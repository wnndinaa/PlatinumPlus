{{-- resources/views/userlist.blade.php --}}
@extends('layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @php
        $user = session('user');
    @endphp

    @if($user && strtolower($user['role']) === 'staff')
        <h2>List of Registered Users</h2>
        <table class="table table-bordered mt-4">
            <thead class="table-light">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>{{ $u->username }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->role }}</td>
                        <td>
                            @if($u->username !== $user['username'])
                                <form action="{{ route('delete.user', ['username' => $u->username]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @else
                                <span class="text-muted small">(you)</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

<form method="GET" action="{{ route('export.users') }}" class="mt-4 d-flex gap-2 align-items-center">
    <label for="format" class="form-label mb-0">Export as:</label>
    <select name="format" id="format" class="form-select w-auto">
        <option value="pdf">PDF</option>
        <option value="csv">CSV (Excel)</option>
    </select>
    <button type="submit" class="btn btn-success">Export</button>
</form>

    @endif
@endsection
