@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
    <!-- Banner Informativo Demo -->
    <div x-data="{ 
        show: !localStorage.getItem('demoBannerClosed'),
        close() {
            this.show = false;
            localStorage.setItem('demoBannerClosed', 'true');
        }
    }" x-show="show" x-transition.duration.300ms class="mb-6">
        <div class="relative bg-gradient-to-r from-zinc-900 via-zinc-800 to-zinc-900 border-2 border-primary-500/40 rounded-xl p-5 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-500/5 via-accent-500/5 to-primary-500/5"></div>
            
            <div class="relative flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                    </div>
                </div>
                
                <div class="flex-1">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div>
                            <h3 class="text-base font-bold text-white mb-1 flex items-center gap-2">
                                Proyecto de Demostración
                                <span class="px-2 py-0.5 bg-primary-500/20 border border-primary-500/40 rounded text-xs font-semibold text-primary-400">DEMO</span>
                            </h3>
                            <p class="text-xs text-zinc-400">Sistema de Email Marketing Automatizado</p>
                        </div>
                        <button @click="close()" class="flex-shrink-0 p-1.5 rounded hover:bg-zinc-700 text-zinc-400 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    
                    <div class="bg-zinc-900/60 rounded-lg p-3.5 border border-zinc-800">
                        <p class="text-sm text-zinc-300 leading-relaxed mb-2.5">
                            Este proyecto es una <strong class="text-white">demostración</strong> de un sistema más complejo que desarrollé. Requirió estudio autodidacta y me permitió aprender tecnologías nuevas.
                        </p>
                        <p class="text-sm text-zinc-300 leading-relaxed">
                            Lo incluí en mi portafolio porque representa un <strong class="text-primary-400">desafío técnico significativo</strong> que completé de manera independiente, desarrollando habilidades en <strong class="text-accent-400">Laravel, procesamiento asíncrono y gestión de datos</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">
        <div class="bg-zinc-900/80 backdrop-blur border border-zinc-800/60 rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-primary-500/10 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500/20 to-primary-600/10 flex items-center justify-center border border-primary-500/20">
                        <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                    </div>
                    <span class="text-xs text-zinc-500">Total</span>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ number_format(\App\Models\Campaign::count()) }}</p>
                <p class="text-xs text-zinc-400">Campañas Creadas</p>
            </div>
        </div>

        <div class="bg-zinc-900/80 backdrop-blur border border-zinc-800/60 rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-accent-500/10 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-accent-500/20 to-accent-600/10 flex items-center justify-center border border-accent-500/20">
                        <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="text-xs text-zinc-500">Éxito</span>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ number_format(\App\Models\EmailLog::where('status', 'sent')->count()) }}</p>
                <p class="text-xs text-zinc-400">Emails Enviados</p>
            </div>
        </div>

        <div class="bg-zinc-900/80 backdrop-blur border border-zinc-800/60 rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-rose-500/10 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500/20 to-rose-600/10 flex items-center justify-center border border-rose-500/20">
                        <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                    </div>
                    <span class="text-xs text-zinc-500">Errores</span>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ number_format(\App\Models\EmailLog::where('status', 'failed')->count()) }}</p>
                <p class="text-xs text-zinc-400">Emails Fallidos</p>
            </div>
        </div>

        <div class="bg-zinc-900/80 backdrop-blur border border-zinc-800/60 rounded-2xl p-5 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-amber-500/10 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500/20 to-amber-600/10 flex items-center justify-center border border-amber-500/20">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                    </div>
                    <span class="text-xs text-zinc-500">Promedio</span>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ number_format(\App\Models\EmailLog::avg('latency_ms') ?? 0, 0) }}</p>
                <p class="text-xs text-zinc-400">Latencia (ms)</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-zinc-900/80 border border-zinc-800/60 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-white">Rendimiento de Campañas</h2>
                <select class="bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none focus:ring-2 focus:ring-primary-500/50">
                    <option>Últimos 7 días</option>
                    <option>Últimas 24 horas</option>
                    <option>Último mes</option>
                </select>
            </div>
            
            <!-- Gráfico de área con línea -->
            <div class="relative h-64 bg-zinc-800/20 rounded-xl p-6 overflow-hidden">
                <!-- Grid de fondo -->
                <div class="absolute inset-6 flex flex-col justify-between pointer-events-none">
                    @for($i = 0; $i < 5; $i++)
                        <div class="border-t border-zinc-700/30"></div>
                    @endfor
                </div>
                
                @php
                    $values = [65, 59, 80, 81, 88, 85, 92, 87, 91, 88, 95, 90];
                    $max = max($values);
                @endphp
                
                <!-- Puntos y tooltips -->
                <div class="absolute inset-6 flex items-end justify-between">
                    @foreach($values as $index => $value)
                        <div class="group relative flex flex-col items-center" style="height: {{ ($value / $max) * 100 }}%;">
                            <!-- Línea vertical indicadora -->
                            <div class="absolute bottom-0 w-px h-full bg-gradient-to-t from-primary-500/0 to-primary-500/30 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            
                            <!-- Punto -->
                            <div class="relative z-10 w-3 h-3 rounded-full bg-accent-400 border-2 border-zinc-900 shadow-lg shadow-accent-500/50 opacity-0 group-hover:opacity-100 transition-all group-hover:scale-125 cursor-pointer"></div>
                            
                            <!-- Tooltip -->
                            <div class="absolute -top-10 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-1.5 text-xs text-white whitespace-nowrap shadow-xl pointer-events-none">
                                <div class="text-accent-400 font-bold">{{ $value }}%</div>
                                <div class="text-zinc-400 text-[10px]">Éxito</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Área rellenada con gradiente -->
                <svg class="absolute inset-6 w-auto h-auto pointer-events-none" preserveAspectRatio="none" viewBox="0 0 100 100">
                    <defs>
                        <linearGradient id="areaGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" style="stop-color:#06b6d4;stop-opacity:0.3" />
                            <stop offset="50%" style="stop-color:#22c55e;stop-opacity:0.15" />
                            <stop offset="100%" style="stop-color:#22c55e;stop-opacity:0" />
                        </linearGradient>
                    </defs>
                    
                    @php
                        $points = '';
                        $linePoints = '';
                        foreach($values as $i => $val) {
                            $x = ($i / (count($values) - 1)) * 100;
                            $y = 100 - (($val / $max) * 100);
                            $linePoints .= "$x,$y ";
                            if($i == 0) $points = "0,100 ";
                            $points .= "$x,$y ";
                            if($i == count($values) - 1) $points .= "100,100";
                        }
                    @endphp
                    
                    <!-- Área rellenada -->
                    <polygon points="{{ $points }}" fill="url(#areaGradient)" />
                    
                    <!-- Línea -->
                    <polyline points="{{ $linePoints }}" fill="none" stroke="#06b6d4" stroke-width="0.5" opacity="0.8" />
                </svg>
            </div>
            
            <!-- Etiquetas del eje X -->
            <div class="flex justify-between text-[10px] text-zinc-500 mt-3 px-6">
                @foreach(['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'] as $month)
                    <span class="flex-1 text-center">{{ $month }}</span>
                @endforeach
            </div>
            
            <div class="mt-8 pt-6 border-t border-zinc-800 grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-zinc-500 mb-1">Tasa de Éxito</p>
                    <p class="text-2xl font-bold text-white">{{ \App\Models\EmailLog::count() > 0 ? number_format((\App\Models\EmailLog::where('status', 'sent')->count() / \App\Models\EmailLog::count()) * 100, 1) : 0 }}%</p>
                </div>
                <div>
                    <p class="text-xs text-zinc-500 mb-1">Total Emails</p>
                    <p class="text-2xl font-bold text-white">{{ number_format(\App\Models\EmailLog::count()) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-zinc-900/80 border border-zinc-800/60 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-white">Actividad Reciente</h2>
                <a href="{{ route('campaigns.index') }}" class="text-xs text-primary-400 hover:text-primary-300">Ver todas</a>
            </div>
            
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @foreach(\App\Models\EmailLog::latest()->take(10)->get() as $log)
                    <div class="flex items-center justify-between p-3.5 bg-zinc-800/40 rounded-xl border border-zinc-700/30 hover:bg-zinc-800/70 hover:border-zinc-600/50 transition-all duration-300 group cursor-default">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center {{ $log->status == 'sent' ? 'bg-accent-500/15 border border-accent-500/20' : 'bg-rose-500/15 border border-rose-500/20' }}">
                                @if($log->status == 'sent')
                                    <svg class="w-4 h-4 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">{{ $log->email }}</p>
                                <p class="text-[10px] text-zinc-500 font-mono">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $log->status == 'sent' ? 'bg-accent-500/15 text-accent-400 border border-accent-500/20' : 'bg-rose-500/15 text-rose-400 border border-rose-500/20' }}">
                                {{ $log->status == 'sent' ? 'Enviado' : 'Fallido' }}
                            </span>
                            <p class="text-[10px] text-zinc-600 mt-1.5 font-mono">{{ $log->latency_ms }}ms</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
