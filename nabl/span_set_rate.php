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



	$txt_trf_no= $_GET["trf_no"];
	$txt_jobs= $_GET["job_no"];

	// to get job for agency id
$sel_job="select * from job where `trf_no`='$txt_trf_no'";
$query_job= mysqli_query($conn,$sel_job);
$result_job=mysqli_fetch_array($query_job);
$get_agency_id= $result_job["agency"];

$sel_agency="select * from agency_master where `agency_id`=".$get_agency_id;
$query_agency= mysqli_query($conn,$sel_agency);
$result_agency=mysqli_fetch_array($query_agency);
$get_agency_gst_no= $result_agency["agency_gstno"];

// code for get test by report no and job no
 $select_test_wise="select * from test_wise_material_rate where `trf_no`='$txt_trf_no' AND `job_no`='$txt_jobs'";
 $select_test_wise_query=mysqli_query($conn,$select_test_wise);

 // get_estimate if available
 $sel_estiamte="select * from estimate_total_span where `trf_no`='$txt_trf_no' AND `job_no`='$txt_jobs'";

 $estiamte_query= mysqli_query($conn,$sel_estiamte);
 if(mysqli_num_rows($estiamte_query) > 0){

	 $get_estimate= mysqli_fetch_array($estiamte_query);
	 $get_rate_type= $get_estimate["rate_type"];
	 $get_gst_type= $get_estimate["gst_type"];
	 $get_c_gst_amt= $get_estimate["c_gst_amt"];
	 $get_s_gst_amt= $get_estimate["s_gst_amt"];
	 $get_i_gst_amt= $get_estimate["i_gst_amt"];
	 $get_grand_total= $get_estimate["grand_total"];
	 $get_total_amount= $get_estimate["total_amt"];
	 $get_total_amt_in_word= $get_estimate["total_amt_in_word"];
	 $hsn_codes= $get_estimate["hsn_codes"];
	 $estimate_perfoma_no= $get_estimate["perfoma_no"];


	 $is_estimate_avail="available";

	 $gst_in_or_ex= $get_estimate["gst_in_or_ex"];
	 $test_name= explode(",",$get_estimate["test_name"]);
	 $test_ids= explode(",",$get_estimate["test_ids"]);
	 $test_qty= explode(",",$get_estimate["test_qty"]);
	 $test_rates= explode(",",$get_estimate["test_rates"]);
	 $test_totals= explode(",",$get_estimate["test_totals"]);

 }else{
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
 }



		 $sel_estiamte_for_perfoma_no="select * from estimate_total_span WHERE perfoma_no NOT LIKE '%-%' ORDER BY est_id DESC";
		 $query_estiamte_for_perfoma_no = mysqli_query($conn, $sel_estiamte_for_perfoma_no);

		 if (mysqli_num_rows($query_estiamte_for_perfoma_no) > 0)
		 {
			$result_estiamte_for_perfoma_no = mysqli_fetch_assoc($query_estiamte_for_perfoma_no);
			$explode_perfoma_no= explode("/",$result_estiamte_for_perfoma_no["perfoma_no"]);

			$first_explode=$explode_perfoma_no[0];
			$second_explode=$explode_perfoma_no[1];
			$third_explode=$explode_perfoma_no[2];
			$fourth_explode=$explode_perfoma_no[3];
			$l_trim_fourth_explode= ltrim($fourth_explode,"0");
			$plus_of_perfoma= intval($l_trim_fourth_explode)+1;
			$final_perfoma_no= sprintf('%04d', $plus_of_perfoma);

			$sel_year="select * from fyearmaster where `fy_isactive`=0";
			$query_year = mysqli_query($conn, $sel_year);
			$result_year = mysqli_fetch_array($query_year);
			$year_name=$result_year["fy_name"];
			$today_date=date("Ymd");

			$get_sequence=$result_estiamte_for_perfoma_no["estimate_sequence_maintain"];
			$plus_squence= intval($get_sequence)+1;

			$set_perfoma_no= $first_explode."/".$year_name."/".$today_date."/".$final_perfoma_no;
		}
		else
		{
			$sel_year="select * from fyearmaster where `fy_isactive`=0";
			$query_year = mysqli_query($conn, $sel_year);
			$result_year = mysqli_fetch_array($query_year);
			$year_name=$result_year["fy_name"];
			$today_date=date("Ymd");

			$set_perfoma_no= "MES/".$year_name."/".$today_date."/0001";
			$plus_squence="1";
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
					Perfoma
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
											<input type="text" class="form-control" value="<?php echo $_GET['trf_no'];?>" id="txt_trf_no" name="txt_trf_no" disabled>
										  </div>



											<div class="col-sm-3">

													<input type="text" class="form-control" value="<?php echo $_GET['job_no'];?>" id="txt_job_no" name="txt_job_no" disabled>
											</div>


											<div class="col-sm-3">
												<?php
												$set_explode=explode("/",$_GET['report_no']);
												$get_invoice_no= $set_explode[2].$set_explode[3];
												?>
													<input type="text" class="form-control" value="<?php echo $_GET['trf_no'];?>" id="txt_invoice_no" name="txt_invoice_no" disabled>
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
														<option value="" <?php if($get_rate_type==""){echo "selected";}?>>Select Rate</option>
														<option value="0" <?php if($get_rate_type=="0"){echo "selected";}?>>Government</option>
														<option value="1" <?php if($get_rate_type=="1"){echo "selected";}?>>Private</option>
														<option value="2" <?php if($get_rate_type=="2"){echo "selected";}?>>Other</option>

													</select>
												</div>
											</div>
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="gst_no" id="gst_no" value="<?php echo $get_agency_gst_no;?>">
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="hsn_codes" id="hsn_codes" value="<?php echo $hsn_codes;?>">
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="perfoma_no" id="perfoma_no" value="<?php if($estimate_perfoma_no!="") { echo $estimate_perfoma_no; }else{ echo $set_perfoma_no; }?>" >
												<input type="hidden"  class="form-control" name="squence_no" id="squence_no" value="<?php echo $plus_squence;?>" >
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
											<th>Qty</th>
											<th>Rate</th>
											<th>Amount</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php

											if($is_estimate_avail=="not_available")
											{
											$get_total_amt=0;

											if(mysqli_num_rows($select_test_wise_query) > 0){

											while($get_test=mysqli_fetch_array($select_test_wise_query)){

											$get_total_amt += $get_test["amt"];

											$sel_test_name="select * from test_master where `test_id`=".$get_test["test_id"];
											$sel_test_query=mysqli_query($conn,$sel_test_name);
											$get_test_record=mysqli_fetch_array($sel_test_query);
										  ?>
										  <tr>
											<td>
											<input type="hidden" name="test_id[]" class="class_test_id" id="testid_<?php echo $get_test['test_wise_id'];?>" value="<?php echo $get_test["test_id"];?>">
											<input type="text" name="test_name[]" class="form-control class_test" id="test_<?php echo $get_test['test_wise_id'];?>" value="<?php echo $get_test_record["test_name"];?>" >
											</td>
											<td>
											<input type="text" name="qty[]" class="form-control class_qty" id="qty_<?php echo $get_test['test_wise_id'];?>" value="<?php echo $get_test['qty']; ?>" >
											</td>
											<td>
											<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_<?php echo $get_test['test_wise_id'];?>" value="<?php echo $get_test['rate']; ?>">
											</td>
											<td>
											  <input type="text" name="amt[]" class="form-control class_amnt" id="amt_<?php echo $get_test['test_wise_id'];?>" value="<?php echo $get_test['amt']; ?>" disabled>
											</td>
										  </tr>
										<?php

										} }

										  }
										  if($is_estimate_avail=="available")
											{
												foreach($test_name as $one_key => $one_tests)
												{ ?>

													<tr>
													<td>
													<input type="hidden" name="test_id[]" class="class_test_id" id="testid_<?php echo $one_key;?>" value="<?php echo $test_ids[$one_key];?>">
													<input type="text" name="test_name[]" class="form-control class_test" id="test_<?php echo $one_key;?>" value="<?php echo $one_tests; ?>" >
													</td>
													<td>
													<input type="text" name="qty[]" class="form-control class_qty" id="qty_<?php echo $one_key;?>" value="<?php echo $test_qty[$one_key]; ?>" >
													</td>
													<td>
													<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_<?php echo $one_key;?>" value="<?php echo $test_rates[$one_key]; ?>">
													</td>
													<td>
													  <input type="text" name="amt[]" class="form-control class_amnt" id="amt_<?php echo $one_key;?>" value="<?php echo $test_totals[$one_key]; ?>" disabled>
													</td>
													</tr>


												<?php
												}
											}

										?>
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
									<input type="text" name="txt_cgst" class="form-control" id="txt_cgst" value="<?php echo $get_c_gst_amt;?>" disabled>
									</div>

									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">SGST AMONUT:</label>
									</div>

									<div class="col-md-2">
									<input type="text" name="txt_sgst" class="form-control" id="txt_sgst" value="<?php echo $get_s_gst_amt;?>" disabled>
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
									<input type="text" name="txt_grand" class="form-control" id="txt_grand" value="<?php echo $get_grand_total;?>" disabled>
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
									<!--<button type="button" class="btn btn-info"  onclick="addData('add_estimate')" name="btn_add_data" id="btn_add_data" style="width:100px;font-size:20px;" >Save</button>-->

									<button type="button" class="btn btn-info"  onclick="addData('save_next_estimate_only_save')" name="btn_add_data" id="btn_add_data" style="width:150px;font-size:20px;" >Save</button>

									<a href="matt_perfoma_bill_print.php?trf_no=<?php echo $get_estimate['trf_no'];?>&&job_no=<?php echo $get_estimate['job_no'];?>" class="btn btn-info" title="" target="_blank" style="width:150px;font-size:20px;"><span class="glyphicon glyphicon-question-list"></span> Print</a>

									<!--<button type="button" class="btn btn-info"  onclick="addData('save_next_estimate')" name="btn_add_data" id="btn_add_data" style="width:150px;font-size:20px;" >Next</button>-->
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
	$('#invoice_date').datepicker({
		  autoclose: true,
		  format: 'dd/mm/yyyy',
		  endDate: '-1d'
	});

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
				url : "<?php $base_url; ?>save_span_set_rate.php",
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
				url : "<?php $base_url; ?>save_span_set_rate.php",
				type: "POST",
				data : postData,
				dataType:'JSON',
				success: function(data)
				 {
					$('#perfoma_no').val(data.set_perfoma_no);
					$('#squence_no').val(data.plus_squence);
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
		var txt_trf_no=$("#txt_trf_no").val();
		var total_grand_amnt=0;
		$(".class_amnt").each(function () {
			total_grand_amnt += parseInt($(this).val());
		});
					var txt_job_no=$("#txt_job_no").val();
					var send= "0"+"|"+txt_trf_no+"|"+txt_job_no+"|"+gst_type+"|"+in_or_ex+"|"+total_grand_amnt;
					get_table_after_update(send);

});

