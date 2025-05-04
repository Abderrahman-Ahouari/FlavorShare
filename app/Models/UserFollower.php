<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollower extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = ['follower_id', 'following_id'];
    protected $fillable = ['follower_id', 'following_id'];

    public function followers()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function followings()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
