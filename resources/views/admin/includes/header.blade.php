<header class="main-header">
	<!-- Logo -->
	<a href="index2.html" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini">
			{{ HTML::image('images/favicon.png', 'Inception', array('class' => '')) }}
		</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg">
			{{ HTML::image('images/logo.svg', 'Inception', array('class' => '')) }}
		</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset(NO_IMAGE) }}" class="user-image" alt="User Image">
						<span class="hidden-xs">{{ \Auth::user()->vLastName }}</span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="{{ asset(NO_IMAGE) }}" class="img-circle" alt="User Image">
							<p>
								{{ \Auth::user()->vFirstName }} {{ \Auth::user()->vLastName }}
								<small>{{ \Auth::user()->vEmail }}</small>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-right">
								<a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>