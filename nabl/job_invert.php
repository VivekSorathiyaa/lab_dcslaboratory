<?php include("header.php");?>
<?php include("sidebar.php");
include("connection.php");
	if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php $base_url; ?>index.php";
	</script>
	<?php
}

		$status_add=0;
		$query="SELECT * FROM fyearmaster WHERE `fy_status`='1'";
	
		 $qrys = mysqli_query($conn,$query);
		$no_of_rows=mysqli_num_rows($qrys);
		if($no_of_rows>0){
								
			$r = mysqli_fetch_array($qrys);
			$year=$r['fy_name'];
			$inv_startdate1=$r['fy_startdate'];
			$inv_enddate1=$r['fy_enddate'];
			$inv_for_txt= date('d/m/Y', strtotime( $inv_startdate1 ));
			$inv_startdate = date('m/d/Y', strtotime( $inv_startdate1 ));
			$inv_enddate = date('m/d/Y', strtotime( $inv_enddate1 ));
			//$srno1=substr($year,2);
			//$srno=substr($srno1,3,2);
			$tec="TMTL/";
			$for_serial_no= date('Y', strtotime( $inv_startdate1 ));
			$srno= substr($for_serial_no,2);
		}
		
		if(isset($_POST['btn_add_city']))
		{
			 $insert = "insert into city(`city_name`,`city_status`,`city_isdeleted`) values('$_POST[txt_new_city]','1','1')"; 
			$qrys = mysqli_query($con,$insert);
		}
	
	
		
		
		if(isset($_POST['btn_estimate'])){
			
			//get estimate number
				$ess_sr_no=1;
				$final_sr_no;
				$querys_serno = "SELECT * FROM job_invert WHERE bt_isdeleted='0'";
				$qrys_serno = mysqli_query($conn,$querys_serno);
				$rows=mysqli_num_rows($qrys_serno);
				$tec_ess=$h_sr."/";											
				while($r1 = mysqli_fetch_array($qrys_serno)){
					$ess_serial_no=$r1['est_sr_no'];
				}
				if($rows<1){
					$final_sr_no=$ess_sr_no;
					
					$sr_no_ess=$tec_ess.$srno."-".$final_sr_no;
				
				}
				else{
				
				$final_serialno=substr($ess_serial_no,7);
					
				$final_sr_no = $final_serialno + 1;
				$sr_no_ess=$tec_ess.$srno."-".$final_sr_no;
				

				}
				
				
			//get job number
				$job_no=1;
				$final_job_no;
				echo $querys_jobno = "SELECT * FROM  `job_invert` WHERE  `job_no` LIKE  '%".$_POST["txt_jobno1"]."%' AND bt_isdeleted='0'";
				
				$qrys_jobno = mysqli_query($conn,$querys_jobno);
				$jobrows=mysqli_num_rows($qrys_jobno);
				$job_plus=$jobrows + 1;
				$sr_no_job= $_POST["txt_jobno1"].$job_plus; 
		
		

					$fyear_query = "select * from fyearmaster WHERE fy_status='1'";
					$result_fyear = mysqli_query($conn, $fyear_query);

						if(mysqli_num_rows($result_fyear) > 0) {
							$row_fyear = mysqli_fetch_assoc($result_fyear);
							$fyear= $row_fyear['fy_name'];
						}
				
			

				
						//------------get sr_no--------

						$sr_no1=$_POST['txt_srno1'];
						$sr_no2=$_POST['txt_srno2'];
						$sr_no=$sr_no1.$sr_no2;
						
						//-------------convert date into mysqli format-----------
						
						$ref_day=substr($_POST['ref_date'],0,2);
						$ref_month=substr($_POST['ref_date'],3,2);
						$ref_year=substr($_POST['ref_date'],6,4);
						$new_ref_date = $ref_year."-".$ref_month."-".$ref_day;
						
						$rec_day=substr($_POST['rec_date'],0,2);
						$rec_month=substr($_POST['rec_date'],3,2);
						$rec_year=substr($_POST['rec_date'],6,4);
						$new_rec_date = $rec_year."-".$rec_month."-".$rec_day;
						
						$inv_day=substr($_POST['invoice_date'],0,2);
						$inv_month=substr($_POST['invoice_date'],3,2);
						$inv_year=substr($_POST['invoice_date'],6,4);
						$new_inv_date = $inv_year."-".$inv_month."-".$inv_day;
						
						$today_day=substr($_POST['txt_date'],0,2);
						$today_month=substr($_POST['txt_date'],3,2);
						$today_year=substr($_POST['txt_date'],6,4);
						$new_today_date = $today_year."-".$today_month."-".$today_day;
					
						
						
						$agency_name= $_POST["select_agency"]; 
							
						
						
						$curr_date=date("Y-m-d");
						
						$job_no_merge= $_POST["txt_jobno1"].$_POST["txt_jobno2"];
						
						$serial_no_concate= $_POST["txt_srno1"].$_POST["txt_srno2"];
						$state_explode= explode("|",$_POST['txt_state']);
						$branch_session=$_SESSION['Branch'];
					$insert_ess="insert into job_invert (`branch_id`,`fy_id`,`est_sr_no`,`sr_no`,`job_no`,`agency_id`,`agency_name`,`auth_name`,`auth_address`,`auth_state`,`auth_statecode`,`auth_gstno`,`ref_date`,`rec_date`,`inv_date`,`today_date`,`bt_createdby`,`bt_createddate`,`bt_modifiedby`,`bt_modifieddate`,`bt_isdeleted`,`ag_or_auth_status`,`name_of_work`,`ref_id`,`city_id`,`ref_name`) 
						values(
						'$branch_session',
						'$fyear',
						'$sr_no_ess',
						'',
						'$sr_no_job',
						'$_POST[select_agency]',
						'$agency_name',
						'$_POST[select_auth]',
						'$_POST[auth_address]',
						'$state_explode[0]',
						'$_POST[txt_statecode]',
						'$_POST[txt_gstno]',
						'$new_ref_date',
						'$new_rec_date',
						'$new_inv_date',
						'$new_today_date',
						'$_SESSION[name]',
						'$curr_date',
						'',
						'0000-00-00',
						'0',
						'$_POST[rdo_button_ag_or_auth]',
						'$_POST[editor1]',
						'$_POST[select_ref]',
						'$_POST[select_city]',
						'$_POST[txt_ref]'
						)"; 
					
					mysqli_query($conn,$insert_ess);	
					
						?>
						
					<script>
						//window.open("<?php $base_url; ?>bill_esstimate.php?ess_id=<?php echo $sr_no_ess;?>",'_blank');
						alert("YOUR ESTIMATE NO:<?php echo $sr_no_ess; ?>");
						window.location.href="<?php $base_url; ?>view_job_invert.php";
					</script>
					
					<?php
						
		}
		
		
