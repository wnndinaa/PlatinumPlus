@extends('layout')

@section('content')
    <div class="content">
        <div class="">
            <form method="GET" action="{{ url()->current() }}" class="mb-3">
                <Table>
                    <tr>
                        <td>
                            <h2>All Publications</h2>
                        </td>
                        <td>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search by Author/Title/Type" class="form-control" style="margin-left: 298%" />
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary" style="margin-left: 860%">Search</button>
                        </td>
                    </tr>
                </Table>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Year</th>
                        <th>Publication Type</th>
                        <th>DOI</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publications as $publication)
                        <tr>
                            <td>{{ $publication->publication_title }}</td>
                            <td>{{ $publication->publication_author }}</td>
                            <td>{{ \Carbon\Carbon::parse($publication->publication_date)->format('Y') }}</td>
                            <td>{{ $publication->publication_type }}</td>
                            <td>{{ $publication->publication_DOI }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $publication->publication_file) }}" target="_blank"
                                    class="btn btn-info btn-sm">
                                    View
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('publication.MyPublication') }}">
                        <button class="btn btn-primary">Go To My Publication</button>
                    </a>
                    <div>
                        {{ $publications->links() }}
                    </div>
                </div>
        </div>
    @endsection
