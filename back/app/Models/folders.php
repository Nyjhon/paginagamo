<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class folders extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'id',
        'nombre',
        'category_id',
        'parent_id',
    ];
    public function parent()
    {
        return $this->belongsTo(folders::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(folders::class, 'parent_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function childrenRecursive()
    {
        return $this->hasMany(folders::class, 'parent_id')->with('childrenRecursive');
    }
    public function documents()
    {
        return $this->hasMany(documents::class);
    }
    public function fullPath()
    {
        $path = [$this->nombre];
        $current = $this->parent;

        while ($current) {
            array_unshift($path, $current->nombre);
            $current = $current->parent;
        }

        // Incluye categoría si está cargada
        if ($this->relationLoaded('category') && $this->category) {
            array_unshift($path, $this->category->nombre);
        }

        return implode('/', $path);
    }
    public function fullPath2($separator = ' / ')
    {
        $names = [];
        $folder = $this;

        while ($folder) {
            array_unshift($names, trim($folder->nombre)); // Insertar al principio
            $folder = $folder->parent;
        }

        return implode($separator, $names);
    }

}
