@inject('model', '\App\Domains\Job\Models\Job')

@extends('backend.layouts.app')

@section('title', __('Create Job'))

@section('content')
    <x-forms.post :action="route('admin.job.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Job')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.job.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">

                {{-- Title --}}
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">@lang('Job Title')</label>
                    <div class="col-md-10">
                        <input type="text" name="title" class="form-control" placeholder="{{ __('Job Name') }}"value="{{ old('title') }}" required />
                    </div>
                </div>
                {{-- Company --}}
                <div class="form-group row">
                    <label for="company_id" class="col-md-2 col-form-label">@lang('Company')</label>
                    <div class="col-md-10">
                        <select name="company_id" class="form-control" required>
                            <option value="">{{ __('Select Type') }}</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Description --}}
                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label">@lang('Description')</label>
                    <div class="col-md-10">
                        <textarea name="description" class="form-control" placeholder="{{ __('Job Description') }}" rows="4">{{ old('description') }}</textarea>
                    </div>
                </div>

                {{-- Quantity --}}
                <div class="form-group row">
                    <label for="quantity" class="col-md-2 col-form-label">@lang('Quantity')</label>
                    <div class="col-md-10">
                        <input type="number" name="quantity" class="form-control" placeholder="{{ __('Quantity') }}" value="{{ old('quantity') }}" required />
                    </div>
                </div>

                {{-- Salary --}}
                <div class="form-group row">
                    <label for="salary" class="col-md-2 col-form-label">@lang('Salary')</label>
                    <div class="col-md-10">
                        <input type="text" name="salary" class="form-control" placeholder="{{ __('Salary') }}" value="{{ old('salary') }}" required />
                    </div>
                </div>

                {{-- Location --}}
                <div class="form-group row">
                    <label for="location" class="col-md-2 col-form-label">@lang('Location')</label>
                    <div class="col-md-10">
                        <input type="text" name="location" class="form-control" placeholder="{{ __('Location') }}" value="{{ old('location') }}" required />
                    </div>
                </div>

                {{-- Working Time --}}
                <div class="form-group row">
                    <label for="working_time" class="col-md-2 col-form-label">@lang('Working Time')</label>
                    <div class="col-md-10">
                        <input type="text" name="working_time" class="form-control" placeholder="{{ __('Working Time') }}" value="{{ old('working_time') }}" required />
                    </div>
                </div>

                {{-- Type --}}
                <div class="form-group row">
                    <label for="type_id" class="col-md-2 col-form-label">@lang('Job Type')</label>
                    <div class="col-md-10">
                        <select name="type_id" class="form-control" required>
                            <option value="">{{ __('Select Type') }}</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Fulltime --}}
                <div class="form-group row">
                    <label for="is_fulltime" class="col-md-2 col-form-label">@lang('Is Full-time')</label>
                    <div class="col-md-10">
                        <select name="is_fulltime" class="form-control"  required>
                            <option value="1" {{ old('is_fulltime') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_fulltime') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>

                {{-- Lever --}}
                <div class="form-group row">
                    <label for="lever" class="col-md-2 col-form-label">@lang('Level')</label>
                    <div class="col-md-10">
                        <input type="text" name="lever" class="form-control" placeholder="{{ __('Lever') }}" value="{{ old('lever') }}" />
                    </div>
                </div>

                {{-- Requirements --}}
                <div class="form-group row">
                    <label for="requirements" class="col-md-2 col-form-label">@lang('Requirements')</label>
                    <div class="col-md-10">
                        <textarea name="requirements" class="form-control" placeholder="{{ __('Requirements') }}" rows="4">{{ old('requirements') }}</textarea>
                    </div>
                </div>

                {{-- End Date --}}
                <div class="form-group row">
                    <label for="end_date" class="col-md-2 col-form-label">@lang('End Date')</label>
                    <div class="col-md-10">
                        <input type="date" name="end_date" class="form-control" placeholder="{{ __('End Date') }}" value="{{ old('end_date') }}" />
                    </div>
                </div>

                {{-- Skills --}}
                <div class="form-group row">
                    <label for="skills" class="col-md-2 col-form-label">@lang('Skills')</label>
                    <div class="col-md-10">
                        <input type="text" name="skills" class="form-control" placeholder="{{ __('Skills') }}" value="{{ old('skills') }}" placeholder="e.g. PHP, Laravel, MySQL" />
                    </div>
                </div>

                {{-- Education --}}
                <div class="form-group row">
                    <label for="education" class="col-md-2 col-form-label">@lang('Education')</label>
                    <div class="col-md-10">
                        <input type="text" name="education" class="form-control" placeholder="{{ __('Education') }}" value="{{ old('education') }}" />
                    </div>
                </div>

                {{-- Is Active --}}
                <div class="form-group row">
                    <label for="is_active" class="col-md-2 col-form-label">@lang('Is Active')</label>
                    <div class="col-md-10">
                        <select name="is_active" class="form-control">
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                {{-- Is Urgent --}}
                <div class="form-group row">
                    <label for="is_urgent" class="col-md-2 col-form-label">@lang('Is Urgent')</label>
                    <div class="col-md-10">
                        <select name="is_urgent" class="form-control">
                            <option value="1" {{ old('is_urgent') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_urgent') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>

                {{-- Gender --}}
                <div class="form-group row">
                    <label for="gender" class="col-md-2 col-form-label">@lang('Gender')</label>
                    <div class="col-md-10">
                        <select name="gender" class="form-control">
                            <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Any</option>
                            <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Male</option>
                            <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Job')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
