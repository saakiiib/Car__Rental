@extends('admin.layouts.admin')

@section('content')

<!-- Main content -->
<section class="content" id="newBtnSection">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <button type="button" class="btn btn-secondary my-3" id="newBtn">Add new</button>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->



<!-- Main content -->
<section class="content mt-3" id="addThisFormContainer">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <!-- right column -->
            <div class="col-md-8">
                <!-- general form elements disabled -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title" id="card-title">Add new car</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="ermsg"></div>
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" class="form-control" id="codeid" name="codeid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Car Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter car name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter brand name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" class="form-control" id="model" name="model" placeholder="Enter model name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <input type="number" class="form-control" id="year" name="year" placeholder="Enter year">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Car Type</label>
                                        <input type="text" class="form-control" id="car_type" name="car_type" placeholder="Enter car type">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Car Type</label>
                                        <input type="number" class="form-control" id="daily_rent_price" name="daily_rent_price" placeholder="Enter daily rent">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="availability">Availability</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="availability" name="availability">
                                            <label class="form-check-label" for="availability">Available</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-10">
                                    <div class="form-group">
                                        <label for="feature-img">Car Image</label>
                                        <input type="file" class="form-control-file" id="image" accept="image/*">
                                        <img id="preview-image" src="#" alt="" style="max-width: 300px; width: 100%; height: auto; margin-top: 20px;">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>


                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" id="addBtn" class="btn btn-secondary" value="Create">Create</button>
                        <button type="submit" id="FormCloseBtn" class="btn btn-default">Cancel</button>
                    </div>
                    <!-- /.card-footer -->
                    <!-- /.card-body -->
                </div>
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<!-- Main content -->
<section class="content" id="contentContainer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">All Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th>Car Type</th>
                                    <th>Daily Rent Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->brand}}</td>
                                    <td>{{$data->model}}</td>
                                    <td>{{$data->year}}</td>
                                    <td>{{$data->car_type}}</td>
                                    <td>{{$data->daily_rent_price}}</td>

                                    <td>
                                        <a id="EditBtn" rid="{{$data->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                                        <a id="deleteBtn" rid="{{$data->id}}"><i class="fa fa-trash" style="color: red; font-size: 16px;"></i>
                                        </a>
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
    $(document).ready(function() {
        $("#image").change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#preview-image").attr("src", e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
    });

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

<script>
    $(document).ready(function() {
        $("#addThisFormContainer").hide();
        $("#newBtn").click(function() {
            clearform();
            $("#newBtn").hide(100);
            $("#addThisFormContainer").show(300);

        });
        $("#FormCloseBtn").click(function() {
            $("#addThisFormContainer").hide(200);
            $("#newBtn").show(100);
            clearform();
        });
        //header for csrf-token is must in laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //
        var url = "{{URL::to('/admin/car')}}";
        var upurl = "{{URL::to('/admin/car-update')}}";
        // console.log(url);
        $("#addBtn").click(function() {
            //   alert("#addBtn");
            if ($(this).val() == 'Create') {
                var form_data = new FormData();
                form_data.append("name", $("#name").val());
                form_data.append("brand", $("#brand").val());
                form_data.append("model", $("#model").val());
                form_data.append("year", $("#year").val());
                form_data.append("car_type", $("#car_type").val());
                form_data.append("daily_rent_price", $("#daily_rent_price").val());
                form_data.append("availability", $("#availability").is(':checked') ? 1 : 0);
                form_data.append("image", $("#image")[0].files[0]);

                $.ajax({
                    url: url,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(d) {
                        if (d.status == 303) {
                            $(".ermsg").html(d.message);
                        } else if (d.status == 300) {
                            swal({
                                text: "Car created successfully!",
                                icon: "success",
                                button: {
                                    text: "OK",
                                    className: "swal-button--confirm"
                                }
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(d) {
                        if (d.status === 422) {
                            var errors = d.responseJSON.errors;
                            var errorHtml = '<ul>';
                            $.each(errors, function(key, value) {
                                errorHtml += '<li>' + value[0] + '</li>';
                            });
                            errorHtml += '</ul>';
                            $(".ermsg").html(errorHtml);
                        } else {
                            console.log(d);
                        }
                    }
                });

            }
            //create  end
            //Update
            if ($(this).val() == 'Update') {
                var form_data = new FormData();
                form_data.append("name", $("#name").val());
                form_data.append("brand", $("#brand").val());
                form_data.append("model", $("#model").val());
                form_data.append("year", $("#year").val());
                form_data.append("car_type", $("#car_type").val());
                form_data.append("daily_rent_price", $("#daily_rent_price").val());
                form_data.append("availability", $("#availability").is(':checked') ? 1 : 0);
                form_data.append("image", $("#image")[0].files[0]);
                form_data.append("codeid", $("#codeid").val());

                $.ajax({
                    url: upurl,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(d) {
                        if (d.status == 303) {
                            $(".ermsg").html(d.message);
                        } else if (d.status == 300) {
                            swal({
                                text: "Car Updated successfully!",
                                icon: "success",
                                button: {
                                    text: "OK",
                                    className: "swal-button--confirm"
                                }
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(d) {
                        if (d.status === 422) {
                            var errors = d.responseJSON.errors;
                            var errorHtml = '<ul>';
                            $.each(errors, function(key, value) {
                                errorHtml += '<li>' + value[0] + '</li>';
                            });
                            errorHtml += '</ul>';
                            $(".ermsg").html(errorHtml);
                        } else {
                            console.log(d);
                        }
                    }
                });
            }
            //Update
        });
        //Edit
        $("#contentContainer").on('click', '#EditBtn', function() {
            //alert("btn work");
            codeid = $(this).attr('rid');
            //console.log($codeid);
            info_url = url + '/' + codeid + '/edit';
            //console.log($info_url);
            $.get(info_url, {}, function(d) {
                populateForm(d);
                pagetop();
            });
        });
        //Edit  end
        //Delete
        $("#contentContainer").on('click', '#deleteBtn', function() {
            if (!confirm('Sure?')) return;
            codeid = $(this).attr('rid');
            info_url = url + '/' + codeid;
            $.ajax({
                url: info_url,
                method: "GET",
                type: "DELETE",
                data: {},
                success: function(d) {
                    if (d.success) {
                        alert(d.message);
                        location.reload();
                    }
                },
                error: function(d) {
                    console.log(d);
                }
            });
        });
        //Delete  
        function populateForm(data) {
            $("#name").val(data.name);
            $("#brand").val(data.brand);
            $("#model").val(data.model);
            $("#year").val(data.year);
            $("#car_type").val(data.car_type);
            $("#daily_rent_price").val(data.daily_rent_price);
            $("#availability").prop('checked', data.availability == 1 ? true : false);
            $("#preview-image").attr('src', data.image);
            $("#codeid").val(data.id);
            $("#addBtn").val('Update');
            $("#addBtn").html('Update');
            $("#card-title").html('Update this car');
            $("#addThisFormContainer").show(300);
            $("#newBtn").hide(100);
        }

        function clearform() {
            $('#createThisForm')[0].reset();
            $("#addBtn").val('Create');
            $('#preview-image').attr('src', '#');
            $("#card-title").html('Add new car');
        }
    });
</script>
@endsection