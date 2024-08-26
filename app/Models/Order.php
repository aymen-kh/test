<?php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'order_date',
        'status',
        'order_type',
        'total_amount',
        'delivery_address',
        'table_id',
        'payment_method',
        'stripe_session_id',
    ];
// app/Models/Order.php
public function getStatusLabelAttribute()
{
    $statusLabels = [
        'unpaid' => 'Unpaid',
        'paid' => 'Paid',
        'preparing' => 'Preparing',
        'in_delivery' => 'In Delivery',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    return $statusLabels[$this->status] ?? 'Unknown';
}

public function user()
{
    return $this->belongsTo(User::class);
}

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_item', 'order_id', 'item_id')
                    ->withPivot('quantity', 'custom_description')
                    ->withTimestamps();
    }

    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }
}
