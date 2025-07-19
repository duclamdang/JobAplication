<?php

namespace App\Domains\Company\Http\Controllers\Backend\Company;

use App\Domains\Company\Models\Company;
use App\Domains\Company\Services\CompanyService;
use Illuminate\Http\Request;

/**
 * Class CompanyStatusController.
 */
class DeactivatedCompanyController
{
    /**
     * @var CompanyService
     */
    protected $companyService;

    /**
     * DeactivatedCompanyController constructor.
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
        return view('backend.auth.company.deactivated');
    }

    /**
     * @param  Request  $request
     * @param  Job  $company
     * @param $status
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Request $request, Company $company, $status)
    {
        $this->companyService->mark($company, (int) $status);

        return redirect()->route(
            (int) $status === 1 || ! $request->company()->can('admin.access.company.reactivate') ?
                'admin.company.index' :
                'admin.company.deactivated'
        )->withFlashSuccess(__('The company was successfully updated.'));
    }
}
