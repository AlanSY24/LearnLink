<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $table = 'teacher_profiles';

    protected $primaryKey = 'profile_id'; // 設定主鍵為 user_id

    protected $fillable = [
        'user_id',
        'title',
        'photo',
        'pdf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
