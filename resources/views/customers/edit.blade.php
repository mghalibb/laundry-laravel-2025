@extends('layouts.vertical', ['title' => 'Edit Pelanggan'])
<style>
    /* Hilangkan panah untuk Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Hilangkan panah untuk Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Edit Data Pelanggan</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Data Pelanggan</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Edit User --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Informasi Pelanggan</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama Pelanggan --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-user"></i></span>
                                <input type="text" class="form-control" name="nama"
                                    value="{{ old('nama', $customer->nama) }}" required>
                            </div>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon / WA</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="number" class="form-control" name="tlp"
                                    value="{{ old('tlp', $customer->tlp) }}" required>
                            </div>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jk" required>
                                <option value="L" {{ old('jk', $customer->jk) == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P" {{ old('jk', $customer->jk) == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="3" required>{{ old('alamat', $customer->alamat) }}</textarea>
                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
