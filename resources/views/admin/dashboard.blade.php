@extends('admin.layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

  <section class="content">
    <div class="container-fluid">
    <div class="row">
    <!-- Total Cars -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalCars }}</h3>
                <p>Total Cars</p>
            </div>
            <div class="icon">
                <i class="ion ion-model-s"></i> <!-- Replace with a suitable icon -->
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- Available Cars -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalAvailableCars }}</h3>
                <p>Available Cars</p>
            </div>
            <div class="icon">
                <i class="ion ion-car"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- Total Rentals -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalRentals }}</h3>
                <p>Total Rentals</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- Active Rentals -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $activeRentals }}</h3>
                <p>Active Rentals</p>
            </div>
            <div class="icon">
                <i class="ion ion-clock"></i> <!-- Suitable icon for active rentals -->
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Canceled Rentals -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $canceledRentals }}</h3>
                <p>Canceled Rentals</p>
            </div>
            <div class="icon">
                <i class="ion ion-close-circled"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Earnings -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalEarnings }}</h3>
                <p>Total Earnings</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Current Month Earnings -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $currentMonthEarnings }}</h3>
                <p>This Month's Earnings</p>
            </div>
            <div class="icon">
                <i class="ion ion-calendar"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Upcoming Rentals -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $upcomingRentals }}</h3>
                <p>Upcoming Rentals</p>
            </div>
            <div class="icon">
                <i class="ion ion-forward"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

    </div>
  </section>

@endsection

@section('script')


<script>
    
</script>

@endsection
