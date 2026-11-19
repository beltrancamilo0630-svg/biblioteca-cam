@extends('layouts.app')

@section('titulo', 'Editar libro - Biblioteca de Camilo')

@section('contenido')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h1 class="text-2xl font-bold mb-6">Editar libro</h1>

        <form action="{{ route('libros.update', $libro) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Título</label>
                <input type="text" name="titulo" value="{{ old('titulo', $libro->titulo) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('titulo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Autor</label>
                <input type="text" name="autor" value="{{ old('autor', $libro->autor) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('autor')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Año de publicación</label>
                <input type="number" name="anio" value="{{ old('anio', $libro->anio) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('anio')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Categoría</label>
                <select name="categoria_id" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected((string) old('categoria_id', $libro->categoria_id) === (string) $categoria->id)>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="disponible" name="disponible" value="1" @checked(old('disponible', $libro->disponible)) class="rounded border-slate-300">
                <label for="disponible" class="text-sm font-medium">Disponible</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-500">
                    Actualizar libro
                </button>
                <a href="{{ route('libros.index') }}" class="px-4 py-2 rounded-lg bg-slate-200 text-slate-800 hover:bg-slate-300">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection