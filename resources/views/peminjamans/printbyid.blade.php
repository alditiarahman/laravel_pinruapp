<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Peminjaman</title>

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
            width: 100%;
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

<body class="A4 potrait">
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

        <h1 style="text-align: center; margin-bottom: 10px;"><b>SURAT PENGAJUAN PEMINJAMAN RUANGAN</b></h1>

        <div class="content">
            <div style="display: flex; justify-content: space-between;">
                <div>Kepada Yth, <b>{{ $peminjaman->peminjam->name }}</b></div>
                <div>Perihal: Peminjaman Ruangan</div>
            </div>
            <p>Di tempat</p>

            <p>Dengan Hormat,</p>
            <p>Sehubung dengan perlunya sebuah tempat untuk melaksanakan sebuah kegiatan, maka dari itu saya selaku
                Peminjam, mengajukan peminjaman Ruangan <b>{{ $peminjaman->ruangan->nama_ruangan }}</b> dari tanggal
                <b>{{ $peminjaman->tanggal_pinjam }}</b> sampai dengan
                dikembalikan.
            </p>
            <p>Adapun yang bertanggung jawab dalam peminjaman ruangan tersebut adalah sebagai berikut:</p>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center align-middle">Nama Penanggung Jawab</th>
                        <th class="text-center align-middle">Jabatan</th>
                        <th class="text-center align-middle">Instansi</th>
                        <th class="text-center align-middle">Nomor KTP / SIM</th>
                        <th class="text-center align-middle">Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamandata as $pinjam)
                        <tr>
                            <td class="text-center align-middle"><?php echo $pinjam->nama_pj; ?></td>
                            <td class="text-center align-middle"><?php echo $pinjam->jabatan; ?></td>
                            <td class="text-center align-middle"><?php echo $pinjam->instansi; ?></td>
                            <td class="text-center align-middle"><?php echo $pinjam->nomor_identitas; ?></td>
                            <td class="text-center align-middle"><?php echo $pinjam->nomor_telepon; ?></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Dalam hal ini bertindak selaku Peminjam Ruangan Kantor Bawaslu Provinsi Kalimantan Selatan akan
                mempergunakan ruangan yang dipinjam tersebut untuk Keperluan : <b>{{ $peminjaman->keperluan }}</b>.</p>
            <p>Dalam hal ini saya berkewajiban :
                <br>1. Memelihara dan menjaga kebersihan Aula, sampah harap dikumpulkan dan dibuang di depan kantor
                (tempat
                sampah di parkiran).
                <br>2. Menjaga keamanan, ketertiban dan ketenteraman selama berlangsungnya peminjaman Aula ini.
                <br>3. Mematikan segala peralatan elektronik yang berada di aula setelah kegiatan berlangsung ( TV LCD,
                AC,
                Lampu dll ).
                <br>4. Mengembalikan peralatan aula meja dan kursi seperti semula.
                <br>5. Saya berkewajiban memperbaiki/mengganti kerusakan, jika ada peralatan kantor di aula yang rusak
                akibat pemakaian atas Aula tersebut dan biaya atas perbaikan tersebut sepenuhnya menjadi tanggung jawab
                saya/ lembaga.
            </p>
            <p>Demikian surat pengajuan peminjaman ruangan ini dibuat. Atas waktu dan perhatian Bapak/Ibu, kami ucapkan
                terima kasih.</p>
        </div>
        <div style="margin-top: 10px;">
            <div style="float: right; width: 40%;">
                <p class="text-center align-middle">
                    Banjarmasin,
                    <?php
                    // Array mapping English day names to Indonesian
                    $dayNames = [
                        'Sunday' => 'Minggu',
                        'Monday' => 'Senin',
                        'Tuesday' => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                    ];
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
                    $currentDate = date('l, d F Y');
                    // Translate day and month names to Indonesian
                    foreach ($dayNames as $english => $indonesian) {
                        $currentDate = str_replace($english, $indonesian, $currentDate);
                    }
                    foreach ($monthNames as $english => $indonesian) {
                        $currentDate = str_replace($english, $indonesian, $currentDate);
                    }
                    echo $currentDate;
                    ?>
                    <br>Hormat Saya,
                </p>
                <br>
                <br>
                <p class="text-center align-middle">

                    <b><u>{{ $peminjaman->peminjam->name }}</u></b>
                </p>
            </div>
            <div style="float: left; width: 35%;">
                <p class="text-center align-middle">
                    <br>Yang Mengetahui
                </p>
                <br>
                <br>
                <p class="text-center align-middle">

                    <b><u>Aries Mardiono, M.Sos</u></b>
                </p>
            </div>

        </div>
    </section>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>