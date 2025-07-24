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

if(isset($_SESSION['reporting_no']))
{
	unset($_SESSION['reporting_no']);
}

if(isset($_SESSION['jobing_no']))
{
	unset($_SESSION['jobing_no']);
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
		
		<!-- Main content -->
		<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row" style="margin: 0px 0px 0px 0px;">
		
					<h1 style="text-align:center;">
					JOB INWARD REGISTER
						
					</h1>
				</div>
				<div class="row">
				<div class="col-md-12">
				
				<div class="nav-tabs-custom">
					<div class="tab-content">
						<div class="active tab-pane" id="clients">
						<form class="" method="post" >
							<div class="row">
										<div class="col-md-3">																			
												<input type="text" class="col-sm-12 form-control" id="from_date" tabindex="8" name="from_date"  placeholder="FROM DATE">
										</div>
										<div class="col-md-3">																			
												<input type="text" class="col-sm-12 form-control" id="to_date" tabindex="8" name="to_date"  placeholder="TO DATE">
										</div>
										<div class="col-md-3">																			
											<button type="button" class="btn btn-info"  onclick="search_data('search_data')" name="btn_add_data1" id="btn_add_data1" style="width:100%" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
										</div>
										<div class="col-md-3">																			
											<button type="button" class="btn btn-info"  onclick="search_data('all_data')" name="btn_add_data" id="btn_add_data" style="width:100%" ><i class="fa fa-database" aria-hidden="true"></i>&nbsp;View All</button>
										</div>
											
							</div>
							
							<hr width="80%">
							<br>
									
							</form>
						</div>
					 
							<!-- /.tab-pane -->

					</div>
				

				</div>
				</div>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<!--<h3 class="box-title">JOB INVERT FINAL LISTING&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal">Light Indication</button></h3>-->
				</div>
				<!-- /.box-header -->
					
						<div class="box-body">
							

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

	$(document).on("click", ".send_to_second", function () {
					var report_no = $(this).attr("data-id");  
					
		
		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Delete This Job ?",
			buttons: {
				confirm: function () {
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>delete_ess_bill.php',
			data: 'action_type=delete_bill&report_no='+report_no,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success:function(html){
				document.getElementById("overlay_div").style.display="none";
				getJobs();
			}
		});
		
		},
				cancel: function () {
					return;
				}
				}
			})
	});


// add data
function search_data(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'search_data') {
				var from_date = $('#from_date').val(); 
				var to_date = $('#to_date').val(); 
				
				
				if(from_date !="" || to_date !="" ){
					
				billData = '&action_type='+type+'&from_date='+from_date+'&to_date='+to_date;
				}else{
					alert(" All Filled Required");
					return false;
				}
				
				//exit();
				
    }
	else if(type == 'all_data') {
				billData = '&action_type='+type;
	}
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>search_inward_register.php',
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
	

</script>
