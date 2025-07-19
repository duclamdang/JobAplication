<?php

namespace App\Domains\Company\Events\Company;

use App\Domains\Company\Models\Company;
use Illuminate\Queue\SerializesModels;

/**
 * Class JobStatusChanged.
 */
class CompanyStatusChanged
{
    use SerializesModels;

    /**
     * @var
     */
    public $company;

    /**
     * @var
     */
    public $status;

    /**
     * JobStatusChanged constructor.
     *
     * @param  Company  $company
     * @param $status
     */
    public function __construct(Company $company, $status)
    {
        $this->company = $company;
        $this->status = $status;
    }
}
