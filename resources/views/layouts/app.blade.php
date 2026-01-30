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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Outfit"', 'sans-serif'],
                    },
                    colors: {
                        primary: { 50: '#ecfeff', 100: '#cffafe', 200: '#a5f3fc', 300: '#67e8f9', 400: '#22d3ee', 500: '#06b6d4', 600: '#0891b2', 700: '#0e7490', 800: '#155e75', 900: '#164e63' },
                        accent: { 50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac', 400: '#4ade80', 500: '#22c55e', 600: '#16a34a', 700: '#15803d', 800: '#166534', 900: '#14532d' },
                        dark: { 
                            900: '#020205', 
                            800: '#0B0B11', 
                            700: '#15151F' 
                        }
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                        'slide-in': 'slideIn 0.5s ease-out forwards',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #020205; }
        
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #27272a; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #3f3f46; }
        
        .glass-nav {
            background: rgba(11, 11, 17, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .glass-header {
            background: rgba(11, 11, 17, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .nav-item-active {
            background: linear-gradient(to right, rgba(6, 182, 212, 0.1), transparent);
            border-left: 3px solid #06b6d4;
        }

        .bg-gradient-mesh {
            background-color: #020205;
            background-image: 
                radial-gradient(at 0% 0%, rgba(6, 182, 212, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(34, 197, 94, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(6, 182, 212, 0.05) 0px, transparent 50%);
        }
    </style>
</head>
<body class="bg-gradient-mesh text-white antialiased overflow-hidden">
    <div class="flex h-screen" x-data="{ sidebarOpen: false }">
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" 
             x-transition:enter="transition-opacity ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 lg:hidden" style="display: none;">
        </div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 w-72 glass-nav flex flex-col z-50 transition-transform duration-300 lg:translate-x-0 lg:relative">
            
            <div class="h-24 flex items-center px-8 border-b border-white/5">
                <div class="flex items-center gap-4">
                    
                    <div>
                        <span class="block text-xl font-bold tracking-tight text-white font-display">EmailFlow</span>
                        <p class="text-[10px] uppercase tracking-wider font-semibold text-primary-400/80">Workspace</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden ml-auto text-zinc-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <nav class="flex-1 px-4 py-8 space-y-2">
                <p class="px-4 mb-4 text-[10px] font-bold text-zinc-500 uppercase tracking-widest font-display">Menu Principal</p>
                
                <a href="{{ route('dashboard') }}" 
                   class="relative flex items-center gap-3 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-300 group {{ request()->routeIs('dashboard') ? 'bg-white/5 text-white shadow-lg shadow-black/20' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                    <div class="{{ request()->routeIs('dashboard') ? 'text-primary-400' : 'text-zinc-500 group-hover:text-zinc-300' }} transition-colors">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                         </svg>
                    </div>
                    <span>Dashboard</span>
                    @if(request()->routeIs('dashboard'))
                        <div class="absolute inset-y-0 left-0 w-1 bg-primary-400 rounded-r-full"></div>
                    @endif
                </a>
                
                <a href="{{ route('campaigns.index') }}" 
                   class="relative flex items-center gap-3 px-4 py-3.5 rounded-xl text-sm font-medium transition-all duration-300 group {{ request()->routeIs('campaigns*') ? 'bg-white/5 text-white shadow-lg shadow-black/20' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                    <div class="{{ request()->routeIs('campaigns*') ? 'text-primary-400' : 'text-zinc-500 group-hover:text-zinc-300' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </div>
                    <span>Campañas</span>
                    @if(request()->routeIs('campaigns*'))
                        <div class="absolute inset-y-0 left-0 w-1 bg-primary-400 rounded-r-full"></div>
                    @endif
                </a>
            </nav>
            
            <div class="p-4 mt-auto">
                <div class="rounded-2xl p-4 border border-white/5 bg-white/5 relative overflow-hidden group hover:border-white/10 transition-colors">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500/10 to-accent-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative flex items-center gap-3">
                         <div class="relative flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary-500 to-accent-500 p-[2px]">
                                <div class="w-full h-full rounded-full bg-dark-800 flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">IV</span>
                                </div>
                            </div>
                            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-dark-900 rounded-full"></span>
                         </div>
                         <div class="overflow-hidden">
                             <p class="text-sm font-bold text-white truncate font-display">Isaac Villegas</p>
                             <p class="text-[10px] text-zinc-400 truncate">Administrador</p>
                         </div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 overflow-auto relative">
            <!-- Background Atmospheric Effects -->
            <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
                <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-primary-600/10 rounded-full blur-[100px] animate-blob"></div>
                <div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] bg-accent-600/5 rounded-full blur-[100px] animate-blob animation-delay-2000"></div>
                <div class="absolute top-[40%] left-[30%] w-[300px] h-[300px] bg-indigo-600/5 rounded-full blur-[80px] animate-blob animation-delay-4000"></div>
            </div>

            <header class="h-20 glass-header flex items-center justify-between px-6 lg:px-10 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-zinc-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-white font-display tracking-tight">@yield('title', 'Dashboard')</h1>
                    </div>
                </div>
                
                <div class="flex items-center gap-6">
                    <!-- Notifications -->
                    <button class="relative text-zinc-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                        </svg>
                        <span class="absolute top-0.5 right-0.5 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-dark-900"></span>
                    </button>
                    
                    <div class="h-8 w-px bg-white/10"></div>
                    
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-white font-display">Visitante</p>
                            <p class="text-[11px] text-zinc-500">Modo Demo</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-600 to-primary-700 flex items-center justify-center text-sm font-bold text-white shadow-lg shadow-primary-500/20 ring-2 ring-white/10">
                            V
                        </div>
                    </div>
                </div>
            </header>
            
            <div class="relative z-10 p-6 lg:p-10 max-w-7xl mx-auto animate-fade-in">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
