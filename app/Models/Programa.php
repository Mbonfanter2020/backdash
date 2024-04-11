<?php

namespace App\Models;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Programa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'nombre'];

    public function estudiantes() {
        return $this->hasMany(Estudiante::class);
    }

    public function universidad(): BelongsTo {
        return $this->belongsTo(Universidad::class);
    }

    
}
