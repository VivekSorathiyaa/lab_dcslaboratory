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
   
  
<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
	
	<div class="row">
		
		<h1 style="text-align:center;">
		Cheque List
		</h1>
	</div>
	<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">
					
					<div class="box-body">
					            <a class="btn btn-primary" href="add_cheque.php">Add Cheque</a>
								
								<hr style="border-top: 1px solid;">

								<br>
								<div id="display_data">
									<table id="example3" class="table table-bordered table-striped" style="width:100%;">
										<thead>
										<tr>
											<th style="text-align:center;">Serial No</th>
											<th style="text-align:center;">cheque No</th>	
											<th style="text-align:center;">Division Name</th>	
											<th style="text-align:center;">cheque Date</th>	
											<th style="text-align:center;">cheque Amount</th>	
											<th style="text-align:center;">Action</th>	
											
											
										</tr>
									</thead>
									<tbody>
										<?php
											$count=0;
											$query="select * from cheque WHERE `cheque_deleted`=0 ORDER BY cheque_id DESC";
											$result=mysqli_query($conn,$query);
											while($row=mysqli_fetch_array($result))
											{
												$count++;
												
												//select division
											$division_query="select * from division WHERE `div_id`='$row[division_id]'";
											$division_result=mysqli_query($conn,$division_query);
											$division_row=mysqli_fetch_assoc($division_result);
												
										?>
												<tr>
												<td style="text-align:right;"><?php echo $count;?></td>
												
												<td style="text-align:right;"><?php echo $row['cheque_no'];?></td>
												
												<td style="text-align:center;"><?php echo $division_row['div_name'];?></td>
												
												<td style="text-align:center;"><?php echo date("d-m-Y", strtotime($row['cheque_date']));?></td>
												
												
												<td style="text-align:center;"><?php echo $row['cheque_amount'];?></td>
												
												
												
												<td style="text-align:center;">
												<button class="btn btn-primary click_to_view" data-id="<?php echo $row['cheque_id']?>"  data-toggle="modal" data-target="#myModal">View</button>
												</td>
												
												
											</tr>
										<?php
											}	
										?>
									</tbody>
									<tfoot>
								   <tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
								   </tfoot>
								  </table>
									
								</div>
							</div>
					<!-- /.box-body -->
					</div>
				</div>
	</div>
</section>	
</div> 

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h1 class="modal-title" style="text-align:center;">Cheque wise Bill List</h1>
      </div>
      <div class="modal-body">
	  <table id="example5" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr>
				<th style="text-align:center;">Serial No</th>
				<th style="text-align:center;">Bill No</th>
				<th style="text-align:center;">Bill Date</th>	
				<th style="text-align:center;">Name Of Work</th>
				<th style="text-align:center;">Bill Total</th>
			</tr>
		</thead>
			<tbody id="put_id">
			</tbody>
		</table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
	
<?php include("footer.php");?>		  
		  
<script>
    $(document).ready(function() {
	var table = $('#example3').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		drawCallback: function () {
      var api = this.api();
      
        //var pageTotal=api.column( 9, {page:'every'} ).data().sum();
       // $('tr:eq(0) td:eq(8)', api.table().footer()).html("TOTAL:");
       // $('tr:eq(0) td:eq(9)', api.table().footer()).html(pageTotal);
      
    },
		
    } );
	var table = $('#example5').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		drawCallback: function () {
      var api = this.api();
      
        //var pageTotal=api.column( 9, {page:'every'} ).data().sum();
       // $('tr:eq(0) td:eq(8)', api.table().footer()).html("TOTAL:");
       // $('tr:eq(0) td:eq(9)', api.table().footer()).html(pageTotal);
      
    },
		
    } );
 } );

</script>
<script>

$(document).on("click", ".click_to_view", function () {
				var clicked_id = $(this).attr("data-id");  
				
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_billing_save.php',
        data: 'action_type=view_data_in_popup&clicked_id='+clicked_id,
        success:function(html){
			$("#put_id").html(html);
        }
    });
	
	
});
</script>
