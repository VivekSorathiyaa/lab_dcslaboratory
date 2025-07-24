<?php 
include("header.php");
include("connection.php");
error_reporting(0);
session_start(); 

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
.visually-hidden {
    position: absolute;
    left: -100vw;
    
    /* Note, you may want to position the checkbox over top the label and set the opacity to zero instead. It can be better for accessibilty on some touch devices for discoverability. */
}
</style>
<?php

	// GET DATA FROM URL VAIBHAV
		if(isset($_GET['report_no'])){
			$report_no=$_GET['report_no'];
			
		}
		if(isset($_GET['trf_no'])){
			$trf_no=$_GET['trf_no'];
			
		}
		if(isset($_GET['job_no'])){
			$job_no=$_GET['job_no'];
			$job_no_main=$_GET['job_no'];
			
		}
		if(isset($_GET['lab_no'])){
			$lab_no=$_GET['lab_no'];
			$aa	=$_GET['lab_no'];
			
		}if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
		}

		$jobQuery = "SELECT * FROM `job` WHERE `trf_no`='$trf_no' AND `job_number`='$job_no'";
		$resQuery = mysqli_query($conn, $jobQuery);
		$rowQuery = mysqli_fetch_array($resQuery);
		$sample_rec_date = $rowQuery['sample_rec_date'];


		$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
		$result_select4 = mysqli_query($conn, $select_query4);

		if (mysqli_num_rows($result_select4) > 0) {
			$row_select4 = mysqli_fetch_assoc($result_select4);
			$tank_no= $row_select4['tanker_no'];
			$lot_no= $row_select4['lot_no'];
			$bitumin_grade= $row_select4['bitumin_grade'];
			$bitumin_make= $row_select4['bitumin_make'];
		}
		
		
?>
	<!-- STYLE PUT VAIBHAV-->
	<div class="content-wrapper" style="margin-left:0px !important;">
	<!-- Content Header (Page header) -->
		<section class="content">
		<!-- MENU INCLUDE VAIBHAV-->
		<?php include("menu.php") ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h2  style="text-align:center;">HOLLOW & SOLID CONCRETE BLOCK</h2>
						</div>
						<!--<div class="box-default">-->
						<form class="form" id="Glazed" method="post">
							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">
							<Br>
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control" id="report_no" value="<?php echo $report_no;?>" name="report_no" ReadOnly >
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>-->
										<div class="col-sm-10">											
											<input type="hidden" class="form-control" tabindex="1"  value="<?php echo $job_no;?>" id="job_no" name="job_no" ReadOnly>
										</div>
									</div>												
								</div>
							</div>
							<!-- </div> -->
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
									 <div class="col-sm-2">
													<label for="chk_auto">Job No. :</label>
													<input type="checkbox" class="visually-hidden" name="chk_auto"  id="chk_auto" value="chk_auto">
												</div>
										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no;?>" name="lab_no" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
										<div class="form-group">
										 <div class="col-sm-4">
													<label>Amend Date. :</label>
												</div>								 
										  <div class="col-sm-8">
											<input type="text" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
										  </div>
										</div>
									</div>
								<div class="col-lg-3">
									<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">Bitumin Grade.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="bitumin_grade" value="<?php echo $bitumin_grade;?>" name="bitumin_grade" ReadOnly>
										</div>
									</div>
								</div>
							</div>
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Tanker No.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="tank_no" value="<?php echo $tank_no;?>" name="tank_no">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">Lot No.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="lot_no" value="<?php echo $lot_no;?>" name="lot_no">
										</div>
									</div>
								</div>
							</div>
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Bitumin Make:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="bitumin_make" value="<?php echo $bitumin_make;?>" name="bitumin_make">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" readonly>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="idEdit" id="idEdit"/>

											</div>
										<div class="col-sm-2">
											<!-- SAVE BUTTON LOGIC VAIBHAV-->
											<?php   
												$querys_job1 = "SELECT * FROM solid_block WHERE `is_deleted`='0' and lab_no='$lab_no'";
												$qrys_jobno = mysqli_query($conn,$querys_job1);
												$rows=mysqli_num_rows($qrys_jobno);
												if($rows < 1){ ?>
													<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
													<?php }													
														?>
										</div>
										<div class="col-sm-2">
											<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>
										</div>
										<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
										<?php
										/*$val =  $_SESSION['isadmin'];
										if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {*/
										?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_solid_cocrete.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
										
										<?php //} ?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_solid_cocrete.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
											
										</div>
									</div>
								</div>
							</div>
							<hr>
							<br>	
							<div class="panel-group" id="accordion">
							 <?php 
  $is_upload = "select * from span_material_assign WHERE `trf_no`='$trf_no' and `job_number`='$job_no'and isdeleted='0'"; 
  
  $result_upload = mysqli_query($conn, $is_upload);
	if(mysqli_num_rows($result_upload)>0){ ?>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse_file">
						<h4 class="panel-title">
							<b>FILE UPLOAD</b>
						</h4>
					</a>
				</h4>
			</div>
			<div id="collapse_file" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-sm-4">
									<div class="col-sm-2">
									<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no;?>&&reports_nos=<?php echo $report_no;?>">Row Data</a>
								</div>
								<div class="col-sm-4">
									<label for="inputEmail3" class="col-sm-12 control-label">Upload Excel :</label>
								</div>
								<div class="col-sm-4">
									<input type="file" class="form-control" id="upload_excel" name="upload_excel" >
								</div>
								<div class="col-sm-4">
									<button type="button" class="btn btn-info pull-right" id="btn_upload_excel" name="btn_upload_excel" tabindex="14" >Upload</button>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div id="view_excel_from_table">
									<table border="1px solid black" align="center" width="100%">
										<tr>
											<th>Download</th>
											<th>Action</th>
										</tr>
								<?php
									$query_file = "select * from excel_upload_from_report WHERE lab_no='$lab_no' and job_no='$job_no_main' and report_no='$report_no'";
									$result_file = mysqli_query($conn, $query_file);
									if (mysqli_num_rows($result_file) > 0)
									{
										while($r_file = mysqli_fetch_array($result_file))
										{
										?>
										<tr>
											<td><a href="<?php echo $base_url.$r_file['excel_sheet'];?>" download><?php echo $r_file['excel_sheet'];?></a></td>
											<td><a href="javascript:void(0);" class="delete_excels" data-id="<?php echo $r_file['id'];?>">Delete</a></td>
										</tr>
									<?php		
										}
									}
									?>
									</table>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<br>
		</div>	
		<?php }	 ?>	  	

							<?php
					$test_check;
					$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
						$result_select1 = mysqli_query($conn, $select_query1);
						while($r1 = mysqli_fetch_array($result_select1)){
							
							if($r1['test_code']=="com")
							{
								
								$test_check.="com,";
			?>
						<div class="panel panel-default" id="com">
					<div class="panel-heading" id="txtcom">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_com">
								<h4 class="panel-title">
								<b>COMPRESSIVE STRENGTH</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_com" class="panel-collapse collapse">
						<div class="panel-body">
							<br>
							<div class="row">									
								<div class="col-lg-6">
									<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_com">1.</label>
												<input type="checkbox" class="visually-hidden" name="chk_com"  id="chk_com" value="chk_com"><br>
											</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">COMPRESSIVE STRENGTH</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Sr No.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Identified As</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Length (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Width (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Area (mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Load (KN)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Compressive Strength (N/mm<sup>2</sup>)</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">1</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='i1' name='i1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='length1' name='length1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='width1' name='width1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='area1' name='area1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='load1' name='load1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='str1' name='str1' disabled>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">2.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='i2' name='i2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='length2' name='length2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='width2' name='width2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='area2' name='area2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='load2' name='load2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='str2' name='str2' disabled>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">3.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='i3' name='i3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='length3' name='length3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='width3' name='width3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='area3' name='area3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='load3' name='load3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='str3' name='str3' disabled>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">4.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='i4' name='i4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='length4' name='length4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='width4' name='width4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='area4' name='area4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='load4' name='load4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='str4' name='str4' disabled>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">5.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='i5' name='i5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='length5' name='length5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='width5' name='width5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='area5' name='area5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='load5' name='load5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='str5' name='str5' disabled>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">6.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='i6' name='i6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='length6' name='length6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='width6' name='width6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='area6' name='area6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='load6' name='load6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='str6' name='str6' disabled>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">7.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='i7' name='i7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='length7' name='length7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='width7' name='width7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='area7' name='area7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='load7' name='load7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='str7' name='str7' disabled>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">8.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='i8' name='i8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='length8' name='length8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='width8' name='width8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='area8' name='area8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='load8' name='load8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='str8' name='str8' disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-right">Average:</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_str' name='avg_str'>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			<?php }
				
			else if($r1['test_code']=="SHR")
			{ $test_check.="SHR,";?>
		
			<div class="panel panel-default" id="shr">
					<div class="panel-heading" id="txtshr">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_shr">
								<h4 class="panel-title">
								<b>DRYING SHRINKAGE & MOISTURE MOVEMENT</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_shr" class="panel-collapse collapse">
						<div class="panel-body">
							<br>
							<div class="row">									
								<div class="col-lg-6">
									<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_shr">2.</label>
												<input type="checkbox" class="visually-hidden" name="chk_shr"  id="chk_shr" value="chk_shr"><br>
											</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">DRYING SHRINKAGE & MOISTURE MOVEMENT</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Sr No.</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading 1</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading 2</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading 3</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading 4</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading 5</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading 6</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Dry Shrinkage</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Average of Two Face</label>
									</div>
								</div>
								
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading 1</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Average of Two Face</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Date</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r1_date' name='r1_date' value="<?php echo date('d/m/Y',strtotime($sample_rec_date)); ?>">
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r2_date' name='r2_date' value="<?php echo date('d/m/Y',strtotime($sample_rec_date."+2 Day")); ?>">
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r3_date' name='r3_date' value="<?php echo date('d/m/Y',strtotime($sample_rec_date."+4 Day")); ?>">
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r4_date' name='r4_date' value="<?php echo date('d/m/Y',strtotime($sample_rec_date."+6 Day")); ?>">
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r5_date' name='r5_date' value="<?php echo date('d/m/Y',strtotime($sample_rec_date."+8 Day")); ?>">
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r6_date' name='r6_date' value="<?php echo date('d/m/Y',strtotime($sample_rec_date."+10 Day")); ?>">
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center"></label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center"></label>
									</div>
								</div>
								
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r7_date' name='r7_date' value="<?php echo date('d/m/Y',strtotime($sample_rec_date."+14 Day")); ?>">
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center"></label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Face 1</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r1_1' name='r1_1'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r2_1' name='r2_1'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r3_1' name='r3_1'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r4_1' name='r4_1'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r5_1' name='r5_1'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r6_1' name='r6_1'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry1' name='dry1'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='age1_1' name='age1_1'>
									</div>
								</div>
								
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r7_1' name='r7_1'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='age2_1' name='age2_1'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Face 2</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r1_2' name='r1_2'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r2_2' name='r2_2'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r3_2' name='r3_2'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r4_2' name='r4_2'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r5_2' name='r5_2'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r6_2' name='r6_2'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry2' name='dry2'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										
									</div>
								</div>
								
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r7_2' name='r7_2'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Face 1</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r1_3' name='r1_3'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r2_3' name='r2_3'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r3_3' name='r3_3'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r4_3' name='r4_3'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r5_3' name='r5_3'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r6_3' name='r6_3'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry3' name='dry3'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='age1_2' name='age1_2'>
									</div>
								</div>
								
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r7_3' name='r7_3'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='age2_2' name='age2_2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Face 2</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r1_4' name='r1_4'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r2_4' name='r2_4'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r3_4' name='r3_4'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r4_4' name='r4_4'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r5_4' name='r5_4'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r6_4' name='r6_4'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry4' name='dry4'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										
									</div>
								</div>
								
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r7_4' name='r7_4'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Face 1</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r1_5' name='r1_5'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r2_5' name='r2_5'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r3_5' name='r3_5'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r4_5' name='r4_5'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r5_5' name='r5_5'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r6_5' name='r6_5'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry5' name='dry5'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='age1_3' name='age1_3'>
									</div>
								</div>
								
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r7_5' name='r7_5'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='age2_3' name='age2_3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Face 2</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r1_6' name='r1_6'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r2_6' name='r2_6'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r3_6' name='r3_6'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r4_6' name='r4_6'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r5_6' name='r5_6'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r6_6' name='r6_6'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry6' name='dry6'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										
									</div>
								</div>
								
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='r7_6' name='r7_6'>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-7">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-right">Average Drying Shrinkage %</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_dry' name='avg_dry'>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-right">Average Moiture Movement %</label>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_mo' name='avg_mo'>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
				
			<?php }
				
			else if($r1['test_code']=="DIM")
			{ $test_check.="DIM,";?>				
							
				<div class="panel panel-default" id="dim">
					<div class="panel-heading" id="txtdim">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_dim">
								<h4 class="panel-title">
								<b>DIMENTION</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_dim" class="panel-collapse collapse">
						<div class="panel-body">
							<br>
							<div class="row">									
								<div class="col-lg-6">
									<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_dim">3.</label>
											<input type="checkbox" class="visually-hidden" name="chk_dim"  id="chk_dim" value="chk_dim"><br>
										</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">DIMENTION</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">Sr No</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">Length (mm)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">Width (mm)</label>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">Height (mm)</label>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">1.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l1' name='l1'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w1' name='w1'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h1' name='h1'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">2.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l2' name='l2'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w2' name='w2'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h2' name='h2'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">3.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l3' name='l3'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w3' name='w3'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h3' name='h3'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">4.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l4' name='l4'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w4' name='w4'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h4' name='h4'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">5.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l5' name='l5'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w5' name='w5'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h5' name='h5'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">6.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l6' name='l6'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w6' name='w6'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h6' name='h6'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">7.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l7' name='l7'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w7' name='w7'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h7' name='h7'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">8.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l8' name='l8'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w8' name='w8'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h8' name='h8'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">9.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l9' name='l9'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w9' name='w9'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h9' name='h9'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">10.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l10' name='l10'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w10' name='w10'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h10' name='h10'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">11.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l11' name='l11'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w11' name='w11'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h11' name='h11'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">12.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l12' name='l12'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w12' name='w12'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h12' name='h12'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">13.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l13' name='l13'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w13' name='w13'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h13' name='h13'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">14.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l14' name='l14'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w14' name='w14'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h14' name='h14'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">15.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l15' name='l15'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w15' name='w15'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h15' name='h15'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">16.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l16' name='l16'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w16' name='w16'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h16' name='h16'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">17.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l17' name='l17'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w17' name='w17'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h17' name='h17'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">18.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l18' name='l18'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w18' name='w18'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h18' name='h18'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">19.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l19' name='l19'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w19' name='w19'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h19' name='h19'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">20.</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='l20' name='l20'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='w20' name='w20'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='h20' name='h20'>
										</div>
									</div>	
																	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">Average</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='avg_length' name='avg_length'>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='avg_width' name='avg_width'>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id='avg_height' name='avg_height'>
										</div>
									</div>	
																	
								</div>
							</div>
							
							
						</div>
							
						
						</div>
				  
				
		
					</div>	
			<?php }
				
			else if($r1['test_code']=="WTR")
			{ $test_check.="WTR,";?>
				
			<div class="panel panel-default" id="wtr">
		<div class="panel-heading" id="txtwtr">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_wtr">
					<h4 class="panel-title">
					<b>WATER ABSORPTION</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse_wtr" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_wtr">4.</label>
													<input type="checkbox" class="visually-hidden" name="chk_wtr"  id="chk_wtr" value="chk_wtr"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">WATER ABSORPTION</label>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">SR No</label>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">Initial Weight (gm)</label>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">SSD Weight (gm)</label>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">Water Absorption (%)</label>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">1.</label>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='wa_1_1' name='wa_1_1'>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='wa_2_1' name='wa_2_1'>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='wtr1' name='wtr1'>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">2.</label>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='wa_1_2' name='wa_1_2'>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='wa_2_2' name='wa_2_2'>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='wtr2' name='wtr2'>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-center">3.</label>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='wa_1_3' name='wa_1_3'>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='wa_2_3' name='wa_2_3'>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='wtr3' name='wtr3'>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-right">Average</label>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id='avg_wtr' name='avg_wtr'>
										</div>
									</div>
								</div>
								
						</div>
				  </div>
	</div>
				
			<?php }
				
			else if($r1['test_code']=="DEN")
			{ $test_check.="DEN,";?>
				
				<div class="panel panel-default" id="den">
						<div class="panel-heading" id="txtden">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse_den">
									<h4 class="panel-title">
									<b>DRY DENSITY</b>
									</h4>
								</a>
							</h4>
						</div>
						<div id="collapse_den" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-lg-6">
									<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_den">5.</label>
												<input type="checkbox" class="visually-hidden" name="chk_den"  id="chk_den" value="chk_den"><br>
											</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">DRY DENSITY</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Sr. No.</label>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Length (mm)</label>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Width (mm)</label>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Height (mm)</label>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Volume (m<sup>3</sup>)</label>
									</div>	
								</div>
								<!--<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Initial Weight (gm)</label>
									</div>	
								</div>-->
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">SSD Weight (gm)</label>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Dry Density (kg/m<sup>3</sup>)</label>
									</div>	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1.</label>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dl1' name='dl1'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dw1' name='dw1'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dh1' name='dh1'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='vol1' name='vol1'>
									</div>	
								</div>
								<!--<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='iwet1' name='iwet1'>
									</div>	
								</div>-->
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fwet1' name='fwet1'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den1' name='den1'>
									</div>	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2.</label>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dl2' name='dl2'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dw2' name='dw2'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dh2' name='dh2'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='vol2' name='vol2'>
									</div>	
								</div>
								<!--<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='iwet2' name='iwet2'>
									</div>	
								</div>-->
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fwet2' name='fwet2'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den2' name='den2'>
									</div>	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">3.</label>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dl3' name='dl3'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dw3' name='dw3'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dh3' name='dh3'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='vol3' name='vol3'>
									</div>	
								</div>
								<!--<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='iwet3' name='iwet3'>
									</div>	
								</div>-->
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fwet3' name='fwet3'>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den3' name='den3'>
									</div>	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-right">Average:</label>
									</div>	
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_den' name='avg_den'>
									</div>	
								</div>
							</div>
									
						</div>
					</div>
				</div>
			
				
			<?php }
				
			else if($r1['test_code']=="kin")
			{ $test_check.="kin,";?>
				
				<div class="panel panel-default" id="kin">
						<div class="panel-heading" id="txtkin">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse32">
									<h4 class="panel-title">
									<b>KINEMATIC VISCOSITY</b>
									</h4>
								</a>
							</h4>
						</div>
						<div id="collapse32" class="panel-collapse collapse">
										<div class="panel-body">
												<div class="row">									
												
													<div class="col-lg-6">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_kin">6.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_kin"  id="chk_kin" value="chk_kin"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">KINEMATIC VISCOSITY</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															
														</div>
													</div>
													
												</div>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Sr. No.</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Description</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Sample 1</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Sample 2</label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">1.</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Specific Test Temprature <sup>0</sup>C </label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_1_1" name="kin_1_1" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_2_1" name="kin_2_1" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">2.</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Size of the Vescometer</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_1_2" name="kin_1_2" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_2_2" name="kin_2_2" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">3.</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Vescometer Constant</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_1_3" name="kin_1_3" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_2_3" name="kin_2_3" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">4.</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Actual Test Temprature</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_1_4" name="kin_1_4" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_2_4" name="kin_2_4" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">5.</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Run in Second</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_1_5" name="kin_1_5" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_2_5" name="kin_2_5" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">6.</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">VISCOSITY in cst (s no 2 x s.no 4)</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_1_6" name="kin_1_6" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="kin_2_6" name="kin_2_6" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">6.</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Average Vescosity</label>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<input type="text" class="form-control" id="avg_kin" name="avg_kin" >
											</div>
										</div>
									</div>
										
									
										</div>
								  </div>
					</div>
			
			<?php	}else if($r1['test_code']=="strip")
			{ $test_check.="strip,";?>
				
				<div class="panel panel-default" id="strip">
						<div class="panel-heading" id="txtstrip">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse_strip">
									<h4 class="panel-title">
									<b>STRIPING VALUE</b>
									</h4>
								</a>
							</h4>
						</div>
						<div id="collapse_strip" class="panel-collapse collapse">
										<div class="panel-body">
												<div class="row">									
												
													<div class="col-lg-6">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_strip">7.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_strip"  id="chk_strip" value="chk_strip"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">STRIPING VALUE</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															
														</div>
													</div>
													
												</div>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Strip of area in %</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Nos</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Strip of area in %</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Nos</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Strip of area in %</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Nos</label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">1</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">2</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">3</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">4</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">5</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">6</label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">100%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_1_1" name="nos_1_1" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">100%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_2_1" name="nos_2_1" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">100%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_3_1" name="nos_3_1" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">90%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_1_2" name="nos_1_2" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">90%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_2_2" name="nos_2_2" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">90%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_3_2" name="nos_3_2" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">80%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_1_3" name="nos_1_3" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">80%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_2_3" name="nos_2_3" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">80%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_3_3" name="nos_3_3" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">70%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_1_4" name="nos_1_4" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">70%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_2_4" name="nos_2_4" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">70%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_3_4" name="nos_3_4" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">60%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_1_5" name="nos_1_5" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">60%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_2_5" name="nos_2_5" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">60%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_3_5" name="nos_3_5" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">50%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_1_6" name="nos_1_6" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">50%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_2_6" name="nos_2_6" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">50%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_3_6" name="nos_3_6" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">40%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_1_7" name="nos_1_7" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">40%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_2_7" name="nos_2_7" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">40%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_3_7" name="nos_3_7" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">30%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_1_8" name="nos_1_8" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">30%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_2_8" name="nos_2_8" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">30%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_3_8" name="nos_3_8" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Less Than 25%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_1_9" name="nos_1_9" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Less Than 25%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_2_9" name="nos_2_9" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Less Than 25%</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_3_9" name="nos_3_9" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Total</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_total_1" name="nos_total_1" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Total</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_total_2" name="nos_total_2" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Total</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="nos_total_3" name="nos_total_3" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">SV=</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="ans_1" name="ans_1" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">SV=</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="ans_2" name="ans_2" ></label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">SV =</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="ans_3" name="ans_3" ></label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Average = </label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label"><input type="text" class="form-control" id="avg_strip" name="avg_strip" ></label>
											</div>
										</div>
										
									</div>
									
									
										</div>
								  </div>
					</div>
			
			<?php	}else if($r1['test_code']=="tri")
			{ $test_check.="tri,";?>
				
				<div class="panel panel-default" id="tri">
						<div class="panel-heading" id="txttri">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse_tri">
									<h4 class="panel-title">
									<b>SOLUBILITY IN TRICHLOREOTHYLENE</b>
									</h4>
								</a>
							</h4>
						</div>
						<div id="collapse_tri" class="panel-collapse collapse">
										<div class="panel-body">
												<div class="row">									
												
													<div class="col-lg-6">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_tri">8.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_tri"  id="chk_tri" value="chk_tri"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">SOLUBILITY IN TRICHLOREOTHYLENE</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															
														</div>
													</div>
													
												</div>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Sr No</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Description</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">I</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">II</label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">1</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight of g of dry sample taken for the test (W1)</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_1_1" name="tri_1_1" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_1_2" name="tri_1_2" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">2</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight in g of Gooch crucible before test (W3)</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_2_1" name="tri_2_1" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_2_2" name="tri_2_2" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">3</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight in g of Gooch crucible after test (W4)</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_3_1" name="tri_3_1" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_3_2" name="tri_3_2" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">4</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Matter soluble in trichloroethylene in gram (W2)=(W4-W3)</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_4_1" name="tri_4_1" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_4_2" name="tri_4_2" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">5</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Matter soluble in trichloroethylene in Percentage (W1 - W2)/W1 x 100</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_5_1" name="tri_5_1" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="tri_5_2" name="tri_5_2" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">6</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="avg_tri" name="avg_tri" >
											</div>
										</div>
									</div>
									
									
										</div>
								  </div>
					</div>
			
			<?php	}else if($r1['test_code']=="fla")
			{ $test_check.="fla,";?>
				
				<div class="panel panel-default" id="fla">
						<div class="panel-heading" id="txtfla">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse_fla">
									<h4 class="panel-title">
									<b>FLASH & FIRE POINT</b>
									</h4>
								</a>
							</h4>
						</div>
						<div id="collapse_fla" class="panel-collapse collapse">
										<div class="panel-body">
												<div class="row">									
												
													<div class="col-lg-6">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_fla">9.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_fla"  id="chk_fla" value="chk_fla"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">FLASH & FIRE POINT</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															
														</div>
													</div>
													
												</div>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Time , Minutes</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Temprature <sup>o</sup>C</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Time , Minutes</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Temprature <sup>o</sup>C</label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">0</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem1" name="atem1" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">0</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem1" name="btem1" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">1</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem2" name="atem2" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">1</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem2" name="btem2" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">2</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem3" name="atem3" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">2</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem3" name="btem3" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">3</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem4" name="atem4" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">3</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem4" name="btem4" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">4</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem5" name="atem5" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">4</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem5" name="btem5" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">5</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem6" name="atem6" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">5</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem6" name="btem6" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">6</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem7" name="atem7" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">6</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem7" name="btem7" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">7</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem8" name="atem8" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">7</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem8" name="btem8" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">8</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem89" name="atem9" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">8</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem9" name="btem9" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">9</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem10" name="atem10" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">9</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem10" name="btem10" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">10</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="atem11" name="atem11" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">10</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="btem11" name="btem11" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Property</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Sample No 1</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Sample No 2</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Sample No 3</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Temprature (<sup>o</sup>C)at Which Sample Flash Point</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="samp_1_1" name="samp_1_1" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="samp_2_1" name="samp_2_1" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="samp_3_1" name="samp_3_1" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="avg_sam_1" name="avg_sam_1" >
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Temprature (<sup>o</sup>C)at Which Sample Fire Point</label>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="samp_1_2" name="samp_1_2" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="samp_2_2" name="samp_2_2" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="samp_3_2" name="samp_3_2" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="text" class="form-control" id="avg_sam_2" name="avg_sam_2" >
											</div>
										</div>
									</div>
									
									
									
										</div>
								  </div>
					</div>
			
			<?php	}else if($r1['test_code']=="los")
			{ $test_check.="los,";?>
				
			<div class="panel panel-default" id="los">
		<div class="panel-heading" id="txtlos">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse36">
					<h4 class="panel-title">
					<b>LOSS ON HEATING</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse36" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									<div class="col-lg-6">
										<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_los">9.</label>
													<input type="checkbox" class="visually-hidden" name="chk_los"  id="chk_los" value="chk_los"><br>
											</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">LOSS ON HEATING</label>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Description</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Sample - 1</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Sample - 2</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Average</label>
									</div>
									</div>
										
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight of Sample + Container (gm)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <input type="text" class="form-control" id="los_w1_1" name="los_w1_1" >
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <input type="text" class="form-control" id="los_w1_2" name="los_w1_2" >
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <input type="text" class="form-control" id="avg_los" name="avg_los" >
									</div>
									</div>
										
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight of Sample + Container (gm) after 5 hour oven dry</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <input type="text" class="form-control" id="los_w2_1" name="los_w2_1" >
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <input type="text" class="form-control" id="los_w2_2" name="los_w2_2" >
									</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">% of loss on Heating</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <input type="text" class="form-control" id="los_1" name="los_1" >
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <input type="text" class="form-control" id="los_2" name="los_2" >
									</div>
									</div>
								</div>
								
						</div>
				  </div>
	</div>
			
				
	<?php }
		}?>					
							</div>
							
							<hr>
							<div id="display_data">	
		<div class="row">
					<div class="col-lg-12">
						<table border="1px solid black" align="center" width="100%" id="aaaa">
							<tr>
								<th style="text-align:center;" width="10%"><label>Actions</label></th>
								<!--<th style="text-align:center;"><label>Report No.</label></th>-->	
								<th style="text-align:center;"><label>Lab No.</label></th>	
								<th style="text-align:center;"><label>Job No.</label></th>	
								
																		

							</tr>
								<?php
							 $query = "select * from solid_block WHERE lab_no='$aa'  and `is_deleted`='0'";

								$result = mysqli_query($conn, $query);
			

								if (mysqli_num_rows($result) > 0) {
							while($r = mysqli_fetch_array($result)){
					
										if($r['is_deleted'] == 0){
										?>
										<tr>
										<td style="text-align:center;" width="10%">	
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
										<?php
											//$val =  $_SESSION['isadmin'];
											//if($val == 0 || $val == 5){
											?>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
										<?php
											//}
										?>
										</td>
										<!--<td style="text-align:center;"><?php //echo $r['report_no'];?></td>-->
										<td style="text-align:center;"><?php echo $r['job_no'];?></td>
										<td style="text-align:center;"><?php echo $r['lab_no'];?></td>					
										</tr>
										<?php
										}
									}
								}
							?>
							
						</table>
					</div>
				</div>
			
			<hr>
		</div>
		
			<!-- TEST LIST FILD VAIBHAV-->
		<input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ',');?>">
							
							
							
							
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php include("footer.php");?>
	<script>
		$('.amend_date').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd'
		});
	 $(function () {
    $('.select2').select2();
  });
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();
	

