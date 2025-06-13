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
        <h2>My Submitted Draft Theses</h2>
        @if(session('user') && session('user')->role === 'Platinum')
            <a class="btn btn-primary" href="{{ route('draftThesis.create') }}">+ Add Draft Thesis</a>
        @endif
    </div>

    <form action="{{ route('draftThesis.index') }}" method="GET" class="mb-4 d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Search by Draft Thesis ID" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Draft Thesis ID</th>
                    <th scope="col">Draft Thesis Number</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Total Pages</th>
                    <th scope="col">Created At</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($draftthesis as $draft)
                    <tr>
                        <td>{{ $draft->id }}</td>
                        <td>{{ $draft->number }}</td>
                        <td>{{ $draft->title }}</td>
                        <td>{{ $draft->description }}</td>
                        <td>{{ $draft->totalpage }}</td>
                        <td>{{ \Carbon\Carbon::parse($draft->created_at)->timezone('Asia/Kuala_Lumpur')->format('d-m-Y H:i') }}</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-start flex-wrap">
                                <a href="{{ route('draftThesis.edit', $draft->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <a href="{{ route('draftThesis.viewfeedback', $draft->id) }}" class="btn btn-sm btn-info">View Feedback</a>

                                <form action="{{ route('draftThesis.destroy', $draft->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this draft thesis?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No draft theses submitted yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
