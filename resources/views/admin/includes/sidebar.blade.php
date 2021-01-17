<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
				<a href="{{ route('admin.dashboard') }}">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			
			<li class="{{ (request()->is('admin/admin/*')) ? 'active' : '' }}">
				<a href="{{ route('admin.admin.list') }}">
					<i class="fa fa-user-plus"></i> <span>Admin</span>
				</a>
			</li>
			
			<li class="{{ (request()->is('admin/category/*')) ? 'active' : '' }}">
				<a href="{{ route('admin.category.list') }}">
					<i class="fa fa-list-alt"></i> <span>Category</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>