<?php

namespace App\Domains\Job\Http\Requests\Backend\Job;

use Illuminate\Validation\Rule;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateCompanyRequest.
 */
class UpdateJobRequest extends FormRequest
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
            'company_id'    => 'required|exists:companies,id',
            'title'         => [
                'required',
                'string',
                'max:255',
                Rule::unique('jobs', 'title')->ignore($this->job->id),
            ],
            'description'   => 'required|string',
            'quantity'      => 'required|integer|min:1',
            'salary'        => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'working_time'  => 'required|string|max:255',
            'type_id'       => 'required|integer',
            'is_fulltime'   => 'required|boolean',
            'lever'         => 'required|string|max:255',
            'requirements'  => 'required|string',
            'end_date'      => 'required|date|after_or_equal:today',
            'skills'        => 'required|string|max:255',
            'education'     => 'required|string|max:255',
            'is_active'     => 'required|boolean',
            'is_urgent'     => 'required|boolean',
            'gender'        => 'required|boolean',
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

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('Only the administrator can update this user.'));
    }
}
