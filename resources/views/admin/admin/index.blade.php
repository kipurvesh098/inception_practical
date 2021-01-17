@extends('admin.layouts.app')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div id="alert-message">
				@include('flash::message')
			</div>
			<!-- Search box -->
			<form id="search-frm" method="post">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-search"></i> Advanced Search</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-md-3">
							<label class="control-label">First Name</label>
							{!! Form::text('vFirstName',null,['id'=>'vFirstName' ,'class' => 'form-control', 'placeholder' => __('First Name')]) !!}
						</div>
						<div class="col-md-3">
							<label class="control-label">Last Name</label>
							{!! Form::text('vLastName',null,['id'=>'vLastName' ,'class' => 'form-control', 'placeholder' => __('Last Name')]) !!}
						</div>
						<div class="col-md-3">
							<label class="control-label">Email</label>
							{!! Form::email('vEmail',null,['id'=>'vEmail' ,'class' => 'form-control', 'placeholder' => __('Email')]) !!}
						</div>
						<div class="col-md-3">
							<label class="control-label">Phone Number</label>
							{!! Form::text('vPhoneNumber',null,['id'=>'vPhoneNumber' ,'class' => 'form-control', 'placeholder' => __('Phone Number')]) !!}
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button class="btn btn-primary">Search</button>
					<button class="btn btn-danger btn-reset">Reset</button>
				</div>
				<!-- /.box-footer -->
			</div>
			</form>
			<!-- /.box -->
			<div class="box">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-md-6 bg-light text-left font-size-20">List</div>
						<div class="col-md-6 bg-light text-right">
							<a href="{{ route('admin.admin.create') }}" class="btn btn-primary">{{ TITLE_ADMIN_CREATE }}</a>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table id="adminDatatableAjax" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Serial Number</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Phone Number</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('scripts')
<script>
	$(document).ready( function () {
		var firstLoad = true;
		$('.btn-reset').click(function(){
			$("#search-frm").trigger("reset");
			location.reload();
		});
		$("#search-frm").submit(function(){
			table.draw();
			return false;
		});
		var table = $('#adminDatatableAjax').DataTable({
			lengthChange: true,
			serverSide: true,
			searching: false,
			processing: true,
			stateSave: true,
			ajax: {
				"url": "{!! route('admin.admin.fetch.data') !!}",
				"data": function (data){
					data.vFirstName = $("#search-frm input[name='vFirstName']").val();
					data.vLastName = $("#search-frm input[name='vLastName']").val();
					data.vEmail = $("#search-frm input[name='vEmail']").val();
					data.vPhoneNumber = $("#search-frm input[name='vPhoneNumber']").val();
				},
			},
			lengthMenu:
			[
			[25,50,100,200],
			[25,50,100,200]
			],
			order: [['1', "DESC"]],
			columns: [
			{data: 'iUserId', name: 'iUserId'},
			{data: 'vFirstName', name: 'vFirstName'},
			{data: 'vLastName', name: 'vLastName'},
			{data: 'vEmail', name: 'vEmail', orderable: false, searchable: false},
			{data: 'vPhoneNumber', name: 'vPhoneNumber'},
			{data: 'tiStatus', name: 'tiStatus', orderable: false, searchable: false},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
		// Delete user
		$('body').on('click', '.deleteAdmin', function () {
			var iUserId = $(this).data("id");
			$.confirm({
				title: 'Confirm!',
				content: 'Are you sure! you want to delete?',
				buttons: {
					Delete: function () {
						$.post("{{ route('admin.admin.delete') }}", {iUserId: iUserId, _method: 'DELETE', _token: '{{ csrf_token() }}'})
						.done(function (response) {
							if (response == 'ok') {
								var table = $('#adminDatatableAjax').DataTable();
								table.row('admin_dt_row_' + iUserId).remove().draw(false);
								close();
							} else {
								$.alert('Request Failed!!');
							}
						});
					},
					cancel: function () {
						close();
					}
				}
			});
		});
	});
</script>
@endsection
