<?php

namespace Database\Factories;

use App\Models\Genero;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibroFactory extends Factory
{
    public function definition(): array
    {
        $catalogo = [
            'Novela' => [
                ['titulo' => 'Cien años de soledad', 'autor' => 'Gabriel García Márquez', 'anio' => 1967],
                ['titulo' => 'Rayuela', 'autor' => 'Julio Cortázar', 'anio' => 1963],
                ['titulo' => 'Pedro Páramo', 'autor' => 'Juan Rulfo', 'anio' => 1955],
                ['titulo' => 'La casa de los espíritus', 'autor' => 'Isabel Allende', 'anio' => 1982],
                ['titulo' => '1984', 'autor' => 'George Orwell', 'anio' => 1949],
                ['titulo' => 'Crimen y castigo', 'autor' => 'Fiódor Dostoyevski', 'anio' => 1866],
            ],
            'Ciencia Ficción' => [
                ['titulo' => 'Dune', 'autor' => 'Frank Herbert', 'anio' => 1965],
                ['titulo' => 'Fahrenheit 451', 'autor' => 'Ray Bradbury', 'anio' => 1953],
                ['titulo' => 'Fundación', 'autor' => 'Isaac Asimov', 'anio' => 1951],
                ['titulo' => 'Neuromante', 'autor' => 'William Gibson', 'anio' => 1984],
                ['titulo' => 'Un mundo feliz', 'autor' => 'Aldous Huxley', 'anio' => 1932],
            ],
            'Ensayo' => [
                ['titulo' => 'El arte de la guerra', 'autor' => 'Sun Tzu', 'anio' => -500],
                ['titulo' => 'Sapiens', 'autor' => 'Yuval Noah Harari', 'anio' => 2011],
                ['titulo' => 'El príncipe', 'autor' => 'Nicolás Maquiavelo', 'anio' => 1532],
                ['titulo' => 'Meditaciones', 'autor' => 'Marco Aurelio', 'anio' => 180],
            ],
        ];

        $generoDb = Genero::inRandomOrder()->first() ?? Genero::create(['nombre' => 'Novela']);
        $nombreGenero = $generoDb->nombre;

        $opciones = $catalogo[$nombreGenero] ?? $catalogo['Novela'];
        $libro = $opciones[array_rand($opciones)];

        return [
            'genero_id' => $generoDb->id,
            'titulo' => $libro['titulo'],
            'autor' => $libro['autor'],
            'anio_publicacion' => max($libro['anio'], 1400),
            'precio' => $this->faker->randomFloat(2, 80, 650),
            'stock' => $this->faker->numberBetween(0, 40),
        ];
    }
}
