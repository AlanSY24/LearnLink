<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities'; // 確保這與資料表名稱一致

    protected $fillable = [
        'id', 'city' // 確保這裡包含你查詢的欄位
    ];
}