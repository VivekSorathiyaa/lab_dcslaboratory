<?php include("header.php");?>
<?php 
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}

if(isset($_POST["save_next"]))
{
	$txt_final_trf_no= $_POST["txt_final_trf_no"];
	$var_ex_date_submission = $_POST['ex_date_submission'];
	$date_ex_date_submission = str_replace('/', '-', $var_ex_date_submission);
	$ex_date_submission =  date('Y-m-d', strtotime($date_ex_date_submission));
	$morr= "r";
	$txt_tested_by= $_POST["txt_tested_by"];
	$txt_reported_by= $_POST["txt_reported_by"];
	$current_date= date('Y-m-d');
	// gt final material counts
	
   $select_mate_counts="select `final_material_id`,`material_category` from final_material_assign_master WHERE `is_deleted`=0 AND `temporary_trf_no`='$txt_final_trf_no' AND `created_by_id`='$_SESSION[u_id]' ORDER BY final_material_id ASC";
	
	$result_mate_counts=mysqli_query($conn,$select_mate_counts);
	$get_counts_of_materials=mysqli_num_rows($result_mate_counts);
	
		if($get_counts_of_materials > 0)
		{
			$sel_jobs="select * from job where `temporary_trf_no`='$txt_final_trf_no'";
		    $result_jobs_date=mysqli_query($conn,$sel_jobs);
		    $get_jobs_result=mysqli_fetch_array($result_jobs_date);
			$sample_rec_date=$get_jobs_result["sample_rec_date"];
			$nabl_type=$get_jobs_result["nabl_type"];
			
			$sel_save_table="select * from save_material_assign where `created_date`='$sample_rec_date' ORDER BY `sm_id` DESC";
			$query_save_entry=mysqli_query($conn,$sel_save_table);
			
			
			if(mysqli_num_rows($query_save_entry)>0)
			{
				// if record available in save_material_assign table
				$result_save_mate=mysqli_fetch_assoc($query_save_entry);
				
				$sub_str_trf= substr($result_save_mate["trf_no"],6);
				$vars = ltrim($sub_str_trf, '0');
				$plused= intval($vars)+1;
				$set_trf_no1= sprintf('%02d', $plused);
				$date_set= date("ymd", strtotime($sample_rec_date));
				$set_trf_no= $date_set.$set_trf_no1;
				$set_job_no= $date_set.$set_trf_no1;
				$set_lab_no= intval($result_save_mate["lab_no_counts"]) + intval($get_counts_of_materials);
				$set_old_count = intval($result_save_mate["lab_no_counts"])+1;
			}
			else
			{
				// if record Not available in save_material_assign table
				$date_set= date("ymd", strtotime($sample_rec_date));
				$set_trf_no1= sprintf('%02d', 1);
					
				$set_trf_no= $date_set.$set_trf_no1;
				$set_job_no= $date_set.$set_trf_no1;
				$set_lab_no= $get_counts_of_materials;
				$set_old_count = 1;
			}
			
			//set trf no by logic
			$set_date_for_squence= $date_set= date("dm", strtotime($sample_rec_date));
			$sel_first="select * from report_seq where `startdate` LIKE '%$set_date_for_squence%'";
			$query_first=mysqli_query($conn,$sel_first);
			$result_first= mysqli_fetch_array($query_first);
			
			$first_letter_of_trf= $result_first["rep_prefix"];
			
			
			$sel_second="select * from fyearmaster where `id`=".$_SESSION["fy_id"];
			$query_second=mysqli_query($conn,$sel_second);
			$result_second= mysqli_fetch_array($query_second);
			
			$second_letter_of_trf= $result_second["ulr_prefix"];
			
			// get
			$joint_letter=$first_letter_of_trf.$second_letter_of_trf;
			$sel_table="select * from save_material_assign where `trf_no` LIKE '%$joint_letter%' ORDER BY `sm_id` DESC";
			$query_save=mysqli_query($conn,$sel_table);
			
			if(mysqli_num_rows($query_save) > 0)
			{
				$result_save=mysqli_fetch_assoc($query_save);
				$explode_trfs= explode("-",$result_save["trf_no"]);
				$plusing= intval($explode_trfs[1])+1;
				$set_plusing= sprintf('%04d', $plusing);
				
				$set_trf_no= $explode_trfs[0]."-".$set_plusing;
				$set_job_no= $explode_trfs[0]."-".$set_plusing;
			}
			else
			{
				$set_trf_no= $joint_letter."-"."0001";
				$set_job_no= $joint_letter."-"."0001";
			}
			
			$insert_save_mate="insert into save_material_assign (`lab_no_counts`,`temporary_trf_no`,`trf_no`, `job_no`, `isstatus`, `created_by`, `created_date`, `modified_by`, `modified_date`,`nabl_type`) 
						values(
						'$set_lab_no',
						'$txt_final_trf_no',
						'$set_trf_no',
						'$set_job_no',
						 1,
						'$_SESSION[u_id]',
						'$sample_rec_date',
						'',
						'0000-00-00',
						'$nabl_type')";
						$query_save_entry=mysqli_query($conn,$insert_save_mate);
						
			$final_id_array=array();
			$final_mat_cat_array=array();
			$array_tested_by=array();
		    $array_tested_status=array();
			while($one_final_id=mysqli_fetch_array($result_mate_counts))
			{
				array_push($final_id_array,$one_final_id["final_material_id"]);
				array_push($final_mat_cat_array,$one_final_id["material_category"]);
				
				$select_eng_by_mat_cat_id="select `material_engineer` from material_category where `material_cat_id`='$one_final_id[material_category]'";
				$query_eng_by_mat_cat_id=mysqli_query($conn,$select_eng_by_mat_cat_id);
				
				if(mysqli_num_rows($query_eng_by_mat_cat_id) > 0)
				{
					$result_engineers= mysqli_fetch_array($query_eng_by_mat_cat_id);
					if (!in_array($result_engineers["material_engineer"], $array_tested_by))
					{
						array_push($array_tested_by,$result_engineers["material_engineer"]);
						array_push($array_tested_status,"0");
					}
				}
			}
			
			$implode_tested_by=implode(",",$array_tested_by);
		    $implode_tested_by_status=implode(",",$array_tested_status);
			
			// update one entry in job table
			$update_jobs="update job set `material_assign`=1,`trf_no`='$set_trf_no', `tested_by`='$implode_tested_by',`tested_by_status`='$implode_tested_by_status',`light_indication`='1',`material_assign`=1 where `temporary_trf_no`='$txt_final_trf_no'";
			$result_jobs=mysqli_query($conn,$update_jobs);
			
			$sel_job="select * from job where `trf_no`='$set_trf_no'";
		    $result_job_date=mysqli_query($conn,$sel_job);
		    $get_job_result=mysqli_fetch_array($result_job_date);
			$job_inserted_date=$get_job_result["sample_rec_date"];
		    
		    $set_only_year= date("y", strtotime($job_inserted_date));
			
			$counting=0;
			$reports_last_no=1;
			
			//get last ulr no and plus 1 in it
			$sel_last_of_ulr="select * from ulr_sequence ORDER BY ulr_sequence_id DESC";
			$query_last_of_ulr=mysqli_query($conn,$sel_last_of_ulr);
			if(mysqli_num_rows($query_last_of_ulr) > 0)
			{
				$result_last_of_ulr=mysqli_fetch_assoc($query_last_of_ulr);
				$get_last_ulr_no= intval($result_last_of_ulr["ulr_sequence"]);
				$ulr_counts= intval($get_last_ulr_no)+1;
			}else{
				$ulr_counts= 1;
			}
			
			for($i=1;$i<=$get_counts_of_materials;$i++)
			{
				//$set_counts_no= sprintf('%02d', $reports_last_no);
				//$set_report_nos= $h_sr."/".$set_trf_no.$set_only_year."/".$set_counts_no;
				$txt_set_lab_nos= $set_trf_no.".".$i;
				$txt_final_ulr_no= sprintf('%09d', $i);
				
				$sel_mate_cate_name="select `material_cat_name` from material_category where `material_cat_id`=".$final_mat_cat_array[$counting];
				$query_mate_cate_name=mysqli_query($conn,$sel_mate_cate_name);
				$result_mate_cate_name=mysqli_fetch_array($query_mate_cate_name);
				
				$get_one_only=substr($result_mate_cate_name["material_cat_name"],0,1);
				
				$first_of_trf=substr($set_trf_no,0,1);
				$remain_of_trf=substr($set_trf_no,1);
				
				$set_report_nos= "B".$first_of_trf.$get_one_only.$remain_of_trf.".".$i;
				
				
				// update final material table
				$update_final_mate="update final_material_assign_master set `trf_no`='$set_trf_no',`job_no`='$set_job_no',`lab_no`='$txt_set_lab_nos',`report_no`='$set_report_nos',`is_status`=1 where `final_material_id`=".$final_id_array[$counting];
			    $result_final_mate=mysqli_query($conn,$update_final_mate);
				
				// update final material table for ulr no if job type nabl
				if($nabl_type=="nabl")
				{
					$update_ulrs="update final_material_assign_master set `ulr_no`='$ulr_counts' where `final_material_id`=".$final_id_array[$counting];
					mysqli_query($conn,$update_ulrs);
					
					//insert in ulr sequence table
					$insert_ulr="insert into ulr_sequence (`ulr_sequence`,`ulr_sequence_date`,`table_primary_key_id`,`ulr_from_type_id_fix`,`created_date`,`created_by`,`modified_date`,`modified_by`,`company_year_id`,`company_id`) 
					values(
					'$ulr_counts',
					'$sample_rec_date',
					'$final_id_array[$counting]',
					'2',
					'$current_date',
					'$_SESSION[u_id]',
					'$current_date',
					'$_SESSION[u_id]',
					'1',
					'1')";
					mysqli_query($conn,$insert_ulr);
				}
				
				//update span_save_material table by final material ids
				
				$update_span_material="update span_material_assign set `trf_no`='$set_trf_no',`job_number`='$set_job_no',`lab_no`='$txt_set_lab_nos',`is_save`='1' where `final_material_id`='$final_id_array[$counting]'";
				
				$result_span_material=mysqli_query($conn,$update_span_material);
				
				
				
				$counting++;
				$reports_last_no++;
				$ulr_counts++;
			}  
			    //update test_wise_master table by temporarory trf_no
				$update_test_wise_master="update test_wise_material_rate set `trf_no`='$set_trf_no',`job_no`='$set_job_no' where `temporary_trf_no`='$txt_final_trf_no'";
				$result_test_wise_master=mysqli_query($conn,$update_test_wise_master);
			
			
			
		}else
		{
			?>
			<script >
				window.location.href="<?php echo $base_url; ?>index.php";
			</script>
			<?php
		}		 
	//report no genrate code Stop
	
	?>
	<script >
	alert("TRF SAVED SUCEESSFULLY .. \n Your TRF No.is : <?php echo $set_trf_no; ?>");
	window.location.href="job_listing_for_second_reception.php";
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





.mede_class{
	color:red;
}
.select2{
	
	width:200px;
}
.visually-hidden {
    position: absolute;
    left: -100vw;
    
    /* Note, you may want to position the checkbox over top the label and set the opacity to zero instead. It can be better for accessibilty on some touch devices for discoverability. */
}

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   <?php
  //set session job and report no
  ?>
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		Material Selection
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									
									<div class="col-lg-12">
									<label for="inputEmail3" class="col-sm-2 control-label">Token No:</label>
											
										  <div class="col-sm-2">
											<input type="text" class="form-control" value="<?php echo $_GET['temporary_trf_no'];?>" id="txt_trf_no" name="txt_trf_no" readonly>
										  </div>
										<div class="form-group">
										
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">Lab No:</label>-->
										  
										  <div class="col-sm-3">
												<div class="input-group date">
													<input type="hidden" class="form-control" value="<?php echo $_GET['temporary_trf_no'];?>" id="txt_job_no" name="txt_job_no" >
											</div>
										</div>
									</div>
								
								</div>
							</div>
							<div class="panel-group">
							  
								<a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="width:100%;margin-top: 2%;font-size: 20px;" id="add_material_button">Add Material</a>
								<div id="collapse1" class="panel-collapse collapse">
								<br>
								<form class="form" id="add_mate_form" method="post">
								
								<div class="row">
									<div class="col-md-4">
									<label for="exampleInputEmail1">Select Category<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-4">
									<label for="exampleInputEmail1">Select Material<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-4">
									<label for="exampleInputEmail1">Expec. submission Date:</label>
									</div>
									
								</div>
								  <div class="row">
								  <div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control select2" name="select_material_category" id="select_material_category" >
													<option value="">Select Category</option>
													<?php 
													$sql = "select * from material_category where `material_cat_status`='1' AND `material_cat_isdelete`='0'";
												
													$result = mysqli_query($conn, $sql);

													if (mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
													
													?>
			
													<option value="<?php echo $row['material_cat_id'];?>"><?php echo $row['material_cat_name'];?></option>
													<?php }}?>
												</select>
											</div>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
											<select class="form-control select2" name="select_material" id="select_material">
													<option value="">Select Material</option>
													
											</select>
												<!--<a href="javascript:void(0)" id="get_more" class=" btn btn-primary"><i class="fa fa-undo" aria-hidden="true"></i></a>-->
												<!--<input type="hidden" value="20" id="get_more_count">-->
											</div>
											
										</div>
									</div>
									
								
									
									<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
												<div class="col-sm-12">
												<input type="text"  style="height:30px;" name="ex_date_submission" id="ex_date_submission" value="<?php echo date('d/m/Y')?>">
											</div>
											</div>
										</div>
									</div>
									
										
								</div>
								<br>
								<div class="row">
									<div class="col-md-4">
									<label for="exampleInputEmail1">Sample Conditon:</label><br>
									
									</div>
									<div class="col-md-4">
									<label for="exampleInputEmail1">Location:</label><br>
									
									</div>
									
									
								</div>
								
								<div class="row">
									<div class="col-md-4">
									<div class="form-group">
											
											<div class="col-sm-12">
									<select class="form-control select2" name="select_samp_condition" id="select_samp_condition">
										<option value="">Select Conditon</option>
										<option value="1" selected>Sealed</option>
										<option value="2">Unsealed</option>
										<option value="3">Good</option>
										<option value="4">Poor</option>
									</select>
									</div>
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
											
											<div class="col-sm-12">
									<select class="form-control select2" name="select_location" id="select_location">
										<option value="">Select Location</option>
										<option value="1" selected>In Laboratory</option>
										<option value="2">On Site</option>
									</select>
									</div>
									</div>
									</div>
									
									
								</div>
								  <br>
								<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<form class="form" id="billing" method="post">
							<div class="panel-group">
								<div class="panel panel-default">
									<br>
									<div class="panel-heading">
										<h4 class="panel-title" style="text-align:center;">
											<a data-toggle="collapse" href="#collapse2" class="btn btn-primary" style="color:white;width:100%;" aria-expanded="true"><b>Type Of Sample</b></a>
										</h4>
									</div><br>
									<div id="collapse2" class="panel-collapse collapse in" aria-expanded="true">
										<div class="panel-body">
											<div class="row material_class" id="CM">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Cement</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
																<label>Type Of Cement</label>
																<select class="form-control" id="type_of_cement" name="type_of_cement">
																	<option value="OPC">OPC</option>
																	<option value="PPC">PPC</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
																<label>Grade</label>
																<select class="form-control" id="cement_grade" name="cement_grade">
																	<option value="53 OPC">53 OPC</option>
																	<option value="43 OPC">43 OPC</option>
																	<option value="33 OPC">33 OPC</option>
																	<option value="PPC">PPC</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Brand</label>
															  <input type="text" class="form-control" id="cement_brand" name="cement_brand" placeholder="Brand">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Week No.</label>
															  <input type="text" class="form-control" id="week_no" name="week_no" placeholder="Week No.">
															</div>
														</div>
													</div>
												</div>
													
												<div class="row material_class" id="CA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Aggregate</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">
													<div class="col-md-3">
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Source</label>
																  <input type="text" class="form-control" id="brick_source" name="brick_source" placeholder="Source">
																</div>
															</div>
												</div>
												<div class="col-md-3">
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Sample Description</label>
																  <input type="text" class="form-control" id="sample_de" name="sample_de" placeholder="Sample Description">
																</div>
															</div>
												</div>
												</div>
												
												<div class="row material_class" id="BR">
													<div class="col-md-12">
														<h4 style="text-align:center;"><b>Brick</b></h4>
													</div>
													<hr style="border: 1px solid #ddd;">
													
														
														<div class="col-md-6">
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Mark</label>
																  <input type="text" class="form-control" id="mark" name="mark" style="text-transform:uppercase;" placeholder="Mark">
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="box-body">
																<div class="form-group">
																	<label>Specification</label>
																	<select class="form-control" id="brick_specification" name="brick_specification">
																		<option value="3.5">3.5</option>
																		<option value="5">5</option>
																		<option value="7.5">7.5</option>
																		<option value="10">10</option>
																		<option value="12.5">12.5</option>
																		<option value="15">15</option>
																		<option value="17.5">17.5</option>
																		<option value="20">20</option>
																		<option value="25">25</option>
																		<option value="30">30</option>
																		<option value="35">35</option>
																	</select>
																</div>
															</div>
														</div>
													
												</div>
												
												
												<div class="row material_class" id="BT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Tanker No.</label>
															  <input type="text" class="form-control" id="tanker_no" name="tanker_no" placeholder="Tanker No">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Lot No.</label>
															  <input type="text" class="form-control" id="lot_no" name="lot_no" placeholder="Lot No.">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
																<label>Grade</label>
																<select class="form-control" id="bitumin_grade" name="bitumin_grade">
																	<option value="vg-10">VG-10</option>
																	<option value="vg-20">VG-20</option>
																	<option value="vg-30">VG-30</option>
																	<option value="vg-40">VG-40</option>
																	
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Make</label>
															  <input type="text" class="form-control" id="make" name="make" placeholder="Make">
															</div>
														</div>
													</div>
												</div>
												
												
												<div class="row material_class" id="CC">
												<div class="col-md-12">
													<!--<h4 style="text-align:center;"><b>C C Cube</b></h4>-->
												</div>
												<hr style="border: 1px solid #ddd;">
													<div class="col-md-4">
														<div class="box-body col-sm-6">
															<div class="form-group">
																<label>Grade</label>
																<select class="form-control" id="cube_grade" name="cube_grade">
																	<option value="">Grade</option>
																	<option value="M-10">M - 10</option>
																	<option value="M-15">M - 15</option>
																	<option value="M-20">M - 20</option>
																	<option value="M-25">M - 25</option>
																	<option value="M-30">M - 30</option>
																	<option value="M-35">M - 35</option>
																	<option value="M-40">M - 40</option>
																	<option value="M-45">M - 45</option>
																	<option value="M-50">M - 50</option>
																	<option value="1:3:6">1:3:6</option>
																	<option value="1:2:4">1:2:4</option>
																	<option value="1:1.5:3">1:1.5:3</option>
																	<option value="1:5">1:5</option>
																	<option value="1:3">1:3</option>
																	
																</select>
															</div>
														</div>
														
														<div class="box-body col-sm-5">
															<div class="form-group">
															  <label for="exampleInputEmail1">Casting Date</label>
														<input type="text" class="form-control" id="casting_date" name="casting_date" placeholder="Casting Date" value="">
															</div>
														</div>
														
													</div>
													<div class="col-md-4">
														
														<div class="box-body col-sm-4">
															<div class="form-group">
																<label>Day</label>
															<select class="form-control" id="day" name="day">
																<option value="7">7 Days</option>
																<option value="28">28 Days</option>
																<!--<option value="7_28">7 & 28 Days</option>-->
																<option value="other">Other</option>
																	
																</select>
															</div>
														</div>
														
														<div class="box-body col-sm-6 only_remark">
															<div class="form-group">
															  <label for="exampleInputEmail1">Remarks</label>
															  <input type="text" class="form-control" id="day_remark" name="day_remark" placeholder="Remarks">
															</div>
														</div>
													
													</div>
													<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Identification Mark</label>
															  <input type="text" class="form-control" id="cc_identification" name="cc_identification" placeholder="Identification Mark" Value="">
															</div>
														</div>
													</div>
													
													<input type="hidden" class="form-control" id="set_of_cube" name="set_of_cube"  Value="1">
															
													
													<input type="hidden" class="form-control" id="no_of_cube" name="no_of_cube" value="3" disabled>
															
												</div>
												
												
												<div class="row material_class" id="PB">
													<div class="col-md-12">
													<h4 style="text-align:center;"><b>Paver Block</b></h4>
													</div>
													<hr style="border: 1px solid #ddd;">
													<div class="col-md-5">
														<div class="box-body col-sm-6">
															<div class="form-group">
															  <label for="exampleInputEmail1">Shape</label>
															  <select class="form-control" id="shape" name="shape">
																<option value="i_shape">I - Shape</option>
																<option value="zigzag">Zigzag</option>
																<option value="damru">Damru</option>
																<option value="plain">Plain</option>
															   </select>
															  
															</div>
														</div>
													
														<div class="box-body col-sm-6">
															<div class="form-group">
															  <label for="exampleInputEmail1">Age</label>
															  <input type="text" class="form-control" id="age" name="age" placeholder="Age">
															</div>
														</div>
													</div>
													<div class="col-md-5">
														<div class="box-body col-sm-6">
															<div class="form-group">
															  <label for="exampleInputEmail1">Color</label>
															  <input type="text" class="form-control" id="color" name="color" placeholder="Color">
															</div>
														</div>
													
														<div class="box-body col-sm-6">
															<div class="form-group">
															  <label for="exampleInputEmail1">Thickness(mm)</label>
															  <select class="form-control" id="thickness" name="thickness">
																<option value="">Select Thickness</option>
																<option value="50">50</option>
																<option value="60">60</option>
																<option value="80">80</option>
																<option value="100">100</option>
																<option value="120">120</option>
																
															   </select>
															</div>
														</div>
													</div>
													<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Grade</label>
															  <select class="form-control" id="paver_grade" name="paver_grade">
																<option value="">Select Grade</option>
																<option value="M-20">M - 20</option>
																<option value="M-25">M - 25</option>
																<option value="M-30">M - 30</option>
																<option value="M-35">M - 35</option>
																<option value="M-40">M - 40</option>
																<option value="M-45">M - 45</option>
																<option value="M-50">M - 50</option>
																<option value="M-55">M - 55</option>
																<option value="M-60">M - 60</option>
																
																
															   </select>
															</div>
														</div>
													</div>
												</div>
												
												<div class="row material_class" id="SO">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Soil</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">
												<div class="col-md-2">
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Sample Type</label>
																  <input type="text" class="form-control" id="sample_type" name="sample_type" placeholder="Sample Type">
																</div>
															</div>
														</div>
												<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Source</label>
															  <input type="text" class="form-control" id="soil_source" name="soil_source" placeholder="Soil Source">
															</div>
														</div>
												</div>
												</div>
												
												<div class="row  material_class" id="ST">
													
													<div class="col-md-12">
														<h4 style="text-align:center;"><b>Steel</b></h4>
													</div>
													<hr style="border: 1px solid #ddd;">
															<div class="box-body col-md-4" >
																<div class="form-group">
																	<label>Dia (mm)</label>
																	<input type="text" class="form-control" id="dia" name="dia" placeholder="Dia">
																	
																</div>
															</div>
															<div class="box-body col-md-4" >
																<div class="form-group">
																	<label>Grade</label>
																	<select class="form-control" id="steel_grade" name="steel_grade">
																		<option value="FE 415">FE 415</option>
																		<option value="FE 415 D">FE 415 D</option>
																		<option value="FE 500">FE 500</option>
																		<option value="FE 500 D">FE 500 D</option>
																		<option value="FE 550">FE 550</option>
																		<option value="FE 550 D">FE 550 D</option>
																		
																	</select>
																</div>
															</div>
															<div class="box-body col-md-4">
																<div class="form-group">
																  <label for="exampleInputEmail1">Brand</label>
																  <input type="text" class="form-control" id="steel_brand" name="steel_brand" placeholder="Brand">
																</div>
															</div>
														
												
												</div>
												
												<div class="row  material_class" id="WA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Water</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">
												<div class="box-body col-md-3">
																<div class="form-group">
																  <label for="exampleInputEmail1">Source</label>
																  <input type="text" class="form-control" id="tile_source" name="tile_source" placeholder="Source">
																</div>
															</div>
												
												</div>
																						
												<div class="row  material_class" id="TI">
													
														<div class="col-md-12">
															<h4 style="text-align:center;"><b>Tiles</b></h4>
														</div>
													<hr style="border: 1px solid #ddd;">	
														
														<div class="col-md-6">
															<div class="box-body">
																<div class="form-group">
																	<label>Specification</label>
																	<input type="text" class="form-control" id="tiles_specification" name="tiles_specification" placeholder="Specification">
																</div>
															</div>
														</div>
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Brand</label>
																  <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand">
																</div>
															</div>
														</div>
														
													
												</div>
												
												<div class="row  material_class" id="FA">
													
														<div class="col-md-12">
															<h4 style="text-align:center;"><b>Fine Aggregate</b></h4>
														</div>
													<hr style="border: 1px solid #ddd;">	
														
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Fine Aggregate Source</label>
																  <input type="text" class="form-control" id="fine_agg_source" name="fine_agg_source" placeholder="Fine Aggregate Source">
																</div>
															</div>
														</div>
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Fine Aggregate Type</label>
																  <input type="text" class="form-control" id="fine_agg_type" name="fine_agg_type" placeholder="Fine Aggregate Type">
																</div>
															</div>
														</div>
														
														
												</div>
												
												<div class="row  material_class" id="QU">
													
														<div class="col-md-12">
															<h4 style="text-align:center;"><b>Quarry Spall</b></h4>
														</div>
													<hr style="border: 1px solid #ddd;">	
														
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Quarry Spall Source</label>
																  <input type="text" class="form-control" id="qa_spall_source" name="qa_spall_source" placeholder="Quarry Spall Source">
																</div>
															</div>
														</div>
														
														
												</div>
												
												
												<div class="row  material_class" id="FT">
													
														<div class="col-md-12">
															<h4 style="text-align:center;"><b>Field Test</b></h4>
														</div>
													<hr style="border: 1px solid #ddd;">	
														
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Chainage No.</label>
																  <input type="text" class="form-control" id="chainage_no" name="chainage_no" placeholder="Enter Chainage No.">
																</div>
															</div>
														</div><div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Sample Description.</label>
																  <input type="text" class="form-control" id="fdd_desc_sample" name="fdd_desc_sample" placeholder="Enter Sample Description." Value="GSB">
																</div>
															</div>
														</div>
														
														
												</div>
												
												<div class="row  material_class" id="BM">
													
														<div class="col-md-12">
															<h4 style="text-align:center;"><b>Bitumin Mix</b></h4>
														</div>
													<hr style="border: 1px solid #ddd;">	
														
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Bitumin Specification</label>
																  
																  <select class="form-control" id="bitumin_mix" name="bitumin_mix">
																		<option value="BC-I">BC-I</option>
																		<option value="BC-II">BC-II</option>
																		<option value="DBM-I">DBM-I</option>
																		<option value="DBM-II">DBM-II</option>
																		<option value="SDBC-I">SDBC-I</option>
																		<option value="SDBC-II">SDBC-II</option>
																		
																	</select>
																</div>
															</div>
														</div>
														
														
												</div>
												</div>
											  <!-- /.box-body -->

											  
										
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
								<hr style="border:var(--primary) 2px solid;">
								<div class="row">
									<div class="col-md-1">
									<label for="chk_for_star">
									Select Test<span class="mede_class" id="id_for_star"></span>:<label>
									<input type="hidden" name="txt_is_sample" id="txt_is_sample" value="0">
									<input type="checkbox" class="visually-hidden" name="chk_for_star"  id="chk_for_star" value="0">									
									</div>
									<div class="col-md-2">
									<div id="put_all_chk_box">
									</div>
									</div>
									<!--<div class="col-md-2">
									<label for="exampleInputEmail1">Admin Supply:<span class="mede_class">*</span>:</label>
									
									</div>-->
									<div class="col-md-2">
									<label for="exampleInputEmail1">Tested By<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-3">
									<label for="exampleInputEmail1">Reported By<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-4">
										<label for="exampleInputEmail1">Excel Uploaded<span class="mede_class">*</span>:</label>
									</div>
								</div>
								<div class="row">
								<div class="col-md-2">
										<div class="form-group">
											
											<div class="col-sm-3">
												<select class="form-control" name="select_test" id="select_test" multiple="multiple">
													
												</select>
												
												<!--<select class="form-control" name="select_test" id="select_test">
												<option value="">Select Test</option>
												
													<option value="">Select Test</option>
													
												</select>-->
											</div>
											
										</div>
								</div>
								<!--<div class="col-md-2">
										<div class="form-group">
											
											<div class="col-sm-12">
												<input type="radio" style="width:33px;height:25px;" name="radio" value="m" checked><span style="font-size:35px;" ><b>M</b></span>
												<input type="radio" style="width:33px;height:25px;"name="radio" value="r"><span style="font-size:35px;"><b>R<b></span>
											</div>
										</div>
								</div>-->
								
								<div class="col-md-2">
								<input type="hidden" name="radio" value="r">
										<div class="form-group">
											
											<div class="col-sm-12">
												
												<select class="form-control " name="sel_tested_by" id="sel_tested_by" style="height:50px;">
													
												</select>
												
											
											</div>
										</div>
								</div>
								
								<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
											<select class="form-control " name="reported_by" id="reported_by" style="height:50px;">
													<option value="">Select Quality Manager</option>
													<?php 
													$sel_staff="select * from multi_login where `staff_isadmin`='5'";
													$query_staff=mysqli_query($conn,$sel_staff);
													if(mysqli_num_rows($query_staff) > 0){
													while($rowss=mysqli_fetch_array($query_staff)){?>
													<option value="<?php echo $rowss['id']?>"><?php echo $rowss['staff_fullname']?></option>
													
													<?php }}?>
												</select>
												
											</div>
										</div>
								</div>
								
								<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
												<input type="radio" style="width:33px;height:25px;" name="exel_radio" value="y"><span style="font-size:35px;" ><b>YES</b></span>
												<input type="radio" style="width:33px;height:25px;"name="exel_radio" value="n" checked><span style="font-size:35px;"><b>No<b></span>
											</div>
										</div>
								</div>
								</div>
								<br>
							<!--<select id="multiselectdemo" multiple="multiple">
									<option value="jQuery">jQuery tutorial</option>
												<option value="Bootstrap">Bootstrap Tips</option>
												<option value="HTML">HTML</option>
												<option value="CSS">CSS tricks</option>
												<option value="angular">Angular JS</option>
												</select>-->
								
								<div class="row">
								
								<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<button type="button" class="btn btn-info"  onclick="addData('add_material_assinging')" name="btn_add_data" id="btn_add_data" style="width:100%;font-size:20px;margin-left:160%;" >Add Test</button>
											</div>
										</div>
								</div>
								</div>
								</div>
							</div>
							</form>
							<div class="row">
									<div class="col-lg-12">
									<div id="display_data">
									</div>
									</div>
							</div>
							<div class="box-footer">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<div class="col-sm-12">
												
												<button type="button" class="btn btn-info"  onclick="savedata('add_material_assinging_save')" name="btn_add_data_save" id="btn_add_data_save" style="width:100%;font-size:20px;display:none;" >Save Test</button>
												
											</div>
										</div>
									</div>
								</div>	
							</div>
							<br>
							<br>
							<div class="row">
									<div class="col-lg-12">
									<div id="display_data_after_save">
									</div>
									</div>
							</div>
							
							
							
							<form name="frm_save" method="post" onsubmit="return confirm('Are you sure you want to Save this Material?');">
							<div class="row">
								<div class="col-lg-12">
									<input type="hidden" value="<?php echo $_GET['temporary_trf_no'];?>" name="txt_final_trf_no">
									<?php
									// set job no from report no
									//$set_job_no1=substr($_GET['report_no'],7);
									?>
									
									<!--<input type="submit" class="btn btn-info" name="final_save" id="final_save" style="width:20%;font-size:20px;margin-left: 40%;margin-bottom: 2%;display:none;" value="SAVE">-->
									 <button type="submit"  class="btn btn-info" name="save_next" id="save_next" style="width:20%;font-size:20px;margin-left: 40%;margin-bottom: 2%;display:none;" >Save
									 </button>

									
									
								</div>
							</div>
								</form>
							</div>
						
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
<link rel="stylesheet" href="bower_components/custom/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="bower_components/custom/bootstrap-multiselect.js"></script>
		  	  
