<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetTeacher extends Model
{

    use HasFactory;

    protected $table = 'be_teachers';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'title', 'subject_id', 'available_time', 'hourly_rate',
        'city_id', 'district_ids', 'details', 'resume_id'
    ];

    protected $guarded = [];

    
    /**
     * 取得教師所屬科目
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    /**
     * 取得教師的使用者資訊
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * 取得教師所在城市
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
     * 取得教師所屬區域
     */
    public function districts()
    {
        $districtIds = json_decode($this->district_ids, true);
        return is_array($districtIds) ? District::whereIn('id', $districtIds)->get() : collect();
    }
    public function profile()
    {
        return $this->hasOne(TeacherProfile::class, 'user_id', 'user_id');
    }
}
