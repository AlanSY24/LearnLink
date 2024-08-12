<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    
    // 定義填充屬性
    protected $fillable = [
        'user_id',
        'teacher_request_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacherRequest()
    {
        return $this->belongsTo(TeacherRequest::class);
    }




}
