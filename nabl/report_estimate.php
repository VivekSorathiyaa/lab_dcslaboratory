<?php 	
	session_start();
	include("header.php");
	include("sidebar.php");
	include("connection.php");
	if($_SESSION['name']=="")
	{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
	}
	?>
<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}
</style>
<?php
	if(isset($_GET['est_sr_no']))
	{
		$select_query = "select * from estimate_bill_total_master WHERE `est_sr_no`='$_GET[est_sr_no]'";
		$result_select = mysqli_query($conn, $select_query);
		if (mysqli_num_rows($result_select) > 0) 
		{
			$row_select = mysqli_fetch_assoc($result_select);
			$serial_no1= $row_select['sr_no'];
			$est_sr_no= $row_select['est_sr_no'];
			$job_no= $row_select['job_no'];
			$agency_id= $row_select['agency_id'];
			$agency_name= $row_select['agency_name'];
			$auth_name= $row_select['auth_name'];
			$ref_date= $row_select['ref_date'];
			$rec_date= $row_select['rec_date'];
			$inv_date= $row_select['inv_date'];
			$today_date= $row_select['today_date'];
			
			$bill_sr_manualy= $row_select['bill_sr_manualy'];
		$ag_or_auth_status= $row_select['ag_or_auth_status'];
		$name_of_work=strip_tags(html_entity_decode($row_select['name_of_work']),"<strong><em><br>");
		/*$ref_name= $row_select['ref_name'];
		$ref_id= $row_select['ref_id'];
		$city_id= $row_select['city_id'];*/
		
		$select_city = "select * from city WHERE `id`='$city_id'";
	    $result_city = mysqli_query($conn, $select_city);

			if (mysqli_num_rows($result_city) > 0) {
				$row_city = mysqli_fetch_assoc($result_city);
				$city_name= $row_city['city_name'];
			}
			$select_query1 = "select * from billmaster WHERE `sr_no`='$est_sr_no'";
			$result_select1 = mysqli_query($conn, $select_query1);
			if (mysqli_num_rows($result_select1) > 0)
			{
				$row_select1 = mysqli_fetch_assoc($result_select1);
				$name_of_work= $row_select1['name_of_work'];
				$city_id= $row_select1['city_id'];
				$ref_name= $row_select1['ref_name'];
				$ref_id= $row_select1['ref_id'];
				$material_id=$row_select1['material_id'];
				$select_city = "select * from city WHERE `id`='$city_id'";
				$result_city = mysqli_query($conn, $select_city);
				if (mysqli_num_rows($result_city) > 0)
				{
					$row_city = mysqli_fetch_assoc($result_city);
					$name_of_work= $row_select1['name_of_work'];
					$city_name= $row_city['city_name'];
				}		
			} 
		}
	}
