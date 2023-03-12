<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const Reader = 1;
    const Librarian = 2;

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
