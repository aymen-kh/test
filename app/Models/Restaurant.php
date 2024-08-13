<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{


    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'is_open',
        'open_days',
        'open_time',
        'close_time',
        'lunch_break',
        'special_closing',
        'closing_date',
        'closing_message',
        'last_order_time',
        'capacity',
        'email',
        'phone',
        'description'
    ];

    // Define any relationships if necessary
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

 /*   public function tables()
    {
        return $this->hasMany(Table::class);
    }
*/

    use HasFactory;

}