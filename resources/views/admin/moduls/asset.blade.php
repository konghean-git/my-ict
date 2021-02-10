@extends('layouts.master')
@section('top_menu')
<a class="navbar-brand p-2" href="{{url('dashboard')}}"><small><i class="fas fa-th fa-0x"></i></small></a>
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
    <div class="col-md-2"></div>
    <div class="col-md-8 col-sm-12">
        <div class="top"></div>
        <div class="m-auto flex-container">
            <div class="text-center m-2 ">
                <a href="{{url('categories')}}" class="text-center">
                    <div class="rounded modul text-center pt-4 pl-4 pr-4 pb-0 bg-info">
                        <i class="fas fa-boxes fa-3x"></i>
                        <div class="title bg-info pt-2 pb-2">Category</div>
                    </div>
                </a>
            </div>
            <div class="text-center m-2 ">
                <a href="{{url('inventories')}}" class="text-center">
                    <div class="rounded modul text-center pt-4 pl-4 pr-4 pb-0 bg-info">
                        <i class="fas fa-dolly-flatbed fa-3x"></i>
                        <div class="title bg-info pt-2 pb-2">Inventory</div>
                    </div>
                </a>
            </div>
            <div class="text-center m-2 ">
                <a href="{{url('branches')}}" class="text-center">
                    <div class="rounded modul text-center pt-4 pl-4 pr-4 pb-0 bg-info">
                        <i class="fas fa-store-alt fa-3x"></i>
                        <div class="title bg-info pt-2 pb-2">Branch</div>
                    </div>
                </a>
            </div>
            <div class="text-center m-2 ">
                <a href="{{url('users')}}" class="text-center">
                    <div class="rounded modul text-center pt-4 pl-4 pr-4 pb-0 bg-info">
                        <i class="fas fa-users fa-3x"></i>
                        <div class="title bg-info pt-2 pb-2">Employee</div>
                    </div>
                </a>
            </div>
            <div class="text-center m-2 ">
                <a href="{{url('inventories/usages/report')}}" class="text-center">
                    <div class="rounded modul text-center pt-4 pl-4 pr-4 pb-0 bg-info">
                        <i class="fas fa-sticky-note fa-3x"></i>
                        <div class="title bg-info pt-2 pb-2">DN Report</div>
                    </div>
                </a>
            </div>
            <div class="text-center m-2 ">
                <a href="{{url('inventories/usages')}}" class="text-center">
                    <div class="rounded modul text-center pt-4 pl-4 pr-4 pb-0 bg-info">
                        <i class="fas fa-users-cog fa-3x"></i>
                        <div class="title bg-info pt-2 pb-2">Usages</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
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
    justify-content: center;
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
.modul:hover{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.5);
}
</style>
@endsection