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

        th {
            border: 1px solid #000;
            padding: 8px;
            background-color: #f2f2f2;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
        }

        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .footer-wrapper {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
            font-size: 14px;
        }

        .signature-box {
            width: 250px;
            text-align: center;
            margin-right: 20px;
        }

        .ttd-name {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
        }

        @media print {
            @page {
                size: A4;
                margin: 10mm;
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
                <th scope="col" width="5%">NO</th>
                <th scope="col">TANGGAL</th>
                <th scope="col">KODE TRANSAKSI</th>
                <th scope="col">PELANGGAN</th>
                <th scope="col">RINCIAN LAYANAN</th>
                <th scope="col">KASIR</th>
                <th scope="col">TOTAL (RP)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $trx)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->order_date)->format('d/m/Y') }}</td>
                    <td>{{ $trx->order_code }}</td>
                    <td>{{ $trx->customer->nama }}</td>
                    <td>
                        @foreach ($trx->details as $detail)
                            @php
                                $satuan = 'Pcs';
                                if (stripos($detail->service->service_name, 'Kg') !== false) {
                                    $satuan = 'Kg';
                                } elseif (stripos($detail->service->service_name, 'm²') !== false) {
                                    $satuan = 'm²';
                                }
                            @endphp
                            <div>- {{ $detail->service->service_name }} ({{ $detail->qty + 0 }} {{ $satuan }})
                            </div>
                        @endforeach
                    </td>
                    <td>{{ $trx->user->name ?? $trx->user->username }}</td>
                    <td>{{ number_format($trx->total_price, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" scope="col" class="text-end">TOTAL PENDAPATAN</th>
                <th scope="col" class="text-end">Rp {{ number_format($totalIncome, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer-wrapper">
        <div class="signature-box">
            <p>Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Mengetahui,</p>
            <div class="ttd-name">
                {{ $leader->name ?? '..........................' }}
            </div>
            {{-- <p>Pimpinan Laundry</p> --}}
        </div>
    </div>

</body>

</html>
