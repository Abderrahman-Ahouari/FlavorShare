<?php

namespace App\Http\Controllers;

use App\Models\recipe;
use Illuminate\Http\Request;
use App\Models\ingredient;


class IngredientController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $ingredients = Ingredient::where('name', 'like', '%' . $query . '%')
            ->select('id', 'name')
            ->limit(10)
            ->get();
    
        return response()->json($ingredients);
    }

    

}
