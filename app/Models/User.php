<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

        // 定義與 StudentPage 模型的關聯
        public function StudentPage()
        {
            return $this->hasMany(StudentPage::class);
        }
        public function TeacherRequest()
        {
            return $this->hasMany(TeacherRequest::class);
        }
            // 定義與 `favorites` 表的多對多關聯
        public function favoriteTeacherRequests(): BelongsToMany
        {
            return $this->belongsToMany(TeacherRequest::class, 'favorites', 'user_id', 'teacher_request_id');
        }

        /**
         * 取得該用戶的名字
         */
        public function getNameAttribute()
        {
            return $this->attributes['name'];
        }


            // 定義與 `favoriteBeTeachers` 表的多對多關聯

        public function favoriteBeTeachers()
        {
            return $this->belongsToMany(BeTeacher::class, 'favorites_student', 'user_id', 'be_teachers_id');
        }


            // 抓photo

        // public function teacherProfile()
        // {
        //     return $this->hasOne(TeacherProfile::class);
        // }


}
