<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Biodata - {{ $pilgrim->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            -webkit-print-color-adjust: exact;
        }

        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .print-container {
                box-shadow: none !important;
                border: 1px solid #000 !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center py-8">

    <div class="w-full max-w-2xl mb-4 flex justify-between items-center px-1 no-print">
        <a href="{{ route('admin.pilgrims.index') }}" class="text-sm text-gray-600 hover:text-black">&larr; Kembali</a>
        <button onclick="window.print()"
            class="bg-black text-white px-4 py-1.5 rounded text-xs font-bold uppercase tracking-wider hover:bg-gray-800">
            Print
        </button>
    </div>

    <div class="print-container bg-white w-full max-w-2xl border border-gray-300 p-6 text-gray-900">

        <div class="border-b-2 border-black pb-2 mb-4 flex justify-between items-end">
            <div>
                <h1 class="text-xl font-bold uppercase tracking-wider leading-none">Biodata Jamaah</h1>
                <p class="text-[10px] text-gray-500 uppercase mt-1 tracking-widest">Umrah Pilgrim Data Sheet</p>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-mono text-gray-400">REF: {{ substr($pilgrim->uuid, 0, 8) }}</p>
            </div>
        </div>

        <div class="flex flex-row gap-5 items-start">

            <div class="w-32 h-40 bg-gray-50 border border-gray-200 flex-shrink-0">
                @if ($pilgrim->photo_path)
                    <img src="{{ asset('storage/' . $pilgrim->photo_path) }}"
                        class="w-full h-full object-cover grayscale print:grayscale-0">
                @else
                    <div
                        class="w-full h-full flex items-center justify-center text-gray-300 text-xs uppercase text-center p-2">
                        No Photo</div>
                @endif
            </div>

            <div class="flex-1 space-y-3">

                <div class="border-b border-gray-100 pb-1">
                    <p class="text-[9px] text-gray-500 uppercase font-semibold">Nama Lengkap / Full Name</p>
                    <p class="text-lg font-bold uppercase leading-tight">{{ $pilgrim->name }}</p>
                </div>

                <div class="grid grid-cols-2 gap-x-4 gap-y-3">

                    <div>
                        <p class="text-[9px] text-gray-500 uppercase font-semibold">No. Paspor</p>
                        <p class="text-sm font-mono font-bold">{{ $pilgrim->passport_number }}</p>
                    </div>

                    <div>
                        <p class="text-[9px] text-gray-500 uppercase font-semibold">ID Umrah / Porsi</p>
                        <p class="text-sm font-mono font-bold">{{ $pilgrim->umrah_id }}</p>
                    </div>

                    <div class="col-span-2">
                        <p class="text-[9px] text-gray-500 uppercase font-semibold">Agen Travel (PPIU)</p>
                        <p class="text-sm font-bold">{{ $pilgrim->agent->name }}</p>
                    </div>

                    <div class="mb-6 col-span-2">
                        <h3 class="font-bold text-xs mb-3 border-b-2 border-black pb-1 uppercase tracking-wide">
                            Akomodasi / Hotel Info
                        </h3>

                        <table class="w-full text-[10px] border border-gray-200 border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="py-2 px-2 text-left text-gray-500 uppercase font-semibold w-1/4">
                                        Lokasi
                                    </th>
                                    <th class="py-2 px-2 text-left text-gray-500 uppercase font-semibold w-2/4">
                                        Nama Hotel
                                    </th>
                                    <th class="py-2 px-2 text-right text-gray-500 uppercase font-semibold w-1/4">
                                        Check-in / Out
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100">
                                    <td class="py-2 px-2 font-medium">Madinah</td>
                                    <td class="py-2 px-2 font-semibold uppercase">
                                        {{ $pilgrim->hotel_madinah_name ?: '-' }}
                                    </td>
                                    <td class="py-2 px-2 text-right font-mono">
                                        {{ $pilgrim->hotel_madinah_check_in?->format('d/m/y') ?? '-' }}
                                        —
                                        {{ $pilgrim->hotel_madinah_check_out?->format('d/m/y') ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-2 font-medium">Mekkah</td>
                                    <td class="py-2 px-2 font-semibold uppercase">
                                        {{ $pilgrim->hotel_makkah_name ?: '-' }}
                                    </td>
                                    <td class="py-2 px-2 text-right font-mono">
                                        {{ $pilgrim->hotel_makkah_check_in?->format('d/m/y') ?? '-' }}
                                        —
                                        {{ $pilgrim->hotel_makkah_check_out?->format('d/m/y') ?? '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="flex flex-col items-center w-24 flex-shrink-0">
                <div class="border border-gray-200 p-1 mb-1">
                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(85)->margin(0)->generate($qrUrl) !!}
                </div>
                <p class="text-[8px] text-center text-gray-400 uppercase">Scan Verifikasi</p>
            </div>

        </div>

        <div class="mt-6 pt-2 border-t border-gray-200 flex justify-between items-center text-[9px] text-gray-400">
            <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
            <p>Sistem Informasi Haji & Umrah</p>
        </div>

    </div>

</body>

</html>
