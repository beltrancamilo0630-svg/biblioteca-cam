<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $categoriaId = $request->input('categoria_id');

        $libros = Libro::with('categoria')
            ->buscar($buscar)
            ->deCategoria($categoriaId)
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $categorias = Categoria::orderBy('nombre')->get();

        return view('libros.index', compact('libros', 'categorias', 'buscar', 'categoriaId'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('libros.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $anioActual = (int) date('Y');

        $datos = $request->validate([
            'titulo' => 'required|string|min:3|max:150',
            'autor' => 'required|string|min:2|max:120',
            'anio' => "required|integer|min:1500|max:{$anioActual}",
            'categoria_id' => 'required|integer|exists:categorias,id',
            'disponible' => 'nullable|boolean',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 3 caracteres.',
            'autor.required' => 'El autor es obligatorio.',
            'autor.min' => 'El autor debe tener al menos 2 caracteres.',
            'anio.required' => 'El año de publicación es obligatorio.',
            'anio.integer' => 'El año de publicación debe ser un número entero.',
            'anio.min' => 'El año de publicación no puede ser menor a 1500.',
            'anio.max' => "El año de publicación no puede ser mayor a {$anioActual}.",
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
        ]);

        $datos['disponible'] = $request->boolean('disponible');

        Libro::create($datos);

        return redirect()->route('libros.index')
            ->with('ok', 'Libro registrado correctamente.');
    }

    public function edit(Libro $libro)
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('libros.edit', compact('libro', 'categorias'));
    }

    public function update(Request $request, Libro $libro)
    {
        $anioActual = (int) date('Y');

        $datos = $request->validate([
            'titulo' => 'required|string|min:3|max:150',
            'autor' => 'required|string|min:2|max:120',
            'anio' => "required|integer|min:1500|max:{$anioActual}",
            'categoria_id' => 'required|integer|exists:categorias,id',
            'disponible' => 'nullable|boolean',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 3 caracteres.',
            'autor.required' => 'El autor es obligatorio.',
            'autor.min' => 'El autor debe tener al menos 2 caracteres.',
            'anio.required' => 'El año de publicación es obligatorio.',
            'anio.integer' => 'El año de publicación debe ser un número entero.',
            'anio.min' => 'El año de publicación no puede ser menor a 1500.',
            'anio.max' => "El año de publicación no puede ser mayor a {$anioActual}.",
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
        ]);

        $datos['disponible'] = $request->boolean('disponible');

        $libro->update($datos);

        return redirect()->route('libros.index')
            ->with('ok', 'Libro actualizado correctamente.');
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('libros.index')
            ->with('ok', 'Libro eliminado correctamente.');
    }
}