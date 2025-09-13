@extends('layouts.app')
@section('content')
<?php
// echo $Users;  exit;

?>
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active text-uppercase" aria-current="page">Client</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->
		<h6 class="mb-0 text-uppercase">Client</h6>
		<hr/>
        <div id="clienttable-message">
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                @if (Auth::guard('users')->user()->role == 'superadmin')
                <a class="edit btn btn-primary  btn-lg" data-bs-toggle="modal" data-bs-target="#clienttable-add">
                    Invite Client
                </a>
                @endif
                <table id="clienttable" class="table table-striped table-bordered dataTable no-footer dtr-inline" style="width:100%">
                    <thead>
                        <tr> 
                            <th>Name</th>
                            <th>Users</th>
                            <th>Total Genrated Url</th>
                            <th>Total Hit Url</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
        
    </div>
</div>



<div class="modal fade" id="clienttable-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Invite Client</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="card">
                <div class="card-body p-4">
                    <form id ="clienttable-add" class="clienttable-add row g-3 needs-validation" action="{{ url('inviteClient') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="bsValidation1" class="form-label">Company Name</label>
                                <input type="text" name="company_name" placeholder='Enter company name'  class="form-control" /> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="bsValidation1" class="form-label">name</label>
                                <input type="text" name="name" placeholder='Enter name'  class="form-control"> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="bsValidation1" class="form-label">Email</label>
                                <input type="email" name="email" placeholder='Enter Email'  class="form-control"> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="bsValidation1" class="form-label">Password</label>
                                <input type="text" name="password" placeholder='Enter password' class="form-control"> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="bsValidation1" class="form-label">Phone</label>
                                <input type="number" name="phone" placeholder='Enter phone' class="form-control"> 
                            </div>
                        </div>
                        <div id="form-result"></div>
                        <div class="form-group">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-white px-4">Submit</button>
                                <!-- <button type="reset" class="btn btn-light px-4">Reset</button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>


@stop

@section('scripts')


<script>

    $(function(){
        var clienttable = $('#clienttable').DataTable({
            processing: true,
            //stateSave: true,
            serverSide: true,
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            searchable:true,
            ajax: {
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url:'{{route('client')}}',
                type: 'POST'
            },
            columns: [
                 {data: 'name', name: 'name'},
                 {data: 'users', name: 'users'},
                {data: 'total_genrated_url', name: 'total_genrated_url'},
                {data: 'total_hit_url', name: 'total_hit_url'},
                {data: 'created_at', name: 'created_at'},
            ],
            orderBy: [["created_at", "desc"]],
            searchDelay: 500,
            dom: 'Blfrtip',
            buttons: {
                buttons: [
                    // {extend: 'csv', footer: true, exportOptions: {columns: [1, 2, 3, 4, 5]}},
                    // {extend: 'excel', footer: true, exportOptions: {columns: [1, 2, 3, 4, 5]}},
                    // {extend: 'print', footer: true, exportOptions: {columns: [1, 2, 3, 4, 5]}}
                ]
            }

        })
        
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                if (regexp.constructor != RegExp)
                    regexp = new RegExp(regexp);
                else if (regexp.global)
                    regexp.lastIndex = 0;
                    return this.optional(element) || regexp.test(value);
            }
        );
        $(".clienttable-add").validate({ //class add on component view 
            rules: {
                company_name: {
                    required: true,
                    maxlength: 20,
                    regex:/^[a-zA-Z\s-]+$/,
                },
                name:{
                    required: true,
                    maxlength: 20,
                    regex:/^[a-zA-Z\s-]+$/,
                },
                email: {
                    required:true,
                    regex: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:[A-Z]{2}|com|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)$/i,
                    maxlength: 90,
                },
                phone: {
                    required:true,
                    digits: true,
                    minlength:5,
                    regex:/^([0|+[0-9]{1,5})?([7-9][0-9]{6,20})$/, 
                    maxlength:15,
                }
            },
            messages: { 
                company_name:{
                    regex:"Please Enter valid company name" 
                },
                name:{
                    regex:"please Enter valid name"
                },
                email:{
                    regex:"Please Enter valid Email."  
                },
                phone:{
                    regex:"Please Enter valid phone no."
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {

                commonAjax(form).then((res)=>{   //ajax response then data table reload 
                    clienttable.ajax.reload();//first argument send form data //sec argument send custom result design 
                })
            }
        });
    });

</script>

<script src="{{ asset('admin_assets/js/app.js') }}"></script>
<script src="{{ url('admin_assets/js/common.js') }}"></script>
@stop