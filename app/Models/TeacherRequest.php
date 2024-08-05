<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherRequest extends Model
{
    protected $fillable = [
        'title', 'subject_id', 'available_time', 'expected_date',
        'hourly_rate_min', 'hourly_rate_max', 'city_id',
        'district_ids', 'details' ,'user_id',
    ];

    protected $casts = [
        'available_time' => 'array',
        'district_ids' => 'array',
        'expected_date' => 'date',
    ];
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'teacher_request_district');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
