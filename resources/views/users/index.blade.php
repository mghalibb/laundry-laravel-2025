@extends('layouts.vertical', ['title' => 'User Management'])

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
                <h4 class="page-title">Users</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Table Contents --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Users Details</h4>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('users.create') }}" class="btn btn-md btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Add User
                            </a>
                            {{-- {{ route('second', ['users', 'add']) }} | {{ route('users.create') }} --}}

                            <a href="{{ route('users.trash') }}" class="btn btn-secondary">
                                <i class="fas fa-recycle me-1"></i> Recycle Bin
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
                                    <th scope="col">NAME</th>
                                    <th scope="col">USERNAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">LEVEL</th>
                                    <th scope="col">CREATED AT</th>
                                    <th scope="col">UPDATED AT</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (isset($user->level))
                                                @if ($user->level->nama_level == 'Superadmin')
                                                    <span class="badge bg-success">{{ $user->level->nama_level }}</span>
                                                @elseif ($user->level->nama_level == 'Administrator')
                                                    <span class="badge bg-primary">{{ $user->level->nama_level }}</span>
                                                @elseif ($user->level->nama_level == 'Operator')
                                                    <span
                                                        class="badge bg-info text-dark">{{ $user->level->nama_level }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $user->level->nama_level }}</span>
                                                @endif
                                            @else
                                                <span class="badge bg-light text-dark">No Level</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }}
                                        </td>
                                        <td>
                                            {{ $user->updated_at ? $user->updated_at->format('d M Y, H:i') : '-' }}
                                        </td>
                                        <td>
                                            @if (auth()->user()->id == $user->id)
                                                <span class="badge bg-light text-dark">-- (This Is You) --</span>
                                            @else
                                                {{-- === BUTTON VIEW === --}}
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#viewUserModal" data-name="{{ $user->name }}"
                                                    data-username="{{ $user->username }}" data-email="{{ $user->email }}"
                                                    data-level="{{ $user->level?->nama_level ?? 'No Level' }}"
                                                    data-created-at="{{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }}"
                                                    data-photo="{{ $user->photo ? asset('storage/' . $user->photo) : '/images/users/avatar-2.jpg' }}">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                {{-- === BUTTON VIEW === --}}

                                                {{-- === BUTTON EDIT === --}}
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-warning btn-md">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                {{-- === BUTTON EDIT === --}}

                                                {{-- === BUTTON DELETE === --}}
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display:inline;" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-md"
                                                        data-title="You Are Sure?"
                                                        data-text="This data cannot be recovered again!"
                                                        data-confirm="Yes, Delete it!">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                {{-- === BUTTON DELETE === --}}
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th scope="col" class="text-center" width="5%">NO</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">USERNAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">LEVEL</th>
                                    <th scope="col">CREATED AT</th>
                                    <th scope="col">UPDATED AT</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Table Contents --}}

    {{-- === BUTTON VIEW === --}}
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="modalUserPhoto" src="" class="rounded-circle" alt="User Photo" width="100"
                            height="100" style="object-fit: cover;">
                    </div>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 30%;">Name</th>
                                <td>: <span id="modalUserName"></span></td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%;">Username</th>
                                <td>: <span id="modalUserUsername"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>: <span id="modalUserEmail"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Level</th>
                                <td>: <span id="modalUserLevel"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Created At</th>
                                <td>: <span id="modalUserCreatedAt"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- === BUTTON VIEW === --}}
@endsection

@section('script-bottom')
    @vite(['resources/js/pages/datatable.init.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var viewUserModal = document.getElementById('viewUserModal');
            if (viewUserModal) {
                viewUserModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;

                    var name = button.dataset.name;
                    var username = button.dataset.username;
                    var email = button.dataset.email;
                    var levelName = button.dataset.level;
                    var createdAt = button.dataset.createdAt;
                    var photo = button.dataset.photo;
                    var modal = this;

                    modal.querySelector('#modalUserName').textContent = name;
                    modal.querySelector('#modalUserUsername').textContent = username;
                    modal.querySelector('#modalUserEmail').textContent = email;
                    modal.querySelector('#modalUserphoto').src = photo;
                    modal.querySelector('#modalUserCreatedAt').textContent = createdAt;

                    // Update Level
                    var levelBadge = '';
                    if (levelName === 'Superadmin') {
                        levelBadge = '<span class="badge bg-success">' + levelName + '</span>';
                    } else if (levelName === 'Administrator') {
                        levelBadge = '<span class="badge bg-primary">' + levelName + '</span>';
                    } else if (levelName === 'Operator') {
                        levelBadge = '<span class="badge bg-info text-dark">' + levelName + '</span>';
                    } else if (levelName === 'Leader') {
                        levelBadge = '<span class="badge bg-secondary">' + levelName + '</span>';
                    } else {
                        levelBadge = '<span class="badge bg-light text-dark">No Level</span>';
                    }
                    modal.querySelector('#modalUserLevel').innerHTML = levelBadge;
                });
            }

            // --- SCRIPT FORM DELETE ---
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
            // --- SCRIPT FORM DELETE ---
        });
    </script>
@endsection
