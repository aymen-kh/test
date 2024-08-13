<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    
    use HasFactory;
    protected $fillable = [
        'number',
        'status',
        'capacity',
        'area_id',
        
                ];






    public function area()
    {
        return $this->belongsTo(Area::class);
    }
  
}
