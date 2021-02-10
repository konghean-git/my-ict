@extends('layouts.master')




@section('top_menu')
<a class="navbar-brand p-2" href="{{url('asset/home')}}"><i class="fas fa-home"></i></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent-333" style="padding-left: 0;">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#">Branches
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

@section('top_filter')
        <div class="row mb-2">
            <!-- <div class="col-md-0">Title Overview</div> -->
            <div class="col-md-10 ">
                <div class="filter_flex">
                    <div class="live_search">
                        <form action="">
                            <input class="form-control form-control-sm typeahead" type="text" name="inventory_search"
                                id="inventory_search" placeholder="Search...">
                        </form>
                    </div>
                    <div class="select_filter">
                        <!-- <input type="checkbox" name="Gendeer" id=""> -->
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Select Filter
                        </a>
                        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                            <form action="">
                                <div class="sub_filter d-block">
                                    <input class="mr-1" type="checkbox" name="category" id="category"> Category
                                </div>
                                <div class="sub_filter d-block">
                                    <input class="mr-1" type="checkbox" name="model" id="model"> Model
                                </div>
                                <div class="sub_filter d-block">
                                    <input class="mr-1" type="checkbox" name="status" id="status"> Status
                                </div>
                                <div class="sub_filter d-block">
                                    <input class="mr-1" type="checkbox" name="vendor" id="vendor"> Vendor
                                </div>
                                <div class="sub_filter d-block">
                                    <input class="mr-1" type="checkbox" name="invoice_number" id="invoice_number">
                                    Invoice No
                                </div>
                                <div class="sub_filter d-block">
                                    <input class="mr-1" type="checkbox" name="target" id="target"> Target
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="filter_flex">
                
                </div>
            </div>
            <div class="col-md-2 text-right">
                <a class="btn btn-sm btn-info pt-0 pb-0 mr-1" href="{{url('branches/create')}}"><small>Add New</small></a>
            </div>
        </div>
@endsection

@section('content')

<div class="container-fluid">
    <table id="datatables" class="table table-striped table-responsive-sm table-hover w-100">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Google Map Link</th>
                <th>City</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($branches as $branch)
            <tr>
                <td>{{ $branch->id }}</td>
                <td>{{ $branch->name }}</td>
                <td><a href="{{ $branch->map_link }}" target="_blank" style=""><i class="fas fa-arrow-circle-up"></i></a> {{ $branch->map_link }}</td>
                <td>{{ $branch->city }}</td>
                <td>{{ $branch->country }}</td>
                <td>
                    <a class="btn p-0 text-warning"
                        href="{{ url('branches/update/' . $branch->id) }}" title="Edit"><i
                            class="fas fa-edit"></i></a>
                    <a class="btn p-0 text-danger btn-delete" href="javascript:void(0)"
                        data-id="{{ $branch->id }}" title="Delete"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="modal-delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <h5><small><b>Are you sure,<br>you want to delete now?</b></small></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm" id="confirm-delete">Delete</button>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
    var the_datatable = $('#datatables').DataTable({
        "ordering": true,
    });

    $('#modal-delete').modal('hide');

    var clicked_product;


    $('body').on('click', '.btn-delete', function() {
        $('#modal-delete').modal('show');
        clicked_product = $(this).attr('data-id');
    });

    $('body').on('click', '#confirm-delete', function() {
        $.ajax({
            url: "{{ url('branches/delete') }}/" + clicked_product,
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