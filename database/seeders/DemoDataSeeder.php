<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\EmailLog;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Mensajes de error realistas
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

        $emails = [
            'carlos.garcia@email.com', 'maria.lopez@correo.es', 'juan.martinez@gmail.com',
            'ana.rodriguez@hotmail.com', 'pedro.sanchez@yahoo.com', 'laura.fernandez@outlook.com',
            'diego.gonzalez@email.com', 'sofia.hernandez@correo.es', 'miguel.torres@gmail.com',
            'lucia.ramirez@hotmail.com', 'jorge.diaz@email.com', 'elena.morales@gmail.com',
            'ricardo.vega@yahoo.com', 'patricia.cruz@outlook.com', 'antonio.ruiz@email.com',
            'isabel.jimenez@gmail.com', 'fernando.castro@hotmail.com', 'carmen.ortiz@email.com'
        ];

        // Crear 3 campañas de demostración
        $campaignData = [
            [
                'name' => 'Lanzamiento Producto Q1 2026',
                'total' => 12,
                'sent' => 9,
                'days_ago' => 2
            ],
            [
                'name' => 'Newsletter Semanal - Enero',
                'total' => 15,
                'sent' => 11,
                'days_ago' => 5
            ],
            [
                'name' => 'Campaña Bienvenida Nuevos Usuarios',
                'total' => 10,
                'sent' => 8,
                'days_ago' => 1
            ]
        ];

        foreach ($campaignData as $data) {
            $totalContacts = $data['total'];
            $sent = $data['sent'];
            $failed = $totalContacts - $sent;
            
            $campaign = Campaign::create([
                'name' => $data['name'],
                'content' => 'Hola {nombre}, este es un email de demostración para {email}',
                'status' => 'completed',
                'total_contacts' => $totalContacts,
                'processed_count' => $totalContacts,
                'failed_count' => $failed,
                'created_at' => Carbon::now()->subDays($data['days_ago']),
                'updated_at' => Carbon::now()->subDays($data['days_ago']),
            ]);

            // Crear logs para esta campaña
            for ($i = 0; $i < $totalContacts; $i++) {
                EmailLog::create([
                    'campaign_id' => $campaign->id,
                    'email' => $emails[$i % count($emails)],
                    'status' => $i < $sent ? 'sent' : 'failed',
                    'latency_ms' => rand(50, 300),
                    'error_message' => $i >= $sent ? $errorMessages[array_rand($errorMessages)] : null,
                    'sent_at' => Carbon::now()->subDays($data['days_ago'])->subMinutes(rand(1, 60)),
                    'created_at' => Carbon::now()->subDays($data['days_ago'])->subMinutes(rand(1, 60)),
                    'updated_at' => Carbon::now()->subDays($data['days_ago'])->subMinutes(rand(1, 60)),
                ]);
            }
        }

        $this->command->info('✅ Base de datos poblada con 3 campañas de demostración');
        $this->command->info('📊 Total de emails: ' . EmailLog::count());
        $this->command->info('✉️  Exitosos: ' . EmailLog::where('status', 'sent')->count());
        $this->command->info('❌ Fallidos: ' . EmailLog::where('status', 'failed')->count());
    }
}
