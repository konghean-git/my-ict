<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Note</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{asset('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('public/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('public/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('public/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/plugins/select2/css/select2.min.css')}}">
 

    <style>
    #main-content,
    .navbar-nav li {
        font-size: 12px;
    }

    .table th {
        color: #212529;
        font-weight: medium;
        font-size: 13px;
        padding: 7px;
        padding-left: 10px;
    }

    .table td {
        color: #212529;
        font-weight: medium;
        font-size: 12px;
        /* height:10px; */
        padding: 3px;
        padding-left: 10px;
    }

    .header div {
        color: black;
    }

    .header div img {
        width: 40%;
    }

    @page {
        size: A4 landscape;
    }

    .header #datatables {
        font-size: 13px;
    }

    .header #datatables tr {
        border-bottom: 1px solid whitesmoke;
        height: 20px;
    }

    .header #datatables th {
        width: 100px;
    }

    #signature {
        font-size: 12px;
    }

    #dn-code {
        font-size: 13px;
    }
    #owner{
        padding-right: 50px;
    }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="header pt-2">
            <div class="row pb-1">
                <div id="ggear-logo" class="col-md-4"><a href="{{url('inventories')}}"><img
                            src="{{url('public/images/ggearlogo.jpg')}}" alt="ggear logo"></a></div>
                <div class="col-md-4 text-center pt-3">
                    <h2> <small><b>Delivery Note</b></small></h2>
                </div>
                <div id="dn-code" class="col-md-4 text-right pt-4">
                    @if($delivery_note->delivery_node_code < 10) <small>DN-Code
                        (000{{$delivery_note->delivery_node_code}})</small><br>
                        @elseif($delivery_note->delivery_node_code < 100) <small>DN-Code
                            (00{{$delivery_note->delivery_node_code}})</small><br>
                            @elseif($delivery_note->delivery_node_code < 1000) <small>DN-Code
                                (0{{$delivery_note->delivery_node_code}})</small><br>
                                @else
                                <small>DN-Code ({{$delivery_note->delivery_node_code}})</small><br>
                                @endif
                                <small>Date ({{$delivery_note->created_at}})</small>
                </div>
            </div>
            <table id="datatables">
                <tr>
                    <th>Name</th>
                    <td>{{$delivery_note->users->name}}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>{{$delivery_note->users->department}}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td>{{$delivery_note->users->position}}</td>
                </tr>
            </table>
        </div>
        <div class="pt-1">
            <table id="datatables" class="table table-bordered table-hover w-100">
                <thead>
                    <tr>
                        <th style="width: 40px;">N<sup>o</sup></th>
                        <th>Code</th>
                        <th>Model</th>
                        <th>Serial</th>
                        <th>Color</th>
                        <th>Description</th>
                        <th>Accessary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>{{$delivery_note->inventories->code}}</td>
                        <td>{{$delivery_note->inventories->model}}</td>
                        <td>{{$delivery_note->inventories->serial}}</td>
                        <td>{{$delivery_note->inventories->color}}</td>
                        <td>{{$delivery_note->inventories->description}}</td>
                        <td>{{$delivery_note->inventories->accessary}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="signature" class="pt-3 row">
            
            <table class="w-100">
                <tr>
                    <th class="pl-5">Prepared By</th>
                    <th class="text-center">Referenced By</th>
                    <th class="text-right" id="owner">Owner By</th>
                </tr>
                <tr>
                    <td style="height: 50px;"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 30px;"><b>Name</b> {{$delivery_note->preparers->name}}</td>
                    <td class="pl-1 text-center"><b>Name</b> {{$delivery_note->references->name}}</td>
                    <td class='row'>
                        <div class="col-md-8"></div>
                        <div class="col-md-4"><b>Name</b> {{$delivery_note->users->name}}</div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 30px;"><b>Date</b>
                        {{\Carbon\Carbon::parse($delivery_note->created_at)->format('d/m/Y')}}</td>
                    <td class="text-center" style="padding-left: 7px;"><b>Date</b>
                        {{\Carbon\Carbon::parse($delivery_note->created_at)->format('d/m/Y')}}</td>
                    <td class='row'>
                        <div class="col-md-8"></div>
                        <div class="col-md-4"><b>Date</b> {{\Carbon\Carbon::parse($delivery_note->created_at)->format('d/m/Y')}}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <script src="{{asset('public/plugins/jquery/jquery.min.js')}}"></script>

</body>

</html>