<script>
$(function () {
    $('.select2').select2();
  });
$(document).ready(function(){
	   $('#select_test').multiselect();
	$(".only_remark").hide();
	$(".material_class").hide();
	get_span_assign_after_save();
	//get_span_assign();
	get_span_set_sam_rec_date("0","onload");
});

$('#casting_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})
	
$('#ex_date_submission').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})
   // on category change 
$("#select_material_category").change(function(){
      var select_material_category = $('#select_material_category').val(); 
	  var txt_report_no = $('#txt_report_no').val();
	   var txt_job_no = $('#txt_job_no').val();
	  var postData = 'action_type=get_material_by_category&select_material_category='+select_material_category+'&txt_report_no='+txt_report_no+'&txt_job_no='+txt_job_no;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					$('#select_material').html(data.all_material);	
				    //$('#txt_lab_no').val(data.final_lab_id);
				    $('#hidden_lab_no').val(data.final_lab_id);
					$('#select_test').html(data.out_tests);
					$('#select_test').multiselect('rebuild');
					$('#sel_tested_by').html(data.out_materials_engineer);
					$('#select_test').multiselect('rebuild');

				    $('#get_more_count').val(20);
					$("#get_more").prop("disabled", false);
					
					var set_sample_id= "#"+data.cate_prefix;
					$(".material_class").hide();
					$(set_sample_id).show();
					//alert(set_sample_id);
				 }
			});
});


