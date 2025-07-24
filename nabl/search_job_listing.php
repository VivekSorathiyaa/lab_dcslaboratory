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


		$from_date=$_POST['from_date'];
		$to_date=$_POST['to_date'];



				$from_day=substr($_POST['from_date'],0,2);
				$from_month=substr($_POST['from_date'],3,2);
				$from_year=substr($_POST['from_date'],6,4);
				$new_from_date = $from_year."-".$from_month."-".$from_day;


				$to_day=substr($_POST['to_date'],0,2);
				$to_month=substr($_POST['to_date'],3,2);
				$to_year=substr($_POST['to_date'],6,4);
				$new_to_date = $to_year."-".$to_month."-".$to_day;




		if($from_date!= "" && $to_date!= ""){
			$where="`date` BETWEEN '$new_from_date' AND '$new_to_date' AND `assign_status`=0 AND `send_to_second_reception`=0";
		}

		else{
			$where="";
		}
?>

		<table id="example1" class="table table-bordered table-striped" style="width:100%;">
					<thead>
					<tr>
						<tr>
							<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Customer Name</th>
										<th style="text-align:center;">Agency Name</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Action</th>
						</tr>
					</tr>
				</thead>
				<tbody>
					<?php

						$count=0;
						 $query="select * from job WHERE $where";
						$result=mysqli_query($conn,$query);
						while($row=mysqli_fetch_array($result))
						{
							$count++;
					?>
						<tr>
											<td><?php echo $count;?></td>
											<td><?php echo date("d-m-Y", strtotime($row['date']));?></td>
											<td><?php echo $row['clientname'];?></td>
											<td><?php

											$query_agency="select * from agency_master where `agency_id`=".$row['agency'];
											$result_agency=mysqli_query($conn,$query_agency);
											$row_result=mysqli_fetch_array($result_agency);
											echo $row_result["agency_name"];
											?></td>
											<td style="white-space:nowrap;"><?php echo $row['report_no'];?></td>
											<td style="text-align:center;">
											<?php if($row['assign_status']==0){ ?>
												<a href="<?php echo $base_url; ?>edit_client_form.php?job_id=<?php echo $row['job_id'];?>" class="btn btn-info btn-lg btn3d" title="Material Assign"><span class="glyphicon glyphicon-question-edit"></span> Edit</a>
												&nbsp;&nbsp;&nbsp;
												<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d send_to_second" data-id="<?php echo $row['job_id'];?>"title="Send to Second Reception Desk"><span class="glyphicon glyphicon-question-ok"></span> Submit</a>

										    <?php } ?>
											</td>
										</tr>
					<?php
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
     $(document).ready(function() {
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		drawCallback: function () {
      var api = this.api();

       // var pageTotal=api.column( 17, {page:'every'} ).data().sum();
        var pageTotal=123;

        var total_amount=api.column( 17, {page:'every'} ).data();
        var paytype =api.column( 18, {page:'every'} ).data();
		var paid_total=0;
		var remain_total=0
		for (i = 0; i < paytype.length; i++)
		{

		  if(paytype[i]=="cash" || paytype[i]=="cheque" || paytype[i]=="rtgs")
		  {
			  paid_total=parseInt(paid_total)+parseInt(Math.round(total_amount[i]));
		  }else{
			  remain_total =parseInt(remain_total)+parseInt(Math.round(total_amount[i]));
		  }
		}


		$('tr:eq(0) td:eq(17)', api.table().footer()).html("TOTAL="+Math.round(paid_total+remain_total)+"   <br>PAID=  "+paid_total+"      <br>UNPAID="  +remain_total);

		//$(api.column(17).footer()).html("TOTAL="+Math.round(pageTotal)+"   <br>PAID=  "+paid_total+"      <br>UNPAID="  +remain_total);

    },
        buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],
    } );
 } );

</script>
