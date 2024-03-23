<?php

namespace App\Models;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programa extends Model
{
    use HasFactory;

    public function estudiantes() {
        return $this->hasMany(Estudiante::class);
    }
}
