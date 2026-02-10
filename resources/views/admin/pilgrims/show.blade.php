<x-app-layout>
    @section('title', 'Detail Jamaah')

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Data Jamaah') }}
            </h2>
            <a href="{{ route('admin.pilgrims.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                &larr; {{ __('Kembali ke List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="space-y-6">

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                        <div class="relative inline-block">
                            @if ($pilgrim->photo_path)
                                <img class="h-40 w-40 rounded-full object-cover shadow-lg border-4 border-emerald-50 mx-auto"
                                    loading="lazy" src="{{ asset('storage/' . $pilgrim->photo_path) }}"
                                    alt="Foto {{ $pilgrim->name }}">
                            @else
                                <img class="h-40 w-40 rounded-full object-cover shadow-lg border-4 border-gray-50 mx-auto"
                                    src="https://ui-avatars.com/api/?name={{ urlencode($pilgrim->name) }}&size=256&background=random"
                                    alt="Placeholder">
                            @endif
                        </div>

                        <h3 class="mt-4 text-xl font-bold text-gray-900 leading-tight">{{ $pilgrim->name }}</h3>
                        <p class="text-sm text-emerald-600 font-medium">{{ $pilgrim->agent->name ?? '-' }}</p>

                        @if ($pilgrim->photo_path)
                            <a href="{{ asset('storage/' . $pilgrim->photo_path) }}" target="_blank"
                                class="mt-2 inline-block text-xs text-blue-500 hover:text-blue-700 underline">
                                Lihat Foto Asli
                            </a>
                        @endif
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Digital ID Scan</h4>
                        <div class="p-2 border border-gray-200 rounded-lg bg-white shadow-sm">
                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(160)->generate($qrUrl) !!}
                        </div>
                        <div class="mt-3 text-center">
                            <span class="block text-[10px] text-gray-400 uppercase">System UUID</span>
                            <code
                                class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded">{{ substr($pilgrim->uuid, 0, 8) }}...</code>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-3">
                        <a href="{{ route('admin.pilgrims.print', $pilgrim) }}" target="_blank"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            {{ __('Cetak ID Card') }}
                        </a>

                        <a href="{{ route('admin.pilgrims.edit', $pilgrim) }}"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Edit Data') }}
                        </a>

                        <form action="{{ route('admin.pilgrims.destroy', $pilgrim) }}" method="POST"
                            class="delete-confirm">
                            @csrf
                            @method('DELETE')
                            <x-danger-button class="w-full justify-center">
                                {{ __('Hapus Data') }}
                            </x-danger-button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h3>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900">{{ $pilgrim->name }}</dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Nomor Paspor</dt>
                                    <dd
                                        class="mt-1 text-base font-mono font-semibold text-gray-900 bg-gray-50 inline-block px-2 py-1 rounded border border-gray-200">
                                        {{ $pilgrim->passport_number }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Nomor Porsi (Umrah ID)</dt>
                                    <dd class="mt-1 text-base font-mono font-semibold text-gray-900">
                                        {{ $pilgrim->umrah_id }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Travel Agent (PPIU)</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900">{{ $pilgrim->agent->name ?? '-' }}</dd>
                                </div>

                            </dl>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-emerald-50 border border-emerald-100 shadow-sm sm:rounded-lg p-5">
                            <h4 class="text-emerald-700 font-bold uppercase text-xs tracking-widest mb-3">Hotel Madinah
                            </h4>
                            <p class="text-lg font-bold text-gray-800 mb-4">{{ $pilgrim->hotel_madinah_name ?: '-' }}
                            </p>
                            <div class="flex justify-between text-sm bg-white p-3 rounded shadow-sm">
                                <div>
                                    <span class="block text-[10px] text-gray-400 uppercase">Check In</span>
                                    <span
                                        class="font-bold">{{ $pilgrim->hotel_madinah_check_in?->format('d M Y') ?: '-' }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="block text-[10px] text-gray-400 uppercase">Check Out</span>
                                    <span
                                        class="font-bold">{{ $pilgrim->hotel_madinah_check_out?->format('d M Y') ?: '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-100 shadow-sm sm:rounded-lg p-5">
                            <h4 class="text-blue-700 font-bold uppercase text-xs tracking-widest mb-3">Hotel Makkah</h4>
                            <p class="text-lg font-bold text-gray-800 mb-4">{{ $pilgrim->hotel_makkah_name ?: '-' }}
                            </p>
                            <div class="flex justify-between text-sm bg-white p-3 rounded shadow-sm">
                                <div>
                                    <span class="block text-[10px] text-gray-400 uppercase">Check In</span>
                                    <span
                                        class="font-bold">{{ $pilgrim->hotel_makkah_check_in?->format('d M Y') ?: '-' }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="block text-[10px] text-gray-400 uppercase">Check Out</span>
                                    <span
                                        class="font-bold">{{ $pilgrim->hotel_makkah_check_out?->format('d M Y') ?: '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
