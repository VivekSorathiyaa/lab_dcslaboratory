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
if(isset($_SESSION['trf_no']))
{
	unset($_SESSION['trf_no']);
}

if(isset($_SESSION['temporary_trf_no']))
{
	unset($_SESSION['temporary_trf_no']);
}

if(isset($_SESSION['clicking']))
{
	unset($_SESSION['clicking']);
}
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}

/* only for 3d button effects */

.btn3d {
    transition:all .08s linear;
    position:relative;
    outline:medium none;
    -moz-outline-style:none;
    border:0px;
    margin-right:10px;
    margin-top:15px;
}
.btn3d:focus {
    outline:medium none;
    -moz-outline-style:none;
}
.btn3d:active {
    top:9px;
}
.btn-primary {
    box-shadow:0 0 0 1px darkgray inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:darkgray;
}
.btn-success {
    box-shadow:0 0 0 1px #5cb85c inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #4cae4c, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#5cb85c;
}
 .btn-info {
    box-shadow:0 0 0 1px #5bc0de inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #46b8da, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#5bc0de;
}
.btn-warning {
    box-shadow:0 0 0 1px #f0ad4e inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #eea236, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#f0ad4e;
}

.btn-danger {
    box-shadow:0 0 0 1px #c63702 inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #C24032, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#c63702;
}
.form-control { 
font-size: 16px;; 
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
			<div class="col-md-4">
			<h1 style="">
			<a  class="btn btn-info" href="add_voucher.php" title="ADD LIBRARY" style="margin-left:10px;">ADD VOUCHER</a>
			</h1>
			</div>
			<div class="col-md-3">
			<h1 style="text-align:center;">Voucher List</h1>
			</div>
			</div>
<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				
				<!-- /.box-header -->
					
					
						<div class="box-body">
						
						<div id="display_data">
								<table id="example1" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;width:6%;">Serial No</th>
										<th style="text-align:center;width:1%;">Voucher Code</th>
										<th style="text-align:center;width:1%;">Voucher Date</th>
										<th style="text-align:center;width:1%;">Person Name</th>
										<th style="text-align:center;width:1%;">Description</th>
										<th style="text-align:center;width:1%;">Amount</th>
										<th style="text-align:center;width:1%;">Payment Type</th>
										<th style="text-align:center;width:1%;">Remark Type</th>
										<th style="text-align:center;width:6%;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from st_voucher WHERE `is_deleted`=0 ORDER BY voucher_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['voucher_code'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo date('d-m-Y', strtotime($row['voucher_date']));?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['given_person'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['discription'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['amount'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['payment_type'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['remark_type'];?></td>
											<td>
											<a href="javascript:void(0)" class="btn btn-danger delete_vouch" title="Delete" data-id="<?php echo $row['voucher_id'];?>">
											Delete
											</a>
											</td>
											
										</tr>
									<?php
										}	
									?>
								</tbody>
								
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
<link rel="stylesheet" href="https://www.jquery-az.com/boots/css/bootstrap-multiselect/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="https://www.jquery-az.com/boots/js/bootstrap-multiselect/bootstrap-multiselect.js"></script>	  
<script type="text/javascript" src="https://www.jquery-az.com/boots/js/selectr/selectr.js"></script>

<script>
    $(document).ready(function() {
   ;
	var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    } );
	
 } );
 $(function () {
		$('.select2').select2()
	})
 $('#sample_rec_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
$(document).on("click",".delete_vouch",function(){
					
					var delete_vouch_id = $(this).attr("data-id"); 
					if(confirm("Are You Sure To Delete..?"))
					{
						
					
						var postData = '&action_type=delete_vouch&delete_vouch_id='+delete_vouch_id;
				
						$.ajax({
							url : "save_voucher.php",
							type: "POST",
							data : postData,
							success: function(data,status,  xhr)
							 {
								alert("Voucher Is Successfully Deleted");
								window.location.href="voucher_list.php";

							 }

						}); 
					}	
	});
 </script>