?>

<?php
		
		
		//-----------get esstimate no-----------
				$ess_sr_no=1;
				$final_sr_no;
				$querys_serno = "SELECT * FROM job_invert WHERE est_sr_no  LIKE 'MGE/".$srno."%' AND bt_isdeleted='0'";
				$qrys_serno = mysqli_query($conn,$querys_serno);
				$rows=mysqli_num_rows($qrys_serno);
				$tec_ess="TMTL/";											
				while($r1 = mysqli_fetch_array($qrys_serno)){
					$ess_serial_no=$r1['est_sr_no'];
				}
				if($rows<1){
					echo "ifffffffffffffe-->".$final_sr_no=$ess_sr_no;
					
					//$sr_no_ess=$h_sr."/".$srno."-".$final_sr_no;
				  $final_sr_no=1;
				}
				else{
				
					$final_serialno=substr($ess_serial_no,7);
				

				$final_sr_no = $final_serialno + 1;
				//$sr_no_ess=$h_sr."/".$srno."-".$final_sr_no;
				
				}
				
				
				//-----------get SAMPLE NO.
				$smpl_sr_no=1;
				$sample_no;
				$querys_serno1 = "SELECT * FROM estimate_bill_total_master WHERE fy_id='$fyear'";
				$qrys_serno1 = mysqli_query($conn,$querys_serno1);
				$rows=mysqli_num_rows($qrys_serno1);
				$tec_ess="TMTL/";											
				/*while($r1 = mysqli_fetch_array($qrys_serno1)){
					$ess_serial_no=$r1['job_no'];
				}*/
				
				if($rows<1){
					$sample_no=$smpl_sr_no;
					
					$sr_no_ess=$h_sr."/".$srno."-".$sample_no;
		
				}
				else{	
				while($r1 = mysqli_fetch_array($qrys_serno1)){
					$ess_serial_no=$r1['job_no'];
				}
				$final_serialno=substr($ess_serial_no,7);
					

				$sample_no = $final_serialno + 1;
				$sr_no_ess=$h_sr."/".$srno."-".$sample_no;
				
				}
