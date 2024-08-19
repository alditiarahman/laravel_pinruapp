<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Per Peminjam</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="{{ asset('/dist/js/normalize.min.css') }}">
    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="{{ asset('/css/paper.css') }}">

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
            padding: 15mm;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            width: 90%;
        }


        h1 {
            font-size: 18px;
            text-decoration: underline;
            margin-top: 20px;
        }

        .table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            font: normal 13px Arial, sans-serif;
            width: 90%;
            margin-top: 20px;
        }

        .table thead th {
            background-color: #DDEFEF;
            border: solid 1px #DDEEEE;
            color: #336B6B;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #fff;
        }

        .table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }
    </style>
</head>

<body class="A4 landscape">
    <section class="sheet">
        <!-- Header/Kop Surat -->
        <div class="header">
            <!-- Logo -->
            <img src="{{ asset('images/logo-Kalsel.png') }}" alt="Logo"
                style="width: 250px; height: auto; float: left; margin-right: 30px;">
            <!-- Clearfix untuk mengatasi float -->
            <div style="clear: both;"></div>
            <br>
            <hr style="border-top: 3px solid black; margin-top: 10px; margin-bottom: 10px;">
        </div>

        <h1 style="text-align: center;">LAPORAN PEMINJAMAN PER PEMINJAM</h1>
        @if ($peminjaman->isEmpty())
            <div class="no-data">
                <p>Data peminjaman tidak tersedia.</p>
            </div>
        @else
        <p>Berikut ini adalah Laporan Riwayat Peminjaman Ruangan yang telah dipinjam oleh <b><u>{{ $peminjaman[0]->peminjam->name }}</u></b> sesuai dengan prosedur yang berlaku.</p>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Nama Ruangan</th>
                        <th class="text-center align-middle">Nama Peminjam</th>
                        <th class="text-center align-middle">Tanggal Mulai</th>
                        <th class="text-center align-middle">Tanggal Selesai</th>
                        <th class="text-center align-middle">Jumlah Hari</th>
                        <th class="text-center align-middle">Verifikator</th>
                        <th class="text-center align-middle">Status</th>
                        <th class="text-center align-middle">Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($peminjaman as $data) : ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo $no; ?></td>
                        <td class="text-center align-middle"><?php echo $data->ruangan->nama_ruangan; ?></td>
                        <td class="text-center align-middle"><?php echo $data->peminjam->name; ?></td>
                        <td class="text-center align-middle"><?php echo $data->tanggal_mulai; ?></td>
                        <td class="text-center align-middle"><?php echo $data->tanggal_selesai; ?></td>
                        <td class="text-center align-middle"><?php echo $data->jumlah_hari; ?></td>
                        <td class="text-center align-middle"><?php echo $data->petugas ? $data->petugas->name : 'Belum Diverifikasi'; ?></td>
                        <td class="text-center align-middle"><?php echo $data->status; ?></td>
                        <td class="text-center align-middle"><?php echo $data->keperluan; ?></td>
                    </tr>

                    <?php $no++;
        endforeach; ?>
                </tbody>
            </table>
            <p>Laporan ini dibuat sebagai catatan riwayat peminjaman ruangan dan dapat digunakan sebagaimana mestinya.</p>
            </div>
        @endif
        <div style="margin-top: 10px;">
            <div style="float: right; width: 40%;">
                <p class="text-center align-middle">
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
                    <br>Mengetahui,
                </p>
                <br>
                <br>
                <p class="text-center align-middle">

                    <b><u>Aries Mardiono, M.Sos.</u></b>
                </p>
            </div>
        </div>
    </section>
</body>

</html>
