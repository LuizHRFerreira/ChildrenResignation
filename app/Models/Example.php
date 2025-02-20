<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'descriptions',
        'value',
        'start_date',
        'end_date'
    ];
}
