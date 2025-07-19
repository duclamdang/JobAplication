@inject('model', '\App\Domains\Company\Models\Company')

@extends('backend.layouts.app')

@section('title', __('Update Company'))

@section('content')
    <x-forms.patch :action="route('admin.company.update', $company)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Company')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.company.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="mb-3">
                    <label for="title" class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $company->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $company->address) }}" required>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Company Logo</label>
                    <input type="file" class="form-control" name="logo" id="logo">
                    @if ($company->logo)
                        <div class="mt-2">
                            <p class="mb-1">Current Logo:</p>
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Current Logo" height="80" class="border rounded">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $company->description) }}" required>
                </div>

                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <input type="text" class="form-control" name="size" id="size" value="{{ old('size', $company->size) }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $company->phone) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $company->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="text" class="form-control" name="website" id="website" value="{{ old('website', $company->website) }}" required>
                </div>

                <div class="mb-3">
                    <label for="fullname" class="form-label">Fullname</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" value="{{ old('fullname', $company->fullname) }}" required>
                </div>

                <div class="mb-3">
                    <label for="map" class="form-label">Map</label>
                    <input type="text" class="form-control" name="map" id="map" value="{{ old('map', $company->map) }}" required>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Company')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
