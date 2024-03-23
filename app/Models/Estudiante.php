<?php

namespace App\Models;

use App\Models\Programa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Estudiante extends Model
{
    use HasFactory;

    public function programa(): BelongsTo {
        return $this->belongsTo(Programa::class);
    }
}
