@extends('layouts.vertical', ['title' => 'Transaksi Baru'])

@section('css')
    {{-- 1. CSS Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- 1. CSS Select2 --}}

    {{-- CSS Themes Bootstrap 5 --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    {{-- CSS Themes Bootstrap 5 --}}
    <style>
        .total-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .bg-light-blue {
            background-color: #f8f9fa;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .stealth-input {
            border: none !important;
            background-color: transparent !important;
            text-align: right;
            font-weight: bold;
            color: #2c3e50;
            padding: 0;
            width: 100%;
            cursor: default;
        }

        .stealth-input:not([readonly]):focus {
            outline: none;
            border-bottom: 1px dashed #999 !important;
        }

        .percent-input {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 2px 5px;
            text-align: center;
            font-size: 11px;
            width: 50px;
            margin-right: 5px;
        }

        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 0.5rem 0.8rem;
            font-size: 14px;
            font-weight: 900;
            color: #000000;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Buat Transaksi Baru</h4>
                    <span class="badge bg-primary fs-6">{{ $orderCode }}</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
                        @csrf
                        <input type="hidden" name="order_code" value="{{ $orderCode }}">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Pilih Pelanggan</label>
                                {{-- <select class="form-select" name="id_customer" required>
                                    <option value="" disabled selected>-- Cari Nama Pelanggan --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->nama }} - {{ $customer->tlp }}
                                        </option>
                                    @endforeach
                                </select> --}}

                                <select class="form-select select2" name="id_customer" required>
                                    <option value="" selected></option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->nama }} - {{ $customer->tlp }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    <small class="text-muted">Pelanggan belum ada? <a
                                            href="{{ route('customers.create') }}">Tambah Baru</a></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tanggal Transaksi</label>
                                <input type="text" class="form-control" value="{{ date('d F Y') }}" readonly>
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered" id="itemsTable">
                                <thead class="bg-light-blue">
                                    <tr>
                                        <th width="30%">Jenis Layanan</th>
                                        <th width="15%">Harga Satuan</th>
                                        <th width="10%">Qty (Kg/Pcs)</th>
                                        <th width="20%">Subtotal</th>
                                        <th width="20%">Catatan (Opsional)</th>
                                        <th width="5%" class="text-center">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="item-row">
                                        <td>
                                            <select name="services[0][id_service]" class="form-select service-select"
                                                required>
                                                <option value="" data-price="0" selected>-- Pilih Layanan --</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                                        {{ $service->service_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control price-display" value="Rp 0"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="services[0][qty]" class="form-control qty-input"
                                                value="1" min="0.001" step="0.001" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control subtotal-display" value="Rp 0"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="services[0][notes]" class="form-control"
                                                placeholder="Contoh: Jangan digosok">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-row" disabled><i
                                                    class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <button type="button" class="btn btn-success btn-sm" id="addRow">
                                                <i class="bi bi-plus-circle"></i> Tambah Baris
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-4">
                                <div class="card bg-light-blue">
                                    <div class="card-body">
                                        {{-- Subtotal Item --}}
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-muted">Subtotal Jasa</span>
                                            <span class="fw-bold" id="subtotalText">Rp 0</span>
                                        </div>
                                        {{-- Subtotal Item --}}

                                        {{-- Input Biaya Admin --}}
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <span class="text-muted me-2 fw-bold">Biaya Admin</span>
                                                    <div class="form-check form-switch" style="min-height: auto;">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="manualAdminToggle" style="width: 25px; height: 12px;">
                                                    </div>
                                                </div>
                                                <div style="width: 120px;">
                                                    <input type="text" id="adminDisplay" class="stealth-input"
                                                        value="Rp 2.500" readonly>
                                                    <input type="hidden" name="admin_fee" id="adminInput" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Input Biaya Admin --}}

                                        {{-- Input Pajak --}}
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <span class="text-muted me-2 fw-bold">Pajak</span>
                                                    <div class="form-check form-switch" style="min-height: auto;">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="manualTaxToggle" style="width: 25px; height: 12px;">
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end align-items-center"
                                                    style="width: 150px;">
                                                    <div id="taxRateWrapper" style="display: none;"
                                                        class="align-items-center">
                                                        <input type="number" id="taxRateInput" class="percent-input"
                                                            value="11" placeholder="%">
                                                        <span class="text-muted me-2">%</span>
                                                    </div>
                                                    <input type="text" id="taxDisplay" class="stealth-input"
                                                        value="Rp 0" readonly>
                                                    <input type="hidden" name="tax" id="taxInput" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Input Pajak --}}

                                        <hr>

                                        {{-- Grand Total --}}
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="total-text">Grand Total:</span>
                                            <span class="total-text text-primary" id="grandTotal">Rp 0</span>
                                        </div>
                                        {{-- Grand Total --}}
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary btn-lg">Simpan
                                                Transaksi</button>
                                            <a href="{{ route('transactions.index') }}"
                                                class="btn btn-secondary">Batal</a>
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

