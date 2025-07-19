<?php

namespace App\Domains\Job\Events\Job;

use App\Domains\Job\Models\Job;
use Illuminate\Queue\SerializesModels;

/**
 * Class JobDestroyed.
 */
class JobDestroyed
{
    use SerializesModels;

    /**
     * @var
     */
    public $job;

    /**
     * @param $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}
