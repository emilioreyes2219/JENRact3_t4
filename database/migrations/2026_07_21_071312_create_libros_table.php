<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genero_id')->constrained('generos')->onDelete('cascade');
            $table->string('titulo');
            $table->string('autor');
            $table->unsignedSmallInteger('anio_publicacion');
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('libros');
    }
};
