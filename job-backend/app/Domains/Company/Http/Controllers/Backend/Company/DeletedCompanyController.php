<?php

namespace App\Domains\Company\Http\Controllers\Backend\Company;

use App\Domains\Company\Models\Company;
use App\Domains\Company\Services\CompanyService;

/**
 * Class DeletedCompanyController.
 */
class DeletedCompanyController
{
    /**
     * @var CompanyService
     */
    protected $companyService;

    /**
     * DeletedCompanyController constructor.
     *
     * @param  CompanyService  $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.company.deleted');
    }

    /**
     * @param  Company  $deletedCompany
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Company $deletedCompany)
    {
        $this->companyService->restore($deletedCompany);

        return redirect()->route('admin.company.index')->withFlashSuccess(__('The company was successfully restored.'));
    }

    /**
     * @param  Company  $deletedCompany
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(Company $deletedCompany)
    {
        abort_unless(config('boilerplate.access.company.permanently_delete'), 404);

        $this->companyService->destroy($deletedCompany);

        return redirect()->route('admin.company.deleted')->withFlashSuccess(__('The company was permanently deleted.'));
    }
}
