@extends('layouts.vertical', ['title' => 'Laporan Penjualan'])

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
                        <table class="table table-bordered table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Pelanggan</th>
                                    <th>Kasir</th>
                                    <th class="text-end">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $trx)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($trx->order_date)->format('d/m/Y') }}</td>
                                        <td>{{ $trx->order_code }}</td>
                                        <td>{{ $trx->customer->nama }}</td>
                                        <td>{{ $trx->user->name ?? $trx->user->username }}</td>
                                        <td class="text-end">{{ number_format($trx->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data penjualan pada periode ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <td colspan="5" class="text-end">GRAND TOTAL</td>
                                    <td class="text-end">Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
