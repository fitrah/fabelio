<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
			<li class="sidebar-search">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button">
						<i class="fa fa-search"></i>
					</button>
				</span>
				</div>
				<!-- /input-group -->
			</li>
			<li>
				<a href="<?=base_url()?>dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
			</li>
			<li>
				<a href="<?=base_url()?>monitoring"><i class="fa fa-bar-chart-o fa-fw"></i> Monitoring<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="<?=base_url()?>monitoring">Add New</a>
					</li>
					<li>
						<a href="<?=base_url()?>monitoring/listdata">View Data</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>