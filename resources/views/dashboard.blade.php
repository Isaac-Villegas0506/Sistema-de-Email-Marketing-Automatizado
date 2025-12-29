@extends('layouts.app')

@section('title', 'Dashboard en Tiempo Real')

@section('content')
    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 mb-8">
        <div class="glass-panel p-4 md:p-6 rounded-2xl shadow-lg relative overflow-hidden group">
            <div class="hidden md:block absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                 <svg class="w-16 h-16 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-slate-400 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-1">Emails Enviados</h3>
            <p class="text-xl md:text-3xl font-bold text-white mb-2 tracking-tight">{{ number_format($totalSent) }}</p>
            <div class="text-[10px] md:text-xs text-emerald-400 flex items-center bg-emerald-400/10 w-fit px-2 py-1 rounded-full border border-emerald-400/20">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-400 mr-2"></span> Total
            </div>
        </div>

        <div class="glass-panel p-4 md:p-6 rounded-2xl shadow-lg relative overflow-hidden group">
             <div class="hidden md:block absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                 <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-slate-400 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-1">En Cola</h3>
            <p class="text-xl md:text-3xl font-bold text-white mb-2 tracking-tight">{{ number_format($queued) }}</p>
            <div class="text-[10px] md:text-xs text-blue-400 flex items-center bg-blue-400/10 w-fit px-2 py-1 rounded-full border border-blue-400/20">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-blue-400 mr-2 animate-pulse"></span> Procesando
            </div>
        </div>

        <div class="glass-panel p-4 md:p-6 rounded-2xl shadow-lg relative overflow-hidden group">
             <div class="hidden md:block absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                 <svg class="w-16 h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h3 class="text-slate-400 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-1">Throughput (RPM)</h3>
            <p class="text-xl md:text-3xl font-bold text-white mb-2 tracking-tight">{{ number_format($throughput) }}</p>
            <div class="text-[10px] md:text-xs text-purple-400 flex items-center bg-purple-400/10 w-fit px-2 py-1 rounded-full border border-purple-400/20">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Emails/min
            </div>
        </div>

        <div class="glass-panel p-4 md:p-6 rounded-2xl shadow-lg relative overflow-hidden group">
             <div class="hidden md:block absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                 <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-slate-400 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-1">Tasa de Fallo</h3>
            <p class="text-xl md:text-3xl font-bold text-white mb-2 tracking-tight">
                @if($totalSent + $totalFailed > 0)
                    {{ number_format(($totalFailed / ($totalSent + $totalFailed)) * 100, 1) }}%
                @else
                    0%
                @endif
            </p>
             <div class="text-[10px] md:text-xs text-pink-400 flex items-center bg-pink-400/10 w-fit px-2 py-1 rounded-full border border-pink-400/20">
                {{ number_format($totalFailed) }} errores
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Live Chart -->
        <div class="glass-panel p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-lg font-semibold text-white">Métricas de Envío (Simulado)</h4>
                <div class="px-3 py-1 rounded-full bg-white/5 text-xs font-medium text-slate-400 border border-white/5">Últimos 5 min</div>
            </div>
            <div class="relative h-64 w-full">
                <canvas id="throughputChart"></canvas>
            </div>
            <p class="text-xs text-slate-500 mt-4 text-center">Datos actualizados en tiempo real al recargar la página.</p>
        </div>

        <!-- Recent Activity -->
        <div class="glass-panel p-6 rounded-2xl shadow-lg">
             <div class="flex items-center justify-between mb-6">
                <h4 class="text-lg font-semibold text-white">Actividad en Vivo</h4>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs text-emerald-400 font-medium">Live Stream</span>
                </div>
            </div>
            
            <div class="space-y-3 max-h-[300px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent">
                @foreach($logs as $log)
                    <div class="flex items-center justify-between p-4 bg-slate-800/40 rounded-xl border border-white/5 hover:bg-slate-800/60 transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $log->status == 'sent' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-red-500/10 text-red-400' }}">
                                @if($log->status == 'sent')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-200 group-hover:text-white transition-colors">{{ $log->email }}</p>
                                <p class="text-xs text-slate-500">{{ $log->campaign->name }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                             <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $log->status == 'sent' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                {{ $log->status == 'sent' ? 'Enviado' : 'Fallido' }}
                            </span>
                            <p class="text-[10px] text-slate-600 mt-1 font-mono">{{ $log->latency_ms }}ms</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('throughputChart').getContext('2d');
        
        // Gradient for the chart
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.5)'); // Indigo
        gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['5m', '4m', '3m', '2m', '1m', 'Ahora'],
                datasets: [{
                    label: 'Emails procesados',
                    data: [12, 19, 3, 5, 2, 3], 
                    borderColor: '#818cf8',
                    borderWidth: 2,
                    pointBackgroundColor: '#818cf8',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#818cf8',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: gradient
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleColor: '#fff',
                        bodyColor: '#cbd5e1',
                        borderColor: 'rgba(255,255,255,0.1)',
                        borderWidth: 1,
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        ticks: { color: '#64748b' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#64748b' }
                    }
                }
            }
        });
    </script>
@endsection
