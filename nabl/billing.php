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
if($_SESSION['isadmin']=="2")
{
	?>
	<script >
		window.location.href="<?php $base_url; ?>home.php";
	</script>
	<?php
	
}
		$select_query = "select * from job_invert WHERE `est_sr_no`='$_GET[est_sr_no]'";
	$result_select = mysqli_query($conn, $select_query);


	if (mysqli_num_rows($result_select) > 0) {
		$row_select = mysqli_fetch_assoc($result_select);
		$ess_serial_no1= $row_select['est_sr_no'];
		$serial_no1= $row_select['sr_no'];
		$job_no= $row_select['job_no'];
		$agency_id= $row_select['agency_id'];
		$agency_name= $row_select['agency_name'];
		$auth_name= $row_select['auth_name'];
		$auth_address= $row_select['auth_address'];
		$auth_state= $row_select['auth_state'];
		$auth_statecode= $row_select['auth_statecode'];
		$auth_gstno= $row_select['auth_gstno'];
		$ref_date= $row_select['ref_date'];
		$rec_date= $row_select['rec_date'];
		$inv_date= $row_select['inv_date'];
		
		$today_date= $row_select['today_date'];
		
		$bill_sr_manualy= $row_select['bill_sr_manualy'];
		$ag_or_auth_status= $row_select['ag_or_auth_status'];
		$name_of_work=strip_tags(html_entity_decode($row_select['name_of_work']),"<strong><em><br>");
		$ref_name= $row_select['ref_name'];
		$ref_id= $row_select['ref_id'];
		$city_id= $row_select['city_id'];
		
		$select_city = "select * from city WHERE `id`='$city_id'";
	    $result_city = mysqli_query($conn, $select_city);

			if (mysqli_num_rows($result_city) > 0) {
				$row_city = mysqli_fetch_assoc($result_city);
				$city_name= $row_city['city_name'];
			}
		
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
			if($_POST['add_status']=="1"){
			
				$ess_sr_no=1;
				$final_sr_no;
				$querys_serno = "SELECT * FROM estimate_bill_total_master WHERE bt_isdeleted='0'";
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
					
						
						//----------GET AGENCY NAME------------
						
						$agency_query = "select * from agency WHERE id='$_POST[select_agency]'";
						$result_agency = mysqli_query($conn, $agency_query);

					
						if (mysqli_num_rows($result_agency) > 0) {
							$row_agency = mysqli_fetch_assoc($result_agency);
							//echo $row_authority['id'];
							//$agency_name= $row_agency['agency_name'];
							$agency_name= $_POST["select_agency"];
						}
						$agency_name= $_POST["select_agency"]; 
						//----------------get tax amt------------
						$tax_query = "select * from billmaster WHERE sr_no='$sr_no' AND `bill_isdeleted`='0'";
						$result_tax = mysqli_query($conn, $tax_query);

						if (mysqli_num_rows($result_tax) > 0) {
							$row_tax = mysqli_fetch_assoc($result_tax);
							$tax_amt= $row_tax['taxable_amt'];
						}	
						
						//----------------get total sum of cgst,sgst,net-------------
						$query_sum1 = "select SUM(taxable_amt) as sum_taxable,SUM(cgstamt) as sum_cgstamt ,SUM(sgstamt) as sum_sgstamt,SUM(netamt) as sum_netamt, SUM(igstamt) as sum_igstamt from billmaster WHERE sr_no='$sr_no' AND `bill_isdeleted`='0'";
						$result_sum1 = mysqli_query($conn, $query_sum1);

						$r_sum1 = mysqli_fetch_array($result_sum1);
																	
						$cgst1=round($r_sum1['sum_cgstamt'],2);
						$sgst1=round($r_sum1['sum_sgstamt'],2);
						$igst1=round($r_sum1['sum_igstamt'],2);
						$tax_amt=round($r_sum1['sum_taxable'],2);
						if($_POST["txt_statecode"]==24){
							$gst1=$cgst1+$sgst1;
						}else{
							$gst1=$igst1;
						}
						
						
						$grand_total= $tax_amt + $gst1;
						
						$net=round($r_sum1['sum_netamt']);
						$curr_date=date("Y-m-d");
						
						$job_no_merge= $_POST["txt_jobno1"].$_POST["txt_jobno2"];
						
						$serial_no_concate= $_POST["txt_srno1"].$_POST["txt_srno2"];
						$state_explode= explode("|",$_POST['txt_state']);
						$branch_session=$_SESSION['Branch'];
					  $insert_ess="insert into estimate_bill_total_master (`branch_id`,`fy_id`,`est_sr_no`,`sr_no`,`job_no`,`agency_id`,`agency_name`,`auth_name`,`auth_address`,`auth_state`,`auth_statecode`,`auth_gstno`,`ref_date`,`rec_date`,`inv_date`,`today_date`,`total_taxableamt`,`cgsttotal`,`sgsttotal`,`igsttotal`,`subtotal`,`grandtotal`,`remarks`,`totalgst_inword`,`billamt_inword`,`bt_isstatus`,`bt_createdby`,`bt_createddate`,`bt_modifiedby`,`bt_modifieddate`,`bt_isdeleted`,`bt_isbill`,`ag_or_auth_status`) 
						values(
						'$branch_session',
						'$fyear',
						'$serial_no_concate',
						'',
						'$job_no_merge',
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
						'$tax_amt',
						'$cgst1',
						'$sgst1',
						'$igst1',
						'$gst1',
						'$net',
						'$_POST[txt_remark]',
						'$_POST[txt_gstinword]',
						'$_POST[txt_billinword]',
						'0',
						'$_SESSION[name]',
						'$curr_date',
						'',
						'0000-00-00',
						'0',
						'0',
						'$_POST[rdo_button_ag_or_auth]')"; 

					mysqli_query($conn,$insert_ess);	
					
					$update="update billmaster SET `bill_status`='1',`bill_isinsert`='1' WHERE `sr_no`='$sr_no'";
				
					$result_of_update=mysqli_query($conn,$update);	
					$update="update job_invert SET `iss_estimate`=1 WHERE `est_sr_no`='$serial_no_concate'";
				
					$result_of_update=mysqli_query($conn,$update);
						?>
						
					<script>
						//window.open("<?php $base_url; ?>bill_esstimate.php?ess_id=<?php echo $sr_no_ess;?>",'_blank');
						window.location.href="<?php $base_url; ?>view_est_bill.php";
					</script>
					
					<?php
						}else{
						?>
							<script>
								alert("Select Material First..");
							</script>
							<?php	
							
						}
		}
		if(!isset($_POST['btn_saves']) || !isset($_POST['btn_estimate'])){

			$delet_query="DELETE FROM billmaster WHERE `bill_isinsert`='0' AND `bill_isdeleted`='0'";
			$qrys_delete = mysqli_query($conn,$delet_query);
		}
		
		
