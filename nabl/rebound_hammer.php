<?php 
session_start(); 
include("header.php");
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
.visually-hidden {
    position: absolute;
    left: -100vw;
    
    /* Note, you may want to position the checkbox over top the label and set the opacity to zero instead. It can be better for accessibilty on some touch devices for discoverability. */
}
.disp_bandh
{
display:none;	
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
			
		}
		if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
			
		}
		 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$grade1= $row_select4['steel_grade'];
					$dia1= $row_select4['steel_dia'];
					$brand1= $row_select4['steel_brand'];
					$sample_qty1= $row_select4['steel_sample_qty'];
					$heat_no1= $row_select4['steel_heat'];
					$rebound_qty= $row_select4['rebound_qty'];
					
					
					
					
				}
				 $cnt_report = $rebound_qty;
				
				$query = "select * from `rebound_hammer` WHERE lab_no='$aa'  and `is_deleted`='0'";

				$result = mysqli_query($conn, $query);											
				$save_report_cnt = mysqli_num_rows($result);
		
				/*$mt_split = explode(',',$dia1);
				$dia = $mt_split[$save_report_cnt];
		
				$chain_exp = explode(',',$grade1);
				$grade = $chain_exp[$save_report_cnt];
				
				$chain1_exp = explode(',',$brand1);
				$brand = $chain1_exp[$save_report_cnt];
				
				$sample_exp = explode(',',$sample_qty1);
				$sample_qty = $sample_exp[$save_report_cnt];
				
				$heat_exp = explode(',',$heat_no1);
				$heat_no = $heat_exp[$save_report_cnt];*/
				
				$test="";
				$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
		
				$test.=$r1['test_name'].",";
		
		}
		
		$get_final_table = "SELECT * FROM `final_material_assign_master` WHERE `trf_no`='$trf_no' AND `job_no`='$job_no' AND `lab_no`='$lab_no'";
		$res_final_table = mysqli_query($conn,$get_final_table);
		if(mysqli_num_rows($res_final_table) > 0){
			$row_final_table = mysqli_fetch_array($res_final_table);
			$rebound_qty = $row_final_table['rebound_qty'];
		}
		
		/*$select_query11 = "select chk_len from span_material_assign,job,rebound_hammer WHERE 
		
		rebound_hammer.lab_no = span_material_assign.lab_no and  
		job.trf_no = span_material_assign.trf_no"; 
		$result_select11 = mysqli_query($conn, $select_query11);
		echo $result_select11;
		*/
		
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
							<h2  style="text-align:center;">Rebound Hammer</h2>
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
											<input type="hidden" class="form-control" tabindex="1"  value="<?php echo $job_no;?>" id="job_no" name="job_no" ReadOnly>
											<input type="hidden" class="form-control" tabindex="1"  value="<?php echo $trf_no;?>" id="trf_no" name="trf_no" ReadOnly>
											<input type="hidden" class="form-control" tabindex="1"  value="<?php echo $cnt_report;?>" id="report_cnt" name="report_cnt" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="cur_grade" value="<?php echo $grade1;?>" name="cur_grade" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="grade" value="<?php echo $grade;?>" name="grade" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="cur_dia" value="<?php echo $dia1;?>" name="cur_dia" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="dia" value="<?php echo $dia;?>" name="dia" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="cur_brand" value="<?php echo $brand1;?>" name="cur_brand" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="brand" value="<?php echo $brand;?>" name="brand" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="cur_sample_qty" value="<?php echo $sample_qty1;?>" name="cur_sample_qty" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="sample_qty" value="<?php echo $sample_qty;?>" name="sample_qty" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="cur_heat_no" value="<?php echo $heat_no1;?>" name="cur_cur_heat_nobrand" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="heat_no" value="<?php echo $heat_no;?>" name="heat_no" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="test" value="<?php echo $test;?>" name="test" ReadOnly>
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
											
											
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<div class="col-sm-3">
											<label for="chk_auto">Quantity :</label>
										</div>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="rebound_qty" value="<?php echo $cnt_report;?>" onchange="set_sample_qty()" name="rebound_qty">
											<input type="hidden" class="form-control" id="cc_sample_qty_old" value="<?php echo $save_report_cnt;?>" name="cc_sample_qty_old">
										</div>
									</div>
								</div>
							</div>
							<!-- </div> -->
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-4">
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
								<div class="col-lg-4">
									<div class="form-group">
									<div class="col-sm-2">
													<label for="chk_auto">Temprature  :</label>
													
												</div>
										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="temp"  name="temp" value="33.5">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-2">
													<label for="chk_auto">Mc  :</label>
													
												</div>
										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="mc_data1"  name="mc_data1" value="1.369">
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-2">
													<label for="chk_auto">Mc 2ND  :</label>
													
												</div>
										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="mc_data2"  name="mc_data2" value = "12.66">
										</div>
									</div>
								</div>
							</div>
							<hr>
					<!--Nikunj Code Start-->
							<?php
								$is_upload = "select * from span_material_assign WHERE `trf_no`='$trf_no' and `job_number`='$job_no'and isdeleted='0'";

								$result_upload = mysqli_query($conn, $is_upload);
								if (mysqli_num_rows($result_upload) > 0) { ?>

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
																<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>&&lab_no=<?php echo $lab_no; ?>">Row Data</a>
															</div>
															<div class="col-md-3">
																<label for="inputEmail3" class="col-md-12 control-label">Upload Excel :</label>
															</div>
															<div class="col-md-3">
																<input type="file" class="form-control" id="upload_excel" name="upload_excel">
															</div>
															<div class="col-md-3">
																<button type="button" class="btn btn-info pull-right" id="btn_upload_excel" name="btn_upload_excel" tabindex="14">Upload</button>
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
																if (mysqli_num_rows($result_file) > 0) {
																	while ($r_file = mysqli_fetch_array($result_file)) {
																?>
																		<tr>
																			<td><a href="<?php echo $base_url . $r_file['excel_sheet']; ?>" download><?php echo $r_file['excel_sheet']; ?></a></td>
																			<td><a href="javascript:void(0);" class="delete_excels" data-id="<?php echo $r_file['id']; ?>">Delete</a></td>
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
	$select_query12 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
	$result_select12 = mysqli_query($conn, $select_query12);
	while($r12 = mysqli_fetch_array($result_select12))
	{
		if($r12['test_code']=="rha")
		{
			$test_check.="rha,";
	?>
			<br>
			<div class="panel panel-default" id="rha">
				<div class="panel-heading" id="txtrha">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse_rha">
							<h4 class="panel-title">
							<b>REBOUND HAMMER</b>
							</h4>
						</a>
					</h4>
				</div>
				<div id="collapse_rha" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">									
							<div class="col-lg-12">
								<div class="form-group">
									<div class="col-lg-8">
										<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_rha">1.</label>
												<input type="checkbox" class="visually-hidden" name="chk_rha"  id="chk_rha" value="chk_rha"><br>
											</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">REBOUND HAMMER</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Location / ID Mark</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">											
									<div class="col-md-12">
										<input type="text" class="form-control" id="rh_location" name="rh_location">
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">RCC member</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_rcc" name="rh_rcc">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">Grade of Concrete</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="grade1" name="grade1">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Casting Date</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">											
									<div class="col-md-12">
										<input type="date" class="form-control" id="rh_cast_date" name="rh_cast_date">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">Age in days</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_age" name="rh_age">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">Direction of Impact</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									
									<select class="form-control" id="rh_direction" name="rh_direction">
															
																	<option value="Horizontal">Horizontal</option>
																	<option value="Vertical-Up">Vertical-Up</option>
																	<option value="Vertical-Down">Vertical-Down</option>
																	
																	
											</select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;"></label>	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">R - 1</label>	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">R - 2</label>	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">R - 3</label>	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">R - 4</label>	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">R - 5</label>	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">R - 6</label>	
								</div>
							</div>
							
							<div class="col-sm-1">
								<div class="form-group">											
									<!--<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">R - 10</label>-->	
								</div>
							</div>
						</div>

						<br>
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Rebound Numbers</label>	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_r1" name="rh_r1">
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_r2" name="rh_r2">	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_r3" name="rh_r3">	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_r4" name="rh_r4">	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_r5" name="rh_r5">
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_r6" name="rh_r6">	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="hidden" class="form-control" id="rh_r7" name="rh_r7">	
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="hidden" class="form-control" id="rh_r8" name="rh_r8">
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="hidden" class="form-control" id="rh_r9" name="rh_r9">
								</div>
							</div>
							<div class="col-sm-1">
								<div class="form-group">											
									<input type="hidden" class="form-control" id="rh_r10" name="rh_r10">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">Avg. Rebound Number (X)</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="avg_r_num" name="avg_r_num">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">Standrard Deviation (S)</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="std_dev" name="std_dev">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">Max. Rb</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_max" name="rh_max">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">Min. Rb</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_min" name="rh_min">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">Range (R)</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_range" name="rh_range">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">R / S</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_rs" name="rh_rs">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">R / S. As per IS 8900:1978 table 4. for 5% significance level</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_level" name="rh_level" value="3.59">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">OUTLIERS REQUIREMENTS</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_out" name="rh_out">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">By Relationship Y=1.369X-12.66</label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_relation" name="rh_relation">
								</div>
							</div>
						</div>
						
						<br>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">											
									<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right;">Vertical up/Down </label>	
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">											
									<input type="text" class="form-control" id="rh_verticle" name="rh_verticle">
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
			<!--<div class="panel panel-default" id="rem">
									<div class="panel-heading" id="rem">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse_rem">
												<h4 class="panel-title">
												<b>REMARKS</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse_rem" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">
										<div class="col-lg-8">
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">REMARKS</label>
												</div>
											</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">											
										<div class="col-md-3">
											<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Heading:</label>	
										</div>
										<div class="col-md-9">
											<input type="text" class="form-control" id="tag_heading" name="tag_heading" value="Remarks">
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">											
										<div class="col-md-2">
											<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Data:</label>	
										</div>
										<div class="col-md-10">
											<input type="text" class="form-control"  id="tag_data" name="tag_data">
										</div>
									</div>
								</div>
							</div>	
											
										</div>
									</div>
								</div>-->
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
									<div class="col-sm-2">
											<a href="javascript:void(0);" class="btn btn-info pull-right" onclick="confirm('Are you sure to delete data?')?ccDelete(<?php echo $r['id']; ?>):false;">DELETE ALL REPORT</a>
										</div>
									<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="idEdit" id="idEdit"/>

											</div>
										<div class="col-sm-2">
											
											
											<?php   
												// $querys_job1 = "SELECT * FROM rebound_hammer WHERE `is_deleted`='0' and lab_no='$lab_no'";
												//$qrys_jobno = mysqli_query($conn,$querys_job1);
												 //$rows=mysqli_num_rows($qrys_jobno);
												
												 //if(intval($rebound_qty) >=intval($rows)){  ?>
													<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
											<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>
													<?php// }												
														?>
										</div>
									
										<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
										
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/report_rebound_hammer.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $ulr;?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b> Report</b></a>
										</div>
										
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/back_rebound_hammer.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
											
										</div>
									</div>
								</div>
							</div>
							<br>
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
							 $query = "select * from rebound_hammer WHERE lab_no='$aa'  and `is_deleted`='0'";

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
										<!-- <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?ccDelete(<?php// echo $r['id']; ?>):false;"></a> -->
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
		</section>
	</div>
	<?php include("footer.php");?>
<script>
getGlazedTiles();	
	

	$("#btn_upload_excel").click(function() {
		form_data = new FormData();
		var acb = $('#upload_excel').val();
		if (acb == "") {
			alert("Upload excel First");
			return false;
		}
		var lab_no = "<?php echo $lab_no; ?>";
		var job_no = "<?php echo $job_no_main; ?>";
		var report_no = "<?php echo $report_no; ?>";

		var file_data = $('#upload_excel').prop('files')[0];
		var form_data = new FormData(); // Create a FormData object
		form_data.append('file', file_data); // Append all element in FormData  object
		form_data.append('lab_no', lab_no); // Append all element in FormData  object
		form_data.append('job_no', job_no); // Append all element in FormData  object
		form_data.append('report_no', report_no); // Append all element in FormData  object

		$.ajax({
			url: '<?php $base_url; ?>excel_upload_test.php', // point to server-side PHP script 
			dataType: 'text', // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function(output) {
				get_excel_record(); // display response from the PHP script, if any
			}
		});
		$('#upload_excel').val('');


	});

	function get_excel_record() {
		var lab_no = "<?php echo $lab_no; ?>";
		var job_no = "<?php echo $job_no_main; ?>";
		var report_no = "<?php echo $report_no; ?>";
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>excel_upload_test.php',
			data: 'action_type=get_excel_record&lab_no=' + lab_no + '&job_no=' + job_no + '&report_no=' + report_no,
			success: function(html) {
				$('#view_excel_from_table').html(html);

			}
		});
	}


$(function () {
    $('.select2').select2();
  })
    
  
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();	
});

function rha_auto(){
	$('#txtrha').css("background-color","var(--primary)");
	/* $('#rh_location').val(1);
	$('#rh_r1').val(1);
	$('#rh_r2').val(1);
	$('#rh_r3').val(1);
	$('#rh_r4').val(1);
	$('#rh_r5').val(1);
	$('#rh_r6').val(1);
	$('#rh_r7').val(1);
	$('#rh_r8').val(1);
	$('#rh_r9').val(1);
	//$('#rh_r10').val(1);
	$('#avg_r_num').val(1);
	$('#std_dev').val(1);
	$('#rh_max').val(1);
	$('#rh_min').val(1);
	$('#rh_range').val(1);
	$('#rh_rs').val(1);
	$('#rh_level').val(1);
	$('#rh_out').val(1);
	$('#rh_relation').val(1);
	$('#rh_verticle').val(1);
	$('#rh_age').val(1);
	$('#rh_rcc').val(1);
	$('#rh_rcc').val(""); */
	
}

$('#chk_rha').change(function(){
    if(this.checked)
	{
		rha_auto();
	}
	else
	{					
		$('#rh_location').val(null);
		$('#rh_r1').val(null);
		$('#rh_r2').val(null);
		$('#rh_r3').val(null);
		$('#rh_r4').val(null);
		$('#rh_r5').val(null);
		$('#rh_r6').val(null);
		$('#rh_r7').val(null);
		$('#rh_r8').val(null);
		$('#rh_r9').val(null);
		$('#rh_r10').val(null);
		$('#avg_r_num').val(null);
		$('#std_dev').val(null);
		$('#rh_max').val(null);
		$('#rh_min').val(null);
		$('#rh_range').val(null);
		$('#rh_rs').val(null);
		$('#rh_level').val(null);
		$('#rh_out').val(null);
		$('#rh_relation').val(null);
		$('#rh_verticle').val(null);
		$('#rh_age').val(null);
		$('#rh_rcc').val(null);
		$('#rh_direction').val(null);
		$('#temp').val(null);
		$('#grade1').val(null);
	}
});

$('#rh_r1,#rh_r2,#rh_r3,#rh_r4,#rh_r5,#rh_r6,#rh_r7,#rh_r8,#rh_r9,#rh_r10').change(function(){
	$("#chk_rha").prop("checked", true);
	$('#txtrha').css("background-color","var(--primary)");
	var rhr1 = $('#rh_r1').val();
	var rhr2 = $('#rh_r2').val();
	var rhr3 = $('#rh_r3').val();
	var rhr4 = $('#rh_r4').val();
	var rhr5 = $('#rh_r5').val();
	var rhr6 = $('#rh_r6').val();
	var rhr7 = $('#rh_r7').val();
	var rhr8 = $('#rh_r8').val();
	var rhr9 = $('#rh_r9').val();
	//var rhr10 = $('#rh_r10').val();
	
	
	var avgr_num  = ((+rhr1) + (+rhr2) + (+rhr3) + (+rhr4) + (+rhr5) + (+rhr6)) / 6;
	$('#avg_r_num').val(avgr_num.toFixed(2));
	
	var avgs = $('#avg_r_num').val();
	
	
	const datas = [rhr1, rhr2, rhr3, rhr4, rhr5, rhr6];
	var stds = math.std(datas);
	$('#std_dev').val(stds.toFixed(3));
	
	var std_devs = $('#std_dev').val();
	var max = math.max(datas);
	var min = math.min(datas);
	$('#rh_max').val(max);
	$('#rh_min').val(min);
	
	var mx = $('#rh_max').val();
	var mn = $('#rh_min').val();
	
	var diff = (+mx) - (+mn);
	$('#rh_range').val(diff);
	var rng = $('#rh_range').val();
	
	var rhrs = (+rng) / (+std_devs);
	$('#rh_rs').val(rhrs.toFixed(2));
	
	var rh_rss = $('#rh_rs').val();
	var rh_level = $('#rh_level').val();
	var out = "";
	if(rh_rss >= rh_level)
	{
		out = "REQUIRED";
	}
	else
	{
		out = "NOT REQUIRED";
	}
	$('#rh_out').val(out);
	var m11 = $('#mc_data1').val();
	var m12 = $('#mc_data2').val();
	//var relations = ((+avgs) * (+m11)) - (+m12);
	
	
	var rh_direction = $('#rh_direction').val();
	if(rh_direction=="Vertical-Up")
	{
		if(avgs<20)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>=20 && avgs<=20.5)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>20.5 && avgs<=21)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>21 && avgs<=21.5)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>21.5 && avgs<=22)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>22 && avgs<=22.5)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>22.5 && avgs<=23)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>23 && avgs<=23.5)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>23.5 && avgs<=24)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>24 && avgs<=24.5)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>24.5 && avgs<=25)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>25 && avgs<=25.5)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>25.5 && avgs<=26)
		{
			$('#rh_relation').val(" < 10");
		}
		else if(avgs>26 && avgs<=26.5)
		{
			$('#rh_relation').val("10");
		}
		else if(avgs>26.5 && avgs<=27)
		{
			$('#rh_relation').val("12");
		}
		else if(avgs>27 && avgs<=27.5)
		{
			$('#rh_relation').val("13");
		}
		else if(avgs>27.5 && avgs<=28)
		{
			$('#rh_relation').val("14");
		}
		else if(avgs>28 && avgs<=28.5)
		{
			$('#rh_relation').val("14");
		}
		else if(avgs>28.5 && avgs<=29)
		{
			$('#rh_relation').val("15");
		}
		else if(avgs>29 && avgs<=29.5)
		{
			$('#rh_relation').val("15");
		}
		else if(avgs>29.5 && avgs<=30)
		{
			$('#rh_relation').val("16");
		}
		else if(avgs>30 && avgs<=30.5)
		{
			$('#rh_relation').val("17");
		}
		else if(avgs>30.5 && avgs<=31)
		{
			$('#rh_relation').val("18");
		}
		else if(avgs>31 && avgs<=31.5)
		{
			$('#rh_relation').val("19");
		}
		else if(avgs>31.5 && avgs<=32)
		{
			$('#rh_relation').val("20");
		}
		else if(avgs>32 && avgs<=32.5)
		{
			$('#rh_relation').val("21");
		}
		else if(avgs>32.5 && avgs<=33)
		{
			$('#rh_relation').val("22");
		}
		else if(avgs>33 && avgs<=33.5)
		{
			$('#rh_relation').val("23");
		}
		else if(avgs>33.5 && avgs<=34)
		{
			$('#rh_relation').val("24");
		}
		else if(avgs>34 && avgs<=34.5)
		{
			$('#rh_relation').val("25");
		}
		else if(avgs>34.5 && avgs<=35)
		{
			$('#rh_relation').val("26");
		}
		else if(avgs>35 && avgs<=35.5)
		{
			$('#rh_relation').val("26");
		}
		else if(avgs>35.5 && avgs<=36)
		{
			$('#rh_relation').val("27");
		}
		else if(avgs>36 && avgs<=36.5)
		{
			$('#rh_relation').val("28");
		}
		else if(avgs>36.5 && avgs<=37)
		{
			$('#rh_relation').val("29");
		}
		else if(avgs>37 && avgs<=37.5)
		{
			$('#rh_relation').val("29");
		}
		else if(avgs>37.5 && avgs<=38)
		{
			$('#rh_relation').val("30");
		}
		else if(avgs>38 && avgs<=38.5)
		{
			$('#rh_relation').val("31");
		}
		else if(avgs>38.5 && avgs<=39)
		{
			$('#rh_relation').val("32");
		}
		else if(avgs>39 && avgs<=39.5)
		{
			$('#rh_relation').val("33");
		}
		else if(avgs>39.5 && avgs<=40)
		{
			$('#rh_relation').val("34");
		}		
		else if(avgs>40 && avgs<=40.5)
		{
			$('#rh_relation').val("35");
		}
		else if(avgs>40.5 && avgs<=41)
		{
			$('#rh_relation').val("36");
		}
		else if(avgs>41 && avgs<=41.5)
		{
			$('#rh_relation').val("37");
		}
		else if(avgs>41.5 && avgs<=42)
		{
			$('#rh_relation').val("38");
		}
		else if(avgs>42 && avgs<=42.5)
		{
			$('#rh_relation').val("39");
		}
		else if(avgs>42.5 && avgs<=43)
		{
			$('#rh_relation').val("40");
		}
		else if(avgs>43 && avgs<=43.5)
		{
			$('#rh_relation').val("41");
		}
		else if(avgs>43.5 && avgs<=44)
		{
			$('#rh_relation').val("42");
		}
		else if(avgs>44 && avgs<=44.5)
		{
			$('#rh_relation').val("43");
		}
		else if(avgs>44.5 && avgs<=45)
		{
			$('#rh_relation').val("44");
		}
		else if(avgs>45 && avgs<=45.5)
		{
			$('#rh_relation').val("45");
		}
		else if(avgs>45.5 && avgs<=46)
		{
			$('#rh_relation').val("46");
		}
		else if(avgs>46 && avgs<=46.5)
		{
			$('#rh_relation').val("47");
		}
		else if(avgs>46.5 && avgs<=47)
		{
			$('#rh_relation').val("48");
		}
		else if(avgs>47 && avgs<=47.5)
		{
			$('#rh_relation').val("49");
		}
		else if(avgs>47.5 && avgs<=48)
		{
			$('#rh_relation').val("50");
		}
		else if(avgs>48 && avgs<=48.5)
		{
			$('#rh_relation').val("51");
		}
		else if(avgs>48.5 && avgs<=49)
		{
			$('#rh_relation').val("52");
		}
		else if(avgs>49 && avgs<=49.5)
		{
			$('#rh_relation').val("53");
		}
		else if(avgs>49.5 && avgs<=50)
		{
			$('#rh_relation').val("54");
		}		
		else if(avgs>50 && avgs<=50.5)
		{
			$('#rh_relation').val("55");
		}
		else if(avgs>50.5 && avgs<=51)
		{
			$('#rh_relation').val("56");
		}
		else if(avgs>51 && avgs<=51.5)
		{
			$('#rh_relation').val("57");
		}
		else if(avgs>51.5 && avgs<=52)
		{
			$('#rh_relation').val("58");
		}
		else if(avgs>52 && avgs<=52.5)
		{
			$('#rh_relation').val("59");
		}
		else if(avgs>52.5 && avgs<=53)
		{
			$('#rh_relation').val("60");
		}
		else if(avgs>53 && avgs<=53.5)
		{
			$('#rh_relation').val("61");
		}
		else if(avgs>53.5 && avgs<=54)
		{
			$('#rh_relation').val("62");
		}
		else if(avgs>54 && avgs<=54.5)
		{
			$('#rh_relation').val("63");
		}
		else if(avgs>54.5 && avgs<=55)
		{
			$('#rh_relation').val("64");
		}
		else if(avgs>55)
		{
			$('#rh_relation').val("> 64");
		}
		
		
	
	
	var rel = $('#rh_relation').val();
	var cal1 = ((+rel) * (+80)) / 100;
	$('#rh_verticle').val(cal1.toFixed(2));
	}
	else if(rh_direction=="Vertical-Down")
	{
		if(avgs<20)
		{
			$('#rh_relation').val("< 14");
		}
		else if(avgs>=20 && avgs<=20.5)
		{
			$('#rh_relation').val("14");
		}
		else if(avgs>20.5 && avgs<=21)
		{
			$('#rh_relation').val("15");
		}
		else if(avgs>21 && avgs<=21.5)
		{
			$('#rh_relation').val("16");
		}
		else if(avgs>21.5 && avgs<=22)
		{
			$('#rh_relation').val("17");
		}
		else if(avgs>22 && avgs<=22.5)
		{
			$('#rh_relation').val("18");
		}
		else if(avgs>22.5 && avgs<=23)
		{
			$('#rh_relation').val("19");
		}
		else if(avgs>23 && avgs<=23.5)
		{
			$('#rh_relation').val("19");
		}
		else if(avgs>23.5 && avgs<=24)
		{
			$('#rh_relation').val("20");
		}
		else if(avgs>24 && avgs<=24.5)
		{
			$('#rh_relation').val("20");
		}
		else if(avgs>24.5 && avgs<=25)
		{
			$('#rh_relation').val("21");
		}
		else if(avgs>25 && avgs<=25.5)
		{
			$('#rh_relation').val("21");
		}
		else if(avgs>25.5 && avgs<=26)
		{
			$('#rh_relation').val("22");
		}
		else if(avgs>26 && avgs<=26.5)
		{
			$('#rh_relation').val("23");
		}
		else if(avgs>26.5 && avgs<=27)
		{
			$('#rh_relation').val("24");
		}
		else if(avgs>27 && avgs<=27.5)
		{
			$('#rh_relation').val("25");
		}
		else if(avgs>27.5 && avgs<=28)
		{
			$('#rh_relation').val("26");
		}
		else if(avgs>28 && avgs<=28.5)
		{
			$('#rh_relation').val("27");
		}
		else if(avgs>28.5 && avgs<=29)
		{
			$('#rh_relation').val("28");
		}
		else if(avgs>29 && avgs<=29.5)
		{
			$('#rh_relation').val("29");
		}
		else if(avgs>29.5 && avgs<=30)
		{
			$('#rh_relation').val("30");
		}
		else if(avgs>30 && avgs<=30.5)
		{
			$('#rh_relation').val("31");
		}
		else if(avgs>30.5 && avgs<=31)
		{
			$('#rh_relation').val("32");
		}
		else if(avgs>31 && avgs<=31.5)
		{
			$('#rh_relation').val("33");
		}
		else if(avgs>31.5 && avgs<=32)
		{
			$('#rh_relation').val("34");
		}
		else if(avgs>32 && avgs<=32.5)
		{
			$('#rh_relation').val("35");
		}
		else if(avgs>32.5 && avgs<=33)
		{
			$('#rh_relation').val("36");
		}
		else if(avgs>33 && avgs<=33.5)
		{
			$('#rh_relation').val("37");
		}
		else if(avgs>33.5 && avgs<=34)
		{
			$('#rh_relation').val("38");
		}
		else if(avgs>34 && avgs<=34.5)
		{
			$('#rh_relation').val("39");
		}
		else if(avgs>34.5 && avgs<=35)
		{
			$('#rh_relation').val("40");
		}
		else if(avgs>35 && avgs<=35.5)
		{
			$('#rh_relation').val("40");
		}
		else if(avgs>35.5 && avgs<=36)
		{
			$('#rh_relation').val("41");
		}
		else if(avgs>36 && avgs<=36.5)
		{
			$('#rh_relation').val("41");
		}
		else if(avgs>36.5 && avgs<=37)
		{
			$('#rh_relation').val("42");
		}
		else if(avgs>37 && avgs<=37.5)
		{
			$('#rh_relation').val("43");
		}
		else if(avgs>37.5 && avgs<=38)
		{
			$('#rh_relation').val("44");
		}
		else if(avgs>38 && avgs<=38.5)
		{
			$('#rh_relation').val("45");
		}
		else if(avgs>38.5 && avgs<=39)
		{
			$('#rh_relation').val("46");
		}
		else if(avgs>39 && avgs<=39.5)
		{
			$('#rh_relation').val("47");
		}
		else if(avgs>39.5 && avgs<=40)
		{
			$('#rh_relation').val("48");
		}		
		else if(avgs>40 && avgs<=40.5)
		{
			$('#rh_relation').val("49");
		}
		else if(avgs>40.5 && avgs<=41)
		{
			$('#rh_relation').val("50");
		}
		else if(avgs>41 && avgs<=41.5)
		{
			$('#rh_relation').val("51");
		}
		else if(avgs>41.5 && avgs<=42)
		{
			$('#rh_relation').val("52");
		}
		else if(avgs>42 && avgs<=42.5)
		{
			$('#rh_relation').val("53");
		}
		else if(avgs>42.5 && avgs<=43)
		{
			$('#rh_relation').val("54");
		}
		else if(avgs>43 && avgs<=43.5)
		{
			$('#rh_relation').val("55");
		}
		else if(avgs>43.5 && avgs<=44)
		{
			$('#rh_relation').val("56");
		}
		else if(avgs>44 && avgs<=44.5)
		{
			$('#rh_relation').val("57");
		}
		else if(avgs>44.5 && avgs<=45)
		{
			$('#rh_relation').val("58");
		}
		else if(avgs>45 && avgs<=45.5)
		{
			$('#rh_relation').val("59");
		}
		else if(avgs>45.5 && avgs<=46)
		{
			$('#rh_relation').val("60");
		}
		else if(avgs>46 && avgs<=46.5)
		{
			$('#rh_relation').val("61");
		}
		else if(avgs>46.5 && avgs<=47)
		{
			$('#rh_relation').val("62");
		}
		else if(avgs>47 && avgs<=47.5)
		{
			$('#rh_relation').val("63");
		}
		else if(avgs>47.5 && avgs<=48)
		{
			$('#rh_relation').val("64");
		}
		else if(avgs>48 && avgs<=48.5)
		{
			$('#rh_relation').val("65");
		}
		else if(avgs>48.5 && avgs<=49)
		{
			$('#rh_relation').val("66");
		}
		else if(avgs>49 && avgs<=49.5)
		{
			$('#rh_relation').val("67");
		}
		else if(avgs>49.5 && avgs<=50)
		{
			$('#rh_relation').val("68");
		}		
		else if(avgs>50 && avgs<=50.5)
		{
			$('#rh_relation').val("69");
		}
		else if(avgs>50.5 && avgs<=51)
		{
			$('#rh_relation').val("70");
		}
		else if(avgs>51)
		{
			$('#rh_relation').val(" > 70");
		}
	
	var cal2 = ((+rel) * (+20)) / 100;
	var finl = (+rel) + (+cal2);
	$('#rh_verticle').val(finl.toFixed(2));
	}
	else if(rh_direction=="Horizontal")
	{
		if(avgs<20)
		{
			$('#rh_relation').val("< 10");
		}
		else if(avgs>=20 && avgs<=20.5)
		{
			$('#rh_relation').val("10");
		}
		else if(avgs>20.5 && avgs<=21)
		{
			$('#rh_relation').val("12");
		}
		else if(avgs>21 && avgs<=21.5)
		{
			$('#rh_relation').val("12");
		}
		else if(avgs>21.5 && avgs<=22)
		{
			$('#rh_relation').val("13");
		}
		else if(avgs>22 && avgs<=22.5)
		{
			$('#rh_relation').val("13");
		}
		else if(avgs>22.5 && avgs<=23)
		{
			$('#rh_relation').val("14");
		}
		else if(avgs>23 && avgs<=23.5)
		{
			$('#rh_relation').val("15");
		}
		else if(avgs>23.5 && avgs<=24)
		{
			$('#rh_relation').val("16");
		}
		else if(avgs>24 && avgs<=24.5)
		{
			$('#rh_relation').val("17");
		}
		else if(avgs>24.5 && avgs<=25)
		{
			$('#rh_relation').val("18");
		}
		else if(avgs>25 && avgs<=25.5)
		{
			$('#rh_relation').val("19");
		}
		else if(avgs>25.5 && avgs<=26)
		{
			$('#rh_relation').val("20");
		}
		else if(avgs>26 && avgs<=26.5)
		{
			$('#rh_relation').val("20");
		}
		else if(avgs>26.5 && avgs<=27)
		{
			$('#rh_relation').val("21");
		}
		else if(avgs>27 && avgs<=27.5)
		{
			$('#rh_relation').val("21");
		}
		else if(avgs>27.5 && avgs<=28)
		{
			$('#rh_relation').val("22");
		}
		else if(avgs>28 && avgs<=28.5)
		{
			$('#rh_relation').val("23");
		}
		else if(avgs>28.5 && avgs<=29)
		{
			$('#rh_relation').val("24");
		}
		else if(avgs>29 && avgs<=29.5)
		{
			$('#rh_relation').val("25");
		}
		else if(avgs>29.5 && avgs<=30)
		{
			$('#rh_relation').val("26");
		}
		else if(avgs>30 && avgs<=30.5)
		{
			$('#rh_relation').val("27");
		}
		else if(avgs>30.5 && avgs<=31)
		{
			$('#rh_relation').val("28");
		}
		else if(avgs>31 && avgs<=31.5)
		{
			$('#rh_relation').val("28");
		}
		else if(avgs>31.5 && avgs<=32)
		{
			$('#rh_relation').val("29");
		}
		else if(avgs>32 && avgs<=32.5)
		{
			$('#rh_relation').val("29");
		}
		else if(avgs>32.5 && avgs<=33)
		{
			$('#rh_relation').val("30");
		}
		else if(avgs>33 && avgs<=33.5)
		{
			$('#rh_relation').val("31");
		}
		else if(avgs>33.5 && avgs<=34)
		{
			$('#rh_relation').val("32");
		}
		else if(avgs>34 && avgs<=34.5)
		{
			$('#rh_relation').val("33");
		}
		else if(avgs>34.5 && avgs<=35)
		{
			$('#rh_relation').val("34");
		}
		else if(avgs>35 && avgs<=35.5)
		{
			$('#rh_relation').val("35");
		}
		else if(avgs>35.5 && avgs<=36)
		{
			$('#rh_relation').val("36");
		}
		else if(avgs>36 && avgs<=36.5)
		{
			$('#rh_relation').val("37");
		}
		else if(avgs>36.5 && avgs<=37)
		{
			$('#rh_relation').val("38");
		}
		else if(avgs>37 && avgs<=37.5)
		{
			$('#rh_relation').val("38");
		}
		else if(avgs>37.5 && avgs<=38)
		{
			$('#rh_relation').val("39");
		}
		else if(avgs>38 && avgs<=38.5)
		{
			$('#rh_relation').val("39");
		}
		else if(avgs>38.5 && avgs<=39)
		{
			$('#rh_relation').val("40");
		}
		else if(avgs>39 && avgs<=39.5)
		{
			$('#rh_relation').val("41");
		}
		else if(avgs>39.5 && avgs<=40)
		{
			$('#rh_relation').val("42");
		}		
		else if(avgs>40 && avgs<=40.5)
		{
			$('#rh_relation').val("43");
		}
		else if(avgs>40.5 && avgs<=41)
		{
			$('#rh_relation').val("44");
		}
		else if(avgs>41 && avgs<=41.5)
		{
			$('#rh_relation').val("45");
		}
		else if(avgs>41.5 && avgs<=42)
		{
			$('#rh_relation').val("46");
		}
		else if(avgs>42 && avgs<=42.5)
		{
			$('#rh_relation').val("47");
		}
		else if(avgs>42.5 && avgs<=43)
		{
			$('#rh_relation').val("48");
		}
		else if(avgs>43 && avgs<=43.5)
		{
			$('#rh_relation').val("49");
		}
		else if(avgs>43.5 && avgs<=44)
		{
			$('#rh_relation').val("50");
		}
		else if(avgs>44 && avgs<=44.5)
		{
			$('#rh_relation').val("51");
		}
		else if(avgs>44.5 && avgs<=45)
		{
			$('#rh_relation').val("52");
		}
		else if(avgs>45 && avgs<=45.5)
		{
			$('#rh_relation').val("53");
		}
		else if(avgs>45.5 && avgs<=46)
		{
			$('#rh_relation').val("54");
		}
		else if(avgs>46 && avgs<=46.5)
		{
			$('#rh_relation').val("55");
		}
		else if(avgs>46.5 && avgs<=47)
		{
			$('#rh_relation').val("56");
		}
		else if(avgs>47 && avgs<=47.5)
		{
			$('#rh_relation').val("57");
		}
		else if(avgs>47.5 && avgs<=48)
		{
			$('#rh_relation').val("58");
		}
		else if(avgs>48 && avgs<=48.5)
		{
			$('#rh_relation').val("59");
		}
		else if(avgs>48.5 && avgs<=49)
		{
			$('#rh_relation').val("60");
		}
		else if(avgs>49 && avgs<=49.5)
		{
			$('#rh_relation').val("61");
		}
		else if(avgs>49.5 && avgs<=50)
		{
			$('#rh_relation').val("62");
		}		
		else if(avgs>50 && avgs<=50.5)
		{
			$('#rh_relation').val("63");
		}
		else if(avgs>50.5 && avgs<=51)
		{
			$('#rh_relation').val("64");
		}
		else if(avgs>51 && avgs<=51.5)
		{
			$('#rh_relation').val("65");
		}
		else if(avgs>51.5 && avgs<=52)
		{
			$('#rh_relation').val("66");
		}
		
		else if(avgs>52 && avgs<=52.5)
		{
			$('#rh_relation').val("67");
		}
		else if(avgs>52.5 && avgs<=53)
		{
			$('#rh_relation').val("68");
		}
		else if(avgs>53 && avgs<=53.5)
		{
			$('#rh_relation').val("68");
		}
		else if(avgs>53.5 && avgs<=54)
		{
			$('#rh_relation').val("69");
		}
		else if(avgs>54 && avgs<=54.5)
		{
			$('#rh_relation').val("69");
		}
		else if(avgs>54.5 && avgs<=55)
		{
			$('#rh_relation').val("70");
		}		
		else if(avgs>55)
		{
			$('#rh_relation').val(" > 70");
		}
	
	$('#rh_verticle').val("");
	}
});