// $('#i1').val('1/8');
// $('#i2').val('2/8');
// $('#i3').val('3/8');
// $('#i4').val('4/8');
// $('#i5').val('5/8');
// $('#i6').val('6/8');
// $('#i7').val('7/8');
// $('#i8').val('8/8');



function com_auto()
{
	$('#txtcom').css("background-color","var(--success)");
	var avg_str = randomNumberFromRange(6.00,12.00);
	$('#avg_str').val((+avg_str).toFixed(2));
	var avg_str = $('#avg_str').val();
		

	if((+randomNumberFromRange(1,9).toFixed())%2==0){
		var str1 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str2 = (+avg_str) - (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str3 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str4 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str5 = (+avg_str) - ((+str3) - (+avg_str));
		var str6 = (+avg_str) - ((+str4) - (+avg_str));
		var str7 = (+avg_str) + ((+avg_str) - (+str2));
		var str8 = (+avg_str) - ((+str1) - (+avg_str));

	}else{
		var str1 = (+avg_str) - (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str2 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str3 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str4 = (+avg_str) - (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str5 = (+avg_str) + ((+avg_str) - (+str4));
		var str6 = (+avg_str) - ((+str3) - (+avg_str));
		var str7 = (+avg_str) - ((+str2) - (+avg_str));
		var str8 = (+avg_str) + ((+avg_str) - (+str1));
	}

	$('#str1').val((+str1).toFixed(2));
	$('#str2').val((+str2).toFixed(2));
	$('#str3').val((+str3).toFixed(2));
	$('#str4').val((+str4).toFixed(2));
	$('#str5').val((+str5).toFixed(2));
	$('#str6').val((+str6).toFixed(2));
	$('#str7').val((+str7).toFixed(2));
	$('#str8').val((+str8).toFixed(2));

	$('#i1').val('1/8');
	$('#i2').val('2/8');
	$('#i3').val('3/8');
	$('#i4').val('4/8');
	$('#i5').val('5/8');
	$('#i6').val('6/8');
	$('#i7').val('7/8');
	$('#i8').val('8/8');
	
	var str1 = $('#str1').val();
	var str2 = $('#str2').val();
	var str3 = $('#str3').val();
	var str4 = $('#str4').val();
	var str5 = $('#str5').val();
	var str6 = $('#str6').val();
	var str7 = $('#str7').val();
	var str8 = $('#str8').val();
	
	var avg_str = ((+str1) + (+str2) + (+str3) + (+str4) + (+str5) + (+str6) + (+str7) + (+str8)) / 8;
	$('#avg_str').val((+avg_str).toFixed(2));
	
	var com_length = randomNumberFromRange(397.00,403.00).toFixed(2);
	var com_width = randomNumberFromRange(198.00,202.00).toFixed(2);
	if(($('#l1').val()) == "" || ($('#l1').val()) == "undefined"){
		var length1 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length2 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length3 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length4 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length5 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length6 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length7 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length8 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));

		var width1 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width2 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width3 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width4 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width5 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width6 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width7 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width8 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
	}else{
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var length1 = $('#l1').val();
			var length2 = $('#l2').val();
			var length3 = $('#l3').val();
			var length4 = $('#l4').val();
			var length5 = $('#l5').val();
			var length6 = $('#l6').val();
			var length7 = $('#l7').val();
			var length8 = $('#l8').val();

			var width1 = $('#w1').val();
			var width2 = $('#w2').val();
			var width3 = $('#w3').val();
			var width4 = $('#w4').val();
			var width5 = $('#w5').val();
			var width6 = $('#w6').val();
			var width7 = $('#w7').val();
			var width8 = $('#w8').val();
		}else{
			var length1 = $('#l13').val();
			var length2 = $('#l14').val();
			var length3 = $('#l15').val();
			var length4 = $('#l16').val();
			var length5 = $('#l17').val();
			var length6 = $('#l18').val();
			var length7 = $('#l19').val();
			var length8 = $('#l20').val();

			var width1 = $('#w13').val();
			var width2 = $('#w14').val();
			var width3 = $('#w15').val();
			var width4 = $('#w16').val();
			var width5 = $('#w17').val();
			var width6 = $('#w18').val();
			var width7 = $('#w19').val();
			var width8 = $('#w20').val();
		}
	}


	$('#length1').val((+length1).toFixed(2));
	$('#length2').val((+length2).toFixed(2));
	$('#length3').val((+length3).toFixed(2));
	$('#length4').val((+length4).toFixed(2));
	$('#length5').val((+length5).toFixed(2));
	$('#length6').val((+length6).toFixed(2));
	$('#length7').val((+length7).toFixed(2));
	$('#length8').val((+length8).toFixed(2));

	$('#width1').val((+width1).toFixed(2));
	$('#width2').val((+width2).toFixed(2));
	$('#width3').val((+width3).toFixed(2));
	$('#width4').val((+width4).toFixed(2));
	$('#width5').val((+width5).toFixed(2));
	$('#width6').val((+width6).toFixed(2));
	$('#width7').val((+width7).toFixed(2));
	$('#width8').val((+width8).toFixed(2));

	var length1 = $('#length1').val();
	var length2 = $('#length2').val();
	var length3 = $('#length3').val();
	var length4 = $('#length4').val();
	var length5 = $('#length5').val();
	var length6 = $('#length6').val();
	var length7 = $('#length7').val();
	var length8 = $('#length8').val();

	var width1 = $('#width1').val();
	var width2 = $('#width2').val();
	var width3 = $('#width3').val();
	var width4 = $('#width4').val();
	var width5 = $('#width5').val();
	var width6 = $('#width6').val();
	var width7 = $('#width7').val();
	var width8 = $('#width8').val();
	
	var area1 = (+length1) * (+width1);
	var area2 = (+length2) * (+width2);
	var area3 = (+length3) * (+width3);
	var area4 = (+length4) * (+width4);
	var area5 = (+length5) * (+width5);
	var area6 = (+length6) * (+width6);
	var area7 = (+length7) * (+width7);
	var area8 = (+length8) * (+width8);
	
	$('#area1').val((+area1).toFixed(1));
	$('#area2').val((+area2).toFixed(1));
	$('#area3').val((+area3).toFixed(1));
	$('#area4').val((+area4).toFixed(1));
	$('#area5').val((+area5).toFixed(1));
	$('#area6').val((+area6).toFixed(1));
	$('#area7').val((+area7).toFixed(1));
	$('#area8').val((+area8).toFixed(1));

	var area1 = $('#area1').val();
	var area2 = $('#area2').val();
	var area3 = $('#area3').val();
	var area4 = $('#area4').val();
	var area5 = $('#area5').val();
	var area6 = $('#area6').val();
	var area7 = $('#area7').val();
	var area8 = $('#area8').val();

	var str1 = $('#str1').val();
	var str2 = $('#str2').val();
	var str3 = $('#str3').val();
	var str4 = $('#str4').val();
	var str5 = $('#str5').val();
	var str6 = $('#str6').val();
	var str7 = $('#str7').val();
	var str8 = $('#str8').val();

	var load1 = ((+area1) * (+str1)) / 1000;
	var load2 = ((+area2) * (+str2)) / 1000;
	var load3 = ((+area3) * (+str3)) / 1000;
	var load4 = ((+area4) * (+str4)) / 1000;
	var load5 = ((+area5) * (+str5)) / 1000;
	var load6 = ((+area6) * (+str6)) / 1000;
	var load7 = ((+area7) * (+str7)) / 1000;
	var load8 = ((+area8) * (+str8)) / 1000;

	$('#load1').val((+load1).toFixed(1));
	$('#load2').val((+load2).toFixed(1));
	$('#load3').val((+load3).toFixed(1));
	$('#load4').val((+load4).toFixed(1));
	$('#load5').val((+load5).toFixed(1));
	$('#load6').val((+load6).toFixed(1));
	$('#load7').val((+load7).toFixed(1));
	$('#load8').val((+load8).toFixed(1));
	
}

$('#chk_com').change(function(){
    if(this.checked)
	{
		com_auto();
	}
	else
	{
		$('#txtcom').css("background-color","white");	
		$('#i1').val(null);
		$('#i2').val(null);
		$('#i3').val(null);
		$('#i4').val(null);
		$('#i5').val(null);
		$('#i6').val(null);
		$('#i7').val(null);
		$('#i8').val(null);
		$('#length1').val(null);
		$('#length2').val(null);
		$('#length3').val(null);
		$('#length4').val(null);
		$('#length5').val(null);
		$('#length6').val(null);
		$('#length7').val(null);
		$('#length8').val(null);
		$('#width1').val(null);
		$('#width2').val(null);
		$('#width3').val(null);
		$('#width4').val(null);
		$('#width5').val(null);
		$('#width6').val(null);
		$('#width7').val(null);
		$('#width8').val(null);
		$('#area1').val(null);
		$('#area2').val(null);
		$('#area3').val(null);
		$('#area4').val(null);
		$('#area5').val(null);
		$('#area6').val(null);
		$('#area7').val(null);
		$('#area8').val(null);
		$('#load1').val(null);
		$('#load2').val(null);
		$('#load3').val(null);
		$('#load4').val(null);
		$('#load5').val(null);
		$('#load6').val(null);
		$('#load7').val(null);
		$('#load8').val(null);
		$('#str1').val(null);
		$('#str2').val(null);
		$('#str3').val(null);
		$('#str4').val(null);
		$('#str5').val(null);
		$('#str6').val(null);
		$('#str7').val(null);
		$('#str8').val(null);
		$('#avg_str').val(null);
		
	}
});


