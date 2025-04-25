<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagRecipeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryRecipesController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('/signup_view',function(){
    return view('auth.signup');
})->name('signup_page');

Route::get('/login_view',function(){
    return view('auth.login');
})->name('login_page');

Route::get('/create_recipe',function(){
    return view('user.create_recipe');
})->name('create_recipe');


Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// TagController routes
Route::get('/tags', [TagController::class, 'getall'])->name('tags.getall');
Route::post('/tags', [TagController::class, 'create'])->name('tags.create');
Route::put('/tags/{id}', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{id}', [TagController::class, 'delete'])->name('tags.delete');


// tagRecipesController routes
Route::post('/recipes/{recipeId}/tags', [TagRecipeController::class, 'attachTags']);
Route::delete('/recipes/{recipeId}/tags', [TagRecipeController::class, 'detachTags']);
Route::get('/recipes/{recipeId}/tags', [TagRecipeController::class, 'getTagsForRecipe']);
Route::get('/tags/{tagId}/recipes', [TagRecipeController::class, 'getRecipesForTag']);
Route::put('/recipes/{recipeId}/tags', [TagRecipeController::class, 'syncTags']);


// CategoryController routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);


// CategoryRecipesController routes
Route::post('/category-recipes/attach/{recipeId}', [CategoryRecipesController::class, 'attachCategories']);
Route::post('/category-recipes/detach/{recipeId}', [CategoryRecipesController::class, 'detachCategories']);
Route::post('/category-recipes/sync/{recipeId}', [CategoryRecipesController::class, 'syncCategories']);
Route::get('/category-recipes/recipe/{recipeId}', [CategoryRecipesController::class, 'getCategoriesForRecipe']);
Route::get('/category-recipes/category/{categoryId}', [CategoryRecipesController::class, 'getRecipesForCategory']);


// RecipeController routes
Route::post('/recipes', [RecipeController::class, 'create']);
Route::put('/recipes/{recipe}', [RecipeController::class, 'update']);
Route::delete('/recipes/{recipe}', [RecipeController::class, 'delete']); 
Route::delete('/recipes/{recipe}', [RecipeController::class, 'delete']); 