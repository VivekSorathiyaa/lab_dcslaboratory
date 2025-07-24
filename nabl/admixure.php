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
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">Admixture</h2>
					</div>
					<div class="box-default">
					<form class="form" id="Glazed" method="post">
						<div class="row">
							<div class="col-lg-6">
								<div class="col-sm-2">	
									<div class="form-group">
										<label for="chk_auto">Job No. :</label>
										<input type="checkbox" class="visually-hidden" name="chk_auto"  id="chk_auto" value="chk_auto">
									</div>
								</div>
								<div class="col-sm-10">	
									<div class="form-group">
										<input type="text" class="form-control" id="lab_no" value="<?php echo $lab_no;?>" name="lab_no" ReadOnly>
									</div>
								</div>	
								<input type="hidden" class="form-control" id="report_no" value="<?php echo $report_no;?>" name="report_no" ReadOnly >
								<input type="hidden" class="form-control" tabindex="1"  value="<?php echo $job_no;?>" id="job_no" name="job_no" ReadOnly>
								<input type="hidden" class="form-control" tabindex="1"  value="<?php echo $ulr;?>" id="ulr" name="ulr" ReadOnly>
							</div>
							
							<div class="col-lg-6">
								<div class="col-sm-12">	
									<div class="form-group">
										<label >DRY MATERIAL CONTENT SELECTION :</label>
										 <select class="form-control dmc_selection" id="dmc_selection" name="dmc_selection">											
											<option value="LIQUID ADMIXTURE">LIQUID ADMIXTURE</option>
											<option value="NON LIQUID ADMIXTURE">NON LIQUID ADMIXTURE</option>
											<option value="BOTH">BOTH</option>
											
											</select>
									</div>
								</div>
								<div class="col-sm-10">	
									<div class="form-group">
								
									</div>
								</div>	
								
							</div>
						</div>
						<br>
							<!-- LAB NO PUT VAIBHAV-->
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">Remarks.:</label>-->
										  <div class="col-sm-2">
										  <label for="inputEmail3" class="col-sm-2 control-label">Product Name :</label>								 
											</div>
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="rem_data" value="" name="rem_data">
										  </div>
										</div>
									</div>		

									<div class="col-lg-3">
										<div class="form-group">
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">Remarks.:</label>-->
										  <div class="col-sm-2">
										  <label for="inputEmail3" class="col-sm-2 control-label">Brand :</label>								 
											</div>
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" id="brand_data" value="" name="brand_data">
										  </div>
										</div>
									</div>	
									<div class="col-lg-3">
										<div class="form-group">
										 <div class="col-sm-4">
													<!--<label>Amend Date. :</label>-->
												</div>								 
										  <div class="col-sm-8">
											<input type="hidden" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
										  </div>
										</div>
									</div>							
								</div>
								<br>
							<!-- LAB NO PUT VAIBHAV-->
								
								<br>
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
													$querys_job1 = "SELECT * FROM admixture WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_admixture.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											
											<?php /*}*/ ?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_admixture.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
			
			if($r1['test_code']=="ash")
			{
				$test_check.="ash,";	
				?>											
				<div class="panel panel-default" id="ash">
					<div class="panel-heading" id="txtash">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseash">
								<h4 class="panel-title">
								<b>ASH CONTENT</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapseash" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-lg-8">
									<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_ash">1.</label>
											<input type="checkbox" class="visually-hidden" name="chk_ash"  id="chk_ash" value="chk_ash"><br>
										</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">ASH CONTENT</label>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">START DATE</label>
											<input type="text" class="form-control" id="ash_s_d" name="ash_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">END DATE</label>
											<input type="text" class="form-control" id="ash_e_d" name="ash_e_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
							</div>
							<br>
								<div class="row">									
								
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="ash_test_method" name="ash_test_method" Value="<?php echo $r1["test_method"];?>">
											<input type="hidden" class="form-control" id="ash_test_id" name="ash_test_id" Value="<?php echo $r1["test"];?>">
											<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
											<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="ash_test_req" name="ash_test_req" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="ash_test_limit" name="ash_test_limit" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="col-md-3">
										<div class="form-group">
											<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_ash','<?php echo $r1["test"];?>','<?php echo $r1["material_category"];?>','<?php echo $r1["material_id"];?>')" name="btn_update_is" id="btn_update_is" tabindex="14" >Update IS</button>
										</div>
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
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Description</label>
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">1</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="control-label">WEIGHT OF CRUCIBLE AND LID (W1)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="ash_w1" name="ash_w1" >
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">2</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="control-label">WEIGHT OF CRUCIBLE, LID AND SAMPLE (W2)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="ash_w2" name="ash_w2" >
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">3</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="control-label">WEIGHT OF CRUCIBLE, LID AND ASH  (W3)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="ash_w3" name="ash_w3" >
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">4</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="control-label">ASH CONTENT =</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="ash_content" name="ash_content" >
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			if($r1['test_code']=="phv")
			{
				$test_check.="phv,";	
				?>											
				<div class="panel panel-default" id="phv">
					<div class="panel-heading" id="txtphv">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapsephv">
								<h4 class="panel-title">
								<b>PH Value </b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapsephv" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-lg-8">
									<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_phv">1.</label>
											<input type="checkbox" class="visually-hidden" name="chk_phv"  id="chk_phv" value="chk_phv"><br>
										</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">PH Value </label>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">START DATE</label>
											<input type="text" class="form-control" id="phv_s_d" name="phv_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">END DATE</label>
											<input type="text" class="form-control" id="phv_e_d" name="phv_e_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
							</div>	
							<br>
								<div class="row">									
								
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="phv_test_method" name="phv_test_method" Value="<?php echo $r1["test_method"];?>">
											<input type="hidden" class="form-control" id="phv_test_id" name="phv_test_id" Value="<?php echo $r1["test"];?>">
											<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
											<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="phv_test_req" name="phv_test_req" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="phv_test_limit" name="phv_test_limit" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="col-md-3">
										<div class="form-group">
											<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_phv','<?php echo $r1["test"];?>','<?php echo $r1["material_category"];?>','<?php echo $r1["material_id"];?>')" name="btn_update_is" id="btn_update_is" tabindex="14" >Update IS</button>
										</div>
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
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">BEFORE SET</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">AFTER SET</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">TEMPERATURE (<sup>o</sup>C)</label>
									</div>
								</div>
								
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_before1" name="phv_before1">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_after1" name="phv_after1">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_temp1" name="phv_temp1">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_before2" name="phv_before2">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_after2" name="phv_after2">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_temp2" name="phv_temp2">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">3</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_before3" name="phv_before3">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_after3" name="phv_after3">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_temp3" name="phv_temp3">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_avg_before" name="phv_avg_before">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_avg_after" name="phv_avg_after">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="phv_avg_temp" name="phv_avg_temp ">
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			<?php
			}if($r1['test_code']=="clr")
			{
				$test_check.="clr,";	
				?>											
				<div class="panel panel-default" id="clr">
					<div class="panel-heading" id="txtclr">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseclr">
								<h4 class="panel-title">
								<b>CHLORIDE CONTENT</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapseclr" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-lg-8">
									<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_clr">1.</label>
											<input type="checkbox" class="visually-hidden" name="chk_clr"  id="chk_clr" value="chk_clr"><br>
										</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">CHLORIDE CONTENT</label>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">START DATE</label>
											<input type="text" class="form-control" id="clr_s_d" name="clr_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">END DATE</label>
											<input type="text" class="form-control" id="clr_e_d" name="clr_e_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
							</div>
							<br>
								<div class="row">									
								
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="clr_test_method" name="clr_test_method" Value="<?php echo $r1["test_method"];?>">
											<input type="hidden" class="form-control" id="clr_test_id" name="clr_test_id" Value="<?php echo $r1["test"];?>">
											<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
											<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="clr_test_req" name="clr_test_req" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="clr_test_limit" name="clr_test_limit" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="col-md-3">
										<div class="form-group">
											<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_clr','<?php echo $r1["test"];?>','<?php echo $r1["material_category"];?>','<?php echo $r1["material_id"];?>')" name="btn_update_is" id="btn_update_is" tabindex="14" >Update IS</button>
										</div>
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
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Description</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label"></label>
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">WEIGHT OF SAMPLE, GM</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="clr_w" name="phv_after1">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">WEIGHT OF CHLORIDE, GM (From Graph)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="clr_x" name="clr_x">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="hidden" class="form-control" id="clr_y" name="clr_y">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="hidden" class="form-control" id="clr_z" name="clr_z">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="hidden" class="form-control" id="clr_n" name="clr_n">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">6</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">CHLORIDE CONTENT (%) = </label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="chloride_content" name="chloride_content">
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			<?php
			}if($r1['test_code']=="rdv")
			{
				$test_check.="rdv,";	
				?>											
				<div class="panel panel-default" id="rdv">
					<div class="panel-heading" id="txtrdv">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapserdv">
								<h4 class="panel-title">
								<b>RELATIVE DENSITY</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapserdv" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-lg-8">
									<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_rdv">1.</label>
											<input type="checkbox" class="visually-hidden" name="chk_rdv"  id="chk_rdv" value="chk_rdv"><br>
										</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">RELATIVE DENSITY</label>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">START DATE</label>
											<input type="text" class="form-control" id="rdv_s_d" name="rdv_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">END DATE</label>
											<input type="text" class="form-control" id="rdv_e_d" name="rdv_e_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
							</div>
							<br>
								<div class="row">									
								
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="rdv_test_method" name="rdv_test_method" Value="<?php echo $r1["test_method"];?>">
											<input type="hidden" class="form-control" id="rdv_test_id" name="rdv_test_id" Value="<?php echo $r1["test"];?>">
											<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
											<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="rdv_test_req" name="rdv_test_req" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="rdv_test_limit" name="rdv_test_limit" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="col-md-3">
										<div class="form-group">
											<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_rdv','<?php echo $r1["test"];?>','<?php echo $r1["material_category"];?>','<?php echo $r1["material_id"];?>')" name="btn_update_is" id="btn_update_is" tabindex="14" >Update IS</button>
										</div>
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
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label"></label>
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="rdv1" name="rdv1">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="rdv2" name="rdv2">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">3</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="rdv3" name="rdv3">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="avg_rdv" name="avg_rdv">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			if($r1['test_code']=="dmc")
			{
				$test_check.="dmc,";	
				?>											
				<div class="panel panel-default" id="dmc">
					<div class="panel-heading" id="txtdmc">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapsedmc">
								<h4 class="panel-title">
									<b>DRY MATERIAL CONTENT</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapsedmc" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-lg-8">
									<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_dmc">1.</label>
											<input type="checkbox" class="visually-hidden" name="chk_dmc"  id="chk_dmc" value="chk_dmc"><br>
										</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">DRY MATERIAL CONTENT</label>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">START DATE</label>
											<input type="text" class="form-control" id="dmc_s_d" name="dmc_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label label-right">END DATE</label>
											<input type="text" class="form-control" id="dmc_e_d" name="dmc_e_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
										</div>
									</div>
								</div>
							</div>
							<br>
								<div class="row">									
								
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="dmc_test_method" name="dmc_test_method" Value="<?php echo $r1["test_method"];?>">
											<input type="hidden" class="form-control" id="dmc_test_id" name="dmc_test_id" Value="<?php echo $r1["test"];?>">
											<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
											<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="dmc_test_req" name="dmc_test_req" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" id="dmc_test_limit" name="dmc_test_limit" Value="">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="col-md-3">
										<div class="form-group">
											<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_dmc','<?php echo $r1["test"];?>','<?php echo $r1["material_category"];?>','<?php echo $r1["material_id"];?>')" name="btn_update_is" id="btn_update_is" tabindex="14" >Update IS</button>
										</div>
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
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">PARTICULAR</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">LIQUID ADMIXTURE</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">NON LIQUID ADMIXTURE</label>
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">WEIGHT OF BOTTLE AND SAND  (W1)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_w1" name="dmc_w1">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_non_w1" name="dmc_non_w1">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">WEIGHT OF BOTTLE + SAND + SAMPLE  (W2)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_w2" name="dmc_w2">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_non_w2" name="dmc_non_w2">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">3</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">WEIGHT OF SAMPLE   (W2-W1)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_w2_w1" name="dmc_w2_w1">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_non_w2_w1" name="dmc_non_w2_w1">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">4</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">WEIGHT OF BOTTLE, SAND AND DRIED RESIDUE  (W3)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_w3" name="dmc_w3">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_non_w3" name="dmc_non_w3">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">5</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">WEIGHT OF DRIED RESIDUE  (W3-W1)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_w3_w1" name="dmc_w3_w1">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_non_w3_w1" name="dmc_non_w3_w1">
									</div>
								</div>
							</div>
							<br>		
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">6</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">PERCENT RESIDUE ON DRYING = ((W3 -W1) / (W2 - W1)) x 100</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_content" name="dmc_content">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id="dmc_non_content" name="dmc_non_content">
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
							 $query = "select * from admixture WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	get_is_data();
}); 


// ASH CONTENT
function ash_auto()
{
	$('#txtash').css("background-color","var(--success)"); 
	var ash_w1 = randomNumberFromRange(60.4093,60.4094).toFixed(4);
	var ash_w2 = randomNumberFromRange(61.4093,61.4094).toFixed(4);
	var ash_w3 = randomNumberFromRange(60.4293,60.4393).toFixed(4);
	$('#ash_w1').val((+ash_w1).toFixed(4));
	$('#ash_w2').val((+ash_w2).toFixed(4));
	$('#ash_w3').val((+ash_w3).toFixed(4));
	
	var ash_content  = ((+ash_w3) - (+ash_w1)) / ((+ash_w2) - (+ash_w1)) * 100;
	$('#ash_content').val((+ash_content).toFixed(2));
}
$('#chk_ash').change(function(){
	if(this.checked)
	{
		ash_auto();
	}
	else{
		$('#txtash').css("background-color","white");
		$('#ash_w1').val(null);
		$('#ash_w2').val(null);
		$('#ash_w3').val(null);
		$('#ash_content').val(null);
	}
});


$('#ash_w1,#ash_w2,#ash_w3').change(function(){
	$('#txtash').css("background-color","var(--success)"); 
	var ash_w1 = $('#ash_w1').val();
	var ash_w2 = $('#ash_w2').val();
	var ash_w3 = $('#ash_w3').val();
	
	var ash_content  = ((+ash_w3) - (+ash_w1)) / ((+ash_w2) - (+ash_w1)) * 100;
	$('#ash_content').val((+ash_content).toFixed(2));
});



// PH Value
function phv_auto()
{
	$('#txtphv').css("background-color","var(--success)"); 
	var phv_before1 = 6.98;
	var phv_before2 = 6.98;
	var phv_before3 = 6.98;
	
	$('#phv_before1').val((+phv_before1).toFixed(2));
	$('#phv_before2').val((+phv_before2).toFixed(2));
	$('#phv_before3').val((+phv_before3).toFixed(2));
	
	var phv_after1 = randomNumberFromRange(7.0000,9.000).toFixed(2);
	var phv_after2 = randomNumberFromRange(7.0000,9.000).toFixed(2);
	var phv_after3 = randomNumberFromRange(7.0000,9.000).toFixed(2);
	
	$('#phv_after1').val((+phv_after1).toFixed(2));
	$('#phv_after2').val((+phv_after2).toFixed(2));
	$('#phv_after3').val((+phv_after3).toFixed(2));
	
	var phv_temp1 = 25;
	var phv_temp2 = 25;
	var phv_temp3 = 25;
	
	$('#phv_temp1').val((+phv_temp1).toFixed());
	$('#phv_temp2').val((+phv_temp2).toFixed());
	$('#phv_temp3').val((+phv_temp3).toFixed());
	
	var phv_before1 = $('#phv_before1').val();
	var phv_before2 = $('#phv_before2').val();
	var phv_before3 = $('#phv_before3').val();
	
	var phv_after1 = $('#phv_after1').val();
	var phv_after2 = $('#phv_after2').val();
	var phv_after3 = $('#phv_after3').val();
	
	var phv_temp1 = $('#phv_temp1').val();
	var phv_temp2 = $('#phv_temp2').val();
	var phv_temp3 = $('#phv_temp3').val();
	
	var phv_avg_before = ((+phv_before1) + (+phv_before2) + (+phv_before3)) / 3;
	var phv_avg_after = ((+phv_after1) + (+phv_after2) + (+phv_after3)) / 3;
	var phv_avg_temp = ((+phv_temp1) + (+phv_temp2) + (+phv_temp3)) / 3;
	
	$('#phv_avg_before').val((+phv_avg_before).toFixed(2));
	$('#phv_avg_after').val((+phv_avg_after).toFixed(2));
	$('#phv_avg_temp ').val((+phv_avg_temp).toFixed());
}

$('#chk_phv').change(function(){
	if(this.checked)
	{
		phv_auto();
	}
	else{
		$('#txtphv').css("background-color","white");
		$('#phv_before1').val(null);
		$('#phv_before2').val(null);
		$('#phv_before3').val(null);
		$('#phv_after1').val(null);
		$('#phv_after2').val(null);
		$('#phv_after3').val(null);
		$('#phv_temp1').val(null);
		$('#phv_temp2').val(null);
		$('#phv_temp3').val(null);
		$('#phv_avg_before').val(null);
		$('#phv_avg_after').val(null);
		$('#phv_avg_temp ').val(null);
	}
});



// CHLORIDE ION CONCENTRATION
function clr_auto()
{
	$('#txtclr').css("background-color","var(--success)"); 
	var clr_w = randomNumberFromRange(2.0001,2.0002).toFixed(4);
	var clr_x = randomNumberFromRange(0.002,0.010).toFixed(4);
	
	$('#clr_w').val((+clr_w).toFixed(4));
	$('#clr_x').val((+clr_x).toFixed(4));
	
	
	
	var chloride_content  = (+clr_x) / (+clr_w);
	$('#chloride_content').val((+chloride_content).toFixed(4));
}
$('#chk_clr').change(function(){
	if(this.checked)
	{
		clr_auto();
	}
	else{
		$('#txtclr').css("background-color","white");
		$('#clr_w').val(null);
		$('#clr_x').val(null);
		$('#clr_y').val(null);
		$('#clr_z').val(null);
		$('#clr_n').val(null);
		$('#chloride_content').val(null);
	}
});



$('#clr_w,#clr_x,#clr_y,#clr_n').change(function(){
	$('#txtclr').css("background-color","var(--success)");
	
	var clr_w = $('#clr_w').val();
	var clr_x = $('#clr_x').val();
	var clr_y = $('#clr_y').val();
	var clr_n = $('#clr_n').val();
	
	var clr_z = (10 - ((+clr_x) - (+clr_y)));
	$('#clr_z').val((+clr_z).toFixed(2));
	var clr_z = $('#clr_z').val();
	
	var chloride_content  = ((+clr_z) * (+0.003546) * (+clr_n) * 100) / (+clr_w);
	$('#chloride_content').val((+chloride_content).toFixed(2));
});


// RELATIVE DENSITY
function rdv_auto()
{
	$('#txtrdv').css("background-color","var(--success)"); 
	var rdv = randomNumberFromRange(1.05,1.18).toFixed(2);
	var bb = randomNumberFromRange(1,9).toFixed();
	if(bb%2==0){
		var rdv1 = (+rdv) - 0.01;
		var rdv2 = (+rdv) - 0.01;
		var rdv3 = (+rdv);
		var avg_rdv = ((+rdv1) + (+rdv2) + (+rdv3)) / 3;
	}else{
		var rdv1 = (+rdv);
		var rdv2 = (+rdv)- 0.01;
		var rdv3 = (+rdv)- 0.01;
		var avg_rdv = ((+rdv1) + (+rdv2) + (+rdv3)) / 3;
	}
	$('#rdv1').val((+rdv1).toFixed(2));
	$('#rdv2').val((+rdv2).toFixed(2));
	$('#rdv3').val((+rdv3).toFixed(2));
	$('#avg_rdv').val((+avg_rdv).toFixed(2));
}
$('#chk_rdv').change(function(){
	if(this.checked)
	{
		rdv_auto();
	}
	else{
		$('#txtrdv').css("background-color","white");
		$('#rdv1').val(null);
		$('#rdv2').val(null);
		$('#rdv3').val(null);
		$('#avg_rdv').val(null);
	}
});



// DRY MATERIAL CONTENT
function dmc_auto()
{
	$('#txtdmc').css("background-color","var(--success)"); 
	
	var dmc_selection = $('#dmc_selection').val();
	if(dmc_selection == "LIQUID ADMIXTURE")
	{
		//LIQUID ADMIXTURE
		var dmc_w1 = randomNumberFromRange(97.7932,98.7932).toFixed(4);
		var dmc_w2 = randomNumberFromRange(101.8932,104.2932).toFixed(4);
		$('#dmc_w1').val((+dmc_w1).toFixed(4));
		$('#dmc_w2').val((+dmc_w2).toFixed(4));
		
		var dmc_w2_w1 = ((+dmc_w2) - (+dmc_w1));
		$('#dmc_w2_w1').val((+dmc_w2_w1).toFixed(1));
		
		var dmc_w3 = randomNumberFromRange(98.8182,101.1432).toFixed(4);
		$('#dmc_w3').val((+dmc_w3).toFixed(4));
		
		var dmc_w3_w1 = ((+dmc_w3) - (+dmc_w1));
		$('#dmc_w3_w1').val((+dmc_w3_w1).toFixed(1));
		
		var dmc_content = (((+dmc_w3) - (+dmc_w1)) / ((+dmc_w2) - (+dmc_w1))) * 100;
		$('#dmc_content').val((+dmc_content).toFixed());
	}
	else if(dmc_selection == "NON LIQUID ADMIXTURE")
	{
		//NON LIQUID ADMIXTURE
		var dmc_non_w1 = randomNumberFromRange(97.7932,98.7932).toFixed(4);
		var dmc_non_w2 = randomNumberFromRange(101.8932,104.2932).toFixed(4);
		$('#dmc_non_w1').val((+dmc_non_w1).toFixed(4));
		$('#dmc_non_w2').val((+dmc_non_w2).toFixed(4));
		
		var dmc_non_w2_w1 = ((+dmc_non_w2) - (+dmc_non_w1));
		$('#dmc_non_w2_w1').val((+dmc_non_w2_w1).toFixed(1));
		
		var dmc_non_w3 = randomNumberFromRange(98.8182,101.1432).toFixed(4);
		$('#dmc_non_w3').val((+dmc_non_w3).toFixed(4));
		
		var dmc_non_w3_w1 = ((+dmc_non_w3) - (+dmc_non_w1));
		$('#dmc_non_w3_w1').val((+dmc_non_w3_w1).toFixed(1));
		
		var dmc_non_content = (((+dmc_non_w3) - (+dmc_non_w1)) / ((+dmc_non_w2) - (+dmc_non_w1))) * 100;
		$('#dmc_non_content').val((+dmc_non_content).toFixed());
	}
	else
	{
		//LIQUID ADMIXTURE
		var dmc_w1 = randomNumberFromRange(97.7932,98.7932).toFixed(4);
		var dmc_w2 = randomNumberFromRange(101.8932,104.2932).toFixed(4);
		$('#dmc_w1').val((+dmc_w1).toFixed(4));
		$('#dmc_w2').val((+dmc_w2).toFixed(4));
		
		var dmc_w2_w1 = ((+dmc_w2) - (+dmc_w1));
		$('#dmc_w2_w1').val((+dmc_w2_w1).toFixed(1));
		
		var dmc_w3 = randomNumberFromRange(98.8182,101.1432).toFixed(4);
		$('#dmc_w3').val((+dmc_w3).toFixed(4));
		
		var dmc_w3_w1 = ((+dmc_w3) - (+dmc_w1));
		$('#dmc_w3_w1').val((+dmc_w3_w1).toFixed(1));
		
		var dmc_content = (((+dmc_w3) - (+dmc_w1)) / ((+dmc_w2) - (+dmc_w1))) * 100;
		$('#dmc_content').val((+dmc_content).toFixed());
		
		//NON LIQUID ADMIXTURE
		var dmc_non_w1 = randomNumberFromRange(97.7932,98.7932).toFixed(4);
		var dmc_non_w2 = randomNumberFromRange(101.8932,104.2932).toFixed(4);
		$('#dmc_non_w1').val((+dmc_non_w1).toFixed(4));
		$('#dmc_non_w2').val((+dmc_non_w2).toFixed(4));
		
		var dmc_non_w2_w1 = ((+dmc_non_w2) - (+dmc_non_w1));
		$('#dmc_non_w2_w1').val((+dmc_non_w2_w1).toFixed(1));
		
		var dmc_non_w3 = randomNumberFromRange(98.8182,101.1432).toFixed(4);
		$('#dmc_non_w3').val((+dmc_non_w3).toFixed(4));
		
		var dmc_non_w3_w1 = ((+dmc_non_w3) - (+dmc_non_w1));
		$('#dmc_non_w3_w1').val((+dmc_non_w3_w1).toFixed(1));
		
		var dmc_non_content = (((+dmc_non_w3) - (+dmc_non_w1)) / ((+dmc_non_w2) - (+dmc_non_w1))) * 100;
		$('#dmc_non_content').val((+dmc_non_content).toFixed());
	}
}
$('#chk_dmc').change(function(){
	if(this.checked)
	{
		dmc_auto();
	}
	else{
		$('#txtdmc').css("background-color","white");
		
		$('#dmc_w1').val(null);
		$('#dmc_w2').val(null);
		$('#dmc_w2_w1').val(null);
		$('#dmc_w3').val(null);
		$('#dmc_w3_w1').val(null);
		$('#dmc_content').val(null);
		$('#dmc_non_w1').val(null);
		$('#dmc_non_w2').val(null);
		$('#dmc_non_w2_w1').val(null);
		$('#dmc_non_w3').val(null);
		$('#dmc_non_w3_w1').val(null);
		$('#dmc_non_content').val(null);
	}
});



$('#dmc_w1,#dmc_w2,#dmc_w3,#dmc_non_w1,#dmc_non_w2,#dmc_non_w3').change(function(){
	$('#txtdmc').css("background-color","var(--success)");
	
	//LIQUID ADMIXTURE
	var dmc_w1 = $('#dmc_w1').val();
	var dmc_w2 = $('#dmc_w2').val();
	
	var dmc_w2_w1 = ((+dmc_w2) - (+dmc_w1));
	$('#dmc_w2_w1').val((+dmc_w2_w1).toFixed(1));
	
	var dmc_w3 = $('#dmc_w3').val();
	
	var dmc_w3_w1 = ((+dmc_w3) - (+dmc_w1));
	$('#dmc_w3_w1').val((+dmc_w3_w1).toFixed(1));
	
	var dmc_content = (((+dmc_w3) - (+dmc_w1)) / ((+dmc_w2) - (+dmc_w1))) * 100;
	$('#dmc_content').val((+dmc_content).toFixed());
	
	//NON LIQUID ADMIXTURE
	var dmc_non_w1 = $('#dmc_non_w1').val();
	var dmc_non_w2 = $('#dmc_non_w2').val();
	
	var dmc_non_w2_w1 = ((+dmc_non_w2) - (+dmc_non_w1));
	$('#dmc_non_w2_w1').val((+dmc_non_w2_w1).toFixed(1));
	
	var dmc_non_w3 = $('#dmc_non_w3').val();
	
	var dmc_non_w3_w1 = ((+dmc_non_w3) - (+dmc_non_w1));
	$('#dmc_non_w3_w1').val((+dmc_non_w3_w1).toFixed(1));
	
	var dmc_non_content = (((+dmc_non_w3) - (+dmc_non_w1)) / ((+dmc_non_w2) - (+dmc_non_w1))) * 100;
	$('#dmc_non_content').val((+dmc_non_content).toFixed());
});





//All Auto Function 
$('#chk_auto').change(function(){
	if(this.checked)
	{ 
		var temp = $('#test_list').val();
		var aa= temp.split(",");
		
		//ASH CONTENT
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="ash")
			{
				$("#chk_ash").prop("checked", true); 
				ash_auto();
				break;
			}					
		}
		//PH Value
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="phv")
			{
				$("#chk_phv").prop("checked", true); 
				phv_auto();
				break;
			}					
		}
		//RELATIVE DENSITY
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="rdv")
			{
				$("#chk_rdv").prop("checked", true); 
				rdv_auto();
				break;
			}					
		}
		//CHLORIDE CONTENT
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="clr")
			{
				$("#chk_clr").prop("checked", true); 
				clr_auto();
				break;
			}					
		}
		//DRY MATERIAL CONTENT
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="dmc")
			{
				$("#chk_dmc").prop("checked", true); 
				dmc_auto();
				break;
			}					
		}
	}
});


