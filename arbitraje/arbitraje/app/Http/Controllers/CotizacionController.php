<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cotizaciones = Cotizacion::with('cliente', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cotizaciones.index', compact('cotizaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Client::where('active', true)->orderBy('name')->get();
        return view('cotizaciones.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clients,id',
            'fecha' => 'required|date',
            'estado' => 'required|in:borrador,enviada,aceptada,rechazada',
            'observaciones' => 'nullable|string',
            'fecha_vencimiento' => 'nullable|date',
            'descripcion' => 'required|array|min:1',
            'descripcion.*' => 'required|string',
            'cantidad' => 'required|array|min:1',
            'cantidad.*' => 'required|numeric|min:0.01',
            'precio_unitario' => 'required|array|min:1',
            'precio_unitario.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Crear la cotización
            $cotizacion = Cotizacion::create([
                'cliente_id' => $request->cliente_id,
                'user_id' => Auth::id(),
                'fecha' => $request->fecha,
                'estado' => $request->estado,
                'observaciones' => $request->observaciones,
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'total' => 0, // Se calculará después
            ]);

            // Crear los items
            $total = 0;
            foreach ($request->descripcion as $index => $descripcion) {
                $cantidad = $request->cantidad[$index];
                $precio_unitario = $request->precio_unitario[$index];
                $subtotal = $cantidad * $precio_unitario;

                CotizacionItem::create([
                    'cotizacion_id' => $cotizacion->id,
                    'descripcion' => $descripcion,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            // Actualizar el total de la cotización
            $cotizacion->update(['total' => $total]);

            DB::commit();

            return redirect()
                ->route('cotizacions.index')
                ->with('success', 'Cotización creada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear la cotización: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cotizacion $cotizacion)
    {
        $cotizacion->load('cliente', 'user', 'items');
        return view('cotizaciones.show', compact('cotizacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cotizacion $cotizacion)
    {
        $clientes = Client::where('active', true)->orderBy('name')->get();
        $cotizacion->load('items');
        return view('cotizaciones.edit', compact('cotizacion', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clients,id',
            'fecha' => 'required|date',
            'estado' => 'required|in:borrador,enviada,aceptada,rechazada',
            'observaciones' => 'nullable|string',
            'fecha_vencimiento' => 'nullable|date',
            'descripcion' => 'required|array|min:1',
            'descripcion.*' => 'required|string',
            'cantidad' => 'required|array|min:1',
            'cantidad.*' => 'required|numeric|min:0.01',
            'precio_unitario' => 'required|array|min:1',
            'precio_unitario.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Actualizar la cotización
            $cotizacion->update([
                'cliente_id' => $request->cliente_id,
                'fecha' => $request->fecha,
                'estado' => $request->estado,
                'observaciones' => $request->observaciones,
                'fecha_vencimiento' => $request->fecha_vencimiento,
            ]);

            // Eliminar items antiguos
            $cotizacion->items()->delete();

            // Crear los nuevos items
            $total = 0;
            foreach ($request->descripcion as $index => $descripcion) {
                $cantidad = $request->cantidad[$index];
                $precio_unitario = $request->precio_unitario[$index];
                $subtotal = $cantidad * $precio_unitario;

                CotizacionItem::create([
                    'cotizacion_id' => $cotizacion->id,
                    'descripcion' => $descripcion,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            // Actualizar el total
            $cotizacion->update(['total' => $total]);

            DB::commit();

            return redirect()
                ->route('cotizacions.index')
                ->with('success', 'Cotización actualizada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar la cotización: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cotizacion $cotizacion)
    {
        try {
            $cotizacion->delete();
            return redirect()
                ->route('cotizacions.index')
                ->with('success', 'Cotización eliminada exitosamente');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Error al eliminar la cotización: ' . $e->getMessage()]);
        }
    }

    /**
     * Generar PDF de la cotización
     */
    public function generarPDF(Cotizacion $cotizacion)
    {
        $cotizacion->load('cliente', 'user', 'items');

        // Configurar opciones de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');

        // Crear instancia de Dompdf
        $dompdf = new Dompdf($options);

        // Renderizar la vista a HTML
        $html = view('cotizaciones.pdf', compact('cotizacion'))->render();

        // Cargar HTML en Dompdf
        $dompdf->loadHtml($html);

        // Configurar el tamaño del papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $dompdf->render();

        // Descargar el PDF
        return $dompdf->stream('cotizacion_' . $cotizacion->id . '.pdf', [
            'Attachment' => true
        ]);
    }
}
