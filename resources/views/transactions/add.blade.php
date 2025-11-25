@extends('layouts.vertical', ['title' => 'Transaksi Baru'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Buat Transaksi Baru</h4>
                <span class="badge bg-primary fs-6">{{ $orderCode }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    {{-- Hidden Input Kode Order --}}
                    <input type="hidden" name="order_code" value="{{ $orderCode }}">

                    {{-- BAGIAN 1: PILIH PELANGGAN --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Pilih Pelanggan</label>
                            <select class="form-select" name="id_customer" required>
                                <option value="" disabled selected>-- Cari Nama Pelanggan --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <input type="text" class="form-control" value="{{ date('d F Y') }}" readonly>
                        </div>
                    </div>

                    {{-- BAGIAN 2: TABEL INPUT MANUAL (5 BARIS STATIS) --}}
                    <div class="alert alert-info py-2 small">
                        <i class="bi bi-info-circle"></i> Isi layanan yang diinginkan. Kosongkan baris yang tidak terpakai. Total harga akan dihitung otomatis oleh sistem setelah disimpan.
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="40%">Jenis Layanan</th>
                                    <th width="15%">Qty (Kg/Pcs)</th>
                                    <th width="40%">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- KITA PAKAI PHP FOR LOOP UNTUK BIKIN 5 BARIS KOSONG --}}
                                @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <td class="text-center align-middle">{{ $i + 1 }}</td>
                                    <td>
                                        {{-- Dropdown Layanan --}}
                                        <select name="services[{{ $i }}][id_service]" class="form-select">
                                            <option value="" selected>-- Pilih Layanan --</option>
                                            @foreach($services as $service)
                                                {{-- Tampilkan Nama & Harga biar Kasir tau --}}
                                                <option value="{{ $service->id }}">
                                                    {{ $service->service_name }} (@ Rp {{ number_format($service->price, 0, ',', '.') }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        {{-- Input Qty (Desimal) --}}
                                        <input type="number" name="services[{{ $i }}][qty]" class="form-control" placeholder="0" step="0.001">
                                    </td>
                                    <td>
                                        {{-- Input Catatan --}}
                                        <input type="text" name="services[{{ $i }}][notes]" class="form-control" placeholder="Keterangan...">
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>

                    {{-- BAGIAN 3: BIAYA TAMBAHAN & TOMBOL --}}
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="card bg-light border">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">Biaya Admin (Rp)</label>
                                        <input type="number" name="admin_fee" class="form-control text-end" value="0">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Pajak (Rp)</label>
                                        <input type="number" name="tax" class="form-control text-end" value="0">
                                    </div>
                                    <hr>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="bi bi-save"></i> SIMPAN TRANSAKSI
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- LIHAT DISINI: TIDAK ADA SECTION SCRIPT SAMA SEKALI --}}
