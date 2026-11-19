@extends('layouts.app')

@section('titulo', 'Registrar libro - Biblioteca de Camilo')

@section('contenido')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h1 class="text-2xl font-bold mb-6">Registrar nuevo libro</h1>

        <form action="{{ route('libros.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Título</label>
                <input type="text" name="titulo" value="{{ old('titulo') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('titulo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Autor</label>
                <input type="text" name="autor" value="{{ old('autor') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('autor')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Año de publicación</label>
                <input type="number" name="anio" value="{{ old('anio') }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                @error('anio')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Categoría</label>
                <select name="categoria_id" class="w-full rounded-lg border border-slate-300 px-3 py-2">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected((string) old('categoria_id') === (string) $categoria->id)>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="disponible" name="disponible" value="1" @checked(old('disponible', '1')) class="rounded border-slate-300">
                <label for="disponible" class="text-sm font-medium">Disponible</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-500">
                    Guardar libro
                </button>
                <a href="{{ route('libros.index') }}" class="px-4 py-2 rounded-lg bg-slate-200 text-slate-800 hover:bg-slate-300">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection