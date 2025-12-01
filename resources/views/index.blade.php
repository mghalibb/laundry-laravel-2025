@extends('layouts.vertical', ['title' => 'Dashboard'])
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
</style>
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Cleanify</a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- === KARTU STATISTIK === --}}
    <div class="row justify-content-center">
        {{-- TRANSAKSI HARI INI --}}
        <div class="col-md-6 col-lg-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Transaksi Hari Ini</p>
                            <h4 class="mt-1 mb-0 fw-medium">{{ $transaksiHariIni ?? 0 }}</h4>
                        </div>
                        <div class="col-3 align-self-center">
                            <div
                                class="d-flex justify-content-center align-items-center thumb-md border-dashed border-primary rounded mx-auto">
                                <i class="bi bi-basket fs-22 align-self-center mb-0 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PENDAPATAN HARI INI --}}
        <div class="col-md-6 col-lg-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Omset Hari Ini</p>
                            <h4 class="mt-1 mb-0 fw-medium">Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="col-3 align-self-center">
                            <div
                                class="d-flex justify-content-center align-items-center thumb-md border-dashed border-success rounded mx-auto">
                                <i class="bi bi-cash-coin fs-22 align-self-center mb-0 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SEDANG PROSES --}}
        <div class="col-md-6 col-lg-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Sedang Proses</p>
                            <h4 class="mt-1 mb-0 fw-medium">{{ $sedangProses ?? 0 }}</h4>
                        </div>
                        <div class="col-3 align-self-center">
                            <div
                                class="d-flex justify-content-center align-items-center thumb-md border-dashed border-warning rounded mx-auto">
                                <i class="bi bi-hourglass-split fs-22 align-self-center mb-0 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOTAL PELANGGAN --}}
        <div class="col-md-6 col-lg-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Pelanggan</p>
                            <h4 class="mt-1 mb-0 fw-medium">{{ $totalPelanggan ?? 0 }}</h4>
                        </div>
                        <div class="col-3 align-self-center">
                            <div
                                class="d-flex justify-content-center align-items-center thumb-md border-dashed border-info rounded mx-auto">
                                <i class="bi bi-people fs-22 align-self-center mb-0 text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- === TABEL TRANSAKSI TERAKHIR === --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Transaksi Terakhir</h4>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('transactions.index') }}" class="text-primary">Lihat Semua</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable_2">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-top-0">Kode Order</th>
                                    <th class="border-top-0">Tanggal</th>
                                    <th class="border-top-0">Pelanggan</th>
                                    <th class="border-top-0">Total</th>
                                    <th class="border-top-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestTransactions ?? [] as $trx)
                                    @php
                                        /** @var \App\Models\TransOrder $trx */
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{ route('transactions.show', $trx->id) }}"
                                                class="text-primary fw-bold">
                                                {{ $trx->order_code }}
                                            </a>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($trx->order_date)->format('d M Y') }}</td>
                                        <td>{{ $trx->customer->nama }}</td>
                                        <td>Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($trx->order_status == '0')
                                                <span
                                                    class="badge bg-warning-subtle text-warning fs-11 fw-medium px-2">Proses</span>
                                            @else
                                                <span
                                                    class="badge bg-success-subtle text-success fs-11 fw-medium px-2">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            Belum ada transaksi. <a href="{{ route('transactions.create') }}">Buat Baru</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
