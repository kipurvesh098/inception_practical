@extends('admin.auth.layouts.auth')

@section('content')
<div class="login-box-body">
	<p class="login-box-msg">Sign in to start your session</p>
	{!! Form::open(['route' => 'admin.login.submit', 'id' => 'submit-form', 'method' => 'POST','redirect-url'=>route('admin.dashboard')]) !!}
		<div class="form-group has-feedback">
			{!! Form::text('phone',null,['class' => 'form-control', 'placeholder' => __('Phone')]) !!}
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			{!! Form::password('password',['class' => 'form-control', 'placeholder' => __('Password')]) !!}
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<div class="row">
			<div class="col-xs-8">
				<div class="checkbox icheck">
					<label>
					{!! Form::checkbox('remember_me',1) !!} {{ __("Remember Me") }}
					</label>
				</div>
			</div>
			<div class="col-xs-4">
				<button type="submit" id="submitBtn" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div>
		</div>
	{!! Form::close() !!}
</div>
@endsection