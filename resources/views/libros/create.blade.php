<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStock | Añadir Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --dark: #100e1c; --dark-2: #191632; --violet: #8b6bff; --violet-soft: #a98bff; --gold: #f4c95d; --muted: #938fb0; }
        * { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Merriweather', serif; }
        body {
            background: radial-gradient(circle at top left, #1c1836 0%, #0c0a18 60%);
            min-height: 100vh; color: #ece9f7;
        }
        .form-card {
            background: var(--dark-2);
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.07);
            overflow: hidden;
        }
        .form-card-header {
            background: linear-gradient(135deg, rgba(139,107,255,0.2), transparent);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 1.5rem;
        }
        .form-card-header .brand-icon {
            width: 44px; height: 44px;
            background: var(--violet);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--dark); font-size: 1.2rem;
        }
        label.form-label { color: #d6d2ee; font-weight: 500; font-size: 0.88rem; }
        .form-control, .form-select {
            background: #14122a;
            border: 1px solid rgba(255,255,255,0.1);
            color: #ece9f7;
            border-radius: 10px;
        }
        .form-control:focus, .form-select:focus {
            background: #14122a; color: #fff;
            border-color: var(--violet);
            box-shadow: 0 0 0 0.2rem rgba(139,107,255,0.22);
        }
        .form-control::placeholder { color: #635e82; }
        .form-select option { background: #14122a; }
        .etiq-box {
            background: #14122a;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
        }
        .form-check-input { background-color: #14122a; border-color: rgba(255,255,255,0.25); }
        .form-check-input:checked { background-color: var(--violet); border-color: var(--violet); }
        .form-check-label { color: #d6d2ee; }
        .btn-violet { background: var(--violet); color: #100e1c; font-weight: 700; border: none; }
        .btn-violet:hover { background: var(--violet-soft); color: #100e1c; }
        .btn-outline-cancel { border: 1px solid rgba(255,255,255,0.15); color: #d6d2ee; }
        .btn-outline-cancel:hover { background: rgba(255,255,255,0.06); color: #fff; }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100 p-4">
        <div class="form-card shadow-lg" style="max-width: 580px; width: 100%;">

            <div class="form-card-header d-flex align-items-center gap-3">
                <div class="brand-icon"><i class="fa-solid fa-book-medical"></i></div>
                <div>
                    <h4 class="mb-0 text-white fw-bold">Añadir Libro</h4>
                    <small class="text-secondary">Registra un nuevo libro en el catálogo</small>
                </div>
            </div>

            <div class="p-4">
                @if ($errors->any())
                    <div class="alert alert-danger p-2 small">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('libros.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="genero_id" class="form-label">Género</label>
                        <select class="form-select" id="genero_id" name="genero_id" required>
                            <option value="" selected disabled>Selecciona un género</option>
                            @foreach($generos as $genero)
                                <option value="{{ $genero->id }}" {{ old('genero_id') == $genero->id ? 'selected' : '' }}>{{ $genero->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder="Ej. Cien años de soledad" required>
                    </div>

                    <div class="row">
                        <div class="col-8 mb-3">
                            <label for="autor" class="form-label">Autor</label>
                            <input type="text" class="form-control" id="autor" name="autor" value="{{ old('autor') }}" placeholder="Ej. Gabriel García Márquez" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="anio_publicacion" class="form-label">Año</label>
                            <input type="number" class="form-control" id="anio_publicacion" name="anio_publicacion" value="{{ old('anio_publicacion') }}" placeholder="Ej. 1967" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-4">
                            <label for="precio" class="form-label">Precio ($)</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" placeholder="Ej. 250.00" required>
                        </div>
                        <div class="col-6 mb-4">
                            <label for="stock" class="form-label">Ejemplares</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" placeholder="Ej. 15" min="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Etiquetas</label>
                        <div class="etiq-box p-3" style="max-height: 150px; overflow-y: auto;">
                            @foreach($etiquetas as $etiqueta)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="etiquetas[]" value="{{ $etiqueta->id }}" id="etq_{{ $etiqueta->id }}">
                                    <label class="form-check-label small" role="button" for="etq_{{ $etiqueta->id }}">
                                        {{ $etiqueta->nombre }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-violet w-100 shadow-sm fw-semibold mb-2 py-2">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Libro
                    </button>

                    <a href="{{ route('libros.index') }}" class="btn btn-outline-cancel w-100 btn-sm">
                        Cancelar
                    </a>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
