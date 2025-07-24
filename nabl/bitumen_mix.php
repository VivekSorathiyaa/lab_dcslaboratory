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
			
		}
		if(isset($_GET['lab_no'])){
			$lab_no=$_GET['lab_no'];
			$aa	=$_GET['lab_no'];
			
		}if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
			
		}
		
		 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					 $bit_mix= $row_select4['bit_mix'];
					/*$lot_no= $row_select4['lot_no'];
					$bitumin_grade= $row_select4['bitumin_grade'];
					$bitumin_make= $row_select4['bitumin_make'];*/
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
							<h2  style="text-align:center;">BITUMEN MIX</h2>
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
								<div class="col-lg-6">
									<div class="form-group">
										 <div class="col-sm-2">
													<label 	>Location :</label>
												</div>
										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="Location_1" name="Location_1">
										</div>
									</div>
								</div>
								
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">TYPE OF SAMPLE:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="type_sample" value="<?php echo $bit_mix;?>" name="type_sample" ReadOnly>
										</div>
									</div>
								</div>
								
								
							</div>
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										
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
										<div class="col-sm-1">
											<!-- SAVE BUTTON LOGIC VAIBHAV-->
											<?php   
												$querys_job1 = "SELECT * FROM bitumin_span_mix WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										//$val =  $_SESSION['isadmin'];
										//if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl"  || $_SESSION['nabl_type']=="direct_non_nabl"|| $_SESSION['nabl_type']=="non_nabl") {
										?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_bitumen_mix.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div><!--
										<div class="col-sm-2">
 													<a target='_blank' href="<?php echo $base_url; ?>back_cal_report_blank/print_bitumen_mix.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&ulr=<?php echo $ulr; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Blank</b></a>

 												</div>-->
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_bitumen_mix.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
											
										</div>
										<?php //} ?>
									</div>
								</div>
							</div>
							<hr>
							<br>	
							<div class="panel-group" id="accordion">
							 <?php 
  $is_upload = "select * from span_material_assign WHERE `excel_upload`='y' and `trf_no`='$trf_no' and `job_number`='$job_no'and isdeleted='0'"; 
  
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
							
							if($r1['test_code']=="msf")
							{
								$test_check.="msf,";
			?>
						<div class="panel panel-default" id="msf">
					<div class="panel-heading" id="txtmsf">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
								<h4 class="panel-title">
								<b>MARSHALL STABILTY & FLOW</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse5" class="panel-collapse collapse">
						<div class="panel-body">
							<br>
							<div class="row">									
								
								<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_msf">1.</label>
													<input type="checkbox" class="visually-hidden" name="chk_msf"  id="chk_msf" value="chk_msf"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">MARSHALL STABILTY & FLOW</label>
										</div>
									</div>
								<div class="col-lg-6">
									<div class="form-group">
										
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Sample No.</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Stability (kN)</label>
										</div>
									</div>									
									<div class="col-md-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Flow (mm)</label>
										</div>
									</div>
									
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">									
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="ms_11" name="ms_11" >
										</div>
									</div>									
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="ms_21" name="ms_21" >
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="ms_31" name="ms_31" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">									
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="ms_12" name="ms_12" >
										</div>
									</div>									
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="ms_22" name="ms_22" >
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="ms_32" name="ms_32" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">									
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="ms_13" name="ms_13" >
										</div>
									</div>									
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="ms_23" name="ms_23" >
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="ms_33" name="ms_33" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">AVERAGE</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_stabilty" name="avg_stabilty" >
										</div>
									</div>									
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_flow" name="avg_flow" >
										</div>
									</div>
								</div>		
							</div>
						</div>
						</div>
					</div>	
			<?php }
				
			else if($r1['test_code']=="cdm")
			{ $test_check.="cdm,";?>
		
			<div class="panel panel-default" id="cdm">
		<div class="panel-heading" id="txtcdm">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
					<h4 class="panel-title">
					<b>DENSITY (CDM) TEST</b>
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
													<label for="chk_cdm">2.</label>
													<input type="checkbox" class="visually-hidden" name="chk_cdm"  id="chk_cdm" value="chk_cdm"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">DENSITY (CDM) TEST</label>
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
									  <label for="inputEmail3" class="col-sm-12 control-label">Sample No.</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight in Air (gms) (A)</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight in Water (gm) (B)</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">S.S.D. Weight (gm) (C)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Volumn in CC D=(C-B)</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Density in gm/cc E=A/D</label>
									</div>
									</div>
									
									
											
								</div>
								<br>
								<!--boxes-->
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="s1" name="s1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a1" name="a1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b1" name="b1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c1" name="c1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d1" name="d1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="e1" name="e1" >
									  </div>
									</div>
									</div>
									
									
							</div>
							<br>
								<!--boxes-->
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="s2" name="s2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a2" name="a2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b2" name="b2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c2" name="c2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d2" name="d2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="e2" name="e2" >
									  </div>
									</div>
									</div>
									
									
							</div>
							<br>
								<!--boxes-->
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="s3" name="s3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a3" name="a3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b3" name="b3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c3" name="c3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d3" name="d3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="e3" name="e3" >
									  </div>
									</div>
									</div>
									
									
							</div>
							<br>
								<!--boxes-->
							<div class="row">
									<div class="col-lg-10">
									<div class="form-group">
									  <div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="avg_density" name="avg_density" >
									  </div>
									</div>
									</div>		
							</div>
					</div>
						</div>
				  </div>
	
				
			<?php }
				
			else if($r1['test_code']=="bin")
			{ $test_check.="bin,";?>				
							
				<div class="panel panel-default" id="bin">
					<div class="panel-heading" id="txtbin">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
								<h4 class="panel-title">
								<b>BINDER CONTENT</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
							<br>
							<div class="row">									
								
								<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_bin">3.</label>
													<input type="checkbox" class="visually-hidden" name="chk_bin"  id="chk_bin" value="chk_bin"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">BINDER CONTENT</label>
										</div>
									</div>
								<div class="col-lg-6">
									<div class="form-group">
										
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Description</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">1</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">2</label>
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of Bowel in gm</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b11" name="b11" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b12" name="b12" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of Filter Paper before extraction in gm (A)</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b21" name="b21" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b22" name="b22" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of Sample before extraction in gm (B)</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b31" name="b31" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b32" name="b32" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of Filter Paper after extraction in gm (C)</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b41" name="b41" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b42" name="b42" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of sample after extraction in gm (D)</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b51" name="b51" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b52" name="b52" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of Aggregate in filter paper E = (C)-(A)</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b61" name="b61" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b62" name="b62" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Total Weight of Aggregate after extraction in gm F =  (D)+(E)</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b71" name="b71" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b72" name="b72" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of bitumen in gm G = (B) - (F)</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b81" name="b81" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b82" name="b82" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">% of bitumen (G/B) x 100</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="per_bin1" name="per_bin1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="per_bin2" name="per_bin2" >
										</div>
									</div>
									
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">	
									<div class="col-md-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Average Binder Content</label>
										</div>
									</div>									
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_bin" name="avg_bin" >
										</div>
									</div>
									
								</div>
							</div>
						</div>
							<br>
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
								<th style="text-align:center;"><label>Job No.</label></th>	
								<th style="text-align:center;"><label>Lab No.</label></th>	
								
																		

							</tr>
								<?php
							 $query = "select * from bitumin_span_mix WHERE lab_no='$aa'  and `is_deleted`='0'";

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
  });
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();
	



	$('#chk_msf').change(function(){
        if(this.checked)
		{
			$('#txtmsf').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtmsf').css("background-color","white");	
		}
		
	});
	
	$('#chk_cdm').change(function(){
        if(this.checked)
		{
			$('#txtcdm').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtcdm').css("background-color","white");	
		}
		
	});
	
	
	
	$('#chk_bin').change(function(){
        if(this.checked)
		{
			$('#txtbin').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtbin').css("background-color","white");	
		}
		
	});
	
	
	
	
	var avg_stabilty;
	var avg_flow;
	var ms_11;
	var ms_12;
	var ms_13;
	var ms_21;
	var ms_22;
	var ms_23;
	var ms_31;
	var ms_32;
	var ms_33;
	
	function msf_auto()
	{
		var grades = $('#type_sample').val();
			if(grades=="BC-I")
			{
				//SAME BIJA GRADE MA MUKVANA
				var avg_stabilty = randomNumberFromRange(11.0,13.0).toFixed(2);
				var avg_flow = randomNumberFromRange(3.63,3.87).toFixed(2);
				$('#avg_stabilty').val(avg_stabilty);
				$('#avg_flow').val(avg_flow);
				var avg_stabilty = $('#avg_stabilty').val(); 
				var avg_flow = $('#avg_flow').val(); 
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var ms_21 = (+avg_stabilty) - 0.76;
				var ms_22 = (+avg_stabilty) - 0.21;
				var ms_23 = (+avg_stabilty) + 0.97; 
				
				var ms_31 = (+avg_flow) - 0.03;
				var ms_32 = (+avg_flow) + 0.07;
				var ms_33 = (+avg_flow) - 0.04; 
				
				}
				else{
				var ms_21 = (+avg_stabilty) + 0.63;
				var ms_22 = (+avg_stabilty) + 0.22;
				var ms_23 = (+avg_stabilty) - 0.85; 
				
				var ms_31 = (+avg_flow) - 0.02;
				var ms_32 = (+avg_flow) - 0.04;
				var ms_33 = (+avg_flow) + 0.06; 
				
				}
									
				
			}
			else if(grades=="BC-II")
			{
				var avg_stabilty = randomNumberFromRange(11.0,13.0).toFixed(2);
				var avg_flow = randomNumberFromRange(3.63,3.87).toFixed(2);
				$('#avg_stabilty').val(avg_stabilty);
				$('#avg_flow').val(avg_flow);
				var avg_stabilty = $('#avg_stabilty').val(); 
				var avg_flow = $('#avg_flow').val(); 
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var ms_21 = (+avg_stabilty) - 0.49;
				var ms_22 = (+avg_stabilty) - 0.24;
				var ms_23 = (+avg_stabilty) + 0.73; 
				
				var ms_31 = (+avg_flow) - 0.03;
				var ms_32 = (+avg_flow) + 0.07;
				var ms_33 = (+avg_flow) - 0.04; 
				
				}
				else{
				var ms_21 = (+avg_stabilty) + 0.64;
				var ms_22 = (+avg_stabilty) + 0.22;
				var ms_23 = (+avg_stabilty) - 0.86; 
				
				var ms_31 = (+avg_flow) - 0.02;
				var ms_32 = (+avg_flow) - 0.04;
				var ms_33 = (+avg_flow) + 0.06; 
				
				}
			}
			else if(grades=="DBM-I")
			{
				var avg_stabilty = randomNumberFromRange(21.5,23.5).toFixed(2); 
				var avg_flow = randomNumberFromRange(3.48,3.72).toFixed(2);
				$('#avg_stabilty').val(avg_stabilty);
				$('#avg_flow').val(avg_flow);
				var avg_stabilty = $('#avg_stabilty').val(); 
				var avg_flow = $('#avg_flow').val(); 
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var ms_21 = (+avg_stabilty) - 0.64;
				var ms_22 = (+avg_stabilty);
				var ms_23 = (+avg_stabilty) + 0.64; 
				
				var ms_31 = (+avg_flow);
				var ms_32 = (+avg_flow)- 0.68;
				var ms_33 = (+avg_flow) + 0.68;
				}
				else{
				var ms_21 = (+avg_stabilty);
				var ms_22 = (+avg_stabilty) + 0.12;
				var ms_23 = (+avg_stabilty) - 0.12;
				
				var ms_31 = (+avg_flow)-0.74;
				var ms_32 = (+avg_flow)- 0.10;
				var ms_33 = (+avg_flow) + 0.84; 
				
				}
			}
			else if(grades=="DBM-II")
			{
				var avg_stabilty = randomNumberFromRange(11.0,13.0).toFixed(2);
				var avg_flow = randomNumberFromRange(3.48,3.76).toFixed(2);
				$('#avg_stabilty').val(avg_stabilty);
				$('#avg_flow').val(avg_flow);
				var avg_stabilty = $('#avg_stabilty').val(); 
				var avg_flow = $('#avg_flow').val(); 
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var ms_21 = (+avg_stabilty) - 0.09;
				var ms_22 = (+avg_stabilty);
				var ms_23 = (+avg_stabilty) + 0.09; 
				
				var ms_31 = parseFloat(avg_flow);
				var ms_32 = parseFloat(avg_flow)- 0.72;
				var ms_33 = parseFloat(avg_flow) + 0.72;
				
				}
				else{
				var ms_21 = (+avg_stabilty);
				var ms_22 = (+avg_stabilty) + 0.15;
				var ms_23 = (+avg_stabilty) - 0.15; 
				
				var ms_31 = (+avg_flow)-0.36;
				var ms_32 = (+avg_flow)- 0.42;
				var ms_33 = (+avg_flow) + 0.78; 
				
				}
			}
			else if(grades=="SDBC-I")
			{
				var avg_stabilty = randomNumberFromRange(11.0,13.0).toFixed(2);
				var avg_flow = randomNumberFromRange(3.48,3.76).toFixed(2);
				$('#avg_stabilty').val(avg_stabilty);
				$('#avg_flow').val(avg_flow);
				var avg_stabilty = $('#avg_stabilty').val(); 
				var avg_flow = $('#avg_flow').val(); 
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var ms_21 = (+avg_stabilty) - 0.05;
				var ms_22 = (+avg_stabilty);
				var ms_23 = (+avg_stabilty) + 0.05; 
				
				var ms_31 = (+avg_flow);
				var ms_32 = (+avg_flow)- 0.74;
				var ms_33 = (+avg_flow) + 0.74;
				
				}
				else{
				var ms_21 = (+avg_stabilty);
				var ms_22 = (+avg_stabilty) + 0.10;
				var ms_23 = (+avg_stabilty) - 0.10; 
				
				var ms_31 = (+avg_flow)-0.47;
				var ms_32 = (+avg_flow)- 0.12;
				var ms_33 = (+avg_flow) + 0.59; 
				
				}
			}
			else if(grades=="SDBC-II")
			{
				var avg_stabilty = randomNumberFromRange(11.0,13.0).toFixed(2);
				var avg_flow = randomNumberFromRange(3.48,3.76).toFixed(2);
				$('#avg_stabilty').val(avg_stabilty);
				$('#avg_flow').val(avg_flow);
				var avg_stabilty = $('#avg_stabilty').val(); 
				var avg_flow = $('#avg_flow').val(); 
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var ms_21 = (+avg_stabilty) - 0.34;
				var ms_22 = (+avg_stabilty);
				var ms_23 = (+avg_stabilty) + 0.34; 
				
				var ms_31 = (+avg_flow);
				var ms_32 = (+avg_flow)- 0.68;
				var ms_33 = (+avg_flow) + 0.68;
				
				}
				else{
				var ms_21 =(+avg_stabilty);
				var ms_22 =(+avg_stabilty) + 0.10;
				var ms_23 =(+avg_stabilty) - 0.10; 
				
				var ms_31 = (+avg_flow)-0.80;
				var ms_32 = (+avg_flow)- 0.10;
				var ms_33 = (+avg_flow) + 0.90; 
				
				}
			}
			
			var ms_11 = "1";
			var ms_12 = "2";
			var ms_13 = "3";
			
			
			
										
			
			$('#ms_31').val(ms_31.toFixed(2));
			$('#ms_32').val(ms_32.toFixed(2));
			$('#ms_33').val(ms_33.toFixed(2));
			$('#ms_21').val(ms_21.toFixed(2));
			$('#ms_22').val(ms_22.toFixed(2));
			$('#ms_23').val(ms_23.toFixed(2));
			$('#ms_11').val(ms_11);
			$('#ms_12').val(ms_12);
			$('#ms_13').val(ms_13);
	}
	
	$('#chk_msf').change(function(){
        if(this.checked)
		{  
			
			msf_auto();
			
			
		}
		else
		{
			$('#avg_stabilty').val(null);
			$('#avg_flow').val(null);
			$('#ms_31').val(null);
			$('#ms_32').val(null);
			$('#ms_33').val(null);
			$('#ms_21').val(null);
			$('#ms_22').val(null);
			$('#ms_23').val(null);
			$('#ms_11').val(null);
			$('#ms_12').val(null);
			$('#ms_13').val(null);
		}
	});
	
	
	$('#avg_stabilty').change(function(){
		
		if ($("#chk_msf").is(':checked')) 
		{
			var avg_stabilty = $('#avg_stabilty').val();
			var gg = randomNumberFromRange(0,9).toFixed();
			if(gg % 2 == 0)
			{
				
			var ms_21 = (+avg_stabilty) - 0.7;
			var ms_22 = (+avg_stabilty) - 0.3;
			var ms_23 = (+avg_stabilty) + 1; 
		
			}
			else
			{
			var ms_21 = (+avg_stabilty) + 0.4;
			var ms_22 = (+avg_stabilty) + 0.5;
			var ms_23 = (+avg_stabilty) - 0.9; 
			
			}
			$('#ms_21').val(ms_21.toFixed(2));
			$('#ms_22').val(ms_22.toFixed(2));
			$('#ms_23').val(ms_23.toFixed(2));
		}
		
	});
	
	$('#avg_flow').change(function(){
		
		if ($("#chk_msf").is(':checked')) {
			
		var avg_flow = $('#avg_flow').val();
		var gg = randomNumberFromRange(0,9).toFixed();
		if(gg % 2 == 0)
		{
		
	 	var ms_31 = (+avg_flow) - 0.03;
		var ms_32 = (+avg_flow) + 0.07;
		var ms_33 = (+avg_flow) - 0.04; 
		 
		}
		else{
	
		 var ms_31 = (+avg_flow) - 0.02;
		var ms_32 = (+avg_flow) - 0.04;
		var ms_33 = (+avg_flow) + 0.06;  
		
		}
		$('#ms_31').val(ms_31.toFixed(2));
		$('#ms_32').val(ms_32.toFixed(2));
		$('#ms_33').val(ms_33.toFixed(2)); 
		
		}
		
	});
	
	function msf_stability()
	{
		$('#txtmsf').css("background-color","var(--success)");	
		var ms_21 = $('#ms_21').val();
		var ms_22 = $('#ms_22').val();
		var ms_23 = $('#ms_23').val();
		
		var avg_stabilty = ((+ms_21) + (+ms_22) + (+ms_23))/3;
		$('#avg_stabilty').val(avg_stabilty.toFixed(2));
	}
	function msf_flow()
	{
		$('#txtmsf').css("background-color","var(--success)");	
		var ms_31 = $('#ms_31').val();
		var ms_32 = $('#ms_32').val();
		var ms_33 = $('#ms_33').val();
		
		var avg_flow = ((+ms_31) + (+ms_32) + (+ms_33))/3;
		$('#avg_flow').val(avg_flow.toFixed(2));
	}
	$('#ms_21').change(function(){
		msf_stability();
	});
	$('#ms_22').change(function(){
		msf_stability();
	});
	$('#ms_23').change(function(){
		msf_stability();
	});
	
	$('#ms_31').change(function(){
		msf_flow();
	});
	$('#ms_32').change(function(){
		msf_flow();
	});
	$('#ms_33').change(function(){
		msf_flow();
	});
	
	var s1;
	var s2;
	var s3;
	var a1;
	var a2;
	var a3;
	var b1;
	var b2;
	var b3;
	var c1;
	var c2;
	var c3;
	var d1;
	var d2;
	var d3;
	var e1;
	var e2;
	var e3;
	var avg_density;	
	
	function cdm_auto()
	{
		var grades = $('#type_sample').val();
			if(grades=="BC-I")
			{
				
				var avg_density = randomNumberFromRange(2.354,2.364).toFixed(3);
				
				$('#avg_density').val(avg_density);
				
				var avg_density = $('#avg_density').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var e1 = (+avg_density) - 0.004;
				var e2 = (+avg_density) - 0.002;
				var e3 = (+avg_density) + 0.006; 
				}
				else{
				var e1 = (+avg_density) + 0.003;
				var e2 = (+avg_density) + 0.001;
				var e3 = (+avg_density) - 0.004; 
				}
									
				
			}
			else if(grades=="BC-II")
			{
				var avg_density = randomNumberFromRange(2.374,2.384).toFixed(3);
				
				$('#avg_density').val(avg_density);
				
				var avg_density = $('#avg_density').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var e1 = (+avg_density) - 0.004;
				var e2 = (+avg_density) - 0.002;
				var e3 = (+avg_density) + 0.006; 
				}
				else{
				var e1 = (+avg_density) + 0.003;
				var e2 = (+avg_density) + 0.001;
				var e3 = (+avg_density) - 0.004; 
				}
					
			}
			else if(grades=="DBM-I")
			{
				var avg_density = randomNumberFromRange(2.314,2.324).toFixed(3);
				
				$('#avg_density').val(avg_density);
				
				var avg_density = $('#avg_density').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var e1 = (+avg_density) - 0.004;
				var e2 = (+avg_density) - 0.002;
				var e3 = (+avg_density) + 0.006; 
				}
				else{
				var e1 = (+avg_density) + 0.003;
				var e2 = (+avg_density) + 0.001;
				var e3 = (+avg_density) - 0.004; 
				}
			}
			else if(grades=="DBM-II")
			{
				var avg_density = randomNumberFromRange(2.334,2.354).toFixed(3);
				
				$('#avg_density').val(avg_density);
				
				var avg_density = $('#avg_density').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var e1 = (+avg_density) - 0.004;
				var e2 = (+avg_density) - 0.002;
				var e3 = (+avg_density) + 0.006; 
				}
				else{
				var e1 = (+avg_density) + 0.003;
				var e2 = (+avg_density) + 0.001;
				var e3 = (+avg_density) - 0.004; 
				}
			}
			else if(grades=="SDBC-I")
			{
				var avg_density = randomNumberFromRange(2.394,2.404).toFixed(3);
				
				$('#avg_density').val(avg_density);
				
				var avg_density = $('#avg_density').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var e1 = (+avg_density) - 0.004;
				var e2 = (+avg_density) - 0.002;
				var e3 = (+avg_density) + 0.006; 
				}
				else{
				var e1 = (+avg_density) + 0.003;
				var e2 = (+avg_density) + 0.001;
				var e3 = (+avg_density) - 0.004; 
				}
			}
			else if(grades=="SDBC-II")
			{
				var avg_density = randomNumberFromRange(2.414,2.424).toFixed(3);
				
				$('#avg_density').val(avg_density);
				
				var avg_density = $('#avg_density').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var e1 = (+avg_density) - 0.004;
				var e2 = (+avg_density) - 0.002;
				var e3 = (+avg_density) + 0.006; 
				}
				else{
				var e1 = (+avg_density) + 0.003;
				var e2 = (+avg_density) + 0.001;
				var e3 = (+avg_density) - 0.004; 
				}
			}
			
			
			
			$('#s1').val("1");
			$('#s2').val("2");
			$('#s3').val("3");
			
			$('#e1').val(e1.toFixed(3));
			$('#e2').val(e2.toFixed(3));
			$('#e3').val(e3.toFixed(3));
			
			var e_1 = $('#e1').val();
			var e_2 = $('#e2').val();
			var e_3 = $('#e3').val();
			
			var d1 = randomNumberFromRange(510.0,550.0).toFixed(1);
			var d2 = randomNumberFromRange(510.0,550.0).toFixed(1);
			var d3 = randomNumberFromRange(510.0,550.0).toFixed(1);
			
			var c1 = randomNumberFromRange(1220.0,1250.0).toFixed(1);
			var c2 = randomNumberFromRange(1220.0,1250.0).toFixed(1);
			var c3 = randomNumberFromRange(1220.0,1250.0).toFixed(1);
			
			$('#d1').val(d1);
			$('#d2').val(d2);
			$('#d3').val(d3);
			$('#c1').val(c1);
			$('#c2').val(c2);
			$('#c3').val(c3);
			
			var d_1 = $('#d1').val();
			var d_2 = $('#d2').val();
			var d_3 = $('#d3').val();
			
			var c_1 = $('#c1').val();
			var c_2 = $('#c2').val();
			var c_3 = $('#c3').val();
			
			var a1 = (+d_1) * (+e_1);
			var a2 = (+d_2) * (+e_2);
			var a3 = (+d_3) * (+e_3);
			
			$('#a1').val(a1.toFixed(1));
			$('#a2').val(a2.toFixed(1));
			$('#a3').val(a3.toFixed(1));
			
			var a_1 = $('#a1').val();
			var a_2 = $('#a2').val();
			var a_3 = $('#a3').val();
			
			var b1 = (+c1) - (+d1);
			var b2 = (+c2) - (+d2);
			var b3 = (+c3) - (+d3);
			
			$('#b1').val(b1.toFixed(1));
			$('#b2').val(b2.toFixed(1));
			$('#b3').val(b3.toFixed(1));
	}
	
	$('#chk_cdm').change(function(){
        if(this.checked)
		{  
			cdm_auto();
			

		}
		else
		{
			$('#avg_density').val(null);
			$('#s1').val(null);
			$('#s2').val(null);
			$('#s3').val(null);
			$('#a1').val(null);
			$('#a2').val(null);
			$('#a3').val(null);
			$('#b1').val(null);
			$('#b2').val(null);
			$('#b3').val(null);
			$('#c1').val(null);
			$('#c2').val(null);
			$('#c3').val(null);
			$('#d1').val(null);
			$('#d2').val(null);
			$('#d3').val(null);
			$('#e1').val(null);
			$('#e2').val(null);
			$('#e3').val(null);
			
		}
	});
	
	$('#avg_density').change(function(){
		
		if ($("#chk_cdm").is(':checked')) {
			
			var avg_density = $('#avg_density').val();
			var gg = randomNumberFromRange(0,9).toFixed();
			if(gg % 2 == 0)
			{
				
			var e1 = (+avg_density) - 0.004;
			var e2 = (+avg_density) - 0.002;
			var e3 = (+avg_density) + 0.006; 
			}
			else{
			var e1 = (+avg_density) + 0.003;
			var e2 = (+avg_density) + 0.001;
			var e3 = (+avg_density) - 0.004; 
			}
			$('#s1').val("1");
			$('#s2').val("2");
			$('#s3').val("3");
			
			$('#e1').val(e1.toFixed(3));
			$('#e2').val(e2.toFixed(3));
			$('#e3').val(e3.toFixed(3));
			
			var e_1 = $('#e1').val();
			var e_2 = $('#e2').val();
			var e_3 = $('#e3').val();
			
			var d1 = randomNumberFromRange(510.0,550.0).toFixed(1);
			var d2 = randomNumberFromRange(510.0,550.0).toFixed(1);
			var d3 = randomNumberFromRange(510.0,550.0).toFixed(1);
			
			var c1 = randomNumberFromRange(1220.0,1250.0).toFixed(1);
			var c2 = randomNumberFromRange(1220.0,1250.0).toFixed(1);
			var c3 = randomNumberFromRange(1220.0,1250.0).toFixed(1);
			
			$('#d1').val(d1);
			$('#d2').val(d2);
			$('#d3').val(d3);
			$('#c1').val(c1);
			$('#c2').val(c2);
			$('#c3').val(c3);
			
			var d_1 = $('#d1').val();
			var d_2 = $('#d2').val();
			var d_3 = $('#d3').val();
			
			var c_1 = $('#c1').val();
			var c_2 = $('#c2').val();
			var c_3 = $('#c3').val();
			
			var a1 = (+d_1)*(+e_1);
			var a2 = (+d_2)*(+e_2);
			var a3 = (+d_3)*(+e_3);
			
			$('#a1').val(a1.toFixed(1));
			$('#a2').val(a2.toFixed(1));
			$('#a3').val(a3.toFixed(1));
			
			var a_1 = $('#a1').val();
			var a_2 = $('#a2').val();
			var a_3 = $('#a3').val();
			
			var b1 = (+c1) - (+d1);
			var b2 = (+c2) - (+d2);
			var b3 = (+c3) - (+d3);
			
			$('#b1').val(b1.toFixed(1));
			$('#b2').val(b2.toFixed(1));
			$('#b3').val(b3.toFixed(1));
		
		
		
		
		}
		
		
	});
	
	$('#e1').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var d1 = (+a_1) / (+e_1);
		var d2 = (+a_2) / (+e_2);
		var d3 = (+a_3) / (+e_3);
		
		$('#d1').val(d1.toFixed(1));
		$('#d2').val(d2.toFixed(1));
		$('#d3').val(d3.toFixed(1));
		
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		var b1 = (+c_1) - (+d_1);
		var b2 = (+c_2) - (+d_2);
		var b3 = (+c_3) - (+d_3);
		
		$('#b1').val(b1.toString().substring(0, b1.toString().indexOf(".") + 3));
		$('#b2').val(b2.toString().substring(0, b2.toString().indexOf(".") + 3));
		$('#b3').val(b3.toString().substring(0, b3.toString().indexOf(".") + 3));
		
		
		
	});
	$('#e2').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var d1 = (+a_1) / (+e_1);
		var d2 = (+a_2) / (+e_2);
		var d3 = (+a_3) / (+e_3);
		
		$('#d1').val(d1.toFixed(1));
		$('#d2').val(d2.toFixed(1));
		$('#d3').val(d3.toFixed(1));
		
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		var b1 = (+c_1) - (+d_1);
		var b2 = (+c_2) - (+d_2);
		var b3 = (+c_3) - (+d_3);
		
		$('#b1').val(b1.toString().substring(0, b1.toString().indexOf(".") + 3));
		$('#b2').val(b2.toString().substring(0, b2.toString().indexOf(".") + 3));
		$('#b3').val(b3.toString().substring(0, b3.toString().indexOf(".") + 3));
	});
	$('#e3').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var d1 = (+a_1) / (+e_1);
		var d2 = (+a_2) / (+e_2);
		var d3 = (+a_3) / (+e_3);
		
		$('#d1').val(d1.toFixed(1));
		$('#d2').val(d2.toFixed(1));
		$('#d3').val(d3.toFixed(1));
		
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		var b1 = (+c_1) - (+d_1);
		var b2 = (+c_2) - (+d_2);
		var b3 = (+c_3) - (+d_3);
		
		$('#b1').val(b1.toString().substring(0, b1.toString().indexOf(".") + 3));
		$('#b2').val(b2.toString().substring(0, b2.toString().indexOf(".") + 3));
		$('#b3').val(b3.toString().substring(0, b3.toString().indexOf(".") + 3));
	});
	$('#c1').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		var b_1 = $('#b1').val();
		var b_2 = $('#b2').val();
		var b_3 = $('#b3').val();
		
		var d1 = (+c_1) - (+b_1);
		var d2 = (+c_2) - (+b_2);
		var d3 = (+c_3) - (+b_3);
		
		$('#d1').val(d1.toFixed(1));
		$('#d2').val(d2.toFixed(1));
		$('#d3').val(d3.toFixed(1));
		
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		
	});
	$('#c2').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		var b_1 = $('#b1').val();
		var b_2 = $('#b2').val();
		var b_3 = $('#b3').val();
		
		var d1 = (+c_1) - (+b_1);
		var d2 = (+c_2) - (+b_2);
		var d3 = (+c_3) - (+b_3);
		
		$('#d1').val(d1.toFixed(1));
		$('#d2').val(d2.toFixed(1));
		$('#d3').val(d3.toFixed(1));
		
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
	});
	$('#c3').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		var b_1 = $('#b1').val();
		var b_2 = $('#b2').val();
		var b_3 = $('#b3').val();
		
		var d1 = (+c_1) - (+b_1);
		var d2 = (+c_2) - (+b_2);
		var d3 = (+c_3) - (+b_3);
		
		$('#d1').val(d1.toFixed(1));
		$('#d2').val(d2.toFixed(1));
		$('#d3').val(d3.toFixed(1));
		
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
	});
	
	
	$('#d1').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		
		var b1 = (+c_1) - (+d_1);
		var b2 = (+c_2) - (+d_2);
		var b3 = (+c_3) - (+d_3);
		
		$('#b1').val(b1.toFixed(1));
		$('#b2').val(b2.toFixed(1));
		$('#b3').val(b3.toFixed(1));
		
		
	});
	$('#d2').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		
		var b1 = (+c_1) - (+d_1);
		var b2 = (+c_2) - (+d_2);
		var b3 = (+c_3) - (+d_3);
		
		$('#b1').val(b1.toFixed(1));
		$('#b2').val(b2.toFixed(1));
		$('#b3').val(b3.toFixed(1));
	});
	$('#d3').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		
		var b1 = (+c_1) - (+d_1);
		var b2 = (+c_2) - (+d_2);
		var b3 = (+c_3) - (+d_3);
		
		$('#b1').val(b1.toFixed(1));
		$('#b2').val(b2.toFixed(1));
		$('#b3').val(b3.toFixed(1));
	});
	
	
	
	$('#a1').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		
		
	});
	$('#a2').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
	});
	$('#a3').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		
	});
	
	$('#b1').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		var b_1 = $('#b1').val();
		var b_2 = $('#b2').val();
		var b_3 = $('#b3').val();
		
		var d1 = (+c_1) - (+b_1);
		var d2 = (+c_2) - (+b_2);
		var d3 = (+c_3) - (+b_3);
		
		$('#d1').val(d1.toFixed(1));
		$('#d2').val(d2.toFixed(1));
		$('#d3').val(d3.toFixed(1));
		
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
		
		
	});
	$('#b2').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		var b_1 = $('#b1').val();
		var b_2 = $('#b2').val();
		var b_3 = $('#b3').val();
		
		var d1 = (+c_1) - (+b_1);
		var d2 = (+c_2) - (+b_2);
		var d3 = (+c_3) - (+b_3);
		
		$('#d1').val(d1.toFixed(1));
		$('#d2').val(d2.toFixed(1));
		$('#d3').val(d3.toFixed(1));
		
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
	});
	$('#b3').change(function(){
		$('#txtcdm').css("background-color","var(--success)");	
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		
		var b_1 = $('#b1').val();
		var b_2 = $('#b2').val();
		var b_3 = $('#b3').val();
		
		var d1 = (+c_1) - (+b_1);
		var d2 = (+c_2) - (+b_2);
		var d3 = (+c_3) - (+b_3);
		
		$('#d1').val(d1.toFixed(1));
		$('#d2').val(d2.toFixed(1));
		$('#d3').val(d3.toFixed(1));
		
		var d_1 = $('#d1').val();
		var d_2 = $('#d2').val();
		var d_3 = $('#d3').val();
		
		var a_1 = $('#a1').val();
		var a_2 = $('#a2').val();
		var a_3 = $('#a3').val();
		
		var e1 = (+a_1)/(+d_1);
		var e2 = (+a_2)/(+d_2);
		var e3 = (+a_3)/(+d_3);
		
		$('#e1').val(e1.toFixed(3));
		$('#e2').val(e2.toFixed(3));
		$('#e3').val(e3.toFixed(3));
		
		var e_1 = $('#e1').val();
		var e_2 = $('#e2').val();
		var e_3 = $('#e3').val();
		
		var avg_density = ((+e_1) + (+e_2) + (+e_3))/3;
		$('#avg_density').val(avg_density.toFixed(3));
	});
	
	
	
