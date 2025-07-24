	<aside class="main-sidebar">
		<section class="sidebar">
			<div class="user-panel">	
				<div class="pull-left image">
					
					
					<img src="uplode/<?php echo $_SESSION['u_id'].'.jpg';?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?php echo $_SESSION['name'];?></p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">MENUS</li>
				<?php	

					if($_SESSION['isadmin']=="1" || $_SESSION['isadmin']=="0")
					{
						?>
						<li class="treeview">
						<a href="#">
							<i class="fa fa-id-card"></i><span>Masters</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="active"><a href="authority.php"><i class="fa fa-circle-o"></i>Authority Master</a></li>
							<li><a href="reference.php"><i class="fa fa-circle-o"></i>Reference Master</a></li>
							<li><a href="tax.php"><i class="fa fa-circle-o"></i>TAX Master</a></li>
							<li><a href="material.php"><i class="fa fa-circle-o"></i>Material Master</a></li>
							<li><a href="fyearmaster.php"><i class="fa fa-circle-o"></i>Financial Year Master</a></li>
							<li><a href="agency.php"><i class="fa fa-circle-o"></i>Agency Master</a></li>
							<li><a href="city.php"><i class="fa fa-circle-o"></i>City Master</a></li>
							<li><a href="ipmaster.php"><i class="fa fa-circle-o"></i>Ip Master</a></li>
							<li><a href="category.php"><i class="fa fa-circle-o"></i>Category Master</a></li>
							<li><a href="material_category.php"><i class="fa fa-circle-o"></i>Material Category Master</a></li>
						</ul>
					</li>
						<?php
					}?>
					
					
					<?php	

					if($_SESSION['isadmin']=="0")
					{
						?>
						<li class="treeview">
						<a href="#">
							<i class="fa fa-id-card"></i>
							<span>Add Staff</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
						</a>
						<ul class="treeview-menu">
						<li class="active"><a href="staff.php"><i class="fa fa-circle-o"></i>Staff Master</a></li>
						
					</ul>
				</li>
					<?php
					}?>	

				<li class="treeview">
					<a href="#">
						<i class="fa fa-id-card"></i>
						<span>Job Inward</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="active"><a href="client_form.php"><i class="fa fa-circle-o"></i>Job Inward</a></li>
						<li class="active"><a href="job_listing.php"><i class="fa fa-circle-o"></i>Job Inward Detail</a></li>
						
					</ul>
				</li>	
				<?php if($_SESSION['isadmin']=="1" || $_SESSION['isadmin']=="0")
					{
						?>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-id-card"></i>
						<span>Billing</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
					
						<!--<li class="active"><a href="billing.php"><i class="fa fa-circle-o"></i>Add Esstimate</a></li>-->
						
						<li class="active"><a href="view_est_bill.php"><i class="fa fa-circle-o"></i>Esstimate Bill Details</a></li>
						<li class="active"><a href="view_bill.php"><i class="fa fa-circle-o"></i>Bill Details</a></li>
						
						<li class="active"><a href="view_est_cash_bill.php"><i class="fa fa-circle-o"></i>Cash Bill Details</a></li>
					
					
			           
			           
					  
					</ul>
				</li>
				<?php }
						
					?>
				<?php if($_SESSION['isadmin']=="1" || $_SESSION['isadmin']=="0")
					{
						?>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-id-card"></i>
						<span>Database Backup</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="active"><a href="database_backup1.php"><i class="fa fa-circle-o"></i>Backup</a></li>
						<!--<li class="active"><a href="database_import.php"><i class="fa fa-circle-o"></i>Upload Database</a></li>-->
					</ul>
				</li>
					<?php
					}?>
					
					<?php if($_SESSION['isadmin']=="0")
					{
						?>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-id-card"></i>
						<span>Super Admin</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="active"><a href="nabl_list.php"><i class="fa fa-circle-o"></i>Nabl List</a></li>
						<li class="active"><a href="superadmin_view_bill.php"><i class="fa fa-circle-o"></i>View Bill</a></li>
					</ul>
				</li>
					<?php
					}?>
			</ul>
		</section>
	</aside>

 