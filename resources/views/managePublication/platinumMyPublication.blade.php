{{-- <script>
    function togglePassword() {
        const input = document.getElementById('password');
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script> --}}


@extends('layout')

@section('content')
    <div class="content">
        <div class="card">
            <h2>My Publication</h2>

            <!-- Search bar -->
            <form method="GET" action="#" class="mb-3">
                <Table>
                    <tr>
                        <td>
                            <input type="text" name="search" placeholder="Search publications..." class="form-control" />
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Search</button>
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
                                <a href="{{ route('publication.MyPublication.edit', $publication->publication_id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('publication.MyPublication.delete', $publication->publication_id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete the publication: {{ $publication->publication_title }}?');"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('publication.MyPublication.add') }}">
                <button class="btn btn-primary">Add Publication</button>
            </a>
        </div>
    </div>
@endsection
