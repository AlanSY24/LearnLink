<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactStudent extends Model
{
    use HasFactory;

    protected $table = 'contact_student';

    protected $fillable = [
        'teacher_requests_id',
        'user_id',
    ];

    public function teacherRequest()
    {
        return $this->belongsTo(TeacherRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
