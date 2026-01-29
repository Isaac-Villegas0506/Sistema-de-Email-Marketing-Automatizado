<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EmailFlow | Sistema de Email Marketing Automatizado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 400: '#22d3ee', 500: '#06b6d4', 600: '#0891b2' },
                        accent: { 400: '#4ade80', 500: '#22c55e', 600: '#16a34a' }
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        @keyframes glow { 0%, 100% { box-shadow: 0 0 30px rgba(6, 182, 212, 0.4); } 50% { box-shadow: 0 0 60px rgba(6, 182, 212, 0.6); } }
        @keyframes gradient-shift { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
        .animate-float { animation: float 4s ease-in-out infinite; }
        .animate-glow { animation: glow 3s ease-in-out infinite; }
        .animate-gradient { background-size: 200% 200%; animation: gradient-shift 4s ease infinite; }
        .text-gradient { background: linear-gradient(135deg, #06b6d4, #22c55e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .bg-grid { background-image: linear-gradient(rgba(6,182,212,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(6,182,212,0.03) 1px, transparent 1px); background-size: 60px 60px; }
        .card-glow:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -15px rgba(6,182,212,0.3); }
    </style>
</head>
<body class="bg-[#09090b] text-white antialiased overflow-x-hidden bg-grid">
    
    <div class="fixed top-0 left-1/4 w-[500px] h-[500px] bg-primary-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="fixed bottom-0 right-1/4 w-[400px] h-[400px] bg-accent-500/10 rounded-full blur-[100px] pointer-events-none"></div>

    <nav class="fixed w-full z-50 bg-[#09090b]/80 backdrop-blur-xl border-b border-zinc-800/50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center shadow-lg shadow-primary-500/30 animate-float">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6Z" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 6L12 13L2 6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="font-bold text-lg text-gradient">EmailFlow</span>
                </div>
                <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary-500 to-accent-500 text-white font-medium text-sm shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 transition-all hover:scale-105 flex items-center gap-2">
                    Acceder al Panel
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-24 lg:pt-44 lg:pb-32">
        <div class="max-w-4xl mx-auto px-4 text-center relative">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-zinc-800/50 border border-zinc-700/50 mb-8 backdrop-blur">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-accent-500"></span>
                </span>
                <span class="text-xs font-medium text-zinc-300 uppercase tracking-wider">Sistema Operativo v1.0</span>
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6">
                Email Marketing<br/>
                <span class="text-gradient">Automatizado y Potente</span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-lg text-zinc-400 leading-relaxed mb-10">
                Plataforma desarrollada con Laravel y Python para gestionar campañas masivas, colas de alto rendimiento y métricas en tiempo real.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-primary-500 to-accent-500 text-white font-semibold shadow-lg shadow-primary-500/25 hover:shadow-primary-500/50 transition-all hover:scale-105 animate-glow">
                    Explorar Dashboard
                </a>
                <a href="#features" class="px-8 py-4 rounded-xl bg-zinc-800/50 border border-zinc-700/50 text-white font-medium hover:bg-zinc-800 hover:border-zinc-600 transition-all backdrop-blur">
                    Ver Caracteristicas
                </a>
            </div>

            <div class="mt-20 relative">
                <div class="absolute inset-0 bg-gradient-to-t from-[#09090b] via-transparent to-transparent z-10 pointer-events-none"></div>
                <div class="rounded-2xl border border-zinc-800/60 overflow-hidden shadow-2xl shadow-black/50 backdrop-blur">
                    <div class="bg-zinc-900/80 px-4 py-3 flex items-center gap-2 border-b border-zinc-800/60">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                            <div class="w-3 h-3 rounded-full bg-accent-500"></div>
                        </div>
                        <div class="flex-1 text-center"><span class="text-xs text-zinc-500">dashboard.emailflow.dev</span></div>
                    </div>
                    <img src="https://ui.aceternity.com/_next/image?url=https%3A%2F%2Fassets.aceternity.com%2Fpro%2Fdashboard-new.png&w=3840&q=75" alt="Dashboard" class="w-full opacity-80 hover:opacity-100 transition-opacity">
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-24 relative">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-white mb-4">Caracteristicas Principales</h2>
                <p class="text-zinc-400 max-w-xl mx-auto">Herramientas diseñadas para maximizar la eficiencia de tus campañas.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="card-glow bg-zinc-900/50 border border-zinc-800/60 rounded-2xl p-8 transition-all duration-300 hover:border-primary-500/30">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary-500/20 to-primary-600/10 flex items-center justify-center mb-6 border border-primary-500/20">
                        <svg class="w-7 h-7 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Alto Rendimiento</h3>
                    <p class="text-zinc-400 text-sm leading-relaxed">Procesamiento de miles de correos mediante colas asíncronas de Laravel.</p>
                </div>

                <div class="card-glow bg-zinc-900/50 border border-zinc-800/60 rounded-2xl p-8 transition-all duration-300 hover:border-accent-500/30">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-accent-500/20 to-accent-600/10 flex items-center justify-center mb-6 border border-accent-500/20">
                        <svg class="w-7 h-7 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Analiticas en Tiempo Real</h3>
                    <p class="text-zinc-400 text-sm leading-relaxed">Visualización de métricas, tasas de rebote y throughput con Chart.js.</p>
                </div>

                <div class="card-glow bg-zinc-900/50 border border-zinc-800/60 rounded-2xl p-8 transition-all duration-300 hover:border-amber-500/30">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-500/20 to-amber-600/10 flex items-center justify-center mb-6 border border-amber-500/20">
                        <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Seguridad y Escala</h3>
                    <p class="text-zinc-400 text-sm leading-relaxed">Arquitectura modular diseñada para escalar horizontalmente.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 border-t border-zinc-800/60">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <p class="text-xs font-bold text-zinc-500 uppercase tracking-widest mb-10">Stack Tecnologico</p>
            <div class="flex flex-wrap justify-center gap-12">
                <div class="flex flex-col items-center gap-3 group">
                    <div class="w-16 h-16 rounded-2xl bg-zinc-800/50 border border-zinc-700/50 flex items-center justify-center group-hover:border-[#FF2D20]/50 transition-colors">
                        <svg class="w-8 h-8 text-[#FF2D20]" viewBox="0 0 24 24" fill="currentColor"><path d="M11.4 1.187a3.004 3.004 0 0 1 1.2 0l9.53 2.923c.85.26 1.34 1.28 1.13 2.15L20.2 16.27a3 3 0 0 1-1.35 1.73L13.1 21.6a3.005 3.005 0 0 1-2.2 0l-5.75-3.6a3 3 0 0 1-1.35-1.73L.74 6.26C.53 5.39 1.02 4.37 1.87 4.11L11.4 1.19z"/></svg>
                    </div>
                    <span class="text-sm font-medium text-zinc-400">Laravel 11</span>
                </div>
                <div class="flex flex-col items-center gap-3 group">
                    <div class="w-16 h-16 rounded-2xl bg-zinc-800/50 border border-zinc-700/50 flex items-center justify-center group-hover:border-primary-500/50 transition-colors">
                        <svg class="w-8 h-8 text-primary-400" viewBox="0 0 24 24" fill="currentColor"><path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z"/></svg>
                    </div>
                    <span class="text-sm font-medium text-zinc-400">Tailwind CSS</span>
                </div>
                <div class="flex flex-col items-center gap-3 group">
                    <div class="w-16 h-16 rounded-2xl bg-zinc-800/50 border border-zinc-700/50 flex items-center justify-center group-hover:border-amber-500/50 transition-colors">
                        <svg class="w-8 h-8 text-amber-400" viewBox="0 0 24 24" fill="currentColor"><path d="M14.25.18l.9.2.73.26.59.3.45.32.34.34.25.34.16.33.1.3.04.26.02.2-.01.13V8.5l-.05.63-.13.55-.21.46-.26.38-.3.31-.33.25-.35.19-.35.14-.33.1-.3.07-.26.04-.21.02H8.77l-.69.05-.59.14-.5.22-.41.27-.33.32-.27.35-.2.36-.15.37-.1.35-.07.32-.04.27-.02.21v3.06H3.17l-.21-.03-.28-.07-.32-.12-.35-.18-.36-.26-.36-.36-.35-.46-.32-.59-.28-.73-.21-.88-.14-1.05-.05-1.23.06-1.22.16-1.04.24-.87.32-.71.36-.57.4-.44.42-.33.42-.24.4-.16.36-.1.32-.05.24-.01h.16l.06.01h8.16v-2.91l.01-.28.04-.26.08-.23.12-.19.16-.15.2-.1.25-.04h6.73z"/></svg>
                    </div>
                    <span class="text-sm font-medium text-zinc-400">Python</span>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-8 text-center border-t border-zinc-800/60">
        <p class="text-xs text-zinc-500">&copy; {{ date('Y') }} EmailFlow &middot; Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
    </footer>
</body>
</html>
