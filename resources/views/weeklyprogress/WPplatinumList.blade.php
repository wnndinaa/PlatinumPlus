@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Platinum List</h2>

    <form method="GET" action="{{ route('weeklyprogress.WPplatinumList') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name...">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    @if($platinums->isEmpty())
        <p class="text-center">No Platinum students assigned or found.</p>
    @else

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('weeklyprogress.report') }}" class="btn btn-success">View Full Report</a>
    </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Platinum Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>View Progress</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($platinums as $platinum)
                    <tr>
                        <td>{{ $platinum->name }}</td>
                        <td>{{ $platinum->email }}</td>
                        <td>{{ $platinum->phonenumber }}</td>
                        <td>
                            <a href="{{ route('weeklyprogress.WPviewPlatinumProgress', $platinum->username) }}" class="btn btn-info btn-sm">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