$('#avg_str').change(function(){
	$('#txtcom').css("background-color","var(--success)");
	
	var avg_str = $('#avg_str').val();
	if((+randomNumberFromRange(1,9).toFixed())%2==0){
		var str1 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str2 = (+avg_str) - (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str3 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str4 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str5 = (+avg_str) - ((+str3) - (+avg_str));
		var str6 = (+avg_str) - ((+str4) - (+avg_str));
		var str7 = (+avg_str) + ((+avg_str) - (+str2));
		var str8 = (+avg_str) - ((+str1) - (+avg_str));

	}else{
		var str1 = (+avg_str) - (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str2 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str3 = (+avg_str) + (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str4 = (+avg_str) - (+randomNumberFromRange(0.30,0.80).toFixed(2));
		var str5 = (+avg_str) + ((+avg_str) - (+str1));
		var str6 = (+avg_str) - ((+str2) - (+avg_str));
		var str7 = (+avg_str) - ((+str3) - (+avg_str));
		var str8 = (+avg_str) + ((+avg_str) - (+str4));
	}

	$('#str1').val((+str1).toFixed(2));
	$('#str2').val((+str2).toFixed(2));
	$('#str3').val((+str3).toFixed(2));
	$('#str4').val((+str4).toFixed(2));
	$('#str5').val((+str5).toFixed(2));
	$('#str6').val((+str6).toFixed(2));
	$('#str7').val((+str7).toFixed(2));
	$('#str8').val((+str8).toFixed(2));
	
	var str1 = $('#str1').val();
	var str2 = $('#str2').val();
	var str3 = $('#str3').val();
	var str4 = $('#str4').val();
	var str5 = $('#str5').val();
	var str6 = $('#str6').val();
	var str7 = $('#str7').val();
	var str8 = $('#str8').val();

	$('#i1').val('1/8');
	$('#i2').val('2/8');
	$('#i3').val('3/8');
	$('#i4').val('4/8');
	$('#i5').val('5/8');
	$('#i6').val('6/8');
	$('#i7').val('7/8');
	$('#i8').val('8/8');	

	
	var com_length = randomNumberFromRange(397.00,403.00).toFixed(2);
	var com_width = randomNumberFromRange(198.00,202.00).toFixed(2);
	if(($('#l1').val()) == "" || ($('#l1').val()) == "undefined"){
		var length1 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length2 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length3 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length4 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length5 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length6 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length7 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var length8 = (+com_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));

		var width1 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width2 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width3 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width4 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width5 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width6 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width7 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var width8 = (+com_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
	}else{
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var length1 = $('#l1').val();
			var length2 = $('#l2').val();
			var length3 = $('#l3').val();
			var length4 = $('#l4').val();
			var length5 = $('#l5').val();
			var length6 = $('#l6').val();
			var length7 = $('#l7').val();
			var length8 = $('#l8').val();

			var width1 = $('#w1').val();
			var width2 = $('#w2').val();
			var width3 = $('#w3').val();
			var width4 = $('#w4').val();
			var width5 = $('#w5').val();
			var width6 = $('#w6').val();
			var width7 = $('#w7').val();
			var width8 = $('#w8').val();
		}else{
			var length1 = $('#l13').val();
			var length2 = $('#l14').val();
			var length3 = $('#l15').val();
			var length4 = $('#l16').val();
			var length5 = $('#l17').val();
			var length6 = $('#l18').val();
			var length7 = $('#l19').val();
			var length8 = $('#l20').val();

			var width1 = $('#w13').val();
			var width2 = $('#w14').val();
			var width3 = $('#w15').val();
			var width4 = $('#w16').val();
			var width5 = $('#w17').val();
			var width6 = $('#w18').val();
			var width7 = $('#w19').val();
			var width8 = $('#w20').val();
		}
	}

	

	$('#length1').val((+length1).toFixed(2));
	$('#length2').val((+length2).toFixed(2));
	$('#length3').val((+length3).toFixed(2));
	$('#length4').val((+length4).toFixed(2));
	$('#length5').val((+length5).toFixed(2));
	$('#length6').val((+length6).toFixed(2));
	$('#length7').val((+length7).toFixed(2));
	$('#length8').val((+length8).toFixed(2));

	$('#width1').val((+width1).toFixed(2));
	$('#width2').val((+width2).toFixed(2));
	$('#width3').val((+width3).toFixed(2));
	$('#width4').val((+width4).toFixed(2));
	$('#width5').val((+width5).toFixed(2));
	$('#width6').val((+width6).toFixed(2));
	$('#width7').val((+width7).toFixed(2));
	$('#width8').val((+width8).toFixed(2));

	var length1 = $('#length1').val();
	var length2 = $('#length2').val();
	var length3 = $('#length3').val();
	var length4 = $('#length4').val();
	var length5 = $('#length5').val();
	var length6 = $('#length6').val();
	var length7 = $('#length7').val();
	var length8 = $('#length8').val();

	var width1 = $('#width1').val();
	var width2 = $('#width2').val();
	var width3 = $('#width3').val();
	var width4 = $('#width4').val();
	var width5 = $('#width5').val();
	var width6 = $('#width6').val();
	var width7 = $('#width7').val();
	var width8 = $('#width8').val();
	
	var area1 = (+length1) * (+width1);
	var area2 = (+length2) * (+width2);
	var area3 = (+length3) * (+width3);
	var area4 = (+length4) * (+width4);
	var area5 = (+length5) * (+width5);
	var area6 = (+length6) * (+width6);
	var area7 = (+length7) * (+width7);
	var area8 = (+length8) * (+width8);
	
	$('#area1').val((+area1).toFixed(1));
	$('#area2').val((+area2).toFixed(1));
	$('#area3').val((+area3).toFixed(1));
	$('#area4').val((+area4).toFixed(1));
	$('#area5').val((+area5).toFixed(1));
	$('#area6').val((+area6).toFixed(1));
	$('#area7').val((+area7).toFixed(1));
	$('#area8').val((+area8).toFixed(1));

	var area1 = $('#area1').val();
	var area2 = $('#area2').val();
	var area3 = $('#area3').val();
	var area4 = $('#area4').val();
	var area5 = $('#area5').val();
	var area6 = $('#area6').val();
	var area7 = $('#area7').val();
	var area8 = $('#area8').val();

	var str1 = $('#str1').val();
	var str2 = $('#str2').val();
	var str3 = $('#str3').val();
	var str4 = $('#str4').val();
	var str5 = $('#str5').val();
	var str6 = $('#str6').val();
	var str7 = $('#str7').val();
	var str8 = $('#str8').val();

	var load1 = ((+area1) * (+str1)) / 1000;
	var load2 = ((+area2) * (+str2)) / 1000;
	var load3 = ((+area3) * (+str3)) / 1000;
	var load4 = ((+area4) * (+str4)) / 1000;
	var load5 = ((+area5) * (+str5)) / 1000;
	var load6 = ((+area6) * (+str6)) / 1000;
	var load7 = ((+area7) * (+str7)) / 1000;
	var load8 = ((+area8) * (+str8)) / 1000;

	$('#load1').val((+load1).toFixed(1));
	$('#load2').val((+load2).toFixed(1));
	$('#load3').val((+load3).toFixed(1));
	$('#load4').val((+load4).toFixed(1));
	$('#load5').val((+load5).toFixed(1));
	$('#load6').val((+load6).toFixed(1));
	$('#load7').val((+load7).toFixed(1));
	$('#load8').val((+load8).toFixed(1));
	
})

$('#length1, #length2,#length3, #length4, #length5, #length6, #length7, #length8, #width1, #width2, #width3, #width4, #width5, #width6, #width7, #width8, #load1, #load2, #load3, #load4, #load5, #load6, #load7, #load8').change(function(){
	$('#txtcom').css("background-color","var(--success)");
		
	var length1 = $('#length1').val();
	var length2 = $('#length2').val();
	var length3 = $('#length3').val();
	var length4 = $('#length4').val();
	var length5 = $('#length5').val();
	var length6 = $('#length6').val();
	var length7 = $('#length7').val();
	var length8 = $('#length8').val();

	var width1 = $('#width1').val();
	var width2 = $('#width2').val();
	var width3 = $('#width3').val();
	var width4 = $('#width4').val();
	var width5 = $('#width5').val();
	var width6 = $('#width6').val();
	var width7 = $('#width7').val();
	var width8 = $('#width8').val();

	var area1 = (+length1) * (+width1);
	var area2 = (+length2) * (+width2);
	var area3 = (+length3) * (+width3);
	var area4 = (+length4) * (+width4);
	var area5 = (+length5) * (+width5);
	var area6 = (+length6) * (+width6);
	var area7 = (+length7) * (+width7);
	var area8 = (+length8) * (+width8);
	
	$('#area1').val((+area1).toFixed(1));
	$('#area2').val((+area2).toFixed(1));
	$('#area3').val((+area3).toFixed(1));
	$('#area4').val((+area4).toFixed(1));
	$('#area5').val((+area5).toFixed(1));
	$('#area6').val((+area6).toFixed(1));
	$('#area7').val((+area7).toFixed(1));
	$('#area8').val((+area8).toFixed(1));

	var area1 = $('#area1').val();
	var area2 = $('#area2').val();
	var area3 = $('#area3').val();
	var area4 = $('#area4').val();
	var area5 = $('#area5').val();
	var area6 = $('#area6').val();
	var area7 = $('#area7').val();
	var area8 = $('#area8').val();

	var load1 = $('#load1').val();
	var load2 = $('#load2').val();
	var load3 = $('#load3').val();
	var load4 = $('#load4').val();
	var load5 = $('#load5').val();
	var load6 = $('#load6').val();
	var load7 = $('#load7').val();
	var load8 = $('#load8').val();

	var str1 = ((+load1) * 1000) / (+area1);
	var str2 = ((+load2) * 1000) / (+area2);
	var str3 = ((+load3) * 1000) / (+area3);
	var str4 = ((+load4) * 1000) / (+area4);
	var str5 = ((+load5) * 1000) / (+area5);
	var str6 = ((+load6) * 1000) / (+area6);
	var str7 = ((+load7) * 1000) / (+area7);
	var str8 = ((+load8) * 1000) / (+area8);
		
	$('#str1').val((+str1).toFixed(2));
	$('#str2').val((+str2).toFixed(2));
	$('#str3').val((+str3).toFixed(2));
	$('#str4').val((+str4).toFixed(2));
	$('#str5').val((+str5).toFixed(2));
	$('#str6').val((+str6).toFixed(2));
	$('#str7').val((+str7).toFixed(2));
	$('#str8').val((+str8).toFixed(2));
	
	var str1 = $('#str1').val();
	var str2 = $('#str2').val();
	var str3 = $('#str3').val();
	var str4 = $('#str4').val();
	var str5 = $('#str5').val();
	var str6 = $('#str6').val();
	var str7 = $('#str7').val();
	var str8 = $('#str8').val();
	
	var avg_str = ((+str1) + (+str2) + (+str3) + (+str4) + (+str5) + (+str6) + (+str7) + (+str8)) / 8;
	$('#avg_str').val((+avg_str).toFixed(2));

})












function shr_auto()
{
	$('#txtshr').css("background-color","var(--success)");
	$('#age1_1').val(randomNumberFromRange(0.010,0.040).toFixed(3));
	$('#age1_2').val(randomNumberFromRange(0.010,0.040).toFixed(3));
	$('#age1_3').val(randomNumberFromRange(0.010,0.040).toFixed(3));
	
	$('#age2_1').val(randomNumberFromRange(0.020,0.060).toFixed(3));
	$('#age2_2').val(randomNumberFromRange(0.020,0.060).toFixed(3));
	$('#age2_3').val(randomNumberFromRange(0.020,0.060).toFixed(3));
	
	var age1_1 = $('#age1_1').val();
	var age1_2 = $('#age1_2').val();
	var age1_3 = $('#age1_3').val();
	
	var age2_1 = $('#age2_1').val();
	var age2_2 = $('#age2_2').val();
	var age2_3 = $('#age2_3').val();
	
	var avg_dry = ((+age1_1) + (+age1_2) + (+age1_3))/3;
	$('#avg_dry').val((+avg_dry).toFixed(3));
	
	var avg_mo = ((+age2_1) + (+age2_2) + (+age2_3))/3;
	$('#avg_mo').val((+avg_mo).toFixed(3));
	
	var hh = randomNumberFromRange(1,9).toFixed();
	if(hh%2==0){
		var dry1 = (+age1_1) + 0.002
		var dry2 = (+age1_1) - 0.002
		var dry3 = (+age1_2) - 0.001
		var dry4 = (+age1_2) + 0.001
		var dry5 = (+age1_3) + 0.003
		var dry6 = (+age1_3) - 0.003

		var r7_1 = (+age2_1) + 0.001
		var r7_2 = (+age2_1) - 0.001
		var r7_3 = (+age2_2) - 0.002
		var r7_4 = (+age2_2) + 0.002
		var r7_5 = (+age2_3) + 0.001
		var r7_6 = (+age2_3) - 0.001

	}else{
		var dry1 = (+age1_1) - 0.001
		var dry2 = (+age1_1) + 0.001
		var dry3 = (+age1_2) + 0.002
		var dry4 = (+age1_2) - 0.002
		var dry5 = (+age1_3) - 0.002
		var dry6 = (+age1_3) + 0.002

		var r7_1 = (+age2_1) - 0.002
		var r7_2 = (+age2_1) + 0.002
		var r7_3 = (+age2_2) + 0.001
		var r7_4 = (+age2_2) - 0.001
		var r7_5 = (+age2_3) - 0.002
		var r7_6 = (+age2_3) + 0.002
	}
	
	$('#dry1').val((+dry1).toFixed(3));
	$('#dry2').val((+dry2).toFixed(3));
	$('#dry3').val((+dry3).toFixed(3));
	$('#dry4').val((+dry4).toFixed(3));
	$('#dry5').val((+dry5).toFixed(3));
	$('#dry6').val((+dry6).toFixed(3));
	
	$('#r7_1').val((+r7_1).toFixed(3));
	$('#r7_2').val((+r7_2).toFixed(3));
	$('#r7_3').val((+r7_3).toFixed(3));
	$('#r7_4').val((+r7_4).toFixed(3));
	$('#r7_5').val((+r7_5).toFixed(3));
	$('#r7_6').val((+r7_6).toFixed(3));

	
	var r1_set1 = randomNumberFromRange(2,12).toFixed();
	var r1_set2 = randomNumberFromRange(2,12).toFixed();
	var r1_set3 = randomNumberFromRange(2,12).toFixed();
	
	var r1_1 = (+r1_set1) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_2 = (+r1_set1) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_3 = (+r1_set2) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_4 = (+r1_set2) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_5 = (+r1_set3) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_6 = (+r1_set3) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	
	$('#r1_1').val((+r1_1).toFixed(3));
	$('#r1_2').val((+r1_2).toFixed(3));
	$('#r1_3').val((+r1_3).toFixed(3));
	$('#r1_4').val((+r1_4).toFixed(3));
	$('#r1_5').val((+r1_5).toFixed(3));
	$('#r1_6').val((+r1_6).toFixed(3));
	
	var r1_1 = $('#r1_1').val();
	var r1_2 = $('#r1_2').val();
	var r1_3 = $('#r1_3').val();
	var r1_4 = $('#r1_4').val();
	var r1_5 = $('#r1_5').val();
	var r1_6 = $('#r1_6').val();
	
	var dry1 = $('#dry1').val();
	var dry2 = $('#dry2').val();
	var dry3 = $('#dry3').val();
	var dry4 = $('#dry4').val();
	var dry5 = $('#dry5').val();
	var dry6 = $('#dry6').val();
	
	var r6_1 = (+r1_1) - (+dry1);
	var r6_2 = (+r1_2) - (+dry2);
	var r6_3 = (+r1_3) - (+dry3);
	var r6_4 = (+r1_4) - (+dry4);
	var r6_5 = (+r1_5) - (+dry5);
	var r6_6 = (+r1_6) - (+dry6);
	
	$('#r6_1').val((+r6_1).toFixed(3));
	$('#r6_2').val((+r6_2).toFixed(3));
	$('#r6_3').val((+r6_3).toFixed(3));
	$('#r6_4').val((+r6_4).toFixed(3));
	$('#r6_5').val((+r6_5).toFixed(3));
	$('#r6_6').val((+r6_6).toFixed(3));
	
	var r6_1 = $('#r6_1').val();
	var r6_2 = $('#r6_2').val();
	var r6_3 = $('#r6_3').val();
	var r6_4 = $('#r6_4').val();
	var r6_5 = $('#r6_5').val();
	var r6_6 = $('#r6_6').val();
	
	var r5_1 = (+r6_1) + (+randomNumberFromRange(0.005,0.010));
	var r5_2 = (+r6_2) + (+randomNumberFromRange(0.005,0.010));
	var r5_3 = (+r6_3) + (+randomNumberFromRange(0.005,0.010));
	var r5_4 = (+r6_4) + (+randomNumberFromRange(0.005,0.010));
	var r5_5 = (+r6_5) + (+randomNumberFromRange(0.005,0.010));
	var r5_6 = (+r6_6) + (+randomNumberFromRange(0.005,0.010));
	
	$('#r5_1').val((+r5_1).toFixed(3));
	$('#r5_2').val((+r5_2).toFixed(3));
	$('#r5_3').val((+r5_3).toFixed(3));
	$('#r5_4').val((+r5_4).toFixed(3));
	$('#r5_5').val((+r5_5).toFixed(3));
	$('#r5_6').val((+r5_6).toFixed(3));
	
	var r5_1 = $('#r5_1').val();
	var r5_2 = $('#r5_2').val();
	var r5_3 = $('#r5_3').val();
	var r5_4 = $('#r5_4').val();
	var r5_5 = $('#r5_5').val();
	var r5_6 = $('#r5_6').val();
	
	var diff1 = (+r1_1) - (+r5_1);
	var diff2 = (+r1_2) - (+r5_2);
	var diff3 = (+r1_3) - (+r5_3);
	var diff4 = (+r1_4) - (+r5_4);
	var diff5 = (+r1_5) - (+r5_5);
	var diff6 = (+r1_6) - (+r5_6);
	
	var r4_1 = (+r5_1) + (+((+diff1) * 15)/100);
	var r4_2 = (+r5_2) + (+((+diff2) * 15)/100);
	var r4_3 = (+r5_3) + (+((+diff3) * 15)/100);
	var r4_4 = (+r5_4) + (+((+diff4) * 15)/100);
	var r4_5 = (+r5_5) + (+((+diff5) * 15)/100);
	var r4_6 = (+r5_6) + (+((+diff6) * 15)/100);
	
	$('#r4_1').val((+r4_1).toFixed(3));
	$('#r4_2').val((+r4_2).toFixed(3));
	$('#r4_3').val((+r4_3).toFixed(3));
	$('#r4_4').val((+r4_4).toFixed(3));
	$('#r4_5').val((+r4_5).toFixed(3));
	$('#r4_6').val((+r4_6).toFixed(3));
	
	var r4_1 = $('#r4_1').val();
	var r4_2 = $('#r4_2').val();
	var r4_3 = $('#r4_3').val();
	var r4_4 = $('#r4_4').val();
	var r4_5 = $('#r4_5').val();
	var r4_6 = $('#r4_6').val();
	
	var r3_1 = (+r4_1) + (+((+diff1) * 25)/100);
	var r3_2 = (+r4_2) + (+((+diff2) * 25)/100);
	var r3_3 = (+r4_3) + (+((+diff3) * 25)/100);
	var r3_4 = (+r4_4) + (+((+diff4) * 25)/100);
	var r3_5 = (+r4_5) + (+((+diff5) * 25)/100);
	var r3_6 = (+r4_6) + (+((+diff6) * 25)/100);
	
	$('#r3_1').val((+r3_1).toFixed(3));
	$('#r3_2').val((+r3_2).toFixed(3));
	$('#r3_3').val((+r3_3).toFixed(3));
	$('#r3_4').val((+r3_4).toFixed(3));
	$('#r3_5').val((+r3_5).toFixed(3));
	$('#r3_6').val((+r3_6).toFixed(3));
	
	var r3_1 = $('#r3_1').val();
	var r3_2 = $('#r3_2').val();
	var r3_3 = $('#r3_3').val();
	var r3_4 = $('#r3_4').val();
	var r3_5 = $('#r3_5').val();
	var r3_6 = $('#r3_6').val();
	
	var r2_1 = (+r3_1) + (+((+diff1) * 40)/100);
	var r2_2 = (+r3_2) + (+((+diff2) * 40)/100);
	var r2_3 = (+r3_3) + (+((+diff3) * 40)/100);
	var r2_4 = (+r3_4) + (+((+diff4) * 40)/100);
	var r2_5 = (+r3_5) + (+((+diff5) * 40)/100);
	var r2_6 = (+r3_6) + (+((+diff6) * 40)/100);
	
	$('#r2_1').val((+r2_1).toFixed(3));
	$('#r2_2').val((+r2_2).toFixed(3));
	$('#r2_3').val((+r2_3).toFixed(3));
	$('#r2_4').val((+r2_4).toFixed(3));
	$('#r2_5').val((+r2_5).toFixed(3));
	$('#r2_6').val((+r2_6).toFixed(3));

}


$('#chk_shr').change(function(){
    if(this.checked)
	{
		shr_auto();
	}
	else
	{
		$('#txtshr').css("background-color","white");
		$('#r1_1').val(null);
		$('#r1_2').val(null);
		$('#r1_3').val(null);
		$('#r1_4').val(null);
		$('#r1_5').val(null);
		$('#r1_6').val(null);
		$('#r2_1').val(null);
		$('#r2_2').val(null);
		$('#r2_3').val(null);
		$('#r2_4').val(null);
		$('#r2_5').val(null);
		$('#r2_6').val(null);
		$('#r3_1').val(null);
		$('#r3_2').val(null);
		$('#r3_3').val(null);
		$('#r3_4').val(null);
		$('#r3_5').val(null);
		$('#r3_6').val(null);
		$('#r4_1').val(null);
		$('#r4_2').val(null);
		$('#r4_3').val(null);
		$('#r4_4').val(null);
		$('#r4_5').val(null);
		$('#r4_6').val(null);
		$('#r5_1').val(null);
		$('#r5_2').val(null);
		$('#r5_3').val(null);
		$('#r5_4').val(null);
		$('#r5_5').val(null);
		$('#r5_6').val(null);
		$('#r6_1').val(null);
		$('#r6_2').val(null);
		$('#r6_3').val(null);
		$('#r6_4').val(null);
		$('#r6_5').val(null);
		$('#r6_6').val(null);
		$('#r7_1').val(null);
		$('#r7_2').val(null);
		$('#r7_3').val(null);
		$('#r7_4').val(null);
		$('#r7_5').val(null);
		$('#r7_6').val(null);
		$('#dry1').val(null);
		$('#dry2').val(null);
		$('#dry3').val(null);
		$('#dry4').val(null);
		$('#dry5').val(null);
		$('#dry6').val(null);
		$('#avg_dry').val(null);
		$('#age1_1').val(null);
		$('#age1_2').val(null);
		$('#age1_3').val(null);
		$('#age2_1').val(null);
		$('#age2_2').val(null);
		$('#age2_3').val(null);
		$('#avg_mo').val(null);
	}
		
});

$('#r1_1, #r1_2, #r1_3, #r1_4, #r1_5, #r1_6, #r2_1, #r2_2, #r2_3, #r2_4, #r2_5, #r2_6, #r3_1, #r3_2, #r3_3, #r3_4, #r3_5, #r3_6, #r4_1, #r4_2, #r4_3, #r4_4, #r4_5, #r4_6, #r5_1, #r5_2, #r5_3, #r5_4, #r5_5, #r5_6, #r6_1, #r6_2, #r6_3, #r6_4, #r6_5, #r6_6, #r7_1, #r7_2, #r7_3, #r7_4, #r7_5, #r7_6').change(function(){
		
		var r1_1 = $('#r1_1').val();
		var r1_2 = $('#r1_2').val();
		var r1_3 = $('#r1_3').val();
		var r1_4 = $('#r1_4').val();
		var r1_5 = $('#r1_5').val();
		var r1_6 = $('#r1_6').val();
		       
		var r2_1 = $('#r2_1').val();
		var r2_2 = $('#r2_2').val();
		var r2_3 = $('#r2_3').val();
		var r2_4 = $('#r2_4').val();
		var r2_5 = $('#r2_5').val();
		var r2_6 = $('#r2_6').val();
		       
		var r3_1 = $('#r3_1').val();
		var r3_2 = $('#r3_2').val();
		var r3_3 = $('#r3_3').val();
		var r3_4 = $('#r3_4').val();
		var r3_5 = $('#r3_5').val();
		var r3_6 = $('#r3_6').val();
		       
		var r4_1 = $('#r4_1').val();
		var r4_2 = $('#r4_2').val();
		var r4_3 = $('#r4_3').val();
		var r4_4 = $('#r4_4').val();
		var r4_5 = $('#r4_5').val();
		var r4_6 = $('#r4_6').val();
		       
		var r5_1 = $('#r5_1').val();
		var r5_2 = $('#r5_2').val();
		var r5_3 = $('#r5_3').val();
		var r5_4 = $('#r5_4').val();
		var r5_5 = $('#r5_5').val();
		var r5_6 = $('#r5_6').val();
		       
		var r6_1 = $('#r6_1').val();
		var r6_2 = $('#r6_2').val();
		var r6_3 = $('#r6_3').val();
		var r6_4 = $('#r6_4').val();
		var r6_5 = $('#r6_5').val();
		var r6_6 = $('#r6_6').val();

		var dry1 = (+r1_1) - (+r6_1);
		var dry2 = (+r1_2) - (+r6_2);
		var dry3 = (+r1_3) - (+r6_3);
		var dry4 = (+r1_4) - (+r6_4);
		var dry5 = (+r1_5) - (+r6_5);
		var dry6 = (+r1_6) - (+r6_6);
		
		$('#dry1').val((+dry1).toFixed(3));
		$('#dry2').val((+dry2).toFixed(3));
		$('#dry3').val((+dry3).toFixed(3));
		$('#dry4').val((+dry4).toFixed(3));
		$('#dry5').val((+dry5).toFixed(3));
		$('#dry6').val((+dry6).toFixed(3));
		
		var dry1 = $('#dry1').val();
		var dry2 = $('#dry2').val();
		var dry3 = $('#dry3').val();
		var dry4 = $('#dry4').val();
		var dry5 = $('#dry5').val();
		var dry6 = $('#dry6').val();
		
		var age1_1 = ((+dry1) + (+dry2))/2;
		var age1_2 = ((+dry3) + (+dry4))/2;
		var age1_3 = ((+dry5) + (+dry6))/2;
		
		$('#age1_1').val((+age1_1).toFixed(3));
		$('#age1_2').val((+age1_2).toFixed(3));
		$('#age1_3').val((+age1_3).toFixed(3));
		
		var age1_1 = $('#age1_1').val();
		var age1_2 = $('#age1_2').val();
		var age1_3 = $('#age1_3').val();
		
		var avg_dry = ((+age1_1) + (+age1_2) + (+age1_3))/3;
		$('#avg_dry').val((+avg_dry).toFixed(3));

		var r7_1 = $('#r7_1').val();
		var r7_2 = $('#r7_2').val();
		var r7_3 = $('#r7_3').val();
		var r7_4 = $('#r7_4').val();
		var r7_5 = $('#r7_5').val();
		var r7_6 = $('#r7_6').val();
		
		var age2_1 = ((+r7_1) + (+r7_2)) / 2;
		var age2_2 = ((+r7_3) + (+r7_4)) / 2;
		var age2_3 = ((+r7_5) + (+r7_6)) / 2;

		$('#age2_1').val((+age2_1).toFixed(3));
		$('#age2_2').val((+age2_2).toFixed(3));
		$('#age2_3').val((+age2_3).toFixed(3));

		var age2_1 = $('#age2_1').val();
		var age2_2 = $('#age2_2').val();
		var age2_3 = $('#age2_3').val();

		var avg_mo = ((+age2_1) + (+age2_2) + (+age2_3)) / 3;
		$('#avg_mo').val((+avg_mo).toFixed(3));
	})


$('#avg_dry, #avg_mo').change(function(){
	$('#txtshr').css("background-color","var(--success)");
	var avg_dry = $('#avg_dry').val();
	var avg_mo = $('#avg_mo').val();

	if((randomNumberFromRange(1,9).toFixed())%2==0)
	{
		var age1_1 = (+avg_dry) + 0.008;
		var age1_2 = (+avg_dry) + 0.001;
		var age1_3 = (+avg_dry) - 0.009;
		
		var age2_1 = (+avg_mo) + 0.009;
		var age2_2 = (+avg_mo) + 0.006;
		var age2_3 = (+avg_mo) - 0.014;

	}else{
		var age1_1 = (+avg_dry) - 0.007;
		var age1_2 = (+avg_dry) + 0.013;
		var age1_3 = (+avg_dry) - 0.006;

		var age2_1 = (+avg_mo) - 0.008;
		var age2_2 = (+avg_mo) + 0.014;
		var age2_3 = (+avg_mo) - 0.006;
	}

	$('#age1_1').val((+age1_1).toFixed(3));
	$('#age1_2').val((+age1_2).toFixed(3));
	$('#age1_3').val((+age1_3).toFixed(3));
	                  
	$('#age2_1').val((+age2_1).toFixed(3));
	$('#age2_2').val((+age2_2).toFixed(3));
	$('#age2_3').val((+age2_3).toFixed(3));
	
	var age1_1 = $('#age1_1').val();
	var age1_2 = $('#age1_2').val();
	var age1_3 = $('#age1_3').val();
	
	var age2_1 = $('#age2_1').val();
	var age2_2 = $('#age2_2').val();
	var age2_3 = $('#age2_3').val();
	
	var hh = randomNumberFromRange(1,9).toFixed();
	if(hh%2==0){
		var dry1 = (+age1_1) + 0.002
		var dry2 = (+age1_1) - 0.002
		var dry3 = (+age1_2) - 0.001
		var dry4 = (+age1_2) + 0.001
		var dry5 = (+age1_3) + 0.003
		var dry6 = (+age1_3) - 0.003

		var r7_1 = (+age2_1) + 0.001
		var r7_2 = (+age2_1) - 0.001
		var r7_3 = (+age2_2) - 0.002
		var r7_4 = (+age2_2) + 0.002
		var r7_5 = (+age2_3) + 0.001
		var r7_6 = (+age2_3) - 0.001

	}else{
		var dry1 = (+age1_1) - 0.001
		var dry2 = (+age1_1) + 0.001
		var dry3 = (+age1_2) + 0.002
		var dry4 = (+age1_2) - 0.002
		var dry5 = (+age1_3) - 0.002
		var dry6 = (+age1_3) + 0.002

		var r7_1 = (+age2_1) - 0.002
		var r7_2 = (+age2_1) + 0.002
		var r7_3 = (+age2_2) + 0.001
		var r7_4 = (+age2_2) - 0.001
		var r7_5 = (+age2_3) - 0.002
		var r7_6 = (+age2_3) + 0.002
	}
	
	$('#dry1').val((+dry1).toFixed(3));
	$('#dry2').val((+dry2).toFixed(3));
	$('#dry3').val((+dry3).toFixed(3));
	$('#dry4').val((+dry4).toFixed(3));
	$('#dry5').val((+dry5).toFixed(3));
	$('#dry6').val((+dry6).toFixed(3));
	
	$('#r7_1').val((+r7_1).toFixed(3));
	$('#r7_2').val((+r7_2).toFixed(3));
	$('#r7_3').val((+r7_3).toFixed(3));
	$('#r7_4').val((+r7_4).toFixed(3));
	$('#r7_5').val((+r7_5).toFixed(3));
	$('#r7_6').val((+r7_6).toFixed(3));

	
	var r1_set1 = randomNumberFromRange(2,12).toFixed();
	var r1_set2 = randomNumberFromRange(2,12).toFixed();
	var r1_set3 = randomNumberFromRange(2,12).toFixed();
	
	var r1_1 = (+r1_set1) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_2 = (+r1_set1) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_3 = (+r1_set2) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_4 = (+r1_set2) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_5 = (+r1_set3) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	var r1_6 = (+r1_set3) + (+randomNumberFromRange(0.550,0.880).toFixed(3));
	
	$('#r1_1').val((+r1_1).toFixed(3));
	$('#r1_2').val((+r1_2).toFixed(3));
	$('#r1_3').val((+r1_3).toFixed(3));
	$('#r1_4').val((+r1_4).toFixed(3));
	$('#r1_5').val((+r1_5).toFixed(3));
	$('#r1_6').val((+r1_6).toFixed(3));
	
	var r1_1 = $('#r1_1').val();
	var r1_2 = $('#r1_2').val();
	var r1_3 = $('#r1_3').val();
	var r1_4 = $('#r1_4').val();
	var r1_5 = $('#r1_5').val();
	var r1_6 = $('#r1_6').val();
	
	var dry1 = $('#dry1').val();
	var dry2 = $('#dry2').val();
	var dry3 = $('#dry3').val();
	var dry4 = $('#dry4').val();
	var dry5 = $('#dry5').val();
	var dry6 = $('#dry6').val();
	
	var r6_1 = (+r1_1) - (+dry1);
	var r6_2 = (+r1_2) - (+dry2);
	var r6_3 = (+r1_3) - (+dry3);
	var r6_4 = (+r1_4) - (+dry4);
	var r6_5 = (+r1_5) - (+dry5);
	var r6_6 = (+r1_6) - (+dry6);
	
	$('#r6_1').val((+r6_1).toFixed(3));
	$('#r6_2').val((+r6_2).toFixed(3));
	$('#r6_3').val((+r6_3).toFixed(3));
	$('#r6_4').val((+r6_4).toFixed(3));
	$('#r6_5').val((+r6_5).toFixed(3));
	$('#r6_6').val((+r6_6).toFixed(3));
	
	var r6_1 = $('#r6_1').val();
	var r6_2 = $('#r6_2').val();
	var r6_3 = $('#r6_3').val();
	var r6_4 = $('#r6_4').val();
	var r6_5 = $('#r6_5').val();
	var r6_6 = $('#r6_6').val();
	
	var r5_1 = (+r6_1) + (+randomNumberFromRange(0.005,0.010));
	var r5_2 = (+r6_2) + (+randomNumberFromRange(0.005,0.010));
	var r5_3 = (+r6_3) + (+randomNumberFromRange(0.005,0.010));
	var r5_4 = (+r6_4) + (+randomNumberFromRange(0.005,0.010));
	var r5_5 = (+r6_5) + (+randomNumberFromRange(0.005,0.010));
	var r5_6 = (+r6_6) + (+randomNumberFromRange(0.005,0.010));
	
	$('#r5_1').val((+r5_1).toFixed(3));
	$('#r5_2').val((+r5_2).toFixed(3));
	$('#r5_3').val((+r5_3).toFixed(3));
	$('#r5_4').val((+r5_4).toFixed(3));
	$('#r5_5').val((+r5_5).toFixed(3));
	$('#r5_6').val((+r5_6).toFixed(3));
	
	var r5_1 = $('#r5_1').val();
	var r5_2 = $('#r5_2').val();
	var r5_3 = $('#r5_3').val();
	var r5_4 = $('#r5_4').val();
	var r5_5 = $('#r5_5').val();
	var r5_6 = $('#r5_6').val();
	
	var diff1 = (+r1_1) - (+r5_1);
	var diff2 = (+r1_2) - (+r5_2);
	var diff3 = (+r1_3) - (+r5_3);
	var diff4 = (+r1_4) - (+r5_4);
	var diff5 = (+r1_5) - (+r5_5);
	var diff6 = (+r1_6) - (+r5_6);
	
	var r4_1 = (+r5_1) + (+((+diff1) * 15)/100);
	var r4_2 = (+r5_2) + (+((+diff2) * 15)/100);
	var r4_3 = (+r5_3) + (+((+diff3) * 15)/100);
	var r4_4 = (+r5_4) + (+((+diff4) * 15)/100);
	var r4_5 = (+r5_5) + (+((+diff5) * 15)/100);
	var r4_6 = (+r5_6) + (+((+diff6) * 15)/100);
	
	$('#r4_1').val((+r4_1).toFixed(3));
	$('#r4_2').val((+r4_2).toFixed(3));
	$('#r4_3').val((+r4_3).toFixed(3));
	$('#r4_4').val((+r4_4).toFixed(3));
	$('#r4_5').val((+r4_5).toFixed(3));
	$('#r4_6').val((+r4_6).toFixed(3));
	
	var r4_1 = $('#r4_1').val();
	var r4_2 = $('#r4_2').val();
	var r4_3 = $('#r4_3').val();
	var r4_4 = $('#r4_4').val();
	var r4_5 = $('#r4_5').val();
	var r4_6 = $('#r4_6').val();
	
	var r3_1 = (+r4_1) + (+((+diff1) * 25)/100);
	var r3_2 = (+r4_2) + (+((+diff2) * 25)/100);
	var r3_3 = (+r4_3) + (+((+diff3) * 25)/100);
	var r3_4 = (+r4_4) + (+((+diff4) * 25)/100);
	var r3_5 = (+r4_5) + (+((+diff5) * 25)/100);
	var r3_6 = (+r4_6) + (+((+diff6) * 25)/100);
	
	$('#r3_1').val((+r3_1).toFixed(3));
	$('#r3_2').val((+r3_2).toFixed(3));
	$('#r3_3').val((+r3_3).toFixed(3));
	$('#r3_4').val((+r3_4).toFixed(3));
	$('#r3_5').val((+r3_5).toFixed(3));
	$('#r3_6').val((+r3_6).toFixed(3));
	
	var r3_1 = $('#r3_1').val();
	var r3_2 = $('#r3_2').val();
	var r3_3 = $('#r3_3').val();
	var r3_4 = $('#r3_4').val();
	var r3_5 = $('#r3_5').val();
	var r3_6 = $('#r3_6').val();
	
	var r2_1 = (+r3_1) + (+((+diff1) * 40)/100);
	var r2_2 = (+r3_2) + (+((+diff2) * 40)/100);
	var r2_3 = (+r3_3) + (+((+diff3) * 40)/100);
	var r2_4 = (+r3_4) + (+((+diff4) * 40)/100);
	var r2_5 = (+r3_5) + (+((+diff5) * 40)/100);
	var r2_6 = (+r3_6) + (+((+diff6) * 40)/100);
	
	$('#r2_1').val((+r2_1).toFixed(3));
	$('#r2_2').val((+r2_2).toFixed(3));
	$('#r2_3').val((+r2_3).toFixed(3));
	$('#r2_4').val((+r2_4).toFixed(3));
	$('#r2_5').val((+r2_5).toFixed(3));
	$('#r2_6').val((+r2_6).toFixed(3));
})

function dim_auto()
{
	$('#txtdim').css("background-color","var(--success)");
	var avg_length = randomNumberFromRange(399.00,402.00);
	var avg_width = randomNumberFromRange(198.00,202.00);
	var avg_height = randomNumberFromRange(198.00,202.00);
	$('#avg_length').val((+avg_length).toFixed(2));
	$('#avg_width').val((+avg_width).toFixed(2));
	$('#avg_height').val((+avg_height).toFixed(2));

	var avg_length = $('#avg_length').val();
	var avg_width = $('#avg_width').val();
	var avg_height = $('#avg_height').val();

	if((+randomNumberFromRange(1,9).toFixed())%2==0){
		var l1 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l2 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l3 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l4 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l5 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l6 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l7 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l8 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l9 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l10 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l11 = (+avg_length) - ((+l1) - (+avg_length));
		var l12 = (+avg_length) + ((+avg_length) - (+l2));
		var l13 = (+avg_length) - ((+l3) - (+avg_length));
		var l14 = (+avg_length) - ((+l4) - (+avg_length));
		var l15 = (+avg_length) + ((+avg_length) - (+l5));
		var l16 = (+avg_length) - ((+l6) - (+avg_length));
		var l17 = (+avg_length) + ((+avg_length) - (+l7));
		var l18 = (+avg_length) + ((+avg_length) - (+l8));
		var l19 = (+avg_length) - ((+l9) - (+avg_length));
		var l20 = (+avg_length) + ((+avg_length) - (+l10));

		var w1 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w2 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w3 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w4 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w5 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w6 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w7 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w8 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w9 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w10 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w11 = (+avg_width) - ((+w1) - (+avg_width));
		var w12 = (+avg_width) + ((+avg_width) - (+w2));
		var w13 = (+avg_width) - ((+w3) - (+avg_width));
		var w14 = (+avg_width) - ((+w4) - (+avg_width));
		var w15 = (+avg_width) + ((+avg_width) - (+w5));
		var w16 = (+avg_width) - ((+w6) - (+avg_width));
		var w17 = (+avg_width) + ((+avg_width) - (+w7));
		var w18 = (+avg_width) + ((+avg_width) - (+w8));
		var w19 = (+avg_width) - ((+w9) - (+avg_width));
		var w20 = (+avg_width) + ((+avg_width) - (+w10));

		var h1 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h2 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h3 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h4 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h5 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h6 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h7 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h8 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h9 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h10 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h11 = (+avg_height) - ((+h1) - (+avg_height));
		var h12 = (+avg_height) + ((+avg_height) - (+h2));
		var h13 = (+avg_height) - ((+h3) - (+avg_height));
		var h14 = (+avg_height) - ((+h4) - (+avg_height));
		var h15 = (+avg_height) + ((+avg_height) - (+h5));
		var h16 = (+avg_height) - ((+h6) - (+avg_height));
		var h17 = (+avg_height) + ((+avg_height) - (+h7));
		var h18 = (+avg_height) + ((+avg_height) - (+h8));
		var h19 = (+avg_height) - ((+h9) - (+avg_height));
		var h20 = (+avg_height) + ((+avg_height) - (+h10));
	}else{
		var l1 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l2 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l3 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l4 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l5 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l6 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l7 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l8 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l9 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l10 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));

		var l11 = (+avg_length) + ((+avg_length) - (+l1));
		var l12 = (+avg_length) + ((+avg_length) - (+l2));
		var l13 = (+avg_length) - ((+l3) - (+avg_length));
		var l14 = (+avg_length) + ((+avg_length) - (+l4));
		var l15 = (+avg_length) - ((+l5) - (+avg_length));
		var l16 = (+avg_length) - ((+l6) - (+avg_length));
		var l17 = (+avg_length) + ((+avg_length) - (+l7));
		var l18 = (+avg_length) + ((+avg_length) - (+l8));
		var l19 = (+avg_length) - ((+l9) - (+avg_length));
		var l20 = (+avg_length) + ((+avg_length) - (+l10));

		var w1 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w2 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w3 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w4 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w5 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w6 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w7 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w8 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w9 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w10 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w11 = (+avg_width) + ((+avg_width) - (+w1));
		var w12 = (+avg_width) + ((+avg_width) - (+w2));
		var w13 = (+avg_width) - ((+w3) - (+avg_width));
		var w14 = (+avg_width) + ((+avg_width) - (+w4));
		var w15 = (+avg_width) - ((+w5) - (+avg_width));
		var w16 = (+avg_width) - ((+w6) - (+avg_width));
		var w17 = (+avg_width) + ((+avg_width) - (+w7));
		var w18 = (+avg_width) + ((+avg_width) - (+w8));
		var w19 = (+avg_width) - ((+w9) - (+avg_width));
		var w20 = (+avg_width) + ((+avg_width) - (+w10));

		var h1 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h2 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h3 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h4 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h5 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h6 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h7 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h8 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h9 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h10 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h11 = (+avg_height) + ((+avg_height) - (+h1));
		var h12 = (+avg_height) + ((+avg_height) - (+h2));
		var h13 = (+avg_height) - ((+h3) - (+avg_height));
		var h14 = (+avg_height) + ((+avg_height) - (+h4));
		var h15 = (+avg_height) - ((+h5) - (+avg_height));
		var h16 = (+avg_height) - ((+h6) - (avg_height));
		var h17 = (+avg_height) + ((+avg_height) - (+h7));
		var h18 = (+avg_height) + ((+avg_height) - (+h8));
		var h19 = (+avg_height) - ((+h9) - (+avg_height));
		var h20 = (+avg_height) + ((+avg_height) - (+h10));
	}


	
	$('#l1').val((+l1).toFixed(2));
	$('#l2').val((+l2).toFixed(2));
	$('#l3').val((+l3).toFixed(2));
	$('#l4').val((+l4).toFixed(2));
	$('#l5').val((+l5).toFixed(2));
	$('#l6').val((+l6).toFixed(2));
	$('#l7').val((+l7).toFixed(2));
	$('#l8').val((+l8).toFixed(2));
	$('#l9').val((+l9).toFixed(2));
	$('#l10').val((+l10).toFixed(2));
	$('#l11').val((+l11).toFixed(2));
	$('#l12').val((+l12).toFixed(2));
	$('#l13').val((+l13).toFixed(2));
	$('#l14').val((+l14).toFixed(2));
	$('#l15').val((+l15).toFixed(2));
	$('#l16').val((+l16).toFixed(2));
	$('#l17').val((+l17).toFixed(2));
	$('#l18').val((+l18).toFixed(2));
	$('#l19').val((+l19).toFixed(2));
	$('#l20').val((+l20).toFixed(2));

	$('#w1').val((+w1).toFixed(2));
	$('#w2').val((+w2).toFixed(2));
	$('#w3').val((+w3).toFixed(2));
	$('#w4').val((+w4).toFixed(2));
	$('#w5').val((+w5).toFixed(2));
	$('#w6').val((+w6).toFixed(2));
	$('#w7').val((+w7).toFixed(2));
	$('#w8').val((+w8).toFixed(2));
	$('#w9').val((+w9).toFixed(2));
	$('#w10').val((+w10).toFixed(2));
	$('#w11').val((+w11).toFixed(2));
	$('#w12').val((+w12).toFixed(2));
	$('#w13').val((+w13).toFixed(2));
	$('#w14').val((+w14).toFixed(2));
	$('#w15').val((+w15).toFixed(2));
	$('#w16').val((+w16).toFixed(2));
	$('#w17').val((+w17).toFixed(2));
	$('#w18').val((+w18).toFixed(2));
	$('#w19').val((+w19).toFixed(2));
	$('#w20').val((+w20).toFixed(2));

	$('#h1').val((+h1).toFixed(2));
	$('#h2').val((+h2).toFixed(2));
	$('#h3').val((+h3).toFixed(2));
	$('#h4').val((+h4).toFixed(2));
	$('#h5').val((+h5).toFixed(2));
	$('#h6').val((+h6).toFixed(2));
	$('#h7').val((+h7).toFixed(2));
	$('#h8').val((+h8).toFixed(2));
	$('#h9').val((+h9).toFixed(2));
	$('#h10').val((+h10).toFixed(2));
	$('#h11').val((+h11).toFixed(2));
	$('#h12').val((+h12).toFixed(2));
	$('#h13').val((+h13).toFixed(2));
	$('#h14').val((+h14).toFixed(2));
	$('#h15').val((+h15).toFixed(2));
	$('#h16').val((+h16).toFixed(2));
	$('#h17').val((+h17).toFixed(2));
	$('#h18').val((+h18).toFixed(2));
	$('#h19').val((+h19).toFixed(2));
	$('#h20').val((+h20).toFixed(2));

}


