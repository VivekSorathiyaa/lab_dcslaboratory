
<?php include("header.php");?>
<?php include("sidebar.php");
include("connection.php");

if($_SESSION['isadmin']=="2")
{
	?>
	<script >
		window.location.href="<?php $base_url; ?>home.php";
	</script>
	<?php
	
}

		/*$delet_query="DELETE FROM billmaster WHERE `bill_isinsert`='0'";
		$qrys_delete = mysqli_query($conn,$delet_query);*/

	$select_query = "select * from bill_totalmaster WHERE `bt_id`='$_GET[bt_id]'";
	$result_select = mysqli_query($conn, $select_query);


	if (mysqli_num_rows($result_select) > 0) {
		$row_select = mysqli_fetch_assoc($result_select);
	/*	if($row_select['job_no']==0 || $row_select['agency_id']==0 || $row_select['agency_name']=="" || $row_select['auth_name'])*/
		
		$serial_no1= $row_select['sr_no'];
		$job_no= $row_select['job_no'];
		$est_sr_no= $row_select['est_sr_no'];
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
		$total_taxableamt= $row_select['total_taxableamt'];
		$cgsttotal= $row_select['cgsttotal'];
		$sgsttotal= $row_select['sgsttotal'];
		$paymenttype= $row_select['paymenttype'];
		$dateofpay= $row_select['dateofpay'];
		$check_no= $row_select['check_no'];
		$bank_name= $row_select['bank_name'];
		$remarks= $row_select['remarks'];
		$totalgst_inword= $row_select['totalgst_inword'];
		$billamt_inword= $row_select['billamt_inword'];
		$bill_sr_manualy= $row_select['bill_sr_manualy'];
		$ag_or_auth_status= $row_select['ag_or_auth_status'];

		$srno2=substr($serial_no1,7);
		$srno1=substr($serial_no1,0,7);
		
		if($dateofpay=="0000-00-00"){
			$paydate="";
		}
		else{
			$paydate=$row_select['dateofpay'];

		}
		if($check_no=="0"){
			$checkno="";
		}
		else{
			$checkno=$row_select['check_no'];
		}
		
		
		$select_query1 = "select * from billmaster WHERE `sr_no`='$est_sr_no'";
		$result_select1 = mysqli_query($conn, $select_query1);


		if (mysqli_num_rows($result_select1) > 0) {
			$row_select1 = mysqli_fetch_assoc($result_select1);
			//$name_of_work= $row_select1['name_of_work'];
			$name_of_work=strip_tags(html_entity_decode($row_select1['name_of_work']),"<strong><em><br>");
			$city_id= $row_select1['city_id'];
			$ref_name= $row_select1['ref_name'];
			$ref_id= $row_select1['ref_id'];
			$material_id=$row_select1['material_id'];
			
				$select_city = "select * from city WHERE `id`='$city_id'";
				$result_city = mysqli_query($conn, $select_city);
	

				if (mysqli_num_rows($result_city) > 0) {
					$row_city = mysqli_fetch_assoc($result_city);
					//$name_of_work= $row_select1['name_of_work'];
					$name_of_work=strip_tags(html_entity_decode($row_select1['name_of_work']),"<strong><em><br>");
					$city_name= $row_city['city_name'];
				}
				
				
		}
		
	}

		$query="SELECT * FROM fyearmaster WHERE `fy_status`='1'";
		$qrys = mysqli_query($conn,$query);
		$no_of_rows=mysqli_num_rows($qrys);
		if($no_of_rows>0){
								
			$r = mysqli_fetch_array($qrys);
			$year=$r['fy_name'];
			$srno=substr($year,2);
			$tec="TMTL/";
		}
		
		if(isset($_POST['btn_add_city']))
		{
			 echo $insert = "insert into city(`city_name`,`city_status`,`city_isdeleted`) values('$_POST[txt_new_city]','1','1')"; 
			$qrys = mysqli_query($con,$insert);
		}
		
		

