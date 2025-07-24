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
	 $get_rate_type="";
	 $get_gst_type="";
	 $get_c_gst_amt="";
	 $get_s_gst_amt="";
	 $get_i_gst_amt="";
	 $get_grand_total="";
	 $get_total_amount="";
	 $get_total_amt_in_word="";
	 $hsn_codes="";
	 $estimate_perfoma_no= "";
	 
	  $is_estimate_avail="not_available";
	  
	  $gst_in_or_ex="";
 
 
	
		 
		 $sel_estiamte_for_perfoma_no="select * from quotations WHERE `est_isdeleted`=0 ORDER BY quotations_id DESC";
		 $query_estiamte_for_perfoma_no = mysqli_query($conn, $sel_estiamte_for_perfoma_no);
		 
		 if (mysqli_num_rows($query_estiamte_for_perfoma_no) > 0) 
		 {
			$result_estiamte_for_perfoma_no = mysqli_fetch_assoc($query_estiamte_for_perfoma_no);
			$explode_perfoma_no= explode("/",$result_estiamte_for_perfoma_no["quatation_no"]);
	
			$fourth_explode=$explode_perfoma_no[3];
			$l_trim_fourth_explode= ltrim($fourth_explode,"0");
			$plus_of_perfoma= intval($l_trim_fourth_explode)+1;
			$final_perfoma_no= sprintf('%04d', $plus_of_perfoma);
			
			$set_perfoma_no= $qt_first_parts.$final_perfoma_no;
		}
		else
		{
			$sel_year="select * from fyearmaster where `fy_isactive`=0";
			$query_year = mysqli_query($conn, $sel_year);
			$result_year = mysqli_fetch_array($query_year);
			$year_name=$result_year["fy_name"];
			$today_date=date("Ymd");
			
			$set_perfoma_no= $qt_first_parts."0001";
		}
		

	
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}

/* only for 3d button effects */

.btn3d {
    transition:all .08s linear;
    position:relative;
    outline:medium none;
    -moz-outline-style:none;
    border:0px;
    margin-right:10px;
    margin-top:15px;
}
.btn3d:focus {
    outline:medium none;
    -moz-outline-style:none;
}
.btn3d:active {
    top:9px;
}
.btn-primary {
    box-shadow:0 0 0 1px #428bca inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#428bca;
}
.btn-success {
    box-shadow:0 0 0 1px #5cb85c inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #4cae4c, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#5cb85c;
}
 .btn-info {
    box-shadow:0 0 0 1px #5bc0de inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #46b8da, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#5bc0de;
}
.form-control { 
font-size: 20px;
height: 50px;
}



