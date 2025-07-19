<?php

namespace App\Http\Controllers\Frontend\Company;

use App\Domains\Company\Services\CompanyService;
use App\Http\Requests\Frontend\Company\UpdateProfileRequest;

/**
 * Class ProfileController.
 */
class ProfileController
{
    /**
     * @param  UpdateProfileRequest  $request
     * @param  CompanyService  $companyService
     * @return mixed
     */
    public function update(UpdateProfileRequest $request, CompanyService $companyService)
    {
        $companyService->updateProfile($request->company(), $request->validated());

        if (session()->has('resent')) {
            return redirect()->route('frontend.auth.verification.notice')->withFlashInfo(__('You must confirm your new e-mail address before you can go any further.'));
        }

        return redirect()->route('frontend.company.account', ['#information'])->withFlashSuccess(__('Profile successfully updated.'));
    }
}