function get_is_data()
	{
		var temp = $('#test_list').val();
				var aa= temp.split(",");
				
					
				//phv
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phv")
					{
						
						var phv_test_id = $('#phv_test_id').val();
						var material_category = $('#material_category').val();
						var material_id = $('#material_id').val();
						 $.ajax({
							type: 'POST',
							dataType:'JSON',
							url: '<?php echo $base_url; ?>save_admixture.php',
							 data: 'action_type=data&'+$("#Glazed").serialize()+'&test='+phv_test_id+'&material_category='+material_category+'&material_id='+material_id,
								success:function(data){
							   
								if(data.test_method!="" && data.test_method!=null && data.test_method!="undefined")
								{
									
								$('#phv_test_method').val(data.test_method);
								}
								if(data.req_is!="" && data.req_is!=null && data.req_is!="undefined")
								{
									$('#phv_test_req').val(data.req_is);
								}
								if(data.req_limit!="" && data.req_limit!=null && data.req_limit!="undefined")
								{
									
									$('#phv_test_limit').val(data.req_limit);
									
								}
								
								
							}
						});
						break;
					}					
				}
				
				//rdv
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="rdv")
					{
						
						var rdv_test_id = $('#rdv_test_id').val();
						var material_category = $('#material_category').val();
						var material_id = $('#material_id').val();
						 $.ajax({
							type: 'POST',
							dataType:'JSON',
							url: '<?php echo $base_url; ?>save_admixture.php',
							 data: 'action_type=data&'+$("#Glazed").serialize()+'&test='+rdv_test_id+'&material_category='+material_category+'&material_id='+material_id,
								success:function(data){
							   
								if(data.test_method!="" && data.test_method!=null && data.test_method!="undefined")
								{
									
								$('#rdv_test_method').val(data.test_method);
								}
								if(data.req_is!="" && data.req_is!=null && data.req_is!="undefined")
								{
									$('#rdv_test_req').val(data.req_is);
								}
								if(data.req_limit!="" && data.req_limit!=null && data.req_limit!="undefined")
								{
									
									$('#rdv_test_limit').val(data.req_limit);
									
								}
								
								
							}
						});
						break;
					}					
				}
				
				//dmc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dmc")
					{
						
						var dmc_test_id = $('#dmc_test_id').val();
						var material_category = $('#material_category').val();
						var material_id = $('#material_id').val();
						 $.ajax({
							type: 'POST',
							dataType:'JSON',
							url: '<?php echo $base_url; ?>save_admixture.php',
							 data: 'action_type=data&'+$("#Glazed").serialize()+'&test='+dmc_test_id+'&material_category='+material_category+'&material_id='+material_id,
								success:function(data){
							   
								if(data.test_method!="" && data.test_method!=null && data.test_method!="undefined")
								{
									
								$('#dmc_test_method').val(data.test_method);
								}
								if(data.req_is!="" && data.req_is!=null && data.req_is!="undefined")
								{
									$('#dmc_test_req').val(data.req_is);
								}
								if(data.req_limit!="" && data.req_limit!=null && data.req_limit!="undefined")
								{
									
									$('#dmc_test_limit').val(data.req_limit);
									
								}
								
								
							}
						});
						break;
					}					
				}

				//ash
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ash")
					{
						
						var ash_test_id = $('#ash_test_id').val();
						var material_category = $('#material_category').val();
						var material_id = $('#material_id').val();
						 $.ajax({
							type: 'POST',
							dataType:'JSON',
							url: '<?php echo $base_url; ?>save_admixture.php',
							 data: 'action_type=data&'+$("#Glazed").serialize()+'&test='+ash_test_id+'&material_category='+material_category+'&material_id='+material_id,
								success:function(data){
							   
								if(data.test_method!="" && data.test_method!=null && data.test_method!="undefined")
								{
									
								$('#ash_test_method').val(data.test_method);
								}
								if(data.req_is!="" && data.req_is!=null && data.req_is!="undefined")
								{
									$('#ash_test_req').val(data.req_is);
								}
								if(data.req_limit!="" && data.req_limit!=null && data.req_limit!="undefined")
								{
									
									$('#ash_test_limit').val(data.req_limit);
									
								}
								
								
							}
						});
						break;
					}					
				}

				//clr
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="clr")
					{
						
						var clr_test_id = $('#clr_test_id').val();
						var material_category = $('#material_category').val();
						var material_id = $('#material_id').val();
						 $.ajax({
							type: 'POST',
							dataType:'JSON',
							url: '<?php echo $base_url; ?>save_admixture.php',
							 data: 'action_type=data&'+$("#Glazed").serialize()+'&test='+clr_test_id+'&material_category='+material_category+'&material_id='+material_id,
								success:function(data){
							   
								if(data.test_method!="" && data.test_method!=null && data.test_method!="undefined")
								{
									
								$('#clr_test_method').val(data.test_method);
								}
								if(data.req_is!="" && data.req_is!=null && data.req_is!="undefined")
								{
									$('#clr_test_req').val(data.req_is);
								}
								if(data.req_limit!="" && data.req_limit!=null && data.req_limit!="undefined")
								{
									
									$('#clr_test_limit').val(data.req_limit);
									
								}
								
								
							}
						});
						break;
					}					
				}
		
	}
	
	
