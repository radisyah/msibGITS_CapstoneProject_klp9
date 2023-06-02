<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

     protected $fillable = [
        'id',
        'level'
    ];

    public function User(){
        return $this->hasMany(User::class);
    }
}
