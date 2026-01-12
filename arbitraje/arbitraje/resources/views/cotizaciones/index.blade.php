@extends('layout.admin')

@section('content')

<div>
    <br>
    <h2 class="alert-heading">
        <i class="fa-solid fa-file-invoice"></i> Cotizaciones
    </h2>
    <br>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row mb-3">
    <div class="col-xl-6 col-md-6">
        <a href="{{ route('cotizacions.create') }}" class="btn btn-primary">Nueva Cotización</a>
    </div>
</div>
<br>

<div class="card">
    <div class="card-body p-0">
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Total (CLP)</th>
                    <th>Vencimiento</th>
                    <th width="220">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($cotizaciones as $cotizacion)
                <tr>
                    <td>{{ $cotizacion->id }}</td>
                    <td>{{ $cotizacion->cliente->name ?? 'N/A' }}</td>
                    <td>{{ $cotizacion->fecha->format('d/m/Y') }}</td>
                    <td>
                        @php
                        $badgeClass = match($cotizacion->estado) {
                        'borrador' => 'bg-secondary',
                        'enviada' => 'bg-info',
                        'aceptada' => 'bg-success',
                        'rechazada' => 'bg-danger',
                        default => 'bg-secondary'
                        };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($cotizacion->estado) }}</span>
                    </td>
                    <td>${{ number_format($cotizacion->total, 2, ',', '.') }}</td>
                    <td>{{ $cotizacion->fecha_vencimiento ? $cotizacion->fecha_vencimiento->format('d/m/Y') : '-' }}</td>

                    <td>
                        <a href="{{ route('cotizacions.show', $cotizacion->id) }}" class="btn btn-sm btn-primary">Ver</a>
                        <a href="{{ route('cotizacions.edit', $cotizacion->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('cotizacions.pdf', $cotizacion->id) }}" class="btn btn-sm btn-info" target="_blank">
                            <i class="fa-solid fa-file-pdf"></i> PDF
                        </a>

                        <form action="{{ route('cotizacions.destroy', $cotizacion->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Seguro que deseas eliminar esta cotización?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-3">No hay cotizaciones registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
    </div>
</div>

@endsection