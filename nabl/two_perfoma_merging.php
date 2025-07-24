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

	$explode_est_id=explode(",",$_GET["chk_array"]);
	$trf_array=array();
	$perfoma_array=array();
	
	foreach($explode_est_id as $keyses => $one_ids)
	{
			$sel_est="select * from estimate_total_span where `est_id`=".$one_ids;
			$query_est=mysqli_query($conn,$sel_est);
			$get_est=mysqli_fetch_array($query_est);
			$explodes_trf=explode(",",$get_est["trf_no"]);
			foreach($explodes_trf as $onesd)
			{
				
			array_push($trf_array,$onesd);
			}
			array_push($perfoma_array,$get_est["perfoma_no"]);
			$get_rate_type=$get_est["rate_type"];
			$gst_noes=$get_est["gst_no"];
			$letter_heading=$get_est["letter_heading"];
			$letter_nos=$get_est["letter_nos"];
			$letter_dated=$get_est["letter_dated"];
			$charge_one=$get_est["charge_one"];
			$charge_one_percentage=$get_est["charge_one_percentage"];
			$charge_two=$get_est["charge_two"];
			$charge_two_percentage=$get_est["charge_two_percentage"];
			$discount_percentage=$get_est["discount_percentage"];
	}
	
	$min_perfoma_no= min($perfoma_array);
	$implode_perfoma_array=implode(",",$perfoma_array);
	$txt_trf_no= $trf_array[0];
	$txt_jobs= $trf_array[0];  
	
	$make_type=$_GET["make_type"];
	if($make_type=="0"){
		$by_make="Test";
	}else{
		$by_make="Material";
	}
	
	// to get job for agency id
$sel_job="select * from job where `trf_no`='$txt_trf_no'";
$query_job= mysqli_query($conn,$sel_job);
$result_job=mysqli_fetch_array($query_job);
$get_agency_id= $result_job["agency"];
$agency_city= $result_job["agency_city"];
$clientnaming= $result_job["clientname"];
$clientid= $result_job["client_code"];

$sel_client_code=$result_job["billing_to_id"];
$sel_client="select `clientname` from client where `client_code`='$sel_client_code'";
$result_client =mysqli_query($conn,$sel_client);
$row_client =mysqli_fetch_array($result_client);
$clientnaming=$row_client["clientname"];
$clientid= $row_client["billing_to_id"];

$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$result_job["billing_to_id"];
$query_agency= mysqli_query($conn,$sel_agency);
$result_agency=mysqli_fetch_array($query_agency);
$get_agency_gst_no= $result_agency["agency_gstno"];
$agency_naming= $result_agency["agency_name"];
$agency_ids= $result_agency["agency_id"];
$perfoma_make_by= $result_agency["perfoma_make_by"];

	


	 
	 $get_gst_type="";
	 $get_c_gst_amt="";
	 $get_s_gst_amt="";
	 $get_i_gst_amt="";
	 $get_grand_total="";
	 $get_total_amount="";
	 $get_total_amt_in_word="";
	 $hsn_codes="";
	 $estimate_perfoma_no= "";
	 $bill_to= $get_estimate["bill_to"];
	 $other_customer_name= "";
	 $other_customer_address= "";
	 $other_customer_gst_no= "";
	 
	 $gst_in_or_ex="";
 
			$invoice_dates = date("Y");
			$sel_fy="select * from fyearmaster where `fyyear`='$invoice_dates'";
			$query_fy = mysqli_query($conn, $sel_fy);
			$result_fy = mysqli_fetch_assoc($query_fy);
			$first_char= $result_fy["ulr_prefix"];
			 // jo invoice date ma perfoma hoy to 
			 $sel_estiamte_by_date="SELECT * FROM estimate_total_span  ORDER BY est_id DESC";
			 $query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);

			
			if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) 
			{
				$result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
				$get_sequence= $result_estimate["perfoma_no"];
				$explode_perfoma=explode("-",$get_sequence);
				$plus_squence= intval($explode_perfoma[2])+1;
				$plused= sprintf('%04d', $plus_squence);
			}else{
				$plused= "0001";
			}
			$set_perfoma_no=$first_char."-PI-".$plused;

		//get trf print also for biller view
		$merge_upload_document='';
		foreach($trf_array as $one_chk_array)
		{
			$sel_jobs_doc="select * from `job` where `trf_no`='$one_chk_array'";
			$query_jobs_doc = mysqli_query($conn, $sel_jobs_doc);
			$result_jobs_doc = mysqli_fetch_array($query_jobs_doc);
			if($result_jobs_doc["scan_document"]!="")
			{
				$merge_upload_document .='<iframe src="'.$base_url.'scan_document/'.$result_jobs_doc["scan_document"].'" style="height:1120px;width:1105px;"></iframe>';
				
				
				
			}
		}
		$implode_trf_no=implode(",",$trf_array);
		
	$today= date("Y-m-d");	
	$sel_fy_years="select * from fyearmaster where `id`='$_SESSION[fy_id]'";
	$query_f_year=mysqli_query($conn, $sel_fy_years);
	$result_f_year = mysqli_fetch_array($query_f_year);
	
	$starting_date=date('Y-m-d H:i:s', strtotime($result_f_year["fy_startdate"]));
	
	
	$end_year_date=date('Y-m-d H:i:s', strtotime($result_f_year["fy_enddate"]));
	
	if($today < $end_year_date){
		
		$ending_date= $today;
	}else{
		$ending_date=date('Y-m-d H:i:s', strtotime($result_f_year["fy_enddate"]));
	}
	
	
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}



