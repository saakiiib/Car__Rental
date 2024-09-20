@extends('layouts.app')

@section('content')
    <div class="container">

                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

        <h1>Your Rentals</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Car</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                    <tr>
                        <td>
                            {{ $rental->car->name }} ({{ $rental->car->brand }})
                            <img src="{{ asset($rental->car->image) }}" alt="{{ $rental->car->brand }}" width="30" height="30">
                        </td>
                        <td>{{ $rental->start_date }}</td>
                        <td>{{ $rental->end_date }}</td>
                        <td>{{ $rental->total_cost }}</td>
                        <td>
                            @if ($rental->is_cancelled=='1')
                                <span>Cancelled</span>
                            @elseif ($rental->start_date > now())
                                <span>Upcoming</span>
                            @else
                                <span>Ongoing</span>
                            @endif
                        </td>
                        <td>
                            @if (!$rental->is_cancelled && $rental->start_date > now())
                            <form action="{{ route('user.rent.cancel', $rental->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>
                            @else
                                <span>Cannot cancel</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection