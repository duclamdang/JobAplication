@extends('backend.layouts.app')

@section('title', __('Job Management'))

@section('content')
    <h4>Ứng viên ứng tuyển</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            @livewire('backend.job-application-table', ['jobId' => $job->id])
        </div>
    </div>
@endsection
