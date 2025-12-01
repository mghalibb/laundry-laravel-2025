<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

// class Level extends Model implements Auditable
class Level extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'levels';
    protected $guarded = ['id'];
    protected $fillable = [
        'nama_level',
        'description',
        'status',
    ];

    /**
     * Defines that one Level can be owned by multiple Users.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id_level');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'level_menu', 'id_level', 'id_menu');
    }
}
