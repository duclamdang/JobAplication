@extends('backend.layouts.app')

@section('title', __('Company Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Company Management')
        </x-slot>

        @if (Auth::user()->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.company.create')"
                    :text="__('Create Company')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.company-table />
        </x-slot>
    </x-backend.card>
@endsection
