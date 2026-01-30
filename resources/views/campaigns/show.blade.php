@extends('layouts.app')

@section('title', 'Detalle de Campaña')

@section('content')
    <a href="{{ route('campaigns.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-zinc-400 hover:text-white mb-8 transition-colors group">
        <div class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center group-hover:bg-primary-600 transition-colors">
            <svg class="w-4 h-4 text-zinc-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        </div>
        <span>Volver al listado</span>
    </a>

    <div class="bg-zinc-900/40 border border-white/5 rounded-2xl p-6 md:p-8 mb-8 relative overflow-hidden backdrop-blur-sm shadow-xl animate-fade-in-up">
        <!-- Decorative Background -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent-500/5 rounded-full blur-3xl -ml-32 -mb-32 pointer-events-none"></div>

        <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
            <div>
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-zinc-800 to-zinc-900 flex items-center justify-center border border-white/5 shadow-inner flex-shrink-0">
                        <span class="text-lg font-bold text-white">{{ substr($campaign->name, 0, 2) }}</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white font-display tracking-tight leading-none mb-1">{{ $campaign->name }}</h1>
                        <p class="text-sm text-zinc-400">ID: <span class="font-mono text-xs text-zinc-500">{{ $campaign->id }}</span></p>
                    </div>
                </div>
                
                @php
                    $sc = match($campaign->status) {
                        'completed' => ['bg'=>'bg-emerald-500/10','t'=>'text-emerald-400','b'=>'border-emerald-500/20','l'=>'Completado','d'=>'bg-emerald-500'],
                        'sending' => ['bg'=>'bg-primary-500/10','t'=>'text-primary-400','b'=>'border-primary-500/20','l'=>'Enviando','d'=>'bg-primary-500'],
                        'failed' => ['bg'=>'bg-rose-500/10','t'=>'text-rose-400','b'=>'border-rose-500/20','l'=>'Fallido','d'=>'bg-rose-500'],
                        'queued' => ['bg'=>'bg-amber-500/10','t'=>'text-amber-400','b'=>'border-amber-500/20','l'=>'En Cola','d'=>'bg-amber-500'],
                        default => ['bg'=>'bg-zinc-500/10','t'=>'text-zinc-400','b'=>'border-zinc-500/20','l'=>'Borrador','d'=>'bg-zinc-500'],
                    };
                @endphp
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide {{ $sc['bg'] }} {{ $sc['t'] }} border {{ $sc['b'] }} ml-1">
                    <span class="w-2 h-2 rounded-full {{ $sc['d'] }} {{ $campaign->status == 'sending' ? 'animate-pulse' : '' }} shadow-[0_0_8px_currentColor]"></span>
                    {{ $sc['l'] }}
                </span>
            </div>
            
            <div class="text-left lg:text-right bg-white/5 rounded-2xl p-4 border border-white/5 min-w-[200px]">
                <p class="text-xs text-zinc-400 uppercase tracking-wider font-bold mb-1">Emails Procesados</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-white font-display tracking-tight">{{ number_format($campaign->processed_count) }}</span>
                    <span class="text-sm text-zinc-500 font-medium">/ {{ number_format($campaign->total_contacts) }}</span>
                </div>
            </div>
        </div>
        
        <div class="relative">
            <div class="flex justify-between mb-2">
                <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Progreso del Envío</span>
                <span class="text-xs text-primary-400 font-mono font-bold">{{ $campaign->total_contacts > 0 ? number_format(($campaign->processed_count / $campaign->total_contacts) * 100, 1) : 0 }}%</span>
            </div>
            <div class="w-full h-4 bg-zinc-800/50 rounded-full overflow-hidden border border-white/5">
                <div class="h-full bg-gradient-to-r from-primary-600 to-primary-400 rounded-full transition-all duration-700 relative shadow-[0_0_20px_rgba(34,211,238,0.3)]" style="width: {{ $campaign->total_contacts > 0 ? ($campaign->processed_count / $campaign->total_contacts) * 100 : 0 }}%">
                    <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-zinc-900/40 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm shadow-xl animate-fade-in-up delay-100">
        <div class="px-6 py-5 border-b border-white/5 bg-white/5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-zinc-800 text-zinc-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-white uppercase tracking-wider font-display">Logs de Actividad</h3>
            </div>
            <span class="px-3 py-1 rounded-full bg-zinc-800 border border-white/5 text-[10px] font-mono text-zinc-400">Últimos 20</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-zinc-900/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider font-display">Email Destinatario</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider font-display">Estado</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider font-display">Detalle Error</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider font-display">Latencia</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider font-display text-right">Hora</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($campaign->emailLogs()->latest()->take(20)->get() as $log)
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="px-6 py-4 text-sm font-medium text-zinc-300 group-hover:text-white transition-colors">{{ $log->email }}</td>
                        <td class="px-6 py-4">
                            @if($log->status == 'sent')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase bg-accent-500/10 text-accent-400 border border-accent-500/20">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    Enviado
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Fallido
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            @if($log->error_message)
                                <div class="flex items-start gap-2 text-rose-400/80">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                                    </svg>
                                    <span class="text-xs leading-relaxed line-clamp-2" title="{{ $log->error_message }}">{{ $log->error_message }}</span>
                                </div>
                            @else
                                <span class="text-xs text-zinc-600">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-zinc-400 font-mono">
                            <span class="{{ $log->latency_ms < 500 ? 'text-emerald-400' : ($log->latency_ms < 1000 ? 'text-amber-400' : 'text-rose-400') }}">
                                {{ $log->latency_ms }}ms
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-zinc-500 font-mono text-right">{{ $log->created_at->format('H:i:s') }}</td>
                    </tr>
                    @endforeach
                    @if($campaign->emailLogs()->count() == 0)
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-zinc-500 text-sm">
                                No hay registros de envío todavía.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
