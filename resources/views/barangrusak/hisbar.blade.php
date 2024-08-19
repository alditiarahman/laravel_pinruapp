<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Riwayat Barang Rusak</title>

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
            <img src="{{ asset('images/logo-Kalsel.png') }}" alt="Logo"
                style="width: 250px; height: auto; float: left;">
            <!-- Clearfix untuk mengatasi float -->
            <div style="clear: both;"></div>
            <br>
            <hr style="border-top: 3px solid black; margin-top: 10px; margin-bottom: 10px;">
        </div>

        <h1 style="text-align: center;"><u>LAPORAN RIWAYAT BARANG RUSAK</u></h1>
        <p>Dengan ini melaporkan riwayat kerusakan barang berdasarkan Nama Ruangan, dengan rincian sebagai berikut :</p>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">Nama Ruangan</th>
                    <th class="text-center align-middle">Nama Barang</th>
                    <th class="text-center align-middle">Foto Barang Rusak</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($barangrusak as $data) : ?>
                <tr>
                    <td class="text-center align-middle"><?php echo $no; ?></td>
                    <td class="text-center align-middle"><?php echo $data->ruangan->nama_ruangan; ?></td>
                    <td class="text-center align-middle"><?php echo $data->nama_barang; ?></td>
                    <td class="text-center align-middle">
                        <img src="{{ public_path('storage/barangrusak/' . $data->foto_barang) }}"
                            alt="FOTO BARANG RUSAK" width="70px" height="70px">
                    </td>
                </tr>

                <?php $no++;
        endforeach; ?>
            </tbody>
        </table>
        <p>Demikian laporan ini dibuat untuk catatan resmi terkait riwayat kerusakan barang dan dapat digunakan sebagaimana mestinya.</p>
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
    </section>

</body>

</html>
