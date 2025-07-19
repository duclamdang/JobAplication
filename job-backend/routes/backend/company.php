<?php

use App\Domains\Company\Http\Controllers\Backend\Company\CompanyController;
use App\Domains\Company\Models\Company;
use Tabuna\Breadcrumbs\Trail;

    Route::group([
        'prefix' => 'company',
        'as' => 'company.',
    ], function () {
        Route::group([
            'middleware' => 'role:'.config('boilerplate.access.role.admin'),
        ], function () {
            Route::get('create', [CompanyController::class, 'create'])
                ->name('create')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.company.index')
                        ->push(__('Create Company'), route('admin.company.create'));
                });
            Route::post('/', [CompanyController::class, 'store'])->name('store');

            Route::get('/', [CompanyController::class, 'index'])->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->push(__('Company'), route('admin.company.index'));
            });

            Route::get('{company}', [CompanyController::class, 'show'])
                ->name('show')
                ->breadcrumbs(function (Trail $trail, Company $company) {
                    $trail->parent('admin.company.index')
                        ->push($company->title, route('admin.company.show', $company));
                });

            Route::group(['prefix' => '{company}'], function () {
                Route::get('edit', [CompanyController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Company $company) {
                        $trail->parent('admin.company.show', $company)
                            ->push(__('Edit'), route('admin.company.edit', $company));
                    });

                Route::match(['patch', 'put'],'/', [CompanyController::class, 'update'])->name('update');
            });

            Route::get('{company}/show', [CompanyController::class, 'show'])
                ->name('show')
                ->breadcrumbs(function (Trail $trail, Company $company) {
                    $trail->parent('admin.company.index')
                        ->push($company->title, route('admin.company.show', $company));
                });

        });
    });
