@extends('layouts.app')

@section('titulo', 'Libros - Biblioteca de Camilo')

@section('contenido')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold">Listado de libros</h1>
        <a href="{{ route('libros.create') }}" class="px-4 py-2 rounded bg-emerald-600 text-white font-medium hover:bg-emerald-500">
            + Registrar libro
        </a>
    </div>

    <form method="GET" action="{{ route('libros.index') }}" class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 mb-6 grid grid-cols-1 md:grid-cols-4 gap-3">
        <input
            type="text"
            name="buscar"
            value="{{ $buscar }}"
            placeholder="Buscar por título..."
            class="md:col-span-2 rounded-lg border border-slate-300 px-3 py-2"
        >

        <select name="categoria_id" class="rounded-lg border border-slate-300 px-3 py-2">
            <option value="">Todas las categorías</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected((string) $categoriaId === (string) $categoria->id)>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>

        <div class="flex gap-2">
            <button type="submit" class="flex-1 rounded-lg bg-slate-900 text-white px-4 py-2 hover:bg-slate-800">
                Filtrar
            </button>
            <a href="{{ route('libros.index') }}" class="rounded-lg bg-slate-200 text-slate-800 px-3 py-2 hover:bg-slate-300">
                Limpiar
            </a>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-sm text-slate-600">
                    <th class="py-3 px-4">Título</th>
                    <th class="py-3 px-4">Autor</th>
                    <th class="py-3 px-4">Año de publicación</th>
                    <th class="py-3 px-4">Categoría</th>
                    <th class="py-3 px-4">Disponible</th>
                    <th class="py-3 px-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse ($libros as $libro)
                    <tr>
                        <td class="py-3 px-4 font-semibold">{{ $libro->titulo }}</td>
                        <td class="py-3 px-4">{{ $libro->autor }}</td>
                        <td class="py-3 px-4">{{ $libro->anio }}</td>
                        <td class="py-3 px-4">{{ $libro->categoria->nombre ?? 'Sin categoría' }}</td>
                        <td class="py-3 px-4">
                            @if ($libro->disponible)
                                <span class="px-2 py-1 rounded text-xs font-medium bg-emerald-100 text-emerald-800">Sí</span>
                            @else
                                <span class="px-2 py-1 rounded text-xs font-medium bg-amber-100 text-amber-800">No</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right whitespace-nowrap">
                            <a href="{{ route('libros.edit', $libro) }}" class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-500 mr-1">
                                Editar
                            </a>
                            <form action="{{ route('libros.destroy', $libro) }}" method="POST" class="inline" onsubmit="return confirm('¿Seguro que deseas eliminar este libro?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-500">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 px-4 text-center text-slate-500">
                            No hay libros que coincidan con la búsqueda o el filtro.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $libros->links() }}
    </div>
@endsection