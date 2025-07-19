<?php

namespace App\Domains\Job\Events\Job;

use App\Domains\Job\Models\Job;
use Illuminate\Queue\SerializesModels;

/**
 * Class JobLoggedIn.
 */
class JobLoggedIn
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
        $this->company = $job;
    }
}
