<x-app-layout>
    @section('title', 'Data Jamaah')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jamaah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                <form method="GET" action="{{ route('admin.pilgrims.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cari Jamaah</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="Nama, Paspor, atau No. Porsi...">
                            </div>
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Filter Agen</label>
                            <select name="agent_id"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="all">Semua Agen</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ request('agent_id') == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-4 flex items-end gap-2">
                            <div class="flex-grow">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                                <select name="sort"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru
                                        Bergabung</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama
                                        Bergabung</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama
                                        (A-Z)</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                        Nama (Z-A)</option>
                                </select>
                            </div>

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-md shadow-sm transition"
                                title="Terapkan Filter">
                                <i class="fa-solid fa-filter"></i>
                            </button>

                            <a href="{{ route('admin.pilgrims.index') }}"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-2.5 rounded-md transition"
                                title="Reset Filter">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">

                <div class="px-5 pt-5">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-lg font-bold text-gray-800">
                                Daftar Jamaah
                                <span class="text-sm font-normal text-gray-500">
                                    (Total: {{ $pilgrims->total() }})
                                </span>
                            </h3>

                            <div id="bulk-action-container" class="hidden relative">
                                <button id="bulk-action-btn" type="button"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 text-white text-xs font-semibold uppercase rounded-md hover:bg-gray-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    <i class="fa-solid fa-list-check"></i>
                                    Aksi Terpilih (<span id="selected-count">0</span>)
                                    <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
                                </button>

                                <div id="bulk-dropdown-menu"
                                    class="hidden absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="py-1" role="menu" aria-orientation="vertical">
                                        <button type="button" onclick="submitBulkAction('print')"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                                            <i class="fa-solid fa-print text-emerald-600 w-5"></i>
                                            Cetak Kartu
                                        </button>

                                        <button type="button" onclick="confirmBulkDelete()"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                            <i class="fa-solid fa-trash-can w-5"></i>
                                            Hapus Permanen
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('admin.pilgrims.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition shadow-sm">
                            <i class="fa-solid fa-user-plus mr-2"></i>
                            Tambah Data
                        </a>
                    </div>
                </div>

                <form id="bulk-form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="form-method" value="POST">

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 w-10">
                                        <input type="checkbox" id="select-all"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Jamaah
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Info Porsi & Paspor
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Hotel
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pilgrims as $pilgrim)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-4">
                                            <input type="checkbox" name="selected_pilgrims[]"
                                                value="{{ $pilgrim->id }}"
                                                class="select-item rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-full object-cover border border-gray-200"
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

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-mono">
                                                {{ $pilgrim->umrah_id }}
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                Paspor: <span
                                                    class="font-medium">{{ $pilgrim->passport_number }}</span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($pilgrim->hotel_madinah_name || $pilgrim->hotel_makkah_name)
                                                <div class="space-y-1">
                                                    @if ($pilgrim->hotel_madinah_name)
                                                        <div class="text-xs flex items-center text-gray-600">
                                                            <span
                                                                class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>
                                                            {{ Str::limit($pilgrim->hotel_madinah_name, 20) }}
                                                        </div>
                                                    @endif
                                                    @if ($pilgrim->hotel_makkah_name)
                                                        <div class="text-xs flex items-center text-gray-600">
                                                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                                            {{ Str::limit($pilgrim->hotel_makkah_name, 20) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-400 italic">Data hotel kosong</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-center text-sm font-medium">
                                            <div class="flex justify-center gap-3">
                                                <a href="{{ route('admin.pilgrims.show', $pilgrim) }}"
                                                    class="text-gray-500 hover:text-gray-800" title="Detail">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.pilgrims.edit', $pilgrim) }}"
                                                    class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ route('admin.pilgrims.print', $pilgrim) }}"
                                                    target="_blank" class="text-emerald-600 hover:text-emerald-900"
                                                    title="Print">
                                                    <i class="fa-solid fa-print"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-500">
                                                <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                                <p>Belum ada data jamaah.</p>
                                            </div>
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
                const bulkActionContainer = document.getElementById('bulk-action-container');
                const bulkBtn = document.getElementById('bulk-action-btn');
                const bulkMenu = document.getElementById('bulk-dropdown-menu');
                const selectedCountSpan = document.getElementById('selected-count');
                const bulkForm = document.getElementById('bulk-form');
                const formMethod = document.getElementById('form-method');

                function updateBulkUI() {
                    const checkedCount = document.querySelectorAll('.select-item:checked').length;

                    if (checkedCount > 0) {
                        bulkActionContainer.classList.remove('hidden');
                        selectedCountSpan.textContent = checkedCount;
                    } else {
                        bulkActionContainer.classList.add('hidden');
                        bulkMenu.classList.add('hidden');
                    }
                }

                selectAll.addEventListener('change', () => {
                    items.forEach(i => i.checked = selectAll.checked);
                    updateBulkUI();
                });

                items.forEach(item => {
                    item.addEventListener('change', () => {
                        if (!item.checked) selectAll.checked = false;
                        updateBulkUI();
                    });
                });

                bulkBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    bulkMenu.classList.toggle('hidden');
                });

                window.addEventListener('click', () => {
                    if (!bulkMenu.classList.contains('hidden')) {
                        bulkMenu.classList.add('hidden');
                    }
                });

                window.submitBulkAction = function(actionType) {
                    if (actionType === 'print') {
                        bulkForm.action = "{{ route('admin.pilgrims.bulk-print') }}";
                        formMethod.value = "POST";
                        bulkForm.target = "_blank";
                        bulkForm.submit();
                        bulkMenu.classList.add('hidden');
                        k
                    }
                };

                window.confirmBulkDelete = function() {
                    const count = document.querySelectorAll('.select-item:checked').length;

                    Swal.fire({
                        title: 'Anda yakin?',
                        text: `Akan menghapus ${count} data jamaah terpilih. Data yang dihapus tidak dapat dikembalikan!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            bulkForm.action = "{{ route('admin.pilgrims.bulk-destroy') }}";
                            formMethod.value = "DELETE";
                            bulkForm.target = "_self";
                            bulkForm.submit();
                        }
                    });
                };
            });
        </script>
    @endpush
</x-app-layout>
