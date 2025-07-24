
<?php 
session_start(); 
include("header.php");
include("sidebar.php"); 
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
$select_query = "select * from job_invert WHERE `est_sr_no`='$_GET[id]' AND `bt_isdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);


		if(isset($_GET['id'])){
			$aa=$_GET['id'];
			
		}
	if (mysqli_num_rows($result_select) > 0) {
		$row_select = mysqli_fetch_assoc($result_select);
		$serial_no1= $row_select['sr_no'];
		$est_sr_no= $row_select['est_sr_no'];
		
		//-------------------job no logic--------------
		
		$j_no=1;
		$final_j_no;
		//$querys_job = "SELECT * FROM metal_0_075_1_18_mm WHERE `sr_no`= '$serial_no1' AND `is_deleted`='0'";
		$querys_job = "SELECT * FROM metal_0_075_1_18_mm WHERE `is_deleted`='0'";
		$qrys_jobno = mysqli_query($conn,$querys_job);
		$rows=mysqli_num_rows($qrys_jobno);
		if($rows<1){
			$final_j_no=$j_no;
		}
		else{
			while($r1 = mysqli_fetch_array($qrys_jobno)){
				$jno=$r1['job_no'];
				$jno1 = substr($jno,4);
			}
		
			$final_j_no=$jno1+1;
		}

	
		//---------------------------------------------
		
		
		$job_no= "1";
		$agency_id= $row_select['agency_id'];
		$agency_name= $row_select['agency_name'];
		$auth_name= $row_select['auth_name'];
		$ref_date= $row_select['ref_date'];
		$ref_name= $row_select['ref_name'];

		$srno2=substr($est_sr_no,7);
		$srno1=substr($est_sr_no,0,7);
		
		/*$select_query1 = "select * from billmaster WHERE `sr_no`='$est_sr_no' AND `bill_isdeleted`='0'";
		$result_select1 = mysqli_query($conn, $select_query1);

		if (mysqli_num_rows($result_select1) > 0) {
			$row_select1 = mysqli_fetch_assoc($result_select1);
			$name_of_work= $row_select1['name_of_work'];
			$city_id= $row_select1['city_id'];
			$ref_name= $row_select1['ref_name'];
			$ref_id= $row_select1['ref_id'];
			$material_id=$row_select1['material_id'];
			
				$select_city = "select * from city WHERE `id`='$city_id'";
				$result_city = mysqli_query($conn, $select_city);
	

				if (mysqli_num_rows($result_city) > 0) {
					$row_city = mysqli_fetch_assoc($result_city);
					$name_of_work= $row_select1['name_of_work'];
					$city_name= $row_city['city_name'];
				}		
		}*/
		
	
	}
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		
		<h1>
			METAL 53-22-4 MM Test
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">METAL 53-22-4  MM</h3>
					</div>
					<div class="box-default">
					<form class="form" id="Glazed" method="post">

							<div class="row">

								<div class="col-lg-6">
									<div class="form-group">
									<input type="hidden" class="form-control" id="txt_id" value="<?php echo $serial_no1;?>" name="txt_id" >
									  <label for="inputEmail3" class="col-sm-2 control-label">SR.No.:</label>

									  <div class="col-sm-3">
										<input type="text" class="form-control" id="txt_srno1" value="<?php echo $srno1;?>" name="txt_srno1" >
									  </div>
									  <div class="col-sm-3">
											<input type="text" class="form-control" id="txt_srno2" value="<?php echo $srno2;?>" name="txt_srno2">

									  </div>

										<label for="inputEmail3" class="col-sm-1 control-label">Job No.:</label>
											<div class="col-sm-3">
											<div class="row">
												<div class="col-md-7">
													<input type="text" class="form-control" id="month_name" name="month_name" >
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" tabindex="1"  value="<?php echo $final_j_no;?>" id="txt_jobno" name="txt_jobno">
												</div>
											</div>
											</div>
									</div>
								</div>
									<div class="col-lg-6">
										<div class="form-group">
										
										  <label for="inputEmail3" class="col-sm-2 control-label">Days:</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="txt_day" name="txt_day">
											</div>
											
											<label for="inputEmail3" class="col-sm-2 control-label">Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="3" id="txt_date" name="txt_date" value="<?php echo date("d/m/Y");?>">
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Letter No:</label>
										 

										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="txt_ref" value="<?php echo $ref_name;?>" name="txt_ref">
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">

										  <label for="inputEmail3" class="col-sm-2 control-label">Ref Date:</label>
										  <div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="5" id="ref_date" name="ref_date" value="<?php echo date('d/m/Y', strtotime($ref_date));?>">
												</div>
											</div>
											 <label for="inputEmail3" class="col-sm-2 control-label">ID Brand:</label>
										  <div class="col-sm-4">
											<input type="text" class="form-control" id="txt_brand" name="txt_brand" Value="N/A">
										  </div>
										</div>
									</div>
									
								</div>
								<br>
								<div class="row">

									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Detail Of Sample:</label>

										  <div class="col-sm-4">
											<input type="text" class="form-control" id="detail_sample" name="detail_sample" value="0.075 - 1.18 MM">
										  </div>
									

											<label for="inputEmail3" class="col-sm-2 control-label">Identification Mark:</label>

											  <div class="col-sm-4">
												<input type="text" class="form-control" tabindex="1"  id="id_mark" name="id_mark" value="N/A">
											  </div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
										
										  <label for="inputEmail3" class="col-sm-2 control-label">Starting Date of Test:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="3" id="start_date" name="start_date" value="<?php echo date('d/m/Y', strtotime($ref_date));?>">
												</div>
											</div>
											
											<label for="inputEmail3" class="col-sm-2 control-label">Complition Date of Test:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="3" id="end_date" name="end_date" value="<?php echo date("d/m/Y");?>">
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Condition Of Sample:</label>

										  <div class="col-sm-4">
											<select class="form-control" id="con_sample" name="con_sample">
													<option>Seal</option>
													<option>Unsealed</option>	
											</select>
										  </div>
											<label for="inputEmail3" class="col-sm-2 control-label">Specification Of Sample:</label>

										  <div class="col-sm-4">
											<input type="text" class="form-control" id="specification" name="specification" >
										  </div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Source Of Sample:</label>

										  <div class="col-sm-4">
											<input type="text" class="form-control" id="source" name="source" >
										  </div>
										  <label for="inputEmail3" class="col-sm-2 control-label">Date of Sample Received:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="3" id="rec_sample_date" name="rec_sample_date" value="<?php echo date("d/m/Y");?>">
												</div>
											</div>
											<!--<div class="col-sm-4">
												<button type="button" class="btn btn-info pull-right" id="btn_auto" name="btn_auto" tabindex="14" >Auto</button>

											</div>-->
										</div>
									</div>
								</div>
								<br>
																<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
										
											<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" id="btn_auto" name="btn_auto" tabindex="14" >Auto</button>

											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>

											</div>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_metal_25_90_hb.php?id=<?php echo $_GET['id'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

											</div>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_metal_22_4_2_36_1.php?id=<?php echo $_GET['id'];?>&name=<?php echo "metal_hb_25_90_mm";?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>

											</div>
											
										</div>
									</div>
								</div>
								
								
								
								
					<hr style="border-top: 1px solid;">
								<!--Nikunj Code Start-->

								
  
  <div class="panel-group" id="accordion">
  <div class="panel panel-default">
      <div class="panel-heading">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
			<h4 class="panel-title">
			<b>GRADATION OF TESTING</b>
			</h4>
		</a>
		</h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body"><div class="row">									
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
													<label for="inputEmail3" class="col-sm-2 control-label">63</label>
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
													<label for="inputEmail3" class="col-sm-2 control-label">53</label>
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
													<label for="inputEmail3" class="col-sm-2 control-label">45</label>
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
													<label for="inputEmail3" class="col-sm-2 control-label">22.4</label>
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
													<label for="inputEmail3" class="col-sm-2 control-label">11.2</label>
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
				 
  
    <div class="panel panel-default">
      <div class="panel-heading">
	  <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
			<h4 class="panel-title">
			<b>IMPACT VALUE</b>
			</h4>
		</a>
		</h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
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
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Total Weight taken in mould in g = A:</label>
									</div>
									</div>
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weight of material retained on IS sieve 2.36 mm in g = B :</label>
									</div>
									</div>
									
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weight of material passing through IS sieve 2.36mm in g = C:</label>
									</div>
									</div>

									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Aggregate Impact Value = B/A X 100</label>
									</div>
									</div>
											
								</div>
								<br>
								<!--IMPACT VALUE SR 1-->
								<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="imp_w_m_a_1" name="imp_w_m_a_1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="imp_w_m_b_1" name="imp_w_m_b_1" >
									  </div>
									</div>
									</div>																
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="imp_w_m_c_1" name="imp_w_m_c_1" ReadOnly>
									  </div>
									</div>
									</div>
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="imp_value_1" name="imp_value_1" ReadOnly>
									  </div>
									</div>
									</div>									
								</div>
								<br>
								<!--IMPACT VALUE SR 2-->
								<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									   <div class="col-sm-12">
										<input type="text" class="form-control" id="imp_w_m_a_2" name="imp_w_m_a_2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-3">
									<div class="form-group">
									    <div class="col-sm-12">
										<input type="text" class="form-control" id="imp_w_m_b_2" name="imp_w_m_b_2" >
									  </div>
									</div>
									</div>																
									<div class="col-lg-3">
									<div class="form-group">
									    <div class="col-sm-12">
										<input type="text" class="form-control" id="imp_w_m_c_2" name="imp_w_m_c_2" ReadOnly>
									  </div>
									</div>
									</div>
									<div class="col-lg-3">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="imp_value_2" name="imp_value_2" ReadOnly>
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
									<div class="col-sm-3">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="imp_value" name="imp_value" >
									  </div>
									</div>
									</div>																										
								</div>
								
								<!--Impact VALUE OVER-->
		
		</div>
      </div>
    </div>
	
				 <div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title">
					   <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
							<h4 class="panel-title">
							<b>ABRASION VALUE</b>
							</h4>
						</a>
					</h4>
				  </div>
				  <div id="collapse3" class="panel-collapse collapse">
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
									<div class="row">
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Total Weight taken for testing in g = A:</label>

									  <div class="col-sm-6">
										<input type="text" class="form-control" id="abr_wt_t_a_1" name="abr_wt_t_a_1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Weight of material retained on IS sieve in g = B :</label>

									  <div class="col-sm-6">
										<input type="text" class="form-control" id="abr_wt_t_b_1" name="abr_wt_t_b_1" >
									  </div>
									</div>
									</div>
									
									
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Weight of material passing through IS sieve 1.70mm C = A - B:</label>

									  <div class="col-sm-6">
										<input type="text" class="form-control" id="abr_wt_t_c_1" name="abr_wt_t_c_1" ReadOnly>
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
									  <label for="inputEmail3" class="col-sm-6 control-label">Abrasion Index % :</label>

									  <div class="col-sm-6">
										<input type="text" class="form-control" id="abr_index" name="abr_index" >
									  </div>
									</div>
									</div>																										
								</div>
								<!--ABRASION VALUE OVER-->
								
						
						</div>
				  </div>
				</div>
							

				<div class="panel panel-default">
				  <div class="panel-heading">
				  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
							<h4 class="panel-title">
							<b>ELONGATION INDEX</b>
							</h4>
						</a>
					</h4>						
				  </div>
				  <div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
						
						<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">ELONGATION INDEX</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_elo"  id="chk_elo" value="chk_elo"><br>
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
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. Of 200 Pcs Retained on each Sieve fraction, g (1)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. of Pieces passing through appropriate gauge ,g (2)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Percentage of the wt. of total number of pieces pass in each fraction (x) = (2)/(1) X 100</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Percentage of each fraction of pieces to the total Wt. of sample, % (y) = (1)/A X 100</label>
									</div>
									</div>

									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weighted percentage of the Wt. of pieces passing, % = (x) X (y) / 100</label>
									</div>
									</div>
									
									
								</div>
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Passing through IS sieve, mm</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Retained on IS sieve, mm</label>
									</div>
									</div>																	
								</div>
								<br>
								<!--Elongation Index VALUE SR 1-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_e1"  id="chk_e1" value="chk_e1">
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="ss11" name="ss11" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ss21" name="ss21" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="aa1" name="aa1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="bb1" name="bb1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cc1" name="cc1" readOnly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="dd1" name="dd1" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="ee1" name="ee1" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							<br>						
							<!--Elongation Index VALUE SR 2-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_e2"  id="chk_e2" value="chk_e2">
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="ss12" name="ss12" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ss22" name="ss22" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="aa2" name="aa2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="bb2" name="bb2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cc2" name="cc2" readOnly >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="dd2" name="dd2" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="ee2" name="ee2" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							<Br>
							<!--Elongation Index VALUE SR 3-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_e3"  id="chk_e3" value="chk_e3">
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="ss13" name="ss13" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ss23" name="ss23" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="aa3" name="aa3" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="bb3" name="bb3" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cc3" name="cc3" readOnly >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="dd3" name="dd3" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="ee3" name="ee3" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							
							<br>
							
								<!--Elongation Index VALUE SR 4-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_e4"  id="chk_e4" value="chk_e4">
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="ss14" name="ss14" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ss24" name="ss24" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="aa4" name="aa4" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="bb4" name="bb4" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cc4" name="cc4" readOnly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="dd4" name="dd4" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="ee4" name="ee4" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							<br>						
							<!--Elongation Index VALUE SR 5-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_e5"  id="chk_e5" value="chk_e5">
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="ss15" name="ss15" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ss25" name="ss25" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="aa5" name="aa5" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="bb5" name="bb5" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cc5" name="cc5" readOnly >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="dd5" name="dd5" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="ee5" name="ee5" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							<Br>
							
							
							<!--Elongation Index TOTAL -->
								<div class="row">
									<div class="col-lg-1">
									
									</div>
									<div class="col-lg-1">
									
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-6">
										 <label for="inputEmail3" class="control-label">A = </label>
									  </div>
									  <div class="col-sm-6">
										<input type="text" class="form-control" id="sumaa" name="sumaa" readOnly>
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-6">
										 <label for="inputEmail3" class="control-label">B = </label>
									  </div>
									  <div class="col-sm-6">
										<input type="text" class="form-control" id="sumbb" name="sumbb" readOnly>
									  </div>
									</div>
									</div>																	
								</div>
								<br>
								<div class="row">
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										 <label for="inputEmail3" class="control-label">Remarks :</label>
									  </div>									  
									</div>
									</div>
									<div class="col-lg-8">
									<div class="form-group">
									  <div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">ELONGATION INDEX, B/A X 100= </label>
									  </div>
									  <div class="col-sm-4">
										<input type="text" class="form-control" id="ei_index" name="ei_index"  readOnly>
									  </div>
									  <div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">%</label>
									  </div>
									</div>
									</div>
																																		
								</div>
								<!--Elongation Index VALUE OVER-->
						
						</div>
				  </div>
				</div>
								
				
								
								
				<div class="panel panel-default">
				  <div class="panel-heading">
				  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
							<h4 class="panel-title">
							<b>FLAKINESS INDEX</b>
							</h4>
						</a>
				</h4>
				  </div>
				  <div id="collapse5" class="panel-collapse collapse">
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
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. Of 200 Pcs Retained on each Sieve fraction, g (1)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Wt. of Pieces passing through appropriate gauge ,g (2)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Percentage of the wt. of total number of pieces pass in each fraction (x) = (2)/(1) X 100</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Percentage of each fraction of pieces to the total Wt. of sample, % (y) = (1)/A X 100</label>
									</div>
									</div>

									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Weighted percentage of the Wt. of pieces passing, % = (x) X (y) / 100</label>
									</div>
									</div>
									
									
								</div>
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Passing through IS sieve, mm</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="control-label">Retained on IS sieve, mm</label>
									</div>
									</div>																	
								</div>
								<br>
								<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f1"  id="chk_f1" value="chk_f1">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s11" name="s11" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="s21" name="s21" >
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
										<input type="text" class="form-control" id="c1" name="c1" readOnly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d1" name="d1" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e1" name="e1" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							<br>						
							<!--Flakiness Index VALUE SR 2-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f2"  id="chk_f2" value="chk_f2">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s12" name="s12" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="s22" name="s22" >
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
										<input type="text" class="form-control" id="c2" name="c2" readOnly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d2" name="d2" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e2" name="e2" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							<Br>
							<!--Flakiness Index VALUE SR 3-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f3"  id="chk_f3" value="chk_f3">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s13" name="s13" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="s23" name="s23" >
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
										<input type="text" class="form-control" id="c3" name="c3" readOnly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d3" name="d3" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e3" name="e3" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 4-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f4"  id="chk_f4" value="chk_f4">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s14" name="s14" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="s24" name="s24" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a4" name="a4" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b4" name="b4" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c4" name="c4" readOnly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d4" name="d4" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e4" name="e4" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							<br>						
							<!--Flakiness Index VALUE SR 5-->
								<div class="row">
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-3">
									   <input type="checkbox" name="chk_f5"  id="chk_f5" value="chk_f5">
										
									  </div>
									  <div class="col-sm-9">
									  <input type="text" class="form-control" id="s15" name="s15" >
									  </div>
									</div>
									</div>
									<div class="col-lg-1">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="s25" name="s25" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="a5" name="a5" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="b5" name="b5" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="c5" name="c5" readOnly>
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="d5" name="d5" readOnly>
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="e5" name="e5" readOnly>
									</div>
								    </div>
								</div>								
							</div>
							<Br>
							
							<br>
							<!--Flakiness Index TOTAL -->
								<div class="row">
									<div class="col-lg-1">
									
									</div>
									<div class="col-lg-1">
									
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-6">
										 <label for="inputEmail3" class="control-label">A = </label>
									  </div>
									  <div class="col-sm-6">
										<input type="text" class="form-control" id="suma" name="suma" readOnly>
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-6">
										 <label for="inputEmail3" class="control-label">B = </label>
									  </div>
									  <div class="col-sm-6">
										<input type="text" class="form-control" id="sumb" name="sumb" readOnly>
									  </div>
									</div>
									</div>																	
								</div>
								<br>
								<div class="row">
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										 <label for="inputEmail3" class="control-label">Remarks :</label>
									  </div>									  
									</div>
									</div>
									<div class="col-lg-8">
									<div class="form-group">
									  <div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">FLAKINESS INDEX, B/A X 100 = </label>
									  </div>
									  <div class="col-sm-4">
										<input type="text" class="form-control" id="fi_index" name="fi_index"  readOnly>
									  </div>
									  <div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">%</label>
									  </div>
									</div>
									</div>
																																		
								</div>
								<!--Flakiness Index VALUE OVER-->
								
						
						</div>
				  </div>
				</div>
				
				
				<div class="panel panel-default">
				  <div class="panel-heading">
				  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
							<h4 class="panel-title">
							<b>SPECIFIC GRAVITY & WATER ABSORPTION</b>
							</h4>
						</a>
				</h4>
				  </div>
				  <div id="collapse6" class="panel-collapse collapse">
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
				
				
				<div class="panel panel-default">
				  <div class="panel-heading">
				  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
							<h4 class="panel-title">
							<b>LIQUID LIMIT</b>
							</h4>
						</a>
				</h4>
				  </div>
				  <div id="collapse7" class="panel-collapse collapse">
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
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12"><b>Detail</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>1</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>2</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>3</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>4</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>1</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>2</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>3</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b></b></div>
											</div>
										</div>
										</div>
								<br>
								<br>
								
								<!------Penetration------->
								<div class="row">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Penetration in (mm)</label>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="p_ll_1" name="p_ll_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="p_ll_2" name="p_ll_2" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="p_ll_4" name="p_ll_4" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="p_ll_5" name="p_ll_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="p_pl_1" name="p_pl_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="p_pl_2" name="p_pl_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="p_pl_3" name="p_pl_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="p_ll_3" name="p_ll_3" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<!------Container Number------->
								<div class="row">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Container Number</label>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cn_ll_1" name="cn_ll_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cn_ll_2" name="cn_ll_2" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cn_ll_4" name="cn_ll_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cn_ll_5" name="cn_ll_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cn_pl_1" name="cn_pl_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cn_pl_2" name="cn_pl_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cn_pl_3" name="cn_pl_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="cn_ll_3" name="cn_ll_3" >
												</div>
											</div>
										</div>
								</div>
								
								<br>
								<!------Wt. Of cont. + Wt. Of wet soil (gm)------->
								<div class="row">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Wt. Of cont. + Wt. Of wet soil (gm)</label>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wt_ll_1" name="wt_ll_1" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wt_ll_2" name="wt_ll_2" readonly>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wt_ll_4" name="wt_ll_4" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wt_ll_5" name="wt_ll_5" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wt_pl_1" name="wt_pl_1" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wt_pl_2" name="wt_pl_2" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wt_pl_3" name="wt_pl_3" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="wt_ll_3" name="wt_ll_3" readonly>
												</div>
											</div>
										</div>
								</div>
							
								
								<br>
								<!------wt. Of Cont. + of dry Soil (gm)------->
								<div class="row">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">wt. Of Cont. + of dry Soil (gm)</label>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dy_ll_1" name="dy_ll_1" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dy_ll_2" name="dy_ll_2" readonly>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dy_ll_4" name="dy_ll_4" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dy_ll_5" name="dy_ll_5" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dy_pl_1" name="dy_pl_1" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dy_pl_2" name="dy_pl_2" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dy_pl_3" name="dy_pl_3" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="dy_ll_3" name="dy_ll_3" readonly>
												</div>
											</div>
										</div>
								</div>
								
								<br>
								<!------Wt. Of water----------------->
								<div class="row">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Wt. Of water</label>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_ll_1" name="wtr_ll_1" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_ll_2" name="wtr_ll_2" readonly>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_ll_4" name="wtr_ll_4" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_ll_5" name="wtr_ll_5" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_pl_1" name="wtr_pl_1" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_pl_2" name="wtr_pl_2" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_pl_3" name="wtr_pl_3" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="wtr_ll_3" name="wtr_ll_3" readonly>
												</div>
											</div>
										</div>
								</div>
								
								<br>
								<!------Wt. Of Container-------------->
								<div class="row">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Wt. Of Container</label>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con_ll_1" name="con_ll_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con_ll_2" name="con_ll_2" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con_ll_4" name="con_ll_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con_ll_5" name="con_ll_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con_pl_1" name="con_pl_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con_pl_2" name="con_pl_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con_pl_3" name="con_pl_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="con_ll_3" name="con_ll_3" >
												</div>
											</div>
										</div>
								</div>
								
								<br>
								<!------Wt. Of oven dry soil------------>
								<div class="row">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Wt. Of oven dry soil</label>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="od_ll_1" name="od_ll_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="od_ll_2" name="od_ll_2" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="od_ll_4" name="od_ll_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="od_ll_5" name="od_ll_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="od_pl_1" name="od_pl_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="od_pl_2" name="od_pl_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="od_pl_3" name="od_pl_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="od_ll_3" name="od_ll_3" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<!------% Moisture Content------------>
								<div class="row">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">% Moisture Content</label>
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mc_ll_1" name="mc_ll_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mc_ll_2" name="mc_ll_2" >
												</div>
											</div>
										</div>										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mc_ll_4" name="mc_ll_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mc_ll_5" name="mc_ll_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mc_pl_1" name="mc_pl_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mc_pl_2" name="mc_pl_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mc_pl_3" name="mc_pl_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="mc_ll_3" name="mc_ll_3" >
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
													<input type="text" class="form-control" id="avg_ll" name="avg_ll" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="avg_pl" name="avg_pl" >
												</div>
											</div>
										</div>
									
											
								</div>

								<br>
								<div class="row">
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Plastic Limit</label>
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
													<label for="inputEmail3" class="control-label">Liquide Limit</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="liquide_limit" name="liquide_limit" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="control-label">Plastic Index</label>
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="chk_pl" name="chk_pl" >
												</div>
											</div>
										</div>
									
											
								</div>

						
						</div>
				  </div>
				</div>
								
								
						
				<div class="panel panel-default">
					  <div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
							<h4 class="panel-title">
							<b>MDD AND OMC</b>
							</h4>
						</a>
					</h4>
					  </div>
					  <div id="collapse8" class="panel-collapse collapse">
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
											
								</div>
						
								<br>
								<div class="row">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>Sr No.</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Particulars</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>1</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>2</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>3</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>4</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>5</b></div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>6</b></div>
											</div>
										</div>
										</div>
								<br>
								
								<div class="row">
									<div class="col-lg-12">
												<div class="form-group">
													<div class="col-sm-12"><b>Density</b></div>
												</div>
									</div>
								</div>
								
								<!------Wt. of Mould + Compacted Soil (w) gm------->
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>1</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Wt. of Mould + Compacted Soil (w) gm</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d11" name="d11" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d12" name="d12" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d13" name="d13" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d14" name="d14" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d15" name="d15" >
													
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d16" name="d16" >
													
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>2</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Wt. of Mould (w) gm</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d21" name="d21" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d22" name="d22" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d23" name="d23" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d24" name="d24" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d25" name="d25" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d26" name="d26" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>3</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Wt. of Compacted Soil gm</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d31" name="d31" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d32" name="d32" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d33" name="d33" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d34" name="d34" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d35" name="d35" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d36" name="d36" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>4</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Water added %</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d41" name="d41" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d42" name="d42" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d43" name="d43" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d44" name="d44" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d45" name="d45" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d46" name="d46" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>5</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Wet Density (m) gm/cc 3/(Vm)</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d51" name="d51" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d52" name="d52" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d53" name="d53" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d54" name="d54" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d55" name="d55" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d56" name="d56" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>6</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Moisture Content (m) %</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d61" name="d61" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d62" name="d62" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d63" name="d63" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d64" name="d64" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d65" name="d65" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d66" name="d66" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>7</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Dry Density (d) gm/cc ((wet X 100)/mc + 100)</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d71" name="d71" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d72" name="d72" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d73" name="d73" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d74" name="d74" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d75" name="d75" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d76" name="d76" >
												</div>
											</div>
										</div>
								</div>
								<br>
								
								<div class="row">
									<div class="col-lg-12">
												<div class="form-group">
													<div class="col-sm-12"><b>Moisture Content</b></div>
												</div>
									</div>
								</div>
								
								<!------Wt. of Mould + Compacted Soil (w) gm------->
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>1</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Container No.</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m11" name="m11" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m12" name="m12" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m13" name="m13" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m14" name="m14" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m15" name="m15" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m16" name="m16" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>2</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Wt. of Container + Wt. of Soil (gm)</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m21" name="m21" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m22" name="m22" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m23" name="m23" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m24" name="m24" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m25" name="m25" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m26" name="m26" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>3</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Wt. of Compacted Container + Wt. of Dry Soil (gm)</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m31" name="m31" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m32" name="m32" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m33" name="m33" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m34" name="m34" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m35" name="m35" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m36" name="m36" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>4</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Wt . Of Water (gm) = (2)-(3)</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m41" name="m41" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m42" name="m42" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m43" name="m43" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m44" name="m44" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m45" name="m45" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m46" name="m46" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>5</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Wt. of Container (gm)</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m51" name="m51" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m52" name="m52" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m53" name="m53" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m54" name="m54" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m55" name="m55" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m56" name="m56" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>6</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Wt. of Oven Dry Soil = (3)-(5)</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m61" name="m61" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m62" name="m62" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m63" name="m63" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m64" name="m64" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m65" name="m65" >
												</div>
											</div>
										</div>
						
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m66" name="m66" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12"><b>7</b></div>
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												<div class="col-sm-12"><b>Moisture Content (m%(4)/(6) X 100)</b></div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m71" name="m71" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m72" name="m72" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m73" name="m73" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m74" name="m74" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m75" name="m75" >
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="m76" name="m76" >
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
					  </div>
				</div>		
				
				
				<div class="panel panel-default">
					  <div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
							<h4 class="panel-title">
							<b>10% FINES VALUE</b>
							</h4>
						</a>
					</h4>
					  </div>
					  <div id="collapse9" class="panel-collapse collapse">
						<div class="panel-body">
									<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">10% Fines Value</label>
												<div class="col-sm-8">
													<input type="checkbox" name="chk_fines"  id="chk_fines" value="chk_fines"><br>
												</div>
										</div>
									</div>
									
								</div>
									<div class="row">
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">10% Fines Value</label>

									  <div class="col-sm-6">
										<input type="text" class="form-control" id="fines_value" name="fines_value" >
									  </div>
									</div>
									</div>
								</div>
								<br>
								
								<!--ABRASION VALUE OVER-->

						
						</div>
					  </div>
				</div>		

				
				
					<div class="panel panel-default">
					  <div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
							<h4 class="panel-title">
							<b>ALKALI REACTION</b>
							</h4>
						</a>
						</h4>
					  </div>
					  <div id="collapse10" class="panel-collapse collapse">
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

				
					<div class="panel panel-default">
					  <div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse11">
							<h4 class="panel-title">
							<b>STRIPPING VALUE</b>
							</h4>
						</a>
						</h4>
					  </div>
					  <div id="collapse11" class="panel-collapse collapse">
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
									<div class="row">
									<div class="col-lg-4">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Stripping Value</label>

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

				
				
					</div>	
<hr>
							<div id="display_data">	
							<div class="row">
										<div class="col-lg-12">
											<table border="1px solid black" align="center" width="100%" id="aaaa">
												<tr>
													<th style="text-align:center;" width="10%"><label>Actions</label></th>
													<th style="text-align:center;"><label>Sr. no.</label></th>	
													<th style="text-align:center;"><label>Job no.</label></th>	
													<th style="text-align:center;"><label>Days</label></th>	
													<th style="text-align:center;"><label>Date</label></th>	
													<th style="text-align:center;"><label>Letter No</label></th>	
													<th style="text-align:center;"><label>Ref Date</label></th>
													<th style="text-align:center;"><label>ID Brand</label></th>		
													<th style="text-align:center;"><label>Detail Of Sample</label></th>
													<th style="text-align:center;"><label>ID Mark</label></th>		
													<th style="text-align:center;"><label>Starting Date of Testing</label></th>	
													<th style="text-align:center;"><label>Completion Date of Testing</label></th>	
																							

												</tr>
													<?php
												 $query = "select * from metal_45_63_mm WHERE bill_id='$aa'";
						
													$result = mysqli_query($conn, $query);
								
			
													if (mysqli_num_rows($result) > 0) {
												while($r = mysqli_fetch_array($result)){
										
															if($r['is_deleted'] == 0){
															?>
															<tr>
															<td style="text-align:center;" width="10%">	
															
															<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
															</td>
															<td style="text-align:center;"><?php echo $r['bill_id'];?></td>
															<td style="text-align:center;"><?php echo $r['job_no'];?></td>
															<td style="text-align:center;"><?php echo $r['days'];?></td>
															<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['date']));?></td>
															<td style="text-align:center;"><?php echo $r['ref_name'];?></td>
															<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['ref_date']));?></td>
															<td style="text-align:center;"><?php echo $r['id_brand'];?></td>
															<td style="text-align:center;"><?php echo $r['detail_sample'];?></td>
															<td style="text-align:center;"><?php echo $r['id_mark'];?></td>
															<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['start_date']));?></td>
															<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['end_date']));?></td>
															<td style="text-align:center;"><?php echo $r['con_sample'];?></td>
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
					</form>
						<!---------->
				<div>
			</div>
		
	</div>
