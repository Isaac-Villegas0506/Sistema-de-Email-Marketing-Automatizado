@extends('layouts.app')

@section('title', 'Nueva Campaña')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('campaigns.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                Volver a campañas
            </a>
        </div>

        <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <!-- Columna Izquierda -->
                <div class="space-y-5">
                    <!-- Información Básica -->
                    <div class="bg-zinc-900/80 border border-zinc-800/60 rounded-2xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-primary-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-white">Informacion Basica</h3>
                                <p class="text-[10px] text-zinc-500">Nombre y contenido del email</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-1.5">Nombre de la Campaña</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="campaign-name"
                                    class="w-full bg-zinc-800/50 border border-zinc-700/50 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-500 focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500/50 focus:outline-none transition-all" 
                                    placeholder="Ej: Boletin Enero 2026" 
                                    required
                                    autocomplete="off">
                            </div>
                            
                            <div>
                                <label class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-1.5">Contenido del Email</label>
                                <textarea 
                                    name="content" 
                                    id="email-content" 
                                    rows="4" 
                                    class="w-full bg-zinc-800/50 border border-zinc-700/50 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-500 focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500/50 focus:outline-none transition-all resize-none" 
                                    placeholder="Escribe tu mensaje aqui..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Variables Dinámicas -->
                    <div class="bg-zinc-900/80 border border-zinc-800/60 rounded-2xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-accent-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"/></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-white">Variables Dinamicas</h3>
                                <p class="text-[10px] text-zinc-500">Click para insertar en el contenido</p>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-2">
                            <button 
                                type="button" 
                                onclick="insertVariable('{nombre}')" 
                                class="px-3 py-2 bg-zinc-800 hover:bg-zinc-700 rounded-lg text-xs font-mono text-primary-400 border border-zinc-700 hover:border-primary-500/50 transition-all flex items-center gap-2 cursor-pointer">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary-500"></span>
                                {nombre}
                            </button>
                            <button 
                                type="button" 
                                onclick="insertVariable('{email}')" 
                                class="px-3 py-2 bg-zinc-800 hover:bg-zinc-700 rounded-lg text-xs font-mono text-accent-400 border border-zinc-700 hover:border-accent-500/50 transition-all flex items-center gap-2 cursor-pointer">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent-500"></span>
                                {email}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="space-y-5">
                    <!-- Lista de Contactos -->
                    <div class="bg-zinc-900/80 border border-zinc-800/60 rounded-2xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-white">Lista de Contactos</h3>
                                <p class="text-[10px] text-zinc-500">Sube tu archivo CSV</p>
                            </div>
                        </div>
                        
                        <div class="border-2 border-dashed border-zinc-700 rounded-xl p-5 text-center hover:border-primary-500/50 transition-all cursor-pointer relative mb-4" id="drop-zone">
                            <input 
                                type="file" 
                                name="csv_file" 
                                id="file-input" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                required 
                                accept=".csv,.txt">
                            <div id="upload-placeholder">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500/20 to-amber-600/10 flex items-center justify-center mx-auto mb-2 border border-amber-500/20">
                                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                                </div>
                                <p class="text-sm font-medium text-zinc-300">Arrastra o selecciona</p>
                                <p class="text-[10px] text-zinc-500">Formato CSV</p>
                            </div>
                            <div id="file-info" class="hidden">
                                <div class="w-10 h-10 rounded-xl bg-accent-500/15 flex items-center justify-center mx-auto mb-2 border border-accent-500/20">
                                    <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <p class="text-sm font-medium text-accent-400" id="filename-display"></p>
                            </div>
                        </div>

                        <!-- Vista previa y descarga CSV -->
                        <div class="bg-zinc-800/50 rounded-xl p-4 border border-zinc-700/50">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider">Archivo de ejemplo</p>
                                <a 
                                    href="{{ url('/demo_contacts.csv') }}" 
                                    download="contactos_ejemplo.csv" 
                                    class="inline-flex items-center gap-1.5 bg-gradient-to-r from-primary-500 to-accent-500 hover:from-primary-400 hover:to-accent-400 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-all shadow-md shadow-primary-500/20 hover:shadow-primary-500/30 z-20 relative cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                    Descargar CSV
                                </a>
                            </div>
                            <div class="bg-zinc-900 rounded-lg overflow-hidden border border-zinc-700/50">
                                <table class="w-full text-[10px]">
                                    <thead class="bg-zinc-800">
                                        <tr>
                                            <th class="px-3 py-2 text-left text-zinc-400 font-bold">email</th>
                                            <th class="px-3 py-2 text-left text-zinc-400 font-bold">nombre</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-zinc-800">
                                        <tr><td class="px-3 py-1.5 text-primary-400">carlos.garcia@email.com</td><td class="px-3 py-1.5 text-zinc-300">Carlos Garcia</td></tr>
                                        <tr><td class="px-3 py-1.5 text-primary-400">maria.lopez@correo.es</td><td class="px-3 py-1.5 text-zinc-300">Maria Lopez</td></tr>
                                        <tr><td class="px-3 py-1.5 text-primary-400">juan.martinez@gmail.com</td><td class="px-3 py-1.5 text-zinc-300">Juan Martinez</td></tr>
                                    </tbody>
                                </table>
                                <div class="px-3 py-1.5 bg-zinc-800/50 text-[10px] text-zinc-500 text-center">+ 7 contactos mas...</div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-primary-500 to-accent-500 hover:from-primary-400 hover:to-accent-400 text-white py-3.5 rounded-xl font-semibold text-sm transition-all shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                        <span>Crear y Procesar Campaña</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // File upload handling
        document.getElementById('file-input').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                document.getElementById('upload-placeholder').classList.add('hidden');
                document.getElementById('file-info').classList.remove('hidden');
                document.getElementById('filename-display').textContent = this.files[0].name;
            }
        });

        // Insert variable function
        function insertVariable(variable) {
            const textarea = document.getElementById('email-content');
            if (!textarea) {
                console.error('Textarea not found');
                return;
            }
            
            textarea.focus();
            const start = textarea.selectionStart || 0;
            const end = textarea.selectionEnd || 0;
            const text = textarea.value;
            
            textarea.value = text.substring(0, start) + variable + text.substring(end);
            const newPosition = start + variable.length;
            textarea.setSelectionRange(newPosition, newPosition);
            textarea.focus();
        }

        // Test inputs on load
        window.addEventListener('load', function() {
            console.log('Form loaded');
            console.log('Name input:', document.getElementById('campaign-name'));
            console.log('Content textarea:', document.getElementById('email-content'));
            console.log('File input:', document.getElementById('file-input'));
        });
    </script>
@endsection
