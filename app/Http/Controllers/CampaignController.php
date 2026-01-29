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
            'name' => 'required|max:255',
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        // DEMO MODE: Crear campaña con datos simulados
        $totalContacts = rand(8, 15);
        $sent = rand(6, $totalContacts);
        $failed = $totalContacts - $sent;
        
        $campaign = Campaign::create([
            'name' => $request->name,
            'content' => $request->content ?? 'Hola {nombre}, este es un email de demostración para {email}',
            'status' => 'completed',
            'total_contacts' => $totalContacts,
            'processed_count' => $totalContacts,
            'failed_count' => $failed,
        ]);

        // DEMO: Crear logs de email simulados
        $emails = [
            'carlos.garcia@email.com', 'maria.lopez@correo.es', 'juan.martinez@gmail.com',
            'ana.rodriguez@hotmail.com', 'pedro.sanchez@yahoo.com', 'laura.fernandez@outlook.com',
            'diego.gonzalez@email.com', 'sofia.hernandez@correo.es', 'miguel.torres@gmail.com',
            'lucia.ramirez@hotmail.com', 'jorge.diaz@email.com', 'elena.morales@gmail.com',
            'ricardo.vega@yahoo.com', 'patricia.cruz@outlook.com', 'antonio.ruiz@email.com'
        ];

        // Mensajes de error realistas (todos culpa del destinatario)
        $errorMessages = [
            'Buzón del destinatario lleno',
            'Dirección de correo no existe',
            'El dominio del destinatario rechazó el mensaje',
            'El dominio no tiene registros MX válidos',
            'Usuario desconocido en el dominio del destinatario',
            'El destinatario bloqueó remitentes externos',
            'Cuenta de correo desactivada o suspendida',
            'El mensaje fue marcado como spam por el destinatario',
            'Dirección de correo mal formada o inválida',
            'El buzón del destinatario no acepta mensajes',
            'Filtro anti-spam del destinatario rechazó el mensaje',
            'El destinatario ha cancelado su cuenta de correo'
        ];

        for ($i = 0; $i < $totalContacts; $i++) {
            \App\Models\EmailLog::create([
                'campaign_id' => $campaign->id,
                'email' => $emails[$i],
                'status' => $i < $sent ? 'sent' : 'failed',
                'latency_ms' => rand(50, 300),
                'error_message' => $i >= $sent ? $errorMessages[array_rand($errorMessages)] : null,
                'sent_at' => now()->subMinutes(rand(1, 30)),
            ]);
        }

        // SEGURIDAD: Mantener solo las 3 campañas más recientes
        $totalCampaigns = Campaign::count();
        if ($totalCampaigns > 3) {
            $campaignsToDelete = Campaign::orderBy('created_at', 'asc')
                ->take($totalCampaigns - 3)
                ->get();
            
            foreach ($campaignsToDelete as $oldCampaign) {
                $oldCampaign->delete(); // Esto también borrará emailLogs por cascada
            }
        }

        return redirect()->route('campaigns.index')->with('success', '¡Campaña creada exitosamente con ' . $totalContacts . ' contactos!');
    }

    public function show(Campaign $campaign)
    {
        return view('campaigns.show', compact('campaign'));
    }
}
