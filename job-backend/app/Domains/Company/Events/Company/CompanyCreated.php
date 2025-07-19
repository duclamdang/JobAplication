<?php

namespace App\Domains\Company\Events\Company;

use App\Domains\Company\Models\Company;
use Illuminate\Queue\SerializesModels;

/**
 * Class CompanyCreated.
 */
class CompanyCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $company;

    /**
     * @param Job $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
}