</section>
</div>
	





	
	
		
<?php include("footer.php");?>
<script>
	
	 


 //Date picker
   $('#txt_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	$('#rec_sample_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	$('#ref_date').datepicker({ 
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
		//alert("dss");
		var ref = $('#ref_date').val();
		//alert(ref);
		document.getElementById('start_date').value = ref;
		/*job number*/
		if ( $('#month_name').val() != '' ) {
			$('#month_name').val('');
			if ( $('#month_name').val() == '' ) {
				//var jobnos = <?php echo $final_j_no;?>;
				//alert(jobnos);
				var months = ["Jan-", "Feb-", "Mar-", "Apr-", "May-", "Jun-",
           "Jul-", "Aug-", "Sep-", "Oct-", "Nov-", "Dec-"];
		   var monthsa = "AGG/";//months[(ref.split('/')[1]-1)];
		  
		   document.getElementById('month_name').value = monthsa;
		
				
			}
		}
  });


  $(function () {
    $('.select2').select2();
  })
$(document).ready(function(){ 
	var ref = $('#ref_date').val();
	var months = ["Jan-", "Feb-", "Mar-", "Apr-", "May-", "Jun-",
           "Jul-", "Aug-", "Sep-", "Oct-", "Nov-", "Dec-"];
		   var monthsa = "AGG/";//months[(ref.split('/')[1]-1)];
		   //alert(monthsa);
			//var job_no_final = $('#txt_jobno').val();
			//alert(job_no_final);
			//var final_jobs = monthsa+job_no_final;
			//alert(final_jobs);
		   document.getElementById('month_name').value = monthsa;
   
	$("#start_date").datepicker({
        todayBtn:  1,
        autoclose: true,
		format: 'dd/mm/yyyy'
    });
	$('#btn_edit_data').hide();
	$('#alert').hide();
    $("#end_date").datepicker({  
    autoclose: true,
	format: 'dd/mm/yyyy'});
        $('#txt_day').change(function(e){
		
	var days = $('#txt_day').val();
	//alert(days);
	days = parseInt(days);
		
	var date_input = document.getElementById("start_date").value.split('/');
	//alert(date_input);
	var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);
	//alert(date);
	var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + days);
	var dd = newdate.getDate();
	var mm = newdate.getMonth() + 1;
	var y = newdate.getFullYear();
	if(mm <= 9)
    mm = '0'+mm;
	if(dd <= 9)
    dd = '0'+dd;
	var someFormattedDate = dd + '/' + mm + '/' + y;
	//alert(someFormattedDate);exit;
  document.getElementById('end_date').value = someFormattedDate;
  document.getElementById('txt_date').value = someFormattedDate;
	});
	
			var abr_wt_t_a_1;
			var abr_index;
            var abr_wt_t_c_1;
			var abr_wt_t_b_1;
			var abr_sample_abr;
	
	//ABRASION INDEX
	$('#chk_abr').change(function(){
        if(this.checked)
		{
            $('#abr_sample_abr').val('METAL 25-90 HB MM');
			abr_wt_t_a_1 = randomNumberFromRange(5000.00, 5010.00);
			abr_index = randomNumberFromRange(10.00, 20.00);
            abr_wt_t_c_1 = ((parseFloat(abr_wt_t_a_1)*parseFloat(abr_index))/100);
			abr_wt_t_b_1 = (parseFloat(abr_wt_t_a_1)-parseFloat(abr_wt_t_c_1));
			$('#abr_wt_t_a_1').val(abr_wt_t_a_1.toFixed(2));
			$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed(2));
			$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
            $('#abr_index').val(abr_index.toFixed(2));
			
		}
        else
		{
            $('#abr_sample_abr').val(null);
			$('#abr_wt_t_a_1').val(null);
			$('#abr_wt_t_b_1').val(null);
			$('#abr_wt_t_c_1').val(null);
			$('#abr_index').val(null);
		}

    });
	
	
	$("#abr_wt_t_a_1").change(function(){
			
            $('#abr_sample_abr').val('METAL 25-90 HB MM');
			abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
			abr_index = $('#abr_index').val();
            abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
			 abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
			
			abr_wt_t_c_1 = (parseFloat(abr_wt_t_a_1)-parseFloat(abr_wt_t_b_1));
			abr_index = ((parseFloat(abr_wt_t_c_1)/parseFloat(abr_wt_t_a_1))*100);
			var a_c = abr_wt_t_c_1.toFixed(2);
			var b_b = abr_index.toFixed(2);
			//$('#abr_wt_t_a_1').val(abr_wt_t_a_11.toFixed(2));
			$('#abr_wt_t_b_1').val(abr_wt_t_b_1);
			$('#abr_wt_t_c_1').val(a_c);
            $('#abr_index').val(b_b);
					
    });
	
	
	$("#abr_wt_t_b_1").change(function(){
			
			abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
			abr_index = $('#abr_index').val();
            abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
			abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
			
			abr_wt_t_c_1 = (parseFloat(abr_wt_t_a_1)-parseFloat(abr_wt_t_b_1));
			abr_index = ((parseFloat(abr_wt_t_c_1)/parseFloat(abr_wt_t_a_1))*100);
			var a_c = abr_wt_t_c_1.toFixed(2);
			var b_b = abr_index.toFixed(2);			
            $('#abr_sample_abr').val('METAL 25-90 HB MM');
			$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
			//$('#abr_wt_t_b_1').val(abr_wt_t_b_1);
			$('#abr_wt_t_c_1').val(a_c);
            $('#abr_index').val(b_b);
					
    });
	
	$("#abr_index").change(function(){
			
			abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
			abr_index = $('#abr_index').val();
            //abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
			//abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
			
			abr_wt_t_c_1 = (parseFloat(abr_wt_t_a_1)*parseFloat(abr_index)/100);
			abr_wt_t_b_1 = parseFloat(abr_wt_t_a_1)-parseFloat(abr_wt_t_c_1);
			
			var a_c = abr_wt_t_c_1.toFixed(2);
			var b_b = abr_wt_t_b_1.toFixed(2);			
            $('#abr_sample_abr').val('METAL 25-90 HB MM');
			//$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
			$('#abr_wt_t_b_1').val(b_b);
			$('#abr_wt_t_c_1').val(a_c);
           // $('#abr_index').val(b_b);
					
    });
	
	
	
	//IMPACT VALUE
	$('#chk_impact').change(function(){
        if(this.checked)
		{         
			var imp_value = randomNumberFromRange(10.00,20.00);
			var imp_value_1 = parseFloat(imp_value) + randomNumberFromRange(-0.50,0.50);
			var tems = (parseFloat(imp_value) * 2);
			var imp_value_2 = (parseFloat(tems)-parseFloat(imp_value_1));
			$('#imp_value').val(imp_value.toFixed(2));
			$('#imp_value_1').val(imp_value_1.toFixed(2));
			$('#imp_value_2').val(imp_value_2.toFixed(2));
			
			var imp_w_m_a_1 = randomNumberFromRange(320,340);
			var imp_w_m_a_2 = randomNumberFromRange(320,340);
			
			var imp_w_m_b_1 = ((parseFloat(imp_value_1)*parseFloat(imp_w_m_a_1))/100);
			var imp_w_m_b_2 = ((parseFloat(imp_value_2)*parseFloat(imp_w_m_a_2))/100);
			
			var imp_w_m_c_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_b_1));
			var imp_w_m_c_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_b_2));
			
			$('#imp_w_m_a_1').val(imp_w_m_a_1.toFixed(2));
			$('#imp_w_m_b_1').val(imp_w_m_b_1.toFixed(2));
			$('#imp_w_m_c_1').val(imp_w_m_c_1.toFixed(2));
			$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(2));
			$('#imp_w_m_b_2').val(imp_w_m_b_2.toFixed(2));
			$('#imp_w_m_c_2').val(imp_w_m_c_2.toFixed(2));			
			
		}
        else
		{
			
            $('#imp_value').val(null);
			$('#imp_value_1').val(null);
			$('#imp_value_2').val(null);
			$('#imp_w_m_a_1').val(null);
			$('#imp_w_m_b_1').val(null);
			$('#imp_w_m_c_1').val(null);
			$('#imp_w_m_a_2').val(null);
			$('#imp_w_m_b_2').val(null);
			$('#imp_w_m_c_2').val(null);
		}

    });
	
	$("#imp_value").change(function(){
			
			
			
			var imp_w_m_a_1 = randomNumberFromRange(320,340);
			var imp_w_m_a_2 = randomNumberFromRange(320,340);
			
			var imp_value = $('#imp_value').val();
			var imp_value_1 = parseFloat(imp_value) + randomNumberFromRange(-0.50,0.50);
			var tems = (parseFloat(imp_value) * 2);
			var imp_value_2 = (parseFloat(tems)-parseFloat(imp_value_1));
			//$('#imp_value').val(imp_value.toFixed(2));
			$('#imp_value_1').val(imp_value_1.toFixed(2));
			$('#imp_value_2').val(imp_value_2.toFixed(2));
			
			
			var imp_w_m_b_1 = ((parseFloat(imp_value_1)*parseFloat(imp_w_m_a_1))/100);
			var imp_w_m_b_2 = ((parseFloat(imp_value_2)*parseFloat(imp_w_m_a_2))/100);
			
			var imp_w_m_c_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_b_1));
			var imp_w_m_c_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_b_2));
			
			$('#imp_w_m_a_1').val(imp_w_m_a_1.toFixed(2));
			$('#imp_w_m_b_1').val(imp_w_m_b_1.toFixed(2));
			$('#imp_w_m_c_1').val(imp_w_m_c_1.toFixed(2));
			$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(2));
			$('#imp_w_m_b_2').val(imp_w_m_b_2.toFixed(2));
			$('#imp_w_m_c_2').val(imp_w_m_c_2.toFixed(2));			
			
					
    });
	
	
	$("#imp_w_m_a_1").change(function(){
			
			
			
			var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
			//var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
			var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
			//var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
			
			var imp_w_m_c_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_b_1));
			//var imp_w_m_c_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_b_2));
			
			
			//$('#imp_w_m_b_1').val(imp_w_m_b_1.toFixed(2));
			$('#imp_w_m_c_1').val(imp_w_m_c_1.toFixed(2));
			//$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(2));
			//$('#imp_w_m_b_2').val(imp_w_m_b_2.toFixed(2));
			//$('#imp_w_m_c_2').val(imp_w_m_c_2.toFixed(2));		
			
			var imp_value_1 = (parseFloat(imp_w_m_b_1) /parseFloat(imp_w_m_a_1)*100);
			var imp_value_2 = $('#imp_value_2').val();
			
			var imp_value = (parseFloat(imp_value_1)+parseFloat(imp_value_2))/2;
			$('#imp_value').val(imp_value.toFixed(2));
			$('#imp_value_1').val(imp_value_1.toFixed(2));
			//$('#imp_value_2').val(imp_value_2.toFixed(2));
			
			
					
    });
	
	$("#imp_w_m_b_1").change(function(){
			
			
			
			var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
			//var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
			var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
			//var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
			
			var imp_w_m_c_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_b_1));
			//var imp_w_m_c_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_b_2));
			
			
			//$('#imp_w_m_b_1').val(imp_w_m_b_1.toFixed(2));
			$('#imp_w_m_c_1').val(imp_w_m_c_1.toFixed(2));
			//$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(2));
			//$('#imp_w_m_b_2').val(imp_w_m_b_2.toFixed(2));
			//$('#imp_w_m_c_2').val(imp_w_m_c_2.toFixed(2));		
			
			var imp_value_1 = (parseFloat(imp_w_m_b_1) /parseFloat(imp_w_m_a_1)*100);
			var imp_value_2 = $('#imp_value_2').val();
			
			var imp_value = (parseFloat(imp_value_1)+parseFloat(imp_value_2))/2;
			$('#imp_value').val(imp_value.toFixed(2));
			$('#imp_value_1').val(imp_value_1.toFixed(2));
			//$('#imp_value_2').val(imp_value_2.toFixed(2));
			
			
					
    });
	
	$("#imp_w_m_a_2").change(function(){
			
			
			
			//var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
			var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
			//var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
			var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
			
			//var imp_w_m_c_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_b_1));
			var imp_w_m_c_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_b_2));
			
			
			//$('#imp_w_m_b_1').val(imp_w_m_b_1.toFixed(2));
			//$('#imp_w_m_c_1').val(imp_w_m_c_1.toFixed(2));
			//$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(2));
			//$('#imp_w_m_b_2').val(imp_w_m_b_2.toFixed(2));
			$('#imp_w_m_c_2').val(imp_w_m_c_2.toFixed(2));		
			
			var imp_value_1 = $('#imp_value_1').val();
			var imp_value_2 = (parseFloat(imp_w_m_b_2) /parseFloat(imp_w_m_a_2)*100);
			
			var imp_value = (parseFloat(imp_value_1)+parseFloat(imp_value_2))/2;
			$('#imp_value').val(imp_value.toFixed(2));
			//$('#imp_value_1').val(imp_value_1.toFixed(2));
			$('#imp_value_2').val(imp_value_2.toFixed(2));
				
			
					
    });
	
	$("#imp_w_m_b_2").change(function(){
			
			
			
			//var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
			var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
			//var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
			var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
			
			//var imp_w_m_c_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_b_1));
			var imp_w_m_c_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_b_2));
			
			
			//$('#imp_w_m_b_1').val(imp_w_m_b_1.toFixed(2));
			//$('#imp_w_m_c_1').val(imp_w_m_c_1.toFixed(2));
			//$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(2));
			//$('#imp_w_m_b_2').val(imp_w_m_b_2.toFixed(2));
			$('#imp_w_m_c_2').val(imp_w_m_c_2.toFixed(2));		
			
			var imp_value_1 = $('#imp_value_1').val();
			var imp_value_2 = (parseFloat(imp_w_m_b_2) /parseFloat(imp_w_m_a_2)*100);
			
			var imp_value = (parseFloat(imp_value_1)+parseFloat(imp_value_2))/2;
			$('#imp_value').val(imp_value.toFixed(2));
			//$('#imp_value_1').val(imp_value_1.toFixed(2));
			$('#imp_value_2').val(imp_value_2.toFixed(2));
				
			
					
    });
	

	
	var sp_sample_ca;
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
	
	$('#chk_sp').change(function(){
        if(this.checked)
		{  
			sp_sample_ca = "25 - 90 HB MM";
			var sp_w_b_a1_1 = randomNumberFromRange(2085.00, 2115.00);	
			var sp_w_b_a2_1 = randomNumberFromRange(799.00,800.00);	
			var sp_w_sur_1 = randomNumberFromRange(2010.00,2011.00);
			var sp_w_s_1 = randomNumberFromRange(1994.00,1999.00);	
			
			sp_wt_st_1 = parseFloat(sp_w_b_a1_1) - parseFloat(sp_w_b_a2_1);
			sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
			sp_water_abr_1 = (100*(parseFloat(sp_w_sur_1)-parseFloat(sp_w_s_1)))/parseFloat(sp_w_s_1);
			
			/*alert(sp_w_b_a1_1);
			alert(sp_w_b_a2_1);
			alert(sp_w_sur_1);
			alert(sp_w_s_1);
			alert(sp_wt_st_1);
			alert(sp_specific_gravity_1);
			alert(sp_water_abr_1);*/
			
			
			 sp_w_b_a1_2 = randomNumberFromRange(2085.00, 2115.00);	
			 sp_w_b_a2_2 = randomNumberFromRange(799.00,800.00);	
			 sp_w_sur_2 = randomNumberFromRange(2010.00,2011.00);
			 sp_w_s_2 = randomNumberFromRange(1994.00,1999.00);	
			
			 sp_wt_st_2 = parseFloat(sp_w_b_a1_2) - parseFloat(sp_w_b_a2_2);
			 sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
			 sp_water_abr_2 = (100*(parseFloat(sp_w_sur_2)-parseFloat(sp_w_s_2)))/parseFloat(sp_w_s_2);
			
			/*alert(sp_w_b_a1_2);
			alert(sp_w_b_a2_2);
			alert(sp_w_sur_2);
			alert(sp_w_s_2);
			alert(sp_wt_st_2);
			alert(sp_specific_gravity_2);
			alert(sp_water_abr_2);*/
			
			var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
			var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;					
			
			$('#sp_w_b_a1_1').val(sp_w_b_a1_1.toFixed(0));
			$('#sp_w_b_a2_1').val(sp_w_b_a2_1.toFixed(2));
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(2));
			$('#sp_w_s_1').val(sp_w_s_1.toFixed(2));
			$('#sp_wt_st_1').val(sp_wt_st_1.toFixed(0));
			
			$('#sp_w_b_a1_2').val(sp_w_b_a1_2.toFixed(0));
			$('#sp_w_b_a2_2').val(sp_w_b_a2_2.toFixed(2));
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(2));
			$('#sp_w_s_2').val(sp_w_s_2.toFixed(2));
			$('#sp_wt_st_2').val(sp_wt_st_2.toFixed(0));
								
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
			$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
			$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
			$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
			$('#sp_water_abr').val(sp_water_abr.toFixed(2));
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
        
			//SPECIFIC GRAVITY VALUE
			
			sp_sample_ca = "25 - 90 HB MM";
			
			
			 var sp_specific_gravity = $('#sp_specific_gravity').val();
			 sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.05,0.05); //G1
			 var tems1 = (parseFloat(sp_specific_gravity) * 2);
			 sp_specific_gravity_2 = (parseFloat(tems1)-parseFloat(sp_specific_gravity_1));
			 $('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
			 $('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
	
			//1
     		 var sp_w_sur_1 = randomNumberFromRange(2010.00,2011.00); //B1
		     var sp_w_s_1 = randomNumberFromRange(1994.00,1999.00);	//C1
			
			
			 sp_wt_st_1 = parseFloat(sp_w_sur_1)-(parseFloat(sp_w_s_1)/parseFloat(sp_specific_gravity_1)); // A
			sp_water_abr_1 = (100*(parseFloat(sp_w_sur_1)-parseFloat(sp_w_s_1)))/parseFloat(sp_w_s_1); //WATER ABR
			
			var sp_w_b_a2_1 = randomNumberFromRange(799.00,800.00);	//A2
			var sp_w_b_a1_1 = parseFloat(sp_wt_st_1)+parseFloat(sp_w_b_a2_1);
			
			
			
			//2
			 sp_w_sur_2 = randomNumberFromRange(2010.00,2011.00);
			 sp_w_s_2 = randomNumberFromRange(1994.00,1999.00);	
			 
			  sp_wt_st_2 = parseFloat(sp_w_sur_2)-(parseFloat(sp_w_s_2)/parseFloat(sp_specific_gravity_2)); // A
			 sp_water_abr_2 = (100*(parseFloat(sp_w_sur_2)-parseFloat(sp_w_s_2)))/parseFloat(sp_w_s_2); //WATER ABR
			 
			 sp_w_b_a2_2 = randomNumberFromRange(799.00,800.00);
			 sp_w_b_a1_2 = parseFloat(sp_wt_st_2)+parseFloat(sp_w_b_a2_2);
			
			
			var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;											
			
			$('#sp_w_b_a1_1').val(sp_w_b_a1_1.toFixed(0));
			$('#sp_w_b_a2_1').val(sp_w_b_a2_1.toFixed(2));
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(2));
			$('#sp_w_s_1').val(sp_w_s_1.toFixed(2));
			$('#sp_wt_st_1').val(sp_wt_st_1.toFixed(0));
			
			$('#sp_w_b_a1_2').val(sp_w_b_a1_2.toFixed(0));
			$('#sp_w_b_a2_2').val(sp_w_b_a2_2.toFixed(2));
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(2));
			$('#sp_w_s_2').val(sp_w_s_2.toFixed(2));
			$('#sp_wt_st_2').val(sp_wt_st_2.toFixed(0));
								
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
			//$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
			$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
			$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
			$('#sp_water_abr').val(sp_water_abr.toFixed(2));
			$('#sp_sample_ca').val(sp_sample_ca);
				
			 
		
	});
	

	$('#sp_water_abr').change(function(){
		//SPECIFIC GRAVITY VALUE
			
			 sp_sample_ca = "25 - 90 HB MM";
			
			
			 var sp_water_abr = $('#sp_water_abr').val();
			 sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.05,0.05); //G1
			 var tems1 = (parseFloat(sp_water_abr) * 2);
			 sp_water_abr_2 = (parseFloat(tems1)-parseFloat(sp_water_abr_1));
			 $('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
			 $('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
	
			//1
     		  sp_w_sur_1 = randomNumberFromRange(2010.00,2011.00); //B1
		      var sp_w_s_1 = randomNumberFromRange(1994.00,1999.00);	//C1
			
			
			 sp_wt_st_1 = parseFloat(sp_w_sur_1)-(parseFloat(sp_w_s_1)/parseFloat(sp_specific_gravity_1)); // A
			 sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
			
			
			var sp_w_b_a2_1 = randomNumberFromRange(799.00,800.00);	//A2
			var sp_w_b_a1_1 = parseFloat(sp_wt_st_1)+parseFloat(sp_w_b_a2_1);
			
			
			
			//2
			 sp_w_sur_2 = randomNumberFromRange(2010.00,2011.00);
			 sp_w_s_2 = randomNumberFromRange(1994.00,1999.00);	
			 
			  sp_wt_st_2 = parseFloat(sp_w_sur_2)-(parseFloat(sp_w_s_2)/parseFloat(sp_specific_gravity_2)); // A
			 sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
			
			 
			 sp_w_b_a2_2 = randomNumberFromRange(799.00,800.00);
			 sp_w_b_a1_2 = parseFloat(sp_wt_st_2)+parseFloat(sp_w_b_a2_2);
			
			
			var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;											
			
			$('#sp_w_b_a1_1').val(sp_w_b_a1_1.toFixed(0));
			$('#sp_w_b_a2_1').val(sp_w_b_a2_1.toFixed(2));
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(2));
			$('#sp_w_s_1').val(sp_w_s_1.toFixed(2));
			$('#sp_wt_st_1').val(sp_wt_st_1.toFixed(0));
			
			$('#sp_w_b_a1_2').val(sp_w_b_a1_2.toFixed(0));
			$('#sp_w_b_a2_2').val(sp_w_b_a2_2.toFixed(2));
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(2));
			$('#sp_w_s_2').val(sp_w_s_2.toFixed(2));
			$('#sp_wt_st_2').val(sp_wt_st_2.toFixed(0));
								
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
			$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
			$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
			$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
			//$('#sp_water_abr').val(sp_water_abr.toFixed(2));
			$('#sp_sample_ca').val(sp_sample_ca);
	});
	
	
	$("#sp_w_b_a1_1").change(function(){
									
			sp_w_b_a1_1 = $('#sp_w_b_a1_1').val();
			var sp_w_b_a2_1 = randomNumberFromRange(799.00,800.00);
			sp_wt_st_1 = parseFloat(sp_w_b_a1_1)-parseFloat(sp_w_b_a2_1);
			var sp_w_sur_1 = $('#sp_w_sur_1').val();
			var sp_w_s_1 = $('#sp_w_s_1').val();
			sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
			
			$('#sp_wt_st_1').val(sp_wt_st_1.toFixed(0));			
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
			
			sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
			var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
			$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
					
    });
	
	$("#sp_w_b_a1_2").change(function(){
									
			sp_w_b_a1_2 = $('#sp_w_b_a1_2').val();
			var sp_w_b_a2_2 = randomNumberFromRange(799.00,800.00);
			sp_wt_st_2 = parseFloat(sp_w_b_a1_2)-parseFloat(sp_w_b_a2_2);
			var sp_w_sur_2 = $('#sp_w_sur_2').val();
			var sp_w_s_2 = $('#sp_w_s_2').val();
			sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
			
			$('#sp_wt_st_2').val(sp_wt_st_2.toFixed(0));			
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
			
			sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
			var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
			$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
					
    });
	
	$("#sp_w_b_a2_1").change(function(){
		sp_w_b_a1_1 = $('#sp_w_b_a1_1').val();
		var sp_w_b_a2_1 = $('#sp_w_b_a2_1').val();
		sp_wt_st_1 = parseFloat(sp_w_b_a1_1)-parseFloat(sp_w_b_a2_1);
		var sp_w_sur_1 = $('#sp_w_sur_1').val();
		var sp_w_s_1 = $('#sp_w_s_1').val();
		sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
		
		$('#sp_wt_st_1').val(sp_wt_st_1.toFixed(0));
		$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
		sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
		
	});
	
	$("#sp_w_b_a2_2").change(function(){
		sp_w_b_a1_2 = $('#sp_w_b_a1_2').val();
		var sp_w_b_a2_2 = $('#sp_w_b_a2_2').val();
		sp_wt_st_2 = parseFloat(sp_w_b_a1_2)-parseFloat(sp_w_b_a2_2);
		var sp_w_sur_2 = $('#sp_w_sur_2').val();
		var sp_w_s_2 = $('#sp_w_s_2').val();
		sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
		
		$('#sp_wt_st_2').val(sp_wt_st_2.toFixed(0));
		$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
		sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
		
	});
	
	$("#sp_w_sur_1").change(function(){

		var sp_w_sur_1 = $('#sp_w_sur_1').val();
		sp_wt_st_1 = $('#sp_wt_st_1').val();
		var sp_w_s_1 = $('#sp_w_s_1').val();
		sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
		$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
		sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
		
		sp_water_abr_1 = (100*(parseFloat(sp_w_sur_1)-parseFloat(sp_w_s_1)))/parseFloat(sp_w_s_1);
		$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
		sp_water_abr_2 = $('#sp_water_abr_2').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toFixed(2));
	});
	
	$("#sp_w_sur_2").change(function(){

		var sp_w_sur_2 = $('#sp_w_sur_2').val();
		sp_wt_st_2 = $('#sp_wt_st_2').val();
		var sp_w_s_2 = $('#sp_w_s_2').val();
		sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
		$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
		sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
		
		sp_water_abr_2 = (100*(parseFloat(sp_w_sur_2)-parseFloat(sp_w_s_2)))/parseFloat(sp_w_s_2);
		$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
		sp_water_abr_1 = $('#sp_water_abr_1').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toFixed(2));
	});
	$("#sp_w_s_1").change(function(){

		var sp_w_sur_1 = $('#sp_w_sur_1').val();
		sp_wt_st_1 = $('#sp_wt_st_1').val();
		var sp_w_s_1 = $('#sp_w_s_1').val();
		sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
		$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
		sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
		
		sp_water_abr_1 = (100*(parseFloat(sp_w_sur_1)-parseFloat(sp_w_s_1)))/parseFloat(sp_w_s_1);
		$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
		sp_water_abr_2 = $('#sp_water_abr_2').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toFixed(2));
	});
	$("#sp_w_s_2").change(function(){

		var sp_w_sur_2 = $('#sp_w_sur_2').val();
		sp_wt_st_2 = $('#sp_wt_st_2').val();
		var sp_w_s_2 = $('#sp_w_s_2').val();
		sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
		$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
		sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
		
		sp_water_abr_2 = (100*(parseFloat(sp_w_sur_2)-parseFloat(sp_w_s_2)))/parseFloat(sp_w_s_2);
		$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
		sp_water_abr_1 = $('#sp_water_abr_1').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toFixed(2));
	});
	
	
	//Flakiness INDEX
	var a1;
	var a2;
	var a3;
	var a4;
	var a5;
	var suma;
	var b1;
	var b2;
	var b3;
	var b4;
	var b5;
	var sumb;
	var c1;
	var c2;
	var c3;
	var c4;
	var c5;
	var d1;
	var d2;
	var d4;
	var d5;
	var d3;
	var e1;
	var e2;
	var e3;
	var e4;
	var e5;
	
	$('#chk_flk').change(function(){
        if(this.checked)
		{ 
			
			$('#fi_index').val(0);
			$('#a1').val(0);
			$('#a2').val(0);
			$('#a3').val(0);
			$('#a4').val(0);
			$('#a5').val(0);
			$('#suma').val(0);
			
			$('#b1').val(0);
			$('#b2').val(0);
			$('#b3').val(0);
			$('#b4').val(0);
			$('#b5').val(0);
			$('#sumb').val(0);
			
			$('#c1').val(0);
			$('#c2').val(0);
			$('#c3').val(0);
			$('#c4').val(0);
			$('#c5').val(0);
			
			$('#d1').val(0);
			$('#d2').val(0);
			$('#d3').val(0);
			$('#d4').val(0);
			$('#d5').val(0);
			
			$('#e1').val(0);
			$('#e2').val(0);
			$('#e3').val(0);
			$('#e4').val(0);
			$('#e5').val(0);
			
		}
		else
		{
			$('#fi_index').val(null);
			 $("#chk_f1").prop("checked", false); 
			 $("#chk_f2").prop("checked", false); 
			 $("#chk_f3").prop("checked", false); 
			 $("#chk_f4").prop("checked", false); 
		     $("#chk_f5").prop("checked", false); 
			 
			$('#a1').val(null);
			$('#a2').val(null);
			$('#a3').val(null);
			$('#a4').val(null);
			$('#a5').val(null);
			$('#suma').val(null);
			
			$('#b1').val(null);
			$('#b2').val(null);
			$('#b3').val(null);
			$('#b4').val(null);
			$('#b5').val(null);
			$('#sumb').val(null);
			
			$('#c1').val(null);
			$('#c2').val(null);
			$('#c3').val(null);
			$('#c4').val(null);
			$('#c5').val(null);
			
			$('#d1').val(null);
			$('#d2').val(null);
			$('#d3').val(null);
			$('#d4').val(null);
			$('#d5').val(null);
			
			$('#e1').val(null);
			$('#e2').val(null);
			$('#e3').val(null);
			$('#e4').val(null);
			$('#e5').val(null);
		}
		
	});
	
	
	function chk_f1_fun()
	{
		
		//FLANKINESS INDEX	   			
			a1=randomNumberFromRange(3605, 3645);
			a2=$('#a2').val();
			a3=$('#a3').val();
			a4=$('#a4').val();
			a5=$('#a5').val();
			suma = parseInt(a1)+parseInt(a2)+parseInt(a3)+parseInt(a4)+parseInt(a5);
			
			b1=randomNumberFromRange(385, 425);			
			b2=$('#b2').val();
			b3=$('#b3').val();
			b4=$('#b4').val();
			b5=$('#b5').val();
			sumb = parseInt(b1)+parseInt(b2)+parseInt(b3)+parseInt(b4)+parseInt(b5);
			
			c1 = (parseInt(b1)/parseInt(a1))*100;
			c2 = 0;//(parseInt(b2)/parseInt(a2))*100;
			c3 = 0;//(parseInt(b3)/parseInt(a3))*100;
			c4 = 0;//(parseInt(b4)/parseInt(a4))*100;
			c5 = 0;//(parseInt(b5)/parseInt(a5))*100;
			
			d1 = (parseInt(a1)/parseInt(suma))*100;
			d2 = 0;//(parseInt(a2)/parseInt(suma))*100;
			d3 = 0;//(parseInt(a3)/parseInt(suma))*100;
			d4 = 0;//(parseInt(a4)/parseInt(suma))*100;
			d5 = 0;//(parseInt(a5)/parseInt(suma))*100;
			
			e1 = (parseFloat(c1)*parseFloat(d1))/100;
			e2 = 0;//(parseFloat(c2)*parseFloat(d2))/100;
			e3 = 0;//(parseFloat(c3)*parseFloat(d3))/100;
			e4 = 0;//(parseFloat(c4)*parseFloat(d4))/100;
			e5 = 0;//(parseFloat(c5)*parseFloat(d5))/100;
			
			fi_index = parseFloat(e1)+parseFloat(e2)+parseFloat(e3)+parseFloat(e4)+parseFloat(e5);
			$('#fi_index').val(fi_index.toFixed(2));
			
			$('#a1').val(a1.toFixed(2));
			$('#suma').val(suma.toFixed(2));
			
			$('#b1').val(b1.toFixed(2));
			$('#sumb').val(sumb.toFixed(2));
			
			$('#c1').val(c1.toFixed(2));
			$('#c2').val(c2.toFixed(2));
			$('#c3').val(c3.toFixed(2));
			$('#c4').val(c4.toFixed(2));
			$('#c5').val(c5.toFixed(2));
			
			$('#d1').val(d1.toFixed(2));
			$('#d2').val(d2.toFixed(2));
			$('#d3').val(d3.toFixed(2));
			$('#d4').val(d4.toFixed(2));
			$('#d5').val(d5.toFixed(2));
			
			$('#e1').val(e1.toFixed(2));
			$('#e2').val(e2.toFixed(2));
			$('#e3').val(e3.toFixed(2));
			$('#e4').val(e4.toFixed(2));
			$('#e5').val(e5.toFixed(2));
		
	}
	
	$('#chk_f1').change(function(){
        if(this.checked)
		{ 
			chk_f1_fun();
		}
		else{
			$('#a1').val(0);
			$('#b1').val(0);
			$('#c1').val(0);
			$('#d1').val(0);
			$('#e1').val(0);
			$('#fi_index').val(0);
			
			$('#suma').val(0);
			$('#sumb').val(0);
			
			$("#chk_f2").prop("checked", false); 
			$('#a2').val(0);
			$('#b2').val(0);
			$('#c2').val(0);
			$('#d2').val(0);
			$('#e2').val(0);
			
			$("#chk_f3").prop("checked", false); 
			$('#a3').val(0);
			$('#b3').val(0);
			$('#c3').val(0);
			$('#d3').val(0);
			$('#e3').val(0);
			
			$("#chk_f4").prop("checked", false); 
			$('#a4').val(0);
			$('#b4').val(0);
			$('#c4').val(0);
			$('#d4').val(0);
			$('#e4').val(0);
			
			$("#chk_f5").prop("checked", false); 
			$('#a5').val(0);
			$('#b5').val(0);
			$('#c5').val(0);
			$('#d5').val(0);
			$('#e5').val(0);
		}
	
	});
	
	
	function chk_f2_fun()
	{
		 $("#chk_f1").prop("checked", true); 
			//FLANKINESS INDEX	   			
			a1=randomNumberFromRange(3605, 3645);
			a2=randomNumberFromRange(3280, 3320);
			a3=$('#a3').val();
			a4=$('#a4').val();
			a5=$('#a5').val();
			suma = parseInt(a1)+parseInt(a2)+parseInt(a3)+parseInt(a4)+parseInt(a5);
			
			b1=randomNumberFromRange(385, 425);
			b2=randomNumberFromRange(185, 225);
			b3=$('#b3').val();
			b4=$('#b4').val();
			b5=$('#b5').val();
			sumb = parseInt(b1)+parseInt(b2)+parseInt(b3)+parseInt(b4)+parseInt(b5);
			
			c1 = (parseInt(b1)/parseInt(a1))*100;
			c2 = (parseInt(b2)/parseInt(a2))*100;
			c3 = 0;//(parseInt(b3)/parseInt(a3))*100;
			c4 = 0;//(parseInt(b4)/parseInt(a4))*100;
			c5 = 0;//(parseInt(b5)/parseInt(a5))*100;
			
			d1 = (parseInt(a1)/parseInt(suma))*100;
			d2 = (parseInt(a2)/parseInt(suma))*100;
			d3 = 0;//(parseInt(a3)/parseInt(suma))*100;
			d4 = 0;//(parseInt(a4)/parseInt(suma))*100;
			d5 = 0;//(parseInt(a5)/parseInt(suma))*100;
			
			e1 = (parseFloat(c1)*parseFloat(d1))/100;
			e2 = (parseFloat(c2)*parseFloat(d2))/100;
			e3 = 0;//(parseFloat(c3)*parseFloat(d3))/100;
			e4 = 0;//(parseFloat(c4)*parseFloat(d4))/100;
			e5 = 0;//(parseFloat(c5)*parseFloat(d5))/100;
			
			fi_index = parseFloat(e1)+parseFloat(e2)+parseFloat(e3)+parseFloat(e4)+parseFloat(e5);
			$('#fi_index').val(fi_index.toFixed(2));
		
			$('#a1').val(a1.toFixed(2));
			$('#a2').val(a2.toFixed(2));
			$('#suma').val(suma.toFixed(2));
			
			$('#b1').val(b1.toFixed(2));
			$('#b2').val(b2.toFixed(2));
			$('#sumb').val(sumb.toFixed(2));
			
			$('#c1').val(c1.toFixed(2));
			$('#c2').val(c2.toFixed(2));
			$('#c3').val(c3.toFixed(2));
			$('#c4').val(c4.toFixed(2));
			$('#c5').val(c5.toFixed(2));
			
			$('#d1').val(d1.toFixed(2));
			$('#d2').val(d2.toFixed(2));
			$('#d3').val(d3.toFixed(2));
			$('#d4').val(d4.toFixed(2));
			$('#d5').val(d5.toFixed(2));
			
			$('#e1').val(e1.toFixed(2));
			$('#e2').val(e2.toFixed(2));
			$('#e3').val(e3.toFixed(2));
			$('#e4').val(e4.toFixed(2));
			$('#e5').val(e5.toFixed(2));
		
	}
	
	$('#chk_f2').change(function(){
        if(this.checked)
		{ 
			chk_f2_fun();
		}
		else{
			$('#a2').val(0);
			$('#b2').val(0);
			$('#c2').val(0);
			$('#d2').val(0);
			$('#e2').val(0);
			
			chk_f1_fun();
			
			$("#chk_f3").prop("checked", false); 
			$('#a3').val(0);
			$('#b3').val(0);
			$('#c3').val(0);
			$('#d3').val(0);
			$('#e3').val(0);
			
			$("#chk_f4").prop("checked", false); 
			$('#a4').val(0);
			$('#b4').val(0);
			$('#c4').val(0);
			$('#d4').val(0);
			$('#e4').val(0);
			
			$("#chk_f5").prop("checked", false); 
			$('#a5').val(0);
			$('#b5').val(0);
			$('#c5').val(0);
			$('#d5').val(0);
			$('#e5').val(0);
		}
	
	});
	
	
	function chk_f3_fun()
	{
		 $("#chk_f1").prop("checked", true); 
		 $("#chk_f2").prop("checked", true); 
			//FLANKINESS INDEX	   			
			a1=randomNumberFromRange(3605, 3645);
			a2=randomNumberFromRange(3280, 3320);
			a3=randomNumberFromRange(2080, 2120);
			a4=$('#a4').val();
			a5=$('#a5').val();
			suma = parseInt(a1)+parseInt(a2)+parseInt(a3)+parseInt(a4)+parseInt(a5);
			
			b1=randomNumberFromRange(385, 425);
			b2=randomNumberFromRange(185, 225);
			b3=randomNumberFromRange(150, 190);
			b4=$('#b4').val();
			b5=$('#b5').val();
			sumb = parseInt(b1)+parseInt(b2)+parseInt(b3)+parseInt(b4)+parseInt(b5);
			
			c1 = (parseInt(b1)/parseInt(a1))*100;
			c2 = (parseInt(b2)/parseInt(a2))*100;
			c3 = (parseInt(b3)/parseInt(a3))*100;
			c4 = 0;//(parseInt(b4)/parseInt(a4))*100;
			c5 = 0;//(parseInt(b5)/parseInt(a5))*100;
			
			d1 = (parseInt(a1)/parseInt(suma))*100;
			d2 = (parseInt(a2)/parseInt(suma))*100;
			d3 = (parseInt(a3)/parseInt(suma))*100;
			d4 = 0;//(parseInt(a4)/parseInt(suma))*100;
			d5 = 0;//(parseInt(a5)/parseInt(suma))*100;
			
			e1 = (parseFloat(c1)*parseFloat(d1))/100;
			e2 = (parseFloat(c2)*parseFloat(d2))/100;
			e3 = (parseFloat(c3)*parseFloat(d3))/100;
			e4 = 0;//(parseFloat(c4)*parseFloat(d4))/100;
			e5 = 0;//(parseFloat(c5)*parseFloat(d5))/100;
			
			fi_index = parseFloat(e1)+parseFloat(e2)+parseFloat(e3)+parseFloat(e4)+parseFloat(e5);
			$('#fi_index').val(fi_index.toFixed(2));
			
			//$('#a1').val(a1.toFixed(2));
			$('#a1').val(a1.toFixed(2));
			$('#a2').val(a2.toFixed(2));
			$('#a3').val(a3.toFixed(2));
			$('#suma').val(suma.toFixed(2));
			
			$('#b1').val(b1.toFixed(2));
			$('#b2').val(b2.toFixed(2));
			$('#b3').val(b3.toFixed(2));
			$('#sumb').val(sumb.toFixed(2));
			
			$('#c1').val(c1.toFixed(2));
			$('#c2').val(c2.toFixed(2));
			$('#c3').val(c3.toFixed(2));
			$('#c4').val(c4.toFixed(2));
			$('#c5').val(c5.toFixed(2));
			
			$('#d1').val(d1.toFixed(2));
			$('#d2').val(d2.toFixed(2));
			$('#d3').val(d3.toFixed(2));
			$('#d4').val(d4.toFixed(2));
			$('#d5').val(d5.toFixed(2));
			
			$('#e1').val(e1.toFixed(2));
			$('#e2').val(e2.toFixed(2));
			$('#e3').val(e3.toFixed(2));
			$('#e4').val(e4.toFixed(2));
			$('#e5').val(e5.toFixed(2));
		
	}
	
	$('#chk_f3').change(function(){
        if(this.checked)
		{ 
			chk_f3_fun();
		}
		else{
			$('#a3').val(0);
			$('#b3').val(0);
			$('#c3').val(0);
			$('#d3').val(0);
			$('#e3').val(0);
			
			chk_f2_fun();
			
			$("#chk_f4").prop("checked", false); 
			$('#a4').val(0);
			$('#b4').val(0);
			$('#c4').val(0);
			$('#d4').val(0);
			$('#e4').val(0);
			
			$("#chk_f5").prop("checked", false); 
			$('#a5').val(0);
			$('#b5').val(0);
			$('#c5').val(0);
			$('#d5').val(0);
			$('#e5').val(0);
			
		}
	
	});
	
	
	function chk_f4_fun()
	{
		
		$("#chk_f1").prop("checked", true); 
		 $("#chk_f2").prop("checked", true); 
		 $("#chk_f3").prop("checked", true); 
			//FLANKINESS INDEX	   			
			a1=randomNumberFromRange(3605, 3645);
			a2=randomNumberFromRange(3280, 3320);
			a3=randomNumberFromRange(2080, 2120);
			a4=randomNumberFromRange(1990, 2000);
			a5=$('#a5').val();
			suma = parseInt(a1)+parseInt(a2)+parseInt(a3)+parseInt(a4)+parseInt(a5);
			
			b1=randomNumberFromRange(385, 425);
			b2=randomNumberFromRange(185, 225);
			b3=randomNumberFromRange(150, 190);
			b4=randomNumberFromRange(140, 145);
			b5=$('#b5').val();
			sumb = parseInt(b1)+parseInt(b2)+parseInt(b3)+parseInt(b4)+parseInt(b5);
			
			c1 = (parseInt(b1)/parseInt(a1))*100;
			c2 = (parseInt(b2)/parseInt(a2))*100;
			c3 = (parseInt(b3)/parseInt(a3))*100;
			c4 = (parseInt(b4)/parseInt(a4))*100;
			c5 = 0;//(parseInt(b5)/parseInt(a5))*100;
			
			d1 = (parseInt(a1)/parseInt(suma))*100;
			d2 = (parseInt(a2)/parseInt(suma))*100;
			d3 = (parseInt(a3)/parseInt(suma))*100;
			d4 = (parseInt(a4)/parseInt(suma))*100;
			d5 = 0;//(parseInt(a5)/parseInt(suma))*100;
			
			e1 = (parseFloat(c1)*parseFloat(d1))/100;
			e2 = (parseFloat(c2)*parseFloat(d2))/100;
			e3 = (parseFloat(c3)*parseFloat(d3))/100;
			e4 = (parseFloat(c4)*parseFloat(d4))/100;
			e5 = 0;//(parseFloat(c5)*parseFloat(d5))/100;
			
			fi_index = parseFloat(e1)+parseFloat(e2)+parseFloat(e3)+parseFloat(e4)+parseFloat(e5);
			$('#fi_index').val(fi_index.toFixed(2));
			
			$('#a1').val(a1.toFixed(2));
			$('#a2').val(a2.toFixed(2));
			$('#a3').val(a3.toFixed(2));
			$('#a4').val(a4.toFixed(2));
			$('#suma').val(suma.toFixed(2));
			
			$('#b1').val(b1.toFixed(2));
			$('#b2').val(b2.toFixed(2));
			$('#b3').val(b3.toFixed(2));
			$('#b4').val(b4.toFixed(2));
			$('#sumb').val(sumb.toFixed(2));
			
			$('#c1').val(c1.toFixed(2));
			$('#c2').val(c2.toFixed(2));
			$('#c3').val(c3.toFixed(2));
			$('#c4').val(c4.toFixed(2));
			$('#c5').val(c5.toFixed(2));
			
			$('#d1').val(d1.toFixed(2));
			$('#d2').val(d2.toFixed(2));
			$('#d3').val(d3.toFixed(2));
			$('#d4').val(d4.toFixed(2));
			$('#d5').val(d5.toFixed(2));
			
			$('#e1').val(e1.toFixed(2));
			$('#e2').val(e2.toFixed(2));
			$('#e3').val(e3.toFixed(2));
			$('#e4').val(e4.toFixed(2));
			$('#e5').val(e5.toFixed(2));
	}
	
	
	$('#chk_f4').change(function(){
        if(this.checked)
		{ 
			chk_f4_fun();
		}
		else{
			$('#a4').val(0);
			$('#b4').val(0);
			$('#c4').val(0);
			$('#d4').val(0);
			$('#e4').val(0);
			chk_f3_fun();
			
			$("#chk_f5").prop("checked", false); 
			$('#a5').val(0);
			$('#b5').val(0);
			$('#c5').val(0);
			$('#d5').val(0);
			$('#e5').val(0);
		}
	
	});
	
	function chk_f5_fun()
	{
		
		$("#chk_f1").prop("checked", true); 
		 $("#chk_f2").prop("checked", true); 
		 $("#chk_f3").prop("checked", true); 
		 $("#chk_f4").prop("checked", true); 
			//FLANKINESS INDEX	   			
			a1=randomNumberFromRange(3605, 3645);
			a2=randomNumberFromRange(3280, 3320);
			a3=randomNumberFromRange(2080, 2120);
			a4=randomNumberFromRange(1990, 2000);
			a5=randomNumberFromRange(1800,1950);
			suma = parseInt(a1)+parseInt(a2)+parseInt(a3)+parseInt(a4)+parseInt(a5);
			
			b1=randomNumberFromRange(385, 425);
			b2=randomNumberFromRange(185, 225);
			b3=randomNumberFromRange(150, 190);
			b4=randomNumberFromRange(140, 145);
			b5=randomNumberFromRange(120, 125);
			sumb = parseInt(b1)+parseInt(b2)+parseInt(b3)+parseInt(b4)+parseInt(b5);
			
			c1 = (parseInt(b1)/parseInt(a1))*100;
			c2 = (parseInt(b2)/parseInt(a2))*100;
			c3 = (parseInt(b3)/parseInt(a3))*100;
			c4 = (parseInt(b4)/parseInt(a4))*100;
			c5 = (parseInt(b5)/parseInt(a5))*100;
			
			d1 = (parseInt(a1)/parseInt(suma))*100;
			d2 = (parseInt(a2)/parseInt(suma))*100;
			d3 = (parseInt(a3)/parseInt(suma))*100;
			d4 = (parseInt(a4)/parseInt(suma))*100;
			d5 = (parseInt(a5)/parseInt(suma))*100;
			
			e1 = (parseFloat(c1)*parseFloat(d1))/100;
			e2 = (parseFloat(c2)*parseFloat(d2))/100;
			e3 = (parseFloat(c3)*parseFloat(d3))/100;
			e4 = (parseFloat(c4)*parseFloat(d4))/100;
			e5 = (parseFloat(c5)*parseFloat(d5))/100;
			
			fi_index = parseFloat(e1)+parseFloat(e2)+parseFloat(e3)+parseFloat(e4)+parseFloat(e5);
			$('#fi_index').val(fi_index.toFixed(2));
			
			$('#a1').val(a1.toFixed(2));
			$('#a2').val(a2.toFixed(2));
			$('#a3').val(a3.toFixed(2));
			$('#a4').val(a4.toFixed(2));
			$('#a5').val(a5.toFixed(2));
			$('#suma').val(suma.toFixed(2));
			
			$('#b1').val(b1.toFixed(2));
			$('#b2').val(b2.toFixed(2));
			$('#b3').val(b3.toFixed(2));
			$('#b4').val(b4.toFixed(2));
			$('#b5').val(b5.toFixed(2));
			$('#sumb').val(sumb.toFixed(2));
			
			$('#c1').val(c1.toFixed(2));
			$('#c2').val(c2.toFixed(2));
			$('#c3').val(c3.toFixed(2));
			$('#c4').val(c4.toFixed(2));
			$('#c5').val(c5.toFixed(2));
			
			$('#d1').val(d1.toFixed(2));
			$('#d2').val(d2.toFixed(2));
			$('#d3').val(d3.toFixed(2));
			$('#d4').val(d4.toFixed(2));
			$('#d5').val(d5.toFixed(2));
			
			$('#e1').val(e1.toFixed(2));
			$('#e2').val(e2.toFixed(2));
			$('#e3').val(e3.toFixed(2));
			$('#e4').val(e4.toFixed(2));
			$('#e5').val(e5.toFixed(2));
	}
	
	$('#chk_f5').change(function(){
        if(this.checked)
		{ 
			chk_f5_fun();
		}
		else{
			
			$('#a5').val(0);
			$('#b5').val(0);
			$('#c5').val(0);
			$('#d5').val(0);
			$('#e5').val(0);
			
			chk_f4_fun();
		}
	
	});
	
	
	function a_b()
	{
		
			//FLANKINESS INDEX	   			
			a1=$('#a1').val();
			a2=$('#a2').val();
			a3=$('#a3').val();
			a4=$('#a4').val();
			a5=$('#a5').val();
			suma = parseInt(a1)+parseInt(a2)+parseInt(a3)+parseInt(a4)+parseInt(a5);
			
			b1=$('#b1').val();
			b2=$('#b2').val();
			b3=$('#b3').val();
			b4=$('#b4').val();
			b5=$('#b5').val();
			sumb = parseInt(b1)+parseInt(b2)+parseInt(b3)+parseInt(b4)+parseInt(b5);
			
			c1 = (parseInt(b1)/parseInt(a1))*100;
			c2 = (parseInt(b2)/parseInt(a2))*100;
			c3 = (parseInt(b3)/parseInt(a3))*100;
			c4 = (parseInt(b4)/parseInt(a4))*100;
			c5 = (parseInt(b5)/parseInt(a5))*100;
			
			d1 = (parseInt(a1)/parseInt(suma))*100;
			d2 = (parseInt(a2)/parseInt(suma))*100;
			d3 = (parseInt(a3)/parseInt(suma))*100;
			d4 = (parseInt(a4)/parseInt(suma))*100;
			d5 = (parseInt(a5)/parseInt(suma))*100;
			
			e1 = (parseFloat(c1)*parseFloat(d1))/100;
			e2 = (parseFloat(c2)*parseFloat(d2))/100;
			e3 = (parseFloat(c3)*parseFloat(d3))/100;
			e4 = (parseFloat(c4)*parseFloat(d4))/100;
			e5 = (parseFloat(c5)*parseFloat(d5))/100;
			
			fi_index = parseFloat(e1)+parseFloat(e2)+parseFloat(e3)+parseFloat(e4)+parseFloat(e5);
			$('#fi_index').val(fi_index.toFixed(2));
			
			//$('#a1').val(a1.toFixed(2));
			//$('#a2').val(a2.toFixed(2));
			//$('#a3').val(a3.toFixed(2));
			$('#suma').val(suma.toFixed(2));
			
			//$('#b1').val(b1.toFixed(2));
			//$('#b2').val(b2.toFixed(2));
			//$('#b3').val(b3.toFixed(2));
			$('#sumb').val(sumb.toFixed(2));
			
			$('#c1').val(c1.toFixed(2));
			$('#c2').val(c2.toFixed(2));
			$('#c3').val(c3.toFixed(2));
			$('#c4').val(c4.toFixed(2));
			$('#c5').val(c5.toFixed(2));
			
			$('#d1').val(d1.toFixed(2));
			$('#d2').val(d2.toFixed(2));
			$('#d3').val(d3.toFixed(2));
			$('#d4').val(d4.toFixed(2));
			$('#d5').val(d5.toFixed(2));
			
			$('#e1').val(e1.toFixed(2));
			$('#e2').val(e2.toFixed(2));
			$('#e3').val(e3.toFixed(2));
			$('#e4').val(e4.toFixed(2));
			$('#e5').val(e5.toFixed(2));
					
	}
	
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
	
	
	//ELONGATION INDEX
	var aa1;
	var aa2;
	var aa3;
	var aa4;
	var aa5;
	var sumaa;
	var bb1;
	var bb2;
	var bb3;
	var bb4;
	var bb5;
	var sumbb;
	var cc1;
	var cc2;
	var cc3;
	var cc4;
	var cc5;
	var dd1;
	var dd2;
	var dd3;
	var dd4;
	var dd5;
	var ee1;
	var ee2;
	var ee3;
	var ee4;
	var ee5;
	
	$('#chk_elo').change(function(){
        if(this.checked)
		{ 
			$('#ei_index').val(0);
			$('#aa1').val(0);
			$('#aa2').val(0);
			$('#aa3').val(0);
			$('#aa4').val(0);
			$('#aa5').val(0);
			$('#sumaa').val(0);
			
			$('#bb1').val(0);
			$('#bb2').val(0);
			$('#bb3').val(0);
			$('#bb4').val(0);
			$('#bb5').val(0);
			$('#sumbb').val(0);
			
			$('#cc1').val(0);
			$('#cc2').val(0);
			$('#cc3').val(0);
			$('#cc4').val(0);
			$('#cc5').val(0);
			
			$('#dd1').val(0);
			$('#dd2').val(0);
			$('#dd3').val(0);
			$('#dd4').val(0);
			$('#dd5').val(0);
			
			$('#ee1').val(0);
			$('#ee2').val(0);
			$('#ee3').val(0);
			$('#ee4').val(0);
			$('#ee5').val(0);
		/*	//ELONGATION INDEX	   			
			aa1=randomNumberFromRange(3600, 3640);
			aa2=randomNumberFromRange(3300, 3340);
			aa3=randomNumberFromRange(2130, 2170);
			aa4=randomNumberFromRange(2000, 2150);
			aa5=randomNumberFromRange(1950, 2000);
			sumaa = parseInt(aa1)+parseInt(aa2)+parseInt(aa3)+parseInt(aa4)+parseInt(aa5);
			
			bb1=randomNumberFromRange(390, 430);
			bb2=randomNumberFromRange(190, 230);
			bb3=randomNumberFromRange(155, 195);
			bb4=randomNumberFromRange(140, 150);
			bb5=randomNumberFromRange(130, 140);
			sumbb = parseInt(bb1)+parseInt(bb2)+parseInt(bb3)+parseInt(bb4)+parseInt(bb5);
			
			cc1 = (parseInt(bb1)/parseInt(aa1))*100;
			cc2 = (parseInt(bb2)/parseInt(aa2))*100;
			cc3 = (parseInt(bb3)/parseInt(aa3))*100;
			cc4 = (parseInt(bb4)/parseInt(aa4))*100;
			cc5 = (parseInt(bb5)/parseInt(aa5))*100;
			
			dd1 = (parseInt(aa1)/parseInt(sumaa))*100;
			dd2 = (parseInt(aa2)/parseInt(sumaa))*100;
			dd3 = (parseInt(aa3)/parseInt(sumaa))*100;
			dd4 = (parseInt(aa4)/parseInt(sumaa))*100;
			dd5 = (parseInt(aa5)/parseInt(sumaa))*100;
			
			ee1 = (parseFloat(cc1)*parseFloat(dd1))/100;
			ee2 = (parseFloat(cc2)*parseFloat(dd2))/100;
			ee3 = (parseFloat(cc3)*parseFloat(dd3))/100;
			ee4 = (parseFloat(cc4)*parseFloat(dd4))/100;
			ee5 = (parseFloat(cc5)*parseFloat(dd5))/100;
			
			ei_index = parseFloat(ee1)+parseFloat(ee2)+parseFloat(ee3)+parseFloat(ee4)+parseFloat(ee5);
			$('#ei_index').val(ei_index.toFixed(2));
			
			$('#aa1').val(aa1.toFixed(2));
			$('#aa2').val(aa2.toFixed(2));
			$('#aa3').val(aa3.toFixed(2));
			$('#aa4').val(aa4.toFixed(2));
			$('#aa5').val(aa5.toFixed(2));
			$('#sumaa').val(sumaa.toFixed(2));
			
			$('#bb1').val(bb1.toFixed(2));
			$('#bb2').val(bb2.toFixed(2));
			$('#bb3').val(bb3.toFixed(2));
			$('#bb4').val(bb4.toFixed(2));
			$('#bb5').val(bb5.toFixed(2));
			$('#sumbb').val(sumbb.toFixed(2));
			
			$('#cc1').val(cc1.toFixed(2));
			$('#cc2').val(cc2.toFixed(2));
			$('#cc3').val(cc3.toFixed(2));
			$('#cc4').val(cc4.toFixed(2));
			$('#cc5').val(cc5.toFixed(2));
			
			$('#dd1').val(dd1.toFixed(2));
			$('#dd2').val(dd2.toFixed(2));
			$('#dd3').val(dd3.toFixed(2));
			$('#dd4').val(dd4.toFixed(2));
			$('#dd5').val(dd5.toFixed(2));
			
			$('#ee1').val(ee1.toFixed(2));
			$('#ee2').val(ee2.toFixed(2));
			$('#ee3').val(ee3.toFixed(2));
			$('#ee4').val(ee4.toFixed(2));
			$('#ee5').val(ee5.toFixed(2));*/
			
		}
		else
		{
			$('#ei_index').val(null);
			 $("#chk_e1").prop("checked", false); 
			 $("#chk_e2").prop("checked", false); 
			 $("#chk_e3").prop("checked", false); 
			 $("#chk_e4").prop("checked", false); 
		     $("#chk_e5").prop("checked", false); 
			 
			$('#aa1').val(null);
			$('#aa2').val(null);
			$('#aa3').val(null);
			$('#aa4').val(null);
			$('#aa5').val(null);
			$('#sumaa').val(null);
			
			$('#bb1').val(null);
			$('#bb2').val(null);
			$('#bb3').val(null);
			$('#bb4').val(null);
			$('#bb5').val(null);
			$('#sumbb').val(null);
			
			$('#cc1').val(null);
			$('#cc2').val(null);
			$('#cc3').val(null);
			$('#cc4').val(null);
			$('#cc5').val(null);
			
			$('#dd1').val(null);
			$('#dd2').val(null);
			$('#dd3').val(null);
			$('#dd4').val(null);
			$('#dd5').val(null);
			
			$('#ee1').val(null);
			$('#ee2').val(null);
			$('#ee3').val(null);
			$('#ee4').val(null);
			$('#ee5').val(null);
		}
		
	});
	
	
	function chk_e1_fun()
	{
		
		//FLANKINESS INDEX	   			
			aa1=randomNumberFromRange(3600, 3640);
			aa2=$('#aa2').val();
			aa3=$('#aa3').val();
			aa4=$('#aa4').val();
			aa5=$('#aa5').val();
			sumaa = parseInt(aa1)+parseInt(aa2)+parseInt(aa3)+parseInt(aa4)+parseInt(aa5);
			
			bb1=randomNumberFromRange(390, 430);			
			bb2=$('#bb2').val();
			bb3=$('#bb3').val();
			bb4=$('#bb4').val();
			bb5=$('#bb5').val();
			sumbb = parseInt(bb1)+parseInt(bb2)+parseInt(bb3)+parseInt(bb4)+parseInt(bb5);
			
			cc1 = (parseInt(bb1)/parseInt(aa1))*100;
			cc2 = 0;//(parseInt(bb2)/parseInt(aa2))*100;
			cc3 = 0;//(parseInt(bb3)/parseInt(aa3))*100;
			cc4 = 0;//(parseInt(bb4)/parseInt(aa4))*100;
			cc5 = 0;//(parseInt(bb5)/parseInt(aa5))*100;
			
			dd1 = (parseInt(aa1)/parseInt(sumaa))*100;
			dd2 = 0;//(parseInt(aa2)/parseInt(sumaa))*100;
			dd3 = 0;//(parseInt(aa3)/parseInt(sumaa))*100;
			dd4 = 0;//(parseInt(aa4)/parseInt(sumaa))*100;
			dd5 = 0;//(parseInt(aa5)/parseInt(sumaa))*100;
			
			ee1 = (parseFloat(cc1)*parseFloat(dd1))/100;
			ee2 = 0;//(parseFloat(cc2)*parseFloat(dd2))/100;
			ee3 = 0;//(parseFloat(cc3)*parseFloat(dd3))/100;
			ee4 = 0;//(parseFloat(cc4)*parseFloat(dd4))/100;
			ee5 = 0;//(parseFloat(cc5)*parseFloat(dd5))/100;
			
			ei_index = parseFloat(ee1)+parseFloat(ee2)+parseFloat(ee3)+parseFloat(ee4)+parseFloat(ee5);
			$('#ei_index').val(ei_index.toFixed(2));
			
			$('#aa1').val(aa1.toFixed(2));
			$('#sumaa').val(sumaa.toFixed(2));
			
			$('#bb1').val(bb1.toFixed(2));
			$('#sumbb').val(sumbb.toFixed(2));
			
			$('#cc1').val(cc1.toFixed(2));
			$('#cc2').val(cc2.toFixed(2));
			$('#cc3').val(cc3.toFixed(2));
			$('#cc4').val(cc4.toFixed(2));
			$('#cc5').val(cc5.toFixed(2));
			
			$('#dd1').val(dd1.toFixed(2));
			$('#dd2').val(dd2.toFixed(2));
			$('#dd3').val(dd3.toFixed(2));
			$('#dd4').val(dd4.toFixed(2));
			$('#dd5').val(dd5.toFixed(2));
			
			$('#ee1').val(ee1.toFixed(2));
			$('#ee2').val(ee2.toFixed(2));
			$('#ee3').val(ee3.toFixed(2));
			$('#ee4').val(ee4.toFixed(2));
			$('#ee5').val(ee5.toFixed(2));
		
	}
	
	$('#chk_e1').change(function(){
        if(this.checked)
		{ 
			chk_e1_fun();
		}
		else{
			$('#aa1').val(0);
			$('#bb1').val(0);
			$('#cc1').val(0);
			$('#dd1').val(0);
			$('#ee1').val(0);
			$('#ei_index').val(0);
			
			$('#sumaa').val(0);
			$('#sumbb').val(0);
			
			$("#chk_e2").prop("checked", false); 
			$('#aa2').val(0);
			$('#bb2').val(0);
			$('#cc2').val(0);
			$('#dd2').val(0);
			$('#ee2').val(0);
			
			$("#chk_e3").prop("checked", false); 
			$('#aa3').val(0);
			$('#bb3').val(0);
			$('#cc3').val(0);
			$('#dd3').val(0);
			$('#ee3').val(0);
			
			$("#chk_e4").prop("checked", false); 
			$('#aa4').val(0);
			$('#bb4').val(0);
			$('#cc4').val(0);
			$('#dd4').val(0);
			$('#ee4').val(0);
			
			$("#chk_e5").prop("checked", false); 
			$('#aa5').val(0);
			$('#bb5').val(0);
			$('#cc5').val(0);
			$('#dd5').val(0);
			$('#ee5').val(0);
		}
	
	});
	
	
	
	/*CODE*/
	function chk_e2_fun()
	{
		 $("#chk_e2").prop("checked", true); 
			//FLANKINESS INDEX	   			
			aa1=randomNumberFromRange(3600, 3640);
			aa2=randomNumberFromRange(3300, 3340);
			aa3=$('#aa3').val();
			aa4=$('#aa4').val();
			aa5=$('#aa5').val();
			sumaa = parseInt(aa1)+parseInt(aa2)+parseInt(aa3)+parseInt(aa4)+parseInt(aa5);
			
			bb1=randomNumberFromRange(390, 430);
			bb2=randomNumberFromRange(190, 230);
			bb3=$('#bb3').val();
			bb4=$('#bb4').val();
			bb5=$('#bb5').val();
			sumbb = parseInt(bb1)+parseInt(bb2)+parseInt(bb3)+parseInt(bb4)+parseInt(bb5);
			
			cc1 = (parseInt(bb1)/parseInt(aa1))*100;
			cc2 = (parseInt(bb2)/parseInt(aa2))*100;
			cc3 = 0;//(parseInt(bb3)/parseInt(aa3))*100;
			cc4 = 0;//(parseInt(bb4)/parseInt(aa4))*100;
			cc5 = 0;//(parseInt(bb5)/parseInt(aa5))*100;
			
			dd1 = (parseInt(aa1)/parseInt(sumaa))*100;
			dd2 = (parseInt(aa2)/parseInt(sumaa))*100;
			dd3 = 0;//(parseInt(aa3)/parseInt(sumaa))*100;
			dd4 = 0;//(parseInt(aa4)/parseInt(sumaa))*100;
			dd5 = 0;//(parseInt(aa5)/parseInt(sumaa))*100;
			
			ee1 = (parseFloat(cc1)*parseFloat(dd1))/100;
			ee2 = (parseFloat(cc2)*parseFloat(dd2))/100;
			ee3 = 0;//(parseFloat(cc3)*parseFloat(dd3))/100;
			ee4 = 0;//(parseFloat(cc4)*parseFloat(dd4))/100;
			ee5 = 0;//(parseFloat(cc5)*parseFloat(dd5))/100;
			
			ei_index = parseFloat(ee1)+parseFloat(ee2)+parseFloat(ee3)+parseFloat(ee4)+parseFloat(ee5);
			$('#ei_index').val(ei_index.toFixed(2));
		
			$('#aa1').val(aa1.toFixed(2));
			$('#aa2').val(aa2.toFixed(2));
			$('#sumaa').val(sumaa.toFixed(2));
			
			$('#bb1').val(bb1.toFixed(2));
			$('#bb2').val(bb2.toFixed(2));
			$('#sumbb').val(sumbb.toFixed(2));
			
			$('#cc1').val(cc1.toFixed(2));
			$('#cc2').val(cc2.toFixed(2));
			$('#cc3').val(cc3.toFixed(2));
			$('#cc4').val(cc4.toFixed(2));
			$('#cc5').val(cc5.toFixed(2));
			
			$('#dd1').val(dd1.toFixed(2));
			$('#dd2').val(dd2.toFixed(2));
			$('#dd3').val(dd3.toFixed(2));
			$('#dd4').val(dd4.toFixed(2));
			$('#dd5').val(dd5.toFixed(2));
			
			$('#ee1').val(ee1.toFixed(2));
			$('#ee2').val(ee2.toFixed(2));
			$('#ee3').val(ee3.toFixed(2));
			$('#ee4').val(ee4.toFixed(2));
			$('#ee5').val(ee5.toFixed(2));
		
	}
	
	
	$('#chk_e2').change(function(){
        if(this.checked)
		{ 
			chk_e2_fun();
		}
		else{
			$('#aa2').val(0);
			$('#bb2').val(0);
			$('#cc2').val(0);
			$('#dd2').val(0);
			$('#ee2').val(0);
			
			chk_e1_fun();
			
			$("#chk_e3").prop("checked", false); 
			$('#aa3').val(0);
			$('#bb3').val(0);
			$('#cc3').val(0);
			$('#dd3').val(0);
			$('#ee3').val(0);
			
			$("#chk_e4").prop("checked", false); 
			$('#aa4').val(0);
			$('#bb4').val(0);
			$('#cc4').val(0);
			$('#dd4').val(0);
			$('#ee4').val(0);
			
			$("#chk_e5").prop("checked", false); 
			$('#aa5').val(0);
			$('#bb5').val(0);
			$('#cc5').val(0);
			$('#dd5').val(0);
			$('#ee5').val(0);
		}
	
	});
	
	function chk_e3_fun()
	{
		 $("#chk_e1").prop("checked", true); 
		 $("#chk_e2").prop("checked", true); 
			//FLANKINESS INDEX	   			
			aa1=randomNumberFromRange(3600, 3640);
			aa2=randomNumberFromRange(3300, 3340);
			aa3=randomNumberFromRange(2130, 2170);
			aa4=$('#aa4').val();
			aa5=$('#aa5').val();
			sumaa = parseInt(aa1)+parseInt(aa2)+parseInt(aa3)+parseInt(aa4)+parseInt(aa5);
			
			bb1=randomNumberFromRange(390, 430);
			bb2=randomNumberFromRange(190, 230);
			bb3=randomNumberFromRange(155, 195);
			bb4=$('#bb4').val();
			bb5=$('#bb5').val();
			sumbb = parseInt(bb1)+parseInt(bb2)+parseInt(bb3)+parseInt(bb4)+parseInt(bb5);
			
			cc1 = (parseInt(bb1)/parseInt(aa1))*100;
			cc2 = (parseInt(bb2)/parseInt(aa2))*100;
			cc3 = (parseInt(bb3)/parseInt(aa3))*100;
			cc4 = 0;//(parseInt(bb4)/parseInt(aa4))*100;
			cc5 = 0;//(parseInt(bb5)/parseInt(aa5))*100;
			
			dd1 = (parseInt(aa1)/parseInt(sumaa))*100;
			dd2 = (parseInt(aa2)/parseInt(sumaa))*100;
			dd3 = (parseInt(aa3)/parseInt(sumaa))*100;
			dd4 = 0;//(parseInt(aa4)/parseInt(sumaa))*100;
			dd5 = 0;//(parseInt(aa5)/parseInt(sumaa))*100;
			
			ee1 = (parseFloat(cc1)*parseFloat(dd1))/100;
			ee2 = (parseFloat(cc2)*parseFloat(dd2))/100;
			ee3 = (parseFloat(cc3)*parseFloat(dd3))/100;
			ee4 = 0;//(parseFloat(cc4)*parseFloat(dd4))/100;
			ee5 = 0;//(parseFloat(cc5)*parseFloat(dd5))/100;
			
			ei_index = parseFloat(ee1)+parseFloat(ee2)+parseFloat(ee3)+parseFloat(ee4)+parseFloat(ee5);
			$('#ei_index').val(ei_index.toFixed(2));
			
			//$('#aa1').val(aa1.toFixed(2));
			$('#aa1').val(aa1.toFixed(2));
			$('#aa2').val(aa2.toFixed(2));
			$('#aa3').val(aa3.toFixed(2));
			$('#sumaa').val(sumaa.toFixed(2));
			
			$('#bb1').val(bb1.toFixed(2));
			$('#bb2').val(bb2.toFixed(2));
			$('#bb3').val(bb3.toFixed(2));
			$('#sumbb').val(sumbb.toFixed(2));
			
			$('#cc1').val(cc1.toFixed(2));
			$('#cc2').val(cc2.toFixed(2));
			$('#cc3').val(cc3.toFixed(2));
			$('#cc4').val(cc4.toFixed(2));
			$('#cc5').val(cc5.toFixed(2));
			
			$('#dd1').val(dd1.toFixed(2));
			$('#dd2').val(dd2.toFixed(2));
			$('#dd3').val(dd3.toFixed(2));
			$('#dd4').val(dd4.toFixed(2));
			$('#dd5').val(dd5.toFixed(2));
			
			$('#ee1').val(ee1.toFixed(2));
			$('#ee2').val(ee2.toFixed(2));
			$('#ee3').val(ee3.toFixed(2));
			$('#ee4').val(ee4.toFixed(2));
			$('#ee5').val(ee5.toFixed(2));
		
	}
	
		$('#chk_e3').change(function(){
        if(this.checked)
		{ 
			chk_e3_fun();
		}
		else{
			$('#aa3').val(0);
			$('#bb3').val(0);
			$('#cc3').val(0);
			$('#dd3').val(0);
			$('#ee3').val(0);
			
			chk_e2_fun();
			
			$("#chk_e4").prop("checked", false); 
			$('#aa4').val(0);
			$('#bb4').val(0);
			$('#cc4').val(0);
			$('#dd4').val(0);
			$('#ee4').val(0);
			
			$("#chk_e5").prop("checked", false); 
			$('#aa5').val(0);
			$('#bb5').val(0);
			$('#cc5').val(0);
			$('#dd5').val(0);
			$('#ee5').val(0);
			
		}
	
	});
	
	function chk_e4_fun()
	{
		
		$("#chk_e1").prop("checked", true); 
		 $("#chk_e2").prop("checked", true); 
		 $("#chk_e3").prop("checked", true); 
			//FLANKINESS INDEX	   			
			aa1=randomNumberFromRange(3600, 3640);
			aa2=randomNumberFromRange(3300, 3340);
			aa3=randomNumberFromRange(2130, 2170);
			aa4=randomNumberFromRange(2000, 2150);
			aa5=$('#aa5').val();
			sumaa = parseInt(aa1)+parseInt(aa2)+parseInt(aa3)+parseInt(aa4)+parseInt(aa5);
			
			bb1=randomNumberFromRange(390, 430);
			bb2=randomNumberFromRange(190, 230);
			bb3=randomNumberFromRange(155, 195);
			bb4=randomNumberFromRange(140, 150);
			bb5=$('#bb5').val();
			sumbb = parseInt(bb1)+parseInt(bb2)+parseInt(bb3)+parseInt(bb4)+parseInt(bb5);
			
			cc1 = (parseInt(bb1)/parseInt(aa1))*100;
			cc2 = (parseInt(bb2)/parseInt(aa2))*100;
			cc3 = (parseInt(bb3)/parseInt(aa3))*100;
			cc4 = (parseInt(bb4)/parseInt(aa4))*100;
			cc5 = 0;//(parseInt(bb5)/parseInt(aa5))*100;
			
			dd1 = (parseInt(aa1)/parseInt(sumaa))*100;
			dd2 = (parseInt(aa2)/parseInt(sumaa))*100;
			dd3 = (parseInt(aa3)/parseInt(sumaa))*100;
			dd4 = (parseInt(aa4)/parseInt(sumaa))*100;
			dd5 = 0;//(parseInt(aa5)/parseInt(sumaa))*100;
			
			ee1 = (parseFloat(cc1)*parseFloat(dd1))/100;
			ee2 = (parseFloat(cc2)*parseFloat(dd2))/100;
			ee3 = (parseFloat(cc3)*parseFloat(dd3))/100;
			ee4 = (parseFloat(cc4)*parseFloat(dd4))/100;
			ee5 = 0;//(parseFloat(cc5)*parseFloat(dd5))/100;
			
			ei_index = parseFloat(ee1)+parseFloat(ee2)+parseFloat(ee3)+parseFloat(ee4)+parseFloat(ee5);
			$('#ei_index').val(ei_index.toFixed(2));
			
			$('#aa1').val(aa1.toFixed(2));
			$('#aa2').val(aa2.toFixed(2));
			$('#aa3').val(aa3.toFixed(2));
			$('#aa4').val(aa4.toFixed(2));
			$('#sumaa').val(sumaa.toFixed(2));
			
			$('#bb1').val(bb1.toFixed(2));
			$('#bb2').val(bb2.toFixed(2));
			$('#bb3').val(bb3.toFixed(2));
			$('#bb4').val(bb4.toFixed(2));
			$('#sumbb').val(sumbb.toFixed(2));
			
			$('#cc1').val(cc1.toFixed(2));
			$('#cc2').val(cc2.toFixed(2));
			$('#cc3').val(cc3.toFixed(2));
			$('#cc4').val(cc4.toFixed(2));
			$('#cc5').val(cc5.toFixed(2));
			
			$('#dd1').val(dd1.toFixed(2));
			$('#dd2').val(dd2.toFixed(2));
			$('#dd3').val(dd3.toFixed(2));
			$('#dd4').val(dd4.toFixed(2));
			$('#dd5').val(dd5.toFixed(2));
			
			$('#ee1').val(ee1.toFixed(2));
			$('#ee2').val(ee2.toFixed(2));
			$('#ee3').val(ee3.toFixed(2));
			$('#ee4').val(ee4.toFixed(2));
			$('#ee5').val(ee5.toFixed(2));
	}
	
	$('#chk_e4').change(function(){
        if(this.checked)
		{ 
			chk_e4_fun();
		}
		else{
			$('#aa4').val(0);
			$('#bb4').val(0);
			$('#cc4').val(0);
			$('#dd4').val(0);
			$('#ee4').val(0);
			chk_e3_fun();
			
			$("#chk_e5").prop("checked", false); 
			$('#aa5').val(0);
			$('#bb5').val(0);
			$('#cc5').val(0);
			$('#dd5').val(0);
			$('#ee5').val(0);
		}
	
	});
	
	
	function chk_e5_fun()
	{
		
		$("#chk_e1").prop("checked", true); 
		 $("#chk_e2").prop("checked", true); 
		 $("#chk_e3").prop("checked", true); 
		 $("#chk_e4").prop("checked", true); 
			//FLANKINESS INDEX	   			
			aa1=randomNumberFromRange(3600, 3640);
			aa2=randomNumberFromRange(3300, 3340);
			aa3=randomNumberFromRange(2130, 2170);
			aa4=randomNumberFromRange(2000, 2150);
			aa5=randomNumberFromRange(1950, 2000);
			sumaa = parseInt(aa1)+parseInt(aa2)+parseInt(aa3)+parseInt(aa4)+parseInt(aa5);
			
			bb1=randomNumberFromRange(390, 430);
			bb2=randomNumberFromRange(190, 230);
			bb3=randomNumberFromRange(155, 195);
			bb4=randomNumberFromRange(140, 150);
			bb5=randomNumberFromRange(130, 140);
			sumbb = parseInt(bb1)+parseInt(bb2)+parseInt(bb3)+parseInt(bb4)+parseInt(bb5);
			
			cc1 = (parseInt(bb1)/parseInt(aa1))*100;
			cc2 = (parseInt(bb2)/parseInt(aa2))*100;
			cc3 = (parseInt(bb3)/parseInt(aa3))*100;
			cc4 = (parseInt(bb4)/parseInt(aa4))*100;
			cc5 = (parseInt(bb5)/parseInt(aa5))*100;
			
			dd1 = (parseInt(aa1)/parseInt(sumaa))*100;
			dd2 = (parseInt(aa2)/parseInt(sumaa))*100;
			dd3 = (parseInt(aa3)/parseInt(sumaa))*100;
			dd4 = (parseInt(aa4)/parseInt(sumaa))*100;
			dd5 = (parseInt(aa5)/parseInt(sumaa))*100;
			
			ee1 = (parseFloat(cc1)*parseFloat(dd1))/100;
			ee2 = (parseFloat(cc2)*parseFloat(dd2))/100;
			ee3 = (parseFloat(cc3)*parseFloat(dd3))/100;
			ee4 = (parseFloat(cc4)*parseFloat(dd4))/100;
			ee5 = (parseFloat(cc5)*parseFloat(dd5))/100;
			
			ei_index = parseFloat(ee1)+parseFloat(ee2)+parseFloat(ee3)+parseFloat(ee4)+parseFloat(ee5);
			$('#ei_index').val(ei_index.toFixed(2));
			
			$('#aa1').val(aa1.toFixed(2));
			$('#aa2').val(aa2.toFixed(2));
			$('#aa3').val(aa3.toFixed(2));
			$('#aa4').val(aa4.toFixed(2));
			$('#aa5').val(aa5.toFixed(2));
			$('#sumaa').val(sumaa.toFixed(2));
			
			$('#bb1').val(bb1.toFixed(2));
			$('#bb2').val(bb2.toFixed(2));
			$('#bb3').val(bb3.toFixed(2));
			$('#bb4').val(bb4.toFixed(2));
			$('#bb5').val(bb5.toFixed(2));
			$('#sumbb').val(sumbb.toFixed(2));
			
			$('#cc1').val(cc1.toFixed(2));
			$('#cc2').val(cc2.toFixed(2));
			$('#cc3').val(cc3.toFixed(2));
			$('#cc4').val(cc4.toFixed(2));
			$('#cc5').val(cc5.toFixed(2));
			
			$('#dd1').val(dd1.toFixed(2));
			$('#dd2').val(dd2.toFixed(2));
			$('#dd3').val(dd3.toFixed(2));
			$('#dd4').val(dd4.toFixed(2));
			$('#dd5').val(dd5.toFixed(2));
			
			$('#ee1').val(ee1.toFixed(2));
			$('#ee2').val(ee2.toFixed(2));
			$('#ee3').val(ee3.toFixed(2));
			$('#ee4').val(ee4.toFixed(2));
			$('#ee5').val(ee5.toFixed(2));
	}
	
	$('#chk_e5').change(function(){
        if(this.checked)
		{ 
			chk_e5_fun();
		}
		else{
			
			$('#aa5').val(0);
			$('#bb5').val(0);
			$('#cc5').val(0);
			$('#dd5').val(0);
			$('#ee5').val(0);
			
			chk_e4_fun();
		}
	
	});
	
	/*CODE*/
	
	function aa_bb()
	{
			//ELONGATION INDEX	   			
			aa1=$('#aa1').val();
			aa2=$('#aa2').val();
			aa3=$('#aa3').val();
			aa4=$('#aa4').val();
			aa5=$('#aa5').val();
			sumaa = parseInt(aa1)+parseInt(aa2)+parseInt(aa3)+parseInt(aa4)+parseInt(aa5);
			
			bb1=$('#bb1').val();
			bb2=$('#bb2').val();
			bb3=$('#bb3').val();
			bb4=$('#bb4').val();
			bb5=$('#bb5').val();
			sumbb = parseInt(bb1)+parseInt(bb2)+parseInt(bb3)+parseInt(bb4)+parseInt(bb5);
			
			cc1 = (parseInt(bb1)/parseInt(aa1))*100;
			cc2 = (parseInt(bb2)/parseInt(aa2))*100;
			cc3 = (parseInt(bb3)/parseInt(aa3))*100;
			cc4 = (parseInt(bb4)/parseInt(aa4))*100;
			cc5 = (parseInt(bb5)/parseInt(aa5))*100;
			
			dd1 = (parseInt(aa1)/parseInt(sumaa))*100;
			dd2 = (parseInt(aa2)/parseInt(sumaa))*100;
			dd3 = (parseInt(aa3)/parseInt(sumaa))*100;
			dd4 = (parseInt(aa4)/parseInt(sumaa))*100;
			dd5 = (parseInt(aa5)/parseInt(sumaa))*100;
			
			ee1 = (parseFloat(cc1)*parseFloat(dd1))/100;
			ee2 = (parseFloat(cc2)*parseFloat(dd2))/100;
			ee3 = (parseFloat(cc3)*parseFloat(dd3))/100;
			ee4 = (parseFloat(cc4)*parseFloat(dd4))/100;
			ee5 = (parseFloat(cc5)*parseFloat(dd5))/100;
			
			ei_index = parseFloat(ee1)+parseFloat(ee2)+parseFloat(ee3)+parseFloat(ee4)+parseFloat(ee5);
			$('#ei_index').val(ei_index.toFixed(2));
					
			$('#sumaa').val(sumaa.toFixed(2));
			
			$('#sumbb').val(sumbb.toFixed(2));
			
			$('#cc1').val(cc1.toFixed(2));
			$('#cc2').val(cc2.toFixed(2));
			$('#cc3').val(cc3.toFixed(2));
			$('#cc4').val(cc4.toFixed(2));
			$('#cc5').val(cc5.toFixed(2));
			
			$('#dd1').val(dd1.toFixed(2));
			$('#dd2').val(dd2.toFixed(2));
			$('#dd3').val(dd3.toFixed(2));
			$('#dd4').val(dd4.toFixed(2));
			$('#dd5').val(dd5.toFixed(2));
			
			$('#ee1').val(ee1.toFixed(2));
			$('#ee2').val(ee2.toFixed(2));
			$('#ee3').val(ee3.toFixed(2));
			$('#ee4').val(ee4.toFixed(2));
			$('#ee5').val(ee5.toFixed(2));
		
	}
	
	$('#aa1').change(function(){
        			  		
		aa_bb();	
		
	});
	
	$('#aa2').change(function(){
      aa_bb();
	});
	
	$('#aa3').change(function(){
		aa_bb();
	});
	
	$('#aa4').change(function(){
		aa_bb();
	});
	
	$('#aa5').change(function(){
		aa_bb();
		
	});
	
	$('#bb1').change(function(){
       aa_bb();
		
	});
	
	$('#bb2').change(function(){
        			  		
		aa_bb();
		
	});
	
	$('#bb3').change(function(){
       aa_bb();
		
	});
	
	

	var sieve_1;	
	var sieve_2;	
	var sieve_3;	
	var sieve_4;	
	var sieve_5;	
	 
	
	$('#chk_grd').change(function(){
        if(this.checked)
		{ 
			sieve_1="63";	
			sieve_2="53";	
			sieve_3="45";	
			sieve_4="22.4";	
			sieve_5="11.2";	
				
					var sample_taken=50000;
					//PASSING RANGE
					var pass_sample_1 = randomNumberFromRange(100, 100);
					var pass_sample_2 = randomNumberFromRange(95,100);
					var pass_sample_3 = randomNumberFromRange(45,65);
					var pass_sample_4 = randomNumberFromRange(0,10);
					var pass_sample_5 = randomNumberFromRange(0,5);
					
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
					
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
					
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
					
					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
					
					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
					
					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(0));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
					
				   
					$('#pass_sample_1').val(pass_sample_1.toFixed(0));
					$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					$('#pass_sample_5').val(pass_sample_5.toFixed(2));
					
				  
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
					
					 
					$('#ret_wt_gm_1').val(null);
					$('#ret_wt_gm_2').val(null);
					$('#ret_wt_gm_3').val(null);
					$('#ret_wt_gm_4').val(null);
					$('#ret_wt_gm_5').val(null);
					
					
					
					$('#cum_ret_1').val(null);
					$('#cum_ret_2').val(null);
					$('#cum_ret_3').val(null);
					$('#cum_ret_4').val(null);
					$('#cum_ret_5').val(null);
					
				   
					$('#pass_sample_1').val(null);
					$('#pass_sample_2').val(null);
					$('#pass_sample_3').val(null);
					$('#pass_sample_4').val(null);
					$('#pass_sample_5').val(null);
					
				  
					 $('#blank_extra').val(null);
					 $('#sample_taken').val(null);
		}
	});
	
	
	$('#sample_taken').change(function(){
        
			sieve_1="63";	
			sieve_2="53";	
			sieve_3="45";	
			sieve_4="22.4";	
			sieve_5="11.2";			
					var sample_taken=$('#sample_taken').val();
					//PASSING RANGE
					var pass_sample_1 = randomNumberFromRange(100, 100);
					var pass_sample_2 = randomNumberFromRange(95,100);
					var pass_sample_3 = randomNumberFromRange(45,65);
					var pass_sample_4 = randomNumberFromRange(0,10);
					var pass_sample_5 = randomNumberFromRange(0,5);
			
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
			
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
			
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
			
					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
					
					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
					
					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(0));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
					
				   
					$('#pass_sample_1').val(pass_sample_1.toFixed(0));
					$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					$('#pass_sample_5').val(pass_sample_5.toFixed(2));
					
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					// $('#sample_taken').val(sample_taken.toFixed(0));
			
		
	});
	
	$('#pass_sample_1').change(function(){
        
			sieve_1="63";	
			sieve_2="53";	
			sieve_3="45";	
			sieve_4="22.4";	
			sieve_5="11.2";		
					var sample_taken=$('#sample_taken').val();
					//PASSING RANGE
					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();
					var pass_sample_5 = $('#pass_sample_5').val();
 					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
 					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
 					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
 					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
 					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
 					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(0));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
 				   
					//$('#pass_sample_1').val(pass_sample_1.toFixed(0));
					//$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					//$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					//$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					// $('#pass_sample_5').val(pass_sample_5.toFixed(2));
					//$('#pass_sample_6').val(pass_sample_6.toFixed(0));
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					// $('#sample_taken').val(sample_taken.toFixed(0));
			
		
	});
	
	$('#pass_sample_2').change(function(){
        
			sieve_1="63";	
			sieve_2="53";	
			sieve_3="45";	
			sieve_4="22.4";	
			sieve_5="11.2";			
					var sample_taken=$('#sample_taken').val();
					//PASSING RANGE
					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();
					var pass_sample_5 = $('#pass_sample_5').val();
 					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
 					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
 					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
 					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
 					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
 					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(0));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
 				   
					//$('#pass_sample_1').val(pass_sample_1.toFixed(0));
					//$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					//$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					//$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					// $('#pass_sample_5').val(pass_sample_5.toFixed(2));
					//$('#pass_sample_6').val(pass_sample_6.toFixed(0));
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					// $('#sample_taken').val(sample_taken.toFixed(0));
			
		
	});
	
	$('#pass_sample_3').change(function(){
        
			sieve_1="63";	
			sieve_2="53";	
			sieve_3="45";	
			sieve_4="22.4";	
			sieve_5="11.2";		
					var sample_taken=$('#sample_taken').val();
					//PASSING RANGE
					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();
					var pass_sample_5 = $('#pass_sample_5').val();
 					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
 					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
 					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
 					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
 					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
 					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(0));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
 				   
					//$('#pass_sample_1').val(pass_sample_1.toFixed(0));
					//$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					//$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					//$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					// $('#pass_sample_5').val(pass_sample_5.toFixed(2));
					//$('#pass_sample_6').val(pass_sample_6.toFixed(0));
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					// $('#sample_taken').val(sample_taken.toFixed(0));
			
		
	});
	
	$('#pass_sample_4').change(function(){
        
			sieve_1="63";	
			sieve_2="53";	
			sieve_3="45";	
			sieve_4="22.4";	
			sieve_5="11.2";		
					var sample_taken=$('#sample_taken').val();
					//PASSING RANGE
					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();
					var pass_sample_5 = $('#pass_sample_5').val();
 					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
 					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
 					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
 					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
 					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
 					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(0));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
 				   
					//$('#pass_sample_1').val(pass_sample_1.toFixed(0));
					//$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					//$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					//$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					// $('#pass_sample_5').val(pass_sample_5.toFixed(2));
					//$('#pass_sample_6').val(pass_sample_6.toFixed(0));
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					// $('#sample_taken').val(sample_taken.toFixed(0));
			
		
	});
	
	$('#pass_sample_5').change(function(){
        
			sieve_1="63";	
			sieve_2="53";	
			sieve_3="45";	
			sieve_4="22.4";	
			sieve_5="11.2";		
					var sample_taken=$('#sample_taken').val();
					//PASSING RANGE
					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();
					var pass_sample_5 = $('#pass_sample_5').val();
 					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
 					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
 					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
 					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
 					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
 					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(0));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
 				   
					//$('#pass_sample_1').val(pass_sample_1.toFixed(0));
					//$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					//$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					//$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					// $('#pass_sample_5').val(pass_sample_5.toFixed(2));
					//$('#pass_sample_6').val(pass_sample_6.toFixed(0));
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					// $('#sample_taken').val(sample_taken.toFixed(0));
			
		
	});
	
	
	$('#chk_ll').change(function(){
        if(this.checked)
		{ 			
				

					//PASSING RANGE
					var p_ll_1 = randomNumberFromRange(14, 17);
					var p_ll_2 = randomNumberFromRange(18, 19);
					var temp1 = 20 - parseFloat(p_ll_2);
					var temp2 = 20 - parseFloat(p_ll_1);
					var p_ll_3 = 20;
					var p_ll_4 = 20 + parseFloat(temp1);
					var p_ll_5 = 20 + parseFloat(temp2);	

					var mc_ll_1 = randomNumberFromRange(15.00, 17.00);
					var mc_ll_2 = randomNumberFromRange(17.01, 19.00);
					var mc_ll_3 = randomNumberFromRange(20.01, 25.00);
					var tem1 = parseFloat(mc_ll_3) - parseFloat(mc_ll_2);
					var tem2 = parseFloat(mc_ll_3) - parseFloat(mc_ll_1);
					var mc_ll_4 = parseFloat(mc_ll_3)+parseFloat(tem1);
					var mc_ll_5 = parseFloat(mc_ll_3)+parseFloat(tem2);

													

					var liquide_limit = mc_ll_3;
					
						
					var od_ll_1 = randomNumberFromRange(20.00, 25.00);
					var od_ll_2 = randomNumberFromRange(20.00, 25.00);
					var od_ll_3 = randomNumberFromRange(20.00, 25.00);
					var od_ll_4 = randomNumberFromRange(20.00, 25.00);
					var od_ll_5 = randomNumberFromRange(20.00, 25.00);
					
					var con_ll_1 = randomNumberFromRange(25.01, 30.00);
					var con_ll_2 = randomNumberFromRange(25.01, 30.00);
					var con_ll_3 = randomNumberFromRange(25.01, 30.00);
					var con_ll_4 = randomNumberFromRange(25.01, 30.00);
					var con_ll_5 = randomNumberFromRange(25.01, 30.00);
				
					var wtr_ll_1 = (parseFloat(mc_ll_1)*parseFloat(od_ll_1))/100;
					var wtr_ll_2 = (parseFloat(mc_ll_2)*parseFloat(od_ll_2))/100;
					var wtr_ll_3 = (parseFloat(mc_ll_3)*parseFloat(od_ll_3))/100;
					var wtr_ll_4 = (parseFloat(mc_ll_4)*parseFloat(od_ll_4))/100;
					var wtr_ll_5 = (parseFloat(mc_ll_5)*parseFloat(od_ll_5))/100;
			
					var wt_ll_1 = parseFloat(wtr_ll_1)+parseFloat(con_ll_1)+parseFloat(od_ll_1);
					var wt_ll_2 = parseFloat(wtr_ll_2)+parseFloat(con_ll_2)+parseFloat(od_ll_2);
					var wt_ll_3 = parseFloat(wtr_ll_3)+parseFloat(con_ll_3)+parseFloat(od_ll_3);
					var wt_ll_4 = parseFloat(wtr_ll_4)+parseFloat(con_ll_4)+parseFloat(od_ll_4);
					var wt_ll_5 = parseFloat(wtr_ll_5)+parseFloat(con_ll_5)+parseFloat(od_ll_5);
					
					var dy_ll_1 = parseFloat(wt_ll_1)-parseFloat(wtr_ll_1);
					var dy_ll_2 = parseFloat(wt_ll_2)-parseFloat(wtr_ll_2);
					var dy_ll_3 = parseFloat(wt_ll_3)-parseFloat(wtr_ll_3);
					var dy_ll_4 = parseFloat(wt_ll_4)-parseFloat(wtr_ll_4);
					var dy_ll_5 = parseFloat(wt_ll_5)-parseFloat(wtr_ll_5);

					var avg_ll = (parseFloat(mc_ll_1)+parseFloat(mc_ll_2)+parseFloat(mc_ll_4)+parseFloat(mc_ll_5))/4;

					$('#liquide_limit').val(liquide_limit.toFixed(2));
					$('#avg_ll').val(avg_ll.toFixed(2));
					$('#p_ll_1').val(p_ll_1.toFixed(0));
					$('#p_ll_2').val(p_ll_2.toFixed(0));
					$('#p_ll_3').val(p_ll_3.toFixed(0));
					$('#p_ll_4').val(p_ll_4.toFixed(0));
					$('#p_ll_5').val(p_ll_5.toFixed(0));
					$('#mc_ll_1').val(mc_ll_1.toFixed(2));
					$('#mc_ll_2').val(mc_ll_2.toFixed(2));
					$('#mc_ll_3').val(mc_ll_3.toFixed(2));
					$('#mc_ll_4').val(mc_ll_4.toFixed(2));
					$('#mc_ll_5').val(mc_ll_5.toFixed(2));
					var p_pl_1,p_pl_2,p_pl_3,cn_ll_1,cn_ll_2,cn_ll_3,cn_ll_4,cn_ll_5,cn_pl_1,cn_pl_2,cn_pl_3;	
					$('#p_pl_1').val(p_pl_1);
					$('#p_pl_2').val(p_pl_2);
					$('#p_pl_3').val(p_pl_3);

					$('#cn_ll_1').val(cn_ll_1);
					$('#cn_ll_2').val(cn_ll_2);
					$('#cn_ll_3').val(cn_ll_3);
					$('#cn_ll_4').val(cn_ll_4);
					$('#cn_ll_5').val(cn_ll_5);

					$('#cn_pl_1').val(cn_pl_1);
					$('#cn_pl_2').val(cn_pl_2);
					$('#cn_pl_3').val(cn_pl_3);
					
					$('#wt_ll_1').val(wt_ll_1.toFixed(2));
					$('#wt_ll_2').val(wt_ll_2.toFixed(2));
					$('#wt_ll_3').val(wt_ll_3.toFixed(2));
					$('#wt_ll_4').val(wt_ll_4.toFixed(2));
					$('#wt_ll_5').val(wt_ll_5.toFixed(2));

					$('#dy_ll_1').val(dy_ll_1.toFixed(2));
					$('#dy_ll_2').val(dy_ll_2.toFixed(2));
					$('#dy_ll_3').val(dy_ll_3.toFixed(2));
					$('#dy_ll_4').val(dy_ll_4.toFixed(2));
					$('#dy_ll_5').val(dy_ll_5.toFixed(2));

					$('#wtr_ll_1').val(wtr_ll_1.toFixed(2));
					$('#wtr_ll_2').val(wtr_ll_2.toFixed(2));
					$('#wtr_ll_3').val(wtr_ll_3.toFixed(2));
					$('#wtr_ll_4').val(wtr_ll_4.toFixed(2));
					$('#wtr_ll_5').val(wtr_ll_5.toFixed(2));

					$('#con_ll_1').val(con_ll_1.toFixed(2));
					$('#con_ll_2').val(con_ll_2.toFixed(2));
					$('#con_ll_3').val(con_ll_3.toFixed(2));
					$('#con_ll_4').val(con_ll_4.toFixed(2));
					$('#con_ll_5').val(con_ll_5.toFixed(2));

					$('#od_ll_1').val(od_ll_1.toFixed(2));
					$('#od_ll_2').val(od_ll_2.toFixed(2));
					$('#od_ll_3').val(od_ll_3.toFixed(2));
					$('#od_ll_4').val(od_ll_4.toFixed(2));
					$('#od_ll_5').val(od_ll_5.toFixed(2));

					
					var chk_pl = randomNumberFromRange(4.00, 6.00);
					$('#chk_pl').val(chk_pl.toFixed(2));
					
					var plastic_limit = parseFloat(liquide_limit)-parseFloat(chk_pl);
					var avg_pl = plastic_limit;
					$('#avg_pl').val(avg_pl.toFixed(2));
					$('#plastic_limit').val(plastic_limit.toFixed(2));
					
					var mc_pl_1  = parseFloat(avg_pl) + randomNumberFromRange(0.50, -0.50);
					var mc_pl_2  = parseFloat(avg_pl) + randomNumberFromRange(0.50, -0.50);
					var abc  = parseFloat(mc_pl_1)+parseFloat(mc_pl_2);
					var mc_pl_3  = (parseFloat(avg_pl)*3) - abc;
				
					var od_pl_1 = randomNumberFromRange(20.00, 25.00);
					var od_pl_2 = randomNumberFromRange(20.00, 25.00);
					var od_pl_3 = randomNumberFromRange(20.00, 25.00);

					var con_pl_1 = randomNumberFromRange(26.00, 30.00);
					var con_pl_2 = randomNumberFromRange(26.00, 30.00);
					var con_pl_3 = randomNumberFromRange(26.00, 30.00);

					var wtr_pl_1 = (parseFloat(mc_pl_1)*parseFloat(od_pl_1))/100;
					var wtr_pl_2 = (parseFloat(mc_pl_2)*parseFloat(od_pl_2))/100;
					var wtr_pl_3 = (parseFloat(mc_pl_3)*parseFloat(od_pl_3))/100;
					
					var wt_pl_1 = parseFloat(wtr_pl_1)+parseFloat(con_pl_1)+parseFloat(od_pl_1);
					var wt_pl_2 = parseFloat(wtr_pl_2)+parseFloat(con_pl_2)+parseFloat(od_pl_2);
					var wt_pl_3 = parseFloat(wtr_pl_3)+parseFloat(con_pl_3)+parseFloat(od_pl_3);
					
					var dy_pl_1 = parseFloat(wt_pl_1)-parseFloat(wtr_pl_1);
					var dy_pl_2 = parseFloat(wt_pl_2)-parseFloat(wtr_pl_2);
					var dy_pl_3 = parseFloat(wt_pl_3)-parseFloat(wtr_pl_3);
					
					
					$('#wt_pl_1').val(wt_pl_1.toFixed(2));
					$('#wt_pl_2').val(wt_pl_2.toFixed(2));
					$('#wt_pl_3').val(wt_pl_3.toFixed(2));

					

					$('#dy_pl_1').val(dy_pl_1.toFixed(2));
					$('#dy_pl_2').val(dy_pl_2.toFixed(2));
					$('#dy_pl_3').val(dy_pl_3.toFixed(2));

					

					$('#wtr_pl_1').val(wtr_pl_1.toFixed(2));
					$('#wtr_pl_2').val(wtr_pl_2.toFixed(2));
					$('#wtr_pl_3').val(wtr_pl_3.toFixed(2));

					

					$('#con_pl_1').val(con_pl_1.toFixed(2));
					$('#con_pl_2').val(con_pl_2.toFixed(2));
					$('#con_pl_3').val(con_pl_3.toFixed(2));

					

					$('#od_pl_1').val(od_pl_1.toFixed(2));
					$('#od_pl_2').val(od_pl_2.toFixed(2));
					$('#od_pl_3').val(od_pl_3.toFixed(2));
					
					

					$('#mc_pl_1').val(mc_pl_1.toFixed(2));
					$('#mc_pl_2').val(mc_pl_2.toFixed(2));
					$('#mc_pl_3').val(mc_pl_3.toFixed(2));
					


					
				
			
		}
		else
		{
					$('#avg_ll').val(null);
					$('#avg_pl').val(null);
						
					$('#chk_pl').val(null);
					$('#plastic_limit').val(null);
					$('#liquide_limit').val(null);
				

					$('#p_ll_1').val(null);
					$('#p_ll_2').val(null);
					$('#p_ll_3').val(null);
					$('#p_ll_4').val(null);
					$('#p_ll_5').val(null);

					$('#p_pl_1').val(null);
					$('#p_pl_2').val(null);
					$('#p_pl_3').val(null);

					$('#cn_ll_1').val(null);
					$('#cn_ll_2').val(null);
					$('#cn_ll_3').val(null);
					$('#cn_ll_4').val(null);
					$('#cn_ll_5').val(null);

					$('#cn_pl_1').val(null);
					$('#cn_pl_2').val(null);
					$('#cn_pl_3').val(null);

					$('#wt_ll_1').val(null);
					$('#wt_ll_2').val(null);
					$('#wt_ll_3').val(null);
					$('#wt_ll_4').val(null);
					$('#wt_ll_5').val(null);

					$('#wt_pl_1').val(null);
					$('#wt_pl_2').val(null);
					$('#wt_pl_3').val(null);

					$('#dy_ll_1').val(null);
					$('#dy_ll_2').val(null);
					$('#dy_ll_3').val(null);
					$('#dy_ll_5').val(null);
					$('#dy_ll_4').val(null);

					$('#dy_pl_1').val(null);
					$('#dy_pl_2').val(null);
					$('#dy_pl_3').val(null);

					$('#wtr_ll_1').val(null);
					$('#wtr_ll_2').val(null);
					$('#wtr_ll_3').val(null);
					$('#wtr_ll_4').val(null);
					$('#wtr_ll_5').val(null);

					$('#wtr_pl_1').val(null);
					$('#wtr_pl_2').val(null);
					$('#wtr_pl_3').val(null);

					$('#con_ll_1').val(null);
					$('#con_ll_2').val(null);
					$('#con_ll_3').val(null);
					$('#con_ll_4').val(null);
					$('#con_ll_5').val(null);

					$('#con_pl_1').val(null);
					$('#con_pl_2').val(null);
					$('#con_pl_3').val(null);

					$('#od_ll_1').val(null);
					$('#od_ll_2').val(null);
					$('#od_ll_3').val(null);
					$('#od_ll_4').val(null);
					$('#od_ll_5').val(null);

					$('#od_pl_1').val(null);
					$('#od_pl_2').val(null);
					$('#od_pl_3').val(null);
					
					$('#mc_ll_1').val(null);
					$('#mc_ll_2').val(null);
					$('#mc_ll_3').val(null);
					$('#mc_ll_4').val(null);
					$('#mc_ll_5	').val(null);

					$('#mc_pl_1').val(null);
					$('#mc_pl_2').val(null);
					$('#mc_pl_3').val(null);
		}
	});

	$('#chk_mdd').change(function(){
        if(this.checked)
		{ 
			var m11 = "";	
			var m12 = "";
			var m13 = "";
			var m14 = "";
			var m15 = "";
			var m16 = "";

			var t =  randomNumberFromRange(1,10);
			if(t%2==0)
			{
				var m76 = randomNumberFromRange(6.00,8.00);
				var m72 = parseFloat(m76)-randomNumberFromRange(1.00,1.50);
				var m71 = parseFloat(m72)-randomNumberFromRange(1.00,1.50);
				var tm1 = parseFloat(m76)-parseFloat(m72);
				var tm2 = parseFloat(m76)-parseFloat(m71);
				var m73 = parseFloat(m76)+parseFloat(tm1);
				var m74 = parseFloat(m76)+parseFloat(tm2);
				var m75 = parseFloat(m76)+randomNumberFromRange(1.00,1.50);

				var d76 = randomNumberFromRange(2.00,3.00);
				var d72 = parseFloat(d76)-randomNumberFromRange(0.01,0.03);
				var d71 = parseFloat(d72)-randomNumberFromRange(0.01,0.03);
				var dm1 = parseFloat(d76)-parseFloat(d72);
				var dm2 = parseFloat(d76)-parseFloat(d71);
				var d73 = parseFloat(d76)+parseFloat(dm1);
				var d74 = parseFloat(d76)+parseFloat(dm2);
				var d75 = parseFloat(d76)+randomNumberFromRange(0.01,0.03);

			}
			else
			{
				var m76 = randomNumberFromRange(6.00,8.00);
				var m73 = parseFloat(m76)-randomNumberFromRange(1.00,1.50);
				var m72 = parseFloat(m73)-randomNumberFromRange(1.00,1.50);
				var m71 = parseFloat(m72)-randomNumberFromRange(1.00,1.50);
				var tm1 = parseFloat(m76)-parseFloat(m73);
				var tm2 = parseFloat(m76)-parseFloat(m72);
				var m74 = parseFloat(m76)+parseFloat(tm1);
				var m75 = parseFloat(m76)+parseFloat(tm2);

				var d76 = randomNumberFromRange(2.00,3.00);
				var d73 = parseFloat(d76)-randomNumberFromRange(0.01,0.03);
				var d72 = parseFloat(d73)-randomNumberFromRange(0.01,0.03);
				var d71 = parseFloat(d72)-randomNumberFromRange(0.01,0.03);
				var dm1 = parseFloat(d76)-parseFloat(d73);
				var dm2 = parseFloat(d76)-parseFloat(d72);
				var d74 = parseFloat(d76)+parseFloat(dm1);
				var d75 = parseFloat(d76)+parseFloat(dm2);
				
			}

				
			var omc = m76;
			var m51 = randomNumberFromRange(25.00,35.00);
			var m52 = randomNumberFromRange(25.00,35.00);
			var m53 = randomNumberFromRange(25.00,35.00);
			var m54 = randomNumberFromRange(25.00,35.00);
			var m55 = randomNumberFromRange(25.00,35.00);
			var m56 = randomNumberFromRange(25.00,35.00);

			var m41 = randomNumberFromRange(5.00,10.00);
			var m42 = randomNumberFromRange(5.00,10.00);
			var m43 = randomNumberFromRange(5.00,10.00);
			var m44 = randomNumberFromRange(5.00,10.00);
			var m45 = randomNumberFromRange(5.00,10.00);
			var m46 = randomNumberFromRange(5.00,10.00);

			var m21 = parseFloat(m51)+randomNumberFromRange(50.00,70.00);
			var m22 = parseFloat(m52)+randomNumberFromRange(50.00,70.00);
			var m23 = parseFloat(m53)+randomNumberFromRange(50.00,70.00);
			var m24 = parseFloat(m54)+randomNumberFromRange(50.00,70.00);
			var m25 = parseFloat(m55)+randomNumberFromRange(50.00,70.00);
			var m26 = parseFloat(m56)+randomNumberFromRange(50.00,70.00);

			var m31 = parseFloat(m41)+parseFloat(m21);
			var m32 = parseFloat(m42)+parseFloat(m22);
			var m33 = parseFloat(m43)+parseFloat(m23);
			var m34 = parseFloat(m44)+parseFloat(m24);
			var m35 = parseFloat(m45)+parseFloat(m25);
			var m36 = parseFloat(m46)+parseFloat(m26);

			var m61 = parseFloat(m31)-parseFloat(m51);
			var m62 = parseFloat(m32)-parseFloat(m52);
			var m63 = parseFloat(m33)-parseFloat(m53);
			var m64 = parseFloat(m34)-parseFloat(m54);
			var m65 = parseFloat(m35)-parseFloat(m55);
			var m66 = parseFloat(m36)-parseFloat(m56);


			var d61 =m71;
			var d62 =m72;
			var d63 =m73;
			var d64 =m74;
			var d65 =m75;
			var d66 =m76;

			var d51 = (parseFloat(d71)*(100+parseFloat(d61)))/100;
			var d52 = (parseFloat(d72)*(100+parseFloat(d62)))/100;
			var d53 = (parseFloat(d73)*(100+parseFloat(d63)))/100;
			var d54 = (parseFloat(d74)*(100+parseFloat(d64)))/100;
			var d55 = (parseFloat(d75)*(100+parseFloat(d65)))/100;
			var d56 = (parseFloat(d76)*(100+parseFloat(d66)))/100;

			var d31 = parseFloat(d51)*2250;
			var d32 = parseFloat(d52)*2250;
			var d33 = parseFloat(d53)*2250;
			var d34 = parseFloat(d54)*2250;
			var d35 = parseFloat(d55)*2250;
			var d36 = parseFloat(d56)*2250;

			var d41 = randomNumberFromRange(4,4);
			var d42 = randomNumberFromRange(6,6);
			var d43 = randomNumberFromRange(8,8);
			var d44 = randomNumberFromRange(10,10);
			var d45 = randomNumberFromRange(14,14);
			var d46 = randomNumberFromRange(16,16);

			var d21 = 6210;
			var d22 = 6210;
			var d23 = 6210;
			var d24 = 6210;
			var d25 = 6210;
			var d26 = 6210;

			var d11 = parseFloat(d21)+parseFloat(d31);
			var d12 = parseFloat(d22)+parseFloat(d32);
			var d13 = parseFloat(d23)+parseFloat(d33);
			var d14 = parseFloat(d24)+parseFloat(d34);
			var d15 = parseFloat(d25)+parseFloat(d35);
			var d16 = parseFloat(d26)+parseFloat(d36);

			
			var mdd = d76;
			
			$('#omc').val(omc.toFixed(2));
			$('#mdd').val(mdd.toFixed(2));
	
			$('#m11').val(m11);
			$('#m12').val(m12);
			$('#m13').val(m13);
			$('#m14').val(m14);
			$('#m15').val(m15);
			$('#m16').val(m16);

			$('#m21').val(m21.toFixed(2));
			$('#m22').val(m22.toFixed(2));
			$('#m23').val(m23.toFixed(2));
			$('#m24').val(m24.toFixed(2));
			$('#m25').val(m25.toFixed(2));
			$('#m26').val(m26.toFixed(2));

			$('#m31').val(m31.toFixed(2));
			$('#m32').val(m32.toFixed(2));
			$('#m33').val(m33.toFixed(2));
			$('#m34').val(m34.toFixed(2));
			$('#m35').val(m35.toFixed(2));
			$('#m36').val(m36.toFixed(2));

			$('#m41').val(m41.toFixed(2));
			$('#m42').val(m42.toFixed(2));
			$('#m43').val(m43.toFixed(2));
			$('#m44').val(m44.toFixed(2));
			$('#m45').val(m45.toFixed(2));
			$('#m46').val(m46.toFixed(2));

			$('#m51').val(m51.toFixed(2));
			$('#m52').val(m52.toFixed(2));
			$('#m53').val(m53.toFixed(2));
			$('#m54').val(m54.toFixed(2));
			$('#m55').val(m55.toFixed(2));
			$('#m56').val(m56.toFixed(2));

			$('#m61').val(m61.toFixed(2));
			$('#m62').val(m62.toFixed(2));
			$('#m63').val(m63.toFixed(2));
			$('#m64').val(m64.toFixed(2));
			$('#m65').val(m65.toFixed(2));
			$('#m66').val(m66.toFixed(2));

			$('#m71').val(m71.toFixed(2));
			$('#m72').val(m72.toFixed(2));
			$('#m73').val(m73.toFixed(2));
			$('#m74').val(m74.toFixed(2));
			$('#m75').val(m75.toFixed(2));
			$('#m76').val(m76.toFixed(2));

			$('#d11').val(d11.toFixed(2));
			$('#d12').val(d12.toFixed(2));
			$('#d13').val(d13.toFixed(2));
			$('#d14').val(d14.toFixed(2));
			$('#d15').val(d15.toFixed(2));
			$('#d16').val(d16.toFixed(2));

			$('#d21').val(d21.toFixed(2));
			$('#d22').val(d22.toFixed(2));
			$('#d23').val(d23.toFixed(2));
			$('#d24').val(d24.toFixed(2));
			$('#d25').val(d25.toFixed(2));
			$('#d26').val(d26.toFixed(2));

			$('#d31').val(d31.toFixed(2));
			$('#d32').val(d32.toFixed(2));
			$('#d33').val(d33.toFixed(2));
			$('#d34').val(d34.toFixed(2));
			$('#d35').val(d35.toFixed(2));
			$('#d36').val(d36.toFixed(2));

			$('#d41').val(d41.toFixed(2));
			$('#d42').val(d42.toFixed(2));
			$('#d43').val(d43.toFixed(2));
			$('#d44').val(d44.toFixed(2));
			$('#d45').val(d45.toFixed(2));
			$('#d46').val(d46.toFixed(2));

			$('#d51').val(d51.toFixed(2));
			$('#d52').val(d52.toFixed(2));
			$('#d53').val(d53.toFixed(2));
			$('#d54').val(d54.toFixed(2));
			$('#d55').val(d55.toFixed(2));
			$('#d56').val(d56.toFixed(2));

			$('#d61').val(d61.toFixed(2));
			$('#d62').val(d62.toFixed(2));
			$('#d63').val(d63.toFixed(2));
			$('#d64').val(d64.toFixed(2));
			$('#d65').val(d65.toFixed(2));
			$('#d66').val(d66.toFixed(2));

			$('#d71').val(d71.toFixed(2));
			$('#d72').val(d72.toFixed(2));
			$('#d73').val(d73.toFixed(2));
			$('#d74').val(d74.toFixed(2));
			$('#d75').val(d75.toFixed(2));
			$('#d76').val(d76.toFixed(2));
		}
		else
		{	
			$('#m11').val(null);
			$('#m12').val(null);
			$('#m13').val(null);
			$('#m14').val(null);
			$('#m15').val(null);
			$('#m16').val(null);

			$('#m21').val(null);
			$('#m22').val(null);
			$('#m23').val(null);
			$('#m24').val(null);
			$('#m25').val(null);
			$('#m26').val(null);

			$('#m31').val(null);
			$('#m32').val(null);
			$('#m33').val(null);
			$('#m34').val(null);
			$('#m35').val(null);
			$('#m36').val(null);

			$('#m41').val(null);
			$('#m42').val(null);
			$('#m43').val(null);
			$('#m44').val(null);
			$('#m45').val(null);
			$('#m46').val(null);

			$('#m51').val(null);
			$('#m52').val(null);
			$('#m53').val(null);
			$('#m54').val(null);
			$('#m55').val(null);
			$('#m56').val(null);

			$('#m61').val(null);
			$('#m62').val(null);
			$('#m63').val(null);
			$('#m64').val(null);
			$('#m65').val(null);
			$('#m66').val(null);

			$('#m71').val(null);
			$('#m72').val(null);
			$('#m73').val(null);
			$('#m74').val(null);
			$('#m75').val(null);
			$('#m76').val(null);
			$('#omc').val(null);
			$('#mdd').val(null);

			$('#d11').val(null);
			$('#d12').val(null);
			$('#d13').val(null);
			$('#d14').val(null);
			$('#d15').val(null);
			$('#d16').val(null);

			$('#d21').val(null);
			$('#d22').val(null);
			$('#d23').val(null);
			$('#d24').val(null);
			$('#d25').val(null);
			$('#d26').val(null);

			$('#d31').val(null);
			$('#d32').val(null);
			$('#d33').val(null);
			$('#d34').val(null);
			$('#d35').val(null);
			$('#d36').val(null);

			$('#d41').val(null);
			$('#d42').val(null);
			$('#d43').val(null);
			$('#d44').val(null);
			$('#d45').val(null);
			$('#d46').val(null);

			$('#d51').val(null);
			$('#d52').val(null);
			$('#d53').val(null);
			$('#d54').val(null);
			$('#d55').val(null);
			$('#d56').val(null);

			$('#d61').val(null);
			$('#d62').val(null);
			$('#d63').val(null);
			$('#d64').val(null);
			$('#d65').val(null);
			$('#d66').val(null);

			$('#d71').val(null);
			$('#d72').val(null);
			$('#d73').val(null);
			$('#d74').val(null);
			$('#d75').val(null);
			$('#d76').val(null);


			
		}	
	});
	
	
	var fines_value;
	$('#chk_fines').change(function(){
        if(this.checked)
		{
           
			fines_value = randomNumberFromRange(10.00, 20.00);            
            $('#fines_value').val(fines_value.toFixed(2));
			
		}
        else
		{
            $('#fines_value').val(null);
			
		}

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
	
	
	var stripping_value;
	$('#chk_strip').change(function(){
        if(this.checked)
		{
           
			stripping_value = randomNumberFromRange(10.00, 20.00);            
            $('#stripping_value').val(stripping_value.toFixed(2));
			
		}
        else
		{
            $('#stripping_value').val(null);
			
		}

    });
	
	
	});


