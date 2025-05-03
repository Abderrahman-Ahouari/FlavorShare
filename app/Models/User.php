<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'bio',
        'role',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'youtube_link',
        'tiktok_link',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    public function recipe_likes()
    {
        return $this->hasMany(recipe_likes::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    
    public function comments()
    {
        return $this->hasMany(comment::class);
    }

    public function comment_reactions()
    {
        return $this->hasMany(CommentReaction::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
    
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'following_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'following_id');
    }
}
