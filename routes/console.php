<?php
 

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;



$scheduleConfig = [
    'tables:update-status' => 'everyFifteenMinutes',
    'orders:archive' => 'weekly',
    'inspire' => 'hourly',
];

foreach ($scheduleConfig as $command => $frequency) {
    Schedule::command($command)->{$frequency}()->runInBackground();
}

//Schedule::command('tables:update-status')->everyFifteenMinutes();
//Schedule::command('orders:archive')->weekly();
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