function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}


$("#btn_auto").click(function(){
		//alert("Estimate Your Bill Successfully");
		
		var alkali_value = randomNumberFromRange(10.00, 20.00);
		var fines_value = randomNumberFromRange(10.00, 20.00);  
		var stripping_value = randomNumberFromRange(10.00, 20.00);  
		$('#stripping_value').val(stripping_value.toFixed(2));
		$('#fines_value').val(fines_value.toFixed(2));
		$('#alkali_value').val(alkali_value.toFixed(2));
		
		
	var minNumber = -100;
	var maxNumber = 40;
	sp_sample_ca = "25 - 90 HB MM";
	sieve_1="63";	
	sieve_2="53";	
	sieve_3="45";	
	sieve_4="22.4";	
	sieve_5="11.2";		
 	//SPECIFIC GRAVITY CALCULATION
	var sp_w_b_a1_1 = randomNumberFromRange(2085.00, 2115.00);	
	var sp_w_b_a2_1 = randomNumberFromRange(799.00,800.00);	
	var sp_w_sur_1 = randomNumberFromRange(2010.00,2011.00);
	var sp_w_s_1 = randomNumberFromRange(1994.00,1999.00);	
	
	sp_wt_st_1 = parseFloat(sp_w_b_a1_1) - parseFloat(sp_w_b_a2_1);
	sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_w_sur_1)-parseFloat(sp_wt_st_1));
	sp_water_abr_1 = (100*(parseFloat(sp_w_sur_1)-parseFloat(sp_w_s_1)))/parseFloat(sp_w_s_1);
	
	/*alert(sp_w_b_a1_1);
	alert(sp_w_b_a2_1);
	alert(sp_w_sur_1);
	alert(sp_w_s_1);
	alert(sp_wt_st_1);
	alert(sp_specific_gravity_1);
	alert(sp_water_abr_1);*/
	
	
	 sp_w_b_a1_2 = randomNumberFromRange(2085.00, 2115.00);	
	 sp_w_b_a2_2 = randomNumberFromRange(799.00,800.00);	
	 sp_w_sur_2 = randomNumberFromRange(2010.00,2011.00);
	 sp_w_s_2 = randomNumberFromRange(1994.00,1999.00);	
	
	 sp_wt_st_2 = parseFloat(sp_w_b_a1_2) - parseFloat(sp_w_b_a2_2);
	 sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_2)-parseFloat(sp_wt_st_2));
	 sp_water_abr_2 = (100*(parseFloat(sp_w_sur_2)-parseFloat(sp_w_s_2)))/parseFloat(sp_w_s_2);
	
	/*alert(sp_w_b_a1_2);
	alert(sp_w_b_a2_2);
	alert(sp_w_sur_2);
	alert(sp_w_s_2);
	alert(sp_wt_st_2);
	alert(sp_specific_gravity_2);
	alert(sp_water_abr_2);*/
	
	var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
	var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;
	
	
