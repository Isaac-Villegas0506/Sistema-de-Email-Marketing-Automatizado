<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Email Marketing Automatizado</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }
            .gradient-text {
                background: linear-gradient(to right, #60a5fa, #a855f7, #ec4899);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
    </head>
    <body class="bg-[#0f172a] text-white antialiased selection:bg-indigo-500 selection:text-white overflow-x-hidden">
        
        <!-- Background Effects -->
        <div class="fixed inset-0 -z-10">
            <div class="absolute top-0 -left-4 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Navbar -->
        <nav class="fixed w-full z-50 transition-all duration-300 bg-slate-900/50 backdrop-blur-md border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight">Email<span class="text-blue-400">Flow</span></span>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 transition-all duration-300 font-medium text-sm flex items-center gap-2 group">
                            <span>Ver Demo en Vivo</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass mb-8 animate-fade-in-up">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    <span class="text-xs font-medium text-slate-300 tracking-wide uppercase">Sistema Disponible v1.0</span>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight">
                    Marketing Automatizado <br/>
                    <span class="gradient-text">Sin Límites</span>
                </h1>
                
                <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-400 mb-10 leading-relaxed">
                    Una solución robusta construida con Laravel y Python para procesar campañas masivas, gestionar colas de alto rendimiento y visualizar métricas en tiempo real.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-semibold shadow-lg shadow-purple-500/25 transition-all duration-300 transform hover:scale-105">
                        Explorar Dashboard
                    </a>
                    <a href="#features" class="px-8 py-4 rounded-full glass hover:bg-white/5 text-white font-medium transition-all duration-300">
                        Ver Características
                    </a>
                </div>

                <!-- Dashboard Preview -->
                <div class="mt-20 relative rounded-2xl border border-white/10 shadow-2xl shadow-blue-900/20 overflow-hidden transform rotate-x-12 perspective-1000 group hover:scale-[1.01] transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-transparent to-transparent z-10"></div>
                    <img src="https://ui.aceternity.com/_next/image?url=https%3A%2F%2Fassets.aceternity.com%2Fpro%2Fdashboard-new.png&w=3840&q=75" alt="Dashboard Preview" class="w-full h-auto opacity-80 group-hover:opacity-100 transition-opacity duration-700">
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <section id="features" class="py-20 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="glass p-8 rounded-2xl hover:bg-white/5 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-xl bg-blue-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Alto Rendimiento</h3>
                        <p class="text-slate-400 leading-relaxed">Procesamiento de miles de correos mediante colas asíncronas de Laravel y validación ultra-rápida con scripts de Python.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="glass p-8 rounded-2xl hover:bg-white/5 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-xl bg-purple-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Analíticas en Tiempo Real</h3>
                        <p class="text-slate-400 leading-relaxed">Visualización instantánea de métricas de envío, tasas de rebote y throughput utilizando Chart.js y actualizaciones dinámicas.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="glass p-8 rounded-2xl hover:bg-white/5 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-xl bg-pink-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Seguridad y Escala</h3>
                        <p class="text-slate-400 leading-relaxed">Arquitectura modular diseñada para escalar horizontalmente. Validación estricta de datos y manejo de errores resiliente.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tech Stack -->
        <section class="py-20 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-widest mb-10">Tecnologías Utilizadas</p>
                <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-70 grayscale hover:grayscale-0 transition-all duration-500">
                    <!-- Laravel -->
                    <div class="flex flex-col items-center gap-2 group">
                        <svg class="w-12 h-12 text-[#FF2D20] transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="currentColor"><path d="M11.4 1.187a3.004 3.004 0 0 1 1.2 0l9.53 2.923c.85.26 1.34 1.28 1.13 2.15L20.2 16.27a3 3 0 0 1-1.35 1.73L13.1 21.6a3.005 3.005 0 0 1-2.2 0l-5.75-3.6a3 3 0 0 1-1.35-1.73L.74 6.26C.53 5.39 1.02 4.37 1.87 4.11L11.4 1.19zM6.9 8.27l10.2 3.13 1.4-6.43-8.8-2.7-2.8 6zm3.5 10.6 5.6 3.5 3.3-1.9-5-7.5-3.9 5.9z"/></svg>
                        <span class="text-sm font-medium">Laravel 10</span>
                    </div>
                    <!-- Tailwind -->
                    <div class="flex flex-col items-center gap-2 group">
                        <svg class="w-12 h-12 text-[#38B2AC] transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="currentColor"><path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z"/></svg>
                        <span class="text-sm font-medium">Tailwind CSS</span>
                    </div>
                     <!-- Python -->
                     <div class="flex flex-col items-center gap-2 group">
                        <svg class="w-12 h-12 text-[#FFD43B] transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="currentColor"><path d="M14.25.18l.9.2.73.26.59.3.45.32.34.34.25.34.16.33.1.3.04.26.02.2-.01.13V8.5l-.05.63-.13.55-.21.46-.26.38-.3.31-.33.25-.35.19-.35.14-.33.1-.3.07-.26.04-.21.02H8.77l-.69.05-.59.14-.5.22-.41.27-.33.32-.27.35-.2.36-.15.37-.1.35-.07.32-.04.27-.02.21v3.06H3.17l-.21-.03-.28-.07-.32-.12-.35-.18-.36-.26-.36-.36-.35-.46-.32-.59-.28-.73-.21-.88-.14-1.05-.05-1.23.06-1.22.16-1.04.24-.87.32-.71.36-.57.4-.44.42-.33.42-.24.4-.16.36-.1.32-.05.24-.01h.16l.06.01h8.16v-2.91l.01-.28.04-.26.08-.23.12-.19.16-.15.2-.1.25-.04h6.73l.43-.01.3.02.26.05.2.07.13.09.09.09.05.07.02.09zm-3.4 2.45v.37l.01.25.04.22.08.19.12.16.16.12.19.08.22.04.25.01h.37l.25-.01.22-.04.19-.08.16-.12.12-.16.08-.19.04-.22.01-.25v-.37l-.01-.25-.04-.22-.08-.19-.12-.16-.16-.12-.19-.08-.22-.04-.25-.01h-.37l-.25.01-.22.04-.19.08-.16.12-.12.16-.08.19-.04.22-.01.25zM12.54 12.83l.25.03.28.07.32.12.35.18.36.26.36.36.35.46.32.59.28.73.21.88.14 1.05.05 1.23-.06 1.22-.16 1.04-.24.87-.32.71-.36.57-.4.44-.42.33-.42.24-.4.16-.36.1-.32.05-.24.01h-.16l-.06-.01h-8.16v2.91l-.01.28-.04.26-.08.23-.12.19-.16.15-.2.1-.25.04H4.76l-.43.01-.3-.02-.26-.05-.2-.07-.12-.09-.09-.09-.05-.07-.02-.09z"/></svg>
                        <span class="text-sm font-medium">Python Integration</span>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-10 text-center text-slate-500 text-sm border-t border-white/5">
            <p>&copy; {{ date('Y') }} EmailFlow System using Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
        </footer>
    </body>
</html>
