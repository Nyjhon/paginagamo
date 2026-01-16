<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class documents extends Model
{
    use HasFactory, SoftDeletes;
    public function folder()
    {
        return $this->belongsTo(folders::class,'folders_id'); // o 'folder_id' si así se llama
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