// on material change

$("#select_material").change(function(){
      var select_material = $('#select_material').val(); 
      var txt_report_no = $('#txt_report_no').val(); 
      var select_material_category = $('#select_material_category').val(); 
      var txt_job_no = $('#txt_job_no').val(); 
	  var postData = 'action_type=get_lab_by_material&select_material='+select_material+'&txt_report_no='+txt_report_no+'&select_material_category='+select_material_category+'&txt_job_no='+txt_job_no;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php", 
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					
					var days=parseInt(data.material_per_day_limit);
					var someDate = new Date();
					someDate.setDate(someDate.getDate() + days);
					
					var dd = someDate.getDate();
					var mm = someDate.getMonth() + 1;
					var y = someDate.getFullYear();

					var someFormattedDate = dd + '/'+ mm + '/'+ y;
					
					$('#ex_date_submission').val(someFormattedDate);
					
					$('#select_test').html(data.out_tests);
					$('#select_test').multiselect('rebuild');
					get_span_set_sam_rec_date(days,"changes");
					
				 }
			});
});

//on day changes

$("#day").change(function(){
	var get_days=$("#day").val();
	var get_set_of_cube=$("#set_of_cube").val();
	
	if(get_days !="" && get_days=="other"){
		$(".only_remark").show();
	}else{
		$(".only_remark").hide();
	}
	
	if(get_days=="7_28"){
			var multi=6;
		}else{
			var multi=3;
			
		}
		
		var set_no_of_cobe= get_set_of_cube * multi;
		$("#no_of_cube").val(set_no_of_cobe);
	
	
	
});


