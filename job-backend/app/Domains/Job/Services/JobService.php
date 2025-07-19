<?php

namespace App\Domains\Job\Services;

use App\Domains\Job\Events\Job\JobCreated;
use App\Domains\Job\Events\Job\JobDeleted;
use App\Domains\Job\Events\Job\JobDestroyed;
use App\Domains\Job\Events\Job\JobRestored;
use App\Domains\Job\Events\Job\JobStatusChanged;
use App\Domains\Job\Events\Job\JobUpdated;
use App\Domains\Job\Models\Job;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class JobService.
 */
class JobService extends BaseService
{
    /**
     * JobService constructor.
     *
     * @param  Job  $job
     */
    public function __construct(Job $job)
    {
        $this->model = $job;
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

    /**
     * @param $info
     * @param $provider
     * @return mixed
     *
     * @throws GeneralException
     */

    /**
     * @param  array  $data
     * @return Job
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data): Job
    {
        return DB::transaction(function () use ($data) {
            // Xử lý logo nếu có
//            if (isset($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
//                $data['logo'] = $data['logo']->store('logos', 'public');
//            }

            // Tự động tạo slug nếu chưa có
            if (empty($data['slug']) && !empty($data['title'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            // Tạo công việc
            $job = Job::create($data);

            event(new JobCreated($job));

            return $job;
        });
    }

    /**
     * @param  Job  $job
     * @param  array  $data
     * @return Job
     *
     * @throws \Throwable
     */
    public function update(Job $job, array $data = []): Job
    {
        DB::beginTransaction();

        try {

            // Nếu chưa có slug, tạo slug từ title
            if (empty($data['slug']) && isset($data['title'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            $job->update($data);

            DB::commit();

            return $job;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \App\Exceptions\GeneralException(__('There was a problem updating this job. Please try again.'));
        }
    }

    /**
     * @param  Job  $job
     * @param  array  $data
     * @return Job
     */

    /**
     * @param  Job  $job
     * @param $data
     * @param  bool  $expired
     * @return Job
     *
     * @throws \Throwable
     */
    /**
     * @param  Job  $company
     * @param $status
     * @return Job
     *
     * @throws GeneralException
     */
    public function mark(Job $job, $status): Job
    {
        if ($status === 0 && auth()->id() === $job->id) {
            throw new GeneralException(__('You can not do that to yourself.'));
        }

        if ($status === 0 && $job->isMasterAdmin()) {
            throw new GeneralException(__('You can not deactivate the administrator account.'));
        }

        $job->active = $status;

        if ($job->save()) {
            event(new JobStatusChanged($job, $status));

            return $job;
        }

        throw new GeneralException(__('There was a problem updating this job. Please try again.'));
    }

    /**
     * @param  Job  $job
     * @return Job
     *
     * @throws GeneralException
     */
    public function delete(Job $job): Job
    {
        if ($job->id === auth()->id()) {
            throw new GeneralException(__('You can not delete yourself.'));
        }

        if ($this->deleteById($job->id)) {
            event(new JobDeleted($job));

            return $job;
        }

        throw new GeneralException('There was a problem deleting this job. Please try again.');
    }

    /**
     * @param  Job  $job
     * @return Job
     *
     * @throws GeneralException
     */
    public function restore(Job $job): Job
    {
        if ($job->restore()) {
            event(new JobRestored($job));

            return $job;
        }

        throw new GeneralException(__('There was a problem restoring this job. Please try again.'));
    }

    /**
     * @param  Job  $job
     * @return bool
     *
     * @throws GeneralException
     */
    public function destroy(Job $job): bool
    {
        if ($job->forceDelete()) {
            event(new JobDestroyed($job));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this job. Please try again.'));
    }

    /**
     * @param  array  $data
     * @return Job
     */
    protected function createJob(array $data = []): Job
    {
        return $this->model::create([
            'title' => $data['title'] ?? $this->model::TYPE_JOB,
            'description' => $data['description'] ?? null,
            'quantity' => $data['quantity'] ?? null,
            'salary' => $data['salary'] ?? null,
            'location' => $data['location'] ?? null,
            'working_time' => $data['working_time'] ?? null,
            'type_id' => $data['type_id'] ?? null,
            'lever' => $data['lever'] ?? true,
            'requirements' => $data['requirements'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'skills' => $data['skills'] ?? null,
            'education' => $data['education'] ?? null,
            'is_active' => filter_var($data['is_active'], FILTER_VALIDATE_BOOLEAN),
            'is_urgent' => filter_var($data['is_urgent'], FILTER_VALIDATE_BOOLEAN),
            'gender' => $data['gender'] ?? null,
        ]);
    }
}
