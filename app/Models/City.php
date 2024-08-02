<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
<<<<<<< HEAD
    use HasFactory;

    protected $fillable = ['city'];
    protected $table = 'cities';

=======
>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374
    public function districts()
    {
        return $this->hasMany(District::class, 'cities_id');
    }
<<<<<<< HEAD
}
=======
}

>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374
