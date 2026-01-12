@extends('layout.admin')

@section('content')

<br>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <br>
        <h2 class="alert-heading">
            <i class="fa-solid fa-file-invoice" style="padding-right: 10px;"></i>Cotización #{{ $cotizacion->id }}
        </h2>
        <br>
    </div>

    <div>
        <a href="{{ route('cotizacions.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('cotizacions.edit', $cotizacion->id) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('cotizacions.pdf', $cotizacion->id) }}" class="btn btn-info" target="_blank">
            <i class="fa-solid fa-file-pdf"></i> Descargar PDF
        </a>

        <form action="{{ route('cotizacions.destroy', $cotizacion->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta cotización?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</div>

{{-- Cabecera cotización --}}
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h5>Datos Cotización</h5>
                <p><strong>ID:</strong> {{ $cotizacion->id }}</p>
                <p><strong>Fecha:</strong> {{ $cotizacion->fecha->format('d-m-Y') }}</p>
                <p><strong>Estado:</strong>
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
                </p>
                @if($cotizacion->fecha_vencimiento)
                <p><strong>Vencimiento:</strong> {{ $cotizacion->fecha_vencimiento->format('d-m-Y') }}</p>
                @endif
                @if($cotizacion->user)
                <p><strong>Creado por:</strong> {{ $cotizacion->user->name }}</p>
                @endif
            </div>

            <div class="col-md-4">
                <h5>Cliente</h5>
                @if($cotizacion->cliente)
                <p><strong>Nombre:</strong> {{ $cotizacion->cliente->name }}</p>
                <p><strong>Email:</strong> {{ $cotizacion->cliente->email ?? '-' }}</p>
                <p><strong>Teléfono:</strong> {{ $cotizacion->cliente->phone ?? '-' }}</p>
                @if($cotizacion->cliente->company)
                <p><strong>Empresa:</strong> {{ $cotizacion->cliente->company }}</p>
                @endif
                @else
                <p class="text-muted">Cliente no registrado</p>
                @endif
            </div>

            <div class="col-md-4">
                <h5>Observaciones</h5>
                <p>{{ $cotizacion->observaciones ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Items --}}
<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th class="text-end">Cantidad</th>
                    <th class="text-end">Precio unit.</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($cotizacion->items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td class="text-end">{{ number_format($item->cantidad, 2, ',', '.') }}</td>
                    <td class="text-end">${{ number_format($item->precio_unitario, 2, ',', '.') }}</td>
                    <td class="text-end">${{ number_format($item->subtotal, 2, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-3">No hay ítems en esta cotización.</td>
                </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">TOTAL</th>
                    <th class="text-end">${{ number_format($cotizacion->total, 2, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection