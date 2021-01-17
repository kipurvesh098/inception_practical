@extends('admin.layouts.app')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div id="alert-message">
				@include('flash::message')
			</div>
			<div class="box">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-md-6 bg-light text-left font-size-20">Create</div>
					</div>
				</div>
				{!! Form::open(array('route' => 'admin.admin.store', 'class' => 'form', 'novalidate' => 'novalidate','files'=>true)) !!}
				<div class="box-body">
					@include('admin.admin.forms.form')
				</div>
				<div class="box-footer">
					{!! Form::submit(TITLE_CREATE_BUTTON, array('class'=>'btn btn-success')) !!}
					<a href="{{ route('admin.admin.list') }}" class="btn btn-danger">{{ TITLE_CANCEL_BUTTON }}</a>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
@endsection
@section('scripts')
<script>
	$(document).ready( function () {
	    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	      checkboxClass: 'icheckbox_flat-blue',
	      radioClass   : 'iradio_flat-blue'
	    });
	    $('#iUserTypeId').select2();
	});
</script>
@endsection
