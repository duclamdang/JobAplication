<?php

namespace App\Domains\Job\Models;

use App\Domains\Company\Models\Company;
use App\Domains\Type\Models\Type;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Job.
 */
class Job extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'quantity',
        'salary',
        'location',
        'working_time',
        'type_id',
        'is_fulltime',
        'lever',
        'requirements',
        'end_date',
        'slug',
        'skills',
        'education',
        'is_active',
        'is_urgent',
        'gender',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
