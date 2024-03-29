<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'user_role');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'user_permission');
    }

    public function hasPermission($permission)
    {
        return $this->permissions()->contains('name', $permission);
    }
}
