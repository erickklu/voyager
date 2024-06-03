<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Publicacione;


class UsuariosController extends Controller
{
    //
    public function index()
    {
        $usuarios = User::all(); // Obtén los productos desde el modelo

        return view('users.index', compact('usuarios'));
    }

    public function edit(User $usuarios)
    {
        $this->authorize('update', $usuarios);

        return view('users.edit', compact('usuarios'));
    }


    public function update(Request $request, User $usuarios)
    {
        $this->authorize('update', $usuarios);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuarios->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opcional: agrega reglas de validación específicas para el avatar
        ]);

        $usuarios->name = $request->name;
        $usuarios->email = $request->email;

        if ($request->hasFile('avatar')) {
            if ($usuarios->avatar) {
                Storage::delete($usuarios->avatar);
            }
            $avatarPath = $request->file('avatar')->store('users', 'public');
            $usuarios->avatar = $avatarPath;
        }
        /*  dd($request->all()); */
        $usuarios->save();
        return redirect()->route('usuarios', $usuarios->id)->with('success', 'Perfil actualizado exitosamente');
    }
    public function show($id)
    {
        $usuario = User::findOrFail($id);

        /* $user = User::findOrFail($id); */
        $publicaciones = Publicacione::where('author_id', $id)->get();

        /* return view('users.show', compact('user', 'publicaciones')); */

        return view('users.read', compact('usuario', 'publicaciones'));
    }

}
