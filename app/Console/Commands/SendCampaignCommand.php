<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Campaign;
use App\Jobs\DispatchCampaignJob;

class SendCampaignCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:campaign {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually dispatch a campaign for sending';

    /**
     * Execute the console command.
     */
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
