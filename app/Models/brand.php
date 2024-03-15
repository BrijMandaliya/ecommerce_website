<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $table = "brand";

    public function sub_category()
    {
        return $this->belongsTo(sub_category::class,'sub_category_id');
    }
}
