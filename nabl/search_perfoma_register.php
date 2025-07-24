<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php
session_start();
include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
	</script>
	<?php
}

$arraying=array(
array($_POST["sel_agency_ids"]," AND `agency_id` LIKE '%".$_POST['sel_agency_ids']."%'"),
array($_POST["perfoma_no"]," AND `perfoma_no` LIKE '%".$_POST['perfoma_no']."%'"),
array($_POST["bill_amnt_id"]," AND `total_amt` LIKE '%".$_POST['bill_amnt_id']."%'"),
array($_POST["cheque_no"]," AND `chequeno` LIKE '%".$_POST['cheque_no']."%'"),
array($_POST["bank_name"]," AND `bank_name` LIKE '%".$_POST['bank_name']."%'"),
array($_POST["tds_amt"]," AND `tds` LIKE '%".$_POST['tds_amt']."%'"),
array($_POST["paid_amt"]," AND `paid_amt` LIKE '%".$_POST['paid_amt']."%'"),
array($_POST["cheque_amt"]," AND `cheque_amt` LIKE '%".$_POST['cheque_amt']."%'"),
array($_POST["remarks"]," AND `remarks` LIKE '%".$_POST['remarks']."%'")
);

$where="";
foreach($arraying as $keys =>$one_array)
{
	if($one_array[0]!="")
	{
		$where .=$one_array[1];
	}
}

$search_customer_name=$_POST["customer_name"];
if($search_customer_name !="")
{
	$where_clients=" AND `client_code`='$search_customer_name'";
}else
{
	$where_clients="";
}

?>
			<table id="example2" class="table table-bordered table-striped" style="width:100%;">
				<thead>
					<tr>
						<th style="text-align:center;">Serial No</th>
						<th style="text-align:center;">Perfoma Date</th>
						<th style="text-align:center;">Agency No</th>
						<th style="text-align:center;">Perfoma No</th>
						<th style="text-align:center;">Name of Department</th>

						<th style="text-align:center;">Bill Amount</th>
						<th style="text-align:center;">Cheque Date</th>
						<th style="text-align:center;">Cheque No.</th>
						<th style="text-align:center;">Bank Name</th>
						<th style="text-align:center;">TDS</th>
						<th style="text-align:center;">Paid Amount</th>
						<th style="text-align:center;">Remarks</th>
						<th style="text-align:center;">Cheque Amount</th>
						<th style="text-align:center;">Action</th>
					</tr>
				</thead>
			    <tbody>
						<?php
										$count=0;
										$query="select * from estimate_total_span WHERE `est_isdeleted`=0  AND `perfoma_completed_by_biller`='1'".$where." ORDER BY est_id DESC";
										$result=mysqli_query($conn,$query);
										if(mysqli_num_rows($result)>0)
										{
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$sel_agency_id=$row["agency_id"];
											$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];

											$get_one_trf_no=explode(",",$row['trf_no']);
											$one_trf_no=$get_one_trf_no[0];
											$query_job="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no'".$where_clients." ORDER BY job_id DESC";
											$result_job =mysqli_query($conn,$query_job);
											$row_job =mysqli_fetch_array($result_job);
											$clientname=$row_job["clientname"];
											$name_of_work= strip_tags(html_entity_decode($row_job["nameofwork"]),"<strong><em>");

											if($row["perfoma_type"]=="direct_perfoma")
											{
												$clientname=$row['customer_name'];
											}

									?>
											<tr>
												<td style="text-align:center;"><?php echo $count;?></td>
												<td style="white-space:nowrap;text-align:center;"><?php
												$date = new DateTime($row['estimate_date']);
												echo $date->format('d-m-Y');
												?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row["perfoma_no"];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $clientname;?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row["total_amt"];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php
												$c_date = new DateTime($row['ch_date']);
												echo $c_date->format('d-m-Y');
												?>
												</td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row["chequeno"];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row["bank_name"];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row["tds"];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row["paid_amt"];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row["remarks"];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row["cheque_amt"];?></td>
												<td style="text-align:center;"></td>
										   </tr>
									<?php
										}
										}
									?>
			    </tbody>
			    </table>

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
$(document).ready(function(){
	var table = $('#example2').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],
    });

	$(function () {
		$('.select2').select2()
	})

});
</script>
