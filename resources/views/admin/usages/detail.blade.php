@extends('layouts.master')


@section('top_menu')
<a class="navbar-brand pl-2" href="{{url('asset/home')}}"><i class="fas fa-home"></i></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
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
<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row pt-2">
                    <div class="col-sm-3">
                        <img class="w-100 img img-thumbnail"
                            src="{{asset('public/images')}}/{{$usage->users->image}}"
                            alt="{{$usage->users->name}}">
                    </div>
                    <div class="col-md-3">
                        <table class="inventory_block">
                            <tr>
                                <th>Code</th>
                                <td>{{$usage->users->code}}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{$usage->users->name}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{$usage->users->gender}}</td>
                            </tr>
                            <tr>
                                <th>Branch</th>
                                <td>{{!empty($usage->users->branch->name) ? $usage->users->branch->name:'N/A'}}
                                </td>
                            </tr>
                            <tr>
                                <th>Division</th>
                                <td>{{$usage->users->division}}</td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td>{{$usage->users->department}}</td>
                            </tr>
                            <tr>
                                <th>Position</th>
                                <td>{{$usage->users->position}}</td>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <td>+855 {{$usage->users->phone}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td class="text-info"><u><i>{{$usage->users->email}}</i></u></td>
                            </tr>
                            <tr>
                                <th>Transaction Type</th>
                                @if($usage->is_normal_user == 1 && $usage->is_using == 1)
                                <td class="text-warning"><u><i>Permanent (In Using)</i></u></td>
                                @elseif($usage->is_normal_user == 1 && $usage->is_using == 0)
                                <td class="text-warning"><u><i>Permanent (Returned)</i></u></td>
                                @elseif($usage->is_normal_user == 0 && $usage->is_using == 1)
                                <td class="text-warning"><u><i>Borrow (In Using)</i></u></td>
                                @else
                                <td class="text-warning"><u><i>Borrow (Returned)</i></u></td>
                                @endif
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-1">
                        <div class="line-vertical m-auto"></div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="">
                            <table class="dn_block">
                                <tr>
                                    <th>DN Number</th>
                                    @if($usage->delivery_node_code < 10) <td>
                                        000{{$usage->delivery_node_code}}</td>
                                        @elseif($usage->delivery_node_code < 100) <td>
                                            00{{$usage->delivery_node_code}}
                                            </td>
                                            @elseif($usage->delivery_node_code < 1000) <td>
                                                0{{$usage->delivery_node_code}}</td>
                                                @else
                                                <td>{{$usage->delivery_node_code}}</td>
                                                @endif
                                </tr>
                                <tr>
                                    <th>Prepared By </th>
                                    <td>{{$usage->preparers->name}}</td>
                                </tr>
                                <tr>
                                    <th>Reference By </th>
                                    <td>{{!empty($usage->references) ? $usage->references->name:'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>UserType </th>
                                    @if($usage->is_normal_user == 1)
                                    <td>Normal User</td>
                                    @else
                                    <td>Borrow User</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>ItemDescription </th>
                                    <td>{{$usage->inventory_description }}</td>
                                </tr>
                                <tr>
                                    <th>UsageDescription </th>
                                    <td>{{$usage->usage_description }}</td>
                                </tr>
                                <tr>
                                    <th>StartDate </th>
                                    <td>{{$usage->started_at }}</td>
                                </tr>
                                <tr>
                                    <th>EndDate </th>
                                    <td>{{!empty($usage->finished_at) ? $usage->finished_at:'N/A' }}
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
@endsection

@section('style')
<style>
    .table th {
        color: #212529;
        font-weight: medium;
        font-size: 11px;
        padding: 7px;
        padding-left: 10px;
    }

    .table td {
        color: #212529;
        font-weight: medium;
        font-size: 11px;
        /* height:10px; */
        padding: 3px;
        padding-left: 10px;
    }

    .inventory_block th {
        width: 100px;
        padding: 5px;
        font-size: 12px;
    }

    .inventory_block td {
        padding-right: 20px;
        font-size: 12px;
    }

    .inventory_block tr {
        border-bottom: 1px solid whitesmoke;
    }

    .line-vertical {
        width: 1px;
        height: 90%;
        background-color: whitesmoke;
    }

    .dn_block th {
        width: 150px;
        padding: 8px;
        font-size: 12px;
    }

    .dn_block td {
        width: 350px;
        padding: 8px;
        font-size: 12px;
    }
</style>
@endsection