?>
<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}

.mystyle{
	text-align: center;
    font-size: 2em;
}

input[type="radio"] {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
    transform: scale(1.5);
}
</style>
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Esstimate 
			</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Esstimate Form</h3>
						</div>
						<form class="form" id="billing" method="post">
							<div class="box-body"  style="border:1px groove #ddd;">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label" style="">SR.No.:</label>
											
										  <div class="col-sm-2">
											<input type="text" class="form-control" value="<?php echo $h_sr."/".$srno."-"?>" id="txt_srno1" name="txt_srno1" >
										  </div>
										  <div class="col-sm-2">
											<input type="text" class="form-control" id="txt_srno2" name="txt_srno2" value="<?php echo $final_sr_no;?>" >
										  </div>
										  
										    <label for="inputEmail3" class="col-sm-1 control-label">Sample No.:</label>

										  <div class="col-sm-3">
											<input type="text" class="form-control"   id="txt_jobno1" name="txt_jobno1" value="<?php// echo $sample_no;?>" >
										  </div>
										  
										  <div class="col-sm-2">
											<input type="text" class="form-control"   id="txt_jobno2" name="txt_jobno2" value="<?php echo $sample_no;?>" ">
										  </div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
										
										  <label for="inputEmail3" class="col-sm-2 control-label">Inward Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="invoice_date" name="invoice_date"  value="<?php echo date('d/m/Y');?>" tabindex="1">
												</div>
											</div>
											
											<label for="inputEmail3" class="col-sm-2 control-label">Reference Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right"  id="ref_date" name="ref_date" value="<?php echo date("d/m/Y");?>" tabindex="2">
												</div>
											</div>
											
										</div>
									</div>
								
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Letter No:</label>
										 

										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" id="txt_ref" name="txt_ref" tabindex="3">
										  </div>
										 
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">

										  <label for="inputEmail3" class="col-sm-2 control-label">Receive Sample Date:</label>
										  <div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right"  id="rec_date" name="rec_date" value="<?php echo date("d/m/Y");?>" tabindex="4">
												</div>
											</div>
											 <label for="inputEmail3" class="col-sm-2 control-label">Date:</label>
										  <div class="col-sm-4">
											<input type="text" class="form-control" id="txt_date" name="txt_date" value="<?php echo date("d/m/Y");?>" tabindex="5">
										  </div>
										</div>
									</div>	
								</div>
								<hr style="border-top: 1px solid;">
								<div class="row">
									<div class="col-md-4">
										<label for="inputEmail3" class="col-sm-2 control-label">Agency:</label>
										<select class="form-control select2 col-sm-9"  style="width:270px;" data-placeholder="Select a Autority" id="select_agency" name="select_agency" tabindex="6">
											<option>Select Agency..</option>
											<?php 
											$agency_query = "select * from agency ";
										
											$result_agency = mysqli_query($conn, $agency_query);

											if (mysqli_num_rows($result_agency) > 0) {
												while($row_agency = mysqli_fetch_assoc($result_agency)) {
											
											?>
											<option value="<?php echo $row_agency['agency_name'];?>"><?php echo $row_agency['agency_name'];?></option>
											<?php } }?>
										</select>
										<input type="button" value="+" class="col-sm-1 btn btn-info pull-right" data-toggle="modal" data-target="#modal-agency" >

									</div>
									<div class="col-md-4">
										<label for="inputEmail3" class="col-sm-3 control-label">Authority:</label>
												<select class="form-control select2 col-sm-8 inputs" style="width:250px;" data-placehold="Select a Autority" id="select_auth" name="select_auth" tabindex="7">
													<option>Select Authority..</option>
													<?php 
													$authority_query = "select * from authority";
												
													$result_authority = mysqli_query($conn, $authority_query);

													if (mysqli_num_rows($result_authority) > 0) {
														while($row_authority = mysqli_fetch_assoc($result_authority)) {
													
													?>
													<option value="<?php echo $row_authority['auth_name'];?>"><?php echo $row_authority['auth_name'];?></option>
													<?php } }?>
												</select>
											
											<input type="button" value="+" class="col-sm-1 btn btn-info pull-right" data-toggle="modal" data-target="#modal-auth" >
									</div>
									<!--<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Edit Authority:</label>
									</div>
									<div class="col-md-3">
										<input type="text" class="col-sm-12 form-control" id="txt_edit_auth" tabindex="8" name="txt_edit_auth">
									</div>-->
									<div class="col-md-4">
									<label for="inputEmail3" class="col-sm-3 control-label">Auth Address:</label>
									<textarea id="auth_address"  name="auth_address" style="width:295px;" tabindex="11"></textarea>
									</div>
								</div>
	
								<br>
								<div class="row">
									<div class="col-md-4">
										<label for="inputEmail3" class="col-sm-2 control-label">City:</label>
										<select class="form-control select2  col-sm-9" data-placeholder="Select a City"  style="width:270px;"  id="select_city" name="select_city" tabindex="9">
										<option>Select City..</option>
										<?php 
												$sql = "select * from city";
											
												$result = mysqli_query($conn, $sql);

													while($row = mysqli_fetch_assoc($result)) {
												
												?>
												<option value="<?php echo $row['id'];?>"><?php echo $row['city_name'];?></option>
												<?php  }?>		
										</select>
										<input type="button" value="+" class="col-sm-1 btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
									</div>
									<div class="col-md-4">
										<label for="inputEmail3" class="col-sm-3 control-label">Reference Id:</label>
										<select class="form-control select2 col-sm-8"data-placeholder="Select a Reference"  style="width:250px;"  id="select_ref" name="select_ref" tabindex="10">
												<option>Select Reference..</option>
												<?php 
												$ref_query = "select * from reference ";
											
												$result_ref = mysqli_query($conn, $ref_query);

												if (mysqli_num_rows($result_ref) > 0) {
													while($row_ref = mysqli_fetch_assoc($result_ref)) {
												
												?>
												<option value="<?php echo $row_ref['ref_name'];?>"><?php echo $row_ref['ref_name'];?></option>
												<?php } }?>
											</select>
											<input type="BUTTON" value="+" class="col-sm-1 btn btn-info pull-right" data-toggle="modal" data-target="#modal-ref">
									</div>
									
									<div class="col-md-4">
									<button type="button" style="float:right;margin-right:40px;" class="btn btn-primary" id="btn_auth_address" name="btn_auth_address">Authority Address Paste</button>
									</div>
								</div>
								
								<br>
								<div class="row">
									<div class="col-md-1">
										<label for="inputEmail3" class="col-sm-1 control-label">Auth State:</label>
									</div>
									<div class="col-md-3">
									<span id="show_only_state_name"></span>
									    <div id="show_state_id">
										<select class="form-control select2 col-sm-8" data-placeholder="Select a State" style="width:250px;" tabindex="12" id="txt_state" name="txt_state" required>
										<option value="24|GUJARAT">GUJARAT</option>
										<?php 
												$state_query = "select * from state";
											
												$result_state = mysqli_query($conn, $state_query);

												if (mysqli_num_rows($result_state) > 0) {
													while($row_state = mysqli_fetch_assoc($result_state)) {
												
												?>
												<option value="<?php echo $row_state['state_tincode'].'|'.$row_state['state_name'];?>"><?php echo $row_state['state_name'];?></option>
												<?php } }?>
										
										</select>
										</div>
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="col-sm-1 control-label">State Code:</label>
									</div>
									<div class="col-md-3">	
										<input type="hidden" class="form-control inputs" tabindex="13" id="txt_statecode" name="txt_statecode" required value="24">
										<span id="just_show_stateid">24</span>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="col-sm-1 control-label">GST No:</label>
									</div>
									<div class="col-md-3">
									<input type="text" class="form-control inputs" tabindex="14" id="txt_gstno" name="txt_gstno" required>
									</div>
								
								</div>
								
								</br>
								<div class="row">
								<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Name Of Work:</label>
									</div>
								<div class="col-md-6">
										<textarea id="editor1"  name="editor1" tabindex="15"></textarea>
									</div>
									<div class="col-md-1">
									<button type="button" class="btn btn-primary" id="btn_last_nofw" name="btn_last_nofw">Paste</button>
									</div>
								<div class="col-md-1">
								<label for="inputEmail3" class="control-label">Save to:</label>
								</div>
								<div class="col-md-3">
								<label for="inputEmail3" class="control-label">
								
								<input type="radio" value="0" name="rdo_button_ag_or_auth" id="rdo_button_ag_or_auth" checked ><span style="padding:10px;">Authority</span>
										<input type="radio" value="1" name="rdo_button_ag_or_auth" id="rdo_button_ag_or_auth"><span style="padding:10px;">Agency
										</span>
								</label>
								</div>
								</div>
								<hr style="border-top: 1px solid;">
								<!--<div class="row">
									<div class="col-lg-12">
									<div id="gst_status" class="mystyle">
										<input type="radio" value="include" name="rdo_button" id="rdo_button" tabindex="16"><span style="padding:10px;">Include</span>
										<input type="radio" value="exclude" name="rdo_button" id="rdo_button" tabindex="17"><span style="padding:10px;">Exclude
										</span>
									</div>
									</div>
								</div>
								<br>-->
									
							</div>
							
							<div class="box-footer">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
									
											<div class="col-sm-6">
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<!--<div class="col-xs-2">
												
													
													<button type="submit" class="btn btn-info pull-right" id="btn_saves" name="btn_saves" tabindex="19" style="width:100px">Save</button>
												</div>-->	
											</div>
											<div class="col-sm-6">
												<div class="col-xs-2">
												<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" tabindex="33" style="width:100px" >Estimate</button>
												</div>
											
												<div class="col-xs-2">
												<!--<button type="submit" class="btn btn-info pull-right" tabindex="21" id="btn_report" name="btn_report">Report</button>-->
												</div>
												
											</div>
										</div>
									</div>
								</div>	
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	</div>
	
	<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New City</h4>
              </div>
				<form id="form_city" name="form_city" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Add City:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New City" id="txt_new_city" name="txt_new_city" class="form-control">											
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_city" name="btn_add_city" data-dismiss="modal">Add City</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	<div class="modal fade" id="modal-ref">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Change Reference</h4>
				</div>
				<form id="form_ref" name="form_ref" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Change Reference:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New Reference" id="txt_new_ref" name="txt_new_ref" class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_ref" name="btn_add_ref" data-dismiss="modal">Change Reference</button>
					</div>
				</form>
			</div>
				<!-- /.modal-content -->
		</div>
          <!-- /.modal-dialog -->
	</div>
		
		<!---Add Rate---->
		
		<div class="modal fade" id="modal-rate">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Change Rate</h4>
					</div>
					<form id="form_rate" name="form_rate" method="post">
						<div class="modal-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Change Rate:</label>
								<div class="col-sm-10">
									<input type="text" placeholder="Enter New Rate" id="txt_new_rate" name="txt_new_rate" class="form-control">									
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="btn_add_rate" name="btn_add_rate" data-dismiss="modal">Change Rate</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
          <!-- /.modal-dialog -->
		</div>
		
		<div class="modal fade" id="modal-auth">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Authority</h4>
              </div>
				<form id="form_auth" name="form_auth" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Add Authority:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New Authority" id="txt_new_auth" name="txt_new_auth" class="form-control">											
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_auth" name="btn_add_auth" data-dismiss="modal">Add Authority</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
		
		<div class="modal fade" id="modal-agency">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Agency</h4>
              </div>
				<form id="form_auth" name="form_auth" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Add Agency:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New Agency" id="txt_new_agency" name="txt_new_agency" class="form-control">											
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_agency" name="btn_add_agency" data-dismiss="modal">Add Agency</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
		
