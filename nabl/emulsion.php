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
		if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
		}
		if(isset($_GET['lab_no'])){
			$lab_no=$_GET['lab_no'];
			$aa	=$_GET['lab_no'];
		}
		
		  $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$bitumin_grade= $row_select4['bitumin_grade1'];
					$lot_no= $row_select4['lot_no1'];
					$tanker_no= $row_select4['tanker_no1'];
					$make= $row_select4['bitumin_make1'];
									
				}
				
		
?>
 
 
 <div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">EMULSION</h2>
					</div>
					<div class="box-default">
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">

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
										 <div class="col-sm-4">
													<label>Sample Description :</label>
												</div>								 
										  <div class="col-sm-8">
											<input type="text" class="form-control" tabindex="4" id="amend_date" name="amend_date" Value="<?php echo $lot_no;?>">
											<select class="form-control grade" id="grade" name="grade">											
												<option value="RS-1" <?php if($bitumin_grade=="RS-1"){echo "selected";}?>>RS-1</option>
												<option value="RS-2" <?php if($bitumin_grade=="RS-2"){echo "selected";}?>>RS-2</option>
												<option value="MS" <?php if($bitumin_grade=="MS"){echo "selected";}?>>MS</option>
												<option value="SS-1" <?php if($bitumin_grade=="SS-1"){echo "selected";}?>>SS-1</option>
												<option value="SS-2" <?php if($bitumin_grade=="SS-2"){echo "selected";}?>>SS-2</option>											
											</select2
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										

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
  	
	<!-- TEST WISE LOGIC VAIBHAV-->
  <?php
	$test_check;
	$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
	$result_select1 = mysqli_query($conn, $select_query1);
	while($r1 = mysqli_fetch_array($result_select1)){
		if($r1['test_code']=="vis")
		{
			$test_check.="vis,";
	?>
	<div class="panel panel-default" id ="kin">
		<div class="panel-heading" id="txtkin">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_kin">
					<h4 class="panel-title"><b>VISCOSITY BY SYOLTFUROL</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_kin" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_kin">1.</label>
								<input type="checkbox" class="visually-hidden" name="chk_kin"  id="chk_kin" value="chk_kin"><br>
							</div>
							<label for="inputEmail3" class="col-sm-10 control-label label-right">VISCOSITY</label>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<center><label class="control-label text-center">Any Grade</label></center>
						</div>
					</div>
					<!--<div class="col-sm-2">
						<div class="form-group">
							<center><label class="control-label text-center">SS2</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<center><label class="control-label text-center">RS1</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<center><label class="control-label text-center">RS2</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<center><label class="control-label text-center">MS</label></center>
						</div>
					</div>-->
					
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-2">
						<div class="form-group">
							<center><label class="control-label text-center">VISCOSITY BY SYOLTFUROL = </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems1"  id="ems1">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="hidden" class="form-control" name="ems15"  id="ems15">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="hidden" class="form-control" name="ems16"  id="ems16">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="hidden" class="form-control" name="ems17"  id="ems17">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="hidden" class="form-control" name="ems18"  id="ems18">
						</div>
					</div>
					
				</div>
				<br>
			</div>
		</div>
	</div>
				
			
<?php	
		}else if($r1['test_code']=="pen")
		{
			$test_check.="pen,";
	?>
	<div class="panel panel-default" id ="pen">
		<div class="panel-heading" id="txtpen">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_pen">
					<h4 class="panel-title"><b>PENETRATION</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_pen" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_pen">2.</label>
								<input type="checkbox" class="visually-hidden" name="chk_pen"  id="chk_pen" value="chk_pen"><br>
							</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">PENETRATION</label>
						</div>
					</div>
					<div class="col-sm-2">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label label-right">1</label>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label label-right">2</label>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label label-right">3</label>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label label-right">4</label>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label label-right">5</label>
							</div>
						</div>
						
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-2">
						<div class="form-group">
							<center><label class="control-label text-center">PENETRATION = </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems2"  id="ems2">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="pen_1"  id="pen_1">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="pen_2"  id="pen_2">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="pen_3"  id="pen_3">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="pen_4"  id="pen_4">
						</div>
					</div>
					
				</div>
				<br>
			</div>
		</div>
	</div>
				
			
<?php	
		}else if($r1['test_code']=="duc")
		{
			$test_check.="duc,";
	?>
	<div class="panel panel-default" id ="duc">
		<div class="panel-heading" id="txtduc">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_duc">
					<h4 class="panel-title"><b>DUCTILITY</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_duc" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_duc">3.</label>
								<input type="checkbox" class="visually-hidden" name="chk_duc"  id="chk_duc" value="chk_duc"><br>
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label label-right">DUCTILITY</label>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label label-right">1</label>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label label-right">2</label>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label label-right">3</label>
							</div>
						</div>
						
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">DUCTILITY = </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems3"  id="ems3">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="duc_1"  id="duc_1">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="duc_2"  id="duc_2">
						</div>
					</div>
					
				</div>
				<br>
			</div>
		</div>
	</div>
				
			
<?php	
		}else if($r1['test_code']=="res")
		{
			$test_check.="res,";
	?>
	<div class="panel panel-default" id ="res">
		<div class="panel-heading" id="txtrec">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_rec">
					<h4 class="panel-title"><b>RECUIDE BY EVAPORATION</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_rec" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_rec">4.</label>
								<input type="checkbox" class="visually-hidden" name="chk_rec"  id="chk_rec" value="chk_rec"><br>
							</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">RECUIDE</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Wt. of beaker + rod (W1)</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_1"  id="wt_1">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Wt. of beaker + rod + residue (W2)</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_2"  id="wt_2">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">RECUIDE BY EVAPORATION = </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems4"  id="ems4">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				
				<br>
			</div>
		</div>
	</div>
				
	<?php	
		}else if($r1['test_code']=="ssa")
		{
			$test_check.="ssa,";
	?>
	<div class="panel panel-default" id ="ssa">
		<div class="panel-heading" id="txtssa">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_ssa">
					<h4 class="panel-title"><b>STORAGE STABILITY</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_ssa" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-3">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_ssa">5.</label>
								<input type="checkbox" class="visually-hidden" name="chk_ssa"  id="chk_ssa" value="chk_ssa"><br>
							</div>
							<label for="inputEmail3" class="col-sm-10 control-label label-right">STORAGE STABILITY 24th HRS</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label label-right" style="text-align:center;">Top</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label label-right" style="text-align:center;">Bottom</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Wt. of beaker + rod (W1)</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_3"  id="wt_3">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_4"  id="wt_4">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_5"  id="wt_5">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_6"  id="wt_6">
						</div>
					</div>
					
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Wt. of beaker + rod + residue (W2)</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_7"  id="wt_7">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_8"  id="wt_8">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_9"  id="wt_9">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="wt_10"  id="wt_10">
						</div>
					</div>
					
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">RECUIDE BY EVAPORATION = </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems11"  id="ems11">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems12"  id="ems12">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems13"  id="ems13">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems14"  id="ems14">
						</div>
					</div>
					
				</div>
				
				<br>
			</div>
		</div>
	</div>
				
			
<?php	
		}else if($r1['test_code']=="sol")
		{
			$test_check.="sol,";
	?>
	<div class="panel panel-default" id ="sol">
		<div class="panel-heading" id="txtsol">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_sol">
					<h4 class="panel-title"><b>SOLUBILITY BY TRICHLORETHYLENE</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_sol" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_sol">6.</label>
								<input type="checkbox" class="visually-hidden" name="chk_sol"  id="chk_sol" value="chk_sol"><br>
							</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">SOLUBILITY BY TRICHLORETHYLENE</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Wt. of Bitumen (W1)</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="w1_1"  id="w1_1">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Wt. of residue (W2)</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="w2_1"  id="w2_1">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">SOLUBILITY BY TRICHLORETHYLENE = </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems5"  id="ems5">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				
				<br>
			</div>
		</div>
	</div>
	<?php	
		}else if($r1['test_code']=="mwa")
		{
			$test_check.="mwa,";
	?>
	<div class="panel panel-default" id ="mwa">
		<div class="panel-heading" id="txtmwa">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_mwa">
					<h4 class="panel-title"><b>Miscibility of Water</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_mwa" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_mwa">7.</label>
								<input type="checkbox" class="visually-hidden" name="chk_mwa"  id="chk_mwa" value="chk_mwa"><br>
							</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">Miscibility of Water</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Miscibility of Water = </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems6"  id="ems6" value="No Coagulation">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
			</div>
		</div>
	</div>
	<?php	
		}else if($r1['test_code']=="par")
		{
			$test_check.="par,";
	?>
	<div class="panel panel-default" id ="par">
		<div class="panel-heading" id="txtpar">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_par">
					<h4 class="panel-title"><b>Particle Charge</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_par" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_par">8.</label>
								<input type="checkbox" class="visually-hidden" name="chk_par"  id="chk_par" value="chk_par"><br>
							</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">Particle Charge</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Particle Charge = </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems7"  id="ems7">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Coagulation at low temperature :- </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems10"  id="ems10">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
				
			</div>
		</div>
	</div>
	<?php	
		}else if($r1['test_code']=="mic")
		{
			$test_check.="mic,";
	?>
	<div class="panel panel-default" id ="mic">
		<div class="panel-heading" id="txtmic">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_mic">
					<h4 class="panel-title"><b>Residue on 600 micron is sieve, % by mass</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_mic" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_mic">9.</label>
								<input type="checkbox" class="visually-hidden" name="chk_mic"  id="chk_mic" value="chk_mic"><br>
							</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">Residue on 600 micron is sieve, % by mass</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Wt. of Emulsion (g)</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems19"  id="ems19">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Wt. of Sieve + pan (g)</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems20"  id="ems20">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Wt. of sieve + pan + residue (g)</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems21"  id="ems21">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Residue on 600 micron is sieve, % by mass = </label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems8"  id="ems8">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				
				<div class="row">									
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Residue %</label></center>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="ems9"  id="ems9">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							
						</div>
					</div>
				</div>
				
				<br>
			</div>
		</div>
	</div>
	
	<?php	
			}
		}
	?>
	</div>
	<br>
	<hr>
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
						$querys_job1 = "SELECT * FROM emulsion WHERE `is_deleted`='0' and lab_no='$lab_no'";
						$qrys_jobno = mysqli_query($conn,$querys_job1);
						$rows=mysqli_num_rows($qrys_jobno);
						if($rows < 1){
					?>
							<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
					<?php }?>
				</div>
				<div class="col-sm-2">
					<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>
				</div>
				<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
				<?php
				/*$val =  $_SESSION['isadmin'];
				if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl"  || $_SESSION['nabl_type']=="direct_non_nabl"|| $_SESSION['nabl_type']=="non_nabl") {*/
				?>
				<div class="col-sm-2">
					<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_emulsion.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
				</div>
				<div class="col-sm-2">
					<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_emulsion.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&tbl_name=emulsion" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
				</div>
				<?php //} ?>
				
			</div>
		</div>
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
							 $query = "select * from emulsion WHERE lab_no='$aa'  and `is_deleted`='0'";

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


 $(function () {
    $('.select2').select2();
  })
	
	function kin_auto()
	{
		$('#txtkin').css("background-color","var(--success)");
		var grade = $('#grade').val();
		if(grade=="RS-1")
		{
		$('#ems1').val(randomNumberFromRange(24.00,30.00).toFixed(2));	
		}
		else if(grade=="RS-2")
		{
			$('#ems1').val(randomNumberFromRange(24.00,30.00).toFixed(2));	
		}
		else if(grade=="MS")
		{
			$('#ems1').val(randomNumberFromRange(24.00,30.00).toFixed(2));	
		}
		else if(grade=="SS-1")
		{
			$('#ems1').val(randomNumberFromRange(24.00,30.00).toFixed(2));	
		}
		else if(grade=="SS-2")
		{
			$('#ems1').val(randomNumberFromRange(24.00,30.00).toFixed(2));	
		}
		
		/* $('#ems15').val(randomNumberFromRange(62.00,64.00).toFixed(2));
		$('#ems16').val(randomNumberFromRange(64.00,66.00).toFixed(2));
		$('#ems17').val(randomNumberFromRange(66.00,68.00).toFixed(2));
		$('#ems18').val(randomNumberFromRange(68.00,70.00).toFixed(2)); */
	}
	$('#chk_kin').change(function(){
        if(this.checked)
		{
			kin_auto();
		}
        else
		{
			$('#txtkin').css("background-color","white");
			$('#ems1').val(null);
			$('#ems15').val(null);
			$('#ems16').val(null);
			$('#ems17').val(null);
			$('#ems18').val(null);
		}
    });

	function duc_auto()
	{
		$('#txtduc').css("background-color","var(--success)");
		
		var grade = $('#grade').val();
		if(grade=="RS-1")
		{
				$('#ems2').val(randomNumberFromRange(94.00,96.00).toFixed(2));
				$('#pen_1').val(randomNumberFromRange(97.00,99.00).toFixed(2));
				$('#pen_2').val(randomNumberFromRange(100.00,102.00).toFixed(2));
				$('#pen_3').val(randomNumberFromRange(102.00,104.00).toFixed(2));
				$('#pen_4').val(randomNumberFromRange(105.00,107.00).toFixed(2));
		}
		else if(grade=="RS-2")
		{
			$('#ems2').val(randomNumberFromRange(94.00,96.00).toFixed(2));
			$('#pen_1').val(randomNumberFromRange(97.00,99.00).toFixed(2));
			$('#pen_2').val(randomNumberFromRange(100.00,102.00).toFixed(2));
			$('#pen_3').val(randomNumberFromRange(102.00,104.00).toFixed(2));
			$('#pen_4').val(randomNumberFromRange(105.00,107.00).toFixed(2));
		}
		else if(grade=="MS")
		{
			$('#ems2').val(randomNumberFromRange(94.00,96.00).toFixed(2));
			$('#pen_1').val(randomNumberFromRange(97.00,99.00).toFixed(2));
			$('#pen_2').val(randomNumberFromRange(100.00,102.00).toFixed(2));
			$('#pen_3').val(randomNumberFromRange(102.00,104.00).toFixed(2));
			$('#pen_4').val(randomNumberFromRange(105.00,107.00).toFixed(2));	
		}
		else if(grade=="SS-1")
		{
				$('#ems2').val(randomNumberFromRange(94.00,96.00).toFixed(2));
			$('#pen_1').val(randomNumberFromRange(97.00,99.00).toFixed(2));
			$('#pen_2').val(randomNumberFromRange(100.00,102.00).toFixed(2));
			$('#pen_3').val(randomNumberFromRange(102.00,104.00).toFixed(2));
			$('#pen_4').val(randomNumberFromRange(105.00,107.00).toFixed(2));
		}
		else if(grade=="SS-2")
		{
			$('#ems2').val(randomNumberFromRange(94.00,96.00).toFixed(2));
			$('#pen_1').val(randomNumberFromRange(97.00,99.00).toFixed(2));
			$('#pen_2').val(randomNumberFromRange(100.00,102.00).toFixed(2));
			$('#pen_3').val(randomNumberFromRange(102.00,104.00).toFixed(2));
			$('#pen_4').val(randomNumberFromRange(105.00,107.00).toFixed(2));
		}
		
		
	}
	$('#chk_duc').change(function(){
        if(this.checked)
		{
			duc_auto();
		}
        else
		{
			$('#txtduc').css("background-color","white");
			$('#ems2').val(null);
			$('#pen_1').val(null);
			$('#pen_2').val(null);
			$('#pen_3').val(null);
			$('#pen_4').val(null);
		}
    });

	function pen_auto()
	{
		$('#txtpen').css("background-color","var(--success)");
		$('#ems3').val(randomNumberFromRange(90.00,95.00).toFixed(2));
		$('#duc_1').val(randomNumberFromRange(96.00,98.00).toFixed(2));
		$('#duc_2').val(randomNumberFromRange(99.00,99.9).toFixed(2));
	}
	$('#chk_pen').change(function(){
        if(this.checked)
		{
			pen_auto();
		}
        else
		{
			$('#txtpen').css("background-color","white");
			$('#ems3').val(null);
			$('#duc_1').val(null);
			$('#duc_2').val(null);
		}
    });

	function rec_auto()
	{
		$('#txtrec').css("background-color","var(--success)");
		$('#ems4').val(randomNumberFromRange(66.00,68.00).toFixed(2));
		$('#wt_1').val(randomNumberFromRange(5.00,10.00).toFixed(2));
		$('#wt_2').val(randomNumberFromRange(15.00,20.00).toFixed(2));
	}
	$('#chk_rec').change(function(){
        if(this.checked)
		{
			rec_auto();
		}
        else
		{
			$('#txtrec').css("background-color","white");
			$('#ems4').val(null);
			$('#wt_1').val(null);
			$('#wt_2').val(null);
		}
    });
		
	function ssa_auto()
	{
		$('#txtssa').css("background-color","var(--success)");
		$('#ems11').val(randomNumberFromRange(1.00,2.00).toFixed(2));
		$('#ems12').val(randomNumberFromRange(1.00,2.00).toFixed(2));
		$('#ems13').val(randomNumberFromRange(1.00,2.00).toFixed(2));
		$('#ems14').val(randomNumberFromRange(1.00,2.00).toFixed(2));
		$('#wt_3').val(randomNumberFromRange(5.00,10.00).toFixed(2));
		$('#wt_4').val(randomNumberFromRange(10.00,15.00).toFixed(2));
		$('#wt_5').val(randomNumberFromRange(15.00,20.00).toFixed(2));
		$('#wt_6').val(randomNumberFromRange(20.00,25.00).toFixed(2));
		$('#wt_7').val(randomNumberFromRange(25.00,30.00).toFixed(2));
		$('#wt_8').val(randomNumberFromRange(30.00,35.00).toFixed(2));
		$('#wt_9').val(randomNumberFromRange(35.00,40.00).toFixed(2));
		$('#wt_10').val(randomNumberFromRange(40.00,45.00).toFixed(2));
	}
	$('#chk_ssa').change(function(){
        if(this.checked)
		{
			ssa_auto();
		}
        else
		{
			$('#txtssa').css("background-color","white");
			$('#ems11').val(null);
			$('#ems12').val(null);
			$('#ems13').val(null);
			$('#ems14').val(null);
			$('#wt_3').val(null);
			$('#wt_4').val(null);
			$('#wt_5').val(null);
			$('#wt_6').val(null);
			$('#wt_7').val(null);
			$('#wt_8').val(null);
			$('#wt_9').val(null);
			$('#wt_10').val(null);
		}
    });
		
		
		
	function sol_auto()
	{
		$('#txtsol').css("background-color","var(--success)");
		$('#ems5').val(randomNumberFromRange(98.00,99.99).toFixed(2));
		$('#w1_1').val(randomNumberFromRange(10.00,14.99).toFixed(2));
		$('#w2_1').val(randomNumberFromRange(15.00,19.99).toFixed(2));
	}
	$('#chk_sol').change(function(){
        if(this.checked)
		{
			sol_auto();
		}
        else
		{
			$('#txtsol').css("background-color","white");
			$('#ems5').val(null);
			$('#w1_1').val(null);
			$('#w2_1').val(null);
		}
    });


	function mwa_auto()
	{
		$('#txtmwa').css("background-color","var(--success)");
		$('#ems6').val("No Coagulation");
	}
	$('#chk_mwa').change(function(){
        if(this.checked)
		{
			mwa_auto();
		}
        else
		{
			$('#txtmwa').css("background-color","white");
			$('#ems6').val(null);
		}
    });


	function par_auto()
	{
		$('#txtpar').css("background-color","var(--success)");
		$('#ems7').val("Positive");
		$('#ems10').val(23);
	}
	$('#chk_par').change(function(){
        if(this.checked)
		{
			par_auto();
		}
        else
		{
			$('#txtpar').css("background-color","white");
			$('#ems7').val(null);
			$('#ems10').val(null);
		}
    });


	function mic_auto()
	{
		$('#txtmic').css("background-color","var(--success)");
		$('#ems8').val(1);
		$('#ems9').val((+randomNumberFromRange(0.03,0.04).toFixed(2)));
		$('#ems19').val(1);
		$('#ems20').val(1);
		$('#ems21').val(1);
		
	}
	$('#chk_mic').change(function(){
        if(this.checked)
		{
			mic_auto();
		}
        else
		{
			$('#txtmic').css("background-color","white");
			$('#ems8').val(null);
			$('#ems9').val(null);
			$('#ems19').val(null);
			$('#ems20').val(null);
			$('#ems21').val(null);
			
		}
    });