.form-control { 
font-size: 14px;
height: 35px;
}



</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
 
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
				<h1 style="text-align:center;">
					Proforma
				</h1>
			</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
								<div class="col-sm-1">
								<label for="inputEmail3" class="control-label">Bill To:</label>
								</div>
									<div class="col-sm-6">
											<!--<input type="radio" style="width:20px;height:10px;" name="txt_bill_to" value="0" checked><span style="font-size:14px;" ><b>Agency (<?php //echo $agency_naming;?>)</b></span>-->
											<input type="radio" style="width:20px;height:10px;"name="txt_bill_to" value="1" checked><span style="font-size:14px;"><b>Client (<?php echo $agency_naming;?>)<b></span>
											<!--<input type="radio" style="width:20px;height:10px;"name="txt_bill_to" value="2"><span style="font-size:14px;"><b>Other<b></span>-->
											
											<input type="hidden" name="" value="<?php echo $agency_ids;?>" id="bill_to_id">
											<input type="hidden" name="" value="<?php echo $agency_naming;?>" id="bill_to_name">
									</div>
									 
								</div>
								<br>
								<div class="row" id="bill_to_hide_show" style="<?php if($bill_to!="2"){ echo "display:none";}else{ echo "display:block";} ?>">
								
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Customer Name:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="other_customer_name" class="form-control" id="other_customer_name" value="<?php echo $other_customer_name;?>">
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Customer Address:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="other_customer_address" class="form-control" id="other_customer_address" value="<?php echo $other_customer_address;?>">
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Customer GSt No:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="other_customer_gst_no" class="form-control" id="other_customer_gst_no" value="<?php echo $other_customer_gst_no;?>">
									</div>
									
									
									
								</div>
								<div class="row">
									<div class="col-md-3">
									<label for="inputEmail3" class="col-md-12 control-label">Report No:</label>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="col-md-12 control-label">Invoice Date:</label>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="col-md-12 control-label">Rate:</label>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="col-md-12 control-label">Gst No:</label>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="col-md-12 control-label">Proforma No:</label>
									</div>
								</div>
								<div class="row">
									
										  <div class="col-sm-3">
											<input type="text" class="form-control" value="<?php echo $implode_trf_no;?>" id="txt_trf_no" name="txt_trf_no" disabled>
											
											<input type="hidden" class="form-control" value="<?php echo $implode_trf_no;?>" id="txt_job_no" name="txt_job_no" disabled>
											
											<input type="hidden" class="form-control" value="<?php echo $txt_trf_no;?>" id="txt_one_trf" name="txt_one_trf" disabled>
											<input type="hidden" class="form-control" value="<?php echo $implode_perfoma_array;?>" id="perfoma_array" name="perfoma_array" >
													
										  </div>
											<div class="col-md-2">
													<input type="text"  class="form-control" name="invoice_date" id="invoice_date" value="<?php echo date('d/m/Y')?>">
											
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
												
												<div class="col-sm-12">
													<select class="form-control " name="select_rate" id="select_rate"  disabled>
														<option value="0" <?php if($get_rate_type=="0"){echo "selected";}?>>Government</option>
														<option value="1" <?php if($get_rate_type=="1"){echo "selected";}?>>Private</option>
														
													</select>
												</div>
											</div>
										  </div>
										  
										  <div class="col-md-2">
												<input type="text"  class="form-control" name="gst_no" id="gst_no" value="<?php echo $gst_noes;?>" disabled>
										  </div>
										  <div class="col-md-2">
												<input type="text"  class="form-control" name="perfoma_no" id="perfoma_no" value="<?php echo $min_perfoma_no;?>" disabled>
										   </div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-3">
									<input type="text"  class="form-control" name="letter_heading" id="letter_heading" placeholder="Reference/PO/Letter" value="<?php echo $letter_heading;?>">
									</div>
									<div class="col-md-3">
									<input type="text"  class="form-control" name="letter_nos" id="letter_nos" placeholder="Reference/PO/Letter NO"  value="<?php echo $letter_nos;?>">
									</div>
									<div class="col-md-3">
									<input type="text"  class="form-control" name="letter_dated" id="letter_dated" placeholder="Dated"  value="<?php echo $letter_dated;?>">
									</div>
									<div class="col-md-3">
											<input type="radio" style="width:20px;height:10px;" name="txt_make_by" value="<?php echo $make_type;?>" checked><span style="font-size:14px;" ><b>By <?php echo $by_make;?></b></span>
									</div>
								</div>
								<br>
							<div class="panel-group">
								<div class="box box-info">
								<div class="row"><div class="col-md-3">&nbsp;</div></div>
								
							<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<table class="table no-margin class_tr_put" >
										  <thead>
										  </thead>
										  <tbody id="put_design">
										  
										  </tbody>
										</table>
										
									  </div>
									</div>
								</div>
							</div>
							<br>
							<div class="box box-info">
							<input type="hidden" name="hidden_gst_type" id="hidden_gst_type" value="with_gst"> 
							<input type="hidden" name="hidden_gst_in_ex" id="hidden_gst_in_ex" value="exclude"> 
							
								<div class="row" id="" style="">
								<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Sub Total</label>
									</div>
									
									
									<div class="col-md-1">
									<input type="text" name="txt_grand" class="form-control" id="txt_grand" value="<?php echo $get_grand_total;?>" disabled>
									</div>
									
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Charge 1:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_sgst" class="form-control" id="txt_charge_one" placeholder="Charge 1" value="<?php echo $charge_one;?>">
									</div>
									
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Charge 1 %:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_sgst" class="form-control" id="txt_charge_one_percentage" placeholder="Charge One Percentage" value="<?php echo $charge_one_percentage;?>">
									</div>
									
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Charge 1 Amount:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_sgst" class="form-control" id="txt_charge_one_amnt" placeholder="Charge One amount" value="" disabled>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Charge 2:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_sgst" class="form-control" id="txt_charge_two" placeholder="Charge 2" value="<?php echo $charge_two;?>">
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Charge 2 %:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_sgst" class="form-control" id="txt_charge_two_percentage" placeholder="Charge Two Percentage" value="<?php echo $charge_two_percentage;?>">
									</div>
								</div>
								<br>
								<div class="row" id="" style="">
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Charge 2 Amount:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_sgst" class="form-control" id="txt_charge_two_amnt" placeholder="Charge Two amount" value="0" disabled>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Discount(%):</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_sgst" class="form-control" id="txt_discount_percentage" placeholder="Discount Percentage" value="<?php echo $discount_percentage;?>" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Discount Amount:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_discount_amnt" class="form-control" id="txt_discount_amnt" value="0" disabled>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Taxable Amount:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_sgst" class="form-control" id="txt_taxable" value="" disabled>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Sgst:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_sgst" class="form-control" id="txt_sgst" value="<?php echo $get_s_gst_amt;?>" disabled>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Cgst:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_cgst" class="form-control" id="txt_cgst" value="<?php echo $get_c_gst_amt;?>" disabled>
									</div>
									
									
								</div>
								<div class="row" id="" style="">
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Igst:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_igst" class="form-control" id="txt_igst" value="<?php echo $get_i_gst_amt;?>" disabled>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Round Up:</label>
									</div>
									
									<div class="col-md-1">
									<input type="text" name="txt_igst" class="form-control" id="txt_round_up" value="" disabled>
									</div>
									
									
								</div>
								
							</div>
							<div class="box box-info">
							<br>
								<div class="row">
									<div class="col-md-3">
									<label for="inputEmail3" class="control-label">Total Amount In Word:</label>
									</div>
									
									<div class="col-md-4">
									<input type="text" name="txt_amt_in_word" class="form-control" id="txt_amt_in_word" value="<?php if($get_total_amt_in_word !=""){ echo $get_total_amt_in_word;}else{ echo numtowords($get_total_amt);} ?>" disabled>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="control-label">Total Amount:</label>
									</div>
									
									<div class="col-md-3">
									<input type="text" name="total_amt" class="form-control" id="total_amt" value="<?php if($get_total_amount !=""){ echo $get_total_amount;}else{ echo $get_total_amt;} ?>" disabled>
									</div>
								</div>
								<br>
							<input type="hidden" name="hidden_agency" id="hidden_agency" value="<?php echo $get_agency_id;?>">
								<div class="row">
									<div class="col-md-3">&nbsp;</div>
									<div class="col-md-6">
									<?php
									if($make_type=="0"){ ?>
									<button type="button" class="btn btn-info"  onclick="addData('merge_perfoma_test')" name="btn_add_data" id="btn_add_data" style="width:150px;font-size:14px;display:none" >Merge By Test</button>
									<?php 
									}else{
									?>
									<button type="button" class="btn btn-info"  onclick="add_material('merge_perfoma_material')" name="btn_add_data_by_mate" id="btn_add_data_by_mate" style="width:150px;font-size:14px;display:none" >Merge By Material</button>
									<?php } ?>
									</div>
									<div class="col-md-3">&nbsp;</div>
									
								</div>
							</div>
							
							
							
							</div>
						
					</div>
				</div>
</section>	
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
$(document).ready(function(){
	var starting_date='<?php echo $starting_date;?>';
	var ending_date='<?php echo $ending_date;?>';
	
	var d = new Date(starting_date);
	
	var curr_date = d.getDate();
	var curr_month = d.getMonth() + 1; //Months are zero based
	var curr_year = d.getFullYear();
	var started_date=(curr_date + "/" + curr_month + "/" + curr_year);
	var d_one = new Date(ending_date);
	var curr_date1 = d_one.getDate();
	var curr_month1 = d_one.getMonth() + 1; //Months are zero based
	var curr_year1 = d_one.getFullYear();
	var ended_date=(curr_date1 + "/" + curr_month1 + "/" + curr_year1);

	$('#invoice_date').datepicker({
		  autoclose: true,
		  format: 'dd/mm/yyyy',
		  startDate: "'"+started_date+"'",
		  endDate: "'"+ended_date+"'"
	});
	on_loadings();
});


$(document).on("blur",".txt_rate_class",function(){
	
      var get_rate = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_qty= $("#qty_"+split_data[1]).val();
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);
	  
	  $("#amt_"+split_data[1]).val(txt_amnts); 
	 // $('input[name=in_or_ex]').prop("checked", false);
	 // $('#hidden_gst_in_ex').val("");
	  get_table_after_update();
});

