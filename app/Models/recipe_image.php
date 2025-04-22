<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recipe_image extends Model
{
    use HasFactory;


    protected $fillable = [
        'recipe_id',
        'image',
    ];


    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
    
}
