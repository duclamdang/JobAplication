<?php

namespace App\Domains\Job\Http\Controllers\Backend\Job;

use App\Domains\Job\Http\Requests\Backend\Job\ClearJobSessionRequest;
use App\Domains\Job\Models\Job;

/**
 * Class JobSessionController.
 */
class JobSessionController
{
    /**
     * @param  ClearJobSessionRequest  $request
     * @param  Job  $job
     * @return mixed
     */
    public function update(ClearJobSessionRequest $request, Job $job)
    {
        $job->update(['to_be_logged_out' => true]);

        return redirect()->back()->withFlashSuccess(__('The job\'s session was successfully cleared.'));
    }
}
