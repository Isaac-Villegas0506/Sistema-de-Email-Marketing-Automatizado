@extends('layouts.app')

@section('title', 'Detalle de Campaña')

@section('content')
    <div class="mb-6">
        <a href="{{ route('campaigns.index') }}" class="text-indigo-400 hover:text-indigo-300">← Volver</a>
    </div>

    <div class="bg-slate-800 rounded-xl border border-slate-700 p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                 <h1 class="text-2xl font-bold text-white mb-2">{{ $campaign->name }}</h1>
                 <p class="text-slate-400">Estado: <strong class="text-white uppercase">
                    {{ match($campaign->status) {
                        'draft' => 'Borrador',
                        'queued' => 'En Cola',
                        'sending' => 'Enviando',
                        'completed' => 'Completado',
                        'failed' => 'Fallido',
                        'processing_file' => 'Procesando archivo',
                        default => $campaign->status
                    } }}
                 </strong></p>
                 <br>
                 <form action="{{ route('campaigns.update', $campaign) }}" method="POST">
                    @csrf
                    @method('PUT')
                     <!-- Hidden trigger to retry or something if needed -->
                 </form>
            </div>
            <div class="text-right">
                <p class="text-3xl font-mono text-white">{{ number_format($campaign->processed_count) }} <span class="text-slate-500 text-lg">/ {{ number_format($campaign->total_contacts) }}</span></p>
                <p class="text-sm text-slate-500">Progresión</p>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="mt-6 w-full bg-slate-900 rounded-full h-4 overflow-hidden">
             <div class="bg-indigo-500 h-full transition-all duration-700 ease-out" style="width: {{ $campaign->total_contacts > 0 ? ($campaign->processed_count / $campaign->total_contacts) * 100 : 0 }}%"></div>
        </div>
    </div>

    <!-- Logs -->
    <h3 class="text-lg font-semibold mb-4">Logs Recientes</h3>
    <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-900/50">
                <tr>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3">Latencia</th>
                    <th class="px-6 py-3">Hora</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @foreach($campaign->emailLogs()->latest()->take(20)->get() as $log)
                <tr>
                    <td class="px-6 py-3">{{ $log->email }}</td>
                    <td class="px-6 py-3">
                         <span class="{{ $log->status == 'sent' ? 'text-emerald-400' : 'text-red-400' }}">
                            {{ $log->status == 'sent' ? 'Enviado' : 'Fallido' }}
                         </span>
                    </td>
                    <td class="px-6 py-3">{{ $log->latency_ms }}ms</td>
                    <td class="px-6 py-3">{{ $log->created_at->format('H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
