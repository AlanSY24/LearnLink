<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'text',
        'city',
        'district',
        'detail_address',
        'hourly_rate'
    ];
}