$('#chk_dim').change(function(){
    if(this.checked)
	{
		dim_auto();
	}
	else
	{
		$('#txtdim').css("background-color","white");	
		$('#l1').val(null);
		$('#l2').val(null);
		$('#l3').val(null);
		$('#l4').val(null);
		$('#l5').val(null);
		$('#l6').val(null);
		$('#l7').val(null);
		$('#l8').val(null);
		$('#l9').val(null);
		$('#l10').val(null);
		$('#l11').val(null);
		$('#l12').val(null);
		$('#l13').val(null);
		$('#l14').val(null);
		$('#l15').val(null);
		$('#l16').val(null);
		$('#l17').val(null);
		$('#l18').val(null);
		$('#l19').val(null);
		$('#l20').val(null);
		$('#w1').val(null);
		$('#w2').val(null);
		$('#w3').val(null);
		$('#w4').val(null);
		$('#w5').val(null);
		$('#w6').val(null);
		$('#w7').val(null);
		$('#w8').val(null);
		$('#w9').val(null);
		$('#w10').val(null);
		$('#w11').val(null);
		$('#w12').val(null);
		$('#w13').val(null);
		$('#w14').val(null);
		$('#w15').val(null);
		$('#w16').val(null);
		$('#w17').val(null);
		$('#w18').val(null);
		$('#w19').val(null);
		$('#w20').val(null);
		$('#h1').val(null);
		$('#h2').val(null);
		$('#h3').val(null);
		$('#h4').val(null);
		$('#h5').val(null);
		$('#h6').val(null);
		$('#h7').val(null);
		$('#h8').val(null);
		$('#h9').val(null);
		$('#h10').val(null);
		$('#h11').val(null);
		$('#h12').val(null);
		$('#h13').val(null);
		$('#h14').val(null);
		$('#h15').val(null);
		$('#h16').val(null);
		$('#h17').val(null);
		$('#h18').val(null);
		$('#h19').val(null);
		$('#h20').val(null);
	}
});

