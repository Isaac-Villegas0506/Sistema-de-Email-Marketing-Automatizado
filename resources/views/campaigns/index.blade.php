@extends('layouts.app')

@section('title', 'Campañas')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h3 class="text-gray-400">Administra tus campañas</h3>
        <a href="{{ route('campaigns.create') }}" class="w-full sm:w-auto bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition shadow-lg shadow-indigo-500/20 text-center">
            + Nueva Campaña
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500 text-emerald-400 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden overflow-x-auto">
        <table class="w-full text-left text-slate-300">
            <thead class="bg-slate-900/50 text-xs uppercase font-semibold text-slate-500">
                <tr>
                    <th class="px-6 py-4 whitespace-nowrap">Nombre</th>
                    <th class="px-6 py-4 whitespace-nowrap">Estado</th>
                    <th class="px-6 py-4 whitespace-nowrap min-w-[200px]">Progreso</th>
                    <th class="px-6 py-4 whitespace-nowrap">Contactos</th>
                    <th class="px-6 py-4 whitespace-nowrap">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($campaigns as $c)
                    <tr class="hover:bg-slate-750 transition">
                        <td class="px-6 py-4 font-medium text-white whitespace-nowrap">{{ $c->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-full text-xs font-bold 
                                @if($c->status == 'completed') bg-emerald-500/20 text-emerald-400
                                @elseif($c->status == 'sending') bg-blue-500/20 text-blue-400 animate-pulse
                                @elseif($c->status == 'failed') bg-red-500/20 text-red-400
                                @else bg-slate-600/20 text-slate-400 @endif">
                                {{ match($c->status) {
                                    'draft' => 'Borrador',
                                    'queued' => 'En Cola',
                                    'sending' => 'Enviando',
                                    'completed' => 'Completado',
                                    'failed' => 'Fallido',
                                    'processing_file' => 'Procesando',
                                    default => ucfirst($c->status)
                                } }}
                            </span>
                        </td>
                        <td class="px-6 py-4 min-w-[200px]">
                            <div class="w-full bg-slate-700 rounded-full h-2.5">
                                <div class="bg-indigo-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $c->total_contacts > 0 ? ($c->processed_count / $c->total_contacts) * 100 : 0 }}%"></div>
                            </div>
                            <span class="text-xs text-slate-500 mt-1 block">{{ $c->processed_count }} / {{ $c->total_contacts }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($c->total_contacts) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('campaigns.show', $c) }}" class="text-indigo-400 hover:text-indigo-300">Ver Detalles</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                            No hay campañas creadas. ¡Crea la primera!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
