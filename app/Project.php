<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tasks' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
