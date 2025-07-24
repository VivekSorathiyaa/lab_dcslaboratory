<?php include("header.php");?>
<?php include("sidebar.php");
include("connection.php");

/* if($_SESSION['isadmin']=="2")
{
	?>
	<script >
		window.location.href="<?php $base_url; ?>home.php";
	</script>
	<?php
	
} */

	/*$delet_query="DELETE FROM billmaster WHERE `bill_isinsert`='0'";
	$qrys_delete = mysqli_query($conn,$delet_query);*/


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

		$query="SELECT * FROM fyearmaster WHERE `fy_status`='1'";
		$qrys = mysqli_query($conn,$query);
		$no_of_rows=mysqli_num_rows($qrys);
		if($no_of_rows>0){
								
			$r = mysqli_fetch_array($qrys);
			$year=$r['fy_name'];
			$srno=substr($year,2);
			$tec="TEC/";
		}
		
		if(isset($_POST['btn_add_city']))
		{
			 $insert = "insert into city(`city_name`,`city_status`,`city_isdeleted`) values('$_POST[txt_new_city]','1','1')"; 
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
				
				$txtarea = $_POST['editor1'];
				$txtarea_work = nl2br(htmlentities($txtarea, ENT_QUOTES, 'UTF-8'));
				
				 
				$agency_name= $_POST['select_agency'];
				$job_no_merge= $_POST["txt_jobno1"].$_POST["txt_jobno2"];
					$state_explode= explode("|",$_POST['txt_state']);
				 $update="update job_invert SET `fy_id`='$fyear',`job_no`='$job_no_merge',`agency_id`='$_POST[select_agency]',`agency_name`='$agency_name',`auth_name`='$_POST[select_auth]',`auth_address`='$_POST[auth_address]',`auth_state`='$state_explode[0]',`auth_statecode`='$_POST[txt_statecode]',`auth_gstno`='$_POST[txt_gstno]',`ref_date`='$new_ref_date',`rec_date`='$new_rec_date',`inv_date`='$new_inv_date',`today_date`='$new_today_date',`bt_modifiedby`='$_SESSION[name]',`bt_modifieddate`='$curr_date',`bill_sr_manualy`='$_POST[txt_manualy]',`ag_or_auth_status`='$_POST[rdo_button_ag_or_auth]',`name_of_work`='$txtarea_work',`ref_id`='$_POST[select_ref]',`city_id`='$_POST[select_city]',`ref_name`='$_POST[txt_ref]' WHERE `est_sr_no`='$_GET[est_sr_no]'"; 
				
				
				mysqli_query($conn,$update);
				
				
				?>
					<script>alert("Invert Updated Successfully");</script>
					<script>window.location.href="<?php echo $base_url; ?>view_job_invert.php";</script>
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
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Edit Job Invert
			</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Edit Esstimate Billing Form</h3>
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
											<label for="inputEmail3" class="col-sm-2 control-label">SR. No. :	</label>
											
											<div class="col-sm-2">
												<input type="text" class="form-control" value="<?php echo $srno1;?>" id="txt_srno1" name="txt_srno1" >
											</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" id="txt_srno2" name="txt_srno2" value="<?php echo $srno2;?>">
											</div>
											<label for="inputEmail3" class="col-sm-1 control-label">Sample  No.:</label>
											<?php $job_explode= explode("-",$job_no)?>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="txt_jobno1" name="txt_jobno1" value="<?php echo $job_explode[0]."-";?>">
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
														<input type="text" class="form-control pull-right" id="invoice_date" name="invoice_date" value="<?php echo date('d/m/Y', strtotime($inv_date));?>" tabindex="1">
												</div>
											</div>
											<label for="inputEmail3" class="col-sm-2 control-label" >Ref Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
														<input type="text" class="form-control pull-right" tabindex="2" id="ref_date" name="ref_date" value="<?php echo date('d/m/Y', strtotime($ref_date));?>">
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
											<input type="text" class="form-control" id="txt_ref" tabindex="3" name="txt_ref" value="<?php echo $ref_name;?>">
										  </div>
										 
										</div>
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Rec Date:</label>
										  <div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="rec_date" tabindex="4" name="rec_date" value="<?php echo date('d/m/Y', strtotime($rec_date));?>">
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
										<select class="form-control select2 col-sm-10" tabindex="6" style="width:250px" data-placeholder="Select a Agency" id="select_agency" name="select_agency">
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
									<div class="col-md-4">
										<label for="inputEmail3" class="col-sm-2 control-label">Autority:</label>
										<select class="form-control select2 col-sm-10" tabindex="7" style="width:250px" data-placehold="Select a Autority" id="select_auth" name="select_auth">
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
									<!--<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Edit Authority:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control col-sm-12" id="txt_edit_auth" tabindex="8" name="txt_edit_auth" value="<?php //echo $auth_name;?>">
									</div>-->
								</div>
								<br>
								<div class="row">
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">City:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control select2 col-sm-12" data-placeholder="Select a City" id="select_city" name="select_city" tabindex="9">
										<option>Select..</option>
										<?php 
												$sql = "select * from city ";
												
												$result_city = mysqli_query($conn, $sql);

													while($row = mysqli_fetch_assoc($result_city)) {
												
												?>
												<option value="<?php echo $row['id']; ?>"
											<?php if($row['city_name']==$city_name) echo 'selected="selected"'; ?>
											>
												<?php echo $row['city_name']; ?></option>
											<?php
											
											}?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="+" class="col-sm-12 btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Reference Id:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control select2 col-sm-10"data-placeholder="Select a Reference" id="select_ref" tabindex="10" name="select_ref">
												
												<option>Select..</option>
												<?php 
												
												/* $select_ref1 = "select * from reference WHERE `id`='$ref_id'";
												$result_ref1 = mysqli_query($conn, $select_ref1);
									

									
													$row_ref1 = mysqli_fetch_assoc($result_ref1);
													$r_name= $row_ref1['ref_name']; */
												
			
												
													$ref_query = "select * from reference ";
												
													$result_ref = mysqli_query($conn, $ref_query);

														while($row_ref = mysqli_fetch_assoc($result_ref)) {
													
													?>
													<option value="<?php echo $row_ref['ref_name']; ?>"
												<?php if($row_ref['ref_name']==$ref_id) echo 'selected="selected"'; ?>>
													<?php echo $row_ref['ref_name']; ?></option>
												<?php
												
												}?>
											</select>
												
									</div>
									<div class="col-md-1">
										<input type="submit" value="+" class="col-sm-12 btn btn-info pull-right" data-toggle="modal" data-target="#modal-default-ref">										
									</div>
									<div class="col-md-4">
									<label for="inputEmail3" class="col-sm-3 control-label">Auth Address:</label>
									<textarea id="auth_address"  name="auth_address" style="width:295px;" tabindex="11">
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
									
									    
										<select class="form-control select2 col-sm-8" data-placeholder="Select a State" style="width:250px;" tabindex="12" id="txt_state" name="txt_state" required>
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
									<div class="col-md-1">
										<label for="inputEmail3" class="col-sm-1 control-label">State Code:</label>
									</div>
									<div class="col-md-3">	
										<input type="hidden" class="form-control inputs" tabindex="13" id="txt_statecode" name="txt_statecode" required value="<?php echo $auth_statecode;?>" >
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
										<textarea id="editor1" name="editor1" tabindex="15">
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
								
							
							</div>
							
							<div class="box-footer">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
									
											<div class="col-sm-12">
												<div class="col-xs-1"></div>
											
												
												
												<div class="col-xs-2">
												<button type="submit" class="btn btn-info pull-right" id="btn_update" tabindex="19" name="btn_update" style="width:120px">Update</button>
												</div>


												<div class="col-xs-2">
											
													<a href="<?php echo $base_url; ?>view_est_bill.php" class="btn btn-info pull-right" tabindex="23" id="btn_cancel" name="btn_cancel" style="width:120px">Cancel</a>
													
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

</script> 
<script>
 //Date picker
    $('#invoice_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
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


</script>
<script type="text/javascript">


</script>

<script>
$(document).ready(function(){
	
	//load data on load
	//getbills();
	
	// Inv Date change event start
	
		
	
	
	$('#invoice_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
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
	
	
	
	// Inv Date change event stop

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
	
    
	
	
	
	
		
	$("#btn_edit_data").click(function(){
		$('#btn_add_data').show();
		$('#btn_edit_data').hide();

	});	
});

</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5();
  })
</script>