</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
 
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
				<h1 style="text-align:center;">
					Make Quotation
				</h1>
			</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove black;">
							<br>
								<div class="row">
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Agency:</label>
									</div>
									
									<div class="col-sm-7">
									<label for="inputEmail3" class="col-sm-12 control-label">Agency Address.</label>
									</div>
									
									<div class="col-sm-2">
									<label for="inputEmail3" class="col-sm-12 control-label">Mobile No.</label>
									</div>
									
									
								</div>
								<div class="row">
									
										  <div class="col-sm-2">
											<select class="form-control  select2 col-sm-12" data-placeholder="Select Agency" tabindex="9"  id="select_agency" name="select_agency" required >
														<option value="">Select Agency</option>
														<?php 
															$cat_sql = "select * from agency_master where `isdeleted`=0";
														
															$cat_result = mysqli_query($conn, $cat_sql);

																while($cat_row = mysqli_fetch_assoc($cat_result)) {
															
															?>
															<option value="<?php echo $cat_row['agency_id']; ?>">
															<?php echo $cat_row['agency_name']; ?></option>
															<?php  }?>
											 </select>
										  </div>
										 <!-- <div class="col-sm-1">
														<input type="button" value="+" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-agency">
														
										</div>-->
										
										  
											<div class="col-sm-7">
												
													<input type="text" class="form-control" value="" id="adress" name="adress" disabled>
											</div>
										
										  
											<div class="col-sm-2">
												
													<input type="text" class="form-control" value="" id="mobile" name="mobile" disabled>
											</div>
											
											
									
								</div>
								<br>
								<div class="row">
								
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label"> Pincode:</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-12 control-label">Email:</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-12 control-label">GST NO:</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-12 control-label">Quotation Date:</label>
									</div>
									
									
									
								</div>
								
								<div class="row">
								
											<div class="col-md-3">
													<input type="text" class="form-control" value="" id="pincode" name="pincode" disabled>
													
											
											</div>
											
											<div class="col-md-3">
												<input type="text"  class="form-control" name="email" id="email" disabled>
										  </div>
										  
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="gst_no" id="gst_no" disabled>
										  </div>
									
										  <div class="col-md-3">
											<div class="form-group">
												
												<div class="col-sm-12">
													<input type="text"  class="form-control" name="invoice_date" id="invoice_date" value="<?php echo date('d/m/Y')?>">
												</div>
											</div>
										  </div>
										  
										  
										  
								</div>
								<br>
								<div class="row">
									
									<div class="col-sm-1">
									<label for="inputEmail3" class="col-sm-12 control-label">Quotation No:</label>
									</div>
									
									<div class="col-md-3">
												<input type="text"  class="form-control" name="perfoma_no" id="perfoma_no" value="<?php echo $set_perfoma_no;?>" disabled>
												
									</div>
									
									<div class="col-sm-2">
									<label for="inputEmail3" class="col-sm-12 control-label">Name Of Work:</label>
									</div>
									
									<div class="col-sm-4">
									<textarea name="name_of_work" id="name_of_work" class="form-control"></textarea>
									</div>
									
									
									
								</div>
								
								<br>
								
							
							<div id="bill_part_show" style="">							
							<div class="panel-group">
							<div class="box box-info">
							<div class="row"><div class="col-md-3">&nbsp;</div></div>
							<div class="row">
							 <div class="col-md-3">
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
			
													<option value="<?php echo $row['material_cat_id']."|".$row['material_cat_name'];?>"><?php echo $row['material_cat_name'];?></option>
													<?php }}?>
												</select>
											</div>
										</div>
							 </div>
							 <div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
											<select class="form-control select2" name="select_material" id="select_material">
													<option value="">Select Material</option>
													
												</select>
												<!--<a href="javascript:void(0)" id="get_more" class=" btn btn-primary"><i class="fa fa-undo" aria-hidden="true"></i></a>-->
												<input type="hidden" value="20" id="get_more_count">
											</div>
										</div>
							 </div>
							 <div class="col-md-3">
										<div class="form-group">
											<div class="col-sm-12">
												<select class="form-control" name="select_test" id="select_test">
												<option value="">Select Test</option>	
												</select>
											</div>
										</div>
							</div>
							<div class="col-md-1">
										<div class="form-group">
											<div class="col-sm-3">
												<a href="JavaScript:void(0)" class="add_button btn btn-primary" title="Add field" style=""><b>Add Test</b></a>
											</div>
										</div>
							</div>
							
							<div class="col-md-2">
										<div class="form-group">
											<div class="col-sm-3">
												<a href="JavaScript:void(0)" class="addButton_extra btn btn-primary" title="Add field" style=""><b>Add Extra</b></a>
											</div>
										</div>
							</div>
							 </div>
							 </div>
							 </br>
								<div class="box box-info">
									<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<table class="table no-margin class_tr_put" >
										  <thead>
										  <tr>
											<th>Material Name</th>
											<th>Test Name</th>
											<th>Qty</th>
											<th>Rate</th>
											<th>Discount(%)</th>
											<th>Amount</th>
											<th>Action</th>
											
										  </tr>
										  </thead>
										  <tbody>
										  </tbody>
										</table>
									  </div>
									</div>
								</div>
							</div>
					</div>
					<br>
					<div class="row">
									<div class="col-sm-2"><label for="inputEmail3" class="control-label">&nbsp;</label></div>
									<div class="col-sm-1">
									<input type="hidden" name="txt_discount_percent" class="form-control" id="txt_discount_percent" value="0">
									</div>
									<div class="col-sm-2"><label for="inputEmail3" class="control-label">&nbsp;</label></div>
									<div class="col-sm-2">
									<input type="hidden" name="txt_discount_amount" class="form-control" id="txt_discount_amount" value="0">
									</div>
								</div>
						<br>
							<div class="box box-info">
							<input type="hidden" name="hidden_gst_type" id="hidden_gst_type" value="without_gst"> 
							<input type="hidden" name="hidden_gst_in_ex" id="hidden_gst_in_ex" value=""> 
								<div class="row">
									<div class="col-sm-2">
									<label for="inputEmail3" class="control-label">GST TYPE:</label>
									</div>
									
									<div class="col-sm-9">
										<input type="radio" style="width:33px;height:25px;" name="gst_type" value="with_gst" <?php if($get_gst_type=="with_gst"){ echo "checked";} ?>><span style="font-size:20px;" ><b>With GST</b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="without_gst" <?php if($get_gst_type=="" || $get_gst_type=="without_gst"){ echo "checked";} ?>><span style="font-size:20px;"><b>Without GST<b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="with_igst" <?php if($get_gst_type!="" && $get_gst_type=="with_igst"){ echo "checked";} ?>><span style="font-size:20px;"><b>With IGST<b></span>
									</div>
								</div>
								<br>
								<div class="row" id="gst_hide_show" style="<?php if($get_gst_type=="" || $get_gst_type=="without_gst"){ echo "display:none";}else{ echo "display:block";} ?>">
								
									<div class="row">
										<div class="col-sm-2">
										<label for="inputEmail3" class="control-label">&nbsp;</label>
										</div>
										<div class="col-sm-9">
											<input type="radio" style="width:33px;height:25px;" name="in_or_ex" value="include" <?php if($gst_in_or_ex=="include"){ echo "checked";} ?>><span style="font-size:20px;" ><b>Include</b></span>
											<input type="radio" style="width:33px;height:25px;"name="in_or_ex" value="exclude" <?php if($gst_in_or_ex=="exclude"){ echo "checked";} ?>><span style="font-size:20px;"><b>Exclude<b></span>
										</div>
									</div>
									<br>
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">CGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_cgst" class="form-control" id="txt_cgst" value="<?php echo $get_c_gst_amt;?>" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="col-sm-12 control-label">SGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_sgst" class="form-control" id="txt_sgst" value="<?php echo $get_s_gst_amt;?>" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="col-sm-12 control-label">IGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_igst" class="form-control" id="txt_igst" value="<?php echo $get_i_gst_amt;?>" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="col-sm-12 control-label">GRAND TOTAL:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_grand" class="form-control" id="txt_grand" value="<?php echo $get_grand_total;?>" >
									</div>
								</div>
								
							</div>
							<div class="box box-info">
							<br>
								<div class="row">
									<div class="col-md-3">
									<label for="inputEmail3" class="col-sm-12 control-label">Total Amount In Word:</label>
									</div>
									
									<div class="col-md-4">
									<input type="text" name="txt_amt_in_word" class="form-control" id="txt_amt_in_word" value="<?php if($get_total_amt_in_word !=""){ echo $get_total_amt_in_word;}else{ echo numtowords($get_total_amt);} ?>" >
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="col-sm-12 control-label">Total Amount:</label>
									</div>
									
									<div class="col-md-3">
									<input type="text" name="total_amt" class="form-control" id="total_amt" value="<?php if($get_total_amount !=""){ echo $get_total_amount;}else{ echo $get_total_amt;} ?>" >
									</div>
								</div>
								<br>
							<input type="hidden" name="hidden_agency" id="hidden_agency" value="<?php echo $get_agency_id;?>">
								<div class="row" id="submit_button_only_for_bill" style="">
									<div class="col-md-3">&nbsp;</div>
									<div class="col-md-6">
									
									 <button type="button" class="btn btn-info"  onclick="addData('save_next_estimate_only_save')" name="btn_add_data" id="btn_add_data" style="width:150px;font-size:20px;" >Save</button>
									</div>
									<div class="col-md-3">&nbsp;</div>
									
								</div>
								
								
							</div>
							
							
							
							</div>
						
					</div>
				</div>
