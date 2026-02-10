<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak ID Card Jamaah</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            --primary-red: #CE1126;
            --primary-yellow: rgb(241, 199, 30);
            --text-black: #000000
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: #e5e7eb
        }

        @page {
            size: A4 portrait;
            margin: 0
        }

        .page {
            width: 210mm;
            height: 297mm;
            background: #fff;
            margin: 0 auto;
            padding: 10mm;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 5mm;
            page-break-after: always;
            position: relative
        }

        .card {
            border: 2px dashed #d1d5db;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            background-color: #fff;
            box-shadow: 0 0 0 1px rgb(0 0 0 / .05)
        }

        .card-front {
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
            background-image: url('{{ asset('assets/img/bg-card.png') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 100% 100%;
            background-color: #fff;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2px 10px;
            height: 50px
        }

        .logo-kemenhaj {
            height: 30px;
            width: auto;
            object-fit: contain
        }

        .siskopatuh-title {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-black);
            letter-spacing: .5px;
            text-transform: uppercase
        }

        .logo-agent {
            height: 30px;
            width: auto;
            max-width: 50px;
            object-fit: contain
        }

        .official-text-area {
            text-align: center;
            padding: 5px 4px;
            line-height: 1;
            margin-bottom: 5px
        }

        .text-indo {
            font-size: 8px;
            font-weight: 700;
            color: var(--text-black);
            text-transform: uppercase
        }

        .text-eng {
            font-size: 7px;
            font-weight: 600;
            color: var(--primary-yellow);
            font-style: italic;
            margin-bottom: 2px
        }

        .photo-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start
        }

        .pilgrim-photo {
            width: 90px;
            height: 110px;
            object-fit: cover;
            background-color: #f3f4f6
        }

        .pilgrim-name {
            font-size: 10px;
            font-weight: 800;
            color: var(--text-black);
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 1px;
            padding: 0 5px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .pilgrim-passport {
            font-size: 9px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1px
        }

        .pilgrim-id {
            padding-top: 2px;
            font-size: 7px;
            font-weight: 700;
            color: var(--text-black)
        }

        .qr-wrapper {
            margin-bottom: 1px;
            background: #fff
        }

        .card-footer {
            color: #000;
            text-align: center;
            padding: 6px 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 35px
        }

        .footer-text-indo {
            font-size: 6px;
            font-weight: 800;
            text-transform: uppercase;
            line-height: 1.2
        }

        .footer-text-eng {
            font-size: 5px;
            font-weight: 400;
            font-style: italic;
            opacity: .9
        }

        .card-back {
            padding: 14px 12px;
            height: 100%;
            background: #fff;
            display: flex;
            flex-direction: column;
            color: #000
        }

        .back-ppiu-name {
            text-align: center;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 4px
        }

        .back-address {
            text-align: center;
            font-size: 9px;
            line-height: 1.3;
            margin-bottom: 10px
        }

        .back-two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            text-align: center;
            margin-bottom: 10px
        }

        .back-label {
            font-size: 8px;
            font-weight: 500;
            margin-bottom: 2px
        }

        .back-value {
            font-size: 10px;
            font-weight: 700
        }

        .back-phone {
            font-size: 9px;
            font-weight: 500
        }

        .back-divider {
            text-align: center;
            font-size: 9px;
            font-weight: 700;
            margin: 8px 0 6px
        }

        .back-office-title {
            text-align: center;
            font-size: 10px;
            font-weight: 800;
            margin-top: auto;
            margin-bottom: 4px
        }

        .back-office-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            text-align: center
        }

        .back-office-city {
            font-size: 10px;
            font-weight: 800;
            margin-bottom: 2px
        }

        .back-office-address {
            font-size: 8px;
            line-height: 1.3
        }

        .no-print {
            text-align: center;
            margin: 20px 0
        }

        .btn-print {
            background: var(--primary-red);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 2px 4px rgb(0 0 0 / .2)
        }

        .btn-print:hover {
            background-color: #b91c1c
        }

        @media print {
            .no-print {
                display: none
            }

            body {
                background: #fff
            }

            .card {
                border: none
            }

            .card-footer {
                -webkit-print-color-adjust: exact
            }
        }
    </style>
</head>

