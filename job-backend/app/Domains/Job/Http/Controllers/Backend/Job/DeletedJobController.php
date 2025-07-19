<?php

namespace App\Domains\Job\Http\Controllers\Backend\Job;

use App\Domains\Job\Models\Job;
use App\Domains\Job\Services\JobService;

/**
 * Class DeletedJobController.
 */
class DeletedJobController
{
    /**
     * @var JobService
     */
    protected $jobService;

    /**
     * DeletedJobController constructor.
     *
     * @param  JobService  $jobService
     */
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.job.deleted');
    }

    /**
     * @param  Job  $deletedJob
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Job $deletedJob)
    {
        $this->jobService->restore($deletedJob);

        return redirect()->route('admin.job.index')->withFlashSuccess(__('The job was successfully restored.'));
    }

    /**
     * @param  Job  $deletedjOB
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(Job $deletedJob)
    {
        abort_unless(config('boilerplate.access.job.permanently_delete'), 404);

        $this->jobService->destroy($deletedJob);

        return redirect()->route('admin.auth.job.deleted')->withFlashSuccess(__('The job was permanently deleted.'));
    }
}
