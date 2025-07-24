<?php 
session_start();
include("header.php");
include("sidebar.php");
include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script>
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}
if($_SESSION['isadmin']!="0")
{
	?>
	<script >
		window.location.href="<?php $base_url; ?>home.php";
	</script>
	<?php
	
}
		$sel_branch="Select * from branch";
	$branch_query=mysqli_query($conn,$sel_branch);
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Billing
      </h1>
      
    </section>

    <!-- Main content -->
  
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title">View Bills</h3>
							</div>
								<!-- /.box-header -->
									
							<div class="box-body">
								<form class="form" id="billing" method="post">
									<div class="box-body">
										<div class="row">	
											<div class="col-lg-3">
												<div class="form-group">
												  <label for="inputEmail3" class="col-sm-3 control-label">From Date:</label>

												  <div class="col-sm-9">
														<div class="input-group date">
															<div class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</div>
															<input type="text" class="form-control pull-right" id="from_date" name="from_date" value="<?php echo date("d/m/Y");?>">
														</div>
												  </div>
												</div>
											</div>
											
											<div class="col-lg-3">
												<div class="form-group">
												  <label for="inputEmail3" class="col-sm-3 control-label">To Date:</label>

												  <div class="col-sm-9">
													<div class="input-group date">
															<div class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</div>
															<input type="text" class="form-control pull-right" id="to_date" name="to_date" value="<?php echo date("d/m/Y");?>">
														</div>
												  </div>
												</div>
											</div>
											
											<div class="col-lg-3">
												<div class="form-group">
												  <label for="inputEmail3" class="col-sm-4 control-label">Agency:</label>
													
													<div class="col-sm-8">
												
														<select class="form-control select2 col-md-7 col-xs-12 " style="width:200px" data-placeholder="Select a Autority" id="select_agency" name="select_agency">
															<option value="select">Select..</option>
															<?php 
															$agency_query = "select * from agency order by id";
														
															$result_agency = mysqli_query($conn, $agency_query);

															if (mysqli_num_rows($result_agency) > 0) {
																while($row_agency = mysqli_fetch_assoc($result_agency)) {
															
															?>
															<option value="<?php echo $row_agency['agency_name'];?>"><?php echo $row_agency['agency_name'];?></option>
															<?php } }?>
														</select>
													</div>
												</div>
											</div>
											
											<div class="col-lg-2">
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-3 control-label">Bills:</label>
													<input type="radio" name="bills" value="bills" class="col-sm-3" required="required" >
													<label for="inputEmail3" class="col-sm-3 control-label">Estimate:</label>
													<input type="radio" name="bills" value="estimate" class="col-sm-3" required="required" >
												</div>
											</div>
											<div class="col-lg-1">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="button" class="btn btn-info pull-right" name="btn_search" id="btn_search" value="Search" disabled>
													</div>
												</div>
											</div>		
										</div>
										
										<br>
									<div class="row">
									 <div class="col-sm-4">
									 <label for="inputEmail3" class="col-sm-4 control-label">Branch Name:</label>
											<select class="form-control select2 col-md-7 col-xs-12 " style="width:200px" data-placeholder="Select a Branch" id="sel_branch" name="sel_branch">
														<option value="0">Select-Branch</option>
														<?php if(!empty($branch_query)){
												while($b = mysqli_fetch_array($branch_query)){
												?>
												<option value="<?php echo $b['branch_id']?>"><?php echo $b['branch_name']?></option>
												<?php } } ?>
											</select>
									 </div>
									</div>
									</div>	
								</form>
								<hr style="border-top: 1px solid;">
								
								<br>
								<div id="display_data">
									<table id="example1" class="table table-bordered table-striped display">
										<thead>
										<tr>
											<th style="text-align:center;">Action</th>
											<th style="text-align:right;"></th>
											<th style="text-align:center;">Sr no</th>	
											<th style="text-align:center;">Financial year</th>
											<th style="text-align:center;">Job No</th>
											<th style="text-align:center;">Agency Name</th>
											<th style="text-align:center;">Auth Name</th>
											<th style="text-align:center;">Reference Date</th>
											<th style="text-align:center;">Rec Date</th>
											<th style="text-align:center;">Invoice Date</th>
											<th style="text-align:center;">Bill Date</th>
											<th style="text-align:center;">Tot Taxable Amount</th>
											<th style="text-align:center;">CGST Total</th>
											<th style="text-align:center;">SGST Total</th>
											<th style="text-align:center;">IGST Total</th>
											<th style="text-align:center;">GST</th>
											<th style="text-align:center;">Grand Total</th>
											<th style="text-align:center;">Payment Status</th>
											<th style="text-align:center;">Payment Type</th>
											<th style="text-align:center;">Date of Payment</th>
											<th style="text-align:center;">Check No.</th>
											<th style="text-align:center;">Bank Name</th>
											<th style="text-align:center;">Remarks</th>
											<th style="text-align:center;">Total GST in words</th>
											<th style="text-align:center;">Total bill amount in words</th>
											<th style="text-align:center;">Entry By</th>
											<th style="text-align:center;">Modified By</th>
										
										</tr>
									</thead>
									<tbody>
										<?php

										$query1="SELECT * FROM fyearmaster WHERE `fy_status`='1'";	
										 $qrys = mysqli_query($conn,$query1);
										$no_of_rows=mysqli_num_rows($qrys);
										if($no_of_rows>0){
																
											$r = mysqli_fetch_array($qrys);
											$year=$r['fy_name'];										
										}
											$count=0;
											$sum_of_grand_tot=0;
											$paid_total=0;
											
											$query="select * from bill_totalmaster WHERE `fy_id`='$year' AND `bt_isdeleted`=0 ORDER BY bt_id DESC";
											$result=mysqli_query($conn,$query);
											while($row=mysqli_fetch_array($result))
											{
												$sum_of_grand_tot += $row['grandtotal'];
												$count++;
												$serial_no1= $row['sr_no'];

												$srno2=substr($serial_no1,8);
												$srno1=substr($serial_no1,0,8);
												
										?>
												<tr>
												<td style="white-space:nowrap;">
													<a href="<?php echo $base_url; ?>edit_bill.php?bt_id=<?php echo $row['bt_id'];?>&est_sr_no=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-edit"></a>
													&nbsp;
													<a href="<?php echo $base_url; ?>delete_bill.php?id=<?php echo $row['bt_id'];?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?deleteData('delete','<?php echo $row['bt_id']; ?>'):false;"></a>
													&nbsp;
													<a href="<?php echo $base_url; ?>report_estimate.php?est_sr_no=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-th-list"></a>&nbsp;&nbsp;
													<a target = '_blank' href="<?php echo $base_url; ?>bill_print.php?sr_no=<?php echo $row['sr_no'];?>" class="glyphicon glyphicon-print"></a>
						

												</td>
						
												<td><?php echo $count;?></td>
												<td style="white-space:nowrap;"><?php echo $row['sr_no'];?></td>
												<td><?php echo $row['fy_id'];?></td>
												<td><?php echo $row['job_no'];?></td>
												<td><?php echo $row['agency_name'];?></td>
												<td><?php echo $row['auth_name'];?></td>
												<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['ref_date']));?></td>
												<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['rec_date']));?></td>
												<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['inv_date']));?></td>
												<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['today_date']));?></td>
												<td><?php echo $row['total_taxableamt'];?></td>
												<td><?php echo $row['cgsttotal'];?></td>
												<td><?php echo $row['sgsttotal'];?></td>
												<td><?php echo $row['igsttotal'];?></td>
												<td><?php echo $row['cgsttotal']+ $row['sgsttotal']+$row['igsttotal'];?></td>
												<td><?php echo $row['grandtotal'];?></td>
												
												<?php  
													if($row['paymenttype']=="")
													{?>
													<td><?php echo "Pending";?></td>

													<?php
													}
													else{
													?>
											
												<td><?php echo "Paied";?></td>
													<?php
													$paid_total +=$row['grandtotal'];
													}
													?>
												
												<td><?php echo $row['paymenttype'];?></td>
												
												<?php  
													if($row['paymenttype']=="")
													{?>
													<td><?php echo "00/00/0000";?></td>

													<?php
													}
													else{
													?>
											
												<td><?php echo date('d/m/Y', strtotime($row['dateofpay']));?></td>
													<?php
													}
													?>
												<td><?php echo $row['check_no'];?></td>
												<td><?php echo $row['bank_name'];?></td>
												<td><?php echo $row['remarks'];?></td>
												<td style="white-space:nowrap;"><?php echo $row['totalgst_inword'];?></td>
												<td style="white-space:nowrap;"><?php echo $row['billamt_inword'];?></td>
												<td><?php echo $row['bt_createdby'];?></td>
												
												<?php  
													if($row['bt_modifiedby']=="")
													{?>
													<td align="center"><?php echo "-";?></td>

													<?php
													}
													else{
													?>
												<td align="center"><?php echo $row['bt_modifiedby'];?></td>
													<?php
													}
													?>
											</tr>
										<?php
											}	
										?>
									</tbody>
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
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<th>Total :</th>
										<th><?php echo $sum_of_grand_tot;?></th>
										<th>Paid :</th>
										<th><?php echo $paid_total;?></th>
										<th>Pending :</th>
										<th colspan="4"><?php echo $sum_of_grand_tot - $paid_total;?></th>
									</tr>
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
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
        buttons: [
			
            'excel'
        ]
		
    } );
 } );
 /*$(document).ready(function() {
      $('#example1').DataTable({
      'paging'      : true,
	  'scrollX'		: true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,

    })
  })*/
  
  $("input[name='bills']").change(
    function(e)
    {
        $("#btn_search").prop("disabled", false);		
    });
	
  $('#from_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	$('#to_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
	 $(function () {
    $('.select2').select2();
  });
</script>
<script>

	$("#btn_search").click(function(){
			
			var from_date = $('#from_date').val(); 
			var to_date = $('#to_date').val(); 
			var select_agency = $('#select_agency').val(); 
			var radio_button =  $("input[name='bills']:checked"). val();
            var sel_branch = $('#sel_branch').val();			
			//alert(radio_button);
			var postData = '&from_date='+from_date+'&to_date='+to_date+'&radio_button='+radio_button+'&select_agency='+select_agency+'&sel_branch='+sel_branch;
		
			$.ajax({
				url : "<?php echo $base_url; ?>superadmin_search_bill.php",
				type: "POST",
				data : postData,
				success: function(data,status,  xhr)
				 {
					$("#display_data").html(data);
				 }

			}); 
	});
	
	
	function deleteData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
	var radio_buttons =  $("input[name='bills']:checked"). val();	
     if (type == 'delete'){
		
			billData = 'action_type='+type+'&id='+id+'&radio_buttons='+radio_buttons;
				
    }
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>superadmin_delete_bill.php',
        data: billData,
        success:function(msg){
            if(msg == 'ok'){
                alert('Bill data has been '+statusArr[type]+' successfully.');
                getbills();
             
				  window.location.href="<?php echo $base_url; ?>superadmin_view_bill.php";
				
            }else{
                alert('Bill data has been '+statusArr[type]+' successfully.');
				 window.location.href="<?php echo $base_url; ?>superadmin_view_bill.php";
            }
        }
    });
}

</script>