//on ulr no  changes

$(document).on("blur",".class_ulr",function(){
	var txt_ulr_no= $(this).val();
	if(txt_ulr_no.length !=5){
		alert("Please Enter 5 Digit In Ulr No.");
		return false;
	}
	var txt_ulr_no_ids= $(this).attr("id");
	var set_first="#first_"+txt_ulr_no_ids;
	var set_third="#third_"+txt_ulr_no_ids;
	var first_ulr= $(set_first).val();
	var third_ulr= $(set_third).val();
	
	var postData = 'action_type=update_ulr_no_by_ids&txt_ulr_no='+txt_ulr_no+'&txt_ulr_no_ids='+txt_ulr_no_ids+'&first_ulr='+first_ulr+'&third_ulr='+third_ulr;
			
		$.ajax({
				url : "<?php $base_url; ?>span_save_material.php", 
				type: "POST",
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
				 }
			});
});

//on delete final materials click

$(document).on("click",".delete_final_entry",function(){
	
	var id= $(this).attr("id");
	var postData = '&action_type=delete_final_entry&id='+id;
			
		$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This material?",
        buttons: {
			confirm: function () 
			{
				$.ajax({
						url : "<?php $base_url; ?>span_save_material.php", 
						type: "POST",
						data : postData,
						beforeSend: function(){
							document.getElementById("overlay_div").style.display="block";
						},
						success: function(data)
						 {
							document.getElementById("overlay_div").style.display="none";
							get_span_assign_after_save();
							get_span_set_sam_rec_date("0","onload");
						 }
					});
			},
            cancel: function () {
				return;
            }
			}
        })
});


