<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ArchiveOrders extends Command
{
    protected $signature = 'orders:archive';

    protected $description = 'Archive orders';

    public function handle()
    {
  
                // Get orders that are eligible for archiving
                $orders = Order::where('status', 'completed')->where('created_at', '<', now()->subDays(30))->get();
        
                // Archive orders
                foreach ($orders as $order) {
                    // Insert order into archived_orders table
                    DB::table('archived_orders')->insert([
                        'order_id' => $order->id,
                        'user_id' => $order->user_id,
                        'order_date' => $order->order_date,
                        'status' => $order->status,
                        'order_type' => $order->order_type,
                        'total_amount' => $order->total_amount,
                        'delivery_address' => $order->delivery_address,
                        'table_id' => $order->table_id,
                        'payment_method' => $order->payment_method,
                        'stripe_session_id' => $order->stripe_session_id,
                        'archived_at' => now(),
                    ]);
        
                    // Update order status to archived
                    $order->status = 'archived';
                    $order->save();
                }
        
                $this->info('Orders archived successfully!');
            }
        }
