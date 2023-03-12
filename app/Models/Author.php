<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'image',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . " "  .  $this->last_name;
    }

    public function getFullPathImageAttribute()
    {
        if($this->image) {
            return Storage::disk('public')->url("authors/" . $this->image);
        }
    }

    public function author(){
        return $this->hasMany('App\Models\Book');
    }
}
