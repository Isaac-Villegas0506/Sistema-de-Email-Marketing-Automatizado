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
    }" x-show="show" x-transition.duration.300ms class="mb-6 md:mb-10">
        <div class="relative bg-white/5 border border-white/10 rounded-2xl p-4 md:p-6 overflow-hidden backdrop-blur-md">
            <!-- Decorative gradient -->
            <div class="absolute -right-10 -top-10 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative flex flex-col md:flex-row gap-4 md:gap-6">
                <div class="flex items-center gap-4 md:block flex-shrink-0">
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-accent-500 p-[1px] shadow-lg shadow-primary-500/20">
                        <div class="w-full h-full bg-dark-900 rounded-2xl flex items-center justify-center">
                            <span class="font-display font-bold text-lg md:text-xl text-white">IV</span>
                        </div>
                    </div>
                    <div class="md:hidden">
                        <h3 class="text-base font-bold text-white font-display flex items-center gap-2">
                            Isaac Villegas
                            <span class="px-2 py-0.5 bg-primary-500/10 border border-primary-500/20 rounded-full text-[9px] uppercase font-bold text-primary-400 tracking-wider">Autor</span>
                        </h3>
                    </div>
                </div>
                
                <div class="flex-1">
                    <div class="hidden md:flex flex-col sm:flex-row items-center sm:items-start justify-between gap-4 mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-white font-display flex items-center gap-3">
                                Isaac Villegas Dev
                                <span class="px-2.5 py-0.5 bg-primary-500/10 border border-primary-500/20 rounded-full text-[10px] uppercase font-bold text-primary-400 tracking-wider">Autor</span>
                            </h3>
                            <p class="text-zinc-400 mt-1">Desarrollador Web Full Stack</p>
                        </div>
                        
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <a href="https://ivillegas.site/" target="_blank" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white text-black hover:bg-zinc-200 text-sm font-bold rounded-xl transition-all shadow-lg shadow-white/5">
                                <span>Ver Portafolio</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            <button @click="close()" class="p-2.5 rounded-xl hover:bg-white/10 text-zinc-400 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="bg-black/20 rounded-xl p-3 md:p-5 border border-white/5 backdrop-blur-sm">
                        <p class="text-xs md:text-base text-zinc-300 leading-relaxed mb-3">
                            <strong class="text-white">Demo de App Enterprise.</strong> Desarrollado para demostrar manejo de <span class="text-primary-300">colas asíncronas</span> y <span class="text-primary-300">tiempo real</span>.
                        </p>
                        <div class="flex md:hidden items-center gap-2 mt-3">
                             <a href="https://ivillegas.site/" target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 bg-white text-black hover:bg-zinc-200 text-xs font-bold rounded-lg transition-all">
                                <span>Portafolio</span>
                            </a>
                            <button @click="close()" class="p-2 text-zinc-400 bg-white/5 rounded-lg">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mb-6 md:mb-8">
        <!-- Card 1 -->
        <div class="relative group bg-zinc-900/40 border border-white/5 rounded-2xl p-4 md:p-6 hover:bg-white/5 transition-all duration-300 hover:-translate-y-1">
            <div class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-transparent via-primary-500/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div class="w-8 h-8 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-primary-500/10 flex items-center justify-center group-hover:bg-primary-500/20 transition-colors">
                    <svg class="w-4 h-4 md:w-6 md:h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </div>
                <span class="px-1.5 py-0.5 md:px-2.5 md:py-1 rounded-md md:rounded-lg bg-white/5 text-[9px] md:text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Total</span>
            </div>
            <div class="space-y-0.5 md:space-y-1">
                <p class="text-xl md:text-3xl font-bold text-white font-display tracking-tight">{{ number_format(\App\Models\Campaign::count()) }}</p>
                <p class="text-[10px] md:text-sm text-zinc-500 font-medium truncate">Campañas</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="relative group bg-zinc-900/40 border border-white/5 rounded-2xl p-4 md:p-6 hover:bg-white/5 transition-all duration-300 hover:-translate-y-1">
            <div class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-transparent via-emerald-500/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div class="w-8 h-8 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-emerald-500/10 flex items-center justify-center group-hover:bg-emerald-500/20 transition-colors">
                    <svg class="w-4 h-4 md:w-6 md:h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="px-1.5 py-0.5 md:px-2.5 md:py-1 rounded-md md:rounded-lg bg-emerald-500/10 text-[9px] md:text-[10px] font-bold text-emerald-400 uppercase tracking-wider">Éxito</span>
            </div>
            <div class="space-y-0.5 md:space-y-1">
                <p class="text-xl md:text-3xl font-bold text-white font-display tracking-tight">{{ number_format(\App\Models\EmailLog::where('status', 'sent')->count()) }}</p>
                <p class="text-[10px] md:text-sm text-zinc-500 font-medium truncate">Enviados</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="relative group bg-zinc-900/40 border border-white/5 rounded-2xl p-4 md:p-6 hover:bg-white/5 transition-all duration-300 hover:-translate-y-1">
            <div class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-transparent via-rose-500/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div class="w-8 h-8 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-rose-500/10 flex items-center justify-center group-hover:bg-rose-500/20 transition-colors">
                    <svg class="w-4 h-4 md:w-6 md:h-6 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                </div>
                <span class="px-1.5 py-0.5 md:px-2.5 md:py-1 rounded-md md:rounded-lg bg-rose-500/10 text-[9px] md:text-[10px] font-bold text-rose-400 uppercase tracking-wider">Error</span>
            </div>
            <div class="space-y-0.5 md:space-y-1">
                <p class="text-xl md:text-3xl font-bold text-white font-display tracking-tight">{{ number_format(\App\Models\EmailLog::where('status', 'failed')->count()) }}</p>
                <p class="text-[10px] md:text-sm text-zinc-500 font-medium truncate">Fallidos</p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="relative group bg-zinc-900/40 border border-white/5 rounded-2xl p-4 md:p-6 hover:bg-white/5 transition-all duration-300 hover:-translate-y-1">
            <div class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-transparent via-amber-500/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div class="w-8 h-8 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-amber-500/10 flex items-center justify-center group-hover:bg-amber-500/20 transition-colors">
                    <svg class="w-4 h-4 md:w-6 md:h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                </div>
                <span class="px-1.5 py-0.5 md:px-2.5 md:py-1 rounded-md md:rounded-lg bg-amber-500/10 text-[9px] md:text-[10px] font-bold text-amber-400 uppercase tracking-wider">Speed</span>
            </div>
            <div class="space-y-0.5 md:space-y-1">
                <p class="text-xl md:text-3xl font-bold text-white font-display tracking-tight">{{ number_format(\App\Models\EmailLog::avg('latency_ms') ?? 0, 0) }}</p>
                <p class="text-[10px] md:text-sm text-zinc-500 font-medium truncate">Latencia (ms)</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Graphic -->
        <div class="lg:col-span-2 bg-zinc-900/40 border border-white/5 rounded-2xl p-6 md:p-8 backdrop-blur-sm">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-lg font-bold text-white font-display">Rendimiento de Envíos</h2>
                    <p class="text-xs text-zinc-500 mt-1">Tasa de éxito en tiempo real</p>
                </div>
                <select class="bg-black/20 border border-white/10 rounded-lg px-3 py-2 text-xs font-medium text-zinc-300 focus:outline-none focus:border-primary-500/50 transition-colors cursor-pointer hover:bg-white/5">
                    <option>Últimos 7 días</option>
                    <option>Últimas 24 horas</option>
                    <option>Último mes</option>
                </select>
            </div>
            
            <div class="relative h-72 w-full">
                <!-- Grid Lines -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-20">
                    <div class="border-t border-dashed border-zinc-500 w-full"></div>
                    <div class="border-t border-dashed border-zinc-500 w-full"></div>
                    <div class="border-t border-dashed border-zinc-500 w-full"></div>
                    <div class="border-t border-dashed border-zinc-500 w-full"></div>
                    <div class="border-t border-dashed border-zinc-500 w-full"></div>
                </div>
                
                @php
                    $values = [45, 59, 70, 81, 76, 85, 92, 87, 91, 88, 95, 98];
                    $max = 100;
                @endphp
                
                <!-- Chart SVG -->
                <svg class="absolute inset-0 w-full h-full filter drop-shadow-[0_0_10px_rgba(99,102,241,0.2)]" preserveAspectRatio="none" viewBox="0 0 100 100">
                    <defs>
                        <linearGradient id="chartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" style="stop-color:#6366f1;stop-opacity:0.4" />
                            <stop offset="100%" style="stop-color:#6366f1;stop-opacity:0" />
                        </linearGradient>
                    </defs>
                    
                    @php
                        $points = '';
                        $linePoints = '';
                        foreach($values as $i => $val) {
                            $x = ($i / (count($values) - 1)) * 100;
                            // Add padding
                            $y = 100 - (($val / $max) * 80); 
                            $linePoints .= "$x,$y ";
                            if($i == 0) $points = "0,100 ";
                            $points .= "$x,$y ";
                            if($i == count($values) - 1) $points .= "100,100";
                        }
                    @endphp
                    
                    <polygon points="{{ $points }}" fill="url(#chartGradient)" />
                    <polyline points="{{ $linePoints }}" fill="none" stroke="#6366f1" stroke-width="2" vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" />
                    
                    @foreach($values as $i => $val)
                        @php
                            $x = ($i / (count($values) - 1)) * 100;
                            $y = 100 - (($val / $max) * 80);
                        @endphp
                        <circle cx="{{ $x }}" cy="{{ $y }}" r="3" fill="#09090b" stroke="#6366f1" stroke-width="2" class="opacity-0 group-hover:opacity-100 transition-opacity duration-200" />
                    @endforeach
                </svg>

                <!-- Interactive Overlay -->
                <div class="absolute inset-0 flex items-end justify-between pointer-events-none">
                     @foreach($values as $index => $value)
                        <div class="relative group h-full w-8 pointer-events-auto flex items-end justify-center">
                            <div class="w-full h-full absolute top-0 hover:bg-white/5 transition-colors rounded-lg"></div>
                            
                            <!-- Tooltip -->
                            <div class="absolute opacity-0 group-hover:opacity-100 transition-all duration-200 bottom-full mb-2 bg-zinc-800 text-white text-[10px] font-bold py-1 px-2 rounded-md shadow-xl border border-white/10 whitespace-nowrap z-20 transform translate-y-2 group-hover:translate-y-0">
                                {{ $value }}% Success
                                <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-zinc-800 border-r border-b border-white/10 rotate-45"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="flex justify-between text-[10px] font-bold text-zinc-500 mt-6 font-mono uppercase">
                @foreach(['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'] as $month)
                    <span>{{ $month }}</span>
                @endforeach
            </div>
        </div>

        <!-- Activity Feed -->
        <div class="bg-zinc-900/40 border border-white/5 rounded-2xl p-6 backdrop-blur-sm flex flex-col h-full">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-white font-display">Actividad</h2>
                    <p class="text-xs text-zinc-500 mt-1">Logs del sistema en vivo</p>
                </div>
                <a href="{{ route('campaigns.index') }}" class="p-2 bg-white/5 hover:bg-white/10 rounded-lg text-zinc-400 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
            
            <div class="space-y-3 flex-1 overflow-y-auto pr-2 custom-scrollbar">
                @forelse(\App\Models\EmailLog::latest()->take(6)->get() as $log)
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-white/5 border border-white/5 hover:border-primary-500/30 transition-all group">
                        <div class="mt-1 w-2 h-2 rounded-full {{ $log->status == 'sent' ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.4)]' : 'bg-rose-500 shadow-[0_0_8px_rgba(244,63,94,0.4)]' }}"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-medium text-zinc-200 truncate">{{ $log->email }}</p>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-[10px] text-zinc-500">{{ $log->created_at->diffForHumans() }}</span>
                                <span class="text-[10px] font-mono {{ $log->status == 'sent' ? 'text-emerald-400' : 'text-rose-400' }}">{{ $log->latency_ms }}ms</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center h-40 text-center">
                        <div class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-xs text-zinc-500">Sin actividad reciente</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-4 pt-4 border-t border-white/5">
                <div class="flex items-center justify-between text-[10px]">
                    <span class="text-zinc-500">Estado del servicio</span>
                    <span class="flex items-center gap-1.5 text-emerald-400 font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Operacional
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