// on set of cube blur
$(document).on("blur","#set_of_cube",function(){
	var get_days=$("#day").val();
	var get_set_of_cube=$("#set_of_cube").val();
	
	if(get_days !=""){
		if(get_days=="7_28"){
			var multi=6;
		}else{
			var multi=3;
			
		}
		
		var set_no_of_cobe= get_set_of_cube * multi;
		$("#no_of_cube").val(set_no_of_cobe);
		
	}else{
		alert("Select Days");
		$("#no_of_cube").val(0);
		return false;
	}
	
	
	
});

// add data
function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_material_assinging') {
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				//var txt_lab_no = $('#txt_lab_no').val(); 
				var type_of_cement = $('#type_of_cement').val(); 
				var cement_grade = $('#cement_grade').val(); 
				var cement_brand = $('#cement_brand').val(); 
				var week_no = $('#week_no').val(); 
				var brick_source = $('#brick_source').val(); 
				var sample_de = $('#sample_de').val(); 
				var mark = $('#mark').val();
				var brick_specification = $('#brick_specification').val();
				var tanker_no = $('#tanker_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var make = $('#make').val();
				var cube_grade = $('#cube_grade').val();
				var day_remark = $('#day_remark').val();
				var casting_date = $('#casting_date').val();
				var day = $('#day').val();
				var set_of_cube = $('#set_of_cube').val();
				var no_of_cube = $('#no_of_cube').val();
				var cc_identification = $('#cc_identification').val();
				var chainage_no = $('#chainage_no').val();
				var fdd_desc_sample = $('#fdd_desc_sample').val();
				var shape = $('#shape').val();
				var age = $('#age').val();
				var color = $('#color').val();
				var thickness = $('#thickness').val();
				var paver_grade = $('#paver_grade').val();
				var sample_type = $('#sample_type').val();
				var soil_source = $('#soil_source').val();
				var dia = $('#dia').val();
				var steel_grade = $('#steel_grade').val();
				var steel_brand = $('#steel_brand').val();
				var tile_source = $('#tile_source').val();
				var tiles_specification = $('#tiles_specification').val();
				var fine_agg_source = $('#fine_agg_source').val();
				var fine_agg_type = $('#fine_agg_type').val();
				var qa_spall_source = $('#qa_spall_source').val();
				var bitumin_mix = $('#bitumin_mix').val();
				var tiles_specification = $('#tiles_specification').val();
				var brand = $('#brand').val();
				var select_test = $('#select_test').val();
				var select_samp_condition = $('#select_samp_condition').val();
				var select_location = $('#select_location').val();
				var txt_is_sample = $('#txt_is_sample').val();
				
				
				var tested_by = $('#sel_tested_by').val();
				var reported_by = $('#reported_by').val();
				var ex_date_submission = $('#ex_date_submission').val();
				var chkmorr = $("input[name='radio']:checked").val();
				var exel_radio = $("input[name='exel_radio']:checked").val();
				
				// condition for steel_brand
				if(select_material_category !="" && select_material_category =="10" && dia=="")
				{
					alert("Please Enter Dia First...");
					return false;
				}
				
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="129" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="143" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
			
				if(txt_trf_no !="" && select_material_category !="" && select_material !=""&& select_test !="" && tested_by !=""&& reported_by !=""){
					
				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&select_material_category='+select_material_category+'&select_material='+select_material+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&sample_type='+sample_type+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+steel_brand+'&tile_source'+tile_source+'&tiles_specification='+tiles_specification+'&brand='+brand+'&select_test='+select_test+'&tested_by='+tested_by+'&reported_by='+reported_by+'&ex_date_submission='+ex_date_submission+'&chkmorr='+chkmorr+'&exel_radio='+exel_radio+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source+'&select_samp_condition='+select_samp_condition+'&select_location='+select_location+'&bitumin_mix='+bitumin_mix+'&txt_is_sample='+txt_is_sample+'&cc_identification='+cc_identification+'&chainage_no='+chainage_no+'&fine_agg_type='+fine_agg_type+'&fdd_desc_sample='+fdd_desc_sample+'&sample_de='+sample_de+'&soil_source='+soil_source;
				}else{
					alert(" All Filled Required");
					return false;
				}
				
				//exit();
				
    }else{
				
	
				billData = 'action_type='+type+'&id='+id;
				
    }
     $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(msg){
		document.getElementById("overlay_div").style.display="none";
          get_span_assign();
		  $("#btn_add_data_save").css("display", "block");
        }
    }); 
}