$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();
});

$('#chk_auto').change(function(){
	if(this.checked)
	{ 
		var temp = $('#test_list').val();
		var aa= temp.split(",");
		
		//vis
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="vis")
			{
				$("#chk_kin").prop("checked", true); 
				kin_auto();
				break;
			}					
		}
		//sol
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="sol")
			{
				$("#chk_sol").prop("checked", true); 
				sol_auto();
				break;
			}					
		}
		//pen
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="pen")
			{
				$("#chk_pen").prop("checked", true); 
				pen_auto();
				break;
			}					
		}
		//duc
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="duc")
			{
				$("#chk_duc").prop("checked", true); 
				duc_auto();
				break;
			}					
		}
		//res
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="res")
			{
				$("#chk_rec").prop("checked", true); 
				rec_auto();
				break;
			}					
		}
		
		//ssa
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="ssa")
			{
				$("#chk_ssa").prop("checked", true); 
				ssa_auto();
				break;
			}					
		}
		
		
		//mwa
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="mwa")
			{
				$("#chk_mwa").prop("checked", true); 
				mwa_auto();
				break;
			}					
		}
		//par
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="par")
			{
				$("#chk_par").prop("checked", true); 
				par_auto();
				break;
			}					
		}
		//mic
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="mic")
			{
				$("#chk_mic").prop("checked", true); 
				mic_auto();
				break;
			}					
		}		
	}
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
        url: '<?php echo $base_url; ?>save_emulsion.php',
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
		var grade = $('#grade').val();
		
		var temp = $('#test_list').val();
		var aa= temp.split(",");	
		
		//Viscosity
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="vis")
			{
				if(document.getElementById('chk_kin').checked) {
					var chk_kin = "1";
				}
				else{
					var chk_kin = "0";
				}
				var ems1 = $('#ems1').val();
				var ems15 = $('#ems15').val();
				var ems16 = $('#ems16').val();
				var ems17 = $('#ems17').val();
				var ems18 = $('#ems18').val();
				break;
			}
			else
			{
				var chk_kin = "0";
				var ems1 = "0";
				var ems15 = "0";
				var ems16 = "0";
				var ems17 = "0";
				var ems18 = "0";
			}
		}
		
		//PENETRATION
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
				var ems2 = $('#ems2').val();
				var pen_1 = $('#pen_1').val();
				var pen_2 = $('#pen_2').val();
				var pen_3 = $('#pen_3').val();
				var pen_4 = $('#pen_4').val();
				break;
			}
			else
			{
				var chk_pen = "0";
				var ems2 = "0";
				var pen_1 = "0";
				var pen_2 = "0";
				var pen_3 = "0";
				var pen_4 = "0";
			}
		}
		
		//DUCTILITY
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
				var ems3 = $('#ems3').val();
				var duc_1 = $('#duc_1').val();
				var duc_2 = $('#duc_2').val();
				break;
			}
			else
			{
				var chk_duc = "0";
				var ems3 = "0";
				var duc_1 = "0";
				var duc_2 = "0";
			}
		}
		
		//RECUIDE
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="res")
			{
				if(document.getElementById('chk_rec').checked) {
					var chk_rec = "1";
				}
				else{
					var chk_rec = "0";
				}
				var ems4 = $('#ems4').val();
				var wt_1 = $('#wt_1').val();
				var wt_2 = $('#wt_2').val();
				break;
			}
			else
			{
				var chk_rec = "0";
				var ems4 = "0";
				var wt_1 = "0";
				var wt_2 = "0";
			}
		}
		
		//STORAGE STABILITY
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="ssa")
			{
				if(document.getElementById('chk_ssa').checked) {
					var chk_ssa = "1";
				}
				else{
					var chk_ssa = "0";
				}
				var ems11 = $('#ems11').val();
				var ems12 = $('#ems12').val();
				var ems13 = $('#ems13').val();
				var ems14 = $('#ems14').val();
				var wt_3 = $('#wt_3').val();
				var wt_4 = $('#wt_4').val();
				var wt_5 = $('#wt_5').val();
				var wt_6 = $('#wt_6').val();
				var wt_7 = $('#wt_7').val();
				var wt_8 = $('#wt_8').val();
				var wt_9 = $('#wt_9').val();
				var wt_10 = $('#wt_10').val();
				break;
			}
			else
			{
				var chk_ssa = "0";
				var ems11 = "0";
				var ems12 = "0";
				var ems13 = "0";
				var ems14 = "0";
				var wt_3 = "0";
				var wt_4 = "0";
				var wt_5 = "0";
				var wt_6 = "0";
				var wt_7 = "0";
				var wt_8 = "0";
				var wt_9 = "0";
				var wt_10 = "0";
			}
		}
		
		//SOLUBILITY BY TRICHLORETHYLENE
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="sol")
			{
				if(document.getElementById('chk_sol').checked) {
					var chk_sol = "1";
				}
				else{
					var chk_sol = "0";
				}
				var ems5 = $('#ems5').val();
				var w1_1 = $('#w1_1').val();
				var w2_1 = $('#w2_1').val();
				break;
			}
			else
			{
				var chk_sol = "0";
				var ems5 = "0";
				var w1_1 = "0";
				var w2_1 = "0";
			}
		}
		
		//Miscibility of Water
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="mwa")
			{
				if(document.getElementById('chk_mwa').checked) {
					var chk_mwa = "1";
				}
				else{
					var chk_mwa = "0";
				}
				var ems6 = $('#ems6').val();
				break;
			}
			else
			{
				var chk_mwa = "0";
				var ems6 = "0";
			}
		}
		
		//Particle Charge
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="par")
			{
				if(document.getElementById('chk_par').checked) {
					var chk_par = "1";
				}
				else{
					var chk_par = "0";
				}
				var ems7 = $('#ems7').val();
				var ems10 = $('#ems10').val();
				break;
			}
			else
			{
				var chk_par = "0";
				var ems7 = "0";
				var ems10 = "0";
			}
		}
		
		//Residue on 600 micron is sieve, % by mass
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="mic")
			{
				if(document.getElementById('chk_mic').checked) {
					var chk_mic = "1";
				}
				else{
					var chk_mic = "0";
				}
				var ems8 = $('#ems8').val();
				var ems9 = $('#ems9').val();
				var ems19 = $('#ems19').val();
				var ems20 = $('#ems20').val();
				var ems21 = $('#ems21').val();
				
				break;
			}
			else
			{
				var chk_mic = "0";
				var ems8 = "0";
				var ems9 = "0";
				var ems19 = "0";
				var ems20 = "0";
				var ems21 = "0";
				
			}
		}
		
		billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&ulr='+ulr+'&chk_kin='+chk_kin+'&chk_sol='+chk_sol+'&chk_mwa='+chk_mwa+'&chk_par='+chk_par+'&chk_mic='+chk_mic+'&chk_pen='+chk_pen+'&chk_duc='+chk_duc+'&chk_rec='+chk_rec+'&ems1='+ems1+'&ems2='+ems2+'&ems3='+ems3+'&ems4='+ems4+'&ems5='+ems5+'&ems6='+ems6+'&ems7='+ems7+'&ems8='+ems8+'&ems9='+ems9+'&ems10='+ems10+'&ems11='+ems11+'&ems12='+ems12+'&ems13='+ems13+'&ems14='+ems14+'&ems15='+ems15+'&ems16='+ems16+'&ems17='+ems17+'&ems18='+ems18+'&ems19='+ems19+'&ems20='+ems20+'&ems21='+ems21+'&duc_1='+duc_1+'&duc_2='+duc_2+'&pen_1='+pen_1+'&pen_2='+pen_2+'&pen_3='+pen_3+'&pen_4='+pen_4+'&w1_1='+w1_1+'&w2_1='+w2_1+'&wt_1='+wt_1+'&wt_2='+wt_2+'&wt_3='+wt_3+'&wt_4='+wt_4+'&wt_5='+wt_5+'&wt_6='+wt_6+'&wt_7='+wt_7+'&wt_8='+wt_8+'&wt_9='+wt_9+'&wt_10='+wt_10+'&amend_date='+amend_date+'&grade='+grade;
						
	}
	else if (type == 'edit'){
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		var lab_no = $('#lab_no').val();
		var ulr = $('#ulr').val();
		var amend_date = $('#amend_date').val();
		var grade = $('#grade').val();
		
		var temp = $('#test_list').val();
		var aa= temp.split(",");	
		
		//Viscosity
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="vis")
			{
				if(document.getElementById('chk_kin').checked) {
					var chk_kin = "1";
				}
				else{
					var chk_kin = "0";
				}
				var ems1 = $('#ems1').val();
				var ems15 = $('#ems15').val();
				var ems16 = $('#ems16').val();
				var ems17 = $('#ems17').val();
				var ems18 = $('#ems18').val();
				break;
			}
			else
			{
				var chk_kin = "0";
				var ems1 = "0";
				var ems15 = "0";
				var ems16 = "0";
				var ems17 = "0";
				var ems18 = "0";
			}
		}
		
		//PENETRATION
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
				var ems2 = $('#ems2').val();
				var pen_1 = $('#pen_1').val();
				var pen_2 = $('#pen_2').val();
				var pen_3 = $('#pen_3').val();
				var pen_4 = $('#pen_4').val();
				break;
			}
			else
			{
				var chk_pen = "0";
				var ems2 = "0";
				var pen_1 = "0";
				var pen_2 = "0";
				var pen_3 = "0";
				var pen_4 = "0";
			}
		}
		
		//DUCTILITY
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
				var ems3 = $('#ems3').val();
				var duc_1 = $('#duc_1').val();
				var duc_2 = $('#duc_2').val();
				break;
			}
			else
			{
				var chk_duc = "0";
				var ems3 = "0";
				var duc_1 = "0";
				var duc_2 = "0";
			}
		}
		
		//RECUIDE
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="res")
			{
				if(document.getElementById('chk_rec').checked) {
					var chk_rec = "1";
				}
				else{
					var chk_rec = "0";
				}
				var ems4 = $('#ems4').val();
				var wt_1 = $('#wt_1').val();
				var wt_2 = $('#wt_2').val();
				break;
			}
			else
			{
				var chk_rec = "0";
				var ems4 = "0";
				var wt_1 = "0";
				var wt_2 = "0";
			}
		}
		
		//STORAGE STABILITY
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="ssa")
			{
				if(document.getElementById('chk_ssa').checked) {
					var chk_ssa = "1";
				}
				else{
					var chk_ssa = "0";
				}
				var ems11 = $('#ems11').val();
				var ems12 = $('#ems12').val();
				var ems13 = $('#ems13').val();
				var ems14 = $('#ems14').val();
				var wt_3 = $('#wt_3').val();
				var wt_4 = $('#wt_4').val();
				var wt_5 = $('#wt_5').val();
				var wt_6 = $('#wt_6').val();
				var wt_7 = $('#wt_7').val();
				var wt_8 = $('#wt_8').val();
				var wt_9 = $('#wt_9').val();
				var wt_10 = $('#wt_10').val();
				break;
			}
			else
			{
				var chk_ssa = "0";
				var ems11 = "0";
				var ems12 = "0";
				var ems13 = "0";
				var ems14 = "0";
				var wt_3 = "0";
				var wt_4 = "0";
				var wt_5 = "0";
				var wt_6 = "0";
				var wt_7 = "0";
				var wt_8 = "0";
				var wt_9 = "0";
				var wt_10 = "0";
			}
		}
		
		//SOLUBILITY BY TRICHLORETHYLENE
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="sol")
			{
				if(document.getElementById('chk_sol').checked) {
					var chk_sol = "1";
				}
				else{
					var chk_sol = "0";
				}
				var ems5 = $('#ems5').val();
				var w1_1 = $('#w1_1').val();
				var w2_1 = $('#w2_1').val();
				break;
			}
			else
			{
				var chk_sol = "0";
				var ems5 = "0";
				var w1_1 = "0";
				var w2_1 = "0";
			}
		}
		
		//Miscibility of Water
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="mwa")
			{
				if(document.getElementById('chk_mwa').checked) {
					var chk_mwa = "1";
				}
				else{
					var chk_mwa = "0";
				}
				var ems6 = $('#ems6').val();
				break;
			}
			else
			{
				var chk_mwa = "0";
				var ems6 = "0";
			}
		}
		
		//Particle Charge
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="par")
			{
				if(document.getElementById('chk_par').checked) {
					var chk_par = "1";
				}
				else{
					var chk_par = "0";
				}
				var ems7 = $('#ems7').val();
				var ems10 = $('#ems10').val();
				break;
			}
			else
			{
				var chk_par = "0";
				var ems7 = "0";
				var ems10 = "0";
			}
		}
		
		//Residue on 600 micron is sieve, % by mass
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="mic")
			{
				if(document.getElementById('chk_mic').checked) {
					var chk_mic = "1";
				}
				else{
					var chk_mic = "0";
				}
				var ems8 = $('#ems8').val();
				var ems9 = $('#ems9').val();
				var ems19 = $('#ems19').val();
				var ems20 = $('#ems20').val();
				var ems21 = $('#ems21').val();
				
				break;
			}
			else
			{
				var chk_mic = "0";
				var ems8 = "0";
				var ems9 = "0";
				var ems19 = "0";
				var ems20 = "0";
				var ems21 = "0";
				
			}
		}
		var idEdit = $('#idEdit').val(); 
		billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&ulr='+ulr+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_kin='+chk_kin+'&chk_sol='+chk_sol+'&chk_pen='+chk_pen+'&chk_duc='+chk_duc+'&chk_rec='+chk_rec+'&chk_mwa='+chk_mwa+'&chk_par='+chk_par+'&chk_mic='+chk_mic+'&ems1='+ems1+'&ems2='+ems2+'&ems3='+ems3+'&ems4='+ems4+'&ems5='+ems5+'&ems6='+ems6+'&ems7='+ems7+'&ems8='+ems8+'&ems9='+ems9+'&ems10='+ems10+'&ems11='+ems11+'&ems12='+ems12+'&ems13='+ems13+'&ems14='+ems14+'&ems15='+ems15+'&ems16='+ems16+'&ems17='+ems17+'&ems18='+ems18+'&ems19='+ems19+'&ems20='+ems20+'&ems21='+ems21+'&duc_1='+duc_1+'&duc_2='+duc_2+'&pen_1='+pen_1+'&pen_2='+pen_2+'&pen_3='+pen_3+'&pen_4='+pen_4+'&w1_1='+w1_1+'&w2_1='+w2_1+'&wt_1='+wt_1+'&wt_2='+wt_2+'&wt_3='+wt_3+'&wt_4='+wt_4+'&wt_5='+wt_5+'&wt_6='+wt_6+'&wt_7='+wt_7+'&wt_8='+wt_8+'&wt_9='+wt_9+'&wt_10='+wt_10+'&amend_date='+amend_date+'&grade='+grade;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	

    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_emulsion.php',
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
        url: '<?php echo $base_url; ?>save_emulsion.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			
			$('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();
			
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
			$('#grade').val(data.grade);
			
            var temp = $('#test_list').val();
			var aa= temp.split(",");				
				
			//PENETRATION
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
					$('#ems2').val(data.ems2);
					$('#pen_1').val(data.pen_1);
					$('#pen_2').val(data.pen_2);
					$('#pen_3').val(data.pen_3);
					$('#pen_4').val(data.pen_4);
					break;
				}
			}
			
			//VISCOSITY
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="vis")
				{
					var chk_kin = data.chk_kin;
					if(chk_kin=="1")
					{
						$('#txtkin').css("background-color","var(--success)");	
						$("#chk_kin").prop("checked", true); 
					}else{
						$('#txtkin').css("background-color","white");	
						$("#chk_kin").prop("checked", false); 
					}
					$('#ems1').val(data.ems1);
					$('#ems15').val(data.ems15);
					$('#ems16').val(data.ems16);
					$('#ems17').val(data.ems17);
					$('#ems18').val(data.ems18);
					break;
				}
			}
			
			//DUCTILITY
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
					$('#ems3').val(data.ems3);
					$('#duc_1').val(data.duc_1);
					$('#duc_2').val(data.duc_2);
					break;
				}
			}
			
			//RECUIDE
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="res")
				{
					var chk_rec = data.chk_rec;
					if(chk_rec=="1")
					{
						$('#txtrec').css("background-color","var(--success)");	
						$("#chk_rec").prop("checked", true); 
					}else{
						$('#txtrec').css("background-color","white");	
						$("#chk_rec").prop("checked", false); 
					}
					$('#ems4').val(data.ems4);
					$('#wt_1').val(data.wt_1);
					$('#wt_2').val(data.wt_2);
					break;
				}
			}
			
			//STORAGE STABILITY
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="ssa")
				{
					var chk_ssa = data.chk_ssa;
					if(chk_ssa=="1")
					{
						$('#txtssa').css("background-color","var(--success)");	
						$("#chk_ssa").prop("checked", true); 
					}else{
						$('#txtssa').css("background-color","white");	
						$("#chk_ssa").prop("checked", false); 
					}
					$('#ems11').val(data.ems11);
					$('#ems12').val(data.ems12);
					$('#ems13').val(data.ems13);
					$('#ems14').val(data.ems14);
					$('#wt_3').val(data.wt_3);
					$('#wt_4').val(data.wt_4);
					$('#wt_5').val(data.wt_5);
					$('#wt_6').val(data.wt_6);
					$('#wt_7').val(data.wt_7);
					$('#wt_8').val(data.wt_8);
					$('#wt_9').val(data.wt_9);
					$('#wt_10').val(data.wt_10);
					break;
				}
			}
			
			//SOLUBILITY BY TRICHLORETHYLENE
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="sol")
				{
					var chk_sol = data.chk_sol;
					if(chk_sol=="1")
					{
						$('#txtsol').css("background-color","var(--success)");	
						$("#chk_sol").prop("checked", true); 
					}else{
						$('#txtsol').css("background-color","white");	
						$("#chk_sol").prop("checked", false); 
					}
					$('#ems5').val(data.ems5);
					$('#w1_1').val(data.w1_1);
					$('#w2_1').val(data.w2_1);
					break;
				}
			}
			
			//Miscibility of Water
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="mwa")
				{
					var chk_mwa = data.chk_mwa;
					if(chk_mwa=="1")
					{
						$('#txtmwa').css("background-color","var(--success)");	
						$("#chk_mwa").prop("checked", true); 
					}else{
						$('#txtmwa').css("background-color","white");	
						$("#chk_mwa").prop("checked", false); 
					}
					$('#ems6').val(data.ems6);
					break;
				}
			}
			
			//Particle Charge
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="par")
				{
					var chk_par = data.chk_par;
					if(chk_par=="1")
					{
						$('#txtpar').css("background-color","var(--success)");	
						$("#chk_par").prop("checked", true); 
					}else{
						$('#txtpar').css("background-color","white");	
						$("#chk_par").prop("checked", false); 
					}
					$('#ems7').val(data.ems7);
					$('#ems10').val(data.ems10);
					break;
				}
			}
			
			//Residue on 600 micron is sieve, % by mass
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="mic")
				{
					var chk_mic = data.chk_mic;
					if(chk_mic=="1")
					{
						$('#txtmic').css("background-color","var(--success)");	
						$("#chk_mic").prop("checked", true); 
					}else{
						$('#txtmic').css("background-color","white");	
						$("#chk_mic").prop("checked", false); 
					}
					$('#ems8').val(data.ems8);
					$('#ems9').val(data.ems9);
					$('#ems19').val(data.ems19);
					$('#ems20').val(data.ems20);
					$('#ems21').val(data.ems21);
					
					break;
				}
			}
			
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}


</script>


