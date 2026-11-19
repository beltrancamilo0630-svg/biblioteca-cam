<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Biblioteca de Camilo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen flex flex-col">
    <header class="bg-slate-900 text-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('libros.index') }}" class="text-xl font-bold tracking-wide">
                Biblioteca de Camilo
            </a>
            <nav class="flex items-center gap-3 text-sm font-medium">
                <a href="{{ route('libros.index') }}" class="px-3 py-2 rounded bg-slate-800 hover:bg-slate-700">
                    Libros
                </a>
                <a href="{{ route('libros.create') }}" class="px-3 py-2 rounded bg-emerald-600 hover:bg-emerald-500">
                    Nuevo libro
                </a>
                <a href="{{ route('categorias.index') }}" class="px-3 py-2 rounded bg-slate-800 hover:bg-slate-700">
                    Categorías
                </a>
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-6xl w-full mx-auto px-4 py-8">
        @if (session('ok'))
            <div class="mb-6 rounded-lg bg-emerald-100 border border-emerald-400 text-emerald-900 px-4 py-3">
                {{ session('ok') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-lg bg-red-100 border border-red-400 text-red-900 px-4 py-3">
                {{ session('error') }}
            </div>
        @endif

        @yield('contenido')
    </main>

    <footer class="bg-white border-t border-slate-200 py-4 text-center text-sm text-slate-600">
        Camilo Hurtado · Ficha 3478025 · 2026
    </footer>
</body>
</html>