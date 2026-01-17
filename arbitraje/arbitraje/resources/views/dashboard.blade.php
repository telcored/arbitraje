@extends('layout.admin')

@section('content')

<div class="row align-items-center mb-4 mt-4">
    <div class="col-md-6">
        <h2 class="fw-bold text-white mb-0">Dashboard</h2>
        <p class="text-muted">Resumen tecnológico de Arbitraje VAR</p>
    </div>
    <div class="col-md-6 text-md-end">
        <div class="badge bg-pitch-gradient p-2 px-3 border border-success">
            <i class="fas fa-clock me-2"></i>{{ now()->format('d M, Y') }}
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-xl-4 col-md-6">
        <div class="glass-card p-4 border-start border-4 border-success">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold">Total de clientes</h6>
                    <h2 class="fw-bold mb-0">{{ $clients->count() }}</h2>
                </div>
                <div class="service-icon mb-0" style="width: 50px; height: 50px; font-size: 1.2rem;">
                    <i class="fas fa-users-viewfinder"></i>
                </div>
            </div>
            <a class="small text-success text-decoration-none fw-bold" href="{{ route('clients.index') }}">
                Ver detalles <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="glass-card p-4 border-start border-4 border-warning">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold">Tareas pendientes</h6>
                    <h2 class="fw-bold mb-0 text-warning">{{ $tasksPendings->count() }}</h2>
                </div>
                <div class="service-icon mb-0" style="width: 50px; height: 50px; font-size: 1.2rem; background: var(--referee-yellow);">
                    <i class="fas fa-clipboard-list text-dark"></i>
                </div>
            </div>
            <a class="small text-warning text-decoration-none fw-bold" href="{{ route('tasks.index') }}">
                Ver detalles <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="glass-card p-4 border-start border-4 border-danger">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold">Seguimientos (hoy)</h6>
                    <h2 class="fw-bold mb-0 text-danger">{{ $follows->count() }}</h2>
                </div>
                <div class="service-icon mb-0" style="width: 50px; height: 50px; font-size: 1.2rem; background: var(--referee-red);">
                    <i class="fas fa-route text-white"></i>
                </div>
            </div>
            <a class="small text-danger text-decoration-none fw-bold" href="{{ route('clients.index') }}">
                Ver detalles <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="glass-card p-4">
            <h5 class="fw-bold mb-4"><i class="fas fa-chart-pie me-2 text-success"></i>Estado de Tareas</h5>
            <div style="height: 300px; position: relative;">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="glass-card p-4">
            <h5 class="fw-bold mb-4"><i class="fas fa-futbol me-2 text-warning"></i>Acceso Rápido</h5>
            <div class="list-group list-group-flush bg-transparent">
                <a href="{{ route('tasks.create') }}" class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle me-3 text-success"></i>Nueva Tarea</span>
                    <i class="fas fa-chevron-right small text-muted"></i>
                </a>
                <a href="{{ route('clients.create') }}" class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-user-plus me-3 text-success"></i>Añadir Cliente</span>
                    <i class="fas fa-chevron-right small text-muted"></i>
                </a>
                <a href="{{ route('public.calendar') }}" target="_blank" class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-external-link-alt me-3 text-success"></i>Ver Web Pública</span>
                    <i class="fas fa-chevron-right small text-muted"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js" type="text/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('myBarChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pendientes', 'Completadas', 'En proceso'],
                datasets: [{
                    data: [{
                            {
                                $tasksPendings - > count()
                            }
                        },
                        {
                            {
                                $tasksCompleted - > count()
                            }
                        },
                        {
                            {
                                $tasksInProgress - > count()
                            }
                        }
                    ],
                    backgroundColor: [
                        '#f1c40f', // Referee Yellow
                        '#1db954', // Pitch Green
                        '#e74c3c' // Referee Red
                    ],
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'rgba(255,255,255,0.7)',
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>

@endpush