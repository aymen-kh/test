<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ['name',
    'description',
    'image',

];
public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
