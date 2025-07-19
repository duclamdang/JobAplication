@extends('backend.layouts.app')

@section('title', __('View Company'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('View Company')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.company.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <table class="table table-hover">

                <tr>
                    <th>@lang('Name')</th>
                    <td>{{ $company->title }}</td>
                </tr>

                <tr>
                    <th>@lang('Address')</th>
                    <td>{{ $company->address }}</td>
                </tr>

                <tr>
                    <th>@lang('Description')</th>
                    <td>{{ $company->description }}</td>
                </tr>

                <tr>
                    <th>@lang('Size')</th>
                    <td>{{ $company->size }}</td>
                </tr>

                <tr>
                    <th>@lang('Phone')</th>
                    <td>{{ $company->phone }}</td>
                </tr>

                <tr>
                    <th>@lang('Email')</th>
                    <td>{{ $company->email }}</td>
                </tr>

                <tr>
                    <th>@lang('Website')</th>
                    <td>{{ $company->website }}</td>
                </tr>

                <tr>
                    <th>@lang('Fullname')</th>
                    <td>{{ $company->fullname }}</td>
                </tr>

                <tr>
                    <th>@lang('Map')</th>
                    <td>{{ $company->map }}</td>
                </tr>
            </table>
        </x-slot>

        <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Account Created'):</strong> @displayDate($company->created_at) ({{ $company->created_at->diffForHumans() }})
                <strong>@lang('Last Updated'):</strong> @displayDate($company->updated_at) ({{ $company->updated_at->diffForHumans() }})

            </small>
        </x-slot>
    </x-backend.card>
@endsection
