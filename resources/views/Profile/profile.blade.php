@extends('layout')

@section('content')
<div class="content">
    <div class="card">
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
</div>
@endsection
