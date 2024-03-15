<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','shortDescription','Description','price','stock','category_id','sub_category_id','brand_id','p_image_1','created_at','updated_at','user_id','user_IP'
    ];

    public function category()
    {
        return $this->belongsTo(category::class,'category_id');
    }

    public function categories()
    {
        return $this->hasMany(category::class,'id');
    }
}
