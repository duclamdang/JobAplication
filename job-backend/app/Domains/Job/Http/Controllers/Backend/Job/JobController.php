<?php

namespace App\Domains\Job\Http\Controllers\Backend\Job;

use App\Domains\Company\Models\Company;
use App\Domains\Job\Http\Requests\Backend\Job\DeleteJobRequest;
use App\Domains\Job\Http\Requests\Backend\Job\EditJobRequest;
use App\Domains\Job\Http\Requests\Backend\Job\StoreJobRequest;
use App\Domains\Job\Http\Requests\Backend\Job\UpdateJobRequest;
use App\Domains\Job\Models\Job;
use App\Domains\Job\Services\JobService;
use App\Domains\Type\Models\Type;

/**
 * Class JobController.
 */
class JobController
{
    /**
     * @var JobService
     */
    protected $jobService;

    /**
     * JobController constructor.
     *
     * @param  JobService  $jobService
     */
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * Hiển thị danh sách công việc.
     */
    public function index()
    {
        return view('backend.job.index');
    }

    /**
     * Form tạo công viêc mới.
     */
    public function create()
    {
        $companies = Company::all();
        $types = Type::all();
        return view('backend.job.create', compact('companies','types'));
    }

    /**
     * Lưu công việc mới.
     */
    public function store(StoreJobRequest $request)
    {
        $job = $this->jobService->store($request->validated());

        return redirect()->route('admin.job.index', $job)
            ->withFlashSuccess(__('The job was successfully created.'));
    }

    /**
     * Hiển thị chi tiết công vệc.
     */
    public function show(Job $job)
    {
        return view('backend.job.show')
            ->withJob($job);
    }

    /**
     * Form chỉnh sửa công việc.
     */
    public function edit(EditJobRequest $request, Job $job)
    {
        $companies = Company::all();
        $types = Type::all();
        return view('backend.job.edit', compact('job', 'companies', 'types'));
        //return view('backend.job.create', compact('companies','types', 'job'));
    }

    /**
     * Cập nhật công vệc.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $this->jobService->update($job, $request->validated());

        return redirect()->route('admin.job.show', $job)
            ->withFlashSuccess(__('The job was successfully updated.'));
    }

    /**
     * Xóa công việc.
     */
    public function destroy(DeleteJobRequest $request, Job $job)
    {
        $this->jobService->delete($job);

        return redirect()->route('admin.job.deleted')
            ->withFlashSuccess(__('The job was successfully deleted.'));
    }

    public function list(Job $job)
    {
        $applications = $job->applications()->with('user')->get();

        return view('backend.job.job-application.application', compact('job', 'applications'));
    }
}
