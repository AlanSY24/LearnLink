<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GetTeacher extends Model
{
    protected $table = 'be_teachers';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'title', 'subject_id', 'available_time', 'hourly_rate',
        'city_id', 'district_ids', 'details', 'resume_id'
    ];

    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function districts()
    {
        $districtIds = json_decode($this->district_ids, true);
        return is_array($districtIds) ? District::whereIn('id', $districtIds)->get() : collect();
    }
}
