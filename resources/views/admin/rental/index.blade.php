@extends('admin.layouts.admin')

@section('content')

<!-- Main content -->
<section class="content pt-3" id="contentContainer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->

        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">All Rentals</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Date</th>
                  <th>Rental ID</th>
                  <th>Customer</th>
                  <th>Car</th>
                  <th>Cost</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($rentals as $key => $data)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{$data->start_date}} - {{$data->end_date}}</td>
                  <td>{{$data->id}}</td>
                  <td>{{$data->user->name}}</td>
                  <td>{{$data->car->name}}</td>
                  <td>{{$data->total_cost}}</td>
                  <td>
                    @if ($data->is_cancelled=='1')
                    <span>Cancelled</span>
                    @elseif ($data->start_date > now())
                    <span>Upcoming</span>
                    @else
                    <span>Ongoing</span>
                    @endif
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
@section('script')

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection