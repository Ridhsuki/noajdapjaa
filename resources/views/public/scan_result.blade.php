<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Siskopatuh - {{ $pilgrim->name }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .label-text {
            color: #4b5563;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .value-text {
            color: #000;
            font-weight: 700;
            font-size: 0.9rem;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen px-8 py-8">

    <div class="max-w-xl mx-auto bg-white shadow-[0_0_8px_rgba(0,0,0,0.15)] overflow-hidden">

        <div class="bg-[#f44336] text-white pt-4 pb-4 text-center">
            <h1 class="text-xl md:text-2xl font-bold leading-tight tracking-tight">
                Informasi dan Sertifikat<br> Vaksin Jamaah Umrah
            </h1>
            <p class="text-[12px] md:text-xs font-light italic opacity-90 mt-2">
                Umrah Pilgrim Information And Vaccine Certificates
            </p>

            <div class="mt-4 flex justify-center">
                <img src="{{ asset('assets/img/public-logo.png') }}" alt="Logo" class="h-16 w-auto object-contain">
            </div>
        </div>

        <div class="p-2 space-y-5">

            <div class="flex justify-center">
                @if ($pilgrim->photo_path)
                    <img class="w-48 h-[264px] object-cover border border-gray-200 shadow-sm"
                        src="{{ asset('storage/' . $pilgrim->photo_path) }}" alt="Foto" loading="lazy">
                @else
                    <img class="w-48 h-60 object-cover border border-gray-200 shadow-sm"
                        src="https://ui-avatars.com/api/?name={{ urlencode($pilgrim->name) }}&size=400&background=random"
                        loading="lazy" alt="Foto">
                @endif
            </div>

            <div class="flex justify-center pt-0 pb-2">
                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->margin(1)->generate(route('scan.show', $pilgrim->uuid)) !!}
            </div>

            <hr class="border-gray-300">
            <div class="space-y-0">
                <div>
                    <div class="label-text"><b>Nomor Porsi Umrah </b>(<span class="italic">Umrah ID</span>) : <span
                            class="text-black font-bold">{{ $pilgrim->umrah_id }}</span></div>
                </div>

                <div>
                    <div class="label-text"><b>Nama</b> (<span class="italic text-[0.75rem]">Name</span>) : <span
                            class="text-black font-bold uppercase">{{ $pilgrim->name }}</span></div>
                </div>

                <div>
                    <div class="label-text"><b>PPIU</b> (<span class="italic text-[0.75rem]">Travel Agent</span>) :
                        <span class="text-black font-bold uppercase">{{ $pilgrim->agent->name }}</span>
                    </div>
                </div>

                <div>
                    <div class="label-text"><b>Hotel</b> <i>(Hotel)</i> :</div>
                    <div class="mt-1 space-y-2">
                        @if ($pilgrim->hotel_makkah_name)
                            <div class="text-[0.85rem] font-bold text-black uppercase leading-tight">
                                - {{ $pilgrim->hotel_makkah_name }} MAKKAH,
                                {{ $pilgrim->hotel_makkah_check_in?->format('d/m/Y') }} -
                                {{ $pilgrim->hotel_makkah_check_out?->format('d/m/Y') }}
                            </div>
                        @endif

                        @if ($pilgrim->hotel_madinah_name)
                            <div class="text-[0.85rem] font-bold text-black uppercase leading-tight">
                                - {{ $pilgrim->hotel_madinah_name }} MADINAH,
                                {{ $pilgrim->hotel_madinah_check_in?->format('d/m/Y') }} -
                                {{ $pilgrim->hotel_madinah_check_out?->format('d/m/Y') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-center space-y-0">
                <h4 class="text-sm font-bold">Sertifikat Vaksin</h4>
                <p class="text-[11px] italic">Vaccine Certificate</p>
            </div>

            <div class="space-y-0">
                <h5 class="text-sm font-bold">Vaksin Pertama</h5>
                <p class="text-[11px] italic">First Vaccine Certificate</p>
            </div>

            <div class="flex justify-center py-4">
                <img src="https://siskopatuh.haji.go.id/web/no-image.png" alt="No Image" />
            </div>

            <div class="text-center space-y-0 mt-6">
                <h4 class="text-sm font-bold">Hasil Tes PCR</h4>
                <p class="text-[11px] italic">PCR Test Result</p>
            </div>

            <div class="space-y-0 text-sm pt-2">
                <div class="label-text"><b>Hasil </b>(<span class="italic text-[0.75rem]">Result</span>) : <span
                        class="text-black font-bold"></span></div>
                <div class="label-text"><b>Laboratorium </b>(<span class="italic text-[0.75rem]">Laboratory</span>) :
                    <span class="text-black font-bold"></span>
                </div>
                <div class="label-text"><b>Tanggal Tes </b>(<span class="italic text-[0.75rem]">Test Date</span>) :
                    <span class="text-black font-bold"></span>
                </div>
                <div class="label-text"><b>BPJS Kesehatan </b>(<span class="italic text-[0.75rem]">BPJS
                        Kesehatan</span>) : <span class="text-black font-bold"></span></div>
                <div class="label-text"><b>BPJS Segmen </b>(<span class="italic text-[0.75rem]">BPJS Segment</span>) :
                    <span class="text-black font-bold"></span>
                </div>
            </div>

            <hr class="border-gray-300 !mt-8">

            <div class="mt-12 pt-2 pb-4 border-t border-gray-100 text-center">
                <p class="text-[12px] font-medium">
                    <b>© Copyright {{ date('Y') }} Kementerian Haji dan Umrah RI</b>
                </p>
            </div>
        </div>
    </div>

</body>

</html>