</section>	
</div>
  
<div class="modal fade" id="modal-agency">
          <div class="modal-dialog" style="width:80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Agency/Contractor/Customer</h4>
              </div>
				<form id="form_agency" name="form_agency" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<div class="col-md-6">													
											<input type="text" class="form-control" PlaceHolder="Enter Agency/Contractor/Customer Name." name="agency_name" id="add_agency_name" required >
										</div>
										
										<div class="col-md-6">												
											<input type="text" class="form-control"  PlaceHolder="Enter Agency/Contractor/Customer Mobile No." name="add_agency_mobile" id="add_agency_mobile" required >
										</div>
									</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<textarea name="add_agency_address" placeholder="Enter Agency/Contractor/Customer Address." id="add_agency_address" class="col-sm-12 form-control"required ></textarea>
												</div>
												
												<div class="col-md-6">												
													<select class="form-control col-sm-12" placeholder="Select City" tabindex="6"   id="add_sel_agency_city" name="sel_agency_city" required >
													<option value="">Select City</option>
													<?php 
													$sql = "select * from city";
												
													$result = mysqli_query($conn, $sql);

														while($row = mysqli_fetch_assoc($result)) {
													
													?>
													<option value="<?php echo $row['id']; ?>">
													<?php echo $row['city_name']; ?></option>
													<?php  }?>
													</select>
										
												</div>
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">												
													<input type="text" class="form-control" placeholder="Enter Agency/Contractor/Customer Pincode" name="add_agency_pincode" id="add_agency_pincode" required >
												</div>
												
												<div class="col-md-6">													
													<input type="text" class="form-control" placeholder="Enter Agency/Contractor/Customer EmailId" name="add_agency_email" id="add_agency_email" required >
												</div>
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<input type="text" class="form-control" placeholder="Enter Agency/Contractor/Customer GST No." name="add_agency_gstno" id="add_agency_gstno" required >
												</div>
									
												<div class="col-md-6">													
													<select class="form-control col-md-7 col-xs-12" name="add_agency_status" id="add_agency_status">
														<option  value="0">Activate</option>
														<option value="1">Deactivate</option>
													<select>			
												</div>
									
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<select class="form-control col-md-7 col-xs-12" name="add_perfoma_make_by" id="add_perfoma_make_by">
														<option  value="0" selected>By Test</option>
														<option value="1">By Material</option>
													<select>			
												</div>
												
												<div class="col-md-6">													
													<select class="form-control col-md-7 col-xs-12" name="add_rate" id="add_rate">
														<option  value="0">Government</option>
														<option value="1" selected >Private</option>
													<select>			
												</div>
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<input type="text" class="form-control" placeholder="Adhar Card Number" name="aadhar_no" id="aadhar_no" required >			
												</div>
												
												<div class="col-md-6">
												<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="upload_adhar" name="upload_adhar">
												</div>
												</div>
												<br>
												<div class="row">
												<div class="row">
												<div class="col-md-12">
												<label>ENTER CITY IF NOT AVAILABLE</label>											
												</div>
												</div>
												<div class="col-md-6">	
													<label>SELECT STATE</label>
													<select name="sel_state" id="sel_state" class="form-control">
													<option value="">Select State</option>
													<?php
													$get_state="SELECT * FROM state where `is_deleted`=0 ORDER BY state_id DESC";
													$get_state_res = mysqli_query($conn, $get_state);
													if (mysqli_num_rows($get_state_res) > 0) 
													{
														while($r = mysqli_fetch_array($get_state_res))
														{?>
															<option value="<?php echo $r["state_id"]?>"><?php echo $r['state_name'];?></option>
													<?php 
														} 
													}
													?>
													</select>
												</div>
												<div class="col-md-6">	
													<label>ENTER CITY</label>
													<input type="text" class="form-control" placeholder="Enter City Name." name="txt_city_name" id="txt_city_name">
												</div>
									
												
												</div>
												
								
											</div>
					</div>
					<div class="modal-footer">	
					
						<button type="button" class="btn btn-primary" id="btn_add_agency" name="btn_add_agency" data-dismiss="modal">Add Agency/Contractor/Customer</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>	
