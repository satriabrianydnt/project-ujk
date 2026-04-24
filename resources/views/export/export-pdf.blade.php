<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi Inventaris</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LAPORAN TRANSAKSI INVENTARIS</h2>
        <p>Dicetak pada: {{ date('d M Y H:i') }} WIB</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $index => $t)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d/m/Y') }}</td>
                    <td>[{{ $t->barang->kode_barang }}] {{ $t->barang->nama_barang }}</td>
                    <td>
                        {{ $t->jenis === 'masuk' ? 'Barang Masuk' : 'Barang Keluar' }}
                    </td>
                    <td>{{ $t->jumlah }}</td>
                    <td>{{ $t->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
