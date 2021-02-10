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
            <a class="nav-link" href="#">Employees
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
                            <input class="form-control form-control-sm typeahead" type="text" name="user_search"
                                id="user_search" placeholder="Search...">
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
                                    <input class="mr-1" type="checkbox" name="branch" id="branch"> Branch
                                </div>
                                <div class="sub_filter d-block">
                                    <input class="mr-1" type="checkbox" name="division" id="division"> Division
                                </div>
                                <div class="sub_filter d-block">
                                    <input class="mr-1" type="checkbox" name="department" id="department"> Department
                                </div>
                                <div class="sub_filter d-block">
                                    <input class="mr-1" type="checkbox" name="position" id="position"> Position
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="filter_flex">
                    <div class="filter_branch d-none pt-2">
                        <select class="select2 form-control form-control-sm" id="branch_select" multiple="multiple"
                            data-placeholder="Filter by Branch">
                            <option value="all">All Branches</option>
                            @php
                            $num =0;
                            @endphp
                            @foreach($branches as $branch)
                            <option value="{{$branch->id}}">{{$num+1}} {{$branch->name}}</option>
                            @php
                            $num++;
                            @endphp
                            @endforeach
                        </select>
                    </div>
                    <div class="filter_division d-none pt-2">
                        <select class="select2 form-control form-control-sm" id="division_select" multiple="multiple"
                            data-placeholder="Filter by Division">
                            <option value="all">All Divisions</option>
                            @foreach($divisions as $division)
                            <option value="{{$division}}">{{$division}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter_department d-none pt-2">
                        <select class="select2 form-control form-control-sm" id="department_select" multiple="multiple"
                            data-placeholder="Filter by Department">
                            <option value="all">All Departments</option>
                            @foreach($departments as $department)
                            <option value="{{$department}}">{{$department}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter_position d-none pt-2">
                        <select class="select2 form-control form-control-sm" id="position_select" multiple="multiple"
                            data-placeholder="Filter by Position">
                            <option value="all">All Positions</option>
                            @foreach($positions as $position)
                            <option value="{{$position}}">{{$position}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-md-2 text-right">
                <a class="btn btn-sm btn-info pt-0 pb-0" href="{{url('users/create')}}"><small>Add Employee</small></a>
            </div>
        </div>
        @endsection

        @section('content')
        <section class="content">
            <table id="datatables" class="table table-striped table-responsive-sm" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 5%;">Code</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Branch</th>
                        <th>Division</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="dynamic-row">
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->code}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{!empty($user->branch) ? $user->branch->name : '--'}}</td>
                        <td>{{$user->division}}</td>
                        <td>{{$user->department}}</td>
                        <td>{{$user->position}}</td>
                        <td>
                            <a class="btn  p-0 ml-1 text-primary" title="Details"
                                href="{{ url('users/detail/' . $user->id) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn  p-0 ml-1 text-warning" title="Edit"
                                href="{{ url('users/update/' . $user->id) }}"><i class="fa fa-edit"></i></a>
                            <a class="btn  p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"
                                data-id="{{ $user->id }}"><i class="fa fa-trash"></i></a>
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
        <!-- /page content -->
        @endsection

        @section('script')
        <script>
        $(document).ready(function() {
            $('#gender').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_gender').removeClass('d-none');
                } else {
                    // $('#gender_filter').hide();
                    $('.filter_gender').addClass('d-none');
                    $('#gender_select').val(null).trigger('change');
                }
            });
            $('#division').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_division').removeClass('d-none');
                } else {
                    // $('#gender_filter').hide();
                    $('.filter_division').addClass('d-none');
                }
            });

            $('#branch').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_branch').removeClass('d-none');
                } else {
                    // $('#gender_filter').hide();
                    $('.filter_branch').addClass('d-none');
                }
            });

            $('#department').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_department').removeClass('d-none');
                } else {
                    // $('#gender_filter').hide();
                    $('.filter_department').addClass('d-none');
                }
            });

            $('#position').click(function() {
                if ($(this).prop('checked')) {
                    $('.filter_position').removeClass('d-none');
                } else {
                    // $('#gender_filter').hide();
                    $('.filter_position').addClass('d-none');
                }
            });

            $('#branch_select').change(function() {
                var selectedValues = $(this).val();
                var branches = $('#branch_select').val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('branch_filter.action')}}",
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
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .name + '</td><td>' + value.gender +
                                    '</td><td>' + value
                                    .branch_id + '</td><td>' + value
                                    .division + '</td><td>' + value.department +
                                    '</td><td>' + value.position +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("users/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a><a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
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
                                '<tr><td align="center" colspan="7">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });
            });

            $('#division_select').change(function() {
                var selectedValues = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('division_filter.action')}}",
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
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .name + '</td><td>' + value.gender +
                                    '</td><td>' + value
                                    .branch_id + '</td><td>' + value
                                    .division + '</td><td>' + value.department +
                                    '</td><td>' + value.position +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("users/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a><a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
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
                                '<tr><td align="center" colspan="7">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });
            });

            $('#department_select').change(function() {
                var selectedValues = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('department_filter.action')}}",
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
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .name + '</td><td>' + value.gender +
                                    '</td><td>' + value
                                    .branch_id + '</td><td>' + value
                                    .division + '</td><td>' + value.department +
                                    '</td><td>' + value.position +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("users/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a><a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
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
                                '<tr><td align="center" colspan="7">Search Not Found</td></tr>';
                            $('#dynamic-row').append(tableRow);
                        }
                    }
                });
            });

            $('#position_select').change(function() {
                var selectedValues = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: "{{route('position_filter.action')}}",
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
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .name + '</td><td>' + value.gender +
                                    '</td><td>' + value
                                    .branch_id + '</td><td>' + value
                                    .division + '</td><td>' + value.department +
                                    '</td><td>' + value.position +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("users/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a><a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
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
                                '<tr><td align="center" colspan="7">Search Not Found</td></tr>';
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
                    url: "{{ url('users/delete') }}/" + clicked_product,
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
            $(document).on('keyup', '#user_search', function() {
                // var query = $(this).val();
                var searchQuery = $('#user_search').val();
                // console.log(querySearch);
                $.ajax({
                    method: 'POST',
                    url: "{{route('user_search.action')}}",
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
                                tableRow = '<tr><td>' + value.code + '</td><td>' +
                                    value
                                    .name + '</td><td>' + value.gender +
                                    '</td><td>' + value
                                    .branch_id + '</td><td>' + value
                                    .division + '</td><td>' + value.department +
                                    '</td><td>' + value.position +
                                    '</td><td><a class="btn  p-0 ml-1 text-primary" title="Details" href="' +
                                    '{{url("users/detail/")}}/' + value.id +
                                    '"><i class="fa fa-eye"></i></a><a class="btn  p-0 ml-1 text-warning" title="Details" href="' +
                                    '{{url("users/update/")}}/' + value.id +
                                    '"><i class="fa fa-edit"></i></a><a class="btn  p-0 ml-1 text-danger btn-delete" title="Delete" href="javascript:void(0)"data-id="' +
                                    value.id +
                                    '"><i class="fa fa-trash"></i></a></td></tr>';
                                $('#dynamic-row').append(tableRow);
                            });
                            // console.log(res);
                        } else {
                            tableRow =
                                '<tr><td align="center" colspan="7">Search Not Found</td></tr>';
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
        .multiselect {
            width: 100px;
        }

        .selectBox select {
            width: 100%;
            height: 20px;
            font-size: 11px;
            line-height: 20px;
        }

        .overSelect {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }

        #checkboxes {
            display: none;
        }

        #checkboxes label {
            background-color: white;
        }

        #checkboxes label:hover {
            background-color: cadetblue;
        }
        </style>
        @endsection