/*	alert(sp_specific_gravity);
	alert(sp_water_abr);*/
	
		$('#sp_w_b_a1_1').val(sp_w_b_a1_1.toFixed(0));
			$('#sp_w_b_a2_1').val(sp_w_b_a2_1.toFixed(2));
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(2));
			$('#sp_w_s_1').val(sp_w_s_1.toFixed(2));
			$('#sp_wt_st_1').val(sp_wt_st_1.toFixed(0));
			
			$('#sp_w_b_a1_2').val(sp_w_b_a1_2.toFixed(0));
			$('#sp_w_b_a2_2').val(sp_w_b_a2_2.toFixed(2));
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(2));
			$('#sp_w_s_2').val(sp_w_s_2.toFixed(2));
			$('#sp_wt_st_2').val(sp_wt_st_2.toFixed(0));
								
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
			$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
			$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
			$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
			$('#sp_water_abr').val(sp_water_abr.toFixed(2));
			$('#sp_sample_ca').val(sp_sample_ca);
	
	
	//ABRASION INDEX
    abr_sample_abr = "25 - 90 HB MM";
	var abr_wt_t_a_1 = randomNumberFromRange(5000,5000);
	var abr_index = randomNumberFromRange(10.00,20.00);
	var abr_wt_t_c_1 = ((parseFloat(abr_wt_t_a_1)*parseFloat(abr_index))/100);
    var abr_wt_t_b_1 = parseFloat(abr_wt_t_a_1) - parseFloat(abr_wt_t_c_1);
	
	$('#abr_index').val(abr_index.toFixed(2));
    $('#abr_wt_t_a_1').val(abr_wt_t_a_1.toFixed(0));
    $('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed(2));
    $('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
    $('#abr_sample_abr').val(abr_sample_abr);
	
	
	//IMPACT VALUE
	 imp_value_1 = randomNumberFromRange(10.00,20.00);
	var imp_w_m_a_1 = randomNumberFromRange(320,340);
	var imp_w_m_b_1 =  ((parseFloat(imp_w_m_a_1)*parseFloat(imp_value_1))/100);
	var imp_w_m_c_1 = (parseFloat(imp_w_m_a_1) - parseFloat(imp_w_m_b_1));
	
     imp_value_2 = imp_value_1 + randomNumberFromRange(-0.50,0.50);
	 imp_w_m_a_2 = randomNumberFromRange(320,340);
	 imp_w_m_b_2 =  ((parseFloat(imp_w_m_a_2)*parseFloat(imp_value_2))/100);
	 imp_w_m_c_2 = (parseFloat(imp_w_m_a_2) - parseFloat(imp_w_m_b_2));
	
	var imp_value = (parseFloat(imp_value_1)+parseFloat(imp_value_2))/2;	
	
	$('#imp_w_m_a_1').val(imp_w_m_a_1.toFixed(0));
    $('#imp_w_m_b_1').val(imp_w_m_b_1.toFixed(2));
    $('#imp_w_m_c_1').val(imp_w_m_c_1.toFixed(2));
	$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(0));
    $('#imp_w_m_b_2').val(imp_w_m_b_2.toFixed(2));
    $('#imp_w_m_c_2').val(imp_w_m_c_2.toFixed(2));
    $('#imp_value').val(imp_value.toFixed(2));
    $('#imp_value_1').val(imp_value_1.toFixed(2));
    $('#imp_value_2').val(imp_value_2.toFixed(2));
	
	
	
	
	
	
				
					var sample_taken=50000;
					//PASSING RANGE
					var pass_sample_1 = randomNumberFromRange(100, 100);
					var pass_sample_2 = randomNumberFromRange(90,100);
					var pass_sample_3 = randomNumberFromRange(25,75);
					var pass_sample_4 = randomNumberFromRange(0,15);
					var pass_sample_5 = randomNumberFromRange(0,5);
					
					
					//(100 - PASSING SAMPLE)
					var cum_ret_1 = 100-parseFloat(pass_sample_1);
					var cum_ret_2 = 100-parseFloat(pass_sample_2);
					var cum_ret_3 = 100-parseFloat(pass_sample_3);
					var cum_ret_4 = 100-parseFloat(pass_sample_4);
					var cum_ret_5 = 100-parseFloat(pass_sample_5);
					
					
					
					//(CUMRET*100)
					var ret_wt_gm_1 = (parseFloat(cum_ret_1)*parseFloat(sample_taken))/100;
					var ret_wt_gm_2 = (parseFloat(cum_ret_2)*parseFloat(sample_taken))/100;
					var ret_wt_gm_3 = (parseFloat(cum_ret_3)*parseFloat(sample_taken))/100;
					var ret_wt_gm_4 = (parseFloat(cum_ret_4)*parseFloat(sample_taken))/100;
					var ret_wt_gm_5 = (parseFloat(cum_ret_5)*parseFloat(sample_taken))/100;
					
					
					//MINUS PLUS
					var cum_wt_gm_1 = ret_wt_gm_1;
					var cum_wt_gm_2 = parseFloat(ret_wt_gm_2)-parseFloat(ret_wt_gm_1);
					var cum_wt_gm_3 = parseFloat(ret_wt_gm_3)-parseFloat(ret_wt_gm_2);
					var cum_wt_gm_4 = parseFloat(ret_wt_gm_4)-parseFloat(ret_wt_gm_3);
					var cum_wt_gm_5 = parseFloat(ret_wt_gm_5)-parseFloat(ret_wt_gm_4);
					
					
					
					//(SUM OF CUM. WAIGHT)
					var blank_extra = parseFloat(cum_wt_gm_1)+parseFloat(cum_wt_gm_2)+parseFloat(cum_wt_gm_3)+parseFloat(cum_wt_gm_4)+parseFloat(cum_wt_gm_5);
					$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
					$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
					$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
					$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));
					$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed(0));
					
					 
					$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
					$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
					$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
					$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));
					$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed(0));
					
					
					
					$('#cum_ret_1').val(cum_ret_1.toFixed(0));
					$('#cum_ret_2').val(cum_ret_2.toFixed(2));
					$('#cum_ret_3').val(cum_ret_3.toFixed(2));
					$('#cum_ret_4').val(cum_ret_4.toFixed(2));
					$('#cum_ret_5').val(cum_ret_5.toFixed(2));
					
				   
					$('#pass_sample_1').val(pass_sample_1.toFixed(0));
					$('#pass_sample_2').val(pass_sample_2.toFixed(2));
					$('#pass_sample_3').val(pass_sample_3.toFixed(2));
					$('#pass_sample_4').val(pass_sample_4.toFixed(2));
					$('#pass_sample_5').val(pass_sample_5.toFixed(2));
					
				  
					 $('#blank_extra').val(blank_extra.toFixed(0));
					 $('#sample_taken').val(sample_taken.toFixed(0));


    
  /*
    //FLANKINESS INDEX	   
    $('#fi_index').val(fi_index.toFixed(2));
    $('#ei_index').val(ei_index.toFixed(2));*/
	a1=randomNumberFromRange(3605, 3645);
	a2=randomNumberFromRange(3280, 3320);
	a3=randomNumberFromRange(2080, 2120);
	a4=randomNumberFromRange(2080, 2120);
	a5=randomNumberFromRange(2080, 2120);
	
	suma = parseInt(a1)+parseInt(a2)+parseInt(a3);
	
	b1=randomNumberFromRange(385, 425);
	b2=randomNumberFromRange(185, 225);
	b3=randomNumberFromRange(150, 190);
	b4=randomNumberFromRange(150, 190);
	b5=randomNumberFromRange(150, 190);

	sumb = parseInt(b1)+parseInt(b2)+parseInt(b3)+parseInt(b4)+parseInt(b5);
	
	c1 = (parseInt(b1)/parseInt(a1))*100; 
	c2 = (parseInt(b2)/parseInt(a2))*100;
	c3 = (parseInt(b3)/parseInt(a3))*100;
	c4 = (parseInt(b4)/parseInt(a4))*100;
	c5 = (parseInt(b5)/parseInt(a5))*100;
	
	d1 = (parseInt(a1)/parseInt(suma))*100;
	d2 = (parseInt(a2)/parseInt(suma))*100;
	d3 = (parseInt(a3)/parseInt(suma))*100;
	d4 = (parseInt(a4)/parseInt(suma))*100;
	d5 = (parseInt(a5)/parseInt(suma))*100;
	
	 
	e1 = (parseFloat(c1)*parseFloat(d1))/100;
	e2 = (parseFloat(c2)*parseFloat(d2))/100;
	e3 = (parseFloat(c3)*parseFloat(d3))/100;
	e4 = (parseFloat(c4)*parseFloat(d4))/100;
	e5 = (parseFloat(c5)*parseFloat(d5))/100;

	
	fi_index = parseFloat(e1)+parseFloat(e2)+parseFloat(e3)+parseFloat(e4)+parseFloat(e5);
	
	//ELONGATION INDEX
	aa1=randomNumberFromRange(3600, 3640);
	aa2=randomNumberFromRange(3300, 3340);
	aa3=randomNumberFromRange(2130, 2170);
	aa4=randomNumberFromRange(2130, 2170);
	aa5=randomNumberFromRange(2130, 2170);
	sumaa = parseInt(aa1)+parseInt(aa2)+parseInt(aa3)+parseInt(aa4)+parseInt(aa5);
	
	bb1=randomNumberFromRange(390, 430);
	bb2=randomNumberFromRange(190, 230);
	bb3=randomNumberFromRange(155, 195);
	bb4=randomNumberFromRange(155, 195);
	bb5=randomNumberFromRange(155, 195);
	sumbb = parseInt(bb1)+parseInt(bb2)+parseInt(bb3)+parseInt(bb4)+parseInt(bb5);
	
	cc1 = (parseInt(bb1)/parseInt(aa1))*100;
	cc2 = (parseInt(bb2)/parseInt(aa2))*100;
	cc3 = (parseInt(bb3)/parseInt(aa3))*100;
	cc4 = (parseInt(bb4)/parseInt(aa4))*100;
	cc5 = (parseInt(bb5)/parseInt(aa5))*100;
	
	dd1 = (parseInt(aa1)/parseInt(sumaa))*100;
	dd2 = (parseInt(aa2)/parseInt(sumaa))*100;
	dd3 = (parseInt(aa3)/parseInt(sumaa))*100;
	dd4 = (parseInt(aa4)/parseInt(sumaa))*100;
	dd5 = (parseInt(aa5)/parseInt(sumaa))*100;
	
	ee1 = (parseFloat(cc1)*parseFloat(dd1))/100;
	ee2 = (parseFloat(cc2)*parseFloat(dd2))/100;
	ee3 = (parseFloat(cc3)*parseFloat(dd3))/100;
	ee4 = (parseFloat(cc4)*parseFloat(dd4))/100;
	ee5 = (parseFloat(cc5)*parseFloat(dd5))/100;
	
	ei_index = parseFloat(ee1)+parseFloat(ee2)+parseFloat(ee3)+parseFloat(ee4)+parseFloat(ee5);
   
			$('#a1').val(a1.toFixed(2));
			$('#a2').val(a2.toFixed(2));
			$('#a3').val(a3.toFixed(2));
			$('#a4').val(a4.toFixed(2));
			$('#a5').val(a5.toFixed(2));
			$('#suma').val(suma.toFixed(2));
			
			$('#b1').val(b1.toFixed(2));
			$('#b2').val(b2.toFixed(2));
			$('#b3').val(b3.toFixed(2));
			$('#b4').val(b4.toFixed(2));
			$('#b5').val(b5.toFixed(2));
			$('#sumb').val(sumb.toFixed(2));
			
			$('#c1').val(c1.toFixed(2));
			$('#c2').val(c2.toFixed(2));
			$('#c3').val(c3.toFixed(2));
			$('#c4').val(c4.toFixed(2));
			$('#c5').val(c5.toFixed(2));
			
			$('#d1').val(d1.toFixed(2));
			$('#d2').val(d2.toFixed(2));
			$('#d3').val(d3.toFixed(2));
			$('#d4').val(d4.toFixed(2));
			$('#d5').val(d5.toFixed(2));
			
			$('#e1').val(e1.toFixed(2));
			$('#e2').val(e2.toFixed(2));
			$('#e3').val(e3.toFixed(2));
			$('#e4').val(e4.toFixed(2));
			$('#e5').val(e5.toFixed(2));
			
			$('#aa1').val(aa1.toFixed(2));
			$('#aa2').val(aa2.toFixed(2));
			$('#aa3').val(aa3.toFixed(2));
			$('#aa4').val(aa4.toFixed(2));
			$('#aa5').val(aa5.toFixed(2));
			$('#sumaa').val(sumaa.toFixed(2));
			
			$('#bb1').val(bb1.toFixed(2));
			$('#bb2').val(bb2.toFixed(2));
			$('#bb3').val(bb3.toFixed(2));
			$('#bb4').val(bb4.toFixed(2));
			$('#bb5').val(bb5.toFixed(2));
			$('#sumbb').val(sumbb.toFixed(2));
			
			$('#cc1').val(cc1.toFixed(2));
			$('#cc2').val(cc2.toFixed(2));
			$('#cc3').val(cc3.toFixed(2));
			$('#cc4').val(cc4.toFixed(2));
			$('#cc5').val(cc5.toFixed(2));
			
			$('#dd1').val(dd1.toFixed(2));
			$('#dd2').val(dd2.toFixed(2));
			$('#dd3').val(dd3.toFixed(2));
			$('#dd4').val(dd4.toFixed(2));
			$('#dd5').val(dd5.toFixed(2));
			
			$('#ee1').val(ee1.toFixed(2));
			$('#ee2').val(ee2.toFixed(2));
			$('#ee3').val(ee3.toFixed(2));
			$('#ee4').val(ee4.toFixed(2));
			$('#ee5').val(ee5.toFixed(2));
	$('#fi_index').val(fi_index.toFixed(2));
    $('#ei_index').val(ei_index.toFixed(2));
	<!------------------------------------------------------------------>
			//PASSING RANGE
					var p_ll_1 = randomNumberFromRange(14, 17);
					var p_ll_2 = randomNumberFromRange(18, 19);
					var temp1 = 20 - parseFloat(p_ll_2);
					var temp2 = 20 - parseFloat(p_ll_1);
					var p_ll_3 = 20;
					var p_ll_4 = 20 + parseFloat(temp1);
					var p_ll_5 = 20 + parseFloat(temp2);	

					var mc_ll_1 = randomNumberFromRange(15.00, 17.00);
					var mc_ll_2 = randomNumberFromRange(17.01, 19.00);
					var mc_ll_3 = randomNumberFromRange(20.01, 25.00);
					var tem1 = parseFloat(mc_ll_3) - parseFloat(mc_ll_2);
					var tem2 = parseFloat(mc_ll_3) - parseFloat(mc_ll_1);
					var mc_ll_4 = parseFloat(mc_ll_3)+parseFloat(tem1);
					var mc_ll_5 = parseFloat(mc_ll_3)+parseFloat(tem2);

													

					var liquide_limit = mc_ll_3;
					
						
					var od_ll_1 = randomNumberFromRange(20.00, 25.00);
					var od_ll_2 = randomNumberFromRange(20.00, 25.00);
					var od_ll_3 = randomNumberFromRange(20.00, 25.00);
					var od_ll_4 = randomNumberFromRange(20.00, 25.00);
					var od_ll_5 = randomNumberFromRange(20.00, 25.00);
					
					var con_ll_1 = randomNumberFromRange(25.01, 30.00);
					var con_ll_2 = randomNumberFromRange(25.01, 30.00);
					var con_ll_3 = randomNumberFromRange(25.01, 30.00);
					var con_ll_4 = randomNumberFromRange(25.01, 30.00);
					var con_ll_5 = randomNumberFromRange(25.01, 30.00);
				
					var wtr_ll_1 = (parseFloat(mc_ll_1)*parseFloat(od_ll_1))/100;
					var wtr_ll_2 = (parseFloat(mc_ll_2)*parseFloat(od_ll_2))/100;
					var wtr_ll_3 = (parseFloat(mc_ll_3)*parseFloat(od_ll_3))/100;
					var wtr_ll_4 = (parseFloat(mc_ll_4)*parseFloat(od_ll_4))/100;
					var wtr_ll_5 = (parseFloat(mc_ll_5)*parseFloat(od_ll_5))/100;
			
					var wt_ll_1 = parseFloat(wtr_ll_1)+parseFloat(con_ll_1)+parseFloat(od_ll_1);
					var wt_ll_2 = parseFloat(wtr_ll_2)+parseFloat(con_ll_2)+parseFloat(od_ll_2);
					var wt_ll_3 = parseFloat(wtr_ll_3)+parseFloat(con_ll_3)+parseFloat(od_ll_3);
					var wt_ll_4 = parseFloat(wtr_ll_4)+parseFloat(con_ll_4)+parseFloat(od_ll_4);
					var wt_ll_5 = parseFloat(wtr_ll_5)+parseFloat(con_ll_5)+parseFloat(od_ll_5);
					
					var dy_ll_1 = parseFloat(wt_ll_1)-parseFloat(wtr_ll_1);
					var dy_ll_2 = parseFloat(wt_ll_2)-parseFloat(wtr_ll_2);
					var dy_ll_3 = parseFloat(wt_ll_3)-parseFloat(wtr_ll_3);
					var dy_ll_4 = parseFloat(wt_ll_4)-parseFloat(wtr_ll_4);
					var dy_ll_5 = parseFloat(wt_ll_5)-parseFloat(wtr_ll_5);

					var avg_ll = (parseFloat(mc_ll_1)+parseFloat(mc_ll_2)+parseFloat(mc_ll_4)+parseFloat(mc_ll_5))/4;

					$('#liquide_limit').val(liquide_limit.toFixed(2));
					$('#avg_ll').val(avg_ll.toFixed(2));
					$('#p_ll_1').val(p_ll_1.toFixed(0));
					$('#p_ll_2').val(p_ll_2.toFixed(0));
					$('#p_ll_3').val(p_ll_3.toFixed(0));
					$('#p_ll_4').val(p_ll_4.toFixed(0));
					$('#p_ll_5').val(p_ll_5.toFixed(0));
					$('#mc_ll_1').val(mc_ll_1.toFixed(2));
					$('#mc_ll_2').val(mc_ll_2.toFixed(2));
					$('#mc_ll_3').val(mc_ll_3.toFixed(2));
					$('#mc_ll_4').val(mc_ll_4.toFixed(2));
					$('#mc_ll_5').val(mc_ll_5.toFixed(2));
					var p_pl_1,p_pl_2,p_pl_3,cn_ll_1,cn_ll_2,cn_ll_3,cn_ll_4,cn_ll_5,cn_pl_1,cn_pl_2,cn_pl_3;	
					$('#p_pl_1').val(p_pl_1);
					$('#p_pl_2').val(p_pl_2);
					$('#p_pl_3').val(p_pl_3);

					$('#cn_ll_1').val(cn_ll_1);
					$('#cn_ll_2').val(cn_ll_2);
					$('#cn_ll_3').val(cn_ll_3);
					$('#cn_ll_4').val(cn_ll_4);
					$('#cn_ll_5').val(cn_ll_5);

					$('#cn_pl_1').val(cn_pl_1);
					$('#cn_pl_2').val(cn_pl_2);
					$('#cn_pl_3').val(cn_pl_3);
					
					$('#wt_ll_1').val(wt_ll_1.toFixed(2));
					$('#wt_ll_2').val(wt_ll_2.toFixed(2));
					$('#wt_ll_3').val(wt_ll_3.toFixed(2));
					$('#wt_ll_4').val(wt_ll_4.toFixed(2));
					$('#wt_ll_5').val(wt_ll_5.toFixed(2));

					$('#dy_ll_1').val(dy_ll_1.toFixed(2));
					$('#dy_ll_2').val(dy_ll_2.toFixed(2));
					$('#dy_ll_3').val(dy_ll_3.toFixed(2));
					$('#dy_ll_4').val(dy_ll_4.toFixed(2));
					$('#dy_ll_5').val(dy_ll_5.toFixed(2));

					$('#wtr_ll_1').val(wtr_ll_1.toFixed(2));
					$('#wtr_ll_2').val(wtr_ll_2.toFixed(2));
					$('#wtr_ll_3').val(wtr_ll_3.toFixed(2));
					$('#wtr_ll_4').val(wtr_ll_4.toFixed(2));
					$('#wtr_ll_5').val(wtr_ll_5.toFixed(2));

					$('#con_ll_1').val(con_ll_1.toFixed(2));
					$('#con_ll_2').val(con_ll_2.toFixed(2));
					$('#con_ll_3').val(con_ll_3.toFixed(2));
					$('#con_ll_4').val(con_ll_4.toFixed(2));
					$('#con_ll_5').val(con_ll_5.toFixed(2));

					$('#od_ll_1').val(od_ll_1.toFixed(2));
					$('#od_ll_2').val(od_ll_2.toFixed(2));
					$('#od_ll_3').val(od_ll_3.toFixed(2));
					$('#od_ll_4').val(od_ll_4.toFixed(2));
					$('#od_ll_5').val(od_ll_5.toFixed(2));

					
					var chk_pl = randomNumberFromRange(4.00, 6.00);
					$('#chk_pl').val(chk_pl.toFixed(2));
					
					var plastic_limit = parseFloat(liquide_limit)-parseFloat(chk_pl);
					var avg_pl = plastic_limit;
					$('#avg_pl').val(avg_pl.toFixed(2));
					$('#plastic_limit').val(plastic_limit.toFixed(2));
					
					var mc_pl_1  = parseFloat(avg_pl) + randomNumberFromRange(0.50, -0.50);
					var mc_pl_2  = parseFloat(avg_pl) + randomNumberFromRange(0.50, -0.50);
					var abc  = parseFloat(mc_pl_1)+parseFloat(mc_pl_2);
					var mc_pl_3  = (parseFloat(avg_pl)*3) - abc;
				
					var od_pl_1 = randomNumberFromRange(20.00, 25.00);
					var od_pl_2 = randomNumberFromRange(20.00, 25.00);
					var od_pl_3 = randomNumberFromRange(20.00, 25.00);

					var con_pl_1 = randomNumberFromRange(26.00, 30.00);
					var con_pl_2 = randomNumberFromRange(26.00, 30.00);
					var con_pl_3 = randomNumberFromRange(26.00, 30.00);

					var wtr_pl_1 = (parseFloat(mc_pl_1)*parseFloat(od_pl_1))/100;
					var wtr_pl_2 = (parseFloat(mc_pl_2)*parseFloat(od_pl_2))/100;
					var wtr_pl_3 = (parseFloat(mc_pl_3)*parseFloat(od_pl_3))/100;
					
					var wt_pl_1 = parseFloat(wtr_pl_1)+parseFloat(con_pl_1)+parseFloat(od_pl_1);
					var wt_pl_2 = parseFloat(wtr_pl_2)+parseFloat(con_pl_2)+parseFloat(od_pl_2);
					var wt_pl_3 = parseFloat(wtr_pl_3)+parseFloat(con_pl_3)+parseFloat(od_pl_3);
					
					var dy_pl_1 = parseFloat(wt_pl_1)-parseFloat(wtr_pl_1);
					var dy_pl_2 = parseFloat(wt_pl_2)-parseFloat(wtr_pl_2);
					var dy_pl_3 = parseFloat(wt_pl_3)-parseFloat(wtr_pl_3);
					
					
					$('#wt_pl_1').val(wt_pl_1.toFixed(2));
					$('#wt_pl_2').val(wt_pl_2.toFixed(2));
					$('#wt_pl_3').val(wt_pl_3.toFixed(2));

					

					$('#dy_pl_1').val(dy_pl_1.toFixed(2));
					$('#dy_pl_2').val(dy_pl_2.toFixed(2));
					$('#dy_pl_3').val(dy_pl_3.toFixed(2));

					

					$('#wtr_pl_1').val(wtr_pl_1.toFixed(2));
					$('#wtr_pl_2').val(wtr_pl_2.toFixed(2));
					$('#wtr_pl_3').val(wtr_pl_3.toFixed(2));

					

					$('#con_pl_1').val(con_pl_1.toFixed(2));
					$('#con_pl_2').val(con_pl_2.toFixed(2));
					$('#con_pl_3').val(con_pl_3.toFixed(2));

					

					$('#od_pl_1').val(od_pl_1.toFixed(2));
					$('#od_pl_2').val(od_pl_2.toFixed(2));
					$('#od_pl_3').val(od_pl_3.toFixed(2));
					
					

					$('#mc_pl_1').val(mc_pl_1.toFixed(2));
					$('#mc_pl_2').val(mc_pl_2.toFixed(2));
					$('#mc_pl_3').val(mc_pl_3.toFixed(2));

				//mdd omc
			var m11 = "";	
			var m12 = "";
			var m13 = "";
			var m14 = "";
			var m15 = "";
			var m16 = "";

			var t =  randomNumberFromRange(1,10);
			if(t%2==0)
			{
				var m76 = randomNumberFromRange(6.00,8.00);
				var m72 = parseFloat(m76)-randomNumberFromRange(1.00,1.50);
				var m71 = parseFloat(m72)-randomNumberFromRange(1.00,1.50);
				var tm1 = parseFloat(m76)-parseFloat(m72);
				var tm2 = parseFloat(m76)-parseFloat(m71);
				var m73 = parseFloat(m76)+parseFloat(tm1);
				var m74 = parseFloat(m76)+parseFloat(tm2);
				var m75 = parseFloat(m76)+randomNumberFromRange(1.00,1.50);

				var d76 = randomNumberFromRange(2.00,3.00);
				var d72 = parseFloat(d76)-randomNumberFromRange(0.01,0.03);
				var d71 = parseFloat(d72)-randomNumberFromRange(0.01,0.03);
				var dm1 = parseFloat(d76)-parseFloat(d72);
				var dm2 = parseFloat(d76)-parseFloat(d71);
				var d73 = parseFloat(d76)+parseFloat(dm1);
				var d74 = parseFloat(d76)+parseFloat(dm2);
				var d75 = parseFloat(d76)+randomNumberFromRange(0.01,0.03);

			}
			else
			{
				var m76 = randomNumberFromRange(6.00,8.00);
				var m73 = parseFloat(m76)-randomNumberFromRange(1.00,1.50);
				var m72 = parseFloat(m73)-randomNumberFromRange(1.00,1.50);
				var m71 = parseFloat(m72)-randomNumberFromRange(1.00,1.50);
				var tm1 = parseFloat(m76)-parseFloat(m73);
				var tm2 = parseFloat(m76)-parseFloat(m72);
				var m74 = parseFloat(m76)+parseFloat(tm1);
				var m75 = parseFloat(m76)+parseFloat(tm2);

				var d76 = randomNumberFromRange(2.00,3.00);
				var d73 = parseFloat(d76)-randomNumberFromRange(0.01,0.03);
				var d72 = parseFloat(d73)-randomNumberFromRange(0.01,0.03);
				var d71 = parseFloat(d72)-randomNumberFromRange(0.01,0.03);
				var dm1 = parseFloat(d76)-parseFloat(d73);
				var dm2 = parseFloat(d76)-parseFloat(d72);
				var d74 = parseFloat(d76)+parseFloat(dm1);
				var d75 = parseFloat(d76)+parseFloat(dm2);
				
			}

				
			var omc = m76;
			var m51 = randomNumberFromRange(25.00,35.00);
			var m52 = randomNumberFromRange(25.00,35.00);
			var m53 = randomNumberFromRange(25.00,35.00);
			var m54 = randomNumberFromRange(25.00,35.00);
			var m55 = randomNumberFromRange(25.00,35.00);
			var m56 = randomNumberFromRange(25.00,35.00);

			var m41 = randomNumberFromRange(5.00,10.00);
			var m42 = randomNumberFromRange(5.00,10.00);
			var m43 = randomNumberFromRange(5.00,10.00);
			var m44 = randomNumberFromRange(5.00,10.00);
			var m45 = randomNumberFromRange(5.00,10.00);
			var m46 = randomNumberFromRange(5.00,10.00);

			var m21 = parseFloat(m51)+randomNumberFromRange(50.00,70.00);
			var m22 = parseFloat(m52)+randomNumberFromRange(50.00,70.00);
			var m23 = parseFloat(m53)+randomNumberFromRange(50.00,70.00);
			var m24 = parseFloat(m54)+randomNumberFromRange(50.00,70.00);
			var m25 = parseFloat(m55)+randomNumberFromRange(50.00,70.00);
			var m26 = parseFloat(m56)+randomNumberFromRange(50.00,70.00);

			var m31 = parseFloat(m41)+parseFloat(m21);
			var m32 = parseFloat(m42)+parseFloat(m22);
			var m33 = parseFloat(m43)+parseFloat(m23);
			var m34 = parseFloat(m44)+parseFloat(m24);
			var m35 = parseFloat(m45)+parseFloat(m25);
			var m36 = parseFloat(m46)+parseFloat(m26);

			var m61 = parseFloat(m31)-parseFloat(m51);
			var m62 = parseFloat(m32)-parseFloat(m52);
			var m63 = parseFloat(m33)-parseFloat(m53);
			var m64 = parseFloat(m34)-parseFloat(m54);
			var m65 = parseFloat(m35)-parseFloat(m55);
			var m66 = parseFloat(m36)-parseFloat(m56);


			var d61 =m71;
			var d62 =m72;
			var d63 =m73;
			var d64 =m74;
			var d65 =m75;
			var d66 =m76;

			var d51 = (parseFloat(d71)*(100+parseFloat(d61)))/100;
			var d52 = (parseFloat(d72)*(100+parseFloat(d62)))/100;
			var d53 = (parseFloat(d73)*(100+parseFloat(d63)))/100;
			var d54 = (parseFloat(d74)*(100+parseFloat(d64)))/100;
			var d55 = (parseFloat(d75)*(100+parseFloat(d65)))/100;
			var d56 = (parseFloat(d76)*(100+parseFloat(d66)))/100;

			var d31 = parseFloat(d51)*2250;
			var d32 = parseFloat(d52)*2250;
			var d33 = parseFloat(d53)*2250;
			var d34 = parseFloat(d54)*2250;
			var d35 = parseFloat(d55)*2250;
			var d36 = parseFloat(d56)*2250;

			var d41 = randomNumberFromRange(4,4);
			var d42 = randomNumberFromRange(6,6);
			var d43 = randomNumberFromRange(8,8);
			var d44 = randomNumberFromRange(10,10);
			var d45 = randomNumberFromRange(14,14);
			var d46 = randomNumberFromRange(16,16);

			var d21 = 6210;
			var d22 = 6210;
			var d23 = 6210;
			var d24 = 6210;
			var d25 = 6210;
			var d26 = 6210;

			var d11 = parseFloat(d21)+parseFloat(d31);
			var d12 = parseFloat(d22)+parseFloat(d32);
			var d13 = parseFloat(d23)+parseFloat(d33);
			var d14 = parseFloat(d24)+parseFloat(d34);
			var d15 = parseFloat(d25)+parseFloat(d35);
			var d16 = parseFloat(d26)+parseFloat(d36);

			
			var mdd = d76;
			
			$('#omc').val(omc.toFixed(2));
			$('#mdd').val(mdd.toFixed(2));
	
			$('#m11').val(m11);
			$('#m12').val(m12);
			$('#m13').val(m13);
			$('#m14').val(m14);
			$('#m15').val(m15);
			$('#m16').val(m16);

			$('#m21').val(m21.toFixed(2));
			$('#m22').val(m22.toFixed(2));
			$('#m23').val(m23.toFixed(2));
			$('#m24').val(m24.toFixed(2));
			$('#m25').val(m25.toFixed(2));
			$('#m26').val(m26.toFixed(2));

			$('#m31').val(m31.toFixed(2));
			$('#m32').val(m32.toFixed(2));
			$('#m33').val(m33.toFixed(2));
			$('#m34').val(m34.toFixed(2));
			$('#m35').val(m35.toFixed(2));
			$('#m36').val(m36.toFixed(2));

			$('#m41').val(m41.toFixed(2));
			$('#m42').val(m42.toFixed(2));
			$('#m43').val(m43.toFixed(2));
			$('#m44').val(m44.toFixed(2));
			$('#m45').val(m45.toFixed(2));
			$('#m46').val(m46.toFixed(2));

			$('#m51').val(m51.toFixed(2));
			$('#m52').val(m52.toFixed(2));
			$('#m53').val(m53.toFixed(2));
			$('#m54').val(m54.toFixed(2));
			$('#m55').val(m55.toFixed(2));
			$('#m56').val(m56.toFixed(2));

			$('#m61').val(m61.toFixed(2));
			$('#m62').val(m62.toFixed(2));
			$('#m63').val(m63.toFixed(2));
			$('#m64').val(m64.toFixed(2));
			$('#m65').val(m65.toFixed(2));
			$('#m66').val(m66.toFixed(2));

			$('#m71').val(m71.toFixed(2));
			$('#m72').val(m72.toFixed(2));
			$('#m73').val(m73.toFixed(2));
			$('#m74').val(m74.toFixed(2));
			$('#m75').val(m75.toFixed(2));
			$('#m76').val(m76.toFixed(2));

			$('#d11').val(d11.toFixed(2));
			$('#d12').val(d12.toFixed(2));
			$('#d13').val(d13.toFixed(2));
			$('#d14').val(d14.toFixed(2));
			$('#d15').val(d15.toFixed(2));
			$('#d16').val(d16.toFixed(2));

			$('#d21').val(d21.toFixed(2));
			$('#d22').val(d22.toFixed(2));
			$('#d23').val(d23.toFixed(2));
			$('#d24').val(d24.toFixed(2));
			$('#d25').val(d25.toFixed(2));
			$('#d26').val(d26.toFixed(2));

			$('#d31').val(d31.toFixed(2));
			$('#d32').val(d32.toFixed(2));
			$('#d33').val(d33.toFixed(2));
			$('#d34').val(d34.toFixed(2));
			$('#d35').val(d35.toFixed(2));
			$('#d36').val(d36.toFixed(2));

			$('#d41').val(d41.toFixed(2));
			$('#d42').val(d42.toFixed(2));
			$('#d43').val(d43.toFixed(2));
			$('#d44').val(d44.toFixed(2));
			$('#d45').val(d45.toFixed(2));
			$('#d46').val(d46.toFixed(2));

			$('#d51').val(d51.toFixed(2));
			$('#d52').val(d52.toFixed(2));
			$('#d53').val(d53.toFixed(2));
			$('#d54').val(d54.toFixed(2));
			$('#d55').val(d55.toFixed(2));
			$('#d56').val(d56.toFixed(2));

			$('#d61').val(d61.toFixed(2));
			$('#d62').val(d62.toFixed(2));
			$('#d63').val(d63.toFixed(2));
			$('#d64').val(d64.toFixed(2));
			$('#d65').val(d65.toFixed(2));
			$('#d66').val(d66.toFixed(2));

			$('#d71').val(d71.toFixed(2));
			$('#d72').val(d72.toFixed(2));
			$('#d73').val(d73.toFixed(2));
			$('#d74').val(d74.toFixed(2));
			$('#d75').val(d75.toFixed(2));
			$('#d76').val(d76.toFixed(2));
	<!------------------------------------------------------------------>
});
$("#btn_edit_data").click(function(){
			$('#btn_edit_data').hide();
			$('#btn_save').show();

	});
