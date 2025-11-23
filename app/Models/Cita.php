<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
    protected $fillable = [
        'nombre',
        'user_id',
        'barbero_id',
        'fecha',
        'hora',
        'servicio',
        'estado',
        'notas',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Relación con el usuario que agendó la cita
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el barbero asignado
     */
    public function barbero(): BelongsTo
    {
        return $this->belongsTo(User::class, 'barbero_id');
    }

    /**
     * Obtener el nombre del servicio formateado
     */
    public function getServicioNombreAttribute(): string
    {
        return match($this->servicio) {
            'corte' => 'Corte de Cabello',
            'barba' => 'Arreglo de Barba',
            'combo' => 'Corte + Barba',
            default => $this->servicio,
        };
    }

    /**
     * Obtener el color del estado
     */
    public function getEstadoColorAttribute(): string
    {
        return match($this->estado) {
            'pendiente' => 'yellow',
            'confirmada' => 'green',
            'cancelada' => 'red',
            'completada' => 'blue',
            default => 'gray',
        };
    }
}
