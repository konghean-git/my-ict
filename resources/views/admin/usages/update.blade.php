@extends('layouts.master')

@section('title')
Transfer-Page
@endsection

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>USAGE CREATION</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <form method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4 mb-4">
                                                        <input type="hidden" class="form-control" name='inventory_id'
                                                            id="inventory_id" value="{{$inventory->id}}">

                                                        <div class="mb-2">
                                                            <img class="w-50 img-thumbnail" style="height:100px"
                                                                src="{{asset('public/images')}}/{{$inventory->image}}"
                                                                id="previewImage" alt="none.jpg" srcset="">
                                                        </div>
                                                        <table id="inventory_transfer">
                                                            <tr>
                                                                <th>Code</th>
                                                                <td>{{$inventory->code}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Model</th>
                                                                <td>{{$inventory->model}}</td>
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
                                                        </table>
                                                    </div>
                                                    <div class="col-md-1 d-block">
                                                        <div class="m-auto" id="vl"></div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <legend><small><b>User Information</b></small></legend>
                                                                <div class="form-group row">
                                                                    <label for="user_id"
                                                                        class="col-sm-3 col-form-label" style="font-size:12px">User
                                                                        Name</label>
                                                                    <div class="col-sm-9">
                                                                        <select name="user_id" id="user_id"
                                                                            class="form-control form-control-sm"
                                                                            required>
                                                                            <option value="" class="text-red" selected>
                                                                                Select User</option>
                                                                            @foreach($users as $user)
                                                                            <option value='{{$user->id}}'>
                                                                                {{$user->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="branch"
                                                                        class="col-sm-3 col-form-label" style="font-size:12px">Gender</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm"
                                                                            id="gender" placeholder="Gender" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="division"
                                                                        class="col-sm-3 col-form-label" style="font-size:12px">Division</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm"
                                                                            id="division" placeholder="Division"
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="department"
                                                                        class="col-sm-3 col-form-label" style="font-size:12px">Department</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm"
                                                                            id="department" placeholder="Department"
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="department"
                                                                        class="col-sm-3 col-form-label" style="font-size:12px">Position</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm"
                                                                            id="position" placeholder="Position"
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="previewuser_image" class="col-form-label" style="font-size: 12px;">
                                                                    <b>Profile Image</b>
                                                                </label>
                                                                <div class="w-100">
                                                                    <img style="width: 80%;" class=" img-thumbnail"
                                                                        src="{{asset('public/images/none.jpg')}}"
                                                                        id="previewuser_image" alt="none.jpg" srcset="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <legend><small><b>Delivery Note Information</b></small></legend>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <div class="form-group row">
                                                                    <label for="condition"
                                                                        class="col-sm-5 col-form-label" style="font-size:12px">DN
                                                                        Number</label>
                                                                    <div class="col-sm-7" style="padding-left: 5px;">
                                                                        <input type="text" value=""
                                                                            class="form-control form-control-sm"
                                                                            name="delivery_node_code" id="code"
                                                                            placeholder="0000" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2"
                                                                style="padding-left:0px;padding-right: 12px;">
                                                                <a class="w-100 btn btn-sm border-success"
                                                                    id="edit-code">Edit</a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="condition"
                                                                class="col-sm-4 col-form-label" style="font-size:12px">Condition</label>
                                                            <div class="col-sm-8">
                                                                <select name="condition" id="condition"
                                                                    class="form-control form-control-sm">
                                                                    <!-- <option value="" selected>Select Reference</option> -->
                                                                    @if($inventory->condition == "New")
                                                                    <option value="New" selected>New</option>
                                                                    <option value="Medium">Medium</option>
                                                                    <option value="Low">Low</option>
                                                                    @elseif($inventory->condition == "Medium")
                                                                    <option value="New">New</option>
                                                                    <option value="Medium" selected>Medium</option>
                                                                    <option value="Low">Low</option>
                                                                    @else
                                                                    <option value="New">New</option>
                                                                    <option value="Medium">Medium</option>
                                                                    <option value="Low" selected>Low</option>
                                                                    @endif

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="accessary"
                                                                class="col-sm-4 col-form-label" style="font-size:12px">Accessary</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" value="{{$inventory->accessary}}"
                                                                    class="form-control form-control-sm"
                                                                    name="accessary" id="accessary"
                                                                    placeholder="Assessary">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inventory_description"
                                                                class="col-sm-4 col-form-label" style="font-size:12px">ItemDescription</label>
                                                            <div class="col-sm-8">
                                                                <textarea type="text"
                                                                    class="form-control form-control-sm"
                                                                    name="inventory_description"
                                                                    id="inventory_description"
                                                                    placeholder="Description">{{$inventory->description}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="usage_description"
                                                                class="col-sm-4 col-form-label" style="font-size:12px">UsageDescription</label>
                                                            <div class="col-sm-8">
                                                                <textarea type="text"
                                                                    class="form-control form-control-sm"
                                                                    name="usage_description" id="usage_description"
                                                                    placeholder="UsageDescription"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 pr-5">
                                                        <div class="form-group row">
                                                            <label for="preparer_id"
                                                                class="col-sm-3 col-form-label" style="font-size:12px">Preparer</label>
                                                            <div class="col-sm-9">
                                                                <select name="preparer_id" id="preparer_id"
                                                                    class="form-control form-control-sm" required>
                                                                    <option value="" selected>Select Preparer</option>
                                                                    @foreach($users as $user)
                                                                    <option value='{{$user->id}}'>{{$user->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="reference_id"
                                                                class="col-sm-3 col-form-label" style="font-size:12px">Reference</label>
                                                            <div class="col-sm-9">
                                                                <select name="reference_id" id="reference_id"
                                                                    class="form-control form-control-sm">
                                                                    <option value="" selected>Select Reference</option>
                                                                    @foreach($users as $user)
                                                                    <option value='{{$user->id}}'>{{$user->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <hr> -->
                                                        <div class="user-type">
                                                            <div class="form-group row">
                                                                <label for="user_type"
                                                                    class="col-sm-3 col-form-label" style="font-size:12px">UserType</label>
                                                                <div class="col-sm-9">
                                                                    <select name="user_type" id="user_type"
                                                                        class="form-control form-control-sm" required>
                                                                        <!-- <option value="" selected disabled hidden>Select UserType</option> -->
                                                                        <option value='1' selected>Normal User</option>
                                                                        <option value='0'>Borrow User</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="start_date"
                                                                class="col-sm-3 col-form-label" style="font-size:12px">StartDate</label>
                                                            <div class="col-sm-9">
                                                                <input type="datetime-local"
                                                                    class="form-control form-control-sm"
                                                                    name="start_date" id="start_date" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="expire_date" id="exp_label"
                                                                class="col-sm-3 col-form-label" style="font-size:12px">ExpireDate</label>
                                                            <div class="col-sm-9">
                                                                <input type="datetime-local"
                                                                    class="form-control form-control-sm"
                                                                    name="expire_date" id="expire_date">
                                                            </div>
                                                        </div>
                                                        <!-- <input type="datetime-local" name="to" id="to" value="2014-12-08T15:43:00"> -->
                                                    </div>
                                                    <div class="col-md-2">
                                                        <legend><small><b>Actions</b></small></legend>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-sm btn-secondary w-100"
                                                                id="btn_transfer"
                                                                formaction="{{url('inventories/transfer/now')}}"
                                                                disabled>Transfer
                                                                Now</button>
                                                        </div>
                                                        <div>
                                                            <button type="submit" class="btn btn-sm btn-secondary w-100"
                                                                id="btn_print_transfer"
                                                                formaction="{{url('inventories/transfer/print')}}"
                                                                disabled>Transfer & Print</button>
                                                        </div>
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
    </div>
</div>
@endsection
@section('style')
<style>
#vl{
    width: 2px;
    background-color: whitesmoke;
    height: 100%;
}
#inventory_transfer{
    font-size: 12px;
}
#inventory_transfer td{
    padding: 5px;
}
#inventory_transfer th{
    width: 100px;
}
label {
    color: gray;
}

.input-group>.custom-file,
.input-group>.custom-select,
.input-group>.form-control,
.input-group>.form-control-plaintext {
    padding-left: 4px;
    padding-top: 4px;
}
.form-group label{
    font-size: 12px;
}
.form-control{
    border-radius: 2px;
}
.form-control-sm{
    font-size: 12px;
}
#edit-code{
    cursor: pointer;
}
</style>
@endsection
@section('script')
<script>
$(document).ready(function() {
    // Date And Time Fetch
    $('#expire_date').hide();
    $('#exp_label').hide();

    $('#user_type').change(function() {
        if ($(this).val() == 0) {
            $('#expire_date').show();
            $('#exp_label').show();
        } else {
            $('#expire_date').hide();
            $('#exp_label').hide();
        }
    });

    $('#borrow_user').click(function() {
        if ($(this).checked == true) {
            $('#expire_date').show();
            $('#exp_label').show();
        } else {
            $('#expire_date').hide();
            $('#exp_label').hide();
        }
    });

    // Fetch Data To Delivery Note 
    var max = <?php echo $max_dn ?>;
    if (max < 10) {
        $('#code').val("000" + max);
    } else if (max < 100) {
        $('#code').val("00" + max);
    } else if (max < 1000) {
        $('#code').val("0" + max);
    } else {
        $('#code').val("" + max);
    }

    // Button Transfer Disabled
    // $('#btn_transfer').attr('disabled',true);


    $('#user_id').change(function() {
        let id = $(this).val();
        let inventoryid = $('#inventory_id').val();
        var ref_id = $('#reference_id').val();

        // console.log(inventoryid);
        if (id != "") {
            $.ajax({
                type: 'GET',
                url: "user_info/" + id,
                success: function(response) {
                    $.each(JSON.parse(response), function(key, value) {
                        // console.log(this);
                        $('#gender').val(this.gender);
                        $('#division').val(this.division);
                        $('#department').val(this.department);
                        $('#position').val(this.position);
                        // $('#previewImage').attr('src',this.image);
                        document.getElementById('previewuser_image').src =
                            "{{url('public/images')}}" + "/" + this.image;
                    });
                }
            });
            $('#btn_transfer').removeAttr('disabled');
            // $('#btn_transfer').removeClass('btn-secondary');
            $('#btn_transfer').addClass('btn-success');

            if (ref_id != "") {
                $('#btn_print_transfer').removeAttr('disabled');
                $('#btn_print_transfer').addClass('btn-success');
            } else {
                $('#btn_print_transfer').attr('disabled', true);
                $('#btn_print_transfer').removeClass('btn-success');
            }

        } else {
            $('#btn_transfer').attr('disabled', true);
            $('#btn_transfer').removeClass('btn-success');
            $('#btn_transfer').addClass('btn-secondary');
            $('#gender').val('');
            $('#division').val('');
            $('#department').val('');
            $('#position').val('');
            $('#previewuser_image').attr('src', '{{asset("public/images/none.jpg")}}');
            $('#btn_print_transfer').attr('disabled', true);
            $('#btn_print_transfer').removeClass('btn-success');
        }
    });

    // Reference ID Change
    $('#reference_id').change(function() {
        var ref_id = $(this).val();
        var user_id = $('#user_id').val();
        if (ref_id != "" & user_id != "") {
            $('#btn_print_transfer').removeAttr('disabled');
            $('#btn_print_transfer').addClass('btn-success');
        } else {
            $('#btn_print_transfer').attr('disabled', true);
            $('#btn_print_transfer').removeClass('btn-success');
        }
    });

    // Span Code Text
    $('#edit-code').click(function() {
        if ($(this).text() == 'Edit') {
            $('#code').removeAttr('readonly');
            // $('#condition').removeAttr('disabled');
            // $('#accessary').removeAttr('readonly');
            // $('#description').removeAttr('readonly');
            $(this).text('Check');
        } else {
            $('#code').attr('readonly', true);
            $(this).text('Edit');
            // $('#condition').attr('disabled', true);
            // $('#accessary').attr('readonly', true);
            // $('#description').attr('readonly', true);
        }
        // console.log('click');
    });

    $('#invoice_date').hide();
    $('#date-check').change(function() {
        if ($(this).is(':checked')) {
            $('#invoice_date').show();
        } else {
            $('#invoice_date').hide();
            $('#invoice_date').val('');
        }
    });

    // Code Textbox
    $('#code').blur(function() {
        $('#code').attr('readonly', true);
        $('#span-code').text('Edit');
    });



    var select2 = $('#product-category').select2();

    var selected_data = <?php echo json_encode(old('product_categories')); ?>;
    select2.val(selected_data).trigger('change');

    var the_datatable = $('#datatables').DataTable({
        "ordering": false,
    });

    $('#modal-delete').modal('hide');

    var clicked_product;


    $('body').on('click', '.btn-delete', function() {
        $('#modal-delete').modal('show');
        clicked_product = $(this).attr('data-id');
    });


    $('body').on('click', '#confirm-delete', function() {
        $.ajax({
            url: "{{ url('backend/admin/products/update/delete/') }}/" + clicked_product,
            data: {},
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 1)
                    $('#modal-delete').modal('hide');

                location.reload();

            },
        });
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