//save in final

function savedata(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_material_assinging_save') {
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				//var txt_lab_no = $('#txt_lab_no').val(); 	
				//6/4
				var type_of_cement = $('#type_of_cement').val(); 
				var cement_grade = $('#cement_grade').val(); 
				var cement_brand = $('#cement_brand').val(); 
				var week_no = $('#week_no').val(); 
				var brick_source = $('#brick_source').val(); 
				var sample_de = $('#sample_de').val(); 
				var mark = $('#mark').val();
				var brick_specification = $('#brick_specification').val();
				var tanker_no = $('#tanker_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var make = $('#make').val();
				var cube_grade = $('#cube_grade').val();
				var day_remark = $('#day_remark').val();
				var casting_date = $('#casting_date').val();
				var day = $('#day').val();
				var set_of_cube = $('#set_of_cube').val();
				var no_of_cube = $('#no_of_cube').val();
				var cc_identification = $('#cc_identification').val();
				var chainage_no = $('#chainage_no').val();
				var fdd_desc_sample = $('#fdd_desc_sample').val();
				var shape = $('#shape').val();
				var age = $('#age').val();
				var color = $('#color').val();
				var thickness = $('#thickness').val();
				var paver_grade = $('#paver_grade').val();
				var sample_type = $('#sample_type').val();
				var soil_source = $('#soil_source').val();
				var dia = $('#dia').val();
				var steel_grade = $('#steel_grade').val();
				var steel_brand = $('#steel_brand').val();
				var tile_source = $('#tile_source').val();
				var tiles_specification = $('#tiles_specification').val();
				var fine_agg_source = $('#fine_agg_source').val();
				var fine_agg_type = $('#fine_agg_type').val();
				var qa_spall_source = $('#qa_spall_source').val();
				var bitumin_mix = $('#bitumin_mix').val();
				var brand = $('#brand').val();
				var select_test = $('#select_test').val();
				var select_samp_condition = $('#select_samp_condition').val();
				var select_location = $('#select_location').val();
				var txt_is_sample = $('#txt_is_sample').val();
				
				var tested_by = $('#sel_tested_by').val();
				var reported_by = $('#reported_by').val();
				var ex_date_submission = $('#ex_date_submission').val();
				var chkmorr = $("input[name='radio']:checked").val();
				var exel_radio = $("input[name='exel_radio']:checked").val();
				
				// condition for steel_brand
				if(select_material_category !="" && select_material_category =="10" && dia=="")
				{
					alert("Please Enter Dia First...");
					return false;
				}
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="129" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="143" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
					
				
				var qty = prompt("ENTER QUANTITY","1");
				if(qty == null)
				{
					alert("Process Cancel Successfully.");
				}
				else
				{
						if (qty != null || qty != "") {
							
								if(qty!=0)
								{
									if(qty > 1)
									{
						
										if(!isNaN(qty))
										{
													billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&select_material_category='+select_material_category+'&select_material='+select_material+'&ex_date_submission='+ex_date_submission+'&qty='+qty+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&sample_type='+sample_type+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+tile_source+'&tiles_specification='+tiles_specification+'&brand='+brand+'&select_test='+select_test+'&tested_by='+tested_by+'&reported_by='+reported_by+'&ex_date_submission='+ex_date_submission+'&chkmorr='+chkmorr+'&exel_radio='+exel_radio+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source+'&select_samp_condition='+select_samp_condition+'&select_location='+select_location+'&bitumin_mix='+bitumin_mix+'&txt_is_sample='+txt_is_sample+'&cc_identification='+cc_identification+'&chainage_no='+chainage_no+'&fine_agg_type='+fine_agg_type+'&fdd_desc_sample='+fdd_desc_sample+'&sample_de='+sample_de+'&soil_source='+soil_source;
													
															 $.ajax({
													type: 'POST',
													url: '<?php $base_url; ?>span_save_material.php',
													data: billData,
													beforeSend: function(){
													//document.getElementById("overlay_div").style.display="block";
													},
													success:function(msg){
													  document.getElementById("overlay_div").style.display="none";
													  $('#display_data').html("");
													  $("#add_mate_form")[0].reset();
													  $("#add_material_button").click();
													 $("#btn_add_data_save").css("display", "none");
													 $("#final_save").css("display", "block");
													 $("#save_next").css("display", "block");
													 $("#after_save_portion").css("display", "block");
														get_span_assign_after_save();
														get_span_set_sam_rec_date("0","onload");
													}														
												});
										}
										else
										{
											alert("Please Input Valid Quantity.");
										}
									}
									else
									{
										
										//PUT SUCEESS DATA OVER HERE
										
										$('#display_data').html("");
										$("#add_mate_form")[0].reset();
										$("#add_material_button").click();
										$("#btn_add_data_save").css("display", "none");
										$("#final_save").css("display", "block");
										$("#save_next").css("display", "block");
										$("#after_save_portion").css("display", "block");
									    get_span_assign_after_save();
										get_span_set_sam_rec_date("0","onload");
									}
								}
								else
								{
									alert("Please Input Valid Quantity.");
								}
						}
						else
						{
								alert("Please Input Valid Quantity.");
						}
				}
				
    }
   
}



