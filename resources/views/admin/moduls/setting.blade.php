@extends('layouts.master')
@section('top_menu')
<a class="navbar-brand p-2" href="{{URL::previous()}}"><small><i class="fas fa-chevron-left fa-0x"></i></small></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                <ul class="navbar-nav mr-auto">
                    
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

@section('menu')
<ul class="nav nav-pills pt-1" role="tablist">
    <li role="presentation"><a class="text-light" href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-2 col-sm-1"></div>
    <div class="col-md-8 col-sm-11">
        <div class="top"></div>
        <div class="m-auto flex-container">
            <div class="text-center mb-4">
                <a href="{{url('inventories')}}" class="text-center">
                    <div class="rounded text-center">
                        <img class="w-70 rounded" src="{{asset('public/images/products.png')}}" alt="">
                    </div>
                    <div class="title">Inventory</div>
                </a>
            </div>
            <div class="text-center mb-4">
                <a href="{{url('categories')}}" class="text-center">
                    <div class="rounded text-center">
                        <img class="w-70 rounded" src="{{asset('public/images/categories.png')}}" alt="">
                    </div>
                    <div class="title">Category</div>
                </a>
            </div>
            <div class="text-center mb-4">
                <a href="{{url('users')}}" class="text-center">
                    <div class="rounded text-center">
                        <img class="w-70 rounded" src="{{asset('public/images/employee.png')}}" alt="">
                    </div>
                    <div class="title">Employees</div>
                </a>
            </div>
            <div class="text-center mb-4">
                <a href="{{url('branches')}}" class="text-center">
                    <div class="rounded text-center">
                        <img class="w-70 rounded" src="{{asset('public/images/branches.png')}}" alt="">
                    </div>
                    <div class="title">Branch</div>
                </a>
            </div>
            <div class="text-center mb-4">
                <a href="{{url('categories')}}" class="text-center">
                    <div class="rounded text-center">
                        <img class="w-70 rounded" src="{{asset('public/images/categories.png')}}" alt="">
                    </div>
                    <div class="title">DN Report</div>
                </a>
            </div>
            <div class="text-center mb-4">
                <a href="{{url('inventories')}}" class="text-center">
                    <div class="rounded text-center">
                        <img class="w-70 rounded" src="{{asset('public/images/usages.png')}}" alt="">
                    </div>
                    <div class="title">Usages</div>
                </a>
            </div>
            <div class="text-center mb-4">
                <a href="{{url('vouchers')}}" class="text-center">
                    <div class="rounded text-center">
                        <img class="w-70 rounded" src="{{asset('public/images/vouchers.png')}}" alt="">
                    </div>
                    <div class="title">Voucher</div>
                </a>
            </div>
            <div class="text-center mb-4">
                <a href="{{url('supports')}}" class="text-center">
                    <div class="rounded text-center">
                        <img class="w-70 rounded" src="{{asset('public/images/supports.png')}}" alt="">
                    </div>
                    <div class="title">Claim Support</div>
                </a>
            </div>
            <div class="text-center mb-4">
                <a href="{{url('users')}}" class="text-center">
                    <div class="rounded text-center">
                        <img class="w-70 rounded" src="{{asset('public/images/role.png')}}" alt="">
                    </div>
                    <div class="title">Role Setting</div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-1"></div>
</div>
@endsection
@section('style')
<style>
body {
    background-color: while;
}

.top {
    height: 50px;
    width: 100px;
}

.flex-container {
    display: flex;
    /* justify-content: center; */
    align-items: center;
    /* height: 500px; */
    flex-wrap: wrap;

}

.flex-container div {
    margin: 3px;
}

.w-70 {
    width: 60%;
}

.icon {
    padding: 0px;
}

.title {
    /* margin-top: 8px; */
    color: whitesmoke;
    background-color: cadetblue;
    /* width: 95%; */
    text-align: center;
    border-radius: 10px;
    font-size: 12px;
}

.bg-yellow {
    background-color: yellow;
}
</style>
@endsection