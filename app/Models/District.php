<?php
<<<<<<< HEAD

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
namespace App\Models;

>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
<<<<<<< HEAD
    use HasFactory;

    protected $fillable = ['district_name', 'cities_id'];
    protected $table = 'districts';

=======
>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374
    public function city()
    {
        return $this->belongsTo(City::class, 'cities_id');
    }
<<<<<<< HEAD

    
    
=======
>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374
}