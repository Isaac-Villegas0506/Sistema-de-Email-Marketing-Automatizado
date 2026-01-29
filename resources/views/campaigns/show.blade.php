@extends('layouts.app')

@section('title', 'Detalle de Campaña')

@section('content')
    <a href="{{ route('campaigns.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
        Volver
    </a>

    <div class="card-glow bg-zinc-900/80 border border-zinc-800/60 rounded-2xl p-6 mb-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-primary-500/10 to-accent-500/5 rounded-full blur-3xl"></div>
        <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div>
                <h1 class="text-xl font-bold text-white mb-3">{{ $campaign->name }}</h1>
                @php
                    $sc = match($campaign->status) {
                        'completed' => ['bg'=>'bg-accent-500/15','t'=>'text-accent-400','b'=>'border-accent-500/25','l'=>'Completado','d'=>'bg-accent-500'],
                        'sending' => ['bg'=>'bg-primary-500/15','t'=>'text-primary-400','b'=>'border-primary-500/25','l'=>'Enviando','d'=>'bg-primary-500'],
                        'failed' => ['bg'=>'bg-rose-500/15','t'=>'text-rose-400','b'=>'border-rose-500/25','l'=>'Fallido','d'=>'bg-rose-500'],
                        'queued' => ['bg'=>'bg-amber-500/15','t'=>'text-amber-400','b'=>'border-amber-500/25','l'=>'En Cola','d'=>'bg-amber-500'],
                        default => ['bg'=>'bg-zinc-500/15','t'=>'text-zinc-400','b'=>'border-zinc-500/25','l'=>'Borrador','d'=>'bg-zinc-500'],
                    };
                @endphp
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold uppercase {{ $sc['bg'] }} {{ $sc['t'] }} border {{ $sc['b'] }}">
                    <span class="w-2 h-2 rounded-full {{ $sc['d'] }} {{ $campaign->status == 'sending' ? 'animate-pulse' : '' }}"></span>
                    {{ $sc['l'] }}
                </span>
            </div>
            <div class="text-left lg:text-right">
                <p class="text-3xl font-bold text-white font-mono">{{ number_format($campaign->processed_count) }} <span class="text-zinc-500 text-lg">/ {{ number_format($campaign->total_contacts) }}</span></p>
                <p class="text-xs text-zinc-500 mt-1">Emails procesados</p>
            </div>
        </div>
        
        <div class="mt-6 relative">
            <div class="flex justify-between mb-2">
                <span class="text-xs text-zinc-500">Progreso</span>
                <span class="text-xs text-primary-400 font-mono font-semibold">{{ $campaign->total_contacts > 0 ? number_format(($campaign->processed_count / $campaign->total_contacts) * 100, 1) : 0 }}%</span>
            </div>
            <div class="w-full h-3 bg-zinc-800 rounded-full overflow-hidden">
                <div class="h-full progress-bar rounded-full transition-all duration-700" style="width: {{ $campaign->total_contacts > 0 ? ($campaign->processed_count / $campaign->total_contacts) * 100 : 0 }}%"></div>
            </div>
        </div>
    </div>

    <div class="card-glow bg-zinc-900/80 border border-zinc-800/60 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-800/60 flex items-center justify-between">
            <h3 class="text-sm font-semibold text-white">Logs Recientes</h3>
            <span class="text-xs text-zinc-500">Ultimos 20 registros</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-zinc-800/50">
                    <tr>
                        <th class="px-6 py-3 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Error</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Latencia</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Hora</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800/60">
                    @foreach($campaign->emailLogs()->latest()->take(20)->get() as $log)
                    <tr class="hover:bg-zinc-800/40 transition-colors">
                        <td class="px-6 py-3 text-sm text-zinc-200">{{ $log->email }}</td>
                        <td class="px-6 py-3">
                            @if($log->status == 'sent')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase bg-accent-500/15 text-accent-400 border border-accent-500/20">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    Enviado
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase bg-rose-500/15 text-rose-400 border border-rose-500/20">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Fallido
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3 max-w-xs">
                            @if($log->error_message)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                                    </svg>
                                    <span class="text-xs text-rose-300">{{ $log->error_message }}</span>
                                </div>
                            @else
                                <span class="text-xs text-zinc-600">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm text-zinc-400 font-mono">{{ $log->latency_ms }}ms</td>
                        <td class="px-6 py-3 text-sm text-zinc-500 font-mono">{{ $log->created_at->format('H:i:s') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
