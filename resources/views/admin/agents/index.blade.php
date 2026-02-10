<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Agent Travel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                <div class="px-5 pt-5">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                        <h3 class="text-lg font-bold text-gray-800">
                            Daftar Agent
                            <span class="text-sm font-normal text-gray-500">
                                (Total: {{ $agents->total() }})
                            </span>
                        </h3>

                        <a href="{{ route('admin.agents.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Agent
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Agent
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Leader
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Muthowwif
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($agents as $agent)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                @if ($agent->logo)
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                        src="{{ asset('storage/' . $agent->logo) }}"
                                                        alt="{{ $agent->name }}" loading="lazy">
                                                @else
                                                    <img class="h-10 w-10 rounded-full object-cover bg-gray-200"
                                                        src="https://ui-avatars.com/api/?name={{ urlencode($agent->name) }}"
                                                        alt="No Logo" loading="lazy">
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $agent->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ Str::limit($agent->address, 40) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $agent->leader_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $agent->leader_number }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $agent->muthowwif_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $agent->muthowwif_number }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('admin.agents.edit', $agent) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                Edit
                                            </a>

                                            <span class="text-gray-300">|</span>

                                            <form action="{{ route('admin.agents.destroy', $agent) }}" method="POST"
                                                class="delete-confirm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        Belum ada data agent.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $agents->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
