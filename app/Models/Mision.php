<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mision extends Model
{
    use HasFactory;

    protected $table = 'misiones';

    protected $fillable = [
        'titulo',
        'descripcion',
        'ubicacion',
        'fecha',
        'nivel_peligro',
        'estado',
        'superheroe_id',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function heroe()
    {
        return $this->belongsTo(Hero::class, 'superheroe_id');
    }
}