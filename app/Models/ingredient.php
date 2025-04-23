<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredient_recipes')
                    ->withPivot('quantity', 'unit')
                    ->withTimestamps();
    }
}
