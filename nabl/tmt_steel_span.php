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
					
					$tmt_qty= $row_select4['tmt_qty'];
					
					$exp_dia = explode(",",$dia1);
					
					
				}
				$cnt_report = count($exp_dia);
				
				$query = "select * from tmt_steel WHERE lab_no='$aa'  and `is_deleted`='0'";

				$result = mysqli_query($conn, $query);											
				$save_report_cnt = mysqli_num_rows($result);
		
				$mt_split = explode(',',$dia1);
				$dia = $mt_split[$save_report_cnt];
		
				$chain_exp = explode(',',$grade1);
				$grade = $chain_exp[$save_report_cnt];
				
				$chain1_exp = explode(',',$brand1);
				$brand = $chain1_exp[$save_report_cnt];
				
				$sample_exp = explode(',',$sample_qty1);
				$sample_qty = $sample_exp[$save_report_cnt];
				
				$heat_exp = explode(',',$heat_no1);
				$heat_no = $heat_exp[$save_report_cnt];
				
				$test="";
				$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
		
				$test.=$r1['test_name'].",";
		
		}
		
		/*$select_query11 = "select chk_len from span_material_assign,job,tmt_steel WHERE 
		
		tmt_steel.lab_no = span_material_assign.lab_no and  
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
							<h2  style="text-align:center;">TMT Steel</h2>
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
										<label for="inputEmail3" class="col-sm-2 control-label">DIA QUANTITY:</label>
										<div class="col-sm-10">											
											<input type="hidden" class="form-control" tabindex="1"  value="<?php echo $job_no;?>" id="job_no" name="job_no" ReadOnly>
											<input type="text" class="form-control" tabindex="1"  value="<?php echo $cnt_report;?>" id="report_cnt" name="report_cnt" ReadOnly>
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
										<label for="inputEmail3" class="col-sm-2 control-label">grade :</label>
										<div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="cur_grade" value="<?php echo $grade1;?>" name="cur_grade" ReadOnly>
											
										</div>
										<div class="col-sm-5">
											
											<input type="text" class="form-control inputs" tabindex="4" id="grade" value="<?php echo $grade;?>" name="grade" ReadOnly>
										</div>
									</div>
								</div>
							</div>
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Dia :</label>
										<div class="col-sm-4">
											<input type="text" class="form-control inputs" tabindex="4" id="cur_dia" value="<?php echo $dia1;?>" name="cur_dia" ReadOnly>
										</div>
										<div class="col-sm-4">
											<input type="text" class="form-control inputs" tabindex="4" id="dia" value="<?php echo $dia;?>" name="dia" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">brand :</label>
										<div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="cur_brand" value="<?php echo $brand1;?>" name="cur_brand" ReadOnly>
										</div>
										<div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="brand" value="<?php echo $brand;?>" name="brand" ReadOnly>
										</div>
									</div>
								</div>
							</div>
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Sample Quantity :</label>
										<div class="col-sm-4">
											<input type="text" class="form-control inputs" tabindex="4" id="cur_sample_qty" value="<?php echo $sample_qty1;?>" name="cur_sample_qty" ReadOnly>
										</div>
										<div class="col-sm-4">
											<input type="text" class="form-control inputs" tabindex="4" id="sample_qty" value="<?php echo $sample_qty;?>" name="sample_qty" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Heat No. :</label>
										<div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="cur_heat_no" value="<?php echo $heat_no1;?>" name="cur_cur_heat_nobrand" ReadOnly>
										</div>
										<div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="heat_no" value="<?php echo $heat_no;?>" name="heat_no" ReadOnly>
										</div>
									</div>
								</div>
							</div>
							<br>
						<div class="row">
						<div class="col-lg-6">
										<div class="form-group">
										 <div class="col-sm-4">
													<label>Amend Date. :</label>
												</div>								 
										  <div class="col-sm-8">
											<input type="text" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
										  </div>
										</div>
									</div>
						</div>
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Set Length (1000):</label>
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Test List :</label>-->
										<div class="col-sm-10">
											<input type="checkbox"  name="chk_auto"  id="chk_len" value="chk_len" <?php
												
											
											?>>
											<input type="hidden" class="form-control inputs" tabindex="4" id="test" value="<?php echo $test;?>" name="test" ReadOnly>
										</div>
									</div>
								</div>	
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No. :</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
										</div>
									</div>
								</div>
							</div>
							
							<hr>
															<!--Nikunj Code Start-->
<?php 
  $is_upload = "select * from span_material_assign WHERE `trf_no`='$trf_no' and `job_number`='$job_no'and isdeleted='0'"; 
  
  $result_upload = mysqli_query($conn, $is_upload);
	if(mysqli_num_rows($result_upload)>0){ 
	
	
	?>
		
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
	<?php }	 ?>
								

								
							
							  	<?php
					$test_check;
					$select_query12 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
						$result_select12 = mysqli_query($conn, $select_query12);
						while($r12 = mysqli_fetch_array($result_select12)){
							
							if($r12['test_code']=="oes")
							{
								$test_check.="oes,";
			?>
							
								<div class="panel panel-default" id="chem">
									<div class="panel-heading" id="txtchem">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
												<h4 class="panel-title">
												<b>CHEMICAL PROPERTIES</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse2" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">
										<div class="col-lg-8">
												<div class="form-group">
														<div class="col-sm-1">
															<label for="chk_chem">2.</label>
															<input type="checkbox" class="visually-hidden" name="chk_chem"  id="chk_chem" value="chk_chem"><br>
														</div>
													<label for="inputEmail3" class="col-sm-4 control-label label-right">CHEMICAL PROPERTIES</label>
												</div>
											</div>
									</div>
								</div>
							</div>
							
											<br>
								
												<div class="row">
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">C (%)</label>	
															</div>
															
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Si (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Mn (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">P (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">S (%)</label>	
															</div>
															
															
														</div>
													</div>
													
													
													
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Cr (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Mo (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Ni (%)</label>	
															</div>
															
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Cu (%)</label>	
															</div>
															
															
															
														</div>
													</div>
													
													
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Nb (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">V (%)</label>	
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">B (%)</label>	
															</div>
															
														</div>
													</div>
													
												</div>																												
												<br>
												<div class="row">
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c1" name="c1">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c4" name="c4">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c5" name="c5">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c3" name="c3">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c2" name="c2">
															</div>
															
															
														</div>
													</div>
													
													
													
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c6" name="c6">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c9" name="c9">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c8" name="c8">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c7" name="c7">
															</div>
															
															
														</div>
													</div>
												
													
													
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c10" name="c10">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c11" name="c11">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c12" name="c12">
															</div>
															
															
														</div>
													</div>
													
													
												</div>
												<br>
											
											
											
											<div class="row">
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Ti (%)</label>	
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12s control-label" style="text-align:center;">N (%)</label>	
															</div>
															
														</div>
													</div>
												</div>	
												<br>
												<div class="row">
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c13" name="c13">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c14" name="c14">
															</div>
															
															
														</div>
													</div>
												</div>	

												<div class="row">
													<div class="col-md-6">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Sample Id</label>
															</div>
															
															
														</div>
													</div>
													<div class="col-md-6">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;" class="form-control inputs col-sm-12" tabindex="4" id="labno2" name="labno2">
															</div>
															
															
														</div>
													</div>
												</div>	
								
											
											
											
										</div>
									</div>
								</div>
						<?php
						}
						if($r12['test_code']=="phy" || $r12['test_code']=="stb"  )
							{
								$test_check.="phy,";
						
						?>
						<div class="panel panel-default" id="phy">
									<div class="panel-heading" id="txtphy">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
												<h4 class="panel-title">
												<b>PHYSICAL PROPERTIES</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse1" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
											
											<div class="col-lg-8">
												<div class="form-group">
														<div class="col-sm-1">
															<label for="chk_phy">1.</label>
															<input type="checkbox" class="visually-hidden" name="chk_phy"  id="chk_phy" value="chk_phy"><br>
														</div>
													<label for="inputEmail3" class="col-sm-4 control-label label-right">PHYSICAL PROPERTIES</label>
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label for="inputEmail3" class="control-label label-right">TEMPERATURE (°C)</label>
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<input type="text" class="form-control inputs" tabindex="1" id="phy_temp" name="phy_temp">
												</div>
											</div>
											
											</div>
							
											<br>
								
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<div class="col-md-3">
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label">Lab No.</label>	
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Sample Id</label>
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Section 
															(Nominal) Dimension, mm</label>	
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Wt. of Bar (gm)</label>	
															</div>
															</div>
															<div class="col-md-3">
															<div class="col-md-3">
															<label for="inputEmail3" class="control-label" style="text-align:center;">Length (mm)</label>	
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Area  (mm<sup>2</sup>)</label>
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Initial Gauge length (5.65&Sqrt;A) mm	</label>	
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Yield Load (N)</label>	
															</div>
															</div>
															<div class="col-md-3">
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Tensile Load (N)</label>
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Yield Stress (N/mm<sup>2</sup>)</label>
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Tensile Stress (N/mm<sup>2</sup>)</label>
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Initial Gauge length (5.65&Sqrt;A) mm</label>	
															</div>
															</div>
															<div class="col-md-3">
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Final Gauge length f<sub>1</sub>(mm)</label>	
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Elongation (%)</label>
															</div>
															
															
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Bend Test 180 &deg;</label>
															</div>
															
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-1 control-label" style="text-align:center;">Re Bend Test</label>
															</div>
															
															
															</div>
														</div>
													</div>
												</div>								
								
											<br>
												<div class="row one" id="one">	
													<div class="col-md-12">
													
														<div class="form-group">
																<div class="col-md-3">
																<div class="col-md-3">
																<div id="ch1" name="ch1">
																	
																		<!--<input type="checkbox" name="chk1"  id="chk1" value="chk1">1.-->
																		
																	<label for="chk1">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk1"  id="chk1" value="chk1"><br>
																
											
																	</div>
																</div>
															
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="labno1" name="labno1">
																</div>
															
																<div class="col-md-3">
																	<select class="form-control" style="text-align:center;width:65px" id="dia_1" name="dia_1" readonly disabled>
																		<option value="4 MM">4 MM</option>
																		<option value="5 MM">5 MM</option>
																		<option value="6 MM">6 MM</option>
																		<option value="8 MM">8 MM</option>
																		<option value="10 MM">10 MM</option>
																		<option value="12 MM">12 MM</option>
																		<option value="16 MM">16 MM</option>
																		<option value="20 MM">20 MM</option>
																		<option value="25 MM">25 MM</option>										
																		<option value="28 MM">28 MM</option>										
																		<option value="32 MM">32 MM</option>
																		<option value="36 MM">36 MM</option>
																		<option value="40 MM">40 MM</option>
																		<option value="45 MM">45 MM</option>
																		<option value="50 MM">50 MM</option>
																	</select>
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="w_1" name="w_1">
																	<input type="hidden" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="len_1" name="len_1" reaDONLY>
																	<input type="hidden" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="samp_1" name="samp_1">
																</div>
																</div>
																<div class="col-md-3">
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px"  class="form-control inputs" tabindex="4" id="l_1" name="l_1">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="cs_1" name="cs_1" readonly>
																</div>
																
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="gl_1" name="gl_1" >
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="yp_1" name="yp_1">
																</div>
																</div>
																
																
																<div class="col-md-3">
																<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="up_1" name="up_1">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ys_1" name="ys_1">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ten_1" name="ten_1">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="og_1" name="og_1" readonly>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="fg_1" name="fg_1">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="elo_1" name="elo_1">
																	</div>
																	
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="bend_1" name="bend_1">
																	</div>
																	
																	
																		
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="rebend_1" name="rebend_1">
																	</div>
																	
																	
																	
																	
																	
																</div>
																
															
															</div>
													
													</div>
												</div>
							
											<br>
												<div class="row two" id="two">	
														<div class="col-md-12">
									
														<div class="form-group">
																<div class="col-md-3">
																<div class="col-md-3">
																<div id="ch2" name="ch2">
																	
																		<input type="checkbox" name="chk2"  id="chk2" value="chk2">2.
																	</div>
																</div>
															
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="labno2" name="labno2">
																</div>
															
																<div class="col-md-3">
																	<select class="form-control" style="text-align:center;width:65px" id="dia_2" name="dia_2">
																		<option value="8 MM">8 MM</option>
																		<option value="10 MM">10 MM</option>
																		<option value="12 MM">12 MM</option>
																		<option value="16 MM">16 MM</option>
																		<option value="20 MM">20 MM</option>
																		<option value="25 MM">25 MM</option>										
																		<option value="32 MM">32 MM</option>
																	</select>
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="w_2" name="w_2">
																</div>
																</div>
																<div class="col-md-3">
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px"  class="form-control inputs" tabindex="4" id="l_2" name="l_2">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="cs_2" name="cs_2">
																</div>
																
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="gl_2" name="gl_2">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="yp_2" name="yp_2">
																</div>
																</div>
																
																
																<div class="col-md-3">
																<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="up_2" name="up_2">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ys_2" name="ys_2">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ten_2" name="ten_2">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="og_2" name="og_2">
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="fg_2" name="fg_2">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="elo_2" name="elo_2">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="bend_2" name="bend_2">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="rebend_2" name="rebend_2">
																	</div>
																</div>
																
															
															</div>
													
														</div>
												</div>
							
											<br>
												<div class="row three" id="three">	
													<div class="col-md-12">
														
														<div class="form-group">
																<div class="col-md-3">
																<div class="col-md-3">
																<div id="ch3" name="ch3">
																	
																		<input type="checkbox" name="chk3"  id="chk3" value="chk3">3.
																	</div>
																</div>
															
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="labno3" name="labno3">
																</div>
															
																<div class="col-md-3">
																	<select class="form-control" style="text-align:center;width:65px" id="dia_3" name="dia_3">
																		<option value="8 MM">8 MM</option>
																		<option value="10 MM">10 MM</option>
																		<option value="12 MM">12 MM</option>
																		<option value="16 MM">16 MM</option>
																		<option value="20 MM">20 MM</option>
																		<option value="25 MM">25 MM</option>										
																		<option value="32 MM">32 MM</option>
																	</select>
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="w_3" name="w_3">
																</div>
																</div>
																<div class="col-md-3">
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px"  class="form-control inputs" tabindex="4" id="l_3" name="l_3">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="cs_3" name="cs_3">
																</div>
																
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="gl_3" name="gl_3">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="yp_3" name="yp_3">
																</div>
																</div>
																
																
																<div class="col-md-3">
																<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="up_3" name="up_3">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ys_3" name="ys_3">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ten_3" name="ten_3">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="og_3" name="og_3">
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="fg_3" name="fg_3">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="elo_3" name="elo_3">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="bend_3" name="bend_3">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="rebend_3" name="rebend_3">
																	</div>
																</div>
																
															
															</div>
													
													</div>
												</div>
								
											<br>
												<div class="row four" id="four">	
													<div class="col-md-12">
														
														<div class="form-group">
																<div class="col-md-3">
																<div class="col-md-3">
																<div id="ch4" name="ch4">
																	
																		<input type="checkbox" name="chk4"  id="chk4" value="chk4">4.
																	</div>
																</div>
															
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="labno4" name="labno4">
																</div>
															
																<div class="col-md-3">
																	<select class="form-control" style="text-align:center;width:65px" id="dia_4" name="dia_4">
																		<option value="8 MM">8 MM</option>
																		<option value="10 MM">10 MM</option>
																		<option value="12 MM">12 MM</option>
																		<option value="16 MM">16 MM</option>
																		<option value="20 MM">20 MM</option>
																		<option value="25 MM">25 MM</option>										
																		<option value="32 MM">32 MM</option>
																	</select>
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="w_4" name="w_4">
																</div>
																</div>
																<div class="col-md-3">
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px"  class="form-control inputs" tabindex="4" id="l_4" name="l_4">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="cs_4" name="cs_4">
																</div>
																
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="gl_4" name="gl_4">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="yp_4" name="yp_4">
																</div>
																</div>
																
																
																<div class="col-md-3">
																<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="up_4" name="up_4">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ys_4" name="ys_4">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ten_4" name="ten_4">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="og_4" name="og_4">
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="fg_4" name="fg_4">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="elo_4" name="elo_4">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="bend_4" name="bend_4">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="rebend_4" name="rebend_4">
																	</div>
																</div>
																
															
															</div>
													
													</div>
												</div>
											<br>
												<div class="row five" id="five">
													<div class="col-md-12">
														
														<div class="form-group">
																<div class="col-md-3">
																<div class="col-md-3">
																<div id="ch5" name="ch5">
																	
																		<input type="checkbox" name="chk5"  id="chk5" value="chk5">5.
																	</div>
																</div>
															
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="labno5" name="labno5">
																</div>
															
																<div class="col-md-3">
																	<select class="form-control" style="text-align:center;width:65px" id="dia_5" name="dia_5">
																		<option value="8 MM">8 MM</option>
																		<option value="10 MM">10 MM</option>
																		<option value="12 MM">12 MM</option>
																		<option value="16 MM">16 MM</option>
																		<option value="20 MM">20 MM</option>
																		<option value="25 MM">25 MM</option>										
																		<option value="32 MM">32 MM</option>
																	</select>
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="w_5" name="w_5">
																</div>
																</div>
																<div class="col-md-3">
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px"  class="form-control inputs" tabindex="4" id="l_5" name="l_5">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="cs_5" name="cs_5">
																</div>
																
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="gl_5" name="gl_5">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="yp_5" name="yp_5">
																</div>
																</div>
																
																
																<div class="col-md-3">
																<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="up_5" name="up_5">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ys_5" name="ys_5">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ten_5" name="ten_5">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="og_5" name="og_5">
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="fg_5" name="fg_5">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="elo_5" name="elo_5">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="bend_5" name="bend_5">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="rebend_5" name="rebend_5">
																	</div>
																</div>
																
															
															</div>
													
													</div>
												</div>
		
											<br>
												<div class="row six" id="six">	
													<div class="col-md-12">
														
														<div class="form-group">
																<div class="col-md-3">
																<div class="col-md-3">
																<div id="ch4" name="ch4">
																	
																		<input type="checkbox" name="chk6"  id="chk6" value="chk6">6.
																	</div>
																</div>
															
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="labno6" name="labno6">
																</div>
															
																<div class="col-md-3">
																	<select class="form-control" style="text-align:center;width:65px" id="dia_6" name="dia_6">
																		<option value="8 MM">8 MM</option>
																		<option value="10 MM">10 MM</option>
																		<option value="12 MM">12 MM</option>
																		<option value="16 MM">16 MM</option>
																		<option value="20 MM">20 MM</option>
																		<option value="25 MM">25 MM</option>										
																		<option value="32 MM">32 MM</option>
																	</select>
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="w_6" name="w_6">
																</div>
																</div>
																<div class="col-md-3">
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px"  class="form-control inputs" tabindex="4" id="l_6" name="l_6">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="cs_6" name="cs_6">
																</div>
																
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="gl_6" name="gl_6">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="yp_6" name="yp_6">
																</div>
																</div>
																
																
																<div class="col-md-3">
																<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="up_6" name="up_6">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ys_6" name="ys_6">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ten_6" name="ten_6">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="og_6" name="og_6">
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="fg_6" name="fg_6">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="elo_6" name="elo_6">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="bend_6" name="bend_6">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="rebend_6" name="rebend_6">
																	</div>
																</div>
																
															
															</div>
													
													</div>
												</div>
							
											<br>
												<div class="row seven" id="seven">	
													<div class="col-md-12">
														
														<div class="form-group">
																<div class="col-md-3">
																<div class="col-md-3">
																<div id="ch4" name="ch4">
																	
																		<input type="checkbox" name="chk7"  id="chk7" value="chk7">7.
																	</div>
																</div>
															
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="labno7" name="labno7">
																</div>
															
																<div class="col-md-3">
																	<select class="form-control" style="text-align:center;width:65px" id="dia_7" name="dia_7">
																		<option value="8 MM">8 MM</option>
																		<option value="10 MM">10 MM</option>
																		<option value="12 MM">12 MM</option>
																		<option value="16 MM">16 MM</option>
																		<option value="20 MM">20 MM</option>
																		<option value="25 MM">25 MM</option>										
																		<option value="32 MM">32 MM</option>
																	</select>
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="w_7" name="w_7">
																</div>
																</div>
																<div class="col-md-3">
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px"  class="form-control inputs" tabindex="4" id="l_7" name="l_7">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="cs_7" name="cs_7">
																</div>
																
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="gl_7" name="gl_7">
																</div>
																<div class="col-md-3">
																	<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="yp_7" name="yp_7">
																</div>
																</div>
																
																
																<div class="col-md-3">
																<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="up_7" name="up_7">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ys_7" name="ys_7">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="ten_7" name="ten_7">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="og_7" name="og_7">
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="fg_7" name="fg_7">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="elo_7" name="elo_7">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="bend_7" name="bend_7">
																	</div>
																	<div class="col-md-3">
																		<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="rebend_7" name="rebend_7">
																	</div>
																</div>
																
															
															</div>
													
													</div>
												</div>
							
										</div>
									</div>
								</div>
							
						
						<?php
						}
						if($r12['test_code']=="stb")
							{
								$test_check.="stb,";
							}
							if($r12['test_code']=="ben")
							{
								$test_check.="ben,";
							}
							if($r12['test_code']=="elo")
							{
								$test_check.="elo,";
							}
						}
						?>
						<div class="panel panel-default" id="rem">
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
								</div>
							</div>
							
							<br>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
									<div class="col-sm-2">
											<a href="javascript:void(0);" class="btn btn-info pull-right" onclick="confirm('Are you sure to delete data?')?ccDelete(<?php echo $r['id']; ?>):false;">DELETE ALL REPORT</a>
										</div>
									<div class="col-sm-1">
												<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="idEdit" id="idEdit"/>

											</div>
										<div class="col-sm-1">
											<!--<button type="button" class="btn btn-info pull-right" id="btn_auto" name="btn_auto" tabindex="14" >Auto</button>
											
											
											<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="id" id="idEdit"/>
										</div>
										<div class="col-sm-2">
											<!-- SAVE BUTTON LOGIC VAIBHAV-->
											
											<?php   
												/*$querys_job1 = "SELECT * FROM tmt_steel WHERE `is_deleted`='0' and lab_no='$lab_no'";
												$qrys_jobno = mysqli_query($conn,$querys_job1);
												$rows=mysqli_num_rows($qrys_jobno);
												if($rows < 1){ */?>
													<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
													<?php /*}*/													
														?>
										</div>
										
										<div class="col-sm-1">
											<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>
										</div>
										
										<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
										<?php
										$val1 =  $_SESSION['isadmin'];
										$val= explode(",",$val1);
			
										// Code For Reception 1	
											// if (in_array(0, $val) || in_array(5, $val) || in_array(6, $val))
											// {										
										?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/span_steel.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>&&ulr=<?php echo $ulr;?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Physical  Report</b></a>
										</div>
										 
										<!--<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/span_steel_chemical.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>&&ulr=<?php echo $ulr;?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Chemical  Report</b></a>
										</div-->
										 
										<?php //} ?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/span_steel.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
											
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
								<th style="text-align:center;"><label>Dia</label></th>	
								<th style="text-align:center;"><label>Heat No.</label></th>	
								<th style="text-align:center;"><label>Sample Id</label></th>	
								
																		

							</tr>
								<?php
							 $query = "select * from tmt_steel WHERE lab_no='$aa'  and `is_deleted`='0'";

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
										<td style="text-align:center;"><?php echo $r['dia'];?></td>					
										<td style="text-align:center;"><?php echo $r['heat_no'];?></td>					
										<td style="text-align:center;"><?php echo $r['labno1'];?></td>					
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
		<input type="text" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ',');?>">	
							
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
getGlazedTiles();	
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

