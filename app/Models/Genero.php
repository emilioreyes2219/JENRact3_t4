<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $fillable = ['nombre'];

    // Relación 1:N -> un género tiene muchos libros
    public function libros() {
        return $this->hasMany(Libro::class);
    }
}
