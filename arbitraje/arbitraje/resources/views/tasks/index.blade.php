@extends('layout.admin')
@section('content')

<div class="row align-items-center mb-4 mt-4">
    <div class="col-md-6">
        <h2 class="fw-bold text-white mb-0"><i class="fas fa-clipboard-list me-2 text-warning"></i>Gestión de Tareas</h2>
        <p class="text-muted">Lista de encuentros y actividades programadas</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('tasks.create') }}" class="btn btn-football"><i class="fas fa-plus me-2"></i>Nueva Tarea</a>
    </div>
</div>

<div class="glass-card mb-4">
    <div class="card-header py-3">
        <h5 class="mb-0 fw-bold">Planificación de Partidos</h5>
    </div>
    <div class="card-body p-0">
        @if($tasks->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fas fa-calendar-times fa-3x mb-3"></i>
            <p>No hay tareas programadas.</p>
        </div>
        @else
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Título</th>
                        <th>Estado</th>
                        <th>Fecha y Hora</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr class="align-middle">
                        <td class="ps-4">
                            <div class="fw-bold text-white">{{ $task->title }}</div>
                            <small class="text-muted text-truncate d-inline-block" style="max-width: 200px;">{{ $task->description }}</small>
                        </td>
                        <td>
                            @php
                            $statusClass = match($task->status) {
                            'Completada' => 'bg-success',
                            'En proceso' => 'bg-info',
                            'Pendiente' => 'bg-warning text-dark',
                            default => 'bg-secondary'
                            };
                            @endphp
                            <span class="badge {{ $statusClass }} rounded-pill px-3">{{ $task->status }}</span>
                        </td>
                        <td><i class="far fa-calendar-alt me-2 text-success"></i>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y H:i') }}</td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a class="btn btn-outline-warning btn-sm" href="{{ route('tasks.edit', $task) }}" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-task-{{ $task->id }}" action="{{ route('tasks.destroy', $task) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $task->id }})" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@push('script')
<script>
    function confirmDelete(taskId) {
        Swal.fire({
            title: '¿Eliminar tarea?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            background: '#1a1a1a',
            color: '#fff',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#1db954',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-task-' + taskId).submit();
            }
        });
    }
</script>
@endpush

@endsection