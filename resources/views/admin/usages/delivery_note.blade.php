@extends('layouts.master')


@section('top_menu')
<a class="navbar-brand p-2" href="{{url('asset/home')}}"><i class="fas fa-home"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('#')}}">Delivery Note
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pt-1 pb-1"><small><b>Pending DN</b></small></div>
                    <div class="card-body">
                        <table id="datatables" class="table table-striped table-responsive-sm table-hove">
                            <thead>
                                <tr>
                                    <th>#DN</th>
                                    <th>Asset Code</th>
                                    <th>Asset Model</th>
                                    <th>Users ID</th>
                                    <th>Users Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pending as $pen)
                                    <tr>
                                        <td>{{$pen->id}}</td>
                                        <td>{{$pen->inventories->code}}</td>
                                        <td>{{$pen->inventories->model}}</td>
                                        <td>{{$pen->users->code}}</td>
                                        <td>{{$pen->users->name}}</td>
                                        <td>NO</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pt-1 pb-1"><small><b>Printed Out DN</b></small></div>
                    <div class="card-body h-100">
                        <table id="datatables" class="datatables table table-striped table-responsive-sm table-hove">
                            <thead>
                                <tr>
                                    <th>#DN</th>
                                    <th>Asset Code</th>
                                    <th>Asset Model</th>
                                    <th>Users ID</th>
                                    <th>Users Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($printed as $print)
                                    <tr>
                                        <td>{{$print->id}}</td>
                                        <td>{{$print->inventories->code}}</td>
                                        <td>{{$print->inventories->model}}</td>
                                        <td>{{$print->users->code}}</td>
                                        <td>{{$print->users->name}}</td>
                                        <td>OK</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
<style>
td .btn{
    padding: 0;
    margin-left: 2px;
    margin-right: 2px;
}
#datatables th {
    color: #212529;
    font-weight: medium;
    padding: 5px;
}

#datatables td {
    color: #212529;
    font-weight: medium;
    padding-bottom: 0px;
}

#inventory_block th {
    padding: 10px;
}

#inventory_block td {
    width: 100%;
    padding-right: 20px;
}

#inventory_block tr {
    border-bottom: 1px solid lightgray;
    font-size: 12px;
}

.line-vertical {
    width: 1px;
    height: 100%;
    background-color: lightgray;
}
</style>
@endsection
@section('script')
<script>
$(document).ready(function() {
    $('#datatables').DataTable({
        "columnDefs": [{
                "width": "8%",
                "targets": 0
            },
            // {
            //     "width": "11%",
            //     "targets": 8
            // },
        ]
    });
    $('.datatables').DataTable({
        "columnDefs": [{
                "width": "8%",
                "targets": 0
            },
            // {
            //     "width": "11%",
            //     "targets": 8
            // },
        ]
    });

    $('#modal-delete').modal('hide');

    var clicked_product;


    $('body').on('click', '.btn-delete', function() {
        $('#modal-delete').modal('show');
        clicked_product = $(this).attr('data-id');
    });

    $('body').on('click', '#confirm-delete', function() {
        $.ajax({
            url: "{{ url('inventories/usages/delete') }}/" + clicked_product,
            data: {},
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 1)
                    $('#modal-delete').modal('hide');
                // console.log('clicked');
                location.reload();

            },
        });
    });

});
</script>
@endsection