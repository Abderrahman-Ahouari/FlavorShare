<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Recipe;

class UserController extends Controller
{
    public function account_view(Request $request)
    {
        $userId = $request->input('user_id');
        $user = $userId ? User::find($userId) : Auth::user();
        if (!$user) {
            return redirect()->route('login_page');
        }

        $isOwner = Auth::check() && $user->id === Auth::id();

        // Social links
        $socialLinks = [
            'facebook' => $user->facebook_link,
            'instagram' => $user->instagram_link,
            'twitter' => $user->twitter_link,
            'youtube' => $user->youtube_link,
            'tiktok' => $user->tiktok_link,
        ];
        $socialLinks = array_filter($socialLinks); // Only available links

        // Followers and following count
        $followersCount = $user->followers()->count();
        $followingCount = $user->followings()->count();

        // Recipes sorted by most liked
        $recipes = Recipe::where('user_id', $user->id)
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
            'socialLinks' => $socialLinks,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
            'recipes' => $recipesData,
            'isOwner' => $isOwner,
        ]);
    }
}
