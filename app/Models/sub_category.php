<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    use HasFactory;

    protected $table = "sub_category";

    public function parent_category()
    {
        return $this->belongsTo(category::class,'parent_category_id');
    }

    public function brand()
    {
        return $this->hasMany(brand::class,'id');
    }
}
