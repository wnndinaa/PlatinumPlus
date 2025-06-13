@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Platinum List</h2>

    <!-- Search form -->
    <form method="GET" action="{{ route('draftThesis.platinumList') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($platinums as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->username }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->phonenumber }}</td>
                    <td>
                        <a href="{{ route('draftThesis.platinumDrafts', $p->username) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
