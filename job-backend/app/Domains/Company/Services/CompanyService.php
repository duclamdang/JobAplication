<?php

namespace App\Domains\Company\Services;

use App\Domains\Company\Events\Company\CompanyCreated;
use App\Domains\Company\Events\Company\CompanyDeleted;
use App\Domains\Company\Events\Company\CompanyDestroyed;
use App\Domains\Company\Events\Company\CompanyRestored;
use App\Domains\Company\Events\Company\CompanyStatusChanged;
use App\Domains\Company\Events\Company\CompanyUpdated;
use App\Domains\Company\Models\Company;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class CompanyService.
 */
class CompanyService extends BaseService
{
    /**
     * CompanyService constructor.
     *
     * @param  Job  $company
     */
    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    /**
     * @param $type
     * @param  bool|int  $perPage
     * @return mixed
     */
    public function getByType($type, $perPage = false)
    {
        if (is_numeric($perPage)) {
            return $this->model::byType($type)->paginate($perPage);
        }

        return $this->model::byType($type)->get();
    }

    /**
     * @param  array  $data
     * @return mixed
     *
     * @throws GeneralException
     */
    public function registerCompany(array $data = []): Company
    {
        DB::beginTransaction();

        try {
            $company = $this->createCompany($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your account.'));
        }

        DB::commit();

        return $company;
    }

    /**
     * @param $info
     * @param $provider
     * @return mixed
     *
     * @throws GeneralException
     */
    public function registerProvider($info, $provider): Company
    {
        $company = $this->model::where('provider_id', $info->id)->first();

        if (! $company) {
            DB::beginTransaction();

            try {
                $company = $this->createCompany([
                    'name' => $info->title,
                    'address' => $info->address,
                    'email' => $info->email,
                ]);
            } catch (Exception $e) {
                DB::rollBack();

                throw new GeneralException(__('There was a problem connecting to :provider', ['provider' => $provider]));
            }

            DB::commit();
        }

        return $company;
    }

    /**
     * @param  array  $data
     * @return Company
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data): Company
    {
        return DB::transaction(function () use ($data) {
            // Xử lý logo nếu có
            if (isset($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
                $data['logo'] = $data['logo']->store('logos', 'public');
            }

            // Tự động tạo slug nếu chưa có
            if (empty($data['slug']) && !empty($data['title'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            // Tạo công ty
            $company = Company::create($data);

            event(new CompanyCreated($company));

            return $company;
        });
    }

    /**
     * @param  Company  $company
     * @param  array  $data
     * @return Company
     *
     * @throws \Throwable
     */
    public function update(Company $company, array $data = []): Company
    {
        DB::beginTransaction();

        try {
            // Nếu có file logo mới
            if (isset($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
                // Xoá logo cũ nếu có
                if ($company->logo) {
                    Storage::disk('public')->delete($company->logo);
                }

                $data['logo'] = $data['logo']->store('logos', 'public');
            } else {
                // Nếu không upload logo mới, bỏ qua logo
                unset($data['logo']);
            }

            // Nếu chưa có slug, tạo slug từ title
            if (empty($data['slug']) && isset($data['title'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            $company->update($data);

            DB::commit();

            return $company;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \App\Exceptions\GeneralException(__('There was a problem updating this company. Please try again.'));
        }
    }

    /**
     * @param  Company  $company
     * @param  array  $data
     * @return Company
     */
    public function updateProfile(Company $company, array $data = []): Company
    {
        $company->name = $data['name'] ?? null;

        if ($company->canChangeEmail() && $company->email !== $data['email']) {
            $company->email = $data['email'];
            $company->email_verified_at = null;
            $company->sendEmailVerificationNotification();
            session()->flash('resent', true);
        }

        return tap($company)->save();
    }


    /**
     * @param  Company  $company
     * @param $status
     * @return Company
     *
     * @throws GeneralException
     */
    public function mark(Company $company, $status): Company
    {
        if ($status === 0 && auth()->id() === $company->id) {
            throw new GeneralException(__('You can not do that to yourself.'));
        }


        $company->active = $status;

        if ($company->save()) {
            event(new CompanyStatusChanged($company, $status));

            return $company;
        }

        throw new GeneralException(__('There was a problem updating this company. Please try again.'));
    }

    /**
     * @param  Company  $company
     * @return Company
     *
     * @throws GeneralException
     */
    public function delete(Company $company): Company
    {
        if ($company->id === auth()->id()) {
            throw new GeneralException(__('You can not delete yourself.'));
        }

        if ($this->deleteById($company->id)) {
            event(new CompanyDeleted($company));

            return $company;
        }

        throw new GeneralException('There was a problem deleting this company. Please try again.');
    }

    /**
     * @param  Company  $company
     * @return Company
     *
     * @throws GeneralException
     */
    public function restore(Company $company): Company
    {
        if ($company->restore()) {
            event(new CompanyRestored($company));

            return $company;
        }

        throw new GeneralException(__('There was a problem restoring this company. Please try again.'));
    }

    /**
     * @param  Company  $company
     * @return bool
     *
     * @throws GeneralException
     */
    public function destroy(Company $company): bool
    {
        if ($company->forceDelete()) {
            event(new CompanyDestroyed($company));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this company. Please try again.'));
    }

    /**
     * @param  array  $data
     * @return Company
     */
    protected function createCompany(array $data = []): Company
    {
        return $this->model::create([
            'type' => $data['type'] ?? $this->model::TYPE_COMPANY,
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'password' => $data['password'] ?? null,
            'provider' => $data['provider'] ?? null,
            'provider_id' => $data['provider_id'] ?? null,
            'email_verified_at' => $data['email_verified_at'] ?? null,
            'active' => $data['active'] ?? true,
        ]);
    }
}
