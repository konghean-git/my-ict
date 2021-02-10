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
            <a class="nav-link" href="{{url('users')}}">Employees
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
    <div class="row">
        <div class="col-md-5 profile_left ">
            <div class="row">
                <div class="col-md-5">
                    <div class="profile_img">
                        <div id="crop-avatar">
                            <img class="img-thumbnail img-responsive avatar-view"
                                src="{{asset('public/images')}}/{{!empty($user->image) ? $user->image:'none.jpg'}}"
                                alt="{{$user->name}}" title="User Profile" style="width: 100%;">
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h3>{{$user->name}}</h3>
                    <ul class="list-unstyled user_data">

                        <li><i class="fa fa-code user-profile-icon mb-3"></i>
                            @if($user->code < 10) GG-00{{$user->code}} @elseif($user->code < 100)
                                    GG-0{{$user->code}} @else GG-{{$user->code}} @endif </li>
                        <li class="m-top-xs mb-3">
                            <i class="fa fa-at user-profile-icon"></i>
                            <a href="#"> {{$user->email}}</a>
                        </li>
                        <li><i class="fa fa-phone user-profile-icon"></i> +855 {{$user->phone}}</li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-md-7 pt-2">
            <div class="col-md-12">
                <table id="user_detail">
                    <tr>
                        <th>Gender</th>
                        <td>{{$user->gender}}</td>
                        <th>Branch</th>
                        <td>{{!empty($user->branch) ? $user->branch->name:'N/A'}}</td>
                    </tr>
                    <tr>
                        <th>Division</th>
                        <td>{{$user->division}}</td>
                        <th>Department</th>
                        <td>{{$user->department}}</td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th>Position</th>
                        <td>{{$user->position}}</td>
                        <th>Status</th>
                        <td>
                            @if($user->status == 1)
                            ON
                            @else
                            OFF
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="ln_solid mt-5 mb-3"></div>
            <div class="btn-profile w-100">
                <a class="btn btn-sm btn-primary float-right" href="{{url('users/update/' . $user->id)}}">Edit
                    Profile</a>
            </div>
            <div class="btn-profile w-100">
                <a class="btn btn-sm btn-danger mr-2 float-right btn-delete" href="javascript:void(0)"
                                data-id="{{ $user->id }}">Delete</a>
            </div>
        </div>
    </div>
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

@section('style')
<style>
.ln_solid {
    width: 100%;
    height: 1px;
    background-color: lightgray;
}

#user_detail th {
    width: 150px;
    height: 35px;
}

#user_detail td {
    width: 250px;
}
</style>
@endsection

@section('script')
<script>
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
            window.location.href = "{{url('users')}}";

        },
    });
});
</script>
@endsection