@extends('layout.admin')

@section('content')

<div>
    <br>
    <h2 class="alert-heading">
        <i class="fa-solid fa-file-invoice"></i> Editar Cotización #{{ $cotizacion->id }}
    </h2>
    <br>
</div>

@if($errors->any())
<div class="alert alert-warning" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container">
    <a href="{{ route('cotizacions.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('cotizacions.update', $cotizacion->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Datos generales --}}
        <div class="card mb-3">
            <div class="card-header">Datos de la Cotización</div>
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Cliente *</label>
                        <select name="cliente_id" class="form-control" required>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}"
                                {{ $cotizacion->cliente_id == $cliente->id ? 'selected':'' }}>
                                {{ $cliente->name }} {{ $cliente->company ? '- ' . $cliente->company : '' }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Fecha *</label>
                        <input type="date" name="fecha" class="form-control"
                            value="{{ $cotizacion->fecha->format('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label>Fecha Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" class="form-control"
                            value="{{ $cotizacion->fecha_vencimiento ? $cotizacion->fecha_vencimiento->format('Y-m-d') : '' }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Estado *</label>
                        <select name="estado" class="form-control" required>
                            <option value="borrador" {{ $cotizacion->estado == 'borrador' ? 'selected' : '' }}>Borrador</option>
                            <option value="enviada" {{ $cotizacion->estado == 'enviada' ? 'selected' : '' }}>Enviada</option>
                            <option value="aceptada" {{ $cotizacion->estado == 'aceptada' ? 'selected' : '' }}>Aceptada</option>
                            <option value="rechazada" {{ $cotizacion->estado == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="3">{{ $cotizacion->observaciones }}</textarea>
                </div>

            </div>
        </div>

        {{-- Items --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Ítems de la Cotización</span>
                <button type="button" class="btn btn-success btn-sm" id="agregarFila">Agregar Ítem</button>
            </div>

            <div class="card-body p-0">
                <table class="table table-bordered mb-0" id="tablaItems">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th width="120">Cantidad</th>
                            <th width="150">Precio Unitario</th>
                            <th width="150">Subtotal</th>
                            <th width="100"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cotizacion->items as $item)
                        <tr>
                            <td>
                                <input type="text" name="descripcion[]" class="form-control"
                                    value="{{ $item->descripcion }}" required>
                            </td>

                            <td>
                                <input type="number" step="0.01" name="cantidad[]"
                                    class="form-control cantidad"
                                    value="{{ $item->cantidad }}" min="0.01" required>
                            </td>

                            <td>
                                <input type="number" step="0.01" name="precio_unitario[]"
                                    class="form-control precio"
                                    value="{{ $item->precio_unitario }}" min="0" required>
                            </td>

                            <td>
                                <input type="text" readonly class="form-control subtotal"
                                    value="{{ number_format($item->subtotal, 2, '.', '') }}">
                            </td>

                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm eliminarFila">X</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>TOTAL:</strong></td>
                            <td><input type="text" readonly class="form-control" id="total-general" value="{{ number_format($cotizacion->total, 2, '.', '') }}"></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <button class="btn btn-primary mt-3">Guardar Cambios</button>

    </form>
</div>

{{-- Script para agregar/eliminar filas --}}
<script>
    document.getElementById('agregarFila').addEventListener('click', function() {
        let tabla = document.querySelector('#tablaItems tbody');

        let fila = `
        <tr>
            <td>
                <input type="text" name="descripcion[]" class="form-control" placeholder="Descripción del item" required>
            </td>

            <td><input type="number" step="0.01" name="cantidad[]" class="form-control cantidad" min="0.01" required></td>
            <td><input type="number" step="0.01" name="precio_unitario[]" class="form-control precio" min="0" required></td>
            <td><input type="text" readonly class="form-control subtotal" value="0.00"></td>

            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm eliminarFila">X</button>
            </td>
        </tr>
    `;
        tabla.insertAdjacentHTML('beforeend', fila);
    });

    // Calcular subtotales
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('cantidad') || e.target.classList.contains('precio')) {
            let row = e.target.closest('tr');
            let cantidad = parseFloat(row.querySelector('.cantidad').value) || 0;
            let precio = parseFloat(row.querySelector('.precio').value) || 0;
            let subtotal = (cantidad * precio).toFixed(2);
            row.querySelector('.subtotal').value = subtotal;

            // Calcular total general
            calcularTotalGeneral();
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('eliminarFila')) {
            e.target.closest('tr').remove();
            calcularTotalGeneral();
        }
    });

    // Función para calcular el total general
    function calcularTotalGeneral() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(function(input) {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('total-general').value = total.toFixed(2);
    }
</script>

@endsection