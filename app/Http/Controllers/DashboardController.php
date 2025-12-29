<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\EmailLog;
use App\Models\EmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $totalSent = EmailLog::where('status', 'sent')->count();
        $totalFailed = EmailLog::where('status', 'failed')->count();
        $queued = EmailJob::where('status', 'pending')->count();
        

        $throughput = EmailLog::where('created_at', '>=', now()->subMinute())->count();
        

        $logs = EmailLog::with('campaign')->latest()->take(10)->get();
        

        $activeCampaigns = Campaign::whereIn('status', ['queued', 'sending'])->get();

        return view('dashboard', compact('totalSent', 'totalFailed', 'queued', 'throughput', 'logs', 'activeCampaigns'));
    }
}
