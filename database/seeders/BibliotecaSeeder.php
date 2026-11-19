<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Database\Seeder;

class BibliotecaSeeder extends Seeder
{
    public function run(): void
    {
        $categoriasNombres = [
            'Novela Colombiana',
            'Literatura Universal',
            'Novela Histórica y Ciencia Ficción',
            'Fútbol y Deporte',
            'Programación y Software',
        ];

        $categorias = [];
        foreach ($categoriasNombres as $nombre) {
            $categorias[$nombre] = Categoria::firstOrCreate(['nombre' => $nombre]);
        }

        $libros = [
            ['titulo' => 'El triunfo del vidente', 'autor' => 'Mario Mendoza', 'anio' => 1997, 'cat' => 'Novela Colombiana', 'disp' => true],
            ['titulo' => 'Táctica moderna en la cancha', 'autor' => 'Mateo Rojas', 'anio' => 2019, 'cat' => 'Fútbol y Deporte', 'disp' => true],
            ['titulo' => 'Satanás', 'autor' => 'Mario Mendoza', 'anio' => 2002, 'cat' => 'Novela Colombiana', 'disp' => true],
            ['titulo' => 'El día del odio', 'autor' => 'José Antonio Osorio Lizarazo', 'anio' => 1952, 'cat' => 'Novela Colombiana', 'disp' => false],
            ['titulo' => 'El perfume', 'autor' => 'Patrick Süskind', 'anio' => 1985, 'cat' => 'Literatura Universal', 'disp' => true],
            ['titulo' => 'Los miserables', 'autor' => 'Victor Hugo', 'anio' => 1862, 'cat' => 'Literatura Universal', 'disp' => true],
            ['titulo' => 'La Divina Comedia', 'autor' => 'Dante Alighieri', 'anio' => 1555, 'cat' => 'Literatura Universal', 'disp' => true],
            ['titulo' => 'Sombras de medianoche', 'autor' => 'Camila Torres', 'anio' => 2022, 'cat' => 'Programación y Software', 'disp' => false],
            ['titulo' => 'Jerusalén: Caballo de Troya 1', 'autor' => 'J. J. Benítez', 'anio' => 1984, 'cat' => 'Novela Histórica y Ciencia Ficción', 'disp' => true],
            ['titulo' => 'Caballo de Troya 2: Masada', 'autor' => 'J. J. Benítez', 'anio' => 1986, 'cat' => 'Novela Histórica y Ciencia Ficción', 'disp' => true],
        ];

        foreach ($libros as $item) {
            Libro::firstOrCreate(
                ['titulo' => $item['titulo']],
                [
                    'autor' => $item['autor'],
                    'anio' => $item['anio'],
                    'categoria_id' => $categorias[$item['cat']]->id,
                    'disponible' => $item['disp'],
                ]
            );
        }
    }
}