<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // Subject 模型中的屬性設置範例
    protected $table = 'subject';  // 資料庫中的表名稱
    protected $fillable = ['name']; // 可以批量賦值的欄位
}