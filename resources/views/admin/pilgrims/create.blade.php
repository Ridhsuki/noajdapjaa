<x-app-layout>
    @section('title', 'Tambah Jamaah')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Data Jamaah Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.pilgrims.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <x-input-label for="photo" :value="__('Foto Jamaah')" />
                            <input id="photo" name="photo" type="file"
                                class="block w-full text-sm text-gray-500 mt-1
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-emerald-50 file:text-emerald-700
                                hover:file:bg-emerald-100
                                border border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500" />
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Maks: 2MB.</p>
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="name" :value="__('Nama Lengkap (Sesuai Paspor)')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="agent_id" :value="__('Agen Travel (PPIU)')" />

                            <select id="agent_id" name="agent_id" required
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="" disabled selected>-- Pilih Agent Travel --</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>


                            <x-input-error :messages="$errors->get('agent_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="umrah_id" :value="__('Nomor Porsi / ID Umrah')" />
                            <x-text-input id="umrah_id" class="block mt-1 w-full" type="text" name="umrah_id"
                                :value="old('umrah_id')" required />
                            <x-input-error :messages="$errors->get('umrah_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="passport_number" :value="__('Nomor Paspor')" />
                            <x-text-input id="passport_number" class="block mt-1 w-full" type="text"
                                name="passport_number" :value="old('passport_number')" required />
                            <x-input-error :messages="$errors->get('passport_number')" class="mt-2" />
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-bold text-emerald-700 uppercase">Madinah</h4>
                                <span class="text-[10px] text-gray-400 uppercase">Opsional</span>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="hotel_madinah_name" :value="__('Nama Hotel')" />
                                    <x-text-input id="hotel_madinah_name" name="hotel_madinah_name" type="text"
                                        class="mt-1 block w-full" :value="old('hotel_madinah_name')" />
                                    <x-input-error :messages="$errors->get('hotel_madinah_name')" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="hotel_madinah_check_in" :value="__('Check In')" />
                                        <x-text-input id="hotel_madinah_check_in" name="hotel_madinah_check_in"
                                            type="date" class="mt-1 block w-full" :value="old('hotel_madinah_check_in')" />
                                        <x-input-error :messages="$errors->get('hotel_madinah_check_in')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="hotel_madinah_check_out" :value="__('Check Out')" />
                                        <x-text-input id="hotel_madinah_check_out" name="hotel_madinah_check_out"
                                            type="date" class="mt-1 block w-full" :value="old('hotel_madinah_check_out')" />
                                        <x-input-error :messages="$errors->get('hotel_madinah_check_out')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-bold text-blue-700 uppercase">Makkah</h4>
                                <span class="text-[10px] text-gray-400 uppercase">Opsional</span>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="hotel_makkah_name" :value="__('Nama Hotel')" />
                                    <x-text-input id="hotel_makkah_name" name="hotel_makkah_name" type="text"
                                        class="mt-1 block w-full" :value="old('hotel_makkah_name')" />
                                    <x-input-error :messages="$errors->get('hotel_makkah_name')" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="hotel_makkah_check_in" :value="__('Check In')" />
                                        <x-text-input id="hotel_makkah_check_in" name="hotel_makkah_check_in"
                                            type="date" class="mt-1 block w-full" :value="old('hotel_makkah_check_in')" />
                                        <x-input-error :messages="$errors->get('hotel_makkah_check_in')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="hotel_makkah_check_out" :value="__('Check Out')" />
                                        <x-text-input id="hotel_makkah_check_out" name="hotel_makkah_check_out"
                                            type="date" class="mt-1 block w-full" :value="old('hotel_makkah_check_out')" />
                                        <x-input-error :messages="$errors->get('hotel_makkah_check_out')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            {{ __('Batal') }}
                        </x-secondary-button>

                        <x-primary-button
                            class="bg-emerald-600 hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900">
                            {{ __('Simpan Data') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
