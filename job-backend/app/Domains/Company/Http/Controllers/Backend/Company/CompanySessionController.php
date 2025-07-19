<?php

namespace App\Domains\Company\Http\Controllers\Backend\Company;

use App\Domains\Company\Http\Requests\Backend\Company\ClearCompanySessionRequest;
use App\Domains\Company\Models\Company;

/**
 * Class CompanySessionController.
 */
class CompanySessionController
{
    /**
     * @param  ClearCompanySessionRequest  $request
     * @param  Company  $company
     * @return mixed
     */
    public function update(ClearCompanySessionRequest $request, Company $company)
    {
        $company->update(['to_be_logged_out' => true]);

        return redirect()->back()->withFlashSuccess(__('The company\'s session was successfully cleared.'));
    }
}