<?php include("footer.php");?>

<?php
function numtowords($num){
	$number = $num;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
 // return $result . "Rupees  " . $points;
  return $result . "Rupees  ";
}
?>		  	  
<script>

 $(function () {
    $('.select2').select2();
  });
$(document).ready(function(){
	$('#invoice_date').datepicker({
		  autoclose: true,
		  format: 'dd/mm/yyyy',
		  endDate: '-1d'
	});
	
	var maxField = 50; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.class_tr_put'); //Input field wrapper
    
	var count_of_append= 1;
    var x = 1; //Initial field counter is 1kkkkkkkkkkkk
	
	
	
	$(document).on( "click",".add_button",function(e)
    {
		count_of_append++;
		
		var select_material_category= $("#select_material_category").val();
	    var select_material= $("#select_material").val();
	    var select_test= $("#select_test").val();
		
		if(select_material_category=="")
		{
			alert("Select Category First...");
			return false;
		}
		if(select_material=="")
		{
			alert("Select Maerial First...");
			return false;
		}
		if(select_test=="")
		{
			alert("Select Test First...");
			return false;
		}
	
		var res_cates_id = select_material_category.split("|");
		var mat_cat_id=res_cates_id[0];
		var mat_cat_names=res_cates_id[1];
		
		var res_cates = select_material.split("|");
		var mat_id=res_cates[0];
		var mat_names=res_cates[1];
		
		var res_test = select_test.split("|");
		var test_id=res_test[0];
		var test_names=res_test[1];
		
		
		
		var postData = 'action_type=get_rates_by_test_id&p&select_material='+select_material+'&select_test='+select_test+'&mat_cat_id='+mat_cat_id;
		
		$.ajax({
				url : "<?php $base_url; ?>save_span_add_new_perfoma.php",
				type: "POST",
				data : postData,
				dataType:'JSON',
				success: function(data)
				 {
					var fieldHTML = '<tr>';
					fieldHTML += '<td>';
					fieldHTML += '<input type="hidden" name="mt_id[]" class="class_mate_id" id="mateid_'+count_of_append+'" value="'+mat_cat_id+'">';
					fieldHTML += '<input type="text" name="mat_name[]" class="form-control class_mate_name" id="matename_'+count_of_append+'" value="'+mat_cat_names+'" style="width:200px;font-weight:bold;">';
					fieldHTML += '</td>';
					
					//fieldHTML += '<tr>';
					
					fieldHTML += '<td>';
					fieldHTML += '<input type="hidden" name="test_id[]" class="class_test_id" id="testid_'+count_of_append+'" value="'+test_id+'">';
					fieldHTML += '<input type="text" name="test_name[]" class="form-control class_test" id="test_'+count_of_append+'" value="'+test_names+'" >';
					fieldHTML += '</td>';
					
					fieldHTML += '<td>';
					fieldHTML += '<input type="text" name="qty[]" class="form-control class_qty" id="qty_'+count_of_append+'" value="1">';
					fieldHTML += '</td>';
					
					fieldHTML += '<td>';
					fieldHTML += '<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_'+count_of_append+'" value="'+data.testings+'">';
					fieldHTML += '</td>';
					
					fieldHTML += '<td>';
					fieldHTML += '<input type="text" name="txtdiscount[]" class="form-control txt_discount_class" id="discount_'+count_of_append+'" value="0">';
					fieldHTML += '</td>';
					
					fieldHTML += '<td>';
					fieldHTML += '<input type="text" name="amt[]" class="form-control class_amnt" id="amt_'+count_of_append+'" value="'+data.testings+'" disabled>';
					fieldHTML += '</td>';
					
					fieldHTML += '<td>';
					fieldHTML += '<a href="JavaScript:void(0)" class="remove_button btn btn-primary" title="Remove field" style=""><b>X</b></a>';
					fieldHTML += '</td>';
					
					fieldHTML += '</tr>'; 
					
					if(x < maxField){ 
						x++; //Increment field counter
						$('.class_tr_put').append(fieldHTML); //Add field html
					}
				 }
			});
		
		//Check maximum number of input fields
        
		after_changes_on();
	});
	
	//Once remove button is clicked
    $(document).on('click', '.remove_button', function(e)
	{
		
        $(this).closest("tr").remove(); //Remove field html
        x--; //Decrement field counter
		
		var totals_amt_sum=0;
		$('input[name=in_or_ex]').prop("checked", false);
		$('input[name=gst_type]').prop("checked", false);
		$('#hidden_gst_in_ex').val("");
		$('#hidden_gst_type').val("");
		after_changes_on();
	});
	
	
	
	var maxField_extra = 50; //Input fields increment limitation
    var addButton_extra = $('.addButton_extra'); //Add button selector
    
	var count_of_append_extra=400 ;
    var x_extra = 1; //Initial field counter is 1kkkkkkkkkkkk
	
	
	$(document).on( "click",".addButton_extra",function(e)
    {
		count_of_append_extra++;
		
		
		var fieldHTML = '<tr>';
		fieldHTML += '<td>';
		fieldHTML += '<input type="hidden" name="mt_id[]" class="class_mate_id" id="mateid_'+count_of_append_extra+'" value="0">';
		fieldHTML += '<input type="text" name="mat_name[]" class="form-control class_mate_name" id="matename_'+count_of_append_extra+'" value="" style="width:200px;font-weight:bold;">';
		fieldHTML += '</td>';
		
		//fieldHTML += '<tr>';
		
		fieldHTML += '<td>';
		fieldHTML += '<input type="hidden" name="test_id[]" class="class_test_id" id="testid_'+count_of_append_extra+'" value="0">';
		fieldHTML += '<input type="text" name="test_name[]" class="form-control class_test" id="test_'+count_of_append_extra+'" value="" >';
		fieldHTML += '</td>';
		
		fieldHTML += '<td>';
		fieldHTML += '<input type="text" name="qty[]" class="form-control class_qty" id="qty_'+count_of_append_extra+'" value="1">';
		fieldHTML += '</td>';
		
		fieldHTML += '<td>';
		fieldHTML += '<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_'+count_of_append_extra+'" value="0">';
		fieldHTML += '</td>';
		
		fieldHTML += '<td>';
		fieldHTML += '<input type="text" name="txtdiscount[]" class="form-control txt_discount_class" id="discount_'+count_of_append_extra+'" value="0">';
		fieldHTML += '</td>';
		
		fieldHTML += '<td>';
		fieldHTML += '<input type="text" name="amt[]" class="form-control class_amnt" id="amt_'+count_of_append_extra+'" value="0" disabled>';
		fieldHTML += '</td>';
		
		fieldHTML += '<td>';
		fieldHTML += '<a href="JavaScript:void(0)" class="remove_button_extra btn btn-primary" title="Remove field" style=""><b>X</b></a>';
		fieldHTML += '</td>';
		
		fieldHTML += '</tr>';
		
		
		
		//Check maximum number of input fields
        if(x_extra < maxField_extra){ 
            x_extra++; //Increment field counter
            $('.class_tr_put').append(fieldHTML); //Add field html
        }
		after_changes_on();
	});
	
	
	
	$(document).on('click', '.remove_button_extra', function(e)
	{
		
        $(this).closest("tr").remove(); //Remove field html
        x_extra--; //Decrement field counter
		
		var totals_amt_sum=0;
		$('input[name=in_or_ex]').prop("checked", false);
		$('input[name=gst_type]').prop("checked", false);
		$('#hidden_gst_in_ex').val("");
		$('#hidden_gst_type').val("");
		after_changes_on();
	});

});


