<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Email Masivo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
         .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .card-gradient {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95));
        }
    </style>
</head>
<body class="bg-[#0f172a] text-white font-sans antialiased selection:bg-indigo-500 selection:text-white">
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-40 md:hidden" style="display: none;"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 w-72 glass-panel border-r-0 border-r border-white/5 flex flex-col z-50 shadow-2xl transition-transform duration-300 md:translate-x-0 md:relative md:flex bg-slate-900 md:bg-transparent">
            <div class="p-8 flex items-center justify-between gap-3">
                 <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h1 class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">EmailFlow</h1>
                 </div>
                 <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                 </button>
            </div>
            
            <nav class="flex-1 px-4 space-y-2 mt-4">
                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">MENU PRINCIPAL</p>
                <a href="{{ route('dashboard') }}" class="group flex items-center px-4 py-3.5 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30 shadow-lg shadow-indigo-500/10' : 'hover:bg-white/5 text-slate-400 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="font-medium">Panel de Control</span>
                </a>
                
                <a href="{{ route('campaigns.index') }}" class="group flex items-center px-4 py-3.5 rounded-xl transition-all duration-300 {{ request()->routeIs('campaigns*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'hover:bg-white/5 text-slate-400 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('campaigns*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span class="font-medium">Campañas</span>
                </a>
            </nav>

             <div class="p-6">
                <div class="bg-gradient-to-br from-indigo-900/40 to-purple-900/40 rounded-2xl p-4 border border-indigo-500/10 shadow-inner">
                    <h4 class="text-sm font-semibold text-white mb-1">Status del Sistema</h4>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-xs text-emerald-400 font-medium tracking-wide">Servicios Online</span>
                    </div>
                </div>
            </div>
            
            <div class="p-4 border-t border-white/5">
                <p class="text-[10px] text-slate-600 text-center mb-1">v1.0.3 Stable • Proyecto Demo</p>
                <p class="text-xs text-indigo-400 text-center font-bold tracking-wider">Isaac Villegas Dev</p>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto relative bg-gradient-to-br from-[#0f172a] to-[#1e1b4b]">
            <header class="h-20 md:bg-transparent flex items-center justify-between px-4 md:px-8 sticky top-0 z-10 glass-panel md:backdrop-filter-none md:border-none">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden p-2 rounded-lg text-slate-400 hover:bg-white/10 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-xl md:text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400 tracking-tight">@yield('title', 'Dashboard')</h2>
                </div>
                
                <div class="flex items-center gap-2 md:gap-4">
                     <button class="p-2 rounded-full hover:bg-white/5 text-slate-400 hover:text-white transition-colors relative">
                        <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500 border-2 border-[#0f172a]"></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                     </button>
                     
                     <div class="flex items-center gap-3 pl-4 border-l border-white/10">
                         <div class="text-right hidden sm:block">
                             <p class="text-sm font-medium text-white">Reclutador / Visitante</p>
                             <p class="text-xs text-slate-400">Acceso Demo</p>
                         </div>
                         <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-500/20 ring-2 ring-white/10">
                             R
                         </div>
                     </div>
                </div>
            </header>
            
            <div class="px-4 py-6 md:px-8">
                 @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
