<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Per Status</title>

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
            margin-left: 350px;
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

        <h1>LAPORAN PEMINJAMAN
            @if ($selected_status == 'disetujui')
                DISETUJUI
            @elseif ($selected_status == 'ditolak')
                DITOLAK
            @elseif ($selected_status == 'menunggu')
                PENDING
            @endif
        </h1>

        @if ($peminjaman->isEmpty())
            <div class="no-data">
                <p>Data peminjaman tidak tersedia.</p>
            </div>
        @else
            <div class="content">
                @if ($peminjaman->contains('status', 'disetujui'))
                    <p>Kami sampaikan bahwa data peminjaman yang ditampilkan saat ini merupakan data dengan status
                        "Disetujui." Data ini mencakup peminjaman
                        <br>- peminjaman yang telah disetujui dan diterima setelah melalui proses evaluasi dan penilaian
                        yang cermat.
                    </p>
                @endif
                @if ($peminjaman->contains('status', 'ditolak'))
                    <p>Kami informasikan bahwa data peminjaman yang ditampilkan saat ini merupakan data dengan status
                        "Ditolak." Data ini mencakup peminjaman
                        <br> yang tidak disetujui berdasarkan evaluasi dan pertimbangan yang telah dilakukan.
                    </p>
                @endif
                @if ($peminjaman->contains('status', 'menunggu'))
                    <p>Kami sampaikan bahwa data peminjaman yang ditampilkan saat ini adalah data dengan status
                        "Pending." Data ini mencakup peminjaman
                        <br>- peminjaman yang saat ini masih dalam proses evaluasi atau menunggu keputusan lebih lanjut.
                    </p>
                    <p>Status "Pending" menunjukkan bahwa peminjaman tersebut belum selesai diproses dan masih
                        memerlukan tindak lanjut atau verifikasi lebih
                        <br> lanjut sesuai dengan prosedur yang berlaku. Kami akan terus memantau dan mengupdate status
                        peminjaman ini hingga keputusan akhir diambil.
                    </p>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Nama Ruangan</th>
                            <th class="text-center align-middle">Nama Peminjam</th>
                            <th class="text-center align-middle">Tanggal Mulai</th>
                            <th class="text-center align-middle">Tanggal Selesai</th>
                            <th class="text-center align-middle">Disetujui Oleh</th>
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
                            <td class="text-center align-middle"><?php echo $data->petugas ? $data->petugas->name : 'Belum Diverifikasi'; ?></td>
                            <td class="text-center align-middle"><?php echo $data->keperluan; ?></td>
                        </tr>

                        <?php $no++;
        endforeach; ?>
                    </tbody>
                </table>
                @if ($peminjaman->contains('status', 'disetujui'))
                    <p>Informasi ini menunjukkan bahwa semua peminjaman dalam laporan ini telah memenuhi kriteria dan
                        persyaratan yang ditetapkan, dan
                        <br>selanjutnya akan diproses sesuai dengan prosedur dan kebijakan yang berlaku. Kami
                        mengharapkan agar data ini digunakan sebagai
                        <br>acuan untuk pelaksanaan atau tindak lanjut yang diperlukan.
                    </p>
                @endif
                @if ($peminjaman->contains('status', 'ditolak'))
                    <p>Harap diperhatikan bahwa setiap penolakan disertai dengan catatan atau alasan yang relevan, yang
                        dapat digunakan sebagai acuan untuk
                        <br> perbaikan atau tindakan lebih lanjut. Kami mendorong agar catatan tersebut diperhatikan
                        dengan seksama guna memastikan kualitas
                        <br> dan kelengkapan peminjaman di masa mendatang.
                    </p>
                @endif
                @if ($peminjaman->contains('status', 'menunggu'))
                    <p>Kami menghargai kesabaran Anda dalam menunggu proses ini dan akan memberikan informasi lebih
                        lanjut segera setelah peminjaman diproses.</p>
                @endif
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
