@extends('layouts.master')


@section('top_filter')
<div class="container pt-1">
    <h5><small><b>Update Branch</b></small></h5>
</div>
@endsection

@section('top_menu')
<a class="navbar-brand p-2" href="{{url('asset/home')}}"><i class="fas fa-home"></i></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent-333" style="padding-left: 0;">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="{{url('branches')}}">Branches
                <span class="sr-only">(current)</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Dropdown
            </a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li> -->
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope"></i>
            </a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
@endsection
@section('content')
<div class="container">
    <form action="{{url('branches/update/submit')}}" method="POST">
        @csrf
        <input type="hidden" name="branch_id" value="{{$branch->id}}">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-2 col-xs-2">Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="text" name="name" value="{{$branch->name}}"
                            class="form-control form-control-sm rounded" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-2 col-xs-2">City</label>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="text" name="city" value="{{$branch->city}}"
                            class="form-control form-control-sm rounded" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-2 col-xs-2">Country</label>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="text" name="country" value="{{$branch->country}}"
                            class="form-control form-control-sm rounded" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-2 col-xs-2">Google Map</label>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <input type="text" name="map_link" value="{{$branch->map_link}}"
                            class="form-control form-control-sm rounded" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-2 col-xs-2">Description</label>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <textarea type="text" name="description"
                            class="form-control form-control-sm rounded">{{$branch->description}}</textarea>
                    </div>
                </div>
                <div class="mb-3 text-right">
                    <a class="btn btn-sm btn-secondary" href="{{url('branches')}}">Cancel</a>
                    <input type="submit" class=" btn btn-sm text-white" style="background-color:#17a2b8"
                        value="Submit">
                </div>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <label for="name">Name</label>
                        <div class="input-group input-group-sm mb-3">
                            <input value="{{old('name')}}" type="text" name="name" step="any"
                                class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="from-group col-md-12">
                        <label class="control-label" for="devision">Google Map</label>
                        <div class="input-group input-group-sm mb-3">
                            <textarea name="map_link" id="map_link" class="form-control" placeholder="Google Map Link" >{{old('map_link')}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="devision">Description</label>
                        <div class="input-group input-group-sm mb-3">
                            <textarea name="description" id="description" class="form-control" placeholder="Description" >{{old('description')}}</textarea>
                        </div>
                    </div>
                </div> -->


            </div>
            <!-- <div class="mb-3 text-center">
                <input type="submit" class=" btn w-50 text-white" style="background-color:#17a2b8" value="Save">
            </div> -->
            <!-- /.card-body -->
        </div>
    </form>
</div>
@endsection
@section('style')
    <style>
        .form-control-sm{
            color: #495057;
        }
        .control-label{
            font-size: 12px;
            color: gray;
        }
        .form-control-sm,.form-group select{
            color: gray;
            font-size:12px;
        }
    </style>
@endsection
@section('additional_scripts')
<script>
$(document).ready(function() {
    var select2 = $('#product-category').select2();

    var selected_data = <?php echo json_encode(old('product_categories')); ?>;
    select2.val(selected_data).trigger('change');

    var the_datatable = $('#datatables').DataTable({
        "ordering": false,
    });

    $('#modal-delete').modal('hide');

    var clicked_product;


    $('body').on('click', '.btn-delete', function() {
        $('#modal-delete').modal('show');
        clicked_product = $(this).attr('data-id');
    });


    $('body').on('click', '#confirm-delete', function() {
        $.ajax({
            url: "{{ url('backend/admin/products/update/delete/') }}/" + clicked_product,
            data: {},
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 1)
                    $('#modal-delete').modal('hide');

                location.reload();

            },
        });
    });
});
</script>
@endsection