$("#btn_add_agency").click(function(){
 var agency_name = $('#add_agency_name').val(); 
 let str = $('#add_agency_name').val();
let newStr = str.replace(/'/g,'zxctxavb');
let newStr1 = newStr.replace(/&/g,'qwerfdsa');
var agency_mobile = $('#add_agency_mobile').val(); 
 var agency_address = $('#add_agency_address').val(); 
 var sel_agency_city = $('#add_sel_agency_city').val(); 
 var agency_pincode = $('#add_agency_pincode').val(); 
 var agency_email = $('#add_agency_email').val(); 
 var agency_gstno = $('#add_agency_gstno').val(); 
 var agency_status = $('#add_agency_status').val(); 
 var add_perfoma_make_by = $('#add_perfoma_make_by').val(); 
 var add_rate = $('#add_rate').val(); 
 var sel_state = $('#sel_state').val();
 var txt_city_name = $('#txt_city_name').val();

if(agency_name == ""){
	alert("Enter Name...");
	return false;
	} 
if(agency_mobile == ""){
	alert("Enter Mobile No...");
	return false;
	}
if(agency_mobile != "" && agency_mobile.length != 10){
	alert("Enter Mobile No Properly...");
	return false;
	}
if(agency_address == ""){
	alert("Enter Address...");
	return false;
	}

	
	var xyz = $('#upload_adhar').val();
	if(xyz ==""){
		//alert("Please Upload Adhar card");
	//return false;
	}
	
	/*var aadhar_no = $('#aadhar_no').val();
	if(aadhar_no ==""){
		alert("Please Enter Adhar card No");
	return false;
	}
	
	if(aadhar_no !="" && aadhar_no.length != 12){
		alert("Please Enter Adhar card No Propery");
	return false;
	}*/
 
	
	form_data = new FormData();
	form_data.append("agency_name", newStr1);
	form_data.append("agency_mobile", agency_mobile);
	form_data.append("agency_address", agency_address);
	form_data.append("sel_agency_city", sel_agency_city);
	form_data.append("agency_pincode", agency_pincode);
	form_data.append("agency_email", agency_email);
	form_data.append("agency_gstno", agency_gstno);
	form_data.append("agency_status", agency_status);
	form_data.append("txt_city_name", txt_city_name);
	form_data.append("sel_state", sel_state);
	form_data.append("add_perfoma_make_by", add_perfoma_make_by);
	form_data.append("add_rate", add_rate);
	form_data.append("aadhar_no", aadhar_no);
	form_data.append("file", document.getElementById('upload_adhar').files[0]);
	

 

	if(newStr1!="")
	{
	  $.ajax({
		url : "<?php $base_url; ?>agency_Data.php",
		type: "POST",
		dataType:'JSON',
		data : form_data,
		processData: false,
		contentType: false,
		success: function(data,status,  xhr)
		 {
		
			$("#select_agency").html(data);
		   $('#txt_new_agency').val("");
		   $( '#form_agency' ).each(function(){
				this.reset();
			});
		 }

	}); 
}else{
	alert("All Fields Are Required..");
	return false;
}
});


function get_table_after_update(id){
    id = (typeof id == "undefined")?'':id;
    var billData = '';
    
	billData = '&action_type=get_table_after_update&id='+id;			
   
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_add_new_perfoma.php',
        data: billData,
		dataType:'JSON',
        success:function(msg){
          //$('#display_data').html(msg.table_design);
          $('#txt_cgst').val(msg.cgst);
          $('#txt_sgst').val(msg.sgst);
          $('#txt_igst').val(msg.igst);
          $('#txt_grand').val(msg.grand_total);
          $('#txt_amt_in_word').val(msg.get_total_amt_in_word);
          $('#total_amt').val(Math.round(msg.net_total));
		  
        }
    });
}

