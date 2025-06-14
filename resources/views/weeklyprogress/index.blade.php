@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>My Weekly Progress</h2>
        @if(session('user') && session('user')->role === 'Platinum')
            <a class="btn btn-primary" href="{{ route('weeklyprogress.create') }}">+ Add Weekly Progress</a>
        @endif
    </div>

    <form action="{{ route('weeklyprogress.index') }}" method="GET" class="mb-4 d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Search by Progress ID" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="mb-3">
        <h5>Total Weekly Progress Submitted: {{ $totalProgress }}</h5>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Progress ID</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Progress Info</th>
                    <th scope="col">Feedback</th>
                    <th scope="col">Created At</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($weeklyprogress as $progress)
                    <tr>
                        <td>{{ $progress->id }}</td>
                        <td>{{ $progress->startDate }}</td>
                        <td>{{ $progress->endDate }}</td>
                        <td>{{ $progress->progressinfo }}</td>
                        <td>{{ $progress->feedback }}</td>
                        <td>{{ \Carbon\Carbon::parse($progress->created_at)->timezone('Asia/Kuala_Lumpur')->format('d-m-Y H:i') }}</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-start flex-wrap">
                                @if($progress->feedback)
                                        <span class="d-inline-block me-1" tabindex="0" data-bs-toggle="tooltip" title="Cannot edit after feedback has been given.">
                                        <button class="btn btn-sm btn-secondary" style="pointer-events: none;" disabled>Edit</button>
                                    </span>
                                @else
                                    <a href="{{ route('weeklyprogress.edit', $progress->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                @endif
                                <a href="{{ route('weeklyprogress.viewFeedback', $progress->id) }}" class="btn btn-sm btn-info">View Feedback</a>

                                @if ($progress->feedback)
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Cannot delete after feedback has been given">
                                        <button class="btn btn-sm btn-danger" disabled style="pointer-events: none;">Delete</button>
                                    </span>
                                @else
                                    <form action="{{ route('weeklyprogress.destroy', $progress->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this weekly progress?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No weekly progress submitted yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
