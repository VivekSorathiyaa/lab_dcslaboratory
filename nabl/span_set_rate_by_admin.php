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



	$txt_report= $_GET["report_no"];
	$txt_jobs= $_GET["job_no"];  

// to get job for agency id
$sel_job="select * from job where `report_no`='$txt_report'";
$query_job= mysqli_query($conn,$sel_job);
$result_job=mysqli_fetch_array($query_job);
$get_agency_id= $result_job["agency"];

// code for get test by report no and job no
$select_test_wise="select * from test_wise_material_rate where `report_no`='$txt_report' AND `job_no`='$txt_jobs'";
 $select_test_wise_query=mysqli_query($conn,$select_test_wise);
 
 // get_estimate if available
 $sel_estiamte="select * from estimate_total_span where `report_no`='$txt_report' AND `job_no`='$txt_jobs'";
 
 $estiamte_query= mysqli_query($conn,$sel_estiamte);
 if(mysqli_num_rows($estiamte_query) > 0){
	 
	 $get_estimate= mysqli_fetch_array($estiamte_query);
	 $get_rate_type= $get_estimate["rate_type"];
	 $get_gst_type= $get_estimate["gst_type"];
	 $get_c_gst_amt= $get_estimate["c_gst_amt"];
	 $get_s_gst_amt= $get_estimate["s_gst_amt"];
	 $get_grand_total= $get_estimate["grand_total"];
	 $get_total_amount= $get_estimate["total_amt"];
	 $get_total_amt_in_word= $get_estimate["total_amt_in_word"];
	 
 }else{
	 $get_rate_type="";
	 $get_gst_type="";
	 $get_c_gst_amt="";
	 $get_s_gst_amt="";
	 $get_grand_total="";
	 $get_total_amount="";
	 $get_total_amt_in_word="";
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
   
  
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		Rate Set
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Report No:</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Job No:</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Invoice No:</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Invoice Date:</label>
									</div>
								</div>
								<div class="row">
									
										  <div class="col-sm-3">
											<input type="text" class="form-control" value="<?php echo $_GET['report_no'];?>" id="txt_report_no" name="txt_report_no" >
										  </div>
										
										
										  
											<div class="col-sm-3">
												
													<input type="text" class="form-control" value="<?php echo $_GET['job_no'];?>" id="txt_job_no" name="txt_job_no" >
											</div>
										
										  
											<div class="col-sm-3">
												
													<input type="text" class="form-control" value="<?php echo $_GET['report_no'];?>" id="txt_invoice_no" name="txt_invoice_no" >
											</div>
											
											<div class="col-md-3">
													<input type="text"  class="form-control" name="invoice_date" id="invoice_date" value="<?php echo date('d/m/Y')?>">
											
											</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Rate:</label>
									</div>
								</div>
								<div class="row">
									
										  <div class="col-md-3">
											<div class="form-group">
												
												<div class="col-sm-12">
													<select class="form-control " name="select_rate" id="select_rate" >
														<option value="" <?php if($get_rate_type==""){echo "selected";}?>>Select Rate</option>
														<option value="0|<?php  echo $txt_report;?>|<?php  echo $txt_jobs;?>" <?php if($get_rate_type=="0"){echo "selected";}?>>Government</option>
														<option value="1|<?php  echo $txt_report;?>|<?php  echo $txt_jobs;?>" <?php if($get_rate_type=="1"){echo "selected";}?>>Private</option>
														<option value="2|<?php  echo $txt_report;?>|<?php  echo $txt_jobs;?>" <?php if($get_rate_type=="2"){echo "selected";}?>>Other</option>
														
													</select>
												</div>
											</div>
										  </div>
										   <div class="col-md-3">
													<input type="text"  class="form-control" name="gst_no" id="gst_no" value="<?php if($result_job['report_sent_to']=="0"){echo $result_job['client_gstno'];}else{echo $result_job['agency_gstno'];}?>">
											
											</div>
								</div>
								<br>
							<div class="panel-group">
								<div class="box box-info">
									<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<table class="table no-margin">
										  <thead>
										  <tr>
											<th>Test Name</th>
											<th>HSN Code</th>
											<th>Qty</th>
											<th>Rate</th>
											<th>Amount</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
											$get_total_amt=0;
											if(mysqli_num_rows($select_test_wise_query) > 0){ 
											
											while($get_test=mysqli_fetch_array($select_test_wise_query)){
											
											$get_total_amt += $get_test["amt"];
											
											$sel_test_name="select * from test_master where `test_id`=".$get_test["test_id"];
											$sel_test_query=mysqli_query($conn,$sel_test_name);
											$get_test_record=mysqli_fetch_array($sel_test_query);
										  ?>
										  <tr>
											<td><b><?php echo $get_test_record["test_name"];?></b></td>
											<td>
											<input type="text" name="hsn[]" class="form-control" id="hsn_<?php echo $get_test_record['hsn_code'];?>" value="<?php echo $get_test_record['hsn_code']; ?>">
											</td>
											<td>
											<input type="text" name="qty[]" class="form-control" id="qty_<?php echo $get_test['test_wise_id'];?>" value="<?php echo $get_test['qty']; ?>" disabled>
											</td>
											<td>
											<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_<?php echo $get_test['test_wise_id'];?>" value="<?php echo $get_test['rate']; ?>">
											</td>
											<td>
											  <input type="text" name="amt[]" class="form-control" id="amt_<?php echo $get_test['test_wise_id'];?>" value="<?php echo $get_test['amt']; ?>" disabled>
											</td>
										  </tr>
										<?php 
										
										} }?>
										  </tbody>
										</table>
									  </div>
									</div>
								</div>
							</div>
							<br>
							<div class="box box-info">
							<input type="hidden" name="hidden_gst_type" id="hidden_gst_type" value="without_gst"> 
								<div class="row">
									<div class="col-sm-2">
									<label for="inputEmail3" class="control-label">GST TYPE:</label>
									</div>
									
									<div class="col-sm-9">
										<input type="radio" style="width:33px;height:25px;" name="gst_type" value="with_gst" <?php if($get_gst_type=="with_gst"){ echo "checked";} ?>><span style="font-size:20px;" ><b>With GST</b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="without_gst" <?php if($get_gst_type=="" || $get_gst_type=="without_gst"){ echo "checked";} ?>><span style="font-size:20px;"><b>Without GST<b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="with_igst" <?php if($get_gst_type=="" || $get_gst_type=="with_igst"){ echo "checked";} ?>><span style="font-size:20px;"><b>With IGST<b></span>
									</div>
								</div>
								<br>
								<div class="row" id="gst_hide_show" style="<?php if($get_gst_type=="" || $get_gst_type=="without_gst"){ echo "display:none";}else{ echo "display:block";}  ?>">
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">CGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_cgst" class="form-control" id="txt_cgst" value="<?php echo $get_c_gst_amt;?>" disabled>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">SGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_sgst" class="form-control" id="txt_sgst" value="<?php echo $get_c_gst_amt;?>" disabled>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">IGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_igst" class="form-control" id="txt_igst" value="<?php echo $get_i_gst_amt;?>" disabled>
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">GRAND TOTAL:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_grand" class="form-control" id="txt_grand" value="<?php if($get_grand_total !=""){ echo $get_grand_total;}else{ echo $get_total_amt;} ?>" disabled>
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
								<div class="row">
									<div class="col-md-3">&nbsp;</div>
									<div class="col-md-3">
									<button type="button" class="btn btn-info"  onclick="addData('add_estimate')" name="btn_add_data" id="btn_add_data" style="width:100px;font-size:20px;" >Save</button>
									</div>
									<div class="col-md-3">&nbsp;</div>
									
								</div>
							</div>
							<input type="hidden" name="hidden_agency" id="hidden_agency" value="<?php echo $get_agency_id;?>">
							
							
							
							</div>
						
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>

<?php
function numtowords($num){ 
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
return $rettxt;
}
?>		  	  
<script>
$(document).ready(function(){
	

});

$('#invoice_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	});

// on rate change

$("#select_rate").change(function(){
      var select_rate = $('#select_rate').val(); 
	  var agency_id = $('#hidden_agency').val();
	  var gst_type=$( 'input[name=gst_type]:checked' ).val();
	  if(select_rate != ""){
      var postData = 'action_type=get_data_by_rate&select_rate='+select_rate+'&agency_id='+agency_id;
	  }else{
		  alert("Select Rate First");
		  return false;
	  }		
			
			$.ajax({
				url : "<?php $base_url; ?>save_span_set_rate.php",
				type: "POST",
				data : postData,
				success: function(html)
				 {
					get_table_after_update(select_rate+"|"+gst_type);
				 
				 }
			});
});	

function get_table_after_update(id){
    id = (typeof id == "undefined")?'':id;
    var billData = '';
    
	billData = '&action_type=get_table_after_update&id='+id;			
   
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_set_rate.php',
        data: billData,
		dataType:'JSON',
        success:function(msg){
          $('#display_data').html(msg.table_design);
          $('#txt_cgst').val(msg.cgst);
          $('#txt_sgst').val(msg.sgst);
		  $('#txt_igst').val(msg.igst);
          $('#txt_grand').val(msg.grand_total);
          $('#txt_amt_in_word').val(msg.get_total_amt_in_word);
          $('#total_amt').val(msg.net_total);
		  
        }
    });
}