// on rate change

$(document).on("blur",".txt_rate_class",function(){
	
      var get_rate = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_qty= $("#qty_"+split_data[1]).val();
	  var get_percent= $("#discount_"+split_data[1]).val();
	  var totals=parseFloat(get_rate)* parseFloat(get_qty);
	  
	  var discounts=parseFloat(totals)* parseFloat(get_percent) / 100;
	  var txt_amnts=parseFloat(totals)- parseFloat(discounts);
	  
	  $("#amt_"+split_data[1]).val(txt_amnts); 
	  $('input[name=in_or_ex]').prop("checked", false);
	  $('#hidden_gst_in_ex').val("");
	  after_changes_on();
});

// on qty change

$(document).on("blur",".class_qty",function(){
	
      var get_qty = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_rate= $("#rate_"+split_data[1]).val();
	  var get_percent= $("#discount_"+split_data[1]).val();
	  var totals=parseFloat(get_rate)* parseFloat(get_qty);
	  
	  var discounts=parseFloat(totals)* parseFloat(get_percent) / 100;
	  var txt_amnts=parseFloat(totals)- parseFloat(discounts);
	  
	  $("#amt_"+split_data[1]).val(txt_amnts);
	  $('input[name=in_or_ex]').prop("checked", false);
	  $('#hidden_gst_in_ex').val("");
	  after_changes_on();
});


// on discount change

$(document).on("blur",".txt_discount_class",function(){
	
      var get_percent = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_rate= $("#rate_"+split_data[1]).val();
	  var get_qty= $("#qty_"+split_data[1]).val();
	 var totals=parseFloat(get_rate)* parseFloat(get_qty);
	  
	  var discounts=parseFloat(totals)* parseFloat(get_percent) / 100;
	  var txt_amnts=parseFloat(totals)- parseFloat(discounts);
	  
	  $("#amt_"+split_data[1]).val(txt_amnts);
	  $('input[name=in_or_ex]').prop("checked", false);
	  $('#hidden_gst_in_ex').val("");
	  after_changes_on();
});

