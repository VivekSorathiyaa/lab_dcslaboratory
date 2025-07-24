<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
   if($_POST['action_type'] == 'set_rate_by_gst'){
		
		$gst_type=$_POST["gst_type"];
		$bill_amt=$_POST["bill_amt"];
		
		$sel_tax="select * from tax";
		$query_tax=mysqli_query($conn,$sel_tax);
		$get_tax=mysqli_fetch_array($query_tax);
		
		$sgst_per=$get_tax["tax_sgst"];
		$cgst_per=$get_tax["tax_cgst"];
		$igst_per=$get_tax["tax_igst"];
		
		if($gst_type=="with_gst"){
			
			$sgst_amt= ($bill_amt * $sgst_per)/100;
			$cgst_amt= ($bill_amt * $cgst_per)/100;
			$igst_amt=0;
			$final_amt= $bill_amt + $sgst_amt+ $cgst_amt + $igst_amt;
			
		}else if($gst_type=="with_igst"){
			
			$sgst_amt= 0;
			$cgst_amt= 0;
			$igst_amt= ($bill_amt * $igst_per)/100;
			$final_amt= $bill_amt + $sgst_amt+ $cgst_amt + $igst_amt;
			
		}else{
			
			$sgst_amt= 0;
			$cgst_amt= 0;
			$igst_amt= 0;
			$final_amt= $bill_amt + $sgst_amt+ $cgst_amt + $igst_amt;
			
		}
		
		$fill=array(
				"sgst_amt" => $sgst_amt,
				"cgst_amt" => $cgst_amt,
				"igst_amt" => $igst_amt,
				"final_amt" => $final_amt
		);
		echo json_encode($fill);
		
	}
	else if($_POST['action_type'] == 'sel_division_final'){
		$id_array = $_POST['arr'];
		$delids=explode(",",$id_array);
		$count=count($delids);
		?>
		<table id="examples1" class="table table-bordered table-striped" width="100%">
			<thead>
				<tr>
					<th style="text-align:center;">Bill No</th>
					<th style="text-align:center;">Bill Date</th>	
					<th style="text-align:center;">Name Of Work</th>
					<th style="text-align:center;">Bill Total</th>
					<th style="text-align:center;">TDS</th>
					<th style="text-align:center;">Final Amount</th>
				</tr>
			</thead>
			<tbody>
		<?php
		$counting_set=1;
		for($i=0;$i<$count;$i++)
		{
			$sel_divisions_final = "select * from span_bill where id = '$delids[$i]' and ispaid = '0'";
			$sel_divisions_qry_final = mysqli_query($conn,$sel_divisions_final);
			?>
			
		<?php
				if (mysqli_num_rows($sel_divisions_qry_final) > 0) 
			{
				
				while($row_final = mysqli_fetch_array($sel_divisions_qry_final))
				{
					$originalDates = $row_final['billdate'];
					$billdatess = date("d-m-Y", strtotime($originalDates));
					?>
						<tr>
						
							<td style="text-align:center;"><?php echo $row_final['billno'];?>
							<input type="hidden" name="bill_id[]" value="<?php echo $row_final['id'];?>" class="bill_class" id="bill_id_<?php echo $counting_set;?>">
							</td>
							<td style="text-align:center;"><?php echo $billdatess;?></td>
							<td style="text-align:center;"><?php echo $row_final['nameofwork'];?></td>
							<td style="text-align:center;"><?php echo $row_final['billtotal'];?> <input type="hidden" id="bill_total_hidden" name="bill_total_hidden" value="<?php echo $row_final['billtotal'];?>"></td>
							<td style="text-align:center;"><input type="text" id="tds_<?php echo $counting_set;?>" name="tds[]" class="tds"></td>
							<td style="text-align:center;"><input type="text" id="final_bill_amount_<?php echo $counting_set;?>" name="final_bill_amount[]" class="final_bill_amount"></td>
						</tr>
					<?php
				
				}
			}?>
			<?php
			$counting_set++;
		}
		?>
		<tr>
		<td colspan="6" style="text-align: center;">
		<input type="button" class="btn btn-info" id="btn_save_main_bills" name="btn_save_main_bills" value="Save">
		</td>
		</tr>
		</tbody>
		</table>
		<?php
		
	}
	else if($_POST['action_type'] == 'sel_division'){
		
		$division_value = $_POST['division_value'];
		$sel_divisions = "select * from span_bill where division = '$division_value' and ispaid = '0' and division_status = '2'";
		$sel_divisions_qry = mysqli_query($conn,$sel_divisions);
		if (mysqli_num_rows($sel_divisions_qry) > 0) 
				{
		?>
		<table id="example1" class="table table-bordered table-striped" width="100%">
			<thead>
				<tr>
					<th style="text-align:center;">Action</th>
					<th style="text-align:center;">Bill No</th>
					<th style="text-align:center;">Bill Date</th>	
					<th style="text-align:center;">Name Of Work</th>
					<th style="text-align:center;">Bill Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
					while($row = mysqli_fetch_array($sel_divisions_qry))
					{
						$originalDate = $row['billdate'];
						$billdates = date("d-m-Y", strtotime($originalDate));
					?>
						<tr>
							<td style="text-align:center;"> <input type="checkbox" id="checkbox_bill" class="checkbox_bill" name="checkbox_bill[]"  value="<?php echo $row['id']; ?>" rel="<?php echo $row['id']; ?>"></td>
							<td style="text-align:center;"><?php echo $row['billno'];?></td>
							<td style="text-align:center;"><?php echo $billdates;?></td>
							<td style="text-align:center;"><?php echo $row['nameofwork'];?></td>
							<td style="text-align:center;"><?php echo $row['billtotal'];?></td>
						</tr>
					<?php 
					}
				?>
			</tbody>
		</table>
		<div class="row">
			<div class="col-md-12" style="text-align:center;">
				<button type="button" class="btn btn-info" id="btn_update_data" name="btn_update_data" >Add</button>
			</div>
	    </div>	
				<?php } }
	else if($_POST['action_type'] == 'add'){
		
		$billdate_set =$_POST['billdate'];
	    $date_explode=explode("/",$billdate_set);
		$billdate=  $date_explode[2]."-".$date_explode[1]."-".$date_explode[0];
		$billmonth = $_POST['billmonth'];
		$billno = $_POST['billno'];
		$division = $_POST['division'];
		$subdivision = $_POST['subdivision'];
		$txtarea_work = $_POST['txtarea_work'];
		$billamt = $_POST['billamt'];
		$gst_type = $_POST['gst_type'];
		$cgst = $_POST['cgst'];
		$sgst = $_POST['sgst'];
		$igst = $_POST['igst'];
		$total_amt = $_POST['total_amt'];
		$current_dates= date('Y/m/d');
		
		$insert="insert into span_bill (`srno`,`month`,`billdate`,`billno`,`division`,`subdivision`,`nameofwork`,`billnet`,`sgst`,`cgst`,`igst`,`rbt`,`billtotal`,`billstatus`,`createddate`,`createdby`,`modifiedby`,`modifieddate`,`isdeleted`,`deletedby`,`checkby`) 
				values(
				'1',
				'$billmonth',
				'$billdate',
				'$billno',
				'$division',
				'$subdivision',
				'$txtarea_work',
				'$billamt',
				'$sgst',
				'$cgst',
				'$igst',
				'$gst_type',
				'$total_amt',
				'0',
				'$current_dates',
				'$_SESSION[name]',
				'',
				'0000-00-00',
				'0',
				'',
				'')";
				
		$result_of_insert=mysqli_query($conn,$insert);
	}elseif($_POST['action_type'] == 'edit'){
		
		$billdate_set =$_POST['billdate'];
	    $date_explode=explode("/",$billdate_set);
		$billdate=  $date_explode[2]."-".$date_explode[1]."-".$date_explode[0];
		$billmonth = $_POST['billmonth'];
		$billno = $_POST['billno'];
		$division = $_POST['division'];
		$subdivision = $_POST['subdivision'];
		$txtarea_work = $_POST['txtarea_work'];
		$billamt = $_POST['billamt'];
		$gst_type = $_POST['gst_type'];
		$cgst = $_POST['cgst'];
		$sgst = $_POST['sgst'];
		$igst = $_POST['igst'];
		$total_amt = $_POST['total_amt'];
		$hidden_id = $_POST['hidden_id'];
		$current_dates= date('Y/m/d');
		
		$update="update span_bill SET `month`='$billmonth',`billdate`='$billdate',`billno`='$billno',`division`='$division',`subdivision`='$subdivision',`nameofwork`='$txtarea_work',`billnet`='$billamt',`sgst`='$sgst',`cgst`='$cgst',`igst`='$igst',`rbt`='$gst_type',`billtotal`='$total_amt' WHERE `id`=$hidden_id";
		
		$result_of_insert=mysqli_query($conn,$update);
	}else if($_POST['action_type'] == 'delete_billing'){
		$clicked_id=$_POST['clicked_id'];
		
		$job_delete="delete from  span_bill WHERE `id`=".$clicked_id;
		$result_of_job_delete=mysqli_query($conn,$job_delete);
	
}else if($_POST['action_type'] == 'send_to_sub_division'){
		$clicked_id=$_POST['clicked_id'];
		
		$job_delete="update span_bill set `division_status`='1' WHERE `id`=".$clicked_id;
		$result_of_job_delete=mysqli_query($conn,$job_delete);
	
}else if($_POST['action_type'] == 'reward_to_main'){
		$clicked_id=$_POST['clicked_id'];
		
		$job_delete="update span_bill set `division_status`='0' WHERE `id`=".$clicked_id;
		$result_of_job_delete=mysqli_query($conn,$job_delete);
	
}else if($_POST['action_type'] == 'send_to_division'){
		$clicked_id=$_POST['clicked_id'];
		
		$job_delete="update span_bill set `division_status`='2' WHERE `id`=".$clicked_id;
		$result_of_job_delete=mysqli_query($conn,$job_delete);
	
}else if($_POST['action_type'] == 'reward_to_sub'){
		$clicked_id=$_POST['clicked_id'];
		
		$job_delete="update span_bill set `division_status`='1' WHERE `id`=".$clicked_id;
		$result_of_job_delete=mysqli_query($conn,$job_delete);
	
}else if($_POST['action_type'] == 'save_main_bill_in_db'){
	
	$bill_ids_array=explode(",",$_POST["bill_ids"]);
	$tds_amts_array=explode(",",$_POST["tds_amts"]);
	$final_amts_array=explode(",",$_POST["final_amts"]);
	$chequeno=$_POST["chequeno"];
	
	$date_explode=explode("/",$_POST["chequedate"]);
	$chequedate= $date_explode[2]."-".$date_explode[1]."-".$date_explode[0];
	$chequeamt=$_POST["chequeamt"];
	$main_division_id=$_POST["main_division_id"];
	
	$cheque_insert="insert into cheque (`division_id`,`cheque_no`,`cheque_date`,`cheque_amount`) 
				values(
				'$main_division_id',
				'$chequeno',
				'$chequedate',
				'$chequeamt')";
				
		$cheque_of_insert=mysqli_query($conn,$cheque_insert);
		$last_insereted_id = mysqli_insert_id($conn);
	
	foreach($bill_ids_array as $keys=> $one_value){
		
		$update_bill="update span_bill set `cheque_no`='$chequeno',`cheque_date`='$chequedate',`cheque_amt`='$chequeamt',`tds_amt`='$tds_amts_array[$keys]',`paid_total`='$final_amts_array[$keys]',`ispaid`='1',`cheque_id`='$last_insereted_id' where `id`=$bill_ids_array[$keys]";
		
		mysqli_query($conn,$update_bill);
	}
	
}else if($_POST['action_type'] == 'view_data_in_popup'){
	$clicked_id=$_POST['clicked_id'];
	
	$sel_bill_by_cheque="select * from span_bill where `cheque_id`='$clicked_id'";
	$get_bill_by_cheque=mysqli_query($conn,$sel_bill_by_cheque);
	if(mysqli_num_rows($get_bill_by_cheque)>0){ ?> 
	
	
	
	
	<?php
	$sel_counting=1;
	while($get_one_bill=mysqli_fetch_array($get_bill_by_cheque)){
		$originalDate = $get_one_bill['billdate'];
		$billdates = date("d-m-Y", strtotime($originalDate));
	?>
			<tr>
				<td style="text-align:center;"> <?php echo $sel_counting;?></td>
				<td style="text-align:center;"><?php echo $get_one_bill['billno'];?></td>
				<td style="text-align:center;"><?php echo $billdates;?></td>
				<td style="text-align:center;"><?php echo $get_one_bill['nameofwork'];?></td>
				<td style="text-align:center;"><?php echo $get_one_bill['billtotal'];?></td>
			</tr>
		
	
	<?php
	$sel_counting++;
	} ?>
	
	<tr>
	<td colspan=5 style="text-align:center;">
	<a target="_blank" href="<?php echo $base_url;?>print_cheque_detail.php?print_id=<?php echo $clicked_id;?>" class="btn btn-primary">Print</a>
	</td>
	</tr>
	
	<?php }
	
}

}
?>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>		  
     $(document).ready(function() {
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
        buttons: [
			
            'excel'
        ]
    } );
	
 } );

</script>