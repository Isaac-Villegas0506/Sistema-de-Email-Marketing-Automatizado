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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old campaigns to optimize storage for demo purpose';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting campaign cleanup...');

        // Keep the most recent campaign (1)
        $latestCampaignId = Campaign::latest('id')->value('id');

        if (!$latestCampaignId) {
            $this->info('No campaigns found.');
            return;
        }

        // Find campaigns older than 1 hour, excluding the latest one
        $campaignsToDelete = Campaign::where('id', '!=', $latestCampaignId)
            ->where('created_at', '<', Carbon::now()->subMinutes(60))
            ->get();

        foreach ($campaignsToDelete as $campaign) {
            $this->info("Deleting campaign ID: {$campaign->id} - {$campaign->name}");

            // Delete associated logs and jobs first (though cascade might handle it, being explicit is safer for code clarity)
            EmailLog::where('campaign_id', $campaign->id)->delete();
            // Note: EmailJob usually has campaign_id or payload related to it. 
            // Since EmailJob might be generic, we rely on cascade or job completion, 
            // but here we just focus on the campaign and logs which take up the most space.
            
            // Delete the CSV file if it exists (assuming we know the path logic or stored it)
            // In CampaignController store: $path = $request->file('csv_file')->store('campaigns');
            // But we don't seem to save the file path in the DB in the controller snippet I saw earlier (only status, content, name).
            // If the path isn't saved, we can't delete the specific file easily without guessing or listing directory.
            // For a demo, ignoring the file or adding a daily file cleanup could work.
            // *Self-correction*: If thousands of CSVs pile up in storage/app/campaigns, that's bad.
            // Let's defer file cleanup or implement a naive "delete files older than X" if needed, 
            // but the prompt emphasized "storage de la bd" (DB storage). 
            // I'll stick to DB cleanup unless I see the model having a file_path.

            $campaign->delete();
        }
        
        // Also clean up orphan logs if any (safety net)
        EmailLog::where('created_at', '<', Carbon::now()->subHours(2))->delete();

        $this->info('Cleanup completed.');
    }
}
