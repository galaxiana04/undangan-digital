<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-pink-600">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-sm text-gray-500">Siap membuat undangan pernikahan impianmu?</p>
                    </div>
                    <a href="{{ route('katalog') }}" class="...">
                        ✨ Buat Undangan Baru
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-bold text-gray-700 mb-4">Daftar Undangan Anda</h3>

                    @if($invitations->isEmpty())
                        <div class="text-center py-10 border-2 border-dashed border-gray-200 rounded-xl">
                            <p class="text-gray-400 text-4xl mb-2">📭</p>
                            <p class="text-gray-500">Anda belum membuat undangan apapun.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3">Pasangan</th>
                                        <th class="px-6 py-3">Link Website</th>
                                        <th class="px-6 py-3">Tanggal Acara</th>
                                        <th class="px-6 py-3">Tema</th>
                                        <th class="px-6 py-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invitations as $invitation)
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="px-6 py-4 font-bold text-gray-900">
                                                {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}
                                            </td>
                                            <td class="px-6 py-4 text-blue-600 underline">
                                                <a href="{{ url('/' . $invitation->slug) }}" target="_blank">
                                                    {{ url('/' . $invitation->slug) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($invitation->event_date)->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($invitation->preset_name == 'flower-pink')
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Gratis</span>
                                                @else
                                                    <span
                                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Premium</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center space-x-2">
                                                <a href="{{ url('/' . $invitation->slug) }}" target="_blank"
                                                    class="text-blue-600 hover:text-blue-900 font-bold border border-blue-200 px-3 py-1 rounded">
                                                    Lihat
                                                </a>
                                                <button onclick="alert('Fitur Edit segera hadir!')"
                                                    class="text-gray-400 hover:text-gray-600 font-bold border border-gray-200 px-3 py-1 rounded">
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>