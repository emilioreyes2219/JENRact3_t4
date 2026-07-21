<?php

namespace Database\Seeders;

use App\Models\Genero;
use App\Models\Etiqueta;
use App\Models\Libro;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Géneros (relación 1:N con libros)
        $generos = ['Novela', 'Ciencia Ficción', 'Ensayo'];
        foreach ($generos as $g) {
            Genero::create(['nombre' => $g]);
        }

        // Etiquetas (relación N:M con libros)
        $etiquetas = ['Bestseller', 'Clásico', 'Edición Especial', 'Recomendado', 'Nuevo Ingreso', 'Premiado'];
        foreach ($etiquetas as $e) {
            Etiqueta::create(['nombre' => $e]);
        }

        // 20 libros de prueba vía Factory
        $libros = Libro::factory(20)->create();

        // Asignar de 1 a 3 etiquetas aleatorias a cada libro
        $etiquetasDb = Etiqueta::all();
        $libros->each(function ($libro) use ($etiquetasDb) {
            $libro->etiquetas()->attach(
                $etiquetasDb->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
