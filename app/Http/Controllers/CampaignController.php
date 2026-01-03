<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Jobs\ImportContactsJob;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->store('campaigns');

        $campaign = Campaign::create([
            'name' => $request->name,
            'content' => $request->content ?? 'Contenido de prueba',
            'status' => 'processing_file',
        ]);

        try {
            \Illuminate\Support\Facades\Artisan::call('campaigns:cleanup');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('Auto-cleanup failed: ' . $e->getMessage());
        }

        ImportContactsJob::dispatch($campaign, storage_path('app/' . $path));

        return redirect()->route('campaigns.index')->with('success', 'El procesamiento de la campaña ha comenzado.');
    }

    public function show(Campaign $campaign)
    {
        return view('campaigns.show', compact('campaign'));
    }
}
