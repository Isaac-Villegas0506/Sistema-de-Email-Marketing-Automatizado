<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Campaign;
use App\Jobs\DispatchCampaignJob;

class SendCampaignCommand extends Command
{
    protected $signature = 'send:campaign {id?}';
    protected $description = 'Manually dispatch a campaign for sending';

    public function handle()
    {
        $id = $this->argument('id');

        if ($id) {
            $campaign = Campaign::find($id);
        } else {
            $campaign = Campaign::where('status', 'queued')->oldest()->first();
        }

        if (!$campaign) {
            $this->error('No queued campaign found.');
            return;
        }

        $this->info("Dispatching Campaign: {$campaign->name}");
        
        DispatchCampaignJob::dispatch($campaign);

        $this->info('Campaign dispatched to queue.');
    }
}