<?php include("footer.php");?>

<script> 

$('#select_auth').change(function(e){
				var select_auth = $('#select_auth').val(); 
				var postData = '&select_auth='+select_auth;

  $.ajax({
			url : "<?php $base_url; ?>getAuth.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  $("#txt_edit_auth").val(data.auth_name);
				
 			 }

		}); 
});
// coding for date change start

$(document).ready(function(){


	var ref_inv = $('#invoice_date').val();
		//alert(ref_inv);
				//var jobnos = <?php echo $final_j_no;?>;
				//alert(jobnos);
				var monthsinv = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
           "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		   var monthsainvo = monthsinv[(ref_inv.split('/')[1]-1)];
		 
			var inv_months=ref_inv.split('/');
			var inv_month=ref_inv[3]+ref_inv[4];
			document.getElementById('txt_jobno1').value = monthsainvo+ref_inv[8]+ref_inv[9]+"-";
			var postData = 'txt_inv_month='+inv_month;
				//alert(postData);
			$.ajax({
		url : "<?php $base_url; ?>form_data_for_job.php",
		type: "POST",
		data : postData,
		success: function(data)
		 {
			//$("#select_city").html(data);
          // alert(data)	;
		document.getElementById('txt_jobno2').value	=data;	   
		 }

	});
	
	
	
});


