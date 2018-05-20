<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'days', 'hours', 'minutes', 'seconds', 'description',
    ];
}
