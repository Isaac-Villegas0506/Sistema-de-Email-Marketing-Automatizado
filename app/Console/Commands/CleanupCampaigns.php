<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Campaign;
use App\Models\EmailLog;
use App\Models\EmailJob;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CleanupCampaigns extends Command
{
    protected $signature = 'campaigns:cleanup';
    protected $description = 'Clean up old campaigns to optimize storage for demo purpose';

    public function handle()
    {
        $this->info('Starting campaign cleanup...');

        $latestCampaignId = Campaign::latest('id')->value('id');

        if (!$latestCampaignId) {
            $this->info('No campaigns found.');
            return;
        }

        $campaignsToDelete = Campaign::where('id', '!=', $latestCampaignId)
            ->where('created_at', '<', Carbon::now()->subMinutes(60))
            ->get();

        foreach ($campaignsToDelete as $campaign) {
            $this->info("Deleting campaign ID: {$campaign->id} - {$campaign->name}");
            EmailLog::where('campaign_id', $campaign->id)->delete();
            $campaign->delete();
        }
        
        EmailLog::where('created_at', '<', Carbon::now()->subHours(2))->delete();

        $this->info('Cleanup completed.');
    }
}
