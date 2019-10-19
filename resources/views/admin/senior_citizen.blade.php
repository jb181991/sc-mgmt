@extends('admin.template.master')

@section('main_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="#" data-toggle="modal" data-target="#modal-station">
            <button type="button" class="btn btn-success btn-sm">Add Record</button>
        </a>

        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Senior Citizen Records</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Senior Citizens</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover datatable" id="records_tbl" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- Add Division modal -->
        <div class="modal fade" id="modal-station" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                                Add new Record
                        </h4>
                    </div>
                    <form id="add_station" method="POST" action="{{ url('/save-record') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <div id="profile-container" style="width:200px;height:200px;">
                                        <img id="profileImage" src="{{ asset('public/dist/img/images.png') }}" style="width:200px;height:200px;" />
                                    </div>
                                    <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture style="display:none;">
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">First Name <span style="color:red;">*</span></label>
                                            <input type="text" name="fname" id="fname" required class="form-control" pattern="[a-zA-Z\s]+" placeholder="Juan">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">M.I <span style="color:red;">*</span></label>
                                            <input type="text" name="mname" id="mname" required class="form-control" maxlength="1" placeholder="A" pattern="[a-zA-Z]+">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Last Name <span style="color:red;">*</span></label>
                                            <input type="text" name="lname" id="lname" required class="form-control" pattern="[a-zA-Z\s]+" placeholder="Cruz">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birthdate <span style="color:red;">*</span></label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" name="birthdate" id="datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Civil Status <span style="color:red;">*</span></label>
                                            <select name="civil_status" id="civil_status" class="form-control select2"  style="width: 100%;">
                                                <option selected disabled>Select Status</option>
                                                @foreach ($civil_status as $item)
                                                    <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Gender <span style="color:red;">*</span></label>
                                            <div class="row col-md-offset-1">
                                                <input type="radio" name="gender" value="Male" class="minimal" checked>
                                                <i class="fa fa-male"></i> | Male
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="gender" value="Female" class="minimal">
                                                <i class="fa fa-female"></i> | Female
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Address <span style="color:red;">*</span></label>
                                        <input type="text" name="address" id="address" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Barangay <span style="color:red;">*</span></label>
                                        <select name="barangay" id="barangay" class="form-control select2" style="width: 100%;">
                                            <option selected disabled>Select Barangay</option>
                                            @foreach ($barangays as $item)
                                                <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Street</label>
                                        <input type="text" name="street" id="street" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone_num" id="phone_num" class="form-control" data-inputmask='"mask": "(0999) 999-9999"' data-mask>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Telephone Number</label>
                                        <input type="text" name="tel_num" id="tel_num" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4><b><i>Contact Person</i></b></h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">First Name <span style="color:red;">*</span></label>
                                        <input type="text" name="cp_fname" id="cp_fname" required class="form-control" pattern="[a-zA-Z\s]+">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Middle Name <span style="color:red;">*</span></label>
                                        <input type="text" name="cp_mname" id="cp_mname" required class="form-control" pattern="[a-zA-Z\s]+">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Last Name <span style="color:red;">*</span></label>
                                        <input type="text" name="cp_lname" id="cp_lname" required class="form-control" pattern="[a-zA-Z\s]+">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Address <span style="color:red;">*</span></label>
                                        <input type="text" name="cp_address" id="cp_address" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="cp_phone_num" id="cp_phone_num" class="form-control" data-inputmask='"mask": "(0999) 999-9999"' data-mask>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Telephone Number</label>
                                        <input type="text" name="cp_tel_num" id="cp_tel_num" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span class="pull-left"><i>Note: Fields with (<span style="color:red;">*</span>) is required.</i></span>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.Add Division modal -->

    </section>
    <!-- /.content -->
@endsection

@section('js')
@if (session()->has('message'))
    @if (session()->get('message') == 'success')
        <script>
            toastr.success('Successfully Save.', 'Success!');
        </script>
    @else
        <script>
            toastr.error('Something went wrong.', 'Oops!');
        </script>
    @endif
@endif
<script>
    $(document).ready(function(){

        $("#profileImage").click(function(e) {
            $("#imageUpload").click();
        });

        function fasterPreview( uploader ) {
            if ( uploader.files && uploader.files[0] ){
                $('#profileImage').attr('src',
                    window.URL.createObjectURL(uploader.files[0]) );
            }
        }

        $("#imageUpload").change(function(){
            fasterPreview( this );
        });

        $('#records_tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{url('/admin-get-records')}}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'fullname', name: 'name' },
                { data: 'birthdate', name: 'age' },
                { data: 'gender', name: 'gender' },
                { data: 'action', name: 'action', className: 'text-center' }
            ]
        });

        $('#datepicker').datepicker({
            autoclose: true,
        });

        $('#records_tbl').on('click', '#btn-del', function(){
            $.ajax({
                url: "{{ url('/admin-del-record') }}",
                type: "POST",
                data: {'data': $(this).attr('data-id'),'_token': $('meta[name="csrf-token"]').attr('content')},
                success: function(items) {
                    if(items.status != 500)
                    {
                        toastr.success('Successfully Deleted.', 'Success!');
                        setTimeout(function(){ window.location.reload() }, 3000);
                    } else {
                        toastr.error('Something went wrong.', 'Oops!');
                    }
                }
            });
        });
    });
</script>
@endsection
