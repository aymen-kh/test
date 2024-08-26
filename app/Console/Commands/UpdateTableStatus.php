<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Table;
use Carbon\Carbon;

class UpdateTableStatus extends Command
{
    protected $signature = 'tables:update-status';
    protected $description = 'Update table status to available if it was not available for more than 1.5 hours';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $threshold = Carbon::now()->subHours(1.5);

        Table::where('status', 'not available')
        ->where('updated_at', '<=', $threshold)
        ->update([
            'status' => 'available',
            'updated_at' => null // Clear the timestamp after updating
        ]);

        $this->info('Table statuses updated successfully.');
    }
}
