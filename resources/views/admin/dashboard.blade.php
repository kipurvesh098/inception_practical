@extends('admin.layouts.app')
@section('content')
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12">
			<div id="alert-message">
				@include('flash::message')
			</div>
		</div>

		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Users</span>
					<span class="info-box-number">{{ $user }}</span>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection