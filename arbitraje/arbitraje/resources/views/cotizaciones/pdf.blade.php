<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización #{{ $cotizacion->id }}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #2d3436;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .header-section {
            background-color: #000000;
            color: #ffffff;
            padding: 40px 0;
            /* Padding vertical only */
            width: 100%;
        }

        /* Container with explicit horizontal padding to avoid overflows */
        .wrapper {
            padding: 0 50px;
        }

        /* Layout Grid via Tables */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Crucial for fixed widths */
        }

        .header-table td {
            vertical-align: top;
            border: none;
            padding: 0;
        }

        .branding {
            width: 55%;
            text-align: left;
        }

        .doc-meta {
            width: 45%;
            text-align: right;
        }

        .brand-name {
            font-size: 24pt;
            font-weight: bold;
            color: #1db954;
            letter-spacing: -1px;
            margin: 0;
            line-height: 1.1;
        }

        .brand-sub {
            margin-top: 10px;
            color: #a1a1a1;
            font-size: 8.5pt;
            line-height: 1.4;
        }

        .doc-title {
            color: #1db954;
            font-size: 20pt;
            /* Slightly smaller to prevent overflow */
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
            line-height: 1.1;
        }

        .doc-number {
            font-size: 14pt;
            color: #ffffff;
            font-weight: bold;
            margin-top: 5px;
        }

        .status-badge {
            margin-top: 10px;
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 7.5pt;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        .badge-borrador {
            background-color: #636e72;
        }

        .badge-enviada {
            background-color: #0984e3;
        }

        .badge-aceptada {
            background-color: #1db954;
        }

        .badge-rechazada {
            background-color: #d63031;
        }

        /* Content Area */
        .content-area {
            padding: 40px 50px;
        }

        /* 3-Column Meta Row */
        .info-row {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .info-col {
            width: 33.33%;
            padding-right: 15px;
        }

        .info-col:last-child {
            padding-right: 0;
        }

        .meta-box {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            border: 1px solid #e9ecef;
            text-align: center;
        }

        .label {
            color: #1db954;
            text-transform: uppercase;
            font-size: 7.5pt;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .value {
            font-size: 10pt;
            font-weight: bold;
            color: #2d3436;
        }

        /* Section Headings */
        .section-title {
            border-left: 4px solid #1db954;
            padding-left: 12px;
            margin-bottom: 15px;
            margin-top: 25px;
            text-transform: uppercase;
            font-size: 11pt;
            font-weight: bold;
            color: #1a1a1a;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .items-table th {
            background-color: #1a1a1a;
            color: #ffffff;
            padding: 12px 15px;
            text-align: left;
            font-size: 8.5pt;
            text-transform: uppercase;
        }

        .items-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
            font-size: 9.5pt;
        }

        .bg-zebra {
            background-color: #fcfcfc;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        /* Summary Box */
        .summary-container {
            width: 100%;
            margin-top: 25px;
        }

        .summary-box {
            width: 280px;
            float: right;
            border-collapse: collapse;
        }

        .summary-box td {
            padding: 6px 15px;
        }

        .total-highlight {
            background-color: #1db954;
            color: white;
            border-radius: 8px;
            padding: 12px 20px !important;
            font-size: 15pt;
            font-weight: bold;
        }

        /* Fixed Footer */
        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            padding: 25px 0;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            text-align: center;
            font-size: 8pt;
            color: #b2bec3;
        }

        .footer-brand {
            color: #1db954;
            font-weight: bold;
            font-size: 9pt;
            margin-bottom: 4px;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header-section">
        <div class="wrapper">
            <table class="header-table">
                <tr>
                    <td class="branding">
                        <h1 class="brand-name">ARBITRAJE VAR</h1>
                        <div class="brand-sub">
                            <strong>Arbitraje VAR SpA</strong><br>
                            Tecnología aplicada al fútbol profesional<br>
                            www.arbitrajevar.cl
                        </div>
                    </td>
                    <td class="doc-meta">
                        <div class="doc-title">Cotización</div>
                        <div class="doc-number">#{{ str_pad($cotizacion->id, 5, '0', STR_PAD_LEFT) }}</div>
                        <div class="status-container">
                            <span class="status-badge badge-{{ $cotizacion->estado }}">{{ $cotizacion->estado }}</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="content-area">
        <!-- Metadata Boxes -->
        <table class="info-row">
            <tr>
                <td class="info-col">
                    <div class="meta-box">
                        <span class="label">Emisión</span>
                        <span class="value">{{ $cotizacion->fecha->format('d/m/Y') }}</span>
                    </div>
                </td>
                <td class="info-col">
                    <div class="meta-box">
                        <span class="label">Vencimiento</span>
                        <span class="value">{{ $cotizacion->fecha_vencimiento ? $cotizacion->fecha_vencimiento->format('d/m/Y') : 'Consultar' }}</span>
                    </div>
                </td>
                <td class="info-col">
                    <div class="meta-box">
                        <span class="label">Referencia</span>
                        <span class="value">VAR-{{ str_pad($cotizacion->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Client Information -->
        <div class="section-title">Preparado para:</div>
        <div style="padding: 0 15px 30px 15px;">
            <div style="font-size: 14pt; font-weight: bold; color: #1a1a1a;">{{ $cotizacion->cliente->name ?? 'Cliente General' }}</div>
            <div style="color: #636e72; margin-top: 5px; font-size: 10pt;">
                @if($cotizacion->cliente && $cotizacion->cliente->email)
                {{ $cotizacion->cliente->email }}<br>
                @endif
                @if($cotizacion->cliente && $cotizacion->cliente->phone)
                {{ $cotizacion->cliente->phone }}
                @endif
            </div>
        </div>

        <!-- Table of Services -->
        <div class="section-title">Detalle de Propuesta</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th width="10%" class="text-center">Item</th>
                    <th width="50%">Descripción del Servicio</th>
                    <th class="text-center" width="10%">Cant.</th>
                    <th class="text-right" width="15%">P. Unit.</th>
                    <th class="text-right" width="15%">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cotizacion->items as $index => $item)
                <tr class="{{ $index % 2 == 0 ? '' : 'bg-zebra' }}">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong style="color: #2d3436;">{{ $item->descripcion }}</strong></td>
                    <td class="text-center">{{ number_format($item->cantidad, 0, ',', '.') }}</td>
                    <td class="text-right">${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                    <td class="text-right"><strong style="color: #1a1a1a;">${{ number_format($item->subtotal, 0, ',', '.') }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals Selection -->
        <div class="summary-container">
            <table class="summary-box">
                <tr>
                    <td class="text-right" style="color: #636e72; font-weight: bold; font-size: 9pt;">Subtotal Neto:</td>
                    <td class="text-right" style="font-weight: bold;">${{ number_format($cotizacion->total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 10px;"></td>
                </tr>
                <tr>
                    <td class="text-right total-highlight">TOTAL:</td>
                    <td class="text-right total-highlight">${{ number_format($cotizacion->total, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div style="clear: both;"></div>

        <!-- Observations -->
        @if($cotizacion->observaciones)
        <div style="margin-top: 50px; padding: 20px; background-color: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 12px;">
            <div class="label" style="color: #636e72; font-size: 8pt;">Notas Administrativas</div>
            <div style="font-size: 9pt; color: #636e72; line-height: 1.6; margin-top: 8px;">
                {{ $cotizacion->observaciones }}
            </div>
        </div>
        @endif
    </div>

    <!-- Fixed Footer -->
    <div class="footer">
        <div class="wrapper">
            <div class="footer-brand">ARBITRAJE VAR - TECNOLOGÍA PROFESIONAL</div>
            <div>Documento digital oficial. Los precios están sujetos a cambios sin previo aviso.</div>
            <div style="margin-top: 4px;">&copy; {{ date('Y') }} - www.arbitrajevar.cl</div>
        </div>
    </div>
</body>

</html>