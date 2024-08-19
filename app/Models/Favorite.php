<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    
    // 定义可填充的属性
    protected $fillable = [
        'user_id',
        'teacher_request_id',
    ];

    // 与 User 模型的关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 与 TeacherRequest 模型的关联
    public function teacherRequest()
    {
        return $this->belongsTo(TeacherRequest::class, 'teacher_request_id');
    }
}
