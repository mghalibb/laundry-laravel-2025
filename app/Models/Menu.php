<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'icon',
        'category',
        'roles',
        'order',
        'is_active'
    ];

    // Menus can have multiple Levels
    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level_menu', 'id_menu', 'id_level');
    }
}