//-------------------------------Update code-------------
		if(isset($_POST['btn_update'])){
				
				$sr_no1=$_POST['txt_srno1'];
				$sr_no2=$_POST['txt_srno2'];
				$sr_no=$sr_no1.$sr_no2;
				
				
				$fyear_query = "select * from fyearmaster WHERE fy_status='1'";
				$result_fyear = mysqli_query($conn, $fyear_query);

				if (mysqli_num_rows($result_fyear) > 0) {
					$row_fyear = mysqli_fetch_assoc($result_fyear);
					$fyear= $row_fyear['fy_name'];
				}	
				
				$tax_query = "select * from billmaster WHERE sr_no='$est_sr_no'";
				$result_tax = mysqli_query($conn, $tax_query);
				
				if (mysqli_num_rows($result_tax) > 0) {
					$row_tax = mysqli_fetch_assoc($result_tax);
					$tax_amt= $row_tax['taxable_amt'];
				}	
				
				 $query_sum1 = "select SUM(taxable_amt) as sum_taxable,SUM(cgstamt) as sum_cgstamt ,SUM(sgstamt) as sum_sgstamt,SUM(netamt) as sum_netamt, SUM(igstamt) as sum_igstamt from billmaster WHERE sr_no='$est_sr_no' AND bill_isdeleted='0'";
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
				
				$net=round($r_sum1['sum_netamt']);
				$curr_date=date("Y-m-d");
				
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
					$agency_name= $row_agency['agency_name'];
				} 
				$agency_name= $_POST['select_agency'];
				
				//-----------payment logic-----
				
				$pay_option_val=$_POST['options_val'];
				
				
				if (!isset($_POST['options']))  {
					
					
						$pay_option="";
						$pay_date="0000-00-00";
						$check_no="";
						$bank_name="";
				}
				else{
					$pay_option=$_POST['options'];
					
					if($pay_option=="cash"){
					
					$pay_of_dt_day=substr($_POST['dateofpay'],0,2);
					$pay_of_dt_month=substr($_POST['dateofpay'],3,2);
					$pay_of_dt_year=substr($_POST['dateofpay'],6,4);
					$pay_date = $pay_of_dt_year."-".$pay_of_dt_month."-".$pay_of_dt_day;
					$check_no="";
					$bank_name="";
					
					}
					else if($pay_option=="cheque"){
						
						$pay_of_dt_day=substr($_POST['dateofpay'],0,2);
						$pay_of_dt_month=substr($_POST['dateofpay'],3,2);
						$pay_of_dt_year=substr($_POST['dateofpay'],6,4);
						$pay_date = $pay_of_dt_year."-".$pay_of_dt_month."-".$pay_of_dt_day;
						$check_no=$_POST['txt_chck'];
						$bank_name=$_POST['txt_info'];
					}
					else if($pay_option=="rtgs"){
						
						$pay_of_dt_day=substr($_POST['dateofpay'],0,2);
						$pay_of_dt_month=substr($_POST['dateofpay'],3,2);
						$pay_of_dt_year=substr($_POST['dateofpay'],6,4);
						$pay_date = $pay_of_dt_year."-".$pay_of_dt_month."-".$pay_of_dt_day;
						$check_no=$_POST['txt_chck'];
						$bank_name=$_POST['txt_info'];
					}
					
					else{
						$pay_date="0000-00-00";
						$check_no="";
						$bank_name="";
					}
				}
				
				$job_no_merge= $_POST["txt_jobno1"].$_POST["txt_jobno2"];
				$state_explode= explode("|",$_POST['txt_state']);
				$update="update bill_totalmaster SET `fy_id`='$fyear',`sr_no`='$sr_no',`job_no`='$job_no_merge',`agency_id`='$_POST[select_agency]',`agency_name`='$agency_name',`auth_name`='$_POST[select_auth]',`auth_address`='$_POST[auth_address]',`auth_state`='$state_explode[0]',`auth_statecode`='$_POST[txt_statecode]',`auth_gstno`='$_POST[txt_gstno]',`ref_date`='$new_ref_date',`rec_date`='$new_rec_date',`inv_date`='$new_inv_date',`today_date`='$new_today_date',`total_taxableamt`='$tax_amt',`cgsttotal`='$cgst1',`sgsttotal`='$sgst1',`igsttotal`='$igst1',`subtotal`='$gst1',`grandtotal`='$net',`paymenttype`='$pay_option',`dateofpay`='$pay_date',`check_no`='$check_no',`bank_name`='$bank_name',`remarks`='$_POST[txt_remark]',`totalgst_inword`='$_POST[txt_gstinword]',`billamt_inword`='$_POST[txt_billinword]',`bt_isstatus`=0,`bt_modifiedby`='$_SESSION[name]',`bt_modifieddate`='$curr_date',`bill_sr_manualy`='$_POST[txt_manualy]',`ag_or_auth_status`='$_POST[rdo_button_ag_or_auth]' WHERE `bt_id`='$_GET[bt_id]'"; 
				
				
				mysqli_query($conn,$update);
				$txtarea = $_POST['editor1'];
				$txtarea_work = nl2br(htmlentities($txtarea, ENT_QUOTES, 'UTF-8'));
				
				$update_bill="update billmaster SET `fy_id`='fyear',`agency_id`='$_POST[select_agency]',`agency_name`='$agency_name',`job_no`='$job_no_merge',`ref_name`='$_POST[txt_ref]',`ref_date`='$new_ref_date',`rec_date`='$new_rec_date',`inv_date`='$new_inv_date',`today_date`='$new_today_date',`authority_name`='$_POST[select_auth]',`auth_address`='$_POST[auth_address]',`auth_state`='$state_explode[0]',`auth_statecode`='$_POST[txt_statecode]',`auth_gstno`='$_POST[txt_gstno]',`name_of_work`='$txtarea_work',`city_id`='$_POST[select_city]',`ref_id`='$_POST[select_ref]',`bill_status`='1',`bill_modifiedby`='$_SESSION[name]',`bill_modifieddate`='$curr_date',`bill_isinsert`='1',`ag_or_auth_status`='$_POST[rdo_button_ag_or_auth]' WHERE `sr_no`='$_GET[est_sr_no]'";
			
				$result_of_update=mysqli_query($conn,$update_bill);	
				?>
					<script>alert("Bill Updated Successfully");</script>
					<script>window.location.href="<?php echo $base_url; ?>view_bill.php";</script>
			<?php
			
		}
	
