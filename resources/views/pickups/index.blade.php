@extends('layouts.vertical', ['title' => 'Pengambilan Laundry'])

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
</style>

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Pengambilan Laundry (Pickup)</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Cucian Siap Ambil (Status: Proses)</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="datatable_2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="15%">Kode Order</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Tgl Masuk</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Total Tagihan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $trx)
                                    <tr class="{{ $trx->order_status == '1' ? 'table-light' : '' }}">
                                        <td><strong>{{ $trx->order_code }}</strong></td>
                                        <td>{{ $trx->customer->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($trx->order_date)->format('d M Y') }}</td>
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
                                        <td>
                                            <span
                                                class="fw-bold {{ $trx->order_status == '1' ? 'text-success' : 'text-primary' }}">
                                                Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($trx->order_status == '0')
                                                <span class="badge bg-warning text-dark">Belum Diambil</span>
                                            @else
                                                <span class="badge bg-success">Sudah Diambil</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($trx->order_status == '0')
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#pickupModal{{ $trx->id }}">
                                                    <i class="bi bi-bag-check"></i> Proses Ambil
                                                </button>

                                                <div class="modal fade" id="pickupModal{{ $trx->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title">Pembayaran & Pengambilan</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form action="{{ route('pickups.store') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body text-start">
                                                                    <input type="hidden" name="id_order"
                                                                        value="{{ $trx->id }}">

                                                                    <div class="alert alert-light border mb-3">
                                                                        <strong>Order:</strong> {{ $trx->order_code }}<br>
                                                                        <strong>Pelanggan:</strong>
                                                                        {{ $trx->customer->nama }}
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Total Tagihan</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text">Rp</span>
                                                                            <input type="text"
                                                                                class="form-control fw-bold text-dark"
                                                                                value="{{ number_format($trx->total_price, 0, ',', '.') }}"
                                                                                readonly>
                                                                            <input type="hidden" class="total-bill"
                                                                                value="{{ $trx->total_price }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Uang Bayar
                                                                            (Diterima)
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text">Rp</span>
                                                                            <input type="number" name="order_pay"
                                                                                class="form-control input-pay"
                                                                                placeholder="0" required
                                                                                min="{{ $trx->total_price }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kembalian</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text">Rp</span>
                                                                            <input type="text"
                                                                                class="form-control input-change-display"
                                                                                value="0" readonly>
                                                                            <input type="hidden" name="order_change"
                                                                                class="input-change" value="0">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Catatan (Opsional)</label>
                                                                        <textarea name="notes" class="form-control" rows="2" placeholder="Catatan pengambilan..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-submit" disabled>Simpan
                                                                        Selesai</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <button class="btn btn-sm btn-light border text-success" disabled>
                                                    <i class="bi bi-check-circle-fill"></i> Selesai
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada cucian yang perlu diambil.</td>
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

@section('script-bottom')
    @vite(['resources/js/pages/datatable.init.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payInputs = document.querySelectorAll('.input-pay');

            payInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const modal = this.closest('.modal');
                    const totalBill = parseFloat(modal.querySelector('.total-bill').value);
                    const payAmount = parseFloat(this.value) || 0;
                    const submitBtn = modal.querySelector('.btn-submit');
                    const change = payAmount - totalBill;
                    const displayChange = modal.querySelector('.input-change-display');
                    const inputChange = modal.querySelector('.input-change');

                    if (change >= 0) {
                        displayChange.value = new Intl.NumberFormat('id-ID').format(change);
                        inputChange.value = change;

                        submitBtn.disabled = false;
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        displayChange.value = 'Uang Kurang!';
                        inputChange.value = 0;

                        submitBtn.disabled = true;
                        this.classList.add('is-invalid');
                    }
                });
            });
        });
    </script>
@endsection