function get_span_assign_after_save(){
		
		var str= '<?php echo $_GET["temporary_trf_no"]?>';
		var txt_jb_id= str;
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_assign_after_save&temporary_trf_no='+str,
        success:function(html){
            $('#display_data_after_save').html(html);
        }
    });
}

function get_span_set_sam_rec_date(first,second){
		
		var str= '<?php echo $_GET["temporary_trf_no"]?>';
		var txt_jb_id= str;
		var first= first;
		var second= second;
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_set_sam_rec_date&temporary_trf_no='+str+'&first='+first+'&second='+second,
        success:function(html){
			//alert(html);
            $('#ex_date_submission').val(html);
        }
    });
}

function get_span_assign(){
		var str= '<?php echo $_GET["temporary_trf_no"]?>';
		var txt_jb_id= str;
		
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_assign&temporary_trf_no='+str,
        success:function(html){
            $('#display_data').html(html);
        }
    });
}


   // $(".open .dropdown-menu checkbox").prop('checked', $(this).prop("checked")); 


$(document).on('click','.all_chk', function(event){
   
	//$('.multiselect-container .multiselect-container').prop('checked', this.checked);
	$('#select_test checkbox').prop('selected',true);
});

 //get more material by category 
$(document).on('click','#get_more', function(event){
   
	var select_material_category = $('#select_material_category').val(); 
	var get_more_count = $('#get_more_count').val(); 
	if(select_material_category==0){
		alert("Slect Category First");
		return false;
	}
	  var postData = 'action_type=get_material_by_category_more&select_material_category='+select_material_category+'&get_more_count='+get_more_count;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					$('#select_material').append(data.all_material);	
				    get_more_count= parseInt(get_more_count)+ 20;
				    $('#get_more_count').val(get_more_count);

					if(data.get_rows_counts==0)
					{
						$("#get_more").prop("disabled", true);
						alert("No More Material For "+data.category_names+" Category");
					}
					
					
				 
				 }
			});
});

$('#chk_for_star').click(function() {
   
	var txt_is_sample= $("#txt_is_sample").val();
	
	if(txt_is_sample=="0")
	{
		$("#txt_is_sample").val("1");
		$('#id_for_star').text('*');
	}else
	{
		$("#txt_is_sample").val("0");
		$('#id_for_star').text('');
	}
});
	
</script>
