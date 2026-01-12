@extends('layout.admin')

@section('content')

<div>
    <br>
    <h2 class="alert-heading">
        <i class="fa-solid fa-file-invoice"></i> Nueva Cotización
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

<div class="row">
    <div class="col-1"></div>
    <div class="col-9">
        <form action="{{ route('cotizacions.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Cliente *</label>
                    <select name="cliente_id" class="form-control" required>
                        <option value="">-- Seleccionar Cliente --</option>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->name }} {{ $cliente->company ? '- ' . $cliente->company : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Fecha *</label>
                    <input type="date" name="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Fecha Vencimiento</label>
                    <input type="date" name="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Estado *</label>
                    <select name="estado" class="form-control" required>
                        <option value="borrador" {{ old('estado') == 'borrador' ? 'selected' : '' }}>Borrador</option>
                        <option value="enviada" {{ old('estado') == 'enviada' ? 'selected' : '' }}>Enviada</option>
                        <option value="aceptada" {{ old('estado') == 'aceptada' ? 'selected' : '' }}>Aceptada</option>
                        <option value="rechazada" {{ old('estado') == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                    </select>
                </div>
            </div>

            <h4>Items de la Cotización</h4>

            <table class="table" id="tabla-items">
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
                    <tr>
                        <td>
                            <input type="text" name="descripcion[]" class="form-control" placeholder="Descripción del item" required>
                        </td>
                        <td><input type="number" step="0.01" name="cantidad[]" class="form-control cantidad" min="0.01" required></td>
                        <td><input type="number" step="0.01" name="precio_unitario[]" class="form-control precio" min="0" required></td>
                        <td><input type="text" readonly class="form-control subtotal" value="0.00"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm eliminar-item">Eliminar</button>
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>TOTAL:</strong></td>
                        <td><input type="text" readonly class="form-control" id="total-general" value="0.00"></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <button type="button" class="btn btn-success btn-sm" id="agregar-item">Agregar Item</button>

            <br><br>

            <div class="mb-3">
                <label>Observaciones</label>
                <textarea name="observaciones" class="form-control" rows="3">{{ old('observaciones') }}</textarea>
            </div>

            <a class="btn btn-secondary" href="{{ route('cotizacions.index') }}">Regresar</a>
            <button type="submit" class="btn btn-primary">Guardar Cotización</button>

        </form>

    </div>
</div>

<script>
    // Agregar nuevo item
    document.getElementById('agregar-item').addEventListener('click', function() {
        let row = `
        <tr>
            <td>
                <input type="text" name="descripcion[]" class="form-control" placeholder="Descripción del item" required>
            </td>
            <td><input type="number" step="0.01" name="cantidad[]" class="form-control cantidad" min="0.01" required></td>
            <td><input type="number" step="0.01" name="precio_unitario[]" class="form-control precio" min="0" required></td>
            <td><input type="text" readonly class="form-control subtotal" value="0.00"></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm eliminar-item">Eliminar</button>
            </td>
        </tr>
        `;
        document.querySelector('#tabla-items tbody').insertAdjacentHTML('beforeend', row);
    });

    // Calcular subtotales y total
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

    // Eliminar item
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('eliminar-item')) {
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