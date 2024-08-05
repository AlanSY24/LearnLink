<?php
// 成為老師
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_id',
        'available_time',
        'hourly_rate',
        'city_id',
        'district_ids',
        'details',
        'user_id',
    ];

    protected $casts = [
        'available_time' => 'array',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class);
    }
}