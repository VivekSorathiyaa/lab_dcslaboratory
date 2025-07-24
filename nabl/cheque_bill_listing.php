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
		Cheque Bill List
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
											<th style="text-align:center;">Bill Date</th>	
											<th style="text-align:center;">Bill Month</th>	
											<th style="text-align:center;">Division</th>
											<th style="text-align:center;">Sub Division</th>
											<th style="text-align:center;">Bill Amount</th>
											<th style="text-align:center;">Cheque No</th>
											<th style="text-align:center;">Cheque Date</th>
											
											<th style="text-align:center;">Cheque Amount</th>
											<th style="text-align:center;">Tds Amount</th>
											<th style="text-align:center;">Paid Amount</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
											$count=0;
											$query="select * from span_bill WHERE `isdeleted`=0 AND `ispaid`=1 ORDER BY id DESC";
											$result=mysqli_query($conn,$query);
											while($row=mysqli_fetch_array($result))
											{
												$count++;
												
												//select division
											$division_query="select * from division WHERE `div_id`='$row[division]'";
											$division_result=mysqli_query($conn,$division_query);
											$division_row=mysqli_fetch_assoc($division_result);
											
											//select sub division
											$sub_division_query="select * from sub_division WHERE `sub_div_id`='$row[subdivision]'";
											$sub_division_result=mysqli_query($conn,$sub_division_query);
											$sub_division_row=mysqli_fetch_assoc($sub_division_result);
												
										?>
												<tr>
												<td style="text-align:center;"><?php echo $count;?></td>
												<td style="text-align:center;"><?php echo date("d-m-Y", strtotime($row['billdate']));?></td>
												
												<td style="text-align:center;"><?php echo $row['month'];?></td>
												
												<td style="text-align:center;"><?php echo $division_row['div_name'];?></td>
												
												<td style="text-align:center;"><?php echo $sub_division_row['sub_div_name'];?></td>
												
												<td style="text-align:center;"><?php echo $row['billnet'];?></td>
												
												<td style="text-align:center;"><?php echo $row['cheque_no'];?></td>
												
												<td style="text-align:center;"><?php echo $row['cheque_date'];?></td>
												
												<td style="text-align:center;"><?php echo $row['cheque_amt'];?></td>
												
												<td style="text-align:center;"><?php echo $row['tds_amt'];?></td>
												
												<td style="text-align:center;"><?php echo $row['paid_total'];?></td>
												
												
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
 } );

</script>
<script>

 $(document).on("click", ".delete_bill", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Bill?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_billing_save.php',
        data: 'action_type=delete_billing&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>span_billing_listing.php";
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

$(document).on("click", ".reward_to_sub", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Reward This Bill To Sub Division?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_billing_save.php',
        data: 'action_type=reward_to_sub&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>span_billing_listing.php";
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});
</script>
