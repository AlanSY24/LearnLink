<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GetStudent extends Model
{
    use HasFactory;

    // 指定資料表名稱
    protected $table = 'teacher_requests';

    // 指定主鍵
    protected $primaryKey = 'id';

    // 避免 Laravel 嘗試自動增加 created_at 和 updated_at 欄位
    public $timestamps = true;

    // 指定可填充的欄位
    protected $fillable = [
        'user_id', 'title', 'subject_id', 'available_time', 'expected_date',
        'city_id', 'district_ids', 'details'
    ];

    // 指定不可填充的欄位
    protected $guarded = [];

    /**
     * 取得該學生所屬的科目
     */
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