var inv_start_date = "<?php echo $inv_startdate; ?>";
var inv_end_date = "<?php echo $inv_enddate; ?>";


$('#invoice_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  startDate: new Date(inv_start_date),
	  endDate: new Date(inv_end_date)
	  
    }).on("change", function() {
		//alert("dss");
		var ref_inv = $('#invoice_date').val();
		
				//var jobnos = <?php echo $final_j_no;?>;
				//alert(jobnos);
				var monthsinv = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
           "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		   var monthsainvo = monthsinv[(ref_inv.split('/')[1]-1)];
		 
			var inv_months=ref_inv.split('/');
			var inv_month=ref_inv[3]+ref_inv[4];
				//alert(inv_month);
			document.getElementById('txt_jobno1').value = monthsainvo+ref_inv[8]+ref_inv[9]+"-";
			document.getElementById('txt_srno1').value = "MGE/"+ref_inv[8]+ref_inv[9]+"-";
			var postData = 'txt_inv_month='+inv_month;
			$.ajax({
		url : "<?php $base_url; ?>form_data_for_job.php",
		type: "POST",
		data : postData,
		success: function(data)
		 {
			//$("#select_city").html(data);
           //alert(data)	;
		document.getElementById('txt_jobno2').value	=data;	   
		 }

	});
		
  });

