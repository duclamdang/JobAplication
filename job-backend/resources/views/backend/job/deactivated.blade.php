@extends('backend.layouts.app')

@section('title', __('Deactivated Job'))

@section('breadcrumb-links')
    @include('backend.auth.job.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deactivated Job')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.job-table status="deactivated" />
        </x-slot>
    </x-backend.card>
@endsection