?>
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Reports Testing
			</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Reports</h3>
						</div>
						<div class="box-body"  style="border:1px groove #ddd;">
							<form class="form" id="billing" method="post">
								<?php
									$srno2=substr($est_sr_no,7);
									$srno1=substr($est_sr_no,0,7);
								?>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">SR.No.:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" value="<?php echo $srno1;?>" id="txt_srno1" name="txt_srno1" disabled>
											</div>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="txt_srno2" name="txt_srno2" value="<?php echo $srno2;?>" disabled>
											</div>
											<label for="inputEmail3" class="col-sm-1 control-label">Job No.:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="txt_jobno" tabindex="1" name="txt_jobno" value="<?php echo $job_no;?>" disabled>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Inv. Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="2" id="invoice_date" name="invoice_date" value="<?php echo date('d/m/Y', strtotime($inv_date));?>" disabled>
												</div>
											</div>
											<label for="inputEmail3" class="col-sm-2 control-label">Rec Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="3" id="rec_date" name="rec_date" value="<?php echo date('d/m/Y', strtotime($rec_date));?>" disabled>
												</div>
											</div>
										</div>
									</div>
								</div>
								<br>								
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Reference:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" tabindex="4" id="txt_ref" name="txt_ref" value="<?php echo $ref_name;?>" disabled>
											</div>						  
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label" >Ref Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="5" id="ref_date" name="ref_date" value="<?php echo date('d/m/Y', strtotime($ref_date));?>" disabled>
												</div>
											</div>
											<label for="inputEmail3" class="col-sm-2 control-label">Date:</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="txt_date" name="txt_date" value="<?php echo date('d/m/Y', strtotime($today_date));?>" disabled>
											</div>
										</div>
									</div>
								</div>
								
								<hr style="border-top: 1px solid;">
								<?php if($_SESSION['isadmin']=="0" || $_SESSION['isadmin']=="1")
								{
									?>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Agency:</label>
											<div class="col-sm-10">
												<select class="form-control select2 col-md-7 col-xs-12" tabindex="6" style="width:250px" data-placeholder="Select a Autority" id="select_agency" name="select_agency" disabled>
													<option>Select..</option>
													<?php 
													$agency_query = "select * from agency";
													$result_agency = mysqli_query($conn, $agency_query);
													if (mysqli_num_rows($result_agency) > 0)
													{
														while($row_agency = mysqli_fetch_assoc($result_agency))
														{
													?>
															<option value="<?php echo $row_agency['id']; ?>"
																<?php if($row_agency['agency_name']==$agency_name) echo 'selected="selected"'; ?>
															>
																<?php echo $row_agency['agency_name']; ?>
															</option>
													<?php
														} 
													}
													?>
												</select>										
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Autority:</label>
											<div class="col-sm-10">
												<select class="form-control select2 col-md-7 col-xs-12" tabindex="7" style="width:250px" data-placehold="Select a Autority" id="select_auth" name="select_auth" disabled>
													<option>Select..</option>
													<?php 
													$authority_query = "select * from authority";
													$result_authority = mysqli_query($conn, $authority_query);
													if (mysqli_num_rows($result_authority) > 0)
														{
															while($row_authority = mysqli_fetch_assoc($result_authority)) 
															{
													?>
																<option value="<?php echo $row_authority['id']; ?>"
																	<?php if($row_authority['auth_name']==$auth_name) echo 'selected="selected"'; ?>
																>
																	<?php echo $row_authority['auth_name']; ?>
																</option>
													<?php
															} 
														}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label">Name of Work:</label>
											<div class="col-sm-8">
												<textarea id="txtarea_work" name="txtarea_work" tabindex="8" style="width:200px" disabled><?php echo $name_of_work;?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="row">	
									<div class="col-lg-3"></div>
									<div class="col-lg-5">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">Edit Authority:</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" tabindex="9" id="txt_edit_auth" name="txt_edit_auth" value="<?php echo $auth_name;?>" disabled>
											</div>
										</div>
									</div>
									<div class="col-lg-4"></div>
								</div>
								<br>
								<div class="row">	
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">City:</label>
											<div class="col-sm-9" id="test">
												<select class="form-control select2  col-md-7 col-xs-12" data-placeholder="Select a City" id="select_city" name="select_city" tabindex="10" disabled>
													<option>Select..</option>
													<?php 
														$sql = "select * from city ";
														$result_city = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_assoc($result_city))
														{
													?>
														<option value="<?php echo $row['id']; ?>"
															<?php if($row['city_name']==$city_name) echo 'selected="selected"'; ?>
														>
															<?php echo $row['city_name']; ?>
														</option>
													<?php
														}
													?>
												</select>
											</div>
											<div class="col-sm-1">
												<input type="button" value="+" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">Reference Id:</label>
											<div class="col-sm-8">
												<select class="form-control select2 col-md-7 col-xs-12 "data-placeholder="Select a Reference" id="select_ref" name="select_ref" tabindex="11" disabled>
													<option>Select..</option>
													<?php 
														$select_ref1 = "select * from reference WHERE `id`='$ref_id'";
														$result_ref1 = mysqli_query($conn, $select_ref1);
														$row_ref1 = mysqli_fetch_assoc($result_ref1);
														$r_name= $row_ref1['ref_name'];
														$ref_query = "select * from reference ";
														$result_ref = mysqli_query($conn, $ref_query);
														while($row_ref = mysqli_fetch_assoc($result_ref))
														{
													?>
														<option value="<?php echo $row_ref['id']; ?>"
													<?php if($row_ref['ref_name']==$r_name) echo 'selected="selected"'; ?>>
														<?php echo $row_ref['ref_name']; ?></option>
													<?php
														}
													?>
												</select>
											</div>
											<div class="col-sm-1">
												<input type="submit" value="+" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default-ref" tabindex="12">
											</div>
										</div>
									</div>
								</div>
								<?php }?>
								<hr style="border-top: 1px solid;">		
							</form>
							<!---------->
							<div class="row">	
								<div class="col-md-12">
									<div class="nav-tabs-custom">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#metal" data-toggle="tab">Metal</a></li>
											<li><a href="#other" data-toggle="tab">Other</a></li>
										</ul>
										<div class="tab-content">
											<div class="active tab-pane" id="metal">
												<form class="form-horizontal" method="post">
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_25_90_hb.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_hb_25_90_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_25_90_hb" name="btn_metal_25_90_hb" style="width:150px"><b>METAL 25-90 HB MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_45_90_hb.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_45_90_hb_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_45_90_hb" name="btn_metal_45_90_hb" style="width:150px"><b>METAL 45-90 HB MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_40_63_hb.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_40_63_hb_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'"; 
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_40_63_hb" name="btn_metal_40_63_hb" style="width:150px"><b>METAL 40-63 HB MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_40_hb.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_40_hb_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_40_hb" name="btn_metal_40_hb" style="width:150px"><b>HB METAL 40 MM</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_53_26_5.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_53_26_5_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_53_26_5" name="btn_metal_53_26_5" style="width:150px"><b>METAL 53-26.5 MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_53_5_9_5.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_53_5_9_5_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_53_5_9_5" name="btn_metal_53_5_9_5" style="width:150px"><b>METAL 53.5-9.5 MM</b></a>
															
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_40.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_40_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_40" name="btn_metal_40" style="width:150px"><b>METAL 40 MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_45_90.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_45_90_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_45_90" name="btn_metal_45_90" style="width:150px"><b>METAL 45-90 MM</b></a>
																
														</div>
														<div class="col-sm-2">
														<a href="<?php echo $base_url; ?>metal_45_63.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_45_63_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_45_63" name="btn_metal_45_63" style="width:150px"><b>METAL 45-63 MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_40_63.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_40_63_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_40_63" name="btn_metal_40_63" style="width:150px"><b>METAL 40-63 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
																<a href="<?php echo $base_url; ?>metal_40_50.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_40_50_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_40_50" name="btn_metal_40_50" style="width:150px"><b>METAL 40-50 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_26_5_13_2.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_26_5_13_2_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_26_5_13_2" name="btn_metal_26_5_13_2" style="width:150px"><b>METAL 26.5-13.2 MM</b></a>
																											
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_26_5_4_75.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_26_5_4_75_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_26_5_4_75" name="btn_metal_26_5_4_75" style="width:150px"><b>METAL 26.5-4.75 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_25_50.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_25_50_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_25_50" name="btn_metal_25_50" style="width:150px"><b>METAL 25-50 MM</b></a>
														
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_25_40.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_25_40_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_25_40" name="btn_metal_25_40" style="width:150px"><b>METAL 25-40 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_25.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_25_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_25" name="btn_metal_25" style="width:150px"><b>METAL 25 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_22_4_53.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_22_4_53_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_22_4_53" name="btn_metal_22_4_53" style="width:150px"><b>METAL 22.4-53 MM</b></a>
														
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_22_4_45.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_22_4_45_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_22_4_45" name="btn_metal_22_4_45" style="width:150px"><b>METAL 22.4-45 MM</b></a>
														
															
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
																<a href="<?php echo $base_url; ?>metal_22_4_2_36.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_22_4_2_36_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_22_4_2_36" name="btn_metal_22_4_2_36" style="width:150px"><b>METAL 22.4-2.36 MM</b></a>
														
														
															
														</div>
														<div class="col-sm-2">
																<a href="<?php echo $base_url; ?>metal_20_40.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_20_40_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_20_40" name="btn_metal_20_40" style="width:150px"><b>METAL 20-40 MM</b></a>																				
														</div>
														<div class="col-sm-2">
																<a href="<?php echo $base_url; ?>metal_20_25.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_20_25_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_20_25" name="btn_metal_20_25" style="width:150px"><b>METAL 20-25 MM</b></a>
																													
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_20.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_20_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_20" name="btn_metal_20" style="width:150px"><b>METAL 20 MM</b></a>
														
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_19_26_5.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_19_26_5_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_19_26_5" name="btn_metal_19_26_5" style="width:150px"><b>METAL 19-26.5 MM</b></a>
														
																														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_19_20_26_50.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_19_20_26_50_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_19_20_26_50" name="btn_metal_19_20_26_50" style="width:150px"><b>METAL 19.20-26.50 MM</b></a>
														
															
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_13_2_19_2.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_13_2_19_2_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>   class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_13_2_19_20" name="btn_metal_13_2_19_20" style="width:150px"><b>METAL 13.2-19.20 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_13_2_19.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_13_2_19_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_13_2_19" name="btn_metal_13_2_19" style="width:150px"><b>METAL 13.2-19 MM</b></a>
														
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_13_2_9_50.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_13_2_9_50_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_13_2_9_50" name="btn_metal_13_2_9_50" style="width:150px"><b>METAL 13.2-9.50 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_13_2_5_6.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_13_2_5_6_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_13_2_5_6" name="btn_metal_13_2_5_6" style="width:150px"><b>METAL 13.2-5.6 MM</b></a>
														
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_13_2.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_13_2_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_13_2" name="btn_metal_13_2" style="width:150px"><b>METAL 13.2 MM</b></a>
														
															
															
														</div>
														<div class="col-sm-2">
														
															<a href="<?php echo $base_url; ?>metal_12_20.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_12_20_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_12_20" name="btn_metal_12_20" style="width:150px"><b>METAL 12-20 MM</b></a>
															
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
														
															<a href="<?php echo $base_url; ?>metal_11_2.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_11_2_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_11_2" name="btn_metal_11_2" style="width:150px"><b>METAL 11.2 MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_11_20_5_6.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_11_20_5_6_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_11_20_5_6" name="btn_metal_11_20_5_6" style="width:150px"><b>METAL 11.20-5.6 MM</b></a>
														
														
														</div>
												
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_11_2_13_2.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_11_2_13_2_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_11_2_13_2" name="btn_metal_11_2_13_2" style="width:150px"><b>METAL 11.2-13.2 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_11_2_22_4.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_11_2_22_4_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_11_2_22_4" name="btn_metal_11_2_22_4" style="width:150px"><b>METAL 11.2-22.4 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_10_20.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_10_20_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_10_20" name="btn_metal_10_20" style="width:150px"><b>METAL 10-20 MM</b></a>
														
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_10_12.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_10_12_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_10_12" name="btn_metal_10_12" style="width:150px"><b>METAL 10-12 MM</b></a>
														
															
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_10_4_75.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_10_4_75_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_10_4_75" name="btn_metal_10_4_75" style="width:150px"><b>METAL 10-4.75 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_10.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_10_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_10" name="btn_metal_10" style="width:150px"><b>METAL 10 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_9_50_4_75.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_9_50_4_75_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_9_50_4_75" name="btn_metal_9_50_4_75" style="width:150px"><b>METAL 9.50-4.75 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_9_50_2_36.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_9_50_2_36_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>   class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_9_50_2_36" name="btn_metal_9_50_2_36" style="width:150px"><b>METAL 9.50-2.36 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_6_10.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_6_10_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_6_10" name="btn_metal_6_10" style="width:150px"><b>METAL 6-10 MM</b></a>
														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_6.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_6_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_6" name="btn_metal_6" style="width:150px"><b>METAL 6 MM GRIT</b></a>
														
															
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_4_75_43_20.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_4_75_43_20_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_4_75_43_20" name="btn_metal_4_75_43_20" style="width:150px"><b>METAL 4.75-43.20 MM</b></a>
														
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_4_75_13_2.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_4_75_13_2_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_4_75_13_2" name="btn_metal_4_75_13_2" style="width:150px"><b>METAL 4.75-13.2 MM</b></a>														
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_4_75_10.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_4_75_10_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_4_75_10" name="btn_metal_4_75_10" style="width:150px"><b>METAL 4.75-10 MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_4_75_9_5.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_4_75_9_5_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_4_75_9_5" name="btn_metal_4_75_9_5" style="width:150px"><b>METAL 4.75-9.5 MM</b></a>
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_4_75_2_36.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_4_75_2_36_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_4_75_2_36" name="btn_metal_4_75_2_36" style="width:150px"><b>METAL 4.75-2.36 MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_4_75.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_4_75_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_4_75" name="btn_metal_4_75" style="width:150px"><b>METAL 4.75 MM</b></a>
															
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_2_80_5_60.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_2_80_5_60_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_2_80_5_60" name="btn_metal_2_80_5_60" style="width:150px"><b>METAL 2.80-5.60 MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_2_8_0_075.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_2_8_0_075_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_2_8_0_075" name="btn_metal_2_8_0_075" style="width:150px"><b>METAL 2.8-0.075 MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_2_8.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_2_8_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_2_8" name="btn_metal_2_8" style="width:150px"><b>METAL 2.8 MM</b></a>
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_2_36_4_75.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_2_36_4_75_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_2_36_4_75" name="btn_metal_2_36_4_75" style="width:150px"><b>METAL 2.36-4.75 MM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_1_18_2_36.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_1_18_2_36_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_1_18_2_36" name="btn_metal_1_18_2_36" style="width:150px"><b>METAL 1.18-2.36 MM</b></a>
														
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_0_075_2_36.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_0_075_2_36_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_0_075_2_36" name="btn_metal_0_075_2_36" style="width:150px"><b>METAL 0.075-2.36 MM</b></a>
															
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_0_075_1_18.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_0_075_1_18_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_0_075_1_18" name="btn_metal_0_075_1_18" style="width:150px"><b>METAL 0.075-1.18 MM</b></a>
													
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_75_300mic.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_75_300mic WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_75_300mic" name="btn_metal_75_300mic" style="width:150px"><b>METAL 75-300 Mic</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_300mic_1_18.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_300mic_1_18_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_300mic_1_18" name="btn_metal_300mic_1_18" style="width:150px"><b>METAL 300(mic)-1.18</b></a>
															
														</div>
														<div class="col-sm-2">
														<a href="<?php echo $base_url; ?>stone_dust.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_stone_dust WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_stone_dust" name="btn_stone_dust" style="width:150px"><b>StoneDust</b></a>
															
														</div>
														<div class="col-sm-2">
														<a href="<?php echo $base_url; ?>stone_dust_2_36.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_stone_dust_2_36_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_stone_dust_2_36" name="btn_stone_dust_2_36" style="width:150px"><b>StoneDust 2.36 MM</b></a>
															
														</div>
														<div class="col-sm-2">
														<a href="<?php echo $base_url; ?>metal_all.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_all WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_all" name="btn_metal_all" style="width:150px"><b>Metal</b></a>
															
														</div>
														
													</div>
													
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_sdbc.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_sdbc WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_sdbc" name="btn_metal_sdbc" style="width:150px"><b>S.D.B.C</b></a>
													
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_25_mm_carpet.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_25_mm_carpet WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_25_mm_carpet" name="btn_metal_25_mm_carpet" style="width:150px"><b>Metal 25 MM CARPET</b></a>
														</div>
														<div class="col-sm-2">
														<a href="<?php echo $base_url; ?>metal_busg.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_busg WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_all" name="btn_metal_all" style="width:150px"><b>B.U.S.G</b></a>
															
														</div>
														<div class="col-sm-2">
														<a href="<?php echo $base_url; ?>metal_sealcoat.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_sealcoat WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_sealcoat" name="btn_metal_sealcoat" style="width:150px"><b>SEAL COAT</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_dbm.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_dbm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_dbm" name="btn_metal_dbm" style="width:150px"><b>DBM</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_bc.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_bc WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_bc" name="btn_metal_bc" style="width:150px"><b>BC</b></a>
															
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_bm_2.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_bm_2 WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_bm_2" name="btn_metal_bm_2" style="width:150px"><b>BM - 2</b></a>
													
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_bsg.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_bsg WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_bsg" name="btn_metal_bsg" style="width:150px"><b>BSG</b></a>
													
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_20_25_bm_mm.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_20_25_bm_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_20_25_bm_mm" name="btn_metal_20_25_bm_mm" style="width:150px"><b>BM 20-25 MM</b></a>
													
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_wbm.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_wbm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_wbm" name="btn_metal_wbm" style="width:150px"><b>WBM</b></a>
													
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_mss.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_mss WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_mss" name="btn_metal_mss" style="width:150px"><b>MSS</b></a>
													
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>metal_bm.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_bm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_bm" name="btn_metal_bm" style="width:150px"><b>BM</b></a>
													
														</div>
														
													</div>
													<div class="form-group">
														<div class="col-sm-2">
													
															<a href="<?php echo $base_url; ?>metal_wmm.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_wmm_mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_wmm" name="btn_metal_wmm" style="width:150px"><b>WMM</b></a>
									
														</div>
														<div class="col-sm-2">
													
															<a href="<?php echo $base_url; ?>metal_wmm_2.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from metal_wmm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_metal_wmm_2" name="btn_metal_wmm_2" style="width:150px"><b>WMM 2</b></a>
									
														</div>
														
													</div>
												</form>
											</div>
											<!-- /.tab-pane -->
											<div class="tab-pane" id="other">
												<form class="form-horizontal" method="post">
													<div class="form-group">
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>specific_report.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from ceramic_tiles WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_ceramic_tiles" name="btn_ceramic_tiles" style="width:150px"><b>CERAMIC TILES</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>glazed_tiles.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from glazed_tiles WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?> class="btn btn-info pull-right" <?php   }  ?> id="btn_glazed_tiles" name="btn_glazed_tiles" style="width:150px"><b>GLAZED TILES</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>vitrified_tiles.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from vitrified_tiles WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>   class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_vitrified_tiles" name="btn_vitrified_tiles" style="width:150px"><b>VITRIFIED TILES</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>steel_angle.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from steelAngel WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_steel_angle" name="btn_steel_angle" style="width:150px"><b>STEEL ANGLE</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>hysdSteel.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from hysdSteel WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_hysdSteel" name="btn_hysdSteel" style="width:150px"><b>HYSD STEEL</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>mild_steel.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from mildSteel WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_mild_steel" name="btn_mild_steel" style="width:150px"><b>MILD STEEL</b></a>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>tmt_steel.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from tmtSteel WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_tmt_steel" name="btn_tmt_steel" style="width:150px"><b>TMT STEEL</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>aluminium.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from aluminium WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_aluminium" name="btn_aluminium" style="width:150px"><b>ALUMINIUM</b></a>
														</div>
														
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>bella.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from bella WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_bella" name="btn_bella" style="width:150px"><b>BELLA</b></a>
															
														</div>
														<div class="col-sm-2">
														<a href="<?php echo $base_url; ?>brick.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from brick WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_brick" name="btn_brick" style="width:150px"><b>BRICK</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>c_c_block.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from c_c_block WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_c_c_block" name="btn_c_c_block" style="width:150px"><b>C.C. Block</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>cc_cube.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from cc_cube WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_cc_cube" name="btn_cc_cube" style="width:150px"><b>C.C. CUBE</b></a>
															
														</div>
													</div>
													<div class="form-group">
																								
														
														<div class="col-sm-2">															
															<a href="<?php echo $base_url; ?>cement.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from cement WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right" 
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_cement" name="btn_cement" style="width:150px"><b>CEMENT</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>cement_pipe.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from cement_pipe WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_cement_pipe" name="btn_cement_pipe" style="width:150px"><b>Cement Pipe</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>cpwd_water.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from cpwd_Water WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_cpwd_water" name="btn_cpwd_water" style="width:150px"><b>CPWD WATER</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>tiles.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from tiles WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_hard_rock" name="btn_hard_rock" style="width:150px"><b>CPWD TILES</b></a>
														</div>
														<div class="col-sm-2">	
															<a href="<?php echo $base_url; ?>emulsion_asphalt.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from emulsion_asphalt WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_estimate" name="btn_estimate" style="width:150px"><b>EMULSION ASPHALT</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>gsb.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from gsb WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_gsb" name="btn_gsb" style="width:150px"><b>GSB</b></a>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>murrum.php?id=<?php echo $_GET['est_sr_no'];?>"  <?php  
															
															$select_query_rp_1 = "select * from murrum WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?>  id="btn_murrum" name="btn_murrum" style="width:150px"><b>MURRUM</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>kota.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from kota WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_kota" name="btn_kota" style="width:150px"><b>KOTA</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>Pipe.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from pipe WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_pipe" name="btn_pipe" style="width:150px"><b>PIPE</b></a>
														</div>
													<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>pvc_water_stop.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from pvc_water_stop WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_pvc_water_stop" name="btn_pvc_water_stop" style="width:150px"><b>PVC WATER STOP</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>quarry_spall.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from quarry_spall WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="quarry_spall" name="quarry_spall" style="width:150px"><b>QUARRY SPALL</b></a>
														</div>
														<div class="col-sm-2">
												
															<a href="<?php echo $base_url; ?>quarry_waste.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from quarry_waste WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_query_waste" name="btn_query_waste" style="width:150px"><b>QUARRY WASTE</b></a>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>hard_rock.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from hard_rock WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right" 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_hard_rock" name="btn_hard_rock" style="width:150px"><b>Rock</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>rubble.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from rubble_tiles WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_rubble" name="btn_rubble" style="width:150px"><b>RUBBLE</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>sand.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from sand WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_sand" name="btn_sand" style="width:150px"><b>SAND</b></a>
															
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>soil.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from soil WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_soil" name="btn_soil" style="width:150px"><b>SOIL</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>Water.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from water WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?>  class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_water" name="btn_water" style="width:150px"><b>WATER</b></a>
														</div>
														<div class="col-sm-2">		
															<a href="<?php echo $base_url; ?>Wood.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from wood WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_wood" name="btn_wood" style="width:150px"><b>WOOD</b></a>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>asphalt.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from asphalt WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_asphalt" name="btn_asphalt" style="width:150px"><b>ASPHALT</b></a>
														</div>
														<div class="col-sm-2">	
															<a href="<?php echo $base_url; ?>paver_block.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from paver_block WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_paver_block" name="btn_paver_block" style="width:150px"><b>PAVER BLOCK</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>acc_block.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from acc_block WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_aac_block" name="btn_aac_block" style="width:150px"><b>AAC BLOCK</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>crs_steel.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from crsSteel WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_crs_block" name="btn_crs_block" style="width:150px"><b>CRS BLOCK</b></a>
														</div>
														<div class="col-sm-2">
													
															<a href="<?php echo $base_url; ?>mix_design.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from mix_design WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_mix_design" name="btn_mix_design" style="width:150px"><b>MIX DESIGN</b></a>
									
														</div>
														<div class="col-sm-2">		
															<a href="<?php echo $base_url; ?>wooden.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from wooden WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_wood" name="btn_wood" style="width:150px"><b>WOODEN</b></a>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-2">		
															<a href="<?php echo $base_url; ?>sal_wood.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from sal_wood WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_wood" name="btn_wood" style="width:150px"><b>SAL WOODEN</b></a>
														</div>
														<div class="col-sm-2">		
															<a href="<?php echo $base_url; ?>ucr_stone.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from ucr_stone WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_wood" name="btn_wood" style="width:150px"><b>UCR STONE</b></a>
														</div>
														<div class="col-sm-2">		
															<a href="<?php echo $base_url; ?>np2_pipes.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from np2_pipes WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right" 
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_wood" name="btn_wood" style="width:150px"><b>N.P.2 PIPES</b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>water_proofing_3mm.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from water_proofing_3mm WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_crs_block" name="btn_crs_block" style="width:150px"><b>WATER PROOFING 3 MM </b></a>
														</div>
														<div class="col-sm-2">
															<a href="<?php echo $base_url; ?>minral_water.php?id=<?php echo $_GET['est_sr_no'];?>" <?php  
															
															$select_query_rp_1 = "select * from minral_water WHERE `bill_id`='$_GET[est_sr_no]' AND `is_deleted`='0'";
															$result_select_rp_1 = mysqli_query($conn, $select_query_rp_1);
															if (mysqli_num_rows($result_select_rp_1) > 0) {
															 ?> class="btn btn-danger pull-right"
															<?php }	
															
															else{
															
															?>class="btn btn-info pull-right" <?php   }  ?> id="btn_crs_block" name="btn_crs_block" style="width:150px"><b>MINRAL WATER</b></a>
														</div>
													</div>
													<!--<div class="form-group">
														
													</div>-->
												</form>
											</div>
											<!-- /.tab-pane -->
										</div>
										<!-- /.tab-content -->
									</div>
									<!-- /.nav-tabs-custom -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Add New City</h4>
					</div>
					<form id="form_city" name="form_city" method="post">
						<div class="modal-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Add City:</label>
								<div class="col-sm-10">
									<input type="text" placeholder="Enter New City" id="txt_new_city" name="txt_new_city" class="form-control">											
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="btn_add_city" name="btn_add_city" data-dismiss="modal">Add City</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</section>	
<?php include("footer.php");?>
<script>
 //Date picker
   $('#invoice_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	$('#ref_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	$('#rec_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	$('#dateofpay').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	
	
	
  $(function () {
    $('.select2').select2()
  })

</script>
<script>
$("#btn_add_city").click(function(){

 var txt_new_city = $('#txt_new_city').val(); 
 var postData = '&txt_new_city='+txt_new_city;


  $.ajax({
    url : "<?php echo $base_url; ?>Form_Data.php",
    type: "POST",
    data : postData,
    success: function(data,status,  xhr)
	 {
		
		$("#select_city").html(data);
	   
	 }

}); 

});

$("#btn_add_ref").click(function(){

  
 var txt_new_ref = $('#txt_new_ref').val(); 
 var postData = '&txt_new_ref='+txt_new_ref;
 
	  $.ajax({
		url : "<?php echo $base_url; ?>Ref_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			
			$("#select_ref").html(data);
		   
		 }

	}); 
});
</script>