// coding for date change stop
</script> 
<script>
 //Date picker
    $('#invoice_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  startDate: new Date(inv_start_date),
	  endDate: new Date(inv_end_date)
    });
	$('#ref_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	$('#rec_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	$('#dateofpay').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
	     
  })

</script>
<script>
var flag=0;
$("#btn_add_city").click(function(){  
	var txt_new_city = $('#txt_new_city').val(); 
	var postData = '&txt_new_city='+txt_new_city;
 
	$.ajax({
		url : "<?php $base_url; ?>Form_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			$("#select_city").html(data);   
			$('#txt_new_city').val("");
		 }

	}); 

});

$("#btn_last_nofw").click(function(){  
	 
	var postData = '&btn_last_nofw='+btn_last_nofw;
 
	$.ajax({
		url : "<?php $base_url; ?>last_name_of_work.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			//alert(data);
			//$("#select_city").html(data);   
			CKEDITOR.instances['editor1'].setData(data)
			//$("textarea#editor1").html("ghghdhjjjjf");
			
			
		 }

	}); 

});


$("#btn_auth_address").click(function(){  
	 
	var postData = '&btn_auth_address='+btn_auth_address;
 
	$.ajax({
		url : "<?php $base_url; ?>last_name_of_work.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			//alert(data);
			//$("#select_city").html(data);   
			//CKEDITOR.instances['editor1'].setData(data)
			$("textarea#auth_address").html(data);
			
			
		 }

	}); 

});



