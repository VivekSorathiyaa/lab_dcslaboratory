
<?php 
include("header.php");
include("sidebar.php");
include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
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
<?php
$select_query = "select * from estimate_bill_total_master WHERE `est_sr_no`='$_GET[id]'";
	$result_select = mysqli_query($conn, $select_query);


		if(isset($_GET['id'])){
			$aa=$_GET['id'];
			
		}
	if (mysqli_num_rows($result_select) > 0) {
		$row_select = mysqli_fetch_assoc($result_select);
		$serial_no1= $row_select['sr_no'];
		
		//-------------------job no logic--------------
		
		$j_no=1;
		$final_j_no;
		$querys_job = "SELECT * FROM c_c_block WHERE `sr_no`= '$serial_no1' AND `is_deleted`='0'";
		$qrys_jobno = mysqli_query($conn,$querys_job);
		$rows=mysqli_num_rows($qrys_jobno);
		if($rows<1){
			$final_j_no=$j_no;
		}
		else{
			while($r1 = mysqli_fetch_array($qrys_jobno)){
				$jno=$r1['job_no'];
			}
		
			$final_j_no=$jno+1;
		}

	
		//---------------------------------------------
		
		$job_no= "1";
		$agency_id= $row_select['agency_id'];
		$agency_name= $row_select['agency_name'];
		$auth_name= $row_select['auth_name'];
		$ref_date= $row_select['ref_date'];
	

		$srno2=substr($serial_no1,8);
		$srno1=substr($serial_no1,0,8);
		
		
		$select_query1 = "select * from billmaster WHERE `sr_no`='$serial_no1'";
		$result_select1 = mysqli_query($conn, $select_query1);

		if (mysqli_num_rows($result_select1) > 0) {
			$row_select1 = mysqli_fetch_assoc($result_select1);
			$name_of_work= $row_select1['name_of_work'];
			$city_id= $row_select1['city_id'];
			$ref_name= $row_select1['ref_name'];
			$ref_id= $row_select1['ref_id'];
			$material_id=$row_select1['material_id'];
			
				$select_city = "select * from city WHERE `id`='$city_id'";
				$result_city = mysqli_query($conn, $select_city);
	

				if (mysqli_num_rows($result_city) > 0) {
					$row_city = mysqli_fetch_assoc($result_city);
					$name_of_work= $row_select1['name_of_work'];
					$city_name= $row_city['city_name'];
				}		
		}
		
	}
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		
		<h1>
			C.C. Block Test
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<label class="col-md-2 col-xs-2 control-label">From:</label>
				<div class="col-md-10 col-xs-10">				
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control pull-right" tabindex="3" id="dpFrom" name="dpFrom" value="<?php echo date("d/m/Y");?>">
					</div>
				</div>
			</div>

			<div class="row">
				<label class="col-md-2 col-xs-2 control-label">Days:</label>
				<div class="col-md-10 col-xs-10">
					<input id="txtDays" type="text" class="form-control" value="5">
				</div>
			</div>

			<div class="row">
				<label class="col-md-2 col-xs-2 control-label">To:</label>
				<div class="col-md-10 col-xs-10">
					<input id="txtTo" type="text" class="form-control" disabled>
				</div>
			</div>
	</section>
</div>
					
	
		
<?php include("footer.php");?> 
<script>
	$('#dpFrom').datetimepicker({
		format: 'MM/DD/YYYY'
	}).on('dp.change', function(e) {
	  
	  // on date change get current date and add txtDays days
	  //
	  var txtTo = e.date.add(+$('#txtDays').val() || 0, 'days');
	  //
	  // format result and save to txtDays
	  //
	  $('#txtTo').val(txtTo.format('MM/DD/YYYY'));
});
 
</script>