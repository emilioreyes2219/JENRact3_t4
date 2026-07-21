<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStock | Catálogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark: #100e1c;
            --dark-2: #191632;
            --violet: #8b6bff;
            --violet-soft: #a98bff;
            --gold: #f4c95d;
            --muted: #938fb0;
        }
        * { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .brand-title { font-family: 'Merriweather', serif; }
        body {
            background: radial-gradient(circle at top left, #1c1836 0%, #0c0a18 60%);
            min-height: 100vh;
            color: #ece9f7;
        }
        .navbar-auto {
            background: var(--dark);
            border-bottom: 3px solid var(--violet);
        }
        .brand-icon {
            width: 42px; height: 42px;
            background: var(--violet);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #100e1c;
            font-size: 1.15rem;
        }
        .btn-violet {
            background: var(--violet);
            color: #100e1c;
            font-weight: 700;
            border: none;
        }
        .btn-violet:hover { background: var(--violet-soft); color: #100e1c; }
        .book-card {
            background: var(--dark-2);
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.07);
            border-left: 4px solid transparent;
            transition: transform .15s ease, border-color .15s ease;
            overflow: hidden;
        }
        .book-card:hover {
            transform: translateY(-4px);
            border-left-color: var(--violet);
        }
        .book-card-top {
            background: linear-gradient(135deg, rgba(139,107,255,0.16), transparent);
            padding: 1.1rem 1.25rem 0.6rem;
        }
        .badge-genero {
            background: rgba(139,107,255,0.18);
            color: var(--violet-soft);
            font-weight: 600;
            font-size: 0.72rem;
            letter-spacing: .03em;
            text-transform: uppercase;
            padding: 0.35em 0.7em;
            border-radius: 20px;
        }
        .badge-stock {
            background: rgba(255,255,255,0.06);
            color: var(--muted);
            font-size: 0.72rem;
            padding: 0.35em 0.7em;
            border-radius: 20px;
        }
        .badge-stock.low { background: rgba(220,53,69,0.2); color: #ff8b98; }
        .book-price {
            color: var(--gold);
            font-weight: 700;
            font-size: 1.2rem;
        }
        .book-titulo {
            font-weight: 700;
            font-size: 1.08rem;
            color: #fff;
            text-decoration: none;
            display: block;
            line-height: 1.3;
        }
        .book-titulo:hover { color: var(--violet-soft); }
        .book-autor {
            color: var(--muted);
            font-size: 0.85rem;
            font-style: italic;
        }
        .btn-icon-sm {
            width: 34px; height: 34px;
            border-radius: 8px;
            display: inline-flex; align-items: center; justify-content: center;
            border: none;
        }
        .stat-pill {
            background: var(--dark-2);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
        }
        .pagination .page-link {
            background: var(--dark-2);
            border-color: rgba(255,255,255,0.08);
            color: #ece9f7;
        }
        .pagination .page-item.active .page-link {
            background: var(--violet);
            border-color: var(--violet);
            color: var(--dark);
        }
        .empty-state { color: var(--muted); }
    </style>
</head>
<body>

    <nav class="navbar navbar-auto py-3 mb-4">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center gap-3">
                <div class="brand-icon"><i class="fa-solid fa-book-open"></i></div>
                <div>
                    <h5 class="mb-0 text-white brand-title fw-bold">BiblioStock</h5>
                    <small class="text-secondary">Catálogo de biblioteca / librería</small>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 pb-5" style="max-width: 1200px;">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div class="stat-pill">
                <span class="text-secondary small d-block">Libros registrados</span>
                <span class="fs-4 fw-bold text-white">{{ $libros->total() }}</span>
            </div>
            <a href="{{ route('libros.create') }}" class="btn btn-violet shadow-sm px-4 py-2">
                <i class="fa-solid fa-plus me-2"></i>Añadir Libro
            </a>
        </div>

        @if($libros->count())
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($libros as $libro)
                    <div class="col">
                        <div class="book-card h-100">
                            <div class="book-card-top">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge-genero">{{ $libro->genero->nombre }}</span>
                                    <span class="badge-stock {{ $libro->stock <= 5 ? 'low' : '' }}">
                                        {{ $libro->stock }} ejemplares
                                    </span>
                                </div>
                                <a href="{{ route('libros.show', $libro->id) }}" class="book-titulo">
                                    {{ $libro->titulo }}
                                </a>
                                <span class="book-autor">{{ $libro->autor }} · {{ $libro->anio_publicacion }}</span>
                            </div>
                            <div class="px-3 pb-3 pt-2 d-flex justify-content-between align-items-center">
                                <span class="book-price">${{ number_format($libro->precio, 2) }}</span>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('libros.edit', $libro->id) }}" class="btn-icon-sm btn-violet" title="Editar">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este libro del catálogo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon-sm btn-danger" title="Eliminar">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $libros->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5 empty-state">
                <i class="fa-solid fa-book-skull fa-3x mb-3"></i>
                <p class="mb-0">Todavía no hay libros registrados.</p>
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
