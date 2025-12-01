@extends('layouts.vertical', ['title' => 'Riwayat Transaksi'])

@section('css')
    @vite(['node_modules/simple-datatables/dist/style.css'])
@endsection
<style>
    #datatable_2 td,
    #datatable_2 th {
        font-size: 14px;
        vertical-align: middle;
    }

    #datatable_2 .badge {
        font-size: 13px;
        padding: 0.4em 0.6em;
    }

    #datatable_2 .btn {
        padding: 0.5rem 0.9rem;
        font-size: 14px;
        font-weight: 900;
    }

    /* === CSS STRUK THERMAL === */
    .invoice-box {
        width: 58mm;
        margin: auto;
        padding: 5px;
        border: 1px solid #eee;
        font-size: 10px;
        font-family: 'Courier New', Courier, monospace;
        line-height: 1.2;
        background: white;
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
</style>
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Data Transaksi Laundry</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Transaksi Laundry</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Daftar Transaksi Laundry</h4>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('transactions.create') }}" class="btn btn-md btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Transaksi Baru
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable_2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="15%">Kode Order</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Total Item</th>
                                    <th scope="col">Total Tagihan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Kasir</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $trx)
                                    <tr>
                                        <td><strong>{{ $trx->order_code }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($trx->order_date)->format('d M Y') }}</td>
                                        <td>{{ $trx->customer->nama }}</td>
                                        <td>{{ $trx->details->count() }} Layanan</td>
                                        <td>
                                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @if ($trx->order_status == '0')
                                                <span class="badge bg-warning text-dark">Baru (Proses)</span>
                                            @else
                                                <span class="badge bg-success">Sudah Diambil</span>
                                            @endif
                                        </td>
                                        <td>{{ $trx->user->username }}</td>
                                        <td>
                                            @if ($trx->order_status == '0')
                                                <small class="text-muted" style="font-size: 11px;">
                                                    @php $hasNote = false; @endphp
                                                    @foreach ($trx->details as $detail)
                                                        @if ($detail->notes)
                                                            <div class="mb-1">
                                                                <i class="bi bi-dot"></i>
                                                                {{ $detail->service->service_name }}: <em
                                                                    class="text-dark">{{ $detail->notes }}</em>
                                                            </div>
                                                            @php
                                                                $hasNote = true;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    @if (!$hasNote)
                                                        -
                                                    @endif
                                                </small>
                                            @else
                                                @if ($trx->pickup && $trx->pickup->notes)
                                                    <small class="text-success fst-italic">
                                                        <i class="bi bi-check2-all"></i> "{{ $trx->pickup->notes }}"
                                                    </small>
                                                @else
                                                    <small class="text-muted">-</small>
                                                @endif
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('transactions.show', $trx->id) }}"
                                                class="btn btn-md btn-info text-white">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </td> --}}
                                        <td>
                                            <button type="button" class="btn btn-md btn-info text-white"
                                                data-bs-toggle="modal" data-bs-target="#strukModal{{ $trx->id }}">
                                                <i class="bi bi-eye"></i> Detail
                                            </button>

                                            {{-- =========================================== --}}
                                            {{-- MODAL STRUK --}}
                                            {{-- =========================================== --}}
                                            <div class="modal fade" id="strukModal{{ $trx->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Preview Struk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body bg-light d-flex justify-content-center">
                                                            <div id="printableArea{{ $trx->id }}">
                                                                <div class="invoice-box card">
                                                                    <div class="card-body p-0">
                                                                        <div class="header-struk">
                                                                            <h4
                                                                                style="font-weight: bold; text-transform: uppercase;">
                                                                                CLEANIFY LAUNDRY</h4>
                                                                            <span>Jl. Karet Pasar Baru Barat</span><br>
                                                                            <span>Telp: 0812-3456-7890</span>
                                                                        </div>

                                                                        <div class="info-struk">
                                                                            <table style="width: 100%">
                                                                                <tr>
                                                                                    <td>No</td>
                                                                                    <td>: {{ $trx->order_code }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Tgl</td>
                                                                                    <td>:
                                                                                        {{ date('d/m/Y H:i', strtotime($trx->order_date)) }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Kasir</td>
                                                                                    <td>: {{ $trx->user->username }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Plg</td>
                                                                                    <td>:
                                                                                        {{ substr($trx->customer->nama, 0, 15) }}
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <table class="table-struk">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 40%">Item</th>
                                                                                    <th style="width: 15%">Qty</th>
                                                                                    <th
                                                                                        style="width: 45%; text-align: right;">
                                                                                        Subtotal</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($trx->details as $detail)
                                                                                    <tr>
                                                                                        <td colspan="3"
                                                                                            style="padding-top: 4px;">
                                                                                            {{ $detail->service->service_name }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <small style="color: #555;">@
                                                                                                Rp
                                                                                                {{ number_format($detail->service->price, 2, ',', '.') }}</small>
                                                                                        </td>
                                                                                        <td style="text-align: center;">
                                                                                            x{{ $detail->qty }}</td>
                                                                                        <td style="text-align: right;">
                                                                                            {{ number_format($detail->subtotal, 2, ',', '.') }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <div class="total-struk"
                                                                            style="border-top: 1px solid #000; padding-top: 5px; margin-top: 5px;">
                                                                            {{-- Subtotal --}}
                                                                            <div
                                                                                style="display: flex; justify-content: space-between; font-size: 10px;">
                                                                                <span>Subtotal</span>
                                                                                <span>{{ number_format($trx->details->sum('subtotal'), 2, ',', '.') }}</span>
                                                                            </div>

                                                                            {{-- Biaya Admin --}}
                                                                            @if ($trx->admin_fee > 0)
                                                                                <div
                                                                                    style="display: flex; justify-content: space-between; font-size: 10px;">
                                                                                    <span>Biaya Admin</span>
                                                                                    <span>{{ number_format($trx->admin_fee, 2, ',', '.') }}</span>
                                                                                </div>
                                                                            @endif

                                                                            {{-- Pajak --}}
                                                                            @if ($trx->tax > 0)
                                                                                <div
                                                                                    style="display: flex; justify-content: space-between; font-size: 10px;">
                                                                                    <span>Pajak</span>
                                                                                    <span>{{ number_format($trx->tax, 2, ',', '.') }}</span>
                                                                                </div>
                                                                            @endif

                                                                            {{-- Grand Total --}}
                                                                            <div class="grand-total"
                                                                                style="border-top: 1px dashed #000; margin-top: 3px; padding-top: 3px;">
                                                                                <span>TOTAL BAYAR</span>
                                                                                <span>Rp
                                                                                    {{ number_format($trx->total_price, 2, ',', '.') }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="footer-struk">
                                                                            <p>-- TERIMA KASIH --</p>
                                                                            <p>Barang tidak diambil > 30 hari<br>di luar
                                                                                tanggung jawab kami.</p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="button" class="btn btn-primary"
                                                                onclick="printDiv('printableArea{{ $trx->id }}')">
                                                                <i class="bi bi-printer"></i> Cetak
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- =========================================== --}}
                                            {{-- MODAL STRUK --}}
                                            {{-- =========================================== --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada transaksi hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" width="15%">Kode Order</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Total Item</th>
                                    <th scope="col">Total Tagihan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Kasir</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-bottom')
    @vite(['resources/js/pages/datatable.init.js'])
    <script>
        function printDiv(divId) {
            var content = document.getElementById(divId).innerHTML;
            var myWindow = window.open('', '', 'height=600,width=400');

            myWindow.document.write('<html><head><title>Cetak Struk</title>');

            // === CSS ===
            myWindow.document.write('<style>');
            myWindow.document.write(
                '@media print { .d-print-none, .page-title-box, footer, header, .navbar, .left-sidenav { display: none!important; } }'
            );
            myWindow.document.write('@page { margin: 0; size: auto; }');
            myWindow.document.write(
                'body { background-color: white; margin: 0; padding: 0; }'
            );

            // SETTING UKURAN KERTAS 58MM
            myWindow.document.write(
                '.invoice-box { width: 58mm; max-width: 58mm; margin: 0; padding: 5px; border: none; box-shadow: none; font-size: 10px; font-family: "Courier New", Courier, monospace; line-height: 1.2; color: #333; }'
            );

            myWindow.document.write(
                'h2, h3, h4, h5, p { margin: 2px 0; color: #000; }'
            );

            // 3. HEADER (Logo & Judul)
            myWindow.document.write(
                '.header-struk { text-align: center; margin-bottom: 10px; padding-bottom: 5px; border-bottom: 1px dashed #000; }'
            );
            myWindow.document.write(
                '.header-struk h4 { margin: 0 0 2px 0; font-size: 14px; font-weight: 800; text-transform: uppercase; color: #000; }'
            );
            myWindow.document.write('.header-struk span { font-size: 9px; color: #555; display: block; }');

            // 4. INFO TRANSAKSI (Rapi Kiri-Kanan)
            myWindow.document.write('.info-struk { margin-bottom: 8px; }');
            myWindow.document.write('.info-struk table { width: 100%; border-collapse: collapse; }');
            myWindow.document.write('.info-struk td { font-size: 9px; vertical-align: top; padding: 1px 0; }');
            myWindow.document.write(
                '.info-struk td:last-child { text-align: right; font-weight: 500; }'); // Kolom kanan rata kanan

            // 5. TABEL ITEM (Garis Lurus, Bukan Putus-putus)
            myWindow.document.write(
                '.table-struk { width: 100%; border-collapse: collapse; margin-bottom: 10px; border-top: 1px solid #000; border-bottom: 1px solid #000; }'
            );
            myWindow.document.write(
                '.table-struk th { font-size: 9px; text-align: left; padding: 4px 0; border-bottom: 1px solid #ddd; }');
            myWindow.document.write('.table-struk td { font-size: 10px; padding: 4px 0; vertical-align: top; }');
            myWindow.document.write('.item-name { font-weight: bold; display: block; margin-bottom: 2px; }');
            myWindow.document.write(
                '.item-desc { font-size: 8px; color: #666; display: block; margin-bottom: 2px; font-style: italic; }');

            // 6. TOTAL HARGA (Lebih Menonjol)
            myWindow.document.write(
                '.total-struk { text-align: right; margin-top: 5px; font-size: 12px; font-weight: bold; border-top: 1px solid #ddd; padding-top: 5px; }'
            );
            myWindow.document.write(
                '.total-row { display: flex; justify-content: space-between; margin-bottom: 2px; font-size: 10px; font-weight: normal; }'
            );
            myWindow.document.write(
                '.grand-total { display: flex; justify-content: space-between; font-size: 12px; font-weight: bold; margin-top: 5px; color: #000; }'
            );

            // 7. FOOTER
            myWindow.document.write(
                '.footer-struk { text-align: center; margin-top: 15px; font-size: 8px; color: #777; border-top: 1px solid #eee; padding-top: 8px; }'
            );
            myWindow.document.write('</style>');
            // === SELESAI CSS ===

            myWindow.document.write('</head><body>');

            // === ISI KONTEN ===
            var contentHTML = `
            <div class="invoice-box">
                <div class="header-struk">
                    <h4>CLEANIFY</h4>
                    <span>Jasa Laundry Profesional</span>
                    <span>0812-3456-7890</span>
                </div>

                <div class="info-struk">
                    <table>
                        <tr><td>No. Order</td><td>${divId.replace('printableArea', 'TRX-')}</td></tr> <tr><td>Tanggal</td><td>${new Date().toLocaleDateString('id-ID')}</td></tr>
                        <tr><td>Pelanggan</td><td>(Nama Pelanggan)</td></tr>
                    </table>
                </div>

                ` + document.getElementById(divId).innerHTML + `
            </div>
        `;

            myWindow.document.write(document.getElementById(divId).innerHTML);

            myWindow.document.write('</body></html>');

            myWindow.document.close();
            myWindow.focus();

            setTimeout(function() {
                myWindow.print();
                myWindow.close();
            }, 500);
        }
    </script>
@endsection
