@php
    /** @var \Illuminate\Database\Eloquent\Collection $levels */
    /** @var \Illuminate\Database\Eloquent\Collection $users */
@endphp
@extends('layouts.vertical', ['title' => 'Levels & Permissions'])

@section('css')
    @vite(['node_modules/simple-datatables/dist/style.css'])
@endsection
<style>
    #datatable_1 td,
    #datatable_1 th {
        font-size: 14px;
        vertical-align: middle;
    }

    #datatable_1 .badge {
        font-size: 13px;
        padding: 0.4em 0.6em;
        font-weight: 600;
    }

    #datatable_1 .btn {
        padding: 0.5rem 0.9rem;
        font-size: 16px;
        font-weight: 900;
    }

    #datatable_2 td,
    #datatable_2 th {
        vertical-align: middle;
    }

    #datatable_2 .thumb-md {
        height: 48px !important;
        width: 48px !important;
        font-size: 20px;
    }

    #datatable_2 .badge {
        font-size: 13px;
        padding: 0.4em 0.65em;
        font-weight: 600;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Levels & Permissions</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('any', 'index') }}">Dashboard</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Management</a></li> --}}
                        <li class="breadcrumb-item active">Levels & Permissions</li>
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
                            <h4 class="card-title">Level Management</h4>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('levels.create') }}" class="btn bg-primary text-white">
                                <i class="fas fa-plus-circle me-1"></i> Add New Level
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable_1">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center" width="5%">NO</th>
                                    <th scope="col">CREATE DATE</th>
                                    <th scope="col">LEVEL NAME</th>
                                    <th scope="col">DESCRIPTION</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col" class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($levels as $level)
                                    <tr>
                                        <td class="text-center" scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $level->created_at->format('d M Y, H:i') }}</td>
                                        <td>{{ $level->nama_level }}</td>
                                        <td style="max-width: 300px;">{{ $level->description }}</td>
                                        <td>
                                            @if ($level->status == 'Active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('levels.edit', $level->id) }}" class="btn btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('levels.destroy', $level->id) }}" method="POST"
                                                style="display:inline;" class="form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-title="Are you sure?"
                                                    data-text="This level will be deleted!" data-confirm="Yes, Delete it!">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Levels Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Assign Levels to Users</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable_2">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center" width="5%">NO</th>
                                    <th scope="col">USERNAME</th>
                                    <th scope="col">LEVEL PERMISSION</th>
                                    <th scope="col" class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : '/images/users/avatar-2.jpg' }}"
                                                    class="me-2 thumb-md align-self-center rounded-circle" alt="Photo">
                                                <div class="flex-grow-1 text-truncate">
                                                    <h6 class="m-0">{{ $user->name }}</h6>
                                                    <p class="fs-12 text-muted mb-0">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
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
                                                <span class="badge bg-light text-dark">No Level Assigned</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="width: 200px;">
                                            <form action="{{ route('levels.assign', $user->id) }}" method="POST"
                                                class="form-assign-level">
                                                @csrf
                                                <select class="form-select form-select-sm" name="id_level"
                                                    onchange="this.form.submit()">
                                                    <option value="" {{ !$user->id_level ? 'selected' : '' }}>--
                                                        Assign Level --</option>
                                                    @foreach ($levels->where('status', 'Active') as $level)
                                                        <option value="{{ $level->id }}"
                                                            {{ $user->id_level == $level->id ? 'selected' : '' }}>
                                                            {{ $level->nama_level }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Users Found</td>
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
            //  === Script SweetAlert ===
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

            // === Script for auto-submit level (optional, can be deleted if you don't like it) ===
            // const assignForms = document.querySelectorAll('.form-assign-level select');
            // assignForms.forEach(select => {
            //     select.addEventListener('change', function() {
            //         this.form.submit();
            //     });
            // });
        });
    </script>
@endsection
