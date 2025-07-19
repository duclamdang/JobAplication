<?php

namespace App\Domains\Company\Models;

use App\Domains\Job\Models\Job;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    public const TYPE_COMPANY = 'company';
    public const TYPE_ADMIN = 'admin';

    public function deactivated()
    {
        $companies = Company::where('active', false)->get();

        return view('backend.company.deactivated', compact('companies'));
    }

    protected $fillable = [
        'title',
        'address',
        'logo',
        'description',
        'size',
        'phone',
        'email',
        'website',
        'fullname',
        'slug',
        'map',
    ];
    public function jobs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Job::class);
    }
}
