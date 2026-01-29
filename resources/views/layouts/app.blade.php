<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EmailFlow | Sistema de Email Marketing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50: '#ecfeff', 100: '#cffafe', 200: '#a5f3fc', 300: '#67e8f9', 400: '#22d3ee', 500: '#06b6d4', 600: '#0891b2', 700: '#0e7490', 800: '#155e75', 900: '#164e63' },
                        accent: { 50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac', 400: '#4ade80', 500: '#22c55e', 600: '#16a34a', 700: '#15803d', 800: '#166534', 900: '#14532d' }
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
        
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #09090b; }
        ::-webkit-scrollbar-thumb { background: #27272a; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #3f3f46; }
        
        .sidebar-item {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: linear-gradient(180deg, #22d3ee, #06b6d4);
            border-radius: 0 2px 2px 0;
            transition: height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-item.active::before { height: 28px; }
        .sidebar-item:hover::before { height: 20px; }
        .sidebar-item.active { background: linear-gradient(90deg, rgba(6, 182, 212, 0.15), transparent); }
        
        .card-glow {
            position: relative;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-glow::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.3), transparent, rgba(34, 197, 94, 0.2));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .card-glow:hover::before { opacity: 1; }
        .card-glow:hover { 
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(6, 182, 212, 0.2);
        }
        
        .progress-bar {
            background: linear-gradient(90deg, #06b6d4, #22c55e);
            background-size: 200% 100%;
            animation: shimmer 2s ease-in-out infinite;
        }
        @keyframes shimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        .animate-float { animation: float 4s ease-in-out infinite; }
        
        @keyframes glow-pulse {
            0%, 100% { box-shadow: 0 0 20px rgba(6, 182, 212, 0.3); }
            50% { box-shadow: 0 0 40px rgba(6, 182, 212, 0.5); }
        }
        .animate-glow { animation: glow-pulse 3s ease-in-out infinite; }
        
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 0.5s ease-out forwards; }
        
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient-shift 4s ease infinite;
        }
        
        .logo-icon {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #22c55e 100%);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #06b6d4, #22c55e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        @keyframes growUp {
            from { height: 0; opacity: 0; }
            to { opacity: 1; }
        }
        
        .bg-grid {
            background-image: 
                linear-gradient(rgba(6, 182, 212, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(6, 182, 212, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }
    </style>
</head>
<body class="bg-[#09090b] text-white antialiased">
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <div x-show="sidebarOpen" @click="sidebarOpen = false" 
             x-transition:enter="transition-opacity ease-out duration-200" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-in duration-150" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 lg:hidden" style="display: none;">
        </div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 w-64 bg-[#0a0a0a] border-r border-zinc-800/60 flex flex-col z-50 transition-transform duration-300 lg:translate-x-0 lg:relative">
            
            <div class="h-16 px-5 flex items-center justify-between border-b border-zinc-800/60">
                <div class="flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-xl logo-icon flex items-center justify-center shadow-lg shadow-primary-500/20 group-hover:shadow-primary-500/40 transition-shadow">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-base font-bold tracking-tight text-gradient">EmailFlow</span>
                        <p class="text-[10px] text-zinc-500 -mt-0.5">Marketing Platform</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg hover:bg-zinc-800 text-zinc-400 hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <nav class="flex-1 px-3 py-6 space-y-1">
                <p class="px-3 mb-4 text-[10px] font-bold text-zinc-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-px bg-gradient-to-r from-primary-500/50 to-transparent"></span>
                    Menu
                </p>
                
                <a href="{{ route('dashboard') }}" 
                   class="sidebar-item {{ request()->routeIs('dashboard') ? 'active text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }} flex items-center gap-3 px-3 py-3 rounded-xl font-medium text-sm group">
                    <div class="w-9 h-9 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary-500/20 text-primary-400' : 'bg-zinc-800 text-zinc-400 group-hover:bg-zinc-700 group-hover:text-white' }} flex items-center justify-center transition-all">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                        </svg>
                    </div>
                    <span>Dashboard</span>
                    @if(request()->routeIs('dashboard'))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-primary-400 animate-pulse"></div>
                    @endif
                </a>
                
                <a href="{{ route('campaigns.index') }}" 
                   class="sidebar-item {{ request()->routeIs('campaigns*') ? 'active text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }} flex items-center gap-3 px-3 py-3 rounded-xl font-medium text-sm group">
                    <div class="w-9 h-9 rounded-lg {{ request()->routeIs('campaigns*') ? 'bg-primary-500/20 text-primary-400' : 'bg-zinc-800 text-zinc-400 group-hover:bg-zinc-700 group-hover:text-white' }} flex items-center justify-center transition-all">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                    </div>
                    <span>Campanas</span>
                    @if(request()->routeIs('campaigns*'))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-primary-400 animate-pulse"></div>
                    @endif
                </a>
            </nav>
            
            <div class="p-4">
                <div class="bg-gradient-to-br from-primary-900/30 to-accent-900/20 rounded-2xl p-4 border border-primary-500/10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-primary-500/10 rounded-full blur-2xl"></div>
                    <div class="relative">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-accent-500"></span>
                            </span>
                            <span class="text-xs font-semibold text-white">Sistema Activo</span>
                        </div>
                        <p class="text-[11px] text-zinc-400">Servicios operando correctamente</p>
                        <div class="mt-3 flex gap-1">
                            <div class="flex-1 h-1 rounded-full bg-accent-500/50"></div>
                            <div class="flex-1 h-1 rounded-full bg-accent-500/50"></div>
                            <div class="flex-1 h-1 rounded-full bg-accent-500/50"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="px-4 py-4 border-t border-zinc-800/60">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] text-zinc-500">v1.0.3 Stable</p>
                        <p class="text-xs font-semibold text-gradient">Isaac Villegas Dev</p>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto bg-[#09090b] bg-grid relative">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl pointer-events-none"></div>
            
            <header class="h-16 bg-[#09090b]/80 backdrop-blur-xl border-b border-zinc-800/60 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2.5 rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-lg font-bold text-white">@yield('title', 'Dashboard')</h1>
                        <p class="text-xs text-zinc-500 hidden sm:block">Gestion de email marketing</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <button class="relative p-2.5 rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-800 transition-all group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                        </svg>
                        <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
                    </button>
                    
                    <div class="h-8 w-px bg-zinc-800"></div>
                    
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-medium text-white">Visitante</p>
                            <p class="text-xs text-zinc-500">Modo Demo</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center text-sm font-bold text-white shadow-lg shadow-primary-500/20 animate-glow">
                            V
                        </div>
                    </div>
                </div>
            </header>
            
            <div class="p-4 lg:p-8 animate-fade-in-up relative">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
