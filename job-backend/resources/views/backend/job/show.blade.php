@extends('backend.layouts.app')

@section('title', __('View Job'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('View Job')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.job.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <table class="table table-hover">

                <tr>
                    <th>@lang('Name')</th>
                    <td>{{ $job->title }}</td>
                </tr>

                <tr>
                    <th>@lang('Conpany Name')</th>
                    <td>{{ $job->company->title }}</td>
                </tr>

                <tr>
                    <th>@lang('Description')</th>
                    <td>{{ $job->description }}</td>
                </tr>

                <tr>
                    <th>@lang('Quantity')</th>
                    <td>{{ $job->quantity }}</td>
                </tr>

                <tr>
                    <th>@lang('Salary')</th>
                    <td>{{ $job->salary }}</td>
                </tr>

                <tr>
                    <th>@lang('Location')</th>
                    <td>{{ $job->location }}</td>
                </tr>

                <tr>
                    <th>@lang('Woking Time')</th>
                    <td>{{ $job->working_time }}</td>
                </tr>

                <tr>
                    <th>@lang('Type Job')</th>
                    <td>{{ $job->type->name }}</td>
                </tr>

                <tr>
                    <th>@lang('Fulltime')</th>
                    <td>{{ $job->is_fulltime ? 'Yes' : 'No' }}</td>
                </tr>

                <tr>
                    <th>@lang('Lever')</th>
                    <td>{{ $job->lever }}</td>
                </tr>

                <tr>
                    <th>@lang('Requirements')</th>
                    <td>{{ $job->requirements }}</td>
                </tr>

                <tr>
                    <th>@lang('End Date')</th>
                    <td>{{ $job->end_date }}</td>
                </tr>

                <tr>
                    <th>@lang('Skills')</th>
                    <td>{{ $job->skills }}</td>
                </tr>

                <tr>
                    <th>@lang('Education')</th>
                    <td>{{ $job->education }}</td>
                </tr>

                <tr>
                    <th>@lang('Is Active')</th>
                    <td>{{ $job->is_active ? 'Yes' : 'No' }}</td>
                </tr>

                <tr>
                    <th>@lang('Is Urgent')</th>
                    <td>{{ $job->is_urgent ? 'Yes' : 'No' }}</td>
                </tr>

                <tr>
                    <th>@lang('Gender')</th>
                    <td>{{ $job->gender == 1 ? 'Male' : ($job->gender == 0 ? 'Female' : 'Any') }}</td>
                </tr>
            </table>
        </x-slot>

        <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Account Created'):</strong> @displayDate($job->created_at) ({{ $job->created_at->diffForHumans() }})
                <strong>@lang('Last Updated'):</strong> @displayDate($job->updated_at) ({{ $job->updated_at->diffForHumans() }})

            </small>
        </x-slot>
    </x-backend.card>
@endsection