?>

<?php
		
		
		//-----------get esstimate no-----------
				$ess_sr_no=1;
				$final_sr_no;
				$querys_serno = "SELECT * FROM estimate_bill_total_master WHERE est_sr_no  LIKE 'MGE/".$srno."%' AND bt_isdeleted='0'";
				$qrys_serno = mysqli_query($conn,$querys_serno);
				$rows=mysqli_num_rows($qrys_serno);
				$tec_ess="TMTL/";											
				while($r1 = mysqli_fetch_array($qrys_serno)){
					$ess_serial_no=$r1['est_sr_no'];
				}
				if($rows<1){
					$final_sr_no=$ess_sr_no;
					
					$sr_no_ess=$h_sr."/".$srno."-".$final_sr_no;
		
				}
				else{
				
					$final_serialno=substr($ess_serial_no,7);
				

				$final_sr_no = $final_serialno + 1;
				$sr_no_ess=$h_sr."/".$srno."-".$final_sr_no;
				
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
										<?php
												$srno2=substr($ess_serial_no1,7);
												$srno1=substr($ess_serial_no1,0,7);
		
										?>
										  <label for="inputEmail3" class="col-sm-2 control-label">SR.No.:</label>
											
										  <div class="col-sm-2">
											<input type="text" class="form-control" value="<?php echo $srno1;?>" id="txt_srno1" name="txt_srno1" >
										  </div>
										  <div class="col-sm-2">
											<input type="text" class="form-control" id="txt_srno2" name="txt_srno2" value="<?php echo $srno2;?>" >
										  </div>
										  
										    <label for="inputEmail3" class="col-sm-1 control-label">Sample No.:</label>
											<?php $job_explode= explode("-",$job_no)?>
										  <div class="col-sm-3">
											<input type="text" class="form-control"   id="txt_jobno1" name="txt_jobno1" value="<?php echo $job_explode[1];?>" >
										  </div>
										  
										  <div class="col-sm-2">
											<input type="text" class="form-control"   id="txt_jobno2" name="txt_jobno2" value="<?php echo $job_explode[1];?>"" ">
										  </div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
										
										  <label for="inputEmail3" class="col-sm-2 control-label">Inv Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="invoice_date" name="invoice_date"  value="<?php echo date('d/m/Y', strtotime($inv_date));?>" tabindex="1">
												</div>
											</div>
											
											<label for="inputEmail3" class="col-sm-2 control-label">Ref Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right"  id="ref_date" name="ref_date" value="<?php echo date('d/m/Y', strtotime($ref_date));?>" tabindex="2">
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
											<input type="text" class="form-control inputs" id="txt_ref" name="txt_ref" tabindex="3" value="<?php echo $ref_name;?>">
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
													<input type="text" class="form-control pull-right"  id="rec_date" name="rec_date" value="<?php echo date('d/m/Y', strtotime($rec_date));?>" tabindex="4">
												</div>
											</div>
											 <label for="inputEmail3" class="col-sm-2 control-label">Date:</label>
										  <div class="col-sm-4">
											<input type="text" class="form-control" id="txt_date" name="txt_date" value="<?php echo date('d/m/Y', strtotime($today_date));?>" tabindex="5">
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
											<option value="<?php echo $row_agency['agency_name']; ?>"
											<?php if($row_agency['agency_name']==$agency_name) echo 'selected="selected"'; ?>
											>
												<?php echo $row_agency['agency_name']; ?></option>
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
													<option value="<?php echo $row_authority['auth_name']; ?>"
											<?php if($row_authority['auth_name']==$auth_name) echo 'selected="selected"'; ?>
											>
												<?php echo $row_authority['auth_name']; ?></option>
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
									<textarea id="auth_address"  name="auth_address" style="width:295px;" tabindex="11">
									<?php echo $auth_address; ?>
									</textarea>
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
												<option value="<?php echo $row['id']; ?>"
											<?php if($row['city_name']==$city_name) echo 'selected="selected"'; ?>
											>
												<?php echo $row['city_name']; ?></option>
												<?php  }?>		
										</select>
										<input type="button" value="+" class="col-sm-1 btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
									</div>
									<div class="col-md-4">
										<label for="inputEmail3" class="col-sm-3 control-label">Reference Id:</label>
										<select class="form-control select2 col-sm-8"data-placeholder="Select a Reference"  style="width:250px;"  id="select_ref" name="select_ref" tabindex="10">
												<option>Select Reference..</option>
												<?php 
												
												/* $select_ref1 = "select * from reference WHERE `id`='$ref_id'";
												$result_ref1 = mysqli_query($conn, $select_ref1);
									

									
													$row_ref1 = mysqli_fetch_assoc($result_ref1);
													$r_name= $row_ref1['ref_name']; */
												
												
												
												$ref_query = "select * from reference ";
											
												$result_ref = mysqli_query($conn, $ref_query);

												if (mysqli_num_rows($result_ref) > 0) {
													while($row_ref = mysqli_fetch_assoc($result_ref)) {
												
												?>
												<option value="<?php echo $row_ref['id']; ?>"
												<?php if($row_ref['ref_name']==$ref_id) echo 'selected="selected"'; ?>>
													<?php echo $row_ref['ref_name']; ?></option>
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
												<option value="<?php echo $row_state['state_tincode'].'|'.$row_state['state_name'];?>" <?php if($row_state['state_tincode']== $auth_statecode){ echo "selected"; } ?> ><?php echo $row_state['state_name'];?></option>
												<?php } }?>
										
										</select>
										</div>
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="col-sm-1 control-label">State Code:</label>
									</div>
									<div class="col-md-3">	
										<input type="hidden" class="form-control inputs" tabindex="13" id="txt_statecode" name="txt_statecode" required value="<?php echo $auth_statecode;?>">
										<span id="just_show_stateid"><?php echo $auth_statecode;?></span>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="col-sm-1 control-label">GST No:</label>
									</div>
									<div class="col-md-3">
									<input type="text" class="form-control inputs" tabindex="14" id="txt_gstno" name="txt_gstno" required value="<?php echo $auth_gstno;?>">
									</div>
								
								</div>
								
								</br>
								<div class="row">
								<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Name Of Work:</label>
									</div>
								<div class="col-md-6">
										<textarea id="editor1"  name="editor1" tabindex="15">
										<?php echo $name_of_work; ?>
										</textarea>
									</div>
									<div class="col-md-1">
									<button type="button" class="btn btn-primary" id="btn_last_nofw" name="btn_last_nofw">Paste</button>
									</div>
								<div class="col-md-1">
								<label for="inputEmail3" class="control-label">Save to:</label>
								</div>
								<div class="col-md-3">
								<label for="inputEmail3" class="control-label">
								
								<input type="radio" value="0" name="rdo_button_ag_or_auth" id="rdo_button_ag_or_auth" <?php if($ag_or_auth_status=="0"){echo "checked";}?> ><span style="padding:10px;">Authority</span>
										<input type="radio" value="1" name="rdo_button_ag_or_auth" id="rdo_button_ag_or_auth" <?php if($ag_or_auth_status=="1"){echo "checked";}?>><span style="padding:10px;">Agency
										</span>
								</label>
								</div>
								</div>
								<hr style="border-top: 1px solid;">
								<div class="row">
									<div class="col-lg-12">
									<div id="gst_status" class="mystyle">
										<input type="radio" value="include" name="rdo_button" id="rdo_button" tabindex="16"><span style="padding:10px;">Include</span>
										<input type="radio" value="exclude" name="rdo_button" id="rdo_button" tabindex="17"><span style="padding:10px;">Exclude
										</span>
									</div>
									</div>
								</div>
								<br>
								<div id="hide_show_inc_exc" style="visibility:hidden;"><!---hide show inc and exclude---->
								<div class="row">
									<div class="col-lg-3">
									<input type="hidden" name="gst_type" id="gst_type">
									<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch_session;?>">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Material</label>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label" >QTY</label>
											
											<label for="inputEmail3" class="col-sm-4 control-label">Rate</label>
											
											<label for="inputEmail3" class="col-sm-4 control-label only_for_guj">CGST</label>
											
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label only_for_guj">SGST</label>
											<label for="inputEmail3" class="col-sm-4 control-label only_for_out_state">IGST</label>
											
											
											<label for="inputEmail3" class="col-sm-4 control-label">Net</label>
											
										</div>
									</div>
								</div>
							
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<input type="hidden" name="txt_material" id="txt_material">
												<select class="form-control select2" name="select_material" id="select_material" tabindex="18">
													<option>Select..</option>
													<?php 
													$sql = "select * from material where `mt_status`='1' AND `mt_isdeleted`='1'";
												
													$result = mysqli_query($conn, $sql);

													if (mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
													
													?>
			
													<option value="<?php echo $row['id'];?>"><?php echo $row['mt_name'];?></option>
													<?php }}?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
										
											<div class="col-sm-4">
												<input type="text" class="form-control" style="text-align:center;" tabindex="19" name="txt_qty" id="txt_qty">
											</div>
											
											<div class="col-sm-4">
												<input type="text" class="form-control" style="text-align:center;" name="txt_rate" id="txt_rate" tabindex="20">
											</div>
											
											<div class="col-sm-4">
												<input type="text" class="form-control only_for_guj" style="text-align:center;" name="txt_cgst" id="txt_cgst" tabindex="21">
											</div>
											
										</div>
									</div>
									<div class="col-lg-5">
										<div class="form-group">
										
											<div class="col-sm-3">
												<input type="text" class="form-control only_for_guj" style="text-align:center;" name="txt_sgst" id="txt_sgst" tabindex="22">
												<input type="text" class="form-control only_for_out_state" style="text-align:center;" name="txt_igst" id="txt_igst" tabindex="21">
											</div>
										
											<div class="col-sm-3">
												<input type="text" class="form-control" style="text-align:center;"  tabindex="24" name="txt_net" id="txt_net">
											</div>
											
											<div class="col-sm-2">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
												<input type="hidden" class="form-control" name="add_status" id="add_status"/>
								
												
												<button type="button" class="btn btn-info pull-right" id="btn_add_data" onclick="addData('add')" name="btn_add_data" id="btn_add_data" tabindex="25" >Add</button>
											
												
											</div>
											<div class="col-sm-2">
												<input type="button" value="EditRate" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-rate" tabindex="26">
											</div>
											<div class="col-sm-2">										
												
												<button type="button" class="btn btn-info pull-right" onclick="addData('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>
												
											</div>												
										</div>
									</div>		
								</div>
								<br>
								<input type="hidden" name="edit_rate" id="edit_rate">
								<div id="display_data">	
									<div class="row">
										<div class="col-lg-12">
											<table border="1px solid black" align="center" width="100%" id="aaaa">
												<tr>
													<th><label>Actions</label></th>
													<th><label>Material</label></th>	
													<th><label>Quantity</label></th>	
													<th><label>Rate</label></th>	
													<th><label>Taxable Amount</label></th>	
													<th><label>CGST</label></th>	
													<th><label>SGST</label></th>	
													<th><label>Net</label></th>	
													
												</tr>
												
													<?php
													$query = "select * from billmaster WHERE sr_no='$get_srno'  AND `bill_isdeleted`='0'";
													$result = mysqli_query($conn, $query);
											
		
													if (mysqli_num_rows($result) > 0) {
														while($r = mysqli_fetch_array($result)){
															if($r['bill_isdeleted'] == 0){

															?>
															<tr>
															<td style="text-align:center;">	
															<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?addData('delete','<?php echo $r['id']; ?>'):false;"></a>
														</td>

															<?php
														
															$mt_id= $r['material_id'];
															
															$query_mt = "select * from material WHERE id='$mt_id' AND `mt_status` = '1' AND `mt_isdeleted` = '1'";
															$result_mt = mysqli_query($conn, $query_mt);
															$rw = mysqli_fetch_array($result_mt);
															
															$query_sum = "select SUM(taxable_amt) as sum_taxable,SUM(cgstamt) as sum_cgstamt ,SUM(sgstamt) as sum_sgstamt,SUM(netamt) as sum_netamt from billmaster WHERE sr_no='$_POST[get_of_srno]' AND bill_isdeleted='0' ";
															$result_sum = mysqli_query($conn, $query_sum);

															$r_sum = mysqli_fetch_array($result_sum);
															
															$cgst=round($r_sum['sum_cgstamt'],2);
															$sgst=round($r_sum['sum_sgstamt'],2);
															$gst=$cgst+$sgst;
															
															$net=round($r_sum['sum_netamt']);
															
															?>
															<td style="text-align:center;"><?php echo $rw['mt_name'];?></td>
															<td style="text-align:center;"><?php echo $r['qty'];?></td>
															<td style="text-align:right;"><?php echo $r['rate'];?></td>
															<td style="text-align:right;"><?php echo $r['taxable_amt'];?></td>
															<td style="text-align:right;"><?php echo $r['cgstamt'];?></td>
															<td style="text-align:right;"><?php echo $r['sgstamt'];?></td>
															<td style="text-align:right;"><?php echo $r['netamt'];?></td>
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
									<div class="row">	
										<div class="col-lg-6">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-2 control-label">Total GST In Word:</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="txt_gstinword" name="txt_gstinword">											
												</div>
											</div>
										</div>
									
										<div class="col-lg-6">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-2 control-label">Total Bill In Word:</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="txt_billinword" name="txt_billinword">											
												</div>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">	
									<div class="col-lg-3">
										<div class="form-group">
											<div class="radio col-sm-4" style="margin-top:-3px;">
												<label>
												  <input type="radio" name="options" id="opt_cash" value="cash" tabindex="27">
												  Cash
												</label>
											</div>
											
											<div class="radio col-sm-4">
												<label>
												  <input type="radio" name="options" id="opt_cheque" value="cheque" tabindex="28">
												  Cheque
												</label>
											</div>
										

											<div class="radio col-sm-4">
												<label>
												  <input type="radio" name="options" id="opt_rtgs" value="rtgs" tabindex="29">
												  RTGS
												</label>
											  <input type="hidden" name="options_val" id="options_val">

											</div>
										</div>
									
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label class="col-sm-3" id="lbl_date" name="lbl_date"> Date:</label>
											<div class="input-group date col-sm-9">
												<div id="pay_date">
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="dateofpay" value="<?php echo date("d/m/Y")?>" name="dateofpay" tabindex="37">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label" id="lbl_chck" name="lbl_chck">Cheque No:</label>
											<div class="col-sm-8">
												<input type="text" class="form-control"name="txt_chck" id="txt_chck" tabindex="30">											
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label" id="lbl_info" name="lbl_info">Bank Name:</label>
											<div class="col-sm-8">
												<input type="text" class="form-control"name="txt_info" id="txt_info" tabindex="31">											
											</div>
										</div>
									</div>
								</div>
						
								<div class="row">	
									<div class="col-lg-12">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label" >Remarks:</label>
											<div class="col-sm-11">
												<textarea rows="3" style="width:100%;" name="txt_remark" id="txt_remark" tabindex="32" ></textarea>	
											</div>
										</div>
									</div>
								</div>
								
							</div><!---hide show inc and exclude---->	
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
												<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" tabindex="33" style="width:100px" disabled>Estimate</button>
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

$("input[name='rdo_button']").change(
    function(e)
    {
        var get_state=$("#txt_state").val();
		if(get_state !=""){
		$.confirm({
        title: "warning",
        content: "In Future GST TYPE Will Not Change.. ?",
        buttons: {
			confirm: function () {
				
			var gst_value= $('input[name=rdo_button]:checked').val();
			$("#gst_type").val(gst_value);
			$("#gst_status").innerHTML="GST TYPE: "+gst_value;
			document.getElementById("gst_status").innerHTML = '<h3>GST TYPE: '+gst_value+'</h3>';
			document.getElementById('hide_show_inc_exc').style.visibility = 'visible';
			$("#btn_estimate").prop("disabled", false);
			document.getElementById("gst_type").classList.remove("mystyle");
			
			document.getElementById('show_state_id').style.visibility = 'hidden';
			
			var get_only_state_to_show= get_state.split("|");
			document.getElementById("show_only_state_name").innerHTML =get_only_state_to_show[1];

			if($('#txt_statecode').val()==24){
				$('.only_for_guj').show();
				$('.only_for_out_state').hide();
			}else{
				$('.only_for_guj').hide();
				$('.only_for_out_state').show();
				
			}
			
		},
            cancel: function () {
				$("input[name='rdo_button']").prop("checked", false);
                return;
            }
			}
        })
		}else{
			alert("Select State First");
			$("input[name='rdo_button']").prop("checked", false);
                return;
		}
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
		url : "<?php $base_url; ?>Form_Data.php",
		type: "POST",
		data : postData,
		success: function(data)
		 {
			//$("#select_city").html(data);
          // alert(data)	;
		//document.getElementById('txt_jobno2').value	=data;	   
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
		url : "<?php $base_url; ?>Form_Data.php",
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
	
    $("#select_material").change(function(){
      
			 var txt_new_material = $('#select_material').val(); 
			 var gst_type = $('#gst_type').val(); 
			 var txt_statecode = $('#txt_statecode').val(); 
			 var postData = '&txt_new_material='+txt_new_material+'&gst_type='+gst_type+'&txt_statecode='+txt_statecode;
			
			$.ajax({
				url : "<?php $base_url; ?>getRate.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				success: function(data,status,  xhr)
				 {
					if(txt_statecode==24){  
					  $("#txt_rate").val(data.txt_rate);
					  $("#txt_qty").val(data.txt_qty);
					  $("#txt_cgst").val(data.txt_cgst);
					  $("#txt_sgst").val(data.txt_sgst);
					  $("#txt_net").val(data.txt_net);	
				 }else{
					 $("#txt_rate").val(data.txt_rate);
					  $("#txt_qty").val(data.txt_qty);
					 // $("#txt_cgst").val(data.txt_cgst);
					  //$("#txt_sgst").val(data.txt_sgst);
					  $("#txt_igst").val(data.txt_igst);
					  $("#txt_net").val(data.txt_net);
					 
				 }
				 }
			}); 
    });
	
	$("#txt_qty").change(function(){
				
				var txt_new_material = $('#select_material').val();
                var txt_statecode = $('#txt_statecode').val(); 

				if(txt_statecode==24){
				var gst_type = $('#gst_type').val(); 
				var txt_qty = $('#txt_qty').val(); 
				var txt_rate = $('#txt_rate').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_igst = $('#txt_igst').val(); 
				var txt_net = $('#txt_net').val(); 
				var edit_rate = $('#edit_rate').val(); 
			
				var postData = '&txt_new_material='+txt_new_material+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_igst='+txt_igst+'&txt_net='+txt_net+'&edit_rate='+edit_rate+'&gst_type='+gst_type+'&txt_statecode='+txt_statecode;
				
				}else{
					
				var gst_type = $('#gst_type').val(); 
				var txt_qty = $('#txt_qty').val(); 
				var txt_rate = $('#txt_rate').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_igst = $('#txt_igst').val(); 
				var txt_net = $('#txt_net').val(); 
				var edit_rate = $('#edit_rate').val(); 
			
				var postData = '&txt_new_material='+txt_new_material+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_igst='+txt_igst+'&txt_net='+txt_net+'&edit_rate='+edit_rate+'&gst_type='+gst_type+'&txt_statecode='+txt_statecode;
					
					
				}
				
		$.ajax({
			url : "<?php $base_url; ?>getFinalRate.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  $("#txt_rate").val(data.txt_rate);
				  $("#txt_qty").val(data.txt_qty);
				  $("#txt_cgst").val(data.txt_cgst);
				  $("#txt_sgst").val(data.txt_sgst);
				  $("#txt_igst").val(data.txt_igst);
				  $("#txt_net").val(data.txt_net);
		
 			 }

		}); 
    });
	
	$("#btn_estimate").click(function(){
		//alert("Estimate Your Bill Successfully");
		

	});
	$("#btn_saves").click(function(){
	
		var radios =$('input:radio[name="options"]').val();
		if(radios==null){
			 $("#options_val").val("blank");
			var radios = $('#options').val(); 
			//alert(radios);
			 alert("Saved Bill Successfully");
		}
		// alert("Saved Bill Successfully");
	
		
	});	
			
	$("#btn_edit_data").click(function(){
					$('#btn_add_data').show();
					$('#btn_edit_data').hide();

	});
});

</script>
<script>

function getbills(){
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
				var txt_statecode = $('#txt_statecode').val(); 
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=view&'+$("#billing").serialize()+'&get_of_srno='+get_of_srno+'&txt_statecode='+txt_statecode,
        success:function(html){
            $('#display_data').html(html);
        }
    });
}

function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
				var txt_srno1 = $('#txt_srno1').val(); 
				var txt_srno2 = $('#txt_srno2').val(); 
				var get_srno=txt_srno1+txt_srno2;
				
				var txt_jobno1 = $('#txt_jobno1').val(); 
				var txt_jobno2 = $('#txt_jobno2').val();
				
				var txt_jobno = txt_jobno1+txt_jobno2;
				
				var invoice_date = $('#invoice_date').val(); 
				var txt_ref = $('#txt_ref').val(); 
				var ref_date = $('#ref_date').val(); 
				var rec_date = $('#rec_date').val(); 
				var txt_date = $('#txt_date').val(); 
				var select_agency = $('#select_agency').val(); 
				var select_auth = $('#select_auth').val(); 
				var auth_address = $('#auth_address').val(); 
				var get_only_state= $('#txt_state').val().split("|");
				var txt_state = get_only_state[0]; 
				var txt_statecode = $('#txt_statecode').val(); 
				var txt_gstno = $('#txt_gstno').val(); 
				var txtarea_work =CKEDITOR.instances.editor1.getData();
				
				var select_city = $('#select_city').val(); 
				var select_ref = $('#select_ref').val(); 
				var txt_new_material = $('#select_material').val(); 
				var txt_qty = $('#txt_qty').val(); 
				var txt_rate = $('#txt_rate').val(); 
				if(txt_statecode==24){
					var txt_cgst = $('#txt_cgst').val(); 
					var txt_sgst = $('#txt_sgst').val();
				}else{
					var txt_igst = $('#txt_igst').val();
				}
				var txt_net = $('#txt_net').val(); 
				var gst_type = $('#gst_type').val(); 
				var branch_id = $('#branch_id').val(); 
				var rdo_button_ag_or_auth = $("input[name='rdo_button_ag_or_auth']:checked").val(); 
				
				
				
				$('#add_status').val("1");

				if(txt_statecode==24){
					
				billData = '&action_type='+type+'&id='+id+'&get_srno='+get_srno+'&txt_jobno='+txt_jobno+'&invoice_date='+invoice_date+'&txt_ref='+txt_ref+'&ref_date='+ref_date+'&rec_date='+rec_date+'&txt_date='+txt_date+'&select_agency='+select_agency+'&select_auth='+select_auth+'&txtarea_work='+txtarea_work+'&select_city='+select_city+'&select_ref='+select_ref+'&txt_new_material='+txt_new_material+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_net='+txt_net+'&auth_address='+auth_address+'&txt_state='+txt_state+'&txt_statecode='+txt_statecode+'&txt_gstno='+txt_gstno+'&gst_type='+gst_type+'&branch_id='+branch_id+'&rdo_button_ag_or_auth='+rdo_button_ag_or_auth;
				
	            }else{
					
				billData = '&action_type='+type+'&id='+id+'&get_srno='+get_srno+'&txt_jobno='+txt_jobno+'&invoice_date='+invoice_date+'&txt_ref='+txt_ref+'&ref_date='+ref_date+'&rec_date='+rec_date+'&txt_date='+txt_date+'&select_agency='+select_agency+'&select_auth='+select_auth+'&txtarea_work='+txtarea_work+'&select_city='+select_city+'&select_ref='+select_ref+'&txt_new_material='+txt_new_material+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_igst='+txt_igst+'&txt_net='+txt_net+'&auth_address='+auth_address+'&txt_state='+txt_state+'&txt_statecode='+txt_statecode+'&txt_gstno='+txt_gstno+'&gst_type='+gst_type+'&branch_id='+branch_id+'&rdo_button_ag_or_auth='+rdo_button_ag_or_auth;
					
				}
				
				//exit();
				
    }else if (type == 'edit'){
		
				var txt_srno1_edit = $('#txt_srno1').val(); 
				var txt_srno2_edit = $('#txt_srno2').val(); 
				var get_srno_edit=txt_srno1_edit+txt_srno2_edit;
				var txt_new_material_edit = $('#select_material').val(); 
				var txt_qty_edit = $('#txt_qty').val(); 
				var txt_rate_edit = $('#txt_rate').val(); 
				var txt_statecode = $('#txt_statecode').val();
				if(txt_statecode==24){
				var txt_cgst_edit = $('#txt_cgst').val(); 
				var txt_sgst_edit = $('#txt_sgst').val(); 
				}else{
				var txt_igst_edit = $('#txt_igst').val();
				}
				var txt_net_edit = $('#txt_net').val(); 
				var txt_id = $('#idEdit').val();  
		
		        if(txt_statecode==24){
				billData = $("#billing").find('.form').serialize()+'&action_type='+type+'&txt_new_material_edit='+txt_new_material_edit+'&txt_qty_edit='+txt_qty_edit+'&txt_rate_edit='+txt_rate_edit+'&txt_rate_edit='+txt_rate_edit+'&txt_cgst_edit='+txt_cgst_edit+'&txt_sgst_edit='+txt_sgst_edit+'&txt_net_edit='+txt_net_edit+'&get_srno_edit='+get_srno_edit+'&txt_id='+txt_id+'&txt_statecode='+txt_statecode;
				
				}else{
					
				billData = $("#billing").find('.form').serialize()+'&action_type='+type+'&txt_new_material_edit='+txt_new_material_edit+'&txt_qty_edit='+txt_qty_edit+'&txt_rate_edit='+txt_rate_edit+'&txt_rate_edit='+txt_rate_edit+'&txt_igst_edit='+txt_igst_edit+'&txt_net_edit='+txt_net_edit+'&get_srno_edit='+get_srno_edit+'&txt_id='+txt_id+'&txt_statecode='+txt_statecode;
					
				}
    }else{
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
	
				billData = 'action_type='+type+'&id='+id+'&get_of_srno='+get_of_srno;
    }
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: billData,
        success:function(msg){
         
                getbills();
				$('#btn_edit_data').hide();
				$('#btn_add_data').show();
          
        }
    });
}
function editData(id){
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var txt_statecode = $('#txt_statecode').val();
				var get_of_srno=txt_srno_of1+txt_srno_of2;
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=data&id='+id+'&get_of_srno='+get_of_srno+'&txt_statecode='+txt_statecode,
        success:function(data){
            $('#idEdit').val(data.data_id);
			//$('#select_material option[value=data.material]').attr('selected','selected');
            $('#select_material').val(data.material);
			//alert(data.material);
			//localStorage.setItem("default_option", data.material);

			//$("#select_material option[value="data.material"]").attr("selected", true);
            $('#txt_qty').val(data.qty);
            $('#txt_rate').val(data.rate);
            $('#txt_cgst').val(data.cgstamt);
            $('#txt_sgst').val(data.sgstamt);
            $('#txt_igst').val(data.igstamt);
            $('#txt_net').val(data.netamt);
			$('#btn_edit_data').show();
			$('#btn_add_data').hide();
        }
    });
}
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
