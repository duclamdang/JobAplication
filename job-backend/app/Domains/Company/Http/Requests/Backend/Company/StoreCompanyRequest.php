<?php

namespace App\Domains\Company\Http\Requests\Backend\Company;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreCompanyRequest.
 */
class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'size' => 'nullable|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:companies,email',
            'website' => 'nullable|url',
            'fullname' => 'nullable|string|max:255',
            'slug' => 'nullable|string|unique:companies,slug',
            'map' => 'nullable|string',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'roles.*.exists' => __('One or more roles were not found or are not allowed to be associated with this user type.'),
            'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this user type.'),
        ];
    }
}
