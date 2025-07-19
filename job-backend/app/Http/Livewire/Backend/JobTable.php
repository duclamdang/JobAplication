<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Job\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class JobTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Company Name", "company_id")
                ->sortable(),
            Column::make("Title", "title")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Quantity", "quantity")
                ->sortable(),
            Column::make("Salary", "salary")
                ->sortable(),
            Column::make("Location", "location")
                ->sortable(),
            Column::make("Type", "type_id")
                ->sortable(),
            Column::make("End date", "end_date")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    public function rowView(): string
    {
        return 'backend.job.includes.row';
    }

    public function query(): Builder
    {
        return Job::query();
    }
}
