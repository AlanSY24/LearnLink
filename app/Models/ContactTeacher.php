<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactTeacher extends Model
{
    use HasFactory;
    protected $table = 'contact_teacher';

    protected $fillable = ['be_teacher_id', 'user_id'];

    public function beTeacher()
    {
        return $this->belongsTo(BeTeacher::class, 'be_teacher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
