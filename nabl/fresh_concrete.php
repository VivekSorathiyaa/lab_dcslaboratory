
<?php 
session_start(); 
include("header.php");
//REMOVE SIDE BAR
/*include("sidebar.php");*/
include("connection.php");
error_reporting(0);
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
			
		}
		if(isset($_GET['lab_no'])){
			$lab_no=$_GET['lab_no'];
			$aa	=$_GET['lab_no'];
			
		}
		if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
		}
		
		  $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$in_l= $row_select4['in_l'];
					$in_w= $row_select4['in_w'];
					$in_h= $row_select4['in_h'];
					$in_den= $row_select4['in_den'];
					$in_grade= $row_select4['in_grade'];					
				}
		
?>
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">FRESH CONCRETE</h2>
					</div>
					<div class="box-default">
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">
								<br>
								<div class="col-lg-6">
									<div class="form-group">
									
									 <!-- <label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->

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
											<input type="hidden" class="form-control" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>

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
										<div class="col-sm-2">
											<div class="form-group">	 
												<label for="inputEmail3" class="control-label">Grade :</label>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">	 
												<input type="text" class="form-control" id="grade_fresh" name="grade_fresh">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">	 
												<label for="inputEmail3" class="control-label">Required Slump:</label>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">	 
												<input type="text" class="form-control" id="slump_req" name="slump_req">
											</div>
										</div>
											
									</div>
								</div>
								<br>

							<!-- LAB NO PUT VAIBHAV-->
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
													$querys_job1 = "SELECT * FROM fresh_concrete WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_fresh_concrete.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											<?php //} ?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_fresh_concrete.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
			
			if($r1['test_code']=="slu")
			{
				$test_check.="slu,";	
				?>											
				<div class="panel panel-default" id="slu">
					<div class="panel-heading" id="txtslu">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_slu">
								<h4 class="panel-title">
								<b>SLUMP</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_slu" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-md-6">
									<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_slu">2.</label>
												<input type="checkbox" class="visually-hidden" name="chk_slu"  id="chk_slu" value="chk_slu"><br>
											</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">SLUMP</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Temp (<sup>o</sup>C)</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id='mix_temp' name='mix_temp' >
										</div>
									</div>
								</div>
							</div>	
							<div class="row">									
								<div class="col-md-6">
									<div class="form-group">
											
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weather Condition:</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id='w_con' name='w_con' >
										</div>
									</div>
								</div>
							</div>								
							<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Sr No.</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Type of Material</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Proportioin per m<sup>2</sup></label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Quantity for Nos Cubes(kg)</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">1.</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Cement</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_a1' name='mix_a1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_b1' name='mix_b1'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">2.</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Fine Aggrigate - Sand</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_a2' name='mix_a2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_b2' name='mix_b2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">3.</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Coarse Aggrigate10mm</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_a3' name='mix_a3'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_b3' name='mix_b3'>
									</div>
								</div>
							</div>
				
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center"></label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Coarse Aggrigate 20mm</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_a4' name='mix_a4'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_b4' name='mix_b4'>
									</div>
								</div>
							</div>
					
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center"></label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Total Coarse Aggrigate</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_a5' name='mix_a5'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_b5' name='mix_b5'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">4.</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Water</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_a6' name='mix_a6'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_b6' name='mix_b6'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">5.</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Admixture</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_a7' name='mix_a7'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_b7' name='mix_b7'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">6.</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Fly Ash</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_a8' name='mix_a8'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_b8' name='mix_b8'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">7.</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">W/C Ratio</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_ratio' name='mix_ratio'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">8.</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Added Water (ml)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='mix_wtr' name='mix_wtr'>
									</div>
								</div>
							</div>
							<br>		
							<br>		
							
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-right">Initial Observation Slump (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='slump1' name='slump1'>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Volume Cylinder (cc) (V)	</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den1' name='den1'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-right">Remarks </label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='slump2' name='slump2'>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Empty Weight of Cylinder (gm)(W2)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den2' name='den2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-right">Time Duration (Minutes)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='slump3' name='slump3'>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Mould + mix Weight (gm) (W2)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den3' name='den3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-right">Observatioin Slump (mm) </label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='slump4' name='slump4'>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Mix weight (gm)(W) = W2 - W1</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den4' name='den4'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-right">Remarks</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='slump5' name='slump5'>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Density of Concrete (gm/cc) = W/V</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den5' name='den5'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-right">Bleeding Test</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='bd_1' name='bd_1'>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Flow (cm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='flow' name='flow'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-right">Air Content (%)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='ac_1' name='ac_1'>
									</div>
								</div>
							</div>
							
						</div>
				  </div>
				</div>
				
		
						
				<?php
			}
			if($r1['test_code']=="DIM")
			{	
				$test_check.="DIM,";
				?>
				<div class="panel panel-default" id="DIM">
					<div class="panel-heading" id="txtdim">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
								<h4 class="panel-title">
								<b>DIMENSION</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse2" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_dim">1.</label>
													<input type="checkbox" class="visually-hidden" name="chk_dim"  id="chk_dim" value="chk_dim"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">DIMENSION</label>
										</div>
									</div>
									
							</div>								
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Sr No.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Length (mm)</label>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label">Width (mm)</label>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label">Height (mm)</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l1' name='l1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w1' name='w1'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h1' name='h1'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l2' name='l2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w2' name='w2'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h2' name='h2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">3.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l3' name='l3'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w3' name='w3'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h3' name='h3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">4.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l4' name='l4'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w4' name='w4'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h4' name='h4'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">5.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l5' name='l5'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w5' name='w5'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h5' name='h5'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">6.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l6' name='l6'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w6' name='w6'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h6' name='h6'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">7.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l7' name='l7'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w7' name='w7'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h7' name='h7'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">8.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l8' name='l8'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w8' name='w8'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h8' name='h8'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">9.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l9' name='l9'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w9' name='w9'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h9' name='h9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">10.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l10' name='l10'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w10' name='w10'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h10' name='h10'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">11.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l11' name='l11'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w11' name='w11'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h11' name='h11'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">12.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l12' name='l12'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w12' name='w12'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h12' name='h12'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">13.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l13' name='l13'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w13' name='w13'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h13' name='h13'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">14.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l14' name='l14'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w14' name='w14'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h14' name='h14'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">15.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l15' name='l15'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w15' name='w15'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h15' name='h15'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">16.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l16' name='l16'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w16' name='w16'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h16' name='h16'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">17.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l17' name='l17'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w17' name='w17'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h17' name='h17'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">18.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l18' name='l18'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w18' name='w18'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h18' name='h18'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">19.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l19' name='l19'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w19' name='w19'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h19' name='h19'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">20.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l20' name='l20'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w20' name='w20'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h20' name='h20'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">21.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l21' name='l21'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w21' name='w21'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h21' name='h21'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">22.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l22' name='l22'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w22' name='w22'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h22' name='h22'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">23.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l23' name='l23'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w23' name='w23'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h23' name='h23'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">24.</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='l24' name='l24'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='w24' name='w24'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='h24' name='h24'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Average :</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_l' name='avg_l'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='avg_w' name='avg_w'>
									</div>                                                              
								</div>                                                                  
																									    
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='avg_h' name='avg_h'>
									</div>
								</div>
							</div>
							
						</div>
				  </div>
				</div>
						
				
					
			<?php
			}
			if($r1['test_code']=="den")
			{	
				$test_check.="den,";
				?>
				<div class="panel panel-default" id="den">
					<div class="panel-heading" id="txtden">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
								<h4 class="panel-title">
								<b>BULK DENSITY &amp; MOISTURE CONTENT</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse3" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_den">3.</label>
													<input type="checkbox" class="visually-hidden" name="chk_den"  id="chk_den" value="chk_den"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">BULK DENSITY &amp; MOISTURE CONTENT</label>
										</div>
									</div>
									
							</div>								
							<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Sr No.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Length (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Width (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Height (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Volume (m<sup>3</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Initial Weight (gm)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Final Weight (gm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Moisture Content (%)</label>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Dry Density (kg/m<sup>3</sup>)</label>
									</div>
								</div>
							</div>
							<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rl1' name='rl1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rw1' name='rw1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rh1' name='rh1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rvol1' name='rvol1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rweight1' name='rweight1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='rfinal1' name='rfinal1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mc1' name='mc1'>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den1' name='den1'>
									</div>
								</div>
							</div>
								<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rl2' name='rl2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rw2' name='rw2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rh2' name='rh2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rvol2' name='rvol2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rweight2' name='rweight2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='rfinal2' name='rfinal2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mc2' name='mc2'>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den2' name='den2'>
									</div>
								</div>
							</div>
								<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">3.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rl3' name='rl3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rw3' name='rw3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rh3' name='rh3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rvol3' name='rvol3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rweight3' name='rweight3'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='rfinal3' name='rfinal3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mc3' name='mc3'>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den3' name='den3'>
									</div>
								</div>
							</div>
								<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">4.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rl4' name='rl4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rw4' name='rw4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rh4' name='rh4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rvol4' name='rvol4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rweight4' name='rweight4'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='rfinal4' name='rfinal4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mc4' name='mc4'>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den4' name='den4'>
									</div>
								</div>
							</div>
								<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">5.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rl5' name='rl5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rw5' name='rw5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rh5' name='rh5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rvol5' name='rvol5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rweight5' name='rweight5'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='rfinal5' name='rfinal5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mc5' name='mc5'>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den5' name='den5'>
									</div>
								</div>
							</div>
								<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">6.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rl6' name='rl6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rw6' name='rw6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rh6' name='rh6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rvol6' name='rvol6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rweight6' name='rweight6'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='rfinal6' name='rfinal6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mc6' name='mc6'>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den6' name='den6'>
									</div>
								</div>
							</div>
								<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">7.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rl7' name='rl7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rw7' name='rw7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rh7' name='rh7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rvol7' name='rvol7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rweight7' name='rweight7'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='rfinal7' name='rfinal7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mc7' name='mc7'>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den7' name='den7'>
									</div>
								</div>
							</div>
								<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">8.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rl8' name='rl8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rw8' name='rw8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rh8' name='rh8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rvol8' name='rvol8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rweight8' name='rweight8'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='rfinal8' name='rfinal8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mc8' name='mc8'>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den8' name='den8'>
									</div>
								</div>
							</div>
								<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">9.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rl9' name='rl9'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rw9' name='rw9'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rh9' name='rh9'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rvol9' name='rvol9'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='rweight9' name='rweight9'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='rfinal9' name='rfinal9'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mc9' name='mc9'>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='den9' name='den9'>
									</div>
								</div>
							</div>
								
							<br>
							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Average:</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_mc' name='avg_mc'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_den' name='avg_den'>
									</div>
								</div>
							</div>
						</div>
				  </div>
				</div>
				
					
			
				
				
			<?php
			}
			if($r1['test_code']=="the")
			{	
				$test_check.="the,";
				?>
				<div class="panel panel-default" id="the">
					<div class="panel-heading" id="txtthe">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_the">
								<h4 class="panel-title">
								<b>THERMAL CONDUCTIVITY</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_the" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-lg-8">
									<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_the">4.</label>
												<input type="checkbox" class="visually-hidden" name="chk_the"  id="chk_the" value="chk_the"><br>
											</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">THERMAL CONDUCTIVITY</label>
									</div>
								</div>
							</div>								
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Sr No.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Length (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Width (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Thickness (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Area (m<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Initial Weight (gm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Oven Dry Weight (gm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Heating Temprature (<sup>o</sup>C)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Cooling Temprature (<sup>o</sup>C)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Woltage (W)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Current (Amp.)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Thermal Conductivity (W/mK)</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='al1' name='al1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='aw1' name='aw1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='at1' name='at1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='aarea1' name='aarea1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='in1' name='in1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='od1' name='od1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='heat1' name='heat1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cool1' name='cool1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='volt1' name='volt1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cur1' name='cur1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='the1' name='the1'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='al2' name='al2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='aw2' name='aw2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='at2' name='at2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='aarea2' name='aarea2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='in2' name='in2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='od2' name='od2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='heat2' name='heat2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cool2' name='cool2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='volt2' name='volt2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cur2' name='cur2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='the2' name='the2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">3.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='al3' name='al3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='aw3' name='aw3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='at3' name='at3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='aarea3' name='aarea3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='in3' name='in3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='od3' name='od3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='heat3' name='heat3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cool3' name='cool3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='volt3' name='volt3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cur3' name='cur3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='the3' name='the3'>
									</div>
								</div>
							</div>
							
							<div class="row">
								
									<div class="col-md-11">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-right">Thermal Conductivity (W/mK):</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_the" name="avg_the" >
										</div>
									</div>
									
															
								
							</div>
						</div>
				  </div>
				</div>
				
		
		
					
				
				
			<?php
			}
			if($r1['test_code']=="SHR")
			{	
				$test_check.="SHR,";
				?>
				<div class="panel panel-default" id="SHR">
					<div class="panel-heading" id="txtdry">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_dry">
								<h4 class="panel-title">
								<b>DRYING SHRINKAGE</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_dry" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_dry">5.</label>
													<input type="checkbox" class="visually-hidden" name="chk_dry"  id="chk_dry" value="chk_dry"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">DRYING SHRINKAGE</label>
										</div>
									</div>
									
							</div>								
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Sr No.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Reading-1</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Reading-2</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Reading-3</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Reading-4</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Reading-5</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Reading-6</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Drying Shrinkage</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Average of two Face</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Face 1.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_1_1' name='fr_1_1_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_1_2' name='fr_1_1_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_1_3' name='fr_1_1_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_1_4' name='fr_1_1_4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_1_5' name='fr_1_1_5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_1_6' name='fr_1_1_6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry1' name='dry1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='two1' name='two1'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Face 2.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_2_1' name='fr_1_2_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_2_2' name='fr_1_2_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_2_3' name='fr_1_2_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_2_4' name='fr_1_2_4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_2_5' name='fr_1_2_5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_1_2_6' name='fr_1_2_6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry2' name='dry2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Face 1.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_1_1' name='fr_2_1_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_1_2' name='fr_2_1_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_1_3' name='fr_2_1_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_1_4' name='fr_2_1_4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_1_5' name='fr_2_1_5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_1_6' name='fr_2_1_6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry3' name='dry3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='two2' name='two2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Face 2.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_2_1' name='fr_2_2_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_2_2' name='fr_2_2_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_2_3' name='fr_2_2_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_2_4' name='fr_2_2_4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_2_5' name='fr_2_2_5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_2_2_6' name='fr_2_2_6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry4' name='dry4'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Face 1.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_1_1' name='fr_3_1_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_1_2' name='fr_3_1_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_1_3' name='fr_3_1_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_1_4' name='fr_3_1_4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_1_5' name='fr_3_1_5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_1_6' name='fr_3_1_6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry5' name='dry5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='two3' name='two3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Face 2.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_2_1' name='fr_3_2_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_2_2' name='fr_3_2_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_2_3' name='fr_3_2_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_2_4' name='fr_3_2_4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_2_5' name='fr_3_2_5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='fr_3_2_6' name='fr_3_2_6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry6' name='dry6'>
									</div>
								</div>
							</div>
							
							<div class="row">
								
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label text-right">Average Drying Shrinkage:</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_dry" name="avg_dry" >
										</div>
									</div>
									
															
								
							</div>
						</div>
				  </div>
				</div>
			<?php
			}if($r1['test_code']=="MOI")
			{	
				$test_check.="MOI,";
				?>
				<div class="panel panel-default" id="moi">
					<div class="panel-heading" id="txtmoi">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_moi">
								<h4 class="panel-title">
								<b>MOISTURE MAINTAINING</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_moi" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_moi">5.</label>
													<input type="checkbox" class="visually-hidden" name="chk_moi"  id="chk_moi" value="chk_moi"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">MOISTURE MAINTAINING</label>
										</div>
									</div>
									
							</div>								
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Sr No</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Identified As</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Initial Weight (kg)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Final Weight (kg)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Moisture Content (%)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Moisture Lost (%)</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id1' name='m_id1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini1' name='m_ini1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin1' name='m_fin1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con1' name='m_con1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost1' name='m_lost1'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id2' name='m_id2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini2' name='m_ini2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin2' name='m_fin2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con2' name='m_con2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost2' name='m_lost2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">3.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id3' name='m_id3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini3' name='m_ini3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin3' name='m_fin3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con3' name='m_con3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost3' name='m_lost3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">4.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id4' name='m_id4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini4' name='m_ini4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin4' name='m_fin4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con4' name='m_con4'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost4' name='m_lost4'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">5.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id5' name='m_id5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini5' name='m_ini5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin5' name='m_fin5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con5' name='m_con5'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost5' name='m_lost5'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">6.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id6' name='m_id6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini6' name='m_ini6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin6' name='m_fin6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con6' name='m_con6'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost6' name='m_lost6'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">7.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id7' name='m_id7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini7' name='m_ini7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin7' name='m_fin7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con7' name='m_con7'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost7' name='m_lost7'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">8.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id8' name='m_id8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini8' name='m_ini8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin8' name='m_fin8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con8' name='m_con8'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost8' name='m_lost8'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">9.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id9' name='m_id9'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini9' name='m_ini9'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin9' name='m_fin9'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con9' name='m_con9'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost9' name='m_lost9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">10.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id10' name='m_id10'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini10' name='m_ini10'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin10' name='m_fin10'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con10' name='m_con10'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost10' name='m_lost10'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">11.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id11' name='m_id11'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini11' name='m_ini11'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin11' name='m_fin11'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con11' name='m_con11'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost11' name='m_lost11'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">12.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_id12' name='m_id12'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_ini12' name='m_ini12'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_fin12' name='m_fin12'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_con12' name='m_con12'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='m_lost12' name='m_lost12'>
									</div>
								</div>
							</div>
						</div>
				  </div>
				</div>
			<?php
			}
		}
			?>
		</div>				
					<hr>
		<!-- DISPLAY DATA LOGIC VAIBHAV-->
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
							 $query = "select * from fresh_concrete WHERE lab_no='$aa'  and `is_deleted`='0'";

								$result = mysqli_query($conn, $query);
			
								
								if (mysqli_num_rows($result) > 0) {
							while($r = mysqli_fetch_array($result)){
									
										if($r['is_deleted'] == 0){
										?>
										<tr>
							
										<td style="text-align:center;" width="10%">	
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
										<?php
										//	$val =  $_SESSION['isadmin'];
										//	if($val == 0 || $val == 5){
											?>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
										<?php
										//	}
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
		</div>		<!-- TEST LIST FILD VAIBHAV-->
		<input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ',');?>">		
				</form>
	</div>
		
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
  })
$(document).ready(function(){ 
				   
	$('#btn_edit_data').hide();
	$('#alert').hide();
	
	
	
	function slu_auto()
	{
		$('#txtslu').css("background-color","var(--success)"); 
		$('#mix_temp').val(1);
		$('#w_con').val(1);
		$('#mix_a1').val(1);
		$('#mix_a2').val(1);
		$('#mix_a3').val(1);
		$('#mix_a4').val(1);
		$('#mix_a5').val(1);
		$('#mix_a6').val(1);
		$('#mix_a7').val(1);
		$('#mix_a8').val(1);
		$('#mix_b1').val(1);
		$('#mix_b2').val(1);
		$('#mix_b3').val(1);
		$('#mix_b4').val(1);
		$('#mix_b5').val(1);
		$('#mix_b6').val(1);
		$('#mix_b7').val(1);
		$('#mix_b8').val(1);
		$('#mix_ratio').val(1);
		$('#mix_wtr').val(1);
		$('#slump1').val(1);
		$('#slump2').val(1);
		$('#slump3').val(1);
		$('#slump4').val(1);
		$('#slump5').val(1);
		$('#den1').val(1);
		$('#den2').val(1);
		$('#den3').val(1);
		$('#den4').val(1);
		$('#den5').val(1);
		$('#bd_1').val(1);
		$('#flow').val(1);
		$('#ac_1').val(1);
	}
	
	
	$('#chk_slu').change(function(){
        if(this.checked)
		{
			slu_auto();
		}
		else
		{
			$('#txtslu').css("background-color","white");
			$('#mix_temp').val(null);
			$('#w_con').val(null);
			$('#mix_a1').val(null);
			$('#mix_a2').val(null);
			$('#mix_a3').val(null);
			$('#mix_a4').val(null);
			$('#mix_a5').val(null);
			$('#mix_a6').val(null);
			$('#mix_a7').val(null);
			$('#mix_a8').val(null);
			$('#mix_b1').val(null);
			$('#mix_b2').val(null);
			$('#mix_b3').val(null);
			$('#mix_b4').val(null);
			$('#mix_b5').val(null);
			$('#mix_b6').val(null);
			$('#mix_b7').val(null);
			$('#mix_b8').val(null);
			$('#mix_ratio').val(null);
			$('#mix_wtr').val(null);
			$('#slump1').val(null);
			$('#slump2').val(null);
			$('#slump3').val(null);
			$('#slump4').val(null);
			$('#slump5').val(null);
			$('#den1').val(null);
			$('#den2').val(null);
			$('#den3').val(null);
			$('#den4').val(null);
			$('#den5').val(null);
			$('#bd_1').val(null);
			$('#flow').val(null);
			$('#ac_1').val(null);
		}
	});
	
	function dry_auto()
	{
		$('#txtdry').css("background-color","var(--success)"); 
		$('#avg_dry').val(1);
		$('#fr_1_1_1').val(1);
		$('#fr_1_1_2').val(1);
		$('#fr_1_1_3').val(1);
		$('#fr_1_1_4').val(1);
		$('#fr_1_1_5').val(1);
		$('#fr_1_1_6').val(1);
		$('#fr_1_2_1').val(1);
		$('#fr_1_2_2').val(1);
		$('#fr_1_2_3').val(1);
		$('#fr_1_2_4').val(1);
		$('#fr_1_2_5').val(1);
		$('#fr_1_2_6').val(1);
		$('#fr_2_1_1').val(1);
		$('#fr_2_1_2').val(1);
		$('#fr_2_1_3').val(1);
		$('#fr_2_1_4').val(1);
		$('#fr_2_1_5').val(1);
		$('#fr_2_1_6').val(1);
		$('#fr_2_2_1').val(1);
		$('#fr_2_2_2').val(1);
		$('#fr_2_2_3').val(1);
		$('#fr_2_2_4').val(1);
		$('#fr_2_2_5').val(1);
		$('#fr_2_2_6').val(1);
		$('#fr_3_1_1').val(1);
		$('#fr_3_1_2').val(1);
		$('#fr_3_1_3').val(1);
		$('#fr_3_1_4').val(1);
		$('#fr_3_1_5').val(1);
		$('#fr_3_1_6').val(1);
		$('#fr_3_2_1').val(1);
		$('#fr_3_2_2').val(1);
		$('#fr_3_2_3').val(1);
		$('#fr_3_2_4').val(1);
		$('#fr_3_2_5').val(1);
		$('#fr_3_2_6').val(1);
		$('#dry1').val(1);
		$('#dry2').val(1);
		$('#dry3').val(1);
		$('#dry4').val(1);
		$('#dry5').val(1);
		$('#dry6').val(1);
		$('#two1').val(1);
		$('#two2').val(1);
		$('#two3').val(1);
		
	}
	
	
	$('#chk_dry').change(function(){
        if(this.checked)
		{
			dry_auto();
		}
		else
		{
			$('#txtdry').css("background-color","white");
			$('#avg_dry').val(null);
			$('#fr_1_1_1').val(null);
			$('#fr_1_1_2').val(null);
			$('#fr_1_1_3').val(null);
			$('#fr_1_1_4').val(null);
			$('#fr_1_1_5').val(null);
			$('#fr_1_1_6').val(null);
			$('#fr_1_2_1').val(null);
			$('#fr_1_2_2').val(null);
			$('#fr_1_2_3').val(null);
			$('#fr_1_2_4').val(null);
			$('#fr_1_2_5').val(null);
			$('#fr_1_2_6').val(null);
			$('#fr_2_1_1').val(null);
			$('#fr_2_1_2').val(null);
			$('#fr_2_1_3').val(null);
			$('#fr_2_1_4').val(null);
			$('#fr_2_1_5').val(null);
			$('#fr_2_1_6').val(null);
			$('#fr_2_2_1').val(null);
			$('#fr_2_2_2').val(null);
			$('#fr_2_2_3').val(null);
			$('#fr_2_2_4').val(null);
			$('#fr_2_2_5').val(null);
			$('#fr_2_2_6').val(null);
			$('#fr_3_1_1').val(null);
			$('#fr_3_1_2').val(null);
			$('#fr_3_1_3').val(null);
			$('#fr_3_1_4').val(null);
			$('#fr_3_1_5').val(null);
			$('#fr_3_1_6').val(null);
			$('#fr_3_2_1').val(null);
			$('#fr_3_2_2').val(null);
			$('#fr_3_2_3').val(null);
			$('#fr_3_2_4').val(null);
			$('#fr_3_2_5').val(null);
			$('#fr_3_2_6').val(null);
			$('#dry1').val(null);
			$('#dry2').val(null);
			$('#dry3').val(null);
			$('#dry4').val(null);
			$('#dry5').val(null);
			$('#dry6').val(null);
			$('#two1').val(null);
			$('#two2').val(null);
			$('#two3').val(null);
			
		}
	});
	
	
	
	
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--success)"); 
			//$('#txtwtr').css("background-color","var(--success)"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				
				//Slump
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="slu")
					{
						$('#txtslu').css("background-color","var(--success)");
						$("#chk_slu").prop("checked", true); 
						slu_auto();
						break;
					}					
				}
				
				//DRYING SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="SHR")
					{
						$('#txtdry').css("background-color","var(--success)");
						$("#chk_dry").prop("checked", true); 
						dry_auto();
						break;
					}					
				}
				
				
				
		}
		
	});
	
	});


function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}


$("#btn_edit_data").click(function(){
			$('#btn_edit_data').hide();
			$('#btn_save').show();

	});
function getGlazedTiles(){
				var lab_no = $('#lab_no').val(); 
				var report_no = $('#report_no').val(); 
				var job_no=$('#job_no').val();
     $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_fresh_concrete.php',
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
				var ulr = $('#ulr').val();	
				var amend_date = $('#amend_date').val();	
				var grade_fresh = $('#grade_fresh').val();
				var slump_req = $('#slump_req').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");				
									
				//Slump
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="slu")
					{
						if(document.getElementById('chk_slu').checked) {
								var chk_slu = "1";
						}
						else{
								var chk_slu = "0";
						}
						var mix_temp = $('#mix_temp').val();
						var w_con = $('#w_con').val();
						var mix_a1 = $('#mix_a1').val();
						var mix_a2 = $('#mix_a2').val();
						var mix_a3 = $('#mix_a3').val();
						var mix_a4 = $('#mix_a4').val();
						var mix_a5 = $('#mix_a5').val();
						var mix_a6 = $('#mix_a6').val();
						var mix_a7 = $('#mix_a7').val();
						var mix_a8 = $('#mix_a8').val();
						var mix_b1 = $('#mix_b1').val();
						var mix_b2 = $('#mix_b2').val();
						var mix_b3 = $('#mix_b3').val();
						var mix_b4 = $('#mix_b4').val();
						var mix_b5 = $('#mix_b5').val();
						var mix_b6 = $('#mix_b6').val();
						var mix_b7 = $('#mix_b7').val();
						var mix_b8 = $('#mix_b8').val();
						var mix_ratio = $('#mix_ratio').val();
						var mix_wtr = $('#mix_wtr').val();
						var slump1 = $('#slump1').val();
						var slump2 = $('#slump2').val();
						var slump3 = $('#slump3').val();
						var slump4 = $('#slump4').val();
						var slump5 = $('#slump5').val();
						var den1 = $('#den1').val();
						var den2 = $('#den2').val();
						var den3 = $('#den3').val();
						var den4 = $('#den4').val();
						var den5 = $('#den5').val();
						var bd_1 = $('#bd_1').val();
						var flow = $('#flow').val();
						var ac_1 = $('#ac_1').val();
						
							
						break;
					}
					else
					{
						var chk_slu = "0";
						var mix_temp = "0";
						var w_con = "0";
						var mix_a1 = "0";
						var mix_a2 = "0";
						var mix_a3 = "0";
						var mix_a4 = "0";
						var mix_a5 = "0";
						var mix_a6 = "0";
						var mix_a7 = "0";
						var mix_a8 = "0";
						var mix_b1 = "0";
						var mix_b2 = "0";
						var mix_b3 = "0";
						var mix_b4 = "0";
						var mix_b5 = "0";
						var mix_b6 = "0";
						var mix_b7 = "0";
						var mix_b8 = "0";
						var mix_ratio = "0";
						var mix_wtr = "0";
						var slump1 = "0";
						var slump2 = "0";
						var slump3 = "0";
						var slump4 = "0";
						var slump5 = "0";
						var den1 = "0";
						var den2 = "0";
						var den3 = "0";
						var den4 = "0";
						var den5 = "0";
						var bd_1 = "0";
						var flow = "0";
						var ac_1 = "0";
					}
				}
				
				//DRYING SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="SHR")
					{
						if(document.getElementById('chk_dry').checked) {
								var chk_dry = "1";
						}
						else{
								var chk_dry = "0";
						}
						
						var fr_1_1_1 = $('#fr_1_1_1').val();
						var fr_1_1_2 = $('#fr_1_1_2').val();
						var fr_1_1_3 = $('#fr_1_1_3').val();
						var fr_1_1_4 = $('#fr_1_1_4').val();
						var fr_1_1_5 = $('#fr_1_1_5').val();
						var fr_1_1_6 = $('#fr_1_1_6').val();
						var dry1 = $('#dry1').val();
						var dry2 = $('#dry2').val();
						var dry3 = $('#dry3').val();
						var dry4 = $('#dry4').val();
						var dry5 = $('#dry5').val();
						var dry6 = $('#dry6').val();
						var avg_dry = $('#avg_dry').val();
						var two1 = $('#two1').val();
						var two2 = $('#two2').val();
						var two3 = $('#two3').val();
						var fr_1_2_1 = $('#fr_1_2_1').val();
						var fr_1_2_2 = $('#fr_1_2_2').val();
						var fr_1_2_3 = $('#fr_1_2_3').val();
						var fr_1_2_4 = $('#fr_1_2_4').val();
						var fr_1_2_5 = $('#fr_1_2_5').val();
						var fr_1_2_6 = $('#fr_1_2_6').val();
						
						var fr_2_1_1 = $('#fr_2_1_1').val();
						var fr_2_1_2 = $('#fr_2_1_2').val();
						var fr_2_1_3 = $('#fr_2_1_3').val();
						var fr_2_1_4 = $('#fr_2_1_4').val();
						var fr_2_1_5 = $('#fr_2_1_5').val();
						var fr_2_1_6 = $('#fr_2_1_6').val();
						var fr_2_2_1 = $('#fr_2_2_1').val();
						var fr_2_2_2 = $('#fr_2_2_2').val();
						var fr_2_2_3 = $('#fr_2_2_3').val();
						var fr_2_2_4 = $('#fr_2_2_4').val();
						var fr_2_2_5 = $('#fr_2_2_5').val();
						var fr_2_2_6 = $('#fr_2_2_6').val();
						
						var fr_3_1_1 = $('#fr_3_1_1').val();
						var fr_3_1_2 = $('#fr_3_1_2').val();
						var fr_3_1_3 = $('#fr_3_1_3').val();
						var fr_3_1_4 = $('#fr_3_1_4').val();
						var fr_3_1_5 = $('#fr_3_1_5').val();
						var fr_3_1_6 = $('#fr_3_1_6').val();
						var fr_3_2_1 = $('#fr_3_2_1').val();
						var fr_3_2_2 = $('#fr_3_2_2').val();
						var fr_3_2_3 = $('#fr_3_2_3').val();
						var fr_3_2_4 = $('#fr_3_2_4').val();
						var fr_3_2_5 = $('#fr_3_2_5').val();
						var fr_3_2_6 = $('#fr_3_2_6').val();
						
						
							
						break;
					}
					else
					{
						var chk_dry = "0";
						var fr_1_1_1 = "0";
						var fr_1_1_2 = "0";
						var fr_1_1_3 = "0";
						var fr_1_1_4 = "0";
						var fr_1_1_5 = "0";
						var fr_1_1_6 = "0";
						var dry1 = "0";
						var dry2 = "0";
						var dry3 = "0";
						var dry4 = "0";
						var dry5 = "0";
						var dry6 = "0";
						var avg_dry = "0";
						var two1 = "0";
						var two2 = "0";
						var two3 = "0";
						var fr_1_2_1 = "0";
						var fr_1_2_2 = "0";
						var fr_1_2_3 = "0";
						var fr_1_2_4 = "0";
						var fr_1_2_5 = "0";
						var fr_1_2_6 = "0";
						
						var fr_2_1_1 = "0";
						var fr_2_1_2 = "0";
						var fr_2_1_3 = "0";
						var fr_2_1_4 = "0";
						var fr_2_1_5 = "0";
						var fr_2_1_6 = "0";
						var fr_2_2_1 = "0";
						var fr_2_2_2 = "0";
						var fr_2_2_3 = "0";
						var fr_2_2_4 = "0";
						var fr_2_2_5 = "0";
						var fr_2_2_6 = "0";
						
						var fr_3_1_1 = "0";
						var fr_3_1_2 = "0";
						var fr_3_1_3 = "0";
						var fr_3_1_4 = "0";
						var fr_3_1_5 = "0";
						var fr_3_1_6 = "0";
						var fr_3_2_1 = "0";
						var fr_3_2_2 = "0";
						var fr_3_2_3 = "0";
						var fr_3_2_4 = "0";
						var fr_3_2_5 = "0";
						var fr_3_2_6 = "0";
						
					}
				}
				
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&grade_fresh='+grade_fresh+'&slump_req='+slump_req+'&mix_temp='+mix_temp+'&w_con='+w_con+'&chk_slu='+chk_slu+'&mix_a1='+mix_a1+'&mix_a2='+mix_a2+'&mix_a3='+mix_a3+'&mix_a4='+mix_a4+'&mix_a5='+mix_a5+'&mix_a6='+mix_a6+'&mix_a7='+mix_a7+'&mix_a8='+mix_a8+'&mix_b1='+mix_b1+'&mix_b2='+mix_b2+'&mix_b3='+mix_b3+'&mix_b4='+mix_b4+'&mix_b5='+mix_b5+'&mix_b6='+mix_b6+'&mix_b7='+mix_b7+'&mix_b8='+mix_b8+'&mix_ratio='+mix_ratio+'&mix_wtr='+mix_wtr+'&slump1='+slump1+'&slump2='+slump2+'&slump3='+slump3+'&slump4='+slump4+'&slump5='+slump5+'&den1='+den1+'&den2='+den2+'&den3='+den3+'&den4='+den4+'&den5='+den5+'&bd_1='+bd_1+'&flow='+flow+'&ac_1='+ac_1+'&chk_dry='+chk_dry+'&fr_1_1_1='+fr_1_1_1+'&fr_1_1_2='+fr_1_1_2+'&fr_1_1_3='+fr_1_1_3+'&fr_1_1_4='+fr_1_1_4+'&fr_1_1_5='+fr_1_1_5+'&fr_1_1_6='+fr_1_1_6+'&dry1='+dry1+'&dry2='+dry2+'&dry3='+dry3+'&dry4='+dry4+'&dry5='+dry5+'&dry6='+dry6+'&avg_dry='+avg_dry+'&two1='+two1+'&two2='+two2+'&two3='+two3+'&fr_1_2_1='+fr_1_2_1+'&fr_1_2_2='+fr_1_2_2+'&fr_1_2_3='+fr_1_2_3+'&fr_1_2_4='+fr_1_2_4+'&fr_1_2_5='+fr_1_2_5+'&fr_1_2_6='+fr_1_2_6+'&fr_2_1_1='+fr_2_1_1+'&fr_2_1_2='+fr_2_1_2+'&fr_2_1_3='+fr_2_1_3+'&fr_2_1_4='+fr_2_1_4+'&fr_2_1_5='+fr_2_1_5+'&fr_2_1_6='+fr_2_1_6+'&fr_2_2_1='+fr_2_2_1+'&fr_2_2_2='+fr_2_2_2+'&fr_2_2_3='+fr_2_2_3+'&fr_2_2_4='+fr_2_2_4+'&fr_2_2_5='+fr_2_2_5+'&fr_2_2_6='+fr_2_2_6+'&fr_3_1_1='+fr_3_1_1+'&fr_3_1_2='+fr_3_1_2+'&fr_3_1_3='+fr_3_1_3+'&fr_3_1_4='+fr_3_1_4+'&fr_3_1_5='+fr_3_1_5+'&fr_3_1_6='+fr_3_1_6+'&fr_3_2_1='+fr_3_2_1+'&fr_3_2_2='+fr_3_2_2+'&fr_3_2_3='+fr_3_2_3+'&fr_3_2_4='+fr_3_2_4+'&fr_3_2_5='+fr_3_2_5+'&fr_3_2_6='+fr_3_2_6+'&amend_date='+amend_date;
				
				
				
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();	
				var amend_date = $('#amend_date').val();	
				var grade_fresh = $('#grade_fresh').val();
				var slump_req = $('#slump_req').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//Slump
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="slu")
					{
						if(document.getElementById('chk_slu').checked) {
								var chk_slu = "1";
						}
						else{
								var chk_slu = "0";
						}
						var mix_temp = $('#mix_temp').val();
						var w_con = $('#w_con').val();
						var mix_a1 = $('#mix_a1').val();
						var mix_a2 = $('#mix_a2').val();
						var mix_a3 = $('#mix_a3').val();
						var mix_a4 = $('#mix_a4').val();
						var mix_a5 = $('#mix_a5').val();
						var mix_a6 = $('#mix_a6').val();
						var mix_a7 = $('#mix_a7').val();
						var mix_a8 = $('#mix_a8').val();
						var mix_b1 = $('#mix_b1').val();
						var mix_b2 = $('#mix_b2').val();
						var mix_b3 = $('#mix_b3').val();
						var mix_b4 = $('#mix_b4').val();
						var mix_b5 = $('#mix_b5').val();
						var mix_b6 = $('#mix_b6').val();
						var mix_b7 = $('#mix_b7').val();
						var mix_b8 = $('#mix_b8').val();
						var mix_ratio = $('#mix_ratio').val();
						var mix_wtr = $('#mix_wtr').val();
						var slump1 = $('#slump1').val();
						var slump2 = $('#slump2').val();
						var slump3 = $('#slump3').val();
						var slump4 = $('#slump4').val();
						var slump5 = $('#slump5').val();
						var den1 = $('#den1').val();
						var den2 = $('#den2').val();
						var den3 = $('#den3').val();
						var den4 = $('#den4').val();
						var den5 = $('#den5').val();
						var bd_1 = $('#bd_1').val();
						var flow = $('#flow').val();
						var ac_1 = $('#ac_1').val();
						
							
						break;
					}
					else
					{
						var chk_slu = "0";
						var mix_temp = "0";
						var w_con = "0";
						var mix_a1 = "0";
						var mix_a2 = "0";
						var mix_a3 = "0";
						var mix_a4 = "0";
						var mix_a5 = "0";
						var mix_a6 = "0";
						var mix_a7 = "0";
						var mix_a8 = "0";
						var mix_b1 = "0";
						var mix_b2 = "0";
						var mix_b3 = "0";
						var mix_b4 = "0";
						var mix_b5 = "0";
						var mix_b6 = "0";
						var mix_b7 = "0";
						var mix_b8 = "0";
						var mix_ratio = "0";
						var mix_wtr = "0";
						var slump1 = "0";
						var slump2 = "0";
						var slump3 = "0";
						var slump4 = "0";
						var slump5 = "0";
						var den1 = "0";
						var den2 = "0";
						var den3 = "0";
						var den4 = "0";
						var den5 = "0";
						var bd_1 = "0";
						var flow = "0";
						var ac_1 = "0";
					}
				}
				
				//DRYING SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="SHR")
					{
						if(document.getElementById('chk_dry').checked) {
								var chk_dry = "1";
						}
						else{
								var chk_dry = "0";
						}
						
						var fr_1_1_1 = $('#fr_1_1_1').val();
						var fr_1_1_2 = $('#fr_1_1_2').val();
						var fr_1_1_3 = $('#fr_1_1_3').val();
						var fr_1_1_4 = $('#fr_1_1_4').val();
						var fr_1_1_5 = $('#fr_1_1_5').val();
						var fr_1_1_6 = $('#fr_1_1_6').val();
						var dry1 = $('#dry1').val();
						var dry2 = $('#dry2').val();
						var dry3 = $('#dry3').val();
						var dry4 = $('#dry4').val();
						var dry5 = $('#dry5').val();
						var dry6 = $('#dry6').val();
						var avg_dry = $('#avg_dry').val();
						var two1 = $('#two1').val();
						var two2 = $('#two2').val();
						var two3 = $('#two3').val();
						var fr_1_2_1 = $('#fr_1_2_1').val();
						var fr_1_2_2 = $('#fr_1_2_2').val();
						var fr_1_2_3 = $('#fr_1_2_3').val();
						var fr_1_2_4 = $('#fr_1_2_4').val();
						var fr_1_2_5 = $('#fr_1_2_5').val();
						var fr_1_2_6 = $('#fr_1_2_6').val();
						
						var fr_2_1_1 = $('#fr_2_1_1').val();
						var fr_2_1_2 = $('#fr_2_1_2').val();
						var fr_2_1_3 = $('#fr_2_1_3').val();
						var fr_2_1_4 = $('#fr_2_1_4').val();
						var fr_2_1_5 = $('#fr_2_1_5').val();
						var fr_2_1_6 = $('#fr_2_1_6').val();
						var fr_2_2_1 = $('#fr_2_2_1').val();
						var fr_2_2_2 = $('#fr_2_2_2').val();
						var fr_2_2_3 = $('#fr_2_2_3').val();
						var fr_2_2_4 = $('#fr_2_2_4').val();
						var fr_2_2_5 = $('#fr_2_2_5').val();
						var fr_2_2_6 = $('#fr_2_2_6').val();
						
						var fr_3_1_1 = $('#fr_3_1_1').val();
						var fr_3_1_2 = $('#fr_3_1_2').val();
						var fr_3_1_3 = $('#fr_3_1_3').val();
						var fr_3_1_4 = $('#fr_3_1_4').val();
						var fr_3_1_5 = $('#fr_3_1_5').val();
						var fr_3_1_6 = $('#fr_3_1_6').val();
						var fr_3_2_1 = $('#fr_3_2_1').val();
						var fr_3_2_2 = $('#fr_3_2_2').val();
						var fr_3_2_3 = $('#fr_3_2_3').val();
						var fr_3_2_4 = $('#fr_3_2_4').val();
						var fr_3_2_5 = $('#fr_3_2_5').val();
						var fr_3_2_6 = $('#fr_3_2_6').val();
						
						
							
						break;
					}
					else
					{
						var chk_dry = "0";
						var fr_1_1_1 = "0";
						var fr_1_1_2 = "0";
						var fr_1_1_3 = "0";
						var fr_1_1_4 = "0";
						var fr_1_1_5 = "0";
						var fr_1_1_6 = "0";
						var dry1 = "0";
						var dry2 = "0";
						var dry3 = "0";
						var dry4 = "0";
						var dry5 = "0";
						var dry6 = "0";
						var avg_dry = "0";
						var two1 = "0";
						var two2 = "0";
						var two3 = "0";
						var fr_1_2_1 = "0";
						var fr_1_2_2 = "0";
						var fr_1_2_3 = "0";
						var fr_1_2_4 = "0";
						var fr_1_2_5 = "0";
						var fr_1_2_6 = "0";
						
						var fr_2_1_1 = "0";
						var fr_2_1_2 = "0";
						var fr_2_1_3 = "0";
						var fr_2_1_4 = "0";
						var fr_2_1_5 = "0";
						var fr_2_1_6 = "0";
						var fr_2_2_1 = "0";
						var fr_2_2_2 = "0";
						var fr_2_2_3 = "0";
						var fr_2_2_4 = "0";
						var fr_2_2_5 = "0";
						var fr_2_2_6 = "0";
						
						var fr_3_1_1 = "0";
						var fr_3_1_2 = "0";
						var fr_3_1_3 = "0";
						var fr_3_1_4 = "0";
						var fr_3_1_5 = "0";
						var fr_3_1_6 = "0";
						var fr_3_2_1 = "0";
						var fr_3_2_2 = "0";
						var fr_3_2_3 = "0";
						var fr_3_2_4 = "0";
						var fr_3_2_5 = "0";
						var fr_3_2_6 = "0";
						
					}
				}
				
				var idEdit = $('#idEdit').val(); 

				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&grade_fresh='+grade_fresh+'&slump_req='+slump_req+'&mix_temp='+mix_temp+'&w_con='+w_con+'&chk_slu='+chk_slu+'&mix_a1='+mix_a1+'&mix_a2='+mix_a2+'&mix_a3='+mix_a3+'&mix_a4='+mix_a4+'&mix_a5='+mix_a5+'&mix_a6='+mix_a6+'&mix_a7='+mix_a7+'&mix_a8='+mix_a8+'&mix_b1='+mix_b1+'&mix_b2='+mix_b2+'&mix_b3='+mix_b3+'&mix_b4='+mix_b4+'&mix_b5='+mix_b5+'&mix_b6='+mix_b6+'&mix_b7='+mix_b7+'&mix_b8='+mix_b8+'&mix_ratio='+mix_ratio+'&mix_wtr='+mix_wtr+'&slump1='+slump1+'&slump2='+slump2+'&slump3='+slump3+'&slump4='+slump4+'&slump5='+slump5+'&den1='+den1+'&den2='+den2+'&den3='+den3+'&den4='+den4+'&den5='+den5+'&bd_1='+bd_1+'&flow='+flow+'&ac_1='+ac_1+'&chk_dry='+chk_dry+'&fr_1_1_1='+fr_1_1_1+'&fr_1_1_2='+fr_1_1_2+'&fr_1_1_3='+fr_1_1_3+'&fr_1_1_4='+fr_1_1_4+'&fr_1_1_5='+fr_1_1_5+'&fr_1_1_6='+fr_1_1_6+'&dry1='+dry1+'&dry2='+dry2+'&dry3='+dry3+'&dry4='+dry4+'&dry5='+dry5+'&dry6='+dry6+'&avg_dry='+avg_dry+'&two1='+two1+'&two2='+two2+'&two3='+two3+'&fr_1_2_1='+fr_1_2_1+'&fr_1_2_2='+fr_1_2_2+'&fr_1_2_3='+fr_1_2_3+'&fr_1_2_4='+fr_1_2_4+'&fr_1_2_5='+fr_1_2_5+'&fr_1_2_6='+fr_1_2_6+'&fr_2_1_1='+fr_2_1_1+'&fr_2_1_2='+fr_2_1_2+'&fr_2_1_3='+fr_2_1_3+'&fr_2_1_4='+fr_2_1_4+'&fr_2_1_5='+fr_2_1_5+'&fr_2_1_6='+fr_2_1_6+'&fr_2_2_1='+fr_2_2_1+'&fr_2_2_2='+fr_2_2_2+'&fr_2_2_3='+fr_2_2_3+'&fr_2_2_4='+fr_2_2_4+'&fr_2_2_5='+fr_2_2_5+'&fr_2_2_6='+fr_2_2_6+'&fr_3_1_1='+fr_3_1_1+'&fr_3_1_2='+fr_3_1_2+'&fr_3_1_3='+fr_3_1_3+'&fr_3_1_4='+fr_3_1_4+'&fr_3_1_5='+fr_3_1_5+'&fr_3_1_6='+fr_3_1_6+'&fr_3_2_1='+fr_3_2_1+'&fr_3_2_2='+fr_3_2_2+'&fr_3_2_3='+fr_3_2_3+'&fr_3_2_4='+fr_3_2_4+'&fr_3_2_5='+fr_3_2_5+'&fr_3_2_6='+fr_3_2_6+'&amend_date='+amend_date;

		
				
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_fresh_concrete.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
				$('#btn_save').hide();
				getGlazedTiles();
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
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
        url: '<?php echo $base_url; ?>save_fresh_concrete.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
            $('#idEdit').val(data.id);
	
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
			$('#grade_fresh').val(data.grade_fresh);
			$('#slump_req').val(data.slump_req);
            var temp = $('#test_list').val();
				var aa= temp.split(",");	
			
			//Slump
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="slu")
					{
						var chk_slu = data.chk_slu;
						if(chk_slu=="1")
						{
							$('#txtslu').css("background-color","var(--success)"); 
						   $("#chk_slu").prop("checked", true); 
						}else{
							$('#txtslu').css("background-color","white"); 
							$("#chk_slu").prop("checked", false); 
						}
						$('#mix_temp').val(data.mix_temp);
						$('#w_con').val(data.w_con);
						$('#mix_a1').val(data.mix_a1);
						$('#mix_a2').val(data.mix_a2);
						$('#mix_a3').val(data.mix_a3);
						$('#mix_a4').val(data.mix_a4);
						$('#mix_a5').val(data.mix_a5);
						$('#mix_a6').val(data.mix_a6);
						$('#mix_a7').val(data.mix_a7);
						$('#mix_a8').val(data.mix_a8);
						$('#mix_b1').val(data.mix_b1);
						$('#mix_b2').val(data.mix_b2);
						$('#mix_b3').val(data.mix_b3);
						$('#mix_b4').val(data.mix_b4);
						$('#mix_b5').val(data.mix_b5);
						$('#mix_b6').val(data.mix_b6);
						$('#mix_b7').val(data.mix_b7);
						$('#mix_b8').val(data.mix_b8);
						$('#mix_ratio').val(data.mix_ratio);
						$('#mix_wtr').val(data.mix_wtr);
						$('#slump1').val(data.slump1);
						$('#slump2').val(data.slump2);
						$('#slump3').val(data.slump3);
						$('#slump4').val(data.slump4);
						$('#slump5').val(data.slump5);
						$('#den1').val(data.den1);
						$('#den2').val(data.den2);
						$('#den3').val(data.den3);
						$('#den4').val(data.den4);
						$('#den5').val(data.den5);	
						$('#bd_1').val(data.bd_1);	
						$('#flow').val(data.flow);	
						$('#ac_1').val(data.ac_1);	
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
						var chk_dry = data.chk_dry;
						if(chk_dry=="1")
						{
							$('#txtdry').css("background-color","white"); 
						   $("#chk_dry").prop("checked", true); 
						}else{
							$('#txtdry').css("background-color","var(--success)"); 
							$("#chk_dry").prop("checked", false); 
						}
						$('#fr_1_1_1').val(data.fr_1_1_1);
						$('#fr_1_1_2').val(data.fr_1_1_2);
						$('#fr_1_1_3').val(data.fr_1_1_3);
						$('#fr_1_1_4').val(data.fr_1_1_4);
						$('#fr_1_1_5').val(data.fr_1_1_5);
						$('#fr_1_1_6').val(data.fr_1_1_6);
						$('#dry1').val(data.dry1);
						$('#dry2').val(data.dry2);
						$('#dry3').val(data.dry3);
						$('#dry4').val(data.dry4);
						$('#dry5').val(data.dry5);
						$('#dry6').val(data.dry6);
						$('#avg_dry').val(data.avg_dry);
						$('#two1').val(data.two1);
						$('#two2').val(data.two2);
						$('#two3').val(data.two3);
						$('#fr_1_2_1').val(data.fr_1_2_1);
						$('#fr_1_2_2').val(data.fr_1_2_2);
						$('#fr_1_2_3').val(data.fr_1_2_3);
						$('#fr_1_2_4').val(data.fr_1_2_4);
						$('#fr_1_2_5').val(data.fr_1_2_5);
						$('#fr_1_2_6').val(data.fr_1_2_6);
						
						$('#fr_2_1_1').val(data.fr_2_1_1);
						$('#fr_2_1_2').val(data.fr_2_1_2);
						$('#fr_2_1_3').val(data.fr_2_1_3);
						$('#fr_2_1_4').val(data.fr_2_1_4);
						$('#fr_2_1_5').val(data.fr_2_1_5);
						$('#fr_2_1_6').val(data.fr_2_1_6);
						$('#fr_2_2_1').val(data.fr_2_2_1);
						$('#fr_2_2_2').val(data.fr_2_2_2);
						$('#fr_2_2_3').val(data.fr_2_2_3);
						$('#fr_2_2_4').val(data.fr_2_2_4);
						$('#fr_2_2_5').val(data.fr_2_2_5);
						$('#fr_2_2_6').val(data.fr_2_2_6);
						
						$('#fr_3_1_1').val(data.fr_3_1_1);
						$('#fr_3_1_2').val(data.fr_3_1_2);
						$('#fr_3_1_3').val(data.fr_3_1_3);
						$('#fr_3_1_4').val(data.fr_3_1_4);
						$('#fr_3_1_5').val(data.fr_3_1_5);
						$('#fr_3_1_6').val(data.fr_3_1_6);
						$('#fr_3_2_1').val(data.fr_3_2_1);
						$('#fr_3_2_2').val(data.fr_3_2_2);
						$('#fr_3_2_3').val(data.fr_3_2_3);
						$('#fr_3_2_4').val(data.fr_3_2_4);
						$('#fr_3_2_5').val(data.fr_3_2_5);
						$('#fr_3_2_6').val(data.fr_3_2_6);
						
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


