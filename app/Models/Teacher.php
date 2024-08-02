<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'subject',
        'city',
        'district',
        'min_price',
        'max_price',
        'time',
        'description',
        'picture',
        'score',
    ];

    // 与 User 模型的关系
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 访问器
    public function getPictureAttribute($value)
    {
        return $value ? url('storage/' . $value) : null;
    }
}