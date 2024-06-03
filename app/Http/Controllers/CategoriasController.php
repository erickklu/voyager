<?php

namespace App\Http\Controllers;
use TCG\Voyager\Models\Category;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Category::all(); 

        return view('categories.index', compact('categorias'));
    }
}
