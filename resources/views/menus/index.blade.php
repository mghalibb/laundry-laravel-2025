@extends('layouts.vertical', ['title' => 'Manajemen Menu'])

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
        font-size: 16px;
        font-weight: 900;
        margin: 1rem 0;
    }

    /* Remove the arrow for Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Remove the arrow for Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Manajemen Menu Sidebar</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Menu</li>
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
                            <h4 class="card-title">Manajemen Menu</h4>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addMenuModal">
                                <i class="bi bi-plus-circle"></i> Tambah Menu Baru
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable_2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center" width="5%">NO</th>
                                    <th scope="col">MENU NAME</th>
                                    <th scope="col">CATEGORY</th>
                                    <th scope="col">URL / ROUTE</th>
                                    <th scope="col">ICON</th>
                                    <th scope="col">ACCESS RIGHTS</th>
                                    <th scope="col">ORDER</th>
                                    <th scope="col" class="text-center" width="15%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menus as $menu)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="fw-bold">{{ $menu->title }}</td>
                                        <td><span class="badge bg-light text-dark border">{{ $menu->category }}</span></td>
                                        <td><code>{{ $menu->url }}</code></td>
                                        <td><i class="{{ $menu->icon }} fs-5"></i> <span
                                                class="text-muted small">({{ $menu->icon }})</span></td>
                                        <td>
                                            {{-- @foreach (explode(',', $menu->roles) as $role)
                                                <span class="badge bg-info-subtle text-info"
                                                    style="margin: 4px 0">{{ $role }}</span>
                                            @endforeach --}}
                                            @foreach ($menu->levels as $level)
                                                <span class="badge bg-info-subtle text-info"
                                                    style="margin: 4px 0">{{ $level->nama_level }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">{{ $menu->order }}</td>
                                        <td class="text-center">
                                            {{-- TOMBOL EDIT --}}
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editMenuModal{{ $menu->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            {{-- TOMBOL EDIT --}}

                                            {{-- TOMBOL HAPUS --}}
                                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                                class="d-inline form-delete">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    data-title="Hapus Menu?" data-text="Menu ini akan hilang dari sidebar!"
                                                    data-confirm="Ya, Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            {{-- TOMBOL HAPUS --}}
                                        </td>
                                    </tr>

                                    {{-- === MODAL EDIT MENU === --}}
                                    <div class="modal fade" id="editMenuModal{{ $menu->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Menu</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('menus.update', $menu->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Menu</label>
                                                            <input type="text" name="title" class="form-control"
                                                                value="{{ $menu->title }}" required>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Route Name</label>
                                                                <input type="text" name="url" class="form-control"
                                                                    value="{{ $menu->url }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Icon Class</label>
                                                                <input type="text" name="icon" class="form-control"
                                                                    value="{{ $menu->icon }}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Kategori</label>
                                                                <input type="text" name="category" class="form-control"
                                                                    list="categoryOptions" value="{{ $menu->category }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Urutan</label>
                                                                <input type="number" name="order" class="form-control"
                                                                    value="{{ $menu->order }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label d-block">Hak Akses (Siapa yang bisa
                                                                lihat?)</label>
                                                            @foreach ($levels as $level)
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="roles[]" value="{{ $level->id }}"
                                                                        id="roleEdit{{ $menu->id }}{{ $level->id }}"
                                                                        {{ $menu->levels->contains('id', $level->id) ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="roleEdit{{ $menu->id }}{{ $level->id }}">{{ $level->nama_level }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Menu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- === MODAL EDIT MENU === --}}
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data menu.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" class="text-center" width="5%">NO</th>
                                    <th scope="col">NAMA MENU</th>
                                    <th scope="col">KATEGORI</th>
                                    <th scope="col">URL / ROUTE</th>
                                    <th scope="col">ICON</th>
                                    <th scope="col">Hak Akses (Roles)</th>
                                    <th scope="col">Urutan</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- === MODAL TAMBAH MENU (DI LUAR LOOP) === --}}
    <div class="modal fade" id="addMenuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Menu Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('menus.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Menu</label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Laporan Stok"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Route Name</label>
                                <input type="text" name="url" class="form-control"
                                    placeholder="Contoh: reports.stock" required>
                                <small class="text-muted">Harus sesuai route di web.php</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Icon Class</label>
                                <input type="text" name="icon" class="form-control"
                                    placeholder="Contoh: bi bi-box">
                                <small class="text-muted"><a href="https://icons.getbootstrap.com/" target="_blank">Lihat
                                        Icon</a></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="category" class="form-control" list="categoryOptions"
                                    placeholder="Pilih atau Ketik Baru..." required>
                                <datalist id="categoryOptions">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat }}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Urutan</label>
                                <input type="number" name="order" class="form-control" value="1" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Hak Akses (Wajib Pilih)</label>
                            @foreach ($levels as $level)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="roles[]"
                                        value="{{ $level->id }}" id="roleAdd{{ $level->id }}">
                                    <label class="form-check-label"
                                        for="roleAdd{{ $level->id }}">{{ $level->nama_level }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-bottom')
    @vite(['resources/js/pages/datatable.init.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.form-delete');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const button = this.querySelector('button[type="submit"]');
                    Swal.fire({
                        title: button.dataset.title,
                        text: button.dataset.text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: button.dataset.confirm
                    }).then((result) => {
                        if (result.isConfirmed) {
                            event.target.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
