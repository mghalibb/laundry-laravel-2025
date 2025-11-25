<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Cleanify</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
        }

        .ttd {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }

        @media print {
            @page {
                size: A4;
                margin: 20mm;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <h2>Cleanify Laundry</h2>
        <p>Jl. Karet Pasar Baru Barat, Jakarta Pusat</p>
        <p>Laporan Penjualan Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d
            {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Kode Transaksi</th>
                <th>Pelanggan</th>
                <th>Kasir</th>
                <th>Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $trx)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($trx->order_date)->format('d/m/Y') }}</td>
                    <td>{{ $trx->order_code }}</td>
                    <td>{{ $trx->customer->nama }}</td>
                    <td>{{ $trx->user->name ?? $trx->user->username }}</td>
                    <td class="text-end">{{ number_format($trx->total_price, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-end">TOTAL PENDAPATAN</th>
                <th class="text-end">Rp {{ number_format($totalIncome, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Jakarta, {{ date('d F Y') }}</p>
        <p>Mengetahui,</p>
        <div class="ttd">Pimpinan Laundry</div>
    </div>

</body>

</html>
