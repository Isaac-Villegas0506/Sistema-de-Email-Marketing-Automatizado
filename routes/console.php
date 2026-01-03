<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('campaigns:cleanup', function () {
    Artisan::call('campaigns:cleanup');
})->purpose('Clean up old campaigns')->hourly();
