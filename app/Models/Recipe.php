<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'preparation_time',
        'servings',
        'user_id',
        'status',
        'video',
        'video_type',
    ];
    

    protected $casts = [
        'steps' => 'array',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_recipes');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_recipes');
    }

    public function recipe_likes()
    {
        return $this->hasMany(recipe_likes::class);
    }

    public function images()
    {
        return $this->hasMany(recipe_image::class);
    }

    public function steps()
    {
        return $this->hasMany(recipe_steps::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(ingredient::class, 'ingredient_recipes')
                    ->withPivot('quantity', 'unit')
                    ->withTimestamps();
    }


}