$("input[name='in_or_ex']").change(
    function(e)
    {
		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		var in_or_ex=$( 'input[name=in_or_ex]:checked' ).val();
		var txt_trf_no=$("#txt_trf_no").val();
		var txt_job_no=$("#txt_job_no").val();
		$('#hidden_gst_in_ex').val(in_or_ex);

		var total_grand_amnt=0;
		$(".class_amnt").each(function () {
			total_grand_amnt += parseInt($(this).val());
		});
					var send= "0"+"|"+txt_trf_no+"|"+txt_job_no+"|"+gst_type+"|"+in_or_ex+"|"+total_grand_amnt;
					get_table_after_update(send);

});
// save estimate_date

function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_estimate' || 'save_next_estimate' || 'save_next_estimate_only_save') {
				var txt_trf_no = $('#txt_trf_no').val();
				var txt_job_no = $('#txt_job_no').val();
				var txt_invoice_no = $('#txt_invoice_no').val();
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
				var squence_no = $('#squence_no').val();
				var perfoma_no = $('#perfoma_no').val();
				var hsn_codes = $('#hsn_codes').val();

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

				var hidden_agency= $('#hidden_agency').val();
				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&txt_invoice_no='+txt_invoice_no+'&invoice_date='+invoice_date+'&select_rate='+select_rate+'&hidden_gst_type='+hidden_gst_type+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_igst='+txt_igst+'&txt_grand='+txt_grand+'&txt_amt_in_word='+txt_amt_in_word+'&total_amt='+total_amt+'&hidden_agency='+hidden_agency+'&gst_no='+gst_no+'&test_ids_array='+test_ids_array+'&test_name_array='+test_name_array+'&test_qty_array='+test_qty_array+'&test_rates_array='+test_rates_array+'&test_amnt_array='+test_amnt_array+'&hidden_gst_in_ex='+hidden_gst_in_ex+'&hsn_codes='+hsn_codes+'&squence_no='+squence_no+'&perfoma_no='+perfoma_no;

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

		if(hidden_gst_type !="without_gst")
		{
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
				url: '<?php $base_url; ?>save_span_set_rate.php',
				data: billData,
				success:function(msg){
					if(type=="save_next_estimate"){
					window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?a=eng&&trf_no="+txt_trf_no+"&&job_no="+txt_job_no;

					}else if(type=="save_next_estimate_only_save"){
					window.location.href="<?php echo $base_url; ?>span_set_rate.php?trf_no="+txt_trf_no+"&&job_no="+txt_job_no;

					}else{
					window.location.href="<?php echo $base_url; ?>perfoma_list_rec_two.php?a=rec2";
					}
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
				if(type=="save_next_estimate"){
					window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?a=eng&&trf_no="+txt_trf_no+"&&job_no="+txt_job_no;

					}else if(type=="save_next_estimate_only_save"){
					window.location.href="<?php echo $base_url; ?>span_set_rate.php?trf_no="+txt_trf_no+"&&job_no="+txt_job_no;

					}else{
					window.location.href="<?php echo $base_url; ?>perfoma_list_rec_two.php?a=rec2";
					}
			}
				 });



		}


}
</script>
