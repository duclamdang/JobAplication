<?php

namespace App\Domains\Job\Http\Requests\Backend\Job;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClearJobSessionRequest.
 */
class ClearJobSessionRequest extends FormRequest
{
    /**
     * Determine if the job is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->job->id !== $this->job()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
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
        throw new AuthorizationException(__('You can not clear your own session.'));
    }
}
