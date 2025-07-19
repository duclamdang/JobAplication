<?php

namespace App\Domains\Company\Events\Company;

use App\Domains\Company\Models\Company;
use Illuminate\Queue\SerializesModels;

/**
 * Class JobDestroyed.
 */
class CompanyDestroyed
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
