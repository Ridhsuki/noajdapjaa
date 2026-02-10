<x-app-layout>
    @section('title', 'Tambah Agent Travel')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Agent Travel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.agents.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <x-input-label for="logo" :value="__('Logo Agent')" />
                            <input id="logo" name="logo" type="file"
                                class="block w-full text-sm text-gray-500 mt-1
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100
                                border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                            <p class="mt-1 text-sm text-gray-500">Format JPG/PNG, max 2MB</p>
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="name" :value="__('Nama Agent Travel')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus />
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
                            <textarea id="address" name="address" rows="3"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('address') }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-indigo-700 uppercase mb-4">
                                Data Leader
                            </h4>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="leader_name" :value="__('Nama Leader')" />
                                    <x-text-input id="leader_name" class="block mt-1 w-full" type="text"
                                        name="leader_name" :value="old('leader_name')" required />
                                    <x-input-error :messages="$errors->get('leader_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="leader_number" :value="__('Nomor HP Leader')" />
                                    <x-text-input id="leader_number" class="block mt-1 w-full" type="text"
                                        name="leader_number" :value="old('leader_number')" required />
                                    <x-input-error :messages="$errors->get('leader_number')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-emerald-700 uppercase mb-4">
                                Data Muthowwif
                            </h4>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="muthowwif_name" :value="__('Nama Muthowwif')" />
                                    <x-text-input id="muthowwif_name" class="block mt-1 w-full" type="text"
                                        name="muthowwif_name" :value="old('muthowwif_name')" required />
                                    <x-input-error :messages="$errors->get('muthowwif_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="muthowwif_number" :value="__('Nomor HP Muthowwif')" />
                                    <x-text-input id="muthowwif_number" class="block mt-1 w-full" type="text"
                                        name="muthowwif_number" :value="old('muthowwif_number')" required />
                                    <x-input-error :messages="$errors->get('muthowwif_number')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            {{ __('Batal') }}
                        </x-secondary-button>

                        <x-primary-button>
                            {{ __('Simpan Agent') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
