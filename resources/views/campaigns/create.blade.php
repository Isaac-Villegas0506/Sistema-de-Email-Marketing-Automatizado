@extends('layouts.app')

@section('title', 'Nueva Campaña')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-slate-800 rounded-xl border border-slate-700 p-6 shadow-xl">
            <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nombre de la Campaña</label>
                    <input type="text" name="name" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Ej: Boletín Informativo Diciembre" required>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-medium text-slate-300">Contenido (Demo)</label>
                    </div>

                    <div class="bg-indigo-900/20 border border-indigo-500/30 rounded-lg p-4 mb-3">
                        <p class="text-sm font-semibold text-indigo-300 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Guía de Variables
                        </p>
                        <p class="text-xs text-slate-400 mb-3">
                            Usa estas "etiquetas" en tu texto y serán reemplazadas automáticamente por los datos de cada contacto del CSV.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                            <div class="flex items-center gap-2 bg-slate-900 p-2 rounded border border-slate-700">
                                <code class="text-emerald-400 font-mono font-bold">{nombre}</code>
                                <span class="text-slate-500">→ Nombre del contacto</span>
                            </div>
                            <div class="flex items-center gap-2 bg-slate-900 p-2 rounded border border-slate-700">
                                <code class="text-emerald-400 font-mono font-bold">{email}</code>
                                <span class="text-slate-500">→ Su correo electrónico</span>
                            </div>
                        </div>
                    </div>

                    <textarea name="content" rows="4" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Hola {nombre}, este es un mensaje para {email}..."></textarea>
                </div>

                <div>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 gap-4">
                        <label class="block text-sm font-medium text-slate-300">Lista de Contactos (CSV)</label>
                        
                        <a href="{{ asset('demo_contacts.csv') }}" download class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm font-bold transition flex items-center gap-2 shadow-lg shadow-emerald-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            <span>📥 Descargar CSV de Ejemplo</span>
                        </a>
                    </div>

                    <div class="border-2 border-dashed border-slate-600 rounded-lg p-4 sm:p-8 text-center hover:border-indigo-500 transition cursor-pointer relative group" id="drop-zone">
                        <input type="file" name="csv_file" id="file-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required accept=".csv,.txt">
                        <div class="text-slate-400 group-hover:text-indigo-400 transition" id="upload-placeholder">
                            <svg class="mx-auto h-12 w-12 text-slate-500 mb-3 group-hover:text-indigo-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="font-medium">Arrastra tu archivo o haz clic aquí</p>
                            <p class="text-xs text-slate-500 mt-1">Soporta .csv con columna 'email'</p>
                        </div>
                        <div id="file-info" class="hidden text-center">
                             <svg class="mx-auto h-12 w-12 text-emerald-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                             <p class="font-medium text-emerald-400" id="filename-display"></p>
                             <p class="text-xs text-slate-500 mt-1">Click para cambiar archivo</p>
                        </div>
                    </div>
                </div>

                <script>
                    const fileInput = document.getElementById('file-input');
                    const uploadPlaceholder = document.getElementById('upload-placeholder');
                    const fileInfo = document.getElementById('file-info');
                    const filenameDisplay = document.getElementById('filename-display');

                    fileInput.addEventListener('change', function(e) {
                         if (this.files && this.files[0]) {
                              uploadPlaceholder.classList.add('hidden');
                              fileInfo.classList.remove('hidden');
                              filenameDisplay.textContent = this.files[0].name;
                         }
                    });
                </script>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="w-full sm:w-auto bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium transition shadow-lg shadow-indigo-500/20 flex items-center justify-center gap-2">
                        <span>Crear y Procesar</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
