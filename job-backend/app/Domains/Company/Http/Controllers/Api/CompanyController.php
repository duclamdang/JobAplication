<?php

namespace App\Domains\Company\Http\Controllers\Api;

use App\Domains\Company\Models\Company;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return response()->json([
            'data' => $companies
        ], 200);
    }
}
