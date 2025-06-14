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
                <th>Delete Request</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $u)
            <tr @if($u->delete_requested) class="table-warning" @endif>
                <td>{{ $u->username }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    @if($u->username !== $user['username'])
                        @if($u->delete_requested)
                            <form action="{{ route('delete.user.approve', ['username' => $u->username]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to approve and delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Approve</button>
                            </form>
                            <form action="{{ route('delete.user.reject', ['username' => $u->username]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to reject this request?');">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-sm btn-secondary">Reject</button>
                            </form>
                        @else
                            <span class="text-muted">No request</span>
                        @endif
                    @else
                        <span class="text-muted small">(you)</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- Export section --}}
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
