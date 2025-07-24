
<?php 
session_start();
include("header.php");
include("sidebar.php");
include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
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

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Billing
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Billing Form</h3>
					</div>
					<div class="box-body"  style="border:1px groove #ddd;">
					<form class="form" id="billing" method="post">
						
							<div class="row">
								
								<div class="col-lg-6">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">SR.No.:</label>
										
									  <div class="col-sm-3">
										<input type="text" class="form-control" value="<?php echo $srno1;?>" id="txt_srno1" name="txt_srno1" >
									  </div>
									  <div class="col-sm-3">
										<input type="text" class="form-control" id="txt_srno2" name="txt_srno2" value="<?php echo $srno2;?>">
									  </div>
									  
										 <label for="inputEmail3" class="col-sm-1 control-label">Job No.:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="txt_jobno" tabindex="1" name="txt_jobno" value="<?php echo $job_no;?>">
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
													<input type="text" class="form-control pull-right" tabindex="2" id="invoice_date" name="invoice_date" value="<?php echo date('d/m/Y', strtotime($inv_date));?>">
												</div>
										  </div>
										  <label for="inputEmail3" class="col-sm-2 control-label">Rec Date:</label>
										  <div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="3" id="rec_date" name="rec_date" value="<?php echo date('d/m/Y', strtotime($rec_date));?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Reference:</label>
										  <div class="col-sm-10">
											<input type="text" class="form-control" tabindex="4" id="txt_ref" name="txt_ref" value="<?php echo $ref_name;?>">
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
													<input type="text" class="form-control pull-right" tabindex="5" id="ref_date" name="ref_date" value="<?php echo date('d/m/Y', strtotime($ref_date));?>">
												</div>
											</div>
										
										  <label for="inputEmail3" class="col-sm-2 control-label">Date:</label>
										  <div class="col-sm-4">
											<input type="text" class="form-control" id="txt_date" name="txt_date" value="<?php echo date('d/m/Y', strtotime($today_date));?>">
										  </div>
										</div>
									</div>
								</div>
								<hr style="border-top: 1px solid;">
								<div class="row">	
								
									<div class="col-lg-4">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Agency:</label>
											
											<div class="col-sm-10">
										
												<select class="form-control select2 col-md-7 col-xs-12" tabindex="6" style="width:250px" data-placeholder="Select a Autority" id="select_agency" name="select_agency">
													<option>Select..</option>
													<?php 
													$agency_query = "select * from agency";
												
													$result_agency = mysqli_query($conn, $agency_query);

													if (mysqli_num_rows($result_agency) > 0) {
														while($row_agency = mysqli_fetch_assoc($result_agency)) {
													
													?>
													
													<option value="<?php echo $row_agency['id']; ?>"
													<?php if($row_agency['agency_name']==$agency_name) echo 'selected="selected"'; ?>
													>
														<?php echo $row_agency['agency_name']; ?></option>
													<?php
													} 
													}?>
												</select>
												
										
																						
											</div>
										 
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Autority:</label>
											
											<div class="col-sm-10">
										
												<select class="form-control select2 col-md-7 col-xs-12" tabindex="7" style="width:250px" data-placehold="Select a Autority" id="select_auth" name="select_auth">
													<option>Select..</option>
													<?php 
													$authority_query = "select * from authority";
												
													$result_authority = mysqli_query($conn, $authority_query);

													if (mysqli_num_rows($result_authority) > 0) {
														while($row_authority = mysqli_fetch_assoc($result_authority)) {
													
													?>
														<option value="<?php echo $row_authority['id']; ?>"
													<?php if($row_authority['auth_name']==$auth_name) echo 'selected="selected"'; ?>
													>
														<?php echo $row_authority['auth_name']; ?></option>
													<?php
													} 
													}?>
												</select>
											
											</div>
										 
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-4 control-label">Name of Work:</label>
											
										  <div class="col-sm-8">
											<textarea id="txtarea_work" name="txtarea_work" tabindex="8" style="width:200px"><?php echo $name_of_work;?></textarea>
												
										  </div>
										 
										</div>
									</div>
								</div>
								
								<div class="row">	
									<div class="col-lg-3">
									</div>
									<div class="col-lg-5">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-3 control-label">Edit Authority:</label>
										  
										  <div class="col-sm-9">
											<input type="text" class="form-control" tabindex="9" id="txt_edit_auth" name="txt_edit_auth" value="<?php echo $auth_name;?>">
										  </div>
										</div>
									</div>
									<div class="col-lg-4">
									</div>
								</div>
								<br>
								<div class="row">	
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">City:</label>
											
											<div class="col-sm-9" id="test">
												<select class="form-control select2  col-md-7 col-xs-12" data-placeholder="Select a City" id="select_city" name="select_city" tabindex="10">
												<option>Select..</option>
												<?php 
														$sql = "select * from city ";
														
													
														$result_city = mysqli_query($conn, $sql);

															while($row = mysqli_fetch_assoc($result_city)) {
														
														?>
														<option value="<?php echo $row['id']; ?>"
													<?php if($row['city_name']==$city_name) echo 'selected="selected"'; ?>
													>
														<?php echo $row['city_name']; ?></option>
													<?php
													
													}?>
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
											
											<select class="form-control select2 col-md-7 col-xs-12 "data-placeholder="Select a Reference" id="select_ref" name="select_ref" tabindex="11">
													
													<option>Select..</option>
													<?php 
													
													$select_ref1 = "select * from reference WHERE `id`='$ref_id'";
													$result_ref1 = mysqli_query($conn, $select_ref1);
										

										
														$row_ref1 = mysqli_fetch_assoc($result_ref1);
														$r_name= $row_ref1['ref_name'];
													
				
													
														$ref_query = "select * from reference ";
													
														$result_ref = mysqli_query($conn, $ref_query);

															while($row_ref = mysqli_fetch_assoc($result_ref)) {
														
														?>
														<option value="<?php echo $row_ref['id']; ?>"
													<?php if($row_ref['ref_name']==$r_name) echo 'selected="selected"'; ?>>
														<?php echo $row_ref['ref_name']; ?></option>
													<?php
													
													}?>
												</select>
													
										  </div>
										 <div class="col-sm-1">
												<input type="submit" value="+" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default-ref" tabindex="12">

										
										</div>
										 
										</div>
									</div>
								</div>
								
							<hr style="border-top: 1px solid;">		
					</form>
							<!---------->
					<div class="row">	
						<div class="col-md-12">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#metal" data-toggle="tab">Metal</a></li>
            
									<li>
										<a href="#other" data-toggle="tab">Other</a></li>
								</ul>
								<div class="tab-content">
										  
									<div class="active tab-pane" id="metal">
										<form class="form-horizontal" method="post">
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 25-90 HB MM</b></button>
												</div>
												
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 45-90 HB MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 40-63 HB MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 40 HB MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 53-26.5 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 53.5-9.5 MM</b></button>
												</div>
											</div>
											<div class="form-group">
												
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 40 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 45-90 MM</b></button>
												</div>
											
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 45-63 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 40-63 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 40-50 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 26.5-13.2 MM</b></button>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 26.5-4.75 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 25-50 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 25-40 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 25 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 22.4-53 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 22.4-45 MM</b></button>
												</div>
												
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 22.4-2.36 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 20-40 MM</b></button>
												</div>
										
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 20-25 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 20 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 19-26.5 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 19.2-26.5 MM</b></button>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 13.2-19.20 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 13.2-19 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 13.2-9.50 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 13.2-5.6 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 13.2 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 12-20 MM</b></button>
												</div>
											</div>
											<div class="form-group">
												
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 11.2 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 11.20-5.6 MM</b></button>
												</div>
										
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 11.2-13.2 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 11.2-22.4 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 10-20 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 10-12 MM</b></button>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 10-4.75 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 10 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 9.50-4.75 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL  9.5-2.36 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 6-10 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 6 MM GRIT</b></button>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 4.75-43.20 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 4.75-13.2 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 4.75-10 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 4.75-9.5 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 4.75-2.36MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 4.75 MM</b></button>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 2.80-5.60 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 2.8-0.075 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 2.8 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 2.36-4.75 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 1.18-2.36 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 0.075-2.36 MM</b></button>
												</div>
											</div>
												<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 0.075-1.18 MM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 75-300 Mic</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>METAL 300(mic)-1.18</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>Stone Dust</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>StoneDust 2.36 MM</b></button>
												</div>
												
											</div>
										</form>
									</div>
										  
										  <!-- /.tab-pane -->

									<div class="tab-pane" id="other">
										<form class="form-horizontal" method="post">
										   <div class="form-group">
												<div class="col-sm-2">
													<a href="specific_report.php?id=<?php echo $_GET['bt_id'];?>" class="btn btn-info pull-right" id="btn_ceramic_tiles" name="btn_ceramic_tiles" style="width:150px"><b>CERAMIC TILES</b></a>
												</div>
												
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>GLAZED TILES</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>MOSAIC TILES</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>VITRIFIED TILES</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>ANGEL STEEL</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>HYSD STEEL</b></button>
												</div>
											</div>
											<div class="form-group">
												
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>MILD STEEL</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>TMT STEEL</b></button>
												</div>
											
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>ALUMINIUM</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>ALPHALT</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>BELLA</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>BRICK</b></button>
												</div>
											</div>
											<div class="form-group">
												
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>C. C. BLOCK</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>C. C. CUBE (1)</b></button>
												</div>
											
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>C. C. CUBE (2)</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>C. C. CUBE (3)</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>C. C. CUBE (4)</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>CEMENT</b></button>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>CEMENT PIPE</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>CPWD WATER</b></button>
												</div>
											
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>CPWD TILES</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>EMULSION ASPHALT</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>GSB</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>MURRUM</b></button>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>KOTA</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>PIPE</b></button>
												</div>
											
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>PVC WATER STOP</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>QUARRY SPALL</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>QUARRY WASTE</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>ROCK</b></button>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>RUBBLE</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>SAND</b></button>
												</div>
											
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>SOIL</button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>WATER</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>WOOD</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>BITUMEN</b></button>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>PAVER BLOCK</b></button>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>NDT</b></button>
												</div>
											
												<div class="col-sm-2">
													<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" style="width:150px"><b>SOIL PROCTOR TEST</b></button>
												</div>
												
											</div>
										</form>
									</div>
										  <!-- /.tab-pane -->
								</div>
            <!-- /.tab-content -->
							</div>
          <!-- /.nav-tabs-custom -->
						</div>
							
					</div>
							
							<!---------->
					<div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
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
    url : "Form_Data.php",
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
		url : "Ref_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			
			$("#select_ref").html(data);
		   
		 }

	}); 
});
</script>
