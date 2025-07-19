<?php

namespace App\Domains\Job\Http\Requests\Backend\Job;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreJobRequest.
 */
class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the job is authorized to make this request.
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
            'title'         => 'required|string|max:255',
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
            'gender'        => 'required|integer|in:0,1,2',
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
