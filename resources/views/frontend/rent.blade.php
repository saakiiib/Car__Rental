@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rent {{ $car->name }}</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                    <p class="card-text">Year: {{ $car->year }}</p>
                    <p class="card-text">Daily Rent Price: {{ $car->daily_rent_price }}</p>
                    <p class="card-text">Availability: {{ $car->availability ? 'Available' : 'Not Available' }}</p>
                    <img src="{{ asset($car->image) }}" class="img-fluid" alt="{{ $car->name }}">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h2>Rental Details</h2>
            <form action="{{ route('user.rent.store') }}" method="POST">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">

                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Rent Car</button>
            </form>
        </div>
    </div>
</div>

@endsection
