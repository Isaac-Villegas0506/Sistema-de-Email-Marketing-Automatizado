<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Models\EmailJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DispatchCampaignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Campaign $campaign)
    {}

    public function handle(): void
    {
        if ($this->campaign->status === 'paused' || $this->campaign->status === 'completed') {
            return;
        }

        $this->campaign->update(['status' => 'sending']);


        EmailJob::where('campaign_id', $this->campaign->id)
                ->where('status', 'pending')
                ->chunkById(100, function ($jobs) {
                    foreach ($jobs as $job) {
                        SendEmailJob::dispatch($job);
                    }
                });
    }
}
