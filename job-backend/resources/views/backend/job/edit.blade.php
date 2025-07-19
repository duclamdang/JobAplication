@inject('model', '\App\Domains\Job\Models\Job')

@extends('backend.layouts.app')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('title', __('Update Job'))


@section('content')
    <x-forms.patch :action="route('admin.job.update', $job)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Job')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.job.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="mb-3">
                    <label for="title" class="form-label">Job Name</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $job->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="company_id" class="form-label">Company</label>
                    <select name="company_id" id="company_id" class="form-control" required>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id', $job->company_id) == $company->id ? 'selected' : '' }}>
                                {{ $company->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $job->description) }}" required>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="text" class="form-control" name="quantity" id="quantity" value="{{ old('quantity', $job->quantity) }}" required>
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="text" class="form-control" name="salary" id="salary" value="{{ old('salary', $job->salary) }}" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" id="location" value="{{ old('location', $job->location) }}" required>
                </div>

                <div class="mb-3">
                    <label for="working_time" class="form-label">Working Time</label>
                    <input type="text" class="form-control" name="working_time" id="working_time" value="{{ old('working_time', $job->working_time) }}" required>
                </div>

                <div class="mb-3">
                    <label for="type_id" class="form-label">Type Job</label>
                    <select name="type_id" id="type_id" class="form-control" required>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id', $job->type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="is_fulltime" class="form-label">Full Time</label>
                    <select class="form-control" name="is_fulltime" id="is_fulltime" required>
                        <option value="1" {{ old('is_fulltime', $job->is_fulltime) == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('is_fulltime', $job->is_fulltime) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="lever" class="form-label">Level</label>
                    <input type="text" class="form-control" name="lever" id="lever" value="{{ old('lever', $job->lever) }}" required>
                </div>

                <div class="mb-3">
                    <label for="requirements" class="form-label">Requirements</label>
                    <textarea class="form-control" name="requirements" id="requirements" rows="3" required>{{ old('requirements', $job->requirements) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date"
                           value="{{ old('end_date', optional($job->end_date)->format('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="skills" class="form-label">Skills</label>
                    <input type="text" class="form-control" name="skills" id="skills" value="{{ old('skills', $job->skills) }}" required>
                </div>

                <div class="mb-3">
                    <label for="education" class="form-label">Education</label>
                    <input type="text" class="form-control" name="education" id="education" value="{{ old('education', $job->education) }}" required>
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">Is Active</label>
                    <select class="form-control" name="is_active" id="is_active" required>
                        <option value="1" {{ old('is_active', $job->is_active) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', $job->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="is_urgent" class="form-label">Is Urgent</label>
                    <select class="form-control" name="is_urgent" id="is_urgent" required>
                        <option value="1" {{ old('is_urgent', $job->is_urgent) == 1 ? 'selected' : '' }}>Urgent</option>
                        <option value="0" {{ old('is_urgent', $job->is_urgent) == 0 ? 'selected' : '' }}>Normal</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="1" {{ old('gender', $job->gender) == 1 ? 'selected' : '' }}>Male</option>
                        <option value="0" {{ old('gender', $job->gender) == 0 ? 'selected' : '' }}>Female</option>
                        <option value="2" {{ old('gender', $job->gender) == 2 ? 'selected' : '' }}>Any</option>
                    </select>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Job')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
