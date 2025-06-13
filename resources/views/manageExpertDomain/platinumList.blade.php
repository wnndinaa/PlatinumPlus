@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Assigned Platinum Users</h3>

    <form method="GET" action="{{ route('manageExpertDomain.platinumList') }}" class="form-inline mb-3">
        <input type="text" name="search" value="{{ $search }}" class="form-control mr-2" placeholder="Search username or name">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @if ($platinums->isEmpty())
        <p>No Platinum users found.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($platinums as $platinum)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $platinum->username }}</td>
                    <td>{{ $platinum->name }}</td>
                    <td>
                        <a href="{{ route('manageExpertDomain.viewAssignedPlatinumExpert', $platinum->username) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('manageExpertDomain.platinumReport', $platinum->username) }}" class="btn btn-sm btn-secondary">Report</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
