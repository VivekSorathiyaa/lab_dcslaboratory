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
							<h2  style="text-align:center;">Bitumen</h2>
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
											<input type="text" class="form-control inputs" tabindex="4" id="" value="<?php echo $job_no;?>" name="lab_no" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no;?>" name="lab_no" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">Bitumin Grade.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="bitumin_grade" value="<?php echo $bitumin_grade;?>" name="bitumin_grade" ReadOnly>
										</div>
									</div>
								</div>
							</div>
							<br>
							<br>
							<div class="row">
								<div class="col-lg-10">
									<div class="form-group">
										<div class="col-sm-3">
											<label>Sample Description.:</label>
										</div>
										<div class="col-sm-3">
											<input type="text" name="s_des" id="s_des">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-3">
											<label>Residual Sample.:</label>
										</div> 
										<div class="col-sm-3">
											<input type="text" name="r_sam"  id="r_sam">
										</div>
									</div>
								</div>
								</div>
								<div class="row">
								<div class="col-lg-10">
									<div class="form-group">
										<div class="col-sm-3">
											<label> Sample Retention.:</label>
										</div>
										<div class="col-sm-3">
											<input type="text"  name="s_ret" id="s_ret">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-3">
											<label>qty.:</label>
										</div>
									    <div class="col-sm-3">
											<input type="text"  name="qty_1" id="qty_1">
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
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $_SESSION['fy_ulr_no'].$ulr;?>" name="ulr" readonly>
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
										<div class="col-sm-1">
											<!-- SAVE BUTTON LOGIC VAIBHAV-->
											<?php   
												$querys_job1 = "SELECT * FROM bitumin_span WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										//if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
										?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_bitumin.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div><!--
										<div class="col-sm-2">
 													<a target='_blank' href="<?php echo $base_url; ?>back_cal_report_blank/print_bitumin.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&ulr=<?php echo $ulr; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Blank</b></a>

 												</div>-->
										<?php //} ?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/bitumin_back.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Sheet</b></a>
											
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
							
									<div class="col-md-3">
									<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no;?>&&reports_nos=<?php echo $report_no;?>&&lab_no=<?php echo $lab_no;?>">Row Data</a>
								</div>
								<div class="col-md-3">
									<label for="inputEmail3" class="col-md-12 control-label">Upload Excel :</label>
								</div>
								<div class="col-md-3">
									<input type="file" class="form-control" id="upload_excel" name="upload_excel" >
								</div>
								<div class="col-md-3">
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
			<br>
		</div>	
		<?php }	 ?>	  	

							<?php
					$test_check;
					$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
						$result_select1 = mysqli_query($conn, $select_query1);
						while($r1 = mysqli_fetch_array($result_select1)){
							
							if($r1['test_code']=="pen")
							{
								
								$test_check.="pen,";
			?>
						<div class="panel panel-default" id="pen">
					<div class="panel-heading" id="txtpen">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
								<h4 class="panel-title">
								<b>PENETRATION</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse5" class="panel-collapse collapse">
						<div class="panel-body">
							<br>
							<div class="row">									
								
								<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_pen">1.</label>
													<input type="checkbox" class="visually-hidden" name="chk_pen"  id="chk_pen" value="chk_pen"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">PENETRATION</label>
										</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature :</label>-->
											<div class="col-sm-8">
												<input type="hidden" class="form-control" id="pen_temp" name="pen_temp" >
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
											<label for="inputEmail3" class="col-sm-12 control-label">I</label>
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">II</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">III</label>
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Initial Dial Gauge Reading</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="idg_1" name="idg_1" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="idg_2" name="idg_2" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="idg_3" name="idg_3" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Final Dial Gauge Reading</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="fdg_1" name="fdg_1" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="fdg_2" name="fdg_2" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="fdg_3" name="fdg_3" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">PENETRATION (in 1/10 mm)</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="pen_1" name="pen_1" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="pen_2" name="pen_2" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="pen_3" name="pen_3" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">AVERAGE PENETRATION (in 1/10 mm)</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_pen" name="avg_pen"disabled >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
							
								
							
							<br>
							
							
								
						
						</div>
				  
				
		
					</div>	
			<?php }
				
			else if($r1['test_code']=="sof")
			{ $test_check.="sof,";?>
		
			<div class="panel panel-default" id="sof">
					<div class="panel-heading" id="txtsof">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse150">
								<h4 class="panel-title">
								<b>SOFTENING POINT</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse150" class="panel-collapse collapse">
						<div class="panel-body">
							<br>
							<div class="row">									
								
								<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_sof">2.</label>
													<input type="checkbox" class="visually-hidden" name="chk_sof"  id="chk_sof" value="chk_sof"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SOFTENING POINT</label>
										</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label"></label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Ball-1</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label"></label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Ball-2</label>
										</div>
									</div>		
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label"></label>
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">--</label>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">TIME<br>(MINUTES)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">TEMP OF WATER <br>BATH &deg;C</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">TIME<br>(MINUTES)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">TEMP OF WATER <br>BATH &deg;C</label>
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label"></label>
										</div>
									</div>	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">0</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw1" name="tw1" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">0</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw2" name="tw2" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf1" name="sf1" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">1</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw3" name="tw3" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">1</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw4" name="tw4" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf2" name="sf2" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">2</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw5" name="tw5" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">2</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw6" name="tw6" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf3" name="sf3" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">3</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw7" name="tw7" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">3</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw8" name="tw8" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf4" name="sf4" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">4</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw9" name="tw9" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">4</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw10" name="tw10" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf5" name="sf5" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">5</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw11" name="tw11" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">5</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw12" name="tw12" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf6" name="sf6" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">6</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw13" name="tw13" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">6</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw14" name="tw14" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf7" name="sf7" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">7</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw15" name="tw15" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">7</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw16" name="tw16" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf8" name="sf8" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">8</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw17" name="tw17" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">8</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw18" name="tw18" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf9" name="sf9" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">9</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw19" name="tw19" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">9</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw20" name="tw20" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf10" name="sf10" >
										</div>
									</div>	
								</div>
							</div>
							<br><div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">10</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw21" name="tw21" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">10</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="tw22" name="tw22" >
										</div>
									</div>	
									<div class="col-md-2">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sf11" name="sf11" >
										</div>
									</div>	
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Ball no. 1</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="bn_1" name="bn_1" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Ball no. 2</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="bn_2" name="bn_2" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label"></label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">AVERAGE SOFTENING POINT</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_sof" name="avg_sof" >
										</div>
									</div>									
								</div>
							</div>
						</div>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-12 control-label">SOFTENING POINT</label>-->
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="hidden" class="form-control" id="sof_0" name="sof_0" >
										</div>
									</div>									
								</div>
							</div>
								
							
							<br>
							
							
								
						
						</div>
				  
				
		
					</div>	
				
			<?php }
				
			else if($r1['test_code']=="duc")
			{ $test_check.="duc,";?>				
							
				<div class="panel panel-default" id="duc">
					<div class="panel-heading" id="txtduc">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
								<h4 class="panel-title">
								<b>DUCTILITY</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
							<br> 
							<div class="row">									
								
								<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_duc">3.</label>
													<input type="checkbox" class="visually-hidden" name="chk_duc"  id="chk_duc" value="chk_duc"><br>
												</div>
											<label for="inputEmail3" class="col-sm-5 control-label label-right">DUCTILITY</label>
										</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="duc_temp" name="duc_temp" >
											</div>
									</div>
									
									
								</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label label-right">Air:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="air_1" name="air_1" >
											</div>
									</div>
									
									
									</div>
									<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label label-right">water Bath:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="bath_1" name="bath_1" >
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
											<label for="inputEmail3" class="col-sm-12 control-label">I</label>
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">II</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">III</label>
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">DUCTILITY (lENGTH OF BITUMEN THREAD IN CM)</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="duc_1" name="duc_1" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="duc_2" name="duc_2" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="duc_3" name="duc_3" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">AVERAGE DUCTILITY (LENGHT IN CM)</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_duc" name="avg_duc" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
							
								
							
							<br>
							
							
								
						
						</div>
				  
				
		
					</div>	
			<?php }
				
			else if($r1['test_code']=="fla")
			{ $test_check.="fla,";?>
				
			<div class="panel panel-default" id="fla">
		<div class="panel-heading" id="txtfla">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31">
					<h4 class="panel-title">
					<b>FLASH POINT-FIRE POINT</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_sp">4.</label>
													<input type="checkbox" class="visually-hidden" name="chk_fla"  id="chk_fla" value="chk_fla"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">flash point-fire point</label>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
												<div class="col-sm-8">
													<input type="hidden" class="form-control" id="sp_temp" name="sp_temp" ><br>
												</div>
										</div>
									</div>
									
								</div>
								<!--<div class="row">
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight of Bottle Filled in Distilled Water (B) gm</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight if about Half Filled Bitumen (C) gm</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight of about Half Filled With Bitumen and the rest with Distilled Water (D) gm</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity G = (c - a) / (b - a)-(d - c)</label>
									</div>
									</div>

									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity</label>
									</div>
									</div>
									
									
									
											
								</div>-->
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
								<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Flash Point&deg;C</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_a_1" name="sp_a_1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_b_1" name="sp_b_1" >
									  </div>
									</div>
									</div>	
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_1" name="sp_1"disabled >
									  </div>									
								     </div>
									</div>	
												
								</div>	
								<br>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Fire Point&deg;C</label>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_d_1" name="sp_d_1" >
									  </div>
									</div>
									</div>													
								<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_c_1" name="sp_c_1" >
									  </div>
									</div>
									</div>	    							
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="avg_sp" name="avg_sp"disabled>
									</div>
								    </div>
								</div>
							</div>
							<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="hidden" class="form-control" id="sp_a_2" name="sp_a_2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="hidden" class="form-control" id="sp_b_2" name="sp_b_2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="hidden" class="form-control" id="sp_c_2" name="sp_c_2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="hidden" class="form-control" id="sp_d_2" name="sp_d_2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="hidden" class="form-control" id="sp_2" name="sp_2" readonly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										
									</div>
								    </div>
								</div>
								
							</div>
						
						</div>
				  </div>
	</div>
				
			<?php }
				
			else if($r1['test_code']=="abs")
			{ $test_check.="abs,";?>
				
				<div class="panel panel-default" id="abs">
						<div class="panel-heading" id="txtabs">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse321">
									<h4 class="panel-title">
									<b>ABSOLUTE VISCOSITY</b>
									</h4>
								</a>
							</h4>
						</div>
						<div id="collapse321" class="panel-collapse collapse">
										<div class="panel-body">
												<div class="row">									
													
													<div class="col-lg-6">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_abs">5.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_abs"  id="chk_abs" value="chk_abs"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">ABSOLUTE VISCOSITY</label>
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
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">1</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Time Req by Bitumen to Cross The Bulb B(T1)</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_4_1" name="abs_4_1" >
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_4_2" name="abs_4_2" >
													  </div>
													</div>
													</div>				
													
											</div>
												<br>
											
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">2</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Bulb B Factor (K1)</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_3_1" name="abs_3_1" >
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_3_2" name="abs_3_2" >
													  </div>
													</div>
													</div>				
													
											</div>
											
											<br>
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">3</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Flow Time In Sec (tB = K1 * T1)</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_5_1" name="abs_5_1" readonly>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_5_2" name="abs_5_2" readonly>
													  </div>
													</div>
													</div>				
													
											</div>
											<br>
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">4</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Time Req. By Bitumen to Cross the bulb-C (T2)</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_7_1" name="abs_7_1" >
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_7_2" name="abs_7_2" >
													  </div>
													</div>
													</div>				
													
											</div>
											
											<br>
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">5</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Bulb -C Factor (K2)</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_6_1" name="abs_6_1" >
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_6_2" name="abs_6_2" >
													  </div>
													</div>
													</div>				
													
											</div>
											
											<br>
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">6</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Flow Time In Sec (Tc = K2 * T2)</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_8_1" name="abs_8_1" readonly>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_8_2" name="abs_8_2" readonly>
													  </div>
													</div>
													</div>				
													
											</div>
											<br>
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">7</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Viscosity in Poises KT = (K1 * T1 + K2 * T2)/2</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_9_1" name="abs_9_1" >
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="abs_9_2" name="abs_9_2" >
													  </div>
													</div>
													</div>				
													
											</div>
											<br>
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">8</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Average Viscosity in Poises</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-6">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="avg_abs" name="avg_abs" >
													  </div>
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
													
													
													
													
													
															
												</div>
												<br>
												
											<br>
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">1</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Time Req. By Bitumen to Cross the bulb -B (t)</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="kin_5_1" name="kin_5_1" >
													  </div>
													</div>
													</div>
															
													
											</div>
											<br>
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">2</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Bulb-B Factor (C) </label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="kin_6_1" name="kin_6_1" readonly>
													  </div>
													</div>
													</div>
																
													
											</div>
											<br>
												<!--boxes-->
												<div class="row">
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">3</label>
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-12 control-label">Kinematic Viscosity cSt,=C * t</label>
													  </div>
													</div>
													</div>
													
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														<input type="text" class="form-control" id="avg_kin" name="avg_kin" >
													  </div>
													</div>
													</div>
													<div class="col-lg-3">
													<div class="form-group">
													  <div class="col-sm-12">
														
													  </div>
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
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">LOSS ON HEATING</label>
												<div class="col-sm-8">
													
													<input type="checkbox" name="chk_los"  id="chk_los" value="chk_los"><br>
												</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="los_temp" name="los_temp" ><br>
												</div>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight of sample before heating w1 (gm)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Weight of sample after heating w2 (gm)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Loss in wt. w1 - w2 (gm)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Loss in wt. (%) = (w1 -w2)/w1 * 100</label>
									</div>
									</div>
									
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Average</label>
									</div>
									</div>

									
									
											
								</div>
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="los_w1_1" name="los_w1_1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="los_w2_1" name="los_w2_1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="los_wt_1" name="los_wt_1" readonly>
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="los_1" name="los_1" readonly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-4">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="avg_los" name="avg_los">
									  </div>									
								     </div>
									</div>								
								
								
							</div>
							<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="los_w1_2" name="los_w1_2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="los_w2_2" name="los_w2_2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="los_wt_2" name="los_wt_2" readonly>
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="los_2" name="los_2" readonly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-4">
									<div class="form-group">
									  <div class="col-sm-12">
									
									  </div>									
								     </div>
									</div>								
								
								
							</div>
						
						</div>
				  </div>
	</div>
			
				
			<?php }
		}?>	

		<div class="panel panel-default" id="reamrks">
			<div class="panel-heading" id="txtreamrks">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse_remarks">
						<h4 class="panel-title">
						<b>Remarks</b>
						</h4>
					</a>
				</h4>
			</div>
			<div id="collapse_remarks" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row">									
						<div class="col-lg-4">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label label-right">Remarks</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="col-md-2">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Heading;</label>
									</div>
								</div>
							</div>
							<div class="col-lg-10">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="tag_heading" name="tag_heading" >
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="col-md-2">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Data;</label>
									</div>
								</div>
							</div>
							<div class="col-lg-10">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="tag_data" name="tag_data" >
									</div>
								</div>
							</div>
						</div>
					</div>
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
							 $query = "select * from bitumin_span WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	



	$('#chk_pen').change(function(){
        if(this.checked)
		{
			$('#txtpen').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtpen').css("background-color","white");	
		}
		
	});
	
	$('#chk_sof').change(function(){
        if(this.checked)
		{
			$('#txtsof').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtsof').css("background-color","white");	
		}
		
	});
	
	
	
	$('#chk_duc').change(function(){
        if(this.checked)
		{
			$('#txtduc').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtduc').css("background-color","white");	
		}
		
	});
	
	
	
	$('#chk_sp').change(function(){
        if(this.checked)
		{
			$('#txtfla').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtfla').css("background-color","white");	
		}
		
	});
	
	$('#chk_abs').change(function(){
        if(this.checked)
		{
			$('#txtabs').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtabs').css("background-color","white");	
		}
		
	});
	
	$('#chk_kin').change(function(){
        if(this.checked)
		{
			$('#txtkin').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtkin').css("background-color","white");	
		}
		
	});
	
	$('#chk_los').change(function(){
        if(this.checked)
		{
			$('#txtlos').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtlos').css("background-color","white");	
		}
		
	});
	
	var global_temp = randomNumberFromRange(26.0,28.5).toFixed(1);
	var pen_temp;
	var pen_1;
	var pen_2;
	var pen_3;
	var avg_pen;	
	
	function pen_auto()
	{
		var pen_temp = global_temp;	
			$('#pen_temp').val(pen_temp);
			var grades = $('#bitumin_grade').val();
			if(grades=="vg-10")
			{
				var avgpen = randomNumberFromRange(84.00,95.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();
				
				var pen_3 = (+avg_pen)+ 2;
				var pen_2 = (+avg_pen);
				var pen_1 = (+avg_pen)- 2; 
				
									
				
			}
			else if(grades=="vg-20")
			{
				var avgpen = randomNumberFromRange(65.00,75.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();
				
				var pen_3 = (+avg_pen)+ 2;
				var pen_2 = (+avg_pen) ;
				var pen_1 = (+avg_pen) - 2; 
				
			}
			else if(grades=="vg-30")
			{
				var avgpen = randomNumberFromRange(48.00,53.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();				
				
				
				var pen_3 = (+avg_pen) - 2;
				var pen_2 = (+avg_pen) ;
				var pen_1 = (+avg_pen)  + 2; 
				
			}
			else if(grades=="vg-40")
			{
				var avgpen = randomNumberFromRange(38.00,42.00).toFixed(); 
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();
				
				var pen_3 = (+avg_pen) + 1;
				var pen_2 = (+avg_pen) - 1;
				var pen_1 = (+avg_pen); 
				
			}
			
			$('#pen_1').val(pen_1.toFixed());
			$('#pen_2').val(pen_2.toFixed());
			$('#pen_3').val(pen_3.toFixed());
			
			$('#fdg_1').val(pen_1.toFixed());
			$('#fdg_2').val(pen_2.toFixed());
			$('#fdg_3').val(pen_3.toFixed());
			
			var fdg_1 = $('#fdg_1').val();
			var fdg_2 = $('#fdg_2').val();
			var fdg_3 = $('#fdg_3').val();
			var idg_1 = (+fdg_1) - (+pen_1);
			var idg_2 = (+fdg_2) - (+pen_2);
			var idg_3 = (+fdg_3) - (+pen_3); 
			
			$('#idg_1').val(idg_1.toFixed());
			$('#idg_2').val(idg_2.toFixed());
			$('#idg_3').val(idg_3.toFixed());							
			
			$('#pen_temp').val(pen_temp.toString().substring(0, pen_temp.toString().indexOf(".") + 2));
			
			
	}
	
	$('#chk_pen').change(function(){
        if(this.checked)
		{  
			pen_auto();
			
		}
		else
		{
			$('#avg_pen').val(null);
			$('#pen_1').val(null);
			$('#pen_2').val(null);
			$('#pen_3').val(null);
			$('#fdg_1').val(null);
			$('#fdg_2').val(null);
			$('#fdg_3').val(null);
			$('#idg_1').val(null);
			$('#idg_2').val(null);
			$('#idg_3').val(null);
			$('#pen_temp').val(null);
			
			
		}
	});
	
	$('#avg_pen').change(function(){
		if ($("#chk_pen").is(':checked')) {
        var grades = $('#bitumin_grade').val();
			if(grades=="vg-10")
			{
				var avg_pen = $('#avg_pen').val();
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var pen_3 = parseInt(avg_pen) - 2;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 2; 
				}
				else{
				var pen_3 = parseInt(avg_pen);
				var pen_2 = parseInt(avg_pen) + 2;
				var pen_1 = parseInt(avg_pen) - 2; 
				}
									
				
			}
			else if(grades=="vg-20")
			{
				var avg_pen = $('#avg_pen').val();
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var pen_3 = parseInt(avg_pen) - 2;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 2; 
				}
				else{
				var pen_3 = parseInt(avg_pen);
				var pen_2 = parseInt(avg_pen) + 2;
				var pen_1 = parseInt(avg_pen) - 2; 
				}
			}
			else if(grades=="vg-30")
			{
				var avg_pen = $('#avg_pen').val(); 
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var pen_3 = parseInt(avg_pen) - 2;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 2; 
				}
				else{
				var pen_3 = parseInt(avg_pen);
				var pen_2 = parseInt(avg_pen) + 2;
				var pen_1 = parseInt(avg_pen) - 2; 
				}
			}
			else if(grades=="vg-40")
			{
				var avg_pen = $('#avg_pen').val();
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var pen_3 = parseInt(avg_pen) - 1;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 1; 
				}
				else{
				var pen_3 = parseInt(avg_pen) + 1;
				var pen_2 = parseInt(avg_pen) - 1;
				var pen_1 = parseInt(avg_pen); 
				}
			}
			$('#pen_1').val(pen_1.toFixed());
			$('#pen_2').val(pen_2.toFixed());
			$('#pen_3').val(pen_3.toFixed());
			
		}
		else
		{
			$('#txtpen').css("background-color","var(--success)");	
		}
			
	});
	
	function pen_1_2_3()
	{
		$('#txtpen').css("background-color","var(--success)");	
		 var pen_1 = $('#pen_1').val();
		 var pen_2 = $('#pen_2').val();
		 var pen_3 = $('#pen_3').val();
		 
		 var avg_pen = ((+pen_1) + (+pen_2) + (+pen_3))/3;
		 $('#avg_pen').val(avg_pen.toFixed());
	}
	
	$('#pen_1').change(function(){
		pen_1_2_3();
	});
	$('#pen_2').change(function(){
		pen_1_2_3();
	});
	$('#pen_3').change(function(){
		pen_1_2_3();
	});
	
	
	var duc_temp;
	var duc_1;
	var duc_2;
	var duc_3;
	var avg_duc;	
	
	
	function duc_auto()
	{
		var duc_temp = global_temp;	
			$('#duc_temp').val(duc_temp);
			var grades = $('#bitumin_grade').val();
			if(grades=="vg-10")
			{
				var avg_duc = randomNumberFromRange(80,99).toFixed(); 
			}
			else if(grades=="vg-20")
			{
				var avg_duc = randomNumberFromRange(70,80).toFixed(); 
			}
			else if(grades=="vg-30")
			{
				var avg_duc = randomNumberFromRange(70,80).toFixed(); 
			}
			else if(grades=="vg-40")
			{
				var avg_duc = randomNumberFromRange(55,65).toFixed(); 
			}
			
				$('#avg_duc').val(avg_duc);
				var avgduc = $('#avg_duc').val();
				
				
				 
				var gg = randomNumberFromRange(0,100).toFixed();
				if(gg % 2 == 0)
				{
					if(gg > 50)
					{
						 var rnd = randomNumberFromRange(0,2).toFixed(); 
						 var duc_1 = (+avgduc) + 1; 
						 var duc_2 = (+avgduc) - (+rnd);
						 $('#duc_1').val(duc_1.toFixed());
						 $('#duc_2').val(duc_2.toFixed());
						 var duc1 = $('#duc_1').val();
						 var duc2 = $('#duc_2').val();
						 var eq = ((+avgduc)*(+3));
						 var duc3 =  (+eq)- ((+duc1)+(+duc2));
						 $('#duc_3').val(duc3.toFixed());
					}
					else
					{
						 var rnd = randomNumberFromRange(0,2).toFixed(); 
						 var duc_1 = (+avgduc) - 1; 
						 var duc_2 = (+avgduc) + (+rnd);
						 $('#duc_1').val(duc_1.toFixed());
						 $('#duc_2').val(duc_2.toFixed());
						 var duc1 = $('#duc_1').val();
						 var duc2 = $('#duc_2').val();
						 var eq = ((+avgduc)*(+3));
						 var duc3 =  (+eq)- ((+duc1)+(+duc2));
						 $('#duc_3').val(duc3.toFixed());
					}
				
				
				}
				else{
					
					if(gg > 50)
					{
						 var rnd = randomNumberFromRange(0,2).toFixed(); 
						 var duc_1 = (+avgduc); 
						 var duc_2 = (+avgduc) + (+rnd);
						 $('#duc_1').val(duc_1.toFixed());
						 $('#duc_2').val(duc_2.toFixed());
						 var duc1 = $('#duc_1').val();
						 var duc2 = $('#duc_2').val();
						 var eq = ((+avgduc)*(+3));
						 var duc3 =  (+eq)- ((+duc1)+(+duc2));
						 $('#duc_3').val(duc3.toFixed()); 
					}
					else
					{
						 var rnd = randomNumberFromRange(0,2).toFixed(); 
						 var duc_1 = (+avgduc) + (+rnd);
						 var duc_2 = (+avgduc);
						 $('#duc_1').val(duc_1.toFixed());
						 $('#duc_2').val(duc_2.toFixed());
						 var duc1 = $('#duc_1').val();
						 var duc2 = $('#duc_2').val();
						 var eq = ((+avgduc)*(+3));
						 var duc3 =  (+eq)- ((+duc1)+(+duc2));
						 $('#duc_3').val(duc3.toFixed());
					}
						
				
				}
				
				var d1 =  $('#duc_1').val();
				var d2 =  $('#duc_2').val();
				var d3 =  $('#duc_3').val();
				
				if(d1 == d2)
				{
					if(d2 == d3)
					{
						 var du1 = (+avgduc) - 1; 
						 var du2 = (+avgduc);
						 var du3 = (+avgduc) + 1;
						 $('#duc_1').val(du1.toFixed());
						 $('#duc_2').val(du1.toFixed());
						 $('#duc_3').val(du3.toFixed());
					}
					else
					{
						
					}
					
				}
				else
				{
					
				}
				
				var avg = ((+d1) + (+d2) + (+d3))/3;
				$('#avg_duc').val(avg.toFixed(1));				
				
			
			
										
			
			$('#duc_temp').val(duc_temp.toString().substring(0, duc_temp.toString().indexOf(".") + 2));
			
			
	}
	
	$('#chk_duc').change(function(){
        if(this.checked)
		{  
			
			duc_auto();
			
		}
		else
		{
			$('#avg_duc').val(null);
			$('#duc_1').val(null);
			$('#duc_2').val(null);
			$('#duc_3').val(null);
			$('#duc_temp').val(null);
			
			
		}
	});
	
	$('#avg_duc').change(function(){
		if ($("#chk_duc").is(':checked')) {
			
			
				var avgduc = $('#avg_duc').val();
			
				var gg = randomNumberFromRange(0,100).toFixed();
				if(gg % 2 == 0)
				{
					if(gg > 50)
					{
						 var rnd = randomNumberFromRange(0,2).toFixed(); 
						 var duc_1 = (+avgduc) + 1; 
						 var duc_2 = (+avgduc) - (+rnd);
						 $('#duc_1').val(duc_1.toFixed());
						 $('#duc_2').val(duc_2.toFixed());
						 var duc1 = $('#duc_1').val();
						 var duc2 = $('#duc_2').val();
						 var eq = ((+avgduc)*(+3));
						 var duc3 =  (+eq)- ((+duc1)+(+duc2));
						 $('#duc_3').val(duc3.toFixed());
					}
					else
					{
						 var rnd = randomNumberFromRange(0,2).toFixed(); 
						 var duc_1 = (+avgduc) - 1; 
						 var duc_2 = (+avgduc) + (+rnd);
						 $('#duc_1').val(duc_1.toFixed());
						 $('#duc_2').val(duc_2.toFixed());
						 var duc1 = $('#duc_1').val();
						 var duc2 = $('#duc_2').val();
						 var eq = ((+avgduc)*(+3));
						 var duc3 =  (+eq)- ((+duc1)+(+duc2));
						 $('#duc_3').val(duc3.toFixed());
					}
				
				
				}
				else{
					
					if(gg > 50)
					{
						 var rnd = randomNumberFromRange(0,2).toFixed(); 
						 var duc_1 = (+avgduc); 
						 var duc_2 = (+avgduc) + (+rnd);
						 $('#duc_1').val(duc_1.toFixed());
						 $('#duc_2').val(duc_2.toFixed());
						 var duc1 = $('#duc_1').val();
						 var duc2 = $('#duc_2').val();
						 var eq = ((+avgduc)*(+3));
						 var duc3 =  (+eq)- ((+duc1)+(+duc2));
						 $('#duc_3').val(duc3.toFixed()); 
					}
					else
					{
						 var rnd = randomNumberFromRange(0,2).toFixed(); 
						 var duc_1 = (+avgduc) + (+rnd);
						 var duc_2 = (+avgduc);
						 $('#duc_1').val(duc_1.toFixed());
						 $('#duc_2').val(duc_2.toFixed());
						 var duc1 = $('#duc_1').val();
						 var duc2 = $('#duc_2').val();
						 var eq = ((+avgduc)*(+3));
						 var duc3 =  (+eq)- ((+duc1)+(+duc2));
						 $('#duc_3').val(duc3.toFixed());
					}
						
				
				}
				
				var d1 =  $('#duc_1').val();
				var d2 =  $('#duc_2').val();
				var d3 =  $('#duc_3').val();
				
				if(d1 == d2)
				{
					if(d2 == d3)
					{
						 var du1 = (+avgduc) - 1; 
						 var du2 = (+avgduc);
						 var du3 = (+avgduc) + 1;
						 $('#duc_1').val(du1.toFixed());
						 $('#duc_2').val(du1.toFixed());
						 $('#duc_3').val(du3.toFixed());
					}
					else
					{
						
					}
					
				}
				else
				{
					
				}
				
				var avg = ((+d1) + (+d2) + (+d3))/3;
				$('#avg_duc').val(avg.toFixed(1));	
				
			
		}
		else
		{
			$('#txtduc').css("background-color","var(--success)");	
		}
			
	});
	
	function duc_1_2_3()
	{
		$('#txtduc').css("background-color","var(--success)");	
		 var duc_1 = $('#duc_1').val();
		 var duc_2 = $('#duc_2').val();
		 var duc_3 = $('#duc_3').val();
		 
		 var avg_duc = ((+duc_1) + (+duc_2) + (+duc_3))/3;
		 $('#avg_duc').val(avg_duc.toFixed(1));
	}
	
	$('#duc_1').change(function(){
		duc_1_2_3();
	});
	$('#duc_2').change(function(){
		duc_1_2_3();
	});
	$('#duc_3').change(function(){
		duc_1_2_3();
	});
	
