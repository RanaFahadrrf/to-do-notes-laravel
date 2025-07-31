<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
// use Illuminate\Foundation\Scheduling\Schedule;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



Schedule::call(function () {
    Artisan::call('send:reminder-emails');
    logger('This task ran!');
})->everyMinute();
// return function (Schedule $schedule) {
//     $schedule->command('inspire')->everyMinute();
// };

// app(Schedule::class)
//     ->command('send:reminder-emails')
//     ->everyMinute();