@extends('layouts.app')

@section('titulo', 'Categorías - Biblioteca de Camilo')

@section('contenido')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold">Categorías</h1>
        <a href="{{ route('categorias.create') }}" class="px-4 py-2 rounded bg-emerald-600 text-white font-medium hover:bg-emerald-500">
            + Nueva categoría
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-sm text-slate-600">
                    <th class="py-3 px-4">Nombre</th>
                    <th class="py-3 px-4">Libros asociados</th>
                    <th class="py-3 px-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse ($categorias as $categoria)
                    <tr>
                        <td class="py-3 px-4 font-semibold">{{ $categoria->nombre }}</td>
                        <td class="py-3 px-4">{{ $categoria->libros_count }}</td>
                        <td class="py-3 px-4 text-right">
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline" onsubmit="return confirm('¿Deseas eliminar esta categoría?');">
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
                        <td colspan="3" class="py-6 px-4 text-center text-slate-500">
                            No hay categorías registradas todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection