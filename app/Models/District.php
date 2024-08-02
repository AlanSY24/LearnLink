<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['district_name', 'cities_id'];
    protected $table = 'districts';

    public function city()
    {
        return $this->belongsTo(City::class, 'cities_id');
    }

    
    
}