$('#avg_length, #avg_width, #avg_height').change(function(){
	$('#txtdim').css("background-color","var(--success)");
	var avg_length = $('#avg_length').val();
	var avg_width = $('#avg_width').val();
	var avg_height = $('#avg_height').val();

	if((+randomNumberFromRange(1,9).toFixed())%2==0){
		var l1 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l2 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l3 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l4 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l5 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l6 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l7 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l8 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l9 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l10 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l11 = (+avg_length) - ((+l1) - (+avg_length));
		var l12 = (+avg_length) + ((+avg_length) - (+l2));
		var l13 = (+avg_length) - ((+l3) - (+avg_length));
		var l14 = (+avg_length) - ((+l4) - (+avg_length));
		var l15 = (+avg_length) + ((+avg_length) - (+l5));
		var l16 = (+avg_length) - ((+l6) - (+avg_length));
		var l17 = (+avg_length) + ((+avg_length) - (+l7));
		var l18 = (+avg_length) + ((+avg_length) - (+l8));
		var l19 = (+avg_length) - ((+l9) - (+avg_length));
		var l20 = (+avg_length) + ((+avg_length) - (+l10));

		var w1 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w2 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w3 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w4 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w5 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w6 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w7 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w8 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w9 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w10 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w11 = (+avg_width) - ((+w1) - (+avg_width));
		var w12 = (+avg_width) + ((+avg_width) - (+w2));
		var w13 = (+avg_width) - ((+w3) - (+avg_width));
		var w14 = (+avg_width) - ((+w4) - (+avg_width));
		var w15 = (+avg_width) + ((+avg_width) - (+w5));
		var w16 = (+avg_width) - ((+w6) - (+avg_width));
		var w17 = (+avg_width) + ((+avg_width) - (+w7));
		var w18 = (+avg_width) + ((+avg_width) - (+w8));
		var w19 = (+avg_width) - ((+w9) - (+avg_width));
		var w20 = (+avg_width) + ((+avg_width) - (+w10));

		var h1 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h2 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h3 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h4 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h5 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h6 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h7 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h8 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h9 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h10 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h11 = (+avg_height) - ((+h1) - (+avg_height));
		var h12 = (+avg_height) + ((+avg_height) - (+h2));
		var h13 = (+avg_height) - ((+h3) - (+avg_height));
		var h14 = (+avg_height) - ((+h4) - (+avg_height));
		var h15 = (+avg_height) + ((+avg_height) - (+h5));
		var h16 = (+avg_height) - ((+h6) - (+avg_height));
		var h17 = (+avg_height) + ((+avg_height) - (+h7));
		var h18 = (+avg_height) + ((+avg_height) - (+h8));
		var h19 = (+avg_height) - ((+h9) - (+avg_height));
		var h20 = (+avg_height) + ((+avg_height) - (+h10));
	}else{
		var l1 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l2 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l3 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l4 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l5 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l6 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l7 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l8 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l9 = (+avg_length) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var l10 = (+avg_length) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));

		var l11 = (+avg_length) + ((+avg_length) - (+l1));
		var l12 = (+avg_length) + ((+avg_length) - (+l2));
		var l13 = (+avg_length) - ((+l3) - (+avg_length));
		var l14 = (+avg_length) + ((+avg_length) - (+l4));
		var l15 = (+avg_length) - ((+l5) - (+avg_length));
		var l16 = (+avg_length) - ((+l6) - (+avg_length));
		var l17 = (+avg_length) + ((+avg_length) - (+l7));
		var l18 = (+avg_length) + ((+avg_length) - (+l8));
		var l19 = (+avg_length) - ((+l9) - (+avg_length));
		var l20 = (+avg_length) + ((+avg_length) - (+l10));

		var w1 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w2 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w3 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w4 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w5 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w6 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w7 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w8 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w9 = (+avg_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w10 = (+avg_width) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var w11 = (+avg_width) + ((+avg_width) - (+w1));
		var w12 = (+avg_width) + ((+avg_width) - (+w2));
		var w13 = (+avg_width) - ((+w3) - (+avg_width));
		var w14 = (+avg_width) + ((+avg_width) - (+w4));
		var w15 = (+avg_width) - ((+w5) - (+avg_width));
		var w16 = (+avg_width) - ((+w6) - (+avg_width));
		var w17 = (+avg_width) + ((+avg_width) - (+w7));
		var w18 = (+avg_width) + ((+avg_width) - (+w8));
		var w19 = (+avg_width) - ((+w9) - (+avg_width));
		var w20 = (+avg_width) + ((+avg_width) - (+w10));

		var h1 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h2 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h3 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h4 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h5 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h6 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h7 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h8 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h9 = (+avg_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h10 = (+avg_height) - (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var h11 = (+avg_height) + ((+avg_height) - (+h1));
		var h12 = (+avg_height) + ((+avg_height) - (+h2));
		var h13 = (+avg_height) - ((+h3) - (+avg_height));
		var h14 = (+avg_height) + ((+avg_height) - (+h4));
		var h15 = (+avg_height) - ((+h5) - (+avg_height));
		var h16 = (+avg_height) - ((+h6) - (avg_height));
		var h17 = (+avg_height) + ((+avg_height) - (+h7));
		var h18 = (+avg_height) + ((+avg_height) - (+h8));
		var h19 = (+avg_height) - ((+h9) - (+avg_height));
		var h20 = (+avg_height) + ((+avg_height) - (+h10));
	}


	
	$('#l1').val((+l1).toFixed(2));
	$('#l2').val((+l2).toFixed(2));
	$('#l3').val((+l3).toFixed(2));
	$('#l4').val((+l4).toFixed(2));
	$('#l5').val((+l5).toFixed(2));
	$('#l6').val((+l6).toFixed(2));
	$('#l7').val((+l7).toFixed(2));
	$('#l8').val((+l8).toFixed(2));
	$('#l9').val((+l9).toFixed(2));
	$('#l10').val((+l10).toFixed(2));
	$('#l11').val((+l11).toFixed(2));
	$('#l12').val((+l12).toFixed(2));
	$('#l13').val((+l13).toFixed(2));
	$('#l14').val((+l14).toFixed(2));
	$('#l15').val((+l15).toFixed(2));
	$('#l16').val((+l16).toFixed(2));
	$('#l17').val((+l17).toFixed(2));
	$('#l18').val((+l18).toFixed(2));
	$('#l19').val((+l19).toFixed(2));
	$('#l20').val((+l20).toFixed(2));

	$('#w1').val((+w1).toFixed(2));
	$('#w2').val((+w2).toFixed(2));
	$('#w3').val((+w3).toFixed(2));
	$('#w4').val((+w4).toFixed(2));
	$('#w5').val((+w5).toFixed(2));
	$('#w6').val((+w6).toFixed(2));
	$('#w7').val((+w7).toFixed(2));
	$('#w8').val((+w8).toFixed(2));
	$('#w9').val((+w9).toFixed(2));
	$('#w10').val((+w10).toFixed(2));
	$('#w11').val((+w11).toFixed(2));
	$('#w12').val((+w12).toFixed(2));
	$('#w13').val((+w13).toFixed(2));
	$('#w14').val((+w14).toFixed(2));
	$('#w15').val((+w15).toFixed(2));
	$('#w16').val((+w16).toFixed(2));
	$('#w17').val((+w17).toFixed(2));
	$('#w18').val((+w18).toFixed(2));
	$('#w19').val((+w19).toFixed(2));
	$('#w20').val((+w20).toFixed(2));

	$('#h1').val((+h1).toFixed(2));
	$('#h2').val((+h2).toFixed(2));
	$('#h3').val((+h3).toFixed(2));
	$('#h4').val((+h4).toFixed(2));
	$('#h5').val((+h5).toFixed(2));
	$('#h6').val((+h6).toFixed(2));
	$('#h7').val((+h7).toFixed(2));
	$('#h8').val((+h8).toFixed(2));
	$('#h9').val((+h9).toFixed(2));
	$('#h10').val((+h10).toFixed(2));
	$('#h11').val((+h11).toFixed(2));
	$('#h12').val((+h12).toFixed(2));
	$('#h13').val((+h13).toFixed(2));
	$('#h14').val((+h14).toFixed(2));
	$('#h15').val((+h15).toFixed(2));
	$('#h16').val((+h16).toFixed(2));
	$('#h17').val((+h17).toFixed(2));
	$('#h18').val((+h18).toFixed(2));
	$('#h19').val((+h19).toFixed(2));
	$('#h20').val((+h20).toFixed(2));
})


$('#l1, #l2, #l3, #l4, #l5, #l6, #l7, #l8, #l9, #l10, #l11, #l12, #l13, #l14, #l15, #l16, #l17, #l18, #l19, #l20, #w1, #w2, #w3, #w4, #w5, #w6, #w7, #w8, #w9, #w10, #w11, #w12, #w13, #w14, #w15, #w16, #w17, #w18, #w19, #w20, #h1, #h2, #h3, #h4, #h5, #h6, #h7, #h8, #h9, #h10, #h11, #h12, #h13, #h14, #h15, #h16, #h17, #h18, #h19, #w20').change(function(){
	$('#txtdim').css("background-color","var(--success)");
	
	var l1 = $('#l1').val();
	var l2 = $('#l2').val();
	var l3 = $('#l3').val();
	var l4 = $('#l4').val();
	var l5 = $('#l5').val();
	var l6 = $('#l6').val();
	var l7 = $('#l7').val();
	var l8 = $('#l8').val();
	var l9 = $('#l9').val();
	var l10 = $('#l10').val();
	var l11 = $('#l11').val();
	var l12 = $('#l12').val();
	var l13 = $('#l13').val();
	var l14 = $('#l14').val();
	var l15 = $('#l15').val();
	var l16 = $('#l16').val();
	var l17 = $('#l17').val();
	var l18 = $('#l18').val();
	var l19 = $('#l19').val();
	var l20 = $('#l20').val();

	var avg_length = ((+l1) + (+l2) + (+l3) + (+l4) + (+l5) + (+l6) + (+l7) + (+l8) + (+l9) + (+l10) + (+l11) + (+l12) + (+l13) + (+l14) + (+l15) + (+l16) + (+l17) + (+l18) + (+l19) + (+l20)) / 20;
	$('#avg_length').val((+avg_length).toFixed(2));

	var w1 = $('#w1').val();
	var w2 = $('#w2').val();
	var w3 = $('#w3').val();
	var w4 = $('#w4').val();
	var w5 = $('#w5').val();
	var w6 = $('#w6').val();
	var w7 = $('#w7').val();
	var w8 = $('#w8').val();
	var w9 = $('#w9').val();
	var w10 = $('#w10').val();
	var w11 = $('#w11').val();
	var w12 = $('#w12').val();
	var w13 = $('#w13').val();
	var w14 = $('#w14').val();
	var w15 = $('#w15').val();
	var w16 = $('#w16').val();
	var w17 = $('#w17').val();
	var w18 = $('#w18').val();
	var w19 = $('#w19').val();
	var w20 = $('#w20').val();
	
	var avg_width = ((+w1) + (+w2) + (+w3) + (+w4) + (+w5) + (+w6) + (+w7) + (+w8) + (+w9) + (+w10) + (+w11) + (+w12) + (+w13) + (+w14) + (+w15) + (+w16) + (+w17) + (+w18) + (+w19) + (+w20)) / 20;
	$('#avg_width').val((+avg_width).toFixed(2));

	var h1 = $('#h1').val();
	var h2 = $('#h2').val();
	var h3 = $('#h3').val();
	var h4 = $('#h4').val();
	var h5 = $('#h5').val();
	var h6 = $('#h6').val();
	var h7 = $('#h7').val();
	var h8 = $('#h8').val();
	var h9 = $('#h9').val();
	var h10 = $('#h10').val();
	var h11 = $('#h11').val();
	var h12 = $('#h12').val();
	var h13 = $('#h13').val();
	var h14 = $('#h14').val();
	var h15 = $('#h15').val();
	var h16 = $('#h16').val();
	var h17 = $('#h17').val();
	var h18 = $('#h18').val();
	var h19 = $('#h19').val();
	var h20 = $('#h20').val();
	var avg_height = ((+h1) + (+h2) + (+h3) + (+h4) + (+h5) + (+h6) + (+h7) + (+h8) + (+h9) + (+h10) + (+h11) + (+h12) + (+h13) + (+h14) + (+h15) + (+h16) + (+h17) + (+h18) + (+h19) + (+h20)) / 20;
	$('#avg_height').val((+avg_height).toFixed(2));

})






function wtr_auto()
{
	$('#txtwtr').css("background-color","var(--success)");
	var avg_wtr = randomNumberFromRange(4.5,7.0).toFixed(1);
	if((+randomNumberFromRange(1,9).toFixed())%2==0){
		var wtr1 = (+avg_wtr) + (+randomNumberFromRange(0.3,0.8).toFixed(1));
		var wtr2 = (+avg_wtr) - ((+wtr1) - (+avg_wtr));
		var wtr3 = (+avg_wtr);
	}else{
		var wtr1 = (+avg_wtr) - (+randomNumberFromRange(0.3,0.8).toFixed(1));
		var wtr2 = (+avg_wtr);
		var wtr3 = (+avg_wtr) + ((+avg_wtr) - (+wtr1));
	}
	
	$('#wtr1').val((+wtr1).toFixed(1));
	$('#wtr2').val((+wtr2).toFixed(1));
	$('#wtr3').val((+wtr3).toFixed(1));
	
	var wtr1 = $('#wtr1').val();
	var wtr2 = $('#wtr2').val();
	var wtr3 = $('#wtr3').val();
	var avg_wtr = ((+wtr1) + (+wtr2) + (+wtr3)) / 3;
	$('#avg_wtr').val((+avg_wtr).toFixed());

	var wa_1_1 = randomNumberFromRange(29.00,33.00).toFixed(2);
	var wa_1_2 = randomNumberFromRange(29.00,33.00).toFixed(2);
	var wa_1_3 = randomNumberFromRange(29.00,33.00).toFixed(2);
	$('#wa_1_1').val(wa_1_1);
	$('#wa_1_2').val(wa_1_2);
	$('#wa_1_3').val(wa_1_3);

	var wa_1_1 = $('#wa_1_1').val();
	var wa_1_2 = $('#wa_1_2').val();
	var wa_1_3 = $('#wa_1_3').val();

	var wtr1 = $('#wtr1').val();
	var wtr2 = $('#wtr2').val();
	var wtr3 = $('#wtr3').val();

	var wa_2_1 = (((+wtr1) * (+wa_1_1)) / 100) + (+wa_1_1);
	var wa_2_2 = (((+wtr2) * (+wa_1_2)) / 100) + (+wa_1_2);
	var wa_2_3 = (((+wtr3) * (+wa_1_3)) / 100) + (+wa_1_3);

	$('#wa_2_1').val((+wa_2_1).toFixed(2));
	$('#wa_2_2').val((+wa_2_2).toFixed(2));
	$('#wa_2_3').val((+wa_2_3).toFixed(2));
}


$('#chk_wtr').change(function(){
    if(this.checked)
	{
		wtr_auto();
	}
	else
	{
		$('#txtwtr').css("background-color","white");	
		$('#wa_1_1').val(null);
		$('#wa_1_2').val(null);
		$('#wa_1_3').val(null);
		$('#wa_2_1').val(null);
		$('#wa_2_2').val(null);
		$('#wa_2_3').val(null);
		$('#wtr1').val(null);
		$('#wtr2').val(null);
		$('#wtr3').val(null);
		$('#avg_wtr').val(null);
	}
});


$('#wa_1_1, #wa_1_2, #wa_1_3, #wa_2_1, #wa_2_2, #wa_2_3').change(function(){
	var wa_1_1 = $('#wa_1_1').val();
	var wa_1_2 = $('#wa_1_2').val();
	var wa_1_3 = $('#wa_1_3').val();

	var wa_2_1 = $('#wa_2_1').val();
	var wa_2_2 = $('#wa_2_2').val();
	var wa_2_3 = $('#wa_2_3').val();
	
	var wtr1 = (((+wa_2_1) - (+wa_1_1)) * 100) / (+wa_1_1);
	var wtr2 = (((+wa_2_2) - (+wa_1_2)) * 100) / (+wa_1_2);
	var wtr3 = (((+wa_2_3) - (+wa_1_3)) * 100) / (+wa_1_3);
	
	$('#wtr1').val((+wtr1).toFixed(2));
	$('#wtr2').val((+wtr2).toFixed(2));
	$('#wtr3').val((+wtr3).toFixed(2));
	
	var wtr1 = $('#wtr1').val();
	var wtr2 = $('#wtr2').val();
	var wtr3 = $('#wtr3').val();
	
	var avg_wtr = ((+wtr1) + (+wtr2) + (+wtr3)) / 3;
	$('#avg_wtr').val((+avg_wtr).toFixed(2));
})

$('#avg_wtr').change(function(){
	$('#txtwtr').css("background-color","var(--success)");

	var avg_wtr = $('#avg_wtr').val();
	if((+randomNumberFromRange(1,9).toFixed())%2==0){
		var wtr1 = (+avg_wtr) + (+randomNumberFromRange(0.3,0.8).toFixed(1));
		var wtr2 = (+avg_wtr) - ((+wtr1) - (+avg_wtr));
		var wtr3 = (+avg_wtr);
	}else{
		var wtr1 = (+avg_wtr) - (+randomNumberFromRange(0.3,0.8).toFixed(1));
		var wtr2 = (+avg_wtr);
		var wtr3 = (+avg_wtr) + ((+avg_wtr) - (+wtr1));
	}
	
	$('#wtr1').val((+wtr1).toFixed(1));
	$('#wtr2').val((+wtr2).toFixed(1));
	$('#wtr3').val((+wtr3).toFixed(1));
	
	var wtr1 = $('#wtr1').val();
	var wtr2 = $('#wtr2').val();
	var wtr3 = $('#wtr3').val();
	var avg_wtr = ((+wtr1) + (+wtr2) + (+wtr3)) / 3;
	$('#avg_wtr').val((+avg_wtr).toFixed());

	var wa_1_1 = randomNumberFromRange(29.00,33.00).toFixed(2);
	var wa_1_2 = randomNumberFromRange(29.00,33.00).toFixed(2);
	var wa_1_3 = randomNumberFromRange(29.00,33.00).toFixed(2);
	$('#wa_1_1').val(wa_1_1);
	$('#wa_1_2').val(wa_1_2);
	$('#wa_1_3').val(wa_1_3);

	var wa_1_1 = $('#wa_1_1').val();
	var wa_1_2 = $('#wa_1_2').val();
	var wa_1_3 = $('#wa_1_3').val();

	var wtr1 = $('#wtr1').val();
	var wtr2 = $('#wtr2').val();
	var wtr3 = $('#wtr3').val();

	var wa_2_1 = (((+wtr1) * (+wa_1_1)) / 100) + (+wa_1_1);
	var wa_2_2 = (((+wtr2) * (+wa_1_2)) / 100) + (+wa_1_2);
	var wa_2_3 = (((+wtr3) * (+wa_1_3)) / 100) + (+wa_1_3);

	$('#wa_2_1').val((+wa_2_1).toFixed(2));
	$('#wa_2_2').val((+wa_2_2).toFixed(2));
	$('#wa_2_3').val((+wa_2_3).toFixed(2));
})





function den_auto()
{
	$('#txtden').css("background-color","var(--success)");	
	var avg_den = randomNumberFromRange(1880,2250).toFixed();
	$('#avg_den').val(avg_den);
	var avg_den = $('#avg_den').val();
	if((randomNumberFromRange(1,9).toFixed())%2==0){
		var den1 = (+avg_den) - (+randomNumberFromRange(15,20).toFixed());
		var den2 = (+avg_den) - 2;
		var den3 = (+avg_den) + ((+avg_den) - (+den1)) + 2;
	}else{
		var den1 = (+avg_den) + (+randomNumberFromRange(15,20).toFixed());
		var den2 = (+avg_den) + 3;
		var den3 = (+avg_den) - ((+den1) - (+avg_den)) - 3;
	}
	$('#den1').val(den1);
	$('#den2').val(den2);
	$('#den3').val(den3);
	var den_length = randomNumberFromRange(397.00,403.00).toFixed(2);
	var den_width = randomNumberFromRange(198.00,202.00).toFixed(2);
	var den_height = randomNumberFromRange(198.00,202.00).toFixed(2);
	if(($('#l1').val()) == "" || ($('#l1').val()) == "undefined"){
		var dl1 = (+den_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var dl2 = (+den_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var dl3 = (+den_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		
		var dw1 = (+den_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var dw2 = (+den_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var dw3 = (+den_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));

		var dh1 = (+den_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var dh2 = (+den_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var dh3 = (+den_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
	}else{
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var dl1 = $('#l1').val();
			var dl2 = $('#l2').val();
			var dl3 = $('#l3').val();
                
			var dw1 = $('#w1').val();
			var dw2 = $('#w2').val();
			var dw3 = $('#w3').val();
	            
			var dh1 = $('#h1').val();
			var dh2 = $('#h2').val();
			var dh3 = $('#h3').val();
		}else{
			var dl1 = $('#l13').val();
			var dl2 = $('#l14').val();
			var dl3 = $('#l15').val();
                
			var dw1 = $('#w13').val();
			var dw2 = $('#w14').val();
			var dw3 = $('#w15').val();
                
			var dh1 = $('#h18').val();
			var dh2 = $('#h19').val();
			var dh3 = $('#h20').val();
		}
	}
	
	$('#dl1').val((+dl1).toFixed(2));
	$('#dl2').val((+dl2).toFixed(2));
	$('#dl3').val((+dl3).toFixed(2));

	$('#dw1').val((+dw1).toFixed(2));
	$('#dw2').val((+dw2).toFixed(2));
	$('#dw3').val((+dw3).toFixed(2));

	$('#dh1').val((+dh1).toFixed(2));
	$('#dh2').val((+dh2).toFixed(2));
	$('#dh3').val((+dh3).toFixed(2));

	var dl1 = $('#dl1').val();
	var dl2 = $('#dl2').val();
	var dl3 = $('#dl3').val();
                  
	var dw1 = $('#dw1').val();
	var dw2 = $('#dw2').val();
	var dw3 = $('#dw3').val();
                  
	var dh1 = $('#dh1').val();
	var dh2 = $('#dh2').val();
	var dh3 = $('#dh3').val();

	var vol1 = ((+dl1) * (+dw1) * (+dh1)) / 1000000000; 
	var vol2 = ((+dl2) * (+dw2) * (+dh2)) / 1000000000; 
	var vol3 = ((+dl3) * (+dw3) * (+dh3)) / 1000000000; 
	$('#vol1').val((+vol1).toFixed(4));
	$('#vol2').val((+vol2).toFixed(4));
	$('#vol3').val((+vol3).toFixed(4));

	var vol1 = $('#vol1').val();
	var vol2 = $('#vol2').val();
	var vol3 = $('#vol3').val();
	
	var den1 = $('#den1').val();
	var den2 = $('#den2').val();
	var den3 = $('#den3').val();
	
	var fwet1 = (+den1) * (+vol1);
	var fwet2 = (+den2) * (+vol2);
	var fwet3 = (+den3) * (+vol3);

	$('#fwet1').val((+fwet1).toFixed(2));
	$('#fwet2').val((+fwet2).toFixed(2));
	$('#fwet3').val((+fwet3).toFixed(2));
	
	
}


$('#chk_den').change(function(){
    if(this.checked)
	{
		den_auto();
	}
	else
	{
		$('#txtden').css("background-color","white");	
		$('#den1').val(null);;
		$('#den2').val(null);;
		$('#den3').val(null);;
		$('#iwet1').val(null);;
		$('#iwet2').val(null);;
		$('#iwet3').val(null);;
		$('#fwet1').val(null);;
		$('#fwet2').val(null);;
		$('#fwet3').val(null);;
		$('#vol1').val(null);;
		$('#vol2').val(null);;
		$('#vol3').val(null);;
		$('#dl1').val(null);;
		$('#dl2').val(null);;
		$('#dl3').val(null);;
		$('#dw1').val(null);;
		$('#dw2').val(null);;
		$('#dw3').val(null);;
		$('#dh1').val(null);;
		$('#dh2').val(null);;
		$('#dh3').val(null);;
		$('#avg_den').val(null);
	}
		
});



$('#dl1,#dl2,#dl3,#dw1,#dw2,#dw3,#dh1,#dh2,#dh3,#fwet1,#fwet2,#fwet3').change(function(){
	var dl1 = $('#dl1').val();
	var dl2 = $('#dl2').val();
	var dl3 = $('#dl3').val();

	var dw1 = $('#dw1').val();
	var dw2 = $('#dw2').val();
	var dw3 = $('#dw3').val();
	
	var dh1 = $('#dh1').val();
	var dh2 = $('#dh2').val();
	var dh3 = $('#dh3').val();

	var vol1 = ((+dl1) * (+dw1) * (+dh1)) / 1000000000;
	var vol2 = ((+dl2) * (+dw2) * (+dh2)) / 1000000000;
	var vol3 = ((+dl3) * (+dw3) * (+dh3)) / 1000000000;
	
	$('#vol1').val((+vol1).toFixed(4));
	$('#vol2').val((+vol2).toFixed(4));
	$('#vol3').val((+vol3).toFixed(4));

	var vol1 = $('#vol1').val();
	var vol2 = $('#vol2').val();
	var vol3 = $('#vol3').val();

	var fwet1 = $('#fwet1').val();
	var fwet2 = $('#fwet2').val();
	var fwet3 = $('#fwet3').val();

	var den1 = (+fwet1) / (+vol1);
	var den2 = (+fwet2) / (+vol2);
	var den3 = (+fwet3) / (+vol3);
	$('#den1').val((+den1).toFixed());
	$('#den2').val((+den2).toFixed());
	$('#den3').val((+den3).toFixed());

	var den1 = $('#den1').val();
	var den2 = $('#den2').val();
	var den3 = $('#den3').val();
	
	var avg_den = ((+den1) + (+den2) + (+den3)) / 3;
	$('#avg_den').val((+avg_den).toFixed());

})

$('#avg_den').change(function(){
	$('#txtden').css("background-color","var(--success)");	
	var avg_den = $('#avg_den').val();
	if((randomNumberFromRange(1,9).toFixed())%2==0){
		var den1 = (+avg_den) - (+randomNumberFromRange(15,20).toFixed());
		var den2 = (+avg_den) - 2;
		var den3 = (+avg_den) + ((+avg_den) - (+den1)) + 2;
	}else{
		var den1 = (+avg_den) + (+randomNumberFromRange(15,20).toFixed());
		var den2 = (+avg_den) + 3;
		var den3 = (+avg_den) - ((+den1) - (+avg_den)) - 3;
	}
	$('#den1').val(den1);
	$('#den2').val(den2);
	$('#den3').val(den3);
	var den_length = randomNumberFromRange(397.00,403.00).toFixed(2);
	var den_width = randomNumberFromRange(198.00,202.00).toFixed(2);
	var den_height = randomNumberFromRange(198.00,202.00).toFixed(2);
	if(($('#l1').val()) == "" || ($('#l1').val()) == "undefined"){
		var dl1 = (+den_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var dl2 = (+den_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		var dl3 = (+den_length) + (+randomNumberFromRange(-4.00,4.00).toFixed(2));
		
		var dw1 = (+den_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var dw2 = (+den_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var dw3 = (+den_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));

		var dh1 = (+den_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var dh2 = (+den_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var dh3 = (+den_height) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
	}else{
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var dl1 = $('#l1').val();
			var dl2 = $('#l2').val();
			var dl3 = $('#l3').val();
                
			var dw1 = $('#w1').val();
			var dw2 = $('#w2').val();
			var dw3 = $('#w3').val();
	            
			var dh1 = $('#h1').val();
			var dh2 = $('#h2').val();
			var dh3 = $('#h3').val();
		}else{
			var dl1 = $('#l13').val();
			var dl2 = $('#l14').val();
			var dl3 = $('#l15').val();
                
			var dw1 = $('#w13').val();
			var dw2 = $('#w14').val();
			var dw3 = $('#w15').val();
                
			var dh1 = $('#h18').val();
			var dh2 = $('#h19').val();
			var dh3 = $('#h20').val();
		}
	}
	
	$('#dl1').val((+dl1).toFixed(2));
	$('#dl2').val((+dl2).toFixed(2));
	$('#dl3').val((+dl3).toFixed(2));

	$('#dw1').val((+dw1).toFixed(2));
	$('#dw2').val((+dw2).toFixed(2));
	$('#dw3').val((+dw3).toFixed(2));

	$('#dh1').val((+dh1).toFixed(2));
	$('#dh2').val((+dh2).toFixed(2));
	$('#dh3').val((+dh3).toFixed(2));

	var dl1 = $('#dl1').val();
	var dl2 = $('#dl2').val();
	var dl3 = $('#dl3').val();
                  
	var dw1 = $('#dw1').val();
	var dw2 = $('#dw2').val();
	var dw3 = $('#dw3').val();
                  
	var dh1 = $('#dh1').val();
	var dh2 = $('#dh2').val();
	var dh3 = $('#dh3').val();

	var vol1 = ((+dl1) * (+dw1) * (+dh1)) / 1000000000; 
	var vol2 = ((+dl2) * (+dw2) * (+dh2)) / 1000000000; 
	var vol3 = ((+dl3) * (+dw3) * (+dh3)) / 1000000000; 
	$('#vol1').val((+vol1).toFixed(4));
	$('#vol2').val((+vol2).toFixed(4));
	$('#vol3').val((+vol3).toFixed(4));

	var vol1 = $('#vol1').val();
	var vol2 = $('#vol2').val();
	var vol3 = $('#vol3').val();
	
	var den1 = $('#den1').val();
	var den2 = $('#den2').val();
	var den3 = $('#den3').val();
	
	var fwet1 = (+den1) * (+vol1);
	var fwet2 = (+den2) * (+vol2);
	var fwet3 = (+den3) * (+vol3);

	$('#fwet1').val((+fwet1).toFixed(2));
	$('#fwet2').val((+fwet2).toFixed(2));
	$('#fwet3').val((+fwet3).toFixed(2));
})

	
function randomNumberFromRange(min,max)
{
	//return Math.floor(Math.random()*(max-min+1)+min);
	return Math.random() * (max - min) + min;
}
	
$('#chk_auto').change(function(){
    if(this.checked)
	{
		var temp = $('#test_list').val();
		var aa= temp.split(",");

		//DIMENTION
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="DIM")
			{
				$('#txtdim').css("background-color","var(--success)");
				$("#chk_dim").prop("checked", true); 
				dim_auto();
				break;
			}					
		}
		
		//Compressive Strength
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="com")
			{
				$('#txtcom').css("background-color","var(--success)");
				$("#chk_com").prop("checked", true); 
				com_auto();
				break;
			}					
		}
		
		//DRYING SHRINKAGE
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="SHR")
			{
				$('#txtshr').css("background-color","var(--success)");
				$("#chk_shr").prop("checked", true); 
				shr_auto();
				break;
			}					
		}
		
		
		
		//WATER ABSORPTION
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="WTR")
			{
				$('#txtwtr').css("background-color","var(--success)");
				$("#chk_wtr").prop("checked", true); 
				wtr_auto();
				break;
			}					
		}
		
		//DRY DENSITY
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="DEN")
			{
				$('#txtden').css("background-color","var(--success)");
				$("#chk_den").prop("checked", true); 
				den_auto();
				break;
			}					
		}
		
		
		
	}
		
	});
});


	
	
		$("#btn_upload_excel").click(function()
		{
			form_data = new FormData();
				var acb = $('#upload_excel').val();
			if(acb ==""){
				alert("Upload excel First");
				return false;
			}
				var lab_no = "<?php echo $lab_no;?>";
				var job_no = "<?php echo $job_no_main;?>";
				var report_no = "<?php echo $report_no;?>";
				
				var file_data = $('#upload_excel').prop('files')[0];
				var form_data = new FormData();  // Create a FormData object
				form_data.append('file', file_data);  // Append all element in FormData  object
				form_data.append('lab_no', lab_no);  // Append all element in FormData  object
				form_data.append('job_no', job_no);  // Append all element in FormData  object
				form_data.append('report_no', report_no);  // Append all element in FormData  object

				$.ajax({
					url         : '<?php $base_url; ?>excel_upload_test.php',     // point to server-side PHP script 
					dataType    : 'text',           // what to expect back from the PHP script, if anything
					cache       : false,
					contentType : false,
					processData : false,
					data        : form_data,                         
					type        : 'post',
					success     : function(output){
					get_excel_record();            // display response from the PHP script, if any
					}
			 });
			 $('#upload_excel').val('');   
				
			
		});
		function get_excel_record()
		{
			var lab_no = "<?php echo $lab_no;?>";
			var job_no = "<?php echo $job_no_main;?>";
			var report_no = "<?php echo $report_no;?>";
			$.ajax({
				type: 'POST',
				url: '<?php echo $base_url; ?>excel_upload_test.php',
				data: 'action_type=get_excel_record&lab_no='+lab_no+'&job_no='+job_no+'&report_no='+report_no,
				success:function(html){
					$('#view_excel_from_table').html(html);

				}
			});	
		}	
		
			$("#btn_edit_data").click(function(){
			$('#btn_edit_data').hide();

	});