$(function () {
    $('.select2').select2();
  })
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();	
	
	
	 

	$('#chk_phy').change(function(){
        if(this.checked)
		{
			$('#txtphy').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtphy').css("background-color","white");	
		}
		
	});
	
	$('#chk_chem').change(function(){
        if(this.checked)
		{
			$('#txtchem').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtchem').css("background-color","white");	
		}
		
	});
	
	var labno1;
	var labno2;
	var labno3;
	var labno4;
	var labno5;
	var labno6;
	var labno7;
	var dia_1;
	var dia_2;
	var dia_3;
	var dia_4;
	var dia_5;
	var dia_6;
	var dia_7;
	var w_1;
	var w_2;
	var w_3;
	var w_4;
	var w_5;
	var w_6;
	var w_7;
	var l_1;
	var l_2;
	var l_3;
	var l_4;
	var l_5;
	var l_6;
	var l_7;
	var cs_1;
	var cs_2;
	var cs_3;
	var cs_4;
	var cs_5;
	var cs_6;
	var cs_7;
	var gl_1;
	var gl_2;
	var gl_3;
	var gl_4;
	var gl_5;
	var gl_6;
	var gl_7;
	var yp_1;
	var yp_2;
	var yp_3;
	var yp_4;
	var yp_5;
	var yp_6;
	var yp_7;
	var up_1;
	var up_2;
	var up_3;
	var up_4;
	var up_5;
	var up_6;
	var up_7;
	var ys_1;
	var ys_2;
	var ys_3;
	var ys_4;
	var ys_5;
	var ys_6;
	var ys_7;
	var ten_1;
	var ten_2;
	var ten_3;
	var ten_4;
	var ten_5;
	var ten_6;
	var ten_7;
	var og_1;
	var og_2;
	var og_3;
	var og_4;
	var og_5;
	var og_6;
	var og_7;
	var fg_1;
	var fg_2;
	var fg_3;
	var fg_4;
	var fg_5;
	var fg_6;
	var fg_7;
	var elo_1;
	var elo_2;
	var elo_3;
	var elo_4;
	var elo_5;
	var elo_6;
	var elo_7;
	var bend_1;
	var bend_2;
	var bend_3;
	var bend_4;
	var bend_5;
	var bend_6;
	var bend_7;
	var rebend_1;
	var rebend_2;
	var rebend_3;
	var rebend_4;
	var rebend_5;
	var rebend_6;
	var rebend_7;
	var c1;
	var c2;
	var c3;
	var c4;
	var c5;
	var c6;
	var c7;
	var c8;
	var c9;
	var c10;
	var c11;
	var c12;
	var c13;
	var c14;
	var len_1;
	var samp_1;
	var lab_op = $('#lab_no').val();
	$('#one').show(); 
	$('#two').hide(); 
	$('#three').hide(); 
	$('#four').hide(); 
	$('#five').hide(); 
	$('#six').hide(); 
	$('#seven').hide(); 
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			
						$('#txtphy').css("background-color","var(--success)");
						$("#chk_phy").prop("checked", true); 
						$("#chk_chem").prop("checked", true); 
						$("#txtchem").css("background-color","var(--success)");
						chk1_data();
						chem_data();
				
		}
		
	});
	
	$('#ten_1,#samp_1,#w_1,#ys_1,#labno1').change(function(){
       
			
						$('#txtphy').css("background-color","var(--success)");
						
						
						
						
				
		
		
	});
	$('#c1,#c2,#c3,#c4').change(function(){
       
			
						$('#txtchem').css("background-color","var(--success)");
						
						
						
						
				
		
		
	});
	

	$('#chk_phy').change(function(){
        if(this.checked)
		{
			
			$('#one').show(); 
			/*$('#two').show(); 
			$('#three').show(); 
			$('#four').show(); 
			$('#five').show(); 
			$('#six').show(); 
			$('#seven').show(); */
			null_data(); 	
			
		}
		else
		{
			$('#one').hide(); 
			$('#two').hide(); 
			$('#three').hide(); 
			
			$('#four').hide(); 
			$('#five').hide(); 
			$('#six').hide(); 
			$('#seven').hide(); 
			 null_data();
		}
		
	});
	
	
	
	$('#ten_1').change(function(){
			
			 var ten_1=$('#ten_1').val();
			 var cs_1=$('#cs_1').val();
			 
			 var up_temp_1 = ((+ten_1)*(+cs_1));
			 var up_temp = Math.round(+up_temp_1) / 20;
			 var up_temp1 = Math.round(+up_temp) * 20;
			 $('#up_1').val(Math.ceil(up_temp1.toFixed()));
			 
			 var up1 = $('#up_1').val();
			  var ulti_ten_1 = ((+up1)) / (+cs_1);
			  $('#ten_1').val(ulti_ten_1.toFixed());
			
			
		
	});
	
	
	$('#ys_1').change(function(){
		 var cs_1=$('#cs_1').val();
		 var ys_1=$('#ys_1').val();
		 var yp_temp_1 = ((+ys_1)*(+cs_1));
		 var yp_temp = Math.round(+yp_temp_1) / 20;
		 var yp_temp1 = Math.round(+yp_temp) * 20;
		 $('#yp_1').val(Math.ceil(yp_temp1.toFixed()));
		 
		  var yp1 = $('#yp_1').val();
		   var yeld_s1 = ((+yp1)) / (+cs_1);
			$('#ys_1').val(yeld_s1.toFixed());
		 
	});
	
	$('#elo_1').change(function(){
		if ($('#chk_phy').prop('checked')) {
			ys1_elo1_w1();
		}
		else
		{
			
		}
	});
	
	$('#w_1').change(function(){
		if ($('#chk_phy').prop('checked')) {
			
			ys1_elo1_w1();
		}
		else
		{
			direct_input();
		}
	});
	
	$('#labno1').change(function(){
		if ($('#chk_phy').prop('checked')) {
			
		}
		else
		{
			direct_input();
		}
	});
	
	
	
	$('#l_1,#len_1').change(function(){
		if ($('#chk_phy').prop('checked')) {
			var lens=$('#l_1').val();
			$('#len_1').val(lens);
			
			ys1_elo1_w1();
		}
		else
		{
			direct_input();
		}
	});
	
	
	function get_count()
	{
		var lab_no = $('#lab_no').val(); 
		$.ajax({
        type: 'POST',
		dataType: 'JSON',
        url: '<?php echo $base_url; ?>save_span_steel.php',
         data: 'action_type=chk&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
			success:function(data){
            var save_data = data.total_row;
			
			if(save_data == "0")
			{
				$('#labno1').val("S1");
			}
			else
			{
				var ans = (+save_data)+1;
				$('#labno1').val("S"+ans);
			}
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
			for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="oes")
					{
						if(save_data == "0")
			{
				$('#labno2').val("S1");
			}
			else
			{
				var ans = (+save_data)+1;
				$('#labno2').val("S"+ans);
			}						
						break;
					}
														
				}
			
			

        }
    });
	
	}
	
	function ys1_elo1_w1()
	{
					//get_count();
					var sample1 = $("#dia_1 option:selected").val();
					var ys_1=$('#ys_1').val();						
					var elo_1=$('#elo_1').val();
					var w_1 = $('#w_1').val();
					 if(sample1=="8 MM")
					{
						dia_1 = 8;						
						var len_1 = randomNumberFromRange(995,1005).toFixed();
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 
						 
						
					}
					else if(sample1=="10 MM")
					{
						 dia_1 = 10;
						 var w_1 = $('#w_1').val();
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						 dia_1 = 12;
						 var w_1 = $('#w_1').val();
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
					}
					else if(sample1=="16 MM")
					{						
						 dia_1 = 16;
						 var w_1 = $('#w_1').val();
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="20 MM")
					{						
						 dia_1 = 20;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
					}
					else if(sample1=="25 MM")
					{												
						 dia_1 = 25;						 						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
					}
					else if(sample1=="32 MM")
					{												
						 dia_1 = 32;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="4 MM")
					{												
						 dia_1 = 4;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="5 MM")
					{												
						 dia_1 = 5;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="6 MM")
					{												
						 dia_1 = 6;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="28 MM")
					{												
						 dia_1 = 28;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="36 MM")
					{												
						 dia_1 = 36;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="40 MM")
					{												
						 dia_1 = 40;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="45 MM")
					{												
						 dia_1 = 45;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="50 MM")
					{												
						 dia_1 = 50;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					
						
						 l_1 = $('#l_1').val();	
						 $('#l_1').val(l_1);
						 cs1 = ((+w_1)/(+0.00785))/1000;
						 $('#cs_1').val(cs1.toFixed(1));
						 cs_1=$('#cs_1').val();
						
						var gl_1 = ((+5.65) * Math.sqrt(cs_1)) / (+5);
						var gl_final = gl_1.toFixed();
						
						$('#gl_1').val((+gl_final) * (+5));
						var gl1 = $('#gl_1').val();	
						
						 $('#og_1').val(gl1);
						 gl_1=$('#gl_1').val();						 
						 og_1=$('#og_1').val();						 
						 
						 
						
						 fg_1 = (((+og_1)*(+elo_1))/100)+(+og_1);
						 $('#fg_1').val(fg_1.toFixed(2));
						
						
						 var ten_1=$('#ten_1').val();
						 
						 up_temp_1 = ((+ten_1)*(+cs_1));
						 up_temp = Math.round(+up_temp_1) / 20;
						 up_temp1 = Math.round(+up_temp) * 20;
						 $('#up_1').val(Math.ceil(up_temp1.toFixed()));
						 
						 
											
						 						
						 $('#bend_1').val("OK");
						 $('#rebend_1').val("OK");
						 var weight_1 = $('#w_1').val();
						 var length_1 = $('#l_1').val();
						 cross1 = (+weight_1)/((0.00785)*(+length_1));
						 $('#cs_1').val(cross1.toFixed(1));
						 var cross_1=$('#cs_1').val();
						 
						var gaul11 = ((+5.65) * Math.sqrt(cross_1)) / (+5);
						var gaul1 = gaul11.toFixed();
						
						 $('#gl_1').val((+gaul1) * (+5));
						 $('#og_1').val((+gaul1) * (+5));
						 var inital_gauge_1=$('#gl_1').val();
						 var orginal_gauge_1=$('#og_1').val();
						 
						 var yeid_point_load_1 = $('#yp_1').val();
						 var ultimate_point_load_1 = $('#up_1').val();
						 
						 var yeld_s1 = ((+yeid_point_load_1)) / (+cross_1);
						 $('#ys_1').val(yeld_s1.toFixed());
						 var yeild_stress_1 = $('#ys_1').val();	
						 
						 var ulti_ten_1 = ((+ultimate_point_load_1)) / (+cross_1);
						  $('#ten_1').val(ulti_ten_1.toFixed());
						 var utlimate_ten_1 = $('#ten_1').val();
						 var final_gauge_1=$('#fg_1').val();						 
						 
						 var eq1 = (+final_gauge_1) - (+orginal_gauge_1);
						 var eq2 = (+eq1) * 100;
						 var elong_1 = (+eq2) / (+orginal_gauge_1);
						 $('#elo_1').val(elong_1.toFixed());
					
					
					
					
	}
	
	
	
	
	
	
	
	function cs1_yp1_up1()
	{
		
					var sample1 = $("#dia_1 option:selected").val();
					get_count();
					 if(sample1=="8 MM")
					{						
						 dia_1 = 8;						
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);						
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="10 MM")
					{
						 
						 
						 dia_1 = 10;
						 var w_1 = $('#w_1').val();
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						
						 dia_1 = 12;
						 var w_1 = $('#w_1').val();
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						
					}
					else if(sample1=="16 MM")
					{
						 
						 dia_1 = 16;
						 var w_1 = $('#w_1').val();
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
					}
					else if(sample1=="20 MM")
					{
						
						 dia_1 = 20;
						 var w_1 = $('#w_1').val();
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="25 MM")
					{
						
						
						 dia_1 = 25;						
						 var w_1 = $('#w_1').val();
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
					}
					else if(sample1=="32 MM")
					{												
						 dia_1 = 32;
						 var w_1 = $('#w_1').val();
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
					}
					else if(sample1=="4 MM")
					{												
						 dia_1 = 4;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="5 MM")
					{												
						 dia_1 = 5;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="6 MM")
					{												
						 dia_1 = 6;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="28 MM")
					{												
						 dia_1 = 28;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="36 MM")
					{												
						 dia_1 = 36;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="40 MM")
					{												
						 dia_1 = 40;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="45 MM")
					{												
						 dia_1 = 45;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					else if(sample1=="50 MM")
					{												
						 dia_1 = 50;						 
						 var len_1 = randomNumberFromRange(995,1005).toFixed();
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
					}
					
					
												 
						 var inital_gauge_1=$('#gl_1').val();
						 var orginal_gauge_1=$('#gl_1').val();
						  var cross_1=$('#cs_1').val();
						 var yeid_point_load_1 = $('#yp_1').val();
						 var ultimate_point_load_1 = $('#up_1').val();
						 
						 var yeld_s1 = ((+yeid_point_load_1)) / (+cross_1);
						 $('#ys_1').val(yeld_s1.toFixed());
						 var yeild_stress_1 = $('#ys_1').val();	
						 
						 var ulti_ten_1 = ((+ultimate_point_load_1)) / (+cross_1);
						  $('#ten_1').val(ulti_ten_1.toFixed());
						 var utlimate_ten_1 = $('#ten_1').val();
						 var final_gauge_1=$('#fg_1').val();						 
						 
						 var eq1 = (+final_gauge_1) - (+orginal_gauge_1);
						 var eq2 = (+eq1) * 100;
						 var elong_1 = (+eq2) / (+orginal_gauge_1);
						 $('#elo_1').val(elong_1.toFixed());
					
	}
	
	
	$('#yp_1').change(function(){
		var yeid_point_load_1 = $('#yp_1').val();
		 var cross_1=$('#cs_1').val();
		var yeld_s1 = ((+yeid_point_load_1)) / (+cross_1);
		 $('#ys_1').val(yeld_s1.toFixed());
		 var yeild_stress_1 = $('#ys_1').val();	
	});
	
	
	
	$('#up_1').change(function(){
		
			 var ultimate_point_load_1 = $('#up_1').val();
			  var cross_1=$('#cs_1').val();
			   var ulti_ten_1 = ((+ultimate_point_load_1)) / (+cross_1);
			  $('#ten_1').val(ulti_ten_1.toFixed());
	
	});
	$('#fg_1').change(function(){
		if ($('#chk_phy').prop('checked')) {
			cs1_yp1_up1();
		}
		else
		{
			direct_input();
		}
	});
	
	$('#og_1,#gl_1').change(function(){
		if ($('#chk_phy').prop('checked')) {
			cs1_yp1_up1();
		}
		else
		{
			direct_input();
		}	
	});
	
	function direct_input()
	{
		
		var dia = $("#dia").val();
		
		if(dia=="8")
		{
			$('#dia_1').val("8 MM").prop('selected', true);
		}
		else if(dia=="10")
		{
			$('#dia_1').val("10 MM").prop('selected', true);
		}
		else if(dia=="12")
		{
			$('#dia_1').val("12 MM").prop('selected', true);
		}
		else if(dia=="16")
		{
			$('#dia_1').val("16 MM").prop('selected', true);
		}
		else if(dia=="20")
		{
			$('#dia_1').val("20 MM").prop('selected', true);
		}
		else if(dia=="25")
		{
			$('#dia_1').val("25 MM").prop('selected', true);
		}
		else if(dia=="32")
		{
			$('#dia_1').val("32 MM").prop('selected', true);
		}
		else if(dia=="4")
		{
			$('#dia_1').val("4 MM").prop('selected', true);
		}
		else if(dia=="5")
		{
			$('#dia_1').val("5 MM").prop('selected', true);
		}
		else if(dia=="6")
		{
			$('#dia_1').val("6 MM").prop('selected', true);
		}
		else if(dia=="28")
		{
			$('#dia_1').val("28 MM").prop('selected', true);
		}
		else if(dia=="36")
		{
			$('#dia_1').val("36 MM").prop('selected', true);
		}
		else if(dia=="40")
		{
			$('#dia_1').val("40 MM").prop('selected', true);
		}
		else if(dia=="45")
		{
			$('#dia_1').val("45 MM").prop('selected', true);
		}
		else if(dia=="50")
		{
			$('#dia_1').val("50 MM").prop('selected', true);
		}
		
		var sample1 = $("#dia_1 option:selected").val();
		//get_count();
		if(sample1=="8 MM")
		{
			var dia_1 = 8;		
		}
		else if(sample1=="10 MM")
		{
			var dia_1 = 10;
		}
		else if(sample1=="12 MM")
		{
			var dia_1 = 12;
		}
		else if(sample1=="16 MM")
		{
			var dia_1 = 16;
		}
		else if(sample1=="20 MM")
		{
			var dia_1 = 20;
		}
		else if(sample1=="25 MM")
		{
			var dia_1 = 25;
		}
		else if(sample1=="32 MM")
		{
			var dia_1 = 32;
		}
		else if(sample1=="4 MM")
		{												
			 var dia_1 = 4;						 
			 
			
		}
		else if(sample1=="5 MM")
		{												
			 var dia_1 = 5;						 
			 
			
		}
		else if(sample1=="6 MM")
		{												
			 var dia_1 = 6;						 
			 
			
		}
		else if(sample1=="28 MM")
		{												
			 var dia_1 = 28;						 
			
			
		}
		else if(sample1=="36 MM")
		{												
			 var dia_1 = 36;						 
			 
		}
		else if(sample1=="40 MM")
		{												
			 var dia_1 = 40;						 
			 
			
		}
		else if(sample1=="45 MM")
		{												
			 var dia_1 = 45;						 
			
			
		}
		else if(sample1=="50 MM")
		{												
			 var dia_1 = 50;						 
			
			
		}
		var w_1 = $('#w_1').val();
		var len_1 = $('#l_1').val(); //randomNumberFromRange(995,1005).toFixed();
		var samp_1 = (+len_1) * (+w_1);
		 $('#len_1').val(len_1);
		 $('#samp_1').val(samp_1.toFixed());
		var l_1 = $('#l_1').val();
		var yp_1 = $('#yp_1').val();
		var up_1 = $('#up_1').val();
		var fg_1 = $('#fg_1').val();
		
		var tsd = ((+l_1) * 0.00785);
		var cs_1 = (+w_1)/ (+tsd);
		$('#cs_1').val(cs_1.toFixed(1));
		var cs1 = $('#cs_1').val();
		var gl_11 = ((+5.65) * Math.sqrt(cs1)) / (+5);
		var gl_1 = gl_11.toFixed();
		
		$('#gl_1').val((+gl_1) * (+5));
		var gl1 = $('#gl_1').val();
		
		var ys_1 = (+yp_1) / (+cs1);
		var finalys = (+ys_1);
		$('#ys_1').val(finalys);
		var ys1 = $('#ys_1').val();
		
		var ten_1 = (+up_1)/(+cs1);
		var finalten = (+ten_1);
		$('#ten_1').val(finalten);
		var ten1 = $('#ten_1').val();
		var og1 = gl1;
		$('#og_1').val(og1);
		var og_1 = $('#og_1').val();
		
		var eq1 = (+fg_1) - (+og_1);
		var eq2 = (+eq1) * 100;
		var elo_1 = (+eq2) / (+og_1);
		$('#elo_1').val(elo_1.toFixed(1));
		var elo_1 = $('#elo_1').val();
		
		
		 
				
		
		 ten1 = randomNumberFromRange(521,545).toFixed();
		 $('#ten_1').val(ten1);
		 ten_1=$('#ten_1').val();
		 
				
		 
		 $('#bend_1').val("OK");
		 $('#rebend_1').val("OK");
		 var weight_1 = $('#w_1').val();
		 var length_1 = $('#l_1').val();
		 cross1 = (+weight_1)/((0.00785)*(+length_1));
		 $('#cs_1').val(cross1.toFixed(1));
		 var cross_1=$('#cs_1').val();
		 var gaul11 = ((+5.65) * Math.sqrt(cross_1)) / (+5);
		 var gaul1 = gaul11.toFixed();
		 $('#gl_1').val((+gaul1) * (+5));
		 $('#og_1').val((+gaul1) * (+5));					 
		 var inital_gauge_1=$('#gl_1').val();
		 var orginal_gauge_1=$('#og_1').val();
		 
		 var yeid_point_load_1 = $('#yp_1').val();
		 var ultimate_point_load_1 = $('#up_1').val();
		 
		 var yeld_s1 = ((+yeid_point_load_1)) / (+cross_1);
		// var yeld_s1 = ((+yeid_point_load_1)*1000) / (+cross_1);
		 $('#ys_1').val(yeld_s1.toFixed());
		 var yeild_stress_1 = $('#ys_1').val();	
		 
		 var ulti_ten_1 = ((+ultimate_point_load_1)) / (+cross_1);
		// var ulti_ten_1 = ((+ultimate_point_load_1) * 1000) / (+cross_1);
		  $('#ten_1').val(ulti_ten_1.toFixed());
		 var utlimate_ten_1 = $('#ten_1').val();
		 var final_gauge_1=$('#fg_1').val();						 
		 
		 var eq1 = (+final_gauge_1) - (+orginal_gauge_1);
		 var eq2 = (+eq1) * 100;
		 var elong_1 = (+eq2) / (+orginal_gauge_1);
		 $('#elo_1').val(elong_1.toFixed());
		
		
		
		
		
		
		
		
		
		
	}
	
	
	
	//CHK1done
	function chk1_data()
	{
		
		var grade = $("#grade").val();
		var dia = $("#dia").val();
		get_count();
		if(dia=="8")
		{
			$('#dia_1').val("8 MM").prop('selected', true);
		}
		else if(dia=="10")
		{
			$('#dia_1').val("10 MM").prop('selected', true);
		}
		else if(dia=="12")
		{
			$('#dia_1').val("12 MM").prop('selected', true);
		}
		else if(dia=="16")
		{
			$('#dia_1').val("16 MM").prop('selected', true);
		}
		else if(dia=="20")
		{
			$('#dia_1').val("20 MM").prop('selected', true);
		}
		else if(dia=="25")
		{
			$('#dia_1').val("25 MM").prop('selected', true);
		}
		else if(dia=="32")
		{
			$('#dia_1').val("32 MM").prop('selected', true);
		}
		else if(dia=="4")
		{
			$('#dia_1').val("4 MM").prop('selected', true);
		}
		else if(dia=="5")
		{
			$('#dia_1').val("5 MM").prop('selected', true);
		}
		else if(dia=="6")
		{
			$('#dia_1').val("6 MM").prop('selected', true);
		}
		else if(dia=="28")
		{
			$('#dia_1').val("28 MM").prop('selected', true);
		}
		else if(dia=="36")
		{
			$('#dia_1').val("36 MM").prop('selected', true);
		}
		else if(dia=="40")
		{
			$('#dia_1').val("40 MM").prop('selected', true);
		}
		else if(dia=="45")
		{
			$('#dia_1').val("45 MM").prop('selected', true);
		}
		else if(dia=="50")
		{
			$('#dia_1').val("50 MM").prop('selected', true);
		}
		
		
			if(grade=="FE 415"){
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
						
					}
					else if(sample1=="16 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						 
					}
					else if(sample1=="20 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="25 MM")
					{
						
						ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new					
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						  w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						  w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						  w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						  w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						  w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						  w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
					
					
					
			}
			else if(grade=="FE 415 D")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						
						 
						
					}
					else if(sample1=="10 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						
						
						
					}
					else if(sample1=="16 MM")
					{
						
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="25 MM")
					{
						
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						 w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						 w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						  w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}					
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						  w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						 w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						 w1 = randomNumberFromRange(15.420,15.450).toFixed(3);
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					
				
			}
			else if(grade=="FE 415 S"){
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
						
					}
					else if(sample1=="16 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						 
					}
					else if(sample1=="20 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="25 MM")
					{
						
						ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new					
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						  w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						  w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						  w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						  w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						  w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						  w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
					
					
					
			}
			else if(grade=="FE 500")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
					}
					else if(sample1=="10 MM")
					{
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="16 MM")
					{
						
						ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						 w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						 w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						  w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						 w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
			}
			else if(grade=="FE 500 D")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
				
			}
			else if(grade=="FE 500 S")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
				
			}		
			else if(grade=="FE 550")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
						
				
			}
			else if(grade=="FE 550 D")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						 
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						 w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						 w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						 w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
			}
			else if(grade=="FE 600")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
						
				
			}
			else if(grade=="FE 650")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
						
				
			}
			else if(grade=="FE 700")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
						
				
			}
			else if(grade=="FE 415 CRS"){
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
						
					}
					else if(sample1=="16 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						 
					}
					else if(sample1=="20 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="25 MM")
					{
						
						ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new					
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						  w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						  w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						  w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						  w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						  w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						  w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(14.9,17.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
					
					
					
			}
			else if(grade=="FE 415 D CRS")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						
						 
						
					}
					else if(sample1=="10 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						
						
						
					}
					else if(sample1=="16 MM")
					{
						
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="25 MM")
					{
						
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						 w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						 w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						  w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}					
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						  w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						 w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.8,23.1).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						 w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(521,545).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					
				
			}
			else if(grade=="FE 415 S CRS"){
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						 var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
						
					}
					else if(sample1=="16 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						 
					}
					else if(sample1=="20 MM")
					{
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="25 MM")
					{
						
						ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new					
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						  w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						  w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						  w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						  w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						  w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						  w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(425, 455).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,19.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(568,575).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
					
					
					
			}
			else if(grade=="FE 500 CRS")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
						
					}
					else if(sample1=="10 MM")
					{
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="16 MM")
					{
						
						ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						 w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						 w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						  w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(12.5,15.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						 w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						 var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(594,630).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
			}
			else if(grade=="FE 500 D CRS")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(605,640).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
				
			}
			else if(grade=="FE 500 S CRS")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(525, 550).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(18.1,22.9).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(687,695).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
				
			}		
			else if(grade=="FE 550 CRS")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,14.3).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(636,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
						
				
			}
			else if(grade=="FE 550 D CRS")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						 
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						 w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						 w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						 w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(565, 600).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(16.0,20.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						 w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(648,670).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
			}
			else if(grade=="FE 600 CRS")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(610, 650).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(689,699).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
						
				
			}
			else if(grade=="FE 650 CRS")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(731,745).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					
						
				
			}
			else if(grade=="FE 700 CRS")
			{
					
					
					
					
					
					var sample1 = $("#dia_1 option:selected").val();	
					 if(sample1=="8 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 8;
						 w1 = randomNumberFromRange(395,403).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="10 MM")
					{
						 
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 10;
						 w1 = randomNumberFromRange(617,629).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="12 MM")
					{
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 12;
						 w1 = randomNumberFromRange(888,905).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
						
					}
					else if(sample1=="16 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 16;
						 w1 = randomNumberFromRange(1580,1600).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="20 MM")
					{
						ys1 = randomNumberFromRange(660, 690).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 20;
						 w1 = randomNumberFromRange(2470,2500).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="25 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 25;
						 w1 = randomNumberFromRange(3850,3900).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="32 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 32;
						  w1 = randomNumberFromRange(6310,6360).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}//new
					else if(sample1=="4 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 4;
						w1 = randomNumberFromRange(99,104).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="5 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 5;
						w1 = randomNumberFromRange(154,160).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="6 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 6;
						w1 = randomNumberFromRange(222,230).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="28 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 28;
						w1 = randomNumberFromRange(4830,4920).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="36 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 36;
						w1 = randomNumberFromRange(7990,8090).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="40 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 40;
						 w1 = randomNumberFromRange(9860,9890).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="45 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 45;
						w1 = randomNumberFromRange(12490,12510).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
					else if(sample1=="50 MM")
					{
						
						 ys1 = randomNumberFromRange(720, 740).toFixed();
						 $('#ys_1').val(ys1);
						 ys_1=$('#ys_1').val();						
						 elo1 = randomNumberFromRange(11.0,13.0).toFixed(1);
						 $('#elo_1').val(elo1);						 
						 elo_1=$('#elo_1').val();
						 dia_1 = 50;
						  w1 = randomNumberFromRange(15420,15450).toFixed();
						 $('#w_1').val(w1);
						  var w_1 = $('#w_1').val();
						 if ($('#chk_len').prop('checked')) { var len_1 = 1000; }else{ var len_1 = randomNumberFromRange(995,1005).toFixed();}
						var samp_1 = (+len_1) * (+w_1);
						 $('#len_1').val(len_1);
						 $('#samp_1').val(samp_1.toFixed());
						 
						 ten1 = randomNumberFromRange(784,795).toFixed();
					     $('#ten_1').val(ten1);
						 ten_1=$('#ten_1').val();
						 
					}
			}
			
			 l_1 = $('#len_1').val();
			 $('#l_1').val(l_1);
			 cs1 = ((+w_1)/(+0.00785))/1000;
			 $('#cs_1').val(cs1.toFixed(1));
			 cs_1=$('#cs_1').val();
			
			 var gl1 = ((+5.65) * Math.sqrt(cs_1)) / (+5);	
			 var gll1 = gl1.toFixed();
			 
			 $('#gl_1').val((+gll1) * (+5));
			 $('#og_1').val((+gll1) * (+5));
			 gl_1=$('#gl_1').val();						 
			 og_1=$('#og_1').val();						 
			 
			 
			 //old
			 /*yp1 = ((+ys_1) * (+cs_1))/1000;
			 $('#yp_1').val(yp1.toFixed(2));*/
			 
			 
			 yp_temp_1 = ((+ys_1)*(+cs_1));
			 yp_temp = Math.round(+yp_temp_1) / 20;
			 yp_temp1 = (Math.round(+yp_temp) * 20);
			 $('#yp_1').val(Math.ceil(yp_temp1.toFixed()));
			 
			
			 fg_1 = (((+og_1)*(+elo_1))/100)+(+og_1);
			 $('#fg_1').val(fg_1.toFixed(2));
			
			 
			 
			 
			 //old
			 /*up_1 = ((+ten_1)*(+cs_1))/1000;
			 $('#up_1').val(up_1.toFixed(2));*/
			 
			 up_temp_1 = ((+ten_1)*(+cs_1));
			 up_temp = Math.round(+up_temp_1) / 20;
			 up_temp1 = Math.round(+up_temp) * 20;
			 $('#up_1').val(Math.ceil(up_temp1.toFixed()));
			 
			 
			 
								
			 
		
			$('#bend_1').val("OK");
			 $('#rebend_1').val("OK");
			 var weight_1 = $('#w_1').val();
			 var length_1 = $('#l_1').val();
			 cross1 = (+weight_1)/((0.00785)*(+length_1));
			 $('#cs_1').val(cross1.toFixed(1));
			 var cross_1=$('#cs_1').val();
			var gaul11 = ((+5.65) * Math.sqrt(cross_1)) / (+5);
			 var gaul1 = gaul11.toFixed();
			 $('#gl_1').val((+gaul1) * (+5));
			 $('#og_1').val((+gaul1) * (+5));					 
			 var inital_gauge_1=$('#gl_1').val();
			 var orginal_gauge_1=$('#og_1').val();
			 
			 var yeid_point_load_1 = $('#yp_1').val();
			 var ultimate_point_load_1 = $('#up_1').val();
			 
			 var yeld_s1 = ((+yeid_point_load_1)) / (+cross_1);
			// var yeld_s1 = ((+yeid_point_load_1)*1000) / (+cross_1);
			 $('#ys_1').val(yeld_s1.toFixed());
			 var yeild_stress_1 = $('#ys_1').val();	
			 
			 var ulti_ten_1 = ((+ultimate_point_load_1)) / (+cross_1);
			// var ulti_ten_1 = ((+ultimate_point_load_1) * 1000) / (+cross_1);
			  $('#ten_1').val(ulti_ten_1.toFixed());
			 var utlimate_ten_1 = $('#ten_1').val();
			 var final_gauge_1=$('#fg_1').val();						 
			 
			 var eq1 = (+final_gauge_1) - (+orginal_gauge_1);
			 var eq2 = (+eq1) * 100;
			 var elong_1 = (+eq2) / (+orginal_gauge_1);
			 $('#elo_1').val(elong_1.toFixed());
	
	}
	
	$('#chk1').change(function(){
        if(this.checked)
		{
			if ($('#chk_phy').prop('checked')) {
			chk1_data();
			}
			else
			{
					
			}
		}
		else
		{
			$('#dia_1').val("8 MM");
			$('#labno1').val(null);
			$('#ys_1').val(null);
			$('#elo_1').val(null);
			$('#w_1').val(null);
			$('#l_1').val(null);
			$('#cs_1').val(null);
			$('#yp_1').val(null);
			$('#gl_1').val(null);
			$('#og_1').val(null);
			$('#fg_1').val(null);
			$('#ten_1').val(null);
			$('#up_1').val(null);
			$('#bend_1').val(null);
			$('#rebend_1').val(null);
		}
		
	});
	
	$('#dia_1').change(function(){
		if ($('#chk_phy').prop('checked')) {
			chk1_data();
		}
		else
		{
				
		}
		
	});
	
	$('#c1').change(function(){
		$('#chk_chem').prop('checked', true);
	});
	



	function chem_data()
	{
		var grade = $("#grade").val();
		
		if(grade=="FE 415"){
				c1 = randomNumberFromRange(0.240,0.270).toFixed(3);
				c2 = randomNumberFromRange(0.030,0.040).toFixed(3);
				c3 = randomNumberFromRange(0.030,0.040).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
				
				
					
			}
			else if(grade=="FE 415 D")
			{
				c1 = randomNumberFromRange(0.240,0.270).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.040).toFixed(3);
				c3 = randomNumberFromRange(0.025,0.040).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
				
			}
			else if(grade=="FE 415 S"){
					
				c1 = randomNumberFromRange(0.200,0.230).toFixed(3);
				c2 = randomNumberFromRange(0.020,0.035).toFixed(3);
				c3 = randomNumberFromRange(0.020,0.035).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
					
			}
			else if(grade=="FE 500")
			{
					
				c1 = randomNumberFromRange(0.230,0.280).toFixed(3);
				c2 = randomNumberFromRange(0.035,0.045).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.045).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
					
			}
			else if(grade=="FE 500 D")
			{
				c1 = randomNumberFromRange(0.180,0.230).toFixed(3);
				c2 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c3 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
				
			}
			else if(grade=="FE 500 S")
			{
				c1 = randomNumberFromRange(0.270,0.300).toFixed(3);
				c2 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c3 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
				
			}		
			else if(grade=="FE 550")
			{
				c1 = randomNumberFromRange(0.230,0.280).toFixed(3);
				c2 = randomNumberFromRange(0.035,0.045).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.045).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
						
				
			}
			else if(grade=="FE 550 D")
			{
				c1 = randomNumberFromRange(0.180,0.230).toFixed(3);
				c2 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c3 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
			}
			else if(grade=="FE 600")
			{
				c1 = randomNumberFromRange(0.270,0.300).toFixed(3);
				c2 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c3 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);	
				
			}
			else if(grade=="FE 650")
			{
					
				c1 = randomNumberFromRange(0.290,0.310).toFixed(3);
				c2 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c3 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);	
				
			}
			else if(grade=="FE 700")
			{
				c1 = randomNumberFromRange(0.290,0.310).toFixed(3);
				c2 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c3 = randomNumberFromRange(0.028,0.036).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
				c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
						
				
			}
			else if(grade=="FE 415 CRS"){
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
				
				
					
			}
			else if(grade=="FE 415 D CRS")
			{
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
				
			}
			else if(grade=="FE 415 S CRS"){
					
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
					
			}
			else if(grade=="FE 500 CRS")
			{
					
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
					
			}
			else if(grade=="FE 500 D CRS")
			{
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
				
			}
			else if(grade=="FE 500 S CRS")
			{
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
				
			}		
			else if(grade=="FE 550 CRS")
			{
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
						
				
			}
			else if(grade=="FE 550 D CRS")
			{
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
			}
			else if(grade=="FE 600 CRS")
			{
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);	
				
			}
			else if(grade=="FE 650 CRS")
			{
					
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);	
				
			}
			else if(grade=="FE 700 CRS")
			{
				c1 = randomNumberFromRange(0.100,0.115).toFixed(3);
				c2 = randomNumberFromRange(0.025,0.038).toFixed(3);
				c3 = randomNumberFromRange(0.035,0.050).toFixed(3);
				c4 = randomNumberFromRange(0.150,0.250).toFixed(3);
				c5 = randomNumberFromRange(0.550,0.900).toFixed(3);
				c6 = randomNumberFromRange(0.250,0.350).toFixed(3);
				c7 = randomNumberFromRange(0.220,0.280).toFixed(3);
				c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
				c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c10 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c11 = randomNumberFromRange(0.001,0.002).toFixed(3);
				c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
				c13 = randomNumberFromRange(0.002,0.005).toFixed(3);
				c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
						
				
			}
			
			 $('#c1').val(c1);
			 $('#c2').val(c2);
			 $('#c3').val(c3);
			 $('#c4').val(c4);
			 $('#c5').val(c5);
			 $('#c6').val(c6);
			 $('#c7').val(c7);
			 $('#c8').val(c8);
			 $('#c9').val(c9);
			 $('#c10').val(c10);
			 $('#c11').val(c11);
			 $('#c12').val(c12);
			 $('#c13').val(c13);
			 $('#c14').val(c14);
			 
	}

	

	
	
	
	
	function null_data()
	{
			$("#chk1").prop("checked", false);   
			$("#chk2").prop("checked", false);   
			$("#chk3").prop("checked", false);   
			$("#chk4").prop("checked", false);   
			$("#chk5").prop("checked", false);   
			$("#chk6").prop("checked", false);   
			$("#chk7").prop("checked", false);   
			$("#labno1").val(null);
			$("#labno2").val(null);
			$("#labno3").val(null);
			$("#labno4").val(null);
			$("#labno5").val(null);
			$("#labno6").val(null);
			$("#labno7").val(null);	
			$('#dia_1').val("8 MM");
			$('#dia_2').val("8 MM");
			$('#dia_3').val("8 MM");
			$('#dia_4').val("8 MM");
			$('#dia_5').val("8 MM");
			$('#dia_6').val("8 MM");
			$('#dia_7').val("8 MM");
			$("#w_1").val(null);
			$("#w_2").val(null);
			$("#w_3").val(null);
			$("#w_4").val(null);
			$("#w_5").val(null);
			$("#w_6").val(null);
			$("#w_7").val(null);
			$("#l_1").val(null);
			$("#l_2").val(null);
			$("#l_3").val(null);
			$("#l_4").val(null);
			$("#l_5").val(null);
			$("#l_6").val(null);
			$("#l_7").val(null);
			$("#cs_1").val(null);
			$("#cs_2").val(null);
			$("#cs_3").val(null);
			$("#cs_4").val(null);
			$("#cs_5").val(null);
			$("#cs_6").val(null);
			$("#cs_7").val(null);
			$("#gl_1").val(null);
			$("#gl_2").val(null);
			$("#gl_3").val(null);
			$("#gl_4").val(null);
			$("#gl_5").val(null);
			$("#gl_6").val(null);
			$("#gl_7").val(null);
			$("#yp_1").val(null);
			$("#yp_2").val(null);
			$("#yp_3").val(null);
			$("#yp_4").val(null);
			$("#yp_5").val(null);
			$("#yp_6").val(null);
			$("#yp_7").val(null);
			$("#up_1").val(null);
			$("#up_2").val(null);
			$("#up_3").val(null);
			$("#up_4").val(null);
			$("#up_5").val(null);
			$("#up_6").val(null);
			$("#up_7").val(null);
			$("#ys_1").val(null);
			$("#ys_2").val(null);
			$("#ys_3").val(null);
			$("#ys_4").val(null);
			$("#ys_5").val(null);
			$("#ys_6").val(null);
			$("#ys_7").val(null);
			$("#ten_1").val(null);
			$("#ten_2").val(null);
			$("#ten_3").val(null);
			$("#ten_4").val(null);
			$("#ten_5").val(null);
			$("#ten_6").val(null);
			$("#ten_7").val(null);
			$("#og_1").val(null);
			$("#og_2").val(null);
			$("#og_3").val(null);
			$("#og_4").val(null);
			$("#og_5").val(null);
			$("#og_6").val(null);
			$("#og_7").val(null);
			$("#fg_1").val(null);
			$("#fg_2").val(null);
			$("#fg_3").val(null);
			$("#fg_4").val(null);
			$("#fg_5").val(null);
			$("#fg_6").val(null);
			$("#fg_7").val(null);
			$("#elo_1").val(null);
			$("#elo_2").val(null);
			$("#elo_3").val(null);
			$("#elo_4").val(null);
			$("#elo_5").val(null);
			$("#elo_6").val(null);
			$("#elo_7").val(null);
			$("#bend_1").val(null);
			$("#bend_2").val(null);
			$("#bend_3").val(null);
			$("#bend_4").val(null);
			$("#bend_5").val(null);
			$("#bend_6").val(null);
			$("#bend_7").val(null);
			$("#rebend_1").val(null);
			$("#rebend_2").val(null);
			$("#rebend_3").val(null);
			$("#rebend_4").val(null);
			$("#rebend_5").val(null);
			$("#rebend_6").val(null);
			$("#rebend_7").val(null);
			
			
			
	}
	
	$('#chk_chem').change(function(){
        if(this.checked)
		{
			
			chem_data();
		}
		else
		{					
			$('#c1').val(null);
			$('#c2').val(null);
			$('#c3').val(null);
			$('#c4').val(null);
			$('#c5').val(null);
			$('#c6').val(null);
			$('#c7').val(null);
			$('#c8').val(null);
			$('#c9').val(null);
			$('#c10').val(null);
			$('#c11').val(null);
			$('#c12').val(null);
			$('#c13').val(null);
			$('#c14').val(null);
			
			
			
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
        url: '<?php echo $base_url; ?>save_span_steel.php',
        data: 'action_type=view&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
		success:function(html){
		$('#display_data').html(html);
		
        }
    });
	
	$.ajax({
        type: 'POST',
		dataType: 'JSON',
        url: '<?php echo $base_url; ?>save_span_steel.php',
         data: 'action_type=chk&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
			success:function(data){
            var save_data = data.total_row;
			var up_data = $('#report_cnt').val();	
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
        url: '<?php echo $base_url; ?>save_span_steel.php',
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
				
				var chk1 = $('#chk1').val();				
				var chk2 = "";				
				var chk3 = "";				
				var chk4 = "";				
				var chk5 = "";				
				var chk6 = "";				
				var chk7 = "";				
				
				
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
				var temp = $('#test_list').val();
				var aa= temp.split(",");
				var chk_phy="1";
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phy")
					{
						if(document.getElementById('chk_phy').checked) {
								var chk_phy = "1";
						}
						else{
								var chk_phy = "1";
						}
						
						if(document.getElementById('chk_len').checked) {
								var chk_len = "1";
						}
						else{
								var chk_len = "0";
						}
														
						break;
					}
				}
				
				chk_phy="1";
				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="oes")
					{
						if(document.getElementById('chk_chem').checked) {
								var chk_chem = "1";
						}
						else{
								var chk_chem = "0";
						}
														
						break;
					}
														
				}
				var labno1 = $('#labno1').val();
				var labno2 = $('#labno2').val();
				var labno3 = $('#labno3').val();
				var labno4 = $('#labno4').val();
				var labno5 = $('#labno5').val();
				var labno6 = $('#labno6').val();
				var labno7 = $('#labno7').val();
				var dia_1 = $('#dia_1').val();
				
				var dia_2 = $('#dia_2').val();
				var dia_3 = $('#dia_3').val();
				var dia_4 = $('#dia_4').val();
				var dia_5 = $('#dia_5').val();
				var dia_6 = $('#dia_6').val();
				var dia_7 = $('#dia_7').val();
				var w_1 = $('#w_1').val();
				
				var w_2 = $('#w_2').val();
				var w_3 = $('#w_3').val();
				var w_4 = $('#w_4').val();
				var w_5 = $('#w_5').val();
				var w_6 = $('#w_6').val();
				var w_7 = $('#w_7').val();
				var l_1 = $('#l_1').val();
				var l_2 = $('#l_2').val();
				var l_3 = $('#l_3').val();
				var l_4 = $('#l_4').val();
				var l_5 = $('#l_5').val();
				var l_6 = $('#l_6').val();
				var l_7 = $('#l_7').val();
				var cs_1 = $('#cs_1').val();
				var cs_2 = $('#cs_2').val();
				var cs_3 = $('#cs_3').val();
				var cs_4 = $('#cs_4').val();
				var cs_5 = $('#cs_5').val();
				var cs_6 = $('#cs_6').val();
				var cs_7 = $('#cs_7').val();
				var gl_1 = $('#gl_1').val();
				var gl_2 = $('#gl_2').val();
				var gl_3 = $('#gl_3').val();
				var gl_4 = $('#gl_4').val();
				var gl_5 = $('#gl_5').val();
				var gl_6 = $('#gl_6').val();
				var gl_7 = $('#gl_7').val();
				var yp_1 = $('#yp_1').val();
				var yp_2 = $('#yp_2').val();
				var yp_3 = $('#yp_3').val();
				var yp_4 = $('#yp_4').val();
				var yp_5 = $('#yp_5').val();
				var yp_6 = $('#yp_6').val();
				var yp_7 = $('#yp_7').val();
				var up_1 = $('#up_1').val();
				var up_2 = $('#up_2').val();
				var up_3 = $('#up_3').val();
				var up_4 = $('#up_4').val();
				var up_5 = $('#up_5').val();
				var up_6 = $('#up_6').val();
				var up_7 = $('#up_7').val();
				var ys_1 = $('#ys_1').val();
				var ys_2 = $('#ys_2').val();
				var ys_3 = $('#ys_3').val();
				var ys_4 = $('#ys_4').val();
				var ys_5 = $('#ys_5').val();
				var ys_6 = $('#ys_6').val();
				var ys_7 = $('#ys_7').val();
				var ten_1 = $('#ten_1').val();
				var ten_2 = $('#ten_2').val();
				var ten_3 = $('#ten_3').val();
				var ten_4 = $('#ten_4').val();
				var ten_5 = $('#ten_5').val();
				var ten_6 = $('#ten_6').val();
				var ten_7 = $('#ten_7').val();
				var og_1 = $('#og_1').val();
				var og_2 = $('#og_2').val();
				var og_3 = $('#og_3').val();
				var og_4 = $('#og_4').val();
				var og_5 = $('#og_5').val();
				var og_6 = $('#og_6').val();
				var og_7 = $('#og_7').val();
				var fg_1 = $('#fg_1').val();
				var fg_2 = $('#fg_2').val();
				var fg_3 = $('#fg_3').val();
				var fg_4 = $('#fg_4').val();
				var fg_5 = $('#fg_5').val();
				var fg_6 = $('#fg_6').val();
				var fg_7 = $('#fg_7').val();
				var elo_1 = $('#elo_1').val();
				var elo_2 = $('#elo_2').val();
				var elo_3 = $('#elo_3').val();
				var elo_4 = $('#elo_4').val();
				var elo_5 = $('#elo_5').val();
				var elo_6 = $('#elo_6').val();
				var elo_7 = $('#elo_7').val();
				var bend_1 = $('#bend_1').val();
				var bend_2 = $('#bend_2').val();
				var bend_3 = $('#bend_3').val();
				var bend_4 = $('#bend_4').val();
				var bend_5 = $('#bend_5').val();
				var bend_6 = $('#bend_6').val();
				var bend_7 = $('#bend_7').val();
				var rebend_1 = $('#rebend_1').val();
				var rebend_2 = $('#rebend_2').val();
				var rebend_3 = $('#rebend_3').val();
				var rebend_4 = $('#rebend_4').val();
				var rebend_5 = $('#rebend_5').val();
				var rebend_6 = $('#rebend_6').val();
				var rebend_7 = $('#rebend_7').val();
				
				var c1 = $('#c1').val();
				
				var c2 = $('#c2').val();
				var c3 = $('#c3').val();
				var c4 = $('#c4').val();
				var c5 = $('#c5').val();
				var c6 = $('#c6').val();
				var c7 = $('#c7').val();
				var c8 = $('#c8').val();
				var c9 = $('#c9').val(); 
				var c10 = $('#c10').val();
				var c11 = $('#c11').val();
				var c12 = $('#c12').val();
				var c13 = $('#c13').val();
				var c14 = $('#c14').val();
				
				var len_1 = $('#len_1').val();
				var samp_1 = $('#samp_1').val();
				var phy_temp = $('#phy_temp').val();
				
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&grade='+grade+'&dia='+dia+'&brand='+brand+'&chk_phy='+chk_phy+'&chk1='+chk1+'&chk2='+chk2+'&chk3='+chk3+'&chk4='+chk4+'&chk5='+chk5+'&chk6='+chk6+'&chk7='+chk7+'&labno1='+labno1+'&labno2='+labno2+'&labno3='+labno3+'&labno4='+labno4+'&labno5='+labno5+'&labno6='+labno6+'&labno7='+labno7+'&dia_1='+dia_1+'&dia_2='+dia_2+'&dia_3='+dia_3+'&dia_4='+dia_4+'&dia_5='+dia_5+'&dia_6='+dia_6+'&dia_7='+dia_7+'&w_1='+w_1+'&w_2='+w_2+'&w_3='+w_3+'&w_4='+w_4+'&w_5='+w_5+'&w_6='+w_6+'&w_7='+w_7+'&l_1='+l_1+'&l_2='+l_2+'&l_3='+l_3+'&l_4='+l_4+'&l_5='+l_5+'&l_6='+l_6+'&l_7='+l_7+'&cs_1='+cs_1+'&cs_2='+cs_2+'&cs_3='+cs_3+'&cs_4='+cs_4+'&cs_5='+cs_5+'&cs_6='+cs_6+'&cs_7='+cs_7+'&gl_1='+gl_1+'&gl_2='+gl_2+'&gl_3='+gl_3+'&gl_4='+gl_4+'&gl_5='+gl_5+'&gl_6='+gl_6+'&gl_7='+gl_7+'&yp_1='+yp_1+'&yp_2='+yp_2+'&yp_3='+yp_3+'&yp_4='+yp_4+'&yp_5='+yp_5+'&yp_6='+yp_6+'&yp_7='+yp_7+'&up_1='+up_1+'&up_2='+up_2+'&up_3='+up_3+'&up_4='+up_4+'&up_5='+up_5+'&up_6='+up_6+'&up_7='+up_7+'&ys_1='+ys_1+'&ys_2='+ys_2+'&ys_3='+ys_3+'&ys_4='+ys_4+'&ys_5='+ys_5+'&ys_6='+ys_6+'&ys_7='+ys_7+'&ten_1='+ten_1+'&ten_2='+ten_2+'&ten_3='+ten_3+'&ten_4='+ten_4+'&ten_5='+ten_5+'&ten_6='+ten_6+'&ten_7='+ten_7+'&og_1='+og_1+'&og_2='+og_2+'&og_3='+og_3+'&og_4='+og_4+'&og_5='+og_5+'&og_6='+og_6+'&og_7='+og_7+'&fg_1='+fg_1+'&fg_2='+fg_2+'&fg_3='+fg_3+'&fg_4='+fg_4+'&fg_5='+fg_5+'&fg_6='+fg_6+'&fg_7='+fg_7+'&elo_1='+elo_1+'&elo_2='+elo_2+'&elo_3='+elo_3+'&elo_4='+elo_4+'&elo_5='+elo_5+'&elo_6='+elo_6+'&elo_7='+elo_7+'&bend_1='+bend_1+'&bend_2='+bend_2+'&bend_3='+bend_3+'&bend_4='+bend_4+'&bend_5='+bend_5+'&bend_6='+bend_6+'&bend_7='+bend_7+'&rebend_1='+rebend_1+'&rebend_2='+rebend_2+'&rebend_3='+rebend_3+'&rebend_4='+rebend_4+'&rebend_5='+rebend_5+'&rebend_6='+rebend_6+'&rebend_7='+rebend_7+'&chk_chem='+chk_chem+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&c7='+c7+'&c8='+c8+'&c9='+c9+'&c10='+c10+'&c11='+c11+'&c12='+c12+'&c13='+c13+'&c14='+c14+'&ulr='+ulr+'&len_1='+len_1+'&samp_1='+samp_1+'&sample_qty='+sample_qty+'&heat_no='+heat_no+'&tag_heading='+tag_heading+'&tag_data='+tag_data+'&chk_len='+chk_len + '&phy_temp=' + phy_temp+ '&amend_date=' + amend_date;
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
					var amend_date = $('#amend_date').val();
				var tag_heading = $('#tag_heading').val();
				var tag_data = $('#tag_data').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");
				var chk1 = $('#chk1').val();				
				var chk2 = "";				
				var chk3 = "";				
				var chk4 = "";				
				var chk5 = "";				
				var chk6 = "";				
				var chk7 = "";		
				
				alert(temp);
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phy")
					{
						if(document.getElementById('chk_phy').checked) {
								var chk_phy = "1";
						}
						else{
								var chk_phy = "1";
						}
						if(document.getElementById('chk_len').checked) {
								var chk_len = "1";
						}
						else{
								var chk_len = "0";
						}
														
						break;
					}
														
				}
				var chk_phy = "1";
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="oes")
					{
						if(document.getElementById('chk_chem').checked) {
								var chk_chem = "1";
						}
						else{
								var chk_chem = "0";
						}
														
						break;
					}
														
				}				
				
				var labno1 = $('#labno1').val();
				var labno2 = $('#labno2').val();
				var labno3 = $('#labno3').val();
				var labno4 = $('#labno4').val();
				var labno5 = $('#labno5').val();
				var labno6 = $('#labno6').val();
				var labno7 = $('#labno7').val();
				var dia_1 = $('#dia_1').val();
				var dia_2 = $('#dia_2').val();
				var dia_3 = $('#dia_3').val();
				var dia_4 = $('#dia_4').val();
				var dia_5 = $('#dia_5').val();
				var dia_6 = $('#dia_6').val();
				var dia_7 = $('#dia_7').val();
				var w_1 = $('#w_1').val();
				var w_2 = $('#w_2').val();
				var w_3 = $('#w_3').val();
				var w_4 = $('#w_4').val();
				var w_5 = $('#w_5').val();
				var w_6 = $('#w_6').val();
				var w_7 = $('#w_7').val();
				var l_1 = $('#l_1').val();
				var l_2 = $('#l_2').val();
				var l_3 = $('#l_3').val();
				var l_4 = $('#l_4').val();
				var l_5 = $('#l_5').val();
				var l_6 = $('#l_6').val();
				var l_7 = $('#l_7').val();
				var cs_1 = $('#cs_1').val();
				var cs_2 = $('#cs_2').val();
				var cs_3 = $('#cs_3').val();
				var cs_4 = $('#cs_4').val();
				var cs_5 = $('#cs_5').val();
				var cs_6 = $('#cs_6').val();
				var cs_7 = $('#cs_7').val();
				var gl_1 = $('#gl_1').val();
				var gl_2 = $('#gl_2').val();
				var gl_3 = $('#gl_3').val();
				var gl_4 = $('#gl_4').val();
				var gl_5 = $('#gl_5').val();
				var gl_6 = $('#gl_6').val();
				var gl_7 = $('#gl_7').val();
				var yp_1 = $('#yp_1').val();
				var yp_2 = $('#yp_2').val();
				var yp_3 = $('#yp_3').val();
				var yp_4 = $('#yp_4').val();
				var yp_5 = $('#yp_5').val();
				var yp_6 = $('#yp_6').val();
				var yp_7 = $('#yp_7').val();
				var up_1 = $('#up_1').val();
				var up_2 = $('#up_2').val();
				var up_3 = $('#up_3').val();
				var up_4 = $('#up_4').val();
				var up_5 = $('#up_5').val();
				var up_6 = $('#up_6').val();
				var up_7 = $('#up_7').val();
				var ys_1 = $('#ys_1').val();
				var ys_2 = $('#ys_2').val();
				var ys_3 = $('#ys_3').val();
				var ys_4 = $('#ys_4').val();
				var ys_5 = $('#ys_5').val();
				var ys_6 = $('#ys_6').val();
				var ys_7 = $('#ys_7').val();
				var ten_1 = $('#ten_1').val();
				var ten_2 = $('#ten_2').val();
				var ten_3 = $('#ten_3').val();
				var ten_4 = $('#ten_4').val();
				var ten_5 = $('#ten_5').val();
				var ten_6 = $('#ten_6').val();
				var ten_7 = $('#ten_7').val();
				var og_1 = $('#og_1').val();
				var og_2 = $('#og_2').val();
				var og_3 = $('#og_3').val();
				var og_4 = $('#og_4').val();
				var og_5 = $('#og_5').val();
				var og_6 = $('#og_6').val();
				var og_7 = $('#og_7').val();
				var fg_1 = $('#fg_1').val();
				var fg_2 = $('#fg_2').val();
				var fg_3 = $('#fg_3').val();
				var fg_4 = $('#fg_4').val();
				var fg_5 = $('#fg_5').val();
				var fg_6 = $('#fg_6').val();
				var fg_7 = $('#fg_7').val();
				var elo_1 = $('#elo_1').val();
				var elo_2 = $('#elo_2').val();
				var elo_3 = $('#elo_3').val();
				var elo_4 = $('#elo_4').val();
				var elo_5 = $('#elo_5').val();
				var elo_6 = $('#elo_6').val();
				var elo_7 = $('#elo_7').val();
				var bend_1 = $('#bend_1').val();
				var bend_2 = $('#bend_2').val();
				var bend_3 = $('#bend_3').val();
				var bend_4 = $('#bend_4').val();
				var bend_5 = $('#bend_5').val();
				var bend_6 = $('#bend_6').val();
				var bend_7 = $('#bend_7').val();
				var rebend_1 = $('#rebend_1').val();
				var rebend_2 = $('#rebend_2').val();
				var rebend_3 = $('#rebend_3').val();
				var rebend_4 = $('#rebend_4').val();
				var rebend_5 = $('#rebend_5').val();
				var rebend_6 = $('#rebend_6').val();
				var rebend_7 = $('#rebend_7').val();				
				var c1 = $('#c1').val();
				
				var c2 = $('#c2').val();
				var c3 = $('#c3').val();
				var c4 = $('#c4').val();
				var c5 = $('#c5').val();
				var c6 = $('#c6').val();
				var c7 = $('#c7').val();
				var c8 = $('#c8').val();
				var c9 = $('#c9').val();
				var c10 = $('#c10').val();
				var c11 = $('#c11').val();
				var c12 = $('#c12').val();
				var c13 = $('#c13').val();
				var c14 = $('#c14').val();
				var len_1 = $('#len_1').val();
				var samp_1 = $('#samp_1').val();
				var idEdit = $('#idEdit').val(); 
				var phy_temp = $('#phy_temp').val();
				
				
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&grade='+grade+'&dia='+dia+'&brand='+brand+'&chk_phy='+chk_phy+'&chk1='+chk1+'&chk2='+chk2+'&chk3='+chk3+'&chk4='+chk4+'&chk5='+chk5+'&chk6='+chk6+'&chk7='+chk7+'&labno1='+labno1+'&labno2='+labno2+'&labno3='+labno3+'&labno4='+labno4+'&labno5='+labno5+'&labno6='+labno6+'&labno7='+labno7+'&dia_1='+dia_1+'&dia_2='+dia_2+'&dia_3='+dia_3+'&dia_4='+dia_4+'&dia_5='+dia_5+'&dia_6='+dia_6+'&dia_7='+dia_7+'&w_1='+w_1+'&w_2='+w_2+'&w_3='+w_3+'&w_4='+w_4+'&w_5='+w_5+'&w_6='+w_6+'&w_7='+w_7+'&l_1='+l_1+'&l_2='+l_2+'&l_3='+l_3+'&l_4='+l_4+'&l_5='+l_5+'&l_6='+l_6+'&l_7='+l_7+'&cs_1='+cs_1+'&cs_2='+cs_2+'&cs_3='+cs_3+'&cs_4='+cs_4+'&cs_5='+cs_5+'&cs_6='+cs_6+'&cs_7='+cs_7+'&gl_1='+gl_1+'&gl_2='+gl_2+'&gl_3='+gl_3+'&gl_4='+gl_4+'&gl_5='+gl_5+'&gl_6='+gl_6+'&gl_7='+gl_7+'&yp_1='+yp_1+'&yp_2='+yp_2+'&yp_3='+yp_3+'&yp_4='+yp_4+'&yp_5='+yp_5+'&yp_6='+yp_6+'&yp_7='+yp_7+'&up_1='+up_1+'&up_2='+up_2+'&up_3='+up_3+'&up_4='+up_4+'&up_5='+up_5+'&up_6='+up_6+'&up_7='+up_7+'&ys_1='+ys_1+'&ys_2='+ys_2+'&ys_3='+ys_3+'&ys_4='+ys_4+'&ys_5='+ys_5+'&ys_6='+ys_6+'&ys_7='+ys_7+'&ten_1='+ten_1+'&ten_2='+ten_2+'&ten_3='+ten_3+'&ten_4='+ten_4+'&ten_5='+ten_5+'&ten_6='+ten_6+'&ten_7='+ten_7+'&og_1='+og_1+'&og_2='+og_2+'&og_3='+og_3+'&og_4='+og_4+'&og_5='+og_5+'&og_6='+og_6+'&og_7='+og_7+'&fg_1='+fg_1+'&fg_2='+fg_2+'&fg_3='+fg_3+'&fg_4='+fg_4+'&fg_5='+fg_5+'&fg_6='+fg_6+'&fg_7='+fg_7+'&elo_1='+elo_1+'&elo_2='+elo_2+'&elo_3='+elo_3+'&elo_4='+elo_4+'&elo_5='+elo_5+'&elo_6='+elo_6+'&elo_7='+elo_7+'&bend_1='+bend_1+'&bend_2='+bend_2+'&bend_3='+bend_3+'&bend_4='+bend_4+'&bend_5='+bend_5+'&bend_6='+bend_6+'&bend_7='+bend_7+'&rebend_1='+rebend_1+'&rebend_2='+rebend_2+'&rebend_3='+rebend_3+'&rebend_4='+rebend_4+'&rebend_5='+rebend_5+'&rebend_6='+rebend_6+'&rebend_7='+rebend_7+'&chk_chem='+chk_chem+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&c7='+c7+'&c8='+c8+'&c9='+c9+'&c10='+c10+'&c11='+c11+'&c12='+c12+'&c13='+c13+'&c14='+c14+'&ulr='+ulr+'&len_1='+len_1+'&samp_1='+samp_1+'&sample_qty='+sample_qty+'&heat_no='+heat_no+'&tag_heading='+tag_heading+'&tag_data='+tag_data+'&chk_len='+chk_len + '&phy_temp=' + phy_temp+ '&amend_date=' + amend_date;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_span_steel.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
		
		getGlazedTiles();
		var report_no = $('#report_no').val(); 
		var job_no = $('#job_no').val();
			//window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
			
			location.reload();
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
        url: '<?php echo $base_url; ?>save_span_steel.php',
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
			$('#amend_date').val(data.amend_date);
            $('#tag_data').val(data.tag_data);
            $('#tag_heading').val(data.tag_heading);
			var phy,chem,chk_1,chk_2,chk_3,chk_4,chk_5,chk_6,chk_7;
            phy = data.chk_phy;
            chem = data.chk_chem;
            var len = data.chk_len;
            

			$('#one').show(); 
			
			


			if(phy=="1")
			{
			   $('#txtphy').css("background-color","var(--success)");			
			   $("#chk_phy").prop("checked", true); 
			}else{
				$('#txtphy').css("background-color","white");			
				$("#chk_phy").prop("checked", false); 
			}
			
			if(len=="1")
			{
			   		
			   $("#chk_len").prop("checked", true); 
			}else{
					
				$("#chk_len").prop("checked", false); 
			}

			if(chem=="1")
			{
			   $('#txtchem').css("background-color","var(--success)");			
			   $("#chk_chem").prop("checked", true); 
				
			$('#c1').val(data.c1);
            $('#c2').val(data.c2);
            $('#c3').val(data.c3);
            $('#c4').val(data.c4);
            $('#c5').val(data.c5);
            $('#c6').val(data.c6);
            $('#c7').val(data.c7);
            $('#c8').val(data.c8);
            $('#c9').val(data.c9);
            $('#c10').val(data.c10);
            $('#c11').val(data.c11);
            $('#c12').val(data.c12);
            $('#c13').val(data.c13);
            $('#c14').val(data.c14);
            

			}else{
				$('#txtchem').css("background-color","white");			
				$("#chk_chem").prop("checked", false); 
			}

			if(chk_1=="1"){		
			   $("#chk1").prop("checked", true); 
			}else{
				$("#chk1").prop("checked", false); 
			}
			
			if(chk_2=="1"){		
			   $("#chk2").prop("checked", true); 
			}else{
				$("#chk2").prop("checked", false); 
			}

			if(chk_3=="1"){		
			   $("#chk3").prop("checked", true); 
			}else{
				$("#chk3").prop("checked", false); 
			}


			if(chk_4=="1"){		
			   $("#chk4").prop("checked", true); 
			}else{
				$("#chk4").prop("checked", false); 
			}

			if(chk_5=="1"){		
			   $("#chk5").prop("checked", true); 
			}else{
				$("#chk5").prop("checked", false); 
			}


			if(chk_6=="1"){		
			   $("#chk6").prop("checked", true); 
			}else{
				$("#chk6").prop("checked", false); 
			}

			if(chk_7=="1"){		
			   $("#chk7").prop("checked", true); 
			}else{
				$("#chk7").prop("checked", false); 
			}
            
            $('#labno1').val(data.labno1);
            $('#labno2').val(data.labno2);
            $('#labno3').val(data.labno3);
            $('#labno4').val(data.labno4);
            $('#labno5').val(data.labno5);
            $('#labno6').val(data.labno6);
            $('#labno7').val(data.labno7);
            $('#dia_1').val(data.dia_1);
            $('#dia_2').val(data.dia_2);
            $('#dia_3').val(data.dia_3);
            $('#dia_4').val(data.dia_4);
            $('#dia_5').val(data.dia_5);
            $('#dia_6').val(data.dia_6);
            $('#dia_7').val(data.dia_7);
            $('#w_1').val(data.w_1);
            $('#w_2').val(data.w_2);
            $('#w_3').val(data.w_3);
            $('#w_4').val(data.w_4);
            $('#w_5').val(data.w_5);
            $('#w_6').val(data.w_6);
            $('#w_7').val(data.w_7);
            $('#l_1').val(data.l_1);
            $('#l_2').val(data.l_2);
            $('#l_3').val(data.l_3);
            $('#l_4').val(data.l_4);
            $('#l_5').val(data.l_5);
            $('#l_6').val(data.l_6);
            $('#l_7').val(data.l_7);
            $('#cs_1').val(data.cs_1);
            $('#cs_2').val(data.cs_2);
            $('#cs_3').val(data.cs_3);
            $('#cs_4').val(data.cs_4);
            $('#cs_5').val(data.cs_5);
            $('#cs_6').val(data.cs_6);
            $('#cs_7').val(data.cs_7);
            $('#gl_1').val(data.gl_1);
            $('#gl_2').val(data.gl_2);
            $('#gl_3').val(data.gl_3);
            $('#gl_4').val(data.gl_4);
            $('#gl_5').val(data.gl_5);
            $('#gl_6').val(data.gl_6);
            $('#gl_7').val(data.gl_7);
            $('#yp_1').val(data.yp_1);
            $('#yp_2').val(data.yp_2);
            $('#yp_3').val(data.yp_3);
            $('#yp_4').val(data.yp_4);
            $('#yp_5').val(data.yp_5);
            $('#yp_6').val(data.yp_6);
            $('#yp_7').val(data.yp_7);
            $('#up_1').val(data.up_1);
            $('#up_2').val(data.up_2);
            $('#up_3').val(data.up_3);
            $('#up_4').val(data.up_4);
            $('#up_5').val(data.up_5);
            $('#up_6').val(data.up_6);
            $('#up_7').val(data.up_7);
            $('#ys_1').val(data.ys_1);
            $('#ys_2').val(data.ys_2);
            $('#ys_3').val(data.ys_3);
            $('#ys_4').val(data.ys_4);
            $('#ys_5').val(data.ys_5);
            $('#ys_6').val(data.ys_6);
            $('#ys_7').val(data.ys_7);
            $('#ten_1').val(data.ten_1);
            $('#ten_2').val(data.ten_2);
            $('#ten_3').val(data.ten_3);
            $('#ten_4').val(data.ten_4);
            $('#ten_5').val(data.ten_5);
            $('#ten_6').val(data.ten_6);
            $('#ten_7').val(data.ten_7);
            $('#og_1').val(data.og_1);
            $('#og_2').val(data.og_2);
            $('#og_3').val(data.og_3);
            $('#og_4').val(data.og_4);
            $('#og_5').val(data.og_5);
            $('#og_6').val(data.og_6);
            $('#og_7').val(data.og_7);
            $('#fg_1').val(data.fg_1);
            $('#fg_2').val(data.fg_2);
            $('#fg_3').val(data.fg_3);
            $('#fg_4').val(data.fg_4);
            $('#fg_5').val(data.fg_5);
            $('#fg_6').val(data.fg_6);
            $('#fg_7').val(data.fg_7);
            $('#elo_1').val(data.elo_1);
            $('#elo_2').val(data.elo_2);
            $('#elo_3').val(data.elo_3);
            $('#elo_4').val(data.elo_4);
            $('#elo_5').val(data.elo_5);
            $('#elo_6').val(data.elo_6);
            $('#elo_7').val(data.elo_7);
            $('#bend_1').val(data.bend_1);
            $('#bend_2').val(data.bend_2);
            $('#bend_3').val(data.bend_3);
            $('#bend_4').val(data.bend_4);
            $('#bend_5').val(data.bend_5);
            $('#bend_6').val(data.bend_6);
            $('#bend_7').val(data.bend_7);
            $('#rebend_1').val(data.rebend_1);
            $('#rebend_2').val(data.rebend_2);
            $('#rebend_3').val(data.rebend_3);
            $('#rebend_4').val(data.rebend_4);
            $('#rebend_5').val(data.rebend_5);
            $('#rebend_6').val(data.rebend_6);
            $('#rebend_7').val(data.rebend_7);           
            $('#len_1').val(data.len_1);           
            $('#samp_1').val(data.samp_1);           
            $('#phy_temp').val(data.phy_temp);
			
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

/*
$(document).on("change", "#l_1", function () {
				var clicked_id = $(this).val();  
			var multipling= parseFloat(clicked_id)*10000;	
			$('#len_1').val(multipling);
			alert("jjj"+multipling);
    
});	*/
	</script>