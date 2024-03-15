<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $fillable = ['name','c_image'];

    /**
     * Get all of the product for the category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Products(): HasMany
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
