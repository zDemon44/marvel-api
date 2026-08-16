<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hero extends Model
{
    use HasFactory;

    protected $table = 'heroes';

    protected $fillable = [
        'nombre',
        'nombre_real',
        'poder_principal',
        'nivel_poder',
        'imagen_url',
        'estado',
    ];

    public function misiones()
    {
        return $this->hasMany(Mision::class, 'superheroe_id');
    }
}