<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Recipe;
use App\Models\UserFollower;
use App\Models\RecipeFavorite;
use App\Models\RecipeLike;
use App\Models\RecipeComment;


class UserController extends Controller
{
    public function account_view($userId = null)
    {
        $user = $userId ? User::find($userId) : Auth::user();
        if (!$user) {
            abort(404, 'User not found');
        }

        $isOwner = Auth::check() && $user->id === Auth::id();

        $isFollowing = false;
        if (Auth::check() && !$isOwner) {
            $isFollowing = $user->followers()->where('id', Auth::id())->exists();
        }

        $socialLinks = [
            'facebook' => $user->facebook_link,
            'instagram' => $user->instagram_link,
            'twitter' => $user->twitter_link,
            'youtube' => $user->youtube_link,
            'tiktok' => $user->tiktok_link,
        ]; 
        $socialLinks = array_filter($socialLinks);

        $followersCount = $user->followers()->count();
        $followingCount = $user->followings()->count();

        $recipes = $user->recipes()
            ->withCount(['likes', 'comments', 'favorites'])
            ->orderByDesc('likes_count')
            ->get(['id', 'title', 'cover_image', 'created_at']);

        $recipesData = $recipes->map(function ($recipe) {
            return [
                'id' => $recipe->id,
                'cover_image' => $recipe->cover_image,
                'title' => $recipe->title,
                'created_at' => $recipe->created_at,
                'likes_count' => $recipe->likes_count,
                'comments_count' => $recipe->comments_count,
                'saves_count' => $recipe->favorites_count,
            ];
        });

        return view('user.account', [
            'user' => $user,
            'bio' => $user->bio,
            'socialLinks' => $socialLinks,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
            'recipes' => $recipesData,
            'isOwner' => $isOwner,
            'isFollowing' => $isFollowing,
        ]);
    }
        
    public function favorites_view()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login_page');
        }

        // Get recipes the user has saved as favorites
        $favoriteRecipes = $user->favorites()->with(['recipe' => function($query) {
            $query->withCount(['likes', 'comments', 'favorites']);
        }])->get()->pluck('recipe');

        $recipesData = $favoriteRecipes->map(function ($recipe) {
            return [
                'id' => $recipe->id,
                'cover_image' => $recipe->cover_image,
                'title' => $recipe->title,            
            ];
        });

        return view('user.favorites', [
            'recipes' => $recipesData,
        ]);
    }

    public function follow(Request $request, $userId)
    {
        $userToFollow = User::findOrFail($userId);
        $user = Auth::user();
    
        if ($user->id === $userToFollow->id) {
            return response()->json(['message' => 'You cannot follow yourself.'], 400);
        }
    
        UserFollower::firstOrCreate([
            'follower_id' => $user->id,
            'following_id' => $userToFollow->id,
        ]);
    }
    

    public function unfollow(Request $request, $userId)
    {
        $userToUnfollow = User::findOrFail($userId);
        $user = Auth::user();
    
        if ($user->id === $userToUnfollow->id) {
            return response()->json(['message' => 'You cannot unfollow yourself.'], 400);
        }
    
        UserFollower::where([
            'follower_id' => $user->id,
            'following_id' => $userToUnfollow->id,
        ])->delete();
    }

    

    public function getFollowers($userId)
    {
        $user = User::findOrFail($userId);
        $followers = $user->followers;
        return view('user.followers_following', [
            'users' => $followers,
            'type' => 'followers',
            'profileUser' => $user,
        ]);
    }

    public function getFollowings($userId)
    {
        $user = User::findOrFail($userId);
        $followings = $user->followings;
        return view('user.followers_following', [
            'users' => $followings,
            'type' => 'followings',
            'profileUser' => $user,
        ]);
    }
    
}