function getGlazedTiles(){
				var lab_no = $('#lab_no').val(); 
				var report_no = $('#report_no').val(); 
				var job_no=$('#job_no').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_solid_cocrete.php',
		data: 'action_type=view&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
		success:function(html){
		$('#display_data').html(html);

        }
    });
}

function saveMetal(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var tank_no = $('#tank_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var bitumin_make = $('#bitumin_make').val();
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//COMPRESSIVE STRENGTH
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						if(document.getElementById('chk_com').checked) {
								var chk_com = "1";
						}
						else{
								var chk_com = "0";
						}	
						
						var i1 = $('#i1').val();
						var i2 = $('#i2').val();
						var i3 = $('#i3').val();
						var i4 = $('#i4').val();
						var i5 = $('#i5').val();
						var i6 = $('#i6').val();
						var i7 = $('#i7').val();
						var i8 = $('#i8').val();
						var length1 = $('#length1').val();
						var length2 = $('#length2').val();
						var length3 = $('#length3').val();
						var length4 = $('#length4').val();
						var length5 = $('#length5').val();
						var length6 = $('#length6').val();
						var length7 = $('#length7').val();
						var length8 = $('#length8').val();
						var width1 = $('#width1').val();
						var width2 = $('#width2').val();
						var width3 = $('#width3').val();
						var width4 = $('#width4').val();
						var width5 = $('#width5').val();
						var width6 = $('#width6').val();
						var width7 = $('#width7').val();
						var width8 = $('#width8').val();
						var area1 = $('#area1').val();
						var area2 = $('#area2').val();
						var area3 = $('#area3').val();
						var area4 = $('#area4').val();
						var area5 = $('#area5').val();
						var area6 = $('#area6').val();
						var area7 = $('#area7').val();
						var area8 = $('#area8').val();
						var load1 = $('#load1').val();
						var load2 = $('#load2').val();
						var load3 = $('#load3').val();
						var load4 = $('#load4').val();
						var load5 = $('#load5').val();
						var load6 = $('#load6').val();
						var load7 = $('#load7').val();
						var load8 = $('#load8').val();
						var str1 = $('#str1').val();
						var str2 = $('#str2').val();
						var str3 = $('#str3').val();
						var str4 = $('#str4').val();
						var str5 = $('#str5').val();
						var str6 = $('#str6').val();
						var str7 = $('#str7').val();
						var str8 = $('#str8').val();
						var avg_str = $('#avg_str').val();
						
						break;
					}
					else
					{
						var chk_com = "0";
						var i1 = "0";
						var i2 = "0";
						var i3 = "0";
						var i4 = "0";
						var i5 = "0";
						var i6 = "0";
						var i7 = "0";
						var i8 = "0";
						var length1 = "0";
						var length2 = "0";
						var length3 = "0";
						var length4 = "0";
						var length5 = "0";
						var length6 = "0";
						var length7 = "0";
						var length8 = "0";
						var width1 = "0";
						var width2 = "0";
						var width3 = "0";
						var width4 = "0";
						var width5 = "0";
						var width6 = "0";
						var width7 = "0";
						var width8 = "0";
						var area1 = "0";
						var area2 = "0";
						var area3 = "0";
						var area4 = "0";
						var area5 = "0";
						var area6 = "0";
						var area7 = "0";
						var area8 = "0";
						var load1 = "0";
						var load2 = "0";
						var load3 = "0";
						var load4 = "0";
						var load5 = "0";
						var load6 = "0";
						var load7 = "0";
						var load8 = "0";
						var str1 = "0";
						var str2 = "0";
						var str3 = "0";
						var str4 = "0";
						var str5 = "0";
						var str6 = "0";
						var str7 = "0";
						var str8 = "0";
						var avg_str = "0";

						
					}
				}
				
				//DRYING SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="SHR")
					{
						if(document.getElementById('chk_shr').checked) {
							var chk_shr = "1";
						}
						else{
							var chk_shr = "0";
						}	
							var r1_1 = $('#r1_1').val();
							var r1_2 = $('#r1_2').val();
							var r1_3 = $('#r1_3').val();
							var r1_4 = $('#r1_4').val();
							var r1_5 = $('#r1_5').val();
							var r1_6 = $('#r1_6').val();
							var r2_1 = $('#r2_1').val();
							var r2_2 = $('#r2_2').val();
							var r2_3 = $('#r2_3').val();
							var r2_4 = $('#r2_4').val();
							var r2_5 = $('#r2_5').val();
							var r2_6 = $('#r2_6').val();
							var r3_1 = $('#r3_1').val();
							var r3_2 = $('#r3_2').val();
							var r3_3 = $('#r3_3').val();
							var r3_4 = $('#r3_4').val();
							var r3_5 = $('#r3_5').val();
							var r3_6 = $('#r3_6').val();
							var r4_1 = $('#r4_1').val();
							var r4_2 = $('#r4_2').val();
							var r4_3 = $('#r4_3').val();
							var r4_4 = $('#r4_4').val();
							var r4_5 = $('#r4_5').val();
							var r4_6 = $('#r4_6').val();
							var r5_1 = $('#r5_1').val();
							var r5_2 = $('#r5_2').val();
							var r5_3 = $('#r5_3').val();
							var r5_4 = $('#r5_4').val();
							var r5_5 = $('#r5_5').val();
							var r5_6 = $('#r5_6').val();
							var r6_1 = $('#r6_1').val();
							var r6_2 = $('#r6_2').val();
							var r6_3 = $('#r6_3').val();
							var r6_4 = $('#r6_4').val();
							var r6_5 = $('#r6_5').val();
							var r6_6 = $('#r6_6').val();
							var r7_1 = $('#r7_1').val();
							var r7_2 = $('#r7_2').val();
							var r7_3 = $('#r7_3').val();
							var r7_4 = $('#r7_4').val();
							var r7_5 = $('#r7_5').val();
							var r7_6 = $('#r7_6').val();
							var dry1 = $('#dry1').val();
							var dry2 = $('#dry2').val();
							var dry3 = $('#dry3').val();
							var dry4 = $('#dry4').val();
							var dry5 = $('#dry5').val();
							var dry6 = $('#dry6').val();
							var avg_dry = $('#avg_dry').val();
							var age1_1 = $('#age1_1').val();
							var age1_2 = $('#age1_2').val();
							var age1_3 = $('#age1_3').val();
							var age2_1 = $('#age2_1').val();
							var age2_2 = $('#age2_2').val();
							var age2_3 = $('#age2_3').val();
							var avg_mo = $('#avg_mo').val();
							var r1_date = $('#r1_date').val();
							var r2_date = $('#r2_date').val();
							var r3_date = $('#r3_date').val();
							var r4_date = $('#r4_date').val();
							var r5_date = $('#r5_date').val();
							var r6_date = $('#r6_date').val();
							var r7_date = $('#r7_date').val();
						
						break;
					}
					else
					{
						var chk_shr = "0";
						var r1_1 = "0";
						var r1_2 = "0";
						var r1_3 = "0";
						var r1_4 = "0";
						var r1_5 = "0";
						var r1_6 = "0";
						var r2_1 = "0";
						var r2_2 = "0";
						var r2_3 = "0";
						var r2_4 = "0";
						var r2_5 = "0";
						var r2_6 = "0";
						var r3_1 = "0";
						var r3_2 = "0";
						var r3_3 = "0";
						var r3_4 = "0";
						var r3_5 = "0";
						var r3_6 = "0";
						var r4_1 = "0";
						var r4_2 = "0";
						var r4_3 = "0";
						var r4_4 = "0";
						var r4_5 = "0";
						var r4_6 = "0";
						var r5_1 = "0";
						var r5_2 = "0";
						var r5_3 = "0";
						var r5_4 = "0";
						var r5_5 = "0";
						var r5_6 = "0";
						var r6_1 = "0";
						var r6_2 = "0";
						var r6_3 = "0";
						var r6_4 = "0";
						var r6_5 = "0";
						var r6_6 = "0";
						var r7_1 = "0";
						var r7_2 = "0";
						var r7_3 = "0";
						var r7_4 = "0";
						var r7_5 = "0";
						var r7_6 = "0";
						var dry1 = "0";
						var dry2 = "0";
						var dry3 = "0";
						var dry4 = "0";
						var dry5 = "0";
						var dry6 = "0";
						var avg_dry = "0";;
						var age1_1 = "0";
						var age1_2 = "0";
						var age1_3 = "0";
						var age2_1 = "0";
						var age2_2 = "0";
						var age2_3 = "0";
						var avg_mo = "0";
						var r1_date = "0";
						var r2_date = "0";
						var r3_date = "0";
						var r4_date = "0";
						var r5_date = "0";
						var r6_date = "0";
						var r7_date = "0";
					}
				}
				
				//DIMENTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="DIM")
					{
						if(document.getElementById('chk_dim').checked) {
								var chk_dim = "1";
						}
						else{
								var chk_dim = "0";
						}	
							var l1 = $('#l1').val();
							var l2 = $('#l2').val();
							var l3 = $('#l3').val();
							var l4 = $('#l4').val();
							var l5 = $('#l5').val();
							var l6 = $('#l6').val();
							var l7 = $('#l7').val();
							var l8 = $('#l8').val();
							var l9 = $('#l9').val();
							var l10 = $('#l10').val();
							var l11 = $('#l11').val();
							var l12 = $('#l12').val();
							var l13 = $('#l13').val();
							var l14 = $('#l14').val();
							var l15 = $('#l15').val();
							var l16 = $('#l16').val();
							var l17 = $('#l17').val();
							var l18 = $('#l18').val();
							var l19 = $('#l19').val();
							var l20 = $('#l20').val();
							var w1 = $('#w1').val();
							var w2 = $('#w2').val();
							var w3 = $('#w3').val();
							var w4 = $('#w4').val();
							var w5 = $('#w5').val();
							var w6 = $('#w6').val();
							var w7 = $('#w7').val();
							var w8 = $('#w8').val();
							var w9 = $('#w9').val();
							var w10 = $('#w10').val();
							var w11 = $('#w11').val();
							var w12 = $('#w12').val();
							var w13 = $('#w13').val();
							var w14 = $('#w14').val();
							var w15 = $('#w15').val();
							var w16 = $('#w16').val();
							var w17 = $('#w17').val();
							var w18 = $('#w18').val();
							var w19 = $('#w19').val();
							var w20 = $('#w20').val();
							var h1 = $('#h1').val();
							var h2 = $('#h2').val();
							var h3 = $('#h3').val();
							var h4 = $('#h4').val();
							var h5 = $('#h5').val();
							var h6 = $('#h6').val();
							var h7 = $('#h7').val();
							var h8 = $('#h8').val();
							var h9 = $('#h9').val();
							var h10 = $('#h10').val();
							var h11 = $('#h11').val();
							var h12 = $('#h12').val();
							var h13 = $('#h13').val();
							var h14 = $('#h14').val();
							var h15 = $('#h15').val();
							var h16 = $('#h16').val();
							var h17 = $('#h17').val();
							var h18 = $('#h18').val();
							var h19 = $('#h19').val();
							var h20 = $('#h20').val();
							var avg_length = $('#avg_length').val();
							var avg_width = $('#avg_width').val();
							var avg_height = $('#avg_height').val();
						break;
					}
					else
					{
						var chk_dim = "0";
						var l1 = "0";
						var l2 = "0";
						var l3 = "0";
						var l4 = "0";
						var l5 = "0";
						var l6 = "0";
						var l7 = "0";
						var l8 = "0";
						var l9 = "0";
						var l10 = "0";
						var l11 = "0";
						var l12 = "0";
						var l13 = "0";
						var l14 = "0";
						var l15 = "0";
						var l16 = "0";
						var l17 = "0";
						var l18 = "0";
						var l19 = "0";
						var l20 = "0";
						var w1 = "0";
						var w2 = "0";
						var w3 = "0";
						var w4 = "0";
						var w5 = "0";
						var w6 = "0";
						var w7 = "0";
						var w8 = "0";
						var w9 = "0";
						var w10 = "0";
						var w11 = "0";
						var w12 = "0";
						var w13 = "0";
						var w14 = "0";
						var w15 = "0";
						var w16 = "0";
						var w17 = "0";
						var w18 = "0";
						var w19 = "0";
						var w20 = "0";
						var h1 = "0";
						var h2 = "0";
						var h3 = "0";
						var h4 = "0";
						var h5 = "0";
						var h6 = "0";
						var h7 = "0";
						var h8 = "0";
						var h9 = "0";
						var h10 = "0";
						var h11 = "0";
						var h12 = "0";
						var h13 = "0";
						var h14 = "0";
						var h15 = "0";
						var h16 = "0";
						var h17 = "0";
						var h18 = "0";
						var h19 = "0";
						var h20 = "0";
						var avg_length = "0";
						var avg_width = "0";
						var avg_height = "0";
						
					}
				}
				
				//WATER ABSORPTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="WTR")
					{
						if(document.getElementById('chk_wtr').checked) {
							var chk_wtr = "1";
						}
						else{
							var chk_wtr = "0";
						}	
							var wa_1_1 = $('#wa_1_1').val();
							var wa_1_2 = $('#wa_1_2').val();
							var wa_1_3 = $('#wa_1_3').val();
							var wa_2_1 = $('#wa_2_1').val();
							var wa_2_2 = $('#wa_2_2').val();
							var wa_2_3 = $('#wa_2_3').val();
							var wtr1 = $('#wtr1').val();
							var wtr2 = $('#wtr2').val();
							var wtr3 = $('#wtr3').val();
							var avg_wtr = $('#avg_wtr').val();
							
						break;
					}
					else
					{
						var chk_wtr = "0";
						var wa_1_1 = "0";
						var wa_1_2 = "0";
						var wa_1_3 = "0";
						var wa_2_1 = "0";
						var wa_2_2 = "0";
						var wa_2_3 = "0";
						var wtr1 = "0";
						var wtr2 = "0";
						var wtr3 = "0";
						var avg_wtr = "0";
						
					}
				}
			
				//DRY DENSITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="DEN")
					{
						if(document.getElementById('chk_den').checked) {
							var chk_den = "1";
						}
						else{
							var chk_den = "0";
						}	
							var den1 = $('#den1').val();
							var den2 = $('#den2').val();
							var den3 = $('#den3').val();
							var iwet1 = $('#iwet1').val();
							var iwet2 = $('#iwet2').val();
							var iwet3 = $('#iwet3').val();
							var fwet1 = $('#fwet1').val();
							var fwet2 = $('#fwet2').val();
							var fwet3 = $('#fwet3').val();
							var vol1 = $('#vol1').val();
							var vol2 = $('#vol2').val();
							var vol3 = $('#vol3').val();
							var dl1 = $('#dl1').val();
							var dl2 = $('#dl2').val();
							var dl3 = $('#dl3').val();
							var dw1 = $('#dw1').val();
							var dw2 = $('#dw2').val();
							var dw3 = $('#dw3').val();
							var dh1 = $('#dh1').val();
							var dh2 = $('#dh2').val();
							var dh3 = $('#dh3').val();
							var avg_den = $('#avg_den').val();
						
						break;
					}
					else
					{
						var chk_den = "0";
						var den1 = "0";
						var den2 = "0";
						var den3 = "0";
						var iwet1 = "0";
						var iwet2 = "0";
						var iwet3 = "0";
						var fwet1 = "0";
						var fwet2 = "0";
						var fwet3 = "0";
						var vol1 = "0";
						var vol2 = "0";
						var vol3 = "0";
						var dl1 = "0";
						var dl2 = "0";
						var dl3 = "0";
						var dw1 = "0";
						var dw2 = "0";
						var dw3 = "0";
						var dh1 = "0";
						var dh2 = "0";
						var dh3 = "0";
						var avg_den = "0";

						
					}
				}
			
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&ulr='+ulr+'&chk_com='+chk_com+'&i1='+i1+'&i2='+i2+'&i3='+i3+'&i4='+i4+'&i5='+i5+'&i6='+i6+'&i7='+i7+'&i8='+i8+'&length1='+length1+'&length2='+length2+'&length3='+length3+'&length4='+length4+'&length5='+length5+'&length6='+length6+'&length7='+length7+'&length8='+length8+'&width1='+width1+'&width2='+width2+'&width3='+width3+'&width4='+width4+'&width5='+width5+'&width6='+width6+'&width7='+width7+'&width8='+width8+'&area1='+area1+'&area2='+area2+'&area3='+area3+'&area4='+area4+'&area5='+area5+'&area6='+area6+'&area7='+area7+'&area8='+area8+'&load1='+load1+'&load2='+load2+'&load3='+load3+'&load4='+load4+'&load5='+load5+'&load6='+load6+'&load7='+load7+'&load8='+load8+'&str1='+str1+'&str2='+str2+'&str3='+str3+'&str4='+str4+'&str5='+str5+'&str6='+str6+'&str7='+str7+'&str8='+str8+'&avg_str='+avg_str+'&chk_shr='+chk_shr+'&r1_1='+r1_1+'&r1_2='+r1_2+'&r1_3='+r1_3+'&r1_4='+r1_4+'&r1_5='+r1_5+'&r1_6='+r1_6+'&r2_1='+r2_1+'&r2_2='+r2_2+'&r2_3='+r2_3+'&r2_4='+r2_4+'&r2_5='+r2_5+'&r2_6='+r2_6+'&r3_1='+r3_1+'&r3_2='+r3_2+'&r3_3='+r3_3+'&r3_4='+r3_4+'&r3_5='+r3_5+'&r3_6='+r3_6+'&r4_1='+r4_1+'&r4_2='+r4_2+'&r4_3='+r4_3+'&r4_4='+r4_4+'&r4_5='+r4_5+'&r4_6='+r4_6+'&r5_1='+r5_1+'&r5_2='+r5_2+'&r5_3='+r5_3+'&r5_4='+r5_4+'&r5_5='+r5_5+'&r5_6='+r5_6+'&r6_1='+r6_1+'&r6_2='+r6_2+'&r6_3='+r6_3+'&r6_4='+r6_4+'&r6_5='+r6_5+'&r6_6='+r6_6+'&r7_1='+r7_1+'&r7_2='+r7_2+'&r7_3='+r7_3+'&r7_4='+r7_4+'&r7_5='+r7_5+'&r7_6='+r7_6+'&dry1='+dry1+'&dry2='+dry2+'&dry3='+dry3+'&dry4='+dry4+'&dry5='+dry5+'&dry6='+dry6+'&avg_dry='+avg_dry+'&age1_1='+age1_1+'&age1_2='+age1_2+'&age1_3='+age1_3+'&age2_1='+age2_1+'&age2_2='+age2_2+'&age2_3='+age2_3+'&avg_mo='+avg_mo+'&chk_dim='+chk_dim+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&l6='+l6+'&l7='+l7+'&l8='+l8+'&l9='+l9+'&l10='+l10+'&l11='+l11+'&l12='+l12+'&l13='+l13+'&l14='+l14+'&l15='+l15+'&l16='+l16+'&l17='+l17+'&l18='+l18+'&l19='+l19+'&l20='+l20+'&w1='+w1+'&w2='+w2+'&w3='+w3+'&w4='+w4+'&w5='+w5+'&w6='+w6+'&w7='+w7+'&w8='+w8+'&w9='+w9+'&w10='+w10+'&w11='+w11+'&w12='+w12+'&w13='+w13+'&w14='+w14+'&w15='+w15+'&w16='+w16+'&w17='+w17+'&w18='+w18+'&w19='+w19+'&w20='+w20+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&h4='+h4+'&h5='+h5+'&h6='+h6+'&h7='+h7+'&h8='+h8+'&h9='+h9+'&h10='+h10+'&h11='+h11+'&h12='+h12+'&h13='+h13+'&h14='+h14+'&h15='+h15+'&h16='+h16+'&h17='+h17+'&h18='+h18+'&h19='+h19+'&h20='+h20+'&chk_wtr='+chk_wtr+'&wa_1_1='+wa_1_1+'&wa_1_2='+wa_1_2+'&wa_1_3='+wa_1_3+'&wa_2_1='+wa_2_1+'&wa_2_2='+wa_2_2+'&wa_2_3='+wa_2_3+'&wtr1='+wtr1+'&wtr2='+wtr2+'&wtr3='+wtr3+'&avg_wtr='+avg_wtr+'&chk_den='+chk_den+'&den1='+den1+'&den2='+den2+'&den3='+den3+'&iwet1='+iwet1+'&iwet2='+iwet2+'&iwet3='+iwet3+'&fwet1='+fwet1+'&fwet2='+fwet2+'&fwet3='+fwet3+'&vol1='+vol1+'&vol2='+vol2+'&vol3='+vol3+'&dl1='+dl1+'&dl2='+dl2+'&dl3='+dl3+'&dw1='+dw1+'&dw2='+dw2+'&dw3='+dw3+'&dh1='+dh1+'&dh2='+dh2+'&dh3='+dh3+'&avg_den='+avg_den+'&r1_date='+r1_date+'&r2_date='+r2_date+'&r3_date='+r3_date+'&r4_date='+r4_date+'&r5_date='+r5_date+'&r6_date='+r6_date+'&r7_date='+r7_date+'&avg_length='+avg_length+'&avg_width='+avg_width+'&avg_height='+avg_height+'&amend_date='+amend_date;
						
	}
	else if (type == 'edit'){
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var tank_no = $('#tank_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var bitumin_make = $('#bitumin_make').val();
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//COMPRESSIVE STRENGTH
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						if(document.getElementById('chk_com').checked) {
								var chk_com = "1";
						}
						else{
								var chk_com = "0";
						}	
						
						var i1 = $('#i1').val();
						var i2 = $('#i2').val();
						var i3 = $('#i3').val();
						var i4 = $('#i4').val();
						var i5 = $('#i5').val();
						var i6 = $('#i6').val();
						var i7 = $('#i7').val();
						var i8 = $('#i8').val();
						var length1 = $('#length1').val();
						var length2 = $('#length2').val();
						var length3 = $('#length3').val();
						var length4 = $('#length4').val();
						var length5 = $('#length5').val();
						var length6 = $('#length6').val();
						var length7 = $('#length7').val();
						var length8 = $('#length8').val();
						var width1 = $('#width1').val();
						var width2 = $('#width2').val();
						var width3 = $('#width3').val();
						var width4 = $('#width4').val();
						var width5 = $('#width5').val();
						var width6 = $('#width6').val();
						var width7 = $('#width7').val();
						var width8 = $('#width8').val();
						var area1 = $('#area1').val();
						var area2 = $('#area2').val();
						var area3 = $('#area3').val();
						var area4 = $('#area4').val();
						var area5 = $('#area5').val();
						var area6 = $('#area6').val();
						var area7 = $('#area7').val();
						var area8 = $('#area8').val();
						var load1 = $('#load1').val();
						var load2 = $('#load2').val();
						var load3 = $('#load3').val();
						var load4 = $('#load4').val();
						var load5 = $('#load5').val();
						var load6 = $('#load6').val();
						var load7 = $('#load7').val();
						var load8 = $('#load8').val();
						var str1 = $('#str1').val();
						var str2 = $('#str2').val();
						var str3 = $('#str3').val();
						var str4 = $('#str4').val();
						var str5 = $('#str5').val();
						var str6 = $('#str6').val();
						var str7 = $('#str7').val();
						var str8 = $('#str8').val();
						var avg_str = $('#avg_str').val();
						
						break;
					}
					else
					{
						var chk_com = "0";
						var i1 = "0";
						var i2 = "0";
						var i3 = "0";
						var i4 = "0";
						var i5 = "0";
						var i6 = "0";
						var i7 = "0";
						var i8 = "0";
						var length1 = "0";
						var length2 = "0";
						var length3 = "0";
						var length4 = "0";
						var length5 = "0";
						var length6 = "0";
						var length7 = "0";
						var length8 = "0";
						var width1 = "0";
						var width2 = "0";
						var width3 = "0";
						var width4 = "0";
						var width5 = "0";
						var width6 = "0";
						var width7 = "0";
						var width8 = "0";
						var area1 = "0";
						var area2 = "0";
						var area3 = "0";
						var area4 = "0";
						var area5 = "0";
						var area6 = "0";
						var area7 = "0";
						var area8 = "0";
						var load1 = "0";
						var load2 = "0";
						var load3 = "0";
						var load4 = "0";
						var load5 = "0";
						var load6 = "0";
						var load7 = "0";
						var load8 = "0";
						var str1 = "0";
						var str2 = "0";
						var str3 = "0";
						var str4 = "0";
						var str5 = "0";
						var str6 = "0";
						var str7 = "0";
						var str8 = "0";
						var avg_str = "0";

						
					}
				}
				
				//DRYING SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="SHR")
					{
						if(document.getElementById('chk_shr').checked) {
							var chk_shr = "1";
						}
						else{
							var chk_shr = "0";
						}	
							var r1_1 = $('#r1_1').val();
							var r1_2 = $('#r1_2').val();
							var r1_3 = $('#r1_3').val();
							var r1_4 = $('#r1_4').val();
							var r1_5 = $('#r1_5').val();
							var r1_6 = $('#r1_6').val();
							var r2_1 = $('#r2_1').val();
							var r2_2 = $('#r2_2').val();
							var r2_3 = $('#r2_3').val();
							var r2_4 = $('#r2_4').val();
							var r2_5 = $('#r2_5').val();
							var r2_6 = $('#r2_6').val();
							var r3_1 = $('#r3_1').val();
							var r3_2 = $('#r3_2').val();
							var r3_3 = $('#r3_3').val();
							var r3_4 = $('#r3_4').val();
							var r3_5 = $('#r3_5').val();
							var r3_6 = $('#r3_6').val();
							var r4_1 = $('#r4_1').val();
							var r4_2 = $('#r4_2').val();
							var r4_3 = $('#r4_3').val();
							var r4_4 = $('#r4_4').val();
							var r4_5 = $('#r4_5').val();
							var r4_6 = $('#r4_6').val();
							var r5_1 = $('#r5_1').val();
							var r5_2 = $('#r5_2').val();
							var r5_3 = $('#r5_3').val();
							var r5_4 = $('#r5_4').val();
							var r5_5 = $('#r5_5').val();
							var r5_6 = $('#r5_6').val();
							var r6_1 = $('#r6_1').val();
							var r6_2 = $('#r6_2').val();
							var r6_3 = $('#r6_3').val();
							var r6_4 = $('#r6_4').val();
							var r6_5 = $('#r6_5').val();
							var r6_6 = $('#r6_6').val();
							var r7_1 = $('#r7_1').val();
							var r7_2 = $('#r7_2').val();
							var r7_3 = $('#r7_3').val();
							var r7_4 = $('#r7_4').val();
							var r7_5 = $('#r7_5').val();
							var r7_6 = $('#r7_6').val();
							var dry1 = $('#dry1').val();
							var dry2 = $('#dry2').val();
							var dry3 = $('#dry3').val();
							var dry4 = $('#dry4').val();
							var dry5 = $('#dry5').val();
							var dry6 = $('#dry6').val();
							var avg_dry = $('#avg_dry').val();
							var age1_1 = $('#age1_1').val();
							var age1_2 = $('#age1_2').val();
							var age1_3 = $('#age1_3').val();
							var age2_1 = $('#age2_1').val();
							var age2_2 = $('#age2_2').val();
							var age2_3 = $('#age2_3').val();
							var avg_mo = $('#avg_mo').val();
							var r1_date = $('#r1_date').val();
							var r2_date = $('#r2_date').val();
							var r3_date = $('#r3_date').val();
							var r4_date = $('#r4_date').val();
							var r5_date = $('#r5_date').val();
							var r6_date = $('#r6_date').val();
							var r7_date = $('#r7_date').val();
						
						break;
					}
					else
					{
						var chk_shr = "0";
						var r1_1 = "0";
						var r1_2 = "0";
						var r1_3 = "0";
						var r1_4 = "0";
						var r1_5 = "0";
						var r1_6 = "0";
						var r2_1 = "0";
						var r2_2 = "0";
						var r2_3 = "0";
						var r2_4 = "0";
						var r2_5 = "0";
						var r2_6 = "0";
						var r3_1 = "0";
						var r3_2 = "0";
						var r3_3 = "0";
						var r3_4 = "0";
						var r3_5 = "0";
						var r3_6 = "0";
						var r4_1 = "0";
						var r4_2 = "0";
						var r4_3 = "0";
						var r4_4 = "0";
						var r4_5 = "0";
						var r4_6 = "0";
						var r5_1 = "0";
						var r5_2 = "0";
						var r5_3 = "0";
						var r5_4 = "0";
						var r5_5 = "0";
						var r5_6 = "0";
						var r6_1 = "0";
						var r6_2 = "0";
						var r6_3 = "0";
						var r6_4 = "0";
						var r6_5 = "0";
						var r6_6 = "0";
						var r7_1 = "0";
						var r7_2 = "0";
						var r7_3 = "0";
						var r7_4 = "0";
						var r7_5 = "0";
						var r7_6 = "0";
						var dry1 = "0";
						var dry2 = "0";
						var dry3 = "0";
						var dry4 = "0";
						var dry5 = "0";
						var dry6 = "0";
						var avg_dry = "0";;
						var age1_1 = "0";
						var age1_2 = "0";
						var age1_3 = "0";
						var age2_1 = "0";
						var age2_2 = "0";
						var age2_3 = "0";
						var avg_mo = "0";
						var r1_date = "0";
						var r2_date = "0";
						var r3_date = "0";
						var r4_date = "0";
						var r5_date = "0";
						var r6_date = "0";
						var r7_date = "0";
					}
				}
				
				//DIMENTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="DIM")
					{
						if(document.getElementById('chk_dim').checked) {
								var chk_dim = "1";
						}
						else{
								var chk_dim = "0";
						}	
							var l1 = $('#l1').val();
							var l2 = $('#l2').val();
							var l3 = $('#l3').val();
							var l4 = $('#l4').val();
							var l5 = $('#l5').val();
							var l6 = $('#l6').val();
							var l7 = $('#l7').val();
							var l8 = $('#l8').val();
							var l9 = $('#l9').val();
							var l10 = $('#l10').val();
							var l11 = $('#l11').val();
							var l12 = $('#l12').val();
							var l13 = $('#l13').val();
							var l14 = $('#l14').val();
							var l15 = $('#l15').val();
							var l16 = $('#l16').val();
							var l17 = $('#l17').val();
							var l18 = $('#l18').val();
							var l19 = $('#l19').val();
							var l20 = $('#l20').val();
							var w1 = $('#w1').val();
							var w2 = $('#w2').val();
							var w3 = $('#w3').val();
							var w4 = $('#w4').val();
							var w5 = $('#w5').val();
							var w6 = $('#w6').val();
							var w7 = $('#w7').val();
							var w8 = $('#w8').val();
							var w9 = $('#w9').val();
							var w10 = $('#w10').val();
							var w11 = $('#w11').val();
							var w12 = $('#w12').val();
							var w13 = $('#w13').val();
							var w14 = $('#w14').val();
							var w15 = $('#w15').val();
							var w16 = $('#w16').val();
							var w17 = $('#w17').val();
							var w18 = $('#w18').val();
							var w19 = $('#w19').val();
							var w20 = $('#w20').val();
							var h1 = $('#h1').val();
							var h2 = $('#h2').val();
							var h3 = $('#h3').val();
							var h4 = $('#h4').val();
							var h5 = $('#h5').val();
							var h6 = $('#h6').val();
							var h7 = $('#h7').val();
							var h8 = $('#h8').val();
							var h9 = $('#h9').val();
							var h10 = $('#h10').val();
							var h11 = $('#h11').val();
							var h12 = $('#h12').val();
							var h13 = $('#h13').val();
							var h14 = $('#h14').val();
							var h15 = $('#h15').val();
							var h16 = $('#h16').val();
							var h17 = $('#h17').val();
							var h18 = $('#h18').val();
							var h19 = $('#h19').val();
							var h20 = $('#h20').val();
							var avg_length = $('#avg_length').val();
							var avg_width = $('#avg_width').val();
							var avg_height = $('#avg_height').val();
						break;
					}
					else
					{
						var chk_dim = "0";
						var l1 = "0";
						var l2 = "0";
						var l3 = "0";
						var l4 = "0";
						var l5 = "0";
						var l6 = "0";
						var l7 = "0";
						var l8 = "0";
						var l9 = "0";
						var l10 = "0";
						var l11 = "0";
						var l12 = "0";
						var l13 = "0";
						var l14 = "0";
						var l15 = "0";
						var l16 = "0";
						var l17 = "0";
						var l18 = "0";
						var l19 = "0";
						var l20 = "0";
						var w1 = "0";
						var w2 = "0";
						var w3 = "0";
						var w4 = "0";
						var w5 = "0";
						var w6 = "0";
						var w7 = "0";
						var w8 = "0";
						var w9 = "0";
						var w10 = "0";
						var w11 = "0";
						var w12 = "0";
						var w13 = "0";
						var w14 = "0";
						var w15 = "0";
						var w16 = "0";
						var w17 = "0";
						var w18 = "0";
						var w19 = "0";
						var w20 = "0";
						var h1 = "0";
						var h2 = "0";
						var h3 = "0";
						var h4 = "0";
						var h5 = "0";
						var h6 = "0";
						var h7 = "0";
						var h8 = "0";
						var h9 = "0";
						var h10 = "0";
						var h11 = "0";
						var h12 = "0";
						var h13 = "0";
						var h14 = "0";
						var h15 = "0";
						var h16 = "0";
						var h17 = "0";
						var h18 = "0";
						var h19 = "0";
						var h20 = "0";
						var avg_length = "0";
						var avg_width = "0";
						var avg_height = "0";
						
					}
				}
				
				//WATER ABSORPTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="WTR")
					{
						if(document.getElementById('chk_wtr').checked) {
							var chk_wtr = "1";
						}
						else{
							var chk_wtr = "0";
						}	
							var wa_1_1 = $('#wa_1_1').val();
							var wa_1_2 = $('#wa_1_2').val();
							var wa_1_3 = $('#wa_1_3').val();
							var wa_2_1 = $('#wa_2_1').val();
							var wa_2_2 = $('#wa_2_2').val();
							var wa_2_3 = $('#wa_2_3').val();
							var wtr1 = $('#wtr1').val();
							var wtr2 = $('#wtr2').val();
							var wtr3 = $('#wtr3').val();
							var avg_wtr = $('#avg_wtr').val();
							
						break;
					}
					else
					{
						var chk_wtr = "0";
						var wa_1_1 = "0";
						var wa_1_2 = "0";
						var wa_1_3 = "0";
						var wa_2_1 = "0";
						var wa_2_2 = "0";
						var wa_2_3 = "0";
						var wtr1 = "0";
						var wtr2 = "0";
						var wtr3 = "0";
						var avg_wtr = "0";
						
					}
				}
			
				//DRY DENSITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="DEN")
					{
						if(document.getElementById('chk_den').checked) {
							var chk_den = "1";
						}
						else{
							var chk_den = "0";
						}	
							var den1 = $('#den1').val();
							var den2 = $('#den2').val();
							var den3 = $('#den3').val();
							var iwet1 = $('#iwet1').val();
							var iwet2 = $('#iwet2').val();
							var iwet3 = $('#iwet3').val();
							var fwet1 = $('#fwet1').val();
							var fwet2 = $('#fwet2').val();
							var fwet3 = $('#fwet3').val();
							var vol1 = $('#vol1').val();
							var vol2 = $('#vol2').val();
							var vol3 = $('#vol3').val();
							var dl1 = $('#dl1').val();
							var dl2 = $('#dl2').val();
							var dl3 = $('#dl3').val();
							var dw1 = $('#dw1').val();
							var dw2 = $('#dw2').val();
							var dw3 = $('#dw3').val();
							var dh1 = $('#dh1').val();
							var dh2 = $('#dh2').val();
							var dh3 = $('#dh3').val();
							var avg_den = $('#avg_den').val();
						
						break;
					}
					else
					{
						var chk_den = "0";
						var den1 = "0";
						var den2 = "0";
						var den3 = "0";
						var iwet1 = "0";
						var iwet2 = "0";
						var iwet3 = "0";
						var fwet1 = "0";
						var fwet2 = "0";
						var fwet3 = "0";
						var vol1 = "0";
						var vol2 = "0";
						var vol3 = "0";
						var dl1 = "0";
						var dl2 = "0";
						var dl3 = "0";
						var dw1 = "0";
						var dw2 = "0";
						var dw3 = "0";
						var dh1 = "0";
						var dh2 = "0";
						var dh3 = "0";
						var avg_den = "0";

						
					}
				}
				
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&ulr='+ulr+'&chk_com='+chk_com+'&i1='+i1+'&i2='+i2+'&i3='+i3+'&i4='+i4+'&i5='+i5+'&i6='+i6+'&i7='+i7+'&i8='+i8+'&length1='+length1+'&length2='+length2+'&length3='+length3+'&length4='+length4+'&length5='+length5+'&length6='+length6+'&length7='+length7+'&length8='+length8+'&width1='+width1+'&width2='+width2+'&width3='+width3+'&width4='+width4+'&width5='+width5+'&width6='+width6+'&width7='+width7+'&width8='+width8+'&area1='+area1+'&area2='+area2+'&area3='+area3+'&area4='+area4+'&area5='+area5+'&area6='+area6+'&area7='+area7+'&area8='+area8+'&load1='+load1+'&load2='+load2+'&load3='+load3+'&load4='+load4+'&load5='+load5+'&load6='+load6+'&load7='+load7+'&load8='+load8+'&str1='+str1+'&str2='+str2+'&str3='+str3+'&str4='+str4+'&str5='+str5+'&str6='+str6+'&str7='+str7+'&str8='+str8+'&avg_str='+avg_str+'&chk_shr='+chk_shr+'&r1_1='+r1_1+'&r1_2='+r1_2+'&r1_3='+r1_3+'&r1_4='+r1_4+'&r1_5='+r1_5+'&r1_6='+r1_6+'&r2_1='+r2_1+'&r2_2='+r2_2+'&r2_3='+r2_3+'&r2_4='+r2_4+'&r2_5='+r2_5+'&r2_6='+r2_6+'&r3_1='+r3_1+'&r3_2='+r3_2+'&r3_3='+r3_3+'&r3_4='+r3_4+'&r3_5='+r3_5+'&r3_6='+r3_6+'&r4_1='+r4_1+'&r4_2='+r4_2+'&r4_3='+r4_3+'&r4_4='+r4_4+'&r4_5='+r4_5+'&r4_6='+r4_6+'&r5_1='+r5_1+'&r5_2='+r5_2+'&r5_3='+r5_3+'&r5_4='+r5_4+'&r5_5='+r5_5+'&r5_6='+r5_6+'&r6_1='+r6_1+'&r6_2='+r6_2+'&r6_3='+r6_3+'&r6_4='+r6_4+'&r6_5='+r6_5+'&r6_6='+r6_6+'&r7_1='+r7_1+'&r7_2='+r7_2+'&r7_3='+r7_3+'&r7_4='+r7_4+'&r7_5='+r7_5+'&r7_6='+r7_6+'&dry1='+dry1+'&dry2='+dry2+'&dry3='+dry3+'&dry4='+dry4+'&dry5='+dry5+'&dry6='+dry6+'&avg_dry='+avg_dry+'&age1_1='+age1_1+'&age1_2='+age1_2+'&age1_3='+age1_3+'&age2_1='+age2_1+'&age2_2='+age2_2+'&age2_3='+age2_3+'&avg_mo='+avg_mo+'&chk_dim='+chk_dim+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&l6='+l6+'&l7='+l7+'&l8='+l8+'&l9='+l9+'&l10='+l10+'&l11='+l11+'&l12='+l12+'&l13='+l13+'&l14='+l14+'&l15='+l15+'&l16='+l16+'&l17='+l17+'&l18='+l18+'&l19='+l19+'&l20='+l20+'&w1='+w1+'&w2='+w2+'&w3='+w3+'&w4='+w4+'&w5='+w5+'&w6='+w6+'&w7='+w7+'&w8='+w8+'&w9='+w9+'&w10='+w10+'&w11='+w11+'&w12='+w12+'&w13='+w13+'&w14='+w14+'&w15='+w15+'&w16='+w16+'&w17='+w17+'&w18='+w18+'&w19='+w19+'&w20='+w20+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&h4='+h4+'&h5='+h5+'&h6='+h6+'&h7='+h7+'&h8='+h8+'&h9='+h9+'&h10='+h10+'&h11='+h11+'&h12='+h12+'&h13='+h13+'&h14='+h14+'&h15='+h15+'&h16='+h16+'&h17='+h17+'&h18='+h18+'&h19='+h19+'&h20='+h20+'&chk_wtr='+chk_wtr+'&wa_1_1='+wa_1_1+'&wa_1_2='+wa_1_2+'&wa_1_3='+wa_1_3+'&wa_2_1='+wa_2_1+'&wa_2_2='+wa_2_2+'&wa_2_3='+wa_2_3+'&wtr1='+wtr1+'&wtr2='+wtr2+'&wtr3='+wtr3+'&avg_wtr='+avg_wtr+'&chk_den='+chk_den+'&den1='+den1+'&den2='+den2+'&den3='+den3+'&iwet1='+iwet1+'&iwet2='+iwet2+'&iwet3='+iwet3+'&fwet1='+fwet1+'&fwet2='+fwet2+'&fwet3='+fwet3+'&vol1='+vol1+'&vol2='+vol2+'&vol3='+vol3+'&dl1='+dl1+'&dl2='+dl2+'&dl3='+dl3+'&dw1='+dw1+'&dw2='+dw2+'&dw3='+dw3+'&dh1='+dh1+'&dh2='+dh2+'&dh3='+dh3+'&avg_den='+avg_den+'&r1_date='+r1_date+'&r2_date='+r2_date+'&r3_date='+r3_date+'&r4_date='+r4_date+'&r5_date='+r5_date+'&r6_date='+r6_date+'&r7_date='+r7_date+'&avg_length='+avg_length+'&avg_width='+avg_width+'&avg_height='+avg_height+'&amend_date='+amend_date;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_solid_cocrete.php',
       data: billData,
		dataType: 'JSON',
        success:function(msg){
		$('#btn_save').hide();
		getGlazedTiles();
		var report_no = $('#report_no').val(); 
		var job_no = $('#job_no').val();
		//window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
        }
    });
}

