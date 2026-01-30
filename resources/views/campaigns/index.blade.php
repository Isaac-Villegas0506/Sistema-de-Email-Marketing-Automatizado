@extends('layouts.app')

@section('title', 'Campañas')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-white text-base font-bold font-display">Tus Campañas</h2>
            <p class="text-zinc-400 text-sm mt-1">Gestiona y monitorea el rendimiento de envíos</p>
        </div>
        <a href="{{ route('campaigns.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary-600 hover:bg-primary-500 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-[0_0_20px_-5px_rgba(99,102,241,0.4)] hover:shadow-[0_0_25px_-5px_rgba(99,102,241,0.6)] hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            <span>Nueva Campaña</span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-5 py-4 rounded-2xl mb-8 flex items-center gap-3 animate-fade-in">
            <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Mobile View (Cards) -->
    <div class="grid grid-cols-1 gap-4 lg:hidden mb-20 animate-fade-in-up">
        @forelse($campaigns as $c)
            @php
                $sc = match($c->status) {
                    'completed' => ['bg'=>'bg-emerald-500/10','t'=>'text-emerald-400','b'=>'border-emerald-500/20','l'=>'Completado','d'=>'bg-emerald-500'],
                    'sending' => ['bg'=>'bg-primary-500/10','t'=>'text-primary-400','b'=>'border-primary-500/20','l'=>'Enviando','d'=>'bg-primary-500'],
                    'failed' => ['bg'=>'bg-rose-500/10','t'=>'text-rose-400','b'=>'border-rose-500/20','l'=>'Fallido','d'=>'bg-rose-500'],
                    'queued' => ['bg'=>'bg-amber-500/10','t'=>'text-amber-400','b'=>'border-amber-500/20','l'=>'En Cola','d'=>'bg-amber-500'],
                    default => ['bg'=>'bg-zinc-500/10','t'=>'text-zinc-400','b'=>'border-zinc-500/20','l'=>'Borrador','d'=>'bg-zinc-500'],
                };
                $progress = $c->total_contacts > 0 ? ($c->processed_count / $c->total_contacts) * 100 : 0;
            @endphp
            <div class="bg-zinc-900/40 border border-white/5 rounded-2xl p-5 relative overflow-hidden backdrop-blur-sm shadow-lg">
                <!-- Status Line -->
                <div class="absolute top-0 left-0 w-1 h-full {{ $sc['d'] }} opacity-50"></div>

                <div class="flex justify-between items-start mb-4 pl-3">
                    <div>
                        <h3 class="text-white font-bold text-lg font-display tracking-tight">{{ $c->name }}</h3>
                        <p class="text-zinc-500 text-xs mt-0.5">Creada {{ $c->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wide {{ $sc['bg'] }} {{ $sc['t'] }} border {{ $sc['b'] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $sc['d'] }} {{ $c->status == 'sending' ? 'animate-pulse' : '' }}"></span>
                        {{ $sc['l'] }}
                    </span>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 gap-4 mb-4 pl-3">
                    <div class="bg-white/5 rounded-xl p-3 border border-white/5">
                        <span class="text-[10px] text-zinc-500 font-bold uppercase tracking-wider block mb-1">Contactos</span>
                        <span class="text-white font-mono text-sm font-semibold">{{ number_format($c->total_contacts) }}</span>
                    </div>
                    <div class="bg-white/5 rounded-xl p-3 border border-white/5">
                        <span class="text-[10px] text-zinc-500 font-bold uppercase tracking-wider block mb-1">Progreso</span>
                        <span class="text-white font-mono text-sm font-semibold">{{ number_format($progress, 0) }}%</span>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="pl-3 mb-5">
                    <div class="h-1.5 bg-zinc-800 rounded-full overflow-hidden w-full">
                        <div class="h-full bg-gradient-to-r from-primary-600 to-primary-400 rounded-full transition-all duration-1000 relative" style="width: {{ $progress }}%"></div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pl-3">
                    <a href="{{ route('campaigns.show', $c->id) }}" class="flex items-center justify-center w-full gap-2 px-4 py-3 bg-white text-black font-bold text-sm rounded-xl hover:bg-zinc-200 transition-colors">
                        <span>Ver Detalles</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-12 px-4">
                <div class="w-16 h-16 rounded-full bg-zinc-900 border border-zinc-800 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                <h3 class="text-white font-bold text-lg mb-1">Sin Campañas</h3>
                <p class="text-zinc-500 text-sm mb-6">Comienza creando tu primera campaña.</p>
                <a href="{{ route('campaigns.create') }}" class="inline-block px-6 py-3 bg-primary-600 text-white font-bold rounded-xl text-sm">Crear Campaña</a>
            </div>
        @endforelse
    </div>

    <!-- Desktop View (Table) -->
    <div class="hidden lg:block bg-zinc-900/40 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-white/5">
                        <th class="px-6 py-5 text-[11px] font-bold text-zinc-400 uppercase tracking-wider font-display">Nombre de Campaña</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-zinc-400 uppercase tracking-wider font-display">Estado Actual</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-zinc-400 uppercase tracking-wider min-w-[200px] font-display">Progreso</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-zinc-400 uppercase tracking-wider font-display">Contactos</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-zinc-400 uppercase tracking-wider text-right font-display">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($campaigns as $c)
                        @php
                            $sc = match($c->status) {
                                'completed' => ['bg'=>'bg-emerald-500/10','t'=>'text-emerald-400','b'=>'border-emerald-500/20','l'=>'Completado','d'=>'bg-emerald-500'],
                                'sending' => ['bg'=>'bg-primary-500/10','t'=>'text-primary-400','b'=>'border-primary-500/20','l'=>'Enviando','d'=>'bg-primary-500'],
                                'failed' => ['bg'=>'bg-rose-500/10','t'=>'text-rose-400','b'=>'border-rose-500/20','l'=>'Fallido','d'=>'bg-rose-500'],
                                'queued' => ['bg'=>'bg-amber-500/10','t'=>'text-amber-400','b'=>'border-amber-500/20','l'=>'En Cola','d'=>'bg-amber-500'],
                                default => ['bg'=>'bg-zinc-500/10','t'=>'text-zinc-400','b'=>'border-zinc-500/20','l'=>'Borrador','d'=>'bg-zinc-500'],
                            };
                        @endphp
                        <tr class="hover:bg-white/5 transition-all duration-200 group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-zinc-800 to-zinc-900 flex items-center justify-center border border-white/5 group-hover:border-primary-500/30 transition-colors flex-shrink-0">
                                        <span class="text-xs font-bold text-zinc-400 group-hover:text-primary-400">{{ substr($c->name, 0, 2) }}</span>
                                    </div>
                                    <span class="font-bold text-white text-sm tracking-tight">{{ $c->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide {{ $sc['bg'] }} {{ $sc['t'] }} border {{ $sc['b'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $sc['d'] }} {{ $c->status == 'sending' ? 'animate-pulse' : '' }} shadow-[0_0_8px_currentColor]"></span>
                                    {{ $sc['l'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="flex-1 h-2 bg-zinc-800/50 rounded-full overflow-hidden border border-white/5">
                                        <div class="h-full bg-gradient-to-r from-primary-600 to-primary-400 rounded-full transition-all duration-1000 ease-out relative" style="width: {{ $c->total_contacts > 0 ? ($c->processed_count / $c->total_contacts) * 100 : 0 }}%">
                                            <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                                        </div>
                                    </div>
                                    <span class="text-xs text-zinc-400 font-mono font-bold">{{ number_format(($c->total_contacts > 0 ? ($c->processed_count / $c->total_contacts) * 100 : 0), 0) }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-400 font-medium font-mono">{{ number_format($c->total_contacts) }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('campaigns.show', $c->id) }}" class="relative z-10 w-fit inline-flex items-center gap-2 px-3 py-2 bg-white/5 hover:bg-zinc-800 border border-white/10 hover:border-primary-500/50 rounded-lg text-xs font-semibold text-zinc-300 hover:text-white transition-all cursor-pointer group/btn">
                                    <span>Detalles</span>
                                    <svg class="w-3 h-3 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-24 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-zinc-900 border border-zinc-800 mb-4">
                                    <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                </div>
                                <h3 class="text-white font-bold text-lg mb-1">Sin Campañas</h3>
                                <p class="text-zinc-500 mb-6 text-sm">Aún no has creado ninguna campaña de email.</p>
                                <a href="{{ route('campaigns.create') }}" class="inline-flex items-center text-primary-400 hover:text-primary-300 text-sm font-bold hover:underline">
                                    Crear primera campaña &rarr;
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
