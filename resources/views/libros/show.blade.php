<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioStock | {{ $libro->titulo }}</title>
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
        .detail-card {
            background: var(--dark-2);
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.07);
            overflow: hidden;
        }
        .detail-header {
            background: linear-gradient(135deg, rgba(139,107,255,0.24), transparent);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 2rem 1.5rem;
            text-align: center;
        }
        .detail-header i { color: var(--violet); }
        .spec-box {
            background: #14122a;
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 1rem 0.5rem;
        }
        .spec-label { color: var(--muted); font-size: 0.78rem; }
        .spec-value { color: #fff; font-weight: 700; }
        .price-value { color: var(--gold); font-weight: 700; }
        h5.section-title { color: #d6d2ee; font-weight: 600; font-size: 0.95rem; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 0.5rem; }
        .list-group-item {
            background: #14122a;
            color: #ece9f7;
            border-color: rgba(255,255,255,0.06);
        }
        .list-group-item.empty { color: var(--muted); font-style: italic; }
        .btn-outline-back { border: 1px solid rgba(255,255,255,0.15); color: #d6d2ee; }
        .btn-outline-back:hover { background: rgba(255,255,255,0.06); color: #fff; }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100 p-4">
        <div class="detail-card shadow-lg" style="max-width: 620px; width: 100%;">

            <div class="detail-header">
                <i class="fa-solid fa-book-open fa-2x mb-2"></i>
                <h2 class="mb-0 fw-bold text-white">{{ $libro->titulo }}</h2>
                <small class="text-secondary">{{ $libro->autor }} · {{ $libro->genero->nombre }}</small>
            </div>

            <div class="p-4">
                <h5 class="section-title mb-3">Detalles del Libro</h5>

                <div class="row g-3 mb-4 text-center">
                    <div class="col-3">
                        <div class="spec-box">
                            <i class="fa-solid fa-layer-group text-secondary mb-1"></i>
                            <p class="spec-label mb-0">Género</p>
                            <h6 class="spec-value mb-0">{{ $libro->genero->nombre }}</h6>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="spec-box">
                            <i class="fa-solid fa-calendar text-secondary mb-1"></i>
                            <p class="spec-label mb-0">Año</p>
                            <h6 class="spec-value mb-0">{{ $libro->anio_publicacion }}</h6>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="spec-box">
                            <i class="fa-solid fa-boxes-stacked text-secondary mb-1"></i>
                            <p class="spec-label mb-0">Ejemplares</p>
                            <h6 class="spec-value mb-0">{{ $libro->stock }}</h6>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="spec-box">
                            <i class="fa-solid fa-tag text-secondary mb-1"></i>
                            <p class="spec-label mb-0">Precio</p>
                            <h6 class="price-value mb-0">${{ number_format($libro->precio, 2) }}</h6>
                        </div>
                    </div>
                </div>

                <h5 class="section-title mb-3">Etiquetas</h5>
                <ul class="list-group list-group-flush rounded border-0 shadow-sm">
                    @forelse($libro->etiquetas as $etiqueta)
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fa-solid fa-circle-check text-warning me-2"></i>
                            {{ $etiqueta->nombre }}
                        </li>
                    @empty
                        <li class="list-group-item empty">
                            <i class="fa-solid fa-circle-info me-2"></i>
                            Este libro no tiene etiquetas asignadas.
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="text-center p-3 border-top" style="border-color: rgba(255,255,255,0.06) !important;">
                <a href="{{ route('libros.index') }}" class="btn btn-outline-back btn-sm shadow-sm px-4">
                    <i class="fa-solid fa-arrow-left me-1"></i> Volver al catálogo
                </a>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
