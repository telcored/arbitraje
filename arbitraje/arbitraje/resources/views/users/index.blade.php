@extends('layout.admin')

@section('content')

<div class="row align-items-center mb-4 mt-4">
    <div class="col-md-6">
        <h2 class="fw-bold text-white mb-0"><i class="fas fa-user-shield me-2 text-primary"></i>Gestión de Usuarios</h2>
        <p class="text-muted">Control de acceso y administración del personal</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('users.create') }}" class="btn btn-football"><i class="fas fa-plus me-2"></i>Nuevo Usuario</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success border-0 bg-success text-white rounded-4 mb-4">
    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<div class="glass-card mb-4">
    <div class="card-header py-3">
        <h5 class="mb-0 fw-bold">Lista de Administradores</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="align-middle">
                        <td class="ps-4"><span class="badge bg-dark">#{{ $user->id }}</span></td>
                        <td class="fw-bold text-white">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="{{ route('users.permissions.edit', $user) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" title="Permisos">
                                    <i class="fa-solid fa-user-gear"></i>
                                </a>
                                <a href="{{ route('users.password.edit', $user) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" title="Cambiar contraseña">
                                    <i class="fa-solid fa-key"></i>
                                </a>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $user->id }}" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Confirmar eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-user-slash fa-4x text-danger mb-3"></i>
                <h5>¿Estás seguro de eliminar este usuario?</h5>
                <p class="text-muted small">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-id');
            var form = document.getElementById('deleteForm');
            form.action = "{{ url('/users') }}/" + userId;
        });
    });
</script>
@endpush
@endsection