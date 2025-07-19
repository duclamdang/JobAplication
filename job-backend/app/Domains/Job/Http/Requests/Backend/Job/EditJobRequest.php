<?php

namespace App\Domains\Job\Http\Requests\Backend\Job;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class EditJobRequest extends FormRequest
{
    public function authorize()
    {
        return !($this->route('job') && !$this->user()->can('update', $this->route('job')));
    }

    public function job()
    {
        return $this->route('job');
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
