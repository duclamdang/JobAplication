<?php

namespace App\Domains\Company\Http\Controllers\Backend\Company;

use App\Domains\Company\Http\Requests\Backend\Company\DeleteCompanyRequest;
use App\Domains\Company\Http\Requests\Backend\Company\EditCompanyRequest;
use App\Domains\Company\Http\Requests\Backend\Company\StoreCompanyRequest;
use App\Domains\Company\Http\Requests\Backend\Company\UpdateCompanyRequest;
use App\Domains\Company\Models\Company;
use App\Domains\Company\Services\CompanyService;

/**
 * Class JobController.
 */
class CompanyController
{
    /**
     * @var CompanyService
     */
    protected $companyService;

    /**
     * JobController constructor.
     *
     * @param  CompanyService  $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Hiển thị danh sách công ty.
     */
    public function index()
    {
        return view('backend.company.index');
    }

    /**
     * Form tạo công ty mới.
     */
    public function create()
    {
        return view('backend.company.create');
    }

    /**
     * Lưu công ty mới.
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = $this->companyService->store($request->validated());

        return redirect()->route('admin.company.index', $company)
            ->withFlashSuccess(__('The company was successfully created.'));
    }

    /**
     * Hiển thị chi tiết công ty.
     */
    public function show(Company $company)
    {
        return view('backend.company.show')
            ->withCompany($company);
    }

    /**
     * Form chỉnh sửa công ty.
     */
    public function edit(EditCompanyRequest $request, Company $company)
    {
        return view('backend.company.edit')
            ->withCompany($company);
    }

    /**
     * Cập nhật công ty.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->companyService->update($company, $request->validated());

        return redirect()->route('admin.company.show', $company)
            ->withFlashSuccess(__('The company was successfully updated.'));
    }

    /**
     * Xóa công ty.
     */
    public function destroy(DeleteCompanyRequest $request, Company $company)
    {
        $this->companyService->delete($company);

        return redirect()->route('admin.company.deleted')
            ->withFlashSuccess(__('The company was successfully deleted.'));
    }
}
