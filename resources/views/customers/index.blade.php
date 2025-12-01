@extends('layouts.vertical', ['title' => 'Data Pelanggan'])

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
    }
</style>
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Data Pelanggan</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Pelanggan</li>
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
                            <h4 class="card-title">Daftar Pelanggan Laundry</h4>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('customers.create') }}" class="btn btn-md btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Tambah Pelanggan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable_2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center" width="5%">NO</th>
                                    <th scope="col">NAMA PELANGGAN</th>
                                    <th scope="col">ALAMAT</th>
                                    <th scope="col">NO TELEPON</th>
                                    <th scope="col">JENIS KELAMIN</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr>
                                        <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $customer->nama }}</td>
                                        <td>{{ Str::limit($customer->alamat, 30) }}</td>
                                        <td>{{ $customer->tlp }}</td>
                                        <td>
                                            @if ($customer->jk == 'L')
                                                <span class="badge bg-info">Laki-laki</span>
                                            @else
                                                <span class="badge bg-pink text-dark"
                                                    style="background-color: #ffb6c1;">Perempuan</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- === BUTTON EDIT === --}}
                                            <a href="{{ route('customers.edit', $customer->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            {{-- === BUTTON DELETE === --}}
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                                style="display:inline;" class="form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    data-title="Hapus Pelanggan?"
                                                    data-text="Data {{ $customer->nama }} akan dihapus permanen!"
                                                    data-confirm="Ya, Hapus!">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data pelanggan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center" width="5%">NO</th>
                                    <th>NAMA PELANGGAN</th>
                                    <th>ALAMAT</th>
                                    <th>NO TELEPON</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>AKSI</th>
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
