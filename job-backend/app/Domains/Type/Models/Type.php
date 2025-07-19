<?php

namespace App\Domains\Type\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'title',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
