@extends('admin.layouts.app')
@section('content')
<!-- Main content -->
<section class="content">
	<div id="alert-message">
		@include('flash::message')
	</div>
	<div class="row">
		<div class="col-md-3">
			<!-- Profile Image -->
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="{{ $userImagePath }}" alt="User profile picture">
					<h3 class="profile-username text-center">{{ Str::ucfirst(\Auth::user()->vFirstName) }} {{ Str::ucfirst(\Auth::user()->vLastName) }}</h3>
					<p class="text-muted text-center">{{ \Auth::user()->UserTypes->vName }}</p> 
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Email</b> <a class="pull-right" href="mailto:{{ \Auth::user()->vEmail }}">{{ \Auth::user()->vEmail }}</a>
						</li>
						<li class="list-group-item">
							<b>Phone</b> <a class="pull-right" href="tel:{{ \Auth::user()->vPhoneNumber }}">{{ \Auth::user()->vPhoneNumber }}</a>
						</li>
						<li class="list-group-item">
							<b>Gender</b> <a class="pull-right">{{ Str::ucfirst(\Auth::user()->eGender) }}</a>
						</li>
						<li class="list-group-item">
							<b>Status</b> <a class="pull-right">@if(\Auth::user()->tiStatus == STATUS_ACTIVE)<span class="label label-success">Active</span> @else <span class="label label-danger">Inactive</span>@endif</a>
						</li>
					</ul>
					<a href="{{ route('admin.changepassword') }}" class="btn btn-primary btn-block"><b>Change Password</b></a>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
		<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-md-6 bg-light text-left font-size-20">Profile Setting</div>
					</div>
				</div>
				{!! Form::model($users, array('method' => 'put', 'route' => array('admin.profile.submit', $users->iUserId), 'class' => 'form', 'files'=>true)) !!}
                {!! Form::hidden('iUserId', $users->iUserId) !!}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">                                     
									<label for="vFirstName">First Name <span class="text-danger">*</span></label>
									{!! Form::text('vFirstName',null,['id'=>'vFirstName' ,'class' => 'form-control', 'placeholder' => __('First Name')]) !!}
									@if($errors->first('vFirstName'))
									<span class="text-danger">{{ $errors->first('vFirstName') }}</span>
									@endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="vLastName">Last Name <span class="text-danger">*</span></label>
									{!! Form::text('vLastName',null,['id'=>'vLastName' ,'class' => 'form-control', 'placeholder' => __('Last Name')]) !!}
									@if($errors->first('vLastName'))
									<span class="text-danger">{{ $errors->first('vLastName') }}</span>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label for="vEmail">Email <span class="text-danger">*</span></label>
									{!! Form::email('vEmail',null,['id'=>'vEmail' ,'class' => 'form-control', 'placeholder' => __('Email')]) !!}
									@if($errors->first('vEmail'))
									<span class="text-danger">{{ $errors->first('vEmail') }}</span>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="eGender">Gender</label>
									<p>
										<label class="ml-5">
											<input type="radio" name="eGender" id="eGender" class="flat-red" value="male" {{ ($users && $users->eGender == "male")?"checked":"" }}>
											<span class="ml-5">Male</span>
										</label>
										<label class="ml-20">
											<input type="radio" name="eGender" id="eGender" class="flat-red" value="female" {{ ($users && $users->eGender == "female")?"checked":"" }}>
											<span class="ml-5">Female</span>
										</label>
									</p>
									@if($errors->first('eGender'))
									<span class="text-danger">{{ $errors->first('eGender') }}</span>
									@endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="vPhoneNumber">Phone</label>
									{!! Form::text('vPhoneNumber',null,['id'=>'vPhoneNumber' ,'class' => 'form-control', 'placeholder' => __('Phone')]) !!}
									@if($errors->first('vPhoneNumber'))
									<span class="text-danger">{{ $errors->first('vPhoneNumber') }}</span>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="vImage">Profile Image</label>
									<input type="file" id="vImage" name="vImage">
									<p class="help-block">Only jpg jpeg or png files are allowed and file size less than 1mb</p>
									@if($errors->first('vImage'))
									<span class="text-danger">{{ $errors->first('vImage') }}</span>
									@endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tiStatus">Status <span class="text-danger">*</span></label>
									<p>
										<label class="ml-5">
											<input type="radio" name="tiStatus" id="tiStatus" class="flat-red" value="1" {{ ($users && $users->tiStatus == 1)?"checked":"" }}>
											<span class="ml-5">Active</span>
										</label>
										<label class="ml-20">
											<input type="radio" name="tiStatus" id="tiStatus" class="flat-red" value="0" {{ ($users && $users->tiStatus == 0)?"checked":"" }}>
											<span class="ml-5">Inactive</span>
										</label>
									</p>
									@if($errors->first('tiStatus'))
									<span class="text-danger">{{ $errors->first('tiStatus') }}</span>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tDetails">About Details</label>
									{!! Form::textarea('tDetails', null, ['id'=>'tDetails','class'=>'form-control','rows'=>'5','placeholder' => __('About Details')]) !!}
									@if($errors->first('tDetails'))
									<span class="text-danger">{{ $errors->first('tDetails') }}</span>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					{!! Form::submit('Save', array('class'=>'btn btn-success')) !!}
				</div>
				{!! Form::close() !!}
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
@endsection
@section('scripts')
<script>
	$(document).ready( function () {
		$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass   : 'iradio_flat-blue'
		});
	});
</script>
@endsection