function saveIs(type,test,material_category,material_id)
{
	 if (type == 'update_phv') {
		 
		 var phv_test_method = $('#phv_test_method').val();
		 var phv_test_req = $('#phv_test_req').val();
		 var phv_test_limit = $('#phv_test_limit').val(); 
		 
		  $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_admixture.php',
        data: 'action_type=add&test='+test+'&material_category='+material_category+'&material_id='+material_id+'&test_method='+phv_test_method+'&req_is='+phv_test_req+'&req_limit='+phv_test_limit,
		dataType: 'JSON',
        success:function(msg){
           get_is_data();
	
        }
    });
		 
		 
	 }
	 
	  if (type == 'update_rdv') {
		 
		 var rdv_test_method = $('#rdv_test_method').val();
		 var rdv_test_req = $('#rdv_test_req').val();
		 var rdv_test_limit = $('#rdv_test_limit').val();
		 
		  $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_admixture.php',
        data: 'action_type=add&test='+test+'&material_category='+material_category+'&material_id='+material_id+'&test_method='+rdv_test_method+'&req_is='+rdv_test_req+'&req_limit='+rdv_test_limit,
		dataType: 'JSON',
        success:function(msg){
           get_is_data();
	
        }
    });
		 
		 
	 }
	 
	  if (type == 'update_dmc') {
		 
		 var dmc_test_method = $('#dmc_test_method').val();
		 var dmc_test_req = $('#dmc_test_req').val();
		 var dmc_test_limit = $('#dmc_test_limit').val();
		 
		  $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_admixture.php',
        data: 'action_type=add&test='+test+'&material_category='+material_category+'&material_id='+material_id+'&test_method='+dmc_test_method+'&req_is='+dmc_test_req+'&req_limit='+dmc_test_limit,
		dataType: 'JSON',
        success:function(msg){
           get_is_data();
	
        }
    });
		 
		 
	 }
	 
	 if (type == 'update_ash') {
		 
		 var ash_test_method = $('#ash_test_method').val();
		 var ash_test_req = $('#ash_test_req').val();
		 var ash_test_limit = $('#ash_test_limit').val();
		 
		  $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_admixture.php',
        data: 'action_type=add&test='+test+'&material_category='+material_category+'&material_id='+material_id+'&test_method='+ash_test_method+'&req_is='+ash_test_req+'&req_limit='+ash_test_limit,
		dataType: 'JSON',
        success:function(msg){
           get_is_data();
	
        }
    });
		 
		 
	 }

	if (type == 'update_clr') {
		 
		 var clr_test_method = $('#clr_test_method').val();
		 var clr_test_req = $('#clr_test_req').val();
		 var clr_test_limit = $('#clr_test_limit').val();
		 
		  $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_admixture.php',
        data: 'action_type=add&test='+test+'&material_category='+material_category+'&material_id='+material_id+'&test_method='+clr_test_method+'&req_is='+clr_test_req+'&req_limit='+clr_test_limit,
		dataType: 'JSON',
        success:function(msg){
           get_is_data();
	
        }
    });
		 
		 
	 }
	 
	 
}	





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
        url: '<?php echo $base_url; ?>save_admixture.php',
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
		var rem_data = $('#rem_data').val();
		var brand_data = $('#brand_data').val();
		var job_no = $('#job_no').val();
		var lab_no = $('#lab_no').val();
		var ulr = $('#ulr').val();
		var amend_date = $('#amend_date').val();
		var ash_s_d = $('#ash_s_d').val();
		var ash_e_d = $('#ash_e_d').val();
		var phv_s_d = $('#phv_s_d').val();
		var phv_e_d = $('#phv_e_d').val();
		var clr_s_d = $('#clr_s_d').val();
		var clr_e_d = $('#clr_e_d').val();
		var rdv_s_d = $('#rdv_s_d').val();
		var rdv_e_d = $('#rdv_e_d').val();
		var dmc_s_d = $('#dmc_s_d').val();
		var dmc_e_d = $('#dmc_e_d').val();	
				
		var temp = $('#test_list').val();
		var aa= temp.split(",");				
									
		//ASH CONTENT
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="ash")
			{
				if(document.getElementById('chk_ash').checked) {
						var chk_ash = "1";
				}
				else{
						var chk_ash = "0";
				}
				var ash_w1 = $('#ash_w1').val();
				var ash_w2 = $('#ash_w2').val();
				var ash_w3 = $('#ash_w3').val();
				var ash_content = $('#ash_content').val();
				var ash_test_method = $('#ash_test_method').val();
				var ash_test_req = $('#ash_test_req').val();
				var ash_test_limit = $('#ash_test_limit').val();
				
				break;
			}
			else
			{
				var chk_ash = "0";
				var ash_w1 = "0";
				var ash_w2 = "0";
				var ash_w3 = "0";
				var ash_content = "0";
				var ash_test_method = "";
				var ash_test_req = "";
				var ash_test_limit = "";
			}
		}
		
		//PH Value
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="phv")
			{
				if(document.getElementById('chk_phv').checked) {
						var chk_phv = "1";
				}
				else{
						var chk_phv = "0";
				}
				var phv_before1 = $('#phv_before1').val();
				var phv_before2 = $('#phv_before2').val();
				var phv_before3 = $('#phv_before3').val();
				var phv_avg_before = $('#phv_avg_before').val();
				var phv_after1 = $('#phv_after1').val();
				var phv_after2 = $('#phv_after2').val();
				var phv_after3 = $('#phv_after3').val();
				var phv_avg_after = $('#phv_avg_after').val();
				var phv_temp1 = $('#phv_temp1').val();
				var phv_temp2 = $('#phv_temp2').val();
				var phv_temp3 = $('#phv_temp3').val();
				var phv_avg_temp = $('#phv_avg_temp').val();
	
				var phv_test_method = $('#phv_test_method').val();
				var phv_test_req = $('#phv_test_req').val();
				var phv_test_limit = $('#phv_test_limit').val();
				
				break;
			}
			else
			{
				var chk_phv = "0";
				var phv_before1 = "0";
				var phv_before2 = "0";
				var phv_before3 = "0";
				var phv_avg_before = "0";
				var phv_after1 = "0";
				var phv_after2 = "0";
				var phv_after3 = "0";
				var phv_avg_after = "0";
				var phv_temp1 = "0";
				var phv_temp2 = "0";
				var phv_temp3 = "0";
				var phv_avg_temp = "0";

				var phv_test_method = "";
				var phv_test_req = "";
				var phv_test_limit = "";
			}
		}
		
		//CHLORIDE CONTENT
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
				var clr_w = $('#clr_w').val();
				var clr_x = $('#clr_x').val();
				var clr_y = $('#clr_y').val();
				var clr_z = $('#clr_z').val();
				var clr_n = $('#clr_n').val();
				var chloride_content = $('#chloride_content').val();

				var clr_test_method = $('#clr_test_method').val();
				var clr_test_req = $('#clr_test_req').val();
				var clr_test_limit = $('#clr_test_limit').val();
				
				break;
			}
			else
			{
				var chk_clr = "0";
				var clr_w = "0";
				var clr_x = "0";
				var clr_y = "0";
				var clr_z = "0";
				var clr_n = "0";
				var chloride_content = "0";
				var clr_test_method = "";
				var clr_test_req = "";
				var clr_test_limit = "";
			}
		}
		
		//RELATIVE DENSITY
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="rdv")
			{
				if(document.getElementById('chk_rdv').checked) {
						var chk_rdv = "1";
				}
				else{
						var chk_rdv = "0";
				}
				var rdv1 = $('#rdv1').val();
				var rdv2 = $('#rdv2').val();
				var rdv3 = $('#rdv3').val();
				var avg_rdv = $('#avg_rdv').val();
				var rdv_test_method = $('#rdv_test_method').val();
				var rdv_test_req = $('#rdv_test_req').val();
				var rdv_test_limit = $('#rdv_test_limit').val();
				
				break;
			}
			else
			{
				var chk_rdv = "0";
				var rdv1 = "0";
				var rdv2 = "0";
				var rdv3 = "0";
				var avg_rdv = "0";
				var rdv_test_method = "";
				var rdv_test_req = "";
				var rdv_test_limit = "";
			}
		}
		
		//DRY MATERIAL CONTENT
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="dmc")
			{
				if(document.getElementById('chk_dmc').checked) {
						var chk_dmc = "1";
				}
				else{
						var chk_dmc = "0";
				}
				var dmc_w1 = $('#dmc_w1').val();
				var dmc_w2 = $('#dmc_w2').val();
				var dmc_w2_w1 = $('#dmc_w2_w1').val();
				var dmc_w3 = $('#dmc_w3').val();
				var dmc_w3_w1 = $('#dmc_w3_w1').val();
				var dmc_content = $('#dmc_content').val();
				var dmc_non_w1 = $('#dmc_non_w1').val();
				var dmc_non_w2 = $('#dmc_non_w2').val();
				var dmc_non_w2_w1 = $('#dmc_non_w2_w1').val();
				var dmc_non_w3 = $('#dmc_non_w3').val();
				var dmc_non_w3_w1 = $('#dmc_non_w3_w1').val();
				var dmc_non_content = $('#dmc_non_content').val();
				var dmc_test_method = $('#dmc_test_method').val();
				var dmc_test_req = $('#dmc_test_req').val();
				var dmc_test_limit = $('#dmc_test_limit').val();
				break;
			}
			else
			{
				var chk_dmc = "0";
				var dmc_w1 = "0";
				var dmc_w2 = "0";
				var dmc_w2_w1 = "0";
				var dmc_w3 = "0";
				var dmc_w3_w1 = "0";
				var dmc_content = "0";
				var dmc_non_w1 = "0";
				var dmc_non_w2 = "0";
				var dmc_non_w2_w1 = "0";
				var dmc_non_w3 = "0";
				var dmc_non_w3_w1 = "0";
				var dmc_non_content = "0";
				var dmc_test_method = "";
				var dmc_test_req = "";
				var dmc_test_limit = "";
			}
		}
		
		
		
		
		
			
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&ulr='+ulr+'&lab_no='+lab_no+'&chk_ash='+chk_ash+'&ash_w1='+ash_w1+'&ash_w2='+ash_w2+'&ash_w3='+ash_w3+'&ash_content='+ash_content+'&chk_phv='+chk_phv+'&phv_before1='+phv_before1+'&phv_before2='+phv_before2+'&phv_before3='+phv_before3+'&phv_avg_before='+phv_avg_before+'&phv_after1='+phv_after1+'&phv_after2='+phv_after2+'&phv_after3='+phv_after3+'&phv_avg_after='+phv_avg_after+'&phv_temp1='+phv_temp1+'&phv_temp2='+phv_temp2+'&phv_temp3='+phv_temp3+'&phv_avg_temp='+phv_avg_temp+'&chk_clr='+chk_clr+'&clr_w='+clr_w+'&clr_x='+clr_x+'&clr_y='+clr_y+'&clr_z='+clr_z+'&clr_n='+clr_n+'&chloride_content='+chloride_content+'&chk_rdv='+chk_rdv+'&rdv1='+rdv1+'&rdv2='+rdv2+'&rdv3='+rdv3+'&avg_rdv='+avg_rdv+'&chk_dmc='+chk_dmc+'&dmc_w1='+dmc_w1+'&dmc_w2='+dmc_w2+'&dmc_w2_w1='+dmc_w2_w1+'&dmc_w3='+dmc_w3+'&dmc_w3_w1='+dmc_w3_w1+'&dmc_content='+dmc_content+'&dmc_non_w1='+dmc_non_w1+'&dmc_non_w2='+dmc_non_w2+'&dmc_non_w2_w1='+dmc_non_w2_w1+'&dmc_non_w3='+dmc_non_w3+'&dmc_non_w3_w1='+dmc_non_w3_w1+'&dmc_non_content='+dmc_non_content+'&ash_s_d='+ash_s_d+'&ash_e_d='+ash_e_d+'&phv_s_d='+phv_s_d+'&phv_e_d='+phv_e_d+'&clr_s_d='+clr_s_d+'&clr_e_d='+clr_e_d+'&rdv_s_d='+rdv_s_d+'&rdv_e_d='+rdv_e_d+'&dmc_s_d='+dmc_s_d+'&dmc_e_d='+dmc_e_d+'&phv_test_method='+phv_test_method+'&phv_test_req='+phv_test_req+'&phv_test_limit='+phv_test_limit+'&rdv_test_method='+rdv_test_method+'&rdv_test_req='+rdv_test_req+'&rdv_test_limit='+rdv_test_limit+'&dmc_test_method='+dmc_test_method+'&dmc_test_req='+dmc_test_req+'&dmc_test_limit='+dmc_test_limit+'&ash_test_method='+ash_test_method+'&ash_test_req='+ash_test_req+'&ash_test_limit='+ash_test_limit+'&clr_test_method='+clr_test_method+'&clr_test_req='+clr_test_req+'&clr_test_limit='+clr_test_limit+'&rem_data='+rem_data+'&brand_data='+brand_data+'&amend_date='+amend_date;

				
				
				
				
	}
	else if (type == 'edit'){
		var rem_data = $('#rem_data').val();
		var brand_data = $('#brand_data').val();
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		var lab_no = $('#lab_no').val();
		var ulr = $('#ulr').val();
		var amend_date = $('#amend_date').val();
		var ash_s_d = $('#ash_s_d').val();
		var ash_e_d = $('#ash_e_d').val();
		var phv_s_d = $('#phv_s_d').val();
		var phv_e_d = $('#phv_e_d').val();
		var clr_s_d = $('#clr_s_d').val();
		var clr_e_d = $('#clr_e_d').val();
		var rdv_s_d = $('#rdv_s_d').val();
		var rdv_e_d = $('#rdv_e_d').val();
		var dmc_s_d = $('#dmc_s_d').val();
		var dmc_e_d = $('#dmc_e_d').val();	
				
		var temp = $('#test_list').val();
		var aa= temp.split(",");				
									
		//ASH CONTENT
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="ash")
			{
				if(document.getElementById('chk_ash').checked) {
						var chk_ash = "1";
				}
				else{
						var chk_ash = "0";
				}
				var ash_w1 = $('#ash_w1').val();
				var ash_w2 = $('#ash_w2').val();
				var ash_w3 = $('#ash_w3').val();
				var ash_content = $('#ash_content').val();
				var ash_test_method = $('#ash_test_method').val();
				var ash_test_req = $('#ash_test_req').val();
				var ash_test_limit = $('#ash_test_limit').val();
				
				break;
			}
			else
			{
				var chk_ash = "0";
				var ash_w1 = "0";
				var ash_w2 = "0";
				var ash_w3 = "0";
				var ash_content = "0";
				var ash_test_method = "";
				var ash_test_req = "";
				var ash_test_limit = "";
			}
		}
		
		//PH Value
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="phv")
			{
				if(document.getElementById('chk_phv').checked) {
						var chk_phv = "1";
				}
				else{
						var chk_phv = "0";
				}
				var phv_before1 = $('#phv_before1').val();
				var phv_before2 = $('#phv_before2').val();
				var phv_before3 = $('#phv_before3').val();
				var phv_avg_before = $('#phv_avg_before').val();
				var phv_after1 = $('#phv_after1').val();
				var phv_after2 = $('#phv_after2').val();
				var phv_after3 = $('#phv_after3').val();
				var phv_avg_after = $('#phv_avg_after').val();
				var phv_temp1 = $('#phv_temp1').val();
				var phv_temp2 = $('#phv_temp2').val();
				var phv_temp3 = $('#phv_temp3').val();
				var phv_avg_temp = $('#phv_avg_temp').val();
	
				var phv_test_method = $('#phv_test_method').val();
				var phv_test_req = $('#phv_test_req').val();
				var phv_test_limit = $('#phv_test_limit').val();
				
				break;
			}
			else
			{
				var chk_phv = "0";
				var phv_before1 = "0";
				var phv_before2 = "0";
				var phv_before3 = "0";
				var phv_avg_before = "0";
				var phv_after1 = "0";
				var phv_after2 = "0";
				var phv_after3 = "0";
				var phv_avg_after = "0";
				var phv_temp1 = "0";
				var phv_temp2 = "0";
				var phv_temp3 = "0";
				var phv_avg_temp = "0";

				var phv_test_method = "";
				var phv_test_req = "";
				var phv_test_limit = "";
			}
		}
		
		//CHLORIDE CONTENT
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
				var clr_w = $('#clr_w').val();
				var clr_x = $('#clr_x').val();
				var clr_y = $('#clr_y').val();
				var clr_z = $('#clr_z').val();
				var clr_n = $('#clr_n').val();
				var chloride_content = $('#chloride_content').val();

				var clr_test_method = $('#clr_test_method').val();
				var clr_test_req = $('#clr_test_req').val();
				var clr_test_limit = $('#clr_test_limit').val();
				
				break;
			}
			else
			{
				var chk_clr = "0";
				var clr_w = "0";
				var clr_x = "0";
				var clr_y = "0";
				var clr_z = "0";
				var clr_n = "0";
				var chloride_content = "0";
				var clr_test_method = "";
				var clr_test_req = "";
				var clr_test_limit = "";
			}
		}
		
		//RELATIVE DENSITY
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="rdv")
			{
				if(document.getElementById('chk_rdv').checked) {
						var chk_rdv = "1";
				}
				else{
						var chk_rdv = "0";
				}
				var rdv1 = $('#rdv1').val();
				var rdv2 = $('#rdv2').val();
				var rdv3 = $('#rdv3').val();
				var avg_rdv = $('#avg_rdv').val();
				var rdv_test_method = $('#rdv_test_method').val();
				var rdv_test_req = $('#rdv_test_req').val();
				var rdv_test_limit = $('#rdv_test_limit').val();
				
				break;
			}
			else
			{
				var chk_rdv = "0";
				var rdv1 = "0";
				var rdv2 = "0";
				var rdv3 = "0";
				var avg_rdv = "0";
				var rdv_test_method = "";
				var rdv_test_req = "";
				var rdv_test_limit = "";
			}
		}
		
		//DRY MATERIAL CONTENT
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="dmc")
			{
				if(document.getElementById('chk_dmc').checked) {
						var chk_dmc = "1";
				}
				else{
						var chk_dmc = "0";
				}
				var dmc_w1 = $('#dmc_w1').val();
				var dmc_w2 = $('#dmc_w2').val();
				var dmc_w2_w1 = $('#dmc_w2_w1').val();
				var dmc_w3 = $('#dmc_w3').val();
				var dmc_w3_w1 = $('#dmc_w3_w1').val();
				var dmc_content = $('#dmc_content').val();
				var dmc_non_w1 = $('#dmc_non_w1').val();
				var dmc_non_w2 = $('#dmc_non_w2').val();
				var dmc_non_w2_w1 = $('#dmc_non_w2_w1').val();
				var dmc_non_w3 = $('#dmc_non_w3').val();
				var dmc_non_w3_w1 = $('#dmc_non_w3_w1').val();
				var dmc_non_content = $('#dmc_non_content').val();
				var dmc_test_method = $('#dmc_test_method').val();
				var dmc_test_req = $('#dmc_test_req').val();
				var dmc_test_limit = $('#dmc_test_limit').val();
				break;
			}
			else
			{
				var chk_dmc = "0";
				var dmc_w1 = "0";
				var dmc_w2 = "0";
				var dmc_w2_w1 = "0";
				var dmc_w3 = "0";
				var dmc_w3_w1 = "0";
				var dmc_content = "0";
				var dmc_non_w1 = "0";
				var dmc_non_w2 = "0";
				var dmc_non_w2_w1 = "0";
				var dmc_non_w3 = "0";
				var dmc_non_w3_w1 = "0";
				var dmc_non_content = "0";
				var dmc_test_method = "";
				var dmc_test_req = "";
				var dmc_test_limit = "";
			}
		}	
				var idEdit = $('#idEdit').val(); 

				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&ulr='+ulr+'&lab_no='+lab_no+'&chk_ash='+chk_ash+'&ash_w1='+ash_w1+'&ash_w2='+ash_w2+'&ash_w3='+ash_w3+'&ash_content='+ash_content+'&chk_phv='+chk_phv+'&phv_before1='+phv_before1+'&phv_before2='+phv_before2+'&phv_before3='+phv_before3+'&phv_avg_before='+phv_avg_before+'&phv_after1='+phv_after1+'&phv_after2='+phv_after2+'&phv_after3='+phv_after3+'&phv_avg_after='+phv_avg_after+'&phv_temp1='+phv_temp1+'&phv_temp2='+phv_temp2+'&phv_temp3='+phv_temp3+'&phv_avg_temp='+phv_avg_temp+'&chk_clr='+chk_clr+'&clr_w='+clr_w+'&clr_x='+clr_x+'&clr_y='+clr_y+'&clr_z='+clr_z+'&clr_n='+clr_n+'&chloride_content='+chloride_content+'&chk_rdv='+chk_rdv+'&rdv1='+rdv1+'&rdv2='+rdv2+'&rdv3='+rdv3+'&avg_rdv='+avg_rdv+'&chk_dmc='+chk_dmc+'&dmc_w1='+dmc_w1+'&dmc_w2='+dmc_w2+'&dmc_w2_w1='+dmc_w2_w1+'&dmc_w3='+dmc_w3+'&dmc_w3_w1='+dmc_w3_w1+'&dmc_content='+dmc_content+'&dmc_non_w1='+dmc_non_w1+'&dmc_non_w2='+dmc_non_w2+'&dmc_non_w2_w1='+dmc_non_w2_w1+'&dmc_non_w3='+dmc_non_w3+'&dmc_non_w3_w1='+dmc_non_w3_w1+'&dmc_non_content='+dmc_non_content+'&ash_s_d='+ash_s_d+'&ash_e_d='+ash_e_d+'&phv_s_d='+phv_s_d+'&phv_e_d='+phv_e_d+'&clr_s_d='+clr_s_d+'&clr_e_d='+clr_e_d+'&rdv_s_d='+rdv_s_d+'&rdv_e_d='+rdv_e_d+'&dmc_s_d='+dmc_s_d+'&dmc_e_d='+dmc_e_d+'&phv_test_method='+phv_test_method+'&phv_test_req='+phv_test_req+'&phv_test_limit='+phv_test_limit+'&rdv_test_method='+rdv_test_method+'&rdv_test_req='+rdv_test_req+'&rdv_test_limit='+rdv_test_limit+'&dmc_test_method='+dmc_test_method+'&dmc_test_req='+dmc_test_req+'&dmc_test_limit='+dmc_test_limit+'&ash_test_method='+ash_test_method+'&ash_test_req='+ash_test_req+'&ash_test_limit='+ash_test_limit+'&clr_test_method='+clr_test_method+'&clr_test_req='+clr_test_req+'&clr_test_limit='+clr_test_limit+'&rem_data='+rem_data+'&brand_data='+brand_data+'&amend_date='+amend_date;


		
				
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_admixture.php',
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
        url: '<?php echo $base_url; ?>save_admixture.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
            $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	
			
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
            $('#rem_data').val(data.rem_data);
            $('#brand_data').val(data.brand_data);
            $('#ash_s_d').val(data.ash_s_d);
			$('#ash_e_d').val(data.ash_e_d);
			$('#phv_s_d').val(data.phv_s_d);
			$('#phv_e_d').val(data.phv_e_d);
			$('#clr_s_d').val(data.clr_s_d);
			$('#clr_e_d').val(data.clr_e_d);
			$('#rdv_s_d').val(data.rdv_s_d);
			$('#rdv_e_d').val(data.rdv_e_d);
			$('#dmc_s_d').val(data.dmc_s_d);
			$('#dmc_e_d').val(data.dmc_e_d);
			
            var temp = $('#test_list').val();
			var aa= temp.split(",");	
			
			//ASH CONTENT
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="ash")
				{
					var chk_ash = data.chk_ash;
					if(chk_ash=="1")
					{
						$('#txtash').css("background-color","var(--success)"); 
						$("#chk_ash").prop("checked", true); 
					}else{
						$('#txtash').css("background-color","white"); 
						$("#chk_ash").prop("checked", false); 
					}
					$('#ash_w1').val(data.ash_w1);
					$('#ash_w2').val(data.ash_w2);
					$('#ash_w3').val(data.ash_w3);
					$('#ash_content').val(data.ash_content);
					$('#ash_test_method').val(data.ash_test_method);
					$('#ash_test_req').val(data.ash_test_req);
					$('#ash_test_limit').val(data.ash_test_limit);
					break;
				}
			}
			
			//PH Value
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="phv")
				{
					var chk_phv = data.chk_phv;
					if(chk_phv=="1")
					{
						$('#txtphv').css("background-color","var(--success)"); 
						$("#chk_phv").prop("checked", true); 
					}else{
						$('#txtphv').css("background-color","white"); 
						$("#chk_phv").prop("checked", false); 
					}
					$('#phv_before1').val(data.phv_before1);
					$('#phv_before2').val(data.phv_before2);
					$('#phv_before3').val(data.phv_before3);
					$('#phv_avg_before').val(data.phv_avg_before);
					$('#phv_after1').val(data.phv_after1);
					$('#phv_after2').val(data.phv_after2);
					$('#phv_after3').val(data.phv_after3);
					$('#phv_avg_after').val(data.phv_avg_after);
					$('#phv_temp1').val(data.phv_temp1);
					$('#phv_temp2').val(data.phv_temp2);
					$('#phv_temp3').val(data.phv_temp3);
					$('#phv_avg_temp').val(data.phv_avg_temp);
					$('#phv_test_method').val(data.phv_test_method);
					$('#phv_test_req').val(data.phv_test_req);
					$('#phv_test_limit').val(data.phv_test_limit);
					break;
				}
			}
			
			//RELATIVE DENSITY
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="rdv")
				{
					var chk_rdv = data.chk_rdv;
					if(chk_rdv=="1")
					{
						$('#txtrdv').css("background-color","var(--success)"); 
						$("#chk_rdv").prop("checked", true); 
					}else{
						$('#txtrdv').css("background-color","white"); 
						$("#chk_rdv").prop("checked", false); 
					}
					$('#rdv1').val(data.rdv1);
					$('#rdv2').val(data.rdv2);
					$('#rdv3').val(data.rdv3);
					$('#avg_rdv').val(data.avg_rdv);
					$('#rdv_test_method').val(data.rdv_test_method);
					$('#rdv_test_req').val(data.rdv_test_req);
					$('#rdv_test_limit').val(data.rdv_test_limit);
					break;
				}
			}
			
			//CHLORIDE CONTENT
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="clr")
				{
					var chk_clr = data.chk_clr;
					if(chk_clr=="1")
					{
						$('#txtclr').css("background-color","var(--success)"); 
						$("#chk_clr").prop("checked", true); 
					}else{
						$('#txtclr').css("background-color","white"); 
						$("#chk_clr").prop("checked", false); 
					}
					$('#clr_w').val(data.clr_w);
					$('#clr_x').val(data.clr_x);
					$('#clr_y').val(data.clr_y);
					$('#clr_z').val(data.clr_z);
					$('#clr_n').val(data.clr_n);
					$('#chloride_content').val(data.chloride_content);
					$('#clr_test_method').val(data.clr_test_method);
					$('#clr_test_req').val(data.clr_test_req);
					$('#clr_test_limit').val(data.clr_test_limit);
					break;
				}
			}
			
			//DRY MATERIAL CONTENT
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="dmc")
				{
					var chk_dmc = data.chk_dmc;
					if(chk_dmc=="1")
					{
						$('#txtdmc').css("background-color","var(--success)	"); 
						$("#chk_dmc").prop("checked", true); 
					}else{
						$('#txtdmc').css("background-color","white"); 
						$("#chk_dmc").prop("checked", false); 
					}
					$('#dmc_w1').val(data.dmc_w1);
					$('#dmc_w2').val(data.dmc_w2);
					$('#dmc_w2_w1').val(data.dmc_w2_w1);
					$('#dmc_w3').val(data.dmc_w3);
					$('#dmc_w3_w1').val(data.dmc_w3_w1);
					$('#dmc_content').val(data.dmc_content);
					$('#dmc_non_w1').val(data.dmc_non_w1);
					$('#dmc_non_w2').val(data.dmc_non_w2);
					$('#dmc_non_w2_w1').val(data.dmc_non_w2_w1);
					$('#dmc_non_w3').val(data.dmc_non_w3);
					$('#dmc_non_w3_w1').val(data.dmc_non_w3_w1);
					$('#dmc_non_content').val(data.dmc_non_content);
					$('#dmc_test_method').val(data.dmc_test_method);
					$('#dmc_test_req').val(data.dmc_test_req);
					$('#dmc_test_limit').val(data.dmc_test_limit);
					break;
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


