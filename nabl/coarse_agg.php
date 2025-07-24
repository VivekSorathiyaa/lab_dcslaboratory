
<?php 
session_start(); 
include("header.php");
//REMOVE SIDE BAR
/*include("sidebar.php");*/ 
include("connection.php");
error_reporting(1);
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
			
		}
		
?>
 
 
 <div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content common_material p-0">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">BUSG (COARSE AGGREGATE)</h2>
					</div>
					<div class="box-default">
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">

								<div class="col-lg-6">
									<div class="form-group">
									
									  <label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>

									  <div class="col-sm-10">
										<input type="text" class="form-control" id="report_no" value="<?php echo $report_no;?>" name="report_no" ReadOnly >
									  </div>

										
									</div>
								</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>
											<div class="col-sm-10">											
													<input type="text" class="form-control" tabindex="1"  value="<?php echo $job_no;?>" id="job_no" name="job_no" ReadOnly>
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
										  <label for="inputEmail3" class="col-sm-2 control-label">Lab No.:</label>
										 

										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no;?>" name="lab_no" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										</div>
									</div>
									
								</div>
								
								<br>
								
								
								<hr>
								<br>
 
 <div class="panel-group" id="accordion">
	<!-- TEST WISE LOGIC VAIBHAV-->
	  <?php 
  $is_upload = "select * from span_material_assign WHERE `excel_upload`='y' and `report_no`='$report_no' and `job_number`='$job_no'and isdeleted='0'"; 
  
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
									<label for="inputEmail3" class="control-label">Upload Excel :</label>
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

  <?php
	$test_check;
	$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.report_no='$_GET[report_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
			
			if($r1['test_code']=="grd")
			{
				$test_check.="grd,";
			?>
	<div class="panel panel-default" id="grd">
      <div class="panel-heading"id="txtgrd">
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
									<div class="col-lg-8">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">GRADATION OF TESTING</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_grd"  id="chk_grd" value="chk_grd"><br>
												</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="control-label">SAMPLE TAKEN :</label>
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
												<label for="inputEmail3" class="col-sm-2 control-label">Cum. Wt.in gm</label>
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
													<label for="inputEmail3" class="col-sm-2 control-label">53.00</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_1" name="cum_wt_gm_1" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_1" name="ret_wt_gm_1" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_1" name="cum_ret_1" readOnly>
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
													<label for="inputEmail3" class="col-sm-2 control-label">26.50</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_2" name="cum_wt_gm_2" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_2" name="ret_wt_gm_2" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_2" name="cum_ret_2" readOnly>
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
													<label for="inputEmail3" class="col-sm-2 control-label">22.40</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_3" name="cum_wt_gm_3" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_3" name="ret_wt_gm_3" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_3" name="cum_ret_3" readOnly>
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
													<label for="inputEmail3" class="col-sm-2 control-label">13.20</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_4" name="cum_wt_gm_4" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_4" name="ret_wt_gm_4" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_4" name="cum_ret_4" readOnly>
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
													<label for="inputEmail3" class="col-sm-2 control-label">5.60</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_5" name="cum_wt_gm_5" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_5" name="ret_wt_gm_5" readOnly >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_5" name="cum_ret_5" readOnly>
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
													<label for="inputEmail3" class="col-sm-2 control-label">2.80</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_6" name="cum_wt_gm_6" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_6" name="ret_wt_gm_6" readOnly >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_6" name="cum_ret_6" readOnly>
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
													<label for="inputEmail3" class="col-sm-2 control-label">Pan</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_wt_gm_7" name="cum_wt_gm_7" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ret_wt_gm_7" name="ret_wt_gm_7" readOnly >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cum_ret_7" name="cum_ret_7" readOnly>
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
								<div class="row">
										<div class="col-lg-2">
											
										</div>
										<div class="col-lg-2">
											
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="blank_extra" name="blank_extra" readOnly>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											
										</div>
										<div class="col-lg-2">
											
										</div>
										<div class="col-lg-2">
											
										</div>
								</div>
								<br>
								</div>
					  </div>
					</div>
				 
				<?php }
			else if($r1['test_code']=="flk")
			{ $test_check.="flk,";
		
			?>
				<div class="panel panel-default" id="flk">
					<div class="panel-heading" id="txtflk">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
								<h4 class="panel-title">
								<b>FLAKINESS INDEX & ELONGATION INDEX</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse2" class="panel-collapse collapse">
						<div class="panel-body">
						
						<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">FLAKINESS INDEX</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_flk"  id="chk_flk" value="chk_flk"><br>
												</div>
										</div>
									</div>

									
								</div>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">SIZE OF AGGREGATE</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Percentage(%)</label>
									</div>
									</div>
									
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wieght (B1) gm</label>
									</div>
									</div>
									
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">passsing weight from thickness gauge(A1)(gm)</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">% of mass of total number piece (x) = (A1/B1) X 100</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Percentage of total mass Whole Sample Y=(B1/Eb1)x100</label>
									</div>
									</div>

									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">weighted % of the mass passing trought thickness gague=(X x Y)/100</label>
									</div>
									</div>

									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Retained Weight From Lenght gague (A1)(gm)</label>
									</div>
									</div>


									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">% of Mass of total number piece(X)=(A1/B1)x100</label>
									</div>
									</div>

									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weighted % of the mass Retained thougth LENGTH gauge= (x) X (y) / 100</label>
									</div>
									</div>
									
								</div>
								
								<br>
								<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f1"  id="chk_f1" value="chk_f1">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s11" name="s11" value="63MM - 50MM" >
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="p1" name="p1" >
									  </div>
									</div>
									</div>
										
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a1" name="a1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b1" name="b1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c1" name="c1">
									  </div>
									</div>
									</div>													
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d1" name="d1">
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e1" name="e1">
									</div>
								    </div>
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="aa1" name="aa1">
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bb1" name="bb1">
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="dd1" name="dd1">
									</div>
								    </div>
								</div>
							</div>
							<br>						
							<!--Flakiness Index VALUE SR 2-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f2"  id="chk_f2" value="chk_f2">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s12" name="s12" value="50MM - 40MM">
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="p2" name="p2" >
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a2" name="a2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b2" name="b2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c2" name="c2">
									  </div>
									</div>
									</div>													
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d2" name="d2">
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e2" name="e2">
									</div>
								    </div>
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="aa2" name="aa2">
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bb2" name="bb2">
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="dd2" name="dd2">
									</div>
								    </div>
								</div>
							</div>
							<br>
							<!--Flakiness Index VALUE SR 3-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f3"  id="chk_f3" value="chk_f3">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s13" name="s13" value="40MM - 31.5MM" >
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="p3" name="p3" >
									  </div>
									</div>
									</div>
										
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a3" name="a3" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b3" name="b3" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c3" name="c3" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d3" name="d3" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e3" name="e3" >
									</div>
								    </div>
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="aa3" name="aa3">
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bb3" name="bb3" >
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="dd3" name="dd3" >
									</div>
								    </div>
								</div>
							</div>
							<br>
							<!--Flakiness Index VALUE SR 4-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f4"  id="chk_f4" value="chk_f4">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s14" name="s14" value="31.5MM - 25MM" >
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="p4" name="p4" >
									  </div>
									</div>
									</div>
										
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a4" name="a4" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b4" name="b4" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c4" name="c4" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d4" name="d4" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e4" name="e4" >
									</div>
								    </div>
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="aa4" name="aa4">
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bb4" name="bb4" >
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="dd4" name="dd4" >
									</div>
								    </div>
								</div>
							</div>
							<br>					
							<!--Flakiness Index VALUE SR 5-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f5"  id="chk_f5" value="chk_f5">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s15" name="s15" value="25MM - 20MM">
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="p5" name="p5" >
									  </div>
									</div>
									</div>
										
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a5" name="a5" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b5" name="b5" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c5" name="c5" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d5" name="d5" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e5" name="e5" >
									</div>
								    </div>
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="aa5" name="aa5">
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bb5" name="bb5" >
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="dd5" name="dd5" >
									</div>
								    </div>
								</div>
							</div>
							<br>
							<!--Flakiness Index VALUE SR 6-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f6"  id="chk_f6" value="chk_f6">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s16" name="s16" value="20MM - 16MM">
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="p6" name="p6" >
									  </div>
									</div>
									</div>
										
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a6" name="a6" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b6" name="b6" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c6" name="c6" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d6" name="d6" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e6" name="e6" >
									</div>
								    </div>
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="aa6" name="aa6">
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bb6" name="bb6" >
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="dd6" name="dd6" >
									</div>
								    </div>
								</div>
							</div>
							<br>
							<!--Flakiness Index VALUE SR 7-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f7"  id="chk_f7" value="chk_f7">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s17" name="s17" value="16MM - 12.5MM" >
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="p7" name="p7" >
									  </div>
									</div>
									</div>
										
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a7" name="a7" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b7" name="b7" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c7" name="c7" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d7" name="d7" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e7" name="e7" >
									</div>
								    </div>
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="aa7" name="aa7">
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bb7" name="bb7" >
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="dd7" name="dd7" >
									</div>
								    </div>
								</div>
							</div>
							<br>
							<!--Flakiness Index VALUE SR 8-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f8"  id="chk_f8" value="chk_f8">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s18" name="s18" value="12.5MM - 10MM" >
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="p8" name="p8" >
									  </div>
									</div>
									</div>
										
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a8" name="a8" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b8" name="b8" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c8" name="c8" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d8" name="d8" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e8" name="e8" >
									</div>
								    </div>
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="aa8" name="aa8">
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bb8" name="bb8" >
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="dd8" name="dd8" >
									</div>
								    </div>
								</div>
							</div>
							<br>
							<!--Flakiness Index VALUE SR 9-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f9"  id="chk_f9" value="chk_f9">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s19" name="s19" value="10MM - 6.3MM" >
									  </div>
									</div>
									</div>
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="p9" name="p9" >
									  </div>
									</div>
									</div>
										
										
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a9" name="a9" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b9" name="b9" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c9" name="c9" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d9" name="d9" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e9" name="e9" >
									</div>
								    </div>
								</div>	
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="aa9" name="aa9">
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bb9" name="bb9" >
									</div>
								    </div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="dd9" name="dd9" >
									</div>
								    </div>
								</div>
							</div>
							<br>
							
							
							<!--Flakiness Index TOTAL -->
								<div class="row">
									
									
									<div class="col-lg-12">
									<div class="form-group">
									<div class="col-lg-2">
									</div>
									  <div class="col-sm-1">
										 <label for="inputEmail3" class="control-label">A = </label>
									  </div>
									  <div class="col-sm-1">
										<input type="text" class="form-control" id="suma" name="suma" readOnly>
									  </div>
									</div>
									</div>
									
																								
								</div>
								<br>
								<div class="row">
									
									
									<div class="col-lg-6">
									<div class="form-group">
									  <div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">FLAKINESS INDEX, B/A X 100 = </label>
									  </div>
									  <div class="col-sm-4">
										<input type="text" class="form-control" id="fi_index" name="fi_index">
									  </div>
									  <div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">%</label>
									  </div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group">
									  <div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">ELONGATION INDEX, B/A X 100= </label>
									  </div>
									  <div class="col-sm-4">
										<input type="text" class="form-control" id="ei_index" name="ei_index">
									  </div>
									  <div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">%</label>
									  </div>
									</div>
									</div>
																																		
								</div>
								<!--Flakiness Index VALUE OVER-->
								<br>
								<div class="row">
									
									<div class="col-lg-3">
									<div class="form-group">
									<div class="col-sm-12">
									</div>
									</div>
									</div>
									
									
									<div class="col-lg-6">
									<div class="form-group">
									  <div class="col-sm-6">
										 <label for="inputEmail3" class="control-label">Combined Flakiness and Elongation Index (%) =</label>
									  </div>
									  <div class="col-sm-6">
										<input type="text" class="form-control" id="combined_index" name="combined_index"  readOnly>
									  </div>
									  <!--div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">%</label>
									  </div-->
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
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SPECIFIC GRAVITY & WATER ABSORPTION</label>
												<div class="col-sm-8">
													
													<input type="checkbox" name="chk_sp"  id="chk_sp" value="chk_sp"><br>
												</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">Temp. of Water</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="sp_temp" name="sp_temp" ><br>
												</div>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. of Basket and Aggregate in Water, A1 (g):</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. of Basket in Water, A2 (g):</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. of Saturated Aggreagate in Water A(g)=A1 - A2:</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. of Saturated Surface Dry Aggreagate in Air B(g):</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. of Oven Dry Aggreagate in Air C(g):</label>
									</div>
									</div>

									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Specific Gravity G=(c)/(B-A)</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Water Absorption =100 X (B-C)/C</label>
									</div>
									</div>
											
								</div>
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_b_a1_1" name="sp_w_b_a1_1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_b_a2_1" name="sp_w_b_a2_1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_wt_st_1" name="sp_wt_st_1" readonly>
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
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_s_1" name="sp_w_s_1">
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
										<input type="text" class="form-control" id="sp_w_b_a1_2" name="sp_w_b_a1_2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_b_a2_2" name="sp_w_b_a2_2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_wt_st_2" name="sp_wt_st_2" readonly >
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
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_s_2" name="sp_w_s_2">
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
										<input type="text" class="form-control" id="sp_water_abr_2" name="sp_water_abr_2" readonly>
									</div>
								    </div>
								</div>
							</div>
								<br>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Sample ID :</label>
									</div>
									</div>	
									<div class="col-lg-2">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="sp_sample_ca" name="sp_sample_ca" >
									  </div>
									</div>	
									<div class="col-lg-6">
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
										<input type="text" class="form-control" id="sp_water_abr" name="sp_water_abr" >
									  </div>
									</div>
									</div>																										
								</div>
								
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE OVER-->
						
						
						</div>
				  </div>
	</div>
				<?php
				}
				
				else if($r1['test_code']=="abr")
			{	$test_check.="abr,";
			?>
		
				<div class="panel panel-default" id="abr">
				  <div class="panel-heading" id="txtabr">
					<h4 class="panel-title">
					   <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
							<h4 class="panel-title">
							<b>ABRASION VALUE</b>
							</h4>
						</a>
					</h4>
				  </div>
				  <div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
						
						<!--ABRASION VALUE START-->
								
								<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">ABRASION VALUE</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_abr"  id="chk_abr" value="chk_abr"><br>
												</div>
										</div>
									</div>
									
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">Grading :</label>
												<div class="col-sm-8">
													<select class="form-control" id="abr_grading" name="abr_grading">
													<option value="A">Type : A</option>
													<option value="B">Type : B</option>	
													<option value="C">Type : C</option>	
													<option value="D">Type : D</option>	
													<option value="E">Type : E</option>	
													<option value="F">Type : F</option>	
													<option value="G">Type : G</option>	
											</select>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">Weight of Charge (gm):</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="abr_weight_charge" name="abr_weight_charge" >
												</div>
										</div>
									</div>
									
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">Number of spheres used :</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="abr_sphere" name="abr_sphere" >
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">Number of revolution :</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="abr_num_revo" name="abr_num_revo" >
												</div>
										</div>
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Weight of Specimen (Oven Dry) = W1 gm</label>
									</div>
									</div>
									
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Weight of Specimen After Abrasion Test coarser than 1.7 mm IS sieve = W2 gm</label>
									</div>
									</div>
									
									
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">% of Wear = (W1-W2)/W1 X 100</label>
									</div>
									</div>																														
								</div>
								<br>
								<div class="row">
									<div class="col-lg-4">
									<div class="form-group">
									 <div class="col-sm-6">
										<input type="text" class="form-control" id="abr_wt_t_a_1" name="abr_wt_t_a_1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-4">
									<div class="form-group">
									  <div class="col-sm-6">
										<input type="text" class="form-control" id="abr_wt_t_b_1" name="abr_wt_t_b_1" >
									  </div>
									</div>
									</div>
									
									
									<div class="col-lg-4">
									<div class="form-group">
									  <div class="col-sm-6">
										<input type="text" class="form-control two-digits" id="abr_wt_t_c_1" name="abr_wt_t_c_1" >
									  </div>
									</div>
									</div>																														
								</div>
								<br>
								<br>
									<div class="row">
									<div class="col-lg-4">
									<div class="form-group">
									  <div class="col-sm-6">
										<input type="text" class="form-control" id="abr_wt_t_a_2" name="abr_wt_t_a_2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-4">
									<div class="form-group">
									 <div class="col-sm-6">
										<input type="text" class="form-control" id="abr_wt_t_b_2" name="abr_wt_t_b_2" >
									  </div>
									</div>
									</div>
									
									
									<div class="col-lg-4">
									<div class="form-group">
									   <div class="col-sm-6">
										<input type="text" class="form-control two-digits" id="abr_wt_t_c_2" name="abr_wt_t_c_2" >
									  </div>
									</div>
									</div>																														
								</div>
								<br>
								
								<div class="row">
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Abrasion Sample Id :</label>

									  <div class="col-sm-6">
										<input type="text" class="form-control" id="abr_sample_abr" name="abr_sample_abr" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Average Abrasion Value (%) : (i + ii)/2</label>

									  <div class="col-sm-6">
										<input type="text" class="form-control two-digits" id="abr_index" name="abr_index" >
									  </div>
									</div>
									</div>																										
								</div>
								<!--ABRASION VALUE OVER-->
								
						
						</div>
				  </div>
				</div>		
				<?php }
				
				else if($r1['test_code']=="cru")
			{ $test_check.="cru,";?>	
				<div class="panel panel-default" id="cru">
					  <div class="panel-heading" id="txtcru">
							 <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
									<h4 class="panel-title">
									<b>CRUSHING VALUE</b>
									</h4>
								</a>
							</h4>
					  </div>
					  <div id="collapse5" class="panel-collapse collapse">
						<div class="panel-body">
															<!--Crushing VALUE Start-->
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CRUSHING VALUE</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_crushing"  id="chk_crushing" value="chk_crushing"><br>
												</div>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Total Weight taken (12.5mm - 10.0mm) into crushing mould in gm(A)</label>
									</div>
									</div>
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weight of Material passing through IS sieve 2.36mm after crushing load (40 T) applied in gm(B)</label>
									</div>
									</div>
									
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. of Fraction Retained on 2.36 mm IS Sieve, g(C):</label>
									</div>
									</div>

									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Aggregate Crush Value = B/A X 100</label>
									</div>
									</div>
											
								</div>
								<br>
								<!--Crushing VALUE SR 1-->
								<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cr_a_1" name="cr_a_1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cr_b_1" name="cr_b_1" >
									  </div>
									</div>
									</div>																
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cr_c_1" name="cr_c_1">
									  </div>
									</div>
									</div>
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cru_value_1" name="cru_value_1">
									  </div>
									</div>
									</div>									
								</div>
								<br>
								<!--Crushing VALUE SR 2-->
								<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									   <div class="col-sm-12">
										<input type="text" class="form-control" id="cr_a_2" name="cr_a_2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-3">
									<div class="form-group">
									    <div class="col-sm-12">
										<input type="text" class="form-control" id="cr_b_2" name="cr_b_2" >
									  </div>
									</div>
									</div>																
									<div class="col-lg-3">
									<div class="form-group">
									    <div class="col-sm-12">
										<input type="text" class="form-control" id="cr_c_2" name="cr_c_2">
									  </div>
									</div>
									</div>
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cru_value_2" name="cru_value_2">
									  </div>
									</div>
									</div>									
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Sample ID :</label>
									</div>
									</div>	
									<div class="col-lg-3">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="cr_sample_crush" name="cr_sample_crush" >
									  </div>
									</div>	
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Crushing Value % :</label>
									</div>
									</div>
									<div class="col-sm-3">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="cru_value" name="cru_value" >
									  </div>
									</div>
									</div>																										
								</div>
								
								<!--Crushing VALUE OVER-->
						
						
						</div>
					  </div>
				</div>
			 <?php }
			 
				else if($r1['test_code']=="sou")
			{ $test_check.="sou,";?>
				<div class="panel panel-default" id="sou">
					  <div class="panel-heading" id="txtsou">
				  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
							<h4 class="panel-title">
							<b>SOUNDNESS</b>
							</h4>
						</a>
				</h4>
				  </div>
					  <div id="collapse6" class="panel-collapse collapse">
						<div class="panel-body">
						
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SOUNDNESS</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_sou"  id="chk_sou" value="chk_sou"><br>
												</div>
										</div>
									</div>
									
								</div>							<!--SOUNDNESS VALUE Start-->
								<br>
								<div class="row">									
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CONDITION</label>
												<div class="col-sm-8">
													<select class="form-control" id="s1" name="s1">
													<option value="MGSO4">MGSO4</option>
													<option value="NA2SO4">NA2SO4</option>	
													
											</select>
												</div>
										</div>
									</div>
									
								</div>
								
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Passing</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Retained On</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-8 control-label">Wt. of test fraction before test (gms)</label>									  
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. of test fraction after test (gms)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Percentage passing finer sieve after test (actual percent loss)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Corrected Percent Loss Factor</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weight average (corrected percent loss)</label>
									</div>
									</div>
																							
								</div>
								
																
								<br>
								<!--SOUNDNESS VALUE SR 1-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="s2" name="s2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sou_size1" name="sou_size1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="w1" name="w1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ga1" name="ga1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="gb1" name="gb1" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="gc1" name="gc1">
									  </div>									
								     </div>
									</div>								
									<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="s1q" name="s1q" readOnly>
									</div>
								    </div>
									</div>					
								</div>
									<br>						
							<!--SOUNDNESS VALUE SR 2-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sound_sample" name="sound_sample" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sou_size2" name="sou_size2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="w2" name="w2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ga2" name="ga2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="gb2" name="gb2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="gc2" name="gc2">
									  </div>									
								     </div>
									</div>								
									<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="s2q" name="s2q" readOnly>
									</div>
								    </div>
									</div>					
								</div>
							<Br>
							<!--SOUNDNESS VALUE SR 3-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
										  <label for="inputEmail3" class="control-label">TOTAL :</label>
										</div>
									</div>									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wsum" name="wsum" readOnly >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="gasum" name="gasum" readOnly>
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="gbsum" name="gbsum" readOnly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="gcsum" name="gcsum" readOnly>
									  </div>									
								     </div>
									</div>								
									
									<div class="col-lg-2">
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
											<label for="inputEmail3" class="col-sm-4 control-label label-right">Bulk Density</label>
												<div class="col-sm-8">
													
													<input type="checkbox" name="chk_den"  id="chk_den" value="chk_den"><br>
												</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-6 control-label">Select Volume</label>

										  <div class="col-sm-6">
											<select class="form-control" id="den_volume" name="den_volume">
													
													<option value="15000">15000</option>	
													
											</select>
										  </div>
										</div>
									</div>
									
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col-md-6">
									<div class="col-md-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Sample ID</label>
									</div>
									</div>
									
									<div class="col-md-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Condition of aggregate at the time of test (Oven dry/Saturated/ Given moisture content )</label>
									</div>
									</div>
									
									
									<div class="col-md-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Volume of mould<br>(Lit.) “V”</label>
									</div>
									</div>
									
									<div class="col-md-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weight of empty mould (Kg) W<sub>1</sub></label>
									</div>
									</div>
									</div>
									
									<div class="col-md-6">
									<div class="col-md-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weight of mould + Sample (loose)  Kg<br>W<sub>2</sub></label>
									</div>
									</div>

									<div class="col-md-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weight of mould +Sample(Compacted) 25 strokes in each of 3 layer  (Kg) W<sub>3</sub></label>
									</div>
									</div>
									
									<div class="col-md-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Bulk Density (Loose)<br>(W2- W1)/V</label>
									</div>
									</div>
									<div class="col-md-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Bulk Density (Compacted)  Kg/l<br>(W3-W1)/V</label>
									</div>
									</div>
									</div>
											
								</div>
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									<div class="col-md-6">
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="den_lab_1" name="den_lab_1" >
									  </div>
									</div>
									</div>
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ov_1" name="ov_1" >
									  </div>
									</div>
									</div>
									
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="v1" name="v1" >
									  </div>
									</div>
									</div>				
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wt1" name="wt1" >
									  </div>
									</div>
									</div>													
									</div>													
									<div class="col-md-6">
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wm1" name="wm1">
									  </div>									
								     </div>
									</div>								
								<div class="col-md-3">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="ws1" name="ws1" >
									</div>
								    </div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bdl1" name="bdl1" >
									</div>
								    </div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bdc1" name="bdc1" >
									</div>
								    </div>
								</div>
								</div>
							</div>
							<br>						
							<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 2-->
							<div class="row">
									<div class="col-md-6">
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="den_lab_2" name="den_lab_2" >
									  </div>
									</div>
									</div>
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ov_2" name="ov_2" >
									  </div>
									</div>
									</div>
									
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="v2" name="v2" >
									  </div>
									</div>
									</div>				
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wt2" name="wt2" >
									  </div>
									</div>
									</div>													
									</div>													
									<div class="col-md-6">
									<div class="col-md-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="wm2" name="wm2">
									  </div>									
								     </div>
									</div>								
								<div class="col-md-3">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="ws2" name="ws2" >
									</div>
								    </div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bdl2" name="bdl2" >
									</div>
								    </div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="bdc2" name="bdc2" >
									</div>
								    </div>
								</div>
								</div>
							</div>
								<br>
								<div class="row">
									
									<div class="col-md-6">
									</div>	
									<div class="col-md-6">
									<div class="col-lg-6">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
									</div>
									</div>
									<div class="col-sm-3">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="bdl" name="bdl" >
									  </div>
									</div>
									</div>																										
									<div class="col-sm-3">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="bdc" name="bdc" >
									  </div>
									</div>
									</div>																										
									</div>																										
								</div>
								
								
						
						
						</div>
				  </div>
	</div>
				<?php }	
			
				else if($r1['test_code']=="fin")
			{ $test_check.="fin,";?>				
			<div class="panel panel-default" id="fin">
      <div class="panel-heading" id="txtfin">
	  <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
			<h4 class="panel-title">
			<b>10% FINES VALUE</b>
			</h4>
		</a>
		</h4>
      </div>
      <div id="collapse7" class="panel-collapse collapse">
        <div class="panel-body">
		
		<!--Impact VALUE Start-->
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">10% FINES VALUE</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_fines"  id="chk_fines" value="chk_fines"><br>
												</div>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Total Weight taken (12.5mm - 10.0mm) into crushing mould in gm(A)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Load applied for 20mm penetration of plunger for normal crushed aggregates, in Tonnes, (X)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weight of material passing through IS sieve 2.36mm after 20mm penetration of plunger in gm (B)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">percentage fines y = (B/A) * 100</label>
									</div>
									</div>

									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Load required for 10% fines = (14 * x)/(y + 4) (Tonnes)</label>
									</div>
									</div>
											
								</div>
								<br>
								<!--IMPACT VALUE SR 1-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="f_a_1" name="f_a_1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="f_b_1" name="f_b_1">
									  </div>
									</div>
									</div>																
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="f_c_1" name="f_c_1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="f_d_1" name="f_d_1" ReadOnly>
									  </div>
									</div>
									</div>
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="f_e_1" name="f_e_1" ReadOnly>
									  </div>
									</div>
									</div>									
								</div>
								<br>
								<!--IMPACT VALUE SR 2-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									   <div class="col-sm-12">
										<input type="text" class="form-control" id="f_a_2" name="f_a_2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									    <div class="col-sm-12">
										<input type="text" class="form-control" id="f_b_2" name="f_b_2">
									  </div>
									</div>
									</div>																
									<div class="col-lg-2">
									<div class="form-group">
									    <div class="col-sm-12">
										<input type="text" class="form-control" id="f_c_2" name="f_c_2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									    <div class="col-sm-12">
										<input type="text" class="form-control" id="f_d_2" name="f_d_2" ReadOnly>
									  </div>
									</div>
									</div>
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="f_e_2" name="f_e_2" ReadOnly>
									  </div>
									</div>
									</div>									
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3"></div>	
									<div class="col-lg-3"></div>	
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Means of Load required for 10 % fines (Tonnes)</label>
									</div>
									</div>
									<div class="col-sm-2">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="fines_value" name="fines_value" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1"></div>									
								</div>
								
								<!--fines VALUE OVER-->
		
		</div>
      </div>
    </div>
			<?php }	
			
			else if($r1['test_code']=="alk")
			{ $test_check.="alk,";?>	
					<div class="panel panel-default" id="alk">
					  <div class="panel-heading" id="txtalk">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
							<h4 class="panel-title">
							<b>ALKALI REACTION</b>
							</h4>
						</a>
						</h4>
					  </div>
					  <div id="collapse8" class="panel-collapse collapse">
						<div class="panel-body">
									<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">Alkali Reaction</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_alkali"  id="chk_alkali" value="chk_alkali"><br>
												</div>
										</div>
									</div>
									
								</div>
									<div class="row">
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Alkali Reaction</label>

									  <div class="col-sm-6">
										<input type="text" class="form-control" id="alkali_value" name="alkali_value" >
									  </div>
									</div>
									</div>
								</div>
								<br>
								
								<!--ABRASION VALUE OVER-->

						
						</div>
					  </div>
				</div>		

				<?php }
			
			else if($r1['test_code']=="str")
			{ $test_check.="str,";?>	
					<div class="panel panel-default" id="str">
					  <div class="panel-heading"id="txtstr">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
							<h4 class="panel-title">
							<b>STRIPPING VALUE</b>
							</h4>
						</a>
						</h4>
					  </div>
					  <div id="collapse9" class="panel-collapse collapse">
						<div class="panel-body">
									<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">Stripping Value</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_strip"  id="chk_strip" value="chk_strip"><br>
												</div>
										</div>
									</div>
									
									</div>
									<br>
									<div class="row">
									<div class="col-lg-6">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Weight of sample taken (gm) (A)</label>

									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_1" name="strip_1" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_21" name="strip_21" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_31" name="strip_31" >
									  </div>
									</div>
									</div>
									</div>
									<br>
									<div class="row">
									<div class="col-lg-6">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Weight of bitumen (5%)(gm) (B)</label>

									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_2" name="strip_2" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_22" name="strip_22" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_32" name="strip_32" >
									  </div>
									</div>
									</div>
									</div>
									<br>
									<div class="row">
									<div class="col-lg-6">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Total Area of Aggregate (C)</label>

									 <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_3" name="strip_3" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_23" name="strip_23" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_33" name="strip_23" >
									  </div>
									</div>
									</div>
									</div>
									<br>
									<div class="row">
									<div class="col-lg-6">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Uncovered area of aggregate (D)</label>

									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_4" name="strip_4" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_24" name="strip_24" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_34" name="strip_24" >
									  </div>
									</div>
									</div>
									</div>
									<br>
									<div class="row">
									<div class="col-lg-6">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Average Value (E) = ((D)/(C)) * 100</label>

									   <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_5" name="strip_5" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_25" name="strip_25" >
									  </div>
									  <div class="col-sm-2">
										<input type="text" class="form-control" id="strip_35" name="strip_25" >
									  </div>
									</div>
									</div>
								</div>
								<br>
									<div class="row">
									<div class="col-lg-6">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Stripping Value (%)</label>

									  <div class="col-sm-6">
										<input type="text" class="form-control" id="stripping_value" name="stripping_value" >
									  </div>
									</div>
									</div>
								</div>
								<br>
								
								<!--ABRASION VALUE OVER-->

						
						</div>
					  </div>
				</div>		

			<?php }
			
			else if($r1['test_code']=="mdd")
					{ $test_check.="mdd,";?>			
				<div class="panel panel-default" id="mdd_01">
					  <div class="panel-heading" id="txtmdd">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
							<h4 class="panel-title">
							<b>MDD AND OMC</b>
							</h4>
						</a>
					</h4>
					  </div>
					  <div id="collapse10" class="panel-collapse collapse">
						<div class="panel-body">
						<!--MDD AND OMC-->
								<br>								
								<div class="row">
									
									
									<div class="col-lg-6">
									<div class="form-group">									  
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-8 control-label">MDD AND OMC</label>
												<div class="col-sm-4">
													<input type="checkbox" name="chk_mdd"  id="chk_mdd" value="chk_mdd"><br>
												</div>
										</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group">									  
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-8 control-label">VOLUME</label>
												<div class="col-sm-4">
													<select class="form-control" id="volume" name="volume">
													<option value="1000">1000</option>
													<option value="2250">2250</option>	
													
											</select>
												</div>
										</div>
									</div>
									</div>									
											
								</div>
								<br>
								<div class="row">
								
									<div class="col-lg-6">
									<div class="form-group">									  
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-8 control-label">type of Compation</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="type_compation" name="type_compation" >
												</div>
										</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group">									  
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-8 control-label">Empty Mould Weight</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="empty_mould" name="empty_mould" value="3780">
												</div>
										</div>
									</div>
									</div>									
											
								</div>
								<br>
								<div class="row">
								
									<div class="col-lg-6">
									<div class="form-group">									  
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-8 control-label">Weight Of Sample</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="weight_of_sample" name="weight_of_sample" >
												</div>
										</div>
									</div>
									</div>
																	
											
								</div>
						
								<br>
								<div class="row">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Weight Of Soil (gm)</b></div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Water Added (%)</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Water added (ml)</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Weight of mould with soil after compaction </b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Weight of Moist Soil(gm) </b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Bulk Density (gm/cc)</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Container No</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Weight of wet soil (W3) </b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Weight of oven dry soil  </b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>% of moisture content (m)=  </b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Dry Density(gm/cc) </b></div>
											</div>
										</div>
										</div>
								<br>
								
								
								<!------Wt. of Mould + Compacted Soil (w) gm------->
								<div class="row">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wos1" name="wos1" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wad1" name="wad1" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wra1" name="wra1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wmc1" name="wmc1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wms1" name="wms1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="bd1" name="bd1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cnm1" name="cnm1" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ww31" name="ww31" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wd41" name="wd41" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="omc1" name="omc1" >
													
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mdd1" name="mdd1" >
													
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wos2" name="wos2" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wad2" name="wad2" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wra2" name="wra2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wmc2" name="wmc2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wms2" name="wms2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="bd2" name="bd2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cnm2" name="cnm2" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ww32" name="ww32" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wd42" name="wd42" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="omc2" name="omc2" >
													
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mdd2" name="mdd2" >
													
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wos3" name="wos3" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wad3" name="wad3" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wra3" name="wra3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wmc3" name="wmc3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wms3" name="wms3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="bd3" name="bd3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cnm3" name="cnm3" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ww33" name="ww33" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wd43" name="wd43" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="omc3" name="omc3" >
													
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mdd3" name="mdd3" >
													
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wos4" name="wos4" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wad4" name="wad4" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wra4" name="wra4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wmc4" name="wmc4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wms4" name="wms4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="bd4" name="bd4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cnm4" name="cnm4" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ww34" name="ww34" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wd44" name="wd44" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="omc4" name="omc4" >
													
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mdd4" name="mdd4" >
													
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wos5" name="wos5" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wad5" name="wad5" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wra5" name="wra5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wmc5" name="wmc5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wms5" name="wms5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="bd5" name="bd5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cnm5" name="cnm5">
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ww35" name="ww35" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wd45" name="wd45" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="omc5" name="omc5" >
													
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mdd5" name="mdd5" >
													
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wos6" name="wos6" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="wad6" name="wad6" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wra6" name="wra6" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wmc6" name="wmc6" >
												</div>
											</div>
										</div> 
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wms6" name="wms6" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="bd6" name="bd6" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cnm6" name="cnm6">
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ww36" name="ww36" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wd46" name="wd46" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="omc6" name="omc6" >
													
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mdd6" name="mdd6" >
													
												</div>
											</div>
										</div>
								</div>
							
								<br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">mdd</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mdd" name="mdd" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Omc</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="omc" name="omc" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">CBR</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cbr" name="cbr" >
												</div>
											</div>
										</div>
									
											
								</div>


						
						</div>
					 
						<!--new code start-->
					
					 </div>
		
				
				</div>		
				
			<?php }
			
			
			else if($r1['test_code']=="lll")
					{ $test_check.="lll,";?>			
				<div class="panel panel-default" id="lll">
				   <div class="panel-heading" id="txtlll">
				  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse11">
							<h4 class="panel-title">
							<b>LIQUID LIMIT</b>
							</h4>
						</a>
				</h4>
				  </div>
				  <div id="collapse11" class="panel-collapse collapse">
						<div class="panel-body">
						
							<br>								
								
								<br>
								<div class="row">
									
									
									<div class="col-lg-6">
									<div class="form-group">									  
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-8 control-label">Liquid Limit</label>
												<div class="col-sm-4">
													<input type="checkbox" name="chk_ll"  id="chk_ll" value="chk_ll"><br>
												</div>
										</div>
									</div>
									</div>
											
								</div>
						
								<br>
								<div class="row">
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>BH No.</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>depth of sample in (m)</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Lab Id</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Bowl No</b></div>
											</div>    
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Weight of Sample (g)</b></div>
											</div>    
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>No Of Blows (N)</b></div>
											</div>    
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Container No.</b></div>
											</div>    
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Weight of Wet Sample (g)</b></div>
											</div>    
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Weight Of Dry Sample (g)</b></div>
											</div>    
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Moisture Content (%)</b></div>
											</div>    
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Liquid Limit (%)</b></div>
											</div>    
										</div>
										
								</div>
								<br>
								<br>
								
								<!------Penetration------->
								<div class="row">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dep_3" name="dep_3" >
												</div>
											</div>
										</div>								
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dep_1" name="dep_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="lab_no_1" name="lab_no_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="bo_1" name="bo_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="weight_sample_1" name="weight_sample_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="blow1" name="blow1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con1" name="con1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wws1" name="wws1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wds1" name="wds1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mc1" name="mc1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="liquide_limit" name="liquide_limit" >
												</div>
											</div>
										</div>
										
										
								</div>
								<br>
								<div class="row">
									<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Plastic limit</label>
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">BH NO.</label>
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Depth of Sample (m)</label>
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Lab Id</label>
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Bowl No.</label>
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Container No.</label>
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Weight of wet sample (g)</label>
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Weight Of Dry Sample (g)</label>
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Plastic limit (%)</label>
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Average plastic limit(%)</label>
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">plastic Index (%)</label>
												</div>
											</div>
									</div>
									
								</div>
								<br>
								
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dep_4" name="dep_4">
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dep_2" name="dep_2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="lab_no_2" name="lab_no_2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="bo_2" name="bo_2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con2" name="con2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wws2" name="wws2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wds2" name="wds2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pl1" name="pl1" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="plastic_limit" name="plastic_limit" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pi_value" name="pi_value" >
												</div>
											</div>
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="lab_no_3" name="lab_no_3" readOnly >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="bo_3" name="bo_3"  >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con3" name="con3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wws3" name="wws3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wds3" name="wds3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pl2" name="pl2" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											
									</div>
									<div class="col-lg-2">
											
									</div>
									
								</div>
								
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
												
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="lab_no_4" name="lab_no_4"  >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="bo_4" name="bo_4" readOnly >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con4" name="con4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wws4" name="wws4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wds4" name="wds4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pl3" name="pl3" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											
									</div>
									<div class="col-lg-2">
											
									</div>
									
								</div>
								
						
						</div>
				  </div>
				</div>
									
			<?php }
				else if($r1['test_code']=="imp")
				{
				$test_check.="imp,";?>
				
				<div class="panel panel-default" id="imp">
		<div class="panel-heading" id="txtimp">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse12">
					<h4 class="panel-title">
						<b>IMPACT VALUE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse12" class="panel-collapse collapse">
			<div class="panel-body">
			<!--Impact VALUE Start-->
				<br>
				<div class="row">									
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label label-right">IMPACT VALUE</label>
								<div class="col-sm-8">
									<input type="checkbox" name="chk_impact"  id="chk_impact" value="chk_impact"><br>
								</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="control-label">Total Weight taken in mould in g = A:</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="control-label">Weight of material retained on IS sieve 2.36 mm in g = B :</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="control-label">Weight of material passing through IS sieve 2.36mm in g = C:</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label for="inputEmail3" class="control-label">D = A-(C+B)</label>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label for="inputEmail3" class="control-label">Aggregate Impact Value = C/A X 100</label>
						</div>
					</div>
				</div>
				<br>
				<!--IMPACT VALUE SR 1-->
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_w_m_a_1" name="imp_w_m_a_1" >
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_w_m_b_1" name="imp_w_m_b_1" >
							</div>
						</div>
					</div>																
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_w_m_c_1" name="imp_w_m_c_1">
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_w_m_d_1" name="imp_w_m_d_1">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_value_1" name="imp_value_1">
							</div>
						</div>
					</div>									
				</div>
				<br>
				<!--IMPACT VALUE SR 2-->
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_w_m_a_2" name="imp_w_m_a_2" >
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_w_m_b_2" name="imp_w_m_b_2" >
							</div>
						</div>
					</div>																
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_w_m_c_2" name="imp_w_m_c_2" >
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_w_m_d_2" name="imp_w_m_d_2" >
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_value_2" name="imp_value_2" >
							</div>
						</div>
					</div>									
				</div>
				<br>
				<div class="row">
					<div class="col-lg-3"></div>	
					<div class="col-lg-3"></div>	
					<div class="col-lg-3">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-6 control-label">Impact Value %:</label>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="imp_value" name="imp_value">
							</div>
						</div>
					</div>
					<div class="col-lg-1"></div>									
				</div>
				<!--Impact VALUE OVER-->
			</div>
		</div>
    </div>			
				<?php
				}
		}	?>
	</div>
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
													$querys_job1 = "SELECT * FROM coarse_aggregate WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											$val =  $_SESSION['isadmin'];
											if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
											?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_coarse_aggregate.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_coarse_aggregate.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div>
											<?php } ?>
											
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
								<th style="text-align:center;"><label>Report No.</label></th>	
								<th style="text-align:center;"><label>Job No.</label></th>	
								<th style="text-align:center;"><label>Lab No.</label></th>	
								
																		

							</tr>
								<?php
							 $query = "select * from coarse_aggregate WHERE lab_no='$aa'  and `is_deleted`='0'";

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
										<td style="text-align:center;"><?php echo $r['report_no'];?></td>
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
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();


	$('#chk_abr').change(function(){
        if(this.checked)
		{
			$('#txtabr').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtabr').css("background-color","white");	
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
	
	$('#chk_flk').change(function(){
        if(this.checked)
		{
			$('#txtflk').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtflk').css("background-color","white");	
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
	
	$('#chk_crushing').change(function(){
        if(this.checked)
		{
			$('#txtcru').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtcru').css("background-color","white");	
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
	
	$('#chk_fines').change(function(){
        if(this.checked)
		{
			$('#txtfin').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtfin').css("background-color","white");	
		}
		
	});
	
	$('#chk_alkali').change(function(){
        if(this.checked)
		{
			$('#txtalk').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtalk').css("background-color","white");	
		}
		
	});
	
	$('#chk_strip').change(function(){
        if(this.checked)
		{
			$('#txtstr').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtstr').css("background-color","white");	
		}
		
	});
	
	$('#chk_mdd').change(function(){
        if(this.checked)
		{
			$('#txtmdd').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtmdd').css("background-color","white");	
		}
		
	});
	
	$('#chk_ll').change(function(){
        if(this.checked)
		{
			$('#txtlll').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtlll').css("background-color","white");	
		}
		
	});
	
	$('#chk_impact').change(function(){
        if(this.checked)
		{
			$('#txtimp').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtimp').css("background-color","white");	
		}
		
	});
		
	
	
			//ABRASION LOGIC
			var abr_index;
			var abr_wt_t_a_1;
			var abr_wt_t_a_2;
            var abr_wt_t_c_1;
            var abr_wt_t_c_2;
			var abr_wt_t_b_1;
			var abr_wt_t_b_2;
			var abr_sample_abr;
			var abr_grading;
			var abr_weight_charge;
			var abr_num_revo;
			var abr_sphere;
	
	//ABRASION INDEX
	$('#chk_abr').change(function(){
        if(this.checked)
		{
			abr_grading =  $("#abr_grading").val();
			if(abr_grading=="A")
			{
				abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
				
							
			}
			else if(abr_grading=="B")
			{
				abr_weight_charge =  randomNumberFromRange(4559.00, 4609.00);
				abr_sphere = 11;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="C")
			{
				abr_weight_charge =  randomNumberFromRange(3310.00, 3350.00);
				abr_sphere = 8;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="D")
			{
				abr_weight_charge =  randomNumberFromRange(2485.00,2515.00);
				abr_sphere = 6;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="E")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 10000;
				 abr_wt_t_a_2 = 10000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="F")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 10000;
				 abr_wt_t_a_2 = 10000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="G")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 10000;
				 abr_wt_t_a_2 = 10000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
           
			
		}
        else
		{
            $('#abr_sample_abr').val(null);
			$('#abr_wt_t_a_1').val(null);
			$('#abr_wt_t_b_1').val(null);
			$('#abr_wt_t_c_1').val(null);
			$('#abr_wt_t_a_2').val(null);
			$('#abr_wt_t_b_2').val(null);
			$('#abr_wt_t_c_2').val(null);
			$('#abr_index').val(null);
			$('#abr_sphere').val(null);
			$('#abr_num_revo').val(null);
			$('#abr_weight_charge').val(null);			
		}

    });

	$("#abr_wt_t_a_1").change(function(){
			
            $('#abr_sample_abr').val('Coarse Agg.');
			abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
			abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
			//abr_index = $('#abr_index').val();
			var temp = (parseFloat(abr_wt_t_a_1)-parseFloat(abr_wt_t_b_1))/parseFloat(abr_wt_t_a_1);
			var temp1 = (parseFloat(temp)*100);
			abr_wt_t_c_1 = temp1;
            abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();									
			$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
			abr_index = (parseFloat(abr_wt_t_c_1)+parseFloat(abr_wt_t_c_2))/2;
            $('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
					
    });
	$("#abr_wt_t_a_2").change(function(){
			
            $('#abr_sample_abr').val('Coarse Agg. MM');
			abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
			abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
			var temp = (parseFloat(abr_wt_t_a_2)-parseFloat(abr_wt_t_b_2))/parseFloat(abr_wt_t_a_2);
			var temp1 = (parseFloat(temp)*100);
			abr_wt_t_c_2 = temp1;
            abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();						
			var a_c = abr_wt_t_c_2.toFixed(2);			
			$('#abr_wt_t_c_2').val(a_c);
			abr_index = (parseFloat(abr_wt_t_c_1)+parseFloat(abr_wt_t_c_2))/2;
            $('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
					
    });

	$("#abr_wt_t_b_1").change(function(){
			
			$('#abr_sample_abr').val('Coarse Agg.');
			abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
			abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
			var temp = (parseFloat(abr_wt_t_a_1)-parseFloat(abr_wt_t_b_1))/parseFloat(abr_wt_t_a_1);
			var temp1 = (parseFloat(temp)*100);
			abr_wt_t_c_1 = temp1;
            abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();						
			$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));	
			abr_index = (parseFloat(abr_wt_t_c_1)+parseFloat(abr_wt_t_c_2))/2;          
			$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
					
    });
	
	$("#abr_wt_t_b_2").change(function(){
			
			$('#abr_sample_abr').val('Coarse Agg.');
			abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
			abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
			var temp = (parseFloat(abr_wt_t_a_2)-parseFloat(abr_wt_t_b_2))/parseFloat(abr_wt_t_a_2);
			var temp1 = (parseFloat(temp)*100);
			abr_wt_t_c_2 = temp1;
            abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
			$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
			abr_index = (parseFloat(abr_wt_t_c_1)+parseFloat(abr_wt_t_c_2))/2;           
			$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
					
    });
	
	$("#abr_index").change(function(){
			
			abr_grading =  $("#abr_grading").val();
			
			if(abr_grading=="A")
			{
				abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				abr_index = $("#abr_index").val();	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				//$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
				
							
			}
			else if(abr_grading=="B")
			{
				abr_weight_charge =  randomNumberFromRange(4559.00, 4609.00);
				abr_sphere = 11;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				abr_index = $("#abr_index").val();	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				//$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="C")
			{
				abr_weight_charge =  randomNumberFromRange(3310.00, 3350.00);
				abr_sphere = 8;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				abr_index = $("#abr_index").val();		
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				//$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="D")
			{
				abr_weight_charge =  randomNumberFromRange(2485.00,2515.00);
				abr_sphere = 6;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = $("#abr_index").val();		
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				//$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="E")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = $("#abr_index").val();		
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 10000;
				 abr_wt_t_a_2 = 10000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				//$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="F")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				abr_index = $("#abr_index").val();	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 10000;
				 abr_wt_t_a_2 = 10000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				//$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="G")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = $("#abr_index").val();	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 10000;
				 abr_wt_t_a_2 = 10000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				//$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
           
			
			
					
    });
	
	$("#abr_grading").change(function(){
			$("#chk_abr").prop("checked", true); 
		abr_grading =  $("#abr_grading").val();
			if(abr_grading=="A")
			{
				abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
				
							
			}
			else if(abr_grading=="B")
			{
				abr_weight_charge =  randomNumberFromRange(4559.00, 4609.00);
				abr_sphere = 11;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="C")
			{
				abr_weight_charge =  randomNumberFromRange(3310.00, 3350.00);
				abr_sphere = 8;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="D")
			{
				abr_weight_charge =  randomNumberFromRange(2485.00,2515.00);
				abr_sphere = 6;
				abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 5000;
				 abr_wt_t_a_2 = 5000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="E")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 10000;
				 abr_wt_t_a_2 = 10000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="F")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 10000;
				 abr_wt_t_a_2 = 10000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
			else if(abr_grading=="G")
			{
				abr_weight_charge =  randomNumberFromRange(4975.00, 5025.00);
				abr_sphere = 12;
				abr_num_revo = 1000;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));
				 $('#abr_sample_abr').val('Coarse Agg.');
				 
				 abr_index = randomNumberFromRange(16.20,19.20);	
				//alert("abr_index="+abr_index);				 
				 var tt = randomNumberFromRange(-0.10,0.10);
				//alert("tt="+tt);				 
				 abr_wt_t_c_1 = parseFloat(abr_index) + parseFloat(tt);				
				 abr_wt_t_c_2 = parseFloat(abr_index) - parseFloat(tt);						
				 abr_wt_t_a_1 = 10000;
				 abr_wt_t_a_2 = 10000;
				 //alert("abr_wt_t_a_2="+abr_wt_t_a_2);
				 var aa = (parseFloat(abr_wt_t_c_1)*parseInt(abr_wt_t_a_1))/100;
				 //alert("aa="+aa);
				 var bb = (parseFloat(abr_wt_t_c_2)*parseInt(abr_wt_t_a_2))/100;
				 //alert("bb="+bb);
				 abr_wt_t_b_1 = parseInt(abr_wt_t_a_1)-parseFloat(aa);
				 // alert("abr_wt_t_b_1="+abr_wt_t_b_1);
				 abr_wt_t_b_2 = parseInt(abr_wt_t_a_2)-parseFloat(bb);
				// alert("abr_wt_t_b_2="+abr_wt_t_b_2);
				$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
				$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());				
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toString().substring(0, abr_wt_t_c_1.toString().indexOf(".") + 3));
				$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
				$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());				
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toString().substring(0, abr_wt_t_c_2.toString().indexOf(".") + 3));
				$('#abr_index').val(abr_index.toString().substring(0, abr_index.toString().indexOf(".") + 3));
			}
           
	});
	
	
	var sp_sample_ca = "BUSG MIX CA";
	var sp_w_b_a1_2;
	var sp_w_b_a2_2;
	var sp_wt_st_1;
	var sp_wt_st_2;
	var sp_w_s_2;
	var sp_specific_gravity_1;
	var sp_specific_gravity_2;
	var sp_water_abr_1;
	var sp_water_abr_2;
	var sp_w_sur_1;	
	var sp_w_sur_2;	
	var sp_temp;	
	
	$('#chk_sp').change(function(){
        if(this.checked)
		{  
			var sp_temp = randomNumberFromRange(25.00,27.00);			
			$('#sp_temp').val(sp_temp.toString().substring(0, sp_temp.toString().indexOf(".") + 2));
			var sp_specific_gravity = randomNumberFromRange(2.80,2.83);  //(sp_specific_gravity)
			var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.01,0.01); //(sp_specific_gravity_1)_1
			 var tems1 = (parseFloat(sp_specific_gravity) * 2);
			var sp_specific_gravity_2 = (parseFloat(tems1)-parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
			
			var sp_water_abr = randomNumberFromRange(0.34,0.42);// (sp_water_abr)_1
			var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.01,0.01)////(sp_water_abr_1)_1
			 var tems11 = (parseFloat(sp_water_abr) * 2);
			var sp_water_abr_2 = (parseFloat(tems11)-parseFloat(sp_water_abr_1));// (sp_water_abr_2)_1 
			
			
			
			//1     	
			 var sp_w_b_a2_1 = randomNumberFromRange(750.2,760.5);    		 
			var sp_w_s_1 = randomNumberFromRange(1997.3,1998.0);
			var sp_w_sur_1 = ((parseFloat(sp_water_abr_1)*parseFloat(sp_w_s_1))/100)+parseFloat(sp_w_s_1);
			
			var sp_wt_st_1 = ((parseFloat(sp_specific_gravity_1)*parseFloat(sp_w_sur_1))- parseFloat(sp_w_s_1))/parseFloat(sp_specific_gravity_1);
			var sp_w_b_a1_1 = parseFloat(sp_wt_st_1) +  parseFloat(sp_w_b_a2_1);
			
			//2nd TRAIL
			 var sp_w_b_a2_2 = randomNumberFromRange(750.2,760.5);    		 
			var sp_w_s_2 = randomNumberFromRange(1997.3,1998.0);
			var sp_w_sur_2 = ((parseFloat(sp_water_abr_2)*parseFloat(sp_w_s_2))/100)+parseFloat(sp_w_s_2);
			
			var sp_wt_st_2 = ((parseFloat(sp_specific_gravity_2)*parseFloat(sp_w_sur_2))- parseFloat(sp_w_s_2))/parseFloat(sp_specific_gravity_2);
			var sp_w_b_a1_2 = parseFloat(sp_wt_st_2) +  parseFloat(sp_w_b_a2_2);
			
			
										
			$('#sp_w_b_a1_1').val(sp_w_b_a1_1.toString().substring(0, sp_w_b_a1_1.toString().indexOf(".") + 2));
			$('#sp_w_b_a2_1').val(sp_w_b_a2_1.toString().substring(0, sp_w_b_a2_1.toString().indexOf(".") + 2));
			$('#sp_w_sur_1').val(sp_w_sur_1.toString().substring(0, sp_w_sur_1.toString().indexOf(".") + 2));	
			$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));	
			$('#sp_wt_st_1').val(sp_wt_st_1.toString().substring(0, sp_wt_st_1.toString().indexOf(".") + 2));				
			$('#sp_w_b_a1_2').val(sp_w_b_a1_2.toString().substring(0, sp_w_b_a1_2.toString().indexOf(".") + 2));				
			$('#sp_w_b_a2_2').val(sp_w_b_a2_2.toString().substring(0, sp_w_b_a2_2.toString().indexOf(".") + 2));				
			$('#sp_w_sur_2').val(sp_w_sur_2.toString().substring(0, sp_w_sur_2.toString().indexOf(".") + 2));				
			$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));				
			$('#sp_wt_st_2').val(sp_wt_st_2.toString().substring(0, sp_wt_st_2.toString().indexOf(".") + 2));				
														
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 3));				
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 3));				
			$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 3));				
			$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));	
			$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));	
			$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
			$('#sp_sample_ca').val(sp_sample_ca);
			
		}
		else
		{
			$('#sp_w_b_a1_1').val(null);
			$('#sp_w_b_a2_1').val(null);
			$('#sp_w_sur_1').val(null);
			$('#sp_w_s_1').val(null);
			$('#sp_wt_st_1').val(null);
			
			$('#sp_w_b_a1_2').val(null);
			$('#sp_w_b_a2_2').val(null);
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
		}
	});

	$('#sp_specific_gravity').change(function(){
        
			var sp_temp = randomNumberFromRange(25.00,27.00);
			$('#sp_temp').val(sp_temp.toString().substring(0, sp_temp.toString().indexOf(".") + 2));
			var sp_specific_gravity = $("#sp_specific_gravity").val();  //(sp_specific_gravity)
			var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.01,0.01); //(sp_specific_gravity_1)_1
			 var tems1 = (parseFloat(sp_specific_gravity) * 2);
			var sp_specific_gravity_2 = (parseFloat(tems1)-parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
			
			var sp_water_abr = randomNumberFromRange(0.34,0.42);// (sp_water_abr)_1
			var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.01,0.01)////(sp_water_abr_1)_1
			 var tems11 = (parseFloat(sp_water_abr) * 2);
			var sp_water_abr_2 = (parseFloat(tems11)-parseFloat(sp_water_abr_1));// (sp_water_abr_2)_1 
			
			//1     	
			 var sp_w_b_a2_1 = randomNumberFromRange(750.2,760.5);    		 
			var sp_w_s_1 = randomNumberFromRange(1997.3,1998.0);
			var sp_w_sur_1 = ((parseFloat(sp_water_abr_1)*parseFloat(sp_w_s_1))/100)+parseFloat(sp_w_s_1);
			
			var sp_wt_st_1 = ((parseFloat(sp_specific_gravity_1)*parseFloat(sp_w_sur_1))- parseFloat(sp_w_s_1))/parseFloat(sp_specific_gravity_1);
			var sp_w_b_a1_1 = parseFloat(sp_wt_st_1) +  parseFloat(sp_w_b_a2_1);
			
			//2nd TRAIL
			 var sp_w_b_a2_2 = randomNumberFromRange(750.2,760.5);    		 
			var sp_w_s_2 = randomNumberFromRange(1997.3,1998.0);
			var sp_w_sur_2 = ((parseFloat(sp_water_abr_2)*parseFloat(sp_w_s_2))/100)+parseFloat(sp_w_s_2);
			
			var sp_wt_st_2 = ((parseFloat(sp_specific_gravity_2)*parseFloat(sp_w_sur_2))- parseFloat(sp_w_s_2))/parseFloat(sp_specific_gravity_2);
			var sp_w_b_a1_2 = parseFloat(sp_wt_st_2) +  parseFloat(sp_w_b_a2_2);
			
			$('#sp_w_b_a1_1').val(sp_w_b_a1_1.toString().substring(0, sp_w_b_a1_1.toString().indexOf(".") + 2));
			$('#sp_w_b_a2_1').val(sp_w_b_a2_1.toString().substring(0, sp_w_b_a2_1.toString().indexOf(".") + 2));
			$('#sp_w_sur_1').val(sp_w_sur_1.toString().substring(0, sp_w_sur_1.toString().indexOf(".") + 2));	
			$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));	
			$('#sp_wt_st_1').val(sp_wt_st_1.toString().substring(0, sp_wt_st_1.toString().indexOf(".") + 2));				
			$('#sp_w_b_a1_2').val(sp_w_b_a1_2.toString().substring(0, sp_w_b_a1_2.toString().indexOf(".") + 2));				
			$('#sp_w_b_a2_2').val(sp_w_b_a2_2.toString().substring(0, sp_w_b_a2_2.toString().indexOf(".") + 2));				
			$('#sp_w_sur_2').val(sp_w_sur_2.toString().substring(0, sp_w_sur_2.toString().indexOf(".") + 2));				
			$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));				
			$('#sp_wt_st_2').val(sp_wt_st_2.toString().substring(0, sp_wt_st_2.toString().indexOf(".") + 2));				
														
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 3));				
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 3));							
			$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));	
			$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));	
			$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
			$('#sp_sample_ca').val(sp_sample_ca);
			
		
	});

	$('#sp_water_abr').change(function(){
			var sp_temp = randomNumberFromRange(25.00,27.00);
			$('#sp_temp').val(sp_temp.toFixed(1));
			var sp_specific_gravity = $('#sp_specific_gravity').val();  //(sp_specific_gravity)
			var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.01,0.01); //(sp_specific_gravity_1)_1
			 var tems1 = (parseFloat(sp_specific_gravity) * 2);
			var sp_specific_gravity_2 = (parseFloat(tems1)-parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
			
			var sp_water_abr = $('#sp_water_abr').val();// (sp_water_abr)_1
			var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.01,0.01)////(sp_water_abr_1)_1
			 var tems11 = (parseFloat(sp_water_abr) * 2);
			var sp_water_abr_2 = (parseFloat(tems11)-parseFloat(sp_water_abr_1));// (sp_water_abr_2)_1 
			
			//1     	
			 var sp_w_b_a2_1 = randomNumberFromRange(750.2,760.5);    		 
			var sp_w_s_1 = randomNumberFromRange(1997.3,1998.0);
			var sp_w_sur_1 = ((parseFloat(sp_water_abr_1)*parseFloat(sp_w_s_1))/100)+parseFloat(sp_w_s_1);
			
			var sp_wt_st_1 = ((parseFloat(sp_specific_gravity_1)*parseFloat(sp_w_sur_1))- parseFloat(sp_w_s_1))/parseFloat(sp_specific_gravity_1);
			var sp_w_b_a1_1 = parseFloat(sp_wt_st_1) +  parseFloat(sp_w_b_a2_1);
			
			//2nd TRAIL
			 var sp_w_b_a2_2 = randomNumberFromRange(750.2,760.5);    		 
			var sp_w_s_2 = randomNumberFromRange(1997.3,1998.0);
			var sp_w_sur_2 = ((parseFloat(sp_water_abr_2)*parseFloat(sp_w_s_2))/100)+parseFloat(sp_w_s_2);
			
			var sp_wt_st_2 = ((parseFloat(sp_specific_gravity_2)*parseFloat(sp_w_sur_2))- parseFloat(sp_w_s_2))/parseFloat(sp_specific_gravity_2);
			var sp_w_b_a1_2 = parseFloat(sp_wt_st_2) +  parseFloat(sp_w_b_a2_2);
			
			
			$('#sp_w_b_a1_1').val(sp_w_b_a1_1.toString().substring(0, sp_w_b_a1_1.toString().indexOf(".") + 2));
			$('#sp_w_b_a2_1').val(sp_w_b_a2_1.toString().substring(0, sp_w_b_a2_1.toString().indexOf(".") + 2));
			$('#sp_w_sur_1').val(sp_w_sur_1.toString().substring(0, sp_w_sur_1.toString().indexOf(".") + 2));	
			$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));	
			$('#sp_wt_st_1').val(sp_wt_st_1.toString().substring(0, sp_wt_st_1.toString().indexOf(".") + 2));				
			$('#sp_w_b_a1_2').val(sp_w_b_a1_2.toString().substring(0, sp_w_b_a1_2.toString().indexOf(".") + 2));				
			$('#sp_w_b_a2_2').val(sp_w_b_a2_2.toString().substring(0, sp_w_b_a2_2.toString().indexOf(".") + 2));				
			$('#sp_w_sur_2').val(sp_w_sur_2.toString().substring(0, sp_w_sur_2.toString().indexOf(".") + 2));				
			$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));				
			$('#sp_wt_st_2').val(sp_wt_st_2.toString().substring(0, sp_wt_st_2.toString().indexOf(".") + 2));				
														
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 3));				
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 3));				
							
			$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));	
			$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));	
			$('#sp_sample_ca').val(sp_sample_ca);
			
	});

	$("#sp_w_b_a1_1").change(function(){
									
			sp_w_b_a1_1 = $('#sp_w_b_a1_1').val();
			var sp_w_b_a2_1 = randomNumberFromRange(750.2,760.5);
			sp_wt_st_1 = parseFloat(sp_w_b_a1_1)-parseFloat(sp_w_b_a2_1);
			var sp_w_sur_1 = $('#sp_w_sur_1').val();
			var sp_w_s_1 = $('#sp_w_s_1').val();
			sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
			
			$('#sp_wt_st_1').val(sp_wt_st_1.toString().substring(0, sp_wt_st_1.toString().indexOf(".") + 2));				
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 3));							
			sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
			var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
			$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 3));
					
    });
	
	$("#sp_w_b_a1_2").change(function(){
									
			sp_w_b_a1_2 = $('#sp_w_b_a1_2').val();
			var sp_w_b_a2_2 = randomNumberFromRange(750.2,760.5);
			sp_wt_st_2 = parseFloat(sp_w_b_a1_2)-parseFloat(sp_w_b_a2_2);
			var sp_w_sur_2 = $('#sp_w_sur_2').val();
			var sp_w_s_2 = $('#sp_w_s_2').val();
			sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
			
			$('#sp_wt_st_2').val(sp_wt_st_2.toString().substring(0, sp_wt_st_2.toString().indexOf(".") + 2));				
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 3));
			sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
			var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
			$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 3));
					
    });
	
	$("#sp_w_b_a2_1").change(function(){
		
		sp_w_b_a1_1 = $('#sp_w_b_a1_1').val();
		var sp_w_b_a2_1 = $('#sp_w_b_a2_1').val();
		sp_wt_st_1 = parseFloat(sp_w_b_a1_1)-parseFloat(sp_w_b_a2_1);
		var sp_w_sur_1 = $('#sp_w_sur_1').val();
		var sp_w_s_1 = $('#sp_w_s_1').val();
		sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
		
		$('#sp_wt_st_1').val(sp_wt_st_1.toString().substring(0, sp_wt_st_1.toString().indexOf(".") + 2));
		$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 3));
		sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 3));
		
	});
	
	$("#sp_w_b_a2_2").change(function(){
		sp_w_b_a1_2 = $('#sp_w_b_a1_2').val();
		var sp_w_b_a2_2 = $('#sp_w_b_a2_2').val();
		sp_wt_st_2 = parseFloat(sp_w_b_a1_2)-parseFloat(sp_w_b_a2_2);
		var sp_w_sur_2 = $('#sp_w_sur_2').val();
		var sp_w_s_2 = $('#sp_w_s_2').val();
		sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
		
		$('#sp_wt_st_2').val(sp_wt_st_2.toString().substring(0, sp_wt_st_2.toString().indexOf(".") + 2));				
		$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 3));
		sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 3));
	});

	$("#sp_w_sur_1").change(function(){

		var sp_w_sur_1 = $('#sp_w_sur_1').val();
		sp_wt_st_1 = $('#sp_wt_st_1').val();
		var sp_w_s_1 = $('#sp_w_s_1').val();
		sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
		$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 3));
		sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 3));
		sp_water_abr_1 = (100*(parseFloat(sp_w_sur_1)-parseFloat(sp_w_s_1)))/parseFloat(sp_w_s_1);
		$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));
		sp_water_abr_2 = $('#sp_water_abr_2').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
	});
	
	$("#sp_w_sur_2").change(function(){

		var sp_w_sur_2 = $('#sp_w_sur_2').val();
		sp_wt_st_2 = $('#sp_wt_st_2').val();
		var sp_w_s_2 = $('#sp_w_s_2').val();
		sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
		$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 3));
		sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 3));
		
		sp_water_abr_2 = (100*(parseFloat(sp_w_sur_2)-parseFloat(sp_w_s_2)))/parseFloat(sp_w_s_2);
		$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));
		sp_water_abr_1 = $('#sp_water_abr_1').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
	});
	$("#sp_w_s_1").change(function(){

		var sp_w_sur_1 = $('#sp_w_sur_1').val();
		sp_wt_st_1 = $('#sp_wt_st_1').val();
		var sp_w_s_1 = $('#sp_w_s_1').val();
		sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
		$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 3));
		sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 3));
		
		sp_water_abr_1 = (100*(parseFloat(sp_w_sur_1)-parseFloat(sp_w_s_1)))/parseFloat(sp_w_s_1);
		$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));
		sp_water_abr_2 = $('#sp_water_abr_2').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
	});
	$("#sp_w_s_2").change(function(){

		var sp_w_sur_2 = $('#sp_w_sur_2').val();
		sp_wt_st_2 = $('#sp_wt_st_2').val();
		var sp_w_s_2 = $('#sp_w_s_2').val();
		sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
		$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 3));
		sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 3));
		sp_water_abr_2 = (100*(parseFloat(sp_w_sur_2)-parseFloat(sp_w_s_2)))/parseFloat(sp_w_s_2);		
		$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));
		sp_water_abr_1 = $('#sp_water_abr_1').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
	});
	
	
		//soundness ----------- START
	var sound_sample;
	var sample_id;
	var w1;
	var w2;
	var wsum;
	var ga1;
	var ga2;
	var gasum;
	var gb1;
	var gb2;
	var gbsum;
	var gc1;
	var gc2;
	var gcsum;
	var gd1;
	var gd2;
	var gdsum;
	var ge1;
	var ge2;
	var gesum;
	var s1;
	var s2;	
	
	function sound()
		{
			sound_sample="12.5";
			s2="20";
			sou_size1="12.5";
			sou_size2="10";
			
			$('#sound_sample').val(sound_sample);			
			$('#s2').val(s2);	
			$('#sou_size1').val(sou_size1);	
			$('#sou_size2').val(sou_size2);	
			
			w1=670;
			w2=330;
			wsum=parseFloat(w1)+parseFloat(w2);
			gb1 = randomNumberFromRange(1.20, 3.50);
			gb2 = randomNumberFromRange(965.0, 988.0);			
			gasum = parseFloat(ga1)+parseFloat(ga2);
			
			var soundness = randomNumberFromRange(2.65,7.70).toFixed(2);
			var gasum = randomNumberFromRange(965.0, 988.0).toFixed(1);
			var temp = ((parseFloat(wsum)-parseFloat(gasum))/parseFloat(wsum));
			var gbsum = parseFloat(temp)*100;
			var gcsum = 2.20;
			var soundness = parseFloat(gcsum)*parseFloat(gbsum);
			 
			
			
			
			$('#soundness').val(soundness.toString().substring(0, soundness.toString().indexOf(".") + 3));
			$('#w1').val(w1);
			$('#w2').val(w2);
			$('#wsum').val(wsum);
			
			$('#gasum').val(gasum.toString().substring(0, gasum.toString().indexOf(".") + 3));
			
			$('#gbsum').val(gbsum.toString().substring(0, gbsum.toString().indexOf(".") + 3));
			
			$('#gcsum').val(gcsum.toFixed(2));
			
		
	}
	
	$('#chk_sou').change(function(){
        if(this.checked)
		{ 
			
			sound();
			
		}
		else
		{
			$('#soundness').val(null);			
			$('#sound_sample').val(null);			
			$('#sample_id').val(null);			
			$('#sou_size2').val(null);			
			$('#sou_size1').val(null);			
			$('#sample_id').val(null);			
			
			
			$('#w1').val(null);			
			$('#w2').val(null);			
			$('#wsum').val(null);			
			
			$('#ga1').val(null);			
			$('#ga2').val(null);			
			$('#gasum').val(null);			
			
			$('#gb1').val(null);			
			$('#gb2').val(null);			
			$('#gbsum').val(null);			
			
			$('#gc1').val(null);			
			$('#gc2').val(null);			
			$('#gcsum').val(null);			
			
			$('#gd1').val(null);			
			$('#gd2').val(null);			
			$('#gdsum').val(null);			
			
			$('#ge1').val(null);			
			$('#ge2').val(null);			
			$('#gesum').val(null);			
			
			$('#s1').val(null);			
			$('#s2').val(null);
		}
	});
	
	
	function soundness_data()
	{
				//SOUNDNESS
			sound_sample="12.5";
			s2="20";
			sou_size1="12.5";
			sou_size2="10";
			
			$('#sound_sample').val(sound_sample);			
			$('#s2').val(s2);	
			$('#sou_size1').val(sou_size1);	
			$('#sou_size2').val(sou_size2);	
			
			var soundness = $('#soundness').val();
			var gcsum = $('#gcsum').val();
			var w1 = $('#w1').val();
			var w2 = $('#w2').val();
			var gbsum = parseFloat(soundness)/parseFloat(gcsum);
			var wsum=parseFloat(w1)+parseFloat(w2);
			var temp  = parseFloat(gbsum) * parseFloat(wsum);
			var temp1  = parseFloat(wsum) * 100;
			var gasum = ((parseFloat(temp1) - parseFloat(temp))/100);
			
			
			
			
			
			$('#wsum').val(wsum);
			
			$('#gasum').val(gasum.toString().substring(0, gasum.toString().indexOf(".") + 3));
			
			$('#gbsum').val(gbsum.toString().substring(0, gbsum.toString().indexOf(".") + 3));
			
	}
	
	$('#soundness').change(function(){      
		soundness_data();		
	});
	
	$('#w1').change(function(){      
		soundness_data();		
					
	});
	
	$('#w2').change(function(){      
			
		soundness_data();				
	});
	$('#gcsum').change(function(){      
			
		soundness_data();				
	});
	
	
	
	
//Flakiness INDEX
	var a1;
	var a2;
	var a3;
	var a4;
	var a5;
	var a6;
	var a7;
	var a8;
	var a9;	
	var suma;
	var b1;
	var b2;
	var b3;
	var b4;
	var b5;
	var b6;
	var b7;
	var b8;
	var b9;	
	var c1;
	var c2;
	var c3;
	var c4;
	var c5;
	var c6;
	var c7;
	var c8;
	var c9;
	var d1;
	var d2;
	var d3;
	var d4;
	var d5;
	var d6;
	var d7;
	var d8;
	var d9;	
	var e1;
	var e2;
	var e3;
	var e4;
	var e5;
	var e6;
	var e7;
	var e8;
	var e9;
	//ELONGATION INDEX
	var aa1;
	var aa2;
	var aa3;
	var aa4;
	var aa5;	
	var aa6;	
	var aa7;	
	var aa8;	
	var aa9;	
	var bb1;
	var bb2;
	var bb3;
	var bb4;
	var bb5;	
	var bb6;	
	var bb7;	
	var bb8;	
	var bb9;		
	var dd1;
	var dd2;
	var dd3;
	var dd4;
	var dd5;
	var dd6;
	var dd7;
	var dd8;
	var dd9;
	

	$('#chk_flk').change(function(){
				if(this.checked)
				{ 
					
					$('#fi_index').val(0);
					$('#ei_index').val(0);
					$('#combined_index').val(0);
					
					$('#a1').val(0);
					$('#a2').val(0);
					$('#a3').val(0);
					$('#a4').val(0);
					$('#a5').val(0);
					$('#a6').val(0);
					$('#a7').val(0);
					$('#a8').val(0);
					$('#a9').val(0);
					$('#suma').val(0);
					
					$('#b1').val(0);
					$('#b2').val(0);
					$('#b3').val(0);
					$('#b4').val(0);
					$('#b5').val(0);
					$('#b6').val(0);
					$('#b7').val(0);
					$('#b8').val(0);
					$('#b9').val(0);

					
					$('#c1').val(0);
					$('#c2').val(0);
					$('#c3').val(0);
					$('#c4').val(0);
					$('#c5').val(0);
					$('#c6').val(0);
					$('#c7').val(0);
					$('#c8').val(0);
					$('#c9').val(0);
					
					
					
					$('#d1').val(0);
					$('#d2').val(0);
					$('#d3').val(0);
					$('#d4').val(0);
					$('#d5').val(0);
					$('#d6').val(0);
					$('#d7').val(0);
					$('#d8').val(0);
					$('#d9').val(0);
					
					

					$('#e1').val(0);
					$('#e2').val(0);
					$('#e3').val(0);
					$('#e4').val(0);
					$('#e5').val(0);
					$('#e6').val(0);
					$('#e7').val(0);
					$('#e8').val(0);
					$('#e9').val(0);
					
					
					$('#aa1').val(0);
					$('#aa2').val(0);
					$('#aa3').val(0);
					$('#aa4').val(0);
					$('#aa5').val(0);
					$('#aa6').val(0);
					$('#aa7').val(0);
					$('#aa8').val(0);
					$('#aa9').val(0);
					
					$('#bb1').val(0);	
					$('#bb2').val(0);
					$('#bb3').val(0);
					$('#bb4').val(0);
					$('#bb5').val(0);
					$('#bb6').val(0);
					$('#bb7').val(0);
					$('#bb8').val(0);
					$('#bb9').val(0);
					
					
					$('#dd1').val(0);
					$('#dd2').val(0);			
					$('#dd3').val(0);
					$('#dd4').val(0);
					$('#dd5').val(0);
					$('#dd6').val(0);
					$('#dd7').val(0);
					$('#dd8').val(0);
					$('#dd9').val(0);
					
					
					
					general_flk_elo1();
				}
				else
				{
					$('#fi_index').val(null);
					$('#ei_index').val(null);
					$('#combined_index').val(null);
					
					 $("#chk_f1").prop("checked", false); 
					 $("#chk_f2").prop("checked", false); 
					 $("#chk_f3").prop("checked", false); 
					 $("#chk_f4").prop("checked", false); 
					 $("#chk_f5").prop("checked", false); 
					 $("#chk_f6").prop("checked", false); 
					 $("#chk_f7").prop("checked", false); 
					 $("#chk_f8").prop("checked", false); 
					 $("#chk_f9").prop("checked", false); 
					 $("#chk_f1").attr("disabled", false);
					 $("#chk_f2").attr("disabled", false);
					 $("#chk_f3").attr("disabled", false);
					 $("#chk_f4").attr("disabled", false);
					 $("#chk_f5").attr("disabled", false);
					 $("#chk_f6").attr("disabled", false);
					 $("#chk_f7").attr("disabled", false);
					 $("#chk_f8").attr("disabled", false);
					 $("#chk_f9").attr("disabled", false);
					 
					$('#a1').val(null);
					$('#a2').val(null);
					$('#a3').val(null);
					$('#a4').val(null);
					$('#a5').val(null);
					$('#a6').val(null);
					$('#a7').val(null);
					$('#a8').val(null);
					$('#a9').val(null);
					$('#suma').val(null);
				
					
					$('#b1').val(null);
					$('#b2').val(null);
					$('#b3').val(null);
					$('#b4').val(null);
					$('#b5').val(null);
					$('#b6').val(null);
					$('#b7').val(null);
					$('#b8').val(null);
					$('#b9').val(null);
				
					$('#c1').val(null);
					$('#c2').val(null);
					$('#c3').val(null);
					$('#c4').val(null);
					$('#c5').val(null);
					$('#c6').val(null);
					$('#c7').val(null);
					$('#c8').val(null);
					$('#c9').val(null);
					
					
					$('#d1').val(null);
					$('#d2').val(null);
					$('#d3').val(null);
					$('#d4').val(null);
					$('#d5').val(null);
					$('#d6').val(null);
					$('#d7').val(null);
					$('#d8').val(null);
					$('#d9').val(null);
					

					$('#e1').val(null);
					$('#e2').val(null);
					$('#e3').val(null);
					$('#e4').val(null);
					$('#e5').val(null);
					$('#e6').val(null);
					$('#e7').val(null);
					$('#e8').val(null);
					$('#e9').val(null);
					
					$('#aa1').val(null);
					$('#aa2').val(null);
					$('#aa3').val(null);
					$('#aa4').val(null);
					$('#aa5').val(null);
					$('#aa6').val(null);
					$('#aa7').val(null);
					$('#aa8').val(null);
					$('#aa9').val(null);
					
					$('#bb1').val(null);	
					$('#bb2').val(null);
					$('#bb3').val(null);
					$('#bb4').val(null);
					$('#bb5').val(null);
					$('#bb6').val(null);
					$('#bb7').val(null);
					$('#bb8').val(null);
					$('#bb9').val(null);
				
					$('#dd1').val(null);
					$('#dd2').val(null);			
					$('#dd3').val(null);
					$('#dd4').val(null);
					$('#dd5').val(null);
					$('#dd6').val(null);
					$('#dd7').val(null);
					$('#dd8').val(null);
					$('#dd9').val(null);
							
				}
				
			});
			
			function general_flk_elo1()
			{
				//DISABLE CHECK BOXES
				 /* $("#chk_f1").prop("checked", true);  
				 $("#chk_f2").prop("checked", true);
				 $("#chk_f3").prop("checked", true); */
				 $("#chk_f4").prop("checked", true); 	 
				 $("#chk_f5").prop("checked", true); 		 
				 $("#chk_f6").prop("checked", true);		 
				 $("#chk_f7").prop("checked", true);		 
				 $("#chk_f8").prop("checked", true); 		 
				 $("#chk_f9").prop("checked", true); 		
				
				
					// Weight B1(gm) (a)
					a1 = 0;//randomNumberFromRange(29950.0, 55000.0).toFixed(2);
					a2 = 0;//randomNumberFromRange(29500.0, 33500.0).toFixed(2);
					a3 = 0;//randomNumberFromRange(11500.0, 13500.0).toFixed(2);
					a4 = randomNumberFromRange(7500.0, 8500.0).toFixed(2);		
					a5 = randomNumberFromRange(3100.0, 3500.0).toFixed(2);
					a6 = randomNumberFromRange(1910.0, 2080.0).toFixed(2);
					a7 = randomNumberFromRange(1000.0, 1200.0).toFixed(2);
					a8 = randomNumberFromRange(550.0, 680.0).toFixed(2);
					a9 = randomNumberFromRange(150.0, 200.0).toFixed(2);

					suma = parseFloat(a1)+parseFloat(a2)+parseFloat(a3)+parseFloat(a4)+parseFloat(a5)+parseFloat(a6)+parseFloat(a7)+parseFloat(a8)+parseFloat(a9);
					
					
					b1 = 0;//randomNumberFromRange(1750.0, 3650.0).toFixed(2);
					b2 = 0;//randomNumberFromRange(1360.0, 2150.0).toFixed(2); 
					b3 = 0;//randomNumberFromRange(1125.0, 1890.0).toFixed(2); 
					b4 = randomNumberFromRange(670.0, 940.0).toFixed(2); 
					b5 = randomNumberFromRange(430.0, 670.0).toFixed(2); 
					b6 = randomNumberFromRange(220.0, 340.0).toFixed(2); 
					b7 = randomNumberFromRange(130.00, 190.00).toFixed(2);
					b8 = randomNumberFromRange(90.00, 140.00).toFixed(2); 
					b9 = randomNumberFromRange(45.00, 80.30).toFixed(2); 
					
					c1 = 0;//(parseFloat(b1)/parseFloat(a1))*100;
					c2 = 0;//(parseFloat(b2)/parseFloat(a2))*100;
					c3 = 0;//(parseFloat(b3)/parseFloat(a3))*100;
					c4 = (parseFloat(b4)/parseFloat(a4))*100;
					c5 = (parseFloat(b5)/parseFloat(a5))*100;
					c6 = (parseFloat(b6)/parseFloat(a6))*100;
					c7 = (parseFloat(b7)/parseFloat(a7))*100;
					c8 = (parseFloat(b8)/parseFloat(a8))*100;
					c9 = (parseFloat(b9)/parseFloat(a9))*100;

					d1 = 0;//(parseFloat(a1)/parseFloat(suma))*100;
					d2 = 0;//(parseFloat(a2)/parseFloat(suma))*100;
					d3 = 0;//(parseFloat(a3)/parseFloat(suma))*100;
					d4 = (parseFloat(a4)/parseFloat(suma))*100;
					d5 = (parseFloat(a5)/parseFloat(suma))*100;
					d6 = (parseFloat(a6)/parseFloat(suma))*100;
					d7 = (parseFloat(a7)/parseFloat(suma))*100;
					d8 = (parseFloat(a8)/parseFloat(suma))*100;
					d9 = (parseFloat(a9)/parseFloat(suma))*100;
					
					// THICKNESS GAUGAE OF FLAKINESS (E)  (X * Y)/100
					e1 = 0;//(parseFloat(c1)* parseFloat(d1))/100;
					e2 = 0;//(parseFloat(c2)* parseFloat(d2))/100;
					e3 = 0;//(parseFloat(c3)* parseFloat(d3))/100;
					e4 = (parseFloat(c4)* parseFloat(d4))/100;	
					e5 = (parseFloat(c5)* parseFloat(d5))/100;
					e6 = (parseFloat(c6)* parseFloat(d6))/100;
					e7 = (parseFloat(c7)* parseFloat(d7))/100;
					e8 = (parseFloat(c8)* parseFloat(d8))/100;
					e9 = (parseFloat(c9)* parseFloat(d9))/100;
					
					var fi_index = parseFloat(e1)+parseFloat(e2)+parseFloat(e3)+parseFloat(e4)+parseFloat(e5)+parseFloat(e6)+parseFloat(e7)+parseFloat(e8)+parseFloat(e9);
					$('#fi_index').val(fi_index.toString().substring(0, fi_index.toString().indexOf(".") + 3));
					
					aa1= 0;//randomNumberFromRange(1790.00,3480.00).toFixed(2);
					aa2= 0;//randomNumberFromRange(1260.00,2120.00).toFixed(2);
					aa3= 0;//randomNumberFromRange(1130.00,1880.00).toFixed(2);
					aa4= randomNumberFromRange(670.00,940.00).toFixed(2);
					aa5= randomNumberFromRange(430.00,670.00).toFixed(2); 
					aa6= randomNumberFromRange(220.00,340.00).toFixed(2); 
					aa7= randomNumberFromRange(130.00,190.00).toFixed(2);
					aa8= randomNumberFromRange(90.00,140.00).toFixed(2);
					aa9= randomNumberFromRange(45.00,80.00).toFixed(2);
					
					bb1= 0;//(parseFloat(aa1)/parseFloat(a1))*100;
					bb2=0;//(parseFloat(aa2)/parseFloat(a2))*100;
					bb3=0;//(parseFloat(aa3)/parseFloat(a3))*100;
					bb4=(parseFloat(aa4)/parseFloat(a4))*100;
					bb5=(parseFloat(aa5)/parseFloat(a5))*100;
					bb6=(parseFloat(aa6)/parseFloat(a6))*100;
					bb7=(parseFloat(aa7)/parseFloat(a7))*100;
					bb8=(parseFloat(aa8)/parseFloat(a8))*100;
					bb9=(parseFloat(aa9)/parseFloat(a9))*100;
					
					dd1 = 0;//(parseFloat(bb1)*parseFloat(d1))/100;
					dd2 = 0;//(parseFloat(bb2)*parseFloat(d2))/100;
					dd3 = 0;//(parseFloat(bb3)*parseFloat(d3))/100;
					dd4 = (parseFloat(bb4)*parseFloat(d4))/100;
					dd5 = (parseFloat(bb5)*parseFloat(d5))/100;
					dd6 = (parseFloat(bb6)*parseFloat(d6))/100;
					dd7 = (parseFloat(bb7)*parseFloat(d7))/100;
					dd8 = (parseFloat(bb8)*parseFloat(d8))/100;
					dd9 = (parseFloat(bb9)*parseFloat(d9))/100;
					
					
					
					
					var ei_index = parseFloat(dd1)+parseFloat(dd2)+parseFloat(dd3)+parseFloat(dd4)+parseFloat(dd5)+parseFloat(dd6)+parseFloat(dd7)+parseFloat(dd8)+parseFloat(dd9);
					$('#ei_index').val(ei_index.toString().substring(0, ei_index.toString().indexOf(".") + 3));
					
					var combined_index = parseFloat(fi_index)+parseFloat(ei_index);
					$('#combined_index').val(combined_index.toString().substring(0, combined_index.toString().indexOf(".") + 3));
					
					
					
					
					

					
					$('#a1').val(a1.toString().substring(0, a1.toString().indexOf(".") + 3));
					$('#a2').val(a2.toString().substring(0, a2.toString().indexOf(".") + 3));
					$('#a3').val(a3.toString().substring(0, a3.toString().indexOf(".") + 3));
					$('#a4').val(a4.toString().substring(0, a4.toString().indexOf(".") + 3));
					$('#a5').val(a5.toString().substring(0, a5.toString().indexOf(".") + 3));
					$('#a6').val(a6.toString().substring(0, a6.toString().indexOf(".") + 3));
					$('#a7').val(a7.toString().substring(0, a7.toString().indexOf(".") + 3));
					$('#a8').val(a8.toString().substring(0, a8.toString().indexOf(".") + 3));
					$('#a9').val(a9.toString().substring(0, a9.toString().indexOf(".") + 3));			
					$('#suma').val(suma.toString().substring(0, suma.toString().indexOf(".") + 3));			
					
					$('#b1').val(b1.toString().substring(0, b1.toString().indexOf(".") + 3));
					$('#b2').val(b2.toString().substring(0, b2.toString().indexOf(".") + 3));
					$('#b3').val(b3.toString().substring(0, b3.toString().indexOf(".") + 3));
					$('#b4').val(b4.toString().substring(0, b4.toString().indexOf(".") + 3));
					$('#b5').val(b5.toString().substring(0, b5.toString().indexOf(".") + 3));
					$('#b6').val(b6.toString().substring(0, b6.toString().indexOf(".") + 3));
					$('#b7').val(b7.toString().substring(0, b7.toString().indexOf(".") + 3));
					$('#b8').val(b8.toString().substring(0, b8.toString().indexOf(".") + 3));
					$('#b9').val(b9.toString().substring(0, b9.toString().indexOf(".") + 3));	
					
					$('#c1').val(c1.toString().substring(0, c1.toString().indexOf(".") + 3));
					$('#c2').val(c2.toString().substring(0, c2.toString().indexOf(".") + 3));
					$('#c3').val(c3.toString().substring(0, c3.toString().indexOf(".") + 3));
					$('#c4').val(c4.toString().substring(0, c4.toString().indexOf(".") + 3));
					$('#c5').val(c5.toString().substring(0, c5.toString().indexOf(".") + 3));
					$('#c6').val(c6.toString().substring(0, c6.toString().indexOf(".") + 3));
					$('#c7').val(c7.toString().substring(0, c7.toString().indexOf(".") + 3));
					$('#c8').val(c8.toString().substring(0, c8.toString().indexOf(".") + 3));
					$('#c9').val(c9.toString().substring(0, c9.toString().indexOf(".") + 3));
								
					$('#d1').val(d1.toString().substring(0, d1.toString().indexOf(".") + 3));
					$('#d2').val(d2.toString().substring(0, d2.toString().indexOf(".") + 3));
					$('#d3').val(d3.toString().substring(0, d3.toString().indexOf(".") + 3));
					$('#d4').val(d4.toString().substring(0, d4.toString().indexOf(".") + 3));
					$('#d5').val(d5.toString().substring(0, d5.toString().indexOf(".") + 3));
					$('#d6').val(d6.toString().substring(0, d6.toString().indexOf(".") + 3));
					$('#d7').val(d7.toString().substring(0, d7.toString().indexOf(".") + 3));
					$('#d8').val(d8.toString().substring(0, d8.toString().indexOf(".") + 3));
					$('#d9').val(d9.toString().substring(0, d9.toString().indexOf(".") + 3));
					
					
					$('#e1').val(e1.toString().substring(0, e1.toString().indexOf(".") + 3));
					$('#e2').val(e2.toString().substring(0, e2.toString().indexOf(".") + 3));
					$('#e3').val(e3.toString().substring(0, e3.toString().indexOf(".") + 3));
					$('#e4').val(e4.toString().substring(0, e4.toString().indexOf(".") + 3));
					$('#e5').val(e5.toString().substring(0, e5.toString().indexOf(".") + 3));
					$('#e6').val(e6.toString().substring(0, e6.toString().indexOf(".") + 3));
					$('#e7').val(e7.toString().substring(0, e7.toString().indexOf(".") + 3));
					$('#e8').val(e8.toString().substring(0, e8.toString().indexOf(".") + 3));
					$('#e9').val(e9.toString().substring(0, e9.toString().indexOf(".") + 3));
					
					$('#aa1').val(aa1.toString().substring(0, aa1.toString().indexOf(".") + 3));
					$('#aa2').val(aa2.toString().substring(0, aa2.toString().indexOf(".") + 3));
					$('#aa3').val(aa3.toString().substring(0, aa3.toString().indexOf(".") + 3));
					$('#aa4').val(aa4.toString().substring(0, aa4.toString().indexOf(".") + 3));
					$('#aa5').val(aa5.toString().substring(0, aa5.toString().indexOf(".") + 3));
					$('#aa6').val(aa6.toString().substring(0, aa6.toString().indexOf(".") + 3));
					$('#aa7').val(aa7.toString().substring(0, aa7.toString().indexOf(".") + 3));
					$('#aa8').val(aa8.toString().substring(0, aa8.toString().indexOf(".") + 3));
					$('#aa9').val(aa9.toString().substring(0, aa9.toString().indexOf(".") + 3));
					
					$('#bb1').val(bb1.toString().substring(0, bb1.toString().indexOf(".") + 3));
					$('#bb2').val(bb2.toString().substring(0, bb2.toString().indexOf(".") + 3));
					$('#bb3').val(bb3.toString().substring(0, bb3.toString().indexOf(".") + 3));
					$('#bb4').val(bb4.toString().substring(0, bb4.toString().indexOf(".") + 3));
					$('#bb5').val(bb5.toString().substring(0, bb5.toString().indexOf(".") + 3));
					$('#bb6').val(bb6.toString().substring(0, bb6.toString().indexOf(".") + 3));
					$('#bb7').val(bb7.toString().substring(0, bb7.toString().indexOf(".") + 3));
					$('#bb8').val(bb8.toString().substring(0, bb8.toString().indexOf(".") + 3));
					$('#bb9').val(bb9.toString().substring(0, bb9.toString().indexOf(".") + 3));
				
					$('#dd1').val(dd1.toString().substring(0, dd1.toString().indexOf(".") + 3));
					$('#dd2').val(dd2.toString().substring(0, dd2.toString().indexOf(".") + 3));
					$('#dd3').val(dd3.toString().substring(0, dd3.toString().indexOf(".") + 3));
					$('#dd4').val(dd4.toString().substring(0, dd4.toString().indexOf(".") + 3));
					$('#dd5').val(dd5.toString().substring(0, dd5.toString().indexOf(".") + 3));
					$('#dd6').val(dd6.toString().substring(0, dd6.toString().indexOf(".") + 3));
					$('#dd7').val(dd7.toString().substring(0, dd7.toString().indexOf(".") + 3));
					$('#dd8').val(dd8.toString().substring(0, dd8.toString().indexOf(".") + 3));
					$('#dd9').val(dd9.toString().substring(0, dd9.toString().indexOf(".") + 3));
								
					
					
			}
			
			
			function fi_ei()
			{
				//DISABLE CHECK BOXES
				 /* $("#chk_f1").prop("checked", true);  
				 $("#chk_f2").prop("checked", true); 
				 $("#chk_f3").prop("checked", true);*/ 
				 $("#chk_f4").prop("checked", true); 
				 $("#chk_f5").prop("checked", true); 
				 $("#chk_f6").prop("checked", true); 
				 $("#chk_f7").prop("checked", true); 
				 $("#chk_f8").prop("checked", true); 
				$("#chk_f9").prop("checked", true);  
				
				 
					var fi_index = $('#fi_index').val();
					//$('#fi_index').val(fi_index.toFixed(2));
					var ei_index = $('#ei_index').val();
					//$('#ei_index').val(ei_index.toFixed(2));
					
					var combined_index = parseFloat(fi_index)+parseFloat(ei_index);
					$('#combined_index').val(combined_index.toString().substring(0, combined_index.toString().indexOf(".") + 3));
					
					
					
					
										
					var ep4 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep5 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep6 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep7 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep8 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep9 = (100-(parseFloat(ep4)+parseFloat(ep5)+parseFloat(ep6)+parseFloat(ep7)+parseFloat(ep8)));			
					// THICKNESS GAUGAE OF FLAKINESS (E)  (X * Y)/100
					e1 = 0;//(parseFloat(fi_index)*parseFloat(ep1))/100;
					e2 = 0;//(parseFloat(fi_index)*parseFloat(ep2))/100;
					e3 = 0;//(parseFloat(fi_index)*parseFloat(ep3))/100;
					e4 = (parseFloat(fi_index)*parseFloat(ep4))/100;
					e5 = (parseFloat(fi_index)*parseFloat(ep5))/100;
					e6 = (parseFloat(fi_index)*parseFloat(ep6))/100;
					e7 = (parseFloat(fi_index)*parseFloat(ep7))/100;
					e8 = (parseFloat(fi_index)*parseFloat(ep8))/100;
					e9 = (parseFloat(fi_index)*parseFloat(ep9))/100;
					
					
					
					
					// Weight B1(gm) (a)
					a1 = 0;//randomNumberFromRange(29950.0, 55000.0).toFixed(2);
					a2 = 0;//randomNumberFromRange(29500.0, 33500.0).toFixed(2);
					a3 = 0;//randomNumberFromRange(11500.0, 13500.0).toFixed(2);
					a4 = randomNumberFromRange(7500.0, 8500.0).toFixed(2);		
					a5 = randomNumberFromRange(3100.0, 3500.0).toFixed(2);
					a6 = randomNumberFromRange(1910.0, 2080.0).toFixed(2);
					a7 = randomNumberFromRange(1000.0, 1200.0).toFixed(2);
					a8 = randomNumberFromRange(550.0, 680.0).toFixed(2);
					a9 = randomNumberFromRange(150.0, 200.0).toFixed(2);
					
					suma = parseFloat(a1)+parseFloat(a2)+parseFloat(a3)+parseFloat(a4)+parseFloat(a5)+parseFloat(a6)+parseFloat(a7)+parseFloat(a8)+parseFloat(a9);


					d1 = 0;//((parseFloat(a1)/parseFloat(suma))*100);
					d2 = 0;//((parseFloat(a2)/parseFloat(suma))*100);
					d3 = 0;//((parseFloat(a3)/parseFloat(suma))*100);
					d4 = ((parseFloat(a4)/parseFloat(suma))*100);
					d5 = ((parseFloat(a5)/parseFloat(suma))*100);
					d6 = ((parseFloat(a6)/parseFloat(suma))*100);
					d7 = ((parseFloat(a7)/parseFloat(suma))*100);
					d8 = ((parseFloat(a8)/parseFloat(suma))*100);
					d9 = ((parseFloat(a9)/parseFloat(suma))*100);
					
					c1 = 0;//(parseFloat(e1)*100)/parseFloat(d1);
					c2 = 0;//(parseFloat(e2)*100)/parseFloat(d2);
					c3 = 0;//(parseFloat(e3)*100)/parseFloat(d3);
					c4 = (parseFloat(e4)*100)/parseFloat(d4);
					c5 = (parseFloat(e5)*100)/parseFloat(d5);
					c6 = (parseFloat(e6)*100)/parseFloat(d6);
					c7 = (parseFloat(e7)*100)/parseFloat(d7);
					c8 = (parseFloat(e8)*100)/parseFloat(d8);
					c9 = (parseFloat(e9)*100)/parseFloat(d9);


					b1 = 0;//(parseFloat(c1)*parseFloat(a1))/100;
					b2 = 0;//(parseFloat(c2)*parseFloat(a2))/100;
					b3 = 0;//(parseFloat(c3)*parseFloat(a3))/100;
					b4 = (parseFloat(c4)*parseFloat(a4))/100;
					b5 = (parseFloat(c5)*parseFloat(a5))/100;
					b6 = (parseFloat(c6)*parseFloat(a6))/100;
					b7 = (parseFloat(c7)*parseFloat(a7))/100;
					b8 = (parseFloat(c8)*parseFloat(a8))/100;
					b9 = (parseFloat(c9)*parseFloat(a9))/100;
					
					
					
					
					
					
					var ep41 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep51 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep61 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep71 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep81 = randomNumberFromRange(5.00,16.00).toFixed(2);	
					var ep91 = (100-(parseFloat(ep41)+parseFloat(ep51)+parseFloat(ep61)+parseFloat(ep71)+parseFloat(ep81)));
					dd1 = 0;//(parseFloat(ei_index)*parseFloat(ep11))/100;
					dd2 = 0;//(parseFloat(ei_index)*parseFloat(ep21))/100;
					dd3 = 0;//(parseFloat(ei_index)*parseFloat(ep31))/100;
					dd4 = (parseFloat(ei_index)*parseFloat(ep41))/100;
					dd5 = (parseFloat(ei_index)*parseFloat(ep51))/100;
					dd6 = (parseFloat(ei_index)*parseFloat(ep61))/100;
					dd7 = (parseFloat(ei_index)*parseFloat(ep71))/100;
					dd8 = (parseFloat(ei_index)*parseFloat(ep81))/100;
					dd9 = (parseFloat(ei_index)*parseFloat(ep91))/100;
					
					
					
					
					bb1=0;//(parseFloat(dd1)*100)/parseFloat(d1);
					bb2=0;//(parseFloat(dd2)*100)/parseFloat(d2);
					bb3=0;//(parseFloat(dd3)*100)/parseFloat(d3);
					bb4=(parseFloat(dd4)*100)/parseFloat(d4);
					bb5=(parseFloat(dd5)*100)/parseFloat(d5);
					bb6=(parseFloat(dd6)*100)/parseFloat(d6);
					bb7=(parseFloat(dd7)*100)/parseFloat(d7);
					bb8=(parseFloat(dd8)*100)/parseFloat(d8);
					bb9=(parseFloat(dd9)*100)/parseFloat(d9);
					
					
					aa1= 0;//(parseFloat(bb1)*parseFloat(a1))/100;
					aa2= 0;//(parseFloat(bb2)*parseFloat(a2))/100;
					aa3= 0;//(parseFloat(bb3)*parseFloat(a3))/100;
					aa4= (parseFloat(bb4)*parseFloat(a4))/100;
					aa5= (parseFloat(bb5)*parseFloat(a5))/100;
					aa6= (parseFloat(bb6)*parseFloat(a6))/100;
					aa7= (parseFloat(bb7)*parseFloat(a7))/100;
					aa8= (parseFloat(bb8)*parseFloat(a8))/100;
					aa9= (parseFloat(bb9)*parseFloat(a9))/100;
					
					
					$('#a1').val(a1.toString().substring(0, a1.toString().indexOf(".") + 3));
					$('#a2').val(a2.toString().substring(0, a2.toString().indexOf(".") + 3));
					$('#a3').val(a3.toString().substring(0, a3.toString().indexOf(".") + 3));
					$('#a4').val(a4.toString().substring(0, a4.toString().indexOf(".") + 3));
					$('#a5').val(a5.toString().substring(0, a5.toString().indexOf(".") + 3));
					$('#a6').val(a6.toString().substring(0, a6.toString().indexOf(".") + 3));
					$('#a7').val(a7.toString().substring(0, a7.toString().indexOf(".") + 3));
					$('#a8').val(a8.toString().substring(0, a8.toString().indexOf(".") + 3));
					$('#a9').val(a9.toString().substring(0, a9.toString().indexOf(".") + 3));			
					$('#suma').val(suma.toString().substring(0, suma.toString().indexOf(".") + 3));			
					
					$('#b1').val(b1.toString().substring(0, b1.toString().indexOf(".") + 3));
					$('#b2').val(b2.toString().substring(0, b2.toString().indexOf(".") + 3));
					$('#b3').val(b3.toString().substring(0, b3.toString().indexOf(".") + 3));
					$('#b4').val(b4.toString().substring(0, b4.toString().indexOf(".") + 3));
					$('#b5').val(b5.toString().substring(0, b5.toString().indexOf(".") + 3));
					$('#b6').val(b6.toString().substring(0, b6.toString().indexOf(".") + 3));
					$('#b7').val(b7.toString().substring(0, b7.toString().indexOf(".") + 3));
					$('#b8').val(b8.toString().substring(0, b8.toString().indexOf(".") + 3));
					$('#b9').val(b9.toString().substring(0, b9.toString().indexOf(".") + 3));	
					
					$('#c1').val(c1.toString().substring(0, c1.toString().indexOf(".") + 3));
					$('#c2').val(c2.toString().substring(0, c2.toString().indexOf(".") + 3));
					$('#c3').val(c3.toString().substring(0, c3.toString().indexOf(".") + 3));
					$('#c4').val(c4.toString().substring(0, c4.toString().indexOf(".") + 3));
					$('#c5').val(c5.toString().substring(0, c5.toString().indexOf(".") + 3));
					$('#c6').val(c6.toString().substring(0, c6.toString().indexOf(".") + 3));
					$('#c7').val(c7.toString().substring(0, c7.toString().indexOf(".") + 3));
					$('#c8').val(c8.toString().substring(0, c8.toString().indexOf(".") + 3));
					$('#c9').val(c9.toString().substring(0, c9.toString().indexOf(".") + 3));
								
					$('#d1').val(d1.toString().substring(0, d1.toString().indexOf(".") + 3));
					$('#d2').val(d2.toString().substring(0, d2.toString().indexOf(".") + 3));
					$('#d3').val(d3.toString().substring(0, d3.toString().indexOf(".") + 3));
					$('#d4').val(d4.toString().substring(0, d4.toString().indexOf(".") + 3));
					$('#d5').val(d5.toString().substring(0, d5.toString().indexOf(".") + 3));
					$('#d6').val(d6.toString().substring(0, d6.toString().indexOf(".") + 3));
					$('#d7').val(d7.toString().substring(0, d7.toString().indexOf(".") + 3));
					$('#d8').val(d8.toString().substring(0, d8.toString().indexOf(".") + 3));
					$('#d9').val(d9.toString().substring(0, d9.toString().indexOf(".") + 3));
					
					
					$('#e1').val(e1.toString().substring(0, e1.toString().indexOf(".") + 3));
					$('#e2').val(e2.toString().substring(0, e2.toString().indexOf(".") + 3));
					$('#e3').val(e3.toString().substring(0, e3.toString().indexOf(".") + 3));
					$('#e4').val(e4.toString().substring(0, e4.toString().indexOf(".") + 3));
					$('#e5').val(e5.toString().substring(0, e5.toString().indexOf(".") + 3));
					$('#e6').val(e6.toString().substring(0, e6.toString().indexOf(".") + 3));
					$('#e7').val(e7.toString().substring(0, e7.toString().indexOf(".") + 3));
					$('#e8').val(e8.toString().substring(0, e8.toString().indexOf(".") + 3));
					$('#e9').val(e9.toString().substring(0, e9.toString().indexOf(".") + 3));
					
					$('#aa1').val(aa1.toString().substring(0, aa1.toString().indexOf(".") + 3));
					$('#aa2').val(aa2.toString().substring(0, aa2.toString().indexOf(".") + 3));
					$('#aa3').val(aa3.toString().substring(0, aa3.toString().indexOf(".") + 3));
					$('#aa4').val(aa4.toString().substring(0, aa4.toString().indexOf(".") + 3));
					$('#aa5').val(aa5.toString().substring(0, aa5.toString().indexOf(".") + 3));
					$('#aa6').val(aa6.toString().substring(0, aa6.toString().indexOf(".") + 3));
					$('#aa7').val(aa7.toString().substring(0, aa7.toString().indexOf(".") + 3));
					$('#aa8').val(aa8.toString().substring(0, aa8.toString().indexOf(".") + 3));
					$('#aa9').val(aa9.toString().substring(0, aa9.toString().indexOf(".") + 3));
					
					$('#bb1').val(bb1.toString().substring(0, bb1.toString().indexOf(".") + 3));
					$('#bb2').val(bb2.toString().substring(0, bb2.toString().indexOf(".") + 3));
					$('#bb3').val(bb3.toString().substring(0, bb3.toString().indexOf(".") + 3));
					$('#bb4').val(bb4.toString().substring(0, bb4.toString().indexOf(".") + 3));
					$('#bb5').val(bb5.toString().substring(0, bb5.toString().indexOf(".") + 3));
					$('#bb6').val(bb6.toString().substring(0, bb6.toString().indexOf(".") + 3));
					$('#bb7').val(bb7.toString().substring(0, bb7.toString().indexOf(".") + 3));
					$('#bb8').val(bb8.toString().substring(0, bb8.toString().indexOf(".") + 3));
					$('#bb9').val(bb9.toString().substring(0, bb9.toString().indexOf(".") + 3));
				
					$('#dd1').val(dd1.toString().substring(0, dd1.toString().indexOf(".") + 3));
					$('#dd2').val(dd2.toString().substring(0, dd2.toString().indexOf(".") + 3));
					$('#dd3').val(dd3.toString().substring(0, dd3.toString().indexOf(".") + 3));
					$('#dd4').val(dd4.toString().substring(0, dd4.toString().indexOf(".") + 3));
					$('#dd5').val(dd5.toString().substring(0, dd5.toString().indexOf(".") + 3));
					$('#dd6').val(dd6.toString().substring(0, dd6.toString().indexOf(".") + 3));
					$('#dd7').val(dd7.toString().substring(0, dd7.toString().indexOf(".") + 3));
					$('#dd8').val(dd8.toString().substring(0, dd8.toString().indexOf(".") + 3));
					$('#dd9').val(dd9.toString().substring(0, dd9.toString().indexOf(".") + 3));
					
			}

			function a_b()
			{
					// Weight B1(gm) (a)
					a1 = $('#a1').val();
					a2 = $('#a2').val();
					a3 = $('#a3').val();
					a4 = $('#a4').val();
					a5 = $('#a5').val();
					a6 = $('#a6').val();
					a7 = $('#a7').val();
					a8 = $('#a8').val();
					a9 = $('#a9').val();
					
					
					
					suma = parseFloat(a1)+parseFloat(a2)+parseFloat(a3)+parseFloat(a4)+parseFloat(a5)+parseFloat(a6)+parseFloat(a7)+parseFloat(a8)+parseFloat(a9);

					b1 = $('#b1').val();
					b2 = $('#b2').val();
					b3 = $('#b3').val();
					b4 = $('#b4').val();
					b5 = $('#b5').val();
					b6 = $('#b6').val();
					b7 = $('#b7').val();
					b8 = $('#b8').val();
					b9 = $('#b9').val();

					c1 = (parseFloat(b1)/parseFloat(a1))*100;
					c2 = (parseFloat(b2)/parseFloat(a2))*100;
					c3 = (parseFloat(b3)/parseFloat(a3))*100;
					c4 = (parseFloat(b4)/parseFloat(a4))*100;
					c5 = (parseFloat(b5)/parseFloat(a5))*100;
					c6 = (parseFloat(b6)/parseFloat(a6))*100;
					c7 = (parseFloat(b7)/parseFloat(a7))*100;
					c8 = (parseFloat(b8)/parseFloat(a8))*100;
					c9 = (parseFloat(b9)/parseFloat(a9))*100;


					if (isNaN(c1)) c1 = 0;
					if (isNaN(c2)) c2 = 0;
					if (isNaN(c3)) c3 = 0;
					if (isNaN(c4)) c4 = 0;
					if (isNaN(c5)) c5 = 0;
					if (isNaN(c6)) c6 = 0;
					if (isNaN(c7)) c7 = 0;
					if (isNaN(c8)) c8 = 0;
					if (isNaN(c9)) c9 = 0;
					
					
					d1 = (parseFloat(a1)/parseFloat(suma))*100;
					d2 = (parseFloat(a2)/parseFloat(suma))*100;
					d3 = (parseFloat(a3)/parseFloat(suma))*100;
					d4 = (parseFloat(a4)/parseFloat(suma))*100;
					d5 = (parseFloat(a5)/parseFloat(suma))*100;
					d6 = (parseFloat(a6)/parseFloat(suma))*100;
					d7 = (parseFloat(a7)/parseFloat(suma))*100;
					d8 = (parseFloat(a8)/parseFloat(suma))*100;
					d9 = (parseFloat(a9)/parseFloat(suma))*100;

					if (isNaN(d1)) d1 = 0;
					if (isNaN(d2)) d2 = 0;
					if (isNaN(d3)) d3 = 0;
					if (isNaN(d4)) d4 = 0;
					if (isNaN(d5)) d5 = 0;
					if (isNaN(d6)) d6 = 0;
					if (isNaN(d7)) d7 = 0;
					if (isNaN(d8)) d8 = 0;
					if (isNaN(d9)) d9 = 0;

					// THICKNESS GAUGAE OF FLAKINESS (E)  (X * Y)/100
					e1 = (parseFloat(c1)*parseFloat(d1))/100;
					e2 = (parseFloat(c2)*parseFloat(d2))/100;
					e3 = (parseFloat(c3)*parseFloat(d3))/100;
					e4 = (parseFloat(c4)*parseFloat(d4))/100;		
					e5 = (parseFloat(c5)*parseFloat(d5))/100;
					e6 = (parseFloat(c6)*parseFloat(d6))/100;
					e7 = (parseFloat(c7)*parseFloat(d7))/100;
					e8 = (parseFloat(c8)*parseFloat(d8))/100;
					e9 = (parseFloat(c9)*parseFloat(d9))/100;

					if (isNaN(e1)) e1 = 0;
					if (isNaN(e2)) e2 = 0;
					if (isNaN(e3)) e3 = 0;
					if (isNaN(e4)) e4 = 0;
					if (isNaN(e5)) e5 = 0;
					if (isNaN(e6)) e6 = 0;
					if (isNaN(e7)) e7 = 0;
					if (isNaN(e8)) e8 = 0;
					if (isNaN(e9)) e9 = 0;

					var fi_index = parseFloat(e1) + parseFloat(e2) + parseFloat(e3) + parseFloat(e4) + parseFloat(e5) + parseFloat(e6) + parseFloat(e7) + parseFloat(e8) + parseFloat(e9);
					$('#fi_index').val(fi_index.toString().substring(0, fi_index.toString().indexOf(".") + 3));

					aa1= $('#aa1').val();
					aa2= $('#aa2').val();
					aa3= $('#aa3').val();
					aa4= $('#aa4').val();
					aa5= $('#aa5').val();
					aa6= $('#aa6').val();
					aa7= $('#aa7').val();
					aa8= $('#aa8').val();
					aa9= $('#aa9').val();

					bb1= (parseFloat(aa1)/parseFloat(a1))*100;
					bb2= (parseFloat(aa2)/parseFloat(a2))*100;
					bb3= (parseFloat(aa3)/parseFloat(a3))*100;
					bb4= (parseFloat(aa4)/parseFloat(a4))*100;
					bb5= (parseFloat(aa5)/parseFloat(a5))*100;
					bb6= (parseFloat(aa6)/parseFloat(a6))*100;
					bb7= (parseFloat(aa7)/parseFloat(a7))*100;
					bb8= (parseFloat(aa8)/parseFloat(a8))*100;
					bb9= (parseFloat(aa9)/parseFloat(a9))*100;

					if (isNaN(bb1)) bb1 = 0;
					if (isNaN(bb2)) bb2 = 0;
					if (isNaN(bb3)) bb3 = 0;
					if (isNaN(bb4)) bb4 = 0;
					if (isNaN(bb5)) bb5 = 0;
					if (isNaN(bb6)) bb6 = 0;
					if (isNaN(bb7)) bb7 = 0;
					if (isNaN(bb8)) bb8 = 0;
					if (isNaN(bb9)) bb9 = 0;

					dd1 = (parseFloat(bb1)*parseFloat(d1))/100;
					dd2 = (parseFloat(bb2)*parseFloat(d2))/100;
					dd3 = (parseFloat(bb3)*parseFloat(d3))/100;
					dd4 = (parseFloat(bb4)*parseFloat(d4))/100;
					dd5 = (parseFloat(bb5)*parseFloat(d5))/100;
					dd6 = (parseFloat(bb6)*parseFloat(d6))/100;
					dd7 = (parseFloat(bb7)*parseFloat(d7))/100;
					dd8 = (parseFloat(bb8)*parseFloat(d8))/100;
					dd9 = (parseFloat(bb9)*parseFloat(d9))/100;

					if (isNaN(dd1)) dd1 = 0;
					if (isNaN(dd2)) dd2 = 0;
					if (isNaN(dd3)) dd3 = 0;
					if (isNaN(dd4)) dd4 = 0;
					if (isNaN(dd5)) dd5 = 0;
					if (isNaN(dd6)) dd6 = 0;
					if (isNaN(dd7)) dd7 = 0;
					if (isNaN(dd8)) dd8 = 0;
					if (isNaN(dd9)) dd9 = 0;


					
					var ei_index = parseFloat(dd1) + parseFloat(dd2) + parseFloat(dd3) + parseFloat(dd4) + parseFloat(dd5) + parseFloat(dd6) + parseFloat(dd7) + parseFloat(dd8) + parseFloat(dd9);
					$('#ei_index').val(ei_index.toString().substring(0, ei_index.toString().indexOf(".") + 3));
					
					var combined_index = parseFloat(fi_index)+parseFloat(ei_index);
					$('#combined_index').val(combined_index.toString().substring(0, combined_index.toString().indexOf(".") + 3));
							
					
					
					
					$('#suma').val(suma.toString().substring(0, suma.toString().indexOf(".") + 3));
					
					$('#c1').val(c1.toString().substring(0, c1.toString().indexOf(".") + 3));
					$('#c2').val(c2.toString().substring(0, c2.toString().indexOf(".") + 3));
					$('#c3').val(c3.toString().substring(0, c3.toString().indexOf(".") + 3));
					$('#c4').val(c4.toString().substring(0, c4.toString().indexOf(".") + 3));
					$('#c5').val(c5.toString().substring(0, c5.toString().indexOf(".") + 3));
					$('#c6').val(c6.toString().substring(0, c6.toString().indexOf(".") + 3));
					$('#c7').val(c7.toString().substring(0, c7.toString().indexOf(".") + 3));
					$('#c8').val(c8.toString().substring(0, c8.toString().indexOf(".") + 3));
					$('#c9').val(c9.toString().substring(0, c9.toString().indexOf(".") + 3));
								
					$('#d1').val(d1.toString().substring(0, d1.toString().indexOf(".") + 3));
					$('#d2').val(d2.toString().substring(0, d2.toString().indexOf(".") + 3));
					$('#d3').val(d3.toString().substring(0, d3.toString().indexOf(".") + 3));
					$('#d4').val(d4.toString().substring(0, d4.toString().indexOf(".") + 3));
					$('#d5').val(d5.toString().substring(0, d5.toString().indexOf(".") + 3));
					$('#d6').val(d6.toString().substring(0, d6.toString().indexOf(".") + 3));
					$('#d7').val(d7.toString().substring(0, d7.toString().indexOf(".") + 3));
					$('#d8').val(d8.toString().substring(0, d8.toString().indexOf(".") + 3));
					$('#d9').val(d9.toString().substring(0, d9.toString().indexOf(".") + 3));
					
					
					$('#e1').val(e1.toString().substring(0, e1.toString().indexOf(".") + 3));
					$('#e2').val(e2.toString().substring(0, e2.toString().indexOf(".") + 3));
					$('#e3').val(e3.toString().substring(0, e3.toString().indexOf(".") + 3));
					$('#e4').val(e4.toString().substring(0, e4.toString().indexOf(".") + 3));
					$('#e5').val(e5.toString().substring(0, e5.toString().indexOf(".") + 3));
					$('#e6').val(e6.toString().substring(0, e6.toString().indexOf(".") + 3));
					$('#e7').val(e7.toString().substring(0, e7.toString().indexOf(".") + 3));
					$('#e8').val(e8.toString().substring(0, e8.toString().indexOf(".") + 3));
					$('#e9').val(e9.toString().substring(0, e9.toString().indexOf(".") + 3));
					
					
					$('#bb1').val(bb1.toString().substring(0, bb1.toString().indexOf(".") + 3));
					$('#bb2').val(bb2.toString().substring(0, bb2.toString().indexOf(".") + 3));
					$('#bb3').val(bb3.toString().substring(0, bb3.toString().indexOf(".") + 3));
					$('#bb4').val(bb4.toString().substring(0, bb4.toString().indexOf(".") + 3));
					$('#bb5').val(bb5.toString().substring(0, bb5.toString().indexOf(".") + 3));
					$('#bb6').val(bb6.toString().substring(0, bb6.toString().indexOf(".") + 3));
					$('#bb7').val(bb7.toString().substring(0, bb7.toString().indexOf(".") + 3));
					$('#bb8').val(bb8.toString().substring(0, bb8.toString().indexOf(".") + 3));
					$('#bb9').val(bb9.toString().substring(0, bb9.toString().indexOf(".") + 3));
				
					$('#dd1').val(dd1.toString().substring(0, dd1.toString().indexOf(".") + 3));
					$('#dd2').val(dd2.toString().substring(0, dd2.toString().indexOf(".") + 3));
					$('#dd3').val(dd3.toString().substring(0, dd3.toString().indexOf(".") + 3));
					$('#dd4').val(dd4.toString().substring(0, dd4.toString().indexOf(".") + 3));
					$('#dd5').val(dd5.toString().substring(0, dd5.toString().indexOf(".") + 3));
					$('#dd6').val(dd6.toString().substring(0, dd6.toString().indexOf(".") + 3));
					$('#dd7').val(dd7.toString().substring(0, dd7.toString().indexOf(".") + 3));
					$('#dd8').val(dd8.toString().substring(0, dd8.toString().indexOf(".") + 3));
					$('#dd9').val(dd9.toString().substring(0, dd9.toString().indexOf(".") + 3));
					
			}
			
	$('#fi_index').change(function(){
				fi_ei();			
						
			});
			
	$('#ei_index').change(function(){
				fi_ei();			
						
			});
			
			
	$('#a1').change(function(){
    	
		a_b();
	});	
	
	$('#a2').change(function(){
    	a_b();
					
	});	
	
	$('#a3').change(function(){
    	
		a_b();
	});	
	
	$('#a4').change(function(){
    	
		a_b();
					
	});	
	
	$('#a5').change(function(){
    	
		a_b();
					
	});	

	$('#a6').change(function(){
    	
		a_b();
					
	});	

	$('#a7').change(function(){
    	
		a_b();
					
	});	

	$('#a8').change(function(){
    	
		a_b();
					
	});	

	$('#a9').change(function(){
    	
		a_b();
					
	});	
	
	$('#b1').change(function(){
    	a_b();
	});	
	
	$('#b2').change(function(){
    	
		a_b();
					
	});	
	
	$('#b3').change(function(){
    	
		a_b();
					
	});	
	
	$('#b4').change(function(){
    	a_b();
					
	});	
	
	$('#b5').change(function(){
    	
		a_b();
					
	});

	$('#b6').change(function(){
    	
		a_b();
					
	});	

	$('#b7').change(function(){
    	
		a_b();
					
	});	

	$('#b8').change(function(){
    	
		a_b();
					
	});	

	$('#b9').change(function(){
    	
		a_b();
					
	});	
	
	$('#aa1').change(function(){
    	
		a_b();
					
	});	
	$('#aa2').change(function(){
			
			a_b();
						
		});	
	$('#aa3').change(function(){
			
			a_b();
						
		});	
	$('#aa4').change(function(){
			
			a_b();
						
		});	
	$('#aa5').change(function(){
			
			a_b();
						
		});	
	$('#aa6').change(function(){
			
			a_b();
						
		});	
	$('#aa7').change(function(){
			
			a_b();
						
		});	
	$('#aa8').change(function(){
			
			a_b();
						
		});	
	$('#aa9').change(function(){
			
			a_b();
						 
		});	

	
		//IMPACT VALUE 
	$('#chk_impact').change(function(){
        if(this.checked)
		{       
		
			var imp_value = randomNumberFromRange(12.00,17.00);
			//alert("imp_value="+imp_value);
			var r = randomNumberFromRange(-0.3,0.3);
			//alert("r="+r);
			var imp_value_1 = parseFloat(imp_value) +  parseFloat(r);
			//alert("imp_value_1="+imp_value_1);
			var imp_value_2 = parseFloat(imp_value) - parseFloat(r);
			//alert("imp_value_2="+imp_value_2);
			var imp_w_m_a_1 = randomNumberFromRange(350.1,358.5);
			//alert("imp_w_m_a_1="+imp_w_m_a_1);
			var imp_w_m_a_2 = imp_w_m_a_1;
			//alert("imp_w_m_a_2="+imp_w_m_a_2);
			
			var imp_w_m_d_1 = parseFloat(randomNumberFromRange(0.3,0.8)).toFixed(1);			
			var imp_w_m_d_2 = parseFloat(randomNumberFromRange(0.3,0.8)).toFixed(1);

			
			var imp_w_m_c_1 = (parseFloat(imp_value_1) *  parseFloat(imp_w_m_a_1))/100;
			//alert("imp_w_m_c_1="+imp_w_m_c_1);
			var imp_w_m_c_2 = (parseFloat(imp_value_2) *  parseFloat(imp_w_m_a_2))/100;
			//alert("imp_w_m_c_2="+imp_w_m_c_2);
			
		
			var imp_w_m_b_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_d_1))- parseFloat(imp_w_m_c_1);
			//alert("imp_w_m_b_1="+imp_w_m_b_1);
			var imp_w_m_b_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_d_2))- parseFloat(imp_w_m_c_2);
			//alert("imp_w_m_b_2="+imp_w_m_b_2);
			
			$('#imp_w_m_a_1').val(imp_w_m_a_1.toString().substring(0, imp_w_m_a_1.toString().indexOf(".") + 2));
			$('#imp_w_m_a_2').val(imp_w_m_a_2.toString().substring(0, imp_w_m_a_2.toString().indexOf(".") + 2));
			$('#imp_w_m_b_1').val(imp_w_m_b_1.toString().substring(0, imp_w_m_b_1.toString().indexOf(".") + 2));
			$('#imp_w_m_b_2').val(imp_w_m_b_2.toString().substring(0, imp_w_m_b_2.toString().indexOf(".") + 2));
			$('#imp_w_m_c_1').val(imp_w_m_c_1.toString().substring(0, imp_w_m_c_1.toString().indexOf(".") + 2));
			$('#imp_w_m_c_2').val(imp_w_m_c_2.toString().substring(0, imp_w_m_c_2.toString().indexOf(".") + 2));
			$('#imp_w_m_d_1').val(imp_w_m_d_1);
			$('#imp_w_m_d_2').val(imp_w_m_d_2);
			$('#imp_value').val(imp_value.toString().substring(0, imp_value.toString().indexOf(".") + 2));
			$('#imp_value_1').val(imp_value_1.toString().substring(0, imp_value_1.toString().indexOf(".") + 2));
			$('#imp_value_2').val(imp_value_2.toString().substring(0, imp_value_2.toString().indexOf(".") + 2));
					
			
		}
        else
		{
			
            $('#imp_value').val(null);
			$('#imp_value_1').val(null);
			$('#imp_value_2').val(null);
			$('#imp_w_m_a_1').val(null);
			$('#imp_w_m_b_1').val(null);
			$('#imp_w_m_c_1').val(null);
			$('#imp_w_m_d_1').val(null);
			$('#imp_w_m_a_2').val(null);
			$('#imp_w_m_b_2').val(null);
			$('#imp_w_m_c_2').val(null);
			$('#imp_w_m_d_2').val(null);
		}

    });
	
	$("#imp_value").change(function(){
			
			var imp_w_m_a_1 = randomNumberFromRange(350.1,358.5);
			var imp_w_m_a_2 = imp_w_m_a_1;
			
			var imp_value = $('#imp_value').val();
			var r =  randomNumberFromRange(-0.3,0.3);
			var imp_value_1 = parseFloat(imp_value) +  parseFloat(r);//G1
			var imp_value_2 = parseFloat(imp_value) -  parseFloat(r);
			
			
			
			var imp_w_m_c_1 = (parseFloat(imp_value_1) *  parseFloat(imp_w_m_a_1))/100;		
			var imp_w_m_c_2 = (parseFloat(imp_value_2) *  parseFloat(imp_w_m_a_2))/100;
					
			var imp_w_m_d_1 = parseFloat(randomNumberFromRange(0.3,0.8)).toFixed(1);			
			var imp_w_m_d_2 = parseFloat(randomNumberFromRange(0.3,0.8)).toFixed(1);
			
			var imp_w_m_b_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_d_1))- parseFloat(imp_w_m_c_1);
			var imp_w_m_b_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_d_2))- parseFloat(imp_w_m_c_2);
			
			
			$('#imp_w_m_a_1').val(imp_w_m_a_1.toString().substring(0, imp_w_m_a_1.toString().indexOf(".") + 2));
			$('#imp_w_m_a_2').val(imp_w_m_a_2.toString().substring(0, imp_w_m_a_2.toString().indexOf(".") + 2));
			$('#imp_w_m_b_1').val(imp_w_m_b_1.toString().substring(0, imp_w_m_b_1.toString().indexOf(".") + 2));
			$('#imp_w_m_b_2').val(imp_w_m_b_2.toString().substring(0, imp_w_m_b_2.toString().indexOf(".") + 2));
			$('#imp_w_m_c_1').val(imp_w_m_c_1.toString().substring(0, imp_w_m_c_1.toString().indexOf(".") + 2));
			$('#imp_w_m_c_2').val(imp_w_m_c_2.toString().substring(0, imp_w_m_c_2.toString().indexOf(".") + 2));
			$('#imp_w_m_d_1').val(imp_w_m_d_1);
			$('#imp_w_m_d_2').val(imp_w_m_d_2);			
			$('#imp_value_1').val(imp_value_1.toString().substring(0, imp_value_1.toString().indexOf(".") + 2));
			$('#imp_value_2').val(imp_value_2.toString().substring(0, imp_value_2.toString().indexOf(".") + 2));	
			
					
    });
	
	function imp_data()
	{
			var imp_w_m_a_1 = $('#imp_w_m_a_1').val();		
			var imp_w_m_b_1 = $('#imp_w_m_b_1').val();			
			var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
			var temps = parseFloat(imp_w_m_b_1) + parseFloat(imp_w_m_c_1);
			var imp_w_m_d_1 = parseFloat(imp_w_m_a_1) - parseFloat(temps);			
			//alert("temps="+temps);
			//alert("imp_w_m_d_1="+imp_w_m_d_1);
				
			
			var imp_value_1 = (parseFloat(imp_w_m_c_1) / parseFloat(imp_w_m_a_1))*100;
			var imp_value_2 = $('#imp_value_2').val();			
			var imp_value = (parseFloat(imp_value_1) + parseFloat(imp_value_2))/2;
			
			$('#imp_w_m_d_1').val(imp_w_m_d_1.toFixed(1));			
			$('#imp_value_1').val(imp_value_1.toString().substring(0, imp_value_1.toString().indexOf(".") + 2));
			$('#imp_value').val(imp_value.toString().substring(0, imp_value.toString().indexOf(".") + 2));
							
	}
	
	$("#imp_w_m_a_1").change(function(){
		imp_data();	
			
    });
	
	$("#imp_w_m_b_1").change(function(){
		imp_data();		
		
					
    });
	
	$("#imp_w_m_c_1").change(function(){
		imp_data();		
		
					
    });
	
	$("#imp_w_m_d_1").change(function(){
		var imp_w_m_d_1 = $('#imp_w_m_d_1').val();
		var abc = $('#imp_w_m_b_1').val();
		var cal = parseFloat(abc) - parseFloat(imp_w_m_d_1);
		$('#imp_w_m_b_1').val(cal.toString().substring(0, cal.toString().indexOf(".") + 2));		
					
    });
	
	$("#imp_w_m_d_2").change(function(){
		var imp_w_m_d_2 = $('#imp_w_m_d_2').val();
		var abc1 = $('#imp_w_m_b_2').val();
		var cal1 = parseFloat(abc1) - parseFloat(imp_w_m_d_2);
		$('#imp_w_m_b_2').val(cal1.toString().substring(0, cal1.toString().indexOf(".") + 2));				
					
    });
	
	function imp_data1()
	{
			var imp_w_m_a_2 = $('#imp_w_m_a_2').val();		
			var imp_w_m_b_2 = $('#imp_w_m_b_2').val();	
			var imp_w_m_c_2 = $('#imp_w_m_c_2').val();
			var temps = parseFloat(imp_w_m_b_2) + parseFloat(imp_w_m_c_2);
			var imp_w_m_d_2 = parseFloat(imp_w_m_a_2) - parseFloat(temps);			

			var imp_value_2 = (parseFloat(imp_w_m_c_2) /parseFloat(imp_w_m_a_2))*100;
			var imp_value_1 = $('#imp_value_1').val();			
			var imp_value = (parseFloat(imp_value_1) + parseFloat(imp_value_2))/2;			
			
			$('#imp_w_m_d_2').val(imp_w_m_d_2.toFixed(1));			
			$('#imp_value_2').val(imp_value_2.toString().substring(0, imp_value_2.toString().indexOf(".") + 2));
			$('#imp_value').val(imp_value.toString().substring(0, imp_value.toString().indexOf(".") + 2));
			
	}
	
	$("#imp_w_m_a_2").change(function(){
			
		imp_data1();								
    });
	
	$("#imp_w_m_b_2").change(function(){
			
		imp_data1();			
    });
	
	$("#imp_w_m_c_2").change(function(){
			
		imp_data1();			
    });	

	
	
var stripping_value;
	$('#chk_strip').change(function(){
        if(this.checked)
		{
           
			stripping_value = randomNumberFromRange(96, 99).toFixed(0);            
            $('#stripping_value').val(stripping_value);
			var strip_5 = randomNumberFromRange(96, 99).toFixed(0); 
			var strip_25 = randomNumberFromRange(96, 99).toFixed(0); 
			var tem = parseFloat(stripping_value) * 3 ;
			var strip_35 = parseFloat(tem) - (parseFloat(strip_5)+parseFloat(strip_25));
			 
			var strip_1 = 200;
			var strip_2 = 10;
			var strip_3 = 100;
			var strip_21 = 200;
			var strip_22 = 10;
			var strip_23 = 100;
			var strip_31 = 200;
			var strip_32 = 10;
			var strip_33 = 100;
			var strip_4 = (parseFloat(strip_5)*parseFloat(strip_3))/100;
			var strip_24 = (parseFloat(strip_25)*parseFloat(strip_23))/100;
			var strip_34 = (parseFloat(strip_35)*parseFloat(strip_33))/100;
			
			$('#strip_1').val(strip_1.toFixed());
			$('#strip_2').val(strip_2.toFixed());
			$('#strip_3').val(strip_3.toFixed());
			$('#strip_4').val(strip_4.toFixed());
			$('#strip_5').val(strip_5);
			
			$('#strip_21').val(strip_21.toFixed());
			$('#strip_22').val(strip_22.toFixed());
			$('#strip_23').val(strip_23.toFixed());
			$('#strip_24').val(strip_24.toFixed());
			$('#strip_25').val(strip_25);
			
			$('#strip_31').val(strip_31.toFixed());
			$('#strip_32').val(strip_32.toFixed());
			$('#strip_33').val(strip_33.toFixed());
			$('#strip_34').val(strip_34.toFixed());
			$('#strip_35').val(strip_35.toFixed());
			
			
			
		}
        else
		{
            $('#stripping_value').val(null);
            $('#strip_1').val(null);
            $('#strip_2').val(null);
            $('#strip_3').val(null);
            $('#strip_4').val(null);
            $('#strip_5').val(null);
			
		}

    });
	
	function strip_val()
	{
			stripping_value = $('#stripping_value').val();            
           
			var strip_5 = randomNumberFromRange(96, 99).toFixed(0); 
			var strip_25 = randomNumberFromRange(96, 99).toFixed(0); 
			var tem = parseFloat(stripping_value) * 3 ;
			var strip_35 = parseFloat(tem) - (parseFloat(strip_5)+parseFloat(strip_25));
			 
			var strip_1 = $('#strip_1').val();  
			var strip_2 = $('#strip_2').val();  
			var strip_3 = $('#strip_3').val();  
			var strip_21 = $('#strip_21').val();  
			var strip_22 = $('#strip_22').val();  
			var strip_23 = $('#strip_23').val();  
			var strip_31 = $('#strip_31').val();  
			var strip_32 = $('#strip_32').val();  
			var strip_33 = $('#strip_33').val();  
			var strip_4 = (parseFloat(strip_5)*parseFloat(strip_3))/100;
			var strip_24 = (parseFloat(strip_25)*parseFloat(strip_23))/100;
			var strip_34 = (parseFloat(strip_35)*parseFloat(strip_33))/100;
			
			$('#strip_4').val(strip_4.toFixed());
			$('#strip_5').val(strip_5);
			
			$('#strip_24').val(strip_24.toFixed());
			$('#strip_25').val(strip_25);
			
			$('#strip_34').val(strip_34.toFixed());
			$('#strip_35').val(strip_35.toFixed());
			
	}
	
	$("#stripping_value").change(function(){
		strip_val();	
					
    });	
	$("#strip_1").change(function(){
		strip_val();	
					
    });	
	$("#strip_2").change(function(){
		strip_val();	
					
    });	
	$("#strip_3").change(function(){
		strip_val();	
					
    });
	
	$("#strip_1").change(function(){
		strip_val();	
					
    });	
	$("#strip_21").change(function(){
		strip_val();	
					
    });	
	$("#strip_31").change(function(){
		strip_val();	
					
    });
	$("#strip_22").change(function(){
		strip_val();	
					
    });	
	$("#strip_23").change(function(){
		strip_val();	
					
    });	
	$("#strip_32").change(function(){
		strip_val();	
					
    });
	$("#strip_33").change(function(){
		strip_val();	
					
    });		
	$("#strip_4").change(function(){
			var strip_1 = $('#strip_1').val(); 
			var strip_2 = $('#strip_2').val(); 
			var strip_3 = $('#strip_3').val(); 	
			var strip_4 = $('#strip_4').val(); 
			
			var strip_21 = $('#strip_21').val(); 
			var strip_22 = $('#strip_22').val(); 
			var strip_23 = $('#strip_23').val(); 	
			var strip_24 = $('#strip_24').val(); 
			
			var strip_31 = $('#strip_31').val(); 
			var strip_32 = $('#strip_32').val(); 
			var strip_33 = $('#strip_33').val(); 	
			var strip_34 = $('#strip_34').val(); 
			
			strip_5 = (parseFloat(strip_4)/parseFloat(strip_3))*100;
			$('#strip_5').val(strip_5.toFixed(0));
			
			strip_25 = (parseFloat(strip_24)/parseFloat(strip_23))*100;
			$('#strip_25').val(strip_25.toFixed(0));
			
			strip_35 = (parseFloat(strip_34)/parseFloat(strip_33))*100;
			$('#strip_35').val(strip_35.toFixed(0));
			
			var stripping_value = parseFloat(strip_5)+parseFloat(strip_25)+parseFloat(strip_35);
			$('#stripping_value').val(stripping_value.toFixed(0));
					
    });	
	
	$("#strip_5").change(function(){
			var strip_5 = $('#strip_5').val(); 
			var strip_3 = $('#strip_3').val(); 
			
			var strip_25 = $('#strip_25').val(); 
			var strip_23 = $('#strip_23').val(); 
			
			var strip_35 = $('#strip_35').val(); 
			var strip_33 = $('#strip_33').val(); 
			
			
			var strip_4 = (parseFloat(strip_5) * parseFloat(strip_3))/100;
			var strip_24 = (parseFloat(strip_25) * parseFloat(strip_23))/100;
			var strip_34 = (parseFloat(strip_35) * parseFloat(strip_33))/100;
			
			var stripping_value = (parseFloat(strip_5)+parseFloat(strip_25)+parseFloat(strip_35))/3;
			$('#stripping_value').val(stripping_value.toFixed(0));
			$('#strip_4').val(strip_4.toFixed(0));
			$('#strip_24').val(strip_24.toFixed(0));
			$('#strip_34').val(strip_34.toFixed(0));
					
    });
	$("#strip_25").change(function(){
			var strip_5 = $('#strip_5').val(); 
			var strip_3 = $('#strip_3').val(); 
			
			var strip_25 = $('#strip_25').val(); 
			var strip_23 = $('#strip_23').val(); 
			
			var strip_35 = $('#strip_35').val(); 
			var strip_33 = $('#strip_33').val(); 
			
			
			var strip_4 = (parseFloat(strip_5) * parseFloat(strip_3))/100;
			var strip_24 = (parseFloat(strip_25) * parseFloat(strip_23))/100;
			var strip_34 = (parseFloat(strip_35) * parseFloat(strip_33))/100;
			
			var stripping_value = (parseFloat(strip_5)+parseFloat(strip_25)+parseFloat(strip_35))/3;
			$('#stripping_value').val(stripping_value.toFixed(0));
			$('#strip_4').val(strip_4.toFixed(0));
			$('#strip_24').val(strip_24.toFixed(0));
			$('#strip_34').val(strip_34.toFixed(0));
					
    });
	$("#strip_35").change(function(){
			var strip_5 = $('#strip_5').val(); 
			var strip_3 = $('#strip_3').val(); 
			
			var strip_25 = $('#strip_25').val(); 
			var strip_23 = $('#strip_23').val(); 
			
			var strip_35 = $('#strip_35').val(); 
			var strip_33 = $('#strip_33').val(); 
			
			
			var strip_4 = (parseFloat(strip_5) * parseFloat(strip_3))/100;
			var strip_24 = (parseFloat(strip_25) * parseFloat(strip_23))/100;
			var strip_34 = (parseFloat(strip_35) * parseFloat(strip_33))/100;
			
			var stripping_value = (parseFloat(strip_5)+parseFloat(strip_25)+parseFloat(strip_35))/3;
			$('#stripping_value').val(stripping_value.toFixed(0));
			$('#strip_4').val(strip_4.toFixed(0));
			$('#strip_24').val(strip_24.toFixed(0));
			$('#strip_34').val(strip_34.toFixed(0));
					
    });

	
	
	$("#strip_24").change(function(){
			var strip_1 = $('#strip_1').val(); 
			var strip_2 = $('#strip_2').val(); 
			var strip_3 = $('#strip_3').val(); 	
			var strip_4 = $('#strip_4').val(); 
			
			var strip_21 = $('#strip_21').val(); 
			var strip_22 = $('#strip_22').val(); 
			var strip_23 = $('#strip_23').val(); 	
			var strip_24 = $('#strip_24').val(); 
			
			var strip_31 = $('#strip_31').val(); 
			var strip_32 = $('#strip_32').val(); 
			var strip_33 = $('#strip_33').val(); 	
			var strip_34 = $('#strip_34').val(); 
			
			strip_5 = (parseFloat(strip_4)/parseFloat(strip_3))*100;
			$('#strip_5').val(strip_5.toFixed(0));
			
			strip_25 = (parseFloat(strip_24)/parseFloat(strip_23))*100;
			$('#strip_25').val(strip_25.toFixed(0));
			
			strip_35 = (parseFloat(strip_34)/parseFloat(strip_33))*100;
			$('#strip_35').val(strip_35.toFixed(0));
			
			var stripping_value = parseFloat(strip_5)+parseFloat(strip_25)+parseFloat(strip_35);
			$('#stripping_value').val(stripping_value.toFixed(0));
					
    });	
	$("#strip_34").change(function(){
			var strip_1 = $('#strip_1').val(); 
			var strip_2 = $('#strip_2').val(); 
			var strip_3 = $('#strip_3').val(); 	
			var strip_4 = $('#strip_4').val(); 
			
			var strip_21 = $('#strip_21').val(); 
			var strip_22 = $('#strip_22').val(); 
			var strip_23 = $('#strip_23').val(); 	
			var strip_24 = $('#strip_24').val(); 
			
			var strip_31 = $('#strip_31').val(); 
			var strip_32 = $('#strip_32').val(); 
			var strip_33 = $('#strip_33').val(); 	
			var strip_34 = $('#strip_34').val(); 
			
			strip_5 = (parseFloat(strip_4)/parseFloat(strip_3))*100;
			$('#strip_5').val(strip_5.toFixed(0));
			
			strip_25 = (parseFloat(strip_24)/parseFloat(strip_23))*100;
			$('#strip_25').val(strip_25.toFixed(0));
			
			strip_35 = (parseFloat(strip_34)/parseFloat(strip_33))*100;
			$('#strip_35').val(strip_35.toFixed(0));
			
			var stripping_value = parseFloat(strip_5)+parseFloat(strip_25)+parseFloat(strip_35);
			$('#stripping_value').val(stripping_value.toFixed(0));
					
    });	
	
	
	
	var fines_value;
	var f_a_1;
	var f_a_2;
	var f_b_1;
	var f_b_2;
	var f_c_1;
	var f_c_2;
	var f_d_1;
	var f_d_2;
	var f_e_1;
	var f_e_2;
	
	
	$('#chk_fines').change(function(){
        if(this.checked)
		{
			fines_value = randomNumberFromRange(12.41, 16.28); 
			var r = randomNumberFromRange(-0.03,0.02); //G1
			f_e_1 = parseFloat(fines_value) + parseFloat(r);
			f_e_2 = parseFloat(fines_value) - parseFloat(r);
			$('#fines_value').val(fines_value.toString().substring(0, fines_value.toString().indexOf(".") + 3));
			
			f_a_1 = randomNumberFromRange(2760, 2880);            
			f_a_2 = f_a_1;         
			f_c_1 = randomNumberFromRange(241.5, 298.5);            
			f_c_2 = randomNumberFromRange(241.5, 298.5);
			var tempd1 =parseFloat(f_c_1)/parseFloat(f_a_1); 
			var tempd2 =parseFloat(f_c_2)/parseFloat(f_a_2); 
			f_d_1 = parseFloat(tempd1)*100;
			f_d_2 = parseFloat(tempd2)*100;
			var fb11= parseFloat(f_e_1)*parseFloat(f_d_1);
			var fb12= parseFloat(f_e_1)*4;
			var fb13= parseFloat(fb11) + parseFloat(fb12);
			f_b_1 = parseFloat(fb13) / 14;
			var fb21= parseFloat(f_e_2)*parseFloat(f_d_2);
			var fb22= parseFloat(f_e_2)*4;
			var fb23= parseFloat(fb21) + parseFloat(fb22);
			f_b_2 = parseFloat(fb23) / 14;
			
			
			$('#f_e_1').val(f_e_1.toString().substring(0, f_e_1.toString().indexOf(".") + 3));
			$('#f_e_2').val(f_e_2.toString().substring(0, f_e_2.toString().indexOf(".") + 3));
			
			$('#f_a_1').val(f_a_1.toFixed());
			$('#f_a_2').val(f_a_2.toFixed());
			$('#f_b_1').val(f_b_1.toFixed(2));
			$('#f_b_1').val(f_b_1.toString().substring(0, f_b_1.toString().indexOf(".") + 3));
			$('#f_b_2').val(f_b_2.toString().substring(0, f_b_2.toString().indexOf(".") + 3));			
			$('#f_c_1').val(f_c_1.toString().substring(0, f_c_1.toString().indexOf(".") + 2));
			$('#f_c_2').val(f_c_2.toString().substring(0, f_c_2.toString().indexOf(".") + 2));			
			$('#f_d_1').val(f_d_1.toString().substring(0, f_d_1.toString().indexOf(".") + 3));
			$('#f_d_2').val(f_d_2.toString().substring(0, f_d_2.toString().indexOf(".") + 3));
			
		}
        else
		{
            $('#fines_value').val(null);
			$('#f_e_1').val(null);
			$('#f_e_2').val(null);
			$('#f_a_1').val(null);
			$('#f_a_2').val(null);
			$('#f_b_1').val(null);
			$('#f_b_2').val(null);
			$('#f_c_1').val(null);
			$('#f_c_2').val(null);
			$('#f_d_1').val(null);
			$('#f_d_2').val(null);
			
		}

    });
	
	$('#fines_value').change(function(){
			fines_value = $('#fines_value').val();
			f_e_1 = parseFloat(fines_value) + randomNumberFromRange(-0.03,0.03); //G1
			var tems1 = (parseFloat(fines_value) * 2);
			f_e_2 = (parseFloat(tems1)-parseFloat(f_e_1));	            		
			f_a_1 = randomNumberFromRange(2760, 2880);            
			f_a_2 = f_a_1;        
			f_c_1 = randomNumberFromRange(241.5, 298.5);            
			f_c_2 = randomNumberFromRange(241.5, 298.5);
			var tempd1 =parseFloat(f_c_1)/parseFloat(f_a_1); 
			var tempd2 =parseFloat(f_c_2)/parseFloat(f_a_2); 
			f_d_1 = parseFloat(tempd1)*100;
			f_d_2 = parseFloat(tempd2)*100;
			var fb11= parseFloat(f_e_1)*parseFloat(f_d_1);
			var fb12= parseFloat(f_e_1)*4;
			var fb13= parseFloat(fb11) + parseFloat(fb12);
			f_b_1 = parseFloat(fb13) / 14;
			var fb21= parseFloat(f_e_2)*parseFloat(f_d_2);
			var fb22= parseFloat(f_e_2)*4;
			var fb23= parseFloat(fb21) + parseFloat(fb22);
			f_b_2 = parseFloat(fb23) / 14;
			
			$('#f_e_1').val(f_e_1.toString().substring(0, f_e_1.toString().indexOf(".") + 3));
			$('#f_e_2').val(f_e_2.toString().substring(0, f_e_2.toString().indexOf(".") + 3));
			
			$('#f_a_1').val(f_a_1.toFixed());
			$('#f_a_2').val(f_a_2.toFixed());
			$('#f_b_1').val(f_b_1.toFixed(2));
			$('#f_b_1').val(f_b_1.toString().substring(0, f_b_1.toString().indexOf(".") + 3));
			$('#f_b_2').val(f_b_2.toString().substring(0, f_b_2.toString().indexOf(".") + 3));			
			$('#f_c_1').val(f_c_1.toString().substring(0, f_c_1.toString().indexOf(".") + 2));
			$('#f_c_2').val(f_c_2.toString().substring(0, f_c_2.toString().indexOf(".") + 2));				
			$('#f_d_1').val(f_d_1.toString().substring(0, f_d_1.toString().indexOf(".") + 3));
			$('#f_d_2').val(f_d_2.toString().substring(0, f_d_2.toString().indexOf(".") + 3));
	});
	
	function fines_all()
	{
			f_a_1 = $('#f_a_1').val();
			f_a_2 = $('#f_a_2').val();
			f_b_1 = $('#f_b_1').val();
			f_b_2 = $('#f_b_2').val();
			f_c_1 = $('#f_c_1').val();
			f_c_2 = $('#f_c_2').val();
			var tempd1 = parseFloat(f_c_1)/ parseFloat(f_a_1);
			var tempd2 = parseFloat(f_c_2)/ parseFloat(f_a_2);
			f_d_1 = parseFloat(tempd1) * 100;
			f_d_2 = parseFloat(tempd2) * 100;
			var tempe11 = 14 * parseFloat(f_b_1);
			var tempe12 = 14 * parseFloat(f_b_2);
			var tempe21 = 4 + parseFloat(f_d_1);
			var tempe22 = 4 + parseFloat(f_d_2);
			f_e_1 = parseFloat(tempe11)/parseFloat(tempe21);
			f_e_2 = parseFloat(tempe12)/parseFloat(tempe22);
			
			fines_value = (parseFloat(f_e_1) + parseFloat(f_e_2)) / 2;			
			$('#fines_value').val(fines_value.toString().substring(0, fines_value.toString().indexOf(".") + 3));
			$('#f_e_1').val(f_e_1.toString().substring(0, f_e_1.toString().indexOf(".") + 3));
			$('#f_e_2').val(f_e_2.toString().substring(0, f_e_2.toString().indexOf(".") + 3));			
			$('#f_d_1').val(f_d_1.toString().substring(0, f_d_1.toString().indexOf(".") + 3));
			$('#f_d_2').val(f_d_2.toString().substring(0, f_d_2.toString().indexOf(".") + 3));
	}

	$('#f_a_1').change(function(){
		fines_all();
	});
	$('#f_a_2').change(function(){
		fines_all();
	});
	
	$('#f_b_1').change(function(){
		fines_all();
	});
	$('#f_b_2').change(function(){
		fines_all();
	});
	$('#f_c_1').change(function(){
		fines_all();
	});
	$('#f_c_2').change(function(){
		fines_all();
	});
	
	var alkali_value;
	$('#chk_alkali').change(function(){
        if(this.checked)
		{
           
			alkali_value = randomNumberFromRange(10.00, 20.00);            
            $('#alkali_value').val(alkali_value.toFixed(2));
			
		}
        else
		{
            $('#alkali_value').val(null);
			
		}

    });
	
	//CRUSHING LOGIC
	var cr_sample_crush;
	var cr_a_1;
	var cr_a_2;
	var cr_b_1;
	var cr_b_2;
	var cr_c_1;
	var cr_c_2;
	var cru_value_1;
	var cru_value_2;
	
	
	$('#chk_crushing').change(function(){
        if(this.checked)
		{  
	
			//CRUSHING VALUE
			 cr_sample_crush = "BUSG MIX CA";
			 cru_value = randomNumberFromRange(17.10,19.50);
			 var r = randomNumberFromRange(-0.30,0.30);
			 cru_value_1 = parseFloat(cru_value) +  parseFloat(r);//G1
			 cru_value_2 = parseFloat(cru_value) -  parseFloat(r);//G1
			   
			 cr_a_1 = parseFloat(randomNumberFromRange(2760,2880));
			 cr_a_2 = parseFloat(cr_a_1);
			 cr_b_1 = (parseFloat(cr_a_1)*parseFloat(cru_value_1))/100;
			 cr_c_1 = parseFloat(cr_a_1)-parseFloat(cr_b_1);			 
			 cr_b_2 = (parseFloat(cr_a_2)*parseFloat(cru_value_2))/100;
			 cr_c_2 = parseFloat(cr_a_2)-parseFloat(cr_b_2);
			
			
			
			$('#cru_value').val(cru_value.toString().substring(0, cru_value.toString().indexOf(".") + 3));
			$('#cru_value_1').val(cru_value_1.toString().substring(0, cru_value_1.toString().indexOf(".") + 3));
			$('#cru_value_2').val(cru_value_2.toString().substring(0, cru_value_2.toString().indexOf(".") + 3));
			$('#cr_sample_crush').val(cr_sample_crush);
			
			$('#cr_a_1').val(cr_a_1.toFixed());
			$('#cr_a_2').val(cr_a_2.toFixed());
			$('#cr_b_1').val(cr_b_1.toFixed());
			$('#cr_c_1').val(cr_c_1.toFixed());
			
			$('#cr_b_2').val(cr_b_2.toFixed());
			$('#cr_c_2').val(cr_c_2.toFixed());
		}
		else
		{
			$('#cru_value').val(null);
			$('#cr_sample_crush').val(null);
			$('#cru_value_1').val(null);
			$('#cr_a_1').val(null);
			$('#cr_a_2').val(null);
			$('#cr_b_1').val(null);
			$('#cr_c_1').val(null);
			$('#cru_value_2').val(null);
			$('#cr_b_2').val(null);
			$('#cr_c_2').val(null);
		}
	});
	
	$('#cru_value').change(function(){
        
			//CRUSHING VALUE					
			 cr_a_1 = parseFloat(randomNumberFromRange(2760,2880));
			 cr_a_2 = parseFloat(cr_a_1);
			 cr_sample_crush = "Coarse Agg.";
			 var cru_value =$('#cru_value').val();			 
			 var r = randomNumberFromRange(-0.30,0.30);
			 cru_value_1 = parseFloat(cru_value) +  parseFloat(r);//G1
			 cru_value_2 = parseFloat(cru_value) -  parseFloat(r);//G1
			 
			$('#cru_value_1').val(cru_value_1.toString().substring(0, cru_value_1.toString().indexOf(".") + 3));
			$('#cru_value_2').val(cru_value_2.toString().substring(0, cru_value_2.toString().indexOf(".") + 3));
			 cr_b_1 = (parseFloat(cr_a_1)*parseFloat(cru_value_1))/100;
			
			 cr_c_1 = parseFloat(cr_a_1)-parseFloat(cr_b_1);					
			 cr_b_2 = (parseFloat(cr_a_2)*parseFloat(cru_value_2))/100;
			 cr_c_2 = parseFloat(cr_a_2)-parseFloat(cr_b_2);
			 
			$('#cr_sample_crush').val(cr_sample_crush);
			$('#cr_a_1').val(cr_a_1.toFixed());
			$('#cr_a_2').val(cr_a_2.toFixed());
			$('#cr_b_1').val(cr_b_1.toFixed());
			$('#cr_c_1').val(cr_c_1.toFixed());			
			$('#cr_b_2').val(cr_b_2.toFixed());
			$('#cr_c_2').val(cr_c_2.toFixed());
		
	});
	
	$("#cr_a_1").change(function(){
			
			
			
			cr_a_1 = $('#cr_a_1').val();			
			cr_b_1 = $('#cr_b_1').val();			
			
			cr_c_1 = parseFloat(cr_a_1) - parseFloat(cr_b_1);											
			$('#cr_c_1').val(cr_c_1.toFixed());				
			
			cru_value_1 = parseFloat(cr_b_1) /parseFloat(cr_a_1)*100;
			cru_value_2 =$('#cru_value_2').val();
			
			var cru_value = (parseFloat(cru_value_1)+parseFloat(cru_value_2))/2;
		
			$('#cru_value_1').val(cru_value_1.toString().substring(0, cru_value_1.toString().indexOf(".") + 3));
			$('#cru_value').val(cru_value.toString().substring(0, cru_value.toString().indexOf(".") + 3));			
    });
	
	$("#cr_b_1").change(function(){
			
			cr_a_1 = $('#cr_a_1').val();			
			cr_b_1 = $('#cr_b_1').val();			
			
			cr_c_1 = parseFloat(cr_a_1) - parseFloat(cr_b_1);											
			$('#cr_c_1').val(cr_c_1.toFixed());				
			
			cru_value_1 = parseFloat(cr_b_1) /parseFloat(cr_a_1)*100;
			cru_value_2 =$('#cru_value_2').val();
			
			var cru_value = (parseFloat(cru_value_1)+parseFloat(cru_value_2))/2;
		
			$('#cru_value_1').val(cru_value_1.toString().substring(0, cru_value_1.toString().indexOf(".") + 3));
			$('#cru_value').val(cru_value.toString().substring(0, cru_value.toString().indexOf(".") + 3));	
    });
	
	
	$("#cr_a_2").change(function(){
										
			cr_a_2 =  $('#cr_a_2').val();			
			cr_b_2 =  $('#cr_b_2').val();	
			
			cr_c_2 =  parseFloat(cr_a_2) - parseFloat(cr_b_2);					
			$('#cr_c_2').val(cr_c_2.toFixed());		
			
			cru_value_1 =  $('#cru_value_1').val();
			cru_value_2 = parseFloat(cr_b_2) /parseFloat(cr_a_2)*100;		
			
			var cru_value = (parseFloat(cru_value_1)+parseFloat(cru_value_2))/2;
			$('#cru_value_2').val(cru_value_2.toString().substring(0, cru_value_2.toString().indexOf(".") + 3));
			$('#cru_value').val(cru_value.toString().substring(0, cru_value.toString().indexOf(".") + 3));										
    });
	
	
	$("#cr_b_2").change(function(){
		cr_a_2 =  $('#cr_a_2').val();			
			cr_b_2 =  $('#cr_b_2').val();	
			
			cr_c_2 =  parseFloat(cr_a_2) - parseFloat(cr_b_2);					
			$('#cr_c_2').val(cr_c_2.toFixed());		
			
			cru_value_1 =  $('#cru_value_1').val();
			cru_value_2 = parseFloat(cr_b_2) /parseFloat(cr_a_2)*100;		
			
			var cru_value = (parseFloat(cru_value_1)+parseFloat(cru_value_2))/2;
			$('#cru_value_2').val(cru_value_2.toString().substring(0, cru_value_2.toString().indexOf(".") + 3));
			$('#cru_value').val(cru_value.toString().substring(0, cru_value.toString().indexOf(".") + 3));
			
					
    });
	
	/*Liquide Limit*/
	$('#chk_ll').change(function(){
        if(this.checked)
		{ 			
	
					var lb =$('#lab_no').val();
					var lab_no_1 = lb;
					var bowl_1 = "1";
					var weight_sample_1 = 50.00;
					var wws1 = 30.00;
					var bo_1 = 1;
					var con1 = "C-"+parseInt(randomNumberFromRange(1,5));
					
					var liquide_limit = randomNumberFromRange(18.00,80.00);			
					//alert("liquide_limit="+liquide_limit);
					var pi_value = randomNumberFromRange(5.00,10.00);	
					//alert("pi_value="+pi_value);					
					$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));					
					var plastic_limit = parseFloat(liquide_limit) - parseFloat(pi_value);
					//alert("plastic_limit="+plastic_limit);
					var blow1 = parseFloat(randomNumberFromRange(18,30)).toFixed();		
					//alert("blow1="+blow1);	
					
					var temp1 = 0.23 * Math.log10(parseFloat(blow1));										
					//alert("temp1="+temp1);	
					var temp2 = 1.3215 - parseFloat(temp1);											
					//alert("temp2="+temp2);	
					//var temp3 = parseFloat(1.3215 - (0.23 * Math.log10(parseInt(blow1)))).toFixed(2);
					var temp3 = parseFloat(temp2) * parseFloat(liquide_limit);											
					//alert("temp3="+temp3);						
					var temp4 = 100 + parseFloat(temp3);
					//alert("temp4="+temp4);						
					
					var wds1 = 3000/temp4;									
					//alert("wds1="+wds1);	
					var hh = parseFloat(wws1)-parseFloat(wds1);
					//alert("hh="+hh);
					var mc1 = (hh * 100)/wds1;
					//alert("mc1="+mc1);
					
					$('#bo_1').val(bo_1.toFixed());
					$('#blow1').val(blow1);
					$('#lab_no_1').val(lab_no_1);
					$('#bowl_1').val(bowl_1);
					$('#weight_sample_1').val(weight_sample_1);
					$('#wws1').val(wws1.toString().substring(0, wws1.toString().indexOf(".") + 3));
					$('#con1').val(con1);
					$('#liquide_limit').val(liquide_limit.toString().substring(0, liquide_limit.toString().indexOf(".") + 3));
					$('#wds1').val(wds1.toString().substring(0, wds1.toString().indexOf(".") + 3));
					$('#mc1').val(mc1.toString().substring(0, mc1.toString().indexOf(".") + 3));
				
					
					var lab_no_2 = lb;
					var lab_no_3 = lb+"/3";
					var lab_no_4 = lb+"/4";
					$('#plastic_limit').val(plastic_limit.toString().substring(0, plastic_limit.toString().indexOf(".") + 3));
					
					var bo_2 = "1";
					var bo_3 = "3";
					var bo_4 = "4";
					
					var con2 = con1;
					var con3 = con1;
					var con4 = con1;
					
					var wws2 = 20.00;
					var wws3 = 20.00;
					var wws4 = 20.00;

					var yy = randomNumberFromRange(-1.0,1.0);
					var yy1 = randomNumberFromRange(-1.0,1.0);
				
					var pl1 =  parseFloat(plastic_limit) - (parseFloat(yy)+parseFloat(yy1));
					//alert("pl1 "+ pl1);
					var pl2 =  parseFloat(plastic_limit) + parseFloat(yy1);
					//alert("pl2 "+ pl2);
					var pl3 =  parseFloat(plastic_limit) + parseFloat(yy);
					//alert("pl3 "+ pl3);
					
					//var t = parseFloat(pl1)+100;
					//var t2 = parseFloat(pl2)+100;
					//var t3 = parseFloat(pl3)+100;
					
					
					var wds2 = 2000 / (parseFloat(pl1)+100);
					//alert("wds2= "+ wds2);
					var wds3 = 2000 / (parseFloat(pl2)+100);
					//alert("wds3= "+ wds3);
					var wds4 = 2000 / (parseFloat(pl3)+100);
					//alert("wds4= "+ wds4);
																		
					$('#wds2').val(wds2.toString().substring(0, wds2.toString().indexOf(".") + 3));
					$('#wds3').val(wds3.toString().substring(0, wds3.toString().indexOf(".") + 3));
					$('#wds4').val(wds4.toString().substring(0, wds4.toString().indexOf(".") + 3));
					
					$('#pl1').val(pl1.toString().substring(0, pl1.toString().indexOf(".") + 3));
					$('#pl2').val(pl2.toString().substring(0, pl2.toString().indexOf(".") + 3));
					$('#pl3').val(pl3.toString().substring(0, pl3.toString().indexOf(".") + 3));
					
					$('#wws2').val(wws2.toString().substring(0, wws2.toString().indexOf(".") + 3));
					$('#wws3').val(wws3.toString().substring(0, wws3.toString().indexOf(".") + 3));
					$('#wws4').val(wws4.toString().substring(0, wws4.toString().indexOf(".") + 3));
					
					
					$('#con2').val(con2);
					$('#con3').val(con3);
					$('#con4').val(con4);
					
					$('#bo_2').val(bo_2);
					$('#bo_3').val(bo_3);
					$('#bo_4').val(bo_4);

					$('#lab_no_2').val(lab_no_2);
					$('#lab_no_3').val(lab_no_3);
					$('#lab_no_4').val(lab_no_4);
					
					
					
				
			
		}
		else
		{
					$('#bo_1').val(null);
					$('#blow1').val(null);
					$('#lab_no_1').val(null);
					$('#bowl_1').val(null);
					$('#weight_sample_1').val(null);
					$('#wws1').val(null);
					$('#con1').val(null);
					$('#liquide_limit').val(null);
					$('#wds1').val(null);
					$('#mc1').val(null);
					
					$('#pi_value').val(null);
					$('#plastic_limit').val(null);
					
					$('#wds2').val(null);
					$('#wds3').val(null);
					$('#wds4').val(null);
					
					$('#pl1').val(null);
					$('#pl2').val(null);
					$('#pl3').val(null);
					
					$('#wws2').val(null);
					$('#wws3').val(null);
					$('#wws4').val(null);
					
					$('#con2').val(null);
					$('#con3').val(null);
					$('#con4').val(null);
					
					$('#bowl_2').val(null);
					$('#bowl_3').val(null);
					$('#bowl_4').val(null);

					$('#lab_no_2').val(null);
					$('#lab_no_3').val(null);
					$('#lab_no_4').val(null);
		}
	});
	
	function ll()
	{
					
					var lb =$('#lab_no').val();
					var lab_no_1 = lb+"/1";
					var bowl_1 = "1";
					var weight_sample_1 = $('#weight_sample_1').val();
					var wws1 = $('#wws1').val();
					var bo_1 = $('#bo_1').val();
					var con1 = $('#con1').val();
					var liquide_limit = $('#liquide_limit').val();					
					var pi_value = $('#pi_value').val();
					if(pi_value !="" && pi_value!="NP")
					{
						var plastic_limit = liquide_limit - parseFloat(pi_value);
						$('#plastic_limit').val(plastic_limit.toString().substring(0, plastic_limit.toString().indexOf(".") + 3));
						
						var yy = randomNumberFromRange(-1.0,1.0);
					var yy1 = randomNumberFromRange(-1.0,1.0);
				
					var pl1 =  parseFloat(plastic_limit) - (parseFloat(yy)+parseFloat(yy1));
					//alert("pl1 "+ pl1);
					var pl2 =  parseFloat(plastic_limit) + parseFloat(yy1);
					//alert("pl2 "+ pl2);
					var pl3 =  parseFloat(plastic_limit) + parseFloat(yy);
					//alert("pl3 "+ pl3);
					
					//var t = parseFloat(pl1)+100;
					//var t2 = parseFloat(pl2)+100;
					//var t3 = parseFloat(pl3)+100;
					
					
					var wds2 = 2000 / (parseFloat(pl1)+100);
					//alert("wds2= "+ wds2);
					var wds3 = 2000 / (parseFloat(pl2)+100);
					//alert("wds3= "+ wds3);
					var wds4 = 2000 / (parseFloat(pl3)+100);
					//alert("wds4= "+ wds4);
																		
					$('#wds2').val(wds2.toString().substring(0, wds2.toString().indexOf(".") + 3));
					$('#wds3').val(wds3.toString().substring(0, wds3.toString().indexOf(".") + 3));
					$('#wds4').val(wds4.toString().substring(0, wds4.toString().indexOf(".") + 3));
					
					$('#pl1').val(pl1.toString().substring(0, pl1.toString().indexOf(".") + 3));
					$('#pl2').val(pl2.toString().substring(0, pl2.toString().indexOf(".") + 3));
					$('#pl3').val(pl3.toString().substring(0, pl3.toString().indexOf(".") + 3));
						
					}
					else
					{
						if(pi_value=="NP")
						{
							pi_np();
						}
						else
						{
							var plastic_limit="";
						}
					}

					
					
					//=3000/(E20*(1.3215-0.23*LOG(A20))+100)
					var blow1 = parseInt($('#blow1').val());
					
					var temp1 = 0.23 * Math.log10(blow1);										
					var temp2 = 1.3215 - temp1;											
					var temp3 = temp2 * liquide_limit;											
					var temp4 = 100 + temp3;									
					var wds1 = 3000/temp4;									
					var hh = (wws1-wds1);					
					var mc1 = (hh*100)/wds1;
														
					
					$('#wds1').val(wds1.toString().substring(0, wds1.toString().indexOf(".") + 3));
					$('#mc1').val(mc1.toString().substring(0, mc1.toString().indexOf(".") + 3));
					$('#bowl_1').val(bowl_1);
					
					
					
	}
	
	function pi_np()
	{
		
		$('#pi_value').val("NP");
		$('#plastic_limit').val("NP");
		
		$('#wds2').val("NP");
		$('#wds3').val("NP");
		$('#wds4').val("NP");
		
		$('#pl1').val("NP");
		$('#pl2').val("NP");
		$('#pl3').val("NP");
		
		$('#wws2').val("NP");
		$('#wws3').val("NP");
		$('#wws4').val("NP");
		
		$('#con2').val("NP");
		$('#con3').val("NP");
		$('#con4').val("NP");
		
		$('#bowl_2').val("NP");
		$('#bowl_3').val("NP");
		$('#bowl_4').val("NP");
		$('#bo_2').val("NP");

		$('#lab_no_2').val("NP");
		$('#lab_no_3').val("NP");
		$('#lab_no_4').val("NP");
	}
	
	$("#liquide_limit").change(function(){
	
		ll();			
	
	});
	
	$("#wws1").change(function(){
		var wws1 = $('#wws1').val();
		var wds1 = $('#wds1').val();
		var blow1 = $('#blow1').val();

		var mc1 = ((parseFloat(wws1)- parseFloat(wds1)) * 100)/parseFloat(wds1);
		
		$('#mc1').val(mc1.toFixed(2));
		var temp1 = 0.23 * Math.log10(blow1);										
		var temp2 = 1.3215 - temp1;	
		var liquide_limit = parseFloat(mc1)/parseFloat(temp2);
		$('#liquide_limit').val(liquide_limit.toString().substring(0, liquide_limit.toString().indexOf(".") + 3));
		
	});
	

	$("#wds1").change(function(){
		var wws1 = $('#wws1').val();
		var wds1 = $('#wds1').val();
		var blow1 = $('#blow1').val();

		var mc1 = ((parseFloat(wws1)- parseFloat(wds1)) * 100)/parseFloat(wds1);
		
		$('#mc1').val(mc1.toFixed(2));
		var temp1 = 0.23 * Math.log10(blow1);										
		var temp2 = 1.3215 - temp1;	
		var liquide_limit = parseFloat(mc1)/parseFloat(temp2);
		$('#liquide_limit').val(liquide_limit.toString().substring(0, liquide_limit.toString().indexOf(".") + 3));
		
		
	});
	
	
	$("#blow1").change(function(){
		
		var mc1 = $('#mc1').val();
		var blow1 = $('#blow1').val();	
		var plastic_limit = $('#plastic_limit').val();	
		var cc = Math.log10(parseInt(blow1)); 		
		var cc1 = 1.095 * parseFloat(cc); 		
		var liquide_limit = parseFloat(mc1)/parseFloat(cc1);
		
		$('#liquide_limit').val(liquide_limit.toString().substring(0, liquide_limit.toString().indexOf(".") + 3));
		var pi_value = parseFloat(liquide_limit) - parseFloat(plastic_limit);
		$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));
	});
	
	
	$("#plastic_limit").change(function(){
					
					
					var lab_no_2 = $('#lab_no_2').val();
					var lab_no_3 = $('#lab_no_3').val();
					var lab_no_4 = $('#lab_no_4').val();
					
					var bo_2 = $('#bo_2').val();
					var bo_3 = $('#bo_3').val();
					var bo_4 = $('#bo_4').val();
					
					var con2 = $('#con2').val();
					var con3 = $('#con3').val();
					var con4 = $('#con4').val();
					
					var wws2 = $('#wws2').val();
					var wws3 = $('#wws3').val();
					var wws4 = $('#wws4').val();

					var plastic_limit = $('#plastic_limit').val();
					var liquide_limit = $('#liquide_limit').val();
					var yy = randomNumberFromRange(-1.0,1.0);
					var yy1 = randomNumberFromRange(-1.0,1.0);
					
					
					var pl1 = parseFloat(plastic_limit) - (parseFloat(yy)+parseFloat(yy1));
					var pl2 = parseFloat(plastic_limit) + parseFloat(yy1);
					var pl3 = parseFloat(plastic_limit) + parseFloat(yy);
				
					var wds2 = 2000 / (parseFloat(pl1)+100);
					var wds3 = 2000 / (parseFloat(pl2)+100);
					var wds4 = 2000 / (parseFloat(pl3)+100);
					
					var pi_value = parseFloat(liquide_limit) - parseFloat(plastic_limit);
					
					$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));
					
					
					$('#wds2').val(wds2.toString().substring(0, wds2.toString().indexOf(".") + 3));
					$('#wds3').val(wds3.toString().substring(0, wds3.toString().indexOf(".") + 3));
					$('#wds4').val(wds4.toString().substring(0, wds4.toString().indexOf(".") + 3));
					
					$('#pl1').val(pl1.toString().substring(0, pl1.toString().indexOf(".") + 3));
					$('#pl2').val(pl2.toString().substring(0, pl2.toString().indexOf(".") + 3));
					$('#pl3').val(pl3.toString().substring(0, pl3.toString().indexOf(".") + 3));
					
	});
	
	$("#pi_value").change(function(){
		var pi_value = $('#pi_value').val();
		if(pi_value!="")
		{
			if(pi_value=="NP")
			{
					pi_np();
			}	
			else
			{
				var liquide_limit = $('#liquide_limit').val();
				var plastic_limit  = parseFloat(liquide_limit)-parseFloat(pi_value);
		
					var lab_no_2 = $('#lab_no_2').val();
					var lab_no_3 = $('#lab_no_3').val();
					var lab_no_4 = $('#lab_no_4').val();
					
					var bo_2 = $('#bo_2').val();
					var bo_3 = $('#bo_3').val();
					var bo_4 = $('#bo_4').val();
					
					var con2 = $('#con2').val();
					var con3 = $('#con3').val();
					var con4 = $('#con4').val();
					
					var wws2 = $('#wws2').val();
					var wws3 = $('#wws3').val();
					var wws4 = $('#wws4').val();

					
					var yy = randomNumberFromRange(-1.0,1.0);
					var yy1 = randomNumberFromRange(-1.0,1.0);
					
					
					var pl1 = parseFloat(plastic_limit) - (parseFloat(yy)+parseFloat(yy1));
					var pl2 = parseFloat(plastic_limit) + parseFloat(yy1);
					var pl3 = parseFloat(plastic_limit) + parseFloat(yy);
				
					var wds2 = 2000 / (parseFloat(pl1)+100);
					var wds3 = 2000 / (parseFloat(pl2)+100);
					var wds4 = 2000 / (parseFloat(pl3)+100);
					
					var pi_value = parseFloat(liquide_limit) - parseFloat(plastic_limit);
					
					$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));
					$('#plastic_limit').val(plastic_limit.toString().substring(0, plastic_limit.toString().indexOf(".") + 3));
					
					$('#wds2').val(wds2.toString().substring(0, wds2.toString().indexOf(".") + 3));
					$('#wds3').val(wds3.toString().substring(0, wds3.toString().indexOf(".") + 3));
					$('#wds4').val(wds4.toString().substring(0, wds4.toString().indexOf(".") + 3));
					
					$('#pl1').val(pl1.toString().substring(0, pl1.toString().indexOf(".") + 3));
					$('#pl2').val(pl2.toString().substring(0, pl2.toString().indexOf(".") + 3));
					$('#pl3').val(pl3.toString().substring(0, pl3.toString().indexOf(".") + 3));	
			}
		}
		else
		{
			pi_value =0;
		}
		
	});
	
	
	$("#wws2").change(function(){
		//Weight of (wet sample – dry sample) x 100/ Weight of dry sample
		var wws2 = $('#wws2').val();
		var wds2 = $('#wds2').val();

		var pl1 = ((parseFloat(wws2)- parseFloat(wds2)) * 100)/parseFloat(wds2);
		$('#pl1').val(pl1.toString().substring(0, pl1.toString().indexOf(".") + 3));	
		var pl2 =  $('#pl2').val();
		var pl3 =  $('#pl3').val();
		var liquide_limit =  $('#liquide_limit').val();
		
		var plastic_limit = (parseFloat(pl1)+parseFloat(pl2)+parseFloat(pl3))/3;
		$('#plastic_limit').val(plastic_limit.toString().substring(0, plastic_limit.toString().indexOf(".") + 3));
		
		var pi_value = parseFloat(liquide_limit) - parseFloat(plastic_limit);					
		$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));				
				
		
	});
	
	$("#wds2").change(function(){
		//Weight of (wet sample – dry sample) x 100/ Weight of dry sample
		var wws2 = $('#wws2').val();
		var wds2 = $('#wds2').val();

		var pl1 = ((parseFloat(wws2)- parseFloat(wds2)) * 100)/parseFloat(wds2);
		$('#pl1').val(pl1.toString().substring(0, pl1.toString().indexOf(".") + 3));
		var pl2 =  $('#pl2').val();
		var pl3 =  $('#pl3').val();
		var liquide_limit =  $('#liquide_limit').val();
		
		var plastic_limit = (parseFloat(pl1)+parseFloat(pl2)+parseFloat(pl3))/3;
		$('#plastic_limit').val(plastic_limit.toString().substring(0, plastic_limit.toString().indexOf(".") + 3));
		
		var pi_value = parseFloat(liquide_limit) - parseFloat(plastic_limit);					
		$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));				
		
	});
		
	$("#wws3").change(function(){
		//Weight of (wet sample – dry sample) x 100/ Weight of dry sample
		var wws3 = $('#wws3').val();
		var wds3 = $('#wds3').val();

		var pl2 = ((parseFloat(wws3)- parseFloat(wds3)) * 100)/parseFloat(wds3);
		$('#pl2').val(pl2.toString().substring(0, pl2.toString().indexOf(".") + 3));
		var pl1 =  $('#pl1').val();
		var pl3 =  $('#pl3').val();
		var liquide_limit =  $('#liquide_limit').val();
		
		var plastic_limit = (parseFloat(pl1)+parseFloat(pl2)+parseFloat(pl3))/3;
		$('#plastic_limit').val(plastic_limit.toString().substring(0, plastic_limit.toString().indexOf(".") + 3));
		
		var pi_value = parseFloat(liquide_limit) - parseFloat(plastic_limit);					
		$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));				
				
		
	});
	
	$("#wds3").change(function(){
		//Weight of (wet sample – dry sample) x 100/ Weight of dry sample
		var wws3 = $('#wws3').val();
		var wds3 = $('#wds3').val();

		var pl2 = ((parseFloat(wws3)- parseFloat(wds3)) * 100)/parseFloat(wds3);
		$('#pl2').val(pl2.toString().substring(0, pl2.toString().indexOf(".") + 3));
		var pl1 =  $('#pl1').val();
		var pl3 =  $('#pl3').val();
		var liquide_limit =  $('#liquide_limit').val();
		
		var plastic_limit = (parseFloat(pl1)+parseFloat(pl2)+parseFloat(pl3))/3;
		$('#plastic_limit').val(plastic_limit.toString().substring(0, plastic_limit.toString().indexOf(".") + 3));
		
		var pi_value = parseFloat(liquide_limit) - parseFloat(plastic_limit);					
		$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));				
		
	});
	
	$("#wws4").change(function(){
		//Weight of (wet sample – dry sample) x 100/ Weight of dry sample
		var wws4 = $('#wws4').val();
		var wds4 = $('#wds4').val();

		var pl3 = ((parseFloat(wws4)- parseFloat(wds4)) * 100)/parseFloat(wds4);
		$('#pl3').val(pl3.toString().substring(0, pl3.toString().indexOf(".") + 3));
		var pl2 =  $('#pl2').val();
		var pl1 =  $('#pl1').val();
		var liquide_limit =  $('#liquide_limit').val();
		
		var plastic_limit = (parseFloat(pl1)+parseFloat(pl2)+parseFloat(pl3))/3;
		$('#plastic_limit').val(plastic_limit.toString().substring(0, plastic_limit.toString().indexOf(".") + 3));
				
		var pi_value = parseFloat(liquide_limit) - parseFloat(plastic_limit);					
		$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));				
		
	});
	
	$("#wds4").change(function(){
		//Weight of (wet sample – dry sample) x 100/ Weight of dry sample
		var wws4 = $('#wws4').val();
		var wds4 = $('#wds4').val();

		var pl3 = ((parseFloat(wws4)- parseFloat(wds4)) * 100)/parseFloat(wds4);
		$('#pl3').val(pl3.toString().substring(0, pl3.toString().indexOf(".") + 3));
		var pl2 =  $('#pl2').val();
		var pl1 =  $('#pl1').val();
		var liquide_limit =  $('#liquide_limit').val();
		
		var plastic_limit = (parseFloat(pl1)+parseFloat(pl2)+parseFloat(pl3))/3;
		$('#plastic_limit').val(plastic_limit.toString().substring(0, plastic_limit.toString().indexOf(".") + 3));
				
		var pi_value = parseFloat(liquide_limit) - parseFloat(plastic_limit);					
		$('#pi_value').val(pi_value.toString().substring(0, pi_value.toString().indexOf(".") + 3));				
		
		
	});
	
	$('#volume').change(function(){
        var vol = $('#volume').val();
		if(vol=="1000")
		{
			$('#empty_mould').val(3780);
			
		}
		else
		{
			$('#empty_mould').val(5570);
		}
	});

	/*Mdd Omc*/
	$('#chk_mdd').change(function(){
        if(this.checked)
		{ 
						
			var volume = parseFloat($('#volume').val());
			var empty_mould = parseFloat($('#empty_mould').val());
			var weight_of_sample = 3000;
			$('#weight_of_sample').val(weight_of_sample)
			var wos1 = 3000;	
			var wos2 = 3000;
			var wos3 = 3000;
			var wos4 = 3000;
			var wos5 = 3000;
			var wos6 = 3000;
			
			var wad1 = 4;	
			var wad2 = 6;
			var wad3 = 8;
			var wad4 = 10;
			var wad5 = 12;
			var wad6 = 14;
			
			var wra1 = (parseInt(wad1)*parseInt(wos1))/100;
			var wra2 = (parseInt(wad2)*parseInt(wos2))/100;
			var wra3 = (parseInt(wad3)*parseInt(wos3))/100;
			var wra4 = (parseInt(wad4)*parseInt(wos4))/100;
			var wra5 = (parseInt(wad5)*parseInt(wos5))/100;
			var wra6 = (parseInt(wad6)*parseInt(wos6))/100;
			
			var bd1 = parseFloat(randomNumberFromRange(2.30,2.32));
			var bd2 = parseFloat(randomNumberFromRange(2.32,2.34));
			var bd3 = parseFloat(randomNumberFromRange(2.34,2.36));
			var bd4 = parseFloat(randomNumberFromRange(2.36,2.38));
			var bd5 = parseFloat(randomNumberFromRange(2.33,2.35));
			var bd6 = parseFloat(randomNumberFromRange(2.29,2.30));	

			var wmc1 = (bd1 * volume) + empty_mould;
			var wmc2 = (bd2 * volume) + empty_mould;
			var wmc3 = (bd3 * volume) + empty_mould;
			var wmc4 = (bd4 * volume) + empty_mould;
			var wmc5 = (bd5 * volume) + empty_mould;
			var wmc6 = (bd6 * volume) + empty_mould;
			
			var cnm1 = "C-1";
			var cnm2 = "C-2";
			var cnm3 = "C-3";
			var cnm4 = "C-4";
			var cnm5 = "C-5";
			var cnm6 = "C-6";
			
			var ww31 = 200;
			var ww32 = 200;
			var ww33 = 200;
			var ww34 = 200;
			var ww35 = 200;
			var ww36 = 200;
			
			var omc1 = parseFloat(randomNumberFromRange(5.20, 5.50));
			var omc2 = parseFloat(randomNumberFromRange(7.30, 7.50));
			var omc3 = parseFloat(randomNumberFromRange(9.10, 9.50));
			var omc4 = parseFloat(randomNumberFromRange(11.50, 12.50));
			var omc5 = parseFloat(randomNumberFromRange(14.00, 15.50));
			var omc6 = parseFloat(randomNumberFromRange(16.00, 18.00));
			
			
			//PENDING
			var wd41 = (parseFloat(ww31) * 100) / (parseFloat(omc1)+100);
			var wd42 = (parseFloat(ww32) * 100) / (parseFloat(omc2)+100);
			var wd43 = (parseFloat(ww33) * 100) / (parseFloat(omc3)+100);
			var wd44 = (parseFloat(ww34) * 100) / (parseFloat(omc4)+100);
			var wd45 = (parseFloat(ww35) * 100) / (parseFloat(omc5)+100);
			var wd46 = (parseFloat(ww36) * 100) / (parseFloat(omc6)+100);
			
			var mdd1 = (parseFloat(bd1) * 100) /(100+parseFloat(omc1));
			var mdd2 = (parseFloat(bd2) * 100) /(100+parseFloat(omc2));
			var mdd3 = (parseFloat(bd3) * 100) /(100+parseFloat(omc3));
			var mdd4 = (parseFloat(bd4) * 100) /(100+parseFloat(omc4));
			var mdd5 = (parseFloat(bd5) * 100) /(100+parseFloat(omc5));
			var mdd6 = (parseFloat(bd6) * 100) /(100+parseFloat(omc6));
			
			var wms1 = parseFloat(volume) * parseFloat(bd1);
			var wms2 = parseFloat(volume) * parseFloat(bd2);
			var wms3 = parseFloat(volume) * parseFloat(bd3);
			var wms4 = parseFloat(volume) * parseFloat(bd4);
			var wms5 = parseFloat(volume) * parseFloat(bd5);
			var wms6 = parseFloat(volume) * parseFloat(bd6);

		
			
			var omc = parseFloat(omc4);
			var mdd = parseFloat(mdd4);	
			
			$('#omc').val(omc.toString().substring(0, omc.toString().indexOf(".") + 3));		
			$('#mdd').val(mdd.toString().substring(0, mdd.toString().indexOf(".") + 3));		
	
			$('#wos1').val(wos1);
			$('#wos2').val(wos2);
			$('#wos3').val(wos3);
			$('#wos4').val(wos4);
			$('#wos5').val(wos5);
			$('#wos6').val(wos6);

			$('#wad1').val(wad1.toString().substring(0, wad1.toString().indexOf(".") + 3));
			$('#wad2').val(wad2.toString().substring(0, wad2.toString().indexOf(".") + 3));
			$('#wad3').val(wad3.toString().substring(0, wad3.toString().indexOf(".") + 3));
			$('#wad4').val(wad4.toString().substring(0, wad4.toString().indexOf(".") + 3));
			$('#wad5').val(wad5.toString().substring(0, wad5.toString().indexOf(".") + 3));
			$('#wad6').val(wad6.toString().substring(0, wad6.toString().indexOf(".") + 3));
			
			$('#wms1').val(wms1.toFixed());
			$('#wms2').val(wms2.toFixed());
			$('#wms3').val(wms3.toFixed());
			$('#wms4').val(wms4.toFixed());
			$('#wms5').val(wms5.toFixed());
			$('#wms6').val(wms6.toFixed());
			

			$('#wra1').val(wra1.toString().substring(0, wra1.toString().indexOf(".") + 3));
			$('#wra2').val(wra2.toString().substring(0, wra2.toString().indexOf(".") + 3));
			$('#wra3').val(wra3.toString().substring(0, wra3.toString().indexOf(".") + 3));
			$('#wra4').val(wra4.toString().substring(0, wra4.toString().indexOf(".") + 3));
			$('#wra5').val(wra5.toString().substring(0, wra5.toString().indexOf(".") + 3));
			$('#wra6').val(wra6.toString().substring(0, wra6.toString().indexOf(".") + 3));

			$('#wmc1').val(wmc1.toFixed());
			$('#wmc2').val(wmc2.toFixed());
			$('#wmc3').val(wmc3.toFixed());
			$('#wmc4').val(wmc4.toFixed());
			$('#wmc5').val(wmc5.toFixed());
			$('#wmc6').val(wmc6.toFixed());
			
			
			$('#bd1').val(bd1.toString().substring(0, bd1.toString().indexOf(".") + 3));
			$('#bd2').val(bd2.toString().substring(0, bd2.toString().indexOf(".") + 3));
			$('#bd3').val(bd3.toString().substring(0, bd3.toString().indexOf(".") + 3));
			$('#bd4').val(bd4.toString().substring(0, bd4.toString().indexOf(".") + 3));
			$('#bd5').val(bd5.toString().substring(0, bd5.toString().indexOf(".") + 3));
			$('#bd6').val(bd6.toString().substring(0, bd6.toString().indexOf(".") + 3));

			$('#cnm1').val(cnm1);
			$('#cnm2').val(cnm2);
			$('#cnm3').val(cnm3);
			$('#cnm4').val(cnm4);
			$('#cnm5').val(cnm5);
			$('#cnm6').val(cnm6);

			$('#ww31').val(ww31.toString().substring(0, ww31.toString().indexOf(".") + 3));
			$('#ww32').val(ww32.toString().substring(0, ww32.toString().indexOf(".") + 3));
			$('#ww33').val(ww33.toString().substring(0, ww33.toString().indexOf(".") + 3));
			$('#ww34').val(ww34.toString().substring(0, ww34.toString().indexOf(".") + 3));
			$('#ww35').val(ww35.toString().substring(0, ww35.toString().indexOf(".") + 3));
			$('#ww36').val(ww36.toString().substring(0, ww36.toString().indexOf(".") + 3));
			
			$('#wd41').val(wd41.toString().substring(0, wd41.toString().indexOf(".") + 3));
			$('#wd42').val(wd42.toString().substring(0, wd42.toString().indexOf(".") + 3));
			$('#wd43').val(wd43.toString().substring(0, wd43.toString().indexOf(".") + 3));
			$('#wd44').val(wd44.toString().substring(0, wd44.toString().indexOf(".") + 3));
			$('#wd45').val(wd45.toString().substring(0, wd45.toString().indexOf(".") + 3));
			$('#wd46').val(wd46.toString().substring(0, wd46.toString().indexOf(".") + 3));
			
			$('#omc1').val(omc1.toString().substring(0, omc1.toString().indexOf(".") + 3));
			$('#omc2').val(omc2.toString().substring(0, omc2.toString().indexOf(".") + 3));
			$('#omc3').val(omc3.toString().substring(0, omc3.toString().indexOf(".") + 3));
			$('#omc4').val(omc4.toString().substring(0, omc4.toString().indexOf(".") + 3));
			$('#omc5').val(omc5.toString().substring(0, omc5.toString().indexOf(".") + 3));
			$('#omc6').val(omc6.toString().substring(0, omc6.toString().indexOf(".") + 3));
			
			$('#mdd1').val(mdd1.toString().substring(0, mdd1.toString().indexOf(".") + 3));
			$('#mdd2').val(mdd2.toString().substring(0, mdd2.toString().indexOf(".") + 3));
			$('#mdd3').val(mdd3.toString().substring(0, mdd3.toString().indexOf(".") + 3));
			$('#mdd4').val(mdd4.toString().substring(0, mdd4.toString().indexOf(".") + 3));
			$('#mdd5').val(mdd5.toString().substring(0, mdd5.toString().indexOf(".") + 3));
			$('#mdd6').val(mdd6.toString().substring(0, mdd6.toString().indexOf(".") + 3));


		}
		else
		{	
			$('#omc').val(null);
			$('#mdd').val(null);
			$('#empty_mould').val(null);
			$('#weight_of_sample').val(null);
			$('#type_compation').val(null);
			
	
			$('#wos1').val(null);
			$('#wos2').val(null);
			$('#wos3').val(null);
			$('#wos4').val(null);
			$('#wos5').val(null);
			$('#wos6').val(null);
			
			$('#wms1').val(null);
			$('#wms2').val(null);
			$('#wms3').val(null);
			$('#wms4').val(null);
			$('#wms5').val(null);
			$('#wms6').val(null);

			$('#wad1').val(null);
			$('#wad2').val(null);
			$('#wad3').val(null);
			$('#wad4').val(null);
			$('#wad5').val(null);
			$('#wad6').val(null);
			

			$('#wra1').val(null);
			$('#wra2').val(null);
			$('#wra3').val(null);
			$('#wra4').val(null);
			$('#wra5').val(null);
			$('#wra6').val(null);

			$('#wmc1').val(null);
			$('#wmc2').val(null);
			$('#wmc3').val(null);
			$('#wmc4').val(null);
			$('#wmc5').val(null);
			$('#wmc6').val(null);
			
			
			

			$('#bd1').val(null);
			$('#bd2').val(null);
			$('#bd3').val(null);
			$('#bd4').val(null);
			$('#bd5').val(null);
			$('#bd6').val(null);

			$('#cnm1').val(null);
			$('#cnm2').val(null);
			$('#cnm3').val(null);
			$('#cnm4').val(null);
			$('#cnm5').val(null);
			$('#cnm6').val(null);

			$('#ww31').val(null);
			$('#ww32').val(null);
			$('#ww33').val(null);
			$('#ww34').val(null);
			$('#ww35').val(null);
			$('#ww36').val(null);	
			
			$('#wd41').val(null);
			$('#wd42').val(null);
			$('#wd43').val(null);
			$('#wd44').val(null);
			$('#wd45').val(null);
			$('#wd46').val(null);
                     
			$('#omc1').val(null);
			$('#omc2').val(null);
			$('#omc3').val(null);
			$('#omc4').val(null);
			$('#omc5').val(null);
			$('#omc6').val(null);
	               
			$('#mdd1').val(null);
			$('#mdd2').val(null);
			$('#mdd3').val(null);
			$('#mdd4').val(null);
			$('#mdd5').val(null);
			$('#mdd6').val(null);


			
		}	
	});
	
	$("#omc").change(function(){
		var omc = $('#omc').val();
		var mdd = $('#mdd').val();
		
			var volume = parseFloat($('#volume').val());
			var empty_mould = parseFloat($('#empty_mould').val());
			var weight_of_sample = $('#weight_of_sample').val();
			
			var wos1 = 3000;	
			var wos2 = 3000;
			var wos3 = 3000;
			var wos4 = 3000;
			var wos5 = 3000;
			var wos6 = 3000;
			
			var wad1 = 4;	
			var wad2 = 6;
			var wad3 = 8;
			var wad4 = 10;
			var wad5 = 12;
			var wad6 = 14;
			
			var wra1 = (parseInt(wad1)*parseInt(wos1))/100;
			var wra2 = (parseInt(wad2)*parseInt(wos2))/100;
			var wra3 = (parseInt(wad3)*parseInt(wos3))/100;
			var wra4 = (parseInt(wad4)*parseInt(wos4))/100;
			var wra5 = (parseInt(wad5)*parseInt(wos5))/100;
			var wra6 = (parseInt(wad6)*parseInt(wos6))/100;
			
			var bd1 = parseFloat(randomNumberFromRange(2.30,2.32));
			var bd2 = parseFloat(randomNumberFromRange(2.32,2.34));
			var bd3 = parseFloat(randomNumberFromRange(2.34,2.36));
			var bd4 = parseFloat(randomNumberFromRange(2.36,2.38));
			var bd5 = parseFloat(randomNumberFromRange(2.33,2.35));
			var bd6 = parseFloat(randomNumberFromRange(2.29,2.30));	

			var wmc1 = (bd1 * volume) + empty_mould;
			var wmc2 = (bd2 * volume) + empty_mould;
			var wmc3 = (bd3 * volume) + empty_mould;
			var wmc4 = (bd4 * volume) + empty_mould;
			var wmc5 = (bd5 * volume) + empty_mould;
			var wmc6 = (bd6 * volume) + empty_mould;
			
			var cnm1 = "C-1";
			var cnm2 = "C-2";
			var cnm3 = "C-3";
			var cnm4 = "C-4";
			var cnm5 = "C-5";
			var cnm6 = "C-6";
			
			var ww31 = 200;
			var ww32 = 200;
			var ww33 = 200;
			var ww34 = 200;
			var ww35 = 200;
			var ww36 = 200;
			
			var omc1 = parseFloat(randomNumberFromRange(6.20, 6.40));
			var omc2 = parseFloat(randomNumberFromRange(6.40, 6.60));
			var omc3 = parseFloat(randomNumberFromRange(6.60, 6.80));
			var omc4 = parseFloat(omc);
			var omc5 = parseFloat(randomNumberFromRange(7.00, 6.20));
			var omc6 = parseFloat(randomNumberFromRange(7.20, 7.40));
			
			
			
			
			//PENDING
			var wd41 = (parseFloat(ww31) * 100) / (parseFloat(omc1)+100);
			var wd42 = (parseFloat(ww32) * 100) / (parseFloat(omc2)+100);
			var wd43 = (parseFloat(ww33) * 100) / (parseFloat(omc3)+100);
			var wd44 = (parseFloat(ww34) * 100) / (parseFloat(omc4)+100);
			var wd45 = (parseFloat(ww35) * 100) / (parseFloat(omc5)+100);
			var wd46 = (parseFloat(ww36) * 100) / (parseFloat(omc6)+100);
			
			var mdd1 = (parseFloat(bd1) * 100) /(100+parseFloat(omc1));
			var mdd2 = (parseFloat(bd2) * 100) /(100+parseFloat(omc2));
			var mdd3 = (parseFloat(bd3) * 100) /(100+parseFloat(omc3));
			var mdd4 = (parseFloat(bd4) * 100) /(100+parseFloat(omc4));
			var mdd5 = (parseFloat(bd5) * 100) /(100+parseFloat(omc5));
			var mdd6 = (parseFloat(bd6) * 100) /(100+parseFloat(omc6));
			
			var wms1 = parseFloat(volume) * parseFloat(bd1);
			var wms2 = parseFloat(volume) * parseFloat(bd2);
			var wms3 = parseFloat(volume) * parseFloat(bd3);
			var wms4 = parseFloat(volume) * parseFloat(bd4);
			var wms5 = parseFloat(volume) * parseFloat(bd5);
			var wms6 = parseFloat(volume) * parseFloat(bd6);
			
			$('#wos1').val(wos1);
			$('#wos2').val(wos2);
			$('#wos3').val(wos3);
			$('#wos4').val(wos4);
			$('#wos5').val(wos5);
			$('#wos6').val(wos6);

			$('#wad1').val(wad1.toString().substring(0, wad1.toString().indexOf(".") + 3));
			$('#wad2').val(wad2.toString().substring(0, wad2.toString().indexOf(".") + 3));
			$('#wad3').val(wad3.toString().substring(0, wad3.toString().indexOf(".") + 3));
			$('#wad4').val(wad4.toString().substring(0, wad4.toString().indexOf(".") + 3));
			$('#wad5').val(wad5.toString().substring(0, wad5.toString().indexOf(".") + 3));
			$('#wad6').val(wad6.toString().substring(0, wad6.toString().indexOf(".") + 3));
			

			$('#wra1').val(wra1.toString().substring(0, wra1.toString().indexOf(".") + 3));
			$('#wra2').val(wra2.toString().substring(0, wra2.toString().indexOf(".") + 3));
			$('#wra3').val(wra3.toString().substring(0, wra3.toString().indexOf(".") + 3));
			$('#wra4').val(wra4.toString().substring(0, wra4.toString().indexOf(".") + 3));
			$('#wra5').val(wra5.toString().substring(0, wra5.toString().indexOf(".") + 3));
			$('#wra6').val(wra6.toString().substring(0, wra6.toString().indexOf(".") + 3));

			$('#wmc1').val(wmc1.toFixed(2));
			$('#wmc2').val(wmc2.toFixed(2));
			$('#wmc3').val(wmc3.toFixed(2));
			$('#wmc4').val(wmc4.toFixed(2));
			$('#wmc5').val(wmc5.toFixed(2));
			$('#wmc6').val(wmc6.toFixed(2));
			
			$('#wms1').val(wms1.toFixed());
			$('#wms2').val(wms2.toFixed());
			$('#wms3').val(wms3.toFixed());
			$('#wms4').val(wms4.toFixed());
			$('#wms5').val(wms5.toFixed());
			$('#wms6').val(wms6.toFixed());
			
			$('#bd1').val(bd1.toString().substring(0, bd1.toString().indexOf(".") + 3));
			$('#bd2').val(bd2.toString().substring(0, bd2.toString().indexOf(".") + 3));
			$('#bd3').val(bd3.toString().substring(0, bd3.toString().indexOf(".") + 3));
			$('#bd4').val(bd4.toString().substring(0, bd4.toString().indexOf(".") + 3));
			$('#bd5').val(bd5.toString().substring(0, bd5.toString().indexOf(".") + 3));
			$('#bd6').val(bd6.toString().substring(0, bd6.toString().indexOf(".") + 3));

			$('#cnm1').val(cnm1);
			$('#cnm2').val(cnm2);
			$('#cnm3').val(cnm3);
			$('#cnm4').val(cnm4);
			$('#cnm5').val(cnm5);
			$('#cnm6').val(cnm6);

			$('#ww31').val(ww31.toString().substring(0, ww31.toString().indexOf(".") + 3));
			$('#ww32').val(ww32.toString().substring(0, ww32.toString().indexOf(".") + 3));
			$('#ww33').val(ww33.toString().substring(0, ww33.toString().indexOf(".") + 3));
			$('#ww34').val(ww34.toString().substring(0, ww34.toString().indexOf(".") + 3));
			$('#ww35').val(ww35.toString().substring(0, ww35.toString().indexOf(".") + 3));
			$('#ww36').val(ww36.toString().substring(0, ww36.toString().indexOf(".") + 3));
			
			$('#wd41').val(wd41.toString().substring(0, wd41.toString().indexOf(".") + 3));
			$('#wd42').val(wd42.toString().substring(0, wd42.toString().indexOf(".") + 3));
			$('#wd43').val(wd43.toString().substring(0, wd43.toString().indexOf(".") + 3));
			$('#wd44').val(wd44.toString().substring(0, wd44.toString().indexOf(".") + 3));
			$('#wd45').val(wd45.toString().substring(0, wd45.toString().indexOf(".") + 3));
			$('#wd46').val(wd46.toString().substring(0, wd46.toString().indexOf(".") + 3));
			

			$('#omc1').val(omc1.toString().substring(0, omc1.toString().indexOf(".") + 3));
			$('#omc2').val(omc2.toString().substring(0, omc2.toString().indexOf(".") + 3));
			$('#omc3').val(omc3.toString().substring(0, omc3.toString().indexOf(".") + 3));
			$('#omc4').val(omc4.toString().substring(0, omc4.toString().indexOf(".") + 3));
			$('#omc5').val(omc5.toString().substring(0, omc5.toString().indexOf(".") + 3));
			$('#omc6').val(omc6.toString().substring(0, omc6.toString().indexOf(".") + 3));
			
			$('#mdd1').val(mdd1.toString().substring(0, mdd1.toString().indexOf(".") + 3));
			$('#mdd2').val(mdd2.toString().substring(0, mdd2.toString().indexOf(".") + 3));
			$('#mdd3').val(mdd3.toString().substring(0, mdd3.toString().indexOf(".") + 3));
			$('#mdd4').val(mdd4.toString().substring(0, mdd4.toString().indexOf(".") + 3));
			$('#mdd5').val(mdd5.toString().substring(0, mdd5.toString().indexOf(".") + 3));
			$('#mdd6').val(mdd6.toString().substring(0, mdd6.toString().indexOf(".") + 3));
			
			
		
	});
	
	$("#mdd").change(function(){
		var omc = $('#omc').val();
		var mdd = $('#mdd').val();
		
			var volume = parseFloat($('#volume').val());
			var empty_mould = parseFloat($('#empty_mould').val());
			var weight_of_sample = $('#weight_of_sample').val();
			
			var wos1 = 3000;	
			var wos2 = 3000;
			var wos3 = 3000;
			var wos4 = 3000;
			var wos5 = 3000;
			var wos6 = 3000;
			
			var wad1 = 4;	
			var wad2 = 6;
			var wad3 = 8;
			var wad4 = 10;
			var wad5 = 12;
			var wad6 = 14;
			
			var wra1 = (parseInt(wad1)*parseInt(wos1))/100;
			var wra2 = (parseInt(wad2)*parseInt(wos2))/100;
			var wra3 = (parseInt(wad3)*parseInt(wos3))/100;
			var wra4 = (parseInt(wad4)*parseInt(wos4))/100;
			var wra5 = (parseInt(wad5)*parseInt(wos5))/100;
			var wra6 = (parseInt(wad6)*parseInt(wos6))/100;
			
			var bd1 = parseFloat(randomNumberFromRange(2.30,2.32));
			var bd2 = parseFloat(randomNumberFromRange(2.32,2.34));
			var bd3 = parseFloat(randomNumberFromRange(2.34,2.36));
			var bd4 = parseFloat(randomNumberFromRange(2.36,2.38));
			var bd5 = parseFloat(randomNumberFromRange(2.33,2.35));
			var bd6 = parseFloat(randomNumberFromRange(2.29,2.30));	

			var wmc1 = (bd1 * volume) + empty_mould;
			var wmc2 = (bd2 * volume) + empty_mould;
			var wmc3 = (bd3 * volume) + empty_mould;
			var wmc4 = (bd4 * volume) + empty_mould;
			var wmc5 = (bd5 * volume) + empty_mould;
			var wmc6 = (bd6 * volume) + empty_mould;
			
			var cnm1 = "C-1";
			var cnm2 = "C-2";
			var cnm3 = "C-3";
			var cnm4 = "C-4";
			var cnm5 = "C-5";
			var cnm6 = "C-6";
			
			var ww31 = 200;
			var ww32 = 200;
			var ww33 = 200;
			var ww34 = 200;
			var ww35 = 200;
			var ww36 = 200;
			
			var omc1 = parseFloat(randomNumberFromRange(6.20, 6.40));
			var omc2 = parseFloat(randomNumberFromRange(6.40, 6.60));
			var omc3 = parseFloat(randomNumberFromRange(6.60, 6.80));
			var omc4 = parseFloat(omc);
			var omc5 = parseFloat(randomNumberFromRange(7.00, 6.20));
			var omc6 = parseFloat(randomNumberFromRange(7.20, 7.40));
			
			
			//PENDING
			var wd41 = (parseFloat(ww31) * 100) / (parseFloat(omc1)+100);
			var wd42 = (parseFloat(ww32) * 100) / (parseFloat(omc2)+100);
			var wd43 = (parseFloat(ww33) * 100) / (parseFloat(omc3)+100);
			var wd44 = (parseFloat(ww34) * 100) / (parseFloat(omc4)+100);
			var wd45 = (parseFloat(ww35) * 100) / (parseFloat(omc5)+100);
			var wd46 = (parseFloat(ww36) * 100) / (parseFloat(omc6)+100);
			
			var mdd1 = bd1 /((1+parseFloat(omc1))/100);
			var mdd2 = bd2 /((1+parseFloat(omc2))/100);
			var mdd3 = bd3 /((1+parseFloat(omc3))/100);
			var mdd4 = parseFloat(mdd);
			var mdd5 = bd5 /((1+parseFloat(omc5))/100);
			var mdd6 = bd5 /((1+parseFloat(omc6))/100);
			
			var wms1 = parseFloat(volume) * parseFloat(bd1);
			var wms2 = parseFloat(volume) * parseFloat(bd2);
			var wms3 = parseFloat(volume) * parseFloat(bd3);
			var wms4 = parseFloat(volume) * parseFloat(bd4);
			var wms5 = parseFloat(volume) * parseFloat(bd5);
			var wms6 = parseFloat(volume) * parseFloat(bd6);
			
			$('#wos1').val(wos1);
			$('#wos2').val(wos2);
			$('#wos3').val(wos3);
			$('#wos4').val(wos4);
			$('#wos5').val(wos5);
			$('#wos6').val(wos6);

			$('#wad1').val(wad1.toString().substring(0, wad1.toString().indexOf(".") + 3));
			$('#wad2').val(wad2.toString().substring(0, wad2.toString().indexOf(".") + 3));
			$('#wad3').val(wad3.toString().substring(0, wad3.toString().indexOf(".") + 3));
			$('#wad4').val(wad4.toString().substring(0, wad4.toString().indexOf(".") + 3));
			$('#wad5').val(wad5.toString().substring(0, wad5.toString().indexOf(".") + 3));
			$('#wad6').val(wad6.toString().substring(0, wad6.toString().indexOf(".") + 3));
			
			
			$('#wra1').val(wra1.toString().substring(0, wra1.toString().indexOf(".") + 3));
			$('#wra2').val(wra2.toString().substring(0, wra2.toString().indexOf(".") + 3));
			$('#wra3').val(wra3.toString().substring(0, wra3.toString().indexOf(".") + 3));
			$('#wra4').val(wra4.toString().substring(0, wra4.toString().indexOf(".") + 3));
			$('#wra5').val(wra5.toString().substring(0, wra5.toString().indexOf(".") + 3));
			$('#wra6').val(wra6.toString().substring(0, wra6.toString().indexOf(".") + 3));


			$('#wmc1').val(wmc1.toFixed(2));
			$('#wmc2').val(wmc2.toFixed(2));
			$('#wmc3').val(wmc3.toFixed(2));
			$('#wmc4').val(wmc4.toFixed(2));
			$('#wmc5').val(wmc5.toFixed(2));
			$('#wmc6').val(wmc6.toFixed(2));
			
			$('#wms1').val(wms1.toFixed());
			$('#wms2').val(wms2.toFixed());
			$('#wms3').val(wms3.toFixed());
			$('#wms4').val(wms4.toFixed());
			$('#wms5').val(wms5.toFixed());
			$('#wms6').val(wms6.toFixed());
			

			$('#bd1').val(bd1.toString().substring(0, bd1.toString().indexOf(".") + 3));
			$('#bd2').val(bd2.toString().substring(0, bd2.toString().indexOf(".") + 3));
			$('#bd3').val(bd3.toString().substring(0, bd3.toString().indexOf(".") + 3));
			$('#bd4').val(bd4.toString().substring(0, bd4.toString().indexOf(".") + 3));
			$('#bd5').val(bd5.toString().substring(0, bd5.toString().indexOf(".") + 3));
			$('#bd6').val(bd6.toString().substring(0, bd6.toString().indexOf(".") + 3));

			$('#cnm1').val(cnm1);
			$('#cnm2').val(cnm2);
			$('#cnm3').val(cnm3);
			$('#cnm4').val(cnm4);
			$('#cnm5').val(cnm5);
			$('#cnm6').val(cnm6);
			
			$('#ww31').val(ww31.toString().substring(0, ww31.toString().indexOf(".") + 3));
			$('#ww32').val(ww32.toString().substring(0, ww32.toString().indexOf(".") + 3));
			$('#ww33').val(ww33.toString().substring(0, ww33.toString().indexOf(".") + 3));
			$('#ww34').val(ww34.toString().substring(0, ww34.toString().indexOf(".") + 3));
			$('#ww35').val(ww35.toString().substring(0, ww35.toString().indexOf(".") + 3));
			$('#ww36').val(ww36.toString().substring(0, ww36.toString().indexOf(".") + 3));
			
			$('#wd41').val(wd41.toString().substring(0, wd41.toString().indexOf(".") + 3));
			$('#wd42').val(wd42.toString().substring(0, wd42.toString().indexOf(".") + 3));
			$('#wd43').val(wd43.toString().substring(0, wd43.toString().indexOf(".") + 3));
			$('#wd44').val(wd44.toString().substring(0, wd44.toString().indexOf(".") + 3));
			$('#wd45').val(wd45.toString().substring(0, wd45.toString().indexOf(".") + 3));
			$('#wd46').val(wd46.toString().substring(0, wd46.toString().indexOf(".") + 3));
			

			$('#omc1').val(omc1.toString().substring(0, omc1.toString().indexOf(".") + 3));
			$('#omc2').val(omc2.toString().substring(0, omc2.toString().indexOf(".") + 3));
			$('#omc3').val(omc3.toString().substring(0, omc3.toString().indexOf(".") + 3));
			$('#omc4').val(omc4.toString().substring(0, omc4.toString().indexOf(".") + 3));
			$('#omc5').val(omc5.toString().substring(0, omc5.toString().indexOf(".") + 3));
			$('#omc6').val(omc6.toString().substring(0, omc6.toString().indexOf(".") + 3));
			
			$('#mdd1').val(mdd1.toString().substring(0, mdd1.toString().indexOf(".") + 3));
			$('#mdd2').val(mdd2.toString().substring(0, mdd2.toString().indexOf(".") + 3));
			$('#mdd3').val(mdd3.toString().substring(0, mdd3.toString().indexOf(".") + 3));
			$('#mdd4').val(mdd4.toString().substring(0, mdd4.toString().indexOf(".") + 3));
			$('#mdd5').val(mdd5.toString().substring(0, mdd5.toString().indexOf(".") + 3));
			$('#mdd6').val(mdd6.toString().substring(0, mdd6.toString().indexOf(".") + 3));
			
			
		
	});
	
	
	$('#chk_den').change(function(){
         if(this.checked)
		 { 
			$('#txtden').css("background-color","var(--success)");
			 var lm = $('#lab_no').val();
			 var den_lab_1= lm;
			 var den_lab_2= lm;

			 var ov_1= "Oven Dry";
			 var ov_2= "Oven Dry";
			
			 var den_volume = $('#den_volume').val();
			 var v1 = 15.12;
			 var v2 = 15.12;
			
			
			
			 var wt1 = 11.80;
			 var wt2 = 11.80;
				
			 var bdl = randomNumberFromRange(1.46,1.55);	
			 var bdc = randomNumberFromRange(1.58,1.64);	
			
			 var bdl1 = parseFloat(bdl) + randomNumberFromRange(-0.03,0.03);
			 var bdc1 = parseFloat(bdc) + randomNumberFromRange(-0.03,0.03);
			
			 var tems1 = (parseFloat(bdl) * 2);
			 var tems2 = (parseFloat(bdc) * 2);
		     var bdl2 = (parseFloat(tems1)-parseFloat(bdl1));
		     var bdc2 = (parseFloat(tems2)-parseFloat(bdc1));
			
			 var ws1 = (parseFloat(bdc1)*parseFloat(v1))+parseFloat(wt1);
			 var ws2 = (parseFloat(bdc2)*parseFloat(v2))+parseFloat(wt2);
			
			
			 var wm1 = (parseFloat(bdl1)*parseFloat(v1))+parseFloat(wt1);
			 var wm2 = (parseFloat(bdl2)*parseFloat(v2))+parseFloat(wt2);
				
			 $('#den_lab_1').val(den_lab_1);
			 $('#den_lab_2').val(den_lab_2);
			 $('#ov_1').val(ov_1);
			 $('#ov_2').val(ov_2);
					
			 $('#v1').val(v1.toString().substring(0, v1.toString().indexOf(".") + 3));
			 $('#v2').val(v2.toString().substring(0, v2.toString().indexOf(".") + 3));
			 $('#wt1').val(wt1.toString().substring(0, wt1.toString().indexOf(".") + 3));
			 $('#wt2').val(wt2.toString().substring(0, wt2.toString().indexOf(".") + 3));		
			
			 $('#wm1').val(wm1.toString().substring(0, wm1.toString().indexOf(".") + 3));
			 $('#wm2').val(wm2.toString().substring(0, wm2.toString().indexOf(".") + 3));
			 $('#ws1').val(ws1.toString().substring(0, ws1.toString().indexOf(".") + 3));
			 $('#ws2').val(ws2.toString().substring(0, ws2.toString().indexOf(".") + 3));
			
					
		    $('#bdl1').val(bdl1.toString().substring(0, bdl1.toString().indexOf(".") + 3));
		    $('#bdl2').val(bdl2.toString().substring(0, bdl2.toString().indexOf(".") + 3));
			 $('#bdl').val(bdl.toString().substring(0, bdl.toString().indexOf(".") + 3));
			 $('#bdc1').val(bdc1.toString().substring(0, bdc1.toString().indexOf(".") + 3));
			 $('#bdc2').val(bdc2.toString().substring(0, bdc2.toString().indexOf(".") + 3));
			 $('#bdc').val(bdc.toString().substring(0, bdc.toString().indexOf(".") + 3));
		
			
		 }
		 else
		 {
					$('#txtden').css("background-color","white");
					 $('#den_lab_1').val(null);
					 $('#den_lab_2').val(null);
					 $('#ov_1').val(null);
					 $('#ov_2').val(null);
					
					
					 
					 $('#v1').val(null);
					 $('#v2').val(null);
					 $('#wt1').val(null);
					 $('#wt2').val(null);
					
					
					
					
					 $('#wm1').val(null);
					 $('#wm2').val(null);
					 $('#ws1').val(null);
					 $('#ws2').val(null);					
					
				   
					 $('#bdl1').val(null);
					 $('#bdl2').val(null);
					 $('#bdc1').val(null);
					 $('#bdc2').val(null);
					 $('#bdc').val(null);
					 $('#bdl').val(null);
				  
					
		 }
	 });
	
	
	 function bulk_den()
	 {
			 var lm = $('#lab_no').val();
			 var den_lab_1= lm +" /1";
			 var den_lab_2= lm +" /2";

			 var ov_1= "Oven Dry";
			 var ov_2= "Oven Dry";
			
			 var den_volume = $('#den_volume').val();
			 var v1 = $('#v1').val();
			 var v2 = $('#v2').val();
			
			
			 var wt1 = $('#wt1').val();
			 var wt2 = $('#wt2').val();
			
			
 					
			 var bdl = $('#bdl').val();
			 var bdc = $('#bdc').val();
			
			 var bdl1 = parseFloat(bdl) + randomNumberFromRange(-0.03,0.03);
			 var bdc1 = parseFloat(bdc) + randomNumberFromRange(-0.03,0.03);
			
			 var tems1 = (parseFloat(bdl) * 2);
			 var tems2 = (parseFloat(bdc) * 2);
		     var bdl2 = (parseFloat(tems1)-parseFloat(bdl1));
		     var bdc2 = (parseFloat(tems2)-parseFloat(bdc1));
			
			 var ws1 = (parseFloat(bdc1)*parseFloat(v1))+parseFloat(wt1);
			 var ws2 = (parseFloat(bdc2)*parseFloat(v2))+parseFloat(wt2);
			
			
			 var wm1 = (parseFloat(bdl1)*parseFloat(v1))+parseFloat(wt1);
			 var wm2 = (parseFloat(bdl2)*parseFloat(v2))+parseFloat(wt2);
				
			 $('#den_lab_1').val(den_lab_1);
			 $('#den_lab_2').val(den_lab_2);
			 $('#ov_1').val(ov_1);
			 $('#ov_2').val(ov_2);
					
			
				
			
			
			 $('#wm1').val(wm1.toString().substring(0, wm1.toString().indexOf(".") + 3));
			 $('#wm2').val(wm2.toString().substring(0, wm2.toString().indexOf(".") + 3));
			 $('#ws1').val(ws1.toString().substring(0, ws1.toString().indexOf(".") + 3));
			 $('#ws2').val(ws2.toString().substring(0, ws2.toString().indexOf(".") + 3));
			
			
			 $('#bdl1').val(bdl1.toString().substring(0, bdl1.toString().indexOf(".") + 3));
		    $('#bdl2').val(bdl2.toString().substring(0, bdl2.toString().indexOf(".") + 3));
		
			 $('#bdc1').val(bdc1.toString().substring(0, bdc1.toString().indexOf(".") + 3));
			 $('#bdc2').val(bdc2.toString().substring(0, bdc2.toString().indexOf(".") + 3));
		
			
	 }
	
	 $('#bdl').change(function(){
        
		 bulk_den();	
	 });
	 $('#bdc').change(function(){
        
		 bulk_den();	
	 });
	
	 $('#den_volume').change(function(){
         var lm = $('#lab_no').val();
			 var den_lab_1= lm;
			 var den_lab_2= lm;

			 var ov_1= "Oven Dry";
			 var ov_2= "Oven Dry";
			
			 var den_volume = $('#den_volume').val();
			 var v1 = 15.12;
			 var v2 = 15.12;
			
			 var wt1 = 11.80;
			 var wt2 = 11.80;
 					
			 var bdl = randomNumberFromRange(1.46,1.55);	
			 var bdc = randomNumberFromRange(1.58,1.64);
			
			 var bdl1 = parseFloat(bdl) + randomNumberFromRange(-0.03,0.03);
			 var bdc1 = parseFloat(bdc) + randomNumberFromRange(-0.03,0.03);
			
			 var tems1 = (parseFloat(bdl) * 2);
			 var tems2 = (parseFloat(bdc) * 2);
		     var bdl2 = (parseFloat(tems1)-parseFloat(bdl1));
		     var bdc2 = (parseFloat(tems2)-parseFloat(bdc1));
			
			 var ws1 = (parseFloat(bdc1)*parseFloat(v1))+parseFloat(wt1);
			 var ws2 = (parseFloat(bdc2)*parseFloat(v2))+parseFloat(wt2);
			
			
			 var wm1 = (parseFloat(bdl1)*parseFloat(v1))+parseFloat(wt1);
			 var wm2 = (parseFloat(bdl2)*parseFloat(v2))+parseFloat(wt2);
				
			 $('#den_lab_1').val(den_lab_1);
			 $('#den_lab_2').val(den_lab_2);
			 $('#ov_1').val(ov_1);
			 $('#ov_2').val(ov_2);
					
			 $('#v1').val(v1.toString().substring(0, v1.toString().indexOf(".") + 3));
			 $('#v2').val(v2.toString().substring(0, v2.toString().indexOf(".") + 3));
			 $('#wt1').val(wt1.toString().substring(0, wt1.toString().indexOf(".") + 3));
			 $('#wt2').val(wt2.toString().substring(0, wt2.toString().indexOf(".") + 3));		
			
			 $('#wm1').val(wm1.toString().substring(0, wm1.toString().indexOf(".") + 3));
			 $('#wm2').val(wm2.toString().substring(0, wm2.toString().indexOf(".") + 3));
			 $('#ws1').val(ws1.toString().substring(0, ws1.toString().indexOf(".") + 3));
			 $('#ws2').val(ws2.toString().substring(0, ws2.toString().indexOf(".") + 3));
			
			
			 $('#bdl1').val(bdl1.toString().substring(0, bdl1.toString().indexOf(".") + 3));
		    $('#bdl2').val(bdl2.toString().substring(0, bdl2.toString().indexOf(".") + 3));
			 $('#bdl').val(bdl.toString().substring(0, bdl.toString().indexOf(".") + 3));
			 $('#bdc1').val(bdc1.toString().substring(0, bdc1.toString().indexOf(".") + 3));
			 $('#bdc2').val(bdc2.toString().substring(0, bdc2.toString().indexOf(".") + 3));
			 $('#bdc').val(bdc.toString().substring(0, bdc.toString().indexOf(".") + 3));	
			
	 });
	
	 function den_dt()
	 {
			 var lm = $('#lab_no').val();
			 var den_lab_1= lm +" /1";
			 var den_lab_2= lm +" /2";

			 var ov_1= "Oven Dry";
			 var ov_2= "Oven Dry";
			
			 var den_volume = $('#den_volume').val();
			 var v1 = $('#v1').val();
			 var v2 = $('#v2').val();
			
			
			 var wt1 = $('#wt1').val();
			 var wt2 = $('#wt2').val();
			
			 var wm1 = $('#wm1').val();
			 var wm2 = $('#wm2').val();
			
			 var ws1 = $('#ws1').val();
			 var ws2 = $('#ws2').val();
			
			 var bdl1 = (parseFloat(wm1)-parseFloat(wt1))/parseFloat(v1);
			 var bdl2 = (parseFloat(wm2)-parseFloat(wt2))/parseFloat(v2);
			
			 var bdc1 = (parseFloat(ws1)-parseFloat(wt1))/parseFloat(v1);
			 var bdc2 = (parseFloat(ws2)-parseFloat(wt2))/parseFloat(v2);
			
			 var bdl = (parseFloat(bdl1)+parseFloat(bdl2))/2;
			 var bdc = (parseFloat(bdc1)+parseFloat(bdc2))/2;
			
			 $('#bdl1').val(bdl1.toString().substring(0, bdl1.toString().indexOf(".") + 3));
		    $('#bdl2').val(bdl2.toString().substring(0, bdl2.toString().indexOf(".") + 3));
			 $('#bdl').val(bdl.toString().substring(0, bdl.toString().indexOf(".") + 3));
			 $('#bdc1').val(bdc1.toString().substring(0, bdc1.toString().indexOf(".") + 3));
			 $('#bdc2').val(bdc2.toString().substring(0, bdc2.toString().indexOf(".") + 3));
			 $('#bdc').val(bdc.toString().substring(0, bdc.toString().indexOf(".") + 3));
			
		
	 }
	
	 $('#wt1').change(function(){
        
		 den_dt();	
	 });
	 $('#wt2').change(function(){
        
		 den_dt();	
	 });
	
	 $('#wm1').change(function(){
        
		 den_dt();	
	 });
	
	 $('#wm2').change(function(){
        
		 den_dt();	
	 });
	
	 $('#ws1').change(function(){
        
		 den_dt();	
	 });
	
	 $('#ws2').change(function(){
        
		 den_dt();	
	 });

	
	

	var sieve_1;	
	var sieve_2;	
	var sieve_3;	
	var sieve_4;
	var sieve_5;
	var sieve_6;
	var sieve_7;
	
	 
	
	$('#chk_grd').change(function(){
        if(this.checked)
		{ 
			sieve_1="53.00";	
			sieve_2="26.50";	
			sieve_3="22.40";	
			sieve_4="13.20";	
			sieve_5="5.60";
			sieve_6="2.80";
			sieve_7="Pan";
				
					var sample_taken=5000;
					//PASSING RANGE
					var pass_sample_1 = randomNumberFromRange(100, 100);
					var pass_sample_2 = randomNumberFromRange(41.00,74.00);
					var pass_sample_3 = randomNumberFromRange(30.00,40.00);
					var pass_sample_4 = randomNumberFromRange(10.00,18.00);
					var pass_sample_5 = randomNumberFromRange(5.00,10.00);
					var pass_sample_6 = randomNumberFromRange(2.00,4.00);
					var pass_sample_7 = randomNumberFromRange(0.00,0.00);
					
					
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
					var cum_ret_6 = 100-parseFloat(pass_sample_6);
					var cum_ret_7 = 100-parseFloat(pass_sample_7);
					
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
					var ret_wt_gm_6 = (parseFloat(cum_ret_6)*parseFloat(sample_taken))/100;
					var ret_wt_gm_7 = (parseFloat(cum_ret_7)*parseFloat(sample_taken))/100;
					
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
					var cum_wt_gm_6 = parseFloat(ret_wt_gm_6)-parseFloat(ret_wt_gm_6);
					var cum_wt_gm_7 = parseFloat(ret_wt_gm_7)-parseFloat(ret_wt_gm_7);
					
					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5)+parseFloat(cum_wt_gm_6)+parseFloat(cum_wt_gm_7);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
					$('#cum_wt_gm_6').val(cum_wt_gm_6.toFixed(0));
					$('#cum_wt_gm_7').val(cum_wt_gm_7.toFixed(0));
					
					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
					$('#ret_wt_gm_6').val(ret_wt_gm_6.toFixed(0));
					$('#ret_wt_gm_7').val(ret_wt_gm_7.toFixed(0));
					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(1));
					$('#cum_ret_2').val(cum_ret_2.toFixed(1));
					$('#cum_ret_3').val(cum_ret_3.toFixed(1));
					$('#cum_ret_4').val(cum_ret_4.toFixed(1));
					$('#cum_ret_5').val(cum_ret_5.toFixed(1));
					$('#cum_ret_6').val(cum_ret_6.toFixed(1));
					$('#cum_ret_7').val(cum_ret_7.toFixed(1));
					
				   
					$('#pass_sample_1').val(pass_sample_1.toFixed(1));
					$('#pass_sample_2').val(pass_sample_2.toFixed(1));
					$('#pass_sample_3').val(pass_sample_3.toFixed(1));
					$('#pass_sample_4').val(pass_sample_4.toFixed(1));
					$('#pass_sample_5').val(pass_sample_5.toFixed(1));
					$('#pass_sample_6').val(pass_sample_6.toFixed(1));
					$('#pass_sample_7').val(pass_sample_7.toFixed(1));
					
					
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					 $('#sample_taken').val(sample_taken.toFixed(0));
			
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
					 
					$('#ret_wt_gm_1').val(null);
					$('#ret_wt_gm_2').val(null);
					$('#ret_wt_gm_3').val(null);
					$('#ret_wt_gm_4').val(null);
					$('#ret_wt_gm_5').val(null);
					$('#ret_wt_gm_6').val(null);
					$('#ret_wt_gm_7').val(null);
					
					
					
					$('#cum_ret_1').val(null);
					$('#cum_ret_2').val(null);
					$('#cum_ret_3').val(null);
					$('#cum_ret_4').val(null);
					$('#cum_ret_5').val(null);
					$('#cum_ret_6').val(null);
					$('#cum_ret_7').val(null);
					
				   
					$('#pass_sample_1').val(null);
					$('#pass_sample_2').val(null);
					$('#pass_sample_3').val(null);
					$('#pass_sample_4').val(null);
					$('#pass_sample_5').val(null);
					$('#pass_sample_6').val(null);
					$('#pass_sample_7').val(null);
				  
					 $('#blank_extra').val(null);
					 $('#sample_taken').val(null);
		}
	});
	
	
	$('#sample_taken').change(function(){
        grds_func();
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
	
	
	function grds_func()
	{
		
			sieve_1="53.00";	
			sieve_2="26.50";	
			sieve_3="22.40";	
			sieve_4="13.20";	
			sieve_5="5.60";
			sieve_6="2.80";
			sieve_7="Pan";		
					var sample_taken=$('#sample_taken').val();
					//PASSING RANGE
					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();
					var pass_sample_5 = $('#pass_sample_5').val();
					var pass_sample_6 = $('#pass_sample_6').val();
					var pass_sample_7 = $('#pass_sample_7').val();
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
					var cum_ret_6 = 100-parseFloat(pass_sample_6);
					var cum_ret_7 = 100-parseFloat(pass_sample_7);
					
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
					var ret_wt_gm_6 = (parseFloat(cum_ret_6)*parseFloat(sample_taken))/100;
					var ret_wt_gm_7 = (parseFloat(cum_ret_7)*parseFloat(sample_taken))/100;
					
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
					var cum_wt_gm_6 = parseFloat(ret_wt_gm_6)-parseFloat(ret_wt_gm_6);
					var cum_wt_gm_7 = parseFloat(ret_wt_gm_7)-parseFloat(ret_wt_gm_7);
					
					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5)+parseFloat(cum_wt_gm_6)+parseFloat(cum_wt_gm_7);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
					$('#cum_wt_gm_6').val(cum_wt_gm_6.toFixed(0));
					$('#cum_wt_gm_7').val(cum_wt_gm_7.toFixed(0));
					
					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
					$('#ret_wt_gm_6').val(ret_wt_gm_6.toFixed(0));
					$('#ret_wt_gm_7').val(ret_wt_gm_7.toFixed(0));
					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(1));
					$('#cum_ret_2').val(cum_ret_2.toFixed(1));
					$('#cum_ret_3').val(cum_ret_3.toFixed(1));
					$('#cum_ret_4').val(cum_ret_4.toFixed(1));
					$('#cum_ret_5').val(cum_ret_5.toFixed(1));
					$('#cum_ret_6').val(cum_ret_6.toFixed(1));
					$('#cum_ret_7').val(cum_ret_7.toFixed(1));
					
				   
					/*$('#pass_sample_1').val(pass_sample_1.toFixed(1));
					$('#pass_sample_2').val(pass_sample_2.toFixed(1));
					$('#pass_sample_3').val(pass_sample_3.toFixed(1));
					$('#pass_sample_4').val(pass_sample_4.toFixed(1));
					$('#pass_sample_5').val(pass_sample_5.toFixed(1));
					$('#pass_sample_6').val(pass_sample_6.toFixed(1));
					$('#pass_sample_7').val(pass_sample_7.toFixed(1));*/
					
					
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					// $('#sample_taken').val(sample_taken.toFixed(0));
			
		
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
        url: '<?php echo $base_url; ?>save_coarse_agg.php',
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
						
						//GRADATION DATA FETCH
						var sieve_1="53.00";	
						var sieve_2="26.50";	
						var sieve_3="22.40";	
						var sieve_4="13.20";	
						var sieve_5="5.60";	
						var sieve_6="2.80";	
						var sieve_7="Pan";	
						var sample_taken = $('#sample_taken').val();
						var blank_extra = $('#blank_extra').val();
						
						var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
						var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
						var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
						var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
						var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
						var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
						var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
														
						var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
						var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
						var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
						var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
						var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
						var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
						var ret_wt_gm_7 = $('#ret_wt_gm_7').val();
						
						var cum_ret_1 = $('#cum_ret_1').val();
						var cum_ret_2 = $('#cum_ret_2').val();
						var cum_ret_3 = $('#cum_ret_3').val();
						var cum_ret_4 = $('#cum_ret_4').val();
						var cum_ret_5 = $('#cum_ret_5').val();
						var cum_ret_6 = $('#cum_ret_6').val();
						var cum_ret_7 = $('#cum_ret_7').val();
						
						var pass_sample_1 = $('#pass_sample_1').val();
						var pass_sample_2 = $('#pass_sample_2').val();
						var pass_sample_3 = $('#pass_sample_3').val();
						var pass_sample_4 = $('#pass_sample_4').val();
						var pass_sample_5 = $('#pass_sample_5').val();
						var pass_sample_6 = $('#pass_sample_6').val();
						var pass_sample_7 = $('#pass_sample_7').val();
						break;
					}
					else
					{
						var chk_grd = "0";	
						var cum_wt_gm_1 ="0";
						var cum_wt_gm_2 ="0";
						var cum_wt_gm_3 ="0";
						var cum_wt_gm_4 ="0";
						var cum_wt_gm_5 ="0";
						var cum_wt_gm_6 ="0";
						var cum_wt_gm_7 ="0";
						
						var ret_wt_gm_1 ="0";
						var ret_wt_gm_2 ="0";
						var ret_wt_gm_3 ="0";
						var ret_wt_gm_4 ="0";
						var ret_wt_gm_5 ="0";
						var ret_wt_gm_6 ="0";
						var ret_wt_gm_7 ="0";
						
						
						var cum_ret_1 ="0";
						var cum_ret_2 ="0";
						var cum_ret_3 ="0";
						var cum_ret_4 ="0";
						var cum_ret_5 ="0";
						var cum_ret_6 ="0";
						var cum_ret_7 ="0";
					   
						var pass_sample_1 ="0";
						var pass_sample_2 ="0";
						var pass_sample_3 ="0";
						var pass_sample_4 ="0";
						var pass_sample_5 ="0";
						var pass_sample_6 ="0";
						var pass_sample_7 ="0";
					  
						 var blank_extra ="0";
						 var sample_taken ="0";
					}
														
				}
				
				
 				//IMPACT
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="imp")
					{
						
							if(document.getElementById('chk_impact').checked) {
									var chk_impact = "1";
							}
							else{
									var chk_impact = "0";
							}
							//impact value-3
							var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
							var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
							var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
							var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
							var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
							var imp_w_m_c_2 = $('#imp_w_m_c_2').val();
							var imp_value_1 = $('#imp_value_1').val();
							var imp_value_2 = $('#imp_value_2').val();
							var imp_w_m_d_1 = $('#imp_w_m_d_1').val();
							var imp_w_m_d_2 = $('#imp_w_m_d_2').val();
							var imp_value = $('#imp_value').val();
							break;
					}
					else
					{
						var chk_impact = "0";	
						var imp_value ="0";
						var imp_value_1 ="0";
						var imp_value_2 ="0";
						var imp_w_m_a_1 ="0";
						var imp_w_m_b_1 ="0";
						var imp_w_m_c_1 ="0";
						var imp_w_m_d_1 ="0";
						var imp_w_m_a_2 ="0";
						var imp_w_m_b_2 ="0";
						var imp_w_m_c_2 ="0";
						var imp_w_m_d_2 ="0";
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
						
							var den_volume = $('#den_volume').val();
							var den_lab_1 = $('#den_lab_1').val();
							var den_lab_2 = $('#den_lab_2').val();
							var ov_1 = $('#ov_1').val();
							var ov_2 = $('#ov_2').val();
							var v1 = $('#v1').val();
							var v2 = $('#v2').val();
							var wt1 = $('#wt1').val();
							var wt2 = $('#wt2').val();
							var wm1 = $('#wm1').val();
							var wm2 = $('#wm2').val();
							var ws1 = $('#ws1').val();
							var ws2 = $('#ws2').val();
							var bdl1 = $('#bdl1').val();
							var bdl2 = $('#bdl2').val();
							var bdc1 = $('#bdc1').val();
							var bdc2 = $('#bdc2').val();
							var bdl = $('#bdl').val();
							var bdc = $('#bdc').val();
							break;
					}
					else
					{
						var chk_den = "0";	
						var den_volume = "0";
						var den_lab_1 = "0";
						var den_lab_2 = "0";
						var ov_1 = "0";
						var ov_2 = "0";
						var v1 = "0";
						var v2 = "0";
						var wt1 = "0";
						var wt2 = "0";
						var wm1 = "0";
						var wm2 = "0";
						var ws1 = "0";
						var ws2 = "0";
						var bdl1 = "0";
						var bdl2 = "0";
						var bdc1 = "0";
						var bdc2 = "0";
						var bdl = "0";
						var bdc = "0";
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
						var sp_w_b_a1_1 = $('#sp_w_b_a1_1').val();			
						var sp_w_b_a1_2 = $('#sp_w_b_a1_2').val();			
						var sp_w_b_a2_1 = $('#sp_w_b_a2_1').val();			
						var sp_w_b_a2_2 = $('#sp_w_b_a2_2').val();				
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
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_w_b_a1_1 ="0";
						var sp_w_b_a2_1 ="0";
						var sp_w_sur_1 ="0";
						var sp_w_s_1 ="0";
						var sp_wt_st_1 ="0";						
						var sp_w_b_a1_2 ="0";
						var sp_w_b_a2_2 ="0";
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
					}
				
				}
				
				//ABRASION VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abr")
					{
						if(document.getElementById('chk_abr').checked) {
							var chk_abr = "1";
							}
							else{
								var chk_abr = "0";
							}
						//Abrasion-2
						var abr_index = $('#abr_index').val();
						var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
						var abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
						var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
						var abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
						var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
						var abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();
						var abr_sample_abr = $('#abr_sample_abr').val();
						var abr_grading = $('#abr_grading').val();
						var abr_num_revo = $('#abr_num_revo').val();
						var abr_weight_charge = $('#abr_weight_charge').val();
						var abr_sphere = $('#abr_sphere').val();		
						break;
					}
					else
					{
						var chk_abr = "0";	
						var abr_sample_abr ="0";
						var abr_wt_t_a_1 ="0";
						var abr_wt_t_b_1 ="0";
						var abr_wt_t_c_1 ="0";
						var abr_wt_t_a_2 ="0";
						var abr_wt_t_b_2 ="0";
						var abr_grading ="0";
						var abr_wt_t_c_2 ="0";
						var abr_index ="0";
						var abr_sphere ="0";
						var abr_num_revo ="0";
						var abr_weight_charge ="0";
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
							
							
								var chk_wp = "0";
							
								var chk_a = "0";
							
								var chk_b = "0";
							
								var chk_c = "0";
							
								var chk_d = "0";
							
								var chk_e = "0";
						
							var soundness = $('#soundness').val();	
							var sou_size1 = $('#sou_size1').val();	
							var sou_size2 = $('#sou_size2').val();	
							var w1= $('#w1').val();	
							var w2= $('#w2').val();	
							var wsum= $('#wsum').val();	
							var ga1 = $('#ga1').val();	
							var ga2 = $('#ga2').val();	
							var gasum = $('#gasum').val();	
							var gb1 = $('#gb1').val();
							var gb2 = $('#gb2').val();
							var gbsum = $('#gbsum').val();
							var gc1 = $('#gc1').val();
							var gc2 = $('#gc2').val();
							var gcsum = $('#gcsum').val();
							var gd1 = $('#gd1').val();
							var gd2 = $('#gd2').val();
							var gdsum = $('#gdsum').val();
							var ge1 = $('#ge1').val();
							var ge2 = $('#ge2').val();
							var gesum = $('#gesum').val();
							var s1 = $('#s1').val();
							var s2 = $('#s2').val();
							var sample_id = $('#sample_id').val();
							var sound_sample = $('#sound_sample').val();
							break;
					}
					else
					{
						var chk_sou = "0";	
						var soundness ="0";			
						var sound_sample ="0";			
						var sample_id ="0";			
						
						var sou_size1 ="0";			
						var sou_size2 ="0";			
						var w1 ="0";			
						var w2 ="0";			
						var wsum ="0";			
						
						var ga1 ="0";			
						var ga2 ="0";			
						var gasum ="0";			
						
						var gb1 ="0";			
						var gb2 ="0";			
						var gbsum ="0";			
						
						var gc1 ="0";			
						var gc2 ="0";			
						var gcsum ="0";			
						
						var gd1 ="0";			
						var gd2 ="0";			
						var gdsum ="0";			
						
						var ge1 ="0";			
						var ge2 ="0";			
						var gesum ="0";			
						
						var s1 ="0";			
						var s2  ="0";
					}
				
				}
			
			
			
			
				//FLAKINESS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flk")
					{	
								if(document.getElementById('chk_f1').checked) {
									var chk_f1 = "1";
								}
								else{
									var chk_f1 = "0";
								}
								
								if(document.getElementById('chk_f2').checked) {
									var chk_f2 = "1";
								}
								else{
									var chk_f2 = "0";
								}
								
								if(document.getElementById('chk_f3').checked) {
									var chk_f3 = "1";
								}
								else{
									var chk_f3 = "0";
								}
								
								if(document.getElementById('chk_f4').checked) {
									var chk_f4 = "1";
								}
								else{
									var chk_f4 = "0";
								}
								
								
								if(document.getElementById('chk_f5').checked) {
									var chk_f5 = "1";
								}
								else{
									var chk_f5 = "0";
								}


								if(document.getElementById('chk_f6').checked) {
									var chk_f6 = "1";
								}
								else{
									var chk_f6 = "0";
								}

								if(document.getElementById('chk_f7').checked) {
									var chk_f7 = "1";
								}
								else{
									var chk_f7 = "0";
								}
								
								if(document.getElementById('chk_f8').checked) {
									var chk_f8 = "1";
								}
								else{
									var chk_f8 = "0";
								}

								if(document.getElementById('chk_f9').checked) {
									var chk_f9 = "1";
								}
								else{
									var chk_f9 = "0";
								}
								
								if(document.getElementById('chk_flk').checked) {
									var chk_flk = "1";
								}
								else{
									var chk_flk = "0";
												
								}
							//Flakiness INDEX
							var p1 = $('#p1').val();
							var p2 = $('#p2').val();
							var p3 = $('#p3').val();
							var p4 = $('#p4').val();
							var p5 = $('#p5').val();
							var p6 = $('#p6').val();
							var p7 = $('#p7').val();
							var p8 = $('#p8').val();
							var p9 = $('#p9').val();
						
							var fi_index = $('#fi_index').val();
							var a1 = $('#a1').val();
							var a2 = $('#a2').val();
							var a3 = $('#a3').val();
							var a4 = $('#a4').val();
							var a5 = $('#a5').val();
							var a6 = $('#a6').val();
							var a7 = $('#a7').val();
							var a8 = $('#a8').val();
							var a9 = $('#a9').val();
							var suma = $('#suma').val();
							
							var b1 = $('#b1').val();
							var b2 = $('#b2').val();
							var b3 = $('#b3').val();
							var b4 = $('#b4').val();
							var b5 = $('#b5').val();				
							var b6 = $('#b6').val();				
							var b7 = $('#b7').val();				
							var b8 = $('#b8').val();				
							var b9 = $('#b9').val();				
							
							var c1 = $('#c1').val();
							var c2 = $('#c2').val();
							var c3 = $('#c3').val();
							var c4 = $('#c4').val();
							var c5 = $('#c5').val();
							var c6 = $('#c6').val();
							var c7 = $('#c7').val();
							var c8 = $('#c8').val();
							var c9 = $('#c9').val();
							
							var d1 = $('#d1').val();
							var d2 = $('#d2').val();
							var d3 = $('#d3').val();
							var d4 = $('#d4').val();
							var d5 = $('#d5').val();
							var d6 = $('#d6').val();
							var d7 = $('#d7').val();
							var d8 = $('#d8').val();
							var d9 = $('#d9').val();
							
							var e1 = $('#e1').val();
							var e2 = $('#e2').val();
							var e3 = $('#e3').val();
							var e4 = $('#e4').val();
							var e5 = $('#e5').val();
							var e6 = $('#e6').val();
							var e7 = $('#e7').val();
							var e8 = $('#e8').val();
							var e9 = $('#e9').val();
							
							var ei_index = $('#ei_index').val();
							var aa1 = $('#aa1').val();
							var aa2 = $('#aa2').val();
							var aa3 = $('#aa3').val();
							var aa4 = $('#aa4').val();
							var aa5 = $('#aa5').val();
							var aa6 = $('#aa6').val();
							var aa7 = $('#aa7').val();
							var aa8 = $('#aa8').val();
							var aa9 = $('#aa9').val();
							
							
							var bb1 = $('#bb1').val();
							var bb2 = $('#bb2').val();
							var bb3 = $('#bb3').val();
							var bb4 = $('#bb4').val();
							var bb5 = $('#bb5').val();
							var bb6 = $('#bb6').val();
							var bb7 = $('#bb7').val();
							var bb8 = $('#bb8').val();
							var bb9 = $('#bb9').val();
							
							var dd1 = $('#dd1').val();
							var dd2 = $('#dd2').val();
							var dd3 = $('#dd3').val();
							var dd4 = $('#dd4').val();
							var dd5 = $('#dd5').val();
							var dd6 = $('#dd6').val();
							var dd7 = $('#dd7').val();
							var dd8 = $('#dd8').val();
							var dd9 = $('#dd9').val();
							
							
							var s11 = $('#s11').val();
							var s12 = $('#s12').val();
							var s13 = $('#s13').val();
							var s14 = $('#s14').val();
							var s15 = $('#s15').val();
							var s16 = $('#s16').val();
							var s17 = $('#s17').val();
							var s18 = $('#s18').val();
							var s19 = $('#s19').val();
							
							var combined_index = $('#combined_index').val();
							break;
					}
					else
					{
						var chk_flk = "0";	
						var chk_f1 = "0";
						var chk_f2 = "0";
						var chk_f3 = "0";
						var chk_f4 = "0";
						var chk_f5 = "0";
						var chk_f6 = "0";
						var chk_f7 = "0";
						var chk_f8 = "0";
						var chk_f9 = "0";
						var fi_index ="0";
						var ei_index ="0";
						var combined_index ="0";
						
						var p1 ="0";
						var p2 ="0";
						var p3 ="0";
						var p4 ="0";
						var p5 ="0";
						var p6 ="0";
						var p7 ="0";
						var p8 ="0";
						var p9 ="0";
						 
						var a1 ="0";
						var a2 ="0";
						var a3 ="0";
						var a4 ="0";
						var a5 ="0";
						var a6 ="0";
						var a7 ="0";
						var a8 ="0";
						var a9 ="0";
						var suma ="0";
												
						var b1 ="0";
						var b2 ="0";
						var b3 ="0";
						var b4 ="0";
						var b5 ="0";
						var b6 ="0";
						var b7 ="0";
						var b8 ="0";
						var b9 ="0";
												
						var c1 ="0";
						var c2 ="0";
						var c3 ="0";
						var c4 ="0";
						var c5 ="0";
						var c6 ="0";
						var c7 ="0";
						var c8 ="0";
						var c9 ="0";
												
						var d1 ="0";
						var d2 ="0";
						var d3 ="0";
						var d4 ="0";
						var d5 ="0";
						var d6 ="0";
						var d7 ="0";
						var d8 ="0";
						var d9 ="0";
						
						var e1 ="0";
						var e2 ="0";
						var e3 ="0";
						var e4 ="0";
						var e5 ="0";
						var e6 ="0";
						var e7 ="0";
						var e8 ="0";
						var e9 ="0";
												
						var aa1 ="0";
						var aa2 ="0";
						var aa3 ="0";
						var aa4 ="0";
						var aa5 ="0";
						var aa6 ="0";
						var aa7 ="0";
						var aa8 ="0";
						var aa9 ="0";
						
						var bb1 ="0";	
						var bb2 ="0";
						var bb3 ="0";
						var bb4 ="0";
						var bb5 ="0";
						var bb6 ="0";
						var bb7 ="0";
						var bb8 ="0";
						var bb9 ="0";
						
						var dd1 ="0";
						var dd2 ="0";			
						var dd3 ="0";
						var dd4 ="0";
						var dd5 ="0";
						var dd6 ="0";
						var dd7 ="0";
						var dd8 ="0";
						var dd9 ="0";	
						
						var s11 = "";
						var s12 = "";
						var s13 = "";
						var s14 = "";
						var s15 = "";
						var s16 = "";
						var s17 = "";
						var s18 = "";
						var s19 = "";
					}
				
				}
				 
				  //STRIPPING VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="str")
					{						
							if(document.getElementById('chk_strip').checked) {
									var chk_strip = "1";
								}
								else{
									var chk_strip = "0";
								}
								var stripping_value = $('#stripping_value').val();
								var strip_1 = $('#strip_1').val();
								var strip_2 = $('#strip_2').val();
								var strip_3 = $('#strip_3').val();
								var strip_4 = $('#strip_4').val();
								var strip_5 = $('#strip_5').val();
								var strip_21 = $('#strip_21').val();
								var strip_22 = $('#strip_22').val();
								var strip_23 = $('#strip_23').val();
								var strip_24 = $('#strip_24').val();
								var strip_25 = $('#strip_25').val();
								var strip_31 = $('#strip_31').val();
								var strip_32 = $('#strip_32').val();
								var strip_33 = $('#strip_33').val();
								var strip_34 = $('#strip_34').val();
								var strip_35 = $('#strip_35').val();
							break;
					}
					else
					{
						var stripping_value = "0";
						var chk_strip = "0";
						var strip_1 = "0";
						var strip_2 = "0";
						var strip_3 = "0";
						var strip_4 = "0";
						var strip_5 = "0";
						var strip_21 = "0";
						var strip_22 = "0";
						var strip_23 = "0";
						var strip_24 = "0";
						var strip_25 = "0";
						var strip_31 = "0";
						var strip_32 = "0";
						var strip_33 = "0";
						var strip_34 = "0";
						var strip_35 = "0";
						
					}	
				}
			
				//FINEVALUES
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{						
							if(document.getElementById('chk_fines').checked) {
									var chk_fines = "1";
								}
								else{
									var chk_fines = "0";
								}
							//alkali strip and fines_value
							var fines_value = $('#fines_value').val();
							var f_a_1 = $('#f_a_1').val();
							var f_a_2 = $('#f_a_2').val();
							var f_b_1 = $('#f_b_1').val();
							var f_b_2 = $('#f_b_2').val();
							var f_c_1 = $('#f_c_1').val();
							var f_c_2 = $('#f_c_2').val();
							var f_d_1 = $('#f_d_1').val();
							var f_d_2 = $('#f_d_2').val();
							var f_e_1 = $('#f_e_1').val();
							var f_e_2 = $('#f_e_2').val();
							break;
					}
					else
					{
						var chk_fines = "0";	
						var fines_value = "0";	
						var f_a_1 = "0";
						var f_a_2 = "0";
						var f_b_1 = "0";
						var f_b_2 = "0";
						var f_c_1 = "0";
						var f_c_2 = "0";
						var f_d_1 = "0";
						var f_d_2 = "0";
						var f_e_1 = "0";
						var f_e_2 = "0";
					}	
				}

				//ALKALI REACTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{						
							if(document.getElementById('chk_alkali').checked) {
									var chk_alkali = "1";
								}
								else{
									var chk_alkali = "0";
								}
							var alkali_value = $('#alkali_value').val();
							break;
					}
					else
					{
						var chk_alkali = "0";	
						var alkali_value = "0";	
					}	
				}

				//CRUSHING
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cru")
					{						
							if(document.getElementById('chk_crushing').checked) {
									var chk_crushing = "1";
								}
								else{
									var chk_crushing = "0";
								}
							//crushing value-4
							var cr_sample_crush = $('#cr_sample_crush').val();
							var cru_value = $('#cru_value').val();
							var cru_value_1 = $('#cru_value_1').val();
							var cru_value_2 = $('#cru_value_2').val();
							var cr_a_1 = $('#cr_a_1').val();
							var cr_a_2 = $('#cr_a_2').val();
							var cr_b_1 = $('#cr_b_1').val();
							var cr_b_2 = $('#cr_b_2').val();
							var cr_c_1 = $('#cr_c_1').val();
							var cr_c_2 = $('#cr_c_2').val();
							break;
					}
					else
					{
						var chk_crushing = "0";	
						var cru_value ="0";
						var cr_sample_crush ="0";
						var cru_value_1 ="0";
						var cr_a_1 ="0";
						var cr_a_2 ="0";
						var cr_b_1 ="0";
						var cr_c_1 ="0";
						var cru_value_2 ="0";
						var cr_b_2 ="0";
						var cr_c_2 ="0";
					}
				}
				
				//mdd omc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mdd")
					{	
						if(document.getElementById('chk_mdd').checked) {
							var chk_mdd = "1";
						}
						else{
							var chk_mdd = "0";
						}					
						//mdd omc
							var wos1 = $('#wos1').val();
							var wos2 = $('#wos2').val();
							var wos4 = $('#wos3').val();
							var wos3 = $('#wos4').val();
							var wos5 = $('#wos5').val();
							var wos6 = $('#wos6').val();
							
							var wad1 = $('#wad1').val();
							var wad2 = $('#wad2').val();
							var wad3 = $('#wad3').val();
							var wad4 = $('#wad4').val();
							var wad5 = $('#wad5').val();
							var wad6 = $('#wad6').val();
							
							var wra1 = $('#wra1').val();
							var wra2 = $('#wra2').val();
							var wra3 = $('#wra3').val();
							var wra4 = $('#wra4').val();
							var wra5 = $('#wra5').val();
							var wra6 = $('#wra6').val();
							
							var wmc1 = $('#wmc1').val();
							var wmc2 = $('#wmc2').val();
							var wmc3 = $('#wmc3').val();
							var wmc4 = $('#wmc4').val();
							var wmc5 = $('#wmc5').val();
							var wmc6 = $('#wmc6').val();
							
							var wms1 = $('#wms1').val();
							var wms2 = $('#wms2').val();
							var wms3 = $('#wms3').val();
							var wms4 = $('#wms4').val();
							var wms5 = $('#wms5').val();
							var wms6 = $('#wms6').val();
							
							
							
							var bd1 = $('#bd1').val();
							var bd2 = $('#bd2').val();
							var bd3 = $('#bd3').val();
							var bd4 = $('#bd4').val();
							var bd5 = $('#bd5').val();
							var bd6 = $('#bd6').val();
							
							var cnm1 = $('#cnm1').val();
							var cnm2 = $('#cnm2').val();
							var cnm3 = $('#cnm3').val();
							var cnm4 = $('#cnm4').val();
							var cnm5 = $('#cnm5').val();
							var cnm6 = $('#cnm6').val();
							
							var ww31 = $('#ww31').val();
							var ww32 = $('#ww32').val();
							var ww33 = $('#ww33').val();
							var ww34 = $('#ww34').val();
							var ww35 = $('#ww35').val();
							var ww36 = $('#ww36').val();
							
							
							var wd41 = $('#wd41').val();
							var wd42 = $('#wd42').val();
							var wd43 = $('#wd43').val();
							var wd44 = $('#wd44').val();
							var wd45 = $('#wd45').val();
							var wd46 = $('#wd46').val();
							
							var omc1 = $('#omc1').val();
							var omc2 = $('#omc2').val();
							var omc3 = $('#omc3').val();
							var omc4 = $('#omc4').val();
							var omc5 = $('#omc5').val();
							var omc6 = $('#omc6').val();
							
							var mdd1 = $('#mdd1').val();
							var mdd2 = $('#mdd2').val();
							var mdd3 = $('#mdd3').val();
							var mdd4 = $('#mdd4').val();
							var mdd5 = $('#mdd5').val();
							var mdd6 = $('#mdd6').val();
							
							var mdd = $('#mdd').val();
							var omc = $('#omc').val();
							var cbr = $('#cbr').val();
							var type_compation = $('#type_compation').val();
							var volume = $('#volume').val();
							var empty_mould = $('#empty_mould').val();
							
							var weight_of_sample = $('#weight_of_sample').val();
							
						break;
						}
						else
						{
						
							var chk_mdd = "0";
							var wos1 = "0";
							var wos2 = "0";
							var wos4 = "0";
							var wos3 = "0";
							var wos5 = "0";
							var wos6 = "0";
							
							var wad1 = "0";
							var wad2 = "0";
							var wad3 = "0";
							var wad4 = "0";
							var wad5 = "0";
							var wad6 = "0";
							           
							var wra1 = "0";
							var wra2 = "0";
							var wra3 = "0";
							var wra4 = "0";
							var wra5 = "0";
							var wra6 = "0";
							
							var wmc1 = "0";
							var wmc2 = "0";
							var wmc3 = "0";
							var wmc4 = "0";
							var wmc5 = "0";
							var wmc6 = "0";
							
							var wms1 = "0";
							var wms2 = "0";
							var wms3 = "0";
							var wms4 = "0";
							var wms5 = "0";
							var wms6 = "0";
							
							var bd1 = "0";
							var bd2 = "0";
							var bd3 = "0";
							var bd4 = "0";
							var bd5 = "0";
							var bd6 = "0";
							
							var cnm1 = "0";
							var cnm2 = "0";
							var cnm3 = "0";
							var cnm4 = "0";
							var cnm5 = "0";
							var cnm6 = "0";
							
							var ww31 = "0";
							var ww32 = "0";
							var ww33 = "0";
							var ww34 = "0";
							var ww35 = "0";
							var ww36 = "0";
							
							
							var wd41 = "0";
							var wd42 = "0";
							var wd43 = "0";
							var wd44 = "0";
							var wd45 = "0";
							var wd46 = "0";
							
							var omc1 = "0";
							var omc2 = "0";
							var omc3 = "0";
							var omc4 = "0";
							var omc5 = "0";
							var omc6 = "0";
							
							var mdd1 = "0";
							var mdd2 = "0";
							var mdd3 = "0";
							var mdd4 = "0";
							var mdd5 = "0";
							var mdd6 = "0";
							
							var mdd = "0";
							var omc = "0";
							var cbr = "0";
							var type_compation = "0";
							var volume = "0";
							var empty_mould = "0";
							var weight_of_sample = "0";
							
						}
				
						}
				
				//LIQUIDE LIMIT AND PLASTICITY VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lll")
					{			//ll and pl
								if(document.getElementById('chk_ll').checked) {
									var chk_ll = "1";
								}
								else{
									var chk_ll = "0";
								}
								
								var bo_1 = $('#bo_1').val();
								var bo_2 = $('#bo_2').val();
								var bo_3 = $('#bo_3').val();
								var bo_4 = $('#bo_4').val();
								
								var dep_1 = $('#dep_1').val();
								var dep_2 = $('#dep_2').val();
								var dep_3 = $('#dep_3').val();
								var dep_4 = $('#dep_4').val();
								
								var lab_no_1 = $('#lab_no_1').val();
								var lab_no_2 = $('#lab_no_2').val();
								var lab_no_3 = $('#lab_no_3').val();
								var lab_no_4 = $('#lab_no_4').val();
								
								var con1 = $('#con1').val();
								var con2 = $('#con2').val();
								var con3 = $('#con3').val();
								var con4 = $('#con4').val();
								
								var wws1 = $('#wws1').val();
								var wws2 = $('#wws2').val();
								var wws3 = $('#wws3').val();
								var wws4 = $('#wws4').val();
								
								var wds1 = $('#wds1').val();
								var wds2 = $('#wds2').val();
								var wds3 = $('#wds3').val();
								var wds4 = $('#wds4').val();
								
								var pl1 = $('#pl1').val();
								var pl2 = $('#pl2').val();
								var pl3 = $('#pl3').val();
								
								
								var plastic_limit = $('#plastic_limit').val();
								var pi_value = $('#pi_value').val();
								var liquide_limit = $('#liquide_limit').val();
								var mc1 = $('#mc1').val();
								var blow1 = $('#blow1').val();																						
								var weight_sample_1 = $('#weight_sample_1').val();								
								
							break;
					}
					else
					{
								var chk_ll = "0";	
								var bo_1 =  "0";	
								var bo_2 =  "0";	
								var bo_3 =  "0";	
								var bo_4 =  "0";	
								
								
								var dep_1 = "0";
								var dep_2 = "0";
								var dep_3 = "0";
								var dep_4 = "0";
								
								var lab_no_1 = "0";
								var lab_no_2 = "0";
								var lab_no_3 = "0";
								var lab_no_4 = "0";
								
								var con1 = "0";
								var con2 = "0";
								var con3 = "0";
								var con4 = "0";
								
								var wws1 = "0";
								var wws2 = "0";
								var wws3 = "0";
								var wws4 = "0";
								
								var wds1 = "0";
								var wds2 = "0";
								var wds3 = "0";
								var wds4 = "0";
								
								var pl1 = "0";
								var pl2 = "0";
								var pl3 = "0";
								
								
								var plastic_limit = "0";
								var pi_value = "0";
								var liquide_limit = "0";
								var mc1 = "0";
								var blow1 = "0";
								var weight_sample_1 = "0";
					}
				
				}
				
				
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_grd='+chk_grd+'&sieve_1='+sieve_1+'&sieve_2='+sieve_2+'&sieve_3='+sieve_3+'&sieve_4='+sieve_4+'&sieve_5='+sieve_5+'&sieve_6='+sieve_6+'&sieve_7='+sieve_7+'&cum_wt_gm_1='+cum_wt_gm_1+'&cum_wt_gm_2='+cum_wt_gm_2+'&cum_wt_gm_3='+cum_wt_gm_3+'&cum_wt_gm_4='+cum_wt_gm_4+'&cum_wt_gm_5='+cum_wt_gm_5+'&cum_wt_gm_6='+cum_wt_gm_6+'&cum_wt_gm_7='+cum_wt_gm_7+'&ret_wt_gm_1='+ret_wt_gm_1+'&ret_wt_gm_2='+ret_wt_gm_2+'&ret_wt_gm_3='+ret_wt_gm_3+'&ret_wt_gm_4='+ret_wt_gm_4+'&ret_wt_gm_5='+ret_wt_gm_5+'&ret_wt_gm_6='+ret_wt_gm_6+'&ret_wt_gm_7='+ret_wt_gm_7+'&cum_ret_1='+cum_ret_1+'&cum_ret_2='+cum_ret_2+'&cum_ret_3='+cum_ret_3+'&cum_ret_4='+cum_ret_4+'&cum_ret_5='+cum_ret_5+'&cum_ret_6='+cum_ret_6+'&cum_ret_7='+cum_ret_7+'&pass_sample_1='+pass_sample_1+'&pass_sample_2='+pass_sample_2+'&pass_sample_3='+pass_sample_3+'&pass_sample_4='+pass_sample_4+'&pass_sample_5='+pass_sample_5+'&pass_sample_6='+pass_sample_6+'&pass_sample_7='+pass_sample_7+'&blank_extra='+blank_extra+'&sample_taken='+sample_taken+'&chk_strip='+chk_strip+'&stripping_value='+stripping_value+'&chk_alkali='+chk_alkali+'&alkali_value='+alkali_value+'&chk_fines='+chk_fines+'&fines_value='+fines_value+'&chk_abr='+chk_abr+'&abr_index='+abr_index+'&abr_sample_abr='+abr_sample_abr+'&abr_wt_t_a_1='+abr_wt_t_a_1+'&abr_wt_t_b_1='+abr_wt_t_b_1+'&abr_wt_t_c_1='+abr_wt_t_c_1+'&chk_sp='+chk_sp+'&sp_sample_ca='+sp_sample_ca+'&sp_w_b_a1_1='+sp_w_b_a1_1+'&sp_w_b_a2_1='+sp_w_b_a2_1+'&sp_w_sur_1='+sp_w_sur_1+'&sp_w_sur_2='+sp_w_sur_2+'&sp_w_s_1='+sp_w_s_1+'&sp_w_s_2='+sp_w_s_2+'&sp_w_b_a1_2='+sp_w_b_a1_2+'&sp_w_b_a2_2='+sp_w_b_a2_2+'&sp_wt_st_1='+sp_wt_st_1+'&sp_wt_st_2='+sp_wt_st_2+'&sp_specific_gravity='+sp_specific_gravity+'&sp_specific_gravity_1='+sp_specific_gravity_1+'&sp_specific_gravity_2='+sp_specific_gravity_2+'&sp_water_abr='+sp_water_abr+'&sp_water_abr_1='+sp_water_abr_1+'&sp_water_abr_2='+sp_water_abr_2+'&chk_impact='+chk_impact+'&imp_w_m_a_1='+imp_w_m_a_1+'&imp_w_m_a_2='+imp_w_m_a_2+'&imp_w_m_b_1='+imp_w_m_b_1+'&imp_w_m_b_2='+imp_w_m_b_2+'&imp_w_m_c_1='+imp_w_m_c_1+'&imp_w_m_c_2='+imp_w_m_c_2+'&imp_value_1='+imp_value_1+'&imp_value_2='+imp_value_2+'&imp_value='+imp_value+'&chk_flk='+chk_flk+'&fi_index='+fi_index+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&a4='+a4+'&a5='+a5+'&a6='+a6+'&a7='+a7+'&a8='+a8+'&a9='+a9+'&suma='+suma+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&b4='+b4+'&b5='+b5+'&b6='+b6+'&b7='+b7+'&b8='+b8+'&b9='+b9+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&c7='+c7+'&c8='+c8+'&c9='+c9+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&d4='+d4+'&d5='+d5+'&d6='+d6+'&d7='+d7+'&d8='+d8+'&d9='+d9+'&e1='+e1+'&e2='+e2+'&e3='+e3+'&e4='+e4+'&e5='+e5+'&e6='+e6+'&e7='+e7+'&e8='+e8+'&e9='+e9+'&chk_f1='+chk_f1+'&chk_f2='+chk_f2+'&chk_f3='+chk_f3+'&chk_f4='+chk_f4+'&chk_f5='+chk_f5+'&chk_f6='+chk_f6+'&chk_f7='+chk_f7+'&chk_f8='+chk_f8+'&chk_f9='+chk_f9+'&s11='+s11+'&s12='+s12+'&s13='+s13+'&s14='+s14+'&s15='+s15+'&s16='+s16+'&s17='+s17+'&s18='+s18+'&s19='+s19+'&ei_index='+ei_index+'&aa1='+aa1+'&aa2='+aa2+'&aa3='+aa3+'&aa4='+aa4+'&aa5='+aa5+'&aa6='+aa6+'&aa7='+aa7+'&aa8='+aa8+'&aa9='+aa9+'&bb1='+bb1+'&bb2='+bb2+'&bb3='+bb3+'&bb4='+bb4+'&bb5='+bb5+'&bb6='+bb6+'&bb7='+bb7+'&bb8='+bb8+'&bb9='+bb9+'&dd1='+dd1+'&dd2='+dd2+'&dd3='+dd3+'&dd4='+dd4+'&dd5='+dd5+'&dd6='+dd6+'&dd7='+dd7+'&dd8='+dd8+'&dd9='+dd9+'&combined_index='+combined_index+'&p1='+p1+'&p2='+p2+'&p3='+p3+'&p4='+p4+'&p5='+p5+'&p6='+p6+'&p7='+p7+'&p8='+p8+'&p9='+p9+'&soundness='+soundness+'&w1='+w1+'&w2='+w2+'&wsum='+wsum+'&ga1='+ga1+'&ga2='+ga2+'&gasum='+gasum+'&gb1='+gb1+'&gb2='+gb2+'&gbsum='+gbsum+'&gc1='+gc1+'&gc2='+gc2+'&gcsum='+gcsum+'&gd1='+gd1+'&gd2='+gd2+'&gdsum='+gdsum+'&ge1='+ge1+'&ge2='+ge2+'&gesum='+gesum+'&s1='+s1+'&s2='+s2+'&chk_sp='+chk_sp+'&chk_sou='+chk_sou+'&chk_grd='+chk_grd+'&chk_wp='+chk_wp+'&chk_a='+chk_a+'&chk_b='+chk_b+'&chk_c='+chk_c+'&chk_d='+chk_d+'&chk_e='+chk_e+'&chk_crushing='+chk_crushing+'&cru_value='+cru_value+'&cr_sample_crush='+cr_sample_crush+'&cr_a_1='+cr_a_1+'&cr_a_2='+cr_a_2+'&cr_b_1='+cr_b_1+'&cr_b_2='+cr_b_2+'&cr_c_1='+cr_c_1+'&cr_c_2='+cr_c_2+'&cru_value_1='+cru_value_1+'&cru_value_2='+cru_value_2+'&sound_sample='+sound_sample+'&imp_w_m_d_1='+imp_w_m_d_1+'&imp_w_m_d_2='+imp_w_m_d_2+'&abr_grading='+abr_grading+'&abr_weight_charge='+abr_weight_charge+'&abr_num_revo='+abr_num_revo+'&abr_sphere='+abr_sphere+'&sp_temp='+sp_temp+'&f_a_1='+f_a_1+'&f_a_2='+f_a_2+'&f_b_1='+f_b_1+'&f_b_2='+f_b_2+'&f_c_1='+f_c_1+'&f_c_2='+f_c_2+'&f_d_1='+f_d_1+'&f_d_2='+f_d_2+'&f_e_1='+f_e_1+'&f_e_2='+f_e_2+'&abr_wt_t_a_2='+abr_wt_t_a_2+'&abr_wt_t_b_2='+abr_wt_t_b_2+'&abr_wt_t_c_2='+abr_wt_t_c_2+'&chk_den='+chk_den+'&den_volume='+den_volume+'&den_lab_1='+den_lab_1+'&den_lab_2='+den_lab_2+'&ov_1='+ov_1+'&v1='+v1+'&v2='+v2+'&wt1='+wt1+'&wt2='+wt2+'&wm1='+wm1+'&wm2='+wm2+'&ws1='+ws1+'&ws2='+ws2+'&bdl1='+bdl1+'&bdl2='+bdl2+'&bdc1='+bdc1+'&bdc2='+bdc2+'&bdl='+bdl+'&bdc='+bdc+'&chk_ll='+chk_ll+'&dep_1='+dep_1+'&dep_2='+dep_2+'&dep_3='+dep_3+'&dep_4='+dep_4+'&lab_no_1='+lab_no_1+'&lab_no_2='+lab_no_2+'&lab_no_3='+lab_no_3+'&lab_no_4='+lab_no_4+'&bo_1='+bo_1+'&bo_2='+bo_2+'&bo_3='+bo_3+'&bo_4='+bo_4+'&con1='+con1+'&con2='+con2+'&con3='+con3+'&con4='+con4+'&wws1='+wws1+'&wws2='+wws2+'&wws3='+wws3+'&wws4='+wws4+'&wds1='+wds1+'&wds2='+wds2+'&wds3='+wds3+'&wds4='+wds4+'&pl1='+pl1+'&pl2='+pl2+'&pl3='+pl3+'&plastic_limit='+plastic_limit+'&pi_value='+pi_value+'&weight_sample_1='+weight_sample_1+'&blow1='+blow1+'&mc1='+mc1+'&liquide_limit='+liquide_limit+'&chk_mdd='+chk_mdd+'&mdd='+mdd+'&omc='+omc+'&cbr='+cbr+'&volume='+volume+'&type_compation='+type_compation+'&empty_mould='+empty_mould+'&weight_of_sample='+weight_of_sample+'&wos1='+wos1+'&wos2='+wos2+'&wos3='+wos3+'&wos4='+wos4+'&wos5='+wos5+'&wos6='+wos6+'&wad1='+wad1+'&wad2='+wad2+'&wad3='+wad3+'&wad4='+wad4+'&wad5='+wad5+'&wad6='+wad6+'&wra1='+wra1+'&wra2='+wra2+'&wra3='+wra3+'&wra4='+wra4+'&wra5='+wra5+'&wra6='+wra6+'&wmc1='+wmc1+'&wmc2='+wmc2+'&wmc3='+wmc3+'&wmc4='+wmc4+'&wmc5='+wmc5+'&wmc6='+wmc6+'&bd1='+bd1+'&bd2='+bd2+'&bd3='+bd3+'&bd4='+bd4+'&bd5='+bd5+'&bd6='+bd6+'&cnm1='+cnm1+'&cnm2='+cnm2+'&cnm3='+cnm3+'&cnm4='+cnm4+'&cnm5='+cnm5+'&cnm6='+cnm6+'&ww31='+ww31+'&ww32='+ww32+'&ww33='+ww33+'&ww34='+ww34+'&ww35='+ww35+'&ww36='+ww36+'&wd41='+wd41+'&wd42='+wd42+'&wd43='+wd43+'&wd44='+wd44+'&wd45='+wd45+'&wd46='+wd46+'&omc1='+omc1+'&omc2='+omc2+'&omc3='+omc3+'&omc4='+omc4+'&omc5='+omc5+'&omc6='+omc6+'&mdd1='+mdd1+'&mdd2='+mdd2+'&mdd3='+mdd3+'&mdd4='+mdd4+'&mdd5='+mdd5+'&mdd6='+mdd6+'&sou_size1='+sou_size1+'&sou_size2='+sou_size2+'&wms1='+wms1+'&wms2='+wms2+'&wms3='+wms3+'&wms4='+wms4+'&wms5='+wms5+'&wms6='+wms6+'&strip_1='+strip_1+'&strip_2='+strip_2+'&strip_3='+strip_3+'&strip_4='+strip_4+'&strip_5='+strip_5+'&strip_21='+strip_21+'&strip_22='+strip_22+'&strip_23='+strip_23+'&strip_24='+strip_24+'&strip_25='+strip_25+'&strip_31='+strip_31+'&strip_32='+strip_32+'&strip_33='+strip_33+'&strip_34='+strip_34+'&strip_35='+strip_35;
					
	}
	else if (type == 'edit'){
		var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
													
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
						
						//GRADATION DATA FETCH
						var sieve_1="53.00";	
						var sieve_2="26.50";	
						var sieve_3="22.40";	
						var sieve_4="13.20";	
						var sieve_5="5.60";	
						var sieve_6="2.80";	
						var sieve_7="Pan";	
						var sample_taken = $('#sample_taken').val();
						var blank_extra = $('#blank_extra').val();
						
						var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
						var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
						var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
						var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
						var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
						var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
						var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
														
						var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
						var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
						var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
						var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
						var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
						var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
						var ret_wt_gm_7 = $('#ret_wt_gm_7').val();
						
						var cum_ret_1 = $('#cum_ret_1').val();
						var cum_ret_2 = $('#cum_ret_2').val();
						var cum_ret_3 = $('#cum_ret_3').val();
						var cum_ret_4 = $('#cum_ret_4').val();
						var cum_ret_5 = $('#cum_ret_5').val();
						var cum_ret_6 = $('#cum_ret_6').val();
						var cum_ret_7 = $('#cum_ret_7').val();
						
						var pass_sample_1 = $('#pass_sample_1').val();
						var pass_sample_2 = $('#pass_sample_2').val();
						var pass_sample_3 = $('#pass_sample_3').val();
						var pass_sample_4 = $('#pass_sample_4').val();
						var pass_sample_5 = $('#pass_sample_5').val();
						var pass_sample_6 = $('#pass_sample_6').val();
						var pass_sample_7 = $('#pass_sample_7').val();
						break;
					}
					else
					{
						var chk_grd = "0";	
						var cum_wt_gm_1 ="0";
						var cum_wt_gm_2 ="0";
						var cum_wt_gm_3 ="0";
						var cum_wt_gm_4 ="0";
						var cum_wt_gm_5 ="0";
						var cum_wt_gm_6 ="0";
						var cum_wt_gm_7 ="0";
						
						var ret_wt_gm_1 ="0";
						var ret_wt_gm_2 ="0";
						var ret_wt_gm_3 ="0";
						var ret_wt_gm_4 ="0";
						var ret_wt_gm_5 ="0";
						var ret_wt_gm_6 ="0";
						var ret_wt_gm_7 ="0";
						
						
						var cum_ret_1 ="0";
						var cum_ret_2 ="0";
						var cum_ret_3 ="0";
						var cum_ret_4 ="0";
						var cum_ret_5 ="0";
						var cum_ret_6 ="0";
						var cum_ret_7 ="0";
					   
						var pass_sample_1 ="0";
						var pass_sample_2 ="0";
						var pass_sample_3 ="0";
						var pass_sample_4 ="0";
						var pass_sample_5 ="0";
						var pass_sample_6 ="0";
						var pass_sample_7 ="0";
					  
						 var blank_extra ="0";
						 var sample_taken ="0";
					}
														
				}
				
 				//IMPACT
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="imp")
					{
						
							if(document.getElementById('chk_impact').checked) {
									var chk_impact = "1";
							}
							else{
									var chk_impact = "0";
							}
							//impact value-3
							var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
							var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
							var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
							var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
							var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
							var imp_w_m_c_2 = $('#imp_w_m_c_2').val();
							var imp_value_1 = $('#imp_value_1').val();
							var imp_value_2 = $('#imp_value_2').val();
							var imp_w_m_d_1 = $('#imp_w_m_d_1').val();
							var imp_w_m_d_2 = $('#imp_w_m_d_2').val();
							var imp_value = $('#imp_value').val();
							break;
					}
					else
					{
						var chk_impact = "0";	
						var imp_value ="0";
						var imp_value_1 ="0";
						var imp_value_2 ="0";
						var imp_w_m_a_1 ="0";
						var imp_w_m_b_1 ="0";
						var imp_w_m_c_1 ="0";
						var imp_w_m_d_1 ="0";
						var imp_w_m_a_2 ="0";
						var imp_w_m_b_2 ="0";
						var imp_w_m_c_2 ="0";
						var imp_w_m_d_2 ="0";
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
						
							var den_volume = $('#den_volume').val();
							var den_lab_1 = $('#den_lab_1').val();
							var den_lab_2 = $('#den_lab_2').val();
							var ov_1 = $('#ov_1').val();
							var ov_2 = $('#ov_2').val();
							var v1 = $('#v1').val();
							var v2 = $('#v2').val();
							var wt1 = $('#wt1').val();
							var wt2 = $('#wt2').val();
							var wm1 = $('#wm1').val();
							var wm2 = $('#wm2').val();
							var ws1 = $('#ws1').val();
							var ws2 = $('#ws2').val();
							var bdl1 = $('#bdl1').val();
							var bdl2 = $('#bdl2').val();
							var bdc1 = $('#bdc1').val();
							var bdc2 = $('#bdc2').val();
							var bdl = $('#bdl').val();
							var bdc = $('#bdc').val();
							break;
					}
					else
					{
						var chk_den = "0";	
						var den_volume = "0";
						var den_lab_1 = "0";
						var den_lab_2 = "0";
						var ov_1 = "0";
						var ov_2 = "0";
						var v1 = "0";
						var v2 = "0";
						var wt1 = "0";
						var wt2 = "0";
						var wm1 = "0";
						var wm2 = "0";
						var ws1 = "0";
						var ws2 = "0";
						var bdl1 = "0";
						var bdl2 = "0";
						var bdc1 = "0";
						var bdc2 = "0";
						var bdl = "0";
						var bdc = "0";
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
						var sp_w_b_a1_1 = $('#sp_w_b_a1_1').val();			
						var sp_w_b_a1_2 = $('#sp_w_b_a1_2').val();			
						var sp_w_b_a2_1 = $('#sp_w_b_a2_1').val();			
						var sp_w_b_a2_2 = $('#sp_w_b_a2_2').val();				
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
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_w_b_a1_1 ="0";
						var sp_w_b_a2_1 ="0";
						var sp_w_sur_1 ="0";
						var sp_w_s_1 ="0";
						var sp_wt_st_1 ="0";						
						var sp_w_b_a1_2 ="0";
						var sp_w_b_a2_2 ="0";
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
					}
				
				}
				
				//ABRASION VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abr")
					{
						if(document.getElementById('chk_abr').checked) {
							var chk_abr = "1";
							}
							else{
								var chk_abr = "0";
							}
						//Abrasion-2
						var abr_index = $('#abr_index').val();
						var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
						var abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
						var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
						var abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
						var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
						var abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();
						var abr_sample_abr = $('#abr_sample_abr').val();
						var abr_grading = $('#abr_grading').val();
						var abr_num_revo = $('#abr_num_revo').val();
						var abr_weight_charge = $('#abr_weight_charge').val();
						var abr_sphere = $('#abr_sphere').val();		
						break;
					}
					else
					{
						var chk_abr = "0";	
						var abr_sample_abr ="0";
						var abr_wt_t_a_1 ="0";
						var abr_wt_t_b_1 ="0";
						var abr_wt_t_c_1 ="0";
						var abr_wt_t_a_2 ="0";
						var abr_wt_t_b_2 ="0";
						var abr_grading ="0";
						var abr_wt_t_c_2 ="0";
						var abr_index ="0";
						var abr_sphere ="0";
						var abr_num_revo ="0";
						var abr_weight_charge ="0";
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
							
							
								var chk_wp = "0";
							
								var chk_a = "0";
							
								var chk_b = "0";
							
								var chk_c = "0";
							
								var chk_d = "0";
							
								var chk_e = "0";
						
							var soundness = $('#soundness').val();	
							var sou_size1 = $('#sou_size1').val();	
							var sou_size2 = $('#sou_size2').val();	
							var w1= $('#w1').val();	
							var w2= $('#w2').val();	
							var wsum= $('#wsum').val();	
							var ga1 = $('#ga1').val();	
							var ga2 = $('#ga2').val();	
							var gasum = $('#gasum').val();	
							var gb1 = $('#gb1').val();
							var gb2 = $('#gb2').val();
							var gbsum = $('#gbsum').val();
							var gc1 = $('#gc1').val();
							var gc2 = $('#gc2').val();
							var gcsum = $('#gcsum').val();
							var gd1 = $('#gd1').val();
							var gd2 = $('#gd2').val();
							var gdsum = $('#gdsum').val();
							var ge1 = $('#ge1').val();
							var ge2 = $('#ge2').val();
							var gesum = $('#gesum').val();
							var s1 = $('#s1').val();
							var s2 = $('#s2').val();
							var sample_id = $('#sample_id').val();
							var sound_sample = $('#sound_sample').val();
							break;
					}
					else
					{
						var chk_sou = "0";	
						var soundness ="0";			
						var sound_sample ="0";			
						var sample_id ="0";			
						
						var sou_size1 ="0";			
						var sou_size2 ="0";			
						var w1 ="0";			
						var w2 ="0";			
						var wsum ="0";			
						
						var ga1 ="0";			
						var ga2 ="0";			
						var gasum ="0";			
						
						var gb1 ="0";			
						var gb2 ="0";			
						var gbsum ="0";			
						
						var gc1 ="0";			
						var gc2 ="0";			
						var gcsum ="0";			
						
						var gd1 ="0";			
						var gd2 ="0";			
						var gdsum ="0";			
						
						var ge1 ="0";			
						var ge2 ="0";			
						var gesum ="0";			
						
						var s1 ="0";			
						var s2  ="0";
					}
				
				}
			
			
			
			
				//FLAKINESS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flk")
					{	
								if(document.getElementById('chk_f1').checked) {
									var chk_f1 = "1";
								}
								else{
									var chk_f1 = "0";
								}
								
								if(document.getElementById('chk_f2').checked) {
									var chk_f2 = "1";
								}
								else{
									var chk_f2 = "0";
								}
								
								if(document.getElementById('chk_f3').checked) {
									var chk_f3 = "1";
								}
								else{
									var chk_f3 = "0";
								}
								
								if(document.getElementById('chk_f4').checked) {
									var chk_f4 = "1";
								}
								else{
									var chk_f4 = "0";
								}
								
								
								if(document.getElementById('chk_f5').checked) {
									var chk_f5 = "1";
								}
								else{
									var chk_f5 = "0";
								}


								if(document.getElementById('chk_f6').checked) {
									var chk_f6 = "1";
								}
								else{
									var chk_f6 = "0";
								}

								if(document.getElementById('chk_f7').checked) {
									var chk_f7 = "1";
								}
								else{
									var chk_f7 = "0";
								}
								
								if(document.getElementById('chk_f8').checked) {
									var chk_f8 = "1";
								}
								else{
									var chk_f8 = "0";
								}

								if(document.getElementById('chk_f9').checked) {
									var chk_f9 = "1";
								}
								else{
									var chk_f9 = "0";
								}
								
								if(document.getElementById('chk_flk').checked) {
									var chk_flk = "1";
								}
								else{
									var chk_flk = "0";
												
								}
							//Flakiness INDEX
							var p1 = $('#p1').val();
							var p2 = $('#p2').val();
							var p3 = $('#p3').val();
							var p4 = $('#p4').val();
							var p5 = $('#p5').val();
							var p6 = $('#p6').val();
							var p7 = $('#p7').val();
							var p8 = $('#p8').val();
							var p9 = $('#p9').val();
						
							var fi_index = $('#fi_index').val();
							var a1 = $('#a1').val();
							var a2 = $('#a2').val();
							var a3 = $('#a3').val();
							var a4 = $('#a4').val();
							var a5 = $('#a5').val();
							var a6 = $('#a6').val();
							var a7 = $('#a7').val();
							var a8 = $('#a8').val();
							var a9 = $('#a9').val();
							var suma = $('#suma').val();
							
							var b1 = $('#b1').val();
							var b2 = $('#b2').val();
							var b3 = $('#b3').val();
							var b4 = $('#b4').val();
							var b5 = $('#b5').val();				
							var b6 = $('#b6').val();				
							var b7 = $('#b7').val();				
							var b8 = $('#b8').val();				
							var b9 = $('#b9').val();				
							
							var c1 = $('#c1').val();
							var c2 = $('#c2').val();
							var c3 = $('#c3').val();
							var c4 = $('#c4').val();
							var c5 = $('#c5').val();
							var c6 = $('#c6').val();
							var c7 = $('#c7').val();
							var c8 = $('#c8').val();
							var c9 = $('#c9').val();
							
							var d1 = $('#d1').val();
							var d2 = $('#d2').val();
							var d3 = $('#d3').val();
							var d4 = $('#d4').val();
							var d5 = $('#d5').val();
							var d6 = $('#d6').val();
							var d7 = $('#d7').val();
							var d8 = $('#d8').val();
							var d9 = $('#d9').val();
							
							var e1 = $('#e1').val();
							var e2 = $('#e2').val();
							var e3 = $('#e3').val();
							var e4 = $('#e4').val();
							var e5 = $('#e5').val();
							var e6 = $('#e6').val();
							var e7 = $('#e7').val();
							var e8 = $('#e8').val();
							var e9 = $('#e9').val();
							
							var ei_index = $('#ei_index').val();
							var aa1 = $('#aa1').val();
							var aa2 = $('#aa2').val();
							var aa3 = $('#aa3').val();
							var aa4 = $('#aa4').val();
							var aa5 = $('#aa5').val();
							var aa6 = $('#aa6').val();
							var aa7 = $('#aa7').val();
							var aa8 = $('#aa8').val();
							var aa9 = $('#aa9').val();
							
							
							var bb1 = $('#bb1').val();
							var bb2 = $('#bb2').val();
							var bb3 = $('#bb3').val();
							var bb4 = $('#bb4').val();
							var bb5 = $('#bb5').val();
							var bb6 = $('#bb6').val();
							var bb7 = $('#bb7').val();
							var bb8 = $('#bb8').val();
							var bb9 = $('#bb9').val();
							
							var dd1 = $('#dd1').val();
							var dd2 = $('#dd2').val();
							var dd3 = $('#dd3').val();
							var dd4 = $('#dd4').val();
							var dd5 = $('#dd5').val();
							var dd6 = $('#dd6').val();
							var dd7 = $('#dd7').val();
							var dd8 = $('#dd8').val();
							var dd9 = $('#dd9').val();
							
							
							var s11 = $('#s11').val();
							var s12 = $('#s12').val();
							var s13 = $('#s13').val();
							var s14 = $('#s14').val();
							var s15 = $('#s15').val();
							var s16 = $('#s16').val();
							var s17 = $('#s17').val();
							var s18 = $('#s18').val();
							var s19 = $('#s19').val();
							
							var combined_index = $('#combined_index').val();
							break;
					}
					else
					{
						var chk_flk = "0";	
						var chk_f1 = "0";
						var chk_f2 = "0";
						var chk_f3 = "0";
						var chk_f4 = "0";
						var chk_f5 = "0";
						var chk_f6 = "0";
						var chk_f7 = "0";
						var chk_f8 = "0";
						var chk_f9 = "0";
						var fi_index ="0";
						var ei_index ="0";
						var combined_index ="0";
						
						var p1 ="0";
						var p2 ="0";
						var p3 ="0";
						var p4 ="0";
						var p5 ="0";
						var p6 ="0";
						var p7 ="0";
						var p8 ="0";
						var p9 ="0";
						 
						var a1 ="0";
						var a2 ="0";
						var a3 ="0";
						var a4 ="0";
						var a5 ="0";
						var a6 ="0";
						var a7 ="0";
						var a8 ="0";
						var a9 ="0";
						var suma ="0";
												
						var b1 ="0";
						var b2 ="0";
						var b3 ="0";
						var b4 ="0";
						var b5 ="0";
						var b6 ="0";
						var b7 ="0";
						var b8 ="0";
						var b9 ="0";
												
						var c1 ="0";
						var c2 ="0";
						var c3 ="0";
						var c4 ="0";
						var c5 ="0";
						var c6 ="0";
						var c7 ="0";
						var c8 ="0";
						var c9 ="0";
												
						var d1 ="0";
						var d2 ="0";
						var d3 ="0";
						var d4 ="0";
						var d5 ="0";
						var d6 ="0";
						var d7 ="0";
						var d8 ="0";
						var d9 ="0";
						
						var e1 ="0";
						var e2 ="0";
						var e3 ="0";
						var e4 ="0";
						var e5 ="0";
						var e6 ="0";
						var e7 ="0";
						var e8 ="0";
						var e9 ="0";
												
						var aa1 ="0";
						var aa2 ="0";
						var aa3 ="0";
						var aa4 ="0";
						var aa5 ="0";
						var aa6 ="0";
						var aa7 ="0";
						var aa8 ="0";
						var aa9 ="0";
						
						var bb1 ="0";	
						var bb2 ="0";
						var bb3 ="0";
						var bb4 ="0";
						var bb5 ="0";
						var bb6 ="0";
						var bb7 ="0";
						var bb8 ="0";
						var bb9 ="0";
						
						var dd1 ="0";
						var dd2 ="0";			
						var dd3 ="0";
						var dd4 ="0";
						var dd5 ="0";
						var dd6 ="0";
						var dd7 ="0";
						var dd8 ="0";
						var dd9 ="0";	
						
						var s11 = "";
						var s12 = "";
						var s13 = "";
						var s14 = "";
						var s15 = "";
						var s16 = "";
						var s17 = "";
						var s18 = "";
						var s19 = "";
					}
				
				}
				 
				 //STRIPPING VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="str")
					{						
							if(document.getElementById('chk_strip').checked) {
									var chk_strip = "1";
								}
								else{
									var chk_strip = "0";
								}
								var stripping_value = $('#stripping_value').val();
								var strip_1 = $('#strip_1').val();
								var strip_2 = $('#strip_2').val();
								var strip_3 = $('#strip_3').val();
								var strip_4 = $('#strip_4').val();
								var strip_5 = $('#strip_5').val();
								var strip_21 = $('#strip_21').val();
								var strip_22 = $('#strip_22').val();
								var strip_23 = $('#strip_23').val();
								var strip_24 = $('#strip_24').val();
								var strip_25 = $('#strip_25').val();
								var strip_31 = $('#strip_31').val();
								var strip_32 = $('#strip_32').val();
								var strip_33 = $('#strip_33').val();
								var strip_34 = $('#strip_34').val();
								var strip_35 = $('#strip_35').val();
							break;
					}
					else
					{
						var stripping_value = "0";
						var chk_strip = "0";
						var strip_1 = "0";
						var strip_2 = "0";
						var strip_3 = "0";
						var strip_4 = "0";
						var strip_5 = "0";
						var strip_21 = "0";
						var strip_22 = "0";
						var strip_23 = "0";
						var strip_24 = "0";
						var strip_25 = "0";
						var strip_31 = "0";
						var strip_32 = "0";
						var strip_33 = "0";
						var strip_34 = "0";
						var strip_35 = "0";
						
					}	
				}
			
				//FINEVALUES
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{						
							if(document.getElementById('chk_fines').checked) {
									var chk_fines = "1";
								}
								else{
									var chk_fines = "0";
								}
							//alkali strip and fines_value
							var fines_value = $('#fines_value').val();
							var f_a_1 = $('#f_a_1').val();
							var f_a_2 = $('#f_a_2').val();
							var f_b_1 = $('#f_b_1').val();
							var f_b_2 = $('#f_b_2').val();
							var f_c_1 = $('#f_c_1').val();
							var f_c_2 = $('#f_c_2').val();
							var f_d_1 = $('#f_d_1').val();
							var f_d_2 = $('#f_d_2').val();
							var f_e_1 = $('#f_e_1').val();
							var f_e_2 = $('#f_e_2').val();
							break;
					}
					else
					{
						var chk_fines = "0";	
						var fines_value = "0";	
						var f_a_1 = "0";
						var f_a_2 = "0";
						var f_b_1 = "0";
						var f_b_2 = "0";
						var f_c_1 = "0";
						var f_c_2 = "0";
						var f_d_1 = "0";
						var f_d_2 = "0";
						var f_e_1 = "0";
						var f_e_2 = "0";
					}	
				}

				//ALKALI REACTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{						
							if(document.getElementById('chk_alkali').checked) {
									var chk_alkali = "1";
								}
								else{
									var chk_alkali = "0";
								}
							var alkali_value = $('#alkali_value').val();
							break;
					}
					else
					{
						var chk_alkali = "0";	
						var alkali_value = "0";	
					}	
				}

				//CRUSHING
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cru")
					{						
							if(document.getElementById('chk_crushing').checked) {
									var chk_crushing = "1";
								}
								else{
									var chk_crushing = "0";
								}
							//crushing value-4
							var cr_sample_crush = $('#cr_sample_crush').val();
							var cru_value = $('#cru_value').val();
							var cru_value_1 = $('#cru_value_1').val();
							var cru_value_2 = $('#cru_value_2').val();
							var cr_a_1 = $('#cr_a_1').val();
							var cr_a_2 = $('#cr_a_2').val();
							var cr_b_1 = $('#cr_b_1').val();
							var cr_b_2 = $('#cr_b_2').val();
							var cr_c_1 = $('#cr_c_1').val();
							var cr_c_2 = $('#cr_c_2').val();
							break;
					}
					else
					{
						var chk_crushing = "0";	
						var cru_value ="0";
						var cr_sample_crush ="0";
						var cru_value_1 ="0";
						var cr_a_1 ="0";
						var cr_a_2 ="0";
						var cr_b_1 ="0";
						var cr_c_1 ="0";
						var cru_value_2 ="0";
						var cr_b_2 ="0";
						var cr_c_2 ="0";
					}
				}
				
				//mdd omc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mdd")
					{	
						if(document.getElementById('chk_mdd').checked) {
							var chk_mdd = "1";
						}
						else{
							var chk_mdd = "0";
						}					
						//mdd omc
							var wos1 = $('#wos1').val();
							var wos2 = $('#wos2').val();
							var wos4 = $('#wos3').val();
							var wos3 = $('#wos4').val();
							var wos5 = $('#wos5').val();
							var wos6 = $('#wos6').val();
							
							var wad1 = $('#wad1').val();
							var wad2 = $('#wad2').val();
							var wad3 = $('#wad3').val();
							var wad4 = $('#wad4').val();
							var wad5 = $('#wad5').val();
							var wad6 = $('#wad6').val();
							
							var wra1 = $('#wra1').val();
							var wra2 = $('#wra2').val();
							var wra3 = $('#wra3').val();
							var wra4 = $('#wra4').val();
							var wra5 = $('#wra5').val();
							var wra6 = $('#wra6').val();
							
							var wmc1 = $('#wmc1').val();
							var wmc2 = $('#wmc2').val();
							var wmc3 = $('#wmc3').val();
							var wmc4 = $('#wmc4').val();
							var wmc5 = $('#wmc5').val();
							var wmc6 = $('#wmc6').val();
							
							var wms1 = $('#wms1').val();
							var wms2 = $('#wms2').val();
							var wms3 = $('#wms3').val();
							var wms4 = $('#wms4').val();
							var wms5 = $('#wms5').val();
							var wms6 = $('#wms6').val();
							
							
							
							var bd1 = $('#bd1').val();
							var bd2 = $('#bd2').val();
							var bd3 = $('#bd3').val();
							var bd4 = $('#bd4').val();
							var bd5 = $('#bd5').val();
							var bd6 = $('#bd6').val();
							
							var cnm1 = $('#cnm1').val();
							var cnm2 = $('#cnm2').val();
							var cnm3 = $('#cnm3').val();
							var cnm4 = $('#cnm4').val();
							var cnm5 = $('#cnm5').val();
							var cnm6 = $('#cnm6').val();
							
							var ww31 = $('#ww31').val();
							var ww32 = $('#ww32').val();
							var ww33 = $('#ww33').val();
							var ww34 = $('#ww34').val();
							var ww35 = $('#ww35').val();
							var ww36 = $('#ww36').val();
							
							
							var wd41 = $('#wd41').val();
							var wd42 = $('#wd42').val();
							var wd43 = $('#wd43').val();
							var wd44 = $('#wd44').val();
							var wd45 = $('#wd45').val();
							var wd46 = $('#wd46').val();
							
							var omc1 = $('#omc1').val();
							var omc2 = $('#omc2').val();
							var omc3 = $('#omc3').val();
							var omc4 = $('#omc4').val();
							var omc5 = $('#omc5').val();
							var omc6 = $('#omc6').val();
							
							var mdd1 = $('#mdd1').val();
							var mdd2 = $('#mdd2').val();
							var mdd3 = $('#mdd3').val();
							var mdd4 = $('#mdd4').val();
							var mdd5 = $('#mdd5').val();
							var mdd6 = $('#mdd6').val();
							
							var mdd = $('#mdd').val();
							var omc = $('#omc').val();
							var cbr = $('#cbr').val();
							var type_compation = $('#type_compation').val();
							var volume = $('#volume').val();
							var empty_mould = $('#empty_mould').val();
							
							var weight_of_sample = $('#weight_of_sample').val();
							
						break;
						}
						else
						{
						
							var chk_mdd = "0";
							var wos1 = "0";
							var wos2 = "0";
							var wos4 = "0";
							var wos3 = "0";
							var wos5 = "0";
							var wos6 = "0";
							
							var wad1 = "0";
							var wad2 = "0";
							var wad3 = "0";
							var wad4 = "0";
							var wad5 = "0";
							var wad6 = "0";
							           
							var wra1 = "0";
							var wra2 = "0";
							var wra3 = "0";
							var wra4 = "0";
							var wra5 = "0";
							var wra6 = "0";
							
							var wmc1 = "0";
							var wmc2 = "0";
							var wmc3 = "0";
							var wmc4 = "0";
							var wmc5 = "0";
							var wmc6 = "0";
							
							var wms1 = "0";
							var wms2 = "0";
							var wms3 = "0";
							var wms4 = "0";
							var wms5 = "0";
							var wms6 = "0";
							
							var bd1 = "0";
							var bd2 = "0";
							var bd3 = "0";
							var bd4 = "0";
							var bd5 = "0";
							var bd6 = "0";
							
							var cnm1 = "0";
							var cnm2 = "0";
							var cnm3 = "0";
							var cnm4 = "0";
							var cnm5 = "0";
							var cnm6 = "0";
							
							var ww31 = "0";
							var ww32 = "0";
							var ww33 = "0";
							var ww34 = "0";
							var ww35 = "0";
							var ww36 = "0";
							
							
							var wd41 = "0";
							var wd42 = "0";
							var wd43 = "0";
							var wd44 = "0";
							var wd45 = "0";
							var wd46 = "0";
							
							var omc1 = "0";
							var omc2 = "0";
							var omc3 = "0";
							var omc4 = "0";
							var omc5 = "0";
							var omc6 = "0";
							
							var mdd1 = "0";
							var mdd2 = "0";
							var mdd3 = "0";
							var mdd4 = "0";
							var mdd5 = "0";
							var mdd6 = "0";
							
							var mdd = "0";
							var omc = "0";
							var cbr = "0";
							var type_compation = "0";
							var volume = "0";
							var empty_mould = "0";
							var weight_of_sample = "0";
							
						}
				
						}
				
				//LIQUIDE LIMIT AND PLASTICITY VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lll")
					{			//ll and pl
								if(document.getElementById('chk_ll').checked) {
									var chk_ll = "1";
								}
								else{
									var chk_ll = "0";
								}
								
								var bo_1 = $('#bo_1').val();
								var bo_2 = $('#bo_2').val();
								var bo_3 = $('#bo_3').val();
								var bo_4 = $('#bo_4').val();
								
								var dep_1 = $('#dep_1').val();
								var dep_2 = $('#dep_2').val();
								var dep_3 = $('#dep_3').val();
								var dep_4 = $('#dep_4').val();
								
								var lab_no_1 = $('#lab_no_1').val();
								var lab_no_2 = $('#lab_no_2').val();
								var lab_no_3 = $('#lab_no_3').val();
								var lab_no_4 = $('#lab_no_4').val();
								
								var con1 = $('#con1').val();
								var con2 = $('#con2').val();
								var con3 = $('#con3').val();
								var con4 = $('#con4').val();
								
								var wws1 = $('#wws1').val();
								var wws2 = $('#wws2').val();
								var wws3 = $('#wws3').val();
								var wws4 = $('#wws4').val();
								
								var wds1 = $('#wds1').val();
								var wds2 = $('#wds2').val();
								var wds3 = $('#wds3').val();
								var wds4 = $('#wds4').val();
								
								var pl1 = $('#pl1').val();
								var pl2 = $('#pl2').val();
								var pl3 = $('#pl3').val();
								
								
								var plastic_limit = $('#plastic_limit').val();
								var pi_value = $('#pi_value').val();
								var liquide_limit = $('#liquide_limit').val();
								var mc1 = $('#mc1').val();
								var blow1 = $('#blow1').val();																						
								var weight_sample_1 = $('#weight_sample_1').val();								
								
							break;
					}
					else
					{
								var chk_ll = "0";	
								var bo_1 =  "0";	
								var bo_2 =  "0";	
								var bo_3 =  "0";	
								var bo_4 =  "0";	
								
								
								var dep_1 = "0";
								var dep_2 = "0";
								var dep_3 = "0";
								var dep_4 = "0";
								
								var lab_no_1 = "0";
								var lab_no_2 = "0";
								var lab_no_3 = "0";
								var lab_no_4 = "0";
								
								var con1 = "0";
								var con2 = "0";
								var con3 = "0";
								var con4 = "0";
								
								var wws1 = "0";
								var wws2 = "0";
								var wws3 = "0";
								var wws4 = "0";
								
								var wds1 = "0";
								var wds2 = "0";
								var wds3 = "0";
								var wds4 = "0";
								
								var pl1 = "0";
								var pl2 = "0";
								var pl3 = "0";
								
								
								var plastic_limit = "0";
								var pi_value = "0";
								var liquide_limit = "0";
								var mc1 = "0";
								var blow1 = "0";
								var weight_sample_1 = "0";
					}
				
				}
				
				
				var idEdit = $('#idEdit').val();
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_grd='+chk_grd+'&sieve_1='+sieve_1+'&sieve_2='+sieve_2+'&sieve_3='+sieve_3+'&sieve_4='+sieve_4+'&sieve_5='+sieve_5+'&sieve_6='+sieve_6+'&sieve_7='+sieve_7+'&cum_wt_gm_1='+cum_wt_gm_1+'&cum_wt_gm_2='+cum_wt_gm_2+'&cum_wt_gm_3='+cum_wt_gm_3+'&cum_wt_gm_4='+cum_wt_gm_4+'&cum_wt_gm_5='+cum_wt_gm_5+'&cum_wt_gm_6='+cum_wt_gm_6+'&cum_wt_gm_7='+cum_wt_gm_7+'&ret_wt_gm_1='+ret_wt_gm_1+'&ret_wt_gm_2='+ret_wt_gm_2+'&ret_wt_gm_3='+ret_wt_gm_3+'&ret_wt_gm_4='+ret_wt_gm_4+'&ret_wt_gm_5='+ret_wt_gm_5+'&ret_wt_gm_6='+ret_wt_gm_6+'&ret_wt_gm_7='+ret_wt_gm_7+'&cum_ret_1='+cum_ret_1+'&cum_ret_2='+cum_ret_2+'&cum_ret_3='+cum_ret_3+'&cum_ret_4='+cum_ret_4+'&cum_ret_5='+cum_ret_5+'&cum_ret_6='+cum_ret_6+'&cum_ret_7='+cum_ret_7+'&pass_sample_1='+pass_sample_1+'&pass_sample_2='+pass_sample_2+'&pass_sample_3='+pass_sample_3+'&pass_sample_4='+pass_sample_4+'&pass_sample_5='+pass_sample_5+'&pass_sample_6='+pass_sample_6+'&pass_sample_7='+pass_sample_7+'&blank_extra='+blank_extra+'&sample_taken='+sample_taken+'&chk_strip='+chk_strip+'&stripping_value='+stripping_value+'&chk_alkali='+chk_alkali+'&alkali_value='+alkali_value+'&chk_fines='+chk_fines+'&fines_value='+fines_value+'&chk_abr='+chk_abr+'&abr_index='+abr_index+'&abr_sample_abr='+abr_sample_abr+'&abr_wt_t_a_1='+abr_wt_t_a_1+'&abr_wt_t_b_1='+abr_wt_t_b_1+'&abr_wt_t_c_1='+abr_wt_t_c_1+'&chk_sp='+chk_sp+'&sp_sample_ca='+sp_sample_ca+'&sp_w_b_a1_1='+sp_w_b_a1_1+'&sp_w_b_a2_1='+sp_w_b_a2_1+'&sp_w_sur_1='+sp_w_sur_1+'&sp_w_sur_2='+sp_w_sur_2+'&sp_w_s_1='+sp_w_s_1+'&sp_w_s_2='+sp_w_s_2+'&sp_w_b_a1_2='+sp_w_b_a1_2+'&sp_w_b_a2_2='+sp_w_b_a2_2+'&sp_wt_st_1='+sp_wt_st_1+'&sp_wt_st_2='+sp_wt_st_2+'&sp_specific_gravity='+sp_specific_gravity+'&sp_specific_gravity_1='+sp_specific_gravity_1+'&sp_specific_gravity_2='+sp_specific_gravity_2+'&sp_water_abr='+sp_water_abr+'&sp_water_abr_1='+sp_water_abr_1+'&sp_water_abr_2='+sp_water_abr_2+'&chk_impact='+chk_impact+'&imp_w_m_a_1='+imp_w_m_a_1+'&imp_w_m_a_2='+imp_w_m_a_2+'&imp_w_m_b_1='+imp_w_m_b_1+'&imp_w_m_b_2='+imp_w_m_b_2+'&imp_w_m_c_1='+imp_w_m_c_1+'&imp_w_m_c_2='+imp_w_m_c_2+'&imp_value_1='+imp_value_1+'&imp_value_2='+imp_value_2+'&imp_value='+imp_value+'&chk_flk='+chk_flk+'&fi_index='+fi_index+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&a4='+a4+'&a5='+a5+'&a6='+a6+'&a7='+a7+'&a8='+a8+'&a9='+a9+'&suma='+suma+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&b4='+b4+'&b5='+b5+'&b6='+b6+'&b7='+b7+'&b8='+b8+'&b9='+b9+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&c7='+c7+'&c8='+c8+'&c9='+c9+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&d4='+d4+'&d5='+d5+'&d6='+d6+'&d7='+d7+'&d8='+d8+'&d9='+d9+'&e1='+e1+'&e2='+e2+'&e3='+e3+'&e4='+e4+'&e5='+e5+'&e6='+e6+'&e7='+e7+'&e8='+e8+'&e9='+e9+'&chk_f1='+chk_f1+'&chk_f2='+chk_f2+'&chk_f3='+chk_f3+'&chk_f4='+chk_f4+'&chk_f5='+chk_f5+'&chk_f6='+chk_f6+'&chk_f7='+chk_f7+'&chk_f8='+chk_f8+'&chk_f9='+chk_f9+'&s11='+s11+'&s12='+s12+'&s13='+s13+'&s14='+s14+'&s15='+s15+'&s16='+s16+'&s17='+s17+'&s18='+s18+'&s19='+s19+'&ei_index='+ei_index+'&aa1='+aa1+'&aa2='+aa2+'&aa3='+aa3+'&aa4='+aa4+'&aa5='+aa5+'&aa6='+aa6+'&aa7='+aa7+'&aa8='+aa8+'&aa9='+aa9+'&bb1='+bb1+'&bb2='+bb2+'&bb3='+bb3+'&bb4='+bb4+'&bb5='+bb5+'&bb6='+bb6+'&bb7='+bb7+'&bb8='+bb8+'&bb9='+bb9+'&dd1='+dd1+'&dd2='+dd2+'&dd3='+dd3+'&dd4='+dd4+'&dd5='+dd5+'&dd6='+dd6+'&dd7='+dd7+'&dd8='+dd8+'&dd9='+dd9+'&combined_index='+combined_index+'&p1='+p1+'&p2='+p2+'&p3='+p3+'&p4='+p4+'&p5='+p5+'&p6='+p6+'&p7='+p7+'&p8='+p8+'&p9='+p9+'&soundness='+soundness+'&w1='+w1+'&w2='+w2+'&wsum='+wsum+'&ga1='+ga1+'&ga2='+ga2+'&gasum='+gasum+'&gb1='+gb1+'&gb2='+gb2+'&gbsum='+gbsum+'&gc1='+gc1+'&gc2='+gc2+'&gcsum='+gcsum+'&gd1='+gd1+'&gd2='+gd2+'&gdsum='+gdsum+'&ge1='+ge1+'&ge2='+ge2+'&gesum='+gesum+'&s1='+s1+'&s2='+s2+'&chk_sp='+chk_sp+'&chk_sou='+chk_sou+'&chk_grd='+chk_grd+'&chk_wp='+chk_wp+'&chk_a='+chk_a+'&chk_b='+chk_b+'&chk_c='+chk_c+'&chk_d='+chk_d+'&chk_e='+chk_e+'&chk_crushing='+chk_crushing+'&cru_value='+cru_value+'&cr_sample_crush='+cr_sample_crush+'&cr_a_1='+cr_a_1+'&cr_a_2='+cr_a_2+'&cr_b_1='+cr_b_1+'&cr_b_2='+cr_b_2+'&cr_c_1='+cr_c_1+'&cr_c_2='+cr_c_2+'&cru_value_1='+cru_value_1+'&cru_value_2='+cru_value_2+'&sound_sample='+sound_sample+'&imp_w_m_d_1='+imp_w_m_d_1+'&imp_w_m_d_2='+imp_w_m_d_2+'&abr_grading='+abr_grading+'&abr_weight_charge='+abr_weight_charge+'&abr_num_revo='+abr_num_revo+'&abr_sphere='+abr_sphere+'&sp_temp='+sp_temp+'&f_a_1='+f_a_1+'&f_a_2='+f_a_2+'&f_b_1='+f_b_1+'&f_b_2='+f_b_2+'&f_c_1='+f_c_1+'&f_c_2='+f_c_2+'&f_d_1='+f_d_1+'&f_d_2='+f_d_2+'&f_e_1='+f_e_1+'&f_e_2='+f_e_2+'&abr_wt_t_a_2='+abr_wt_t_a_2+'&abr_wt_t_b_2='+abr_wt_t_b_2+'&abr_wt_t_c_2='+abr_wt_t_c_2+'&chk_den='+chk_den+'&den_volume='+den_volume+'&den_lab_1='+den_lab_1+'&den_lab_2='+den_lab_2+'&ov_1='+ov_1+'&v1='+v1+'&v2='+v2+'&wt1='+wt1+'&wt2='+wt2+'&wm1='+wm1+'&wm2='+wm2+'&ws1='+ws1+'&ws2='+ws2+'&bdl1='+bdl1+'&bdl2='+bdl2+'&bdc1='+bdc1+'&bdc2='+bdc2+'&bdl='+bdl+'&bdc='+bdc+'&chk_ll='+chk_ll+'&dep_1='+dep_1+'&dep_2='+dep_2+'&dep_3='+dep_3+'&dep_4='+dep_4+'&lab_no_1='+lab_no_1+'&lab_no_2='+lab_no_2+'&lab_no_3='+lab_no_3+'&lab_no_4='+lab_no_4+'&bo_1='+bo_1+'&bo_2='+bo_2+'&bo_3='+bo_3+'&bo_4='+bo_4+'&con1='+con1+'&con2='+con2+'&con3='+con3+'&con4='+con4+'&wws1='+wws1+'&wws2='+wws2+'&wws3='+wws3+'&wws4='+wws4+'&wds1='+wds1+'&wds2='+wds2+'&wds3='+wds3+'&wds4='+wds4+'&pl1='+pl1+'&pl2='+pl2+'&pl3='+pl3+'&plastic_limit='+plastic_limit+'&pi_value='+pi_value+'&weight_sample_1='+weight_sample_1+'&blow1='+blow1+'&mc1='+mc1+'&liquide_limit='+liquide_limit+'&chk_mdd='+chk_mdd+'&mdd='+mdd+'&omc='+omc+'&cbr='+cbr+'&volume='+volume+'&type_compation='+type_compation+'&empty_mould='+empty_mould+'&weight_of_sample='+weight_of_sample+'&wos1='+wos1+'&wos2='+wos2+'&wos3='+wos3+'&wos4='+wos4+'&wos5='+wos5+'&wos6='+wos6+'&wad1='+wad1+'&wad2='+wad2+'&wad3='+wad3+'&wad4='+wad4+'&wad5='+wad5+'&wad6='+wad6+'&wra1='+wra1+'&wra2='+wra2+'&wra3='+wra3+'&wra4='+wra4+'&wra5='+wra5+'&wra6='+wra6+'&wmc1='+wmc1+'&wmc2='+wmc2+'&wmc3='+wmc3+'&wmc4='+wmc4+'&wmc5='+wmc5+'&wmc6='+wmc6+'&bd1='+bd1+'&bd2='+bd2+'&bd3='+bd3+'&bd4='+bd4+'&bd5='+bd5+'&bd6='+bd6+'&cnm1='+cnm1+'&cnm2='+cnm2+'&cnm3='+cnm3+'&cnm4='+cnm4+'&cnm5='+cnm5+'&cnm6='+cnm6+'&ww31='+ww31+'&ww32='+ww32+'&ww33='+ww33+'&ww34='+ww34+'&ww35='+ww35+'&ww36='+ww36+'&wd41='+wd41+'&wd42='+wd42+'&wd43='+wd43+'&wd44='+wd44+'&wd45='+wd45+'&wd46='+wd46+'&omc1='+omc1+'&omc2='+omc2+'&omc3='+omc3+'&omc4='+omc4+'&omc5='+omc5+'&omc6='+omc6+'&mdd1='+mdd1+'&mdd2='+mdd2+'&mdd3='+mdd3+'&mdd4='+mdd4+'&mdd5='+mdd5+'&mdd6='+mdd6+'&sou_size1='+sou_size1+'&sou_size2='+sou_size2+'&wms1='+wms1+'&wms2='+wms2+'&wms3='+wms3+'&wms4='+wms4+'&wms5='+wms5+'&wms6='+wms6+'&strip_1='+strip_1+'&strip_2='+strip_2+'&strip_3='+strip_3+'&strip_4='+strip_4+'&strip_5='+strip_5+'&strip_21='+strip_21+'&strip_22='+strip_22+'&strip_23='+strip_23+'&strip_24='+strip_24+'&strip_25='+strip_25+'&strip_31='+strip_31+'&strip_32='+strip_32+'&strip_33='+strip_33+'&strip_34='+strip_34+'&strip_35='+strip_35;
			}
			else
			{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
				}
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_coarse_agg.php',
       data: billData,
		dataType: 'JSON',
		success:function(msg){
		$('#btn_save').hide();
		getGlazedTiles();
		var report_no = $('#report_no').val(); 
			var job_no = $('#job_no').val();
			//window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+"&&job_no="+job_no;
						
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
        url: '<?php echo $base_url; ?>save_coarse_agg.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
            $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
           		
			//GRADATION DATA FETCH
			var temp = $('#test_list').val();
				var aa= temp.split(",");				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grd")
					{											
						var chk_grd = data.chk_grd;
						if(chk_grd=="1")
						{
							$('#txtgrd').css("background-color","var(--success)");	
						   $("#chk_grd").prop("checked", true); 
						}else{
							$('#txtgrd').css("background-color","white");	
							$("#chk_grd").prop("checked", false); 
						}
								//GRADATION DATA FETCH-1
						$('#sample_taken').val(data.sample_taken);
						
						$('#cum_wt_gm_1').val(data.cum_wt_gm_1);
						$('#cum_wt_gm_2').val(data.cum_wt_gm_2);
						$('#cum_wt_gm_3').val(data.cum_wt_gm_3);
						$('#cum_wt_gm_4').val(data.cum_wt_gm_4);
						$('#cum_wt_gm_5').val(data.cum_wt_gm_5);
						$('#cum_wt_gm_6').val(data.cum_wt_gm_6);
						$('#cum_wt_gm_7').val(data.cum_wt_gm_7);
						
						$('#ret_wt_gm_1').val(data.ret_wt_gm_1);
						$('#ret_wt_gm_2').val(data.ret_wt_gm_2);
						$('#ret_wt_gm_3').val(data.ret_wt_gm_3);
						$('#ret_wt_gm_4').val(data.ret_wt_gm_4);
						$('#ret_wt_gm_5').val(data.ret_wt_gm_5);
						$('#ret_wt_gm_6').val(data.ret_wt_gm_6);
						$('#ret_wt_gm_7').val(data.ret_wt_gm_7);
						
						$('#cum_ret_1').val(data.cum_ret_1);
						$('#cum_ret_2').val(data.cum_ret_2);
						$('#cum_ret_3').val(data.cum_ret_3);
						$('#cum_ret_4').val(data.cum_ret_4);
						$('#cum_ret_5').val(data.cum_ret_5);
						$('#cum_ret_6').val(data.cum_ret_6);
						$('#cum_ret_7').val(data.cum_ret_7);
						
						$('#pass_sample_1').val(data.pass_sample_1);
						$('#pass_sample_2').val(data.pass_sample_2);
						$('#pass_sample_3').val(data.pass_sample_3);
						$('#pass_sample_4').val(data.pass_sample_4);
						$('#pass_sample_5').val(data.pass_sample_5);
						$('#pass_sample_6').val(data.pass_sample_6);
						$('#pass_sample_7').val(data.pass_sample_7);
						
						$('#blank_extra').val(data.blank_extra);
						
						sieve_1=data.sieve_1;
						sieve_2=data.sieve_2;
						sieve_3=data.sieve_3;
						sieve_4=data.sieve_4;
						sieve_5=data.sieve_5;
						sieve_6=data.sieve_6;
						sieve_7=data.sieve_7;
						break;
					}
					else
					{
						
					}
														
				}
			
				//flakiness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flk")
					{	
							$('#p1').val(data.p1);
							$('#p2').val(data.p2);
							$('#p3').val(data.p3);
							$('#p4').val(data.p4);
							$('#p5').val(data.p5);
							$('#p6').val(data.p6);
							$('#p7').val(data.pa7);
							$('#p8').val(data.p8);
							$('#p9').val(data.p9);
							
							$('#fi_index').val(data.fi_index);
							$('#a1').val(data.a1);
							$('#a2').val(data.a2);
							$('#a3').val(data.a3);
							$('#a4').val(data.a4);
							$('#a5').val(data.a5);
							$('#a6').val(data.a6);
							$('#a7').val(data.a7);
							$('#a8').val(data.a8);
							$('#a9').val(data.a9);
							$('#suma').val(data.suma);

							$('#b1').val(data.b1);
							$('#b2').val(data.b2);
							$('#b3').val(data.b3);
							$('#b4').val(data.b4);
							$('#b5').val(data.b5);
							$('#b6').val(data.b6);
							$('#b7').val(data.b7);
							$('#b8').val(data.b8);
							$('#b9').val(data.b9);
							
												
							$('#c1').val(data.c1);
							$('#c2').val(data.c2);
							$('#c3').val(data.c3);					
							$('#c4').val(data.c4);					
							$('#c5').val(data.c5);					
							$('#c6').val(data.c6);					
							$('#c7').val(data.c7);					
							$('#c8').val(data.c8);					
							$('#c9').val(data.c9);					
							
							$('#d1').val(data.d1);
							$('#d2').val(data.d2);
							$('#d3').val(data.d3);					
							$('#d4').val(data.d4);					
							$('#d5').val(data.d5);					
							$('#d6').val(data.d6);					
							$('#d7').val(data.d7);					
							$('#d8').val(data.d8);					
							$('#d9').val(data.d9);					
							
							$('#e1').val(data.e1);
							$('#e2').val(data.e2);
							$('#e3').val(data.e3);									
							$('#e4').val(data.e4);									
							$('#e5').val(data.e5);									
							$('#e6').val(data.e6);									
							$('#e7').val(data.e7);									
							$('#e8').val(data.e8);									
							$('#e9').val(data.e9);									
							
							$('#ei_index').val(data.ei_index);									
						
							$('#aa1').val(data.aa1);
							$('#aa2').val(data.aa2);
							$('#aa3').val(data.aa3);
							$('#aa4').val(data.aa4);
							$('#aa5').val(data.aa5);			
							$('#aa6').val(data.aa6);			
							$('#aa7').val(data.aa7);			
							$('#aa8').val(data.aa8);			
							$('#aa9').val(data.aa9);			

							$('#bb1').val(data.bb1);
							$('#bb2').val(data.bb2);
							$('#bb3').val(data.bb3);
							$('#bb4').val(data.bb4);
							$('#bb5').val(data.bb5);			
							$('#bb6').val(data.bb6);			
							$('#bb7').val(data.bb7);			
							$('#bb8').val(data.bb8);			
							$('#bb9').val(data.bb9);			
												
							
							$('#dd1').val(data.dd1);
							$('#dd2').val(data.dd2);
							$('#dd3').val(data.dd3);					
							$('#dd4').val(data.dd4);					
							$('#dd5').val(data.dd5);					
							$('#dd6').val(data.dd6);					
							$('#dd7').val(data.dd7);					
							$('#dd8').val(data.dd8);					
							$('#dd9').val(data.dd9);					
							
							$('#combined_index').val(data.combined_index);					
							
						
							var chk_f1,chk_f2,chk_f3,chk_f4,chk_f5,chk_f6,chk_f7,chk_f8,chk_f9;
							chk_f1 = data.chk_f1;
							chk_f2 = data.chk_f2;
							chk_f3 = data.chk_f3;
							chk_f4 = data.chk_f4;
							chk_f5 = data.chk_f5;
							chk_f6 = data.chk_f6;
							chk_f7 = data.chk_f7;
							chk_f8 = data.chk_f8;
							chk_f9 = data.chk_f9;
							
							
							$('#s11').val(data.s11);
							$('#s12').val(data.s12);
							$('#s13').val(data.s13);
							$('#s14').val(data.s14);
							$('#s15').val(data.s15);
							$('#s16').val(data.s16);
							$('#s17').val(data.s17);
							$('#s18').val(data.s18);
							$('#s19').val(data.s19);
							
							
							
							if(chk_f1=="1")
							{
							   $("#chk_f1").prop("checked", true); 
							}
							else
							{
								$("#chk_f1").prop("checked", false); 
							}
							
							if(chk_f2=="1")
							{
							   $("#chk_f2").prop("checked", true); 
							}
							else
							{
								$("#chk_f2").prop("checked", false); 
							}
							
							if(chk_f3=="1")
							{
							   $("#chk_f3").prop("checked", true); 
							}
							else
							{
								$("#chk_f3").prop("checked", false); 
							}
							
							if(chk_f4=="1")
							{
							   $("#chk_f4").prop("checked", true); 
							}
							else
							{
								$("#chk_f4").prop("checked", false); 
							}
							
							if(chk_f5=="1")
							{
							   $("#chk_f5").prop("checked", true); 
							}
							else
							{
								$("#chk_f5").prop("checked", false); 
							}

							if(chk_f6=="1")
							{
							   $("#chk_f6").prop("checked", true); 
							}
							else
							{
								$("#chk_f6").prop("checked", false); 
							}

							if(chk_f7=="1")
							{
							   $("#chk_f7").prop("checked", true); 
							}
							else
							{
								$("#chk_f7").prop("checked", false); 
							}

							if(chk_f8=="1")
							{
							   $("#chk_f8").prop("checked", true); 
							}
							else
							{
								$("#chk_f8").prop("checked", false); 
							}

							if(chk_f9=="1")
							{
							   $("#chk_f9").prop("checked", true); 
							}
							else
							{
								$("#chk_f9").prop("checked", false); 
							}
							
							
							var chk_flk = data.chk_flk;	
							if(chk_flk=="1")
							{
								$('#txtflk').css("background-color","var(--success)");	
							   $("#chk_flk").prop("checked", true); 
							}else{
								$('#txtflk').css("background-color","white");	
								$("#chk_flk").prop("checked", false); 
							}
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
						$('#sp_w_b_a1_1').val(data.sp_w_b_a1_1);
						$('#sp_w_b_a1_2').val(data.sp_w_b_a1_2);
						$('#sp_w_b_a2_1').val(data.sp_w_b_a2_1);
						$('#sp_w_b_a2_2').val(data.sp_w_b_a2_2);	
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
						break;
					}
					else
					{
						
					}
				
				}

				//ABRASION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abr")
					{
						$('#abr_index').val(data.abr_index);			
						$('#abr_wt_t_a_1').val(data.abr_wt_t_a_1);			
						$('#abr_wt_t_b_1').val(data.abr_wt_t_b_1);			
						$('#abr_wt_t_c_1').val(data.abr_wt_t_c_1);			
						$('#abr_sample_abr').val(data.abr_sample_abr);
						$('#abr_grading').val(data.abr_grading);	
						$('#abr_weight_charge').val(data.abr_weight_charge);	
						$('#abr_num_revo').val(data.abr_num_revo);	
						$('#abr_sphere').val(data.abr_sphere);	
						$('#abr_wt_t_a_2').val(data.abr_wt_t_a_2);			
						$('#abr_wt_t_b_2').val(data.abr_wt_t_b_2);			
						$('#abr_wt_t_c_2').val(data.abr_wt_t_c_2);
							var chk_abr = data.chk_abr;
						if(chk_abr=="1")
						{
							$('#txtabr').css("background-color","var(--success)");	
						   $("#chk_abr").prop("checked", true); 
						}else{
							$('#txtabr').css("background-color","white");	
							$("#chk_abr").prop("checked", false); 
						}	
						break;
					}
					else
					{
					
					}
				}
			
				//SOUNDNESS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{	
							//SOUNDNESS
							$('#soundness').val(data.soundness);
							$('#s2').val(data.s2);
							$('#sound_sample').val(data.sound_sample);
							$('#sou_size1').val(data.sou_size1);
							$('#sou_size2').val(data.sou_size2);
							$('#w1').val(data.w1);
							$('#w2').val(data.w2);
							$('#wsum').val(data.wsum);
							$('#gasum').val(data.gasum);
							$('#gbsum').val(data.gbsum);
							$('#gcsum').val(data.gcsum);
							$('#s1').val(data.s1);
														
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
			
				
				//impact
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="imp")
					{
						
							//impact value
							$('#imp_w_m_a_1').val(data.imp_w_m_a_1);
							$('#imp_w_m_a_2').val(data.imp_w_m_a_2);				
							$('#imp_w_m_b_1').val(data.imp_w_m_b_1);
							$('#imp_w_m_b_2').val(data.imp_w_m_b_2);				
							$('#imp_w_m_c_1').val(data.imp_w_m_c_1);
							$('#imp_w_m_c_2').val(data.imp_w_m_c_2);
							$('#imp_value_1').val(data.imp_value_1);
							$('#imp_value_2').val(data.imp_value_2);
							$('#imp_value').val(data.imp_value);
							$('#imp_w_m_d_1').val(data.imp_w_m_d_1);
							$('#imp_w_m_d_2').val(data.imp_w_m_d_2);
					
							var chk_impact = data.chk_impact;
							if(chk_impact=="1")
							{
								$('#txtimp').css("background-color","var(--success)");	
							   $("#chk_impact").prop("checked", true); 
							}else{
								$('#txtimp').css("background-color","white");	
								$("#chk_impact").prop("checked", false); 
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
						
							
							$('#den_volume').val(data.den_volume);
							$('#den_lab_1').val(data.den_lab_1);				
							$('#den_lab_2').val(data.den_lab_2);
							$('#ov_1').val(data.ov_1);				
							$('#ov_2').val(data.ov_2);
							$('#v1').val(data.v1);
							$('#v2').val(data.v2);
							$('#wt1').val(data.wt1);
							$('#wt2').val(data.wt2);
							$('#wm1').val(data.wm1);
							$('#wm2').val(data.wm2);
							$('#ws1').val(data.ws1);
							$('#ws2').val(data.ws2);
							$('#bdl1').val(data.bdl1);
							$('#bdl2').val(data.bdl2);
							$('#bdc1').val(data.bdc1);
							$('#bdc2').val(data.bdc2);
							$('#bdl').val(data.bdl);
							$('#bdc').val(data.bdc);
					
							var chk_den = data.chk_den;
							if(chk_den=="1")
							{
							   $('#txtden').css("background-color","var(--success)");	
							   $("#chk_den").prop("checked", true); 
							}else{
								$('#txtden').css("background-color","white");	
								$("#chk_den").prop("checked", false); 
							}	
							break;
					}
					else
					{
						
					}

				}

				 //STRIPPING VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="str")
					{						
							$('#stripping_value').val(data.stripping_value);			
								var chk_strip = data.chk_strip;
								if(chk_strip=="1")
								{
									$('#txtstr').css("background-color","var(--success)");	
								   $("#chk_strip").prop("checked", true); 
								}else{
									$('#txtstr').css("background-color","white");	
									$("#chk_strip").prop("checked", false); 
								}
								$('#strip_1').val(data.strip_1);
								$('#strip_2').val(data.strip_2);
								$('#strip_3').val(data.strip_3);
								$('#strip_4').val(data.strip_4);
								$('#strip_5').val(data.strip_5);
								$('#strip_21').val(data.strip_21);
								$('#strip_22').val(data.strip_22);
								$('#strip_23').val(data.strip_23);
								$('#strip_24').val(data.strip_24);
								$('#strip_25').val(data.strip_25);
								$('#strip_31').val(data.strip_31);
								$('#strip_32').val(data.strip_32);
								$('#strip_33').val(data.strip_33);
								$('#strip_34').val(data.strip_34);
								$('#strip_35').val(data.strip_35);
								
							break;
					}
					else
					{
						
						
					}	
				}

				//FINES
				for(var i=0;i<aa.length;i++)
					{
						if(aa[i]=="fin")
						{						
								$('#fines_value').val(data.fines_value);			
								var chk_fines = data.chk_fines;
								if(chk_fines=="1")
								{
									$('#txtfin').css("background-color","var(--success)");	
								   $("#chk_fines").prop("checked", true); 
								}else{
									$('#txtfin').css("background-color","white");	
									$("#chk_fines").prop("checked", false); 
								}
								$('#fines_value').val(data.fines_value);
								$('#f_a_1').val(data.f_a_1);
								$('#f_a_2').val(data.f_a_2);
								$('#f_b_1').val(data.f_b_1);
								$('#f_b_2').val(data.f_b_2);
								$('#f_c_1').val(data.f_c_1);
								$('#f_c_2').val(data.f_c_2);
								$('#f_d_1').val(data.f_d_1);
								$('#f_d_2').val(data.f_d_2);
								$('#f_e_1').val(data.f_e_1);
								$('#f_e_2').val(data.f_e_2);
								break;
						}
						else
						{
							
						}	
					}
				
				//ALKALI REACTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alk")
					{						
							$('#alkali_value').val(data.alkali_value);			
							var chk_alkali = data.chk_alkali;
							if(chk_alkali=="1")
							{
							   $('#txtalk').css("background-color","var(--success)");	
							   $("#chk_alkali").prop("checked", true); 
							}else{
								$('#txtalk').css("background-color","white");	
								$("#chk_alkali").prop("checked", false); 
							}
							break;
					}
					else
					{
						
					}	
				}

				//crushing
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cru")
					{						
							$('#cr_a_1').val(data.cr_a_1);
							$('#cr_a_2').val(data.cr_a_2);			
							$('#cr_b_1').val(data.cr_b_1);
							$('#cr_b_2').val(data.cr_b_2);
							$('#cr_c_1').val(data.cr_c_1);
							$('#cr_c_2').val(data.cr_c_2);
							$('#cru_value_1').val(data.cru_value_1);
							$('#cru_value_2').val(data.cru_value_2);
							$('#cru_value').val(data.cru_value);
							$('#cru_sample_crush').val(data.cru_sample_crush);
							
							var chk_crushing = data.chk_crushing;
							if(chk_crushing=="1")
							{
								$('#txtcru').css("background-color","var(--success)");	
							   $("#chk_crushing").prop("checked", true); 
							}else{
								$('#txtcru').css("background-color","white");	
								$("#chk_crushing").prop("checked", false); 
							}
							break;
					}
					else
					{
						
					}
				}
			
				//LIQUIDE LIMIT AND PLASTICITY VALUE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lll")
					{			//ll and pl
								
								var chk_ll = data.chk_ll;
								if(chk_ll=="1")
								{
								   $('#txtlll').css("background-color","var(--success)");	
								   $("#chk_ll").prop("checked", true); 
								}else{
									$('#txtlll').css("background-color","white");	
									$("#chk_ll").prop("checked", false); 
								}
								$('#dep_1').val(data.dep_1);
								$('#dep_2').val(data.dep_2);
								$('#dep_3').val(data.dep_3);
								$('#dep_4').val(data.dep_4);
								
								$('#lab_no_1_1').val(data.lab_no_1_1);
								$('#lab_no_1_2').val(data.lab_no_1_2);
								$('#lab_no_1_3').val(data.lab_no_1_3);
								$('#lab_no_1_4').val(data.lab_no_1_4);
								
								$('#bo_1').val(data.bo_1);
								$('#bo_2').val(data.bo_2);
								$('#bo_3').val(data.bo_3);
								$('#bo_4').val(data.bo_4);
								
								$('#con1').val(data.con1);
								$('#con2').val(data.con2);
								$('#con3').val(data.con3);
								$('#con4').val(data.con4);
								
								$('#wws1').val(data.wws1);
								$('#wws2').val(data.wws2);
								$('#wws3').val(data.wws3);
								$('#wws4').val(data.wws4);
								
								$('#wds1').val(data.wds1);
								$('#wds2').val(data.wds2);
								$('#wds3').val(data.wds3);
								$('#wds4').val(data.wds4);
								
								$('#pl1').val(data.pl1);
								$('#pl2').val(data.pl2);
								$('#pl3').val(data.pl3);
								
								
								$('#plastic_limit').val(data.plastic_limit);
								$('#pi_value').val(data.pi_value);
								$('#liquide_limit').val(data.liquide_limit);
								$('#mc1').val(data.mc1);
								$('#blow1').val(data.blow1);
								$('#weight_sample_1').val(data.weight_sample_1);
								
								
								
							break;
					}
					else
					{
							
					}
				
				}
				
				//CBR MDD OMC
				for(var i=0;i<aa.length;i++)
				{
								if(aa[i]=="mdd")
								{
									
								$('#mdd').val(data.mdd);
								$('#omc').val(data.omc);
								$('#cbr').val(data.cbr);
								
								$('#wos1').val(data.wos1);
								$('#wos2').val(data.wos2);
								$('#wos3').val(data.wos3);					
								$('#wos4').val(data.wos4);					
								$('#wos5').val(data.wos5);
								$('#wos6').val(data.wos6);
								
								$('#wad1').val(data.wad1);
								$('#wad2').val(data.wad2);
								$('#wad3').val(data.wad3);					
								$('#wad4').val(data.wad4);					
								$('#wad5').val(data.wad5);
								$('#wad6').val(data.wad6);
								
								
								$('#wra1').val(data.wra1);
								$('#wra2').val(data.wra2);
								$('#wra3').val(data.wra3);					
								$('#wra4').val(data.wra4);					
								$('#wra5').val(data.wra5);
								$('#wra6').val(data.wra6);
								
								$('#wmc1').val(data.wmc1);
								$('#wmc2').val(data.wmc2);
								$('#wmc3').val(data.wmc3);					
								$('#wmc4').val(data.wmc4);					
								$('#wmc5').val(data.wmc5);
								$('#wmc6').val(data.wmc6);
								
								
								$('#wms1').val(data.wms1);
								$('#wms2').val(data.wms2);
								$('#wms3').val(data.wms3);
								$('#wms4').val(data.wms4);
								$('#wms5').val(data.wms5);
								$('#wms6').val(data.wms6);
								
								
								
								$('#bd1').val(data.bd1);
								$('#bd2').val(data.bd2);
								$('#bd3').val(data.bd3);					
								$('#bd4').val(data.bd4);					
								$('#bd5').val(data.bd5);
								$('#bd6').val(data.bd6);
								
								$('#cnm1').val(data.cnm1);
								$('#cnm2').val(data.cnm2);
								$('#cnm3').val(data.cnm3);					
								$('#cnm4').val(data.cnm4);					
								$('#cnm5').val(data.cnm5);
								$('#cnm6').val(data.cnm6);
								
								
								$('#ww31').val(data.ww31);
								$('#ww32').val(data.ww32);
								$('#ww33').val(data.ww33);					
								$('#ww34').val(data.ww34);					
								$('#ww35').val(data.ww35);
								$('#ww36').val(data.ww36);
								
								$('#wd41').val(data.wd41);
								$('#wd42').val(data.wd42);
								$('#wd43').val(data.wd43);					
								$('#wd44').val(data.wd44);					
								$('#wd45').val(data.wd45);
								$('#wd46').val(data.wd46);
								
								
								$('#omc1').val(data.omc1);
								$('#omc2').val(data.omc2);
								$('#omc3').val(data.omc3);					
								$('#omc4').val(data.omc4);					
								$('#omc5').val(data.omc5);
								$('#omc6').val(data.omc6);
								
								$('#mdd1').val(data.mdd1);
								$('#mdd2').val(data.mdd2);
								$('#mdd3').val(data.mdd3);					
								$('#mdd4').val(data.mdd4);					
								$('#mdd5').val(data.mdd5);
								$('#mdd6').val(data.mdd6);
								
								$('#empty_mould').val(data.empty_mould);
								$('#weight_of_sample').val(data.weight_of_sample);
								$('#mdd').val(data.mdd);					
								$('#omc').val(data.omc);					
								$('#cbr').val(data.cbr);
								$('#type_compation').val(data.type_compation);								
								$('#volume').val(data.volume);
								
								
							var chk_mdd = data.chk_mdd;
							if(chk_mdd=="1")
							{
							   $('#txtmdd').css("background-color","var(--success)");			
							   $("#chk_mdd").prop("checked", true); 
							}else{
								$('#txtmdd').css("background-color","white");			
								$("#chk_mdd").prop("checked", false); 
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
	