<?php

namespace App\Domains\Company\Http\Requests\Backend\Company;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class EditCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return !($this->route('company') && !$this->user()->can('update', $this->route('company')));
    }

    public function company()
    {
        return $this->route('company');
    }

    public function rules()
    {
        return [
            //
        ];
    }
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('Only the administrator can update this user.'));
    }
}