function getGlazedTiles(){
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save53_22_4_mm.php',
        data: 'action_type=view&'+$("#Glazed").serialize()+'&get_of_srno='+get_of_srno,
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
				var txt_srno1 = $('#txt_srno1').val(); 
				var txt_id = $('#txt_id').val(); 
				var txt_srno2 = $('#txt_srno2').val(); 
				var get_srno=txt_srno1+txt_srno2;
				var txt_jobno = $('#txt_jobno').val(); 
				var txt_ref = $('#txt_ref').val(); 
				var ref_date = $('#ref_date').val(); 
				var txt_day = $('#txt_day').val();
				var txt_date = $('#txt_date').val();
				var txt_brand = $('#txt_brand').val();
				var detail_sample = $('#detail_sample').val();
				var id_mark = $('#id_mark').val();
				var start_date = $('#start_date').val();
				var end_date = $('#end_date').val();
				var con_sample = $('#con_sample').val();
				var specification = $('#specification').val();
				var source  = $('#source').val();
				var rec_sample_date = $('#rec_sample_date').val();
				var sample_id = $('#sample_id').val();
				var size_of_sample = $('#size_of_sample').val();
				
				
				
				//GRADATION DATA FETCH
				var sample_taken = $('#sample_taken').val();
				var blank_extra = $('#blank_extra').val();
				
				var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
				var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
				var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
				var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
				var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
 												
				var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
				var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
				var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
				var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
				var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
 				
				var cum_ret_1 = $('#cum_ret_1').val();
				var cum_ret_2 = $('#cum_ret_2').val();
				var cum_ret_3 = $('#cum_ret_3').val();
				var cum_ret_4 = $('#cum_ret_4').val();
				var cum_ret_5 = $('#cum_ret_5').val();
 				
				var pass_sample_1 = $('#pass_sample_1').val();
				var pass_sample_2 = $('#pass_sample_2').val();
				var pass_sample_3 = $('#pass_sample_3').val();
				var pass_sample_4 = $('#pass_sample_4').val();
				var pass_sample_5 = $('#pass_sample_5').val();
 				
				
					//Abrasion
				var abr_index = $('#abr_index').val();
				var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
				var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
				var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
				var abr_sample_abr = $('#abr_sample_abr').val();
				
				//impact value
				var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
				var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
				var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
				var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
				var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
				var imp_w_m_c_2 = $('#imp_w_m_c_2').val();
				var imp_value_1 = $('#imp_value_1').val();
				var imp_value_2 = $('#imp_value_2').val();
				var imp_value = $('#imp_value').val();
							
				
				//specific gravity and water abrasion								
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
				
			
				
				//Flakiness INDEX
				var fi_index = $('#fi_index').val();
				var a1 = $('#a1').val();
				var a2 = $('#a2').val();
				var a3 = $('#a3').val();
				var a4 = $('#a4').val();
				var a5 = $('#a5').val();
				var suma = $('#suma').val();
				
				var b1 = $('#b1').val();
				var b2 = $('#b2').val();
				var b3 = $('#b3').val();
				var b4 = $('#b4').val();
				var b5 = $('#b5').val();
				var sumb = $('#sumb').val();
				
				var c1 = $('#c1').val();
				var c2 = $('#c2').val();
				var c3 = $('#c3').val();
				var c4 = $('#c4').val();
				var c5 = $('#c5').val();
				
				var d1 = $('#d1').val();
				var d2 = $('#d2').val();
				var d3 = $('#d3').val();
				var d4 = $('#d4').val();
				var d5 = $('#d5').val();
				
				var e1 = $('#e1').val();
				var e2 = $('#e2').val();
				var e3 = $('#e3').val();
				var e4 = $('#e4').val();
				var e5 = $('#e5').val();
				
				var ei_index = $('#ei_index').val();
				var aa1 = $('#aa1').val();
				var aa2 = $('#aa2').val();
				var aa3 = $('#aa3').val();
				var aa4 = $('#aa4').val();
				var aa5 = $('#aa5').val();
				var sumaa = $('#sumaa').val();
				
				var bb1 = $('#bb1').val();
				var bb2 = $('#bb2').val();
				var bb3 = $('#bb3').val();
				var bb4 = $('#bb4').val();
				var bb5 = $('#bb5').val();
				var sumbb = $('#sumbb').val();
				
				var cc1 = $('#cc1').val();
				var cc2 = $('#cc2').val();
				var cc3 = $('#cc3').val();
				var cc4 = $('#cc4').val();
				var cc5 = $('#cc5').val();
				
				var dd1 = $('#dd1').val();
				var dd2 = $('#dd2').val();
				var dd3 = $('#dd3').val();
				var dd4 = $('#dd4').val();
				var dd5 = $('#dd5').val();
				
				var ee1 = $('#ee1').val();
				var ee2 = $('#ee2').val();
				var ee3 = $('#ee3').val();
				var ee4 = $('#ee4').val();
				var ee5 = $('#ee5').val();
				
				//mdd omc
				var m11 = $('#m11').val();
				var m12 = $('#m12').val();
				var m14 = $('#m13').val();
				var m13 = $('#m14').val();
				var m15 = $('#m15').val();
				var m16 = $('#m16').val();
				
				var m21 = $('#m21').val();
				var m22 = $('#m22').val();
				var m23 = $('#m23').val();
				var m24 = $('#m24').val();
				var m25 = $('#m25').val();
				var m26 = $('#m26').val();
				
				var m31 = $('#m31').val();
				var m32 = $('#m32').val();
				var m33 = $('#m33').val();
				var m34 = $('#m34').val();
				var m35 = $('#m35').val();
				var m36 = $('#m36').val();
				
				var m41 = $('#m41').val();
				var m42 = $('#m42').val();
				var m43 = $('#m43').val();
				var m44 = $('#m44').val();
				var m45 = $('#m45').val();
				var m46 = $('#m46').val();
				
				var m51 = $('#m51').val();
				var m52 = $('#m52').val();
				var m53 = $('#m53').val();
				var m54 = $('#m54').val();
				var m55 = $('#m55').val();
				var m56 = $('#m56').val();
				
				var m61 = $('#m61').val();
				var m62 = $('#m62').val();
				var m63 = $('#m63').val();
				var m64 = $('#m64').val();
				var m65 = $('#m65').val();
				var m66 = $('#m66').val();
				
				var m71 = $('#m71').val();
				var m72 = $('#m72').val();
				var m73 = $('#m73').val();
				var m74 = $('#m74').val();
				var m75 = $('#m75').val();
				var m76 = $('#m76').val();
				
				
				var d11 = $('#d11').val();
				var d12 = $('#d12').val();
				var d13 = $('#d13').val();
				var d14 = $('#d14').val();
				var d15 = $('#d15').val();
				var d16 = $('#d16').val();
				
				var d21 = $('#d21').val();
				var d22 = $('#d22').val();
				var d23 = $('#d23').val();
				var d24 = $('#d24').val();
				var d25 = $('#d25').val();
				var d26 = $('#d26').val();
				
				var d31 = $('#d31').val();
				var d32 = $('#d32').val();
				var d33 = $('#d33').val();
				var d34 = $('#d34').val();
				var d35 = $('#d35').val();
				var d36 = $('#d36').val();
				
				var d41 = $('#d41').val();
				var d42 = $('#d42').val();
				var d43 = $('#d43').val();
				var d44 = $('#d44').val();
				var d45 = $('#d45').val();
				var d46 = $('#d46').val();
				
				var d51 = $('#d51').val();
				var d52 = $('#d52').val();
				var d53 = $('#d53').val();
				var d54 = $('#d54').val();
				var d55 = $('#d55').val();
				var d56 = $('#d56').val();
				
				var d61 = $('#d61').val();
				var d62 = $('#d62').val();
				var d63 = $('#d63').val();
				var d64 = $('#d64').val();
				var d65 = $('#d65').val();
				var d66 = $('#d66').val();
				
				var d71 = $('#d71').val();
				var d72 = $('#d72').val();
				var d73 = $('#d73').val();
				var d74 = $('#d74').val();
				var d75 = $('#d75').val();
				var d76 = $('#d76').val();
				
				var mdd = $('#mdd').val();
				var omc = $('#omc').val();
				var cbr = $('#cbr').val();
				
				//ll and pl
				
				var chk_pl = $('#chk_pl').val();
				var plastic_limit = $('#plastic_limit').val();
				var liquide_limit = $('#liquide_limit').val();
				
				var p_ll_1 = $('#p_ll_1').val();
				var p_ll_2 = $('#p_ll_2').val();
				var p_ll_3 = $('#p_ll_3').val();
				var p_ll_4 = $('#p_ll_4').val();
				var p_ll_5 = $('#p_ll_5').val();
				
				var p_pl_1 = $('#p_pl_1').val();
				var p_pl_2 = $('#p_pl_2').val();
				var p_pl_3 = $('#p_pl_3').val();
				
				var cn_ll_1 = $('#cn_ll_1').val();
				var cn_ll_2 = $('#cn_ll_2').val();
				var cn_ll_3 = $('#cn_ll_3').val();
				var cn_ll_4 = $('#cn_ll_4').val();
				var cn_ll_5 = $('#cn_ll_5').val();
				
				var cn_pl_1 = $('#cn_pl_1').val();
				var cn_pl_2 = $('#cn_pl_2').val();
				var cn_pl_3 = $('#cn_pl_3').val();
				
				var wt_ll_1 = $('#wt_ll_1').val();
				var wt_ll_2 = $('#wt_ll_2').val();
				var wt_ll_3 = $('#wt_ll_3').val();
				var wt_ll_4 = $('#wt_ll_4').val();
				var wt_ll_5 = $('#wt_ll_5').val();
				
				var wt_pl_1 = $('#wt_pl_1').val();
				var wt_pl_2 = $('#wt_pl_2').val();
				var wt_pl_3 = $('#wt_pl_3').val();
				
				var dy_ll_1 = $('#dy_ll_1').val();
				var dy_ll_2 = $('#dy_ll_2').val();
				var dy_ll_3 = $('#dy_ll_3').val();
				var dy_ll_4 = $('#dy_ll_4').val();
				var dy_ll_5 = $('#dy_ll_5').val();
				
				var dy_pl_1 = $('#dy_pl_1').val();
				var dy_pl_2 = $('#dy_pl_2').val();
				var dy_pl_3 = $('#dy_pl_3').val();
				
				var wtr_ll_1 = $('#wtr_ll_1').val();
				var wtr_ll_2 = $('#wtr_ll_2').val();
				var wtr_ll_3 = $('#wtr_ll_3').val();
				var wtr_ll_4 = $('#wtr_ll_4').val();
				var wtr_ll_5 = $('#wtr_ll_5').val();
				
				var wtr_pl_1 = $('#wtr_pl_1').val();
				var wtr_pl_2 = $('#wtr_pl_2').val();
				var wtr_pl_3 = $('#wtr_pl_3').val();
				
				var con_ll_1 = $('#con_ll_1').val();
				var con_ll_2 = $('#con_ll_2').val();
				var con_ll_3 = $('#con_ll_3').val();
				var con_ll_4 = $('#con_ll_4').val();
				var con_ll_5 = $('#con_ll_5').val();
				
				var con_pl_1 = $('#con_pl_1').val();
				var con_pl_2 = $('#con_pl_2').val();
				var con_pl_3 = $('#con_pl_3').val();
				
				var od_ll_1 = $('#od_ll_1').val();
				var od_ll_2 = $('#od_ll_2').val();
				var od_ll_3 = $('#od_ll_3').val();
				var od_ll_4 = $('#od_ll_4').val();
				var od_ll_5 = $('#od_ll_5').val();
				
				var od_pl_1 = $('#od_pl_1').val();
				var od_pl_2 = $('#od_pl_2').val();
				var od_pl_3 = $('#od_pl_3').val();
				
				var mc_ll_1 = $('#mc_ll_1').val();
				var mc_ll_2 = $('#mc_ll_2').val();
				var mc_ll_3 = $('#mc_ll_3').val();
				var mc_ll_4 = $('#mc_ll_4').val();
				var mc_ll_5 = $('#mc_ll_5').val();
				
				var mc_pl_1 = $('#mc_pl_1').val();
				var mc_pl_2 = $('#mc_pl_2').val();
				var mc_pl_3 = $('#mc_pl_3').val();
				var avg_ll = $('#avg_ll').val();
				var avg_pl = $('#avg_pl').val();
				
				
				//alkali strip and fines_value
				var fines_value = $('#fines_value').val();
				var stripping_value = $('#stripping_value').val();
				var alkali_value = $('#alkali_value').val();
				
				if(document.getElementById('chk_fines').checked) {
				var chk_fines = "1";
				}
				else{
					var chk_fines = "0";
				}
				
				if(document.getElementById('chk_strip').checked) {
				var chk_strip = "1";
				}
				else{
					var chk_strip = "0";
				}
				
				if(document.getElementById('chk_alkali').checked) {
				var chk_alkali = "1";
				}
				else{
					var chk_alkali = "0";
				}
				
				
				if(document.getElementById('chk_abr').checked) {
				var chk_abr = "1";
				}
				else{
					var chk_abr = "0";
				}
				
				if(document.getElementById('chk_impact').checked) {
				var chk_impact = "1";
				}
				else{
					var chk_impact = "0";
				}
				
				
				
				if(document.getElementById('chk_sp').checked) {
				var chk_sp = "1";
				}
				else{
					var chk_sp = "0";
				}
				
				
				
				if(document.getElementById('chk_flk').checked) {
				var chk_flk = "1";
				}
				else{
					var chk_flk = "0";
				}
				
				if(document.getElementById('chk_elo').checked) {
				var chk_elo = "1";
				}
				else{
					var chk_elo = "0";
				}
				
				
				
				if(document.getElementById('chk_grd').checked) {
				var chk_grd = "1";
				}
				else{
					var chk_grd = "0";
				}
				
				if(document.getElementById('chk_mdd').checked) {
				var chk_mdd = "1";
				}
				else{
					var chk_mdd = "0";
				}
				
				if(document.getElementById('chk_ll').checked) {
				var chk_ll = "1";
				}
				else{
					var chk_ll = "0";
				}
				
				
				
				
				
					var month_name = $('#month_name').val();
				
				if(txt_brand !== "" && txt_day !== "")
					{
						billData = '&action_type='+type+'&id='+id+'&txt_id='+txt_id+'&get_srno='+get_srno+'&txt_jobno='+txt_jobno+'&txt_ref='+txt_ref+'&ref_date='+ref_date+'&txt_day='+txt_day+'&txt_date='+txt_date+'&txt_brand='+txt_brand+'&detail_sample='+detail_sample+'&id_mark='+id_mark+'&start_date='+start_date+'&end_date='+end_date+'&con_sample='+con_sample+'&sp_w_b_a1_1='+sp_w_b_a1_1+'&abr_wt_t_a_1='+abr_wt_t_a_1+'&imp_w_m_a_1='+imp_w_m_a_1+'&sp_w_b_a2_1='+sp_w_b_a2_1+'&abr_wt_t_b_1='+abr_wt_t_b_1+'&imp_w_m_b_1='+imp_w_m_b_1+'&sp_w_sur_1='+sp_w_sur_1+'&sp_w_sur_2='+sp_w_sur_2+'&abr_wt_t_c_1='+abr_wt_t_c_1+'&imp_w_m_c_1='+imp_w_m_c_1+'&sp_w_s_1='+sp_w_s_1+'&size_of_sample='+size_of_sample+'&sp_specific_gravity='+sp_specific_gravity+'&sp_water_abr='+sp_water_abr+'&abr_index='+abr_index+'&fi_index='+fi_index+'&ei_index='+ei_index+'&imp_value='+imp_value+'&sieve_1='+sieve_1+'&sieve_2='+sieve_2+'&sieve_3='+sieve_3+'&sieve_4='+sieve_4+'&sieve_5='+sieve_5+'&cum_wt_gm_1='+cum_wt_gm_1+'&cum_wt_gm_2='+cum_wt_gm_2+'&cum_wt_gm_3='+cum_wt_gm_3+'&cum_wt_gm_4='+cum_wt_gm_4+'&cum_wt_gm_5='+cum_wt_gm_5+'&ret_wt_gm_1='+ret_wt_gm_1+'&ret_wt_gm_2='+ret_wt_gm_2+'&ret_wt_gm_3='+ret_wt_gm_3+'&ret_wt_gm_4='+ret_wt_gm_4+'&ret_wt_gm_5='+ret_wt_gm_5+'&cum_ret_1='+cum_ret_1+'&cum_ret_2='+cum_ret_2+'&cum_ret_3='+cum_ret_3+'&cum_ret_4='+cum_ret_4+'&cum_ret_5='+cum_ret_5+'&pass_sample_1='+pass_sample_1+'&pass_sample_2='+pass_sample_2+'&pass_sample_3='+pass_sample_3+'&pass_sample_4='+pass_sample_4+'&pass_sample_5='+pass_sample_5+'&blank_extra='+blank_extra+'&sp_sample_ca='+sp_sample_ca+'&sp_w_b_a1_2='+sp_w_b_a1_2+'&sp_w_b_a2_2='+sp_w_b_a2_2+'&sp_wt_st_1='+sp_wt_st_1+'&sp_wt_st_2='+sp_wt_st_2+'&sp_w_s_2='+sp_w_s_2+'&sp_specific_gravity_1='+sp_specific_gravity_1+'&sp_specific_gravity_2='+sp_specific_gravity_2+'&sp_water_abr_1='+sp_water_abr_1+'&sp_water_abr_2='+sp_water_abr_2+'&abr_sample_abr='+abr_sample_abr+'&imp_w_m_a_2='+imp_w_m_a_2+'&imp_w_m_b_2='+imp_w_m_b_2+'&imp_w_m_c_2='+imp_w_m_c_2+'&imp_value_1='+imp_value_1+'&imp_value_2='+imp_value_2+'&m1='+m1+'&m2='+m2+'&m3='+m3+'&m4='+m4+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&a4='+a4+'&a5='+a5+'&suma='+suma+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&sumb='+sumb+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&e1='+e1+'&e2='+e2+'&e3='+e3+'&aa1='+aa1+'&aa2='+aa2+'&aa3='+aa3+'&sumaa='+sumaa+'&bb1='+bb1+'&bb2='+bb2+'&bb3='+bb3+'&sumbb='+sumbb+'&cc1='+cc1+'&cc2='+cc2+'&cc3='+cc3+'&dd1='+dd1+'&dd2='+dd2+'&dd3='+dd3+'&ee1='+ee1+'&ee2='+ee2+'&ee3='+ee3+'&w1='+w1+'&w2='+w2+'&wsum='+wsum+'&ga1='+ga1+'&ga2='+ga2+'&gasum='+gasum+'&gb1='+gb1+'&gb2='+gb2+'&gbsum='+gbsum+'&gc1='+gc1+'&gc2='+gc2+'&gcsum='+gcsum+'&gd1='+gd1+'&gd2='+gd2+'&gdsum='+gdsum+'&ge1='+ge1+'&ge2='+ge2+'&gesum='+gesum+'&s1='+s1+'&s2='+s2+'&month_name='+month_name+'&specification='+specification+'&source='+source+'&rec_sample_date='+rec_sample_date+'&sample_id='+sample_id+'&sample_taken='+sample_taken+'&chk_abr='+chk_abr+'&chk_impact='+chk_impact+'&chk_sp='+chk_sp+'&chk_flk='+chk_flk+'&chk_elo='+chk_elo+'&chk_grd='+chk_grd+'&m1_1='+m1_1+'&m2_1='+m2_1+'&m3_1='+m3_1+'&m4_1='+m4_1;
					
					}else{
						swal(
						  'Oops...',
						  'Please Fil all the field!',
						  'error'
						);
					}
	}
	else if (type == 'edit'){
		
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
				var txt_srno1 = $('#txt_srno1').val(); 
				var txt_id = $('#txt_id').val(); 
				var txt_srno2 = $('#txt_srno2').val(); 
				var get_srno=txt_srno1+txt_srno2;
				var txt_jobno = $('#txt_jobno').val(); 
				var txt_ref = $('#txt_ref').val(); 
				var ref_date = $('#ref_date').val(); 
				var txt_day = $('#txt_day').val();
				var txt_date = $('#txt_date').val();
				var txt_brand = $('#txt_brand').val();
				var detail_sample = $('#detail_sample').val();
				var id_mark = $('#id_mark').val();
				var start_date = $('#start_date').val();
				var end_date = $('#end_date').val();
				var con_sample = $('#con_sample').val();
				var specification = $('#specification').val();
				var source  = $('#source').val();
				var rec_sample_date = $('#rec_sample_date').val();
				var sample_id = $('#sample_id').val();
				var size_of_sample = $('#size_of_sample').val();
				
				
				
				//GRADATION DATA FETCH
				var sample_taken = $('#sample_taken').val();
				var blank_extra = $('#blank_extra').val();
				
				var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
				var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
				var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
				var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
				var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
 												
				var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
				var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
				var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
				var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
				var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
 				
				var cum_ret_1 = $('#cum_ret_1').val();
				var cum_ret_2 = $('#cum_ret_2').val();
				var cum_ret_3 = $('#cum_ret_3').val();
				var cum_ret_4 = $('#cum_ret_4').val();
				var cum_ret_5 = $('#cum_ret_5').val();
 				
				var pass_sample_1 = $('#pass_sample_1').val();
				var pass_sample_2 = $('#pass_sample_2').val();
				var pass_sample_3 = $('#pass_sample_3').val();
				var pass_sample_4 = $('#pass_sample_4').val();
				var pass_sample_5 = $('#pass_sample_5').val();
 				
				
				//Abrasion
				var abr_index = $('#abr_index').val();
				var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
				var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
				var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
				var abr_sample_abr = $('#abr_sample_abr').val();
				
				//impact value
				var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
				var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
				var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
				var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
				var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
				var imp_w_m_c_2 = $('#imp_w_m_c_2').val();
				var imp_value_1 = $('#imp_value_1').val();
				var imp_value_2 = $('#imp_value_2').val();
				var imp_value = $('#imp_value').val();
				
				
				
				//specific gravity and water abrasion								
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
				
				
				
				//Flakiness INDEX
				var fi_index = $('#fi_index').val();
				var a1 = $('#a1').val();
				var a2 = $('#a2').val();
				var a3 = $('#a3').val();
				var a4 = $('#a4').val();
				var a5 = $('#a5').val();
				var suma = $('#suma').val();
				
				var b1 = $('#b1').val();
				var b2 = $('#b2').val();
				var b3 = $('#b3').val();
				var b4 = $('#b4').val();
				var b5 = $('#b5').val();
				var sumb = $('#sumb').val();
				
				var c1 = $('#c1').val();
				var c2 = $('#c2').val();
				var c3 = $('#c3').val();
				var c4 = $('#c4').val();
				var c5 = $('#c5').val();
				
				var d1 = $('#d1').val();
				var d2 = $('#d2').val();
				var d3 = $('#d3').val();
				var d4 = $('#d4').val();
				var d5 = $('#d5').val();
				
				var e1 = $('#e1').val();
				var e2 = $('#e2').val();
				var e3 = $('#e3').val();
				var e4 = $('#e4').val();
				var e5 = $('#e5').val();
				
				var ei_index = $('#ei_index').val();
				var aa1 = $('#aa1').val();
				var aa2 = $('#aa2').val();
				var aa3 = $('#aa3').val();
				var aa4 = $('#aa4').val();
				var aa5 = $('#aa5').val();
				var sumaa = $('#sumaa').val();
				
				var bb1 = $('#bb1').val();
				var bb2 = $('#bb2').val();
				var bb3 = $('#bb3').val();
				var bb4 = $('#bb4').val();
				var bb5 = $('#bb5').val();
				var sumbb = $('#sumbb').val();
				
				var cc1 = $('#cc1').val();
				var cc2 = $('#cc2').val();
				var cc3 = $('#cc3').val();
				var cc4 = $('#cc4').val();
				var cc5 = $('#cc5').val();
				
				var dd1 = $('#dd1').val();
				var dd2 = $('#dd2').val();
				var dd3 = $('#dd3').val();
				var dd4 = $('#dd4').val();
				var dd5 = $('#dd5').val();
				
				var ee1 = $('#ee1').val();
				var ee2 = $('#ee2').val();
				var ee3 = $('#ee3').val();
				var ee4 = $('#ee4').val();
				var ee5 = $('#ee5').val();
				
				
				
				if(document.getElementById('chk_abr').checked) {
				var chk_abr = "1";
				}
				else{
					var chk_abr = "0";
				}
				
				if(document.getElementById('chk_impact').checked) {
				var chk_impact = "1";
				}
				else{
					var chk_impact = "0";
				}
				
				
				
				if(document.getElementById('chk_sp').checked) {
				var chk_sp = "1";
				}
				else{
					var chk_sp = "0";
				}
				
				
				if(document.getElementById('chk_flk').checked) {
				var chk_flk = "1";
				}
				else{
					var chk_flk = "0";
				}
				
				if(document.getElementById('chk_elo').checked) {
				var chk_elo = "1";
				}
				else{
					var chk_elo = "0";
				}
				
				if(document.getElementById('chk_elo').checked) {
				var chk_elo = "1";
				}
				else{
					var chk_elo = "0";
				}
				
				
				
				if(document.getElementById('chk_grd').checked) {
				var chk_grd = "1";
				}
				else{
					var chk_grd = "0";
				}
				
						
				var txt_id1 = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&txt_id='+txt_id1+'&get_of_srno='+get_of_srno+'&get_srno='+get_srno+'&txt_jobno='+txt_jobno+'&txt_ref='+txt_ref+'&ref_date='+ref_date+'&txt_day='+txt_day+'&txt_date='+txt_date+'&txt_brand='+txt_brand+'&detail_sample='+detail_sample+'&id_mark='+id_mark+'&start_date='+start_date+'&end_date='+end_date+'&con_sample='+con_sample+'&sp_w_b_a1_1='+sp_w_b_a1_1+'&abr_wt_t_a_1='+abr_wt_t_a_1+'&imp_w_m_a_1='+imp_w_m_a_1+'&sp_w_b_a2_1='+sp_w_b_a2_1+'&abr_wt_t_b_1='+abr_wt_t_b_1+'&imp_w_m_b_1='+imp_w_m_b_1+'&sp_w_sur_1='+sp_w_sur_1+'&sp_w_sur_2='+sp_w_sur_2+'&abr_wt_t_c_1='+abr_wt_t_c_1+'&imp_w_m_c_1='+imp_w_m_c_1+'&sp_w_s_1='+sp_w_s_1+'&size_of_sample='+size_of_sample+'&sp_specific_gravity='+sp_specific_gravity+'&sp_water_abr='+sp_water_abr+'&abr_index='+abr_index+'&fi_index='+fi_index+'&ei_index='+ei_index+'&imp_value='+imp_value+'&sieve_1='+sieve_1+'&sieve_2='+sieve_2+'&sieve_3='+sieve_3+'&sieve_4='+sieve_4+'&sieve_5='+sieve_5+'&cum_wt_gm_1='+cum_wt_gm_1+'&cum_wt_gm_2='+cum_wt_gm_2+'&cum_wt_gm_3='+cum_wt_gm_3+'&cum_wt_gm_4='+cum_wt_gm_4+'&cum_wt_gm_5='+cum_wt_gm_5+'&ret_wt_gm_1='+ret_wt_gm_1+'&ret_wt_gm_2='+ret_wt_gm_2+'&ret_wt_gm_3='+ret_wt_gm_3+'&ret_wt_gm_4='+ret_wt_gm_4+'&ret_wt_gm_5='+ret_wt_gm_5+'&cum_ret_1='+cum_ret_1+'&cum_ret_2='+cum_ret_2+'&cum_ret_3='+cum_ret_3+'&cum_ret_4='+cum_ret_4+'&cum_ret_5='+cum_ret_5+'&pass_sample_1='+pass_sample_1+'&pass_sample_2='+pass_sample_2+'&pass_sample_3='+pass_sample_3+'&pass_sample_4='+pass_sample_4+'&pass_sample_5='+pass_sample_5+'&blank_extra='+blank_extra+'&sp_sample_ca='+sp_sample_ca+'&sp_w_b_a1_2='+sp_w_b_a1_2+'&sp_w_b_a2_2='+sp_w_b_a2_2+'&sp_wt_st_1='+sp_wt_st_1+'&sp_wt_st_2='+sp_wt_st_2+'&sp_w_s_2='+sp_w_s_2+'&sp_specific_gravity_1='+sp_specific_gravity_1+'&sp_specific_gravity_2='+sp_specific_gravity_2+'&sp_water_abr_1='+sp_water_abr_1+'&sp_water_abr_2='+sp_water_abr_2+'&abr_sample_abr='+abr_sample_abr+'&imp_w_m_a_2='+imp_w_m_a_2+'&imp_w_m_b_2='+imp_w_m_b_2+'&imp_w_m_c_2='+imp_w_m_c_2+'&imp_value_1='+imp_value_1+'&imp_value_2='+imp_value_2+'&m1='+m1+'&m2='+m2+'&m3='+m3+'&m4='+m4+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&suma='+suma+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&sumb='+sumb+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&e1='+e1+'&e2='+e2+'&e3='+e3+'&aa1='+aa1+'&aa2='+aa2+'&aa3='+aa3+'&sumaa='+sumaa+'&bb1='+bb1+'&bb2='+bb2+'&bb3='+bb3+'&sumbb='+sumbb+'&cc1='+cc1+'&cc2='+cc2+'&cc3='+cc3+'&dd1='+dd1+'&dd2='+dd2+'&dd3='+dd3+'&ee1='+ee1+'&ee2='+ee2+'&ee3='+ee3+'&w1='+w1+'&w2='+w2+'&wsum='+wsum+'&ga1='+ga1+'&ga2='+ga2+'&gasum='+gasum+'&gb1='+gb1+'&gb2='+gb2+'&gbsum='+gbsum+'&gc1='+gc1+'&gc2='+gc2+'&gcsum='+gcsum+'&gd1='+gd1+'&gd2='+gd2+'&gdsum='+gdsum+'&ge1='+ge1+'&ge2='+ge2+'&gesum='+gesum+'&s1='+s1+'&s2='+s2+'&month_name='+month_name+'&specification='+specification+'&source='+source+'&rec_sample_date='+rec_sample_date+'&sample_id='+sample_id+'&sample_taken='+sample_taken+'&chk_abr='+chk_abr+'&chk_impact='+chk_impact+'&chk_sp='+chk_sp+'&chk_flk='+chk_flk+'&chk_elo='+chk_elo+'&chk_grd='+chk_grd+'&m1_1='+m1_1+'&m2_1='+m2_1+'&m3_1='+m3_1+'&m4_1='+m4_1;	
    }
	else{
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
	
				billData = 'action_type='+type+'&id='+id+'&get_of_srno='+get_of_srno;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save53_22_4.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
         
                getGlazedTiles();
				
					$('#txt_jobno').val(msg.txt_jobno);	 
	
        }
    });
}

