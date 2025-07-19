<?php

namespace App\Domains\Job\Events\Job;

use App\Domains\Job\Models\Job;
use Illuminate\Queue\SerializesModels;

/**
 * Class JobStatusChanged.
 */
class JobStatusChanged
{
    use SerializesModels;

    /**
     * @var
     */
    public $job;

    /**
     * @var
     */
    public $status;

    /**
     * JobStatusChanged constructor.
     *
     * @param  Job  $job
     * @param $status
     */
    public function __construct(Job $job, $status)
    {
        $this->job = $job;
        $this->status = $status;
    }
}
