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
            <h2>All Publications</h2>

            <!-- Search bar -->
            <form method="GET" action="#" class="mb-3">
                <Table>
                    <tr>
                        <td>
                            <input type="text" name="search" placeholder="Search publications..." class="form-control" />
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary mt-2">Search</button>
                        </td>
                    </tr>
                </Table>
            </form>

            <!-- Publication list -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($publications as $publication) --}}
                    <tr>
                        <td>Publication Title</td>
                        <td>Publication Authors</td>
                        <td>Publication Year</td>
                        {{-- <td>{{ $publication->title }}</td>
                    <td>{{ $publication->authors }}</td>
                    <td>{{ $publication->year }}</td> --}}
                        <td>
                            <!-- Maybe just view details, since not editable here -->
                            <a href="#" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>

            <a href="{{ route('publication.MyPublication') }}">
                <button class="btn btn-primary mt-3">My Publication</button>
            </a>
        </div>
    </div>
@endsection
