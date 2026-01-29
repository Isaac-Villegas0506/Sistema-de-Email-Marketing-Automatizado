@extends('layouts.app')

@section('title', 'Campañas')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <p class="text-zinc-400 text-sm">Gestiona y monitorea tus campañas</p>
        <a href="{{ route('campaigns.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-primary-500 to-accent-500 hover:from-primary-400 hover:to-accent-400 text-white px-5 py-2.5 rounded-xl font-medium text-sm transition-all shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            <span>Nueva Campaña</span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-accent-500/10 border border-accent-500/20 text-accent-400 px-4 py-3.5 rounded-xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-zinc-900/80 border border-zinc-800/60 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-zinc-800/50 border-b border-zinc-700/50">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider min-w-[200px]">Progreso</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Contactos</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Accion</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800/60">
                    @forelse($campaigns as $c)
                        @php
                            $sc = match($c->status) {
                                'completed' => ['bg'=>'bg-accent-500/15','t'=>'text-accent-400','b'=>'border-accent-500/25','l'=>'Completado','d'=>'bg-accent-500'],
                                'sending' => ['bg'=>'bg-primary-500/15','t'=>'text-primary-400','b'=>'border-primary-500/25','l'=>'Enviando','d'=>'bg-primary-500'],
                                'failed' => ['bg'=>'bg-rose-500/15','t'=>'text-rose-400','b'=>'border-rose-500/25','l'=>'Fallido','d'=>'bg-rose-500'],
                                'queued' => ['bg'=>'bg-amber-500/15','t'=>'text-amber-400','b'=>'border-amber-500/25','l'=>'En Cola','d'=>'bg-amber-500'],
                                default => ['bg'=>'bg-zinc-500/15','t'=>'text-zinc-400','b'=>'border-zinc-500/25','l'=>'Borrador','d'=>'bg-zinc-500'],
                            };
                        @endphp
                        <tr class="hover:bg-zinc-800/40 transition-all group">
                            <td class="px-6 py-4">
                                <span class="font-semibold text-white text-sm">{{ $c->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase {{ $sc['bg'] }} {{ $sc['t'] }} border {{ $sc['b'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $sc['d'] }} {{ $c->status == 'sending' ? 'animate-pulse' : '' }}"></span>
                                    {{ $sc['l'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 h-2 bg-zinc-800 rounded-full overflow-hidden">
                                        <div class="h-full progress-bar rounded-full" style="width: {{ $c->total_contacts > 0 ? ($c->processed_count / $c->total_contacts) * 100 : 0 }}%"></div>
                                    </div>
                                    <span class="text-xs text-zinc-400 font-mono">{{ number_format(($c->total_contacts > 0 ? ($c->processed_count / $c->total_contacts) * 100 : 0), 0) }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-300 font-semibold">{{ number_format($c->total_contacts) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('campaigns.show', $c) }}" class="relative z-10 inline-flex items-center gap-2 px-4 py-2 bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 hover:border-primary-500/50 rounded-lg text-sm font-medium text-white hover:text-primary-400 transition-all cursor-pointer">
                                    <span>Ver detalles</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <p class="text-zinc-400 mb-2">No hay campañas creadas</p>
                                <a href="{{ route('campaigns.create') }}" class="text-primary-400 hover:text-primary-300 text-sm font-medium">Crear primera campaña</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
