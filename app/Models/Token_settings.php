<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token_settings extends Model
{
    use HasFactory;
    protected $fillable = ([
        'avg_time_in_min',
        'curr_token',
        'status',
        'start_from_date',
        'start_from_time'
    ]);
}
