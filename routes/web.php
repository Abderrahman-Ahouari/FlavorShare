<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagRecipeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryRecipesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;


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

Route::get('/home_view',function(){
    return view('user.home');
})->name('home_page');

Route::get('/contact_view',function(){
    return view('user.contact');
})->name('contact_page');

Route::get('/recipe_view',function(){
    return view('user.recipe_details');
})->name('recipe_page');


Route::get('/account_view', [UserController::class, 'account_view'])->name('account_page');
Route::put('/update_info', [AuthController::class, 'update'])->name('profile.update');
Route::get('/favorites_view', [UserController::class, 'favorites_view'])->name('favorites_page');
// Route::get('/recipe_view', [UserController::class, 'recipe_details_view'])->name('recipe_page');



Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// RecipeController routes
Route::post('/recipes', [RecipeController::class, 'create'])->name('recipes.create');                                                                               
Route::delete('/recipes/{recipe}', [RecipeController::class, 'delete']);
Route::get('/create_recipe_view', [RecipeController::class, 'create_recipe_view'])->name('create_recipe');
Route::get('/recipes_view', [RecipeController::class, 'index'])->name('recipes_page');

 
Route::get('/Ingredient_search', [IngredientController::class, 'search'])->name('Ingredient_search');
