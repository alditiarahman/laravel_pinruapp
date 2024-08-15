<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Riwayat Penilaian Ruangan By Peminjam</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }
    </style>
    <style>
        body {
            font-family: Calibri, sans-serif;
        }

        .sheet {
            padding: 5mm;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 18px;
            margin-top: 20px;
        }

        .table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            font: normal 13px Arial, sans-serif;
            width: 100%;
            margin-top: 20px;
        }

        .table thead th {
            background-color: #DDEFEF;
            border: solid 1px #DDEEEE;
            color: #336B6B;
            padding: 10px;
            text-align: center;
            text-shadow: 1px 1px 1px #fff;
        }

        .table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
            text-align: center;
            text-shadow: 1px 1px 1px #fff;
        }

        .table tbody tr {
            page-break-inside: avoid;
            /* Tambahkan ini */
        }

        .left-align {
            text-align: left;
        }
    </style>
</head>

<body>
    <section class="sheet">
        <!-- Header/Kop Surat -->
        <div class="header">

            <!-- Logo -->
            <img src="{{ public_path('images/logo-bawaslu.png') }}" alt="LOGO BAWASLU"
                style="width: 120px; height: auto; float: left;">

            <!-- Informasi Organisasi -->
            <div class="center-align">
                <h2 style="margin-top: 15px; font-size: 18px;"><b>Badan Pengawas Pemilihan Umum Provinsi Kalimantan Selatan</b>
                </h2>
                <p style="margin: 5px 0;">Jl. RE Martadinata No.3, Kertak Baru Ilir, Kec. Banjarmasin Tengah,</p>
                <p style="margin: 5px 0;">Kota Banjarmasin, Kalimantan Selatan 70231</p>
                <p style="margin: 5px 0;">Telepon: (0511) 6726 437 | Email: set.kalsel@gmail.go.id</p>
            </div>
            <!-- Clearfix untuk mengatasi float -->
            <div style="clear: both;"></div>
            <br>
            <hr style="border-top: 3px solid black; margin-top: 10px; margin-bottom: 10px;">
        </div>

        <h1 style="text-align: center;"><u>LAPORAN RIWAYAT PENILAIAN RUANGAN BERDASARKAN PEMINJAM</u></h1>

        @if ($penilaianruangan->isEmpty())
            <div class="no-data">
                <p>Data penilaian ruangan tidak tersedia.</p>
            </div>
        @else
            <p>Dengan ini melaporkan riwayat penilaian ruangan berdasarkan Nama Peminjam, dengan rincian sebagai berikut :</p>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Nama Ruangan</th>
                        <th class="text-center align-middle">Nama Peminjam</th>
                        <th class="text-center align-middle">Kebersihan</th>
                        <th class="text-center align-middle">Kenyamanan</th>
                        <th class="text-center align-middle">Kelengkapan Fasilitas</th>
                        <th class="text-center align-middle">Saran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penilaianruangan as $data)
                    <tr>
                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                        <td class="text-center align-middle">{{ $data->ruangan->nama_ruangan }}</td>
                        <td class="text-center align-middle">{{ $data->peminjam->name }}</td>
                        <td class="text-center align-middle">{{ $data->kebersihan }}</td>
                        <td class="text-center align-middle">{{ $data->kenyamanan }}</td>
                        <td class="text-center align-middle">{{ $data->kelengkapan_fasilitas }}</td>
                        <td class="text-center align-middle">{{ $data->saran }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Demikian laporan ini dibuat untuk catatan resmi terkait riwayat penilaian ruangan dan dapat digunakan sebagaimana mestinya.</p>
            <div style="margin-top: 10px;">
                <div class="center-align" style="float: right; width: 45%;">
                    <p>
                        Banjarmasin,
                        <?php
                        // Array mapping English month names to Indonesian
                        $monthNames = [
                            'January' => 'Januari',
                            'February' => 'Februari',
                            'March' => 'Maret',
                            'April' => 'April',
                            'May' => 'Mei',
                            'June' => 'Juni',
                            'July' => 'Juli',
                            'August' => 'Agustus',
                            'September' => 'September',
                            'October' => 'Oktober',
                            'November' => 'November',
                            'December' => 'Desember',
                        ];
                        // Get current date and time
                        $currentDate = date('d F Y');
                        foreach ($monthNames as $english => $indonesian) {
                            $currentDate = str_replace($english, $indonesian, $currentDate);
                        }
                        echo $currentDate;
                        ?>
                        <br>Mengetahui
                    </p>
                    <br>
                    <br>
                    <p class="center-align">
                        <b><u>Aries Mardiono, M.Sos</u></b>
                    </p>
                </div>
            </div>
        @endif
    </section>

</body>

</html>
