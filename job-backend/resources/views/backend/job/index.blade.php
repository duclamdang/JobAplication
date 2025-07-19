@extends('backend.layouts.app')

@section('title', __('Job Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Job Management')
        </x-slot>

        @if (Auth::user()->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.job.create')"
                    :text="__('Create Job')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.job-table />
        </x-slot>
    </x-backend.card>
@endsection
