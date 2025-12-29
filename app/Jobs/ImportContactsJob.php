<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\EmailJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ImportContactsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;

    public function __construct(public Campaign $campaign, public string $filePath)
    {}

    public function handle(): void
    {
        $this->campaign->update(['status' => 'processing_file']);


        $scriptPath = base_path('python_scripts/validator.py');
        

        $result = Process::run(['python', $scriptPath, $this->filePath]);

        $validEmails = [];


        if ($result->failed() || empty($json = json_decode($result->output(), true))) {
            Log::warning("Python falló o no retornó JSON. Usando Fallback PHP. Error: " . $result->errorOutput());
            

            $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $email = trim(str_getcsv($line)[0] ?? '');

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $validEmails[] = $email;
                }
            }
        } else {
            $validEmails = $json['valid'];
        }
        
        $chunks = array_chunk($validEmails, 1000);
        
        foreach ($chunks as $chunk) {
            $contactIds = [];
            foreach ($chunk as $email) {

                $contact = Contact::firstOrCreate(
                    ['email' => $email],
                    ['status' => 'valid']
                );
                $contactIds[] = $contact->id;
            }


            $jobData = [];
            foreach ($contactIds as $cid) {
                $jobData[] = [
                    'campaign_id' => $this->campaign->id,
                    'contact_id' => $cid,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            EmailJob::insert($jobData);
        }

        $this->campaign->update([
            'status' => 'queued', 
            'total_contacts' => count($validEmails)
        ]);


        DispatchCampaignJob::dispatch($this->campaign);
    }
}
