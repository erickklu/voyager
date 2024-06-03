<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publicacione;
use App\Interese;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use TCG\Voyager\Models\Category;

class PublicacionesController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacione::with(['author', 'categoria'])->get();
        $categorias = Category::all();

        return view('posts.index', compact('publicaciones', 'categorias'));
    }

    public function create()
    {
        $categorias = Category::all();
        return view('posts.create', compact('categorias'));
    }

    /* public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'required|image',
            'categoria' => 'required|exists:categorias,id',
        ]);

        $path = $request->file('imagen')->store('public/publicaciones');

        $publicacion = new Publicacione();
        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->imagen = str_replace('public/', '', $path);
        $publicacion->categoria_id = $request->categoria;
        $publicacion->author_id = Auth::id();
        $publicacion->save();

        return redirect()->route('publicaciones')->with('success', 'Publicación creada exitosamente.');
    } */

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'required|image',
            'categoria' => 'required|exists:categories,id', // Asegura que la categoría seleccionada exista en la tabla de categorías
        ]);

        $path = $request->file('imagen')->store('public/publicaciones');

        $publicacion = new Publicacione();
        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->imagen = str_replace('public/', '', $path);
        $publicacion->categoria_id = $request->categoria; // Asocia la publicación con la categoría seleccionada
        $publicacion->author_id = Auth::id();
        $publicacion->save();

        return redirect()->route('publicaciones')->with('success', 'Publicación creada exitosamente.');
    }

    public function edit(Publicacione $publicaciones)
    {
        $this->authorize('update', $publicaciones);
        $categorias = Category::all();

        return view('posts.edit', compact('publicaciones', 'categorias'));
    }

    public function update(Request $request, Publicacione $publicaciones)
    {
        $this->authorize('update', $publicaciones);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image',
            'categoria_id' => 'required|exists:categories,id' // Validar la categoría seleccionada
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('public/publicaciones');
            $publicaciones->imagen = str_replace('public/', '', $path);
        }

        $publicaciones->titulo = $request->titulo;
        $publicaciones->descripcion = $request->descripcion;
        $publicaciones->categoria_id = $request->categoria_id; // Actualizar la categoría
        $publicaciones->save();

        return redirect()->route('publicaciones')->with('success', 'Publicación actualizada exitosamente.');
    }

    public function destroy(Publicacione $publicaciones)
    {
        $this->authorize('delete', $publicaciones);

        Storage::delete('public/' . $publicaciones->imagen);
        $publicaciones->delete();

        return redirect()->route('publicaciones')->with('success', 'Publicación eliminada exitosamente.');
    }

    public function show($id)
    {
        $publicacion = Publicacione::with('categoria')->findOrFail($id);


        return view('posts.read', compact('publicacion'));
    }

    public function meInteresa($id)
    {
        $userId = auth()->user()->id;

        // Verificar si el usuario ya ha dado "Me interesa" a esta publicación
        $likeExistente = Interese::where('user_id', $userId)
            ->where('publicacion_id', $id)
            ->first();

        if ($likeExistente) {
            $likeExistente->delete();
        } else {
            Interese::create([
                'user_id' => $userId,
                'publicacion_id' => $id
            ]);
        }

        return back();
    }

    public function misIntereses()
    {
        $usuario = auth()->user();
        $publicacionesInteresadas = $usuario->publicacionesInteresadas()->paginate(10);
        return view('intereses.read', compact('publicacionesInteresadas'));
    }

    public function filterByCategory($categoryId)
    {
        $publicaciones = Publicacione::with('author')->where('categoria_id', $categoryId)->get();
        $categorias = Category::all(); // Obtener todas las categorías

        return view('posts.index', compact('publicaciones', 'categorias', 'categoryId'));
    }

}
