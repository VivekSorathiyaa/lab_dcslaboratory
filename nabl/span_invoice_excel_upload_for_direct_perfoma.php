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



	$perfoma_no= $_GET["perfoma_no"];
	
	$txt_trf_no= $get_chk_array[0];
	$txt_jobs= $get_chk_array[0];   
	
	$sel_perfoma="select * from estimate_total_span where `perfoma_no`='$perfoma_no'";
    $query_sel_perfoma = mysqli_query($conn, $sel_perfoma);
	$result_perfomas= mysqli_fetch_array($query_sel_perfoma);
	$estimate_date=$result_perfomas["estimate_date"];
	$agreement_no=$result_perfomas["agreement_no"];
	$hsn_codes=$result_perfomas["hsn_codes"];
	$bill_to=$result_perfomas["bill_to"];
	$other_customer_name=$result_perfomas["other_customer_name"];
	$other_customer_address=$result_perfomas["other_customer_address"];
	$other_customer_gst_no=$result_perfomas["other_customer_gst_no"];
	$get_agency_id=$result_perfomas["agency_id"];

	   // bill sequence logic
		 $sel_estiamte_for_bill_no="select * from estimate_total_span_bill_sequence  ORDER BY bill_id DESC";
		 $query_estiamte_for_bill_no = mysqli_query($conn, $sel_estiamte_for_bill_no);
		 
		 if (mysqli_num_rows($query_estiamte_for_bill_no) > 0) 
		 {
			$result_estiamte_for_bill_no = mysqli_fetch_assoc($query_estiamte_for_bill_no);
			$explode_bill_no= explode("/",$result_estiamte_for_bill_no["bill_no"]);
	
			$first_explode=$explode_bill_no[0];
			$second_explode=$explode_bill_no[1];
			$third_explode=$explode_bill_no[2];
			$l_trim_third_explode= ltrim($third_explode,"0");
			$plus_of_bill= intval($l_trim_third_explode)+1;
			$final_bill_no= sprintf('%04d', $plus_of_bill);
			
			$sel_year="select * from fyearmaster where `fy_isactive`=0";
			$query_year = mysqli_query($conn, $sel_year);
			$result_year = mysqli_fetch_array($query_year);
			$year_name=$result_year["fy_name"];
			$today_date=date("Ymd");
			
			$set_bill_no= $first_explode."/".$year_name."/".$final_bill_no;
		}
		else
		{
			$sel_year="select * from fyearmaster where `fy_isactive`=0";
			$query_year = mysqli_query($conn, $sel_year);
			$result_year = mysqli_fetch_array($query_year);
			$year_name=$result_year["fy_name"];
			$today_date=date("Ymd");
			
			$set_bill_no= "GST/".$year_name."/0001";

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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   
  <?php 
  $_SESSION['trf_no']= $txt_trf_no;
  $_SESSION['jobing_no']= $txt_jobs;
  ?>
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		Excel Upload For Invoice
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Invoice Date:</label>
									</div>
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">GST NO:</label>
									</div>
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">HSN/SAC Code:</label>
									</div>
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Bill No:</label>
									</div>
								</div>
								<div class="row">
									
										  <div class="col-md-3">
											<input type="text"  class="form-control" name="invoice_date" id="invoice_date" value="<?php echo date('d/m/Y',strtotime($estimate_date))?>">
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="gst_no" id="gst_no" value="<?php echo $agreement_no;?>">
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="hsn_codes" id="hsn_codes" value="<?php echo $hsn_codes;?>">
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="bill_no" id="bill_no" value="<?php echo $set_bill_no;?>" >
											
										  </div>
									
								</div>
								
								<br>
								<div class="row">
										<div class="col-sm-2">
										<label for="inputEmail3" class="control-label">Bill To :</label>
										</div>
										<div class="col-sm-9">
											<input type="radio" style="width:33px;height:25px;" name="txt_bill_to" value="0" <?php if($bill_to=="0"){ echo "checked";} ?>><span style="font-size:20px;" ><b>Agency</b></span>
											<input type="radio" style="width:33px;height:25px;"name="txt_bill_to" value="1" <?php if($bill_to=="1"){ echo "checked";} ?>><span style="font-size:20px;"><b>Client<b></span>
											<input type="radio" style="width:33px;height:25px;"name="txt_bill_to" value="2" <?php if($bill_to=="2"){ echo "checked";} ?>><span style="font-size:20px;"><b>Other<b></span>
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
								<br>
							<div class="panel-group">
								<div class="box box-info">
									<div class="box-body">
									  <div class="table-responsive" id="display_data" style="min-height:150px;">
										<table class="table no-margin">
										  <thead>
										  <tr>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
										  </tr>
										  <tr>
											<th>
											<label for="inputEmail3" class="control-label">
											UPLOAD EXCEL:
											</label>
											</th>
											<th><input type="file" name="txt_excel" id="txt_excel" class="form-control"></th>
											
										  </tr>
										  </thead>
										  <tbody>
										  
										  </tbody>
										</table>
									  </div>
									</div>
								</div>
							</div>
							<br>
							<div class="box box-info">
							<br>
								<div class="row">
									<div class="col-sm-2"><label for="inputEmail3" class="control-label">Sub Total:</label></div>
									<div class="col-sm-1">
									<input type="text" name="txt_sub_total" class="form-control" id="txt_sub_total" value="0">
									</div>
									<div class="col-sm-2"><label for="inputEmail3" class="control-label">Discount Percent:</label></div>
									<div class="col-sm-1">
									<input type="text" name="txt_discount_percent" class="form-control" id="txt_discount_percent" value="0">
									</div>
									<div class="col-sm-2"><label for="inputEmail3" class="control-label">Discount Amount:</label></div>
									<div class="col-sm-2">
									<input type="text" name="txt_discount_amount" class="form-control" id="txt_discount_amount" value="0">
									</div>
								</div>
							<br>
							</div>
							<div class="box box-info">
							<input type="hidden" name="hidden_gst_type" id="hidden_gst_type" value=""> 
							<input type="hidden" name="hidden_gst_in_ex" id="hidden_gst_in_ex" value=""> 
								<div class="row">
									<div class="col-sm-2">
									<label for="inputEmail3" class="control-label">GST TYPE:</label>
									</div>
									
									<div class="col-sm-9">
										<input type="radio" style="width:33px;height:25px;" name="gst_type" value="with_gst"><span style="font-size:20px;" ><b>With GST</b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="without_gst"><span style="font-size:20px;"><b>Without GST<b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="with_igst"><span style="font-size:20px;"><b>With IGST<b></span>
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
									<input type="text" name="txt_cgst" class="form-control" id="txt_cgst" value="0" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">SGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_sgst" class="form-control" id="txt_sgst" value="0" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">IGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_igst" class="form-control" id="txt_igst" value="0" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">GRAND TOTAL:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_grand" class="form-control" id="txt_grand" value="0" >
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
									<input type="text" name="txt_amt_in_word" class="form-control" id="txt_amt_in_word" value="" >
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="control-label">Total Amount:</label>
									</div>
									
									<div class="col-md-3">
									<input type="text" name="total_amt" class="form-control" id="total_amt" value="0" >
									</div>
								</div>
								<br>
							<input type="hidden" name="hidden_agency" id="hidden_agency" value="<?php echo $get_agency_id;?>">
							<input type="hidden" name="hidden_perfoma_no" id="hidden_perfoma_no" value="<?php echo $perfoma_no;?>">
							<?php
							$sel_excel="select * from estimate_total_span_only_for_test where `perfoma_no`='$perfoma_no' AND `est_isdeleted`=0";
						    $query_excel=mysqli_query($conn,$sel_excel);
							$if_record_available=mysqli_num_rows($query_excel);
							if($if_record_available <= 0)
							{
							?>
								<div class="row">
									<div class="col-md-5">
									</div>
									<div class="col-md-6">
									<button type="button" class="btn btn-info"  onclick="saveclient('upload_direct_perfoma_excel')" style="width:150px;font-size:20px;">Upload</button> 
									</div>
								</div>
							<?php 
							} 
							?>
								<br>
								<div class="table-responsive" style="min-height:150px;" border="1">
										<table class="table no-margin">
										  <thead>
										  <tr>
											<th>&nbsp;</th>
											<th>EXCEL FILE</th>
											<th>AMOUNT</th>
											<th>ACTION</th>
										  </tr>
										  <?php
                                          
										  if(mysqli_num_rows($query_excel)>0)
										  {
											while($one_excel=mysqli_fetch_array($query_excel))
											{  
										  ?>
											  <tr>
												<td>&nbsp;</td>
												<td><?php echo $one_excel["bill_no"];?></td>
												<td><?php echo $one_excel["invoice_excel_upload"];?></td>
												<td><?php echo $one_excel["total_amt"];?></td>
												<td>
												<a class="btn btn-success" href="invoice_excel/<?php echo $one_excel["invoice_excel_upload"];?>" target="_blank"style="width:150px;font-size:20px;">Download</a>
												&nbsp;
												<button type="button" class="btn btn-danger delete_direct_perfoma_excel"  id="<?php echo $one_excel["bill_no"];?>" style="width:150px;font-size:20px;">Delete</button>
												</td>
											  </tr>
										  <?php 
										    }
										   }
										   ?>
										  </thead>
										  <tbody>
										  
										  </tbody>
										</table>
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
	$('#invoice_date').datepicker({
		  autoclose: true,
		  format: 'dd/mm/yyyy',
		  endDate: '-1d'
	});
});


