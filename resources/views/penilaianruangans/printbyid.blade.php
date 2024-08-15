<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Berita Acara Penilaian Ruangan</title>

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

        <h1 style="text-align: center; margin-bottom: 10px;"><b>BERITA ACARA PENILAIAN RUANGAN</b></h1>

        <div class="content">
            <div style="display: flex; justify-content: space-between;">
                <div>Nomor : <b>{{ $penilaianruangan->nomor_surat }}</b>
                    <p>Perihal : Penilaian Ruangan</p>
                </div>
            </div>
            <p>Dengan ini menyatakan bahwa saya <b><u>{{ $penilaianruangan->peminjam->name }}</u></b> telah melakukan penilaian terhadap Ruangan <b><u>{{ $penilaianruangan->ruangan->nama_ruangan }}</u></b> dengan detail penilaian sebagai berikut :</p>
            <table class="table">
            <thead>
                <tr>
                    <th class="text-left align-middle">Kebersihan</th>
                    <td class="text-center align-middle">:</td>
                    <td class="text-left align-middle">{{ $penilaianruangan->kebersihan }}</td>
                </tr>
                <tr>
                    <th class="text-left align-middle">Kenyamanan</th>
                    <td class="text-center align-middle">:</td>
                    <td class="text-left align-middle">{{ $penilaianruangan->kenyamanan }}</td>
                </tr>
                <tr>
                    <th class="text-left align-middle">Kelengkapan Fasilitas</th>
                    <td class="text-center align-middle">:</td>
                    <td class="text-left align-middle">{{ $penilaianruangan->kelengkapan_fasilitas }}</td>
                </tr>
                <tr>
                    <th class="text-left align-middle">Saran</th>
                    <td class="text-center align-middle">:</td>
                    <td class="text-left align-middle">{{ $penilaianruangan->saran }}</td>
                </tr>
            </thead>
        </table>
        <p>Berdasarkan hasil penilaian dari Ruangan <b><u>{{ $penilaianruangan->ruangan->nama_ruangan }}</u></b>. Penilaian ini dilakukan secara objektif sesuai dengan standar dan prosedur yang berlaku.</p>
        <p>Demikian berita acara penilaian ruangan ini dibuat untuk digunakan sebagaimana mestinya.</p>
        </div>
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
                    <br>Hormat Saya,
                </p>
                <br>
                <br>
                <p class="text-center align-middle">

                    <b><u>{{ $penilaianruangan->peminjam->name }}</u></b>
                </p>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
