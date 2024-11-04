<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registro extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'rut',
        'nombres',
        'apellidos',
        'proveedor_id',
        'motivo',
        'estado_id',
        'user_id',
        'is_duplicated',
    ];

    protected $perPage = 100000;


    protected $searchableFields = ['*'];



    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