function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}
	
		
	
	var b11;
	var b12;
	var b21;
	var b22;
	var b31;
	var b32;
	var b41;
	var b42;
	var b51;
	var b52;
	var b61;
	var b62;
	var b71;
	var b72;
	var b81;
	var b82;
	
	var per_bin1;	
	var per_bin2;	
	var avg_bin;	
	
	function bin_auto()
	{
		var grades = $('#type_sample').val();
			if(grades=="BC-I")
			{
				
				var avgbin = randomNumberFromRange(5.22,5.27).toFixed(2);
				
				$('#avg_bin').val(avgbin);
				
				var avg_bin1 = $('#avg_bin').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) - (+tmp);
				var per_bin2 = (+avg_bin1) + (+tmp);
				
				}
				else{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) + (+tmp);
				var per_bin2 = (+avg_bin1) - (+tmp);	
				
				}
									
				
			}
			else if(grades=="BC-II")
			{
				var avgbin = randomNumberFromRange(5.42,5.47).toFixed(2);
				
				$('#avg_bin').val(avgbin);
				
				var avg_bin1 = $('#avg_bin').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) - (+tmp);
				var per_bin2 = (+avg_bin1) + (+tmp);
				
				}
				else{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) + (+tmp);
				var per_bin2 = (+avg_bin1) - (+tmp);	
				
				}
					
			}
			else if(grades=="DBM-I")
			{
				var avgbin = randomNumberFromRange(4.05,4.12).toFixed(2);
				
				$('#avg_bin').val(avgbin);
				
				var avg_bin1 = $('#avg_bin').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) - (+tmp);
				var per_bin2 = (+avg_bin1) + (+tmp);
				
				}
				else{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) + (+tmp);
				var per_bin2 = (+avg_bin1) - (+tmp);	
				
				}
			}
			else if(grades=="DBM-II")
			{
				var avgbin = randomNumberFromRange(4.53,4.62).toFixed(3);
				
				$('#avg_bin').val(avgbin);
				
				var avg_bin1 = $('#avg_bin').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) - (+tmp);
				var per_bin2 = (+avg_bin1) + (+tmp);
				
				}
				else{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) + (+tmp);
				var per_bin2 = (+avg_bin1) - (+tmp);	
				
				}
			}
			else if(grades=="SDBC-I")
			{
				var avgbin = randomNumberFromRange(5.02,5.18).toFixed(2);
				
				$('#avg_bin').val(avgbin);
				
				var avg_bin1 = $('#avg_bin').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) - (+tmp);
				var per_bin2 = (+avg_bin1) + (+tmp);
				
				}
				else{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) + (+tmp);
				var per_bin2 = (+avg_bin1) - (+tmp);	
				
				}
			}
			else if(grades=="SDBC-II")
			{
				var avgbin = randomNumberFromRange(5.52,5.67).toFixed(2);
				
				$('#avg_bin').val(avgbin);
				
				var avg_bin1 = $('#avg_bin').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) - (+tmp);
				var per_bin2 = (+avg_bin1) + (+tmp);
				
				}
				else{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin1) + (+tmp);
				var per_bin2 = (+avg_bin1) - (+tmp);	
				
				}
			}
			
			$('#per_bin1').val(per_bin1.toFixed(2));
			$('#per_bin2').val(per_bin2.toFixed(2))
			var per_bin_1 = $('#per_bin1').val();
			var per_bin_2 = $('#per_bin2').val();
			
			var b11 = 921;
			var b12 = 921;
			$('#b11').val(b11);
			$('#b12').val(b12);
			var b21 = randomNumberFromRange(3.000,3.200).toFixed(3);
			var b22 = randomNumberFromRange(3.000,3.200).toFixed(3);
			$('#b21').val(b21);
			$('#b22').val(b22);
			var b_21 = $('#b21').val(); 
			var b_22 = $('#b22').val(); 
			var b31 = 700;
			var b32 = 700;
			$('#b31').val(b31);
			$('#b32').val(b32);
			
			var rnad1 = randomNumberFromRange(0.300,0.700).toFixed(3);
			var rnad2 = randomNumberFromRange(0.300,0.700).toFixed(3);
			var b41 = (+b_21) + (+rnad1);
			var b42 = (+b_22) + (+rnad2);
			$('#b41').val(b41.toFixed(3));
			$('#b42').val(b42.toFixed(3));
			var b_41 = $('#b41').val();
			var b_42 = $('#b42').val();
			
			var tt1 = (+b31) * (+per_bin_1);
			var tt2 = (+b32) * (+per_bin_2);
			
			var b81 = (+tt1) / 100;
			var b82 = (+tt2) / 100;
			//alert(tt1);
			//alert(tt2);
			$('#b81').val(b81.toFixed(1));
			$('#b82').val(b82.toFixed(1));
			var b_81 = $('#b81').val();
			var b_82 = $('#b82').val();
			
			var b61 = (+b_41) - (+b_21);
			var b62 = (+b_42) - (+b_22);
			
			$('#b61').val(b61.toFixed(2));
			$('#b62').val(b62.toFixed(2));
			var b_61 = $('#b61').val();
			var b_62 = $('#b62').val();
			
			var b71 = (+b31) - (+b_81);
			var b72 = (+b32) - (+b_82);
			$('#b71').val(b71.toFixed(1));
			$('#b72').val(b72.toFixed(1));
			var b_71 = $('#b71').val();
			var b_72 = $('#b72').val();
			
			var b51 = (+b_71) - (+b_61);
			var b52 = (+b_72) - (+b_62);
			$('#b51').val(b51.toFixed(1));
			$('#b52').val(b52.toFixed(1));
			
			var b1_1 = $('#b11').val();
			var b1_2 = $('#b12').val();
			
			var b2_1 = $('#b21').val();
			var b2_2 = $('#b22').val();
			
			var b3_1 = $('#b31').val();
			var b3_2 = $('#b32').val();
			
			var b4_1 = $('#b41').val();
			var b4_2 = $('#b42').val();								
			
			var b5_1 = $('#b51').val();
			var b5_2 = $('#b52').val();
			
			var b_6_1 = (+b4_1) - (+b2_1);
			var b_6_2 = (+b4_2) - (+b2_2); 
			$('#b61').val(b_6_1.toFixed(2));
			$('#b62').val(b_6_2.toFixed(2));
			var b6_1 = $('#b61').val();
			var b6_2 = $('#b62').val();
			
			var temp1 = (+b5_1) + (+b6_1);
			var temp2 = (+b5_2) + (+b6_2);
			$('#b71').val(temp1.toFixed(1));
			$('#b72').val(temp2.toFixed(1));
			var b7_1 = $('#b71').val();
			var b7_2 = $('#b72').val();
			
			var tm1 = (+b3_1) - (+b7_1);
			var tm2 = (+b3_2) - (+b7_2);
			$('#b81').val(tm1.toFixed(1));
			$('#b82').val(tm2.toFixed(1));
			var b8_1 = $('#b81').val();
			var b8_2 = $('#b82').val();
			
			var ans1 = ((+b8_1)/(+b3_1))*100;
			var ans2 = ((+b8_2)/(+b3_2))*100;
			$('#per_bin1').val(ans1.toFixed(2));
			$('#per_bin2').val(ans2.toFixed(2));
			var as1 = $('#per_bin1').val();
			var as2 = $('#per_bin2').val();
			
			var abgs = ((+as1) + (+as2)) / (+2);
			
			$('#avg_bin').val(abgs.toFixed(2));
	}
	
	$('#chk_bin').change(function(){
        if(this.checked)
		{  
			bin_auto();
			
			
			
			
		}
		else
		{
			$('#per_bin1').val(null);
			$('#per_bin2').val(null);
			$('#per_bin').val(null);
			$('#avg_bin').val(null);
			$('#b11').val(null);
			$('#b12').val(null);
			$('#b21').val(null);
			$('#b22').val(null);
			$('#b31').val(null);
			$('#b32').val(null);
			$('#b41').val(null);
			$('#b42').val(null);
			$('#b51').val(null);
			$('#b52').val(null);
			$('#b61').val(null);
			$('#b62').val(null);
			$('#b71').val(null);
			$('#b72').val(null);
			$('#b81').val(null);
			$('#b82').val(null);
			
		
		}
	});
	
	

	$('#avg_bin').change(function(){
		
		if ($("#chk_bin").is(':checked')) {
						
				var avg_bin = $('#avg_bin').val(); 
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin) - (+tmp);
				var per_bin2 = (+avg_bin) + (+tmp);
				
				}
				else{
				var tmp = randomNumberFromRange(-0.02,0.02).toFixed(2);
				var per_bin1 = (+avg_bin) + (+tmp);
				var per_bin2 = (+avg_bin) - (+tmp);	
				
				}
				
				$('#per_bin1').val(per_bin1.toFixed(2));
				$('#per_bin2').val(per_bin2.toFixed(2))
				var per_bin_1 = $('#per_bin1').val();
				var per_bin_2 = $('#per_bin2').val();
				
				var b11 = 921;
				var b12 = 921;
				$('#b11').val(b11);
				$('#b12').val(b12);
				var b21 = randomNumberFromRange(3.000,3.200).toFixed(3);
				var b22 = randomNumberFromRange(3.000,3.200).toFixed(3);
				$('#b21').val(b21);
				$('#b22').val(b22);
				var b_21 = $('#b21').val(); 
				var b_22 = $('#b22').val(); 
				var b31 = 700;
				var b32 = 700;
				$('#b31').val(b31);
				$('#b32').val(b32);
				
				var rnad1 = randomNumberFromRange(0.300,0.700).toFixed(3);
				var rnad2 = randomNumberFromRange(0.300,0.700).toFixed(3);
				var b41 = (+b_21) + (+rnad1);
				var b42 = (+b_22) + (+rnad2);
				$('#b41').val(b41.toFixed(3));
				$('#b42').val(b42.toFixed(3));
				var b_41 = $('#b41').val();
				var b_42 = $('#b42').val();
				
				var tt1 = (+b31) * (+per_bin_1);
				var tt2 = (+b32) * (+per_bin_2);
				
				var b81 = (+tt1) / 100;
				var b82 = (+tt2) / 100;
				//alert(tt1);
				//alert(tt2);
				$('#b81').val(b81.toFixed(1));
				$('#b82').val(b82.toFixed(1));
				var b_81 = $('#b81').val();
				var b_82 = $('#b82').val();
				
				var b61 = (+b_41) - (+b_21);
				var b62 = (+b_42) - (+b_22);
				
				$('#b61').val(b61.toFixed(2));
				$('#b62').val(b62.toFixed(2));
				var b_61 = $('#b61').val();
				var b_62 = $('#b62').val();
				
				var b71 = (+b31) - (+b_81);
				var b72 = (+b32) - (+b_82);
				$('#b71').val(b71.toFixed(1));
				$('#b72').val(b72.toFixed(1));
				var b_71 = $('#b71').val();
				var b_72 = $('#b72').val();
				
				var b51 = (+b_71) - (+b_61);
				var b52 = (+b_72) - (+b_62);
				$('#b51').val(b51.toFixed(1));
				$('#b52').val(b52.toFixed(1));
				
				var b1_1 = $('#b11').val();
				var b1_2 = $('#b12').val();
				
				var b2_1 = $('#b21').val();
				var b2_2 = $('#b22').val();
				
				var b3_1 = $('#b31').val();
				var b3_2 = $('#b32').val();
				
				var b4_1 = $('#b41').val();
				var b4_2 = $('#b42').val();								
				
				var b5_1 = $('#b51').val();
				var b5_2 = $('#b52').val();
				
				var b_6_1 = (+b4_1) - (+b2_1);
				var b_6_2 = (+b4_2) - (+b2_2); 
				$('#b61').val(b_6_1.toFixed(2));
				$('#b62').val(b_6_2.toFixed(2));
				var b6_1 = $('#b61').val();
				var b6_2 = $('#b62').val();
				
				var temp1 = (+b5_1) + (+b6_1);
				var temp2 = (+b5_2) + (+b6_2);
				$('#b71').val(temp1.toFixed(1));
				$('#b72').val(temp2.toFixed(1));
				var b7_1 = $('#b71').val();
				var b7_2 = $('#b72').val();
				
				var tm1 = (+b3_1) - (+b7_1);
				var tm2 = (+b3_2) - (+b7_2);
				$('#b81').val(tm1.toFixed(1));
				$('#b82').val(tm2.toFixed(1));
				var b8_1 = $('#b81').val();
				var b8_2 = $('#b82').val();
				
				var ans1 = ((+b8_1)/(+b3_1))*100;
				var ans2 = ((+b8_2)/(+b3_2))*100;
				$('#per_bin1').val(ans1.toFixed(2));
				$('#per_bin2').val(ans2.toFixed(2));
				var as1 = $('#per_bin1').val();
				var as2 = $('#per_bin2').val();
				
				var abgs = ((+as1) + (+as2)) / (+2);
				
				$('#avg_bin').val(abgs.toFixed(2));
				
				
			
		}
		
		
	});
	
	$('#b11').change(function(){
		b1_b2_b3_b4_b5();
	});
	$('#b12').change(function(){
		b1_b2_b3_b4_b5();
	});
	$('#b21').change(function(){
		b1_b2_b3_b4_b5();
	});
	$('#b22').change(function(){
		b1_b2_b3_b4_b5();
	});
	$('#b31').change(function(){
		b1_b2_b3_b4_b5();
	});
	$('#b32').change(function(){
		b1_b2_b3_b4_b5();
	});
	$('#b41').change(function(){
		b1_b2_b3_b4_b5();
	});
	$('#b42').change(function(){
		b1_b2_b3_b4_b5();
	});
	$('#b51').change(function(){
		b1_b2_b3_b4_b5();
	});
	$('#b52').change(function(){
		b1_b2_b3_b4_b5();
	});
	
	function b1_b2_b3_b4_b5()
	{
		$('#txtbin').css("background-color","var(--success)");
		var b_11 = $('#b11').val(); 
		var b_12 = $('#b12').val();
		var b_21 = $('#b21').val(); 
		var b_22 = $('#b22').val();
		var b_31 = $('#b31').val(); 
		var b_32 = $('#b32').val(); 
		var b_41 = $('#b41').val(); 
		var b_42 = $('#b42').val(); 
		var b_51 = $('#b51').val(); 
		var b_52 = $('#b52').val(); 
		
		var b61 = (+b_41)-(+b_21);		
		var b62 = (+b_42)-(+b_22);
		
		$('#b61').val(b61.toFixed(2));
		$('#b62').val(b62.toFixed(2));
		var b_61 = $('#b61').val();
		var b_62 = $('#b62').val();
		
		var b71 = (+b_51) + (+b_61);
		var b72 = (+b_52) + (+b_62);
		$('#b71').val(b71.toFixed(1));
		$('#b72').val(b72.toFixed(1));
		var b_71 = $('#b71').val();
		var b_72 = $('#b72').val();
		
		var b81 = (+b_31) - (+b_71);
		var b82 = (+b_32) - (+b_72);

		$('#b81').val(b81.toFixed(1));
		$('#b82').val(b82.toFixed(1));
		var b_81 = $('#b81').val();
		var b_82 = $('#b82').val();
		
		var per_bin1 = ((+b_81)/(+b_31))*100;
		var per_bin2 = ((+b_82)/(+b_32))*100;
		
		$('#per_bin1').val(per_bin1.toFixed(2));
		$('#per_bin2').val(per_bin2.toFixed(2));
		var per_bin_1 = $('#per_bin1').val();
		var per_bin_2 = $('#per_bin2').val();
		
		var avg_bin = ((+per_bin_1)+(+per_bin_2))/2;
		$('#avg_bin').val(avg_bin.toFixed(2));
		
		
		
	}
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--success)"); 
			//$('#txtwtr').css("background-color","var(--success)"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				//MSF
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="msf")
					{
						$('#txtmsf').css("background-color","var(--success)");
						$("#chk_msf").prop("checked", true); 
						msf_auto();
						break;
					}					
				}
				
				//cdm
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cdm")
					{
						$('#txtcdm').css("background-color","var(--success)");
						$("#chk_cdm").prop("checked", true); 
						cdm_auto()
						break;
					}					
				}
		
				//SETTING TIME
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bin")
					{
						$('#txtbin').css("background-color","var(--success)");
						$("#chk_bin").prop("checked", true); 
						bin_auto();
						break;
					}					
				}
				
				
		
		}
		
	});

	
	
	(function($) {
    $.rand = function(arg) {
        if ($.isArray(arg)) {
            return arg[$.rand(arg.length)];
        } else if (typeof arg === "number") {
            return Math.floor(Math.random() * arg);
        } else {
            return 4;  // chosen by fair dice roll
        }
    };
})(jQuery);
	
	
	
});


	
	
		$("#btn_upload_excel").click(function()
		{
			form_data = new FormData();
				var acb = $('#upload_excel').val();
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
        url: '<?php echo $base_url; ?>save_bitumin_mix.php',
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
				var Location_1 = $('#Location_1').val();
				/*var tank_no = $('#tank_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var bitumin_make = $('#bitumin_make').val();*/
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//MARSHALL
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="msf")
					{
						if(document.getElementById('chk_msf').checked) {
								var chk_msf = "1";
						}
						else{
								var chk_msf = "0";
						}	
							
																				
							var ms_11 = $('#ms_11').val();
							var ms_12 = $('#ms_12').val();
							var ms_13 = $('#ms_13').val();
							var ms_21 = $('#ms_21').val();
							var ms_22 = $('#ms_22').val();
							var ms_23 = $('#ms_23').val();
							var ms_31 = $('#ms_31').val();
							var ms_32 = $('#ms_32').val();
							var ms_33 = $('#ms_33').val();
							var avg_stabilty = $('#avg_stabilty').val();
							var avg_flow = $('#avg_flow').val();
						
						break;
					}
					else
					{
							var chk_msf = "0";
							var avg_stabilty = "0";
							var avg_flow = "0";
							var ms_11 = "0";
							var ms_12 = "0";
							var ms_13 = "0";
							var ms_21 = "0";
							var ms_22 = "0";
							var ms_23 = "0";
							var ms_31 = "0";
							var ms_32 = "0";
							var ms_33 = "0";
					}
														
				}
				
				//DENSITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cdm")
					{
						if(document.getElementById('chk_cdm').checked) {
								var chk_cdm = "1";
						}
						else{
								var chk_cdm = "0";
						}	
							
																			
							var s1 = $('#s1').val();
							var s2 = $('#s2').val();
							var s3 = $('#s3').val();
							var a1 = $('#a1').val();
							var a2 = $('#a2').val();
							var a3 = $('#a3').val();
							var b1 = $('#b1').val();
							var b2 = $('#b2').val();
							var b3 = $('#b3').val();
							var c1 = $('#c1').val();
							var c2 = $('#c2').val();
							var c3 = $('#c3').val();
							var d1 = $('#d1').val();
							var d2 = $('#d2').val();
							var d3 = $('#d3').val();
							var e1 = $('#e1').val();
							var e2 = $('#e2').val();
							var e3 = $('#e3').val();							
							var avg_density = $('#avg_density').val();
						
						break;
					}
					else
					{
							var chk_cdm = "0";
							var avg_density = "0";
							var s1 = "0";
							var s2 = "0";
							var s3 = "0";
							var a1 = "0";
							var a2 = "0";
							var a3 = "0";
							var b1 = "0";
							var b2 = "0";
							var b3 = "0";
							var c1 = "0";
							var c2 = "0";
							var c3 = "0";
							var d1 = "0";
							var d2 = "0";
							var d3 = "0";
							var e1 = "0";
							var e2 = "0";
							var e3 = "0";
							
					}
														
				}

				
				// BINDER CONTENT
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bin")
					{
						
							if(document.getElementById('chk_bin').checked) {
									var chk_bin = "1";
							}
							else{
									var chk_bin = "0";
							}
						
							var b11 = $('#b11').val();
							var b12 = $('#b12').val();
							var b21 = $('#b21').val();
							var b22 = $('#b22').val();
							var b31 = $('#b31').val();
							var b32 = $('#b32').val();
							var b41 = $('#b41').val();
							var b42 = $('#b42').val();
							var b51 = $('#b51').val();
							var b52 = $('#b52').val();
							var b61 = $('#b61').val();
							var b62 = $('#b62').val();
							var b71 = $('#b71').val();
							var b72 = $('#b72').val();
							var b81 = $('#b81').val();
							var b82 = $('#b82').val();
							
							var per_bin1 = $('#per_bin1').val();
							var per_bin2 = $('#per_bin2').val();
							var avg_bin = $('#avg_bin').val();
														
							break;
					}
					else
					{
						var chk_bin = "0";	
						var per_bin1 = "0";	
						var per_bin2 = "0";	
						var avg_bin = "0";	
						var b11 = "0";	
						var b12 = "0";	
						var b21 = "0";	
						var b22 = "0";	
						var b31 = "0";	
						var b32 = "0";	
						var b41 = "0";	
						var b42 = "0";	
						var b51 = "0";	
						var b52 = "0";	
						var b61 = "0";	
						var b62 = "0";	
						var b71 = "0";	
						var b72 = "0";	
						var b81 = "0";	
						var b82 = "0";	
					}

				}
				
				
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_msf='+chk_msf+'&ms_11='+ms_11+'&ms_12='+ms_12+'&ms_13='+ms_13+'&ms_21='+ms_21+'&ms_22='+ms_22+'&ms_23='+ms_23+'&ms_31='+ms_31+'&ms_32='+ms_32+'&ms_33='+ms_33+'&avg_stabilty='+avg_stabilty+'&avg_flow='+avg_flow+'&chk_cdm='+chk_cdm+'&avg_density='+avg_density+'&s1='+s1+'&s2='+s2+'&s3='+s3+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&e1='+e1+'&e2='+e2+'&e3='+e3+'&chk_bin='+chk_bin+'&per_bin1='+per_bin1+'&per_bin2='+per_bin2+'&avg_bin='+avg_bin+'&b11='+b11+'&b12='+b12+'&b21='+b21+'&b22='+b22+'&b31='+b31+'&b32='+b32+'&b41='+b41+'&b42='+b42+'&b51='+b51+'&b52='+b52+'&b61='+b61+'&b62='+b62+'&b71='+b71+'&b72='+b72+'&b81='+b81+'&b82='+b82+'&ulr='+ulr+'&Location_1='+Location_1;
						
	}
	else if (type == 'edit'){
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				var Location_1 = $('#Location_1').val();
				/* var tank_no = $('#tank_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var bitumin_make = $('#bitumin_make').val();
				 */
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//MARSHALL
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="msf")
					{
						if(document.getElementById('chk_msf').checked) {
								var chk_msf = "1";
						}
						else{
								var chk_msf = "0";
						}	
							
																				
							var ms_11 = $('#ms_11').val();
							var ms_12 = $('#ms_12').val();
							var ms_13 = $('#ms_13').val();
							var ms_21 = $('#ms_21').val();
							var ms_22 = $('#ms_22').val();
							var ms_23 = $('#ms_23').val();
							var ms_31 = $('#ms_31').val();
							var ms_32 = $('#ms_32').val();
							var ms_33 = $('#ms_33').val();
							var avg_stabilty = $('#avg_stabilty').val();
							var avg_flow = $('#avg_flow').val();
						
						break;
					}
					else
					{
							var chk_msf = "0";
							var avg_stabilty = "0";
							var avg_flow = "0";
							var ms_11 = "0";
							var ms_12 = "0";
							var ms_13 = "0";
							var ms_21 = "0";
							var ms_22 = "0";
							var ms_23 = "0";
							var ms_31 = "0";
							var ms_32 = "0";
							var ms_33 = "0";
					}
														
				}
				
				//DENSITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cdm")
					{
						if(document.getElementById('chk_cdm').checked) {
								var chk_cdm = "1";
						}
						else{
								var chk_cdm = "0";
						}	
							
																			
							var s1 = $('#s1').val();
							var s2 = $('#s2').val();
							var s3 = $('#s3').val();
							var a1 = $('#a1').val();
							var a2 = $('#a2').val();
							var a3 = $('#a3').val();
							var b1 = $('#b1').val();
							var b2 = $('#b2').val();
							var b3 = $('#b3').val();
							var c1 = $('#c1').val();
							var c2 = $('#c2').val();
							var c3 = $('#c3').val();
							var d1 = $('#d1').val();
							var d2 = $('#d2').val();
							var d3 = $('#d3').val();
							var e1 = $('#e1').val();
							var e2 = $('#e2').val();
							var e3 = $('#e3').val();							
							var avg_density = $('#avg_density').val();
						
						break;
					}
					else
					{
							var chk_cdm = "0";
							var avg_density = "0";
							var s1 = "0";
							var s2 = "0";
							var s3 = "0";
							var a1 = "0";
							var a2 = "0";
							var a3 = "0";
							var b1 = "0";
							var b2 = "0";
							var b3 = "0";
							var c1 = "0";
							var c2 = "0";
							var c3 = "0";
							var d1 = "0";
							var d2 = "0";
							var d3 = "0";
							var e1 = "0";
							var e2 = "0";
							var e3 = "0";
							
					}
														
				}

				
				// BINDER CONTENT
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bin")
					{
						
							if(document.getElementById('chk_bin').checked) {
									var chk_bin = "1";
							}
							else{
									var chk_bin = "0";
							}
						
							var b11 = $('#b11').val();
							var b12 = $('#b12').val();
							var b21 = $('#b21').val();
							var b22 = $('#b22').val();
							var b31 = $('#b31').val();
							var b32 = $('#b32').val();
							var b41 = $('#b41').val();
							var b42 = $('#b42').val();
							var b51 = $('#b51').val();
							var b52 = $('#b52').val();
							var b61 = $('#b61').val();
							var b62 = $('#b62').val();
							var b71 = $('#b71').val();
							var b72 = $('#b72').val();
							var b81 = $('#b81').val();
							var b82 = $('#b82').val();
							
							var per_bin1 = $('#per_bin1').val();
							var per_bin2 = $('#per_bin2').val();
							var avg_bin = $('#avg_bin').val();
														
							break;
					}
					else
					{
						var chk_bin = "0";	
						var per_bin1 = "0";	
						var per_bin2 = "0";	
						var avg_bin = "0";	
						var b11 = "0";	
						var b12 = "0";	
						var b21 = "0";	
						var b22 = "0";	
						var b31 = "0";	
						var b32 = "0";	
						var b41 = "0";	
						var b42 = "0";	
						var b51 = "0";	
						var b52 = "0";	
						var b61 = "0";	
						var b62 = "0";	
						var b71 = "0";	
						var b72 = "0";	
						var b81 = "0";	
						var b82 = "0";	
					}

				}
			
				
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_msf='+chk_msf+'&ms_11='+ms_11+'&ms_12='+ms_12+'&ms_13='+ms_13+'&ms_21='+ms_21+'&ms_22='+ms_22+'&ms_23='+ms_23+'&ms_31='+ms_31+'&ms_32='+ms_32+'&ms_33='+ms_33+'&avg_stabilty='+avg_stabilty+'&avg_flow='+avg_flow+'&chk_cdm='+chk_cdm+'&avg_density='+avg_density+'&s1='+s1+'&s2='+s2+'&s3='+s3+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&e1='+e1+'&e2='+e2+'&e3='+e3+'&chk_bin='+chk_bin+'&per_bin1='+per_bin1+'&per_bin2='+per_bin2+'&avg_bin='+avg_bin+'&b11='+b11+'&b12='+b12+'&b21='+b21+'&b22='+b22+'&b31='+b31+'&b32='+b32+'&b41='+b41+'&b42='+b42+'&b51='+b51+'&b52='+b52+'&b61='+b61+'&b62='+b62+'&b71='+b71+'&b72='+b72+'&b81='+b81+'&b82='+b82+'&ulr='+ulr+'&Location_1='+Location_1;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_bitumin_mix.php',
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
        url: '<?php echo $base_url; ?>save_bitumin_mix.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
            $('#Location_1').val(data.Location_1);
            /* $('#tank_no').val(data.tank_no);
            $('#lot_no').val(data.lot_no);
            $('#bitumin_grade').val(data.bitumin_grade);
            $('#bitumin_make').val(data.bitumin_make); */
			
            var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//MARSHALL
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="msf")
					{
						
						var chk_msf = data.chk_msf;
						if(chk_msf=="1")
						{
							$('#txtmsf').css("background-color","var(--success)");	
						   $("#chk_msf").prop("checked", true); 
						 
						}else{
							$('#txtmsf').css("background-color","white");	
							$("#chk_msf").prop("checked", false);
						
						}
								//GRADATION DATA FETCH-1
						$('#avg_stabilty').val(data.avg_stabilty);
						$('#avg_flow').val(data.avg_flow);
						$('#ms_11').val(data.ms_11);
						$('#ms_12').val(data.ms_12);
						$('#ms_13').val(data.ms_13);
						$('#ms_21').val(data.ms_21);
						$('#ms_22').val(data.ms_22);
						$('#ms_23').val(data.ms_23);
						$('#ms_31').val(data.ms_31);
						$('#ms_32').val(data.ms_32);
						$('#ms_33').val(data.ms_33);
						
						
						break;
					}
					else
					{
						
					}
														
				}
			
			
				//CDM
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cdm")
					{
						
						var chk_cdm = data.chk_cdm;
						if(chk_cdm=="1")
						{
							$('#txtcdm').css("background-color","var(--success)");	
						   $("#chk_cdm").prop("checked", true); 
						 
						}else{
							$('#txtcdm').css("background-color","white");	
							$("#chk_cdm").prop("checked", false);
						
						}
								//GRADATION DATA FETCH-1
						$('#avg_density').val(data.avg_density);
						
						$('#s1').val(data.s1);
						$('#s2').val(data.s2);
						$('#s3').val(data.s3);
						$('#a1').val(data.a1);
						$('#a2').val(data.a2);
						$('#a3').val(data.a3);
						$('#b1').val(data.b1);
						$('#b2').val(data.b2);
						$('#b3').val(data.b3);
						$('#c1').val(data.c1);
						$('#c2').val(data.c2);
						$('#c3').val(data.c3);
						$('#d1').val(data.d1);
						$('#d2').val(data.d2);
						$('#d3').val(data.d3);
						$('#e1').val(data.e1);
						$('#e2').val(data.e2);
						$('#e3').val(data.e3);	
						break;
					}
					else
					{	
					}										
				}
			
				
				//Binder 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bin")
					{	var chk_bin = data.chk_bin;
							if(chk_bin=="1")
							{
								$('#txtbin').css("background-color","var(--success)");	
							   $("#chk_bin").prop("checked", true); 
							}else{
								$('#txtbin').css("background-color","white");	
								$("#chk_bin").prop("checked", false); 
							}
						//specific gravity
						$('#per_bin1').val(data.per_bin1);
						$('#per_bin2').val(data.per_bin2);
						$('#avg_bin').val(data.avg_bin);
						$('#b11').val(data.b11);
						$('#b12').val(data.b12);
						$('#b21').val(data.b21);
						$('#b22').val(data.b22);	
						$('#b31').val(data.b31);
						$('#b32').val(data.b32);	
						$('#b41').val(data.b41);
						$('#b42').val(data.b42);		
						$('#b51').val(data.b51);
						$('#b52').val(data.b52);
						$('#b61').val(data.b61);
						$('#b62').val(data.b62);														
						$('#b71').val(data.b71);
						$('#b72').val(data.b72);														
						$('#b81').val(data.b81);
						$('#b82').val(data.b82);														
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
	
	
	</script>