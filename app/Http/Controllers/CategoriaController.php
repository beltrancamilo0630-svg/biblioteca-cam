<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('libros')->orderBy('nombre')->get();

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|min:2|max:80|unique:categorias,nombre',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.min' => 'El nombre de la categoría debe tener al menos 2 caracteres.',
            'nombre.max' => 'El nombre de la categoría no puede superar 80 caracteres.',
            'nombre.unique' => 'Esa categoría ya existe.',
        ]);

        Categoria::create($datos);

        return redirect()->route('categorias.index')
            ->with('ok', 'Categoría creada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->libros()->exists()) {
            return redirect()->route('categorias.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene libros asociados.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('ok', 'Categoría eliminada correctamente.');
    }
}