function get_table_after_update(id){
    id = (typeof id == "undefined")?'':id;
    var billData = '';
    
	billData = '&action_type=get_table_after_update&id='+id;			
   
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_invoice_excel_upload.php',
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

$(document).on("blur","#total_amt",function(){
    id = (typeof id == "undefined")?'':id;
    var billData = '';
    var total_amt=$('#total_amt').val();
	billData = '&action_type=change_amt_in_word&total_amt='+total_amt;			
   
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_invoice_excel_upload.php',
        data: billData,
		dataType:'JSON',
        success:function(msg){
			
          $('#txt_amt_in_word').val(msg.get_total_amt_in_word);
		}
    });
});

$(document).on("click",".delete_direct_perfoma_excel",function(){
    
    var bill_no=$(this).attr("id");
    var txt_trf_no=$("#txt_trf_no").val();
	billData = '&action_type=delete_direct_perfoma_excel&bill_no='+bill_no;			
   
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_invoice_excel_upload.php',
        data: billData,
		dataType:'JSON',
        success:function(msg){
          window.location.href="<?php $base_url; ?>span_invoice_excel_upload.php?chk_array="+txt_trf_no;
		}
    });
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
		
		
		
});

$("input[name='in_or_ex']").change(
    function(e)
    {
		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		var in_or_ex=$( 'input[name=in_or_ex]:checked' ).val();
		var txt_trf_no=$("#txt_trf_no").val();
		var txt_job_no=$("#txt_job_no").val();
		$('#hidden_gst_in_ex').val(in_or_ex);
		
});