@section('script-bottom')
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- jQuery --}}

    {{-- JS Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- JS Select2 --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rowCount = 1;

            // === FUNGSI FORMAT RUPIAH ===
            function formatRupiah(angka) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
            }

            function parseRupiah(rupiahString) {
                return parseFloat(rupiahString.replace(/[^0-9,-]+/g, "").replace(',', '.')) || 0;
            }
            // === FUNGSI FORMAT RUPIAH ===

            // === FUNGSI UPDATE SUBTOTAL, ADMIN FEE, TAX & GRAND TOTAL ===
            function updateCalculations() {
                let subtotalJasa = 0;
                document.querySelectorAll('.item-row').forEach(row => {
                    const select = row.querySelector('.service-select');
                    const priceDisplay = row.querySelector('.price-display');
                    const qtyInput = row.querySelector('.qty-input');
                    const subtotalDisplay = row.querySelector('.subtotal-display');

                    const price = parseFloat(select.options[select.selectedIndex].dataset.price) || 0;
                    const qty = parseFloat(qtyInput.value) || 0;
                    const subtotal = price * qty;

                    subtotalJasa += subtotal;
                    priceDisplay.value = formatRupiah(price);
                    subtotalDisplay.value = formatRupiah(subtotal);
                });
                const isManualAdmin = document.getElementById('manualAdminToggle').checked;
                let adminFee = 0;

                if (isManualAdmin) {
                    adminFee = parseFloat(document.getElementById('adminInput').value) || 0;
                } else {
                    adminFee = 2500;
                    document.getElementById('adminInput').value = adminFee;
                    document.getElementById('adminDisplay').value = formatRupiah(adminFee);
                }

                const isManualTax = document.getElementById('manualTaxToggle').checked;
                let tax = 0;
                let taxRate = 11; // Default 11%

                if (isManualTax) {
                    taxRate = parseFloat(document.getElementById('taxRateInput').value) || 0;
                } else {
                    document.getElementById('taxRateInput').value = 11; // Reset ke default 11% jika otomatis
                    taxRate = 11; // Reset ke default 11% jika otomatis
                }

                tax = subtotalJasa * (taxRate / 100);
                document.getElementById('taxInput').value = tax;
                document.getElementById('taxDisplay').value = formatRupiah(tax);
                const grandTotal = subtotalJasa + adminFee + tax;

                document.getElementById('subtotalText').textContent = formatRupiah(subtotalJasa);
                document.getElementById('grandTotal').textContent = formatRupiah(grandTotal);
            }
            // === FUNGSI UPDATE SUBTOTAL, ADMIN FEE, TAX & GRAND TOTAL ===

            // === EVENT LISTENER (SAAT INPUT BERUBAH) ===
            document.getElementById('manualAdminToggle').addEventListener('change', function() {
                const displayInput = document.getElementById('adminDisplay');
                const hiddenInput = document.getElementById('adminInput');

                if (this.checked) {
                    // MODE MANUAL:
                    displayInput.removeAttribute('readonly');
                    displayInput.value = hiddenInput.value;
                    displayInput.type = 'number';
                    displayInput.focus();
                } else {
                    // MODE AUTO:
                    displayInput.setAttribute('readonly', true);
                    displayInput.type = 'text';
                    updateCalculations();
                }
            });

            document.getElementById('adminDisplay').addEventListener('input', function() {
                document.getElementById('adminInput').value = this.value;
                updateCalculations();
            });

            document.getElementById('manualTaxToggle').addEventListener('change', function() {
                const rateWrapper = document.getElementById('taxRateWrapper');
                if (this.checked) {
                    rateWrapper.style.display = 'flex';
                    document.getElementById('taxRateInput').focus();
                } else {
                    rateWrapper.style.display = 'none';
                    updateCalculations();
                }
            });

            document.getElementById('taxRateInput').addEventListener('input', updateCalculations);
            const itemsTable = document.querySelector('#itemsTable');
            itemsTable.addEventListener('input', e => {
                if (e.target.matches('.qty-input, .service-select')) updateCalculations();
            });
            itemsTable.addEventListener('change', e => {
                if (e.target.matches('.service-select')) updateCalculations();
            });
            // === EVENT LISTENER (SAAT INPUT BERUBAH) ===

            // === TAMBAH BARIS BARU ===
            document.getElementById('addRow').addEventListener('click', function() {
                const tableBody = document.querySelector('#itemsTable tbody');
                const newRow = document.createElement('tr');
                newRow.classList.add('item-row');

                newRow.innerHTML = `
                <td>
                    <select name="services[${rowCount}][id_service]" class="form-select service-select" required>
                        <option value="" data-price="0" selected>-- Pilih Layanan --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                {{ $service->service_name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" class="form-control price-display" value="Rp 0" readonly></td>
                <td><input type="number" name="services[${rowCount}][qty]" class="form-control qty-input" value="1" min="0.001" step="0.001" required></td>
                <td><input type="text" class="form-control subtotal-display" value="Rp 0" readonly></td>
                <td><input type="text" name="services[${rowCount}][notes]" class="form-control" placeholder="Catatan..."></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="bi bi-trash"></i></button>
                </td>
            `;

                tableBody.appendChild(newRow);
                rowCount++;
                checkDeleteButtons();
            });
            // === TAMBAH BARIS BARU ===

            // === HAPUS BARIS ===
            itemsTable.addEventListener('click', function(e) {
                if (e.target.closest('.remove-row')) {
                    const row = e.target.closest('tr');
                    if (document.querySelectorAll('.item-row').length > 1) {
                        row.remove();
                        updateCalculations();
                        checkDeleteButtons();
                    } else {
                        alert("Minimal harus ada satu item layanan!");
                    }
                }
            });

            function checkDeleteButtons() {
                const rows = document.querySelectorAll('.item-row');
                const buttons = document.querySelectorAll('.remove-row');

                if (rows.length === 1) {
                    buttons.forEach(btn => btn.disabled = true);
                } else {
                    buttons.forEach(btn => btn.disabled = false);
                }
            }
            checkDeleteButtons();
            // === HAPUS BARIS ===
        });

        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Cari Nama Pelanggan --',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
