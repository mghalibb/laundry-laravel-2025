@extends('layouts.vertical', ['title' => 'Tambah Pelanggan'])
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
                <h4 class="page-title">Tambah Pelanggan Baru</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Data Pelanggan</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Data Pelanggan</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf

                        {{-- Nama Pelanggan --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-user"></i></span>
                                <input type="text" class="form-control" name="nama"
                                    placeholder="Masukkan nama pelanggan" required value="{{ old('nama') }}">
                            </div>
                            @error('nama')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon / WA</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="number" class="form-control" name="tlp" placeholder="08xxxxxxxx" required
                                    value="{{ old('tlp') }}">
                            </div>
                            @error('tlp')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jk" required>
                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Pelanggan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
