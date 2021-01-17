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
		<div class="col-md-6">
			<div class="form-group">
				<label for="vPhoneNumber">Phone <span class="text-danger">*</span></label>
				{!! Form::text('vPhoneNumber',null,['id'=>'vPhoneNumber' ,'class' => 'form-control', 'placeholder' => __('Phone')]) !!}
				@if($errors->first('vPhoneNumber'))
				<span class="text-danger">{{ $errors->first('vPhoneNumber') }}</span>
				@endif
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="vEmail">Email </label>
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
				<label for="vPassword">Password @if(!$users)<span class="text-danger">*</span> @endif </label>
				{!! Form::password('vPassword',['id'=>'vPassword' ,'class' => 'form-control', 'placeholder' => __('Password')]) !!}
				@if($errors->first('vPassword'))
				<span class="text-danger">{{ $errors->first('vPassword') }}</span>
				@endif
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="vConfirmPassword">Confirm Password @if(!$users)<span class="text-danger">*</span> @endif</label>
				{!! Form::password('vConfirmPassword',['id'=>'vConfirmPassword' ,'class' => 'form-control', 'placeholder' => __('Confirm Password')]) !!}
				@if($errors->first('vConfirmPassword'))
				<span class="text-danger">{{ $errors->first('vConfirmPassword') }}</span>
				@endif
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="form-group">
				<label for="tiStatus">Status <span class="text-danger">*</span></label>
				<p>
					<label class="ml-5">
						<input type="radio" name="tiStatus" id="tiStatus" class="flat-red" value="{{STATUS_ACTIVE}}" {{ ($users && $users->tiStatus == STATUS_ACTIVE && empty(old('tiStatus')) || ( old() && old('tiStatus') == STATUS_ACTIVE ))?"checked":"" }}>
						<span class="ml-5">Active</span>
					</label>
					<label class="ml-20">
						<input type="radio" name="tiStatus" id="tiStatus" class="flat-red" value="{{STATUS_INACTIVE}}" {{ ($users && $users->tiStatus == STATUS_INACTIVE && empty(old('tiStatus')) || ( !empty(old()) && old('tiStatus') == STATUS_INACTIVE ))?"checked":"" }}>
						<span class="ml-5">Inactive</span>
					</label>
				</p>
				@if($errors->first('tiStatus'))
				<span class="text-danger">{{ $errors->first('tiStatus') }}</span>
				@endif
			</div>
		</div>
	</div>
</div>