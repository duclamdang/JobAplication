<?php

namespace App\Domains\Job\Http\Controllers\Backend\Job;

use App\Domains\Job\Models\Job;
use App\Domains\Job\Services\JobService;
use Illuminate\Http\Request;

/**
 * Class JobStatusController.
 */
class DeactivatedJobController
{
    /**
     * @var JobService
     */
    protected $jobService;

    /**
     * DeactivatedJobController constructor.
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
        return view('backend.job.deactivated');
    }

    /**
     * @param  Request  $request
     * @param  Job  $job
     * @param $status
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Request $request, Job $job, $status)
    {
        $this->jobService->mark($job, (int) $status);

        return redirect()->route(
            (int) $status === 1 || ! $request->job()->can('admin.access.job.reactivate') ?
                'admin.job.index' :
                'admin.job.deactivated'
        )->withFlashSuccess(__('The job was successfully updated.'));
    }
}
