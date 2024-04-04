<?php

namespace App\Models;

use App\Models\Programa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Estudiante extends Model
{
    use HasFactory;
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $fillable = ['codigo', 'nombre', 'email', 'fechaN', 'programa_id'];

    public function programa(): BelongsTo {
        return $this->belongsTo(Programa::class);
    }

}
