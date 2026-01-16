<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    use HasFactory, SoftDeletes;
    public function imagenes()
    {
        return $this->hasMany(Imagenes::class);
    }
}
