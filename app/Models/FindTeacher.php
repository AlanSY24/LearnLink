<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FindTeacher extends Model
{
    use HasFactory;

    // 指定表名（如果不同於默認的複數形式）
    protected $table = 'find_teachers';

    // 可批量賦值的屬性
    protected $fillable = [
        'title',
        'subject',
        'frequency',
        'hourly_rate_min',
        'hourly_rate_max',
        'city',
        'districts',
        'details',
        'connection',
        'contact_value',
        'available_time',
    ];

    // 類型轉換
    protected $casts = [
        'hourly_rate_min' => 'integer',
        'hourly_rate_max' => 'integer',
        'districts' => 'array', // 如果存儲為 JSON
    ];

    // 日期字段
    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    // ];

    // 關聯方法（如果需要）
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // 自定義方法
    public function getFullHourlyRateAttribute()
    {
        return "$this->hourly_rate_min - $this->hourly_rate_max";
    }

    // 範圍查詢
    // public function scopeActive($query)
    // {
    //     return $query->where('status', 'active');
    // }
}