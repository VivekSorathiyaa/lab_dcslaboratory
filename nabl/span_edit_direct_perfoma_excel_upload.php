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
	 if(isset($_POST["txt_perfoma"]))
	 {
		 $txt_perfoma_no=$_POST["txt_perfoma"];
		 $update_files="update estimate_total_span set `perfoma_excel_upload`='' where `perfoma_no`='$txt_perfoma_no'";
		 mysqli_query($conn, $update_files);
	 }
	 
	 $perfoma_nos=$_GET["perfoma_no"];
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
 
 
	
		 
		 $sel_estiamte_for_perfoma_no="select * from estimate_total_span WHERE perfoma_no='$perfoma_nos' ORDER BY est_id DESC";
		 $query_estiamte_for_perfoma_no = mysqli_query($conn, $sel_estiamte_for_perfoma_no);
		 
		 if (mysqli_num_rows($query_estiamte_for_perfoma_no) > 0) 
		 {
			$result_estiamte_for_perfoma_no = mysqli_fetch_array($query_estiamte_for_perfoma_no);
			$perfoma_no=$result_estiamte_for_perfoma_no["perfoma_no"];
			$agency_id=$result_estiamte_for_perfoma_no["agency_id"];
			$agree_no=$result_estiamte_for_perfoma_no["agreement_no"];
			$reference_no=$result_estiamte_for_perfoma_no["reference_no"];
			$estimate_date=$result_estiamte_for_perfoma_no["estimate_date"];
			$name_of_work=$result_estiamte_for_perfoma_no["name_of_work"];
			$customer_name=$result_estiamte_for_perfoma_no["customer_name"];
			$rate_type=$result_estiamte_for_perfoma_no["rate_type"];
			$gst_no=$result_estiamte_for_perfoma_no["gst_no"];
			$hsn_codes=$result_estiamte_for_perfoma_no["hsn_codes"];
			$gst_type=$result_estiamte_for_perfoma_no["gst_type"];
			$gst_in_or_ex=$result_estiamte_for_perfoma_no["gst_in_or_ex"];
			$c_gst_amt=$result_estiamte_for_perfoma_no["c_gst_amt"];
			$s_gst_amt=$result_estiamte_for_perfoma_no["s_gst_amt"];
			$i_gst_amt=$result_estiamte_for_perfoma_no["i_gst_amt"];
			$grand_total=$result_estiamte_for_perfoma_no["grand_total"];
			$total_amt=$result_estiamte_for_perfoma_no["total_amt"];
			$total_amt_in_word=$result_estiamte_for_perfoma_no["total_amt_in_word"];
			$fileing=$result_estiamte_for_perfoma_no["perfoma_excel_upload"];
	
			
		}
		else
		{
			
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
					Add Direct Perfoma
				</h1>
			</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									<div class="col-sm-4">
									<label for="inputEmail3" class="col-sm-2 control-label">Agency:</label>
									</div>
									
									<div class="col-sm-2">
									<label for="inputEmail3" class="col-sm-2 control-label">Agreement No.</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Reference No.</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label"> Date:</label>
									</div>
								</div>
								<div class="row">
									
										  <div class="col-sm-3">
											<select class="form-control  select2 col-sm-12" data-placeholder="Select Agency" tabindex="9"  id="select_agency" name="select_agency" required >
														<option value="">Select Agency</option>
														<?php 
															$cat_sql = "select * from agency_master where `isdeleted`=0";
														
															$cat_result = mysqli_query($conn, $cat_sql);

																while($cat_row = mysqli_fetch_assoc($cat_result)) {
															
															?>
															<option value="<?php echo $cat_row['agency_id']; ?>" <?php if($agency_id==$cat_row['agency_id']){ echo "selected"; }?> >
															<?php echo $cat_row['agency_name']; ?></option>
															<?php  }?>
											 </select>
										  </div>
										  <div class="col-sm-1">
														<input type="button" value="+" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-agency">
														
										</div>
										
										  
											<div class="col-sm-2">
												
													<input type="text" class="form-control"  id="agreement_no" name="agreement_no" value="<?php echo $agree_no;?>">
											</div>
										
										  
											<div class="col-sm-3">
												
													<input type="text" class="form-control" value="<?php echo $reference_no;?>" id="reference_no" name="reference_no" >
											</div>
											
											<div class="col-md-3">
													<input type="text"  class="form-control" name="invoice_date" id="invoice_date" value="<?php echo date('d/m/Y',strtotime($estimate_date))?>">
											
											</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-sm-1">
									<label for="inputEmail3" class="col-sm-2 control-label">Name Of Work:</label>
									</div>
									
									<div class="col-sm-4">
									<textarea name="name_of_work" id="name_of_work" class="form-control">
									<?php echo $name_of_work;?>
									</textarea>
									</div>
									<div class="col-sm-1">
									<label for="inputEmail3" class="col-sm-2 control-label">Customer Name:</label>
									</div>
									
									<div class="col-sm-4">
									<input type="text" class="form-control" value="<?php echo $customer_name;?>" id="customer_name" name="customer_name" >
									</div>
									
									
								</div>
								
								<br>
								<div class="row">
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Rate:</label>
									</div>
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">GST NO:</label>
									</div>
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">HSN/SAC Code:</label>
									</div>
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Perfoma No:</label>
									</div>
								</div>
								
								<div class="row">
									
										  <div class="col-md-3">
											<div class="form-group">
												
												<div class="col-sm-12">
													<select class="form-control " name="select_rate" id="select_rate" >
														<option value="" <?php if($rate_type==""){echo "selected";}?>>Select Rate</option>
														<option value="0" <?php if($rate_type=="0"){echo "selected";}?>>Government</option>
														<option value="1" <?php if($rate_type=="1"){echo "selected";}?>>Private</option>
														<option value="2" <?php if($rate_type=="2"){echo "selected";}?>>Other</option>
														
													</select>
												</div>
											</div>
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="gst_no" id="gst_no" value="<?php echo $gst_no;?>">
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="hsn_codes" id="hsn_codes" value="<?php echo $hsn_codes;?>">
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="perfoma_no" id="perfoma_no" value="<?php echo $perfoma_no;?>" disabled>
												
										  </div>
								</div>
								<br>
								<div class="row" style="text-align:center;font-size:40px;">
								<div class="col-sm-12">
								BY EXCEL 
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
											<th>File :
											</th>
											<th><?php echo '<a class="btn btn-primary" target="_blank" href="uploaded_excel/'.$fileing.'"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;View File</a>';?>
											</th>
											<th>
											</th>
										  </tr>
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
											<th>
											<input type="file" name="txt_excel" id="txt_excel" class="form-control">
											</th>
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
							<input type="hidden" name="hidden_gst_type" id="hidden_gst_type" value="without_gst"> 
							<input type="hidden" name="hidden_gst_in_ex" id="hidden_gst_in_ex" value=""> 
								<div class="row">
									<div class="col-sm-2">
									<label for="inputEmail3" class="control-label">GST TYPE:</label>
									</div>
									
									<div class="col-sm-9">
										<input type="radio" style="width:33px;height:25px;" name="gst_type" value="with_gst" <?php if($gst_type=="with_gst"){ echo "checked";} ?>><span style="font-size:20px;" ><b>With GST</b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="without_gst" <?php if($gst_type=="" || $gst_type=="without_gst"){ echo "checked";} ?>><span style="font-size:20px;"><b>Without GST<b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="with_igst" <?php if($gst_type!="" && $gst_type=="with_igst"){ echo "checked";} ?>><span style="font-size:20px;"><b>With IGST<b></span>
									</div>
								</div>
								<br>
								<div class="row" id="gst_hide_show" style="<?php if($gst_type=="" || $gst_type=="without_gst"){ echo "display:none";}else{ echo "display:block";} ?>">
								
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
									<input type="text" name="txt_cgst" class="form-control" id="txt_cgst" value="<?php echo $c_gst_amt;?>" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">SGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_sgst" class="form-control" id="txt_sgst" value="<?php echo $s_gst_amt;?>" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">IGST AMONUT:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_igst" class="form-control" id="txt_igst" value="<?php echo $i_gst_amt;?>" >
									</div>
									
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">GRAND TOTAL:</label>
									</div>
									
									<div class="col-md-2">
									<input type="text" name="txt_grand" class="form-control" id="txt_grand" value="<?php echo $grand_total;?>" >
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
									<input type="text" name="txt_amt_in_word" class="form-control" id="txt_amt_in_word" value="<?php if($total_amt_in_word !=""){ echo $total_amt_in_word;}else{ echo numtowords($total_amt);} ?>" >
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="control-label">Total Amount:</label>
									</div>
									
									<div class="col-md-3">
									<input type="text" name="total_amt" class="form-control" id="total_amt" value="<?php if($total_amt !=""){ echo $total_amt;}else{ echo $total_amt;} ?>" >
									</div>
								</div>
								<br>
								
								<div class="row">
									<div class="col-md-3">&nbsp;</div>
									<div class="col-md-6">
									
									 <button type="button" class="btn btn-info"  onclick="addData_for_excel('direct_perfoma_excel_upload_update')" name="btn_add_data" id="btn_add_data" style="width:150px;font-size:20px;" >Upload Excel</button>
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
                <h4 class="modal-title">Add New Agency</h4>
              </div>
				<form id="form_agency" name="form_agency" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<div class="col-md-6">													
											<input type="text" class="form-control" PlaceHolder="Enter Agency Name." name="agency_name" id="add_agency_name" required >
										</div>
										
										<div class="col-md-6">												
											<input type="text" class="form-control"  PlaceHolder="Enter Agency Mobile No." name="agency_mobile" id="add_agency_mobile" required >
										</div>
									</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<textarea name="add_agency_address" placeholder="Enter Agency Address." id="add_agency_address" class="col-sm-12 form-control"required ></textarea>
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
													<input type="text" class="form-control" placeholder="Enter Agency Pincode" name="add_agency_pincode" id="add_agency_pincode" required >
												</div>
												
												<div class="col-md-6">													
													<input type="text" class="form-control" placeholder="Enter Agency EmailId" name="add_agency_email" id="add_agency_email" required >
												</div>
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<input type="text" class="form-control" placeholder="Enter Agency GST No." name="add_agency_gstno" id="add_agency_gstno" required >
												</div>
									
												<div class="col-md-6">													
													<select class="form-control col-md-7 col-xs-12" name="add_agency_status" id="add_agency_status">
														<option  value="0">Activate</option>
														<option value="1">Deactivate</option>
													<select>			
												</div>
												</div>
												
								
											</div>
					</div>
					<div class="modal-footer">		
					
						<button type="button" class="btn btn-primary" id="btn_add_agency" name="btn_add_agency" data-dismiss="modal">Add Agency</button>
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
	
		var res_cates = select_material_category.split("|");
		var mat_id=res_cates[0];
		var mat_names=res_cates[1];
		
		var res_test = select_test.split("|");
		var test_id=res_test[0];
		var test_names=res_test[1];
		
		var fieldHTML = '<tr>';
		fieldHTML += '<td>';
		fieldHTML += '<input type="hidden" name="mt_id[]" class="class_mate_id" id="mateid_'+count_of_append+'" value="'+mat_id+'">';
		fieldHTML += '<input type="text" name="mat_name[]" class="form-control class_mate_name" id="matename_'+count_of_append+'" value="'+mat_names+'" disabled style="width:200px;font-weight:bold;">';
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
		fieldHTML += '<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_'+count_of_append+'" value="0">';
		fieldHTML += '</td>';
		
		fieldHTML += '<td>';
		fieldHTML += '<input type="text" name="amt[]" class="form-control class_amnt" id="amt_'+count_of_append+'" value="0" disabled>';
		fieldHTML += '</td>';
		
		fieldHTML += '<td>';
		fieldHTML += '<a href="JavaScript:void(0)" class="remove_button btn btn-primary" title="Remove field" style=""><b>X</b></a>';
		fieldHTML += '</td>';
		
		fieldHTML += '</tr>';
		
		//Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $('.class_tr_put').append(fieldHTML); //Add field html
        }
		
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
	});

});


