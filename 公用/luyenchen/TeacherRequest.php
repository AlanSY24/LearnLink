<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherRequest extends Model
{
    protected $fillable = [
        'title', 'subject', 'available_time', 'expected_date',
        'hourly_rate_min', 'hourly_rate_max', 'city_id',
        'district_ids', 'details'
    ];

    protected $casts = [
        'available_time' => 'array',
        'district_ids' => 'array',
        'expected_date' => 'date',
    ];
}
