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


	$query="SELECT * FROM job WHERE `jobisstatus`='1'"; 
		$qrys = mysqli_query($conn,$query);
		$no_of_rows=mysqli_num_rows($qrys);
		if($no_of_rows>0){
								
			$r = mysqli_fetch_array($qrys);
			$inv_startdate1=$r['fy_startdate'];
			$inv_enddate1=$r['fy_enddate'];
			$inv_for_start_txt= date('d/m/Y', strtotime( $inv_startdate1 ));
			$inv_for_end_txt= date('d/m/Y', strtotime( $inv_enddate1 ));
			$inv_startdate = date('m/d/Y', strtotime( $inv_startdate1 ));
			$inv_enddate = date('m/d/Y', strtotime( $inv_enddate1 ));
			
		}
		$sel_branch="Select * from job";
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
  <div class="content-wrapper" style="margin-left: 0px !important;">
		
		<!-- Main content -->
		<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row" style="margin: 0px 0px 0px 0px;">
		
					<h1 style="text-align:center;">
					SUBMITTED JOB LISTING
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">SUBMITTED JOB LISTING</h3>
				</div>
				<!-- /.box-header -->
					
						<div class="box-body">
							<form class="form" id="billing" method="post">
								<div class="box-body">
									<div class="row">	
										<div class="col-lg-4">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">From Date:</label>

											  <div class="col-sm-9">
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="from_date" name="from_date" value="<?php echo date("d/m/Y");?>" tabindex="1">
													</div>
											  </div>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">To Date:</label>

											  <div class="col-sm-9">
												<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="to_date" name="to_date" value="<?php echo date("d/m/Y");?>" tabindex="2">
													</div>
											  </div>
											</div>
										</div>
										
										
										
										<div class="col-lg-4">
											
											<div class="form-group">
											 
											  <div class="col-sm-12">
												<input type="button" class="btn btn-info pull-right" name="btn_search" id="btn_search" value="Search" tabindex="5">

											  </div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
									
									 <div class="col-lg-4">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-4 control-label">Agency:</label>
												
												<div class="col-sm-8">
											
													<select class="form-control select2 col-md-7 col-xs-12 " style="width:200px" data-placeholder="Select a Agency" id="agency" name="agency" tabindex="3">
														<option value="0">Select..</option>
														<?php  
														$client_query_d = "select * from agency_master where `isdeleted`=0";
													
														$result_client_d = mysqli_query($conn, $client_query_d);

														if (mysqli_num_rows($result_client_d) > 0) {
															while($row_client_d = mysqli_fetch_assoc($result_client_d)) {
															
															
														?>
														<option value="<?php echo $row_client_d['agency_id'];?>"><?php echo $row_client_d['agency_name'];?></option>
														<?php } }?>
												
													</select>
												</div>
											</div>
										</div>
									 <div class="col-sm-4">
									 <label for="inputEmail3" class="col-sm-4 control-label">Customer Name:</label>
											<select class="form-control select2 col-md-7 col-xs-12 " style="width:200px" data-placeholder="Select a Customer" id="clientname" name="clientname" tabindex="4">
														
											<option value="0">Select Customer Name</option>
														<?php  
														$client_query = "select * from client";
													
														$result_client = mysqli_query($conn, $client_query);

														if (mysqli_num_rows($result_client) > 0) {
															while($row_client = mysqli_fetch_assoc($result_client)) {
															
															
														?>
														<option value="<?php echo $row_client['client_code'];?>"><?php echo $row_client['clientname'];?></option>
														<?php } }?>
													</select>
									 </div>
									</div>
								</div>
							</form>
							<hr style="border-top: 1px solid;">

							<br>

							<div id="display_data">
								
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
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		
    } );
 } );
var inv_start_date = "<?php echo $inv_startdate; ?>";
var inv_end_date = "<?php echo $inv_enddate; ?>";
	$('#from_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy',
	  //startDate: new Date(inv_start_date),
	 // endDate: new Date(inv_end_date)
	})
	$('#to_date').datepicker({
	  autoclose: true,
	  format: 'dd/mm/yyyy',
	 // startDate: new Date(inv_start_date),
	  //endDate: new Date(inv_end_date)
	})
		
	$(function () {
		$('.select2').select2()
	})
</script>
<script>


	$("#btn_search").click(function(){
					
					var from_date = $('#from_date').val(); 
					var to_date = $('#to_date').val(); 
					var agency = $('#agency').val(); 
					var clientname = $('#clientname').val(); 
					
					var postData = '&from_date='+from_date+'&to_date='+to_date+'&agency='+agency+'&clientname='+clientname;
			
					$.ajax({
						url : "<?php echo $base_url; ?>search_submitted.php",
						type: "POST", 
						data : postData,
						beforeSend: function(){
						document.getElementById("overlay_div").style.display="block";
						},
						success: function(data,status,  xhr)
						 {
							document.getElementById("overlay_div").style.display="none";
							$("#display_data").html(data);

						 }

					}); 
	});
	
	
	function get_jobs()
	{
			var from_date = $('#from_date').val(); 
					var to_date = $('#to_date').val(); 
					var agency = $('#agency').val(); 
					var clientname = $('#clientname').val(); 
					
					var postData = '&from_date='+from_date+'&to_date='+to_date+'&agency='+agency+'&clientname='+clientname;
			
					$.ajax({
						url : "<?php echo $base_url; ?>search_submitted.php",
						type: "POST", 
						data : postData,
						beforeSend: function(){
						document.getElementById("overlay_div").style.display="block";
						},
						success: function(data,status,  xhr)
						 {
							document.getElementById("overlay_div").style.display="none";
							$("#display_data").html(data);

						 }

					});
	}
	
	
		$(document).on("click", ".send_to_second", function () {
					var report_no = $(this).attr("data-id");  
					
		
		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Send To Edit this Report Job Data ?",
			buttons: {
				confirm: function () {
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>update_status_of_admin.php',
			data: 'action_type=sendrec1&report_no='+report_no,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success:function(html){
				document.getElementById("overlay_div").style.display="none";
				get_jobs();
			}
		});
		
		},
				cancel: function () {
					return;
				}
				}
			})
	});
	
	
	function deleteData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
  
     if (type == 'delete'){
		
			billData = 'action_type='+type+'&id='+id;
				
    }
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>delete_ess_bill.php',
        data: billData,
        success:function(msg){
            if(msg == 'ok'){
                alert('Bill data has been '+statusArr[type]+' successfully.');
                getbills();
              
				  window.location.href="<?php echo $base_url; ?>view_est_bill.php";
				
            }else{
                alert('Bill data has been '+statusArr[type]+' successfully.');
				 window.location.href="<?php echo $base_url; ?>view_est_bill.php";
            }
        }
    });
}

$(window).load(function() {
    var vWidth = $(window).width();
    var vHeight = $(window).height();
    $('.table > section').css('width', vWidth).css('height', vHeight);
});

$(window).resize(function() {
    var vWidth = $(window).width();
    var vHeight = $(window).height();
    $('.table > section').css('width', vWidth).css('height', vHeight);
});
</script>
