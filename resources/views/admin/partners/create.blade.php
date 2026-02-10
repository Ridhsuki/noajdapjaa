<x-app-layout>
    @section('title', 'Tambah Partner')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Partner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.partners.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- INFORMASI UTAMA --}}
                        <div class="md:col-span-2 bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-indigo-700 uppercase mb-4">
                                Informasi Utama
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Partner / Muassasah')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name')" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="phone" :value="__('No. HP Penanggung Jawab')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                        :value="old('phone')" required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- KANTOR MAKKAH --}}
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-emerald-700 uppercase mb-4">
                                Kantor Makkah
                            </h4>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="makkah_address" :value="__('Alamat Makkah')" />
                                    <textarea id="makkah_address" name="makkah_address" rows="3"
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        required>{{ old('makkah_address') }}</textarea>
                                    <x-input-error :messages="$errors->get('makkah_address')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="makkah_phone" :value="__('Telp / HP Makkah')" />
                                    <x-text-input id="makkah_phone" class="block mt-1 w-full" type="text"
                                        name="makkah_phone" :value="old('makkah_phone')" required />
                                    <x-input-error :messages="$errors->get('makkah_phone')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- KANTOR MADINAH --}}
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-blue-700 uppercase mb-4">
                                Kantor Madinah
                            </h4>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="madinah_address" :value="__('Alamat Madinah')" />
                                    <textarea id="madinah_address" name="madinah_address" rows="3"
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('madinah_address') }}</textarea>
                                    <x-input-error :messages="$errors->get('madinah_address')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="madinah_phone" :value="__('Telp / HP Madinah')" />
                                    <x-text-input id="madinah_phone" class="block mt-1 w-full" type="text"
                                        name="madinah_phone" :value="old('madinah_phone')" required />
                                    <x-input-error :messages="$errors->get('madinah_phone')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            {{ __('Batal') }}
                        </x-secondary-button>

                        <x-primary-button>
                            {{ __('Simpan Partner') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
