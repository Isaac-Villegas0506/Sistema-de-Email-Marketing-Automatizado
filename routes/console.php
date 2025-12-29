<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('campaigns:cleanup', function () {
    // Logic is handled in the command class app/Console/Commands/CleanupCampaigns.php
    // checking if we can just register the class based command here or if we need to call it.
    // Actually, since I created a Command class, Laravel auto-discovers it in app/Console/Commands usually.
    // But to be safe and explicit for the schedule:
    Artisan::call('campaigns:cleanup');
})->purpose('Clean up old campaigns')->hourly();
