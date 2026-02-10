<x-app-layout>
    @section('title', 'Edit Partner')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Partner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.partners.update', $partner) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- INFORMASI UTAMA --}}
                        <div class="md:col-span-2 bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-indigo-700 uppercase mb-4">
                                Informasi Utama
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Partner / Muassasah')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text"
                                        name="name" :value="old('name', $partner->name)" required />
                                </div>

                                <div>
                                    <x-input-label for="phone" :value="__('No. HP Penanggung Jawab')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text"
                                        name="phone" :value="old('phone', $partner->phone)" required />
                                </div>
                            </div>
                        </div>

                        {{-- MAKKAH --}}
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-emerald-700 uppercase mb-4">
                                Kantor Makkah
                            </h4>

                            <div class="space-y-4">
                                <textarea name="makkah_address" rows="3"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                    required>{{ old('makkah_address', $partner->makkah_address) }}</textarea>

                                <x-text-input name="makkah_phone" class="w-full"
                                    :value="old('makkah_phone', $partner->makkah_phone)" required />
                            </div>
                        </div>

                        {{-- MADINAH --}}
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-bold text-blue-700 uppercase mb-4">
                                Kantor Madinah
                            </h4>

                            <div class="space-y-4">
                                <textarea name="madinah_address" rows="3"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                    required>{{ old('madinah_address', $partner->madinah_address) }}</textarea>

                                <x-text-input name="madinah_phone" class="w-full"
                                    :value="old('madinah_phone', $partner->madinah_phone)" required />
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end mt-6">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            Batal
                        </x-secondary-button>

                        <x-primary-button>
                            Update Partner
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
