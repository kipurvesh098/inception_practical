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
					<img class="profile-user-img img-responsive img-circle" src="{{ \App\Helpers\AWSHelper::generatePresignedURLS3(\Auth::user()->vImage, USER_PROFILE_PATH) }}" alt="User profile picture">
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
					<a href="{{ route('admin.profile') }}" class="btn btn-primary btn-block"><b>Profile Setting</b></a>
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
						<div class="col-md-6 bg-light text-left font-size-20">Change Password</div>
					</div>
				</div>
				{!! Form::model($users, array('method' => 'put', 'route' => array('admin.changepassword.submit', $users->iUserId), 'class' => 'form', 'files'=>true)) !!}
            	{!! Form::hidden('iUserId', $users->iUserId) !!}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label for="current_password">Current Password <span class="text-danger">*</span></label>
									{!! Form::password('current_password',['id'=>'current_password' ,'class' => 'form-control', 'placeholder' => __('Old Password')]) !!}
									@if($errors->first('current_password'))
									<span class="text-danger">{{ $errors->first('current_password') }}</span>
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="vPassword">New Password <span class="text-danger">*</span></label>
									{!! Form::password('vPassword',['id'=>'vPassword' ,'class' => 'form-control', 'placeholder' => __('New Password')]) !!}
									@if($errors->first('vPassword'))
									<span class="text-danger">{{ $errors->first('vPassword') }}</span>
									@endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="vConfirmPassword">New Confirm Password <span class="text-danger">*</span></label>
									{!! Form::password('vConfirmPassword',['id'=>'vConfirmPassword' ,'class' => 'form-control', 'placeholder' => __('New Confirm Password')]) !!}
									@if($errors->first('vConfirmPassword'))
									<span class="text-danger">{{ $errors->first('vConfirmPassword') }}</span>
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