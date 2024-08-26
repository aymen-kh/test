<?php
namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UserExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::with('orders', 'reservations')
            ->get()
            ->map(function ($client) {
                return [
                    'name' => $client->name,
                    'email' => $client->email,
                    'total_spent' => $client->orders->sum('total'),
                    'num_orders' => $client->orders->count(),
                    'num_reservations' => $client->reservations->count(),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Client Name',
            'Email',
            'Total Spent',
            'Number of Orders',
            'Number of Reservations',
        ];
    }
}
