<?php 
session_start(); 
include("header.php");
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
		if(isset($_GET['job_no'])){
			$job_no=$_GET['job_no'];
			$job_no_main=$_GET['job_no'];
			
		}
		if(isset($_GET['lab_no'])){
			$lab_no=$_GET['lab_no'];
			$aa	=$_GET['lab_no'];
			
		}if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
			
		}if(isset($_GET['trf_no'])){
			$trf_no=$_GET['trf_no'];
			
			
		}
		$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_array($result_select4);
					$zone= $row_select4['grd_zone'];
									
				}
				
				$select_query3 = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0' ";
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$rec_sample_date= $row_select3['sample_rec_date'];					
				}
				
				$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
			$result_select2 = mysqli_query($conn, $select_query2);

			if (mysqli_num_rows($result_select2) > 0) {
				$row_select2 = mysqli_fetch_assoc($result_select2);
				$start_date= $row_select2['start_date'];
				$end_date= $row_select2['end_date'];
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
						<h2  style="text-align:center;">FINE AGGREGATE</h2>
					</div>
					<!--<div class="box-default">-->
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
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="" value="<?php echo $job_no;?>" name="lab_no" ReadOnly>
                                        <input type="hidden" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										 <!-- <label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
										 

										  <div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
										  </div>
										</div>
									</div>
									
								</div>
								
								<br>
				
								

								
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
									<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no;?>&&reports_nos=<?php echo $report_no;?>&&lab_no=<?php echo $lab_no;?>">Row Data</a>
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
	<?php } ?>
  <?php
	$test_check;
	 $select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
			
			if($r1['test_code']=="grd")
			{
				$test_check.="grd,";
			?>
	<div class="panel panel-default" id="grd">
	
      <div class="panel-heading" id="txtgrd">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
			<h4 class="panel-title">
			<b>GRADATION OF TESTING</b>
			</h4>
		</a>
		</h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">
							<div class="row">									
									
									<div class="col-lg-4">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_grd">1.</label>
													<input type="checkbox" class="visually-hidden" name="chk_grd"  id="chk_grd" value="chk_grd"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">GRADATION OF TESTING</label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">SAMPLE TAKEN :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sample_taken" name="sample_taken" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
													<input type="text" class="form-control" id="grd_s_d" name="grd_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
													<input type="text" class="form-control" id="grd_e_d" name="grd_e_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2"></div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Sieve Size In MM</label>
											</div>
										</div>
									</div>
								
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Retained Wt.in gm</label>
											</div>
										</div>
									</div>
										<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Cum. Wt.in gm</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Cum. % retained</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">% passing of sample</label>
											</div>
										</div>
									</div>
								</div>
								</br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">1.</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">10 (mm)</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_1" name="cum_wt_gm_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_1" name="ret_wt_gm_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_1" name="cum_ret_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pass_sample_1" name="pass_sample_1" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">2.</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">4.75 (mm)</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_2" name="cum_wt_gm_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_2" name="ret_wt_gm_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_2" name="cum_ret_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pass_sample_2" name="pass_sample_2" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">3.</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">2.36 (mm)</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_3" name="cum_wt_gm_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_3" name="ret_wt_gm_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_3" name="cum_ret_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pass_sample_3" name="pass_sample_3" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">4.</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">1.18 (mm)</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_4" name="cum_wt_gm_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_4" name="ret_wt_gm_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_4" name="cum_ret_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pass_sample_4" name="pass_sample_4" >
												</div>
											</div>
										</div>
								</div>
								
								<br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">5.</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">600 mic</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_5" name="cum_wt_gm_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_5" name="ret_wt_gm_5"  >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_5" name="cum_ret_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pass_sample_5" name="pass_sample_5" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">6.</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">300 mic</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_6" name="cum_wt_gm_6" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_6" name="ret_wt_gm_6"  >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_6" name="cum_ret_6" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pass_sample_6" name="pass_sample_6" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">7.</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">150 mic</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_7" name="cum_wt_gm_7" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_7" name="ret_wt_gm_7"  >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_7" name="cum_ret_7" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pass_sample_7" name="pass_sample_7" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">8.</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-2 control-label">075 mic</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_8" name="cum_wt_gm_8" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_8" name="ret_wt_gm_8"  >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_8" name="cum_ret_8" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pass_sample_8" name="pass_sample_8" >
												</div>
											</div>
										</div>
								</div>
								
								<br>
								<div class="row">
										<div class="col-lg-2">
											
										</div>
										<div class="col-lg-2">
											
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="blank_extra" name="blank_extra" >
												</div>
											</div>
										</div>

										<div class="col-lg-2">
										
											
											
										</div>
										<div class="col-lg-2">
										<div class="form-group">
												<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-6 control-label">Selected Zone</label>
												</div>											
										</div>
										</div>
										<div class="col-lg-2">
											<input type="text" class="form-control" id="grd_zone" name="grd_zone" value="<?php echo $zone;?>">
										</div>
								</div>
								<br>
							
								<div class="row">
										<div class="col-lg-6">
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">FM</label>
															<div class="col-sm-8">
																
																<input type="checkbox" name="chk_fm"  id="chk_fm" value="chk_fm"><br>
															</div>
													</div>
												</div>	

										<div class="col-lg-6">
										
											<div class="form-group">
												<div class="col-sm-6">
													<label for="inputEmail3" class="col-sm-6 control-label">FM</label>
												</div>
												<div class="col-sm-6">
													<input type="text" class="form-control" id="grd_fm" name="grd_fm">												
												</div>
											</div>
											
											
										</div>
										
								</div>
								<br>
									<div class="row">									
												<div class="col-lg-8">
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">SILT CONTENT</label>
															<div class="col-sm-8">
																
																<input type="checkbox" name="chk_silt"  id="chk_silt" value="chk_silt"><br>
															</div>
													</div>
												</div>	
												<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
													<input type="text" class="form-control" id="slt_s_d" name="slt_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
												</div>
											</div>
										</div>
										<div class="col-lg-2">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
														<input type="text" class="form-control" id="slt_e_d" name="slt_e_d" value="<?php echo date('d/m/Y', strtotime("$start_date +1 day")); ?>">
													</div>
												</div>
										</div>	
											</div>													
											<br>
										<div class="row">
											<div class="col-md-3">
											<div class="col-md-6">
												<div class="form-group">
												  <div class="col-sm-12">
													 <label for="inputEmail3" class="col-sm-12 control-label">Weight of Oven Dry Sample (B) gm</label>
												  </div>
												</div>
												</div>	
												<div class="col-md-6">
												<div class="form-group">
												  <div class="col-sm-12">
													<input type="text" class="form-control" id="silt_1" name="silt_1" >
												  </div>
												</div>
												</div>
																								
											</div>
											<div class="col-md-3">
											<div class="col-md-6">
												<div class="form-group">
												  <div class="col-sm-12">
													 <label for="inputEmail3" class="col-sm-12 control-label">Retain On 75 Micron Sieve (C) gm</label>
												  </div>
												</div>
												</div>	
												<div class="col-md-6">
												<div class="form-group">
												  <div class="col-sm-12">
													<input type="text" class="form-control" id="silt_2" name="silt_2" >
												  </div>
												</div>
												</div>
																								
											</div>	
											<div class="col-md-3">
											<div class="col-md-6">
												<div class="form-group">
												  <div class="col-sm-12">
													 <label for="inputEmail3" class="col-sm-12 control-label">Silt Content</label>
												  </div>
												</div>
												</div>	
												<div class="col-md-6">
												<div class="form-group">
												  <div class="col-sm-12">
													<input type="text" class="form-control" id="silt_content" name="silt_content" >
												  </div>
												</div>
												</div>
																								
											</div>													
										</div>
								</div>
					  </div>
					</div>
	
				
				<?php }
				
			else if($r1['test_code']=="wtr")
			{ $test_check.="wtr,";?>
		
				<div class="panel panel-default" id="wtr">
		<div class="panel-heading" id="txtwtr">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
					<h4 class="panel-title">
					<b>SPECIFIC GRAVITY & WATER ABSORPTION</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse3" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
									
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-1">
													<label for="chk_sp">1.</label>
													<input type="checkbox" class="visually-hidden" name="chk_sp"  id="chk_sp" value="chk_sp"><br>
											</div>
											<label for="inputEmail3" class="col-sm-6 control-label label-right">SPECIFIC GRAVITY & WATER ABSORPTION</label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
												<input type="text" class="form-control" id="wtr_s_d" name="wtr_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
													<input type="text" class="form-control" id="wtr_e_d" name="wtr_e_d" value="<?php echo date('d/m/Y', strtotime("$start_date +1 day")); ?>">
												</div>
											</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
												<div class="col-sm-8">
													<!--<label for="inputEmail3" class="col-sm-12 control-label">Weight of Basket in water A2 =</label>-->
												</div>
												<div class="col-sm-4">
													<input type="hidden" class="form-control" id="sp_bask_water" name="sp_bask_water" >
													<input type="hidden" class="form-control" id="sp_temp" name="sp_temp" ><br>
												</div>
										</div>
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col-lg-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Mass of Saturated Surface Dry Aggregate (A)</label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Mass of Pycnometercontaning Aggregate and Filled with Distilled Water (B)</label>
										</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Mass of Pycnometer Filled with Distilled Water (C)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Mass of Oven Dry Aggregate (D)</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity based on dry aggregate	= D / A - (B - C)</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group"><!--
									  <label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity based on SSD weight	= A / A - (B - C)</label>-->
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Apparent Specific Gravity = D / D - (B - C)</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Water Absorption = (A - D) / D X 100</label>
									</div>
									</div>
											
								</div>
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_wt_st_1" name="sp_wt_st_1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_wt_bas1" name="sp_wt_bas1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_s_1" name="sp_w_s_1">
									  </div>									
								     </div>
									</div>								
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_sur_1" name="sp_w_sur_1" >
									  </div>
									</div>
									</div>													
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_specific_gravity_1" name="sp_specific_gravity_1" readonly>
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="hidden" class="form-control" id="sp_specific_gravity_11" name="sp_specific_gravity_11"readonly>
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_apr1" name="sp_apr1" readonly>
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_water_abr_1" name="sp_water_abr_1" readonly>
									</div>
								    </div>
								</div>
							</div>
							<br>						
							<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 2-->
								<div class="row">
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_wt_st_2" name="sp_wt_st_2"  >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_wt_bas2" name="sp_wt_bas2"  >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_s_2" name="sp_w_s_2">
									  </div>									
								     </div>
									</div>										
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_sur_2" name="sp_w_sur_2" >
									  </div>
									</div>
									</div>													
																
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_specific_gravity_2" name="sp_specific_gravity_2" readonly>
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="hidden" class="form-control" id="sp_specific_gravity_22" name="sp_specific_gravity_22"readonly>
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_apr2" name="sp_apr2"readonly>
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_water_abr_2" name="sp_water_abr_2" readonly>
									</div>
								    </div>
								</div>
							</div>
								<br>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  
									</div>
									</div>	
									<div class="col-lg-4">
									<div class="col-sm-12">
										<input type="hidden" class="form-control" id="sp_sample_ca" name="sp_sample_ca" >
									  </div>
									</div>	
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
									</div>
									</div>
									<div class="col-sm-1">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_specific_gravity" name="sp_specific_gravity" >
									  </div>
									</div>
									</div>
									<div class="col-sm-1">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="hidden" class="form-control" id="sp_specific_gravity1" name="sp_specific_gravity1" >
									  </div>
									</div>
									</div>																										
									<div class="col-sm-1">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_avg_apr" name="sp_avg_apr" >
									  </div>
									</div>
									</div>
									<div class="col-sm-1">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_water_abr" name="sp_water_abr" >
									  </div>
									</div>
									</div>									
								</div>
						</div>
				  </div>
	</div>
			
			<?php }
			
			else if($r1['test_code']=="alk")
			{ $test_check.="alk,";?>
		
		<div class="panel panel-default" id="alk">
			<div class="panel-heading" id="txtalk">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse_alk">
						<h4 class="panel-title">
						<b>ALKALI REACTIVITY</b>
						</h4>
					</a>
				</h4>
			</div>
			<div id="collapse_alk" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row">									
						<div class="col-lg-8">
							<div class="form-group">
									<div class="col-sm-1">
										<label for="chk_alk">3.</label>
										<input type="checkbox" class="visually-hidden" name="chk_alk"  id="chk_alk" value="chk_alk"><br>
									</div>
								<label for="inputEmail3" class="col-sm-4 control-label label-right">Alkali Ractivities</label>
							</div>
						</div>
						<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
													<input type="text" class="form-control" id="alk_s_d" name="alk_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
												</div>
											</div>
										</div>
										<div class="col-lg-2">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
														<input type="text" class="form-control" id="alk_e_d" name="alk_e_d" value="<?php echo date('d/m/Y', strtotime("$start_date +1 day")); ?>">
													</div>
												</div>
										</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<div class="col-sm-12">
									<label for="inputEmail3" class="col-sm-12 control-label"> Length of Speciment after 24 hr</label>
								</div>
							</div>
						</div>				
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_a1" name="alk_a1">
								</div>									
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_b1" name="alk_b1">
								</div>									
							</div>
						</div>								
					</div>
					<br>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<div class="col-sm-12">
									<label for="inputEmail3" class="col-sm-12 control-label"> Length of Speciment after 7 days</label>
								</div>
							</div>
						</div>				
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_a2" name="alk_a2">
								</div>									
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_b2" name="alk_b2">
								</div>									
							</div>
						</div>								
					</div>
					<br>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<div class="col-sm-12">
									<label for="inputEmail3" class="col-sm-12 control-label"> Length of Speciment after 28 days</label>
								</div>
							</div>
						</div>				
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_a3" name="alk_a3">
								</div>									
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_b3" name="alk_b3">
								</div>									
							</div>
						</div>								
					</div>
					<br>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<div class="col-sm-12">
									<label for="inputEmail3" class="col-sm-12 control-label"> Length of Speciment after 6 Months</label>
								</div>
							</div>
						</div>				
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_a4" name="alk_a4">
								</div>									
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_b4" name="alk_b4">
								</div>									
							</div>
						</div>								
					</div>
					<br>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<div class="col-sm-12">
									<label for="inputEmail3" class="col-sm-12 control-label"> Length of Speciment after 365 days</label>
								</div>
							</div>
						</div>				
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_a5" name="alk_a5">
								</div>									
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="text" class="form-control" id="alk_b5" name="alk_b5">
								</div>									
							</div>
						</div>								
					</div>
				</div>
			</div>
		</div>
			
			<?php }
			 	
				else if($r1['test_code']=="sou")
			{ $test_check.="sou,";?>
		
				<div class="panel panel-default" id="sou">
		<div class="panel-heading" id="txtsou">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
					<h4 class="panel-title">
					<b>SOUNDNESS</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse7" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-4">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_sou">4.</label>
													<input type="checkbox" class="visually-hidden" name="chk_sou"  id="chk_sou" value="chk_sou"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SOUNDNESS</label>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<select class="form-control" name="wom1" id="wom1">
												<option value="N1">NA<sub>2</sub>SO<sub>4</sub></option>
												<option value="M1">Mg<sub>2</sub>SO<sub>4</sub></option>
											</select>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
													<input type="text" class="form-control" id="sou_s_d" name="sou_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
												</div>
											</div>
										</div>
										<div class="col-lg-2">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
														<input type="text" class="form-control" id="sou_e_d" name="sou_e_d" value="<?php echo date('d/m/Y', strtotime("$start_date +6 day")); ?>">
													</div>
												</div>
										</div>
									
								</div>
								<Br>
								<div class="row">
									<div class="col-lg-12">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">SIEVE SIZE</label>
									</div>
									</div>		
								</div>
								<Br>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Passing</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Retained</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Grading of original sample percent</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight of test fractions before test</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Percentage passing finer sieve after test (Actual Percentage loss)</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight average(Corrected Percentage loss)</label>
									</div>
									</div>									
								</div>
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">	
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">150 mic</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">-</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="go1" name="go1" value="5.0">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wt1" name="wt1">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pp1" name="pp1">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wa1" name="wa1">
									  </div>									
								     </div>
									</div>								
									
							</div>
							<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">	
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">300 mic</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">150 mic</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="go2" name="go2" value="11.4">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wt2" name="wt2">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pp2" name="pp2">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wa2" name="wa2">
									  </div>									
								     </div>
									</div>								
									
							</div>
							<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">	
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">600 mic</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">300 mic</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="go3" name="go3" value="26.0">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wt3" name="wt3">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pp3" name="pp3">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wa3" name="wa3">
									  </div>									
								     </div>
									</div>								
									
							</div>
							<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">	
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">1.18 mm</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">600 mic</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="go4" name="go4" value="25.2">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wt4" name="wt4">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pp4" name="pp4">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wa4" name="wa4">
									  </div>									
								     </div>
									</div>								
									
							</div>
							<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">	
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">2.36 mm</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">1.18 mm</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="go5" name="go5" value="17.0">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wt5" name="wt5">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pp5" name="pp5">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wa5" name="wa5">
									  </div>									
								     </div>
									</div>								
									
							</div>
							<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">	
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">4.75 mm</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">2.36 mm</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="go6" name="go6" value="10.8">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wt6" name="wt6">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pp6" name="pp6">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wa6" name="wa6">
									  </div>									
								     </div>
									</div>								
									
							</div>
							<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">	
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">10 mm</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">4.75 mm</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="go7" name="go7" value="4.6">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wt7" name="wt7">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pp7" name="pp7">
									  </div>									
								     </div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wa7" name="wa7">
									  </div>									
								     </div>
									</div>								
									
							</div>
							<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									
									
									<div class="col-lg-10">
									<div class="form-group">
									  <div class="col-sm-12">
										 <label for="inputEmail3" class="col-sm-12 control-label"> Result : Soundness : =</label>
									  </div>
									</div>
									</div>				
									<div class="col-lg-4">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="soundness" name="soundness">
									  </div>									
								     </div>
									</div>								
									
							</div>
							</div>
				  </div>
				</div>
				
			<?php }
				
				else if($r1['test_code']=="den")
			{ $test_check.="den,";?>
				<div class="panel panel-default" id="den">
					<div class="panel-heading" id="txtden">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse15">
							<h4 class="panel-title">
							<b>BULK DENSITY</b>
							</h4>
						</a>
					</h4>
				</div>
				<div id="collapse15" class="panel-collapse collapse">
								<div class="panel-body">
										<div class="row">									
											<div class="col-lg-8">
												<div class="form-group">
														<div class="col-sm-1">
															<label for="chk_den">1.</label>
															<input type="checkbox" class="visually-hidden" name="chk_den"  id="chk_den" value="chk_den"><br>
														</div>
													<label for="inputEmail3" class="col-sm-4 control-label label-right">BULK DENSITY</label>
												</div>
											</div>
											<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
													<input type="text" class="form-control" id="den_s_d" name="den_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
												</div>
											</div>
										</div>
										<div class="col-lg-2">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
														<input type="text" class="form-control" id="den_e_d" name="den_e_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
													</div>
												</div>
										</div>
											
										</div>
										<br>
										<br>
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-3">
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-12 control-label">Description</label>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-12 control-label">1</label>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-12 control-label">2</label>
													</div>
												</div>
											</div>		
										</div>
										<br>
										<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-3">
													<div class="form-group">
														<div class="col-sm-12">
															<label for="inputEmail3" class="col-sm-12 control-label">Volume of container (Ltr)</label>
														</div>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<div class="col-sm-12">
															<input type="text" class="form-control" id="m11" name="m11" >
												</div>
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="m12" name="m12" >
											  </div>
											</div>
											</div>				
																								
											</div>													
											
										</div>
									<br>
										<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
										<div class="row">
											<div class="col-md-12">
											<div class="col-md-3">
											<div class="form-group">
											  <div class="col-sm-12">
												 <label for="inputEmail3" class="col-sm-12 control-label">Wt.of Empty Container (Kg)</label>
											  </div>
											</div>
											</div>
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="m21" name="m21" >
											  </div>
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="m22" name="m22" >
											  </div>
											</div>
											</div>				
																								
											</div>													
											
									</div>
									<br>
										<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
										<div class="row">
											<div class="col-md-12">
											<div class="col-md-3">
											<div class="form-group">
											  <div class="col-sm-12">
												 <label for="inputEmail3" class="col-sm-12 control-label">Wt.of Empty Container + Agg. (Kg)</label>
											  </div>
											</div>
											</div>
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="m31" name="m31" >
											  </div>
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="m32" name="m32" >
											  </div>
											</div>
											</div>				
																							
											</div>													
											
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-3">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Wt.of Agg. (Kg)</label>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="den_mo_vol1" name="den_mo_vol1" >
													</div>
												</div>
											</div>			
											<div class="col-md-2">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="den_liter" name="den_liter" >
													</div>
												</div>
											</div>												
										</div>													
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-3">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Bulk Density (Compacted) (kg/ltr)</label>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="den_mo_vol2" name="den_mo_vol2" >
													</div>
												</div>
											</div>				
											<div class="col-md-2">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="den_kg_lit" name="den_kg_lit" >
													</div>
												</div>
											</div>												
										</div>													
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="col-lg-3">
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="form-group">
													<div class="col-sm-5">
														<input type="text" class="form-control" id="avg_wom" name="avg_wom"disabled>
													</div>
												</div>
											</div>																										
										</div>																										
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-3">
												<div class="form-group">
													<div class="col-sm-12">
														<!--<label for="inputEmail3" class="col-sm-12 control-label">Voids (%) = (Gs-r)*100/Gs</label>-->
													</div>
												</div>
											</div>
																						
										</div>													
									</div>
									<br>
									
									<div class="row">
											<div class="col-md-12">
											<div class="col-md-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-12 control-label">Description</label>
											</div>
											</div>
											
											<div class="col-md-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-12 control-label">1</label>
											</div>
											</div>
											
											
											<div class="col-md-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-12 control-label">2</label>
											</div>
											</div>
											
											<div class="col-md-3">
											<div class="form-group">
											  <!--<label for="inputEmail3" class="col-sm-12 control-label">(III)</label>-->
											</div>
											</div>
											</div>
											
											
													
										</div>
										<br>
										<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
										<div class="row">
											<div class="col-md-12">
											<div class="col-md-3">
											<div class="form-group">
											  <div class="col-sm-12">
												 <label for="inputEmail3" class="col-sm-12 control-label">Volume of container (Ltr)</label>
											  </div>
											</div>
											</div>
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="m13" name="m13" >
											  </div>
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="m23" name="m23" >
											  </div>
											</div>
											</div>																
											</div>													
									</div>
									<br>
										<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
										<div class="row">
											<div class="col-md-12">
											<div class="col-md-3">
											<div class="form-group">
											  <div class="col-sm-12">
												 <label for="inputEmail3" class="col-sm-12 control-label">Wt.of Empty Container (Kg)</label>
											  </div>
											</div>
											</div>
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="m33" name="m33" >
											  </div>
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="den_voids_1" name="den_voids_1" >
											  </div>
											</div>
											</div>															
											</div>													
											
									</div>
									<br>
										<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
										<div class="row">
											<div class="col-md-12">
											<div class="col-md-3">
											<div class="form-group">
											  <div class="col-sm-12">
												 <label for="inputEmail3" class="col-sm-12 control-label">Wt.of Empty Container + Agg. (Kg)</label>
											  </div>
											</div>
											</div>
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="weight_1" name="weight_1" >
											  </div>
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											  <div class="col-sm-12">
												<input type="text" class="form-control" id="weight_2" name="weight_2" >
											  </div>
											</div>
											</div>																	
											</div>													
											
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-3">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Wt.of Agg. (Kg)</label>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="asd_1" name="asd_1" >
													</div>
												</div>
											</div>			
											<div class="col-md-2">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="asd_2" name="asd_2" >
													</div>
												</div>
											</div>												
										</div>													
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-3">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Bulk Density (Loose) (kg/ltr)</label>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="den_voids" name="den_voids" >
													</div>
												</div>
											</div>				
											<div class="col-md-2">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="den_voids1" name="den_voids1" >
													</div>
												</div>
											</div>												
										</div>													
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="col-lg-3">
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="form-group">
													<div class="col-sm-5">
														<input type="text" class="form-control" id="avg_wom1" name="avg_wom1"disabled>
													</div>
												</div>
											</div>																										
										</div>																										
									</div>
									
										<br>
										<div class="row">
											<div class="col-md-12">
											<div class="col-lg-12">
											<div class="form-group">
											 <!-- <label for="inputEmail3" class="col-sm-6 control-label">Sand Confition at that time :- (Oven dry/S.S.D./Moisturized)</label>-->
											</div>
											</div>															
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-12">
											<div class="col-lg-4">
											<div class="form-group">
											 <!-- <label for="inputEmail3" class="col-sm-6 control-label">Bulk Density = Weight of Material / Volume of Mould  = </label>-->
											</div>
											</div>
											<div class="col-lg-2">
											<div class="form-group">
											  <input type="hidden" class="form-control" id="avg_wom1" name="avg_wom1" readonly> 
											</div>
											</div>
											<div class="col-lg-1">
											<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-6 control-label">/ </label>-->
											</div>
											</div>
											<div class="col-lg-2">
											<div class="form-group">
											<input type="hidden" class="form-control" id="vol" name="vol" >
											</div>
											</div>
											<div class="col-lg-1">
											<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-6 control-label">= </label>-->
											</div>
											</div>
											<div class="col-lg-2">
											<div class="form-group">
											  <input type="hidden" class="form-control" id="bdl" name="bdl" > 
											</div>			
											</div>
										</div>
										
										
								
								
								</div>
						  </div>
			</div>
				</div>
			
			
			<?php 
			 }else if($r1['test_code']=="pha")
				{
				$test_check.="pha,";?>
				
				<div class="panel panel-default" id="pha">
		<div class="panel-heading" id="txtpha">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_pha">
					<h4 class="panel-title">
						<b>pH </b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse_pha" class="panel-collapse collapse">
			<div class="panel-body">
			<!--Impact VALUE Start-->
				<br>
				<div class="row">									
					
					<div class="col-lg-8">
						<div class="form-group">
								<div class="col-sm-1">
									<label for="chk_pha">6.</label>
									<input type="checkbox" class="visually-hidden" name="chk_pha"  id="chk_pha" value="chk_pha"><br>
								</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">pH</label>
						</div>
					</div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Methods</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">S1</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">S2</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Volume in ml of sample taken (V)</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="ph_s1_1" name="ph_s1_1" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="ph_s2_1" name="ph_s2_1" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">pH)</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="ph_s1_2" name="ph_s1_2" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="ph_s2_2" name="ph_s2_2" >
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Average pH</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="avg_ph" name="avg_ph" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>			
	
				<?php
				}else if($r1['test_code']=="clr")
				{
				$test_check.="clr,";?>
				
				<div class="panel panel-default" id="clr">
		<div class="panel-heading" id="txtclr">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_clr">
					<h4 class="panel-title">
						<b>Chloride Content</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse_clr" class="panel-collapse collapse">
			<div class="panel-body">
			<!--Impact VALUE Start-->
				<br>
				<div class="row">									
					<div class="col-lg-8">
						<div class="form-group">
								<div class="col-sm-1">
									<label for="chk_clr">7.</label>
									<input type="checkbox" class="visually-hidden" name="chk_clr"  id="chk_clr" value="chk_clr"><br>
								</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">Chloride Content</label>
						</div>
					</div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Methods</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">S1</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">S2</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Weight of Soil Sample</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s1_1" name="clr_s1_1" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s2_1" name="clr_s2_1" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Weight of Water</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s1_2" name="clr_s1_2" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s2_2" name="clr_s2_2" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Water / Soil Ratio (gm/g) W</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s1_3" name="clr_s1_3" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s2_3" name="clr_s2_3" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Volume of AgNo3.0.1 Solution (ml), V5</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s1_4" name="clr_s1_4" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s2_4" name="clr_s2_4" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Volume of STD NH4SCn Solutions (ml), V6</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s1_5" name="clr_s1_5" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s2_5" name="clr_s2_5" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">CT - normality of NH4SCn</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s1_6" name="clr_s1_6" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s2_6" name="clr_s2_6" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Chloride = 0.003546*W X {(V5 - (10 x CT x V6))}</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s1_7" name="clr_s1_7" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="clr_s2_7" name="clr_s2_7" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="av_clr" name="av_clr" >
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>			
	
				<?php
				}else if($r1['test_code']=="sil")
				{
				$test_check.="sil,";?>
				
				<div class="panel panel-default" id="sil">
		<div class="panel-heading" id="txtslp">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_slp">
					<h4 class="panel-title">
						<b>SILT CONTENT</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse_slp" class="panel-collapse collapse">
			<div class="panel-body">
			<!--Impact VALUE Start-->
				<br>
				<div class="row">									
					<div class="col-lg-8">
						<div class="form-group">
								<div class="col-sm-1">
									<label for="chk_slp">7.</label>
									<input type="checkbox" class="visually-hidden" name="chk_slp"  id="chk_slp" value="chk_slp"><br>
								</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">SILT CONTENT</label>
						</div>
					</div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">DESCRIPTION</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">S1</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">S2</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (V1), ml</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="slp_s1_1" name="slp_s1_1" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="slp_s2_1" name="slp_s2_1" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Volume of Silt after three hours (V2), ml </label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="slp_s1_2" name="slp_s1_2" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="slp_s2_2" name="slp_s2_2" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Percentage Silt by Volume V2/V1X100 %</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="slp_s1_3" name="slp_s1_3" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="slp_s2_3" name="slp_s2_3" >
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group"><!--
							<label for="inputEmail3" class="col-sm-12 control-label">Weight of Residue after ignition d = (C-B) gm</label>-->
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="hidden" class="form-control" id="slp_s1_4" name="slp_s1_4" readonly>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="hidden" class="form-control" id="slp_s2_4" name="slp_s2_4" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group"><!--
							<label for="inputEmail3" class="col-sm-12 control-label">S04 (%) = 41.15*D/A</label>-->
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="hidden" class="form-control" id="slp_s1_5" name="slp_s1_5" readonly>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="hidden" class="form-control" id="slp_s2_5" name="slp_s2_5" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="avg_sul" name="avg_sul" readonly>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>			
	
				<?php
				}
				else if($r1['test_code']=="dtm")
				{
				$test_check.="dtm,";?>
				
				<div class="panel panel-default" id="dtm">
		<div class="panel-heading" id="txtdtm">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_dtm">
					<h4 class="panel-title">
						<b>DELETERIOUS MATERIAL</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse_dtm" class="panel-collapse collapse">
			<div class="panel-body">
			<!--Impact VALUE Start-->
				<br>
				<div class="row">									
					<div class="col-lg-8">
						<div class="form-group">
								<div class="col-sm-1">
									<label for="chk_dtm">8.</label>
									<input type="checkbox" class="visually-hidden" name="chk_dtm"  id="chk_dtm" value="chk_dtm"><br>
								</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">DELETERIOUS MATERIAL</label>
						</div>
					</div>
					<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
													<input type="text" class="form-control" id="del_s_d" name="del_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
												</div>
											</div>
										</div>
										<div class="col-lg-2">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
														<input type="text" class="form-control" id="del_e_d" name="del_e_d" value="<?php echo date('d/m/Y', strtotime("$start_date +3 day")); ?>">
													</div>
												</div>
										</div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Deleterious Material </label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">i. % Finer than 75u</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Trial I</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Trial II</label>
						</div>
					</div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Wt.of Sample in gms (A)</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_1_1" name="dele_1_1" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_3_1" name="dele_3_1" >
						</div>
					</div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Wt.of Washed Retained Sample on 75 Micron IS Sieve (after the Oven dried) in gms</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_1_2" name="dele_1_2" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_3_2" name="dele_3_2" >
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group"><!--
							<label for="inputEmail3" class="col-sm-12 control-label">Weight of sample gm C</label>-->
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="hidden" class="form-control" id="dele_1_3" name="dele_1_3" readonly>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="hidden" class="form-control" id="dele_3_3" name="dele_3_3" readonly>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">% 75 micron IS Sieve (A-B)/Ax100</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_1_4" name="dele_1_4" readonly>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_3_4" name="dele_3_4" readonly>
						</div>
					</div>
					
				</div>
				<br>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">ii. % Clay nd Lumps</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Wt.of Oven dry Sample in gms (A)</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_2_1" name="dele_2_1" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_4_1" name="dele_4_1" >
						</div>
					</div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Wt.of Sample after removal of clay lump in gm (b)</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_2_2" name="dele_2_2" >
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_4_2" name="dele_4_2" >
						</div>
					</div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">% Clay lumps = (A-B)/Ax100</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_2_3" name="dele_2_3" readonly>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_4_3" name="dele_4_3" readonly>
						</div>
					</div>
					
				</div>
				<br>
			</div>
		</div>
    </div>			
				
				<?php
				}else if($r1['test_code']=="aoi")
			{ $test_check.="aoi,";?>
				<div class="panel panel-default" id="aoi">
		<div class="panel-heading" id="txtaoi">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_aoi">
					<h4 class="panel-title">
						<b>ORGANIC IMPURITIES</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse_aoi" class="panel-collapse collapse">
			<div class="panel-body">
			<!--Impact VALUE Start-->
				<br>
				<div class="row">									
					<div class="col-lg-8">
						<div class="form-group">
								<div class="col-sm-1">
									<label for="chk_aoi">9.</label>
									<input type="checkbox" class="visually-hidden" name="chk_aoi"  id="chk_aoi" value="chk_aoi"><br>
								</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">ORGANIC IMPURITIES</label>
						</div>
					</div>
					<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
													<input type="text" class="form-control" id="org_s_d" name="or_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
												</div>
											</div>
										</div>
										<div class="col-lg-2">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
														<input type="text" class="form-control" id="org_e_d" name="org_e_d" value="<?php echo date('d/m/Y', strtotime("$start_date +4 day")); ?>">
													</div>
												</div>
										</div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">ORGANIC IMPURITIES </label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Fill Solutions upto Mark</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="aoi_1" name="aoi_1" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Fill Sand upto mark</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="aoi_2" name="aoi_2" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Further fill solution upto mark</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="aoi_3" name="aoi_3" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Observation</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="aoi_4" name="aoi_4" value="Visual Match With Standard Solution, Organic Impurities Not Detected.">
						</div>
					</div>
				</div>
				
			</div>
		</div>
    </div>			
	
				<?php } else if ($r1['test_code'] == "fne") {
										$test_check .= "fne,"; ?>
										
										<div class="panel panel-default" id="fne">
											<div class="panel-heading" id="txtfne">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse6ff">
														<h4 class="panel-title">
															<b>WATER ABSORPTION</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse6ff" class="panel-collapse collapse">
												<div class="panel-body">
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_finer">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_finer" id="chk_finer" value="chk_finer"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">WATER ABSORPTION</label>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">

															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label"></label>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Sample No - 1</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Sample No - 2</label>
															</div>
														</div>
													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
													<div class="row">


														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Wt.of saturated surface dry aggregate in air (W1)gm</label>
																</div>
															</div>
														</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="finer_a" name="finer_a">
																	</div>
																</div>
															</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="finer_a1" name="finer_a1">
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
													<div class="row">


														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Wt.of oven dried aggregate in air (w2)gm</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="finer_b" name="finer_b">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="finer_b1" name="finer_b1">
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 2-->
													<div class="row">


														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Water absorption = (W1-W2)*100/W2(%)</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="avg_finer" name="avg_finer">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="avg_finer1" name="avg_finer1">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Average</label>
																</div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="avg_fin_1" name="avg_fin_1"disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="hidden" class="form-control" id="avg_fin_2" name="avg_fin_2"disabled>
																</div>
															</div>
														</div>
													</div>
													
												</div>
											</div>
										</div>
				<?php } else if ($r1['test_code'] == "lbd") {
										$test_check .= "lbd,"; ?>
										
										<div class="panel panel-default" id="lbd">
											<div class="panel-heading" id="txtlbd">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
														<h4 class="panel-title">
															<b>BULKING OF SAND</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse6" class="panel-collapse collapse">
												<div class="panel-body">
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_lbd">15.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_lbd" id="chk_lbd" value="chk_lbd"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">BULKING OF SAND</label>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">

															</div>
														</div>

													</div>
													
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
													<div class="row">


														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">y, ml</label>
																</div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="lbd_1" name="lbd_1">
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
													<div class="row">


														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">% of Bulking</label>
																</div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="ans_lbd" name="ans_lbd" readonly>
																</div>
															</div>
														</div>

													</div>
													
												</div>
											</div>
										</div>
										
				<?php } else if ($r1['test_code'] == "fmc") {
										$test_check .= "fmc,"; ?>
										
										<div class="panel panel-default" id="fmc">
											<div class="panel-heading" id="txtfmc">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse6d">
														<h4 class="panel-title">
															<b>SURFACE MOISTURE</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse6d" class="panel-collapse collapse">
												<div class="panel-body">
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_fmc">16.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_fmc" id="chk_fmc" value="chk_fmc"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">SURFACE MOISTURE</label>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">

															</div>
														</div>

													</div>
													<br>
													<div class="row">


														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Specific Gravity</label>
																</div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="fmc_sp" name="fmc_sp">
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
													<div class="row">


														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Mc = Weight in g of container filled up to the mark with water</label>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="fmc_1" name="fmc_1">
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Ms = Weight in g of the sample</label>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="fmc_2" name="fmc_2">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">


														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">M = Weight in g of the sample and container filled to the mark with water</label>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="fmc_3" name="fmc_3">
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Vs = Weight in g of the water displaced by the sample ( Mc + Ms -M )</label>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="fmc_4" name="fmc_4">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">


														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Vd = Weight of the sample (Ms) / Specific Gravity </label>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="fmc_5" name="fmc_5">
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">P1  = (Vs - Vd / Ms - Vs) X 100</label>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="fmc_6" name="fmc_6">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">


														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">P2 = (Vs - Vd / Ms - Vd) X 100 </label>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="fmc_7" name="fmc_7">
																</div>
															</div>
														</div>
														

													</div>
													
													
												</div>
											</div>
										</div>
										
					
			<?php 
			 }
			 				
		}?>
	</div>
	<Br>
	<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
										
											<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="idEdit" id="idEdit"/>

											</div>
											<div class="col-sm-1">
												<!-- SAVE BUTTON LOGIC VAIBHAV-->
												<?php   
													$querys_job1 = "SELECT * FROM sand WHERE `is_deleted`='0' and lab_no='$lab_no'";
													$qrys_jobno = mysqli_query($conn,$querys_job1);
													$rows=mysqli_num_rows($qrys_jobno);
													if($rows < 1){ ?>
														<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
														<?php }													
															?>
												

											</div> 
											<div class="col-sm-1">
												<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>

											</div>
											<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
											<?php
											/*$val =  $_SESSION['isadmin'];
											if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {*/
											?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_sand.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											<!--<div class="col-sm-2">
 													<a target='_blank' href="<?php echo $base_url; ?>back_cal_report_blank/print_sand.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&ulr=<?php echo $ulr; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Blank</b></a>

 												</div>-->
											<?php //} ?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_sand.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div>
										</div>
									</div>
								</div>
	<hr>
							<div id="display_data">	
		<div class="row">
					<div class="col-lg-12">
						<table border="1px solid black" align="center" width="100%" id="aaaa">
							<tr>
								<th style="text-align:center;" width="10%"><label>Actions</label></th>
								<!--<th style="text-align:center;"><label>Report No.</label></th>-->	
								<th style="text-align:center;"><label>Job No.</label></th>
														<th style="text-align:center;"><label>Unique Identity No.</label></th>
								
																		

							</tr>
								<?php
							 $query = "select * from sand WHERE lab_no='$aa'  and `is_deleted`='0'";

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
 $(function () {
    $('.select2').select2();
  })
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();
	



	$('#chk_lbd').change(function(){
        if(this.checked)
		{
			lbd_auto();
			$('#txtlbd').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtlbd').css("background-color","white");	
		}
		
	});
	
	function lbd_auto()
	{
		var lbd_1 = randomNumberFromRange(150,170).toFixed(1);
		$('#lbd_1').val(lbd_1);
		var lbd1 = $('#lbd_1').val();
		var ans = (((+200) / (+lbd1)) - (+1)) * (+100);
		$('#ans_lbd').val(ans.toFixed(2));
		
	}
	
	$('#lbd_1').change(function(){
		var lbd1 = $('#lbd_1').val();
		var ans = (((+200) / (+lbd1)) - (+1)) * (+100);
		$('#ans_lbd').val(ans.toFixed(2));
	});
		
	
	$('#chk_lbd').change(function(){
        if(this.checked)
		{
			$('#txtlbd').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtlbd').css("background-color","white");
			$('#lbd_1').val(null);
			$('#ans_lbd').val(null);
		}
		
	});
	
	function fmc_auto()
	{
		
	}
	
	
	$('#chk_fmc').change(function(){
        if(this.checked)
		{
			fmc_auto();
			$('#txtfmc').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtfmc').css("background-color","white");	
			$('#fmc_sp').val(null);
			$('#fmc_1').val(null);
			$('#fmc_2').val(null);
			$('#fmc_3').val(null);
			$('#fmc_4').val(null);
			$('#fmc_5').val(null);
			$('#fmc_6').val(null);
			$('#fmc_7').val(null);
		}
		
	});
	
	$('#chk_silt').change(function(){
        if(this.checked)
		{
			$('#txtsil').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtsil').css("background-color","white");	
		}
		
	});
	
	$('#chk_grd').change(function(){
        if(this.checked)
		{
			$('#txtgrd').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtgrd').css("background-color","white");	
		}
		
	});
	
	
	
	$('#chk_sp').change(function(){
        if(this.checked)
		{
			$('#txtwtr').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtwtr').css("background-color","white");	
		}
		
	});
	
	
	
	$('#chk_den').change(function(){
        if(this.checked)
		{
			$('#txtden').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtden').css("background-color","white");	
		}
		
	});
	$('#chk_alk').change(function(){
        if(this.checked)
		{
			$('#txtalk').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtalk').css("background-color","white");	
		}
		
	});
	$('#chk_sou').change(function(){
        if(this.checked)
		{
			$('#txtsou').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtsou').css("background-color","white");	
		}
		
	});
	
	function soundness_auto()
	{
		$('#txtsou').css("background-color","var(--success)");

			var go1 = 15.0;
			var go2 = 34.2;
			var go3 = 78.0;
			var go4 = 75.6;
			var go5 = 51.0;
			var go6 = 32.4;
			var go7 = 13.8;
			$('#go1').val(go1);
			$('#go2').val(go2);
			$('#go3').val(go3);
			$('#go4').val(go4);
			$('#go5').val(go5);
			$('#go6').val(go6);
			$('#go7').val(go7);

			var wt1 = "-";
			var wt2 = "-";
			var wt3 = 100;
			var wt4 = 100;
			var wt5 = 100;
			var wt6 = 100;
			var wt7 = "-";	
			
			$('#wt1').val(wt1); 
			$('#wt2').val(wt2); 
			$('#wt3').val(wt3); 
			$('#wt4').val(wt4); 
			$('#wt5').val(wt5); 
			$('#wt6').val(wt6); 
			$('#wt7').val(wt7); 

			var wa1 = "-";
			var wa2 = "-";
			var wa3 = randomNumberFromRange(0.20,0.50).toFixed(2);
			var wa4 = randomNumberFromRange(0.20,0.50).toFixed(2);
			var wa5 = randomNumberFromRange(0.20,0.50).toFixed(2);
			var wa6 = randomNumberFromRange(0.20,0.50).toFixed(2);
			var wa7 = randomNumberFromRange(0.20,0.50).toFixed(2);
			$('#wa1').val(wa1);
			$('#wa2').val(wa2);
			$('#wa3').val(wa3);
			$('#wa4').val(wa4);
			$('#wa5').val(wa5);
			$('#wa6').val(wa6);
			$('#wa7').val(wa7);
			
			var soundness = (+wa3) + (+wa4) + (+wa5) + (+wa6) + (+wa7);
			$('#soundness').val(soundness.toFixed(1));
			
			var g3 = $('#go3').val();
			var g4 = $('#go4').val();
			var g5 = $('#go5').val();
			var g6 = $('#go6').val();
			var g7 = $('#go7').val();
			
			var t3 = $('#wt3').val();
			var t4 = $('#wt4').val();
			var t5 = $('#wt5').val();
			var t6 = $('#wt6').val();
			var t7 = $('#wt7').val();
			
			var a3 = $('#wa3').val();
			var a4 = $('#wa4').val();
			var a5 = $('#wa5').val();
			var a6 = $('#wa6').val();
			var a7 = $('#wa7').val();
			
			var eqa3 = (+a3)/(+g3);
			var eqa4 = (+a4)/(+g4);
			var eqa5 = (+a5)/(+g5);
			var eqa6 = (+a6)/(+g6);
			var eqa7 = (+a7)/(+g7);
			
			var pp3 = (+eqa3)*100;
			var pp4 = (+eqa4)*100;
			var pp5 = (+eqa5)*100;
			var pp6 = (+eqa6)*100;
			var pp7 = (+eqa6)*100;
			
			$('#pp1').val("-");
			$('#pp2').val("-");
			$('#pp3').val(pp3.toFixed(2));
			$('#pp4').val(pp4.toFixed(2));
			$('#pp5').val(pp5.toFixed(2));
			$('#pp6').val(pp6.toFixed(2));
			$('#pp7').val(pp6.toFixed(2));
			
			var g_3 = $('#go3').val();
			var g_4 = $('#go4').val();
			var g_5 = $('#go5').val();
			var g_6 = $('#go6').val();
			var g_7 = $('#go7').val();
			
			var pp_3 = $('#pp3').val();
			var pp_4 = $('#pp4').val();
			var pp_5 = $('#pp5').val();
			var pp_6 = $('#pp6').val();
			var pp_7 = $('#pp7').val();
			
			var temp3 = (+g_3) * (+pp_3);
			var temp4 = (+g_4) * (+pp_4);
			var temp5 = (+g_5) * (+pp_5);
			var temp6 = (+g_6) * (+pp_6);
			var temp7 = (+g_7) * (+pp_7);
			
			var wa_3 = (+temp3) / 100;
			var wa_4 = (+temp4) / 100;
			var wa_5 = (+temp5) / 100;
			var wa_6 = (+temp6) / 100;
			var wa_7 = (+temp7) / 100;
			
			$('#wa3').val(wa_3.toFixed(2));
			$('#wa4').val(wa_4.toFixed(2));
			$('#wa5').val(wa_5.toFixed(2));
			$('#wa6').val(wa_6.toFixed(2));
			$('#wa7').val(wa_7.toFixed(2));
			
			var w_a3 = $('#wa3').val();
			var w_a4 = $('#wa4').val();
			var w_a5 = $('#wa5').val();
			var w_a6 = $('#wa6').val();
			var w_a7 = $('#wa7').val();
			
			var soundness2 = (+w_a3) + (+w_a4) + (+w_a5) + (+w_a6) + (+w_a7);
			$('#soundness').val(soundness2.toFixed(1));
			
			
			
	}
	
	//SOUNDNESS
	$('#chk_sou').change(function(){
        if(this.checked)
		{ 
			
			soundness_auto();

		}
		else
		{
					
					$('#soundness').val(null);
					$('#pp1').val(null);
					$('#pp2').val(null);
					$('#pp3').val(null);
					$('#pp4').val(null);
					$('#pp5').val(null);
					$('#pp6').val(null);
					$('#pp7').val(null);
					$('#wa1').val(null);
					$('#wa2').val(null);
					$('#wa3').val(null);
					$('#wa4').val(null);
					$('#wa5').val(null);
					$('#wa6').val(null);
					$('#wa7').val(null);
					$('#go1').val(null);
					$('#go2').val(null);
					$('#go3').val(null);
					$('#go4').val(null);
					$('#go5').val(null);
					$('#go6').val(null);
					$('#go7').val(null);
					$('#wt1').val(null); 
					$('#wt2').val(null); 
					$('#wt3').val(null); 
					$('#wt4').val(null); 
					$('#wt5').val(null); 
					$('#wt6').val(null); 
					$('#wt7').val(null); 

					//$('#txtsou').css("background-color","white");
		}
	});
	
	function frnt_cal()
	{
		var g1 = $('#go1').val();
		var g2 = $('#go2').val();
		var g3 = $('#go3').val();
		var g4 = $('#go4').val();
		var g5 = $('#go5').val();
		var g6 = $('#go6').val();
		var g7 = $('#go7').val();
		
		var p1 = $('#pp1').val();
		var p2 = $('#pp2').val();
		var p3 = $('#pp3').val();
		var p4 = $('#pp4').val();
		var p5 = $('#pp5').val();
		var p6 = $('#pp6').val();
		var p7 = $('#pp7').val();
		
		var wa1 = ((+p1) * (+g1)) / 100;
		var wa2 = ((+p2) * (+g2)) / 100;
		var wa3 = ((+p3) * (+g3)) / 100;
		var wa4 = ((+p4) * (+g4)) / 100;
		var wa5 = ((+p5) * (+g5)) / 100;
		var wa6 = ((+p6) * (+g6)) / 100;
		var wa7 = ((+p7) * (+g7)) / 100;
		
		$('#wa1').val(wa1.toFixed(2));
		$('#wa2').val(wa2.toFixed(2));
		$('#wa3').val(wa3.toFixed(2));
		$('#wa4').val(wa4.toFixed(2));
		$('#wa5').val(wa5.toFixed(2));
		$('#wa6').val(wa6.toFixed(2));
		$('#wa7').val(wa7.toFixed(2));
		
		var w1 = $('#wa1').val();
		var w2 = $('#wa2').val();
		var w3 = $('#wa3').val();
		var w4 = $('#wa4').val();
		var w5 = $('#wa5').val();
		var w6 = $('#wa6').val();
		var w7 = $('#wa7').val();
		
		var soundness = (+wa1) + (+wa2) + (+wa3) + (+wa4) + (+wa5) + (+wa6) + (+wa7);
		$('#soundness').val(soundness.toFixed(1));
			
		
	}
	
	$('#go1').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
			
	});$('#go2').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#go3').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#go4').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#go5').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#go6').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#go7').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});
	
	$('#pp1').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#pp2').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#pp3').change(function(){
		$('#txtsou').css("background-color","var(--success)");
		frnt_cal();		
	});$('#pp4').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#pp5').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#pp6').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});$('#pp7').change(function(){
		$('#txtsou').css("background-color","var(--success)");	
		frnt_cal();
	});
	
	function alk_auto()
	{
		$('#txtalk').css("background-color","var(--success)");	
		$('#alk_a1').val(randomNumberFromRange(281.50,281.53).toFixed(2));
		$('#alk_b1').val(randomNumberFromRange(281.50,281.53).toFixed(2));
		var alk1 = $('#alk_a1').val();
		var alkb1 = $('#alk_b1').val();
		$('#alk_a2').val(((+alk1) + (+randomNumberFromRange(0.08,0.09))).toFixed(2));
		$('#alk_b2').val(((+alkb1) + (+randomNumberFromRange(0.08,0.09))).toFixed(2));
		var alk2 = $('#alk_a2').val();
		var alkb2 = $('#alk_b2').val();
		
		$('#alk_a3').val(((+alk2) + (+randomNumberFromRange(0.08,0.09))).toFixed(2));
		$('#alk_b3').val(((+alkb2) + (+randomNumberFromRange(0.08,0.09))).toFixed(2));
		var alk3 = $('#alk_a3').val();
		var alkb3 = $('#alk_b3').val();
		
		$('#alk_a4').val(((+alk3) + (+randomNumberFromRange(0.08,0.09))).toFixed(2));
		$('#alk_b4').val(((+alkb3) + (+randomNumberFromRange(0.08,0.09))).toFixed(2));
		var alk4 = $('#alk_a4').val();
		var alkb4 = $('#alk_b4').val();
		
		$('#alk_a5').val(((+alk4) + (+randomNumberFromRange(0.08,0.09))).toFixed(2));
		$('#alk_b5').val(((+alkb4) + (+randomNumberFromRange(0.08,0.09))).toFixed(2));
		
		
		



		
	}
	
	//FINER
	$('#chk_alk').change(function(){
        if(this.checked)
		{ 
			alk_auto();	

		}
		else
		{
			$('#alk_a1').val(null);
			$('#alk_a2').val(null);
			$('#alk_a3').val(null);
			$('#alk_a4').val(null);
			$('#alk_a5').val(null);
			$('#alk_b1').val(null);
			$('#alk_b2').val(null);
			$('#alk_b3').val(null);
			$('#alk_b4').val(null);
			$('#alk_b5').val(null);			
			$('#txtalk').css("background-color","white");
		}
	});
	
	function finer_auto()
	{
		var avg_finer = randomNumberFromRange(2.00,3.98).toFixed(2);
			$('#avg_finer').val(avg_finer);
			var avg_finer1 = $('#avg_finer').val();
			var finer_a = 500;
			var eq1 = (+avg_finer1) * (+finer_a);
			var eq2 = (+finer_a) * 100;
			var eq3 = (+eq2) - (+eq1);
			var finer_b = (+eq3) / 100;	
			$('#finer_a').val(finer_a);
			$('#finer_b').val(finer_b.toFixed(2));	
	}
	
	$('#chk_finer').change(function(){
        if(this.checked)
		{ 
			finer_auto();	

		}
		else
		{
			$('#avg_finer').val(null);
			$('#finer_a').val(null);
			$('#finer_b').val(null);
						
			$('#txtfne').css("background-color","white");
		}
	});

	$('#avg_finer').change(function(){
        if ($("#chk_finer").is(':checked')) {
			$('#txtfne').css("background-color","var(--success)");
			var avg_finer = $('#avg_finer').val();
			var finer_a = $('#finer_a').val();			
			var eq1 = (+avg_finer) * (+finer_a);
			var eq2 = (+finer_a) * 100;
			var eq3 = (+eq2) - (+eq1);
			var finer_b = (+eq3) / 100;	
			//$('#avg_finer').val(avg_finer.toString().substring(0, avg_finer.toString().indexOf(".") + 3));
			
			$('#finer_b').val(finer_b.toFixed(1));
		}			
	});
	$('#finer_a').change(function(){
        $('#txtfne').css("background-color","var(--success)");
			var finer_b = $('#finer_b').val();
			var finer_a = $('#finer_a').val();			
			var eq1 = (+finer_a) - (+finer_b);
			var eq2 = (+eq1) / (+finer_a);
			var avg_finer = (+eq2) * 100;
				
			$('#avg_finer').val(avg_finer.toFixed(2));
	});
	$('#finer_b').change(function(){
        $('#txtfne').css("background-color","var(--success)");
			var finer_b = $('#finer_b').val();
			var finer_a = $('#finer_a').val();			
			var eq1 = (+finer_a) - (+finer_b);
			var eq2 = (+eq1) / (+finer_a);
			var avg_finer = (+eq2) * 100;
				
			$('#avg_finer').val(avg_finer.toFixed(2));
	});
	
		
		function sp_auto()
		{
			$('#txtwtr').css("background-color","var(--success)");
			
			
			var sp_wt_st_1 = randomNumberFromRange(504,510).toFixed(1);
			var sp_wt_st_2 = randomNumberFromRange(504,510).toFixed(1);
			
			$('#sp_wt_st_1').val(sp_wt_st_1);
			$('#sp_wt_st_2').val(sp_wt_st_2);
			
			var a1 = $('#sp_wt_st_1').val();
			var a2 = $('#sp_wt_st_2').val();
			
			var sp_wt_bas1 = randomNumberFromRange(1890,1900).toFixed(1);
			var sp_wt_bas2 = randomNumberFromRange(1890,1900).toFixed(1);
			
			$('#sp_wt_bas1').val(sp_wt_bas1);
			$('#sp_wt_bas2').val(sp_wt_bas2);
			
			var b1 = $('#sp_wt_bas1').val();
			var b2 = $('#sp_wt_bas2').val();
			
			
			var sp_w_sur_1 = randomNumberFromRange(1580,1585).toFixed(1);
			var sp_w_sur_2 = randomNumberFromRange(1580,1585).toFixed(1);
			
			$('#sp_w_sur_1').val(sp_w_sur_1);
			$('#sp_w_sur_2').val(sp_w_sur_2);
			
			var c1 = $('#sp_w_sur_1').val();
			var c2 = $('#sp_w_sur_2').val();
			
			var sp_w_s_1 = randomNumberFromRange(500,503).toFixed(1);
			var sp_w_s_2 = randomNumberFromRange(500,503).toFixed(1);
			
			$('#sp_w_s_1').val(sp_w_s_1);
			$('#sp_w_s_2').val(sp_w_s_2);
			
			var d1 = $('#sp_w_s_1').val();
			var d2 = $('#sp_w_s_2').val();
			
			var sp1 = (+a1) / ((+a1) - ((+b1) - (+c1)));
			var sp2 = (+a2) / ((+a2) - ((+b2) - (+c2)));
			
			$('#sp_specific_gravity_1').val(sp1.toFixed(3));
			$('#sp_specific_gravity_2').val(sp2.toFixed(3));
			
			var spp1 = $('#sp_specific_gravity_1').val();
			var spp2 = $('#sp_specific_gravity_2').val();
			
			var avg = ((+spp1) + (+spp2))/(+2);
			$('#sp_specific_gravity').val(avg.toFixed(3));
			
			var asp1 = (+d1) / ((+d1) - ((+b1) - (+c1)));
			var asp2 = (+d2) / ((+d2) - ((+b2) - (+c2)));
			
			$('#sp_apr1').val(asp1.toFixed(3));
			$('#sp_apr2').val(asp2.toFixed(3));
			
			var aspp1 = $('#sp_apr1').val();
			var aspp2 = $('#sp_apr2').val();
			
			var aavg = ((+aspp1) + (+aspp2))/(+2);
			$('#sp_avg_apr').val(aavg.toFixed(3));
			
			
			var cal1 = (+a1)- (+d1);
			var cal2 = (+a2)- (+d2);
			var c1 = (+cal1) / (+d1);
			var c2 = (+cal2) / (+d2);
			
			var wtr1 = (+c1) * (+100);
			var wtr2 = (+c2) * (+100);
			
			$('#sp_water_abr_1').val(wtr1.toFixed(3));
			$('#sp_water_abr_2').val(wtr2.toFixed(3));
			
			var wtrr1 = $('#sp_water_abr_1').val();
			var wtrr2 = $('#sp_water_abr_2').val();
			
			var wtrs = ((+wtrr1) + (+wtrr2))/(+2);
			$('#sp_water_abr').val(wtrs.toFixed(3));
			
			
			
			
			/* var sp_specificgravity = randomNumberFromRange(2.600,2.660).toFixed(3);  //(sp_specific_gravity)
			var sp_waterabr = randomNumberFromRange(1.22,1.28).toFixed(2);
			var sp_bask_water = randomNumberFromRange(1500,1700).toFixed(1);
			
			$('#sp_specific_gravity').val(sp_specificgravity);
			$('#sp_water_abr').val(sp_waterabr);
			$('#sp_bask_water').val(sp_bask_water);
			
			var sp_specific_gravity	= $('#sp_specific_gravity').val();	
			var sp_water_abr = $('#sp_water_abr').val();
			
			var tt = randomNumberFromRange(-0.010,0.010).toFixed(3);
			var jj = randomNumberFromRange(-0.010,0.020).toFixed(2);
			
			if((+jj) == 0.000){
				jj = 0.010;
			}
			
			var ran_diff = randomNumberFromRange(1,9).toFixed();
			
			if(ran_diff % 2 == 0){
				var sp_specific_gravity1 = (+sp_specific_gravity) - (+tt);
				var sp_specific_gravity2 = (+sp_specific_gravity) + (+tt);
				
				var sp_water_abr1 = (+sp_water_abr) + (+jj);
				var sp_water_abr2 = (+sp_water_abr) - (+jj);
				
				var sp_apr1 = (+sp_specific_gravity1) + (+tt);
				var sp_apr2 = (+sp_specific_gravity2) + (+tt);
				
				
			}else{
				var sp_specific_gravity1 = (+sp_specific_gravity) + (+tt);
				var sp_specific_gravity2 = (+sp_specific_gravity) - (+tt);
				
				var sp_water_abr1 = (+sp_water_abr) - (+jj);
				var sp_water_abr2 = (+sp_water_abr) + (+jj);
				
				var sp_apr1 = (+sp_specific_gravity1) + (+tt);
				var sp_apr2 = (+sp_specific_gravity2) + (+tt);
			}
			
			$('#sp_specific_gravity_1').val(sp_specific_gravity1.toFixed(3));
			$('#sp_specific_gravity_2').val(sp_specific_gravity2.toFixed(3));
			
			var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
			var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
			
			
			$('#sp_water_abr_1').val(sp_water_abr1.toFixed(2));
			$('#sp_water_abr_2').val(sp_water_abr2.toFixed(2));
			
			var sp_water_abr_1 = $('#sp_water_abr_1').val();
			var sp_water_abr_2 = $('#sp_water_abr_2').val();
			
			$('#sp_apr1').val(sp_apr1.toFixed(3));
			$('#sp_apr2').val(sp_apr2.toFixed(3));
			
			var sp_apr1 = $('#sp_apr1').val();
			var sp_apr2 = $('#sp_apr2').val();
			
			var sp_avg_apr = ((+sp_apr1) + (+sp_apr2))/2;
			$('#sp_avg_apr').val(sp_avg_apr.toFixed(3));
			
			var sp_wt_bas1 = randomNumberFromRange(500, 600);
			var sp_wt_bas2 = randomNumberFromRange(500, 600);
			
			var sp_wt_st_1 = (((+sp_water_abr_1) * (+sp_w_s_1))/100) + (+sp_w_s_1);
			var sp_wt_st_2 = (((+sp_water_abr_2) * (+sp_w_s_2))/100) + (+sp_w_s_1);
			
			$('#sp_wt_bas1').val(sp_wt_bas1.toFixed());
			$('#sp_wt_bas2').val(sp_wt_bas2.toFixed());
			
			
			var sp_wt_bas1 = $('#sp_wt_bas1').val();
			var sp_wt_bas2 = $('#sp_wt_bas2').val()
			var sp_w_sur_1 = (+sp_wt_bas1) - (+sp_bask_water);
			var sp_w_sur_2 = (+sp_wt_bas2) - (+sp_bask_water);
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			
			var sp_w_s_1 = randomNumberFromRange(500, 600);
			var sp_w_s_2 = randomNumberFromRange(500, 600);
			$('#sp_w_s_1').val(sp_w_s_1.toFixed(1));
			$('#sp_w_s_2').val(sp_w_s_2.toFixed(1));
			
			var w1 = $('#sp_water_abr_1').val();
			var w2 = $('#sp_water_abr_2').val();
			var c1 = $('#sp_w_s_1').val();
			var c2 = $('#sp_w_s_2').val();
			
			var sp_wt_st_1 = (((+w1) * (+c1))/100)+(+c1);
			var sp_wt_st_2 = (((+w2) * (+c2))/100)+(+c2);
			
			$('#sp_wt_st_1').val(sp_wt_st_1.toFixed(1));
			$('#sp_wt_st_2').val(sp_wt_st_2.toFixed(1));
			
			//Find C= G(B-A)
			var g1 = $('#sp_specific_gravity_1').val();
			var g2 = $('#sp_specific_gravity_2').val();
			
			var b1 = $('#sp_wt_st_1').val();
			var b2 = $('#sp_wt_st_2').val();
			
			var a1 = $('#sp_w_sur_1').val();
			var a2 = $('#sp_w_sur_2').val();
			
			var c1 = (g1) * ((+b1) - (+a1));
			var c2 = (g2) * ((+b2) - (+a2));
			$('#sp_w_s_1').val(c1.toFixed(1));
			$('#sp_w_s_2').val(c2.toFixed(1)); */
			
			
			/*var sp_wt_bas1 = $('#sp_wt_bas1').val();
			var sp_wt_bas2 = $('#sp_wt_bas2').val();
			var sp_wt_st_1 = $('#sp_wt_st_1').val();
			var sp_wt_st_2 = $('#sp_wt_st_2').val();
			
			var sp_w_sur_1 = (+sp_wt_bas1) - (+sp_bask_water);
			var sp_w_sur_2 = (+sp_wt_bas2) - (+sp_bask_water);
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			
			var sp_w_sur_1 = $('#sp_w_sur_1').val();
			var sp_w_sur_2 = $('#sp_w_sur_2').val();
			
			var sp_w_s_1 = (+sp_specific_gravity_1) * ((+sp_wt_st_1) - (+sp_w_sur_1));
			var sp_w_s_2 = (+sp_specific_gravity_2) * ((+sp_wt_st_2) - (+sp_w_sur_2));
			
			$('#sp_w_s_1').val(sp_w_s_1.toFixed(1));
			$('#sp_w_s_2').val(sp_w_s_2.toFixed(1));*/
			
			
			
			
			/*var sp_specific_gravity1 = (+sp_specific_gravity) + (+tt); //(sp_specific_gravity_1)_1
			$('#sp_specific_gravity_1').val(sp_specific_gravity1.toFixed(3));
			var sp_specific_gravity_1	= $('#sp_specific_gravity_1').val();				
			var tems1 = (+sp_specific_gravity) * 2;
			var sp_specific_gravity2 = ((+tems1)-(+sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
			$('#sp_specific_gravity_2').val(sp_specific_gravity2.toFixed(3));
			var sp_specific_gravity_2	= $('#sp_specific_gravity_2').val();*/
			// (sp_water_abr)_1
			
			
			/*var ttt = randomNumberFromRange(-0.02,0.02).toFixed(2);
			var sp_water_abr1 = (+sp_water_abr) + (+ttt); ////(sp_water_abr_1)_1
			$('#sp_water_abr_1').val(sp_water_abr1.toFixed(2));
			var sp_water_abr_1 = $('#sp_water_abr_1').val();
			var tems11 = (+sp_water_abr) * 2;
			var sp_water_abr2 = (+tems11)-(+sp_water_abr_1);// (sp_water_abr_2)_1 
			$('#sp_water_abr_2').val(sp_water_abr2.toFixed(2));
			var sp_water_abr_2 = $('#sp_water_abr_2').val();
						
			
			$('#sp_wt_st_1').val(2000);				
			$('#sp_wt_st_2').val(2000);				
			
			var a1 = $('#sp_wt_st_1').val();
			var a2 = $('#sp_wt_st_2').val();
			var g1 = $('#sp_specific_gravity_1').val();
			var g2 = $('#sp_specific_gravity_2').val();
			var wtr1 = $('#sp_water_abr_1').val();
			var wtr2 = $('#sp_water_abr_2').val();
			var equp1  = a1 * 100;
			var equp2  = a2 * 100;
			var eqdn1  = (+wtr1) + 100;
			var eqdn2  = (+wtr2) + 100;
			var sp_w_s_1 = equp1 / eqdn1;
			var sp_w_s_2 = equp2 / eqdn2;
			$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));	
			$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));				
			var b1 = $('#sp_w_s_1').val();
			var b2 = $('#sp_w_s_2').val();
			var sp_w_sur_1 = (+a1) - ((+b1) / (+g1));
			var sp_w_sur_2 = (+a2) - ((+b2) / (+g2));						
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));					
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			$('#sp_sample_ca').val(sp_sample_ca);
//sidhu
			var aa1 = $('#sp_wt_st_1').val();
			var aa2 = $('#sp_wt_st_2').val();
			var bb1 = $('#sp_w_s_1').val();
			var bb2 = $('#sp_w_s_2').val();
			var cc1 = $('#sp_w_sur_1').val();
			var cc2 = $('#sp_w_sur_2').val();
			
			
			var tempr1 = (+aa1) - (+cc1);
			var tempr2 = (+aa2) - (+cc2);
			var spg1 = (+bb1) / (+tempr1);
			var spg2 = (+bb2) / (+tempr2);
			
			$('#sp_specific_gravity_1').val(spg1.toFixed(3));
			$('#sp_specific_gravity_2').val(spg2.toFixed(3));
			
			var spg_1 = $('#sp_specific_gravity_1').val();
			var spg_2 = $('#sp_specific_gravity_2').val();
			
			var avg_t = (+spg_1) + (+spg_2);
			var sp_specific_ans = (+avg_t)/2;
			$('#sp_specific_gravity').val(sp_specific_ans.toFixed(3));
			
			var temp_wtr1 = (+aa1) - (+bb1);
			var temp_wtr2 = (+aa2) - (+bb2);
			
			var t_wtr1 = (+temp_wtr1) / (+bb1);
			var t_wtr2 = (+temp_wtr2) / (+bb2);
			
			var wtr11 = (+t_wtr1) * 100;
			var wtr22 = (+t_wtr2) * 100;
			
			$('#sp_water_abr_1').val(wtr11.toFixed(2));
			$('#sp_water_abr_2').val(wtr22.toFixed(2));
			
			//new added field
						$('#sp_bask_water').val(2);
						$('#sp_wt_bas1').val(2);
						$('#sp_wt_bas2').val(2);
						$('#sp_apr1').val(2);
						$('#sp_apr2').val(2);
						$('#sp_avg_apr').val(2);*/
		}
		
		//SPECIFIC GRAVITY
		$('#chk_sp').change(function(){
        if(this.checked)
		{  
			sp_auto();
			
		}
		else
		{
			$('#txtwtr').css("background-color","white");
			$('#sp_w_sur_1').val(null);
			$('#sp_w_s_1').val(null);
			$('#sp_wt_st_1').val(null);
			
			
			$('#sp_w_sur_2').val(null);
			$('#sp_w_s_2').val(null);
			$('#sp_wt_st_2').val(null);
								
			$('#sp_specific_gravity_1').val(null);
			$('#sp_specific_gravity_2').val(null);
			$('#sp_specific_gravity').val(null);
			$('#sp_water_abr_1').val(null);
			$('#sp_water_abr_2').val(null);
			$('#sp_water_abr').val(null);
			$('#sp_sample_ca').val(null);
			
			$('#sp_bask_water').val(null);
			$('#sp_wt_bas1').val(null);
			$('#sp_wt_bas2').val(null);
			$('#sp_apr1').val(null);
			$('#sp_apr2').val(null);
			$('#sp_avg_apr').val(null);
		}
	});


	
	$("#sp_wt_bas1, #sp_wt_bas2, #sp_bask_water, #sp_w_sur_1, #sp_w_sur_2, #sp_w_s_1, #sp_w_s_2").change(function(){
		$('#txtwtr').css("background-color","var(--success)");
		
			var a1 = $('#sp_wt_st_1').val();
			var a2 = $('#sp_wt_st_2').val();
			
		
			var b1 = $('#sp_wt_bas1').val();
			var b2 = $('#sp_wt_bas2').val();
			
			
			
			
			var c1 = $('#sp_w_sur_1').val();
			var c2 = $('#sp_w_sur_2').val();
			
			
			
			var d1 = $('#sp_w_s_1').val();
			var d2 = $('#sp_w_s_2').val();
			
			var sp1 = (+a1) / ((+a1) - ((+b1) - (+c1)));
			var sp2 = (+a2) / ((+a2) - ((+b2) - (+c2)));
			
			$('#sp_specific_gravity_1').val(sp1.toFixed(3));
			$('#sp_specific_gravity_2').val(sp2.toFixed(3));
			
			var spp1 = $('#sp_specific_gravity_1').val();
			var spp2 = $('#sp_specific_gravity_2').val();
			
			var avg = ((+spp1) + (+spp2))/(+2);
			$('#sp_specific_gravity').val(avg.toFixed(3));
			
			var asp1 = (+d1) / ((+d1) - ((+b1) - (+c1)));
			var asp2 = (+d2) / ((+d2) - ((+b2) - (+c2)));
			
			$('#sp_apr1').val(asp1.toFixed(3));
			$('#sp_apr2').val(asp2.toFixed(3));
			
			var aspp1 = $('#sp_apr1').val();
			var aspp2 = $('#sp_apr2').val();
			
			var aavg = ((+aspp1) + (+aspp2))/(+2);
			$('#sp_avg_apr').val(aavg.toFixed(3));
			
			
			var cal1 = (+a1)- (+d1);
			var cal2 = (+a2)- (+d2);
			var c1 = (+cal1) / (+d1);
			var c2 = (+cal2) / (+d2);
			
			var wtr1 = (+c1) * (+100);
			var wtr2 = (+c2) * (+100);
			
			$('#sp_water_abr_1').val(wtr1.toFixed(3));
			$('#sp_water_abr_2').val(wtr2.toFixed(3));
			
			var wtrr1 = $('#sp_water_abr_1').val();
			var wtrr2 = $('#sp_water_abr_2').val();
			
			var wtrs = ((+wtrr1) + (+wtrr2))/(+2);
			$('#sp_water_abr').val(wtrs.toFixed(3));
	});
	
	
	
	function den_auto()
	{
		$('#txtden').css("background-color","var(--success)");	
		
			// bulk Density Compacted
			var avg_wom = randomNumberFromRange(1.350,1.600).toFixed(3);
			$('#avg_wom').val(avg_wom);
			var avg_wom = $('#avg_wom').val();
			
			var aa = randomNumberFromRange(1,2).toFixed();
			if(aa==1)
				{
					var den_mo_vol2 = (+avg_wom) - 0.02;
					var den_kg_lit = (+avg_wom) + 0.02;
				}
				else if(aa==2)
				{
					var den_mo_vol2 = (+avg_wom) + 0.02;
					var den_kg_lit = (+avg_wom) - 0.02;
				}
			
			$('#den_mo_vol2').val(den_mo_vol2.toFixed(3));
			$('#den_kg_lit').val(den_kg_lit.toFixed(3));
			
			var m31 = randomNumberFromRange(30,35).toFixed(2);
			var m32 = randomNumberFromRange(30,35).toFixed(2);
			$('#m31').val(m31);
			$('#m32').val(m32);
			var m31 = $('#m31').val();
			var m32 = $('#m32').val();
			
			var m21 = randomNumberFromRange(9,12).toFixed(2);
			var m22 = randomNumberFromRange(9,12).toFixed(2);
			$('#m21').val(m21);
			$('#m22').val(m22);
			var m21 = $('#m21').val();
			var m22 = $('#m22').val();
			
			var m11 = randomNumberFromRange(14.50,15.50).toFixed(2);
			var m12 = randomNumberFromRange(14.50,15.50).toFixed(2);
			$('#m11').val(m11);
			$('#m12').val(m12);
			var m11 = $('#m11').val();
			var m12 = $('#m12').val();
			
			var den_mo_vol1 = (+m31) - (+m21);
			$('#den_mo_vol1').val(den_mo_vol1.toFixed(2));
			var den_liter = (+m32) - (+m22);
			$('#den_liter').val(den_liter.toFixed(2));
			
			//bulk density compacted
			var m11 = $('#m11').val();
			var m12 = $('#m12').val();
			var m21 = $('#m21').val();
			var m22 = $('#m22').val();
			var m31 = $('#m31').val();
			var m32 = $('#m32').val();
			
			var den_mo_vol1 = (+m31) - (+m21);
			$('#den_mo_vol1').val(den_mo_vol1.toFixed(2));
			var den_mo_vol1 = $('#den_mo_vol1').val();
			var den_liter = (+m32) - (+m22);
			$('#den_liter').val(den_liter.toFixed(2));
			var den_liter = $('#den_liter').val();
			
			var den_mo_vol2 = (+den_mo_vol1) / (+m11);
			$('#den_mo_vol2').val(den_mo_vol2.toFixed(3));
			var den_kg_lit = (+den_liter) / (+m12);
			$('#den_kg_lit').val(den_kg_lit.toFixed(3));
			
			var avg_wom = ((+den_mo_vol2)+(+den_kg_lit))/2;
			$('#avg_wom').val(avg_wom.toFixed(3));
			
			
			// bulk Density Loose
			var avg_wom1 = randomNumberFromRange(1.350,1.600).toFixed(3);
			$('#avg_wom1').val(avg_wom1);
			var avg_wom1 = $('#avg_wom1').val();
			
			var aa = randomNumberFromRange(1,2).toFixed();
			if(aa==1)
				{
					var den_voids = (+avg_wom1) - 0.02;
					var den_voids1 = (+avg_wom1) + 0.02;
				}
				else if(aa==2)
				{
					var den_voids = (+avg_wom1) + 0.02;
					var den_voids1 = (+avg_wom1) - 0.02;
				}
			
			$('#den_voids').val(den_voids.toFixed(3));
			$('#den_voids1').val(den_voids1.toFixed(3));
			
			var weight_1 = randomNumberFromRange(30,35).toFixed(2);
			var weight_2 = randomNumberFromRange(30,35).toFixed(2);
			$('#weight_1').val(weight_1);
			$('#weight_2').val(weight_2);
			var weight_1 = $('#weight_1').val();
			var weight_2 = $('#weight_2').val();
			
			var m33 = randomNumberFromRange(9,12).toFixed(2);
			var den_voids_1 = randomNumberFromRange(9,12).toFixed(2);
			$('#m33').val(m33);
			$('#den_voids_1').val(den_voids_1);
			var m33 = $('#m33').val();
			var den_voids_1 = $('#den_voids_1').val();
			
			var m13 = randomNumberFromRange(14.50,15.50).toFixed(2);
			var m23 = randomNumberFromRange(14.50,15.50).toFixed(2);
			$('#m13').val(m13);
			$('#m23').val(m23);
			var m13 = $('#m13').val();
			var m23 = $('#m23').val();
			
			var asd_1 = (+weight_1) - (+m33);
			$('#asd_1').val(asd_1.toFixed(2));
			var asd_2 = (+weight_2) - (+den_voids_1);
			$('#asd_2').val(asd_2.toFixed(2));
			
			//bulk Density Losee 
			var m13 = $('#m13').val();
			var m23 = $('#m23').val();
			var m33 = $('#m33').val();
			var den_voids_1 = $('#den_voids_1').val();
			var weight_1 = $('#weight_1').val();
			var weight_2 = $('#weight_2').val();
			
			var asd_1 = (+weight_1) - (+m33);
			$('#asd_1').val(asd_1.toFixed(2));
			var asd_1 = $('#asd_1').val();
			var asd_2 = (+weight_2) - (+den_voids_1);
			$('#asd_2').val(asd_2.toFixed(2));
			var asd_2 = $('#asd_2').val();
			
			var den_voids = (+asd_1) / (+m13);
			$('#den_voids').val(den_voids.toFixed(3));
			var den_voids1 = (+asd_2) / (+m23);
			$('#den_voids1').val(den_voids1.toFixed(3));
			
			var avg_wom1 = ((+den_voids)+(+den_voids1))/2;
			$('#avg_wom1').val(avg_wom1.toFixed(3));
			
			/* var bdl = randomNumberFromRange(1400,1500).toFixed(1);
			var vol = 0.0147;
			$('#bdl').val(bdl);
			$('#vol').val(vol);
			var bdl1 = $('#bdl').val();
			var avg_wom = (+bdl1) * (+vol);
			$('#avg_wom1').val(avg_wom.toFixed(2));
			var avg_wom1_kg = $('#avg_wom1').val();
			var avg_kg = (+avg_wom1_kg) * (+100);
			$('#avg_wom').val(avg_kg.toFixed());			
			var avg = $('#avg_wom').val();
			var m21 = 8550;
			var m22 = 8550;
			var m23 = 8550;
			
			var m31 = (+avg) + randomNumberFromRange(-10,10);
			var m32 = (+avg) - randomNumberFromRange(-10,10);
			$('#m31').val(m31.toFixed());		
			$('#m32').val(m32.toFixed());		
			var wo1 = $('#m31').val();
			var wo2 = $('#m32').val();
			var tem1 = (+avg)*3;
			var tem2 = (+wo1) + (+wo2);
			var m33 = (+tem1) - (+tem2);
			$('#m33').val(m33.toFixed());
			var wo3 = $('#m33').val();
			
			var m11 = (+m21) + (+wo1);
			var m12 = (+m22) + (+wo2);
			var m13 = (+m23) + (+wo3);
					
			$('#m11').val(m11.toFixed());
			$('#m12').val(m12.toFixed());
			$('#m13').val(m13.toFixed());
			$('#m21').val(m21.toFixed());
			$('#m22').val(m22.toFixed());
			$('#m23').val(m23.toFixed());
			
			//new added field
			$('#den_mo_vol1').val(vol);
			$('#den_mo_vol2').val("");
			$('#den_liter').val("");
			$('#den_kg_lit').val("");
			$('#den_voids').val(""); */
	}
	
	//BULK DENSITY
	$('#chk_den').change(function(){
        if(this.checked)
		{ 
			den_auto();
			
			
		}
		else
		{
					$('#bdl').val(null);
					$('#vol').val(null);
					$('#avg_wom').val(null);
					$('#avg_wom1').val(null);
					$('#m21').val(null);
					$('#m22').val(null);
					$('#m23').val(null);
					$('#m11').val(null);
					$('#m12').val(null);
					$('#m13').val(null);
					$('#m31').val(null);
					$('#m32').val(null);
					$('#m33').val(null);
					$('#txtden').css("background-color","white");
					$('#den_mo_vol1').val(null);
						$('#den_mo_vol2').val(null);
						$('#den_liter').val(null);
						$('#den_kg_lit').val(null);
						$('#den_voids').val(null);
						$('#den_voids_1').val(null);
						$('#weight_1').val(null);
						$('#weight_2').val(null);
						$('#asd_1').val(null);
						$('#den_voids1').val(null);
						$('#asd_2').val(null);
					
		}
	});
	
	function bulk_den()
	{
			$('#txtden').css("background-color","var(--success)");
				
			// bulk Density Compacted
			var avg_wom = $('#avg_wom').val();
			
			var aa = randomNumberFromRange(1,2).toFixed();
			if(aa==1)
				{
					var den_mo_vol2 = (+avg_wom) - 0.02;
					var den_kg_lit = (+avg_wom) + 0.02;
				}
				else if(aa==2)
				{
					var den_mo_vol2 = (+avg_wom) + 0.02;
					var den_kg_lit = (+avg_wom) - 0.02;
				}
			
			$('#den_mo_vol2').val(den_mo_vol2.toFixed(3));
			$('#den_kg_lit').val(den_kg_lit.toFixed(3));
			
			var m31 = randomNumberFromRange(30,35).toFixed(2);
			var m32 = randomNumberFromRange(30,35).toFixed(2);
			$('#m31').val(m31);
			$('#m32').val(m32);
			var m31 = $('#m31').val();
			var m32 = $('#m32').val();
			
			var m21 = randomNumberFromRange(9,12).toFixed(2);
			var m22 = randomNumberFromRange(9,12).toFixed(2);
			$('#m21').val(m21);
			$('#m22').val(m22);
			var m21 = $('#m21').val();
			var m22 = $('#m22').val();
			
			var m11 = randomNumberFromRange(14.50,15.50).toFixed(2);
			var m12 = randomNumberFromRange(14.50,15.50).toFixed(2);
			$('#m11').val(m11);
			$('#m12').val(m12);
			var m11 = $('#m11').val();
			var m12 = $('#m12').val();
			
			var den_mo_vol1 = (+m31) - (+m21);
			$('#den_mo_vol1').val(den_mo_vol1.toFixed(2));
			var den_liter = (+m32) - (+m22);
			$('#den_liter').val(den_liter.toFixed(2));
			
			//bulk density compacted
			var m11 = $('#m11').val();
			var m12 = $('#m12').val();
			var m21 = $('#m21').val();
			var m22 = $('#m22').val();
			var m31 = $('#m31').val();
			var m32 = $('#m32').val();
			
			var den_mo_vol1 = (+m31) - (+m21);
			$('#den_mo_vol1').val(den_mo_vol1.toFixed(2));
			var den_mo_vol1 = $('#den_mo_vol1').val();
			var den_liter = (+m32) - (+m22);
			$('#den_liter').val(den_liter.toFixed(2));
			var den_liter = $('#den_liter').val();
			
			var den_mo_vol2 = (+den_mo_vol1) / (+m11);
			$('#den_mo_vol2').val(den_mo_vol2.toFixed(3));
			var den_kg_lit = (+den_liter) / (+m12);
			$('#den_kg_lit').val(den_kg_lit.toFixed(3));
			
			var avg_wom = ((+den_mo_vol2)+(+den_kg_lit))/2;
			$('#avg_wom').val(avg_wom.toFixed(3));
			
			// bulk Density Loose
			var avg_wom1 = $('#avg_wom1').val();
			
			var aa = randomNumberFromRange(1,2).toFixed();
			var aa1 = randomNumberFromRange(0.00,0.02).toFixed(2);
			if(aa==1)
				{
					var den_voids = (+avg_wom1) - (+aa1);
					var den_voids1 = (+avg_wom1) + (+aa1);
				}
				else if(aa==2)
				{
					var den_voids = (+avg_wom1) + (+aa1);
					var den_voids1 = (+avg_wom1) - (+aa1);
				}
			
			$('#den_voids').val(den_voids.toFixed(3));
			$('#den_voids1').val(den_voids1.toFixed(3));
			
			var weight_1 = randomNumberFromRange(30,35).toFixed(2);
			var weight_2 = randomNumberFromRange(30,35).toFixed(2);
			$('#weight_1').val(weight_1);
			$('#weight_2').val(weight_2);
			var weight_1 = $('#weight_1').val();
			var weight_2 = $('#weight_2').val();
			
			var m33 = randomNumberFromRange(9,12).toFixed(2);
			var den_voids_1 = randomNumberFromRange(9,12).toFixed(2);
			$('#m33').val(m33);
			$('#den_voids_1').val(den_voids_1);
			var m33 = $('#m33').val();
			var den_voids_1 = $('#den_voids_1').val();
			
			var m13 = randomNumberFromRange(14.50,15.50).toFixed(2);
			var m23 = randomNumberFromRange(14.50,15.50).toFixed(2);
			$('#m13').val(m13);
			$('#m23').val(m23);
			var m13 = $('#m13').val();
			var m23 = $('#m23').val();
			
			var asd_1 = (+weight_1) - (+m33);
			$('#asd_1').val(asd_1.toFixed(2));
			var asd_2 = (+weight_2) - (+den_voids_1);
			$('#asd_2').val(asd_2.toFixed(2));
			
			
			//bulk Density Losee 
			var m13 = $('#m13').val();
			var m23 = $('#m23').val();
			var m33 = $('#m33').val();
			var den_voids_1 = $('#den_voids_1').val();
			var weight_1 = $('#weight_1').val();
			var weight_2 = $('#weight_2').val();
			
			var asd_1 = (+weight_1) - (+m33);
			$('#asd_1').val(asd_1.toFixed(2));
			var asd_1 = $('#asd_1').val();
			var asd_2 = (+weight_2) - (+den_voids_1);
			$('#asd_2').val(asd_2.toFixed(2));
			var asd_2 = $('#asd_2').val();
			
			var den_voids = (+asd_1) / (+m13);
			$('#den_voids').val(den_voids.toFixed(3));
			var den_voids1 = (+asd_2) / (+m23);
			$('#den_voids1').val(den_voids1.toFixed(3));
			
			var avg_wom1 = ((+den_voids)+(+den_voids1))/2;
			$('#avg_wom1').val(avg_wom1.toFixed(3));
				
			/* var bdl1 = $('#bdl').val();
			var vol = $('#vol').val();
			var avg_wom = (+bdl1) * (+vol);
			$('#avg_wom1').val(avg_wom.toFixed(2));
			var avg_wom1_kg = $('#avg_wom1').val();
			var avg_kg = (+avg_wom1_kg) * (+100);
			$('#avg_wom').val(avg_kg.toFixed());			
			var avg = $('#avg_wom').val();
			var m21 = 8550;
			var m22 = 8550;
			var m23 = 8550;
			
			var m31 = (+avg) + randomNumberFromRange(-10,10);
			var m32 = (+avg) - randomNumberFromRange(-10,10);
			$('#m31').val(m31.toFixed());		
			$('#m32').val(m32.toFixed());		
			var wo1 = $('#m31').val();
			var wo2 = $('#m32').val();
			var tem1 = (+avg)*3;
			var tem2 = (+wo1) + (+wo2);
			var m33 = (+tem1) - (+tem2);
			$('#m33').val(m33.toFixed());
			var wo3 = $('#m33').val();
			
			var m11 = (+m21) + (+wo1);
			var m12 = (+m22) + (+wo2);
			var m13 = (+m23) + (+wo3);
					
			$('#m11').val(m11.toFixed());
			$('#m12').val(m12.toFixed());
			$('#m13').val(m13.toFixed());
			$('#m21').val(m21.toFixed());
			$('#m22').val(m22.toFixed());
			$('#m23').val(m23.toFixed());
			
			//new added field
			$('#den_mo_vol1').val(vol);
			$('#den_mo_vol2').val("");
			$('#den_liter').val("");
			$('#den_kg_lit').val("");
			$('#den_voids').val(""); */
		
			
	}
	
	$('#avg_wom,#avg_wom1').change(function(){
        if ($("#chk_den").is(':checked')) {	
		bulk_den();	
		}
	});
	
	/* $('#avg_wom').change(function(){
			
			$('#txtden').css("background-color","var(--success)");
			if ($("#chk_den").is(':checked')) {	
			var avg = $('#avg_wom').val();
			$('#avg_wom').val(avg);					
			var m31 = (+avg) + randomNumberFromRange(-10,10);
			var m32 = (+avg) - randomNumberFromRange(-10,10);
			$('#m31').val(m31.toFixed());		
			$('#m32').val(m32.toFixed());		
			var wo1 = $('#m31').val();
			var wo2 = $('#m32').val();
			var tem1 = (+avg)*3;
			var tem2 = (+wo1) + (+wo2);
			var m33 = (+tem1) - (+tem2);
			$('#m33').val(m33.toFixed());
			var wo3 = $('#m33').val();		
			var m21 = $('#m21').val();
			var m22 = $('#m22').val();
			var m23 = $('#m23').val();
			var m11 = (+m21) + (+wo1);
			var m12 = (+m22) + (+wo2);
			var m13 = (+m23) + (+wo3);			
			$('#m11').val(m11.toFixed());
			$('#m12').val(m12.toFixed());
			$('#m13').val(m13.toFixed());
		
			var vol = $('#vol').val();
			var bdl = (+avg)/(+vol);
			$('#bdl').val(bdl.toFixed(2));
			}
		
	}); */
	
	function weigh_mould_material()
	{		
		$('#txtden').css("background-color","var(--success)");
		var m11 = $('#m11').val();
		var m12 = $('#m12').val();
		var m21 = $('#m21').val();
		var m22 = $('#m22').val();
		var m31 = $('#m31').val();
		var m32 = $('#m32').val();
		
		var den_mo_vol1 = (+m31) - (+m21);
		$('#den_mo_vol1').val(den_mo_vol1.toFixed(2));
		var den_mo_vol1 = $('#den_mo_vol1').val();
		var den_liter = (+m32) - (+m22);
		$('#den_liter').val(den_liter.toFixed(2));
		var den_liter = $('#den_liter').val();
		
		var den_mo_vol2 = (+den_mo_vol1) / (+m11);
		$('#den_mo_vol2').val(den_mo_vol2.toFixed(3));
		var den_kg_lit = (+den_liter) / (+m12);
		$('#den_kg_lit').val(den_kg_lit.toFixed(3));
		
		var avg_wom = ((+den_mo_vol2)+(+den_kg_lit))/2;
		$('#avg_wom').val(avg_wom.toFixed(3	));
			
		/* var wo1 = $('#m31').val();
		var wo2 = $('#m32').val();
		var wo3 = $('#m33').val();	
		
		var avg_wom = ((+m31)+(+m32)+(+m33))/3;
		$('#avg_wom').val(avg_wom.toFixed());	
		var kg_mate = $('#avg_wom').val();
		var ans = (+kg_mate) / (+100);
		$('#avg_wom1').val(ans.toFixed(2));
		var avg_m32 = $('#avg_wom1').val();
		var vol = $('#vol').val();
		var bdl = (+avg_m32)/(+vol);
		$('#bdl').val(bdl.toFixed(2)); */
	}
	
	function weigh_mould_material1()
	{		
		$('#txtden').css("background-color","var(--success)");		
		var m13 = $('#m13').val();
		var m23 = $('#m23').val();
		var m33 = $('#m33').val();
		var den_voids_1 = $('#den_voids_1').val();
		var weight_1 = $('#weight_1').val();
		var weight_2 = $('#weight_2').val();
		
		var asd_1 = (+weight_1) - (+m33);
		$('#asd_1').val(asd_1.toFixed(2));
		var asd_1 = $('#asd_1').val();
		var asd_2 = (+weight_2) - (+den_voids_1);
		$('#asd_2').val(asd_2.toFixed(2));
		var asd_2 = $('#asd_2').val();
		
		var den_voids = (+asd_1) / (+m13);
		$('#den_voids').val(den_voids.toFixed(3));
		var den_voids1 = (+asd_2) / (+m23);
		$('#den_voids1').val(den_voids1.toFixed(3));
		
		var avg_wom1 = ((+den_voids)+(+den_voids1))/2;
		$('#avg_wom1').val(avg_wom1.toFixed(3));
	}
	
	$('#m11,#m12,#m21,#m22,#m31,#m32').change(function(){
      weigh_mould_material()  
			
	});
	$('#m13,#m23,#m33,#den_voids_1,#weight_1,#weight_2').change(function(){
      weigh_mould_material1()  
			
	});
	
	function wom_123()
	{		
		$('#txtden').css("background-color","var(--success)");
		var m31 = $('#m31').val();
		var m32 = $('#m32').val();
		var m33 = $('#m33').val();
		var m21 = $('#m21').val();
		var m22 = $('#m22').val();
		var m23 = $('#m23').val();
		
		var avg_wom = ((+m31)+(+m32)+(+m33))/3;
		$('#avg_wom').val(avg_wom.toFixed());	
		var kg_mate = $('#avg_wom').val();
		var ans = (+kg_mate) / (+100);
		$('#avg_wom1').val(ans.toFixed(2));
		
		var m11 = (+m31) + (+m21);
		var m12 = (+m32) + (+m22);
		var m13 = (+m33) + (+m23);
		
		$('#m11').val(m11.toFixed());
		$('#m12').val(m12.toFixed());
		$('#m13').val(m13.toFixed());
		var avg_m32 = $('#avg_wom1').val();
		var vol = $('#vol').val();
		var bdl = (+avg_m32)/(+vol);
		$('#bdl').val(bdl.toFixed(1));
			
		
	}
	
	$('#m31,#m32,#m33').change(function(){
        
		wom_123();	
	});
	
	
	
	
	var sieve_1;	
	var sieve_2;	
	var sieve_3;	
	var sieve_4;	
	var sieve_5;	
	var sieve_6;	
	var sieve_7;	
	var sieve_8;	
	
	
	function grd_auto()
	{
			sieve_1="10.00 (mm)";	
			sieve_2="4.75 (mm)";	
			sieve_3="2.36 (mm)";	
			sieve_4="1.18 (mm)";	
			sieve_5="0.600 (mm)";
			sieve_6="0.300 (mm)";
			sieve_7="0.150 (mm)";
			sieve_8="0.075 (mm)";
			
					var sample_taken=2500;
					
					var grd_zone =  $("#grd_zone").val();
					var silt_1 = 500;
					var silt_2 = randomNumberFromRange(485.60, 485.80).toFixed(2);
					var silt_content = ((((+silt_1)-(+silt_2))/(+silt_1))*(+100));
					if(grd_zone=="Zone I")
					{
						//PASSING RANGE
						var pass_sample_1 = randomNumberFromRange(100, 100);
						var pass_sample_2 = randomNumberFromRange(90.50,98.49);
						var pass_sample_3 = randomNumberFromRange(80.35,90.00);
						var pass_sample_4 = randomNumberFromRange(65.02,69.58);
						var pass_sample_5 = randomNumberFromRange(32.11,33.80);
						var pass_sample_6 = randomNumberFromRange(16.40,19.85);
						var pass_sample_7 = randomNumberFromRange(8.11,9.95);
						var pass_sample_8 = randomNumberFromRange(5.10,8.10);
						
					}
					else if(grd_zone=="Zone II")
					{
						//PASSING RANGE
						var pass_sample_1 = randomNumberFromRange(100, 100);
						var pass_sample_2 = randomNumberFromRange(95.10,99.82);
						var pass_sample_3 = randomNumberFromRange(91.00,95.00);
						var pass_sample_4 = randomNumberFromRange(86.00,90.00);
						var pass_sample_5 = randomNumberFromRange(52.00,59.00);
						var pass_sample_6 = randomNumberFromRange(21.00,29.00);
						var pass_sample_7 = randomNumberFromRange(8.11,9.95);
						var pass_sample_8 = randomNumberFromRange(0.50,1.20);
				
					}
					else if(grd_zone=="Zone III")
					{
						//PASSING RANGE
						var pass_sample_1 = randomNumberFromRange(100, 100);
						var pass_sample_2 = randomNumberFromRange(95.00,99.00);
						var pass_sample_3 = randomNumberFromRange(90.00,92.00);
						var pass_sample_4 = randomNumberFromRange(76.00,81.00);
						var pass_sample_5 = randomNumberFromRange(60.50,69.00);
						var pass_sample_6 = randomNumberFromRange(25.00,39.00);
						var pass_sample_7 = randomNumberFromRange(8.11,9.95);
						var pass_sample_8 = randomNumberFromRange(0.20,1.00);
						
					}
					else if(grd_zone=="Zone IV")
					{
						//PASSING RANGE
						var pass_sample_1 = randomNumberFromRange(100, 100);
						var pass_sample_2 = randomNumberFromRange(95.00,95.50);
						var pass_sample_3 = randomNumberFromRange(94.51,94.99);
						var pass_sample_4 = randomNumberFromRange(90.50,94.50);
						var pass_sample_5 = randomNumberFromRange(80.00,80.99);
						var pass_sample_6 = randomNumberFromRange(15.00,15.99);
						var pass_sample_7 = randomNumberFromRange(8.11,9.95);
						var pass_sample_8 = randomNumberFromRange(0.0,0.0);
						
					}
					
					$('#pass_sample_1').val(pass_sample_1.toFixed(2));
					$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					$('#pass_sample_5').val(pass_sample_5.toFixed(2));
					$('#pass_sample_6').val(pass_sample_6.toFixed(2));
					$('#pass_sample_7').val(pass_sample_7.toFixed(2));
					$('#pass_sample_8').val(pass_sample_8.toFixed(2));
					
					var pass_sample1 = $('#pass_sample_1').val();
					var pass_sample2 = $('#pass_sample_2').val();
					var pass_sample3 = $('#pass_sample_3').val();
					var pass_sample4 = $('#pass_sample_4').val();
					var pass_sample5 = $('#pass_sample_5').val();
					var pass_sample6 = $('#pass_sample_6').val();
					var pass_sample7 = $('#pass_sample_7').val();
					var pass_sample8 = $('#pass_sample_8').val();
					
					
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100 - (+pass_sample1);
					var cum_ret_2 = 100 - (+pass_sample2);
					var cum_ret_3 = 100 - (+pass_sample3);
					var cum_ret_4 = 100 - (+pass_sample4);
					var cum_ret_5 = 100 - (+pass_sample5);
					var cum_ret_6 = 100 - (+pass_sample6);
					var cum_ret_7 = 100 - (+pass_sample7);
					var cum_ret_8 = 100 - (+pass_sample8);
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(2));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
					$('#cum_ret_6').val(cum_ret_6.toFixed(2));
					$('#cum_ret_7').val(cum_ret_7.toFixed(2));
					$('#cum_ret_8').val(cum_ret_8.toFixed(2));
					
					var cum_ret1 = $('#cum_ret_1').val();
					var cum_ret2 = $('#cum_ret_2').val();
					var cum_ret3 = $('#cum_ret_3').val();
					var cum_ret4 = $('#cum_ret_4').val();
					var cum_ret5 = $('#cum_ret_5').val();
					var cum_ret6 = $('#cum_ret_6').val();
					var cum_ret7 = $('#cum_ret_7').val();
					var cum_ret8 = $('#cum_ret_8').val();
					
					
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = ((+cum_ret1)*(+sample_taken))/100;
					var ret_wt_gm_2 = ((+cum_ret2)*(+sample_taken))/100;
					var ret_wt_gm_3 = ((+cum_ret3)*(+sample_taken))/100;
					var ret_wt_gm_4 = ((+cum_ret4)*(+sample_taken))/100;
					var ret_wt_gm_5 = ((+cum_ret5)*(+sample_taken))/100;
					var ret_wt_gm_6 = ((+cum_ret6)*(+sample_taken))/100;
					var ret_wt_gm_7 = ((+cum_ret7)*(+sample_taken))/100;
					var ret_wt_gm_8 = ((+cum_ret8)*(+sample_taken))/100;
					
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed());
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed());
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed());
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed());
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed());
					$('#ret_wt_gm_6').val(ret_wt_gm_6.toFixed());
					$('#ret_wt_gm_7').val(ret_wt_gm_7.toFixed());
					$('#ret_wt_gm_8').val(ret_wt_gm_8.toFixed());
					
					var ret_wt_gm1 = $('#ret_wt_gm_1').val();
					var ret_wt_gm2 = $('#ret_wt_gm_2').val();
					var ret_wt_gm3 = $('#ret_wt_gm_3').val();
					var ret_wt_gm4 = $('#ret_wt_gm_4').val();
					var ret_wt_gm5 = $('#ret_wt_gm_5').val();
					var ret_wt_gm6 = $('#ret_wt_gm_6').val();
					var ret_wt_gm7 = $('#ret_wt_gm_7').val();
					var ret_wt_gm8 = $('#ret_wt_gm_8').val();
					
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm1;
					var cum_wt_gm_2 = (+ret_wt_gm2)-(+ret_wt_gm1);
					var cum_wt_gm_3 = (+ret_wt_gm3)-(+ret_wt_gm2);
					var cum_wt_gm_4 = (+ret_wt_gm4)-(+ret_wt_gm3);
					var cum_wt_gm_5 = (+ret_wt_gm5)-(+ret_wt_gm4);
					var cum_wt_gm_6 = (+ret_wt_gm6)-(+ret_wt_gm5);
					var cum_wt_gm_7 = (+ret_wt_gm7)-(+ret_wt_gm6);
					var cum_wt_gm_8 = (+ret_wt_gm8)-(+ret_wt_gm7);
					
					$('#cum_wt_gm_1').val(cum_wt_gm_1);
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed());
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed());
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed());
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed());
					$('#cum_wt_gm_6').val(cum_wt_gm_6.toFixed());
					$('#cum_wt_gm_7').val(cum_wt_gm_7.toFixed());
					$('#cum_wt_gm_8').val(cum_wt_gm_8.toFixed());
					
					var cum_wt_gm1 = $('#cum_wt_gm_1').val();
					var cum_wt_gm2 = $('#cum_wt_gm_2').val();
					var cum_wt_gm3 = $('#cum_wt_gm_3').val();
					var cum_wt_gm4 = $('#cum_wt_gm_4').val();
					var cum_wt_gm5 = $('#cum_wt_gm_5').val();
					var cum_wt_gm6 = $('#cum_wt_gm_6').val();
					var cum_wt_gm7 = $('#cum_wt_gm_7').val();
					var cum_wt_gm8 = $('#cum_wt_gm_8').val();
					

					var sums = (+cum_ret2)+(+cum_ret3)+(+cum_ret4)+(+cum_ret5)+(+cum_ret6)+(+cum_ret7)+(+cum_ret8);
					var ans = (+sums)/100;
					$('#grd_fm').val(ans.toFixed(2));
					
					
					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = (+cum_wt_gm_1)+(+cum_wt_gm_2)+(+cum_wt_gm_3)+(+cum_wt_gm_4)+(+cum_wt_gm_5)+(+cum_wt_gm_6)+(+cum_wt_gm_7)+(+cum_wt_gm_8);
					 $('#blank_extra').val(blank_extra.toFixed());
					 $('#sample_taken').val(sample_taken);
					$('#silt_1').val(silt_1);
					 $('#silt_2').val(silt_2);
					 $('#silt_content').val(silt_content.toFixed(2));
					 
					
					var sampletaken1 = $('#sample_taken').val();
					var cum_wtgm1 = $('#cum_wt_gm_1').val();
					var cum_wtgm2 = $('#cum_wt_gm_2').val();
					var cum_wtgm3 = $('#cum_wt_gm_3').val();
					var cum_wtgm4 = $('#cum_wt_gm_4').val();
					var cum_wtgm5 = $('#cum_wt_gm_5').val();
					var cum_wtgm6 = $('#cum_wt_gm_6').val();
					var cum_wtgm7 = $('#cum_wt_gm_7').val();
					var cum_wtgm8 = $('#cum_wt_gm_8').val();
					
					//MINUS PLUS
					var ret_wtgm1 = cum_wtgm1;
					var ret_wtgm2 = (+cum_wtgm2)+(+ret_wtgm1);
					var ret_wtgm3 = (+cum_wtgm3)+(+ret_wtgm2);
					var ret_wtgm4 = (+cum_wtgm4)+(+ret_wtgm3);
					var ret_wtgm5 = (+cum_wtgm5)+(+ret_wtgm4);
					var ret_wtgm6 = (+cum_wtgm6)+(+ret_wtgm5);
					var ret_wtgm7 = (+cum_wtgm7)+(+ret_wtgm6);
					var ret_wtgm8 = (+cum_wtgm8)+(+ret_wtgm7);
					
					$('#ret_wt_gm_1').val(ret_wtgm1);
					$('#ret_wt_gm_2').val(ret_wtgm2.toFixed());
					$('#ret_wt_gm_3').val(ret_wtgm3.toFixed());
					$('#ret_wt_gm_4').val(ret_wtgm4.toFixed());
					$('#ret_wt_gm_5').val(ret_wtgm5.toFixed());
					$('#ret_wt_gm_6').val(ret_wtgm6.toFixed());
					$('#ret_wt_gm_7').val(ret_wtgm7.toFixed());
					$('#ret_wt_gm_8').val(ret_wtgm8.toFixed());
					
					var blank_extra = (+cum_wtgm1)+(+cum_wtgm2)+(+cum_wtgm3)+(+cum_wtgm4)+(+cum_wtgm5)+(+cum_wtgm6)+(+cum_wtgm7)+(+cum_wtgm8);
					$('#blank_extra').val(blank_extra.toFixed());

					var ret_wtgm1 = $('#ret_wt_gm_1').val();
					var ret_wtgm2 = $('#ret_wt_gm_2').val();
					var ret_wtgm3 = $('#ret_wt_gm_3').val();
					var ret_wtgm4 = $('#ret_wt_gm_4').val();
					var ret_wtgm5 = $('#ret_wt_gm_5').val();
					var ret_wtgm6 = $('#ret_wt_gm_6').val();
					var ret_wtgm7 = $('#ret_wt_gm_7').val();
					var ret_wtgm8 = $('#ret_wt_gm_8').val();
					
					var cumret1 = ((+ret_wtgm1)/(+sampletaken1))*100;
					var cumret2 = ((+ret_wtgm2)/(+sampletaken1))*100;
					var cumret3 = ((+ret_wtgm3)/(+sampletaken1))*100;
					var cumret4 = ((+ret_wtgm4)/(+sampletaken1))*100;
					var cumret5 = ((+ret_wtgm5)/(+sampletaken1))*100;
					var cumret6 = ((+ret_wtgm6)/(+sampletaken1))*100;
					var cumret7 = ((+ret_wtgm7)/(+sampletaken1))*100;
					var cumret8 = ((+ret_wtgm8)/(+sampletaken1))*100;
					
					$('#cum_ret_1').val(cumret1.toFixed(2));
					$('#cum_ret_2').val(cumret2.toFixed(2));
					$('#cum_ret_3').val(cumret3.toFixed(2));
					$('#cum_ret_4').val(cumret4.toFixed(2));
					$('#cum_ret_5').val(cumret5.toFixed(2));
					$('#cum_ret_6').val(cumret6.toFixed(2));
					$('#cum_ret_7').val(cumret7.toFixed(2));
					$('#cum_ret_8').val(cumret8.toFixed(2));
					
					var cum__ret1 = $('#cum_ret_1').val();
					var cum__ret2 = $('#cum_ret_2').val();
					var cum__ret3 = $('#cum_ret_3').val();
					var cum__ret4 = $('#cum_ret_4').val();
					var cum__ret5 = $('#cum_ret_5').val();
					var cum__ret6 = $('#cum_ret_6').val();
					var cum__ret7 = $('#cum_ret_7').val();
					var cum__ret8 = $('#cum_ret_8').val();
					
					var passsample1 = 100.00;
					var passsample2 = (+100.00) - (+cum__ret2);
					var passsample3 = (+100.00) - (+cum__ret3);
					var passsample4 = (+100.00) - (+cum__ret4);
					var passsample5 = (+100.00) - (+cum__ret5);
					var passsample6 = (+100.00) - (+cum__ret6);
					var passsample7 = (+100.00) - (+cum__ret7);
					var passsample8 = (+100.00) - (+cum__ret8);
				
					$('#pass_sample_1').val(passsample1);
					$('#pass_sample_2').val(passsample2.toFixed(2));
					$('#pass_sample_3').val(passsample3.toFixed(2));
					$('#pass_sample_4').val(passsample4.toFixed(2));
					$('#pass_sample_5').val(passsample5.toFixed(2));
					$('#pass_sample_6').val(passsample6.toFixed(2));
					$('#pass_sample_7').val(passsample7.toFixed(2));
					$('#pass_sample_8').val(passsample8.toFixed(2));

					var sums = (+cum__ret2)+(+cum__ret3)+(+cum__ret4)+(+cum__ret5)+(+cum__ret6)+(+cum__ret7)+(+cum__ret8);
					var ans = (+sums)/100;
					$('#grd_fm').val(ans.toFixed(2));
	}
	
	$('#chk_grd').change(function(){
        if(this.checked)
		{ 
			grd_auto();
		
		}
		else
		{
					$('#cum_wt_gm_1').val(null);
					$('#cum_wt_gm_2').val(null);
					$('#cum_wt_gm_3').val(null);
					$('#cum_wt_gm_4').val(null);
					$('#cum_wt_gm_5').val(null);
					$('#cum_wt_gm_6').val(null);
					$('#cum_wt_gm_7').val(null);
					$('#cum_wt_gm_8').val(null);
					
					 
					$('#ret_wt_gm_1').val(null);
					$('#ret_wt_gm_2').val(null);
					$('#ret_wt_gm_3').val(null);
					$('#ret_wt_gm_4').val(null);
					$('#ret_wt_gm_5').val(null);
					$('#ret_wt_gm_6').val(null);
					$('#ret_wt_gm_7').val(null);
					$('#ret_wt_gm_8').val(null);
					
					
					
					$('#cum_ret_1').val(null);
					$('#cum_ret_2').val(null);
					$('#cum_ret_3').val(null);
					$('#cum_ret_4').val(null);
					$('#cum_ret_5').val(null);
					$('#cum_ret_6').val(null);
					$('#cum_ret_7').val(null);
					$('#cum_ret_8').val(null);
					
				   
					$('#pass_sample_1').val(null);
					$('#pass_sample_2').val(null);
					$('#pass_sample_3').val(null);
					$('#pass_sample_4').val(null);
					$('#pass_sample_5').val(null);
					$('#pass_sample_6').val(null);
					$('#pass_sample_7').val(null);
					$('#pass_sample_8').val(null);
					
				  
					 $('#blank_extra').val(null);
					 $('#sample_taken').val(null);
					 $('#grd_fm').val(null);
					 $('#silt_1').val(null);
					 $('#silt_2').val(null);
					 $('#silt_content').val(null);
		}
	});
	
	
	$('#sample_taken').change(function(){
		$('#txtgrd').css("background-color","var(--success)");	
		if ($("#chk_grd").is(':checked')) {
        grds_func();
		}
	});
	
	$('#pass_sample_1').change(function(){
        grds_func();
	});
	
	$('#pass_sample_2').change(function(){
        grds_func();
	});
	
	$('#pass_sample_3').change(function(){
        grds_func();
		
	});
	
	$('#pass_sample_4').change(function(){
        grds_func();
	});
	
	$('#pass_sample_5').change(function(){
        grds_func();
	});
	$('#pass_sample_6').change(function(){
        grds_func();
	});
	$('#pass_sample_7').change(function(){
        grds_func();
	});

	$('#silt_1').change(function(){
		if ($("#chk_grd").is(':checked')) {
        grds_func();
		}
	});
	$('#silt_2').change(function(){
		if ($("#chk_grd").is(':checked')) {
        grds_func();
		}
	});

	$('#silt_content').change(function(){
		$('#txtgrd').css("background-color","var(--success)");
        var silt_1 = $('#silt_1').val();
		var silt_content = $('#silt_content').val();
		var silt_2 = ((parseFloat(silt_1)*100)/(parseFloat(silt_content)+100));
		$('#silt_2').val(silt_2.toFixed(2));
	});
	
	$('#silt_1').keyup(function(){
		var get_silt_1_val = parseInt($('#silt_1').val());
		var get_silt_2_val = parseInt($('#silt_2').val());
		var get_formula_1 = (get_silt_1_val - get_silt_2_val) / 500 * 100;
		var main_result  = get_formula_1 * 100;
		$("#silt_content").val(get_formula_1.toFixed(1));
	});
	
	$('#silt_2').keyup(function(){
		var get_silt_1_val = parseInt($('#silt_1').val());
		var get_silt_2_val = parseInt($('#silt_2').val());
		var get_formula_1 = (get_silt_1_val - get_silt_2_val) / 500 * 100;
		var main_result  = get_formula_1 * 100;
		$("#silt_content").val(get_formula_1.toFixed(1));
	});
	
	function weight_cum_gm()
	{
			$('#txtgrd').css("background-color","var(--success)");
			var sieve_1="10.00 (mm)";	
			var sieve_2="4.75 (mm)";	
			var sieve_3="2.36 (mm)";	
			var sieve_4="1.18 (mm)";	
			var sieve_5="0.600 (mm)";
			var sieve_6="0.300 (mm)";
			var sieve_7="0.150 (mm)";
			var sieve_8="0.075 (mm)";

		 var sample_taken=$('#sample_taken').val();
		//PASSING RANGE
		var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
		var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
		var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
		var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
		var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
		var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
		var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
		var cum_wt_gm_8 = $('#cum_wt_gm_8').val();
		
		//MINUS PLUS
		var ret_wt_gm_1 = cum_wt_gm_1;
		var ret_wt_gm_2 = (+cum_wt_gm_2)+(+ret_wt_gm_1);
		var ret_wt_gm_3 = (+cum_wt_gm_3)+(+ret_wt_gm_2);
		var ret_wt_gm_4 = (+cum_wt_gm_4)+(+ret_wt_gm_3);
		var ret_wt_gm_5 = (+cum_wt_gm_5)+(+ret_wt_gm_4);
		var ret_wt_gm_6 = (+cum_wt_gm_6)+(+ret_wt_gm_5);
		var ret_wt_gm_7 = (+cum_wt_gm_7)+(+ret_wt_gm_6);
		var ret_wt_gm_8 = (+cum_wt_gm_8)+(+ret_wt_gm_7);
		
		$('#ret_wt_gm_1').val(ret_wt_gm_1);
		$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed());
		$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed());
		$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed());
		$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed());
		$('#ret_wt_gm_6').val(ret_wt_gm_6.toFixed());
		$('#ret_wt_gm_7').val(ret_wt_gm_7.toFixed());
		$('#ret_wt_gm_8').val(ret_wt_gm_8.toFixed());
		
		var blank_extra = (+cum_wt_gm_1)+(+cum_wt_gm_2)+(+cum_wt_gm_3)+(+cum_wt_gm_4)+(+cum_wt_gm_5)+(+cum_wt_gm_6)+(+cum_wt_gm_7)+(+cum_wt_gm_8);
		$('#blank_extra').val(blank_extra.toFixed());

		var ret_wt_gm1 = $('#ret_wt_gm_1').val();
		var ret_wt_gm2 = $('#ret_wt_gm_2').val();
		var ret_wt_gm3 = $('#ret_wt_gm_3').val();
		var ret_wt_gm4 = $('#ret_wt_gm_4').val();
		var ret_wt_gm5 = $('#ret_wt_gm_5').val();
		var ret_wt_gm6 = $('#ret_wt_gm_6').val();
		var ret_wt_gm7 = $('#ret_wt_gm_7').val();
		var ret_wt_gm8 = $('#ret_wt_gm_8').val();
		
		var cum_ret_1 = ((+ret_wt_gm1)/(+sample_taken))*100;
		var cum_ret_2 = ((+ret_wt_gm2)/(+sample_taken))*100;
		var cum_ret_3 = ((+ret_wt_gm3)/(+sample_taken))*100;
		var cum_ret_4 = ((+ret_wt_gm4)/(+sample_taken))*100;
		var cum_ret_5 = ((+ret_wt_gm5)/(+sample_taken))*100;
		var cum_ret_6 = ((+ret_wt_gm6)/(+sample_taken))*100;
		var cum_ret_7 = ((+ret_wt_gm7)/(+sample_taken))*100;
		var cum_ret_8 = ((+ret_wt_gm8)/(+sample_taken))*100;
		
		$('#cum_ret_1').val(cum_ret_1.toFixed(2));
		$('#cum_ret_2').val(cum_ret_2.toFixed(2));
		$('#cum_ret_3').val(cum_ret_3.toFixed(2));
		$('#cum_ret_4').val(cum_ret_4.toFixed(2));
		$('#cum_ret_5').val(cum_ret_5.toFixed(2));
		$('#cum_ret_6').val(cum_ret_6.toFixed(2));
		$('#cum_ret_7').val(cum_ret_7.toFixed(2));
		$('#cum_ret_8').val(cum_ret_8.toFixed(2));
		
		var cum_ret1 = $('#cum_ret_1').val();
		var cum_ret2 = $('#cum_ret_2').val();
		var cum_ret3 = $('#cum_ret_3').val();
		var cum_ret4 = $('#cum_ret_4').val();
		var cum_ret5 = $('#cum_ret_5').val();
		var cum_ret6 = $('#cum_ret_6').val();
		var cum_ret7 = $('#cum_ret_7').val();
		var cum_ret8 = $('#cum_ret_8').val();
		
		var pass_sample_1 = 100.00;
		var pass_sample_2 = (+100.00) - (+cum_ret2);
		var pass_sample_3 = (+100.00) - (+cum_ret3);
		var pass_sample_4 = (+100.00) - (+cum_ret4);
		var pass_sample_5 = (+100.00) - (+cum_ret5);
		var pass_sample_6 = (+100.00) - (+cum_ret6);
		var pass_sample_7 = (+100.00) - (+cum_ret7);
		var pass_sample_8 = (+100.00) - (+cum_ret8);
	
		$('#pass_sample_1').val(pass_sample_1);
		$('#pass_sample_2').val(pass_sample_2.toFixed(2));
		$('#pass_sample_3').val(pass_sample_3.toFixed(2));
		$('#pass_sample_4').val(pass_sample_4.toFixed(2));
		$('#pass_sample_5').val(pass_sample_5.toFixed(2));
		$('#pass_sample_6').val(pass_sample_6.toFixed(2));
		$('#pass_sample_7').val(pass_sample_7.toFixed(2));
		$('#pass_sample_8').val(pass_sample_8.toFixed(2));

		var sums = (+cum_ret2)+(+cum_ret3)+(+cum_ret4)+(+cum_ret5)+(+cum_ret6)+(+cum_ret7)+(+cum_ret8);
		var ans = (+sums)/100;
		$('#grd_fm').val(ans.toFixed(2));
		
		
		
	}
	
	$('#cum_wt_gm_1').change(function(){
       weight_cum_gm();
	});
	$('#cum_wt_gm_2').change(function(){
       weight_cum_gm();
	});
	$('#cum_wt_gm_3').change(function(){
       weight_cum_gm();
	});
	$('#cum_wt_gm_4').change(function(){
       weight_cum_gm();
	});
	$('#cum_wt_gm_5').change(function(){
       weight_cum_gm();
	});
	$('#cum_wt_gm_6').change(function(){
       weight_cum_gm();
	});
	$('#cum_wt_gm_7').change(function(){
       weight_cum_gm();
	});
	
	function grds_func()
	{
		
			$('#txtgrd').css("background-color","var(--success)");	
			sieve_1="10.00 (mm)";	
			sieve_2="4.75 (mm)";	
			sieve_3="2.36 (mm)";	
			sieve_4="1.18 (mm)";	
			sieve_5="0.600 (mm)";
			sieve_6="0.300 (mm)";
			sieve_7="0.150 (mm)";
			sieve_8="0.075 (mm)";
			
					var sample_taken=$('#sample_taken').val();
					//PASSING RANGE
					
					
					var pass_sample1 = $('#pass_sample_1').val();
					var pass_sample2 = $('#pass_sample_2').val();
					var pass_sample3 = $('#pass_sample_3').val();
					var pass_sample4 = $('#pass_sample_4').val();
					var pass_sample5 = $('#pass_sample_5').val();
					var pass_sample6 = $('#pass_sample_6').val();
					var pass_sample7 = $('#pass_sample_7').val();
					var pass_sample8 = $('#pass_sample_8').val();
					
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100 - (+pass_sample1);
					var cum_ret_2 = 100 - (+pass_sample2);
					var cum_ret_3 = 100 - (+pass_sample3);
					var cum_ret_4 = 100 - (+pass_sample4);
					var cum_ret_5 = 100 - (+pass_sample5);
					var cum_ret_6 = 100 - (+pass_sample6);
					var cum_ret_7 = 100 - (+pass_sample7);
					var cum_ret_8 = 100 - (+pass_sample8);
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(2));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
					$('#cum_ret_6').val(cum_ret_6.toFixed(2));
					$('#cum_ret_7').val(cum_ret_7.toFixed(2));
					$('#cum_ret_8').val(cum_ret_8.toFixed(2));
					
					var cum_ret1 = $('#cum_ret_1').val();
					var cum_ret2 = $('#cum_ret_2').val();
					var cum_ret3 = $('#cum_ret_3').val();
					var cum_ret4 = $('#cum_ret_4').val();
					var cum_ret5 = $('#cum_ret_5').val();
					var cum_ret6 = $('#cum_ret_6').val();
					var cum_ret7 = $('#cum_ret_7').val();
					var cum_ret8 = $('#cum_ret_8').val();
					
					
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = ((+cum_ret1)*(+sample_taken))/100;
					var ret_wt_gm_2 = ((+cum_ret2)*(+sample_taken))/100;
					var ret_wt_gm_3 = ((+cum_ret3)*(+sample_taken))/100;
					var ret_wt_gm_4 = ((+cum_ret4)*(+sample_taken))/100;
					var ret_wt_gm_5 = ((+cum_ret5)*(+sample_taken))/100;
					var ret_wt_gm_6 = ((+cum_ret6)*(+sample_taken))/100;
					var ret_wt_gm_7 = ((+cum_ret7)*(+sample_taken))/100;
					var ret_wt_gm_8 = ((+cum_ret8)*(+sample_taken))/100;
					
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed());
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed());
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed());
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed());
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed());
					$('#ret_wt_gm_6').val(ret_wt_gm_6.toFixed());
					$('#ret_wt_gm_7').val(ret_wt_gm_7.toFixed());
					$('#ret_wt_gm_8').val(ret_wt_gm_8.toFixed());
					
					var ret_wt_gm1 = $('#ret_wt_gm_1').val();
					var ret_wt_gm2 = $('#ret_wt_gm_2').val();
					var ret_wt_gm3 = $('#ret_wt_gm_3').val();
					var ret_wt_gm4 = $('#ret_wt_gm_4').val();
					var ret_wt_gm5 = $('#ret_wt_gm_5').val();
					var ret_wt_gm6 = $('#ret_wt_gm_6').val();
					var ret_wt_gm7 = $('#ret_wt_gm_7').val();
					var ret_wt_gm8 = $('#ret_wt_gm_8').val();
					
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm1;
					var cum_wt_gm_2 = (+ret_wt_gm2)-(+ret_wt_gm1);
					var cum_wt_gm_3 = (+ret_wt_gm3)-(+ret_wt_gm2);
					var cum_wt_gm_4 = (+ret_wt_gm4)-(+ret_wt_gm3);
					var cum_wt_gm_5 = (+ret_wt_gm5)-(+ret_wt_gm4);
					var cum_wt_gm_6 = (+ret_wt_gm6)-(+ret_wt_gm5);
					var cum_wt_gm_7 = (+ret_wt_gm7)-(+ret_wt_gm6);
					var cum_wt_gm_8 = (+ret_wt_gm8)-(+ret_wt_gm7);
					
					$('#cum_wt_gm_1').val(cum_wt_gm_1);
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed());
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed());
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed());
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed());
					$('#cum_wt_gm_6').val(cum_wt_gm_6.toFixed());
					$('#cum_wt_gm_7').val(cum_wt_gm_7.toFixed());
					$('#cum_wt_gm_8').val(cum_wt_gm_8.toFixed());
					
					var cum_wt_gm1 = $('#cum_wt_gm_1').val();
					var cum_wt_gm2 = $('#cum_wt_gm_2').val();
					var cum_wt_gm3 = $('#cum_wt_gm_3').val();
					var cum_wt_gm4 = $('#cum_wt_gm_4').val();
					var cum_wt_gm5 = $('#cum_wt_gm_5').val();
					var cum_wt_gm6 = $('#cum_wt_gm_6').val();
					var cum_wt_gm7 = $('#cum_wt_gm_7').val();
					var cum_wt_gm8 = $('#cum_wt_gm_8').val();
					

					var sums = (+cum_ret2)+(+cum_ret3)+(+cum_ret4)+(+cum_ret5)+(+cum_ret6)+(+cum_ret7)+(+cum_ret8);
					var ans = (+sums)/100;
					$('#grd_fm').val(ans.toFixed(2));
					
					
					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = (+cum_wt_gm_1)+(+cum_wt_gm_2)+(+cum_wt_gm_3)+(+cum_wt_gm_4)+(+cum_wt_gm_5)+(+cum_wt_gm_6)+(+cum_wt_gm_7)+(+cum_wt_gm_8);
					 $('#blank_extra').val(blank_extra.toFixed());
					 $('#sample_taken').val(sample_taken);
					//$('#silt_1').val(silt_1.toFixed(2));
					// $('#silt_2').val(silt_2.toFixed(2));
					// $('#silt_content').val(silt_content.toFixed(2));
					 
					
					var sampletaken1 = $('#sample_taken').val();
					var cum_wtgm1 = $('#cum_wt_gm_1').val();
					var cum_wtgm2 = $('#cum_wt_gm_2').val();
					var cum_wtgm3 = $('#cum_wt_gm_3').val();
					var cum_wtgm4 = $('#cum_wt_gm_4').val();
					var cum_wtgm5 = $('#cum_wt_gm_5').val();
					var cum_wtgm6 = $('#cum_wt_gm_6').val();
					var cum_wtgm7 = $('#cum_wt_gm_7').val();
					var cum_wtgm8 = $('#cum_wt_gm_8').val();
					
					//MINUS PLUS
					var ret_wtgm1 = cum_wtgm1;
					var ret_wtgm2 = (+cum_wtgm2)+(+ret_wtgm1);
					var ret_wtgm3 = (+cum_wtgm3)+(+ret_wtgm2);
					var ret_wtgm4 = (+cum_wtgm4)+(+ret_wtgm3);
					var ret_wtgm5 = (+cum_wtgm5)+(+ret_wtgm4);
					var ret_wtgm6 = (+cum_wtgm6)+(+ret_wtgm5);
					var ret_wtgm7 = (+cum_wtgm7)+(+ret_wtgm6);
					var ret_wtgm8 = (+cum_wtgm8)+(+ret_wtgm7);
					
					$('#ret_wt_gm_1').val(ret_wtgm1);
					$('#ret_wt_gm_2').val(ret_wtgm2.toFixed());
					$('#ret_wt_gm_3').val(ret_wtgm3.toFixed());
					$('#ret_wt_gm_4').val(ret_wtgm4.toFixed());
					$('#ret_wt_gm_5').val(ret_wtgm5.toFixed());
					$('#ret_wt_gm_6').val(ret_wtgm6.toFixed());
					$('#ret_wt_gm_7').val(ret_wtgm7.toFixed());
					$('#ret_wt_gm_8').val(ret_wtgm8.toFixed());
					
					var blank_extra = (+cum_wtgm1)+(+cum_wtgm2)+(+cum_wtgm3)+(+cum_wtgm4)+(+cum_wtgm5)+(+cum_wtgm6)+(+cum_wtgm7)+(+cum_wtgm8);
					$('#blank_extra').val(blank_extra.toFixed());

					var ret_wtgm1 = $('#ret_wt_gm_1').val();
					var ret_wtgm2 = $('#ret_wt_gm_2').val();
					var ret_wtgm3 = $('#ret_wt_gm_3').val();
					var ret_wtgm4 = $('#ret_wt_gm_4').val();
					var ret_wtgm5 = $('#ret_wt_gm_5').val();
					var ret_wtgm6 = $('#ret_wt_gm_6').val();
					var ret_wtgm7 = $('#ret_wt_gm_7').val();
					var ret_wtgm8 = $('#ret_wt_gm_8').val();
					
					var cumret1 = ((+ret_wtgm1)/(+sampletaken1))*100;
					var cumret2 = ((+ret_wtgm2)/(+sampletaken1))*100;
					var cumret3 = ((+ret_wtgm3)/(+sampletaken1))*100;
					var cumret4 = ((+ret_wtgm4)/(+sampletaken1))*100;
					var cumret5 = ((+ret_wtgm5)/(+sampletaken1))*100;
					var cumret6 = ((+ret_wtgm6)/(+sampletaken1))*100;
					var cumret7 = ((+ret_wtgm7)/(+sampletaken1))*100;
					var cumret8 = ((+ret_wtgm8)/(+sampletaken1))*100;
					
					$('#cum_ret_1').val(cumret1.toFixed(2));
					$('#cum_ret_2').val(cumret2.toFixed(2));
					$('#cum_ret_3').val(cumret3.toFixed(2));
					$('#cum_ret_4').val(cumret4.toFixed(2));
					$('#cum_ret_5').val(cumret5.toFixed(2));
					$('#cum_ret_6').val(cumret6.toFixed(2));
					$('#cum_ret_7').val(cumret7.toFixed(2));
					$('#cum_ret_8').val(cumret8.toFixed(2));
					
					var cum__ret1 = $('#cum_ret_1').val();
					var cum__ret2 = $('#cum_ret_2').val();
					var cum__ret3 = $('#cum_ret_3').val();
					var cum__ret4 = $('#cum_ret_4').val();
					var cum__ret5 = $('#cum_ret_5').val();
					var cum__ret6 = $('#cum_ret_6').val();
					var cum__ret7 = $('#cum_ret_7').val();
					var cum__ret8 = $('#cum_ret_8').val();
					
					var passsample1 = 100.00;
					var passsample2 = (+100.00) - (+cum__ret2);
					var passsample3 = (+100.00) - (+cum__ret3);
					var passsample4 = (+100.00) - (+cum__ret4);
					var passsample5 = (+100.00) - (+cum__ret5);
					var passsample6 = (+100.00) - (+cum__ret6);
					var passsample7 = (+100.00) - (+cum__ret7);
					var passsample8 = (+100.00) - (+cum__ret8);
				
					$('#pass_sample_1').val(passsample1);
					$('#pass_sample_2').val(passsample2.toFixed(2));
					$('#pass_sample_3').val(passsample3.toFixed(2));
					$('#pass_sample_4').val(passsample4.toFixed(2));
					$('#pass_sample_5').val(passsample5.toFixed(2));
					$('#pass_sample_6').val(passsample6.toFixed(2));
					$('#pass_sample_7').val(passsample7.toFixed(2));
					$('#pass_sample_8').val(passsample8.toFixed(2));

					var sums = (+cum__ret2)+(+cum__ret3)+(+cum__ret4)+(+cum__ret5)+(+cum__ret6)+(+cum__ret7)+(+cum__ret8);
					var ans = (+sums)/100;
					$('#grd_fm').val(ans.toFixed(2));
		}
		
	
	
	
	$("#grd_zone").change(function(){
		$('#txtgrd').css("background-color","var(--success)");	
			if ($("#chk_grd").is(':checked')) {
				
			sieve_1="10.00 (mm)";	
			sieve_2="4.75 (mm)";	
			sieve_3="2.36 (mm)";	
			sieve_4="1.18 (mm)";	
			sieve_5="0.600 (mm)";
			sieve_6="0.300 (mm)";
			sieve_7="0.150 (mm)";	
			sieve_8="0.075 (mm)";	
					var sample_taken=1000;
					
					grd_zone =  $("#grd_zone").val();
					
					if(grd_zone=="Zone I")
					{
						//PASSING RANGE
						var pass_sample_1 = randomNumberFromRange(100, 100);
						var pass_sample_2 = randomNumberFromRange(91.00,99.00);
						var pass_sample_3 = randomNumberFromRange(65.00,89.00);
						var pass_sample_4 = randomNumberFromRange(34.00,63.00);
						var pass_sample_5 = randomNumberFromRange(18.00,30.00);
						var pass_sample_6 = randomNumberFromRange(7.00,16.00);
						var pass_sample_7 = randomNumberFromRange(0.50,6.00);
						
					}
					else if(grd_zone=="Zone II")
					{
						//PASSING RANGE
						var pass_sample_1 = randomNumberFromRange(100, 100);
						var pass_sample_2 = randomNumberFromRange(91.00,99.00);
						var pass_sample_3 = randomNumberFromRange(80.00,89.00);
						var pass_sample_4 = randomNumberFromRange(59.00,78.00);
						var pass_sample_5 = randomNumberFromRange(36.00,57.00);
						var pass_sample_6 = randomNumberFromRange(10.00,29.00);
						var pass_sample_7 = randomNumberFromRange(0.50,8.00);
				
					}
					else if(grd_zone=="Zone III")
					{
						//PASSING RANGE
						var pass_sample_1 = randomNumberFromRange(100, 100);
						var pass_sample_2 = randomNumberFromRange(93.00,99.00);
						var pass_sample_3 = randomNumberFromRange(86.00,92.00);
						var pass_sample_4 = randomNumberFromRange(76.00,85.00);
						var pass_sample_5 = randomNumberFromRange(61.00,75.00);
						var pass_sample_6 = randomNumberFromRange(13.00,39.00);
						var pass_sample_7 = randomNumberFromRange(0.50,7.00);
						
					}
					else if(grd_zone=="Zone IV")
					{
						//PASSING RANGE
						var pass_sample_1 = randomNumberFromRange(100, 100);
						var pass_sample_2 = randomNumberFromRange(98.00,100.00);
						var pass_sample_3 = randomNumberFromRange(95.50,97.50);
						var pass_sample_4 = randomNumberFromRange(90.50,94.50);
						var pass_sample_5 = randomNumberFromRange(81.00,90.00);
						var pass_sample_6 = randomNumberFromRange(16.00,49.00);
						var pass_sample_7 = randomNumberFromRange(0.50,14.00);
						
					}
					
					$('#pass_sample_1').val(pass_sample_1.toFixed(2));
					$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					$('#pass_sample_5').val(pass_sample_5.toFixed(2));
					$('#pass_sample_6').val(pass_sample_6.toFixed(2));
					$('#pass_sample_7').val(pass_sample_7.toFixed(2));
					
					var pass_sample1 = $('#pass_sample_1').val();
					var pass_sample2 = $('#pass_sample_2').val();
					var pass_sample3 = $('#pass_sample_3').val();
					var pass_sample4 = $('#pass_sample_4').val();
					var pass_sample5 = $('#pass_sample_5').val();
					var pass_sample6 = $('#pass_sample_6').val();
					var pass_sample7 = $('#pass_sample_7').val();
					
					
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100 - (+pass_sample1);
					var cum_ret_2 = 100 - (+pass_sample2);
					var cum_ret_3 = 100 - (+pass_sample3);
					var cum_ret_4 = 100 - (+pass_sample4);
					var cum_ret_5 = 100 - (+pass_sample5);
					var cum_ret_6 = 100 - (+pass_sample6);
					var cum_ret_7 = 100 - (+pass_sample7);
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(2));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
					$('#cum_ret_6').val(cum_ret_6.toFixed(2));
					$('#cum_ret_7').val(cum_ret_7.toFixed(2));
					
					var cum_ret1 = $('#cum_ret_1').val();
					var cum_ret2 = $('#cum_ret_2').val();
					var cum_ret3 = $('#cum_ret_3').val();
					var cum_ret4 = $('#cum_ret_4').val();
					var cum_ret5 = $('#cum_ret_5').val();
					var cum_ret6 = $('#cum_ret_6').val();
					var cum_ret7 = $('#cum_ret_7').val();
					
					
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = ((+cum_ret1)*(+sample_taken))/100;
					var ret_wt_gm_2 = ((+cum_ret2)*(+sample_taken))/100;
					var ret_wt_gm_3 = ((+cum_ret3)*(+sample_taken))/100;
					var ret_wt_gm_4 = ((+cum_ret4)*(+sample_taken))/100;
					var ret_wt_gm_5 = ((+cum_ret5)*(+sample_taken))/100;
					var ret_wt_gm_6 = ((+cum_ret6)*(+sample_taken))/100;
					var ret_wt_gm_7 = ((+cum_ret7)*(+sample_taken))/100;
					
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed());
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed());
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed());
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed());
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed());
					$('#ret_wt_gm_6').val(ret_wt_gm_6.toFixed());
					$('#ret_wt_gm_7').val(ret_wt_gm_7.toFixed());
					
					var ret_wt_gm1 = $('#ret_wt_gm_1').val();
					var ret_wt_gm2 = $('#ret_wt_gm_2').val();
					var ret_wt_gm3 = $('#ret_wt_gm_3').val();
					var ret_wt_gm4 = $('#ret_wt_gm_4').val();
					var ret_wt_gm5 = $('#ret_wt_gm_5').val();
					var ret_wt_gm6 = $('#ret_wt_gm_6').val();
					var ret_wt_gm7 = $('#ret_wt_gm_7').val();
					
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm1;
					var cum_wt_gm_2 = (+ret_wt_gm2)-(+ret_wt_gm1);
					var cum_wt_gm_3 = (+ret_wt_gm3)-(+ret_wt_gm2);
					var cum_wt_gm_4 = (+ret_wt_gm4)-(+ret_wt_gm3);
					var cum_wt_gm_5 = (+ret_wt_gm5)-(+ret_wt_gm4);
					var cum_wt_gm_6 = (+ret_wt_gm6)-(+ret_wt_gm5);
					var cum_wt_gm_7 = (+ret_wt_gm7)-(+ret_wt_gm6);
					
					$('#cum_wt_gm_1').val(cum_wt_gm_1);
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed());
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed());
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed());
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed());
					$('#cum_wt_gm_6').val(cum_wt_gm_6.toFixed());
					$('#cum_wt_gm_7').val(cum_wt_gm_7.toFixed());
					
					var cum_wt_gm1 = $('#cum_wt_gm_1').val();
					var cum_wt_gm2 = $('#cum_wt_gm_2').val();
					var cum_wt_gm3 = $('#cum_wt_gm_3').val();
					var cum_wt_gm4 = $('#cum_wt_gm_4').val();
					var cum_wt_gm5 = $('#cum_wt_gm_5').val();
					var cum_wt_gm6 = $('#cum_wt_gm_6').val();
					var cum_wt_gm7 = $('#cum_wt_gm_7').val();
					

					var sums = (+cum_ret2)+(+cum_ret3)+(+cum_ret4)+(+cum_ret5)+(+cum_ret6)+(+cum_ret7);
					var ans = (+sums)/100;
					$('#grd_fm').val(ans.toFixed(2));
					
					
					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = (+cum_wt_gm_1)+(+cum_wt_gm_2)+(+cum_wt_gm_3)+(+cum_wt_gm_4)+(+cum_wt_gm_5)+(+cum_wt_gm_6)+(+cum_wt_gm_7);
					 $('#blank_extra').val(blank_extra.toFixed());
					 $('#sample_taken').val(sample_taken.toFixed());
					$('#silt_1').val(silt_1.toFixed(2));
					 $('#silt_2').val(silt_2.toFixed(2));
					 $('#silt_content').val(silt_content.toFixed(2));
					 
					
					var sampletaken1 = $('#sample_taken').val();
					var cum_wtgm1 = $('#cum_wt_gm_1').val();
					var cum_wtgm2 = $('#cum_wt_gm_2').val();
					var cum_wtgm3 = $('#cum_wt_gm_3').val();
					var cum_wtgm4 = $('#cum_wt_gm_4').val();
					var cum_wtgm5 = $('#cum_wt_gm_5').val();
					var cum_wtgm6 = $('#cum_wt_gm_6').val();
					var cum_wtgm7 = $('#cum_wt_gm_7').val();
					
					//MINUS PLUS
					var ret_wtgm1 = cum_wtgm1;
					var ret_wtgm2 = (+cum_wtgm2)+(+ret_wtgm1);
					var ret_wtgm3 = (+cum_wtgm3)+(+ret_wtgm2);
					var ret_wtgm4 = (+cum_wtgm4)+(+ret_wtgm3);
					var ret_wtgm5 = (+cum_wtgm5)+(+ret_wtgm4);
					var ret_wtgm6 = (+cum_wtgm6)+(+ret_wtgm5);
					var ret_wtgm7 = (+cum_wtgm7)+(+ret_wtgm6);
					
					$('#ret_wt_gm_1').val(ret_wtgm1);
					$('#ret_wt_gm_2').val(ret_wtgm2.toFixed());
					$('#ret_wt_gm_3').val(ret_wtgm3.toFixed());
					$('#ret_wt_gm_4').val(ret_wtgm4.toFixed());
					$('#ret_wt_gm_5').val(ret_wtgm5.toFixed());
					$('#ret_wt_gm_6').val(ret_wtgm6.toFixed());
					$('#ret_wt_gm_7').val(ret_wtgm7.toFixed());
					
					var blank_extra = (+cum_wtgm1)+(+cum_wtgm2)+(+cum_wtgm3)+(+cum_wtgm4)+(+cum_wtgm5)+(+cum_wtgm6)+(+cum_wtgm7);
					$('#blank_extra').val(blank_extra.toFixed());

					var ret_wtgm1 = $('#ret_wt_gm_1').val();
					var ret_wtgm2 = $('#ret_wt_gm_2').val();
					var ret_wtgm3 = $('#ret_wt_gm_3').val();
					var ret_wtgm4 = $('#ret_wt_gm_4').val();
					var ret_wtgm5 = $('#ret_wt_gm_5').val();
					var ret_wtgm6 = $('#ret_wt_gm_6').val();
					var ret_wtgm7 = $('#ret_wt_gm_7').val();
					
					var cumret1 = ((+ret_wtgm1)/(+sampletaken1))*100;
					var cumret2 = ((+ret_wtgm2)/(+sampletaken1))*100;
					var cumret3 = ((+ret_wtgm3)/(+sampletaken1))*100;
					var cumret4 = ((+ret_wtgm4)/(+sampletaken1))*100;
					var cumret5 = ((+ret_wtgm5)/(+sampletaken1))*100;
					var cumret6 = ((+ret_wtgm6)/(+sampletaken1))*100;
					var cumret7 = ((+ret_wtgm7)/(+sampletaken1))*100;
					
					$('#cum_ret_1').val(cumret1.toFixed(2));
					$('#cum_ret_2').val(cumret2.toFixed(2));
					$('#cum_ret_3').val(cumret3.toFixed(2));
					$('#cum_ret_4').val(cumret4.toFixed(2));
					$('#cum_ret_5').val(cumret5.toFixed(2));
					$('#cum_ret_6').val(cumret6.toFixed(2));
					$('#cum_ret_7').val(cumret7.toFixed(2));
					
					var cum__ret1 = $('#cum_ret_1').val();
					var cum__ret2 = $('#cum_ret_2').val();
					var cum__ret3 = $('#cum_ret_3').val();
					var cum__ret4 = $('#cum_ret_4').val();
					var cum__ret5 = $('#cum_ret_5').val();
					var cum__ret6 = $('#cum_ret_6').val();
					var cum__ret7 = $('#cum_ret_7').val();
					
					var passsample1 = 100.00;
					var passsample2 = (+100.00) - (+cum__ret2);
					var passsample3 = (+100.00) - (+cum__ret3);
					var passsample4 = (+100.00) - (+cum__ret4);
					var passsample5 = (+100.00) - (+cum__ret5);
					var passsample6 = (+100.00) - (+cum__ret6);
					var passsample7 = (+100.00) - (+cum__ret7);
				
					$('#pass_sample_1').val(passsample1);
					$('#pass_sample_2').val(passsample2.toFixed(2));
					$('#pass_sample_3').val(passsample3.toFixed(2));
					$('#pass_sample_4').val(passsample4.toFixed(2));
					$('#pass_sample_5').val(passsample5.toFixed(2));
					$('#pass_sample_6').val(passsample6.toFixed(2));
					$('#pass_sample_7').val(passsample7.toFixed(2));

					var sums = (+cum__ret2)+(+cum__ret3)+(+cum__ret4)+(+cum__ret5)+(+cum__ret6)+(+cum__ret7);
					var ans = (+sums)/100;
					$('#grd_fm').val(ans.toFixed(2));
			}
	});
	
	//Organic Impurities
	function  aoi_auto()
	{
		$('#txtaoi').css("background-color","var(--success)");
		var aoi_1 = 125;
		var aoi_2 = 125;
		var aoi_3 = "NIL";
		var aoi_4 = "Visual Match With Standard Solution, Organic Impurities Not Detected.";
		$('#aoi_1').val(aoi_1);
		$('#aoi_2').val(aoi_2);
		$('#aoi_3').val(aoi_3);
		$('#aoi_4').val(aoi_4);
		
	}
	
	
	$('#chk_aoi').change(function(){
        if(this.checked)
		{ 
			aoi_auto();
		}
		else
		{
			$('#txtaoi').css("background-color","#fff");
			$('#avg_org').val(null);
		}
	});
	
	function  pha_auto()
	{
		$('#txtpha').css("background-color","var(--success)");
		var ph_s1_1 = randomNumberFromRange(30.00,30.10).toFixed(2);
		$('#ph_s1_1').val(ph_s1_1);            
		var ph_s11 = $('#ph_s1_1').val();      
											   
		var ph_s2_1 = randomNumberFromRange(30.00,30.10).toFixed(2);
		$('#ph_s2_1').val(ph_s2_1);
		var ph_s21 = $('#ph_s2_1').val();
		
		var ph_s1_2 = randomNumberFromRange(7.10,7.15).toFixed(2);
		$('#ph_s1_2').val(ph_s1_2);            
		var ph_s12 = $('#ph_s1_2').val();      
											   
		var ph_s2_2 = randomNumberFromRange(7.10,7.15).toFixed(2);
		$('#ph_s2_2').val(ph_s2_2);
		var ph_s22 = $('#ph_s2_2').val();
		
		var avg = ((+ph_s12)  + (+ph_s22)) / 2;
		$('#avg_ph').val(avg.toFixed(2));
		
		
	}
	
	$('#chk_pha').change(function(){
        if(this.checked)
		{
			pha_auto();
		}
        else
		{
			$('#txtpha').css("background-color","white");
			$('#ph_s1_1').val(null);
			$('#ph_s1_2').val(null);
			$('#ph_s2_1').val(null);
			$('#ph_s2_2').val(null);
			$('#avg_ph').val(null);
		}
    });
	
	//Deleterias Material
	function  dtm_auto()
	{
		$('#txtdtm').css("background-color","var(--success)");
		
		var dele_1_1 = randomNumberFromRange(500.00,500.00).toFixed(2);
		var dele_3_1 = randomNumberFromRange(500.00,500.00).toFixed(2);
		$('#dele_1_1').val(dele_1_1);
		$('#dele_3_1').val(dele_3_1);
		var dele11 = $('#dele_1_1').val();
		var dele31 = $('#dele_3_1').val();
		
		
		var dele_1_2 = randomNumberFromRange(485.60,486.00);
		var dele_3_2 = randomNumberFromRange(485.60,486.00);
		$('#dele_1_2').val(dele_1_2.toFixed(2));
		$('#dele_3_2').val(dele_3_2.toFixed(2));
		var dele12 = $('#dele_1_2').val();
		var dele32 = $('#dele_3_2').val();
		
		var dele_1_3 = (+dele11) - (+dele12);
		var dele_3_3 = (+dele31) - (+dele32);
		$('#dele_1_3').val(dele_1_3.toFixed(2));
		$('#dele_3_3').val(dele_3_3.toFixed(2));
		var dele13 = $('#dele_1_3').val();
		var dele33 = $('#dele_3_3').val();
		
		var dele_1_4 = ((+dele13) / (+dele11)) * (+100);
		var dele_3_4 = ((+dele33) / (+dele31)) * (+100);
		
		$('#dele_1_4').val(dele_1_4.toFixed(2));
		$('#dele_3_4').val(dele_3_4.toFixed(2));
		
		
		var dele_2_1 = randomNumberFromRange(500.000,500.000).toFixed(2);
		$('#dele_2_1').val(dele_2_1);
		var dele21 = $('#dele_2_1').val();
		
		var dele_4_1 = randomNumberFromRange(500.000,500.000).toFixed(2);
		$('#dele_4_1').val(dele_4_1);
		var dele41 = $('#dele_4_1').val();
		
		
		var dele_2_2 = randomNumberFromRange(495.00,499.00).toFixed(2);
		$('#dele_2_2').val(dele_2_2);
		var dele22 = $('#dele_2_2').val();
		
		var dele_2_3 = (+dele21) - (+dele22);
		var dele_2_3 = ((+dele_2_3) / (+dele21)) * (+100);
		
		$('#dele_2_3').val(dele_2_3.toFixed(2));
		
		var dele_4_2 = randomNumberFromRange(495.00,499.00).toFixed(2);
		$('#dele_4_2').val(dele_4_2);
		var dele42 = $('#dele_4_2').val();
		
		var dele_4_3 = (+dele41) - (+dele42);
		var dele_4_3 = ((+dele_4_3) / (+dele41)) * (+100);
		
		$('#dele_4_3').val(dele_4_3.toFixed(2));
		
		
		/* var dele_3_1 = randomNumberFromRange(2.60,4.90).toFixed(2);
		$('#dele_3_1').val(dele_3_1);
		var dele31 = $('#dele_3_1').val();
		
		var dele_3_2 = randomNumberFromRange(500.00,500.00).toFixed(2);
		$('#dele_3_2').val(dele_3_2);
		
		var dele32= $('#dele_3_2').val();
		
		
		var dele_33 = (+dele31) / (+dele32);
		var dele_3_3 = (+dele_33) * (+100);
		$('#dele_3_3').val(dele_3_3.toFixed(2));
		
		
		
		var dele_4_1 = randomNumberFromRange(498.000,503.000).toFixed(2);
		$('#dele_4_1').val(dele_4_1);
		var dele41 = $('#dele_4_1').val();
		
		
		var dele_4_2 = (+dele41) * (+randomNumberFromRange(0.9990,0.9995).toFixed(4));
		$('#dele_4_2').val(dele_4_2.toFixed(2));
		var dele42 = $('#dele_4_2').val();
		
		var dele_4_3 = (+dele41) - (+dele42);
		var dele_4_3 = ((+dele_4_3) / (+dele41)) * (+100);
		
		$('#dele_4_3').val(dele_4_3.toFixed(2)); */
		
		
	}
	
	
	$('#dele_1_1,#dele_1_2,#dele_2_1,#dele_2_2,#dele_3_1,#dele_3_2,#dele_4_1,#dele_4_2').change(function(){
       var dele11 = $('#dele_1_1').val();
       var dele12 = $('#dele_1_2').val();
	   var dele21 = $('#dele_2_1').val();
       var dele22 = $('#dele_2_2').val();
	   var dele31 = $('#dele_3_1').val();
       var dele32 = $('#dele_3_2').val();
	   var dele41 = $('#dele_4_1').val();
       var dele42 = $('#dele_4_2').val();
	   
		
		var dele_1_3 = (+dele11) - (+dele12);
		var dele_3_3 = (+dele31) - (+dele32);
		$('#dele_1_3').val(dele_1_3.toFixed(2));
		$('#dele_3_3').val(dele_3_3.toFixed(2));
		var dele13 = $('#dele_1_3').val();
		var dele33 = $('#dele_3_3').val();
		
		var dele_1_4 = ((+dele13) / (+dele11)) * (+100);
		var dele_3_4 = ((+dele33) / (+dele31)) * (+100);
		
		$('#dele_1_4').val(dele_1_4.toFixed(2));
		$('#dele_3_4').val(dele_3_4.toFixed(2));
		
		var dele_2_3 = (+dele21) - (+dele22);
		var dele_2_3 = ((+dele_2_3) / (+dele21)) * (+100);
		
		$('#dele_2_3').val(dele_2_3.toFixed(2));
		
		var dele_4_3 = (+dele41) - (+dele42);
		var dele_4_3 = ((+dele_4_3) / (+dele41)) * (+100);
		
		$('#dele_4_3').val(dele_4_3.toFixed(2));
	   
	});
	
	
	$('#chk_dtm').change(function(){
        if(this.checked)
		{ 
			dtm_auto();
		}
		else
		{
			$('#txtdtm').css("background-color","#fff");
			$('#avg_dtm').val(null);
			$('#dele_1_1').val(null);
			$('#dele_1_2').val(null);
			$('#dele_1_3').val(null);
			$('#dele_1_4').val(null);
			
			$('#dele_2_1').val(null);
			$('#dele_2_2').val(null);
			$('#dele_2_3').val(null);
			
			$('#dele_3_1').val(null);
			$('#dele_3_2').val(null);
			$('#dele_3_3').val(null);
			
			$('#dele_4_1').val(null);
			$('#dele_4_2').val(null);
			$('#dele_4_3').val(null);
		}
	});
	
	function  clr_auto()
	{
		$('#txtclr').css("background-color","var(--success)");
		var clr_s1_1 = randomNumberFromRange(498.000,503.000).toFixed(3);
		$('#clr_s1_1').val(clr_s1_1);
		var clr_s11 = $('#clr_s1_1').val();
		
		var clr_s1_2 = randomNumberFromRange(498.000,503.000).toFixed(3);
		$('#clr_s1_2').val(clr_s1_2);
		var clr_s12 = $('#clr_s1_2').val();
		
		var clr_s1_3 = (+clr_s11) / (+clr_s12);
		$('#clr_s1_3').val(clr_s1_3.toFixed(3));
		var clr_s13 = $('#clr_s1_3').val();
		
		var clr_s2_1 = randomNumberFromRange(498.000,503.000).toFixed(3);
		$('#clr_s2_1').val(clr_s2_1);
		var clr_s21 = $('#clr_s2_1').val();

		var clr_s2_2 = randomNumberFromRange(498.000,503.000).toFixed(3);
		$('#clr_s2_2').val(clr_s2_2);
		var clr_s22 = $('#clr_s2_2').val();
		
		var clr_s2_3 = (+clr_s21) / (+clr_s22);
		$('#clr_s2_3').val(clr_s2_3.toFixed(3));
		var clr_s23 = $('#clr_s2_3').val();
		
		
		var clr_s1_4 = randomNumberFromRange(9.95,10.05);
		var clr_s2_4 = randomNumberFromRange(9.95,10.05);
		$('#clr_s1_4').val(clr_s1_4.toFixed(2));
		$('#clr_s2_4').val(clr_s2_4.toFixed(2));
		var clr_s14 = $('#clr_s1_4').val();
		var clr_s24 = $('#clr_s2_4').val();
		
		var clr_s1_5 = randomNumberFromRange(9.60,9.70);
		var clr_s2_5 = randomNumberFromRange(9.60,9.70);
		$('#clr_s1_5').val(clr_s1_5.toFixed(2));
		$('#clr_s2_5').val(clr_s2_5.toFixed(2));
		var clr_s15 = $('#clr_s1_5').val();
		var clr_s25 = $('#clr_s2_5').val();
		var clr_s1_6 = 0.10;
		var clr_s2_6 = 0.10;
		$('#clr_s1_6').val(clr_s1_6.toFixed(2));
		$('#clr_s2_6').val(clr_s2_6.toFixed(2));
		var clr_s16 = $('#clr_s1_6').val();
		var clr_s26 = $('#clr_s2_6').val();
		
		var so1_1 = (+10) * (+clr_s16) * (+clr_s15);
		var so2_1 = (+10) * (+clr_s26) * (+clr_s25);
		
		var sol1_1 = (+clr_s14) - (+so1_1);
		var sol2_1 = (+clr_s24) - (+so2_1);
		
		var fin1_1 = (+0.003546) * (+clr_s13) * (+sol1_1);
		var fin2_1 = (+0.003546) * (+clr_s23) * (+sol2_1);
		
		$('#clr_s1_7').val(fin1_1.toFixed(4));
		$('#clr_s2_7').val(fin2_1.toFixed(4));
		
		var clr_s17 = $('#clr_s1_7').val();
		var clr_s27 = $('#clr_s2_7').val();
		
		var avgs = ((+clr_s17) + (+clr_s27))/2;
		$('#av_clr').val(avgs.toFixed(3));
		
		
		
	}
	
	$('#chk_clr').change(function(){
        if(this.checked)
		{
			clr_auto();
		}
        else
		{
			$('#txtclr').css("background-color","white");
			$('#clr_s1_1').val(null);
			$('#clr_s1_2').val(null);
			$('#clr_s1_3').val(null);
			$('#clr_s1_4').val(null);
			$('#clr_s1_5').val(null);
			$('#clr_s1_6').val(null);
			$('#clr_s1_7').val(null);
			$('#clr_s2_1').val(null);
			$('#clr_s2_2').val(null);
			$('#clr_s2_3').val(null);
			$('#clr_s2_4').val(null);
			$('#clr_s2_5').val(null);
			$('#clr_s2_6').val(null);
			$('#clr_s2_7').val(null);
			$('#av_clr').val(null);
		}
    });
	
	function  slp_auto()
	{
		$('#txtslp').css("background-color","var(--success)");
		
		var avg_sul = randomNumberFromRange(13,14).toFixed(2);
		$('#avg_sul').val(avg_sul);
		var avg_sul  = $('#avg_sul').val();
		
		var slp_s1_3 = (+avg_sul) - 2; 
		var slp_s2_3 = (+avg_sul) + 2;
		
		$('#slp_s1_3').val(slp_s1_3);
		$('#slp_s2_3').val(slp_s2_3);
		
		var slp_s1_3  = $('#slp_s1_3').val();
		var slp_s2_3  = $('#slp_s2_3').val();
		
		var slp_s1_1 = randomNumberFromRange(200,200).toFixed(0);
		$('#slp_s1_1').val(slp_s1_1);            
		var slp_s11 = $('#slp_s1_1').val(); 
		
		var slp_s2_1 = randomNumberFromRange(200,200).toFixed(0);
		$('#slp_s2_1').val(slp_s2_1);
		var slp_s21 = $('#slp_s2_1').val();
		
		var slp_s1_2 = ((+slp_s1_3) * (+slp_s11)) / (+100);
		var slp_s2_2 =((+slp_s2_3) * (+slp_s21)) / (+100);
		$('#slp_s1_2').val(slp_s1_2.toFixed(0));
		$('#slp_s2_2').val(slp_s2_2.toFixed(0));
		
		var slp_s1_2 = $('#slp_s1_2').val();
		var slp_s2_2 = $('#slp_s2_2').val();
		var slp_s1_1 = $('#slp_s1_1').val();
		var slp_s2_1 = $('#slp_s2_1').val();
		
		var slp_s1_3 = ((+slp_s1_2) / (+slp_s1_1)) * (+100);
		var slp_s2_3 =((+slp_s2_2) / (+slp_s2_1)) * (+100);
		$('#slp_s1_3').val(slp_s1_3.toFixed(2));
		$('#slp_s2_3').val(slp_s2_3.toFixed(2));
		
		var slp_s1_3 = $('#slp_s1_3').val();
		var slp_s2_3 = $('#slp_s2_3').val();
		
		var avg_sul =((+slp_s1_3) + (+slp_s2_3)) / (+2);
		$('#avg_sul').val(avg_sul.toFixed(2));
		
		/* var slp_s1_1 = randomNumberFromRange(10.0100,10.0300).toFixed(4);
		$('#slp_s1_1').val(slp_s1_1);            
		var slp_s11 = $('#slp_s1_1').val();      
												 
		var slp_s2_1 = randomNumberFromRange(10.0100,10.0300).toFixed(4);
		$('#slp_s2_1').val(slp_s2_1);
		var slp_s21 = $('#slp_s2_1').val();
		
		var slp_s1_2 = randomNumberFromRange(69.0000,71.0000).toFixed(4);
		$('#slp_s1_2').val(slp_s1_2);            
		var slp_s12 = $('#slp_s1_2').val();      
												 
		var slp_s2_2 = randomNumberFromRange(69.0000,71.0000).toFixed(4);
		$('#slp_s2_2').val(slp_s2_2);
		var slp_s22 = $('#slp_s2_2').val();
		
		var slp_s1_3 = (+slp_s12) * (+randomNumberFromRange(1.00005,1.00012).toFixed(5));
		$('#slp_s1_3').val(slp_s1_3.toFixed(4));            
		var slp_s13 = $('#slp_s1_3').val();      
												 
		var slp_s2_3 = (+slp_s22) * (+randomNumberFromRange(1.00005,1.00012).toFixed(5));
		$('#slp_s2_3').val(slp_s2_3.toFixed(4));
		var slp_s23 = $('#slp_s2_3').val();
		
		var slp_s1_4 = (+slp_s13) - (+slp_s12);
		var slp_s2_4 = (+slp_s23) - (+slp_s22);
		$('#slp_s1_4').val(slp_s1_4.toFixed(4));
		$('#slp_s2_4').val(slp_s2_4.toFixed(4));
		var slp_s14 = $('#slp_s1_4').val();
		var slp_s24 = $('#slp_s2_4').val();
		
		var slp_s1_5 = ((+41.15) * (+slp_s14)) / (+slp_s11);
		var slp_s2_5 = ((+41.15) * (+slp_s24)) / (+slp_s21);
		$('#slp_s1_5').val(slp_s1_5.toFixed(4));
		$('#slp_s2_5').val(slp_s2_5.toFixed(4));
		var slp_s15 = $('#slp_s1_5').val();
		var slp_s25 = $('#slp_s2_5').val();
		
		var avg = ((+slp_s15) + (+slp_s25)) / 2;
		$('#avg_sul').val(avg.toFixed(3)); */
	}
	
	$('#slp_s1_1,#slp_s2_1,#slp_s1_2,#slp_s2_2').change(function(){
		
		var slp_s1_2 = $('#slp_s1_2').val();
		var slp_s2_2 = $('#slp_s2_2').val();
		var slp_s1_1 = $('#slp_s1_1').val();
		var slp_s2_1 = $('#slp_s2_1').val();
		
		var slp_s1_3 = ((+slp_s1_2) / (+slp_s1_1)) * (+100);
		var slp_s2_3 =((+slp_s2_2) / (+slp_s2_1)) * (+100);
		$('#slp_s1_3').val(slp_s1_3.toFixed(2));
		$('#slp_s2_3').val(slp_s2_3.toFixed(2));
		
		var avg_sul =((+slp_s1_3) + (+slp_s2_3)) / (+2);
		$('#avg_sul').val(avg_sul.toFixed(2));
    });
	
	$('#chk_slp').change(function(){
        if(this.checked)
		{
			slp_auto();
		}
        else
		{
			$('#txtslp').css("background-color","white");
			$('#slp_s1_1').val(null);
			$('#slp_s1_2').val(null);
			$('#slp_s1_3').val(null);
			$('#slp_s1_4').val(null);
			$('#slp_s1_5').val(null);
			$('#slp_s2_1').val(null);
			$('#slp_s2_2').val(null);
			$('#slp_s2_3').val(null);
			$('#slp_s2_4').val(null);
			$('#slp_s2_5').val(null);
			$('#avg_sul').val(null);
		}
    });
	
	$('#chk_slp').change(function(){
        if(this.checked)
		{
			slp_auto();
		}
        else
		{
			$('#txtslp').css("background-color","white");
			$('#slp_s1_1').val(null);
			$('#slp_s1_2').val(null);
			$('#slp_s1_3').val(null);
			$('#slp_s1_4').val(null);
			$('#slp_s1_5').val(null);
			$('#slp_s2_1').val(null);
			$('#slp_s2_2').val(null);
			$('#slp_s2_3').val(null);
			$('#slp_s2_4').val(null);
			$('#slp_s2_5').val(null);
			$('#avg_sul').val(null);
		}
    });
	
	
	
	
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--success)"); 
			//$('#txtwtr').css("background-color","var(--success)"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				//grd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grd")
					{
						$('#txtgrd').css("background-color","var(--success)");	
						$("#chk_grd").prop("checked", true); 
						grd_auto();
						break;
					}					
				}
				
				//density
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="den")
					{
						
						$("#chk_den").prop("checked", true); 
						den_auto();
						break;
					}					
				}
		
				//Deleterias Material
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dtm")
					{
						$("#chk_dtm").prop("checked", true); 
						dtm_auto();
						break;
					}					
				}
				
				//Organic Impurities
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="aoi")
					{
						$("#chk_aoi").prop("checked", true); 
						aoi_auto();
						break;
					}					
				}
				//clr
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="clr")
					{
						$('#txtclr').css("background-color","var(--success)");
						$("#chk_clr").prop("checked", true); 
						clr_auto();
						break;
					}					
				}
				
				//sil
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sil")
					{
						$('#txtslp').css("background-color","var(--success)");
						$("#chk_slp").prop("checked", true); 
						slp_auto();
						break;
					}					
				}
				//pha
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pha")
					{
						$('#txtpha').css("background-color","var(--success)");
						$("#chk_pha").prop("checked", true); 
						pha_auto();
						break;
					}					
				}
				
				//SPG
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{
						$('#txtwtr').css("background-color","var(--success)"); 
						$("#chk_sp").prop("checked", true); 
						sp_auto();
						break;
					}					
				}
				
				//DENSITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{
						$('#txtalk').css("background-color","var(--success)");
						$("#chk_alk").prop("checked", true); 
						alk_auto();
						break;
					}					
				}
				//soundness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{
						$('#txtsou').css("background-color","var(--success)");
						$("#chk_sou").prop("checked", true); 
						soundness_auto();
						break;
					}					
				}
				
				//finer
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fne")
					{
						$('#txtfne').css("background-color","var(--success)");
						$("#chk_finer").prop("checked", true); 
						finer_auto();
						break;
					}					
				}
				//fmc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fmc")
					{
						$('#txtfmc').css("background-color","var(--success)");
						$("#chk_fmc").prop("checked", true); 
						fmc_auto();
						break;
					}					
				}
				
				//lbd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lbd")
					{
						$('#txtlbd').css("background-color","var(--success)");
						$("#chk_lbd").prop("checked", true); 
						lbd_auto();
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
	function get_excel_record(){
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
        url: '<?php echo $base_url; ?>save_sand.php',
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
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//GRADATION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grd")
					{
						if(document.getElementById('chk_grd').checked) {
								var chk_grd = "1";
						}
						else{
								var chk_grd = "0";
						}	
							var chk_fm = "1";
							var grd_fm = $('#grd_fm').val();						
							var sieve_1="10 (mm)";	
							var sieve_2="4.75 (mm)";	
							var sieve_3="2.36 (mm)";	
							var sieve_4="1.18 (mm)";	
							var sieve_5="0.600 (mm)";
							var sieve_6="0.300 (mm)";
							var sieve_7="0.150 (mm)";
							var sieve_8="0.075 (mm)";
						
							var sample_taken = $('#sample_taken').val();
							var blank_extra = $('#blank_extra').val();
							var grd_zone = $('#grd_zone').val();
							var silt_content = $('#silt_content').val();
							var silt_1 = $('#silt_1').val();
							var silt_2 = $('#silt_2').val();
							var chk_silt = "1";
							var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
							var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
							var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
							var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
							var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
							var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
							var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
							var cum_wt_gm_8 = $('#cum_wt_gm_8').val();
															
							var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
							var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
							var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
							var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
							var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
							var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
							var ret_wt_gm_7 = $('#ret_wt_gm_7').val();
							var ret_wt_gm_8 = $('#ret_wt_gm_8').val();
							
							var cum_ret_1 = $('#cum_ret_1').val();
							var cum_ret_2 = $('#cum_ret_2').val();
							var cum_ret_3 = $('#cum_ret_3').val();
							var cum_ret_4 = $('#cum_ret_4').val();
							var cum_ret_5 = $('#cum_ret_5').val();
							var cum_ret_6 = $('#cum_ret_6').val();
							var cum_ret_7 = $('#cum_ret_7').val();
							var cum_ret_8 = $('#cum_ret_8').val();
							
							var pass_sample_1 = $('#pass_sample_1').val();
							var pass_sample_2 = $('#pass_sample_2').val();
							var pass_sample_3 = $('#pass_sample_3').val();
							var pass_sample_4 = $('#pass_sample_4').val();
							var pass_sample_5 = $('#pass_sample_5').val();
							var pass_sample_6 = $('#pass_sample_6').val();
							var pass_sample_7 = $('#pass_sample_7').val();
							var pass_sample_8 = $('#pass_sample_8').val();
							
							var grd_s_d = $('#grd_s_d').val();
							var grd_e_d = $('#grd_e_d').val();
							var slt_s_d = $('#slt_s_d').val();
							var slt_e_d = $('#slt_e_d').val();
							
						break;
					}
					else
					{
						var chk_grd = "0";	
						var grd_zone = "0";	
						var chk_fm = "0";
						var grd_fm = "0";
						var silt_1 = "0";
						var silt_2 = "0";
						var cum_wt_gm_1 ="0";
						var cum_wt_gm_2 ="0";
						var cum_wt_gm_3 ="0";
						var cum_wt_gm_4 ="0";
						var cum_wt_gm_5 ="0";
						var cum_wt_gm_6 ="0";
						var cum_wt_gm_7 ="0";
						var cum_wt_gm_8 ="0";
						
						var ret_wt_gm_1 ="0";
						var ret_wt_gm_2 ="0";
						var ret_wt_gm_3 ="0";
						var ret_wt_gm_4 ="0";
						var ret_wt_gm_5 ="0";
						var ret_wt_gm_6 ="0";
						var ret_wt_gm_7 ="0";
						var ret_wt_gm_8 ="0";
						
						
						var cum_ret_1 ="0";
						var cum_ret_2 ="0";
						var cum_ret_3 ="0";
						var cum_ret_4 ="0";
						var cum_ret_5 ="0";
						var cum_ret_6 ="0";
						var cum_ret_7 ="0";
						var cum_ret_8 ="0";
						
						var pass_sample_1 ="0";
						var pass_sample_2 ="0";
						var pass_sample_3 ="0";
						var pass_sample_4 ="0";
						var pass_sample_5 ="0";
						var pass_sample_6 ="0";
						var pass_sample_7 ="0";
						var pass_sample_8 ="0";
						
						 var blank_extra ="0";
						 var sample_taken ="0";
						 var silt_content = "0";
						 var chk_silt = "0";
						 
						 var grd_s_d = "";
						 var grd_e_d = "";
						 var slt_s_d = "";
						 var slt_e_d = "";
					}
														
				}

				
				// bulk density
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="den")
					{
						
							if(document.getElementById('chk_den').checked) {
									var chk_den = "1";
							}
							else{
									var chk_den = "0";
							}
						
							
							var m11 = $('#m11').val();
							var m12 = $('#m12').val();
							var m13 = $('#m13').val();
							var m21 = $('#m21').val();
							var m22 = $('#m22').val();
							var m23 = $('#m23').val();
							var m31 = $('#m31').val();
							var m32 = $('#m32').val();
							var m33 = $('#m33').val();
							
							var wom2 = $('#wom2').val();
							var wom3 = $('#wom3').val();
							var avg_wom = $('#avg_wom').val();
							var vol = $('#vol').val();
							var bdl = $('#bdl').val();
							
							var den_s_d = $('#den_s_d').val();
							var den_e_d = $('#den_e_d').val();
							
							var avg_wom1 = $('#avg_wom1').val();
							var den_voids1 = $('#den_voids1').val();
							var weight_1 = $('#weight_1').val();
							var weight_2 = $('#weight_2').val();
							var asd_1 = $('#asd_1').val();
							var asd_2 = $('#asd_2').val();
							var den_voids_1 = $('#den_voids_1').val();
							var den_voids = $('#den_voids').val();
							var den_mo_vol1 = $('#den_mo_vol1').val();
							var den_mo_vol2 = $('#den_mo_vol2').val();
							var den_kg_lit = $('#den_kg_lit').val();
							var den_liter = $('#den_liter').val();
							
							break;
					}
					else
					{
						var chk_den = "0";	
						var m11 = "0";
						var m12 = "0";
						var m13 = "0";
						var m21 = "0";
						var m22 = "0";
						var m23 = "0";
						var m31 = "0";
						var m32 = "0";
						var m33 = "0";
						
						var wom2 = "0";
						var wom3 = "0";
						var avg_wom = "0";
						var vol = "0";
						var bdl = "0";
						var den_s_d = "";
						var den_e_d = "";
						
						var avg_wom1 = "";
						var den_voids1 = "";
						var weight_1 = "";
						var weight_2 = "";
						var asd_1 = "";
						var asd_2 = "";
						var den_voids_1 = "";
						var den_voids = "";
						var den_mo_vol1 = "";
						var den_mo_vol2 = "";
						var den_kg_lit = "";
						var den_liter = "";
					}

				}
				
				// FINER
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fne")
					{
							if(document.getElementById('chk_finer').checked) {
									var chk_finer = "1";
							}
							else{
									var chk_finer = "0";
							}
							var finer_a = $('#finer_a').val();
							var finer_b = $('#finer_b').val();
							var avg_finer = $('#avg_finer').val();
							
							var finer_a1 = $('#finer_a1').val();
							var finer_b1 = $('#finer_b1').val();
							var avg_finer1 = $('#avg_finer1').val();
							var avg_fin_1 = $('#avg_fin_1').val();
							var avg_fin_2 = $('#avg_fin_2').val();
							
							break;
					}
					else
					{
						var chk_finer = "0";	
						var finer_a = "0";
						var finer_b = "0";
						var avg_finer = "0";
						
						var finer_a1 = "";
						var finer_b1 = "";
						var avg_finer1 = "";
						var avg_fin_1 = "";
						var avg_fin_2 = "";
					}
				}
				
				
				// fmc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fmc")
					{
							if(document.getElementById('chk_fmc').checked) {
									var chk_fmc = "1";
							}
							else{
									var chk_fmc = "0";
							}
							var fmc_sp = $('#fmc_sp').val();
							var fmc_1 = $('#fmc_1').val();
							var fmc_2 = $('#fmc_2').val();
							var fmc_3 = $('#fmc_3').val();
							var fmc_4 = $('#fmc_4').val();
							var fmc_5 = $('#fmc_5').val();
							var fmc_6 = $('#fmc_6').val();
							var fmc_7 = $('#fmc_7').val();
							break;
					}
					else
					{
						var chk_fmc = "0";	
						var fmc_sp = "0";
						var fmc_1 = "0";
						var fmc_2 = "0";
						var fmc_3 = "0";
						var fmc_4 = "0";
						var fmc_5 = "0";
						var fmc_6 = "0";
						var fmc_7 = "0";
					}
				}
				
				// lbd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lbd")
					{
							if(document.getElementById('chk_lbd').checked) {
									var chk_lbd = "1";
							}
							else{
									var chk_lbd = "0";
							}
							var ans_lbd = $('#ans_lbd').val();
							var lbd_1 = $('#lbd_1').val();
							
							break;
					}
					else
					{
						var chk_lbd = "0";	
						var ans_lbd = "0";
						var lbd_1 = "0";
					}
				}
				
				// ALKALI
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{
						if(document.getElementById('chk_alk').checked) {
								var chk_alk = "1";
						}
						else{
								var chk_alk = "0";
						}
						var alk_a1 = $('#alk_a1').val();
						var alk_a2 = $('#alk_a2').val();
						var alk_a3 = $('#alk_a3').val();
						var alk_a4 = $('#alk_a4').val();
						var alk_a5 = $('#alk_a5').val();
						var alk_b1 = $('#alk_b1').val();
						var alk_b2 = $('#alk_b2').val();
						var alk_b3 = $('#alk_b3').val();
						var alk_b4 = $('#alk_b4').val();
						var alk_b5 = $('#alk_b5').val();
						
						var alk_s_d = $('#alk_s_d').val();
						var alk_e_d = $('#alk_e_d').val();
						
						break;
					}
					else
					{
						var chk_alk = "0";	
						var alk_a1 = "0";
						var alk_a2 = "0";
						var alk_a3 = "0";
						var alk_a4 = "0";
						var alk_a5 = "0";
						var alk_b1 = "0";
						var alk_b2 = "0";
						var alk_b3 = "0";
						var alk_b4 = "0";
						var alk_b5 = "0";
						var alk_s_d = "";
						var alk_e_d = "";
					}
				}
				
				//SP AND WATER ABR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{	
						if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}					
						//specific gravity and water abrasion-5							
						var sp_w_sur_1 = $('#sp_w_sur_1').val();						
						var sp_w_sur_2 = $('#sp_w_sur_2').val();						
						var sp_w_s_1 = $('#sp_w_s_1').val();														
						var sp_w_s_2 = $('#sp_w_s_2').val();				
						var sp_wt_st_1 = $('#sp_wt_st_1').val();				
						var sp_wt_st_2 = $('#sp_wt_st_2').val();				
						var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
						var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
						var sp_specific_gravity = $('#sp_specific_gravity').val();
						var sp_water_abr = $('#sp_water_abr').val(); 
						var sp_water_abr_1 = $('#sp_water_abr_1').val();
						var sp_water_abr_2 = $('#sp_water_abr_2').val();
						var sp_sample_ca = $('#sp_sample_ca').val();
						var sp_temp = $('#sp_temp').val(); 
						
						var sp_bask_water = $('#sp_bask_water').val();
						var sp_wt_bas1 = $('#sp_wt_bas1').val();
						var sp_wt_bas2 = $('#sp_wt_bas2').val();
						var sp_apr1 = $('#sp_apr1').val();
						var sp_apr2 = $('#sp_apr2').val();
						var sp_avg_apr = $('#sp_avg_apr').val();
						var wtr_s_d = $('#wtr_s_d').val();
						var wtr_e_d = $('#wtr_e_d').val();
						
						var sp_specific_gravity_11 = $('#sp_specific_gravity_11').val();
						var sp_specific_gravity_22 = $('#sp_specific_gravity_22').val();
						var sp_specific_gravity1 = $('#sp_specific_gravity1').val();
						
						

						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_w_sur_1 ="0";
						var sp_w_s_1 ="0";
						var sp_wt_st_1 ="0";						
						var sp_w_sur_2 ="0";
						var sp_w_s_2 ="0";
						var sp_wt_st_2 ="0";										
						var sp_specific_gravity_1 ="0";
						var sp_specific_gravity_2 ="0";
						var sp_specific_gravity ="0";
						var sp_water_abr_1 ="0";
						var sp_water_abr_2 ="0";
						var sp_water_abr ="0";
						var sp_sample_ca ="0";
						var sp_temp ="0";
						
						var sp_bask_water = "";
						var sp_wt_bas1 = "";
						var sp_wt_bas2 = "";
						var sp_apr1 = "";
						var sp_apr2 = "";
						var sp_avg_apr = "";
						
						var wtr_s_d = "";
						var wtr_e_d = "";
						
						var sp_specific_gravity_11 = "";
						var sp_specific_gravity_22 = "";
						var sp_specific_gravity1 = "";
						
						
					}
				
				}
				
				//SOUNDNESS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{	
						if(document.getElementById('chk_sou').checked) {
							var chk_sou = "1";
						}
						else{
							var chk_sou = "0";
						}					
												
						var go1 = $('#go1').val();						
						var go2 = $('#go2').val();						
						var go3 = $('#go3').val();						
						var go4 = $('#go4').val();						
						var go5 = $('#go5').val();						
						var go6 = $('#go6').val();						
						var go7 = $('#go7').val();
						var wt1 = $('#wt1').val();						
						var wt2 = $('#wt2').val();						
						var wt3 = $('#wt3').val();						
						var wt4 = $('#wt4').val();						
						var wt5 = $('#wt5').val();						
						var wt6 = $('#wt6').val();						
						var wt7 = $('#wt7').val();
						var pp1 = $('#pp1').val();						
						var pp2 = $('#pp2').val();						
						var pp3 = $('#pp3').val();						
						var pp4 = $('#pp4').val();						
						var pp5 = $('#pp5').val();						
						var pp6 = $('#pp6').val();						
						var pp7 = $('#pp7').val();
						var wa1 = $('#wa1').val();						
						var wa2 = $('#wa2').val();						
						var wa3 = $('#wa3').val();						
						var wa4 = $('#wa4').val();						
						var wa5 = $('#wa5').val();						
						var wa6 = $('#wa6').val();						
						var wa7 = $('#wa7').val();						
						var soundness = $('#soundness').val();
						var wom1 = $('#wom1').val();
						
						var sou_s_d = $('#sou_s_d').val();
						var sou_e_d = $('#sou_e_d').val();
						
						break;
					}
					else
					{
						var wom1 = "0";
						var chk_sou = "0";
						var soundness ="0";
						var go1 ="0";
						var go2 ="0";
						var go3 ="0";
						var go4 ="0";
						var go5 ="0";
						var go6 ="0";
						var go7 ="0";
						var wt1 ="0";
						var wt2 ="0";
						var wt3 ="0";
						var wt4 ="0";
						var wt5 ="0";
						var wt6 ="0";
						var wt7 ="0";
						var pp1 ="0";
						var pp2 ="0";
						var pp3 ="0";
						var pp4 ="0";
						var pp5 ="0";
						var pp6 ="0";
						var pp7 ="0";
						var wa1 ="0";
						var wa2 ="0";
						var wa3 ="0";
						var wa4 ="0";
						var wa5 ="0";
						var wa6 ="0";
						var wa7 ="0";
						var sou_s_d = "";
						var sou_e_d = "";
						
					}
				
				}
				//Ph
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pha")
					{	
						if(document.getElementById('chk_pha').checked) {
							var chk_pha = "1";
						}
						else{
							var chk_pha = "0";
						}					
											
						var ph_s1_1 = $('#ph_s1_1').val();						
						var ph_s1_2 = $('#ph_s1_2').val();
						var ph_s2_1 = $('#ph_s2_1').val();						
						var ph_s2_2 = $('#ph_s2_2').val();						
						var avg_ph = $('#avg_ph').val();
						break;
					}
					else
					{
						var chk_pha = "0";
						var ph_s1_1 = "0";					
						var ph_s1_2 = "0";
						var ph_s2_1 = "0";					
						var ph_s2_2 = "0";					
						var avg_ph = "0";
					}
				}
				
				//CLR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="clr")
					{	
						if(document.getElementById('chk_clr').checked) {
							var chk_clr = "1";
						}
						else{
							var chk_clr = "0";
						}					
											
						var clr_s1_1 = $('#clr_s1_1').val();						
						var clr_s1_2 = $('#clr_s1_2').val();
						var clr_s1_3 = $('#clr_s1_3').val();
						var clr_s1_4 = $('#clr_s1_4').val();
						var clr_s1_5 = $('#clr_s1_5').val();
						var clr_s1_6 = $('#clr_s1_6').val();
						var clr_s1_7 = $('#clr_s1_7').val();
						var clr_s2_1 = $('#clr_s1_1').val();						
						var clr_s2_2 = $('#clr_s1_2').val();
						var clr_s2_3 = $('#clr_s1_3').val();
						var clr_s2_4 = $('#clr_s1_4').val();
						var clr_s2_5 = $('#clr_s1_5').val();
						var clr_s2_6 = $('#clr_s1_6').val();
						var clr_s2_7 = $('#clr_s1_7').val();
						var avg_clr = $('#av_clr').val();
						break;
					}
					else
					{
						var chk_clr = "0";
						var clr_s1_1 = "0";				
						var clr_s1_2 = "0";
						var clr_s1_3 = "0";
						var clr_s1_4 = "0";
						var clr_s1_5 = "0";
						var clr_s1_6 = "0";
						var clr_s1_7 = "0";
						var clr_s2_1 = "0";				
						var clr_s2_2 = "0";
						var clr_s2_3 = "0";
						var clr_s2_4 = "0";
						var clr_s2_5 = "0";
						var clr_s2_6 = "0";
						var clr_s2_7 = "0";
						var avg_clr = "0";
					}
				}
				
				//sil
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sil")
					{	
						if(document.getElementById('chk_slp').checked) {
							var chk_slp = "1";
						}
						else{
							var chk_slp = "0";
						}					
											
						var slp_s1_1 = $('#slp_s1_1').val();						
						var slp_s1_2 = $('#slp_s1_2').val();
						var slp_s1_3 = $('#slp_s1_3').val();
						var slp_s1_4 = $('#slp_s1_4').val();
						var slp_s1_5 = $('#slp_s1_5').val();
						var slp_s2_1 = $('#slp_s1_1').val();						
						var slp_s2_2 = $('#slp_s1_2').val();
						var slp_s2_3 = $('#slp_s1_3').val();
						var slp_s2_4 = $('#slp_s1_4').val();
						var slp_s2_5 = $('#slp_s1_5').val();
						var avg_sul = $('#avg_sul').val();
						break;
					}
					else
					{
						var chk_slp = "0";
						var slp_s1_1 = "0";					
						var slp_s1_2 = "0";
						var slp_s1_3 = "0";
						var slp_s1_4 = "0";
						var slp_s1_5 = "0";
						var slp_s2_1 = "0";					
						var slp_s2_2 = "0";
						var slp_s2_3 = "0";
						var slp_s2_4 = "0";
						var slp_s2_5 = "0";
						var avg_sul = "0";
					}
				}
				
				//DTM
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dtm")
					{	
						if(document.getElementById('chk_dtm').checked) {
							var chk_dtm = "1";
						}
						else{
							var chk_dtm = "0";
						}					
											
						var dele_1_1 = $('#dele_1_1').val();
						var dele_1_2 = $('#dele_1_2').val();
						var dele_1_3 = $('#dele_1_3').val();
						var dele_1_4 = $('#dele_1_4').val();
						var dele_2_1 = $('#dele_2_1').val();
						var dele_2_2 = $('#dele_2_2').val();
						var dele_2_3 = $('#dele_2_3').val();
						var dele_3_1 = $('#dele_3_1').val();
						var dele_3_2 = $('#dele_3_2').val();
						var dele_3_3 = $('#dele_3_3').val();
						var dele_3_4 = $('#dele_3_4').val();
						var dele_4_1 = $('#dele_4_1').val();
						var dele_4_2 = $('#dele_4_2').val();
						var dele_4_3 = $('#dele_4_3').val();
						
						var del_s_d = $('#del_s_d').val();
						var del_e_d = $('#del_e_d').val();
						break;
					}
					else
					{
						var chk_dtm = "0";
						var dele_1_1 = "0";
						var dele_1_2 = "0";
						var dele_1_3 = "0";
						var dele_1_4 = "0";
						var dele_2_1 = "0";
						var dele_2_2 = "0";
						var dele_2_3 = "0";
						var dele_3_1 = "0";
						var dele_3_2 = "0";
						var dele_3_3 = "0";
						var dele_3_4 = "0";
						var dele_4_1 = "0";
						var dele_4_2 = "0";
						var dele_4_3 = "0";
						var del_s_d = "";
						var del_e_d = "";
					}
				}
				
				
				//aoi
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="aoi")
					{	
						if(document.getElementById('chk_aoi').checked) {
							var chk_aoi = "1";
						}
						else{
							var chk_aoi = "0";
						}					
											
						var aoi_1 = $('#aoi_1').val();						
						var aoi_2 = $('#aoi_2').val();
						var aoi_3 = $('#aoi_3').val();						
						var aoi_4 = $('#aoi_4').val();						
						var org_s_d = $('#org_s_d').val();
						var org_e_d = $('#org_e_d').val();
						break;
					}
					else
					{
						var chk_aoi = "0";
						var aoi_1 = "0";					
						var aoi_2 = "0";
						var aoi_3 = "0";					
						var aoi_4 = "0";					
						var org_s_d = "";
						var org_e_d = "";
					}
				}
				
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_grd='+chk_grd+'&sieve_1='+sieve_1+'&sieve_2='+sieve_2+'&sieve_3='+sieve_3+'&sieve_4='+sieve_4+'&sieve_5='+sieve_5+'&sieve_6='+sieve_6+'&sieve_7='+sieve_7+'&sieve_8='+sieve_8+'&cum_wt_gm_1='+cum_wt_gm_1+'&cum_wt_gm_2='+cum_wt_gm_2+'&cum_wt_gm_3='+cum_wt_gm_3+'&cum_wt_gm_4='+cum_wt_gm_4+'&cum_wt_gm_5='+cum_wt_gm_5+'&cum_wt_gm_6='+cum_wt_gm_6+'&cum_wt_gm_7='+cum_wt_gm_7+'&cum_wt_gm_8='+cum_wt_gm_8+'&ret_wt_gm_1='+ret_wt_gm_1+'&ret_wt_gm_2='+ret_wt_gm_2+'&ret_wt_gm_3='+ret_wt_gm_3+'&ret_wt_gm_4='+ret_wt_gm_4+'&ret_wt_gm_5='+ret_wt_gm_5+'&ret_wt_gm_6='+ret_wt_gm_6+'&ret_wt_gm_7='+ret_wt_gm_7+'&ret_wt_gm_8='+ret_wt_gm_8+'&cum_ret_1='+cum_ret_1+'&cum_ret_2='+cum_ret_2+'&cum_ret_3='+cum_ret_3+'&cum_ret_4='+cum_ret_4+'&cum_ret_5='+cum_ret_5+'&cum_ret_6='+cum_ret_6+'&cum_ret_7='+cum_ret_7+'&cum_ret_8='+cum_ret_8+'&pass_sample_1='+pass_sample_1+'&pass_sample_2='+pass_sample_2+'&pass_sample_3='+pass_sample_3+'&pass_sample_4='+pass_sample_4+'&pass_sample_5='+pass_sample_5+'&pass_sample_6='+pass_sample_6+'&pass_sample_7='+pass_sample_7+'&pass_sample_8='+pass_sample_8+'&blank_extra='+blank_extra+'&sample_taken='+sample_taken+'&grd_zone='+grd_zone+'&chk_fm='+chk_fm+'&grd_fm='+grd_fm+'&chk_silt='+chk_silt+'&silt_content='+silt_content+'&sp_temp='+sp_temp+'&silt_1='+silt_1+'&silt_2='+silt_2+'&chk_sp='+chk_sp+'&sp_sample_ca='+sp_sample_ca+'&sp_w_sur_1='+sp_w_sur_1+'&sp_w_sur_2='+sp_w_sur_2+'&sp_w_s_1='+sp_w_s_1+'&sp_w_s_2='+sp_w_s_2+'&sp_wt_st_1='+sp_wt_st_1+'&sp_wt_st_2='+sp_wt_st_2+'&sp_specific_gravity='+sp_specific_gravity+'&sp_specific_gravity_1='+sp_specific_gravity_1+'&sp_specific_gravity_2='+sp_specific_gravity_2+'&sp_water_abr='+sp_water_abr+'&sp_water_abr_1='+sp_water_abr_1+'&sp_water_abr_2='+sp_water_abr_2+'&chk_den='+chk_den+'&m11='+m11+'&m12='+m12+'&m13='+m13+'&m21='+m21+'&m22='+m22+'&m23='+m23+'&wom1='+wom1+'&wom2='+wom2+'&wom3='+wom3+'&avg_wom='+avg_wom+'&vol='+vol+'&bdl='+bdl+'&chk_sou='+chk_sou+'&soundness='+soundness+'&go1='+go1+'&go2='+go2+'&go3='+go3+'&go4='+go4+'&go5='+go5+'&go6='+go6+'&go7='+go7+'&wt1='+wt1+'&wt2='+wt2+'&wt3='+wt3+'&wt4='+wt4+'&wt5='+wt5+'&wt6='+wt6+'&wt7='+wt7+'&pp1='+pp1+'&pp2='+pp2+'&pp3='+pp3+'&pp4='+pp4+'&pp5='+pp5+'&pp6='+pp6+'&pp7='+pp7+'&wa1='+wa1+'&wa2='+wa2+'&wa3='+wa3+'&wa4='+wa4+'&wa5='+wa5+'&wa6='+wa6+'&wa7='+wa7+'&chk_finer='+chk_finer+'&finer_a='+finer_a+'&finer_b='+finer_b+'&avg_finer='+avg_finer+'&ulr='+ulr+'&chk_pha='+chk_pha+'&ph_s1_1='+ph_s1_1+'&ph_s1_2='+ph_s1_2+'&ph_s2_1='+ph_s2_1+'&ph_s2_2='+ph_s2_2+'&avg_ph='+avg_ph+'&chk_clr='+chk_clr+'&clr_s1_1='+clr_s1_1+'&clr_s1_2='+clr_s1_2+'&clr_s1_3='+clr_s1_3+'&clr_s1_4='+clr_s1_4+'&clr_s1_5='+clr_s1_5+'&clr_s1_6='+clr_s1_6+'&clr_s1_7='+clr_s1_7+'&clr_s2_1='+clr_s2_1+'&clr_s2_2='+clr_s2_2+'&clr_s2_3='+clr_s2_3+'&clr_s2_4='+clr_s2_4+'&clr_s2_5='+clr_s2_5+'&clr_s2_6='+clr_s2_6+'&clr_s2_7='+clr_s2_7+'&avg_clr='+avg_clr+'&chk_slp='+chk_slp+'&slp_s1_1='+slp_s1_1+'&slp_s1_2='+slp_s1_2+'&slp_s1_3='+slp_s1_3+'&slp_s1_4='+slp_s1_4+'&slp_s1_5='+slp_s1_5+'&slp_s2_1='+slp_s2_1+'&slp_s2_2='+slp_s2_2+'&slp_s2_3='+slp_s2_3+'&slp_s2_4='+slp_s2_4+'&slp_s2_5='+slp_s2_5+'&avg_sul='+avg_sul+'&chk_dtm='+chk_dtm+'&dele_1_1='+dele_1_1+'&dele_1_2='+dele_1_2+'&dele_1_3='+dele_1_3+'&dele_1_4='+dele_1_4+'&dele_2_1='+dele_2_1+'&dele_2_2='+dele_2_2+'&dele_2_3='+dele_2_3+'&dele_3_1='+dele_3_1+'&dele_3_2='+dele_3_2+'&dele_3_3='+dele_3_3+'&dele_3_4='+dele_3_4+'&dele_4_1='+dele_4_1+'&dele_4_2='+dele_4_2+'&dele_4_3='+dele_4_3+'&chk_aoi='+chk_aoi+'&aoi_1='+aoi_1+'&aoi_2='+aoi_2+'&aoi_3='+aoi_3+'&aoi_4='+aoi_4+'&sp_bask_water='+sp_bask_water+'&sp_wt_bas1='+sp_wt_bas1+'&sp_wt_bas2='+sp_wt_bas2+'&sp_apr1='+sp_apr1+'&sp_apr2='+sp_apr2+'&sp_avg_apr='+sp_avg_apr+'&chk_alk='+chk_alk+'&alk_a1='+alk_a1+'&alk_a2='+alk_a2+'&alk_a3='+alk_a3+'&alk_a4='+alk_a4+'&alk_a5='+alk_a5+'&alk_b1='+alk_b1+'&alk_b2='+alk_b2+'&alk_b3='+alk_b3+'&alk_b4='+alk_b4+'&alk_b5='+alk_b5+'&m31='+m31+'&m32='+m32+'&m33='+m33+'&wtr_s_d='+wtr_s_d+'&wtr_e_d='+wtr_e_d+'&grd_s_d='+grd_s_d+'&grd_e_d='+grd_e_d+'&slt_s_d='+slt_s_d+'&slt_e_d='+slt_e_d+'&alk_s_d='+alk_s_d+'&alk_e_d='+alk_e_d+'&den_s_d='+den_s_d+'&den_e_d='+den_e_d+'&org_s_d='+org_s_d+'&org_e_d='+org_e_d+'&del_s_d='+del_s_d+'&del_e_d='+del_e_d+'&sou_s_d='+sou_s_d+'&sou_e_d='+sou_e_d+'&chk_fmc='+chk_fmc+'&fmc_sp='+fmc_sp+'&fmc_1='+fmc_1+'&fmc_2='+fmc_2+'&fmc_3='+fmc_3+'&fmc_4='+fmc_4+'&fmc_5='+fmc_5+'&fmc_6='+fmc_6+'&fmc_7='+fmc_7+'&chk_lbd='+chk_lbd+'&lbd_1='+lbd_1+'&ans_lbd='+ans_lbd+  '&sp_specific_gravity_11=' + sp_specific_gravity_11 +  '&sp_specific_gravity_22=' + sp_specific_gravity_22 +  '&sp_specific_gravity1=' + sp_specific_gravity1 +  '&avg_wom1=' + avg_wom1 +  '&den_voids1=' + den_voids1 +  '&weight_1=' + weight_1 +  '&weight_2=' + weight_2 +  '&asd_1=' + asd_1 +  '&asd_2=' + asd_2 +  '&finer_a1=' + finer_a1 +  '&finer_b1=' + finer_b1 +  '&avg_finer1=' + avg_finer1 +  '&avg_fin_1=' + avg_fin_1 +  '&avg_fin_2=' + avg_fin_2 +  '&den_voids_1=' + den_voids_1 +  '&den_voids=' + den_voids +  '&den_mo_vol1=' + den_mo_vol1 +  '&den_mo_vol2=' + den_mo_vol2 +  '&den_kg_lit=' + den_kg_lit +  '&den_liter=' + den_liter ;
						
	}
	else if (type == 'edit'){
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//GRADATION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grd")
					{
						if(document.getElementById('chk_grd').checked) {
								var chk_grd = "1";
						}
						else{
								var chk_grd = "0";
						}	
							var chk_fm = "1";
							var grd_fm = $('#grd_fm').val();						
							var sieve_1="10 (mm)";	
							var sieve_2="4.75 (mm)";	
							var sieve_3="2.36 (mm)";	
							var sieve_4="1.18 (mm)";	
							var sieve_5="0.600 (mm)";
							var sieve_6="0.300 (mm)";
							var sieve_7="0.150 (mm)";
							var sieve_8="0.075 (mm)";
						
							var sample_taken = $('#sample_taken').val();
							var blank_extra = $('#blank_extra').val();
							var grd_zone = $('#grd_zone').val();
							var silt_content = $('#silt_content').val();
							var silt_1 = $('#silt_1').val();
							var silt_2 = $('#silt_2').val();
							var chk_silt = "1";
							var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
							var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
							var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
							var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
							var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
							var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
							var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
							var cum_wt_gm_8 = $('#cum_wt_gm_8').val();
															
							var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
							var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
							var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
							var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
							var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
							var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
							var ret_wt_gm_8 = $('#ret_wt_gm_8').val();
							
							var cum_ret_1 = $('#cum_ret_1').val();
							var cum_ret_2 = $('#cum_ret_2').val();
							var cum_ret_3 = $('#cum_ret_3').val();
							var cum_ret_4 = $('#cum_ret_4').val();
							var cum_ret_5 = $('#cum_ret_5').val();
							var cum_ret_6 = $('#cum_ret_6').val();
							var cum_ret_7 = $('#cum_ret_7').val();
							var cum_ret_8 = $('#cum_ret_8').val();
							
							var pass_sample_1 = $('#pass_sample_1').val();
							var pass_sample_2 = $('#pass_sample_2').val();
							var pass_sample_3 = $('#pass_sample_3').val();
							var pass_sample_4 = $('#pass_sample_4').val();
							var pass_sample_5 = $('#pass_sample_5').val();
							var pass_sample_6 = $('#pass_sample_6').val();
							var pass_sample_7 = $('#pass_sample_7').val();
							var pass_sample_8 = $('#pass_sample_8').val();
							
							var grd_s_d = $('#grd_s_d').val();
							var grd_e_d = $('#grd_e_d').val();
							var slt_s_d = $('#slt_s_d').val();
							var slt_e_d = $('#slt_e_d').val();
							
						break;
					}
					else
					{
						var chk_grd = "0";	
						var grd_zone = "0";	
						var chk_fm = "0";
						var grd_fm = "0";
						var silt_1 = "0";
						var silt_2 = "0";
						var cum_wt_gm_1 ="0";
						var cum_wt_gm_2 ="0";
						var cum_wt_gm_3 ="0";
						var cum_wt_gm_4 ="0";
						var cum_wt_gm_5 ="0";
						var cum_wt_gm_6 ="0";
						var cum_wt_gm_7 ="0";
						var cum_wt_gm_8 ="0";
						
						var ret_wt_gm_1 ="0";
						var ret_wt_gm_2 ="0";
						var ret_wt_gm_3 ="0";
						var ret_wt_gm_4 ="0";
						var ret_wt_gm_5 ="0";
						var ret_wt_gm_6 ="0";
						var ret_wt_gm_7 ="0";
						var ret_wt_gm_8 ="0";
						
						
						var cum_ret_1 ="0";
						var cum_ret_2 ="0";
						var cum_ret_3 ="0";
						var cum_ret_4 ="0";
						var cum_ret_5 ="0";
						var cum_ret_6 ="0";
						var cum_ret_7 ="0";
						var cum_ret_8 ="0";
						
						var pass_sample_1 ="0";
						var pass_sample_2 ="0";
						var pass_sample_3 ="0";
						var pass_sample_4 ="0";
						var pass_sample_5 ="0";
						var pass_sample_6 ="0";
						var pass_sample_7 ="0";
						var pass_sample_8 ="0";
						
						 var blank_extra ="0";
						 var sample_taken ="0";
						 var silt_content = "0";
						 var chk_silt = "0";
						 
						 var grd_s_d = "";
						 var grd_e_d = "";
						 var slt_s_d = "";
						 var slt_e_d = "";
					}
														
				}

				
				// bulk density
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="den")
					{
						
							if(document.getElementById('chk_den').checked) {
									var chk_den = "1";
							}
							else{
									var chk_den = "0";
							}
						
							
							var m11 = $('#m11').val();
							var m12 = $('#m12').val();
							var m13 = $('#m13').val();
							var m21 = $('#m21').val();
							var m22 = $('#m22').val();
							var m23 = $('#m23').val();
							var m31 = $('#m31').val();
							var m32 = $('#m32').val();
							var m33 = $('#m33').val();
							
							var wom2 = $('#wom2').val();
							var wom3 = $('#wom3').val();
							var avg_wom = $('#avg_wom').val();
							var vol = $('#vol').val();
							var bdl = $('#bdl').val();
							
							var den_s_d = $('#den_s_d').val();
							var den_e_d = $('#den_e_d').val();
							
							var avg_wom1 = $('#avg_wom1').val();
							var den_voids1 = $('#den_voids1').val();
							var weight_1 = $('#weight_1').val();
							var weight_2 = $('#weight_2').val();
							var asd_1 = $('#asd_1').val();
							var asd_2 = $('#asd_2').val();
							var den_voids_1 = $('#den_voids_1').val();
							var den_voids = $('#den_voids').val();
							var den_mo_vol1 = $('#den_mo_vol1').val();
							var den_mo_vol2 = $('#den_mo_vol2').val();
							var den_kg_lit = $('#den_kg_lit').val();
							var den_liter = $('#den_liter').val();
							
							break;
					}
					else
					{
						var chk_den = "0";	
						var m11 = "0";
						var m12 = "0";
						var m13 = "0";
						var m21 = "0";
						var m22 = "0";
						var m23 = "0";
						var m31 = "0";
						var m32 = "0";
						var m33 = "0";
						
						var wom2 = "0";
						var wom3 = "0";
						var avg_wom = "0";
						var vol = "0";
						var bdl = "0";
						var den_s_d = "";
						var den_e_d = "";
						
						var avg_wom1 = "";
						var den_voids1 = "";
						var weight_1 = "";
						var weight_2 = "";
						var asd_1 = "";
						var asd_2 = "";
						var den_voids_1 = "";
						var den_voids = "";
						var den_mo_vol1 = "";
						var den_mo_vol2 = "";
						var den_kg_lit = "";
						var den_liter = "";
					}

				}
				
				// FINER
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fne")
					{
							if(document.getElementById('chk_finer').checked) {
									var chk_finer = "1";
							}
							else{
									var chk_finer = "0";
							}
							var finer_a = $('#finer_a').val();
							var finer_b = $('#finer_b').val();
							var avg_finer = $('#avg_finer').val();
							
							var finer_a1 = $('#finer_a1').val();
							var finer_b1 = $('#finer_b1').val();
							var avg_finer1 = $('#avg_finer1').val();
							var avg_fin_1 = $('#avg_fin_1').val();
							var avg_fin_2 = $('#avg_fin_2').val();
							
							break;
					}
					else
					{
						var chk_finer = "0";	
						var finer_a = "0";
						var finer_b = "0";
						var avg_finer = "0";
						
						var finer_a1 = "";
						var finer_b1 = "";
						var avg_finer1 = "";
						var avg_fin_1 = "";
						var avg_fin_2 = "";
						
					}
				}
				
				
				// fmc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fmc")
					{
							if(document.getElementById('chk_fmc').checked) {
									var chk_fmc = "1";
							}
							else{
									var chk_fmc = "0";
							}
							var fmc_sp = $('#fmc_sp').val();
							var fmc_1 = $('#fmc_1').val();
							var fmc_2 = $('#fmc_2').val();
							var fmc_3 = $('#fmc_3').val();
							var fmc_4 = $('#fmc_4').val();
							var fmc_5 = $('#fmc_5').val();
							var fmc_6 = $('#fmc_6').val();
							var fmc_7 = $('#fmc_7').val();
							break;
					}
					else
					{
						var chk_fmc = "0";	
						var fmc_sp = "0";
						var fmc_1 = "0";
						var fmc_2 = "0";
						var fmc_3 = "0";
						var fmc_4 = "0";
						var fmc_5 = "0";
						var fmc_6 = "0";
						var fmc_7 = "0";
					}
				}
				
				// lbd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lbd")
					{
							if(document.getElementById('chk_lbd').checked) {
									var chk_lbd = "1";
							}
							else{
									var chk_lbd = "0";
							}
							var ans_lbd = $('#ans_lbd').val();
							var lbd_1 = $('#lbd_1').val();
							
							break;
					}
					else
					{
						var chk_lbd = "0";	
						var ans_lbd = "0";
						var lbd_1 = "0";
					}
				}
				
				// ALKALI
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{
						if(document.getElementById('chk_alk').checked) {
								var chk_alk = "1";
						}
						else{
								var chk_alk = "0";
						}
						var alk_a1 = $('#alk_a1').val();
						var alk_a2 = $('#alk_a2').val();
						var alk_a3 = $('#alk_a3').val();
						var alk_a4 = $('#alk_a4').val();
						var alk_a5 = $('#alk_a5').val();
						var alk_b1 = $('#alk_b1').val();
						var alk_b2 = $('#alk_b2').val();
						var alk_b3 = $('#alk_b3').val();
						var alk_b4 = $('#alk_b4').val();
						var alk_b5 = $('#alk_b5').val();
						
						var alk_s_d = $('#alk_s_d').val();
						var alk_e_d = $('#alk_e_d').val();
						
						break;
					}
					else
					{
						var chk_alk = "0";	
						var alk_a1 = "0";
						var alk_a2 = "0";
						var alk_a3 = "0";
						var alk_a4 = "0";
						var alk_a5 = "0";
						var alk_b1 = "0";
						var alk_b2 = "0";
						var alk_b3 = "0";
						var alk_b4 = "0";
						var alk_b5 = "0";
						var alk_s_d = "";
						var alk_e_d = "";
					}
				}
				
				//SP AND WATER ABR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{	
						if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}					
						//specific gravity and water abrasion-5							
						var sp_w_sur_1 = $('#sp_w_sur_1').val();						
						var sp_w_sur_2 = $('#sp_w_sur_2').val();						
						var sp_w_s_1 = $('#sp_w_s_1').val();														
						var sp_w_s_2 = $('#sp_w_s_2').val();				
						var sp_wt_st_1 = $('#sp_wt_st_1').val();				
						var sp_wt_st_2 = $('#sp_wt_st_2').val();				
						var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
						var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
						var sp_specific_gravity = $('#sp_specific_gravity').val();
						var sp_water_abr = $('#sp_water_abr').val(); 
						var sp_water_abr_1 = $('#sp_water_abr_1').val();
						var sp_water_abr_2 = $('#sp_water_abr_2').val();
						var sp_sample_ca = $('#sp_sample_ca').val();
						var sp_temp = $('#sp_temp').val(); 
						
						var sp_bask_water = $('#sp_bask_water').val();
						var sp_wt_bas1 = $('#sp_wt_bas1').val();
						var sp_wt_bas2 = $('#sp_wt_bas2').val();
						var sp_apr1 = $('#sp_apr1').val();
						var sp_apr2 = $('#sp_apr2').val();
						var sp_avg_apr = $('#sp_avg_apr').val();
						var wtr_s_d = $('#wtr_s_d').val();
						var wtr_e_d = $('#wtr_e_d').val();
						
						var sp_specific_gravity_11 = $('#sp_specific_gravity_11').val();
						var sp_specific_gravity_22 = $('#sp_specific_gravity_22').val();
						var sp_specific_gravity1 = $('#sp_specific_gravity1').val();
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_w_sur_1 ="0";
						var sp_w_s_1 ="0";
						var sp_wt_st_1 ="0";						
						var sp_w_sur_2 ="0";
						var sp_w_s_2 ="0";
						var sp_wt_st_2 ="0";										
						var sp_specific_gravity_1 ="0";
						var sp_specific_gravity_2 ="0";
						var sp_specific_gravity ="0";
						var sp_water_abr_1 ="0";
						var sp_water_abr_2 ="0";
						var sp_water_abr ="0";
						var sp_sample_ca ="0";
						var sp_temp ="0";
						
						var sp_bask_water = "";
						var sp_wt_bas1 = "";
						var sp_wt_bas2 = "";
						var sp_apr1 = "";
						var sp_apr2 = "";
						var sp_avg_apr = "";
						
						var wtr_s_d = "";
						var wtr_e_d = "";
						
						var sp_specific_gravity_11 = "";
						var sp_specific_gravity_22 = "";
						var sp_specific_gravity1 = "";
					}
				
				}
				
				//SOUNDNESS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{	
						if(document.getElementById('chk_sou').checked) {
							var chk_sou = "1";
						}
						else{
							var chk_sou = "0";
						}					
												
						var go1 = $('#go1').val();						
						var go2 = $('#go2').val();						
						var go3 = $('#go3').val();						
						var go4 = $('#go4').val();						
						var go5 = $('#go5').val();						
						var go6 = $('#go6').val();						
						var go7 = $('#go7').val();
						var wt1 = $('#wt1').val();						
						var wt2 = $('#wt2').val();						
						var wt3 = $('#wt3').val();						
						var wt4 = $('#wt4').val();						
						var wt5 = $('#wt5').val();						
						var wt6 = $('#wt6').val();						
						var wt7 = $('#wt7').val();
						var pp1 = $('#pp1').val();						
						var pp2 = $('#pp2').val();						
						var pp3 = $('#pp3').val();						
						var pp4 = $('#pp4').val();						
						var pp5 = $('#pp5').val();						
						var pp6 = $('#pp6').val();						
						var pp7 = $('#pp7').val();
						var wa1 = $('#wa1').val();						
						var wa2 = $('#wa2').val();						
						var wa3 = $('#wa3').val();						
						var wa4 = $('#wa4').val();						
						var wa5 = $('#wa5').val();						
						var wa6 = $('#wa6').val();						
						var wa7 = $('#wa7').val();						
						var soundness = $('#soundness').val();
						var wom1 = $('#wom1').val();
						
						var sou_s_d = $('#sou_s_d').val();
						var sou_e_d = $('#sou_e_d').val();
						
						break;
					}
					else
					{
						var wom1 = "0";
						var chk_sou = "0";
						var soundness ="0";
						var go1 ="0";
						var go2 ="0";
						var go3 ="0";
						var go4 ="0";
						var go5 ="0";
						var go6 ="0";
						var go7 ="0";
						var wt1 ="0";
						var wt2 ="0";
						var wt3 ="0";
						var wt4 ="0";
						var wt5 ="0";
						var wt6 ="0";
						var wt7 ="0";
						var pp1 ="0";
						var pp2 ="0";
						var pp3 ="0";
						var pp4 ="0";
						var pp5 ="0";
						var pp6 ="0";
						var pp7 ="0";
						var wa1 ="0";
						var wa2 ="0";
						var wa3 ="0";
						var wa4 ="0";
						var wa5 ="0";
						var wa6 ="0";
						var wa7 ="0";
						var sou_s_d = "";
						var sou_e_d = "";
						
					}
				
				}
				//Ph
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pha")
					{	
						if(document.getElementById('chk_pha').checked) {
							var chk_pha = "1";
						}
						else{
							var chk_pha = "0";
						}					
											
						var ph_s1_1 = $('#ph_s1_1').val();						
						var ph_s1_2 = $('#ph_s1_2').val();
						var ph_s2_1 = $('#ph_s2_1').val();						
						var ph_s2_2 = $('#ph_s2_2').val();						
						var avg_ph = $('#avg_ph').val();
						break;
					}
					else
					{
						var chk_pha = "0";
						var ph_s1_1 = "0";					
						var ph_s1_2 = "0";
						var ph_s2_1 = "0";					
						var ph_s2_2 = "0";					
						var avg_ph = "0";
					}
				}
				
				//CLR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="clr")
					{	
						if(document.getElementById('chk_clr').checked) {
							var chk_clr = "1";
						}
						else{
							var chk_clr = "0";
						}					
											
						var clr_s1_1 = $('#clr_s1_1').val();						
						var clr_s1_2 = $('#clr_s1_2').val();
						var clr_s1_3 = $('#clr_s1_3').val();
						var clr_s1_4 = $('#clr_s1_4').val();
						var clr_s1_5 = $('#clr_s1_5').val();
						var clr_s1_6 = $('#clr_s1_6').val();
						var clr_s1_7 = $('#clr_s1_7').val();
						var clr_s2_1 = $('#clr_s1_1').val();						
						var clr_s2_2 = $('#clr_s1_2').val();
						var clr_s2_3 = $('#clr_s1_3').val();
						var clr_s2_4 = $('#clr_s1_4').val();
						var clr_s2_5 = $('#clr_s1_5').val();
						var clr_s2_6 = $('#clr_s1_6').val();
						var clr_s2_7 = $('#clr_s1_7').val();
						var avg_clr = $('#av_clr').val();
						break;
					}
					else
					{
						var chk_clr = "0";
						var clr_s1_1 = "0";				
						var clr_s1_2 = "0";
						var clr_s1_3 = "0";
						var clr_s1_4 = "0";
						var clr_s1_5 = "0";
						var clr_s1_6 = "0";
						var clr_s1_7 = "0";
						var clr_s2_1 = "0";				
						var clr_s2_2 = "0";
						var clr_s2_3 = "0";
						var clr_s2_4 = "0";
						var clr_s2_5 = "0";
						var clr_s2_6 = "0";
						var clr_s2_7 = "0";
						var avg_clr = "0";
					}
				}
				
				//sil
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sil")
					{	
						if(document.getElementById('chk_slp').checked) {
							var chk_slp = "1";
						}
						else{
							var chk_slp = "0";
						}					
											
						var slp_s1_1 = $('#slp_s1_1').val();						
						var slp_s1_2 = $('#slp_s1_2').val();
						var slp_s1_3 = $('#slp_s1_3').val();
						var slp_s1_4 = $('#slp_s1_4').val();
						var slp_s1_5 = $('#slp_s1_5').val();
						var slp_s2_1 = $('#slp_s1_1').val();						
						var slp_s2_2 = $('#slp_s1_2').val();
						var slp_s2_3 = $('#slp_s1_3').val();
						var slp_s2_4 = $('#slp_s1_4').val();
						var slp_s2_5 = $('#slp_s1_5').val();
						var avg_sul = $('#avg_sul').val();
						break;
					}
					else
					{
						var chk_slp = "0";
						var slp_s1_1 = "0";					
						var slp_s1_2 = "0";
						var slp_s1_3 = "0";
						var slp_s1_4 = "0";
						var slp_s1_5 = "0";
						var slp_s2_1 = "0";					
						var slp_s2_2 = "0";
						var slp_s2_3 = "0";
						var slp_s2_4 = "0";
						var slp_s2_5 = "0";
						var avg_sul = "0";
					}
				}
				
				//DTM
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dtm")
					{	
						if(document.getElementById('chk_dtm').checked) {
							var chk_dtm = "1";
						}
						else{
							var chk_dtm = "0";
						}					
											
						var dele_1_1 = $('#dele_1_1').val();
						var dele_1_2 = $('#dele_1_2').val();
						var dele_1_3 = $('#dele_1_3').val();
						var dele_1_4 = $('#dele_1_4').val();
						var dele_2_1 = $('#dele_2_1').val();
						var dele_2_2 = $('#dele_2_2').val();
						var dele_2_3 = $('#dele_2_3').val();
						var dele_3_1 = $('#dele_3_1').val();
						var dele_3_2 = $('#dele_3_2').val();
						var dele_3_3 = $('#dele_3_3').val();
						var dele_3_4 = $('#dele_3_4').val();
						var dele_4_1 = $('#dele_4_1').val();
						var dele_4_2 = $('#dele_4_2').val();
						var dele_4_3 = $('#dele_4_3').val();
						
						var del_s_d = $('#del_s_d').val();
						var del_e_d = $('#del_e_d').val();
						break;
					}
					else
					{
						var chk_dtm = "0";
						var dele_1_1 = "0";
						var dele_1_2 = "0";
						var dele_1_3 = "0";
						var dele_1_4 = "0";
						var dele_2_1 = "0";
						var dele_2_2 = "0";
						var dele_2_3 = "0";
						var dele_3_1 = "0";
						var dele_3_2 = "0";
						var dele_3_3 = "0";
						var dele_3_4 = "0";
						var dele_4_1 = "0";
						var dele_4_2 = "0";
						var dele_4_3 = "0";
						var del_s_d = "";
						var del_e_d = "";
					}
				}
				
				
				//aoi
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="aoi")
					{	
						if(document.getElementById('chk_aoi').checked) {
							var chk_aoi = "1";
						}
						else{
							var chk_aoi = "0";
						}					
											
						var aoi_1 = $('#aoi_1').val();						
						var aoi_2 = $('#aoi_2').val();
						var aoi_3 = $('#aoi_3').val();						
						var aoi_4 = $('#aoi_4').val();						
						var org_s_d = $('#org_s_d').val();
						var org_e_d = $('#org_e_d').val();
						break;
					}
					else
					{
						var chk_aoi = "0";
						var aoi_1 = "0";					
						var aoi_2 = "0";
						var aoi_3 = "0";					
						var aoi_4 = "0";					
						var org_s_d = "";
						var org_e_d = "";
					}
				}
				
				var idEdit = $('#idEdit').val();
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_grd='+chk_grd+'&sieve_1='+sieve_1+'&sieve_2='+sieve_2+'&sieve_3='+sieve_3+'&sieve_4='+sieve_4+'&sieve_5='+sieve_5+'&sieve_6='+sieve_6+'&sieve_7='+sieve_7+'&sieve_8='+sieve_8+'&cum_wt_gm_1='+cum_wt_gm_1+'&cum_wt_gm_2='+cum_wt_gm_2+'&cum_wt_gm_3='+cum_wt_gm_3+'&cum_wt_gm_4='+cum_wt_gm_4+'&cum_wt_gm_5='+cum_wt_gm_5+'&cum_wt_gm_6='+cum_wt_gm_6+'&cum_wt_gm_7='+cum_wt_gm_7+'&cum_wt_gm_8='+cum_wt_gm_8+'&ret_wt_gm_1='+ret_wt_gm_1+'&ret_wt_gm_2='+ret_wt_gm_2+'&ret_wt_gm_3='+ret_wt_gm_3+'&ret_wt_gm_4='+ret_wt_gm_4+'&ret_wt_gm_5='+ret_wt_gm_5+'&ret_wt_gm_6='+ret_wt_gm_6+'&ret_wt_gm_7='+ret_wt_gm_7+'&ret_wt_gm_8='+ret_wt_gm_8+'&cum_ret_1='+cum_ret_1+'&cum_ret_2='+cum_ret_2+'&cum_ret_3='+cum_ret_3+'&cum_ret_4='+cum_ret_4+'&cum_ret_5='+cum_ret_5+'&cum_ret_6='+cum_ret_6+'&cum_ret_7='+cum_ret_7+'&cum_ret_8='+cum_ret_8+'&pass_sample_1='+pass_sample_1+'&pass_sample_2='+pass_sample_2+'&pass_sample_3='+pass_sample_3+'&pass_sample_4='+pass_sample_4+'&pass_sample_5='+pass_sample_5+'&pass_sample_6='+pass_sample_6+'&pass_sample_7='+pass_sample_7+'&pass_sample_8='+pass_sample_8+'&blank_extra='+blank_extra+'&sample_taken='+sample_taken+'&grd_zone='+grd_zone+'&chk_fm='+chk_fm+'&grd_fm='+grd_fm+'&chk_silt='+chk_silt+'&silt_content='+silt_content+'&sp_temp='+sp_temp+'&silt_1='+silt_1+'&silt_2='+silt_2+'&chk_sp='+chk_sp+'&sp_sample_ca='+sp_sample_ca+'&sp_w_sur_1='+sp_w_sur_1+'&sp_w_sur_2='+sp_w_sur_2+'&sp_w_s_1='+sp_w_s_1+'&sp_w_s_2='+sp_w_s_2+'&sp_wt_st_1='+sp_wt_st_1+'&sp_wt_st_2='+sp_wt_st_2+'&sp_specific_gravity='+sp_specific_gravity+'&sp_specific_gravity_1='+sp_specific_gravity_1+'&sp_specific_gravity_2='+sp_specific_gravity_2+'&sp_water_abr='+sp_water_abr+'&sp_water_abr_1='+sp_water_abr_1+'&sp_water_abr_2='+sp_water_abr_2+'&chk_den='+chk_den+'&m11='+m11+'&m12='+m12+'&m13='+m13+'&m21='+m21+'&m22='+m22+'&m23='+m23+'&wom1='+wom1+'&wom2='+wom2+'&wom3='+wom3+'&avg_wom='+avg_wom+'&vol='+vol+'&bdl='+bdl+'&chk_sou='+chk_sou+'&soundness='+soundness+'&go1='+go1+'&go2='+go2+'&go3='+go3+'&go4='+go4+'&go5='+go5+'&go6='+go6+'&go7='+go7+'&wt1='+wt1+'&wt2='+wt2+'&wt3='+wt3+'&wt4='+wt4+'&wt5='+wt5+'&wt6='+wt6+'&wt7='+wt7+'&pp1='+pp1+'&pp2='+pp2+'&pp3='+pp3+'&pp4='+pp4+'&pp5='+pp5+'&pp6='+pp6+'&pp7='+pp7+'&wa1='+wa1+'&wa2='+wa2+'&wa3='+wa3+'&wa4='+wa4+'&wa5='+wa5+'&wa6='+wa6+'&wa7='+wa7+'&chk_finer='+chk_finer+'&finer_a='+finer_a+'&finer_b='+finer_b+'&avg_finer='+avg_finer+'&ulr='+ulr+'&chk_pha='+chk_pha+'&ph_s1_1='+ph_s1_1+'&ph_s1_2='+ph_s1_2+'&ph_s2_1='+ph_s2_1+'&ph_s2_2='+ph_s2_2+'&avg_ph='+avg_ph+'&chk_clr='+chk_clr+'&clr_s1_1='+clr_s1_1+'&clr_s1_2='+clr_s1_2+'&clr_s1_3='+clr_s1_3+'&clr_s1_4='+clr_s1_4+'&clr_s1_5='+clr_s1_5+'&clr_s1_6='+clr_s1_6+'&clr_s1_7='+clr_s1_7+'&clr_s2_1='+clr_s2_1+'&clr_s2_2='+clr_s2_2+'&clr_s2_3='+clr_s2_3+'&clr_s2_4='+clr_s2_4+'&clr_s2_5='+clr_s2_5+'&clr_s2_6='+clr_s2_6+'&clr_s2_7='+clr_s2_7+'&avg_clr='+avg_clr+'&chk_slp='+chk_slp+'&slp_s1_1='+slp_s1_1+'&slp_s1_2='+slp_s1_2+'&slp_s1_3='+slp_s1_3+'&slp_s1_4='+slp_s1_4+'&slp_s1_5='+slp_s1_5+'&slp_s2_1='+slp_s2_1+'&slp_s2_2='+slp_s2_2+'&slp_s2_3='+slp_s2_3+'&slp_s2_4='+slp_s2_4+'&slp_s2_5='+slp_s2_5+'&avg_sul='+avg_sul+'&chk_dtm='+chk_dtm+'&dele_1_1='+dele_1_1+'&dele_1_2='+dele_1_2+'&dele_1_3='+dele_1_3+'&dele_1_4='+dele_1_4+'&dele_2_1='+dele_2_1+'&dele_2_2='+dele_2_2+'&dele_2_3='+dele_2_3+'&dele_3_1='+dele_3_1+'&dele_3_2='+dele_3_2+'&dele_3_3='+dele_3_3+'&dele_3_4='+dele_3_4+'&dele_4_1='+dele_4_1+'&dele_4_2='+dele_4_2+'&dele_4_3='+dele_4_3+'&chk_aoi='+chk_aoi+'&aoi_1='+aoi_1+'&aoi_2='+aoi_2+'&aoi_3='+aoi_3+'&aoi_4='+aoi_4+'&sp_bask_water='+sp_bask_water+'&sp_wt_bas1='+sp_wt_bas1+'&sp_wt_bas2='+sp_wt_bas2+'&sp_apr1='+sp_apr1+'&sp_apr2='+sp_apr2+'&sp_avg_apr='+sp_avg_apr+'&chk_alk='+chk_alk+'&alk_a1='+alk_a1+'&alk_a2='+alk_a2+'&alk_a3='+alk_a3+'&alk_a4='+alk_a4+'&alk_a5='+alk_a5+'&alk_b1='+alk_b1+'&alk_b2='+alk_b2+'&alk_b3='+alk_b3+'&alk_b4='+alk_b4+'&alk_b5='+alk_b5+'&m31='+m31+'&m32='+m32+'&m33='+m33+'&wtr_s_d='+wtr_s_d+'&wtr_e_d='+wtr_e_d+'&grd_s_d='+grd_s_d+'&grd_e_d='+grd_e_d+'&slt_s_d='+slt_s_d+'&slt_e_d='+slt_e_d+'&alk_s_d='+alk_s_d+'&alk_e_d='+alk_e_d+'&den_s_d='+den_s_d+'&den_e_d='+den_e_d+'&org_s_d='+org_s_d+'&org_e_d='+org_e_d+'&del_s_d='+del_s_d+'&del_e_d='+del_e_d+'&sou_s_d='+sou_s_d+'&sou_e_d='+sou_e_d+'&chk_fmc='+chk_fmc+'&fmc_sp='+fmc_sp+'&fmc_1='+fmc_1+'&fmc_2='+fmc_2+'&fmc_3='+fmc_3+'&fmc_4='+fmc_4+'&fmc_5='+fmc_5+'&fmc_6='+fmc_6+'&fmc_7='+fmc_7+'&chk_lbd='+chk_lbd+'&lbd_1='+lbd_1+'&ans_lbd='+ans_lbd+  '&sp_specific_gravity_11=' + sp_specific_gravity_11 +  '&sp_specific_gravity_22=' + sp_specific_gravity_22 +  '&sp_specific_gravity1=' + sp_specific_gravity1 +  '&avg_wom1=' + avg_wom1 +  '&den_voids1=' + den_voids1 +  '&weight_1=' + weight_1 +  '&weight_2=' + weight_2 +  '&asd_1=' + asd_1 +  '&asd_2=' + asd_2 +  '&finer_a1=' + finer_a1 +  '&finer_b1=' + finer_b1 +  '&avg_finer1=' + avg_finer1 +  '&avg_fin_1=' + avg_fin_1 +  '&avg_fin_2=' + avg_fin_2+  '&den_voids_1=' + den_voids_1+  '&den_voids=' + den_voids +  '&den_mo_vol1=' + den_mo_vol1 +  '&den_mo_vol2=' + den_mo_vol2 +  '&den_kg_lit=' + den_kg_lit +  '&den_liter=' + den_liter;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_sand.php',
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
        url: '<?php echo $base_url; ?>save_sand.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			
            var temp = $('#test_list').val();
				var aa= temp.split(",");	

				//PH
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pha")
					{	var chk_pha = data.chk_pha;
							if(chk_pha=="1")
							{
								$('#txtpha').css("background-color","var(--success)");	
							   $("#chk_pha").prop("checked", true); 
							}else{
								$('#txtpha').css("background-color","white");	
								$("#chk_pha").prop("checked", false); 
							}
						$('#ph_s1_1').val(data.ph_s1_1);
						$('#ph_s1_2').val(data.ph_s1_2);
						$('#ph_s2_1').val(data.ph_s2_1);
						$('#ph_s2_2').val(data.ph_s2_2);
						$('#avg_ph').val(data.avg_ph);
						break;
					}
					else
					{
						
					}
				}
				
				//fmc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fmc")
					{	var chk_fmc = data.chk_fmc;
							if(chk_fmc=="1")
							{
								$('#txtfmc').css("background-color","var(--success)");	
							   $("#chk_fmc").prop("checked", true); 
							}else{
								$('#txtfmc').css("background-color","white");	
								$("#chk_fmc").prop("checked", false); 
							}
						$('#fmc_sp').val(data.fmc_sp);
						$('#fmc_1').val(data.fmc_1);
						$('#fmc_2').val(data.fmc_2);
						$('#fmc_3').val(data.fmc_3);
						$('#fmc_4').val(data.fmc_4);
						$('#fmc_5').val(data.fmc_5);
						$('#fmc_6').val(data.fmc_6);
						$('#fmc_7').val(data.fmc_7);
						
						break;
					}
					else
					{
						
					}
				}
				
				
				//lbd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lbd")
					{	var chk_lbd = data.chk_lbd;
							if(chk_lbd=="1")
							{
								$('#txtlbd').css("background-color","var(--success)");	
							   $("#chk_lbd").prop("checked", true); 
							}else{
								$('#txtlbd').css("background-color","white");	
								$("#chk_lbd").prop("checked", false); 
							}
						$('#lbd_1').val(data.lbd_1);
						$('#ans_lbd').val(data.ans_lbd);
						
						
						break;
					}
					else
					{
						
					}
				}
				
				
				//aoi
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="aoi")
					{	var chk_aoi = data.chk_aoi;
							if(chk_aoi=="1")
							{
								$('#txtaoi').css("background-color","var(--success)");	
							   $("#chk_aoi").prop("checked", true); 
							}else{
								$('#txtaoi').css("background-color","white");	
								$("#chk_aoi").prop("checked", false); 
							}
						$('#aoi_1').val(data.soi_1);
						$('#aoi_2').val(data.soi_2);
						$('#aoi_3').val(data.soi_3);
						$('#aoi_4').val(data.soi_4);
						$('#org_s_d').val(data.org_s_d);
						$('#org_e_d').val(data.org_e_d);
						break;
					}
					else
					{
						
					}
				}
				//alk
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{	var chk_alk = data.chk_alk;
							if(chk_alk=="1")
							{
								$('#txtalk').css("background-color","var(--success)");	
							   $("#chk_alk").prop("checked", true); 
							}else{
								$('#txtalk').css("background-color","white");	
								$("#chk_alk").prop("checked", false); 
							}
						$('#alk_a1').val(data.alk_a1);
						$('#alk_a2').val(data.alk_a2);
						$('#alk_a3').val(data.alk_a3);
						$('#alk_a4').val(data.alk_a4);
						$('#alk_a5').val(data.alk_a5);
						$('#alk_b1').val(data.alk_b1);
						$('#alk_b2').val(data.alk_b2);
						$('#alk_b3').val(data.alk_b3);
						$('#alk_b4').val(data.alk_b4);
						$('#alk_b5').val(data.alk_b5);
						$('#alk_s_d').val(data.alk_s_d);
						$('#alk_e_d').val(data.alk_e_d);
						break;
					}
					else
					{
						
					}
				}
				
				//clr
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="clr")
					{	var chk_clr = data.chk_clr;
							if(chk_clr=="1")
							{
								$('#txtclr').css("background-color","var(--success)");	
							   $("#chk_clr").prop("checked", true); 
							}else{
								$('#txtclr').css("background-color","white");	
								$("#chk_clr").prop("checked", false); 
							}
							$('#clr_s1_1').val(data.clr_s1_1);
							$('#clr_s1_2').val(data.clr_s1_2);
							$('#clr_s1_3').val(data.clr_s1_3);
							$('#clr_s1_4').val(data.clr_s1_4);
							$('#clr_s1_5').val(data.clr_s1_5);
							$('#clr_s1_6').val(data.clr_s1_6);
							$('#clr_s1_7').val(data.clr_s1_7);
							$('#clr_s2_1').val(data.clr_s2_1);
							$('#clr_s2_2').val(data.clr_s2_2);
							$('#clr_s2_3').val(data.clr_s2_3);
							$('#clr_s2_4').val(data.clr_s2_4);
							$('#clr_s2_5').val(data.clr_s2_5);
							$('#clr_s2_6').val(data.clr_s2_6);
							$('#clr_s2_7').val(data.clr_s2_7);
							$('#av_clr').val(data.avg_clr);
						break;
					}
					else
					{
						
					}
				}
				
				//spl
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sil")
					{	var chk_slp = data.chk_slp;
							if(chk_slp=="1")
							{
								$('#txtslp').css("background-color","var(--success)");	
							   $("#chk_slp").prop("checked", true); 
							}else{
								$('#txtslp').css("background-color","white");	
								$("#chk_slp").prop("checked", false); 
							}
						$('#slp_s1_1').val(data.slp_s1_1);
						$('#slp_s1_2').val(data.slp_s1_2);
						$('#slp_s1_3').val(data.slp_s1_3);
						$('#slp_s1_4').val(data.slp_s1_4);
						$('#slp_s1_5').val(data.slp_s1_5);
						$('#slp_s2_1').val(data.slp_s2_1);
						$('#slp_s2_2').val(data.slp_s2_2);
						$('#slp_s2_3').val(data.slp_s2_3);
						$('#slp_s2_4').val(data.slp_s2_4);
						$('#slp_s2_5').val(data.slp_s2_5);
						$('#avg_sul').val(data.avg_sul);
						break;
					}
					else
					{
						
					}
				}
				
				//DTM
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dtm")
					{	var chk_dtm = data.chk_dtm;
							if(chk_dtm=="1")
							{
								$('#txtdtm').css("background-color","var(--success)");	
							   $("#chk_dtm").prop("checked", true); 
							}else{
								$('#txtdtm').css("background-color","white");	
							   $("#chk_dtm").prop("checked", false); 
							}
						$('#dele_1_1').val(data.dele_1_1);
						$('#dele_1_2').val(data.dele_1_2);
						$('#dele_1_3').val(data.dele_1_3);
						$('#dele_1_4').val(data.dele_1_4);
						$('#dele_2_1').val(data.dele_2_1);
						$('#dele_2_2').val(data.dele_2_2);
						$('#dele_2_3').val(data.dele_2_3);
						$('#dele_3_1').val(data.dele_3_1);
						$('#dele_3_2').val(data.dele_3_2);
						$('#dele_3_3').val(data.dele_3_3);
						$('#dele_3_4').val(data.dele_3_4);
						$('#dele_4_1').val(data.dele_4_1);
						$('#dele_4_2').val(data.dele_4_2);
						$('#dele_4_3').val(data.dele_4_3);
						$('#del_s_d').val(data.del_s_d);
						$('#del_e_d').val(data.del_e_d);
						
						break;
					}
					else
					{
						
					}
				}
				
				
				//GRADATION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grd")
					{
						
						var chk_grd = data.chk_grd;
						if(chk_grd=="1")
						{
							$('#txtgrd').css("background-color","var(--success)");	
						   $("#chk_grd").prop("checked", true); 
						   $("#chk_fm").prop("checked", true); 
						   $("#chk_silt").prop("checked", true); 
						}else{
							$('#txtgrd').css("background-color","white");	
							$("#chk_grd").prop("checked", false);
							$("#chk_fm").prop("checked", false); 
						   $("#chk_silt").prop("checked", false); 
						}
								//GRADATION DATA FETCH-1
						$('#sample_taken').val(data.sample_taken);
						$('#grd_fm').val(data.grd_fm);
						$('#silt_content').val(data.silt_content);
						$('#silt_2').val(data.silt_2);
						$('#silt_1').val(data.silt_1);
						
						$('#cum_wt_gm_1').val(data.cum_wt_gm_1);
						$('#cum_wt_gm_2').val(data.cum_wt_gm_2);
						$('#cum_wt_gm_3').val(data.cum_wt_gm_3);
						$('#cum_wt_gm_4').val(data.cum_wt_gm_4);
						$('#cum_wt_gm_5').val(data.cum_wt_gm_5);
						$('#cum_wt_gm_6').val(data.cum_wt_gm_6);
						$('#cum_wt_gm_7').val(data.cum_wt_gm_7);
						$('#cum_wt_gm_8').val(data.cum_wt_gm_8);
						
						$('#ret_wt_gm_1').val(data.ret_wt_gm_1);
						$('#ret_wt_gm_2').val(data.ret_wt_gm_2);
						$('#ret_wt_gm_3').val(data.ret_wt_gm_3);
						$('#ret_wt_gm_4').val(data.ret_wt_gm_4);
						$('#ret_wt_gm_5').val(data.ret_wt_gm_5);
						$('#ret_wt_gm_6').val(data.ret_wt_gm_6);
						$('#ret_wt_gm_7').val(data.ret_wt_gm_7);
						$('#ret_wt_gm_8').val(data.ret_wt_gm_8);
						
						$('#cum_ret_1').val(data.cum_ret_1);
						$('#cum_ret_2').val(data.cum_ret_2);
						$('#cum_ret_3').val(data.cum_ret_3);
						$('#cum_ret_4').val(data.cum_ret_4);
						$('#cum_ret_5').val(data.cum_ret_5);
						$('#cum_ret_6').val(data.cum_ret_6);
						$('#cum_ret_7').val(data.cum_ret_7);
						$('#cum_ret_8').val(data.cum_ret_8);
						
						$('#pass_sample_1').val(data.pass_sample_1);
						$('#pass_sample_2').val(data.pass_sample_2);
						$('#pass_sample_3').val(data.pass_sample_3);
						$('#pass_sample_4').val(data.pass_sample_4);
						$('#pass_sample_5').val(data.pass_sample_5);
						$('#pass_sample_6').val(data.pass_sample_6);
						$('#pass_sample_7').val(data.pass_sample_7);
						$('#pass_sample_8').val(data.pass_sample_8);
						
						$('#blank_extra').val(data.blank_extra);
						$('#grd_zone').val(data.grd_zone);
						
						sieve_1=data.sieve_1;
						sieve_2=data.sieve_2;
						sieve_3=data.sieve_3;
						sieve_4=data.sieve_4;
						sieve_5=data.sieve_5;
						sieve_6=data.sieve_6;
						sieve_7=data.sieve_7;
						sieve_8=data.sieve_8;
						
						$('#grd_s_d').val(data.grd_s_d);
						$('#grd_e_d').val(data.grd_e_d);
						$('#slt_s_d').val(data.slt_s_d);
						$('#slt_e_d').val(data.slt_e_d);
						
						break;
					}
					else
					{
						
					}
														
				}
			
				
				//sp and water
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{	var chk_sp = data.chk_sp;
							if(chk_sp=="1")
							{
								$('#txtwtr').css("background-color","var(--success)");	
							   $("#chk_sp").prop("checked", true); 
							}else{
								$('#txtwtr').css("background-color","white");	
								$("#chk_sp").prop("checked", false); 
							}
						//specific gravity and water abr
						$('#sp_sample_ca').val(data.sp_sample_ca);
						$('#sp_w_sur_1').val(data.sp_w_sur_1);
						$('#sp_w_sur_2').val(data.sp_w_sur_2);	
						$('#sp_w_s_1').val(data.sp_w_s_1);
						$('#sp_w_s_2').val(data.sp_w_s_2);		
						$('#sp_wt_st_1').val(data.sp_wt_st_1);
						$('#sp_wt_st_2').val(data.sp_wt_st_2);								
						$('#sp_specific_gravity_1').val(data.sp_specific_gravity_1);
						$('#sp_specific_gravity_2').val(data.sp_specific_gravity_2);										
						$('#sp_specific_gravity').val(data.sp_specific_gravity);										
						$('#sp_water_abr').val(data.sp_water_abr);										
						$('#sp_water_abr_1').val(data.sp_water_abr_1);										
						$('#sp_water_abr_2').val(data.sp_water_abr_2);
						$('#sp_temp').val(data.sp_temp); 
						
						$('#sp_bask_water').val(data.sp_bask_water);
						$('#sp_wt_bas1').val(data.sp_wt_bas1);
						$('#sp_wt_bas2').val(data.sp_wt_bas2);
						$('#sp_apr1').val(data.sp_apr1);
						$('#sp_apr2').val(data.sp_apr2);
						$('#sp_avg_apr').val(data.sp_avg_apr);
						$('#wtr_s_d').val(data.wtr_s_d);
						$('#wtr_e_d').val(data.wtr_e_d);
						
						$('#sp_specific_gravity_11').val(data.sp_specific_gravity_11);
						$('#sp_specific_gravity_22').val(data.sp_specific_gravity_22);
						$('#sp_specific_gravity1').val(data.sp_specific_gravity1);
						
						

						
						break;
					}
					else
					{
						
					}
				
				}
				
				//ORG
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="aoi")
					{
							$('#avg_org').val(data.avg_org);
							
							var chk_aoi = data.chk_aoi;
							if(chk_aoi=="1")
							{
							   $('#txtaoi').css("background-color","var(--success)");	
							   $("#chk_aoi").prop("checked", true); 
							}else{
								$('#txtaoi').css("background-color","white");	
								$("#chk_aoi").prop("checked", false); 
							}	
							break;
					}
					else
					{
						
					}
				}
				
				//DELETERIOUS MATERIAL
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dtm")
					{
							$('#avg_dtm').val(data.avg_dtm);
							
							var chk_dtm = data.chk_dtm;
							if(chk_dtm=="1")
							{
							   $('#txtdtm').css("background-color","var(--success)");	
							   $("#chk_dtm").prop("checked", true); 
							}else{
								$('#txtdtm').css("background-color","white");	
								$("#chk_dtm").prop("checked", false); 
							}	
							break;
					}
					else
					{
						
					}
				}
				
				//bulk density
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="den")
					{
							$('#m11').val(data.m11);
							$('#m12').val(data.m12);
							$('#m13').val(data.m13);
							$('#m21').val(data.m21);
							$('#m22').val(data.m22);
							$('#m23').val(data.m23);
							$('#m31').val(data.m31);
							$('#m32').val(data.m32);
							$('#m33').val(data.m33);
							$('#wom1').val(data.wom1);
							$('#wom2').val(data.wom2);
							$('#wom3').val(data.wom3);
							$('#avg_wom').val(data.avg_wom);
							$('#avg_wom1').val(data.avg_wom);
							$('#vol').val(data.vol);
							$('#bdl').val(data.bdl);
							$('#avg_wom1').val(data.avg_wom1);
							$('#den_voids1').val(data.den_voids1);
							$('#weight_1').val(data.weight_1);
							$('#weight_2').val(data.weight_2);
							$('#asd_1').val(data.asd_1);
							$('#asd_2').val(data.asd_2);
							$('#den_voids_1').val(data.den_voids_1);
							$('#den_voids').val(data.den_voids);
							$('#den_mo_vol1').val(data.den_mo_vol1);
							$('#den_mo_vol2').val(data.den_mo_vol2);
							$('#den_kg_lit').val(data.den_kg_lit);
							$('#den_liter').val(data.den_liter);
							var chk_den = data.chk_den;
							if(chk_den=="1")
							{
							   $('#txtden').css("background-color","var(--success)");	
							   $("#chk_den").prop("checked", true); 
							}else{
								$('#txtden').css("background-color","white");	
								$("#chk_den").prop("checked", false); 
							}	
							
							$('#den_s_d').val(data.den_s_d);
						    $('#den_e_d').val(data.den_e_d);
							break;
					}
					else
					{
						
					}

				}
				
				//FINER
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fne")
					{
							$('#finer_a').val(data.finer_a);
							$('#finer_b').val(data.finer_b);
							$('#avg_finer').val(data.avg_finer);
							
							var chk_finer = data.chk_finer;
							$('#finer_a1').val(data.finer_a1);
							$('#finer_b1').val(data.finer_b1);
							$('#avg_finer1').val(data.avg_finer1);
							$('#avg_fin_1').val(data.avg_fin_1);
							$('#avg_fin_2').val(data.avg_fin_2);
							if(chk_finer=="1")
							{
							   $('#txtfne').css("background-color","var(--success)");	
							   $("#chk_finer").prop("checked", true); 
							}else{
								$('#txtfne').css("background-color","white");	
								$("#chk_finer").prop("checked", false); 
							}	
							break;
					}
					else
					{
						
					}

				}
				
				//soundness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{
							$('#go1').val(data.go1);
							$('#go2').val(data.go2);
							$('#go3').val(data.go3);
							$('#go4').val(data.go4);
							$('#go5').val(data.go5);
							$('#go6').val(data.go6);
							$('#go7').val(data.go7);
							
							$('#wt1').val(data.wt1);
							$('#wt2').val(data.wt2);
							$('#wt3').val(data.wt3);
							$('#wt4').val(data.wt4);
							$('#wt5').val(data.wt5);
							$('#wt6').val(data.wt6);
							$('#wt7').val(data.wt7);
							
							$('#pp1').val(data.pp1);
							$('#pp2').val(data.pp2);
							$('#pp3').val(data.pp3);
							$('#pp4').val(data.pp4);
							$('#pp5').val(data.pp5);
							$('#pp6').val(data.pp6);
							$('#pp7').val(data.pp7);
							
							$('#wa1').val(data.wa1);
							$('#wa2').val(data.wa2);
							$('#wa3').val(data.wa3);
							$('#wa4').val(data.wa4);
							$('#wa5').val(data.wa5);
							$('#wa6').val(data.wa6);
							$('#wa7').val(data.wa7);
							$('#sou_s_d').val(data.sou_s_d);
						    $('#sou_e_d').val(data.sou_e_d);
							$('#soundness').val(data.soundness);
							
							
							var chk_sou = data.chk_sou;
							if(chk_sou=="1")
							{
							   $('#txtsou').css("background-color","var(--success)");	
							   $("#chk_sou").prop("checked", true); 
							}else{
								$('#txtsou').css("background-color","white");	
								$("#chk_sou").prop("checked", false); 
							}	
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