@extends('layout')

@section('content')
<div class="content">

    {{-- Search Form --}}
    <div class="card p-4 mb-4">
    <form method="GET" action="{{ route('profile.profile') }}">
        <div class="row align-items-end">
            <div class="col-md-10 mb-3">
                <label for="searchRole">Search by Role:</label>
                <select name="searchRole" id="searchRole" class="form-select">
                    <option value="">-- Select Role --</option>
                    @foreach($searchRoleOptions as $role)
                        <option value="{{ $role }}" {{ request('searchRole') == $role ? 'selected' : '' }}>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-3">
                <button class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>
</div>


    {{-- Current User Profile --}}
    <div class="card p-4 mb-4">
        <h2 class="mb-4">Your Profile Information</h2>
        <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Username:</label>
                    <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>IC:</label>
                    <input type="text" class="form-control" value="{{ $user->ic }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Name:</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email:</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone Number:</label>
                    <input type="text" class="form-control" value="{{ $user->phonenumber }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Role:</label>
                    <input type="text" class="form-control" value="{{ $user->role }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Citizenship:</label>
                    <select class="form-select" disabled>
                        <option {{ $user->citizenship == 'Malaysian' ? 'selected' : '' }}>Malaysian</option>
                        <option {{ $user->citizenship == 'Non-Malaysian' ? 'selected' : '' }}>Non-Malaysian</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Gender:</label>
                    <select class="form-select" disabled>
                        <option {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                @if($platinum)
                    <div class="col-md-6 mb-3">
                        <label>Assigned CRMP:</label>
                        <input type="text" class="form-control" value="{{ $platinum->assignedCRMP }}" readonly>
                    </div>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </form>
    </div>

    {{-- Search Results --}}
    @if($searchResults->isNotEmpty())
        <div class="card p-4">
            <h3 class="mb-3">Search Results</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($searchResults as $u)
                        <tr>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->role }}</td>
                            <td>{{ $u->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif($hasSearched)
        <div class="alert alert-warning mt-3">
            No users found for "{{ request('search') }}".
        </div>
    @endif

</div>
@endsection