$("input[name='gst_type']").change(
    function(e)
    {
		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		$('input[name=in_or_ex]').prop("checked", false);
		var in_or_ex="";
		if(gst_type=="with_gst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_gst");
			$('#hidden_gst_in_ex').val("");
		}else if(gst_type=="with_igst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_igst");
			$('#hidden_gst_in_ex').val("");
		}else{
			$("#gst_hide_show").hide();
			$('#hidden_gst_type').val("without_gst");
			$('#hidden_gst_in_ex').val("");
		}
		var txt_trf_no="";
		var total_amounts=0;
		$(".class_amnt").each(function () {
			total_amounts += parseFloat($(this).val());
		});
					var txt_discount_amount=$("#txt_discount_amount").val();
					var total_grand_amnt=parseFloat(total_amounts) - parseFloat(txt_discount_amount);
					var txt_job_no="";
					var send= "0"+"|"+txt_trf_no+"|"+txt_job_no+"|"+gst_type+"|"+in_or_ex+"|"+total_grand_amnt;
					get_table_after_update(send);
		
});

$("input[name='perfoma_type']").change(
    function(e)
    {
		var perfoma_type=$( 'input[name=perfoma_type]:checked' ).val();
		$.confirm({
        title: "warning",
        content: "After You Click Confirm , You Cant Change In This, Are You Sure To Make "+perfoma_type+"?",
        buttons: {
			confirm: function () 
			{
		
				
				if(perfoma_type=="by_bill"){
					$("#bill_part_show").show();
					$("#submit_button_only_for_bill").show();
					$("#excel_part_show").hide();
					$("#submit_button_for_excel_upload").hide();
					$("#perfoma_radio_part").hide();
					$("#perfoma_type_text").show();
					$("#parfoma_type_caption").html('<b style="text-align:center;font-size:40px;">BY BILL</b>');
				}else{
					$("#bill_part_show").hide();
					$("#submit_button_only_for_bill").hide();
					$("#excel_part_show").show();
					$("#submit_button_for_excel_upload").show();
					$("#perfoma_radio_part").hide();
					$("#perfoma_type_text").show();
					$("#parfoma_type_caption").html('<b style="text-align:center;font-size:40px;">BY Excel</b>');
				}
			},
            cancel: function () {
				return;
            }
			}
			});
		
		
		
     });

$("input[name='in_or_ex']").change(
    function(e)
    {
		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		var in_or_ex=$( 'input[name=in_or_ex]:checked' ).val();
		var txt_trf_no=""
		var txt_job_no=""
		$('#hidden_gst_in_ex').val(in_or_ex);
		
		var total_amounts=0;
		$(".class_amnt").each(function () {
			total_amounts += parseFloat($(this).val());
		});
					var txt_discount_amount=$("#txt_discount_amount").val();
					var total_grand_amnt=parseFloat(total_amounts) - parseFloat(txt_discount_amount);
					var send= "0"+"|"+txt_trf_no+"|"+txt_job_no+"|"+gst_type+"|"+in_or_ex+"|"+total_grand_amnt;
					get_table_after_update(send);
		
});
// save estimate_date

