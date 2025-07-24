<?php include("header.php");?>
<?php include("sidebar.php");?>
<?php include("connection.php");

		if(isset($_POST["import"]))
		{
				$filename = $_FILES["database"]["name"];
				if(file_exists(dirname(__FILE__)."/dailybackup/".$fileName)) unlink(dirname(__FILE__)."/dailybackup/".$fileName);
				move_uploaded_file($_FILES["database"]["tmp_name"],  dirname(__FILE__)."/dailybackup/" . $backup_file_name);	
				$res = mysqli_query($conn,"SHOW TABLES");

				$tables = array();

				while($row = mysqli_fetch_array($res, MYSQL_NUM)) {
					$tables[] = "$row[0]";
				}

				$length = count($tables);

				for ($i = 0; $i < $length; $i++) {
					$res = "DROP TABLE $tables[$i]";
					mysqli_query($conn,$res);
					//echo $res;
				}
				
				$restore_file  = dirname(__FILE__)."/dailybackup/".$backup_file_name;
				//echo $restore_file;exit;
				$server_name   = $lab_host;
				$username      = $lab_username;
				$password      = $lab_password;
				$database_name = $lab_db;
				

				$cmd = "mysql -h {$server_name} -u {$username} -p{$password} {$database_name} < $restore_file";
				exec($cmd);
		}
?>
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Upload Database
			</h1>
		</section>
		<section class="content">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Upload Database</h3>
					</div>
							 <form method="post" enctype="multipart/form-data">
									<div class="box-body">
										<div class="row">	
											<div class="col-lg-6">
												<div class="form-group">
												  <label for="inputEmail3" class="col-sm-3 control-label">Upload File:</label>

												  <div class="col-sm-9">
													<input type="file" class="form-control pull-right" name="database">
												  </div>
												</div>
											</div>
											
											<div class="col-lg-3">
												<div class="form-group">
													<div class="col-sm-12">
														
														<input type="submit" name="import" class="btn btn-info pull-right" value="Import" />
													</div>
												</div>
											</div>		
										</div>
									</div>	
								</form>
				</div>
			</div>
		</section>
	</div>
<?php include("footer.php");?>