// on qty change

$(document).on("blur",".class_qty",function(){
	
      var get_qty = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_rate= $("#rate_"+split_data[1]).val();
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);
	  
	  $("#amt_"+split_data[1]).val(txt_amnts);
	 // $('input[name=in_or_ex]').prop("checked", false);
	 // $('#hidden_gst_in_ex').val("");
	  get_table_after_update();
});


$(document).on("blur",".class_material_rates",function(){
	
      var get_rate = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_qty= $("#materialqty_"+split_data[1]).val();
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);
	  
	  $("#materialtotals_"+split_data[1]).val(txt_amnts); 
	 // $('input[name=in_or_ex]').prop("checked", false);
	 // $('#hidden_gst_in_ex').val("");
	  get_table_after_update();
});

// on qty change

$(document).on("blur",".class_material_qty",function(){
	
      var get_qty = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_rate= $("#materialrating_"+split_data[1]).val();
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);
	  
	  $("#materialtotals_"+split_data[1]).val(txt_amnts);
	 // $('input[name=in_or_ex]').prop("checked", false);
	 // $('#hidden_gst_in_ex').val("");
	  get_table_after_update();
});



function get_table_after_update(){
    var billData = '';
	var gst_no=$('#gst_no').val();
	
	if(gst_no.indexOf("24")==0)
	{
		$('#hidden_gst_type').val("with_gst");

	}else{
	
	$('#hidden_gst_type').val("with_igst");
		
	}
	
	var select_rate=$('#select_rate').val();
	var gst_type=$('#hidden_gst_type').val();
	//return false;
	var hidden_gst_in_ex=$('#hidden_gst_in_ex').val();
	var txt_charge_one_percentage=$('#txt_charge_one_percentage').val();
	var txt_charge_two_percentage=$('#txt_charge_two_percentage').val();
	var txt_discount_percentage=$('#txt_discount_percentage').val();
	var total_grand_amnt=0;
	$(".class_amnt").each(function () {
			total_grand_amnt += parseInt($(this).val());
			
	});
	
	var send= gst_type+"|"+hidden_gst_in_ex+"|"+total_grand_amnt+"|"+txt_charge_one_percentage+"|"+txt_charge_two_percentage+"|"+txt_discount_percentage+"|"+select_rate;
	billData = '&action_type=get_table_after_update&id='+send;			
   
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_set_rate_merging_perfoma.php',
        data: billData,
		dataType:'JSON',
        success:function(msg){
          //$('#display_data').html(msg.table_design);
          $('#txt_cgst').val(msg.cgst);
          $('#txt_sgst').val(msg.sgst);
          $('#txt_igst').val(msg.igst);
          $('#txt_grand').val(msg.grand_total);
          $('#txt_taxable').val(msg.taxable_amnt);
          $('#txt_amt_in_word').val(msg.get_total_amt_in_word);
          $('#total_amt').val(msg.net_total);
          $('#txt_round_up').val(msg.round_off_total);
		  $('#txt_charge_one_amnt').val(msg.charge_one_amnt);
		  $('#txt_charge_two_amnt').val(msg.charge_two_amnt);
		  $('#txt_discount_percentage').val(msg.txt_discount_percentage);
		  $('#txt_discount_amnt').val(msg.discount_amnt);
		  
        }
    });
}


