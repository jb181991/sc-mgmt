@extends('admin.template.master')

@section('main_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="#" data-toggle="modal" data-target="#modal-station">
            <button type="button" class="btn btn-success btn-sm">Add Pension</button>
        </a>

        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><i class="fa fa-users"></i> Users</li>
            <li class="active">Add User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add User</h3>

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

                <div class="col-md-12">
                    <div class="col-md-2 text-center">
                        <div class="effect7" id="profile-container" style="width:200px;height:200px;">
                            <img id="profileImage" src="{{ asset('public/dist/img/images.png') }}" style="width:200px;height:200px;" />
                        </div>
                        <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture style="display:none;">
                    </div>
                    <div class="col-md-10">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name <span style="color:red;">*</span></label>
                                <input type="text" name="fname" id="fname" required class="form-control" style="text-transform: capitalize;" placeholder="Juan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email <span style="color:red;">*</span></label>
                                <input type="email" name="mname" id="mname" required class="form-control" style="text-transform: capitalize;" placeholder="De La">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Password <span style="color:red;">*</span></label>
                                <input type="text" style="text-transform: capitalize;" name="lname" id="lname" required class="form-control" placeholder="Cruz">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Confirm Password <span style="color:red;">*</span></label>
                                <input type="text" style="text-transform: capitalize;" name="ename" id="ename" class="form-control" placeholder="Jr.">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h4>Personal Info</h4>
                
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

@section('js')
@if (session()->has('message'))
    @if (session()->get('message') == 'success')
        <script>
            toastr.success('Successfully Save.', 'Success!');
        </script>
    @endif
@endif
<script>
    $(document).ready(function(){
        /* datatable initialization */
        $('#contributions_tbl').DataTable(); /* datatable initialization */

        $("#btn-edit").on('click', function() {
            $.ajax({
                url: "{{ url('/get-pension-data') }}",
                type: "POST",
                data: {'c_id': $(this).attr('data-id'),'_token': $('meta[name="csrf-token"]').attr('content')},
                success: function(items) {
                    $("#senior_id").val(items.user[0].senior_id).trigger('change');
                    $("#contribution").val(items.user[0].pension_amount);
                    $("#id").val(items.user[0].id);
                    $("#modal-station").modal('show');
                }
            });
        });

        $("#btn-del").on('click', function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('/admin-del-pension') }}",
                        type: "POST",
                        data: {'data': $(this).attr('data-id'),'_token': $('meta[name="csrf-token"]').attr('content')},
                        success: function(items) {
                            if(items.status != 500)
                            {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    type: 'success',
                                    showConfirmButton: true,
                                }).then((result) => {
                                    if(result.value){
                                        window.location = "{{ $base_url }}" + "/admin-senior-pension";
                                    }
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Oops! Something went wrong',
                                    'error'
                                )
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
