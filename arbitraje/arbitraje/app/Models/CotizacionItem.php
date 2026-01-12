<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cotizacion_id',
        'descripcion',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Relación: Un item pertenece a una cotización
     */
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
