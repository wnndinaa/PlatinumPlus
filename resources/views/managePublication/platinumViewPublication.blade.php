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
            <h2>View Publication</h2>

            <a href="{{ route('publication.MyPublication') }}">
                <button class="btn btn-primary mt-3">My Publication</button>
            </a>

        </div>
    </div>
@endsection
