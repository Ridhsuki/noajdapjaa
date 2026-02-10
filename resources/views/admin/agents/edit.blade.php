<x-app-layout>
    @section('title', 'Edit Agent Travel')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Agent Travel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.agents.update', $agent) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <x-input-label for="logo" :value="__('Logo Agent')" />

                            <div class="flex items-center gap-4 mt-1">
                                @if ($agent->logo)
                                    <img src="{{ asset('storage/' . $agent->logo) }}" loading="lazy"
                                        class="h-14 w-14 rounded-full object-cover border">
                                @endif

                                <input id="logo" name="logo" type="file"
                                    class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                    border border-gray-300 rounded-md">
                            </div>

                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="name" :value="__('Nama Agent Travel')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name', $agent->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="partner_id" :value="__('Partner')" />

                            <select id="partner_id" name="partner_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Partner (Opsional) --</option>

                                @foreach ($partners as $partner)
                                    <option value="{{ $partner->id }}"
                                        {{ old('partner_id', $agent->partner_id ?? null) == $partner->id ? 'selected' : '' }}>
                                        {{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('partner_id')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="address" :value="__('Alamat Lengkap')" />
                            <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required>{{ old('address', $agent->address) }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-indigo-700 uppercase mb-4">
                                Data Leader
                            </h4>

                            <div class="space-y-4">
                                <x-text-input name="leader_name" class="w-full" :value="old('leader_name', $agent->leader_name)" required />
                                <x-text-input name="leader_number" class="w-full" :value="old('leader_number', $agent->leader_number)" required />
                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-emerald-700 uppercase mb-4">
                                Data Muthowwif
                            </h4>

                            <div class="space-y-4">
                                <x-text-input name="muthowwif_name" class="w-full" :value="old('muthowwif_name', $agent->muthowwif_name)" required />
                                <x-text-input name="muthowwif_number" class="w-full" :value="old('muthowwif_number', $agent->muthowwif_number)" required />
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end mt-6">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            Batal
                        </x-secondary-button>

                        <x-primary-button>
                            Update Agent
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
