<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_id',
        'start_time',
        'end_time',
        'event_date',
        'number_of_guests',
        'event_type',
        'additional_information',
        'status',
      
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Table
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