function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}
	
		
	
	var sp_a_1;
	var sp_a_2;
	var sp_b_1;
	var sp_b_2;
	var sp_c_1;
	var sp_c_2;
	var sp_d_1;
	var sp_d_2;
	var sp_1;
	var sp_2;	
	var avg_sp;	
	var sp_temp;	
	
	function sp_auto()
	{
		var sp_temp = global_temp;	
			$('#sp_temp').val(sp_temp);
			
			var sp_1 = randomNumberFromRange(295,299).toFixed(1);
			var avg_sp = randomNumberFromRange(295,299).toFixed(1);
			$('#avg_sp').val(avg_sp);
			$('#sp_1').val(sp_1);
			var avg_sp  = $('#avg_sp').val();
			var sp_1  = $('#sp_1').val();
			
			var sp_a1 = (+sp_1) - 3; 
			var sp_b1 = (+sp_1) + 3;
			
			$('#sp_a_1').val(sp_a1);
			$('#sp_b_1').val(sp_b1);
			
			var sp_d1 = (+avg_sp) - 3; 
			var sp_c1 = (+avg_sp) + 3;
			
			$('#sp_d_1').val(sp_a1);
			$('#sp_c_1').val(sp_b1);
			
			var sp_a_1  = $('#sp_a_1').val();
			var sp_b_1  = $('#sp_b_1').val();
			var sp_c_1  = $('#sp_c_1').val();						
			var sp_d_1  = $('#sp_d_1').val();						
		
			
			var sp_1 = ((+sp_a_1) + (+sp_b_1)) / (+2);  
			$('#sp_1').val(sp_1.toFixed(2));
			
			var avg_sp = ((+sp_c_1) + (+sp_d_1)) / (+2);  
			$('#avg_sp').val(avg_sp.toFixed(2));
			
			
	}
	
	$('#chk_fla').change(function(){
        if(this.checked)
		{  
			sp_auto();
			
		}
		else
		{
			$('#avg_sp').val(null);
			$('#sp_temp').val(null);
			$('#sp_a_1').val(null);
			$('#sp_a_2').val(null);
			$('#sp_b_1').val(null);
			
			$('#sp_b_2').val(null);
			$('#sp_c_1').val(null);
			$('#sp_c_2').val(null);
			$('#sp_d_1').val(null);
			$('#sp_d_2').val(null);
								
			$('#sp_1').val(null);
			$('#sp_2').val(null);
		
		}
	});
	
	/* $('#avg_sp').change(function(){
        if ($("#chk_sp").is(':checked')) {
			var sp_temp = global_temp;	
			$('#sp_temp').val(sp_temp);
			
				var avg_sp = $('#avg_sp').val();
				var sp_1 = $('#avg_sp').val();
				var aa = randomNumberFromRange(1,5).toFixed();
				if(aa==1)
				{
					var sp_a_1 = 60.12;
					var sp_b_1 = 122.89;
				}
				else if(aa==2)
				{
					var sp_a_1 = 55.22;
					var sp_b_1 = 112.49;
				}
				else if(aa==3)
				{
					var sp_a_1 = 58.00;
					var sp_b_1 = 119.85;
				}
				else if(aa==4)
				{
					var sp_a_1 = 57.95;
					var sp_b_1 = 120.45;
				}
				else if(aa==5)
				{
					var sp_a_1 = 57.45;
					var sp_b_1 = 120.65;
				}
				
				
				$('#sp_a_1').val(sp_a_1);
				$('#sp_b_1').val(sp_b_1);
				var sp_c_1  = randomNumberFromRange(84.00,88.00).toFixed(3);
				$('#sp_c_1').val(sp_c_1);

				var sp_a_1 = $('#sp_a_1').val();
				var sp_b_1 = $('#sp_b_1').val();
				var sp_c_1 = $('#sp_c_1').val();
				
				var gb = (+sp_1)*(+sp_b_1);
				 var ga = (+sp_1)*(+sp_a_1);
				 var gc = (+sp_1)*(+sp_c_1);
				
				 var eq = ((+sp_a_1)+(+gb)+(+gc));
				 var eq1 = ((+sp_c_1)+(+ga));
				 var finaleq = (+eq) - (+eq1);
				 var sp_d_1 = (+finaleq)/(+sp_1);
				
				//$('#sp_1').val(sp_1.toFixed(2));
				$('#sp_d_1').val(sp_d_1.toFixed(3));
			
		}
		else
		{
			$('#txtfla').css("background-color","var(--success)");	
		}
									
		
	}); */


	function one()
	{
			$('#txtfla').css("background-color","var(--success)");	
			var sp_temp = global_temp;	
			$('#sp_temp').val(sp_temp);
			
			
			
			//1st case
			var sp_a_1  = $('#sp_a_1').val();
			var sp_b_1  = $('#sp_b_1').val();
			var sp_c_1  = $('#sp_c_1').val();						
			var sp_d_1  = $('#sp_d_1').val();						
		
			
			var sp_1 = ((+sp_a_1) + (+sp_b_1)) / (+2);  
			$('#sp_1').val(sp_1.toFixed(2));
			
			var avg_sp = ((+sp_c_1) + (+sp_d_1)) / (+2);  
			$('#avg_sp').val(avg_sp.toFixed(2));
			
			

			
	}
	
	$("#sp_a_1").change(function(){
		one();											
    });
	
	$("#sp_b_1").change(function(){
		one();											
    });
	
	$("#sp_c_1").change(function(){
		one();											
    });
	
	$("#sp_d_1").change(function(){
		one();											
    });
	
	
	
	function abs_auto()
	{
		var grades = $('#bitumin_grade').val();
			if(grades=="vg-10")
			{
				var abs_9_1 = randomNumberFromRange(900.00,1100.00).toFixed(2);
				
			}
			else if(grades=="vg-20")
			{
				var abs_9_1 = randomNumberFromRange(1700.00,2000.00).toFixed(2);
				
			}
			else if(grades=="vg-30")
			{
				var abs_9_1 = randomNumberFromRange(2650.00,2800.00).toFixed(2);
				
			}
			else if(grades=="vg-40")
			{
				var abs_9_1 = randomNumberFromRange(3300.00,3800.00).toFixed(2);
				
			}
			
			var abs_3_1 = 42.5189;
			$('#abs_3_1').val(abs_3_1);
			var abs_31 = $('#abs_3_1').val();
			
			
			var abs_6_1 = 12.2000;
			$('#abs_6_1').val(abs_6_1);
			var abs_61 = $('#abs_6_1').val();
			
			$('#abs_9_1').val(abs_9_1);
			$('#avg_abs').val(abs_9_1);
			var abs_91 = $('#abs_9_1').val();
			
			var ren = randomNumberFromRange(0.58,0.65).toFixed(2);
			
			var ts = (+ren) * 2;
			var abs_5_1 = (+abs_91) * (+ts);
			$('#abs_5_1').val(abs_5_1.toFixed(2));
			var abs_51 = $('#abs_5_1').val();
			
			var abs_4_1 = (+abs_51)/(+abs_31);
			
			$('#abs_4_1').val(abs_4_1.toFixed(2));
			var abs_41 = $('#abs_4_1').val();
			
			var temp  = (+abs_91) * (+2);
			
			var abs_8_1 = (+temp) - (+abs_51);
			$('#abs_8_1').val(abs_8_1.toFixed(2));
			var abs_81 = $('#abs_8_1').val();
			var abs_7_1 = (+abs_81)/(+abs_61);
			$('#abs_7_1').val(abs_7_1.toFixed(2));
			
			var abs44 = $('#abs_4_1').val();
			var abs77 = $('#abs_7_1').val();
			
			var abs_5_1 = (+abs44) * (+abs_31);
			$('#abs_5_1').val(abs_5_1.toFixed(2));
			var abs55 = $('#abs_5_1').val();
			
			var abs_8_1 = (+abs77) * (+abs_61);
			$('#abs_8_1').val(abs_8_1.toFixed(2));
			var abs88 = $('#abs_8_1').val();
			
			var abs_9_1 = ((+abs55) + (+abs88))/2;
			$('#abs_9_1').val(abs_9_1.toFixed(2));
			$('#avg_abs').val(abs_9_1.toFixed(2));
	}
	
	$('#chk_abs').change(function(){
        if(this.checked)
		{ 
			abs_auto();
			
			
			
		
			
		}
		else
		{
			$('#abs_1_1').val(null);
			$('#abs_1_2').val(null);
			$('#abs_2_1').val(null);
			$('#abs_2_2').val(null);
			$('#abs_3_1').val(null);
			$('#abs_3_2').val(null);
			$('#abs_4_1').val(null);
			$('#abs_4_2').val(null);
			$('#abs_5_1').val(null);
			$('#abs_5_2').val(null);
			$('#abs_6_1').val(null);
			$('#abs_6_2').val(null);
			$('#abs_7_1').val(null);
			$('#abs_7_2').val(null);
			$('#abs_8_1').val(null);
			$('#abs_8_2').val(null);
			$('#abs_9_1').val(null);
			$('#abs_9_2').val(null);
			$('#avg_abs').val(null);
				  
					
		}
	});
	
	
	$('#avg_abs').change(function(){
		$('#txtabs').css("background-color","var(--success)");	
       	 if ($("#chk_abs").is(':checked')) {
			
			var avg_abs = $('#avg_abs').val();
			$('#abs_9_1').val(avg_abs);
			var abs_91 = $('#abs_9_1').val();
			
			var abs_3_1 = 42.5189;
			$('#abs_3_1').val(abs_3_1);
			var abs_31 = $('#abs_3_1').val();
			
			
			var abs_6_1 = 12.2000;
			$('#abs_6_1').val(abs_6_1);
			var abs_61 = $('#abs_6_1').val();
						
			var ren = randomNumberFromRange(0.58,0.65).toFixed(2);
			
			var abs_5_1 = (+abs_91) * (+2) * (+ren);
			$('#abs_5_1').val(abs_5_1.toFixed(1));
			var abs_51 = $('#abs_5_1').val();
			
			var abs_4_1 = (+abs_51)/(+abs_31);
			$('#abs_4_1').val(abs_4_1.toFixed(2));
			var abs_41 = $('#abs_4_1').val();
			
			var temp  = (+abs_91) * (+2);
			
			var abs_8_1 = (+temp) - (+abs_51);
			$('#abs_8_1').val(abs_8_1.toFixed(1));
			var abs_81 = $('#abs_8_1').val();
			var abs_7_1 = (+abs_81)/(+abs_61);
			$('#abs_7_1').val(abs_7_1.toFixed(2));
			
			var abs44 = $('#abs_4_1').val();
			var abs77 = $('#abs_7_1').val();
			
			var abs_5_1 = (+abs44) * (+abs_31);
			$('#abs_5_1').val(abs_5_1.toFixed(2));
			var abs55 = $('#abs_5_1').val();
			
			var abs_8_1 = (+abs77) * (+abs_61);
			$('#abs_8_1').val(abs_8_1.toFixed(2));
			var abs88 = $('#abs_8_1').val();
			
			var abs_9_1 = ((+abs55) + (+abs88))/2;
			$('#abs_9_1').val(abs_9_1.toFixed(2));
			$('#avg_abs').val(abs_9_1.toFixed(2));
			
			
			
		 }
		
			
		
	});
	
	
	
	$('#abs_3_1').change(function(){
		$('#txtabs').css("background-color","var(--success)");	
		var abs_3_1 = $('#abs_3_1').val();		
		var abs_4_1 = $('#abs_4_1').val();
		var abs_6_1 = $('#abs_6_1').val();	
		var abs_7_1 = $('#abs_7_1').val();
		
		var abs_5_1 = (+abs_3_1) * (+abs_4_1);
		var abs_8_1 = (+abs_6_1) * (+abs_7_1);
		$('#abs_5_1').val(abs_5_1.toFixed(2));
		$('#abs_8_1').val(abs_8_1.toFixed(2));
		
		var abs_51 = $('#abs_5_1').val();		
		var abs_81 = $('#abs_8_1').val();		
		
		var abs_9_1 = ((+abs_51) + (+abs_81))/2;
		
		$('#abs_9_1').val(abs_9_1.toFixed(2));
		$('#avg_abs').val(abs_9_1.toFixed(2));
		
		
	});
	$('#abs_4_1').change(function(){
		$('#txtabs').css("background-color","var(--success)");	
        var abs_3_1 = $('#abs_3_1').val();		
		var abs_4_1 = $('#abs_4_1').val();
		var abs_6_1 = $('#abs_6_1').val();	
		var abs_7_1 = $('#abs_7_1').val();
		
		var abs_5_1 = (+abs_3_1) * (+abs_4_1);
		var abs_8_1 = (+abs_6_1) * (+abs_7_1);
		$('#abs_5_1').val(abs_5_1.toFixed(2));
		$('#abs_8_1').val(abs_8_1.toFixed(2));
		
		var abs_51 = $('#abs_5_1').val();		
		var abs_81 = $('#abs_8_1').val();		
		
		var abs_9_1 = ((+abs_51) + (+abs_81))/2;
		
		$('#abs_9_1').val(abs_9_1.toFixed(2));
		$('#avg_abs').val(abs_9_1.toFixed(2));	
	});
		
	
	$('#abs_3_2').change(function(){
		$('#txtabs').css("background-color","var(--success)");	
		var abs_3_2 = $('#abs_3_2').val();		
		var abs_4_2 = $('#abs_4_2').val();
		var abs_6_2 = $('#abs_6_2').val();	
		var abs_7_2 = $('#abs_7_2').val();
		
		var abs_5_2 = (+abs_3_2) * (+abs_4_2);
		var abs_8_2 = (+abs_6_2) * (+abs_7_2);
		$('#abs_5_2').val(abs_5_2.toFixed(2));
		$('#abs_8_2').val(abs_8_2.toFixed(2));
		
		var abs_52 = $('#abs_5_2').val();		
		var abs_82 = $('#abs_8_2').val();		
		
		var abs_9_2 = ((+abs_52) + (+abs_82))/2;
		
		$('#abs_9_2').val(abs_9_2.toFixed(2));
		var abs_91 = $('#abs_9_1').val();
		var abs_92 = $('#abs_9_2').val();
		var avg_abs = ((+abs_91)+(+abs_92))/2;
			
		$('#avg_abs').val(avg_abs.toFixed(2));
	});
	$('#abs_4_2').change(function(){
		$('#txtabs').css("background-color","var(--success)");	
        var abs_3_2 = $('#abs_3_2').val();		
		var abs_4_2 = $('#abs_4_2').val();
		var abs_6_2 = $('#abs_6_2').val();	
		var abs_7_2 = $('#abs_7_2').val();
		
		var abs_5_2 = (+abs_3_2) * (+abs_4_2);
		var abs_8_2 = (+abs_6_2) * (+abs_7_2);
		$('#abs_5_2').val(abs_5_2.toFixed(2));
		$('#abs_8_2').val(abs_8_2.toFixed(2));
		
		var abs_52 = $('#abs_5_2').val();		
		var abs_82 = $('#abs_8_2').val();		
		
		var abs_9_2 = ((+abs_52) + (+abs_82))/2;
		
		$('#abs_9_2').val(abs_9_2.toFixed(2));
		var abs_91 = $('#abs_9_1').val();
		var abs_92 = $('#abs_9_2').val();
		var avg_abs = ((+abs_91)+(+abs_92))/2;
			
		$('#avg_abs').val(avg_abs.toFixed(2));
	});
	$('#abs_6_1').change(function(){
        $('#txtabs').css("background-color","var(--success)");	
		var abs_3_1 = $('#abs_3_1').val();		
		var abs_4_1 = $('#abs_4_1').val();
		var abs_6_1 = $('#abs_6_1').val();	
		var abs_7_1 = $('#abs_7_1').val();
		
		var abs_5_1 = (+abs_3_1) * (+abs_4_1);
		var abs_8_1 = (+abs_6_1) * (+abs_7_1);
		$('#abs_5_1').val(abs_5_1.toFixed(2));
		$('#abs_8_1').val(abs_8_1.toFixed(2));
		
		var abs_51 = $('#abs_5_1').val();		
		var abs_81 = $('#abs_8_1').val();		
		
		var abs_9_1 = ((+abs_51) + (+abs_81))/2;
		
		$('#abs_9_1').val(abs_9_1.toFixed(2));
		$('#avg_abs').val(abs_9_1.toFixed(2));
	});
	$('#abs_6_2').change(function(){
		$('#txtabs').css("background-color","var(--success)");	
       var abs_3_2 = $('#abs_3_2').val();		
		var abs_4_2 = $('#abs_4_2').val();
		var abs_6_2 = $('#abs_6_2').val();	
		var abs_7_2 = $('#abs_7_2').val();
		
		var abs_5_2 = (+abs_3_2) * (+abs_4_2);
		var abs_8_2 = (+abs_6_2) * (+abs_7_2);
		$('#abs_5_2').val(abs_5_2.toFixed(2));
		$('#abs_8_2').val(abs_8_2.toFixed(2));
		
		var abs_52 = $('#abs_5_2').val();		
		var abs_82 = $('#abs_8_2').val();		
		
		var abs_9_2 = ((+abs_52) + (+abs_82))/2;
		
		$('#abs_9_2').val(abs_9_2.toFixed(2));
		var abs_91 = $('#abs_9_1').val();
		var abs_92 = $('#abs_9_2').val();
		var avg_abs = ((+abs_91)+(+abs_92))/2;
			
		$('#avg_abs').val(avg_abs.toFixed(2));
	});
	$('#abs_7_1').change(function(){
        $('#txtabs').css("background-color","var(--success)");	
		var abs_3_1 = $('#abs_3_1').val();		
		var abs_4_1 = $('#abs_4_1').val();
		var abs_6_1 = $('#abs_6_1').val();	
		var abs_7_1 = $('#abs_7_1').val();
		
		var abs_5_1 = (+abs_3_1) * (+abs_4_1);
		var abs_8_1 = (+abs_6_1) * (+abs_7_1);
		$('#abs_5_1').val(abs_5_1.toFixed(2));
		$('#abs_8_1').val(abs_8_1.toFixed(2));
		
		var abs_51 = $('#abs_5_1').val();		
		var abs_81 = $('#abs_8_1').val();		
		
		var abs_9_1 = ((+abs_51) + (+abs_81))/2;
		
		$('#abs_9_1').val(abs_9_1.toFixed(2));
		$('#avg_abs').val(abs_9_1.toFixed(2));
	});
	$('#abs_7_2').change(function(){
		$('#txtabs').css("background-color","var(--success)");	
       var abs_3_2 = $('#abs_3_2').val();		
		var abs_4_2 = $('#abs_4_2').val();
		var abs_6_2 = $('#abs_6_2').val();	
		var abs_7_2 = $('#abs_7_2').val();
		
		var abs_5_2 = (+abs_3_2) * (+abs_4_2);
		var abs_8_2 = (+abs_6_2) * (+abs_7_2);
		$('#abs_5_2').val(abs_5_2.toFixed(2));
		$('#abs_8_2').val(abs_8_2.toFixed(2));
		
		var abs_52 = $('#abs_5_2').val();		
		var abs_82 = $('#abs_8_2').val();		
		
		var abs_9_2 = ((+abs_52) + (+abs_82))/2;
		
		$('#abs_9_2').val(abs_9_2.toFixed(2));
		var abs_91 = $('#abs_9_1').val();
		var abs_92 = $('#abs_9_2').val();
		var avg_abs = ((+abs_91)+(+abs_92))/2;
			
		$('#avg_abs').val(avg_abs.toFixed(2));	
	});
	
	function kin_auto()
	{
		var grades = $('#bitumin_grade').val();
			if(grades=="vg-10")
			{
				var avg_kin = randomNumberFromRange(260,290).toFixed(2);
			}
			else if(grades=="vg-20")
			{
				var avg_kin = randomNumberFromRange(310,340).toFixed(2);
			}
			else if(grades=="vg-30")
			{
				var avg_kin = randomNumberFromRange(360,390).toFixed(2);
			}
			else if(grades=="vg-40")
			{
				var avg_kin = randomNumberFromRange(430,480).toFixed(2);
			}
			$('#avg_kin').val(avg_kin);
			var avgs = $('#avg_kin').val();
			var kin_6_1 = 1.34029;
			var kin_5_1 = (+avgs) / (+kin_6_1);
			$('#kin_6_1').val(kin_6_1);
			$('#kin_5_1').val(kin_5_1.toFixed(2));
			
			var kin51 =	$('#kin_5_1').val();			 
			var avg_kin = (+kin_6_1) * (+kin51);			
			$('#avg_kin').val(avg_kin.toFixed(2));
			
		
	}
	
	$('#chk_kin').change(function(){
        if(this.checked)
		{ 
			kin_auto();			
		}
		else
		{
			
			$('#kin_5_1').val(null);
			$('#kin_6_1').val(null);
			$('#avg_kin').val(null);
				  
					
		}
	});
	
	
	$('#avg_kin').change(function(){
        if ($("#chk_kin").is(':checked')) {
					
			
			var avg_kin = $('#avg_kin').val();
		
			var kin_6_1 = 1.34029;			
			var kin_5_1 = (+avg_kin) / (+kin_6_1);
			$('#kin_6_1').val(kin_6_1);
			$('#kin_5_1').val(kin_5_1.toFixed(2));
			
			var kin51 =	$('#kin_5_1').val();			 
			var avg_kin = (+kin_6_1) * (+kin51);			
			$('#avg_kin').val(avg_kin.toFixed(2));
			
		}
		$('#txtkin').css("background-color","var(--success)");		
		
		
			
		
	});
	
	
	$('#kin_5_1').change(function(){
		$('#txtkin').css("background-color","var(--success)");		
			var kin_5_1 = $('#kin_5_1').val();
		
			var kin_6_1 = 1.34029;			
			var avg_kin = (+kin_6_1) * (+kin_5_1);
			$('#kin_6_1').val(kin_6_1);
			$('#avg_kin').val(avg_kin.toFixed(2));
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
	
	function los_avg()
	{
		var los_temp = global_temp;	
					$('#los_temp').val(los_temp);
					var items = Array(0.05,0.10,0.15,0.20);
					var avg_los = jQuery.rand(items)
					var av = randomNumberFromRange(-0.02,0.02).toFixed(2);
					var los_1  = parseFloat(avg_los) - parseFloat(av);
					var los_2  = parseFloat(avg_los) + parseFloat(av);	
					
					var los_w1_1 = randomNumberFromRange(85.000, 98.000);
					var los_w1_2 = randomNumberFromRange(85.000, 98.000);
					
					//1
					var eq1 = (parseFloat(los_1)*parseFloat(los_w1_1));
					var eq11 = (parseFloat(los_w1_1)*100);
					var ans = (parseFloat(eq11)-parseFloat(eq1));
					var los_w2_1 = (parseFloat(ans)/100);
					
					var eq2 = (parseFloat(los_2)*parseFloat(los_w1_2));
					var eq22 = (parseFloat(los_w1_2)*100);
					var ans2 = (parseFloat(eq22)-parseFloat(eq2));
					var los_w2_2 = (parseFloat(ans2)/100);
					
					var los_wt_1 = parseFloat(los_w1_1)-parseFloat(los_w2_1);
					var los_wt_2 = parseFloat(los_w1_2)-parseFloat(los_w2_2);
					
					
				
					$('#los_w1_1').val(los_w1_1.toFixed(3));
					$('#los_w1_2').val(los_w1_2.toFixed(3));
					$('#los_w2_1').val(los_w2_1.toFixed(3));
					$('#los_w2_2').val(los_w2_2.toFixed(3));
					$('#los_wt_1').val(los_wt_1.toFixed(3));
					$('#los_wt_2').val(los_wt_2.toFixed(3));
					$('#los_1').val(los_1.toFixed(2));
					$('#los_2').val(los_2.toFixed(2));
					$('#avg_los').val(avg_los);
	}
	
	$('#chk_los').change(function(){
        if(this.checked)
		{ 
			
			los_avg();		
					
					
					 
		}
		else
		{
					$('#los_w1_1').val(null);
					$('#los_w1_2').val(null);
					$('#los_w2_1').val(null);
					$('#los_w2_2').val(null);
					$('#los_wt_1').val(null);
					$('#los_wt_2').val(null);
					$('#los_1').val(null);
					$('#los_2').val(null);
					$('#avg_los').val(null);
					$('#los_temp').val(null);
		}
	});
	
	
	
	$('#avg_los').change(function(){
        	
					var los_temp = global_temp;	
					$('#los_temp').val(los_temp);
				
					var avg_los = $('#avg_los').val();
					var av = randomNumberFromRange(-0.02,0.02).toFixed(2);
					var los_1  = parseFloat(avg_los) - parseFloat(av);
					var los_2  = parseFloat(avg_los) + parseFloat(av);	
					
					var los_w1_1 = randomNumberFromRange(85.000, 98.000);
					var los_w1_2 = randomNumberFromRange(85.000, 98.000);
					
					//1
					var eq1 = (parseFloat(los_1)*parseFloat(los_w1_1));
					var eq11 = (parseFloat(los_w1_1)*100);
					var ans = (parseFloat(eq11)-parseFloat(eq1));
					var los_w2_1 = (parseFloat(ans)/100);
					
					var eq2 = (parseFloat(los_2)*parseFloat(los_w1_2));
					var eq22 = (parseFloat(los_w1_2)*100);
					var ans2 = (parseFloat(eq22)-parseFloat(eq2));
					var los_w2_2 = (parseFloat(ans2)/100);
					
					var los_wt_1 = parseFloat(los_w1_1)-parseFloat(los_w2_1);
					var los_wt_2 = parseFloat(los_w1_2)-parseFloat(los_w2_2);
					
					
				
					$('#los_w1_1').val(los_w1_1.toFixed(3));
					$('#los_w1_2').val(los_w1_2.toFixed(3));
					$('#los_w2_1').val(los_w2_1.toFixed(3));
					$('#los_w2_2').val(los_w2_2.toFixed(3));
					$('#los_wt_1').val(los_wt_1.toFixed(3));
					$('#los_wt_2').val(los_wt_2.toFixed(3));
					$('#los_1').val(los_1.toFixed(2));
					$('#los_2').val(los_2.toFixed(2));
					//$('#avg_los').val(avg_los);
					
					 
		
	});
	
	
	function los_data()
	{
		
		var los_w1_1 = $('#los_w1_1').val();
		var los_w1_2 = $('#los_w1_2').val();
		var los_w2_1 = $('#los_w2_1').val();
		var los_w2_2 = $('#los_w2_2').val();
		
		var los_wt_1 = parseFloat(los_w1_1)-parseFloat(los_w2_1);
		var los_wt_2 = parseFloat(los_w1_2)-parseFloat(los_w2_2);
		
		var los_1 = ((parseFloat(los_wt_1)/parseFloat(los_w1_1))*100);
		var los_2 = ((parseFloat(los_wt_2)/parseFloat(los_w1_2))*100);
		
		var avg_los = ((parseFloat(los_1)+parseFloat(los_2))/2);
		
		$('#los_wt_1').val(los_wt_1.toFixed(3));
		$('#los_wt_2').val(los_wt_2.toFixed(3));
		$('#los_1').val(los_1.toFixed(2));
		$('#los_2').val(los_2.toFixed(2));
		$('#avg_los').val(avg_los.toFixed(2));
		
	}
	
	$('#los_w1_1').change(function(){
        los_data();
	});
	$('#los_w1_2').change(function(){
        los_data();
	});
	$('#los_w2_1').change(function(){
        los_data();
	});
	$('#los_w2_2').change(function(){
        los_data();
	});
	
	function sof_auto()
	{
		var grades = $('#bitumin_grade').val();

		

					if(grades=="vg-10")
					{
						
						var items1 = Array(41.0,41.5,42.0,42.5,43.0,43.5,44.0,44.5,45.0,45.5,46.0,46.5,47.0);
						var avg_sof = jQuery.rand(items1);
					}
					else if(grades=="vg-20")
					{
						var items1 = Array(46.0,46.5,47.0,47.5,48.0,48.5,49.0,49.5,50.0,50.5);
						var avg_sof = jQuery.rand(items1);
					}
					else if(grades=="vg-30")
					{
						var items1 = Array(50.0,50.5,51.0,51.5,52.0,52.5);
						var avg_sof = jQuery.rand(items1);
					}
					else if(grades=="vg-40")
					{
						var items1 = Array(52.5,53.0,53.5,54.0,54.5,55.0,55.5,56.0);
						var avg_sof = jQuery.rand(items1);
					}
					$('#avg_sof').val(avg_sof.toFixed(1));
					var avgsof = $('#avg_sof').val();
					var tt= randomNumberFromRange(0,9).toFixed();
					if(tt % 2 == 0)
					{
							var rnf = randomNumberFromRange(-0.4,0.4).toFixed(1);
							var bn_1  = (+avgsof) - (+rnf);
							var bn_2  = (+avgsof) + (+rnf);
							
					}
					else
					{
						if(tt == 0)
						{
							
							var rnf = randomNumberFromRange(-0.4,0.4).toFixed(1);
							var bn_1  = (+avgsof) + (+rnf);
							var bn_2  = (+avgsof) - (+rnf);
						}
						else
						{
														
							var rnf = randomNumberFromRange(-0.4,0.4).toFixed(1);
							var bn_1  = (+avgsof) - (+rnf);
							var bn_2  = (+avgsof) + (+rnf);
						}
							
					}
						
					
					var tw1 = randomNumberFromRange(5.0, 5.0);
		$('#tw1').val(tw1.toFixed(1));
		var tw2 = randomNumberFromRange(5.0, 5.0);
		$('#tw2').val(tw2.toFixed(1));
		
		var tw3 = randomNumberFromRange(10.2, 10.2);
		$('#tw3').val(tw3.toFixed(1));
		var tw4 = randomNumberFromRange(10.2, 10.2);
		$('#tw4').val(tw4.toFixed(1));
		
		var tw5 = randomNumberFromRange(14.9, 14.9);
		$('#tw5').val(tw5.toFixed(1));
		var tw6 = randomNumberFromRange(14.9, 14.9);
		$('#tw6').val(tw6.toFixed(1));
		
		var tw7 = randomNumberFromRange(19.8, 19.8);
		$('#tw7').val(tw7.toFixed(1));
		var tw8 = randomNumberFromRange(19.8, 19.8);
		$('#tw8').val(tw8.toFixed(1));
		
		var tw9 = randomNumberFromRange(25.1, 25.1);
		$('#tw9').val(tw9.toFixed(1));
		var tw10 = randomNumberFromRange(25.1, 25.1);
		$('#tw10').val(tw10.toFixed(1));
		
		var tw11 = randomNumberFromRange(29.9, 29.9);
		$('#tw11').val(tw11.toFixed(1));
		var tw12 = randomNumberFromRange(29.9, 29.9);
		$('#tw12').val(tw12.toFixed(1));
		
		var tw13 = randomNumberFromRange(34.8, 34.8);
		$('#tw13').val(tw13.toFixed(1));
		var tw14 = randomNumberFromRange(34.8, 34.8);
		$('#tw14').val(tw14.toFixed(1));
		
		var tw15 = randomNumberFromRange(40.1, 40.1);
		$('#tw15').val(tw15.toFixed(1));
		var tw16 = randomNumberFromRange(40.1, 40.1);
		$('#tw16').val(tw16.toFixed(1));
		
		var tw17 = randomNumberFromRange(45.6, 46.8);
		$('#tw17').val(tw17.toFixed(1));
		var tw18 = randomNumberFromRange(45.6, 46.8);
		$('#tw18').val(tw18.toFixed(1));
		
		var tw19 = randomNumberFromRange(0, 0);
		$('#tw19').val(tw19.toFixed(1));
		var tw20 = randomNumberFromRange(0, 0);
		$('#tw20').val(tw20.toFixed(1));
		
		var tw21 = randomNumberFromRange(0, 0);
		$('#tw21').val(tw21.toFixed(1));
		var tw22 = randomNumberFromRange(0, 0);
		$('#tw22').val(tw22.toFixed(1));
		
		
					
				
					
					
				
					$('#bn_1').val(bn_1.toFixed(1));
					$('#bn_2').val(bn_2.toFixed(1));
					$('#sof_2').val("");
	}
	
	$('#chk_sof').change(function(){
        if(this.checked)
		{ 
				
				 sof_auto();
		}
		else
		{
					$('#bn_1').val(null);
					$('#bn_2').val(null);
					$('#sof_2').val(null);
					$('#tw1').val(null);
					$('#tw2').val(null);
					$('#tw3').val(null);
					$('#tw4').val(null);
					$('#tw5').val(null);
					$('#tw6').val(null);
					$('#tw7').val(null);
					$('#tw8').val(null);
					$('#tw9').val(null);
					$('#tw10').val(null);
					$('#tw11').val(null);
					$('#tw12').val(null);
					$('#tw13').val(null);
					$('#tw14').val(null);
					$('#tw15').val(null);
					$('#tw16').val(null);
					$('#tw17').val(null);
					$('#tw18').val(null);
					$('#tw19').val(null);
					$('#tw20').val(null);
					$('#tw21').val(null);
					$('#tw22').val(null);
					
					$('#avg_sof').val(null);
		}
	});
	
	$('#avg_sof').change(function(){
        	if ($("#chk_sof").is(':checked')) {
					
					
					var avgsof = $('#avg_sof').val();
					
					/*var grades = $('#bitumin_grade').val();
					if(grades=="vg-10")
					{
						
						var items1 = Array(41.0,41.5,42.0,42.5,43.0,43.5,44.0,44.5,45.0,45.5,46.0,46.5,47.0);
						var avg_sof = jQuery.rand(items1);
					}
					else if(grades=="vg-20")
					{
						var items1 = Array(46.0,46.5,47.0,47.5,48.0,48.5,49.0,49.5,50.0,50.5);
						var avg_sof = jQuery.rand(items1);
					}
					else if(grades=="vg-30")
					{
						var items1 = Array(48.0,48.5,49.0,49.5,50.0,50.5,51.0,51.5,52.0,52.5);
						var avg_sof = jQuery.rand(items1);
					}
					else if(grades=="vg-40")
					{
						var items1 = Array(51.0,51.5,52.0,52.5,53.0,53.5,54.0,54.5,55.0,55.5,56.0);
						var avg_sof = jQuery.rand(items1);
					}*/
					//$('#avg_sof').val(avg_sof.toFixed(1));
					
					var tt= randomNumberFromRange(0,9).toFixed();
					if(tt % 2 == 0)
					{
							var rnf = randomNumberFromRange(-0.4,0.4).toFixed(1);
							var bn_1  = (+avgsof) - (+rnf);
							var bn_2  = (+avgsof) + (+rnf);
							
					}
					else
					{
						if(tt == 0)
						{
							
							var rnf = randomNumberFromRange(-0.4,0.4).toFixed(1);
							var bn_1  = (+avgsof) + (+rnf);
							var bn_2  = (+avgsof) - (+rnf);
						}
						else
						{
														
							var rnf = randomNumberFromRange(-0.4,0.4).toFixed(1);
							var bn_1  = (+avgsof) - (+rnf);
							var bn_2  = (+avgsof) + (+rnf);
						}
							
					}
						
					
					
					
				
					
					
				
					$('#bn_1').val(bn_1.toFixed(1));
					$('#bn_2').val(bn_2.toFixed(1));
					$('#sof_2').val("");					
					
			}
					
				
	});
	
	$('#bn_1').change(function(){
		sof_1_2_3();
	});
	$('#bn_2').change(function(){
		sof_1_2_3();
	});
	$('#sof_2').change(function(){
		sof_1_2_3();
	});
	
	function sof_1_2_3()
	{
		$('#txtsof').css("background-color","var(--success)");	
		 var sof_0 = $('#bn_1').val();
		 var sof_1 = $('#bn_2').val();
		 
		 
		 var avg_sof = ((+sof_0) + (+sof_1))/2;
		 
		 var as = (+avg_sof) / 0.5;
		 var temp = as.toFixed();
		 var ans = (+temp) * 0.5;
		 $('#avg_sof').val(ans.toFixed(1));
	}
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--success)"); 
			//$('#txtfla').css("background-color","var(--success)"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				//los
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="los")
					{
						$('#txtlos').css("background-color","var(--success)");
						$("#chk_los").prop("checked", true); 
						los_avg();
						break;
					}					
				}
				
				//sof
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sof")
					{
						$('#txtsof').css("background-color","var(--success)");
						$("#chk_sof").prop("checked", true); 
						 sof_auto()
						break;
					}					
				}
		
				//Kin
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="kin")
					{
						$('#txtkin').css("background-color","var(--success)");	
						$("#chk_kin").prop("checked", true); 
						kin_auto();
						break;
					}					
				}
				
				//Abs
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abs")
					{
						$('#txtabs').css("background-color","var(--success)"); 
						$("#chk_abs").prop("checked", true); 
						abs_auto();
						break;
					}					
				}
				
				//sp
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fla")
					{
						$('#txtfla').css("background-color","var(--success)"); 
						$("#chk_sp").prop("checked", true); 
						sp_auto();
						break;
					}					
				}
			
				//duc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="duc")
					{
						$('#txtduc').css("background-color","var(--success)"); 
						$("#chk_duc").prop("checked", true); 
						duc_auto();
						break;
					}					
				}
				
				//pen
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pen")
					{
						$('#txtpen').css("background-color","var(--success)"); 
						$("#chk_pen").prop("checked", true); 
						pen_auto();
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
        url: '<?php echo $base_url; ?>save_bitumin.php',
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
				var tag_heading = $('#tag_heading').val();
				var tag_data = $('#tag_data').val();
				var s_des = $('#s_des').val();
				var r_sam = $('#r_sam').val();
				var s_ret = $('#s_ret').val();
				var qty_1 = $('#qty_1').val();
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//penetration
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pen")
					{
						if(document.getElementById('chk_pen').checked) {
								var chk_pen = "1";
						}
						else{
								var chk_pen = "0";
						}	
							
							var pen_temp = $('#pen_temp').val();													
							var pen_1 = $('#pen_1').val();
							var pen_2 = $('#pen_2').val();
							var pen_3 = $('#pen_3').val();
							var avg_pen = $('#avg_pen').val();
							var idg_1 = $('#idg_1').val();
                            var idg_2 = $('#idg_2').val();
                            var idg_3 = $('#idg_3').val();
                            var fdg_1 = $('#fdg_1').val();
                            var fdg_2 = $('#fdg_2').val();
                            var fdg_3 = $('#fdg_3').val();

							
						
						break;
					}
					else
					{
							var chik_pen = "0";
							var pen_temp = "0";
							var pen_1 = "0";
							var pen_2 = "0";
							var pen_3 = "0";
							var avg_pen = "0";
							var idg_1 = "0";
                            var idg_2 = "0";
                            var idg_3 = "0";
                            var fdg_1 = "0";
                            var fdg_2 = "0";
                            var fdg_3 = "0";


					}
														
				}
				
				//ductility
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="duc")
					{
						if(document.getElementById('chk_duc').checked) {
								var chk_duc = "1";
						}
						else{
								var chk_duc = "0";
						}	
							
							var duc_temp = $('#duc_temp').val();													
							var duc_1 = $('#duc_1').val();
							var duc_2 = $('#duc_2').val();
							var duc_3 = $('#duc_3').val();
							var avg_duc = $('#avg_duc').val();
							var air_1 = $('#air_1').val();
							var bath_1 = $('#bath_1').val();

						
						break;
					}
					else
					{
							var chik_duc = "0";
							var duc_temp = "0";
							var duc_1 = "0";
							var duc_2 = "0";
							var duc_3 = "0";
							var avg_duc = "0";
							var air_1 = "0";
							var bath_1 = "0";

					}
														
				}

				
				
				// softing point
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sof")
					{
						
							if(document.getElementById('chk_sof').checked) {
									var chk_sof = "1";
							}
							else{
									var chk_sof = "0";
							}
						
							var sof_0 = $('#sof_0').val();
							var sof_1 = $('#sof_1').val();
							var sof_2 = $('#sof_2').val();
							var tw1 = $('#tw1').val();
							var tw2 = $('#tw2').val();
							var tw3 = $('#tw3').val();
							var tw4 = $('#tw4').val();
							var tw5 = $('#tw5').val();
							var tw6 = $('#tw6').val();
							var tw7 = $('#tw7').val();
							var tw8 = $('#tw8').val();
							var tw9 = $('#tw9').val();
							var tw10 = $('#tw10').val();
							var tw11 = $('#tw11').val();
							var tw12 = $('#tw12').val();
							var tw13 = $('#tw13').val();
							var tw14 = $('#tw14').val();
							var tw15 = $('#tw15').val();
							var tw16 = $('#tw16').val();
							var tw17 = $('#tw17').val();
							var tw18 = $('#tw18').val();
							var tw19 = $('#tw19').val();
							var tw20 = $('#tw20').val();
							var tw21 = $('#tw21').val();
							var tw22 = $('#tw22').val();
							var sf1 = $('#sf1').val();
							var sf2 = $('#sf2').val();
							var sf3 = $('#sf3').val();
							var sf4 = $('#sf4').val();
							var sf5 = $('#sf5').val();
							var sf6 = $('#sf6').val();
							var sf7 = $('#sf7').val();
							var sf8 = $('#sf8').val();
							var sf9 = $('#sf9').val();
							var sf10 = $('#sf10').val();
							var sf11 = $('#sf11').val();
							var bn_1 = $('#bn_1').val();
							var bn_2 = $('#bn_2').val();
							
							var avg_sof = $('#avg_sof').val();							
							break;
					}
					else
					{
						var chk_sof = "0";	
						var sof_0 = "0";	
						var sof_1 = "0";	
						var sof_2 = "0";
						var tw1 = "0";
							var tw2 = "0";
							var tw3 = "0";
							var tw4 = "0";
							var tw5 = "0";
							var tw6 = "0";
							var tw7 = "0";
							var tw8 = "0";
							var tw9 = "0";
							var tw10 = "0";
							var tw11 = "0";
							var tw12 = "0";
							var tw13 = "0";
							var tw14 = "0";
							var tw15 = "0";
							var tw16 = "0";
							var tw17 = "0";
							var tw18 = "0";
							var tw19 = "0";
							var tw20 = "0";
							var tw21 = "0";
							var tw22 = "0";
							var sf1 = "0";
							var sf2 = "0";
							var sf3 = "0";
							var sf4 = "0";
							var sf5 = "0";
							var sf6 = "0";
							var sf7 = "0";
							var sf8 = "0";
							var sf9 = "0";
							var sf10 = "0";
							var sf11 = "0";
							var bn_1 = "0";
							var bn_2 = "0";
							
							
						var avg_sof = "0";	
					}

				}
				
				//SP
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fla")
					{	
						/* if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}					 */
						//specific gravity and water abrasion-5							
						var sp_a_1 = $('#sp_a_1').val();			
						var sp_a_2 = $('#sp_a_2').val();			
						var sp_b_1 = $('#sp_b_1').val();			
						var sp_b_2 = $('#sp_b_2').val();				
						var sp_c_1 = $('#sp_c_1').val();						
						var sp_c_2 = $('#sp_c_2').val();						
						var sp_d_1 = $('#sp_d_1').val();														
						var sp_d_2 = $('#sp_d_2').val();				
						var sp_1 = $('#sp_1').val();				
						var sp_2 = $('#sp_2').val();				
						var avg_sp = $('#avg_sp').val();					
						var sp_temp = $('#sp_temp').val(); 						
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_temp ="0";
						var sp_a_1 = "0";			
						var sp_a_2 = "0";		
						var sp_b_1 = "0";			
						var sp_b_2 = "0";
						var sp_c_1 = "0";
						var sp_c_2 = "0";
						var sp_d_1 = "0";
						var sp_d_2 = "0";
						var sp_1 = "0";
						var sp_2 = "0";
						var avg_sp = "0";
					}
				
				}
				
				//Absolute viscosity
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abs")
					{	
						if(document.getElementById('chk_abs').checked) {
							var chk_abs = "1";
						}
						else{
							var chk_abs = "0";
						}					
											
						var abs_1_1 = $('#abs_1_1').val();			
						var abs_1_2 = $('#abs_1_2').val();			
						var abs_2_1 = $('#abs_2_1').val();			
						var abs_2_2 = $('#abs_2_2').val();			
						var abs_3_1 = $('#abs_3_1').val();			
						var abs_3_2 = $('#abs_3_2').val();			
						var abs_4_1 = $('#abs_4_1').val();			
						var abs_4_2 = $('#abs_4_2').val();			
						var abs_5_1 = $('#abs_5_1').val();			
						var abs_5_2 = $('#abs_5_2').val();			
						var abs_6_1 = $('#abs_6_1').val();			
						var abs_6_2 = $('#abs_6_2').val();			
						var abs_7_1 = $('#abs_7_1').val();			
						var abs_7_2 = $('#abs_7_2').val();			
						var abs_8_1 = $('#abs_8_1').val();			
						var abs_8_2 = $('#abs_8_2').val();			
						var abs_9_1 = $('#abs_9_1').val();			
						var abs_9_2 = $('#abs_9_2').val();			
						var avg_abs = $('#avg_abs').val();			
						
						break;
					}
					else
					{
						var chk_abs = "0";
						var abs_1_1 = "0";
						var abs_1_2 = "0";
						var abs_2_1 = "0";
						var abs_2_2 = "0";
						var abs_3_1 = "0";
						var abs_3_2 = "0";
						var abs_4_1 = "0";
						var abs_4_2 = "0";
						var abs_5_1 = "0";
						var abs_5_2 = "0";
						var abs_6_1 = "0";
						var abs_6_2 = "0";
						var abs_7_1 = "0";
						var abs_7_2 = "0";
						var abs_8_1 = "0";
						var abs_8_2 = "0";
						var abs_9_1 = "0";
						var abs_9_2 = "0";
						var avg_abs = "0";
					}
				
				}
				
				
				//kinematic viscosity
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="kin")
					{	
						if(document.getElementById('chk_kin').checked) {
							var chk_kin = "1";
						}
						else{
							var chk_kin = "0";
						}					
											
						var kin_1_1 = $('#kin_1_1').val();			
						var kin_1_2 = $('#kin_1_2').val();			
						var kin_2_1 = $('#kin_2_1').val();			
						var kin_2_2 = $('#kin_2_2').val();			
						var kin_3_1 = $('#kin_3_1').val();			
						var kin_3_2 = $('#kin_3_2').val();			
						var kin_4_1 = $('#kin_4_1').val();			
						var kin_4_2 = $('#kin_4_2').val();			
						var kin_5_1 = $('#kin_5_1').val();			
						var kin_5_2 = $('#kin_5_2').val();			
						var kin_6_1 = $('#kin_6_1').val();			
						var kin_6_2 = $('#kin_6_2').val();											
						var avg_kin = $('#avg_kin').val();			
						
						break;
					}
					else
					{
						var chk_kin = "0";
						var kin_1_1 = "0";
						var kin_1_2 = "0";
						var kin_2_1 = "0";
						var kin_2_2 = "0";
						var kin_3_1 = "0";
						var kin_3_2 = "0";
						var kin_4_1 = "0";
						var kin_4_2 = "0";
						var kin_5_1 = "0";
						var kin_5_2 = "0";
						var kin_6_1 = "0";
						var kin_6_2 = "0";						
						var avg_kin = "0";
					}
				
				}
				
				//loss on heating
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="los")
					{	
						if(document.getElementById('chk_los').checked) {
							var chk_los = "1";
						}
						else{
							var chk_los = "0";
						}					
											
						var los_temp = $('#los_temp').val();			
						var los_w1_1 = $('#los_w1_1').val();			
						var los_w1_2 = $('#los_w1_2').val();			
						var los_w2_1 = $('#los_w2_1').val();			
						var los_w2_2 = $('#los_w2_2').val();			
						var los_wt_1 = $('#los_wt_1').val();			
						var los_wt_2 = $('#los_wt_2').val();			
						var los_1 = $('#los_1').val();			
						var los_2 = $('#los_2').val();																			
						var avg_los = $('#avg_los').val();			
						
						break;
					}
					else
					{
						var chk_los = "0";
						var los_temp = "0";
						var los_w1_1 = "0";
						var los_w1_2 = "0";
						var los_w2_1 = "0";
						var los_w2_2 = "0";
						var los_wt_1 = "0";
						var los_wt_2 = "0";
						var los_1 = "0";
						var los_2 = "0";
						var avg_los = "0";
					}
				
				}
				
			
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&tank_no='+tank_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&bitumin_make='+bitumin_make+'&chk_pen='+chk_pen+'&pen_temp='+pen_temp+'&pen_1='+pen_1+'&pen_2='+pen_2+'&pen_3='+pen_3+'&avg_pen='+avg_pen+'&chk_sof='+chk_sof+'&sof_0='+sof_0+'&sof_1='+sof_1+'&sof_2='+sof_2+'&avg_sof='+avg_sof+'&chk_duc='+chk_duc+'&duc_temp='+duc_temp+'&duc_1='+duc_1+'&duc_2='+duc_2+'&duc_3='+duc_3+'&avg_duc='+avg_duc+'&chk_sp='+chk_sp+'&sp_temp='+sp_temp+'&sp_a_1='+sp_a_1+'&sp_a_2='+sp_a_2+'&sp_b_1='+sp_b_1+'&sp_b_2='+sp_b_2+'&sp_c_1='+sp_c_1+'&sp_c_2='+sp_c_2+'&sp_d_1='+sp_d_1+'&sp_d_2='+sp_d_2+'&sp_1='+sp_1+'&sp_2='+sp_2+'&avg_sp='+avg_sp+'&chk_abs='+chk_abs+'&abs_1_1='+abs_1_1+'&abs_1_2='+abs_1_2+'&abs_2_1='+abs_2_1+'&abs_2_2='+abs_2_2+'&abs_3_1='+abs_3_1+'&abs_3_2='+abs_3_2+'&abs_4_1='+abs_4_1+'&abs_4_2='+abs_4_2+'&abs_5_1='+abs_5_1+'&abs_5_2='+abs_5_2+'&abs_6_1='+abs_6_1+'&abs_6_2='+abs_6_2+'&abs_7_1='+abs_7_1+'&abs_7_2='+abs_7_2+'&abs_8_1='+abs_8_1+'&abs_8_2='+abs_8_2+'&abs_9_1='+abs_9_1+'&abs_9_2='+abs_9_2+'&avg_abs='+avg_abs+'&chk_kin='+chk_kin+'&kin_1_1='+kin_1_1+'&kin_1_2='+kin_1_2+'&kin_2_1='+kin_2_1+'&kin_2_2='+kin_2_2+'&kin_3_1='+kin_3_1+'&kin_3_2='+kin_3_2+'&kin_4_1='+kin_4_1+'&kin_4_2='+kin_4_2+'&kin_5_1='+kin_5_1+'&kin_5_2='+kin_5_2+'&kin_6_1='+kin_6_1+'&kin_6_2='+kin_6_2+'&avg_kin='+avg_kin+'&chk_los='+chk_los+'&los_temp='+los_temp+'&los_w1_1='+los_w1_1+'&los_w1_2='+los_w1_2+'&los_w2_1='+los_w2_1+'&los_w2_2='+los_w2_2+'&los_wt_1='+los_wt_1+'&los_wt_2='+los_wt_2+'&los_1='+los_1+'&los_2='+los_2+'&avg_los='+avg_los+'&ulr='+ulr+'&tag_heading='+tag_heading+'&tag_data='+tag_data+  '&air_1=' + air_1 +  '&bath_1=' + bath_1+  '&idg_1=' + idg_1 +  '&idg_2=' + idg_2 +  '&idg_3=' + idg_3 +  '&fdg_1=' + fdg_1 +  '&fdg_2=' + fdg_2 +  '&fdg_3=' + fdg_3+  '&s_des=' + s_des +  '&r_sam=' + r_sam +  '&s_ret=' + s_ret +  '&qty_1=' + qty_1+  '&tw1=' + tw1 +  '&tw2=' + tw2 +  '&tw3=' + tw3 +  '&tw4=' + tw4 +  '&tw5=' + tw5 +  '&tw6=' + tw6 +  '&tw7=' + tw7 +  '&tw8=' + tw8 +  '&tw9=' + tw9 +  '&tw10=' + tw10 +  '&tw11=' + tw11 +  '&tw12=' + tw12 +  '&tw13=' + tw13 +  '&tw14=' + tw14 +  '&tw15=' + tw15 +  '&tw16=' + tw16 +  '&tw17=' + tw17 +  '&tw18=' + tw18 +  '&tw19=' + tw19 +  '&tw20=' + tw20 +  '&tw21=' + tw21 +  '&tw22=' + tw22 +  '&sf1=' + sf1 +  '&sf2=' + sf2 +  '&sf3=' + sf3 +  '&sf4=' + sf4 +  '&sf5=' + sf5 +  '&sf6=' + sf6 +  '&sf7=' + sf7 +  '&sf8=' + sf8 +  '&sf9=' + sf9 +  '&sf10=' + sf10 +  '&sf11=' + sf11 +  '&bn_1=' + bn_1 +  '&bn_2=' + bn_2  ;
			
						
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
				var tag_heading = $('#tag_heading').val();
				var tag_data = $('#tag_data').val();
				var temp = $('#test_list').val();
				var s_des = $('#s_des').val();
				var r_sam = $('#r_sam').val();
				var s_ret = $('#s_ret').val();
				var qty_1 = $('#qty_1').val();
				var aa= temp.split(",");	
				
				//penetration
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pen")
					{
						if(document.getElementById('chk_pen').checked) {
								var chk_pen = "1";
						}
						else{
								var chk_pen = "0";
						}	
							
							var pen_temp = $('#pen_temp').val();													
							var pen_1 = $('#pen_1').val();
							var pen_2 = $('#pen_2').val();
							var pen_3 = $('#pen_3').val();
							var avg_pen = $('#avg_pen').val();
							var idg_1 = $('#idg_1').val();
                            var idg_2 = $('#idg_2').val();
                            var idg_3 = $('#idg_3').val();
                            var fdg_1 = $('#fdg_1').val();
                            var fdg_2 = $('#fdg_2').val();
                            var fdg_3 = $('#fdg_3').val();

						
						break;
					}
					else
					{
							var chik_pen = "0";
							var pen_temp = "0";
							var pen_1 = "0";
							var pen_2 = "0";
							var pen_3 = "0";
							var avg_pen = "0";
							var idg_1 = "0";
                            var idg_2 = "0";
                            var idg_3 = "0";
                            var fdg_1 = "0";
                            var fdg_2 = "0";
                            var fdg_3 = "0";


					}
														
				}
				
				//ductility
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="duc")
					{
						if(document.getElementById('chk_duc').checked) {
								var chk_duc = "1";
						}
						else{
								var chk_duc = "0";
						}	
							
							var duc_temp = $('#duc_temp').val();													
							var duc_1 = $('#duc_1').val();
							var duc_2 = $('#duc_2').val();
							var duc_3 = $('#duc_3').val();
							var avg_duc = $('#avg_duc').val();
							var air_1 = $('#air_1').val();
							var bath_1 = $('#bath_1').val();

						
						break;
					}
					else
					{
							var chik_duc = "0";
							var duc_temp = "0";
							var duc_1 = "0";
							var duc_2 = "0";
							var duc_3 = "0";
							var avg_duc = "0";
							var air_1 = "0";
							var bath_1 = "0";

					}
														
				}
				
				
				
				
				
				// softing point
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sof")
					{
						
							if(document.getElementById('chk_sof').checked) {
									var chk_sof = "1";
							}
							else{
									var chk_sof = "0";
							}
						
							var sof_0 = $('#sof_0').val();
							var sof_1 = $('#sof_1').val();
							var sof_2 = $('#sof_2').val();
							var tw1 = $('#tw1').val();
							var tw2 = $('#tw2').val();
							var tw3 = $('#tw3').val();
							var tw4 = $('#tw4').val();
							var tw5 = $('#tw5').val();
							var tw6 = $('#tw6').val();
							var tw7 = $('#tw7').val();
							var tw8 = $('#tw8').val();
							var tw9 = $('#tw9').val();
							var tw10 = $('#tw10').val();
							var tw11 = $('#tw11').val();
							var tw12 = $('#tw12').val();
							var tw13 = $('#tw13').val();
							var tw14 = $('#tw14').val();
							var tw15 = $('#tw15').val();
							var tw16 = $('#tw16').val();
							var tw17 = $('#tw17').val();
							var tw18 = $('#tw18').val();
							var tw19 = $('#tw19').val();
							var tw20 = $('#tw20').val();
							var tw21 = $('#tw21').val();
							var tw22 = $('#tw22').val();
							var sf1 = $('#sf1').val();
							var sf2 = $('#sf2').val();
							var sf3 = $('#sf3').val();
							var sf4 = $('#sf4').val();
							var sf5 = $('#sf5').val();
							var sf6 = $('#sf6').val();
							var sf7 = $('#sf7').val();
							var sf8 = $('#sf8').val();
							var sf9 = $('#sf9').val();
							var sf10 = $('#sf10').val();
							var sf11 = $('#sf11').val();
							var bn_1 = $('#bn_1').val();
							var bn_2 = $('#bn_2').val();
							
							var avg_sof = $('#avg_sof').val();							
							break;
					}
					else
					{
						var chk_sof = "0";	
						var sof_0 = "0";	
						var sof_1 = "0";	
						var sof_2 = "0";
							var tw1 = "0";
							var tw2 = "0";
							var tw3 = "0";
							var tw4 = "0";
							var tw5 = "0";
							var tw6 = "0";
							var tw7 = "0";
							var tw8 = "0";
							var tw9 = "0";
							var tw10 = "0";
							var tw11 = "0";
							var tw12 = "0";
							var tw13 = "0";
							var tw14 = "0";
							var tw15 = "0";
							var tw16 = "0";
							var tw17 = "0";
							var tw18 = "0";
							var tw19 = "0";
							var tw20 = "0";
							var tw21 = "0";
							var tw22 = "0";
							var sf1 = "0";
							var sf2 = "0";
							var sf3 = "0";
							var sf4 = "0";
							var sf5 = "0";
							var sf6 = "0";
							var sf7 = "0";
							var sf8 = "0";
							var sf9 = "0";
							var sf10 = "0";
							var sf11 = "0";						
							var bn_1 = "0";						
							var bn_2 = "0";						
						
						var avg_sof = "0";	
					}

				}
				
				//SP
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fla")
					{	
						/* if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}		 */			
						//specific gravity and water abrasion-5							
						var sp_a_1 = $('#sp_a_1').val();			
						var sp_a_2 = $('#sp_a_2').val();			
						var sp_b_1 = $('#sp_b_1').val();			
						var sp_b_2 = $('#sp_b_2').val();				
						var sp_c_1 = $('#sp_c_1').val();						
						var sp_c_2 = $('#sp_c_2').val();						
						var sp_d_1 = $('#sp_d_1').val();														
						var sp_d_2 = $('#sp_d_2').val();				
						var sp_1 = $('#sp_1').val();				
						var sp_2 = $('#sp_2').val();				
						var avg_sp = $('#avg_sp').val();					
						var sp_temp = $('#sp_temp').val(); 						
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_a_1 = "0";		
						var sp_a_2 = "0";		
						var sp_b_1 = "0";		
						var sp_b_2 = "0";			
						var sp_c_1 = "0";					
						var sp_c_2 = "0";					
						var sp_d_1 = "0";													
						var sp_d_2 = "0";			
						var sp_1 = "0";				
						var sp_2 = "0";				
						var avg_sp = "0";					
						var sp_temp = "0";
					}
				
				}
				
				//Absolute viscosity
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abs")
					{	
						if(document.getElementById('chk_abs').checked) {
							var chk_abs = "1";
						}
						else{
							var chk_abs = "0";
						}					
											
						var abs_1_1 = $('#abs_1_1').val();			
						var abs_1_2 = $('#abs_1_2').val();			
						var abs_2_1 = $('#abs_2_1').val();			
						var abs_2_2 = $('#abs_2_2').val();			
						var abs_3_1 = $('#abs_3_1').val();			
						var abs_3_2 = $('#abs_3_2').val();			
						var abs_4_1 = $('#abs_4_1').val();			
						var abs_4_2 = $('#abs_4_2').val();			
						var abs_5_1 = $('#abs_5_1').val();			
						var abs_5_2 = $('#abs_5_2').val();			
						var abs_6_1 = $('#abs_6_1').val();			
						var abs_6_2 = $('#abs_6_2').val();			
						var abs_7_1 = $('#abs_7_1').val();			
						var abs_7_2 = $('#abs_7_2').val();			
						var abs_8_1 = $('#abs_8_1').val();			
						var abs_8_2 = $('#abs_8_2').val();			
						var abs_9_1 = $('#abs_9_1').val();			
						var abs_9_2 = $('#abs_9_2').val();			
						var avg_abs = $('#avg_abs').val();			
						
						break;
					}
					else
					{
						var chk_abs = "0";
						var abs_1_1 = "0";
						var abs_1_2 = "0";
						var abs_2_1 = "0";
						var abs_2_2 = "0";
						var abs_3_1 = "0";
						var abs_3_2 = "0";
						var abs_4_1 = "0";
						var abs_4_2 = "0";
						var abs_5_1 = "0";
						var abs_5_2 = "0";
						var abs_6_1 = "0";
						var abs_6_2 = "0";
						var abs_7_1 = "0";
						var abs_7_2 = "0";
						var abs_8_1 = "0";
						var abs_8_2 = "0";
						var abs_9_1 = "0";
						var abs_9_2 = "0";
						var avg_abs = "0";
					}
				
				}
				
				
				//kinematic viscosity
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="kin")
					{	
						if(document.getElementById('chk_kin').checked) {
							var chk_kin = "1";
						}
						else{
							var chk_kin = "0";
						}					
											
						var kin_1_1 = $('#kin_1_1').val();			
						var kin_1_2 = $('#kin_1_2').val();			
						var kin_2_1 = $('#kin_2_1').val();			
						var kin_2_2 = $('#kin_2_2').val();			
						var kin_3_1 = $('#kin_3_1').val();			
						var kin_3_2 = $('#kin_3_2').val();			
						var kin_4_1 = $('#kin_4_1').val();			
						var kin_4_2 = $('#kin_4_2').val();			
						var kin_5_1 = $('#kin_5_1').val();			
						var kin_5_2 = $('#kin_5_2').val();			
						var kin_6_1 = $('#kin_6_1').val();			
						var kin_6_2 = $('#kin_6_2').val();											
						var avg_kin = $('#avg_kin').val();			
						
						break;
					}
					else
					{
						var chk_kin = "0";
						var kin_1_1 = "0";
						var kin_1_2 = "0";
						var kin_2_1 = "0";
						var kin_2_2 = "0";
						var kin_3_1 = "0";
						var kin_3_2 = "0";
						var kin_4_1 = "0";
						var kin_4_2 = "0";
						var kin_5_1 = "0";
						var kin_5_2 = "0";
						var kin_6_1 = "0";
						var kin_6_2 = "0";						
						var avg_kin = "0";
					}
				
				}
				
				//loss on heating
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="los")
					{	
						if(document.getElementById('chk_los').checked) {
							var chk_los = "1";
						}
						else{
							var chk_los = "0";
						}					
											
						var los_temp = $('#los_temp').val();			
						var los_w1_1 = $('#los_w1_1').val();			
						var los_w1_2 = $('#los_w1_2').val();			
						var los_w2_1 = $('#los_w2_1').val();			
						var los_w2_2 = $('#los_w2_2').val();			
						var los_wt_1 = $('#los_wt_1').val();			
						var los_wt_2 = $('#los_wt_2').val();			
						var los_1 = $('#los_1').val();			
						var los_2 = $('#los_2').val();																			
						var avg_los = $('#avg_los').val();			
						
						break;
					}
					else
					{
						var chk_los = "0";
						var los_temp = "0";
						var los_w1_1 = "0";
						var los_w1_2 = "0";
						var los_w2_1 = "0";
						var los_w2_2 = "0";
						var los_wt_1 = "0";
						var los_wt_2 = "0";
						var los_1 = "0";
						var los_2 = "0";
						var avg_los = "0";
					}
				
				}
				
			
				
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&tank_no='+tank_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&bitumin_make='+bitumin_make+'&chk_pen='+chk_pen+'&pen_temp='+pen_temp+'&pen_1='+pen_1+'&pen_2='+pen_2+'&pen_3='+pen_3+'&avg_pen='+avg_pen+'&chk_sof='+chk_sof+'&sof_0='+sof_0+'&sof_1='+sof_1+'&sof_2='+sof_2+'&avg_sof='+avg_sof+'&chk_duc='+chk_duc+'&duc_temp='+duc_temp+'&duc_1='+duc_1+'&duc_2='+duc_2+'&duc_3='+duc_3+'&avg_duc='+avg_duc+'&chk_sp='+chk_sp+'&sp_temp='+sp_temp+'&sp_a_1='+sp_a_1+'&sp_a_2='+sp_a_2+'&sp_b_1='+sp_b_1+'&sp_b_2='+sp_b_2+'&sp_c_1='+sp_c_1+'&sp_c_2='+sp_c_2+'&sp_d_1='+sp_d_1+'&sp_d_2='+sp_d_2+'&sp_1='+sp_1+'&sp_2='+sp_2+'&avg_sp='+avg_sp+'&chk_abs='+chk_abs+'&abs_1_1='+abs_1_1+'&abs_1_2='+abs_1_2+'&abs_2_1='+abs_2_1+'&abs_2_2='+abs_2_2+'&abs_3_1='+abs_3_1+'&abs_3_2='+abs_3_2+'&abs_4_1='+abs_4_1+'&abs_4_2='+abs_4_2+'&abs_5_1='+abs_5_1+'&abs_5_2='+abs_5_2+'&abs_6_1='+abs_6_1+'&abs_6_2='+abs_6_2+'&abs_7_1='+abs_7_1+'&abs_7_2='+abs_7_2+'&abs_8_1='+abs_8_1+'&abs_8_2='+abs_8_2+'&abs_9_1='+abs_9_1+'&abs_9_2='+abs_9_2+'&avg_abs='+avg_abs+'&chk_kin='+chk_kin+'&kin_1_1='+kin_1_1+'&kin_1_2='+kin_1_2+'&kin_2_1='+kin_2_1+'&kin_2_2='+kin_2_2+'&kin_3_1='+kin_3_1+'&kin_3_2='+kin_3_2+'&kin_4_1='+kin_4_1+'&kin_4_2='+kin_4_2+'&kin_5_1='+kin_5_1+'&kin_5_2='+kin_5_2+'&kin_6_1='+kin_6_1+'&kin_6_2='+kin_6_2+'&avg_kin='+avg_kin+'&chk_los='+chk_los+'&los_temp='+los_temp+'&los_w1_1='+los_w1_1+'&los_w1_2='+los_w1_2+'&los_w2_1='+los_w2_1+'&los_w2_2='+los_w2_2+'&los_wt_1='+los_wt_1+'&los_wt_2='+los_wt_2+'&los_1='+los_1+'&los_2='+los_2+'&avg_los='+avg_los+'&ulr='+ulr+'&tag_heading='+tag_heading+'&tag_data='+tag_data+  '&air_1=' + air_1 +  '&bath_1=' + bath_1+  '&idg_1=' + idg_1 +  '&idg_2=' + idg_2 +  '&idg_3=' + idg_3 +  '&fdg_1=' + fdg_1 +  '&fdg_2=' + fdg_2 +  '&fdg_3=' + fdg_3+  '&s_des=' + s_des +  '&r_sam=' + r_sam +  '&s_ret=' + s_ret +  '&qty_1=' + qty_1 +  '&tw1=' + tw1 +  '&tw2=' + tw2 +  '&tw3=' + tw3 +  '&tw4=' + tw4 +  '&tw5=' + tw5 +  '&tw6=' + tw6 +  '&tw7=' + tw7 +  '&tw8=' + tw8 +  '&tw9=' + tw9 +  '&tw10=' + tw10 +  '&tw11=' + tw11 +  '&tw12=' + tw12 +  '&tw13=' + tw13 +  '&tw14=' + tw14 +  '&tw15=' + tw15 +  '&tw16=' + tw16 +  '&tw17=' + tw17 +  '&tw18=' + tw18 +  '&tw19=' + tw19 +  '&tw20=' + tw20 +  '&tw21=' + tw21 +  '&tw22=' + tw22 +  '&sf1=' + sf1 +  '&sf2=' + sf2 +  '&sf3=' + sf3 +  '&sf4=' + sf4 +  '&sf5=' + sf5 +  '&sf6=' + sf6 +  '&sf7=' + sf7 +  '&sf8=' + sf8 +  '&sf9=' + sf9 +  '&sf10=' + sf10 +  '&sf11=' + sf11 +  '&bn_1=' + bn_1 +  '&bn_2=' + bn_2 ;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_bitumin.php',
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
        url: '<?php echo $base_url; ?>save_bitumin.php',
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
            $('#tag_heading').val(data.tag_heading);
            $('#tag_data').val(data.tag_data);
			$('#s_des').val(data.s_des);
			$('#r_sam').val(data.r_sam);
			$('#s_ret').val(data.s_ret);
			$('#qty_1').val(data.qty_1);
			
            var temp = $('#test_list').val();
				var aa= temp.split(",");				
				//penetration
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pen")
					{
						
						var chk_pen = data.chk_pen;
						if(chk_pen=="1")
						{
							$('#txtpen').css("background-color","var(--success)");	
						   $("#chk_pen").prop("checked", true); 
						 
						}else{
							$('#txtpen').css("background-color","white");	
							$("#chk_pen").prop("checked", false);
						
						}
						
								//GRADATION DATA FETCH-1
						$('#pen_temp').val(data.pen_temp);
						$('#pen_1').val(data.pen_1);
						$('#pen_2').val(data.pen_2);
						$('#pen_3').val(data.pen_3);
						$('#avg_pen').val(data.avg_pen);
						$('#idg_1').val(data.idg_1);
                        $('#idg_2').val(data.idg_2);
                        $('#idg_3').val(data.idg_3);
                        $('#fdg_1').val(data.fdg_1);
                        $('#fdg_2').val(data.fdg_2);
                        $('#fdg_3').val(data.fdg_3);
						
						break;
					}
					else
					{
						
					}
														
				}
				
				
				
			
				//ductility
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="duc")
					{
						
						var chk_duc = data.chk_duc;
						if(chk_duc=="1")
						{
							$('#txtduc').css("background-color","var(--success)");	
						   $("#chk_duc").prop("checked", true); 
						 
						}else{
							$('#txtduc').css("background-color","white");	
							$("#chk_duc").prop("checked", false);
						
						}
								//GRADATION DATA FETCH-1
						$('#duc_temp').val(data.duc_temp);
						$('#duc_1').val(data.duc_1);
						$('#duc_2').val(data.duc_2);
						$('#duc_3').val(data.duc_3);
						$('#avg_duc').val(data.avg_duc);
						$('#air_1').val(data.air_1);
						$('#bath_1').val(data.bath_1);
						


						
						
						break;
					}
					else
					{
						
					}
														
				}
			
				
				//sp 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fla")
					{	var chk_sp = data.chk_sp;
							if(chk_sp=="1")
							{
								$('#txtfla').css("background-color","var(--success)");	
							   $("#chk_sp").prop("checked", true); 
							}else{
								$('#txtfla').css("background-color","white");	
								$("#chk_sp").prop("checked", false); 
							}
						//specific gravity
						$('#sp_temp').val(data.sp_temp);
						$('#sp_a_1').val(data.sp_a_1);
						$('#sp_a_2').val(data.sp_a_2);
						$('#sp_b_1').val(data.sp_b_1);
						$('#sp_b_2').val(data.sp_b_2);	
						$('#sp_c_1').val(data.sp_c_1);
						$('#sp_c_2').val(data.sp_c_2);	
						$('#sp_d_1').val(data.sp_d_1);
						$('#sp_d_2').val(data.sp_d_2);		
						$('#sp_1').val(data.sp_1);
						$('#sp_2').val(data.sp_2);														
						$('#avg_sp').val(data.avg_sp); 
						break;
					}
					else
					{
						
					}
				
				}

				
			
				
				//sotining point
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sof")
					{
						
							
							$('#sof_0').val(data.sof_0);
							$('#sof_1').val(data.sof_1);				
							$('#sof_2').val(data.sof_2);
							$('#avg_sof').val(data.avg_sof);
							
							$('#tw1').val(data.tw1);
							$('#tw2').val(data.tw2);
							$('#tw3').val(data.tw3);
							$('#tw4').val(data.tw4);
							$('#tw5').val(data.tw5);
							$('#tw6').val(data.tw6);
							$('#tw7').val(data.tw7);
							$('#tw8').val(data.tw8);
							$('#tw9').val(data.tw9);
							$('#tw10').val(data.tw10);
							$('#tw11').val(data.tw11);
							$('#tw12').val(data.tw12);
							$('#tw13').val(data.tw13);
							$('#tw14').val(data.tw14);
							$('#tw15').val(data.tw15);
							$('#tw16').val(data.tw16);
							$('#tw17').val(data.tw17);
							$('#tw18').val(data.tw18);
							$('#tw19').val(data.tw19);
							$('#tw20').val(data.tw20);
							$('#tw21').val(data.tw21);
							$('#tw22').val(data.tw22);
							$('#sf1').val(data.sf1);
							$('#sf2').val(data.sf2);
							$('#sf3').val(data.sf3);
							$('#sf4').val(data.sf4);
							$('#sf5').val(data.sf5);
							$('#sf6').val(data.sf6);
							$('#sf7').val(data.sf7);
							$('#sf8').val(data.sf8);
							$('#sf9').val(data.sf9);
							$('#sf10').val(data.sf10);
							$('#sf11').val(data.sf11);			
							$('#bn_1').val(data.bn_1);			
							$('#bn_2').val(data.bn_2);			
							
							
							var chk_sof = data.chk_sof;
							if(chk_sof=="1")
							{
							   $('#txtsof').css("background-color","var(--success)");	
							   $("#chk_sof").prop("checked", true); 
							}else{
								$('#txtsof').css("background-color","white");	
								$("#chk_sof").prop("checked", false); 
							}	
							break;
					}
					else
					{
						
					}

				}
				
				
				
				//Absolute viscosity
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abs")
					{
						
							
							$('#abs_1_1').val(data.abs_1_1);
							$('#abs_1_2').val(data.abs_1_2);
							$('#abs_2_1').val(data.abs_2_1);
							$('#abs_2_2').val(data.abs_2_2);				
							$('#abs_3_1').val(data.abs_3_1);
							$('#abs_3_2').val(data.abs_3_2);				
							$('#abs_4_1').val(data.abs_4_1);
							$('#abs_4_2').val(data.abs_4_2);				
							$('#abs_5_1').val(data.abs_5_1);
							$('#abs_5_2').val(data.abs_5_2);				
							$('#abs_6_1').val(data.abs_6_1);
							$('#abs_6_2').val(data.abs_6_2);				
							$('#abs_7_1').val(data.abs_7_1);
							$('#abs_7_2').val(data.abs_7_2);				
							$('#abs_8_1').val(data.abs_8_1);
							$('#abs_8_2').val(data.abs_8_2);				
							$('#abs_9_1').val(data.abs_9_1);
							$('#abs_9_2').val(data.abs_9_2);				
							$('#avg_abs').val(data.avg_abs);				
							
							
							var chk_abs = data.chk_abs;
							if(chk_abs=="1")
							{
							   $('#txtabs').css("background-color","var(--success)");	
							   $("#chk_abs").prop("checked", true); 
							}else{
								$('#txtabs').css("background-color","white");	
								$("#chk_abs").prop("checked", false); 
							}	
							break;
					}
					else
					{
						
					}

				}

				
					//Kinematic viscosity
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="kin")
					{
						
							
							$('#kin_1_1').val(data.kin_1_1);
							$('#kin_1_2').val(data.kin_1_2);
							$('#kin_2_1').val(data.kin_2_1);
							$('#kin_2_2').val(data.kin_2_2);				
							$('#kin_3_1').val(data.kin_3_1);
							$('#kin_3_2').val(data.kin_3_2);				
							$('#kin_4_1').val(data.kin_4_1);
							$('#kin_4_2').val(data.kin_4_2);				
							$('#kin_5_1').val(data.kin_5_1);
							$('#kin_5_2').val(data.kin_5_2);				
							$('#kin_6_1').val(data.kin_6_1);
							$('#kin_6_2').val(data.kin_6_2);													
							$('#avg_kin').val(data.avg_kin);				
							
							
							var chk_kin = data.chk_kin;
							if(chk_kin=="1")
							{
							   $('#txtkin').css("background-color","var(--success)");	
							   $("#chk_kin").prop("checked", true); 
							}else{
								$('#txtkin').css("background-color","white");	
								$("#chk_kin").prop("checked", false); 
							}	
							break;
					}
					else
					{
						
					}

				}	
				
				
				
			
				//loss on heating
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="los")
					{
						
							
							$('#los_w1_1').val(data.los_w1_1);
							$('#los_w1_2').val(data.los_w1_2);
							$('#los_w2_1').val(data.los_w2_1);
							$('#los_w2_2').val(data.los_w2_2);
							$('#los_wt_1').val(data.los_wt_1);
							$('#los_wt_2').val(data.los_wt_2);
							$('#los_1').val(data.los_1);
							$('#los_2').val(data.los_2);
							$('#avg_los').val(data.avg_los);
							
										
							
							
							var chk_los = data.chk_los;
							if(chk_los=="1")
							{
							   $('#txtlos').css("background-color","var(--success)");	
							   $("#chk_los").prop("checked", true); 
							}else{
								$('#txtlos').css("background-color","white");	
								$("#chk_los").prop("checked", false); 
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
	</script>