?>

<?php

		$sr_no=1;
		$final_sr_no;
		$querys_serno = "SELECT * FROM billmaster ";
		$qrys_serno = mysqli_query($conn,$querys_serno);
		$rows=mysqli_num_rows($qrys_serno);
															
		while($r1 = mysqli_fetch_array($qrys_serno)){
			$serial_no=$r1['id'];
		}
		if($rows<1){
			$final_sr_no=$sr_no;
			$get_srno=$tec.$srno.$final_sr_no;
		
		}
		else{
		
		$final_sr_no = $serial_no + 1;
		$get_srno=$tec.$srno.$final_sr_no;

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
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Edit Billing
			</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Edit Billing Form</h3>
						</div>
						<form class="form" id="billing" method="post">
							<div class="box-body"  style="border:1px groove #ddd;">
								<div class="row">
									
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">SR.No.:</label>
											
										  <div class="col-sm-2">
											<input type="text" class="form-control" value="<?php echo $srno1;?>" id="txt_srno1" name="txt_srno1" >
										  </div>
										  <div class="col-sm-2">
											<input type="text" class="form-control" id="txt_srno2" name="txt_srno2" value="<?php echo $srno2;?>">
										  </div>
										  
										    <label for="inputEmail3" class="col-sm-1 control-label">Job No.:</label>
											<?php $job_explode= explode("-",$job_no)?>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="txt_jobno1"  name="txt_jobno1" value="<?php echo $job_explode[0]."-";?>">
											</div>
											
											<div class="col-sm-2">
												<input type="text" class="form-control" id="txt_jobno2"  name="txt_jobno2" value="<?php echo $job_explode[1];?>">
											</div>
										</div>
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Inv. Date:</label>
										  <div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="2" id="invoice_date" name="invoice_date" value="<?php echo date('d/m/Y', strtotime($inv_date));?>" tabindex="1">
												</div>
										  </div>
										  <label for="inputEmail3" class="col-sm-2 control-label">Rec Date:</label>
										  <div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="2" id="rec_date" name="rec_date" value="<?php echo date('d/m/Y', strtotime($rec_date));?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Reference:</label>
										  <div class="col-sm-10">
											<input type="text" class="form-control" tabindex="3" id="txt_ref" name="txt_ref" value="<?php echo $ref_name;?>">
										  </div>						  
										</div>
									</div>
									
									
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label" >Ref Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="4" id="ref_date" name="ref_date" value="<?php echo date('d/m/Y', strtotime($ref_date));?>">
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
								
									<div class="col-lg-4">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Agency:</label>
											
											<div class="col-sm-10">
										
												<select class="form-control select2 col-md-7 col-xs-12"  style="width:250px" data-placeholder="Select a Agency" id="select_agency" name="select_agency" tabindex="6">
													<option>Select..</option>
													<?php 
													$agency_query = "select * from agency";
												
													$result_agency = mysqli_query($conn, $agency_query);

													if (mysqli_num_rows($result_agency) > 0) {
														while($row_agency = mysqli_fetch_assoc($result_agency)) {
													
													?>
													
													<option value="<?php echo $row_agency['agency_name']; ?>"
													<?php if($row_agency['agency_name']==$agency_name) echo 'selected="selected"'; ?>
													>
														<?php echo $row_agency['agency_name']; ?></option>
													<?php
													} 
													}?>
												</select>
																					
											</div>
										 
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Autority:</label>
											
											<div class="col-sm-10">
										
												<select class="form-control select2 col-md-7 col-xs-12" tabindex="7" style="width:250px" data-placehold="Select a Autority" id="select_auth" name="select_auth">
													<option>Select..</option>
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
													<?php
													} 
													}?>
												</select>
											
											</div>
										 
										</div>
									</div>
									<!--<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Edit Authority:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control" tabindex="8" id="txt_edit_auth" name="txt_edit_auth" value="<?php //echo $auth_name;?>">
									</div>-->
								</div>
								</br>
								<br>
								<div class="row">
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">City:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control select2  col-md-7 col-xs-12" data-placeholder="Select a City" id="select_city" name="select_city" tabindex="9">
												<option>Select..</option>
												<?php 
														$sql = "select * from city ";
														
													
														$result_city = mysqli_query($conn, $sql);

															while($row = mysqli_fetch_assoc($result_city)) {
														
														?>
														<option value="<?php echo $row['id']; ?>"
													<?php if($row['city_name']==$city_name) echo 'selected="selected"'; ?>
													><?php echo $row['city_name']; ?></option>
													<?php
													}?>
												</select>
									</div>
									
									<div class="col-md-1">
											<input type="button" value="+" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
										</div>
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Reference Id:</label>
									</div>
									<div class="col-md-2">
											
											<select class="form-control select2 col-md-7 col-xs-12 "data-placeholder="Select a Reference" id="select_ref" name="select_ref" tabindex="10">
													
													<option>Select..</option>
													<?php 
													
													$select_ref1 = "select * from reference WHERE `id`='$ref_id'";
													$result_ref1 = mysqli_query($conn, $select_ref1);
										

										
														$row_ref1 = mysqli_fetch_assoc($result_ref1);
														$r_name= $row_ref1['ref_name'];
													
				
													
														$ref_query = "select * from reference ";
													
														$result_ref = mysqli_query($conn, $ref_query);

															while($row_ref = mysqli_fetch_assoc($result_ref)) {
														
														?>
														<option value="<?php echo $row_ref['id']; ?>"
													<?php if($row_ref['ref_name']==$r_name) echo 'selected="selected"'; ?>>
														<?php echo $row_ref['ref_name']; ?></option>
													<?php
													
													}?>
												</select>
													
									</div>
									<div class="col-md-1">
												<input type="submit" value="+" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default-ref" tabindex="11">
									</div>
									<div class="col-md-4">
									<label for="inputEmail3" class="col-sm-3 control-label">Auth Address:</label>
									<textarea id="auth_address"  name="auth_address" style="width:295px;" tabindex="12">
									<?php echo $auth_address; ?>
									</textarea>
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-1">
										<label for="inputEmail3" class="col-sm-1 control-label">Auth State:</label>
									</div>
									<?php
									$only_state_query = "select * from state where state_tincode=".$auth_state;
									$only_result_state = mysqli_fetch_assoc(mysqli_query($conn, $only_state_query));
									?>
									<div class="col-md-3">
									<span id="show_only_state_name"><?php echo $only_result_state['state_name'];?></span>
										<div id="show_state_id" style="visibility:hidden;">
										<select class="form-control select2 col-sm-8" data-placeholder="Select a State" style="width:250px;" tabindex="13" id="txt_state" name="txt_state" required>
										<option value="">Select - State</option>
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
										<input type="hidden" class="form-control inputs" tabindex="14" id="txt_statecode" name="txt_statecode" required value="<?php echo $auth_statecode;?>" >
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
										<label for="inputEmail3" class="control-label">Name of Work:</label>
									</div>
									<div class="col-md-7">
										<textarea id="editor1" name="editor1" tabindex="16">
										<?php echo $name_of_work; ?>
										</textarea>
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
								<br>
								<hr style="border-top: 1px solid;">
								<?php
									$query = "select * from billmaster WHERE sr_no='$est_sr_no'";
									$result = mysqli_query($conn, $query);
									if (mysqli_num_rows($result) > 0) {
										 $get_gsttype = mysqli_fetch_array($result);
										 $get_gst_type = $get_gsttype["gst_type"];
									}else{
										$get_gst_type="include";
									}
								
								?>
								<div class="row">
									<div class="col-lg-12">
									<div id="gst_status">
										<h3>GST TYPE: <?php echo $get_gst_type;?></h3>
									</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3">
									<input type="hidden" name="gst_type" id="gst_type" value="<?php echo $get_gst_type;?>">
									<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch_session?>">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Material</label>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label" >QTY</label>
											
											<label for="inputEmail3" class="col-sm-4 control-label">Rate</label>
											
											<?php if($auth_statecode==24){ ?>
											
											<label for="inputEmail3" class="col-sm-4 control-label">CGST</label>
											<?php } ?>
											
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<?php if($auth_statecode==24){ ?>
											<label for="inputEmail3" class="col-sm-4 control-label">SGST</label>
											<?php } else{?>
											<label for="inputEmail3" class="col-sm-4 control-label">IGST</label>
											<?php } ?>
											
											
											<label for="inputEmail3" class="col-sm-4 control-label">Net</label>
											
										</div>
									</div>
							</div>
							
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control select2" name="select_material" tabindex="17" id="select_material">
												
												<option>Select..</option>
													<?php 
													
													$select_mt1 = "select * from material WHERE `id`='$material_id'";
													$result_mt1 = mysqli_query($conn, $select_mt1);
										

										
														$row_mt1 = mysqli_fetch_assoc($result_mt1);
														$mt_name= $row_mt1['mt_name'];
													
				
													
														$mt_query = "select * from material ";
													
														$result_mt = mysqli_query($conn, $mt_query);

															while($row_mt = mysqli_fetch_assoc($result_mt)) {
														
														?>
														<option value="<?php echo $row_mt['id']; ?>"
													<?php if($row_mt['mt_name']==$mt_name) echo 'selected="selected"'; ?>>
														<?php echo $row_mt['mt_name']; ?></option>
													<?php
													
													}?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
										
											<div class="col-sm-4">
												<input type="text" class="form-control" style="text-align:center;" tabindex="18" name="txt_qty" id="txt_qty">
											</div>
											
											<div class="col-sm-4">
												<input type="text" class="form-control" style="text-align:center;"name="txt_rate" id="txt_rate">
											</div>
											
											<div class="col-sm-4">
												<?php if($auth_statecode==24){?>
												<input type="text" class="form-control" style="text-align:center;" name="txt_cgst" id="txt_cgst" >
											<?php } ?>
											</div>
											
										</div>
									</div>
									<div class="col-lg-5">
										<div class="form-group">
										
											<div class="col-sm-3">
												<?php if($auth_statecode==24){?>
												<input type="text" class="form-control" style="text-align:center;" name="txt_sgst" id="txt_sgst" >
												<?php } else {?>
												<input type="text" class="form-control" style="text-align:center;" name="txt_igst" id="txt_igst">
												<?php } ?>
											</div>
										
											<div class="col-sm-3">
												<input type="text" class="form-control" style="text-align:center;" name="txt_net" id="txt_net">
											</div>
											
											<div class="col-sm-2">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
								
												
												<button type="button" class="btn btn-info pull-right" id="btn_add_data" onclick="addData('add')" name="btn_add_data" id="btn_add_data" tabindex="19" >Add</button>
											
												
											</div>
											<div class="col-sm-2">
												<input type="button" value="EditRate" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-rate">
											</div>
											<div class="col-sm-2">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
										
												
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
													<th width="10%"><label>Actions</label></th>
													<th width="35%"><label>Material</label></th>	
													<th width="5%"><label>Quantity</label></th>	
													<th width="10%"><label>Rate</label></th>	
													<th width="10%"><label>Taxable Amount</label></th>	
													<?php if($auth_statecode==24){ ?>
													<th width="10%"><label>CGST</label></th>	
													<th width="10%"><label>SGST</label></th>
													<?php } else { ?>
													<th width="10%"><label>IGST</label></th>
													<?php } ?>
													<th width="10%"><label>Net</label></th>	
													
												</tr>
												
													<?php
													$query = "select * from billmaster WHERE sr_no='$est_sr_no'";
													$result = mysqli_query($conn, $query);
											
		
													if (mysqli_num_rows($result) > 0) {
														while($r = mysqli_fetch_array($result)){
										
															if($r['bill_isdeleted'] == 0){
															?>
															<tr>
															<td style="text-align:center;" width="10%">	
															<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?addData('delete','<?php echo $r['id']; ?>'):false;"></a>
														</td>

															<?php
															$mt_id= $r['material_id'];
															
															$query_mt = "select * from material WHERE id='$mt_id'";
															$result_mt = mysqli_query($conn, $query_mt);
															$rw = mysqli_fetch_array($result_mt);
															
															$query_sum = "select SUM(taxable_amt) as sum_taxable,SUM(cgstamt) as sum_cgstamt ,SUM(igstamt) as sum_igstamt, SUM(sgstamt) as sum_sgstamt,SUM(netamt) as sum_netamt from billmaster WHERE sr_no='$est_sr_no' AND bill_isdeleted='0'";
															$result_sum = mysqli_query($conn, $query_sum);
															
															$r_sum = mysqli_fetch_array($result_sum);
															
															$cgst=round($r_sum['sum_cgstamt'],2);
															$sgst=round($r_sum['sum_sgstamt'],2);
															$igst=round($r_sum['sum_igstamt'],2);
															if($auth_statecode==24){
															$gst=$cgst+$sgst;
															}else{
															$gst=$igst;
															}
																														
															$net=round($r_sum['sum_netamt']);
														
															?>
															<td style="text-align:center;" width="35%"><?php echo $rw['mt_name'];?></td>
															<td style="text-align:center;" width="5%"><?php echo $r['qty'];?></td>
															<td style="text-align:right;" width="10%"><?php echo $r['rate'];?></td>
															<td style="text-align:right;" width="10%"><?php echo $r['taxable_amt'];?></td>
															<?php if($auth_statecode==24){ ?>
															<td style="text-align:right;" width="10%"><?php echo $r['cgstamt'];?></td>
															<td style="text-align:right;" width="10%"><?php echo $r['sgstamt'];?></td>
															<?php } else{ ?>
															<td style="text-align:right;" width="10%"><?php echo $r['igstamt'];?></td>
															<?php } ?>
															<td style="text-align:right;" width="10%"><?php echo $r['netamt'];?></td>
															</tr>
															<?php
															}
														}
													}
												?>
							
												<tr>
													<th colspan="4"><label>Total</label></th>
													<th style="text-align:right;"><?php echo round($r_sum['sum_taxable'], 2);?></th>
													<?php if($auth_statecode==24){ ?>
													<th style="text-align:right;"><?php echo round($r_sum['sum_cgstamt'], 2);?></th>
													<th style="text-align:right;"><?php echo round($r_sum['sum_sgstamt'], 2);?></th>
													<?php } else{ ?>
													<th style="text-align:right;"><?php echo round($r_sum['sum_igstamt'], 2);?></th>
													<?php } ?>
													<th style="text-align:right;"><?php echo round($r_sum['sum_netamt'], 2);?></th>
												</tr>
											</table>
										</div>
									</div>
								
								<hr>
								<div class="row">	
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Total GST In Word:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_gstinword" name="txt_gstinword" value="<?php echo ucfirst($totalgst_inword);?>">											
											</div>
										</div>
									</div>
								
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Total Bill In Word:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_billinword" name="txt_billinword" value="<?php echo ucfirst($billamt_inword);?>">											
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>
								<div class="row">	
									<div class="col-lg-3">
										<div class="form-group">
											<div class="radio col-sm-4" style="margin-top: -3px;">
												<label>
												<input type="radio" name="options" id="opt_cash" tabindex="20" value="cash" <?php if ($paymenttype == 'cash') {echo ' checked ';} ?> />Cash

												</label>
											</div>
											<div class="radio col-sm-4">
												<label>
												<input type="radio" name="options" id="opt_cheque" tabindex="21" value="cheque"  <?php if ($paymenttype == 'cheque') {echo ' checked ';} ?> />Cheque
												</label>
											</div>
											<div class="radio col-sm-4">
												<label>
													<input type="radio" name="options" id="opt_rtgs" tabindex="22" value="rtgs"  <?php if ($paymenttype == 'rtgs') {echo ' checked ';} ?> />RTGS

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
														<input type="text" class="form-control pull-right" id="dateofpay" name="dateofpay" value="<?php echo date('d/m/Y', strtotime($today_date));?>" tabindex="23">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label" id="lbl_chck" name="lbl_chck">Cheque No:</label>
											<div class="col-sm-8">
												<input type="text" class="form-control"name="txt_chck" id="txt_chck" value="<?php echo $checkno;?>" tabindex="24">											
											</div>
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label" id="lbl_info" name="lbl_info" >Bank Name:</label>
											<div class="col-sm-8">
												<input type="text" class="form-control"name="txt_info" id="txt_info" value="<?php echo $bank_name;?>" tabindex="25">											
											</div>
										</div>
									</div>
								</div>
								<div class="row">	
									<div class="col-lg-12">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label" >Remarks:</label>
											<div class="col-sm-11">
												<textarea rows="3" style="width:100%;" name="txt_remark" tabindex="26" id="txt_remark"><?php echo $remarks;?></textarea>	
											</div>
										</div>
									</div>
								</div><br>
								<div class="row">	
									<div class="col-lg-12">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-1 control-label" >Bill Sr No:</label>
											<div class="col-sm-4">
												<?php
												$srno2manual=substr($serial_no1,4);
												$srno1manual=substr($serial_no1,0,3);
												?>
												<input type="text" class="form-control"name="txt_manualy" id="txt_manualy" value="<?php if(!empty($bill_sr_manualy)){ echo $bill_sr_manualy; } else{ echo $srno1manual."/BILL/".$srno2manual; }?>" >	
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="box-footer">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<div class="col-sm-1"></div>
											<div class="col-sm-2">
												
												<button type="submit" class="btn btn-info pull-right" tabindex="27" id="btn_update" name="btn_update" style="width:100px">Update</button>
												
											</div>
											<div class="col-sm-2">
												
									
												<a href="<?php echo $base_url; ?>view_bill.php" class="btn btn-info pull-right" tabindex="28" id="btn_cancel" name="btn_cancel" style="width:120px">Cancel</a>
												
											</div>
											<div class="col-sm-2">
													<a target = '_blank' href="<?php echo $base_url; ?>bill_print.php?sr_no=<?php echo $est_sr_no;?>&f_year=<?php echo $year;?>" style="width:100px" class="btn btn-info pull-right" id="btn_report" name="btn_report">Print Bill</a>
											</div>
											<div class="col-sm-2">
													<a target = '_blank' href="<?php echo $base_url; ?>bill_print_withoutgst.php?sr_no=<?php echo $est_sr_no;?>&f_year=<?php echo $year;?>"  class="btn btn-info pull-right" id="btn_report" name="btn_report">Print Bill Without GST</a>
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
		
		<div class="modal fade" id="modal-default-ref">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Reference</h4>
              </div>
				<form id="form_ref" name="form_ref" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Add Reference:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New Reference" id="txt_new_ref" name="txt_new_ref" class="form-control">											
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_ref" name="btn_add_ref" data-dismiss="modal">Add Reference</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
		
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
		
		<?php function numtowords($num){ 
$decones = array( 
            '01' => "One", 
            '02' => "Two", 
            '03' => "Three", 
            '04' => "Four", 
            '05' => "Five", 
            '06' => "Six", 
            '07' => "Seven", 
            '08' => "Eight", 
            '09' => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            );
$ones = array( 
            0 => " ",
            1 => "One",     
            2 => "Two", 
            3 => "Three", 
            4 => "Four", 
            5 => "Five", 
            6 => "Six", 
            7 => "Seven", 
            8 => "Eight", 
            9 => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            ); 
$tens = array( 
            0 => "",
            2 => "Twenty", 
            3 => "Thirty", 
            4 => "Forty", 
            5 => "Fifty", 
            6 => "Sixty", 
            7 => "Seventy", 
            8 => "Eighty", 
            9 => "Ninety" 
            ); 
$hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
            ); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
    if($i < 20){ 
        $rettxt .= $ones[$i]; 
    }
    elseif($i < 100){ 
        $rettxt .= $tens[substr($i,0,1)]; 
        $rettxt .= " ".$ones[substr($i,1,1)]; 
    }
    else{ 
        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        $rettxt .= " ".$tens[substr($i,1,1)]; 
        $rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
    } 

} 
$rettxt = $rettxt." Rupees";

