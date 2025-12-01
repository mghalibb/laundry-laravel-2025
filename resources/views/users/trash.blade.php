@extends('layouts.vertical', ['title' => 'Recycle Bin'])

@section('css')
    @vite(['node_modules/simple-datatables/dist/style.css'])
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
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Recycle Bin</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Management</a></li>
                        <li class="breadcrumb-item active">Recycle Bin</li>
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
                            <h4 class="card-title">Deleted Users</h4>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Back to Users List
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable_2">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>LEVEL</th>
                                    <th>DELETED AT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span
                                                class="badge bg-light text-dark">{{ $user->level?->nama_level ?? 'No Level' }}</span>
                                        </td>
                                        <td>{{ $user->deleted_at ? $user->deleted_at->format('d M Y, H:i') : '-' }}</td>
                                        <td>
                                            {{-- BUTTON RESTORE --}}
                                            <form action="{{ route('users.restore', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-arrow-counterclockwise"></i> Restore
                                                </button>
                                            </form>
                                            {{-- BUTTON RESTORE --}}

                                            {{-- BUTTON DELETE PERMANENTLY --}}
                                            <form action="{{ route('users.forceDelete', $user->id) }}" method="POST"
                                                style="display:inline;" class="form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    data-title="ARE YOU ABSOLUTELY SURE?"
                                                    data-text="This action cannot be undone and the user will be gone forever!"
                                                    data-confirm="Yes, Delete it permanently!">
                                                    <i class="bi bi-trash3-fill"></i> Delete Permanently
                                                </button>
                                            </form>
                                            {{-- BUTTON DELETE PERMANENTLY --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Recycle Bin is Empty</td>
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
            const deleteForms = document.querySelectorAll('.form-delete');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const button = this.querySelector('button[type="submit"]');
                    const title = button.dataset.title || 'Are you sure?';
                    const text = button.dataset.text || 'This action cannot be undone!';
                    const confirmText = button.dataset.confirm || 'Yes, do it!';

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: confirmText
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