// on rate change

$(document).on("blur",".txt_rate_class",function(){
	
      var get_rate = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_qty= $("#qty_"+split_data[1]).val();
	  var get_test_id=split_data[1];
	  var gst_type=$( 'input[name=gst_type]:checked' ).val();
	 
	  
	  
	  if(get_rate != "" && get_qty != ""&& get_test_id != ""){
      var postData = 'action_type=update_test_by_id&get_rate='+get_rate+'&get_qty='+get_qty+'&get_test_id='+get_test_id;
	  }else{
		  alert("something Wrong..");
		  return false;
	  }		
			
			$.ajax({
				url : "<?php $base_url; ?>save_span_set_rate.php",
				type: "POST",
				data : postData,
				success: function(html)
				 {
					var txt_report_no=$("#txt_report_no").val();
					var txt_job_no=$("#txt_job_no").val();
					var send= "0"+"|"+txt_report_no+"|"+txt_job_no+"|"+gst_type;
					get_table_after_update(send);
				 
				 }
			});
});

$("input[name='gst_type']").change(
    function(e)
    {
		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		if(gst_type=="with_gst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_gst");
		}else if(gst_type=="with_igst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_igst");
		}else{
			$("#gst_hide_show").hide();
			$('#hidden_gst_type').val("without_gst");
		}
		var txt_report_no=$("#txt_report_no").val();
					var txt_job_no=$("#txt_job_no").val();
					var send= "0"+"|"+txt_report_no+"|"+txt_job_no+"|"+gst_type;
					get_table_after_update(send);
		
});