<body>

    <div class="no-print">
        <button onclick="window.print()" class="btn-print">🖨️ Cetak ID Card (PDF)</button>
        <p style="color: #666; font-size: 13px; margin-top: 8px;">
            Gunakan kertas <b>A4</b>, Layout <b>Portrait</b>, Scale <b>100%</b>.
        </p>
    </div>

    @foreach ($pilgrims->chunk(9) as $chunk)
        {{-- HALAMAN DEPAN --}}
        <div class="page">
            @foreach ($chunk as $pilgrim)
                <div class="card">
                    <div class="card-front">

                        <div class="header-top">
                            <img src="{{ asset('assets/img/kemenhaj.png') }}" class="logo-kemenhaj"
                                onerror="this.style.display='none';">
                            <div class="siskopatuh-title">SISKOPATUH</div>

                            @if ($pilgrim->agent && $pilgrim->agent->logo)
                                <img src="{{ asset('storage/' . $pilgrim->agent->logo) }}" class="logo-agent"
                                    alt="Agent">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($pilgrim->agent->name ?? 'PPIU') }}&background=ffffff&color=111827"
                                    alt="Agent"
                                    style="
                                            width: 25px;
                                            height: 25px;
                                            border-radius: 50%;
                                            object-fit: cover;
                                            border: 1px solid #d1d5db;
                                            background-color: #ffffff;
                                            padding: 2px;
                                            box-shadow: 0 1px 2px rgba(0,0,0,0.15);
                                        ">
                            @endif
                        </div>

                        <div class="official-text-area">
                            <div class="text-indo">KEMENTERIAN HAJI DAN UMRAH REPUBLIK INDONESIA</div>
                            <div class="text-eng">MINISTRY OF HAJJ AND UMRAH</div>
                            <div class="text-indo">JEMAAH UMRAH INDONESIA</div>
                            <div class="text-eng">INDONESIAN UMRAH PILGRIMS</div>
                        </div>

                        <div class="photo-wrapper">
                            @if ($pilgrim->photo_path)
                                <img src="{{ asset('storage/' . $pilgrim->photo_path) }}" class="pilgrim-photo"
                                    alt="Foto">
                            @else
                                <div class="pilgrim-photo"
                                    style="display:flex;align-items:center;justify-content:center;color:#ccc;font-size:10px;">
                                    No Photo</div>
                            @endif

                            <div class="pilgrim-name">{{ $pilgrim->name }}</div>
                            <div class="pilgrim-passport"><i>PASSPORT:</i> {{ $pilgrim->passport_number }}</div>
                            <div class="pilgrim-id">{{ $pilgrim->umrah_id }}</div>

                            <div class="qr-wrapper">
                                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(68)->margin(0)->generate(route('scan.show', $pilgrim)) !!}
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="footer-text-indo">DIREKTORAT JENDERAL BINA PENYELENGGARAAN HAJI DAN UMRAH</div>
                            <div class="footer-text-eng">DIRECTORATE GENERAL OF HAJJ AND UMRAH MANAGEMENT</div>
                            <div style="flex:1;"></div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- HALAMAN BELAKANG --}}
        <div class="page">
            @foreach ($chunk as $pilgrim)
                <div class="card">
                    <div class="card-back">

                        <div class="back-ppiu-name">
                            {{ $pilgrim->agent->name ?? 'PPIU TRAVEL' }}
                        </div>

                        <div class="back-address">
                            {{ $pilgrim->agent->address ?? '-' }}
                        </div>

                        <div class="back-two-col">
                            <div>
                                <div class="back-label">Tour Leader</div>
                                <div class="back-value">{{ $pilgrim->agent->leader_name ?? '-' }}</div>
                                <div class="back-phone">{{ $pilgrim->agent->leader_number ?? '-' }}</div>
                            </div>

                            <div>
                                <div class="back-label">Muthawif</div>
                                <div class="back-value">{{ $pilgrim->agent->muthowwif_name ?? '-' }}</div>
                                <div class="back-phone">{{ $pilgrim->agent->muthowwif_number ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="back-two-col">
                            <div>
                                <div class="back-label">Hotel Makkah</div>
                                <div class="back-value">{{ $pilgrim->hotel_makkah_name ?? '-' }}</div>
                            </div>

                            <div>
                                <div class="back-label">Hotel Madinah</div>
                                <div class="back-value">{{ $pilgrim->hotel_madinah_name ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="back-divider">
                            {{ $pilgrim->agent->partner->name ?? 'KANTOR PERWAKILAN' }}
                        </div>
                        <div class="back-divider">
                            HP: {{ $pilgrim->agent->partner->phone ?? '-' }}
                        </div>

                        <div class="back-office-title">Kantor Perwakilan :</div>

                        <div class="back-office-grid">
                            <div>
                                <div class="back-office-city">Makkah</div>
                                <div class="back-office-address">
                                    {{ $pilgrim->agent->partner->makkah_address ?? '-' }}<br>
                                    {{ $pilgrim->agent->partner->makkah_phone ?? '' }}
                                </div>
                            </div>

                            <div>
                                <div class="back-office-city">Madinah</div>
                                <div class="back-office-address">
                                    {{ $pilgrim->agent->partner->madinah_address ?? '-' }}<br>
                                    {{ $pilgrim->agent->partner->madinah_phone ?? '' }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

</body>

</html>
