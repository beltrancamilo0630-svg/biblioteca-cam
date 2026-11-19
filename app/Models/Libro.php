<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        'titulo',
        'autor',
        'anio',
        'categoria_id',
        'disponible',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function scopeBuscar($query, ?string $buscar)
    {
        if ($buscar) {
            $query->where('titulo', 'like', '%' . $buscar . '%');
        }

        return $query;
    }

    public function scopeDeCategoria($query, $categoriaId)
    {
        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        }

        return $query;
    }
}