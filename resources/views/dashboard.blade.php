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
						<li class="breadcrumb-item active text-uppercase" aria-current="page">Url Shortner</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->
		<h6 class="mb-0 text-uppercase">Url shortner List</h6>
		<hr/>
        <div id="urlshortnertable-message">
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                @if (Auth::guard('users')->user()->role != 'superadmin')
                <a class="edit btn btn-primary  btn-lg" data-bs-toggle="modal" data-bs-target="#urlshortnertable-add">
                    Genrate short url
                </a>
                @endif
                <table id="urlshortnertable" class="table table-striped table-bordered dataTable no-footer dtr-inline" style="width:100%">
                    <thead>
                        <tr> 
                            <th>Short Url</th>
                            <th>Long Url</th>
                            <th>Hits</th>
                            <th>company</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
        
    </div>
</div>



<div class="modal fade" id="urlshortnertable-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Genrate short url</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="card">
                <div class="card-body p-4">
                    <form id ="urlshortnertable-add" class="urlshortnertable-add row g-3 needs-validation" action="{{ url('genrateurl') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="bsValidation1" class="form-label">Full Url</label>
                                <textarea type="text" name="long_url"  class="form-control"> </textarea>
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
        var urlshortnertable = $('#urlshortnertable').DataTable({
            processing: true,
            //stateSave: true,
            serverSide: true,
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            searchable:true,
            // scrollX: true,
            // language: {
            //     @lang('datatable.strings')
            // },
            order: [[ 4, "desc" ]],
            ajax: {
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url:'{{route('dashboard')}}',
                type: 'POST'

            },
            columns: [
                {data: 'short_url', name: 'short_url'},
                {data: 'long_url', name: 'long_url'},
                {data: 'hits', name: 'hits'},
                {data: 'company', name: 'company'},
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
        $(".urlshortnertable-add").validate({ //class add on component view 
            rules: {
                long_url: {
                    required: true,
                },
            },
            messages: { 
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
                    urlshortnertable.ajax.reload();//first argument send form data //sec argument send custom result design 
                })
            }
        });
    });

</script>
	
	
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
        
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    } );
</script>
<!--app JS-->
<script src="{{ asset('admin_assets/js/app.js') }}"></script>
<script src="{{ url('admin_assets/js/common.js') }}"></script>
@stop