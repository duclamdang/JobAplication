<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Job\Models\JobApplication;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class JobApplicationTable extends DataTableComponent
{
    public int $jobId;

    public function mount($jobId)
    {
        $this->jobId = $jobId;
    }

    public function columns(): array
    {
        return [
            Column::make("User", "user.name")
                ->sortable()
                ->format(fn($value, $column, $row) => $row->user->name ?? '-'),

            Column::make("Job Title", "job.title")
                ->sortable()
                ->format(fn($value, $column, $row) => $row->job->title ?? '-'),

            Column::make("Created At", "created_at")
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }
    public function rowView(): string
    {
        return 'backend.job.job-application.includes.row';
    }
    public function query(): Builder
    {
        return JobApplication::query()
            ->with(['user', 'job'])
            ->where('job_id', $this->jobId);
    }
}
