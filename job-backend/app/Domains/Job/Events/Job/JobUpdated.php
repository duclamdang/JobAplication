<?php

namespace App\Domains\Job\Events\Job;

use App\Domains\Job\Models\Job;
use Illuminate\Queue\SerializesModels;

/**
 * Class JobUpdated.
 */
class JobUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $company;

    /**
     * @param $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
}
