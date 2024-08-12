<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteStudent extends Model
{
    use HasFactory;
    protected $table = 'favorites_student';

    protected $fillable = [
        'user_id',
        'be_teachers_id',
    ];

    // 與 User 的關聯
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 與 BeTeacher 的關聯
    public function beTeacher()
    {
        return $this->belongsTo(BeTeacher::class, 'be_teachers_id');
    }
}
