<?php

namespace App\Domains\Job\Events\Job;

use App\Domains\Job\Models\Job;
use Illuminate\Queue\SerializesModels;

/**
 * Class JobCreated.
 */
class JobCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $job;

    /**
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}
