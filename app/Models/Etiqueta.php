<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $fillable = ['nombre'];

    // Relación N:M -> una etiqueta puede estar en muchos libros
    public function libros() {
        return $this->belongsToMany(Libro::class);
    }
}
