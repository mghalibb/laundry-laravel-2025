@extends('layouts.vertical', ['title' => 'Laporan Penjualan'])
<style>
    #datatable_1 th {
        font-size: 14px;
        vertical-align: middle;
        text-align: center;
        font-weight: 700;
    }

    #datatable_1 td {
        font-size: 14px;
        vertical-align: middle;
        text-align: center;
    }

    #datatable_1 .badge {
        font-size: 13px;
        padding: 0.4em 0.6em;
        font-weight: 600;
    }

    #datatable_1 .btn {
        padding: 0.5rem 0.9rem;
        font-size: 16px;
        font-weight: 900;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Laporan Penjualan</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('reports.index') }}" method="GET" class="row g-3 align-items-end mb-4">
                        <div class="col-md-3">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="bi bi-filter"></i> Filter
                            </button>
                            <a href="{{ route('reports.print', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                                target="_blank" class="btn btn-secondary">
                                <i class="bi bi-printer"></i> Cetak Laporan
                            </a>
                        </div>
                    </form>

                    <div class="alert alert-info border-0" role="alert">
                        <strong>Total Pendapatan ({{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}):</strong>
                        <span class="float-end fw-bold fs-5">Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0" id="datatable_1">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="5%">NO</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">KODE TRANSAKSI</th>
                                    <th scope="col">PELANGGAN</th>
                                    <th scope="col">RINCIAN LAYANAN</th>
                                    <th scope="col">KASIR</th>
                                    <th scope="col">JUMLAH (RP)</th>
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
                                            <small class="text-muted">
                                                @foreach ($trx->details as $detail)
                                                    @php
                                                        $satuan = 'Pcs';
                                                        if (stripos($detail->service->service_name, 'Kg') !== false) {
                                                            $satuan = 'Kg';
                                                        } elseif (
                                                            stripos($detail->service->service_name, 'm²') !== false
                                                        ) {
                                                            $satuan = 'm²';
                                                        }
                                                    @endphp

                                                    <div class="mb-1">
                                                        &bull; {{ $detail->service->service_name }}
                                                        <span class="text-dark fw-bold">
                                                            ({{ $detail->qty + 0 }} {{ $satuan }})
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </small>
                                        </td>
                                        <td>{{ $trx->user->name ?? $trx->user->username }}</td>
                                        <td>{{ number_format($trx->total_price, 2, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data penjualan pada periode ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="6" class="text-end fw-bold">GRAND TOTAL</td>
                                    <td class="text-end  fw-bold">Rp {{ number_format($totalIncome, 2, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