$(document).on("blur","#gst_no",function(){
	get_table_after_update();
})

// save By  test
function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'merge_perfoma_test') {
		
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var invoice_date = $('#invoice_date').val(); 
				var gst_no = $('#gst_no').val(); 
				var select_rate = $('#select_rate').val(); 
				var hidden_gst_type = $('#hidden_gst_type').val(); 
				var hidden_gst_in_ex = $('#hidden_gst_in_ex').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_igst = $('#txt_igst').val(); 
				var txt_grand = $('#txt_grand').val(); 
				var txt_amt_in_word = $('#txt_amt_in_word').val(); 
				var total_amt = $('#total_amt').val();
				var perfoma_no = $('#perfoma_no').val();
				var hsn_codes = $('#hsn_codes').val();
				var txt_bill_to=$( 'input[name=txt_bill_to]:checked' ).val();
				var other_customer_name = $('#other_customer_name').val();
				var other_customer_address = $('#other_customer_address').val();
				var other_customer_gst_no = $('#other_customer_gst_no').val();
				var bill_to_id = $('#bill_to_id').val();
				var bill_to_name_f = $('#bill_to_name').val();
				var bill_to_name= bill_to_name_f.replace("&", "QQQ");
				var perfoma_array = $('#perfoma_array').val();
				
				if(gst_no ==""){
					alert("please Enter Gst First");
					return false;
				}else{
					
				}
				if(gst_no.length !=15)
				{
					if(gst_no!="24aaa"){
					alert("Enter Gst No Properly...");
					return false;
					}else{
					}
				}
				
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
				
				var test_trf_id_array=[];
				$(".class_trf_id").each(function () {
					test_trf_id_array.push($(this).val());
				});
				
				var hidden_agency= $('#hidden_agency').val();
				var letter_heading= $('#letter_heading').val();
				var letter_nos= $('#letter_nos').val();
				var letter_dated= $('#letter_dated').val();
								
				if(letter_heading !="" && letter_nos =="" && letter_dated==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_heading !="" && letter_nos ==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_heading !="" && letter_dated ==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_nos !="" && letter_heading =="" && letter_dated==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_nos !="" && letter_heading ==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_nos !="" && letter_dated==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_dated !="" && letter_heading =="" && letter_nos==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_dated !="" && letter_heading ==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_dated !="" && letter_nos==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				
				var txt_charge_one= $('#txt_charge_one').val();
				var txt_charge_one_percentage= $('#txt_charge_one_percentage').val();
				var txt_charge_two= $('#txt_charge_two').val();
				var txt_charge_two_percentage= $('#txt_charge_two_percentage').val();
				var txt_taxable= $('#txt_taxable').val();
				var txt_round_up= $('#txt_round_up').val();
				var txt_charge_one_amnt= $('#txt_charge_one_amnt').val();
				var txt_charge_two_amnt= $('#txt_charge_two_amnt').val();
				var txt_discount_percentage= $('#txt_discount_percentage').val();
				var txt_discount_amnt= $('#txt_discount_amnt').val();
				if(txt_charge_one_percentage !="" && txt_charge_one =="" && select_rate !="0"){
					alert("Enter First Charge Text..");
					return false;
				}
				if(txt_charge_two_percentage !="" && txt_charge_two =="" && select_rate !="0"){
					alert("Enter Second Charge Text..");
					return false;
				}
				
				
				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&invoice_date='+invoice_date+'&select_rate='+select_rate+'&hidden_gst_type='+hidden_gst_type+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_igst='+txt_igst+'&txt_grand='+txt_grand+'&txt_amt_in_word='+txt_amt_in_word+'&total_amt='+total_amt+'&hidden_agency='+hidden_agency+'&gst_no='+gst_no+'&test_ids_array='+test_ids_array+'&test_name_array='+test_name_array+'&test_qty_array='+test_qty_array+'&test_rates_array='+test_rates_array+'&test_amnt_array='+test_amnt_array+'&hidden_gst_in_ex='+hidden_gst_in_ex+'&hsn_codes='+hsn_codes+'&perfoma_no='+perfoma_no+'&test_mate_array='+test_mate_array+'&test_mate_id_array='+test_mate_id_array+'&txt_bill_to='+txt_bill_to+'&other_customer_name='+other_customer_name+'&other_customer_address='+other_customer_address+'&other_customer_gst_no='+other_customer_gst_no+'&test_trf_id_array='+test_trf_id_array+'&letter_heading='+letter_heading+'&letter_nos='+letter_nos+'&letter_dated='+letter_dated+'&txt_charge_one='+txt_charge_one+'&txt_charge_one_percentage='+txt_charge_one_percentage+'&txt_charge_two='+txt_charge_two+'&txt_charge_two_percentage='+txt_charge_two_percentage+'&txt_taxable='+txt_taxable+'&txt_round_up='+txt_round_up+'&txt_charge_one_amnt='+txt_charge_one_amnt+'&txt_charge_two_amnt='+txt_charge_two_amnt+'&txt_discount_percentage='+txt_discount_percentage+'&txt_discount_amnt='+txt_discount_amnt+'&bill_to_id='+bill_to_id+'&bill_to_name='+bill_to_name+'&perfoma_array='+perfoma_array;
				
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
		if(select_rate=="")
		{
			alert("Please Select Rate Type");
			return false;
		}
		
		if(hidden_gst_in_ex==""){
				
				alert("Please Select Include Or Exclude..");
			}
			else if(gst_no==null || gst_no=="")
			{
				alert("GST No. Require..");
			}
			else
			{
					$.ajax({
				type: 'POST',
				url: '<?php $base_url; ?>save_perfoma_merge.php',
				data: billData,
				success:function(msg){
					alert("Perfoma Merged By Test Successfully");
					window.location.href="<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";
					}
					 });
			}
		
}
// code for save by material
function add_material(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'merge_perfoma_material') {
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var invoice_date = $('#invoice_date').val(); 
				var gst_no = $('#gst_no').val(); 
				var select_rate = $('#select_rate').val(); 
				var hidden_gst_type = $('#hidden_gst_type').val(); 
				var hidden_gst_in_ex = $('#hidden_gst_in_ex').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_igst = $('#txt_igst').val(); 
				var txt_grand = $('#txt_grand').val(); 
				var txt_amt_in_word = $('#txt_amt_in_word').val(); 
				var total_amt = $('#total_amt').val();
				var perfoma_no = $('#perfoma_no').val();
				var hsn_codes = $('#hsn_codes').val();
				var txt_bill_to=$( 'input[name=txt_bill_to]:checked' ).val();
				var other_customer_name = $('#other_customer_name').val();
				var other_customer_address = $('#other_customer_address').val();
				var other_customer_gst_no = $('#other_customer_gst_no').val();
				var bill_to_id = $('#bill_to_id').val();
				var bill_to_name_f = $('#bill_to_name').val();
				var bill_to_name= bill_to_name_f.replace("&", "QQQ");
				var perfoma_array = $('#perfoma_array').val();
				
				if(gst_no ==""){
					alert("please Enter Gst First");
					return false;
				}else{
					
				}
				
				if(gst_no.length !=15){
					if(gst_no!="24aaa"){
					alert("Enter Gst No Properly...");
					return false;
					}else{
					}
				}
				
				var mate_qty_array=[];
				$(".class_material_qty").each(function () {
					mate_qty_array.push($(this).val());
				});
				
				var mate_rates_array=[];
				$(".class_material_rates").each(function () {
					mate_rates_array.push($(this).val());
				});
				
				var mat_amnt_array=[];
				$(".class_amnt").each(function () {
					mat_amnt_array.push($(this).val());
				});
				
				var test_mate_array=[];
				$(".class_material_name").each(function () {
					test_mate_array.push($(this).val());
				});
				
				var test_mate_id_array=[];
				$(".class_material_id").each(function () {
					test_mate_id_array.push($(this).val());
				});
				
				var test_trf_id_array=[];
				$(".class_trf_id").each(function () {
					test_trf_id_array.push($(this).val());
				});
				
				var hidden_agency= $('#hidden_agency').val();
				var letter_heading= $('#letter_heading').val();
				var letter_nos= $('#letter_nos').val();
				var letter_dated= $('#letter_dated').val();
								
				if(letter_heading !="" && letter_nos =="" && letter_dated==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_heading !="" && letter_nos ==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_heading !="" && letter_dated ==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_nos !="" && letter_heading =="" && letter_dated==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_nos !="" && letter_heading ==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_nos !="" && letter_dated==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_dated !="" && letter_heading =="" && letter_nos==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_dated !="" && letter_heading ==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				if(letter_dated !="" && letter_nos==""){
					alert("Please Enter Letter Data Properly");
					return false;
				}
				
				var txt_charge_one= $('#txt_charge_one').val();
				var txt_charge_one_percentage= $('#txt_charge_one_percentage').val();
				var txt_charge_two= $('#txt_charge_two').val();
				var txt_charge_two_percentage= $('#txt_charge_two_percentage').val();
				var txt_taxable= $('#txt_taxable').val();
				var txt_round_up= $('#txt_round_up').val();
				var txt_charge_one_amnt= $('#txt_charge_one_amnt').val();
				var txt_charge_two_amnt= $('#txt_charge_two_amnt').val();
				var txt_discount_percentage= $('#txt_discount_percentage').val();
				var txt_discount_amnt= $('#txt_discount_amnt').val();
				
				if(txt_charge_one_percentage !="" && txt_charge_one =="" && select_rate !="0"){
					alert("Enter First Charge Text..");
					return false;
				}
				if(txt_charge_two_percentage !="" && txt_charge_two =="" && select_rate !="0"){
					alert("Enter Second Charge Text..");
					return false;
				}
				
				
				
				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&invoice_date='+invoice_date+'&select_rate='+select_rate+'&hidden_gst_type='+hidden_gst_type+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_igst='+txt_igst+'&txt_grand='+txt_grand+'&txt_amt_in_word='+txt_amt_in_word+'&total_amt='+total_amt+'&hidden_agency='+hidden_agency+'&gst_no='+gst_no+'&mate_qty_array='+mate_qty_array+'&mate_rates_array='+mate_rates_array+'&mat_amnt_array='+mat_amnt_array+'&hidden_gst_in_ex='+hidden_gst_in_ex+'&hsn_codes='+hsn_codes+'&perfoma_no='+perfoma_no+'&test_mate_array='+test_mate_array+'&test_mate_id_array='+test_mate_id_array+'&txt_bill_to='+txt_bill_to+'&other_customer_name='+other_customer_name+'&other_customer_address='+other_customer_address+'&other_customer_gst_no='+other_customer_gst_no+'&test_trf_id_array='+test_trf_id_array+'&letter_heading='+letter_heading+'&letter_nos='+letter_nos+'&letter_dated='+letter_dated+'&txt_charge_one='+txt_charge_one+'&txt_charge_one_percentage='+txt_charge_one_percentage+'&txt_charge_two='+txt_charge_two+'&txt_charge_two_percentage='+txt_charge_two_percentage+'&txt_taxable='+txt_taxable+'&txt_round_up='+txt_round_up+'&txt_charge_one_amnt='+txt_charge_one_amnt+'&txt_charge_two_amnt='+txt_charge_two_amnt+'&txt_discount_percentage='+txt_discount_percentage+'&txt_discount_amnt='+txt_discount_amnt+'&bill_to_id='+bill_to_id+'&bill_to_name='+bill_to_name+'&perfoma_array='+perfoma_array;
				
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
		if(select_rate=="")
		{
			alert("Please Select Rate Type");
			return false;
		}
		
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_perfoma_merge.php',
			data: billData,
			success:function(msg){
				alert("Perfoma Merged By Material Successfully");
				window.location.href="<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";
					
			}
		});
       
	
   
}

