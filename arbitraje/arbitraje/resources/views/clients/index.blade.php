@extends('layout.admin')

@section('content')

<div class="row align-items-center mb-4 mt-4">
    <div class="col-md-6">
        <h2 class="fw-bold text-white mb-0"><i class="fas fa-users-viewfinder me-2 text-success"></i>Gestión de Clientes</h2>
        <p class="text-muted">Administra los contactos y ligas registradas</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('clients.create') }}" class="btn btn-football"><i class="fas fa-plus me-2"></i>Nuevo Cliente</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success border-0 bg-success text-white rounded-4 mb-4">
    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<div class="glass-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold">Listado General</h5>
        <div class="btn-group">
            <a class="btn btn-outline-warning btn-sm" href="{{ route('clients.deleted') }}"><i class="fas fa-history me-1"></i>Historial</a>
            <a class="btn btn-outline-success btn-sm" href="{{ route('clients.export') }}"><i class="fas fa-file-excel me-1"></i>Excel</a>
            <a class="btn btn-outline-info btn-sm" href="{{ route('clients.form-import') }}"><i class="fas fa-file-import me-1"></i>Importar</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                    <tr class="align-middle">
                        <td class="ps-4 fw-bold text-white">{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td><span class="badge bg-dark border border-secondary">{{ $client->phone }}</span></td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a class="btn btn-outline-success btn-sm" href="{{ route('clients.show', $client->id) }}" title="Detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-outline-warning btn-sm" href="{{ route('clients.edit', $client->id) }}" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="post" style="display:inline" onsubmit="return confirm('¿Confirmas eliminar este cliente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" type="submit" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="fas fa-users-slash fa-3x mb-3"></i>
                            <p>No hay clientes registrados en el sistema.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($clients->hasPages())
    <div class="card-footer border-top border-secondary py-3">
        {!! $clients->links() !!}
    </div>
    @endif
</div>

@endsection