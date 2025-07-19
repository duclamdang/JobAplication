<?php

use App\Domains\Job\Http\Controllers\Backend\Job\JobController;
use App\Domains\Job\Models\Job;
use App\Domains\Job\Models\JobApplication;
use Tabuna\Breadcrumbs\Trail;

Route::group([
        'prefix' => 'job',
        'as' => 'job.',
    ], function () {
        Route::group([
            'middleware' => 'role:'.config('boilerplate.access.role.admin'),
        ], function () {
            Route::get('create', [JobController::class, 'create'])
                ->name('create')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.job.index')
                        ->push(__('Create Job'), route('admin.job.create'));
                });
            Route::post('/', [JobController::class, 'store'])->name('store');

            Route::get('/', [JobController::class, 'index'])->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->push(__('Job'), route('admin.job.index'));
            });

            Route::group(['prefix' => '{job}'], function () {
                Route::get('edit', [JobController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Job $job) {
                        $trail->parent('admin.job.show', $job)
                            ->push(__('Edit'), route('admin.job.edit', $job));
                    });

                Route::patch('/', [JobController::class, 'update'])->name('update');
            });

            Route::get('{job}/show', [JobController::class, 'show'])
                ->name('show')
                ->breadcrumbs(function (Trail $trail, Job $job) {
                    $trail->parent('admin.job.index')
                        ->push($job->title, route('admin.job.show', $job));
                });



            Route::get('{job}/application', [JobController::class, 'list'])
                ->name('application')
                ->breadcrumbs(function (Trail $trail, Job $job) {
                    $trail->parent('admin.job.index')
                    ->push($job->title, route('admin.job.application', $job));
                });

        });
    });
