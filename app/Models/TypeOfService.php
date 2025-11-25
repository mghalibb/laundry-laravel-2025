<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfService extends Model
{use HasFactory;

    protected $table = 'type_of_service';

    protected $fillable = [
        'service_name',
        'price',
        'description',
    ];
}
