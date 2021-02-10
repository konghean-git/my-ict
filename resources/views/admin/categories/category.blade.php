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
            <a class="nav-link" href="{{url('#')}}">Category
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
                                    <input class="mr-1" type="checkbox" name="category" id="category"> Coming soon
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="filter_flex">
                    
                    <div class="filter_status d-none pt-2">
                        <select class="select2 form-control form-control-sm" id="status_select" multiple="multiple"
                            data-placeholder="Filter by Status">
                            <option value="all">All Status</option>
                            <option value="1">New Available</option>
                            <option value="2">2nd Available</option>
                            <option value="3">In Using</option>
                            <option value="4">Broken</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-2 text-right">
                <a class="btn btn-sm btn-info pt-0 pb-0" href="{{url('categories/create')}}"><small>Add New</small></a>
            </div>
        </div>
        @endsection
        @section('content')
        <section class="content">
            <table id="datatables" class="table table-striped table-responsive-sm table-hover">
                <thead class="fixed">
                    <tr>
                        <th style="width: 7%;">#ID</th>
                        <th style="width: 10%;">Name</th>
                        <th>Asset Code</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="dynamic-row">
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->group_code}}</td>
                        <td>{{$category->description}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>{{$category->updated_at}}</td>
                        <td>
                            <a class="btn p-0 ml-1 text-warning" title="Edit"
                                href="{{ url('categories/update/' . $category->id) }}"><i class="fas fa-edit"></i></a>
                            <a class="btn p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"
                                data-id="{{ $category->id }}"><i class="fas fa-trash"></i></a>
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
        </section>
        @endsection

        @section('script')
        <script>
        $(document).ready(function() {
            $('#category').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_category').removeClass('d-none');
                } else {
                    // $('#gender_filter').hide();
                    $('.filter_category').addClass('d-none');
                    $('#category_select').val(null).trigger('change');
                }
                $('#inventory_search').val('');

            });
            $('#model').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_model').removeClass('d-none');
                } else {
                    $('.filter_model').addClass('d-none');
                    $('#model_select').val(null).trigger('change');
                }
                $('#inventory_search').val('');

            });
            $('#status').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_status').removeClass('d-none');
                } else {
                    $('.filter_status').addClass('d-none');
                    $('#status_select').val(null).trigger('change');
                }
                $('#inventory_search').val('');

            });


            $('#vendor').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_vendor').removeClass('d-none');
                } else {
                    $('.filter_vendor').addClass('d-none');
                    $('#vendor_select').val(null).trigger('change');
                }
                $('#inventory_search').val('');

            });
            $('#invoice_number').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_invoice_number').removeClass('d-none');
                } else {
                    $('.filter_invoice_number').addClass('d-none');
                    $('#invoice_number_select').val(null).trigger('change');
                }
                $('#inventory_search').val('');

            });
            $('#target').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_target').removeClass('d-none');
                } else {
                    $('.filter_target').addClass('d-none');
                    $('#target_select').val(null).trigger('change');
                }
                $('#inventory_search').val('');

            });

            $('#target_select').change(function() {
                var selectedValues = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('target_filter.action')}}",
                    dataType: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        selectedValues: selectedValues,
                        // branches: branches
                    },
                    success: function(res) {
                        console.log(res.length);
                        var tableRow = '';
                        $('#dynamic-row').html('');
                        if (res.length > 0) {
                            $.each(res, function(index, value) {
                                var status = '';
                                var btn_transfer = '';
                                if (value.status == 1) {
                                    status = 'New Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 2) {
                                    status = '2nd Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 3) {
                                    status = 'In Using';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 disabled" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else {
                                    status = 'Broken';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                }
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .model + '</td><td>' + value.category_id +
                                    '</td><td>' +
                                    value.vendor + '</td><td>' + value
                                    .invoice_number +
                                    '</td><td>' +
                                    value
                                    .description + '</td><td>' + value
                                    .remark + '</td><td>' + status +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("inventories/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a>' +
                                    btn_transfer +
                                    '<a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
                                    '{{url("users/update/")}}/' + value.id +
                                    '"><i class="fa fa-edit"></i></a><a class="btn  p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"data-id="' +
                                    value.id +
                                    '"><i class="fa fa-trash"></i></a></td></tr>';
                                $('#dynamic-row').append(tableRow);
                                console.log(value);
                            });
                            console.log(res);
                        } else {
                            tableRow =
                                '<tr><td align="center" colspan="9">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });
            });

            $('#invoice_number_select').change(function() {
                var selectedValues = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('invoice_filter.action')}}",
                    dataType: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        selectedValues: selectedValues,
                        // branches: branches
                    },
                    success: function(res) {
                        console.log(res.length);
                        var tableRow = '';
                        $('#dynamic-row').html('');
                        if (res.length > 0) {
                            $.each(res, function(index, value) {
                                var status = '';
                                var btn_transfer = '';
                                if (value.status == 1) {
                                    status = 'New Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 2) {
                                    status = '2nd Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 3) {
                                    status = 'In Using';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 disabled" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else {
                                    status = 'Broken';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                }
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .model + '</td><td>' + value.category_id +
                                    '</td><td>' +
                                    value.vendor + '</td><td>' + value
                                    .invoice_number +
                                    '</td><td>' +
                                    value
                                    .description + '</td><td>' + value
                                    .remark + '</td><td>' + status +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("inventories/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a>' +
                                    btn_transfer +
                                    '<a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
                                    '{{url("users/update/")}}/' + value.id +
                                    '"><i class="fa fa-edit"></i></a><a class="btn  p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"data-id="' +
                                    value.id +
                                    '"><i class="fa fa-trash"></i></a></td></tr>';
                                $('#dynamic-row').append(tableRow);
                                console.log(value);
                            });
                            console.log(res);
                        } else {
                            tableRow =
                                '<tr><td align="center" colspan="9">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });
            });

            $('#vendor_select').change(function() {
                var selectedValues = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('vendor_filter.action')}}",
                    dataType: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        selectedValues: selectedValues,
                        // branches: branches
                    },
                    success: function(res) {
                        console.log(res.length);
                        var tableRow = '';
                        $('#dynamic-row').html('');
                        if (res.length > 0) {
                            $.each(res, function(index, value) {
                                var status = '';
                                var btn_transfer = '';
                                if (value.status == 1) {
                                    status = 'New Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 2) {
                                    status = '2nd Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 3) {
                                    status = 'In Using';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 disabled" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else {
                                    status = 'Broken';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                }
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .model + '</td><td>' + value.category_id +
                                    '</td><td>' +
                                    value.vendor + '</td><td>' + value
                                    .invoice_number +
                                    '</td><td>' +
                                    value
                                    .description + '</td><td>' + value
                                    .remark + '</td><td>' + status +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("inventories/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a>' +
                                    btn_transfer +
                                    '<a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
                                    '{{url("users/update/")}}/' + value.id +
                                    '"><i class="fa fa-edit"></i></a><a class="btn  p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"data-id="' +
                                    value.id +
                                    '"><i class="fa fa-trash"></i></a></td></tr>';
                                $('#dynamic-row').append(tableRow);
                                console.log(value);
                            });
                            console.log(res);
                        } else {
                            tableRow =
                                '<tr><td align="center" colspan="9">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });
            });


            $('#status_select').change(function() {
                var selectedValues = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('status_filter.action')}}",
                    dataType: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        selectedValues: selectedValues,
                        // branches: branches
                    },
                    success: function(res) {
                        console.log(res.length);
                        var tableRow = '';
                        $('#dynamic-row').html('');
                        if (res.length > 0) {
                            $.each(res, function(index, value) {
                                var status = '';
                                var btn_transfer = '';
                                if (value.status == 1) {
                                    status = 'New Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 2) {
                                    status = '2nd Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 3) {
                                    status = 'In Using';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 disabled" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else {
                                    status = 'Broken';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                }
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .model + '</td><td>' + value.category_id +
                                    '</td><td>' +
                                    value.vendor + '</td><td>' + value
                                    .invoice_number +
                                    '</td><td>' +
                                    value
                                    .description + '</td><td>' + value
                                    .remark + '</td><td>' + status +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("inventories/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a>' +
                                    btn_transfer +
                                    '<a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
                                    '{{url("users/update/")}}/' + value.id +
                                    '"><i class="fa fa-edit"></i></a><a class="btn  p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"data-id="' +
                                    value.id +
                                    '"><i class="fa fa-trash"></i></a></td></tr>';
                                $('#dynamic-row').append(tableRow);
                                console.log(value);
                            });
                            console.log(res);
                        } else {
                            tableRow =
                                '<tr><td align="center" colspan="9">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });
            });

            $('#category_select').change(function() {
                var selectedValues = $(this).val();
                var status = $('#status_select').val();
                var vendor = $('#vendor_select').val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('category_filter.action')}}",
                    dataType: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        selectedValues: selectedValues,
                        status: status,
                        vendor: vendor
                    },
                    success: function(res) {
                        console.log(res.length);
                        var tableRow = '';
                        $('#dynamic-row').html('');
                        if (res.length > 0) {
                            $.each(res, function(index, value) {
                                var status = '';
                                var btn_transfer = '';
                                if (value.status == 1) {
                                    status = 'New Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 2) {
                                    status = '2nd Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 3) {
                                    status = 'In Using';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 disabled" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else {
                                    status = 'Broken';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                }
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .model + '</td><td>' + value.category_id +
                                    '</td><td>' +
                                    value.vendor + '</td><td>' + value
                                    .invoice_number +
                                    '</td><td>' +
                                    value
                                    .description + '</td><td>' + value
                                    .remark + '</td><td>' + status +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("inventories/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a>' +
                                    btn_transfer +
                                    '<a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
                                    '{{url("users/update/")}}/' + value.id +
                                    '"><i class="fa fa-edit"></i></a><a class="btn  p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"data-id="' +
                                    value.id +
                                    '"><i class="fa fa-trash"></i></a></td></tr>';
                                $('#dynamic-row').append(tableRow);
                                console.log(value);
                            });
                            console.log(res);
                        } else {
                            tableRow =
                                '<tr><td align="center" colspan="9">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });
            });

            $('#model_select').change(function() {
                var selectedValues = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('model_filter.action')}}",
                    dataType: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        selectedValues: selectedValues,
                        // branches: branches
                    },
                    success: function(res) {
                        console.log(res.length);
                        var tableRow = '';
                        $('#dynamic-row').html('');
                        if (res.length > 0) {
                            $.each(res, function(index, value) {
                                var status = '';
                                var btn_transfer = '';
                                if (value.status == 1) {
                                    status = 'New Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 2) {
                                    status = '2nd Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 3) {
                                    status = 'In Using';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 disabled" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else {
                                    status = 'Broken';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                }
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .model + '</td><td>' + value.category_id +
                                    '</td><td>' +
                                    value.vendor + '</td><td>' + value
                                    .invoice_number +
                                    '</td><td>' +
                                    value
                                    .description + '</td><td>' + value
                                    .remark + '</td><td>' + status +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("inventories/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a>' +
                                    btn_transfer +
                                    '<a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
                                    '{{url("users/update/")}}/' + value.id +
                                    '"><i class="fa fa-edit"></i></a><a class="btn  p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"data-id="' +
                                    value.id +
                                    '"><i class="fa fa-trash"></i></a></td></tr>';
                                $('#dynamic-row').append(tableRow);
                                console.log(value);
                            });
                            console.log(res);
                        } else {
                            tableRow =
                                '<tr><td align="center" colspan="9">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });
            });
            $('.select2').select2();
            $('#datatables').DataTable({});
            $('#modal-delete').modal('hide');

            var clicked_product;


            $('body').on('click', '.btn-delete', function() {
                $('#modal-delete').modal('show');
                clicked_product = $(this).attr('data-id');
            });

            $('body').on('click', '#confirm-delete', function() {
                $.ajax({
                    url: "{{ url('categories/delete') }}/" + clicked_product,
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

            // Live Search
            $(document).on('keyup', '#categories_search', function() {
                // var query = $(this).val();
                var searchQuery = $('#inventory_search').val();
                // console.log(querySearch);
                $.ajax({
                    method: 'POST',
                    url: "{{route('categories_search.action')}}",
                    dataType: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        searchQuery: searchQuery
                    },
                    success: function(res) {
                        console.log(res.length);
                        var tableRow = '';
                        $('#dynamic-row').html('');
                        if (res.length > 0) {
                            $.each(res, function(index, value) {
                                var status = '';
                                var btn_transfer = '';
                                if (value.status == 1) {
                                    status = 'New Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 2) {
                                    status = '2nd Available';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else if (value.status == 3) {
                                    status = 'In Using';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 disabled" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                } else {
                                    status = 'Broken';
                                    btn_transfer =
                                        '<a class="btn p-0 ml-1 text-success" title="Details" href="' +
                                        '{{url("inventories/transfer/create/")}}/' +
                                        value
                                        .id +
                                        '"><i class="fa fa-arrow-circle-up"></i></a>';
                                }
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .model + '</td><td>' + value.category_id +
                                    '</td><td>' +
                                    value.vendor + '</td><td>' + value
                                    .invoice_number +
                                    '</td><td>' +
                                    value
                                    .description + '</td><td>' + value
                                    .remark + '</td><td>' + status +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("users/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a>' +
                                    btn_transfer +
                                    '<a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
                                    '{{url("users/update/")}}/' + value.id +
                                    '"><i class="fa fa-edit"></i></a><a class="btn  p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"data-id="' +
                                    value.id +
                                    '"><i class="fa fa-trash"></i></a></td></tr>';
                                $('#dynamic-row').append(tableRow);
                            });
                            // console.log(res);
                        } else {
                            tableRow =
                                '<tr><td align="center" colspan="9">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });

            });


        });
        </script>
        @endsection


        @section('style')
        <style>
        .filter_status {
            width: 200px;
            border-bottom: 1px solid lightgray;
            margin-right: 3px;
        }

        .filter_status .select2-container--default .select2-selection--multiple,
        .select2-container--default .select2-selection--multiple {
            width: 200px;
        }
        </style>
        @endsection