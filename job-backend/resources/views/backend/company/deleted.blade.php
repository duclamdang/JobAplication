@extends('backend.layouts.app')

@section('title', __('Deleted Company'))

@section('breadcrumb-links')
    @include('backend.auth.company.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Company')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.company-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
