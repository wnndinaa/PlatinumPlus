@extends('layout')

@section('content')
<div class="content">
    <div class="card mb-4">
        <h2>Profile Information</h2>
        <p><strong>Username:</strong> {{ $profile->username }}</p>
        <p><strong>Name:</strong> {{ $profile->name }}</p>
        <p><strong>IC:</strong> {{ $profile->ic }}</p>
        <p><strong>Email:</strong> {{ $profile->email }}</p>
        <p><strong>Phone Number:</strong> {{ $profile->phonenumber }}</p>
        <p><strong>Role:</strong> {{ $profile->role }}</p>

        <a href="{{ route('profile.edit') }}">
            <button class="btn btn-primary mt-3">Edit Profile</button>
        </a>
    </div>

    {{-- Search Form --}}
    <div class="card mb-4">
        <form method="GET" action="{{ route('profile.profile') }}">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search users by name or username">
                <button type="submit" class="btn btn-secondary">Search</button>
            </div>
        </form>
    </div>

    {{-- Search Results --}}
    @if(isset($results) && $results->isNotEmpty())
        <div class="card">
            <h4>Search Results:</h4>
            <ul class="list-group">
                @foreach($results as $user)
                    <li class="list-group-item">
                        <strong>{{ $user->name }}</strong> ({{ $user->username }}) - {{ $user->role }}
                    </li>
                @endforeach
            </ul>
        </div>
    @elseif(request()->has('search'))
        <div class="alert alert-warning">
            No users found matching your search.
        </div>
    @endif
</div>
@endsection
