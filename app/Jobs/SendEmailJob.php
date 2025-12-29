<?php

namespace App\Jobs;

use App\Models\EmailJob;
use App\Models\EmailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Throwable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = [10, 30, 60];

    public function __construct(public EmailJob $emailJob)
    {}

    /**
     * @throws Throwable
     */
    public function handle(): void
    {

        
        $this->emailJob->update(['status' => 'processing']);

        $latency = rand(50, 500);
        usleep($latency * 1000);

        if (rand(1, 100) <= 10) {
            throw new \Exception("Error SMTP Simulado 421");
        }

        DB::transaction(function () use ($latency) {
            $this->emailJob->update(['status' => 'completed']);
            
            EmailLog::create([
                'campaign_id' => $this->emailJob->campaign_id,

                'email' => $this->emailJob->contact->email,
                'status' => 'sent',
                'latency_ms' => $latency,
                'sent_at' => now(),
            ]);

            $this->emailJob->campaign->increment('processed_count');
        });
    }

    public function failed(Throwable $exception): void
    {
         $this->emailJob->update(['status' => 'failed']);
         
         EmailLog::create([
            'campaign_id' => $this->emailJob->campaign_id,

            'email' => $this->emailJob->contact->email,
            'status' => 'failed',
            'error_message' => $exception->getMessage(),
            'sent_at' => now(),
        ]);
        
        $this->emailJob->campaign->increment('failed_count');
    }
}
