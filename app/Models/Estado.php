<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estado extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nombre_estado'];

    protected $searchableFields = ['*'];

    public function registros()
    {
        return $this->hasMany(Registro::class);
    }
}