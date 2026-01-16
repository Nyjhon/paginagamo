<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagenes extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'imagenes'; 
    
    protected $fillable = [
        'ruta',
        'noticia_id',
    ];
    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }

}
