<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPage extends Model
{
    use HasFactory;
    // protected $table = 'student_cards';

    protected $fillable = [
        'name',
        'age',
        'gender',

    ];
}
