<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EmailFlow | Enterprise Email Marketing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Outfit"', 'sans-serif'],
                    },
                    colors: {
                        primary: { 50: '#ecfeff', 100: '#cffafe', 200: '#a5f3fc', 300: '#67e8f9', 400: '#22d3ee', 500: '#06b6d4', 600: '#0891b2', 700: '#0e7490', 800: '#155e75', 900: '#164e63' },
                        accent: { 50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac', 400: '#4ade80', 500: '#22c55e', 600: '#16a34a', 700: '#15803d', 800: '#166534', 900: '#14532d' },
                        dark: { 900: '#020205', 800: '#0B0B11', 700: '#15151F' }
                    },
                    animation: {
                        'blob': 'blob 10s infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #020205; color: #f4f4f5; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-grid {
            background-color: #020205;
            background-image: 
                radial-gradient(at 0% 0%, rgba(6, 182, 212, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(34, 197, 94, 0.1) 0px, transparent 50%),
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 30px 30px, 30px 30px;
        }
        .text-glow { text-shadow: 0 0 20px rgba(6, 182, 212, 0.5); }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="antialiased selection:bg-primary-500/30 selection:text-white bg-[#020205] overflow-x-hidden">

    <!-- Background Effects -->
    <div class="fixed inset-0 bg-grid -z-10 bg-fixed"></div>
    <div class="fixed top-[-20%] left-[-10%] w-[800px] h-[800px] bg-primary-600/10 rounded-full blur-[120px] animate-blob -z-10 pointer-events-none"></div>
    <div class="fixed bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-accent-600/5 rounded-full blur-[100px] animate-blob animation-delay-2000 -z-10 pointer-events-none"></div>

    <nav class="fixed top-0 w-full z-50 border-b border-white/5 bg-[#020205]/80 backdrop-blur-xl transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3 group translate-y-0 hover:translate-y-[-2px] transition-transform">
                <div class="relative w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-tr from-primary-500 to-accent-400 p-[1px]">
                    <div class="w-full h-full bg-dark-900 rounded-xl flex items-center justify-center">
                        <span class="font-display font-bold text-lg text-transparent bg-clip-text bg-gradient-to-br from-primary-400 to-accent-400">IV</span>
                    </div>
                </div>
                <span class="text-xl font-bold tracking-tight text-white font-display">EmailFlow</span>
            </div>
            
            <div class="flex items-center gap-8">
                <a href="#features" class="text-sm font-medium text-zinc-400 hover:text-white transition-colors hidden sm:block">Características</a>
                <a href="{{ route('dashboard') }}" class="group relative px-6 py-2.5 rounded-xl bg-white text-dark-900 font-bold text-sm transition-all hover:shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:scale-105 active:scale-95">
                    <span class="relative z-10">Ir al Dashboard</span>
                </a>
            </div>
        </div>
    </nav>

    <main class="relative pt-32 pb-20 lg:pt-48">
        <div class="max-w-5xl mx-auto px-6 text-center">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 mb-8 backdrop-blur-sm animate-fade-in-up hover:border-primary-500/30 transition-colors cursor-default">
                <span class="flex h-2 w-2 rounded-full bg-emerald-500 shadow-[0_0_10px_#10b981] animate-pulse"></span>
                <span class="text-xs font-semibold text-zinc-300 tracking-wide uppercase font-display">v2.0 Sistema Enterprise</span>
            </div>

            <h1 class="text-6xl sm:text-7xl lg:text-8xl font-bold tracking-tight text-white font-display mb-8 leading-[1]">
                Marketing Limitless <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 via-primary-200 to-accent-400 animate-gradient">Reinventado</span>
            </h1>

            <p class="text-lg sm:text-xl text-zinc-400 mb-12 max-w-2xl mx-auto leading-relaxed font-light">
                Arquitectura de alto rendimiento diseñada para manejar millones de correos. 
                <span class="text-zinc-200 font-medium">Colas asíncronas, métricas en tiempo real y seguridad total.</span>
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up delay-100">
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-primary-600 to-primary-500 text-white font-bold hover:shadow-[0_0_30px_-5px_rgba(6,182,212,0.5)] transition-all hover:-translate-y-1">
                    Comenzar Gratis
                </a>
                <a href="#demo" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white/5 text-white font-medium hover:bg-white/10 border border-white/10 transition-all hover:-translate-y-1 backdrop-blur-md">
                    Ver Demo en Vivo
                </a>
            </div>

            <!-- Dashboard Preview -->
            <div class="mt-24 relative group mx-auto max-w-5xl animate-float">
                <div class="absolute -inset-1 bg-gradient-to-b from-primary-500/20 via-accent-500/5 to-transparent rounded-2xl blur-2xl opacity-30 group-hover:opacity-50 transition-all duration-1000"></div>
                <div class="relative rounded-2xl border border-white/10 bg-[#0B0B11]/80 backdrop-blur-xl overflow-hidden shadow-2xl">
                    <div class="h-10 bg-white/5 border-b border-white/5 flex items-center gap-2 px-4">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-rose-500/20 border border-rose-500/50"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-500/20 border border-amber-500/50"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-500/20 border border-emerald-500/50"></div>
                        </div>
                        <div class="mx-auto bg-black/20 px-4 py-1 rounded-md text-[10px] text-zinc-500 font-mono tracking-widest border border-white/5">Localhost:8000</div>
                    </div>
                    <!-- Minimalist Mockup Image Representation -->
                    <div class="aspect-[16/9] bg-dark-900/50 relative flex items-center justify-center overflow-hidden group-hover:scale-[1.01] transition-transform duration-700">
                         <img src="https://ui.aceternity.com/_next/image?url=https%3A%2F%2Fassets.aceternity.com%2Fpro%2Fdashboard-new.png&w=3840&q=75" alt="Dashboard Preview" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition-opacity duration-500 mask-image-gradient-b">
                         <div class="absolute inset-0 bg-gradient-to-t from-[#020205] via-transparent to-transparent opacity-80"></div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <section id="features" class="py-32 border-t border-white/5 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-bold text-white font-display mb-6">Potencia bajo el capó</h2>
                <p class="text-zinc-400 max-w-2xl mx-auto text-lg">Diseñado no solo para verse bien, sino para escalar sin esfuerzo.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-3xl glass-card hover:bg-white/5 transition-all duration-500 group border border-white/5 hover:border-primary-500/30">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500/20 to-primary-600/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 border border-primary-500/10">
                        <svg class="w-7 h-7 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3 font-display">Velocidad Extrema</h3>
                    <p class="text-zinc-400 leading-relaxed">
                        Sistema impulsado por <span class="text-primary-300">colas Redis/Database</span> gestionadas asincrónicamente. Envía 10k+ correos sin bloquear la UI.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-3xl glass-card hover:bg-white/5 transition-all duration-500 group border border-white/5 hover:border-accent-500/30">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-accent-500/20 to-accent-600/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 border border-accent-500/10">
                        <svg class="w-7 h-7 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3 font-display">Métricas Real-Time</h3>
                    <p class="text-zinc-400 leading-relaxed">
                        Visualización de datos en vivo. Tasa de entrega, latencia de envío y logs detallados con actualización instantánea.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-3xl glass-card hover:bg-white/5 transition-all duration-500 group border border-white/5 hover:border-indigo-500/30">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500/20 to-indigo-600/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 border border-indigo-500/10">
                        <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3 font-display">Seguridad Robusta</h3>
                    <p class="text-zinc-400 leading-relaxed">
                        Arquitectura preparada para escalar. Protección CSRF, validación estricta y sanitización de datos en cada request.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-12 border-t border-white/5 bg-[#010103] relative z-10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3 opacity-60 hover:opacity-100 transition-opacity">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-primary-600 to-accent-500 p-[1px]">
                    <div class="w-full h-full bg-black rounded-lg flex items-center justify-center">
                        <span class="text-[10px] font-bold text-white">IV</span>
                    </div>
                </div>
                <span class="text-sm font-semibold text-zinc-300">EmailFlow System</span>
            </div>
            <p class="text-sm text-zinc-600 font-mono">
                &copy; {{ date('Y') }} Isaac Villegas. <span class="hidden sm:inline">Code with passion.</span>
            </p>
        </div>
    </footer>

</body>
</html>
