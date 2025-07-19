@inject('model', '\App\Domains\Company\Models\Company')

@extends('backend.layouts.app')

@section('title', __('Create Company'))

@section('content')
    <x-forms.post :action="route('admin.company.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Company')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.company.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">

                {{-- Title --}}
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">@lang('Title')</label>
                    <div class="col-md-10">
                        <input type="text" name="title" class="form-control" placeholder="{{ __('Company Title') }}" value="{{ old('title') }}" required />
                    </div>
                </div>

                {{-- Fullname --}}
                <div class="form-group row">
                    <label for="fullname" class="col-md-2 col-form-label">@lang('Full Name')</label>
                    <div class="col-md-10">
                        <input type="text" name="fullname" class="form-control" placeholder="{{ __('Full Company Name') }}" value="{{ old('fullname') }}" required />
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label">@lang('Email')</label>
                    <div class="col-md-10">
                        <input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required />
                    </div>
                </div>

                {{-- Phone --}}
                <div class="form-group row">
                    <label for="phone" class="col-md-2 col-form-label">@lang('Phone')</label>
                    <div class="col-md-10">
                        <input type="text" name="phone" class="form-control" placeholder="{{ __('Phone') }}" value="{{ old('phone') }}" required />
                    </div>
                </div>

                {{-- Address --}}
                <div class="form-group row">
                    <label for="address" class="col-md-2 col-form-label">@lang('Address')</label>
                    <div class="col-md-10">
                        <input type="text" name="address" class="form-control" placeholder="{{ __('Address') }}" value="{{ old('address') }}" />
                    </div>
                </div>

                {{-- Website --}}
                <div class="form-group row">
                    <label for="website" class="col-md-2 col-form-label">@lang('Website')</label>
                    <div class="col-md-10">
                        <input type="text" name="website" class="form-control" placeholder="{{ __('Website URL') }}" value="{{ old('website') }}" />
                    </div>
                </div>

                {{-- Size --}}
                <div class="form-group row">
                    <label for="size" class="col-md-2 col-form-label">@lang('Size')</label>
                    <div class="col-md-10">
                        <input type="text" name="size" class="form-control" placeholder="{{ __('Company Size') }}" value="{{ old('size') }}" />
                    </div>
                </div>

                {{-- Logo --}}
                <div class="form-group row">
                    <label for="logo" class="col-md-2 col-form-label">@lang('Logo')</label>
                    <div class="col-md-10">
                        <input type="file" name="logo" class="form-control-file" />
                    </div>
                </div>

                {{-- Description --}}
                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label">@lang('Description')</label>
                    <div class="col-md-10">
                        <textarea name="description" class="form-control" rows="4" placeholder="{{ __('Company Description') }}">{{ old('description') }}</textarea>
                    </div>
                </div>

{{--                --}}{{-- Slug --}}
{{--                <div class="form-group row">--}}
{{--                    <label for="slug" class="col-md-2 col-form-label">@lang('Slug')</label>--}}
{{--                    <div class="col-md-10">--}}
{{--                        <input type="text" name="slug" class="form-control" placeholder="{{ __('Slug') }}" value="{{ old('slug') }}" />--}}
{{--                    </div>--}}
{{--                </div>--}}

                {{-- Map --}}
                <div class="form-group row">
                    <label for="map" class="col-md-2 col-form-label">@lang('Map')</label>
                    <div class="col-md-10">
                        <textarea name="map" class="form-control" rows="3" placeholder="{{ __('Map Embed Code') }}">{{ old('map') }}</textarea>
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Company')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
