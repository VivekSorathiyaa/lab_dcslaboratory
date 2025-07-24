<style>
.tdclass{
    border: 1px solid black;
    font-size:12px;
	 font-family: arial;
}
.test {
    border-collapse: collapse;
}
</style>

<?php include("connection.php");
		$print_id=$_GET['print_id'];
		$sel_bill_by_cheque="select * from span_bill where `cheque_id`='$print_id'";
	    $get_bill_by_cheque=mysqli_query($conn,$sel_bill_by_cheque);
		
		
		//select Check
		$sel_cheque="select * from cheque where `cheque_id`='$print_id'";
	    $get_cheque=mysqli_query($conn,$sel_cheque);
		$get_one_cheque=mysqli_fetch_array($get_cheque);
		
		//select division
		$division_query="select * from division WHERE `div_id`='$get_one_cheque[division_id]'";
		$division_result=mysqli_query($conn,$division_query);
		$division_row=mysqli_fetch_assoc($division_result);
			
		
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>




<table align="center" border="1" width="100%"class="table table-bordered table-striped" style="width:100%;">
	<tr>
	<td colspan="3" style="padding:10px;"><b>Cheque No:</b></td>
	<td colspan="2" style="padding:10px;"><b><?php echo $get_one_cheque["cheque_no"];?></b></td>
	</tr>
	
	<tr>
	<td colspan="3" style="padding:10px;"><b>Cheque Date:</b></td>
	<td colspan="2" style="padding:10px;"><b><?php echo date("d-m-Y", strtotime($get_one_cheque['cheque_date']));?>
	</b></td>
	</tr>
	
	<tr>
	<td colspan="3" style="padding:10px;"><b>Cheque Amount:</b></td>
	<td colspan="2" style="padding:10px;"><b><?php echo $get_one_cheque["cheque_amount"];?></b></td>
	</tr>
	
	<tr>
	<td colspan="3" style="padding:10px;"><b>Division Name:</b></td>
	<td colspan="2" style="padding:10px;"><b><?php echo $division_row["div_name"];?></b></td>
	</tr>
	<tr>
			<th style="text-align:center;padding:5px;">Serial No</th>
			<th style="text-align:center;padding:5px;">Bill No</th>
			<th style="text-align:center;padding:5px;">Bill Date</th>	
			<th style="text-align:center;padding:5px;">Name Of Work</th>
			<th style="text-align:center;padding:5px;">Bill Total</th>
		</tr>
		
	<?php
	$sel_counting=1;
	while($get_one_bill=mysqli_fetch_array($get_bill_by_cheque)){
		$originalDate = $get_one_bill['billdate'];
		$billdates = date("d-m-Y", strtotime($originalDate));
	?>
			<tr>
				<td style="text-align:center;padding:5px;"> <?php echo $sel_counting;?></td>
				<td style="text-align:center;padding:5px;"><?php echo $get_one_bill['billno'];?></td>
				<td style="text-align:center;padding:5px;"><?php echo $billdates;?></td>
				<td style="text-align:center;padding:5px;"><?php echo $get_one_bill['nameofwork'];?></td>
				<td style="text-align:center;padding:5px;"><?php echo $get_one_bill['billtotal'];?></td>
			</tr>
		
	
	<?php
	$sel_counting++;
	} ?>
	
</table>


	

 <!--<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">-->
	
<?php

function integerToRoman($integer)
{
 // Convert the integer into an integer (just to make sure)
 $integer = intval($integer);
 $result = '';
 
 // Create a lookup array that contains all of the Roman numerals.
 $lookup = array('M' => 1000,
 'CM' => 900,
 'D' => 500,
 'CD' => 400,
 'C' => 100,
 'XC' => 90,
 'L' => 50,
 'XL' => 40,
 'X' => 10,
 'IX' => 9,
 'V' => 5,
 'IV' => 4,
 'I' => 1);
 
 foreach($lookup as $roman => $value){
  // Determine the number of matches
  $matches = intval($integer/$value);
 
  // Add the same number of characters to the string
  $result .= str_repeat($roman,$matches);
 
  // Set the integer to be the remainder of the integer and the value
  $integer = $integer % $value;
 }
 
 // The Roman numeral should be built, return it
 return $result;
}

?>

<script type="text/javascript">
window.onload = function(){ 
	setTimeout(function()
		{
			
			window.print();
		}, 
		1000);

}

/* $("#print_button").on("click",function(){
	
	
			window.print();
		 });
$('.btn_print').on('click', function() {
    $('.btn_print').hide();
}); */


 
</script>

