<?php

use App\Domains\Company\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->get('/companies', [CompanyController::class, 'index']);
