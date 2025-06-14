@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Notifications for: {{ $paper->paper_title }}</h3>

    @if($notifications->isEmpty())
        <div class="alert alert-info">No notifications available for this paper.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $index => $notify)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $notify->message }}</td>
                        <td>{{ \Carbon\Carbon::parse($notify->created_at)->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary">Back</a>
    </div>
</div>
@endsection
