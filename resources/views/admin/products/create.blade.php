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
            <div class="container">
                <div class="clearfix"></div>
                <div class="row">
                    <!-- form input mask -->
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h5><small><i class="fas fa-plus-circle"></i></small> <b>Add Item</b></h5>
                                <div class="clearfix">
                                    <hr>
                                </div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form class="form-horizontal form-label-left"
                                    action="{{url('inventories/create/submit')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-5 p-2">
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3  ">Target</label>
                                                <div class="col-md-9 col-sm-9  ">
                                                    <div class="input-group m-0">
                                                        <select name="target" id="target"
                                                            class="form-control form-control-sm rounded"
                                                            style="color: #495057;" required>
                                                            <option value="" disabled selected hidden>Select Target
                                                            </option>
                                                            @foreach($branches as $branch)
                                                            <option value="{{$branch->name}}">{{$branch->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Category</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <select name="category_id" id="category_id"
                                                        class="form-control form-control-sm rounded"
                                                        style="color: #495057;" required>
                                                        <option value="" disabled selected hidden>Select Category
                                                        </option>
                                                        @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="input-group mb-3">
                                        <label class="control-label col-md-3 col-sm-3">Code</label>
                                        <input id="code" type="text" value="{{old('code')}}" name="code"
                                            class="rounded form-control form-control-sm" readonly required>
                                        <button id="edit-code" class="btn btn-sm btn-outline-secondary" type="button"
                                            id="button-addon2"><i id="ico-code" class="fa fa-edit"></i></button>
                                    </div> -->
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3">Code</label>
                                                <div class="col-md-9 col-sm-9  ">
                                                    <div class="input-group m-0">
                                                        <input id="code" type="text" value="{{old('code')}}" name="code"
                                                            class="rounded form-control form-control-sm" readonly
                                                            required>
                                                        <button id="edit-code" class="btn btn-sm btn-outline-secondary"
                                                            type="button" id="button-addon2"><i id="ico-code"
                                                                class="fa fa-edit"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Model</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" name="model" value="{{old('model')}}"
                                                        class="form-control form-control-sm rounded" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label
                                                    class="control-label col-md-3 col-sm-3 col-xs-3">Condition</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <select name="condition" id="condition"
                                                        class="form-control form-control-sm rounded"
                                                        style="color: #495057;" required>
                                                        <option value="" disabled selected hidden>Select Condition
                                                        </option>
                                                        <option value="New">New</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="Low">Low</option>
                                                        <option value="Broken">Broken</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Service
                                                    Tag</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" name="serial"
                                                        class="form-control form-control-sm rounded"
                                                        value="{{old('serial')}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Color</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" name="color" value="{{old('color')}}"
                                                        class="form-control form-control-sm rounded" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 p-2">
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Price</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="number" step="any" name="price" value="0.00"
                                                        class="form-control form-control-sm rounded" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Vendor</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" name="vendor" value="{{old('vendor')}}"
                                                        class="form-control form-control-sm rounded" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Invoice
                                                    No</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" name="invoice_number"
                                                        class="form-control form-control-sm rounded" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Purchase
                                                    Date</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="datetime-local" name="invoice_date"
                                                        value="{{old('invoice_date')}}"
                                                        class="form-control form-control-sm rounded" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="control-label col-md-3 col-sm-3 col-xs-3">Accessary</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" name="accessary" value="{{old('accessary')}}"
                                                        class="form-control form-control-sm rounded" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Item
                                                    Description</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" name="description" value="{{old('description')}}"
                                                        class="form-control form-control-sm rounded" value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Remark</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <textarea type="text" name="remark"
                                                        class="form-control form-control-sm rounded"
                                                        value="">{{old('remark')}}</textarea>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="float-right">
                                                    <a class="btn btn-sm btn-secondary text-light"
                                                        href="{{url('inventories')}}"
                                                        style="cursor: pointer;">Cancel</a>
                                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                            <label for="image">Profile</label>
                                            <div class="">
                                                <img class=" w-100 img-thumbnail"
                                                    src="{{asset('images/none_inv.jpg')}}" id="previewImage"
                                                    alt="none.jpg" srcset="">
                                            </div>
                                            <div class="pt-2">
                                                <div class="input-group mb-3">
                                                    <input style="width:80px; font-size:small; cursor:pointer;"
                                                        type="file" name="image" id="image"
                                                        onchange="previewFile(this)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
#edit-code {
    cursor: pointer;
}

.form-control-sm {
    color: #495057;
}

.control-label {
    font-size: 12px;
}

.form-control,
.form-control-sm {
    font-size: 12px;
    padding-top: 0;
    padding-bottom: 0;
}
</style>
@endsection

@section('script')
<script>
$(document).ready(function() {

    // Span Code Text
    $('#edit-code').click(function() {
        if ($('#ico-code').hasClass('fa-edit') == true) {
            $('#code').removeAttr('readonly');
            $('#ico-code').removeClass('fa-edit');
            $('#ico-code').addClass('fa-check-square');
        } else {
            $('#code').attr('readonly', true);
            $('#ico-code').addClass('fa-edit');
            $('#ico-code').removeClass('fa-check-square');
        }
    });
    // Code Textbox
    $('#code').blur(function() {
        $('#code').attr('readonly', true);
        $('#ico-code').addClass('fa-edit');
        $('#ico-code').removeClass('fa-check-square-o');
    });
    // Code Automatic generate
    $('#target').change(function() {
        if ($('#target').val() == "Pronith") {
            var max_pronith = 0;
            if (<?php echo strlen($max_pronith); ?> < 11) {
                max_pronith = parseInt("<?php echo substr($max_pronith,-3); ?>");
            } else {
                max_pronith = parseInt("<?php echo substr($max_pronith,-4); ?>");
            }
            if (max_pronith < 10) {
                document.getElementById('code').value = "GGP-COM-00" + (max_pronith + 1);
            } else if (max_pronith < 100) {
                document.getElementById('code').value = "GGP-COM-0" + (max_pronith + 1);
            } else {
                document.getElementById('code').value = "GGP-COM-" + (max_pronith + 1);
            }
            // document.getElementById('code').value = "GGP-COM-" + (max_pronith+1);
        } else {
            var max_hq = 0;
            if (<?php echo strlen($max_hq); ?> < 11) {
                // console.log(<?php echo strlen($max_hq); ?>);
                max_hq = parseInt("<?php echo substr($max_hq, -3); ?>");
            } else {
                max_hq = parseInt("<?php echo substr($max_hq, -4); ?>");
            }
            if (max_hq < 10) {
                document.getElementById('code').value = "GG-COM-00" + (max_hq + 1);
            } else if (max_hq < 100) {
                document.getElementById('code').value = "GG-COM-0" + (max_hq + 1);
            } else {
                document.getElementById('code').value = "GG-COM-" + (max_hq + 1);
            }
            // document.getElementById('code').value = "GGP-COM-" + (max_hq+1);
        }
    });
});

function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function() {
            $('#previewImage').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection