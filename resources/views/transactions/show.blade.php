@extends('layouts.vertical', ['title' => 'Struk Transaksi'])

@section('css')
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            background-color: white;
        }

        @media print {

            .d-print-none,
            .page-title-box,
            footer,
            header,
            .navbar,
            .left-sidenav {
                display: none !important;
            }

            @page {
                margin: 0;
                size: auto;
            }

            body {
                background-color: white;
                margin: 0;
                padding: 0;
            }

            .invoice-box {
                width: 58mm;
                max-width: 58mm;
                margin: 0;
                padding: 5px;
                border: none;
                box-shadow: none;
                font-size: 10px;
                font-family: 'Courier New', Courier, monospace;
                line-height: 1.2;
            }

            h2,
            h3,
            h4,
            h5,
            p {
                margin: 2px 0;
                color: #000;
            }

            .header-struk {
                text-align: center;
                margin-bottom: 10px;
                border-bottom: 1px dashed #000;
                padding-bottom: 5px;
            }

            .info-struk {
                margin-bottom: 5px;
                border-bottom: 1px dashed #000;
                padding-bottom: 5px;
            }

            .table-struk {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 5px;
            }

            .table-struk th {
                text-align: left;
                border-bottom: 1px dashed #000;
                padding: 2px 0;
            }

            .table-struk td {
                padding: 2px 0;
                vertical-align: top;
            }

            .total-struk {
                border-top: 1px dashed #000;
                padding-top: 5px;
                text-align: right;
                font-weight: bold;
            }

            .footer-struk {
                text-align: center;
                margin-top: 10px;
                font-size: 9px;
            }

            .badge {
                border: none !important;
                color: black !important;
                padding: 0 !important;
                font-weight: normal;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="page-title-box d-print-none d-flex align-items-center justify-content-between mb-3">
                <h4 class="page-title">Detail Transaksi</h4>
                <div>
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="bi bi-printer"></i> Cetak Struk
                    </button>
                </div>
            </div>

            <div class="invoice-box card">
                <div class="card-body p-0">
                    <div class="header-struk">
                        <h4 style="font-weight: bold; text-transform: uppercase;">CLEANIFY LAUNDRY</h4>
                        <span>Jl. Karet Pasar Baru Barat</span><br>
                        <span>Telp: 0812-3456-7890</span>
                    </div>

                    <div class="info-struk">
                        <table style="width: 100%">
                            <tr>
                                <td>No</td>
                                <td>: {{ $transaction->order_code }}</td>
                            </tr>
                            <tr>
                                <td>Tgl</td>
                                <td>: {{ date('d/m/Y H:i', strtotime($transaction->order_date)) }}</td>
                            </tr>
                            <tr>
                                <td>Kasir</td>
                                <td>: {{ $transaction->user->username }}</td>
                            </tr>
                            <tr>
                                <td>Plg</td>
                                <td>: {{ substr($transaction->customer_name, 0, 15) }}</td>
                            </tr>
                        </table>
                    </div>

                    <table class="table-struk">
                        <thead>
                            <tr>
                                <th style="width: 40%">Item</th>
                                <th style="width: 15%">Qty</th>
                                <th style="width: 45%; text-align: right;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction->details as $detail)
                                <tr>
                                    <td colspan="3" style="padding-top: 4px;">
                                        {{ $detail->service->service_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small style="color: #555;">@ Rp
                                            {{ number_format($detail->service->price, 0, ',', '.') }}</small>
                                    </td>
                                    <td style="text-align: center;">x{{ $detail->qty }}</td>
                                    <td style="text-align: right;">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="total-struk">
                        <table style="width: 100%">
                            <tr>
                                <td>TOTAL BAYAR:</td>
                                <td style="font-size: 14px;">Rp {{ number_format($grandTotal, 2, ',', '.') }}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="footer-struk">
                        <p>-- TERIMA KASIH --</p>
                        <p>Barang tidak diambil > 30 hari<br>di luar tanggung jawab kami.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
