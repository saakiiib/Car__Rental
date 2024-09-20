@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <h1>Cars</h1>
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search cars">
                        <select name="brand" class="form-control">
                            <option value="">Select Brand</option>
                            @foreach($cars->pluck('brand')->unique() as $brand)
                                <option value="{{ $brand }}">{{ $brand }}</option>
                            @endforeach
                        </select>
                        <select name="model" class="form-control">
                            <option value="">Select Model</option>
                            @foreach($cars->pluck('model')->unique() as $model)
                                <option value="{{ $model }}">{{ $model }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
                <div class="row">
                    @foreach($cars as $car)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset($car->image) }}" class="card-img-top" alt="Car Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $car->name }}</h5>
                                    <p class="card-text">
                                        <strong>Brand:</strong> {{ $car->brand }}<br>
                                        <strong>Model:</strong> {{ $car->model }}<br>
                                        <strong>Year:</strong> {{ $car->year }}<br>
                                        <strong>Car Type:</strong> {{ $car->car_type }}<br>
                                        <strong>Daily Rent Price:</strong> {{ $car->daily_rent_price }}<br>
                                        <strong>Availability:</strong> {{ $car->availability ? 'Available' : 'Not Available' }}
                                    </p>
                                    @if($car->availability)
                                        <a href="{{ route('user.rent', $car->id) }}" class="btn btn-primary">Rent Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $cars->render('pagination::default') }}
            </div>
        </div>
    </div>
@endsection