function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'save_next_estimate_only_save') {
				var invoice_date = $('#invoice_date').val(); 
				var hidden_gst_type = $('#hidden_gst_type').val(); 
				var hidden_gst_in_ex = $('#hidden_gst_in_ex').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_igst = $('#txt_igst').val(); 
				var txt_grand = $('#txt_grand').val(); 
				var txt_amt_in_word = $('#txt_amt_in_word').val(); 
				var total_amt = $('#total_amt').val();
				var perfoma_no = $('#perfoma_no').val();
				
				var test_ids_array=[];
				$(".class_test_id").each(function () {
					test_ids_array.push($(this).val());
				});
				
				var test_name_array=[];
				$(".class_test").each(function () {
					test_name_array.push($(this).val());
				});
				
				var test_qty_array=[];
				$(".class_qty").each(function () {
					test_qty_array.push($(this).val());
				});
				
				var test_rates_array=[];
				$(".txt_rate_class").each(function () {
					test_rates_array.push($(this).val());
				});
				
				var test_amnt_array=[];
				$(".class_amnt").each(function () {
					test_amnt_array.push($(this).val());
				});
				
				var test_mate_array=[];
				$(".class_mate_name").each(function () {
					test_mate_array.push($(this).val());
				});
				
				var test_mate_id_array=[];
				$(".class_mate_id").each(function () {
					test_mate_id_array.push($(this).val());
				});
				
				var txt_discount_class=[];
				$(".txt_discount_class").each(function () {
					txt_discount_class.push($(this).val());
				});
				
				var hidden_agency= $("#select_agency").val();									
				var name_of_work= $("#name_of_work").val();	
				
				var txt_discount_percent= $("#txt_discount_percent").val();									
				var txt_discount_amount= $("#txt_discount_amount").val();									
				
				billData = '&action_type='+type+'&id='+id+'&invoice_date='+invoice_date+'&hidden_gst_type='+hidden_gst_type+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_igst='+txt_igst+'&txt_grand='+txt_grand+'&txt_amt_in_word='+txt_amt_in_word+'&total_amt='+total_amt+'&hidden_agency='+hidden_agency+'&test_ids_array='+test_ids_array+'&test_name_array='+test_name_array+'&test_qty_array='+test_qty_array+'&test_rates_array='+test_rates_array+'&test_amnt_array='+test_amnt_array+'&hidden_gst_in_ex='+hidden_gst_in_ex+'&perfoma_no='+perfoma_no+'&test_mate_array='+test_mate_array+'&test_mate_id_array='+test_mate_id_array+'&name_of_work='+name_of_work+'&txt_discount_percent='+txt_discount_percent+'&txt_discount_amount='+txt_discount_amount+'&txt_discount_class='+txt_discount_class;
				
    }else{
		
	
				billData = 'action_type='+type+'&id='+id;
				
    }
		var gst_no = $('#gst_no').val();
		var hidden_gst_type = $('#hidden_gst_type').val(); 		
		
		if(invoice_date=="")
		{
			alert("Please Select Invoice Date..");
			return false;
		}
		if(hidden_gst_type=="")
		{
			alert("Please Select Gst..");
			return false;
		}
		
		
		if(hidden_gst_type !="without_gst")
		{
			if(hidden_gst_in_ex==""){
				
				alert("Please Select Include Or Exclude..");
			}
			else
			{
					$.ajax({
				type: 'POST',
				url: '<?php $base_url; ?>save_span_add_new_perfoma.php',
				data: billData,
				success:function(msg){
					alert("Successfully Saved..");
					window.location.href="<?php echo $base_url; ?>list_of_quoations.php";
						
					
					}
					 });
			}
		}
		else
		{
			 $.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_add_new_perfoma.php',
			data: billData,
			success:function(msg){
				alert("Successfully Saved..");
					window.location.href="<?php echo $base_url; ?>list_of_quoations.php";
				
			}
				 });
          
        
   
		}
	
   
}




 // on category change 
$("#select_material_category").change(function(){
      var select_material_category = $('#select_material_category').val(); 
	  
	  var postData = 'action_type=get_material_by_category&select_material_category='+select_material_category;
			
			$.ajax({
				url : "<?php $base_url; ?>save_span_add_new_perfoma.php",
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
				    $('#get_more_count').val(20);
					$("#get_more").prop("disabled", false);
					
				 }
			});
});

// on material change

$("#select_material").change(function(){
      var select_material = $('#select_material').val(); 
      var select_material_category = $('#select_material_category').val(); 
	  var postData = 'action_type=get_lab_by_material&select_material='+select_material+'&select_material_category='+select_material_category;
			
			$.ajax({
				url : "<?php $base_url; ?>save_span_add_new_perfoma.php", 
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					$('#select_test').html(data.out_tests);
					
				 }
			});
});

$("#select_agency").change(function(){
				
		var select_agency = $('#select_agency').val();
		var ajaxParameter = 'action_type=select_agency_data&agency_id='+select_agency;
		$.ajax({
			url : "<?php $base_url; ?>get_on_change_agency.php",
			type: "POST",
			dataType:'JSON',
			data : ajaxParameter,
			success: function(data,status,  xhr)
			{
				if(data.status == 'success'){
					$('#adress').val(data.agency_address);
					$('#mobile').val(data.agency_mobile);
					$('#pincode').val(data.agency_pincode);
					$('#email').val(data.agency_email);
					$('#gst_no').val(data.agency_gstno);
				}else{
					alert('No Data Found');
				}
			}
		}); 
		
	 });
	 
function after_changes_on(){
	
$("#txt_discount_percent").val("0");
$("#txt_discount_amount").val("0");
$('input[name=in_or_ex]').prop("checked", false);
	$('input[name=gst_type]').prop("checked", false);
}

$(document).on("blur","#txt_discount_percent",function(){
	
	var txt_discount_percent= $("#txt_discount_percent").val();
	var plus_total_amount=0;
	$(".class_amnt").each(function(){
		plus_total_amount +=parseInt($(this).val());
	});
	var discount_amounts= parseInt(plus_total_amount)*parseInt(txt_discount_percent)/100;
	var set_grand_total= parseInt(plus_total_amount)- parseInt(discount_amounts);
	$("#txt_discount_amount").val(discount_amounts);
	$("#txt_grand").val(set_grand_total);
	$('input[name=in_or_ex]').prop("checked", false);
	$('input[name=gst_type]').prop("checked", false);
	
});
</script>
