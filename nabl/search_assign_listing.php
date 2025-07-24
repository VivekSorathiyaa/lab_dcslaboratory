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
			$where="`date` BETWEEN '$new_from_date' AND '$new_to_date' AND `isdeleted`=0 ORDER BY assign_id_total DESC"; 
		}
		
		else{
			$where=" `isdeleted`=0 ORDER BY assign_id_total DESC";
		}
?>
						
		<table id="example1" class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;">Report Number</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Created By</th>
									</tr>
										
								</thead>
				<tbody>
					<?php
									
						$count=0;
						 $query="select * from material_assign_total WHERE $where";
						$result=mysqli_query($conn,$query);
						while($row=mysqli_fetch_array($result))
						{
							
					?>
										<tr>
											<td style="text-align:center;">
											
												<a href="<?php echo $base_url; ?>edit_assigned_report.php?report_no=<?php echo $row['report_number'];?>&&mate_rate=<?php echo $row['mate_rate'];?>" class="glyphicon glyphicon-pencil" title="Material Assign"></a>
												
												&nbsp;&nbsp;&nbsp;
												<a href="<?php echo $base_url; ?>material_report.php?report_no=<?php echo $row['report_number'];?>" class="glyphicon glyphicon-th-list" title="View Assigned Material"></a>
										    
											</td>
					
											
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_number'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['date'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['createdby'];?></td>
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
      
        buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    } );
 } );

</script>
