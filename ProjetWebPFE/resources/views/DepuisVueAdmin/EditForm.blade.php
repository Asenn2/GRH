@extends('layout')

@section('title', 'Edit User')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>
                <div class="card-body">
                    <form action="{{ route('adminUpdate', ['id' => $user->idlogin_table]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (leave blank to keep current password)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" name="role" class="form-control" value="{{ $user->role }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="idEmploye" class="form-label">Employé ID</label>
                            <input type="number" name="idEmploye" class="form-control" value="{{ $user->idEmploye }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('adminPannel') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