$("#btn_add_ref").click(function(){
 var txt_new_ref = $('#txt_new_ref').val(); 
 var postData = '&txt_new_ref='+txt_new_ref;
 
	  $.ajax({
		url : "<?php $base_url; ?>Ref_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
		
			$("#select_ref").html(data);
			$('#txt_new_ref').val("");
		   
		 }

	}); 

});
<!---Authority------->
$("#btn_add_auth").click(function(){
 var txt_new_auth = $('#txt_new_auth').val(); 
 var postData = '&txt_new_auth='+txt_new_auth;
 
	  $.ajax({
		url : "<?php $base_url; ?>auth_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
		
			$("#select_auth").html(data);
			$('#txt_new_auth').val("");
		   
		 }

	}); 

});

<!---Agency------->
$("#btn_add_agency").click(function(){
 var txt_new_agency = $('#txt_new_agency').val(); 
 var postData = '&txt_new_agency='+txt_new_agency;
 
	  $.ajax({
		url : "<?php $base_url; ?>agency_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
		
			$("#select_agency").html(data);
		   $('#txt_new_agency').val("");
		 }

	}); 

});

$("#btn_add_rate").click(function(){

		var txt_new_rate = $('#txt_new_rate').val(); 
		flag=1;
		var txt_new_material = $('#select_material').val(); 
		var gst_type = $('#gst_type').val(); 
		var txt_qty = $('#txt_qty').val(); 
		
		var txt_rate = $('#txt_rate').val(); 
		var txt_cgst = $('#txt_cgst').val(); 
		var txt_sgst = $('#txt_sgst').val(); 
		var txt_net = $('#txt_net').val(); 
	 
		var postData ='&txt_new_rate='+txt_new_rate+'&txt_new_material='+txt_new_material+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_net='+txt_net+'&gst_type='+gst_type;

		$.ajax({
				url : "<?php $base_url; ?>editRate.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				success: function(data,status,  xhr)
				{
				
				  $("#edit_rate").val(data.txt_net);
				  $("#txt_rate").val(data.txt_rate);
				  $("#txt_qty").val(data.txt_qty);
				  $("#txt_cgst").val(data.txt_cgst);
				  $("#txt_sgst").val(data.txt_sgst);
				  $("#txt_net").val(data.txt_net);
				  
				}

			});
	});

</script>

<script>


$(document).ready(function(){

		var edit_rate = $('#edit_rate').val(); 
	   $( "#txt_jobno" ).focus();
	   $('#btn_edit_data').hide();
	   $('#lbl_date').hide();
	   $('#pay_date').hide();
	   $('#lbl_chck').hide();
	   $('#txt_chck').hide();
	   $('#lbl_info').hide();
	   $('#txt_info').hide();
		
		$('input:radio[name="options"]').change(function(){
			if($(this).val() == 'cash'){
				$('#lbl_date').show();
				$('#pay_date').show();
				$('#lbl_chck').hide();
				$('#txt_chck').hide();
				$('#lbl_info').hide();
				$('#txt_info').hide();
				
			}
			if($(this).val() == 'cheque'){
				$('#lbl_chck').show();
				$('#txt_chck').show();
				$('#lbl_date').show();
				$('#pay_date').show();
				$('#lbl_info').show();
				$('#txt_info').show();
			}
			if($(this).val() == 'rtgs'){
				$('#lbl_info').show();
				$('#txt_info').show();
				$('#lbl_date').show();
				$('#pay_date').show();
				$('#lbl_chck').show();
				$('#txt_chck').show();
			}
		});
		
	$("#txt_state").change(function(){
      
			 var txt_state = $('#txt_state').val(); 
			 var get_only_state= txt_state.split("|");
			 $('#txt_statecode').val(get_only_state[0]);
			 document.getElementById("just_show_stateid").innerHTML=(get_only_state[0]);
			 
			 
    });
	
 
});

</script>
<script>
if (localStorage.getItem("default_option")) {
   $('#select_material').val(localStorage.getItem("default_option")); 
}
</script>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
