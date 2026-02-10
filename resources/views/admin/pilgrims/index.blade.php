<x-app-layout>
    @section('title', 'Data Jamaah')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jamaah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">

                {{-- HEADER --}}
                <div class="px-5 pt-5">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-lg font-bold text-gray-800">
                                Daftar Jamaah
                                <span class="text-sm font-normal text-gray-500">
                                    (Total: {{ $pilgrims->total() }})
                                </span>
                            </h3>

                            <button type="submit" form="bulk-print-form" id="btn-bulk-print"
                                class="hidden items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-xs font-semibold uppercase rounded-md hover:bg-emerald-700 transition">
                                <i class="fa-solid fa-print"></i>
                                Cetak Kartu Terpilih
                            </button>
                        </div>

                        <a href="{{ route('admin.pilgrims.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                            <i class="fa-solid fa-user-plus mr-2"></i>
                            Tambah Data
                        </a>
                    </div>
                </div>

                {{-- TABLE --}}
                <form id="bulk-print-form" action="{{ route('admin.pilgrims.bulk-print') }}" method="POST"
                    target="_blank">
                    @csrf

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3">
                                        <input type="checkbox" id="select-all"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Nama Jamaah
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Info Porsi & Paspor
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Hotel
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pilgrims as $pilgrim)
                                    <tr class="hover:bg-gray-50 transition">

                                        {{-- CHECKBOX --}}
                                        <td class="px-4 py-4">
                                            <input type="checkbox" name="selected_pilgrims[]"
                                                value="{{ $pilgrim->id }}"
                                                class="select-item rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        </td>

                                        {{-- NAMA --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                        src="{{ $pilgrim->photo_path
                                                            ? asset('storage/' . $pilgrim->photo_path)
                                                            : 'https://ui-avatars.com/api/?name=' . urlencode($pilgrim->name) }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $pilgrim->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $pilgrim->agent->name ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- PASPOR --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                Porsi: {{ $pilgrim->umrah_id }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Paspor: {{ $pilgrim->passport_number }}
                                            </div>
                                        </td>

                                        {{-- HOTEL --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($pilgrim->hotel_madinah_name || $pilgrim->hotel_makkah_name)
                                                <div class="space-y-2">
                                                    @if ($pilgrim->hotel_madinah_name)
                                                        <div class="text-sm">
                                                            <span
                                                                class="inline-block w-2 h-2 bg-emerald-500 rounded-full mr-1"></span>
                                                            {{ $pilgrim->hotel_madinah_name }}
                                                        </div>
                                                    @endif
                                                    @if ($pilgrim->hotel_makkah_name)
                                                        <div class="text-sm">
                                                            <span
                                                                class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-1"></span>
                                                            {{ $pilgrim->hotel_makkah_name }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-400 italic">
                                                    Data hotel belum diisi
                                                </span>
                                            @endif
                                        </td>

                                        {{-- AKSI --}}
                                        <td class="px-6 py-4 text-center text-sm font-medium">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('admin.pilgrims.show', $pilgrim) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    Detail
                                                </a>
                                                <span class="text-gray-300">|</span>
                                                <a href="{{ route('admin.pilgrims.print', $pilgrim) }}" target="_blank"
                                                    class="text-emerald-600 hover:text-emerald-900">
                                                    Print
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                            Belum ada data jamaah.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $pilgrims->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const selectAll = document.getElementById('select-all');
                const items = document.querySelectorAll('.select-item');
                const btnPrint = document.getElementById('btn-bulk-print');

                function toggleButton() {
                    const checked = document.querySelectorAll('.select-item:checked');
                    btnPrint.classList.toggle('hidden', checked.length === 0);
                    btnPrint.classList.toggle('flex', checked.length > 0);
                }

                selectAll.addEventListener('change', () => {
                    items.forEach(i => i.checked = selectAll.checked);
                    toggleButton();
                });

                items.forEach(item => {
                    item.addEventListener('change', () => {
                        if (!item.checked) selectAll.checked = false;
                        toggleButton();
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