function on_loadings()
    {
		var txt_make_by=$( 'input[name=txt_make_by]:checked' ).val();
		var txt_trf_no=$('#txt_trf_no').val();
		var get_rate_type=$('#select_rate').val();
		var perfoma_array=$('#perfoma_array').val();
		var bill_to_id=$('#bill_to_id').val();
		billData = '&action_type=on_make_by_change&txt_make_by='+txt_make_by+'&txt_trf_no='+txt_trf_no+'&get_rate_type='+get_rate_type+'&perfoma_array='+perfoma_array+'&bill_to_id='+bill_to_id;
		$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_perfoma_merge.php',
        data: billData,
		success:function(msg)
		{
          $("#put_design").html(msg);
		  get_table_after_update();
		  
		  if(txt_make_by=="0")
		  {
			$("#btn_add_data").show();  
			$("#btn_add_data_by_mate").hide();
		  }else{
			$("#btn_add_data").hide();  
			$("#btn_add_data_by_mate").show();  
			  
		  }
		  
        }
    });
	
};

$(document).on("blur",".class_material_rates",function(){
	
      var get_rate = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_qty= $("#materialqty_"+split_data[1]).val();
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);
	  
	  $("#materialtotals_"+split_data[1]).val(txt_amnts); 
	 // $('input[name=in_or_ex]').prop("checked", false);
	 // $('#hidden_gst_in_ex').val("");
	  get_table_after_update();
});

// on qty change

$(document).on("blur",".class_material_qty",function(){
	
      var get_qty = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_rate= $("#materialrating_"+split_data[1]).val();
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);
	  
	  $("#materialtotals_"+split_data[1]).val(txt_amnts);
	 // $('input[name=in_or_ex]').prop("checked", false);
	 // $('#hidden_gst_in_ex').val("");
	
	  get_table_after_update();
});
</script>