function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'upload_direct_perfoma_excel') {		
				
				var invoice_date = $('#invoice_date').val(); 
				var gst_no = $('#gst_no').val(); 
				var hidden_gst_type = $('#hidden_gst_type').val(); 
				var hidden_gst_in_ex = $('#hidden_gst_in_ex').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_igst = $('#txt_igst').val(); 
				var txt_grand = $('#txt_grand').val(); 
				var txt_amt_in_word = $('#txt_amt_in_word').val(); 
				var total_amt = $('#total_amt').val();
				var bill_no = $('#bill_no').val();
				var hsn_codes = $('#hsn_codes').val();
				var txt_sub_total = $('#txt_sub_total').val();
				var txt_discount_percent = $('#txt_discount_percent').val();
				var txt_discount_amount = $('#txt_discount_amount').val();
				var other_customer_name = $('#other_customer_name').val();
				var other_customer_address = $('#other_customer_address').val();
				var other_customer_gst_no = $('#other_customer_gst_no').val();
				var hidden_perfoma_no = $('#hidden_perfoma_no').val();
				var txt_bill_to=$( 'input[name=txt_bill_to]:checked' ).val();
				
				var test_ids_array=[];
				var test_name_array=[];
				var test_qty_array=[];
				var test_rates_array=[];
				var test_amnt_array=[];
				var test_mate_array=[];
				var hidden_agency= $('#hidden_agency').val();
				
				billData = '&action_type='+type+'&id='+id+'&invoice_date='+invoice_date+'&hidden_gst_type='+hidden_gst_type+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_igst='+txt_igst+'&txt_grand='+txt_grand+'&txt_amt_in_word='+txt_amt_in_word+'&total_amt='+total_amt+'&hidden_agency='+hidden_agency+'&gst_no='+gst_no+'&test_ids_array='+test_ids_array+'&test_name_array='+test_name_array+'&test_qty_array='+test_qty_array+'&test_rates_array='+test_rates_array+'&test_amnt_array='+test_amnt_array+'&hidden_gst_in_ex='+hidden_gst_in_ex+'&hsn_codes='+hsn_codes+'&bill_no='+bill_no+'&txt_sub_total='+txt_sub_total+'&txt_discount_percent='+txt_discount_percent+'&txt_discount_amount='+txt_discount_amount+'&txt_bill_to='+txt_bill_to+'&test_mate_array='+test_mate_array;
				
	
	}
	else{
			
	
				billData = 'action_type='+type+'&id='+id;
    }
	
	   form_data = new FormData();
		var acb = $('#txt_excel').val();
	
		if(acb !=""){
		form_data.append("file", document.getElementById('txt_excel').files[0]);
		
		}else{
			alert("Upload Excel First...");
			return false;
		}
		
		if(hidden_gst_type ==""){
			alert("Select GST First...");
			return false;
		}
		
		
		form_data.append("action_type", "upload_direct_perfoma_excel");
		form_data.append("invoice_date", invoice_date);
		form_data.append("hidden_gst_type", hidden_gst_type);
		form_data.append("txt_cgst", txt_cgst);
		form_data.append("txt_sgst", txt_sgst);
		form_data.append("txt_igst", txt_igst);
		form_data.append("txt_grand", txt_grand);
		form_data.append("txt_amt_in_word", txt_amt_in_word);
		form_data.append("total_amt", total_amt);
		form_data.append("hidden_agency", hidden_agency);
		form_data.append("gst_no", gst_no);
		form_data.append("test_ids_array", test_ids_array);
		form_data.append("test_name_array", test_name_array);
		form_data.append("test_qty_array", test_qty_array);
		form_data.append("test_rates_array", test_rates_array);
		form_data.append("test_amnt_array", test_amnt_array);
		form_data.append("hidden_gst_in_ex", hidden_gst_in_ex);
		form_data.append("hsn_codes", hsn_codes);
		form_data.append("bill_no", bill_no);
		form_data.append("txt_sub_total", txt_sub_total);
		form_data.append("txt_discount_percent", txt_discount_percent);
		form_data.append("txt_discount_amount", txt_discount_amount);
		form_data.append("txt_bill_to", txt_bill_to);
		form_data.append("other_customer_name", other_customer_name);
		form_data.append("other_customer_address", other_customer_address);
		form_data.append("other_customer_gst_no", other_customer_gst_no);
		form_data.append("test_mate_array", test_mate_array);
		form_data.append("hidden_perfoma_no", hidden_perfoma_no);
		
    $.ajax({
        url : "<?php $base_url; ?>save_span_invoice_excel_upload.php",
		type: "POST",
		dataType:'JSON',
		data : form_data,
		processData: false,
		contentType: false,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(data){
			document.getElementById("overlay_div").style.display="none";
			alert("Successfully Saved..");
		    window.location.href="<?php $base_url; ?>list_of_completed_perfoma_for_biller.php";
			
        }
    });
  
}
$("input[name='txt_bill_to']").change(
    function(e)
    {
		var txt_bill_to=$( 'input[name=txt_bill_to]:checked' ).val();
		if(txt_bill_to=="2"){
			$("#bill_to_hide_show").show();
			$("#other_customer_name").val("");
			$("#other_customer_address").val("");
			$("#other_customer_gst_no").val("");
		}else{
			$("#bill_to_hide_show").hide();
		}	
});
</script>
