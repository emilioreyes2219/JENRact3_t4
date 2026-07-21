<?php
namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Genero;
use App\Models\Etiqueta;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
{
    $libros = Libro::with(['genero', 'etiquetas'])->paginate(6);

    return view('libros.index', compact('libros'));
}

    public function create() {
        $generos = Genero::all();
        $etiquetas = Etiqueta::all();
        return view('libros.create', compact('generos', 'etiquetas'));
    }

    public function store(Request $request) {
        $request->validate([
            'genero_id' => 'required|exists:generos,id',
            'titulo' => 'required|max:150',
            'autor' => 'required|max:100',
            'anio_publicacion' => 'required|integer|min:1400|max:' . (date('Y') + 1),
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id'
        ]);

        $libro = Libro::create($request->all());

        if ($request->has('etiquetas')) {
            $libro->etiquetas()->attach($request->etiquetas);
        }

        return redirect()->route('libros.index')->with('success', 'Libro registrado con éxito.');
    }

    public function show(Libro $libro) {
        $libro->load(['genero', 'etiquetas']);
        return view('libros.show', compact('libro'));
    }

    public function edit(Libro $libro) {
        $generos = Genero::all();
        $etiquetas = Etiqueta::all();
        return view('libros.edit', compact('libro', 'generos', 'etiquetas'));
    }

    public function update(Request $request, Libro $libro) {
        $request->validate([
            'genero_id' => 'required|exists:generos,id',
            'titulo' => 'required|max:150',
            'autor' => 'required|max:100',
            'anio_publicacion' => 'required|integer|min:1400|max:' . (date('Y') + 1),
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id'
        ]);

        $libro->update($request->all());
        $libro->etiquetas()->sync($request->etiquetas ?? []);

        return redirect()->route('libros.index')->with('success', 'Datos del libro actualizados.');
    }

    public function destroy(Libro $libro) {
        $libro->delete();
        return redirect()->route('libros.index')->with('success', 'Libro eliminado correctamente.');
    }
}