if($decnum > 0){ 
    $rettxt .= " and "; 
    if($decnum < 20){ 
        $rettxt .= $decones[$decnum]; 
    }
    elseif($decnum < 100){ 
        $rettxt .= $tens[substr($decnum,0,1)]; 
        $rettxt .= " ".$ones[substr($decnum,1,1)]; 
    }
    $rettxt = $rettxt." Paise"; 
} 
return $rettxt;} 

?>

		
		
<?php include("footer.php");?>

<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js">
    $(".form_datetime").datetimepicker({
        format: "dd MM yyyy - hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: "2013-02-14 10:00",
        minuteStep: 10
    });
</script> 
<script> 
$(document).on('change', '#select_auth', function() {
				var select_auth = $('#select_auth').val(); 
				var postData = '&select_auth='+select_auth;

  $.ajax({
			url : "<?php echo $base_url; ?>getAuth.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  $("#txt_edit_auth").val(data.auth_name);
				
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

</script> 
<script>
 //Date picker
   $('#invoice_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  startDate: new Date(inv_start_date),
	  endDate: new Date(inv_end_date)
    })
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
    $('.select2').select2()
  })

</script>
<script>
$("#btn_add_city").click(function(){

 var txt_new_city = $('#txt_new_city').val(); 
 var postData = '&txt_new_city='+txt_new_city;


  $.ajax({
    url : "<?php echo $base_url; ?>Form_Data.php",
    type: "POST",
    data : postData,
    success: function(data,status,  xhr)
	 {

		$("#select_city").html(data);
	   
	 }

}); 

});

$("#btn_add_ref").click(function(){

  
 var txt_new_ref = $('#txt_new_ref').val(); 
 var postData = '&txt_new_ref='+txt_new_ref;
 
	  $.ajax({
		url : "<?php echo $base_url; ?>Ref_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			
			$("#select_ref").html(data);
		   
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
				url : "<?php echo $base_url; ?>editRate.php",
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
<script type="text/javascript">


</script>

<script>


$(document).ready(function(){
	
	
	
		$('#btn_edit_data').hide();
	   	$( "#txt_jobno" ).focus();
		
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
			 $('#txt_statecode').val(txt_state);
			 
    });
	
    $("#select_material").change(function(){
				var txt_new_material = $('#select_material').val(); 
				var gst_type = $('#gst_type').val();
				var txt_statecode = $('#txt_statecode').val();
				
			 var postData = '&txt_new_material='+txt_new_material+'&gst_type='+gst_type+'&txt_statecode='+txt_statecode;
		
			$.ajax({
				url : "<?php echo $base_url; ?>getRate.php",
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
					url : "<?php echo $base_url; ?>getFinalRate.php",
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
	
	$("#btn_saves").click(function(){
		
		var radios =$('input:radio[name="options"]').val();
		if(radios==null){
			 $("#options_val").val("blank");
			var radios = $('#options').val(); 
			alert(radios);
			 alert("Saved Bill Successfully");
		}
		 alert("Saved Bill Successfully");
		
	});	
	$("#btn_edit_data").click(function(){
		$('#btn_add_data').show();
		$('#btn_edit_data').hide();

	});

	
});

</script>
<script>

function getbills(){
	var est_sr_no = getQueryVariable("est_sr_no");
	
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=est_sr_no;
				var txt_statecode = $('#txt_statecode').val(); 
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>addData.php',
        data: 'action_type=view&'+$("#billing").serialize()+'&get_of_srno='+get_of_srno+'&txt_statecode='+txt_statecode,
        success:function(html){
            $('#display_data').html(html);
        }
    });
}

function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}

function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
				var txt_srno1 = $('#txt_srno1').val(); 
				var txt_srno2 = $('#txt_srno2').val(); 
				//var get_srno=txt_srno1+txt_srno2;
				var get_srno='<?php echo $_GET['est_sr_no'];?>';
				
				var txt_jno1 = $('#txt_jobno1').val(); 
				var txt_jno2 = $('#txt_jobno2').val(); 
				var txt_jobno=txt_jno1+txt_jno2;
				
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
				var txtarea_work = $('#editor1').val(); 
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
				
				
				if(txt_statecode==24){
							
				billData = '&action_type='+type+'&id='+id+'&get_srno='+get_srno+'&txt_jobno='+txt_jobno+'&invoice_date='+invoice_date+'&txt_ref='+txt_ref+'&ref_date='+ref_date+'&rec_date='+rec_date+'&txt_date='+txt_date+'&select_agency='+select_agency+'&select_auth='+select_auth+'&txtarea_work='+txtarea_work+'&select_city='+select_city+'&select_ref='+select_ref+'&txt_new_material='+txt_new_material+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_net='+txt_net+'&auth_address='+auth_address+'&txt_state='+txt_state+'&txt_statecode='+txt_statecode+'&txt_gstno='+txt_gstno+'&gst_type='+gst_type+'&branch_id='+branch_id+'&rdo_button_ag_or_auth='+rdo_button_ag_or_auth;
				
				}else{
					
				billData = '&action_type='+type+'&id='+id+'&get_srno='+get_srno+'&txt_jobno='+txt_jobno+'&invoice_date='+invoice_date+'&txt_ref='+txt_ref+'&ref_date='+ref_date+'&rec_date='+rec_date+'&txt_date='+txt_date+'&select_agency='+select_agency+'&select_auth='+select_auth+'&txtarea_work='+txtarea_work+'&select_city='+select_city+'&select_ref='+select_ref+'&txt_new_material='+txt_new_material+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_igst='+txt_igst+'&txt_net='+txt_net+'&auth_address='+auth_address+'&txt_state='+txt_state+'&txt_statecode='+txt_statecode+'&txt_gstno='+txt_gstno+'&gst_type='+gst_type+'&branch_id='+branch_id+'&rdo_button_ag_or_auth='+rdo_button_ag_or_auth;
				}
				
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
		
				billData = $("#billing").find('.form').serialize()+'&action_type='+type+'&txt_new_material_edit='+txt_new_material_edit+'&txt_qty_edit='+txt_qty_edit+'&txt_rate_edit='+txt_rate_edit+'&txt_rate_edit='+txt_rate_edit+'&txt_cgst_edit='+txt_cgst_edit+'&txt_sgst_edit='+txt_sgst_edit+'&txt_net_edit='+txt_net_edit+'&get_srno_edit='+get_srno_edit+'&txt_id='+txt_id;
				
				}else{
					
				billData = $("#billing").find('.form').serialize()+'&action_type='+type+'&txt_new_material_edit='+txt_new_material_edit+'&txt_qty_edit='+txt_qty_edit+'&txt_rate_edit='+txt_rate_edit+'&txt_rate_edit='+txt_rate_edit+'&txt_igst_edit='+txt_igst_edit+'&txt_net_edit='+txt_net_edit+'&get_srno_edit='+get_srno_edit+'&txt_id='+txt_id;
					
				}
				
    }else{
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
	
        billData = 'action_type='+type+'&id='+id+'&get_of_srno='+get_of_srno;
    }
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>addData.php',
        data: billData,
        success:function(msg){
         
            getbills();
			$('#btn_edit_data').hide();
			
        }
    });
}


function editData(id){
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
				var txt_statecode = $('#txt_statecode').val();
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: '<?php echo $base_url; ?>addData.php',
        data: 'action_type=data&id='+id+'&get_of_srno='+get_of_srno+'&txt_statecode='+txt_statecode,
        success:function(data){
            $('#idEdit').val(data.data_id);
            $('#select_material').val(data.material);
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
