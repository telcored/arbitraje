<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'cliente_id',
        'user_id',
        'fecha',
        'estado',
        'total',
        'observaciones',
        'fecha_vencimiento'
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_vencimiento' => 'date',
        'total' => 'decimal:2',
    ];

    /**
     * Relación: Una cotización pertenece a un cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Client::class, 'cliente_id');
    }

    /**
     * Relación: Una cotización pertenece a un usuario (quien la creó)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Una cotización tiene muchos items
     */
    public function items()
    {
        return $this->hasMany(CotizacionItem::class);
    }

    /**
     * Calcular el total de la cotización basado en sus items
     */
    public function calcularTotal()
    {
        return $this->items()->sum('subtotal');
    }
}