function editData(id){
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: '<?php echo $base_url; ?>save53_22_4.php',
        data: 'action_type=data&id='+id+'&get_of_srno='+get_of_srno,
        success:function(data){
            $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();
	
            	var job_month1 = data.job_no;
			var job_nos = job_month1.substring(4);
			var job_month = job_month1.slice(0,4);
			//alert(job_month);
            $('#txt_jobno').val(job_nos);
            $('#month_name').val(job_month);            
            $('#txt_day').val(data.days);
            $('#txt_date').val(data.date);
            $('#txt_ref').val(data.ref_name);
            $('#ref_date').val(data.ref_date);
            $('#txt_brand').val(data.id_brand);
            $('#detail_sample').val(data.detail_sample);
            $('#id_mark').val(data.id_mark);
            $('#start_date').val(data.start_date);
            $('#end_date').val(data.end_date);
            $('#con_sample').val(data.con_sample);
            $('#specification').val(data.specification);
            $('#source').val(data.source);
            $('#rec_sample_date').val(data.rec_sample_date);
            $('#sample_id').val(data.sample_id);
            $('#sample_taken').val(data.sample_taken);
			
			$('#cum_wt_gm_1').val(data.cum_wt_gm_1);
			$('#cum_wt_gm_2').val(data.cum_wt_gm_2);
			$('#cum_wt_gm_3').val(data.cum_wt_gm_3);
			$('#cum_wt_gm_4').val(data.cum_wt_gm_4);
			$('#cum_wt_gm_5').val(data.cum_wt_gm_5);
			
			$('#ret_wt_gm_1').val(data.ret_wt_gm_1);
			$('#ret_wt_gm_2').val(data.ret_wt_gm_2);
			$('#ret_wt_gm_3').val(data.ret_wt_gm_3);
			$('#ret_wt_gm_4').val(data.ret_wt_gm_4);
			$('#ret_wt_gm_5').val(data.ret_wt_gm_5);
			
			$('#cum_ret_1').val(data.cum_ret_1);
			$('#cum_ret_2').val(data.cum_ret_2);
			$('#cum_ret_3').val(data.cum_ret_3);
			$('#cum_ret_4').val(data.cum_ret_4);
			$('#cum_ret_5').val(data.cum_ret_5);
			
			$('#pass_sample_1').val(data.pass_sample_1);
			$('#pass_sample_2').val(data.pass_sample_2);
			$('#pass_sample_3').val(data.pass_sample_3);
			$('#pass_sample_4').val(data.pass_sample_4);
			$('#pass_sample_5').val(data.pass_sample_5);
			
			$('#blank_extra').val(data.blank_extra);
			
			
			
			//FLAKINESS & ELONGATION
			$('#fi_index').val(data.fi_index);
			$('#a1').val(data.a1);
			$('#a2').val(data.a2);
			$('#a3').val(data.a3);
			$('#suma').val(data.suma);

			$('#b1').val(data.b1);
			$('#b2').val(data.b2);
			$('#b3').val(data.b3);
			$('#sumb').val(data.sumb);			
								
			$('#c1').val(data.c1);
			$('#c2').val(data.c2);
			$('#c3').val(data.c3);					
			
			$('#d1').val(data.d1);
			$('#d2').val(data.d2);
			$('#d3').val(data.d3);					
			
			$('#e1').val(data.e1);
			$('#e2').val(data.e2);
			$('#e3').val(data.e3);									
			
			$('#ei_index').val(data.ei_index);									
		
			$('#aa1').val(data.aa1);
			$('#aa2').val(data.aa2);
			$('#aa3').val(data.aa3);
			$('#sumaa').val(data.sumaa);

			$('#bb1').val(data.bb1);
			$('#bb2').val(data.bb2);
			$('#bb3').val(data.bb3);
			$('#sumbb').val(data.sumbb);			
								
			$('#cc1').val(data.cc1);
			$('#cc2').val(data.cc2);
			$('#cc3').val(data.cc3);					
			
			$('#dd1').val(data.dd1);
			$('#dd2').val(data.dd2);
			$('#dd3').val(data.dd3);					
			
			$('#ee1').val(data.ee1);
			$('#ee2').val(data.ee2);
			$('#ee3').val(data.ee3);
			
						
				
			//specific gravity and water abr
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

			
			
			
			//Abrasion
			$('#abr_index').val(data.abr_index);			
			$('#abr_wt_t_a_1').val(data.abr_wt_t_a_1);			
			$('#abr_wt_t_b_1').val(data.abr_wt_t_b_1);			
			$('#abr_wt_t_c_1').val(data.abr_wt_t_c_1);			
			$('#abr_sample_abr').val(data.abr_sample_abr);									
			
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
			sieve_1=data.sieve_1;
			sieve_2=data.sieve_2;
			sieve_3=data.sieve_3;
			sieve_4=data.sieve_4;
			sieve_5=data.sieve_5;
			var chk_abr,chk_elo,chk_flk,chk_grd,chk_impact,chk_sp;
			chk_abr = data.chk_abr;
			chk_elo = data.chk_elo;
			chk_flk = data.chk_flk;
			chk_grd = data.chk_grd;
			chk_impact = data.chk_impact;
			chk_sp = data.chk_sp;			
			if(chk_abr=="1")
			{
			   $("#chk_abr").prop("checked", true); 
			}
			else
			{
				$("#chk_abr").prop("checked", false); 
			}
			
			if(chk_impact=="1")
			{
			   $("#chk_impact").prop("checked", true); 
			}else{
				$("#chk_impact").prop("checked", false); 
			}				
			
			
			if(chk_sp=="1")
			{
			   $("#chk_sp").prop("checked", true); 
			}
			
			
			if(chk_flk=="1")
			{
			   $("#chk_flk").prop("checked", true); 
			}
			
			if(chk_elo=="1")
			{
			   $("#chk_elo").prop("checked", true); 
			}
			
			
			
			if(chk_grd=="1")
			{
			   $("#chk_grd").prop("checked", true); 
			}
			
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}



</script>


