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
							<div class="col-md-6">
								<label class="control-label">Title</label>
								{!! Form::text('vTitle',null,['id'=>'vTitle' ,'class' => 'form-control', 'placeholder' => __('Title')]) !!}
							</div>
							<div class="col-md-6">
								<label class="control-label">Parent Category</label>
								{!! Form::text('iParentCategoryId',null,['id'=>'iParentCategoryId' ,'class' => 'form-control', 'placeholder' => __('Parent Category')]) !!}
							</div>
						</div>
						<div class="clearfix">&nbsp;</div>
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
							<a href="{{ route('admin.category.create') }}" class="btn btn-primary">{{ TITLE_CATEGORY_CREATE_BUTTON }}</a>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table id="categoryDatatableAjax" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Serial Number</th>
								<th>Title</th>
								<th>Parent Category</th>
								<th>Slug</th>
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
		var table = $('#categoryDatatableAjax').DataTable({
			lengthChange: true,
			serverSide: true,
			searching: false,
			processing: true,
			stateSave: true,
			ajax: {
				"url": "{!! route('admin.category.fetch.data') !!}",
				"data": function (data){
					data.vTitle = $("#search-frm input[name='vTitle']").val();
					data.iParentCategoryId = $("#search-frm input[name='iParentCategoryId']").val();
				},
			},
			lengthMenu:
			[
			[25,50,100,200],
			[25,50,100,200]
			],
			'columnDefs': [{
				"targets": 4,
				"className": "text-center",
			}],
			order: [['1', "DESC"]],
			columns: [
			{data: 'iCategoryId', name: 'iCategoryId'},
			{data: 'vTitle', name: 'vTitle'},
			{data: 'iParentCategoryId', name: 'iParentCategoryId'},
			{data: 'vSlug', name: 'vSlug'},
			{data: 'tiStatus', name: 'tiStatus', orderable: false, searchable: false},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
		// Delete Category
		$('body').on('click', '.deleteCategory', function () {
			var iCategoryId = $(this).data("id");
			$.confirm({
				title: 'Confirm!',
				content: 'Are you sure! you want to delete?',
				buttons: {
					Delete: function () {
						$.post("{{ route('admin.category.delete') }}", {iCategoryId: iCategoryId, _method: 'DELETE', _token: '{{ csrf_token() }}'})
						.done(function (response) {
							if (response == 'ok') {
								var table = $('#categoryDatatableAjax').DataTable();
								table.row('category_dt_row_' + iCategoryId).remove().draw(false);
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
