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
        'steps',
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

    public function images()
    {
        return $this->hasMany(RecipeImage::class);
    }

     


}