$("#btn_add_agency").click(function(){
 var agency_name = $('#add_agency_name').val(); 
 var agency_mobile = $('#add_agency_mobile').val(); 
 var agency_address = $('#add_agency_address').val(); 
 var sel_agency_city = $('#add_sel_agency_city').val(); 
 var agency_pincode = $('#add_agency_pincode').val(); 
 var agency_email = $('#add_agency_email').val(); 
 var agency_gstno = $('#add_agency_gstno').val(); 
 var agency_status = $('#add_agency_status').val(); 
 var postData = '&agency_name='+agency_name+'&agency_mobile='+agency_mobile+'&agency_address='+agency_address+'&sel_agency_city='+sel_agency_city+'&agency_pincode='+agency_pincode+'&agency_email='+agency_email+'&agency_gstno='+agency_gstno+'&agency_status='+agency_status;
	
	if(agency_name!=""){
	  $.ajax({
		url : "<?php $base_url; ?>agency_Data.php",
		type: "POST",
		data : postData,
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



// on rate change

$("#select_rate").change(function(){
      var select_rate = $('#select_rate').val(); 
       var test_id_array=[];
       var test_ids_id_array=[];
       var test_total_amnt_array=[];
		$(".class_test_id").each(function () 
		{
			test_id_array.push($(this).val());
			var get_id=$(this).attr("id");
			var split_data=get_id.split("_");
			var get_rates_id= "#rate_"+split_data[1];
			var get_total_id= "#amt_"+split_data[1];
			test_ids_id_array.push(get_rates_id);
			test_total_amnt_array.push(get_total_id);
		});
		
		var test_qty_array=[];
		$(".class_qty").each(function () {
		test_qty_array.push($(this).val());
		});
	  
	  if(select_rate != ""){
      var postData = 'action_type=get_data_by_rate&select_rate='+select_rate+'&test_id_array='+test_id_array+'&test_qty_array='+test_qty_array;
	  }else{
		  alert("Select Rate First");
		  return false;
	  }		
			
			$.ajax({
				url : "<?php $base_url; ?>save_span_add_new_perfoma.php",
				type: "POST",
				data : postData,
				dataType:'JSON',
				success: function(data)
				 {
					var get_test_rates_array=data.test_wise_rate_array;
					var get_test_total_array=data.test_wise_total_array;
					
					for(var i=0; i < get_test_rates_array.length; i++) 
					{
						$(test_ids_id_array[i]).val(get_test_rates_array[i]);
						$(test_total_amnt_array[i]).val(get_test_total_array[i]);
						
						
					}
					$('input[name=in_or_ex]').prop("checked", false);
					$('input[name=gst_type]').prop("checked", false);
					$('#hidden_gst_in_ex').val("");
					$('#hidden_gst_type').val("");
				 }
			});
});	



// on invoice_date change
$(document).on("change","#invoice_date",function(){
      var invoice_date = $('#invoice_date').val(); 
	  var myDate = new Date('yyyy/mm/dd',invoice_date);
        var today = new Date();
        if ( myDate > today ) {
             alert("The date is wrong.");
            return false;
        }
      var postData = 'action_type=set_perfoma_no_by_invoice_date&invoice_date='+invoice_date;
	  	    
			$.ajax({
				url : "<?php $base_url; ?>save_span_add_new_perfoma.php",
				type: "POST",
				data : postData,
				dataType:'JSON',
				success: function(data)
				 {
					$('#perfoma_no').val(data.set_perfoma_no);
					
				 }
			});
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
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);
	  
	  $("#amt_"+split_data[1]).val(txt_amnts); 
	  $('input[name=in_or_ex]').prop("checked", false);
	  $('#hidden_gst_in_ex').val("");
});

// on qty change

$(document).on("blur",".class_qty",function(){
	
      var get_qty = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_rate= $("#rate_"+split_data[1]).val();
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);
	  
	  $("#amt_"+split_data[1]).val(txt_amnts);
	  $('input[name=in_or_ex]').prop("checked", false);
	  $('#hidden_gst_in_ex').val("");
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
		var total_grand_amnt=0;
		$(".class_amnt").each(function () {
			total_grand_amnt += parseInt($(this).val());
		});
					var txt_job_no="";
					var send= "0"+"|"+txt_trf_no+"|"+txt_job_no+"|"+gst_type+"|"+in_or_ex+"|"+total_grand_amnt;
					get_table_after_update(send);
		
});
$("input[name='in_or_ex']").change(
    function(e)
    {
		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		var in_or_ex=$( 'input[name=in_or_ex]:checked' ).val();
		var txt_trf_no=""
		var txt_job_no=""
		$('#hidden_gst_in_ex').val(in_or_ex);
		
		var total_grand_amnt=0;
		$(".class_amnt").each(function () {
			total_grand_amnt += parseInt($(this).val());
		});
					var send= "0"+"|"+txt_trf_no+"|"+txt_job_no+"|"+gst_type+"|"+in_or_ex+"|"+total_grand_amnt;
					get_table_after_update(send);
		
});

function addData_for_excel(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'direct_perfoma_excel_upload_update') {
				var txt_trf_no = ""; 
				var txt_job_no = ""; 
				var txt_invoice_no = ""; 
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
				
				var test_ids_array=[];
				var test_name_array=[];
				var test_qty_array=[];
				var test_rates_array=[];
				var test_amnt_array=[];
				var test_mate_array=[];
				var test_mate_id_array=[];
				var customer_name= $("#customer_name").val();									
				var hidden_agency= $("#select_agency").val();									
				var name_of_work= $("#name_of_work").val();									
				var agreement_no= $("#agreement_no").val();									
				var reference_no= $("#reference_no").val();	
				
				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&txt_invoice_no='+txt_invoice_no+'&invoice_date='+invoice_date+'&select_rate='+select_rate+'&hidden_gst_type='+hidden_gst_type+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_igst='+txt_igst+'&txt_grand='+txt_grand+'&txt_amt_in_word='+txt_amt_in_word+'&total_amt='+total_amt+'&hidden_agency='+hidden_agency+'&gst_no='+gst_no+'&test_ids_array='+test_ids_array+'&test_name_array='+test_name_array+'&test_qty_array='+test_qty_array+'&test_rates_array='+test_rates_array+'&test_amnt_array='+test_amnt_array+'&hidden_gst_in_ex='+hidden_gst_in_ex+'&hsn_codes='+hsn_codes+'&perfoma_no='+perfoma_no+'&test_mate_array='+test_mate_array+'&test_mate_id_array='+test_mate_id_array+'&customer_name='+customer_name+'&name_of_work='+name_of_work+'&agreement_no='+agreement_no+'&reference_no='+reference_no;
				
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
		
		
					form_data = new FormData();
					var acb = $('#txt_excel').val();
					if(acb !=""){
					form_data.append("file", document.getElementById('txt_excel').files[0]);
					
					}
					
				
					
					form_data.append("action_type", type);
					form_data.append("txt_trf_no", txt_trf_no);
					form_data.append("txt_job_no", txt_job_no);
					form_data.append("txt_invoice_no", txt_invoice_no);
					form_data.append("invoice_date", invoice_date);
					form_data.append("select_rate", select_rate);
					form_data.append("hidden_gst_type", hidden_gst_type);
					form_data.append("txt_cgst", txt_cgst);
					form_data.append("txt_sgst", txt_sgst);
					form_data.append("txt_igst", txt_igst);
					form_data.append("txt_grand", txt_grand);
					form_data.append("txt_amt_in_word", txt_amt_in_word);
					form_data.append("total_amt", total_amt);
					form_data.append("perfoma_no", perfoma_no);
					form_data.append("hidden_agency", hidden_agency);
					form_data.append("gst_no", gst_no);
					form_data.append("test_ids_array", test_ids_array);
					form_data.append("test_name_array", test_name_array);
					form_data.append("test_qty_array", test_qty_array);
					form_data.append("test_rates_array", test_rates_array);
					form_data.append("test_amnt_array", test_amnt_array);
					form_data.append("hidden_gst_in_ex", hidden_gst_in_ex);
					form_data.append("hsn_codes", hsn_codes);
					form_data.append("test_mate_array", test_mate_array);
					form_data.append("test_mate_id_array", test_mate_id_array);
					form_data.append("customer_name", customer_name);
					form_data.append("name_of_work", name_of_work);
					form_data.append("agreement_no", agreement_no);
					form_data.append("name_of_work", name_of_work);
					form_data.append("reference_no", reference_no);
					
					$.ajax({
					url: '<?php $base_url; ?>save_span_add_new_perfoma.php',
					type: 'POST',
					dataType:'JSON',
					data : form_data,
					processData: false,
					contentType: false,
					success:function(msg){
					if(type=="save_next_estimate"){
					window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?a=eng&&trf_no="+txt_trf_no+"&&job_no="+txt_job_no;
						
					}else if(type=="save_next_estimate_only_save"){
					alert("Successfully Saved..");
					window.location.href="<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";
						
					}else{
					window.location.href="<?php echo $base_url; ?>perfoma_list_rec_two.php?a=rec2";
					}
					}
					 });
			
		
		
	
   
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
</script>
