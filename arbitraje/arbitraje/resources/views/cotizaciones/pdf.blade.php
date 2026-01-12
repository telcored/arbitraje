<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización #{{ $cotizacion->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 11pt;
            color: #333;
            line-height: 1.4;
        }

        .container {
            padding: 20px;
        }

        /* Header con logo */
        .header {
            margin-bottom: 30px;
            border-bottom: 3px solid #FF6B00;
            padding-bottom: 15px;
        }

        .header-content {
            display: table;
            width: 100%;
        }

        .logo {
            display: table-cell;
            width: 150px;
            vertical-align: middle;
        }

        .logo img {
            max-width: 140px;
            height: auto;
        }

        .company-info {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            padding-left: 20px;
        }

        .company-info h1 {
            color: #FF6B00;
            font-size: 24pt;
            margin-bottom: 5px;
        }

        .company-info p {
            font-size: 9pt;
            color: #666;
            margin: 2px 0;
        }

        /* Información de cotización */
        .cotizacion-info {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 5px;
        }

        .info-row {
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 120px;
        }

        .info-value {
            color: #333;
        }

        .estado-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 3px;
            font-size: 9pt;
            font-weight: bold;
            color: white;
        }

        .estado-borrador {
            background-color: #6c757d;
        }

        .estado-enviada {
            background-color: #0dcaf0;
        }

        .estado-aceptada {
            background-color: #198754;
        }

        .estado-rechazada {
            background-color: #dc3545;
        }

        /* Sección de cliente */
        .cliente-section {
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .section-title {
            font-size: 14pt;
            color: #FF6B00;
            margin-bottom: 10px;
            font-weight: bold;
            border-bottom: 2px solid #FF6B00;
            padding-bottom: 5px;
        }

        /* Tabla de items */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table thead {
            background-color: #FF6B00;
            color: white;
        }

        .items-table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            font-size: 10pt;
        }

        .items-table th.text-right,
        .items-table td.text-right {
            text-align: right;
        }

        .items-table th.text-center,
        .items-table td.text-center {
            text-align: center;
        }

        .items-table tbody tr {
            border-bottom: 1px solid #dee2e6;
        }

        .items-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .items-table td {
            padding: 8px 10px;
            font-size: 10pt;
        }

        .items-table tfoot {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .items-table tfoot td {
            padding: 12px 10px;
            font-size: 12pt;
            border-top: 2px solid #FF6B00;
        }

        /* Observaciones */
        .observaciones {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 4px solid #FF6B00;
        }

        .observaciones-title {
            font-weight: bold;
            color: #FF6B00;
            margin-bottom: 8px;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #dee2e6;
            text-align: center;
            font-size: 9pt;
            color: #666;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="logo">
                    <img src="{{ public_path('assets/img/logo2.png') }}" alt="VAR Logo">
                </div>
                <div class="company-info">
                    <h1>COTIZACIÓN</h1>
                    <p><strong>VAR - Video Assistant Referee</strong></p>
                    <p>arbitrajevar.cl</p>
                    <p>Fecha de emisión: {{ now()->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Información de la cotización -->
        <div class="cotizacion-info">
            <div class="info-grid">
                <div class="info-column">
                    <div class="info-row">
                        <span class="info-label">Cotización N°:</span>
                        <span class="info-value">#{{ str_pad($cotizacion->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Fecha:</span>
                        <span class="info-value">{{ $cotizacion->fecha->format('d/m/Y') }}</span>
                    </div>
                    @if($cotizacion->fecha_vencimiento)
                    <div class="info-row">
                        <span class="info-label">Válida hasta:</span>
                        <span class="info-value">{{ $cotizacion->fecha_vencimiento->format('d/m/Y') }}</span>
                    </div>
                    @endif
                </div>
                <div class="info-column">
                    <div class="info-row">
                        <span class="info-label">Estado:</span>
                        <span class="estado-badge estado-{{ $cotizacion->estado }}">
                            {{ strtoupper($cotizacion->estado) }}
                        </span>
                    </div>
                    @if($cotizacion->user)
                    <div class="info-row">
                        <span class="info-label">Emitida por:</span>
                        <span class="info-value">{{ $cotizacion->user->name }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Información del cliente -->
        <div class="cliente-section">
            <div class="section-title">DATOS DEL CLIENTE</div>
            @if($cotizacion->cliente)
            <div class="info-row">
                <span class="info-label">Nombre:</span>
                <span class="info-value">{{ $cotizacion->cliente->name }}</span>
            </div>
            @if($cotizacion->cliente->company)
            <div class="info-row">
                <span class="info-label">Empresa:</span>
                <span class="info-value">{{ $cotizacion->cliente->company }}</span>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $cotizacion->cliente->email ?? 'No especificado' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Teléfono:</span>
                <span class="info-value">{{ $cotizacion->cliente->phone ?? 'No especificado' }}</span>
            </div>
            @else
            <p>Cliente no registrado</p>
            @endif
        </div>

        <!-- Tabla de items -->
        <div class="section-title">DETALLE DE LA COTIZACIÓN</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th class="text-center" width="5%">#</th>
                    <th width="45%">Descripción</th>
                    <th class="text-center" width="15%">Cantidad</th>
                    <th class="text-right" width="17.5%">Precio Unit.</th>
                    <th class="text-right" width="17.5%">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cotizacion->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td class="text-center">{{ number_format($item->cantidad, 2, ',', '.') }}</td>
                    <td class="text-right">${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                    <td class="text-right">${{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right">TOTAL (CLP):</td>
                    <td class="text-right">${{ number_format($cotizacion->total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Observaciones -->
        @if($cotizacion->observaciones)
        <div class="observaciones">
            <div class="observaciones-title">OBSERVACIONES:</div>
            <p>{{ $cotizacion->observaciones }}</p>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p><strong>VAR - Video Assistant Referee</strong></p>
            <p>Este documento es una cotización y no constituye una factura</p>
            <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</body>

</html>