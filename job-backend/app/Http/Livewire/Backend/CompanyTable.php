<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Company\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CompanyTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Title", "title")
                ->sortable(),
            Column::make("Address", "address")
                ->sortable(),
            Column::make("Phone", "phone")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Website", "website")
                ->sortable(),
            Column::make("Fullname", "fullname")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    public function query(): Builder
    {
        return Company::query();
    }

    public function rowView(): string
    {
        return 'backend.company.includes.row';
    }

}