$('#chk_auto').change(function(){
    if(this.checked)
	{
		$("#chk_rha").prop("checked", true);
		rha_auto();
	}
		
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
        url: '<?php echo $base_url; ?>save_rh.php',
        data: 'action_type=view&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
		success:function(html){
		$('#display_data').html(html);
		
        }
    });
	
	$.ajax({
        type: 'POST',
		dataType: 'JSON',
        url: '<?php echo $base_url; ?>save_rh.php',
         data: 'action_type=chk&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
			success:function(data){
            var save_data = data.total_row;
			var up_data = $('#rebound_qty').val();	
			
			if(save_data < up_data)
			{
				$('#btn_save').show();

			}
			else
			{
				$('#btn_save').hide();

			}

        }
    });
}

function ccDelete(id)
{
		var lab_no = $('#lab_no').val(); 
		var job_no = $('#job_no').val(); 
	 $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_rh.php',
        data: 'action_type=delete&id='+id+'&lab_no='+lab_no+'&job_no='+job_no,
		dataType: 'JSON',
        success:function(msg){
         
               getGlazedTiles();
			   location.reload();
				
	
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
				var grade = $('#grade').val();
				var dia = $('#dia').val();
				var brand = $('#brand').val();				
				var sample_qty = $('#sample_qty').val();				
				var heat_no = $('#heat_no').val();				
				var tag_heading = $('#tag_heading').val();				
				var tag_data = $('#tag_data').val();
				var ulr = $('#ulr').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");
				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="rha")
					{
						if(document.getElementById('chk_rha').checked) {
								var chk_rha = "1";
						}
						else{
								var chk_rha = "0";
						}
						var rh_location = $('#rh_location').val();
						var rh_cast_date = $('#rh_cast_date').val();
						var rh_r1 = $('#rh_r1').val();
						var rh_r2 = $('#rh_r2').val();
						var rh_r3 = $('#rh_r3').val();
						var rh_r4 = $('#rh_r4').val();
						var rh_r5 = $('#rh_r5').val();
						var rh_r6 = $('#rh_r6').val();
						var rh_r7 = $('#rh_r7').val();
						var rh_r8 = $('#rh_r8').val();
						var rh_r9 = $('#rh_r9').val();
						var rh_r10 = $('#rh_r10').val();
						var avg_r_num = $('#avg_r_num').val();
						var std_dev = $('#std_dev').val();
						var rh_max = $('#rh_max').val();
						var rh_min = $('#rh_min').val();
						var rh_range = $('#rh_range').val();
						var rh_rs = $('#rh_rs').val();
						var rh_level = $('#rh_level').val();
						var rh_out = $('#rh_out').val();
						var rh_relation = $('#rh_relation').val();
						var rh_verticle = $('#rh_verticle').val();
						var rh_age = $('#rh_age').val();
						var rh_rcc = $('#rh_rcc').val();
						var rh_direction = $('#rh_direction').val();
						var temp = $('#temp').val();
						var grade1 = $('#grade1').val();
						break;
					
					}
					else
					{
						var chk_rha = "0";
						var rh_location = "0";
						var rh_cast_date = "0";
						var rh_r1 = "0";
						var rh_r2 = "0";
						var rh_r3 = "0";
						var rh_r4 = "0";
						var rh_r5 = "0";
						var rh_r6 = "0";
						var rh_r7 = "0";
						var rh_r8 = "0";
						var rh_r9 = "0";
						var rh_r10 = "";
						var avg_r_num = "0";
						var std_dev = "0";
						var rh_max = "0";
						var rh_min = "0";
						var rh_range = "0";
						var rh_rs = "0";
						var rh_level = "0";
						var rh_out = "0";
						var rh_relation = "0";
						var rh_verticle = "0";
						var rh_age = "0";
						var rh_rcc = "0";
						var rh_direction = "0";
						var temp = "0";
						var grade1 = "0";
					}
														
				}
				billData = '&action_type='+type+'&report_no='+report_no+'&ulr='+ulr+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_rha='+chk_rha+'&rh_location='+rh_location+'&rh_cast_date='+rh_cast_date+'&rh_r1='+rh_r1+'&rh_r2='+rh_r2+'&rh_r3='+rh_r3+'&rh_r4='+rh_r4+'&rh_r5='+rh_r5+'&rh_r6='+rh_r6+'&rh_r7='+rh_r7+'&rh_r8='+rh_r8+'&rh_r9='+rh_r9+'&rh_r10='+rh_r10+'&avg_r_num='+avg_r_num+'&std_dev='+std_dev+'&rh_max='+rh_max+'&rh_min='+rh_min+'&rh_range='+rh_range+'&rh_rs='+rh_rs+'&rh_level='+rh_level+'&rh_out='+rh_out+'&rh_relation='+rh_relation+'&rh_verticle='+rh_verticle+'&rh_age='+rh_age+'&rh_rcc='+rh_rcc+'&rh_direction='+rh_direction+'&temp='+temp+'&grade1='+grade1;
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var grade = $('#grade').val();
				var dia = $('#dia').val();
				var brand = $('#brand').val();
				var sample_qty = $('#sample_qty').val();				
				var heat_no = $('#heat_no').val();
				var ulr = $('#ulr').val();
				var tag_heading = $('#tag_heading').val();
				var tag_data = $('#tag_data').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");
				
				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="rha")
					{
						if(document.getElementById('chk_rha').checked) {
								var chk_rha = "1";
						}
						else{
								var chk_rha = "0";
						}
						var rh_location = $('#rh_location').val();
						var rh_cast_date = $('#rh_cast_date').val();
						var rh_r1 = $('#rh_r1').val();
						var rh_r2 = $('#rh_r2').val();
						var rh_r3 = $('#rh_r3').val();
						var rh_r4 = $('#rh_r4').val();
						var rh_r5 = $('#rh_r5').val();
						var rh_r6 = $('#rh_r6').val();
						var rh_r7 = $('#rh_r7').val();
						var rh_r8 = $('#rh_r8').val();
						var rh_r9 = $('#rh_r9').val();
						var rh_r10 = $('#rh_r10').val();
						var avg_r_num = $('#avg_r_num').val();
						var std_dev = $('#std_dev').val();
						var rh_max = $('#rh_max').val();
						var rh_min = $('#rh_min').val();
						var rh_range = $('#rh_range').val();
						var rh_rs = $('#rh_rs').val();
						var rh_level = $('#rh_level').val();
						var rh_out = $('#rh_out').val();
						var rh_relation = $('#rh_relation').val();
						var rh_verticle = $('#rh_verticle').val();
						var rh_age = $('#rh_age').val();
						var rh_rcc = $('#rh_rcc').val();
						var rh_direction = $('#rh_direction').val();
						var temp = $('#temp').val();
						var grade1 = $('#grade1').val();
						break;
					}
					else
					{
						var chk_rha = "0";
						var rh_location = "0";
						var rh_cast_date = "0";
						var rh_r1 = "0";
						var rh_r2 = "0";
						var rh_r3 = "0";
						var rh_r4 = "0";
						var rh_r5 = "0";
						var rh_r6 = "0";
						var rh_r7 = "0";
						var rh_r8 = "0";
						var rh_r9 = "0";
						var rh_r10 = "0";
						var avg_r_num = "0";
						var std_dev = "0";
						var rh_max = "0";
						var rh_min = "0";
						var rh_range = "0";
						var rh_rs = "0";
						var rh_level = "0";
						var rh_out = "0";
						var rh_relation = "0";
						var rh_verticle = "0";
						var rh_age = "0";
						var rh_rcc = "0";
						var rh_direction = "0";
						var temp = "0";
						var grade1 = "0";
					}
														
				}
				
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&ulr='+ulr+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_rha='+chk_rha+'&rh_location='+rh_location+'&rh_cast_date='+rh_cast_date+'&rh_r1='+rh_r1+'&rh_r2='+rh_r2+'&rh_r3='+rh_r3+'&rh_r4='+rh_r4+'&rh_r5='+rh_r5+'&rh_r6='+rh_r6+'&rh_r7='+rh_r7+'&rh_r8='+rh_r8+'&rh_r9='+rh_r9+'&rh_r10='+rh_r10+'&avg_r_num='+avg_r_num+'&std_dev='+std_dev+'&rh_max='+rh_max+'&rh_min='+rh_min+'&rh_range='+rh_range+'&rh_rs='+rh_rs+'&rh_level='+rh_level+'&rh_out='+rh_out+'&rh_relation='+rh_relation+'&rh_verticle='+rh_verticle+'&rh_age='+rh_age+'&rh_rcc='+rh_rcc+'&rh_direction='+rh_direction+'&temp='+temp+'&grade1='+grade1;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_rh.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
		var sam_qty = $('#rebound_qty').val(); 
			 if(msg.row_count >= (+sam_qty)){
				//$('#btn_save').hide();
			}else{
				//$('#btn_save').show();
			} 
		var report_no = $('#report_no').val(); 
		var job_no = $('#job_no').val();
			//window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
			
			location.reload();
		getGlazedTiles();
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
        url: '<?php echo $base_url; ?>save_rh.php',
       data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			$('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
			$('#grade').val(data.grade);
            $('#dia').val(data.dia);
            $('#brand').val(data.brand);
            $('#sample_qty').val(data.sample_qty);
            $('#heat_no').val(data.heat_no);
            $('#ulr').val(data.ulr);
            $('#tag_data').val(data.tag_data);
            $('#tag_heading').val(data.tag_heading);
			
			
					var chk_rha = data.chk_rha;
					if(chk_rha=="1")
					{
						$('#txtrha').css("background-color","var(--primary)");	
						$("#chk_rha").prop("checked", true); 
					}else{
						$('#txtrha').css("background-color","white");	
						$("#chk_rha").prop("checked", false); 
					}
					$('#rh_location').val(data.rh_location);
					$('#rh_cast_date').val(data.rh_cast_date);
					$('#rh_r1').val(data.rh_r1);
					$('#rh_r2').val(data.rh_r2);
					$('#rh_r3').val(data.rh_r3);
					$('#rh_r4').val(data.rh_r4);
					$('#rh_r5').val(data.rh_r5);
					$('#rh_r6').val(data.rh_r6);
					$('#rh_r7').val(data.rh_r7);
					$('#rh_r8').val(data.rh_r8);
					$('#rh_r9').val(data.rh_r9);
					$('#rh_r1').val(data.rh_r1);
					$('#avg_r_num').val(data.avg_r_num);
					$('#std_dev').val(data.std_dev);
					$('#rh_max').val(data.rh_max);
					$('#rh_min').val(data.rh_min);
					$('#rh_range').val(data.rh_range);
					$('#rh_rs').val(data.rh_rs);
					$('#rh_level').val(data.rh_level);
					$('#rh_out').val(data.rh_out);
					$('#rh_relation').val(data.rh_relation);
					$('#rh_verticle').val(data.rh_verticle);
					$('#rh_age').val(data.rh_age);
					$('#rh_rcc').val(data.rh_rcc);
					$('#rh_direction').val(data.rh_direction);
					$('#temp').val(data.temp);
					$('#grade1').val(data.grade1);
				
			
			
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


function set_sample_qty(){
	var trf_no = $('#trf_no').val(); 
	var job_no= $('#job_no').val();
	var lab_no = $('#lab_no').val(); 
	var rebound_qty = $('#rebound_qty').val();
	
	$.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_rh.php',
		data: 'action_type=set_sample_qty&trf_no='+trf_no+'&job_no='+job_no+'&lab_no='+lab_no+'&rebound_qty='+rebound_qty,
		dataType: 'JSON',
        success:function(msg){
			if(msg.status == 'success'){
				alert('Sample QTY Set Successfull.');
				var cc_sample_qty_old = $('#cc_sample_qty_old').val();
				if((+rebound_qty > (+cc_sample_qty_old))){
					$('#btn_save').show();
				}else{
					$('#btn_save').hide();
				}
				location.reload();
			}else{
				alert('Sample QTY Set Failed.');
				location.reload();
			}
        }
    });
}

/*
$(document).on("change", "#l_1", function () {
				var clicked_id = $(this).val();  
			var multipling= parseFloat(clicked_id)*10000;	
			$('#len_1').val(multipling);
			alert("jjj"+multipling);
    
});	*/
	</script>