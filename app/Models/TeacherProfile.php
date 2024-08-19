<?php
// 老師履歷表
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

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'teacher_id', 'user_id');
    }
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating');
    }
    public function getRatingsCountAttribute()
    {
        return $this->ratings()->count();
    }
}
