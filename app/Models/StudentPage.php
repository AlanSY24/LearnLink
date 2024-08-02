<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPage extends Model
{
    use HasFactory;
    protected $table = 'children_card';

    protected $primaryKey = 'children_id';

    protected $fillable = [
        'user_id',
        'children_name',
        'children_birthdate',
        'children_gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