// save estimate_date

function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_estimate') {
				var txt_report_no = $('#txt_report_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var txt_invoice_no = $('#txt_invoice_no').val(); 
				var invoice_date = $('#invoice_date').val(); 
					var gst_no = $('#gst_no').val(); 
				var select_rate = $('#select_rate').val(); 
				var hidden_gst_type = $('#hidden_gst_type').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_grand = $('#txt_grand').val(); 
				var txt_amt_in_word = $('#txt_amt_in_word').val(); 
				var total_amt = $('#total_amt').val();
				var hidden_agency = $('#hidden_agency').val();
				
					
				billData = '&action_type='+type+'&id='+id+'&txt_report_no='+txt_report_no+'&txt_job_no='+txt_job_no+'&txt_invoice_no='+txt_invoice_no+'&invoice_date='+invoice_date+'&select_rate='+select_rate+'&hidden_gst_type='+hidden_gst_type+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_grand='+txt_grand+'&txt_amt_in_word='+txt_amt_in_word+'&total_amt='+total_amt+'&hidden_agency='+hidden_agency+'&gst_no='+gst_no;
				
    }else{
				
	
				billData = 'action_type='+type+'&id='+id;
				
    }
	
	var gst_no = $('#gst_no').val();
		var hidden_gst_type = $('#hidden_gst_type').val(); 		
		
		if(hidden_gst_type !="without_gst")
		{
			if(gst_no==null || gst_no=="")
			{
				alert("GST No. Require..");
			}
			else
			{
					$.ajax({
				type: 'POST',
				url: '<?php $base_url; ?>save_span_set_rate.php',
				data: billData,
				success:function(msg){
					window.location.href="<?php echo $base_url; ?>superadmin_pending_estimates_of_biller.php";
				}
					 });
			}
		}
		else
		{
			 $.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_set_rate.php',
			data: billData,
			success:function(msg){
				window.location.href="<?php echo $base_url; ?>superadmin_pending_estimates_of_biller.php";
			}
				 });
          
        
   
		}
   
}
</script>
