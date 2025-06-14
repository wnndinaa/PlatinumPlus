@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Weekly Progress Report</h2>

    <!-- Search form -->
    <form method="GET" action="{{ route('weeklyprogress.report') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search Platinum Name..." value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Filter form -->
    <form method="GET" action="{{ route('weeklyprogress.report') }}" class="mb-4 row g-3 align-items-end">
        <div class="col-md-3">
            <label for="total_progress" class="form-label">Min Total Weekly Progress</label>
            <input type="number" class="form-control" name="total_progress" id="total_progress" value="{{ request('total_progress') }}">
        </div>

        <div class="col-md-3">
            <label for="last_updated" class="form-label">Last Updated Date</label>
            <input type="date" class="form-control" name="last_updated" id="last_updated" value="{{ request('last_updated') }}">
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('weeklyprogress.report') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <!-- Report table -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Platinum Name</th>
                <th>Last Updated</th>
                <th>Total Progress Submitted</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->last_updated ? date('d/m/Y H:i', strtotime($row->last_updated)) : 'No Submission Yet' }}</td>
                    <td>{{ $row->total_progress }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Back button -->
    <a href="{{ route('weeklyprogress.WPplatinumList') }}" class="btn btn-secondary mb-3">
        Back to Platinum List
    </a>
</div>
@endsection
