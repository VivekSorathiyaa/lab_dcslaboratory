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
			$where="And `created_date` >= '$new_from_date' AND `created_date` <='$new_to_date' "; 
		}
		
		else if($to_date!= "" ){
			$where="And `created_date` <='$new_to_date'  "; 
		}
		
		else if($from_date!= "" ){
			$where="And `created_date` >= '$new_from_date' "; 
		}
		
		
		else{
			$where="";
		}
		
		
		?>
						
					<table id="example1" class="table table-bordered table-striped" style="width:100%">
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;"></th>
										<th style="text-align:center;">Report No</th>	
										<th style="text-align:center;">Job No</th>
										
								
									</tr>
								</thead>
								<tbody>
									<?php
									
										$count=0;
										 $query="select * from save_material_assign where  isstatus='1' and is_deleted='0' ".$where;
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											
									?>
											<tr>
											<td style="white-space:nowrap;">
											
												<!--a href="<!?php echo $base_url; ?>edit_job_invert.php?est_sr_no=<1?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-edit"></a>
												&nbsp;
												<a href="<!?php echo $base_url; ?>delete_ess_bill.php?id=<!?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?deleteData('delete','<!?php echo $row['est_sr_no']; ?>'):false;"></a>
												&nbsp;
												<a href="<!?php echo $base_url; ?>report.php?est_sr_no=<1?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-th-list"></a>&nbsp;&nbsp;
												
												<a href="<!?php echo $base_url; ?>billing.php?est_sr_no=<!?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-book"></a>&nbsp;&nbsp;-->
												
												<button>View Data</button>
											</td>     
					
											<td><?php echo $count;?></td>
											<td style="white-space:nowrap;"><?php echo $row['report_no'];?></td>
											<td><?php echo $row['job_no'];?></td>
											
											
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
        buttons: [
			
            'excel'
        ]
    } );
 } );

</script>
