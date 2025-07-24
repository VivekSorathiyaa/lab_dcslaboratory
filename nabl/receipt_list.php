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
			<a  class="btn btn-info" href="add_receipt.php" title="ADD RECEIPT" style="margin-left:10px;">ADD Payment In</a>
			</h1>
			</div>
			<div class="col-md-3">
			<h1 style="text-align:center;">Payment In</h1>
			</div>
			</div>
			
			<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
								<label>AGENCY:</label>
									<select class="form-control select2" name="sel_client" id="sel_client" >
									<option value="">Select-Agency</option>
									<?php
									$clients="select * from agency_master where `isdeleted`=0";
									$query_client=mysqli_query($conn,$clients);
									if(mysqli_num_rows($query_client) > 0)
									{
										while($one_client=mysqli_fetch_array($query_client))
										{
									?>
										<option value="<?php echo $one_client["agency_id"];?>"><?php echo $one_client["agency_name"];?></option>
									<?php
										}
									}
									?>
									</select>
			</div>
			<div class="col-md-2">
								<label>CLIENT:</label>
									<select class="form-control select2" name="sel_auth" id="sel_auth" >
									<option value="">Select-Client</option>
									<?php
									$clients="select * from client where `clientisdeleted`=0";
									$query_client=mysqli_query($conn,$clients);
									if(mysqli_num_rows($query_client) > 0)
									{
										while($one_client=mysqli_fetch_array($query_client))
										{
									?>
										<option value="<?php echo $one_client["client_code"];?>"><?php echo $one_client["clientname"];?></option>
									<?php
										}
									}
									?>
									</select>
			</div>
			
			<div class="col-md-2">
			<label>FROM DATE:</label>
			<input type="text" name="from_date" id="from_date" class="form-control" placeholder="Enter From Date">
			</div>
			<div class="col-md-2">
			<label>TO DATE:</label>
			<input type="text" name="to_date" id="to_date" class="form-control" placeholder="Enter To Date">
			</div>
			</div>
			<br>
			<div class="row">
			<div class="col-md-1"></div>
			
			<div class="col-md-2">
								<label>Payment Type:</label>
									<select class="form-control select2" name="pay_types" id="pay_types" >
									<option value="">Select Payment Type</option>
									<option value="Cash">Cash</option>
									<option value="Cheque">Cheque</option>
									<option value="RTGS">RTGS</option>
									</select>
			</div>
			<div class="col-md-2">	
				<label>&nbsp;</label>
			<button type="button" class="btn btn-info"  onclick="search_data('search_data')" name="btn_add_data1" id="btn_add_data1" style="width:100%" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
			</div>
			</div>
			<br>
<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				
				<!-- /.box-header -->
					
					
						<div class="box-body">
							<div id="display_data"></div>
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
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    });
	
 } );
 $(function () {
		$('.select2').select2()
	})
 $('#from_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
$('#to_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
function search_data(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'search_data') {
				var sel_client = $('#sel_client').val(); 
				var sel_auth = $('#sel_auth').val(); 
				var from_date = $('#from_date').val(); 
				var to_date = $('#to_date').val(); 
				var pay_types = $('#pay_types').val(); 
				
				if(sel_client =="" && sel_auth =="")
				{
					alert("Please Select Only One, Client Or Authority");
					return false;
					
				}
				if(sel_client !="" && sel_auth !="")
				{
					alert("Please Select Only One, Client Or Authority");
					return false;
					
				}
				if(sel_client !="" && sel_auth =="")
				{
					var user_type="0";
					var sends=$('#sel_client').val();
				}
				
				if(sel_client =="" && sel_auth !="")
				{
					var user_type="1";
					var sends=$('#sel_auth').val();
				}
				
				
				
				if(from_date !="" && to_date =="" || from_date =="" && to_date !="")
				{
					alert("Please Select Date Properly");
					return false;
				}
				
				billData = '&action_type='+type+'&user_type='+user_type+'&sends='+sends+'&from_date='+from_date+'&to_date='+to_date+'&pay_types='+pay_types;		
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>search_receipt.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},		
        success:function(msg){
		document.getElementById("overlay_div").style.display="none";
		
		$("#display_data").html(msg);
		//$(".class_submit").show();
		
        }
    });
}

$(document).on("click",".delete_receipt",function(){
					
					var delete_rec_id = $(this).attr("data-id"); 
					if(confirm("Are You Sure To Delete..?"))
					{
						
					
						var postData = '&action_type=delete_receipt&delete_rec_id='+delete_rec_id;
				
						$.ajax({
							url : "save_receipt.php",
							type: "POST",
							data : postData,
							success: function(data,status,  xhr)
							 {
								alert("Receipt Is Successfully Deleted");
								window.location.href="receipt_list.php";

							 }

						}); 
					}	
	});
 </script>