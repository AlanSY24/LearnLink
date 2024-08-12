<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetStudent extends Model
{
    use HasFactory;

    protected $table = 'teacher_requests';

    // 确保主键设置正确
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'user_id', 'title', 'subject_id', 'available_time', 'expected_date',
        'city_id', 'district_ids', 'details'
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
