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
                        <a class="nav-link" href="{{url('inventories')}}">Inventory
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

<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row mb-3">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h5><small><i class="fas fa-table"></i></small> Item Detail</h5>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="row pt-3">
                                        <div class="col-sm-2">
                                            <img class="w-100 img img-thumbnail"
                                                src="{{asset('public/images')}}/{{$inventory->image}}" alt="">
                                        </div>
                                        <div class="col-md-2">
                                            <table id="inventory_block">
                                                <tr>
                                                    <th>Code</th>
                                                    <td>{{$inventory->code}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Model</th>
                                                    <td>{{$inventory->model}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Serial</th>
                                                    <td>{{$inventory->serial}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Cateogory</th>
                                                    <td>{{$inventory->category->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Condition</th>
                                                    <td>{{$inventory->condition}}</td>
                                                </tr>

                                            </table>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="line-vertical m-auto"></div>
                                        </div>
                                        <div class="col-md-2">
                                            <table id="inventory_block">
                                                <tr>
                                                    <th>Color</th>
                                                    <td>{{$inventory->color}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    @if($inventory->status == 1)
                                                    <td class="text-success"><u>New Available</u></td>
                                                    @elseif($inventory->status == 2)
                                                    <td class="text-success"><u>Second Hand Available</u></td>
                                                    @elseif($inventory->status == 3)
                                                    <td class="text-info"><u>Using</u></td>
                                                    @else
                                                    <td class="text-danger"><u>Broken</u></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th>Target</th>
                                                    <td>{{$inventory->target}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Price</th>
                                                    <td>${{$inventory->price}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Vendor</th>
                                                    <td>{{$inventory->vendor->name}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="line-vertical m-auto"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <table id="inventory_block">
                                                
                                                <tr>
                                                    <th>InvouceNo.</th>
                                                    <td>{{$inventory->invoice_number}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Accessary</th>
                                                    <td>{{$inventory->accessary}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Description</th>
                                                    <td>{{$inventory->description}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Remark</th>
                                                    <td>{{$inventory->remark}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Purchase Date</th>
                                                    <td>{{date('d M, Y @ g:i A',strtotime($inventory->created_at))}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="w-100 mt-3 pr-2 d-flex flex-row-reverse">
                <div class="text-right">
                    @if(!empty($status->is_using))
                        @if($status->is_using == 0)
                        <a class="btn p-0 ml-1 btn-sm btn-success p-1" title="Transfer"
                            href="{{ url('inventories/transfer/create/' . $inventory->id) }}" id="btn_transfer"><i
                            class="fas fa-arrow-circle-up"></i>Transfer</a>
                        @else
                        <a class="btn p-0 ml-1 btn-sm btn-secondary disabled p-1" title="Transfer"
                            href="{{ url('inventories/transfer/create/' . $inventory->id) }}" id="btn_transfer"><i
                            class="fas fa-arrow-circle-up"></i>Transfer</a>
                        @endif
                    @else
                    <a class="btn p-0 ml-1 btn-sm btn-success p-1" title="Transfer"
                            href="{{ url('inventories/transfer/create/' . $inventory->id) }}" id="btn_transfer"><i
                            class="fas fa-arrow-circle-up"></i>Transfer</a>
                    @endif
                </div>
                <div class="text-right">
                    <a class="btn p-0 ml-1 btn-sm btn-warning p-1" title="Edit"
                        href="{{ url('/inventories/update/' . $inventory->id) }}"><i
                            class="fas fa-edit"></i>Edit</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-5">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h5><small><i class="fas fa-table"></i></small> PC Transection History</h5>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatables" class="table table-striped table-responsive-sm table-hover w-100">
                                        <thead>
                                            <tr>
                                                <th>DN No</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Position</th>
                                                <th>StartDate</th>
                                                <th>EndDate</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($usages as $usage)
                                            <tr>
                                                @if($usage->delivery_node_code < 10) <td>
                                                    000{{$usage->delivery_node_code}}</td>
                                                    @elseif($usage->delivery_node_code < 100) <td>
                                                        00{{$usage->delivery_node_code}}</td>
                                                        @elseif($usage->delivery_node_code < 1000) <td>
                                                            0{{$usage->delivery_node_code}}</td>
                                                            @else
                                                            <td>{{$usage->delivery_node_code}}</td>
                                                            @endif
                                                            <td>{{$usage->users->code}}</td>
                                                            <td>{{$usage->users->name}}</td>
                                                            <td>{{$usage->users->department}}</td>
                                                            <td>{{$usage->users->position}}</td>
                                                            <td>{!!
                                                                \Carbon\Carbon::parse($usage->started_at)->format('d-m-Y')
                                                                !!}</td>
                                                            <td>{!!
                                                                \Carbon\Carbon::parse($usage->finished_at)->format('d-m-Y')
                                                                !!}</td>
                                                            @if($usage->is_using == 0)
                                                            <td>Returned</td>
                                                            @else
                                                            <td>Using</td>
                                                            @endif
                                                            <td>
                                                                <a class="btn text-info" title="Edit"
                                                                    href="{{ url('inventories/usages/detail/' . $usage->id) }}"><i
                                                                        class="fa fa-eye"></i></a>
                                                                @if($usage->is_using == 0)
                                                                <a class="btn text-secondary disabled "
                                                                    title="Return"
                                                                    href="{{ url('inventories/return/' . $usage->id) }}"><i
                                                                        class="fa fa-reply-all"></i></a>
                                                                @else
                                                                <a class="btn text-success "
                                                                    title="Return"
                                                                    href="{{ url('inventories/usages/return/' . $usage->id) }}"><i
                                                                        class="fa fa-reply-all"></i></a>
                                                                @endif
                                                                <a class="btn text-warning" title="Edit"
                                                                    href="{{ url('inventories/usages/update/' . $usage->id) }}"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <a class="btn text-danger btn-delete"
                                                                    title="Delete" href="javascript:void(0)"
                                                                    data-id="{{ $usage->id }}"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-delete" class="modal fade" tabindex="-1" role="dialog"
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