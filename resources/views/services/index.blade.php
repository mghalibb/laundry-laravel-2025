@extends('layouts.vertical', ['title' => 'Jenis Layanan'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title">Jenis Layanan (Service)</h4>
                <a href="{{ route('services.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Layanan</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Layanan</th>
                                    <th>Harga / Satuan</th>
                                    <th>Deskripsi</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $service)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $service->service_name }}</strong></td>
                                        <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                                        <td>{{ $service->description }}</td>
                                        <td>
                                            <a href="{{ route('services.edit', $service->id) }}"
                                                class="btn btn-xl btn-warning"><i class="bi bi-pencil"></i></a>

                                            <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                                style="display:inline;" class="form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xl btn-danger"
                                                    data-title="Hapus Layanan?"
                                                    data-text="Layanan '{{ $service->service_name }}' akan dihapus permanen!"
                                                    data-confirm="Ya, Hapus!">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data layanan.</td>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.form-delete');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const button = this.querySelector('button[type="submit"]');

                    Swal.fire({
                        title: button.dataset.title || 'Yakin hapus?',
                        text: button.dataset.text || 'Data tidak bisa dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: button.dataset.confirm || 'Ya, Hapus',
                        cancelButtonText: 'Batal'
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
