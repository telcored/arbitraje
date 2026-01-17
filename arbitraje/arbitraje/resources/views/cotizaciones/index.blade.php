@extends('layout.admin')

@section('content')

<div class="row align-items-center mb-4 mt-4">
    <div class="col-md-6">
        <h2 class="fw-bold text-white mb-0"><i class="fa-solid fa-file-invoice me-2 text-info"></i>Cotizaciones</h2>
        <p class="text-muted">Presupuestos y propuestas comerciales</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('cotizacions.create') }}" class="btn btn-football"><i class="fas fa-plus me-2"></i>Nueva Cotización</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success border-0 bg-success text-white rounded-4 mb-4">
    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<div class="glass-card mb-4">
    <div class="card-header py-3">
        <h5 class="mb-0 fw-bold">Listado de Cotizaciones</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Vencimiento</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($cotizaciones as $cotizacion)
                    <tr class="align-middle">
                        <td class="ps-4"><span class="badge bg-dark">#{{ $cotizacion->id }}</span></td>
                        <td class="fw-bold text-white">{{ $cotizacion->cliente->name ?? 'N/A' }}</td>
                        <td><i class="far fa-calendar-alt me-1 text-success"></i> {{ $cotizacion->fecha->format('d/m/Y') }}</td>
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
                            <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ ucfirst($cotizacion->estado) }}</span>
                        </td>
                        <td class="text-white">${{ number_format($cotizacion->total, 0, ',', '.') }}</td>
                        <td><small class="text-muted">{{ $cotizacion->fecha_vencimiento ? $cotizacion->fecha_vencimiento->format('d/m/Y') : '-' }}</small></td>

                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="{{ route('cotizacions.show', $cotizacion->id) }}" class="btn btn-outline-primary btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('cotizacions.edit', $cotizacion->id) }}" class="btn btn-outline-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('cotizacions.pdf', $cotizacion->id) }}" class="btn btn-outline-info btn-sm" target="_blank" title="PDF">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <form action="{{ route('cotizacions.destroy', $cotizacion->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar esta cotización?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-file-invoice fa-3x mb-3"></i>
                            <p>No hay cotizaciones registradas en el sistema.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($cotizaciones, 'links'))
    <div class="card-footer border-top border-secondary py-3">
        {!! $cotizaciones->links() !!}
    </div>
    @endif
</div>

@endsection