function editData(id){
				var lab_no = $('#lab_no').val(); 
				var report_no = $('#report_no').val(); 
				var job_no= $('#job_no').val();
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: '<?php echo $base_url; ?>save_solid_cocrete.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#tank_no').val(data.tank_no);
            $('#lot_no').val(data.lot_no);
            $('#bitumin_grade').val(data.bitumin_grade);
            $('#bitumin_make').val(data.bitumin_make);
            $('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
			
            var temp = $('#test_list').val();
			var aa= temp.split(",");				
			
			//COMPRESSIVE STRENGTH
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="com")
				{
					var chk_com = data.chk_com;
					if(chk_com=="1")
					{
						$('#txtcom').css("background-color","var(--success)");	
					   $("#chk_com").prop("checked", true); 
					 
					}else{
						$('#txtcom').css("background-color","white");	
						$("#chk_com").prop("checked", false);
					
					}
					$('#i1').val(data.i1);
					$('#i2').val(data.i2);
					$('#i3').val(data.i3);
					$('#i4').val(data.i4);
					$('#i5').val(data.i5);
					$('#i6').val(data.i6);
					$('#i7').val(data.i7);
					$('#i8').val(data.i8);
					$('#length1').val(data.length1);
					$('#length2').val(data.length2);
					$('#length3').val(data.length3);
					$('#length4').val(data.length4);
					$('#length5').val(data.length5);
					$('#length6').val(data.length6);
					$('#length7').val(data.length7);
					$('#length8').val(data.length8);
					$('#width1').val(data.width1);
					$('#width2').val(data.width2);
					$('#width3').val(data.width3);
					$('#width4').val(data.width4);
					$('#width5').val(data.width5);
					$('#width6').val(data.width6);
					$('#width7').val(data.width7);
					$('#width8').val(data.width8);
					$('#area1').val(data.area1);
					$('#area2').val(data.area2);
					$('#area3').val(data.area3);
					$('#area4').val(data.area4);
					$('#area5').val(data.area5);
					$('#area6').val(data.area6);
					$('#area7').val(data.area7);
					$('#area8').val(data.area8);
					$('#load1').val(data.load1);
					$('#load2').val(data.load2);
					$('#load3').val(data.load3);
					$('#load4').val(data.load4);
					$('#load5').val(data.load5);
					$('#load6').val(data.load6);
					$('#load7').val(data.load7);
					$('#load8').val(data.load8);
					$('#str1').val(data.str1);
					$('#str2').val(data.str2);
					$('#str3').val(data.str3);
					$('#str4').val(data.str4);
					$('#str5').val(data.str5);
					$('#str6').val(data.str6);
					$('#str7').val(data.str7);
					$('#str8').val(data.str8);
					$('#avg_str').val(data.avg_str);
					break;
				}
				else
				{
				}
			}
			
			//DRYING SHRINKAGE 
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="SHR")
				{
					var chk_shr = data.chk_shr;
					if(chk_shr=="1")
					{
						$('#txtshr').css("background-color","var(--success)");	
					   $("#chk_shr").prop("checked", true); 
					 
					}else{
						$('#txtshr').css("background-color","white");	
						$("#chk_shr").prop("checked", false);
					
					}
					$('#r1_1').val(data.r1_1);
					$('#r1_2').val(data.r1_2);
					$('#r1_3').val(data.r1_3);
					$('#r1_4').val(data.r1_4);
					$('#r1_5').val(data.r1_5);
					$('#r1_6').val(data.r1_6);
					$('#r2_1').val(data.r2_1);
					$('#r2_2').val(data.r2_2);
					$('#r2_3').val(data.r2_3);
					$('#r2_4').val(data.r2_4);
					$('#r2_5').val(data.r2_5);
					$('#r2_6').val(data.r2_6);
					$('#r3_1').val(data.r3_1);
					$('#r3_2').val(data.r3_2);
					$('#r3_3').val(data.r3_3);
					$('#r3_4').val(data.r3_4);
					$('#r3_5').val(data.r3_5);
					$('#r3_6').val(data.r3_6);
					$('#r4_1').val(data.r4_1);
					$('#r4_2').val(data.r4_2);
					$('#r4_3').val(data.r4_3);
					$('#r4_4').val(data.r4_4);
					$('#r4_5').val(data.r4_5);
					$('#r4_6').val(data.r4_6);
					$('#r5_1').val(data.r5_1);
					$('#r5_2').val(data.r5_2);
					$('#r5_3').val(data.r5_3);
					$('#r5_4').val(data.r5_4);
					$('#r5_5').val(data.r5_5);
					$('#r5_6').val(data.r5_6);
					$('#r6_1').val(data.r6_1);
					$('#r6_2').val(data.r6_2);
					$('#r6_3').val(data.r6_3);
					$('#r6_4').val(data.r6_4);
					$('#r6_5').val(data.r6_5);
					$('#r6_6').val(data.r6_6);
					$('#r7_1').val(data.r7_1);
					$('#r7_2').val(data.r7_2);
					$('#r7_3').val(data.r7_3);
					$('#r7_4').val(data.r7_4);
					$('#r7_5').val(data.r7_5);
					$('#r7_6').val(data.r7_6);
					$('#dry1').val(data.dry1);
					$('#dry2').val(data.dry2);
					$('#dry3').val(data.dry3);
					$('#dry4').val(data.dry4);
					$('#dry5').val(data.dry5);
					$('#dry6').val(data.dry6);
					$('#avg_dry').val(data.avg_dry);
					$('#age1_1').val(data.age1_1);
					$('#age1_2').val(data.age1_2);
					$('#age1_3').val(data.age1_3);
					$('#age2_1').val(data.age2_1);
					$('#age2_2').val(data.age2_2);
					$('#age2_3').val(data.age2_3);
					$('#avg_mo').val(data.avg_mo);
					$('#r1_date').val(data.r1_date);
					$('#r2_date').val(data.r2_date);
					$('#r3_date').val(data.r3_date);
					$('#r4_date').val(data.r4_date);
					$('#r5_date').val(data.r5_date);
					$('#r6_date').val(data.r6_date);
					$('#r7_date').val(data.r7_date);
					break;
				}
				else
				{
				}
			}
			
			//DIMENTION
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="DIM")
				{
					var chk_dim = data.chk_dim;
					if(chk_dim=="1")
					{
						$('#txtdim').css("background-color","var(--success)");	
					   $("#chk_dim").prop("checked", true); 
					 
					}else{
						$('#txtdim').css("background-color","white");	
						$("#chk_dim").prop("checked", false);
					
					}
					$('#l1').val(data.l1);
					$('#l2').val(data.l2);
					$('#l3').val(data.l3);
					$('#l4').val(data.l4);
					$('#l5').val(data.l5);
					$('#l6').val(data.l6);
					$('#l7').val(data.l7);
					$('#l8').val(data.l8);
					$('#l9').val(data.l9);
					$('#l10').val(data.l10);
					$('#l11').val(data.l11);
					$('#l12').val(data.l12);
					$('#l13').val(data.l13);
					$('#l14').val(data.l14);
					$('#l15').val(data.l15);
					$('#l16').val(data.l16);
					$('#l17').val(data.l17);
					$('#l18').val(data.l18);
					$('#l19').val(data.l19);
					$('#l20').val(data.l20);
					$('#w1').val(data.w1);
					$('#w2').val(data.w2);
					$('#w3').val(data.w3);
					$('#w4').val(data.w4);
					$('#w5').val(data.w5);
					$('#w6').val(data.w6);
					$('#w7').val(data.w7);
					$('#w8').val(data.w8);
					$('#w9').val(data.w9);
					$('#w10').val(data.w10);
					$('#w11').val(data.w11);
					$('#w12').val(data.w12);
					$('#w13').val(data.w13);
					$('#w14').val(data.w14);
					$('#w15').val(data.w15);
					$('#w16').val(data.w16);
					$('#w17').val(data.w17);
					$('#w18').val(data.w18);
					$('#w19').val(data.w19);
					$('#w20').val(data.w20);
					$('#h1').val(data.h1);
					$('#h2').val(data.h2);
					$('#h3').val(data.h3);
					$('#h4').val(data.h4);
					$('#h5').val(data.h5);
					$('#h6').val(data.h6);
					$('#h7').val(data.h7);
					$('#h8').val(data.h8);
					$('#h9').val(data.h9);
					$('#h10').val(data.h10);
					$('#h11').val(data.h11);
					$('#h12').val(data.h12);
					$('#h13').val(data.h13);
					$('#h14').val(data.h14);
					$('#h15').val(data.h15);
					$('#h16').val(data.h16);
					$('#h17').val(data.h17);
					$('#h18').val(data.h18);
					$('#h19').val(data.h19);
					$('#h20').val(data.h20);
					$('#avg_height').val(data.avg_height);
					$('#avg_width').val(data.avg_width);
					$('#avg_length').val(data.avg_length);
					break;
				}
				else
				{
				}
			}
			
			
			//WATER ABSORPTION
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="WTR")
				{
					var chk_wtr = data.chk_wtr;
					if(chk_wtr=="1")
					{
						$('#txtwtr').css("background-color","var(--success)");	
					   $("#chk_wtr").prop("checked", true); 
					 
					}else{
						$('#txtwtr').css("background-color","white");	
						$("#chk_wtr").prop("checked", false);
					}
					$('#wa_1_1').val(data.wa_1_1);
					$('#wa_1_2').val(data.wa_1_2);
					$('#wa_1_3').val(data.wa_1_3);
					$('#wa_2_1').val(data.wa_2_1);
					$('#wa_2_2').val(data.wa_2_2);
					$('#wa_2_3').val(data.wa_2_3);
					$('#wtr1').val(data.wtr1);
					$('#wtr2').val(data.wtr2);
					$('#wtr3').val(data.wtr3);
					$('#avg_wtr').val(data.avg_wtr);
					break;
				}
				else
				{
				}
			}
			
			//DRY DENSITY
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="DEN")
				{
					var chk_den = data.chk_den;
					if(chk_den=="1")
					{
						$('#txtden').css("background-color","var(--success)");	
					   $("#chk_den").prop("checked", true); 
					 
					}else{
						$('#txtden').css("background-color","white");	
						$("#chk_den").prop("checked", false);
					}
					$('#den1').val(data.den1);
					$('#den2').val(data.den2);
					$('#den3').val(data.den3);
					$('#iwet1').val(data.iwet1);
					$('#iwet2').val(data.iwet2);
					$('#iwet3').val(data.iwet3);
					$('#fwet1').val(data.fwet1);
					$('#fwet2').val(data.fwet2);
					$('#fwet3').val(data.fwet3);
					$('#vol1').val(data.vol1);
					$('#vol2').val(data.vol2);
					$('#vol3').val(data.vol3);
					$('#dl1').val(data.dl1);
					$('#dl2').val(data.dl2);
					$('#dl3').val(data.dl3);
					$('#dw1').val(data.dw1);
					$('#dw2').val(data.dw2);
					$('#dw3').val(data.dw3);
					$('#dh1').val(data.dh1);
					$('#dh2').val(data.dh2);
					$('#dh3').val(data.dh3);
					$('#avg_den').val(data.avg_den);
					break;
				}
				else
				{
				}
			}
			
			
			
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });


}
	
$(document).on("click", ".delete_excels", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Excel?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>excel_upload_test.php',
        data: 'action_type=delete_excels&clicked_id='+clicked_id,
        success:function(html){
			location.reload();
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});	
	</script>