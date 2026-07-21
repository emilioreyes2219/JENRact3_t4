<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = ['genero_id', 'titulo', 'autor', 'anio_publicacion', 'precio', 'stock'];

    // Relación N:1 -> cada libro pertenece a un solo género
    public function genero() {
        return $this->belongsTo(Genero::class);
    }

    // Relación N:M -> un libro puede tener varias etiquetas
    public function etiquetas() {
        return $this->belongsToMany(Etiqueta::class);
    }
}
