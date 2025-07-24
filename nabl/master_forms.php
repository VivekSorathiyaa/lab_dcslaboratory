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
   
  
<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
	<div class="row">
		
		<h1 style="text-align:center;">
		MASTER FORMS
			
		</h1>
	</div>
	<div class="row">
			<div class="col-md-12">
          <!-- Application buttons -->
          <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">MASTER FIELDS</h3>
            </div>-->
            <div class="box-body" style="text-align:center; border-top: 3px solid var(--primary);">
             <!-- <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a></code> tag to achieve the following:</p>-->
              <a class="btn btn-app" href="staff.php" >
                <i class="fa fa-users"></i> <b style="font-size:16px">Staff</b>
              </a>
              <a class="btn btn-app" href="city.php" >
                <i class="fa fa-globe"></i> <b style="font-size:16px">City</b>
              </a>
              <a class="btn btn-app" href="view_customer_lists.php" style="width:15%">
               
                <i class="fa fa-building-o"></i> <b style="font-size:16px">Client (End Customer)</b>
              </a>
			  
			  <a class="btn btn-app" href="agency.php" style="width:20%">
               
                <i class="fa fa-building-o"></i> <b style="font-size:16px">Agency/Contractor/Customer</b>
              </a>
			  
			  <a class="btn btn-app" href="view_tpi_lists.php" >
               
                <i class="fa fa-building-o"></i> <b style="font-size:16px">Tpi</b>
              </a>
			  
			  <a class="btn btn-app" href="view_pmc_lists.php" >
               
                <i class="fa fa-building-o"></i> <b style="font-size:16px">Pmc</b>
              </a>
				<a class="btn btn-app" href="set_agency_rate.php" >
               
                <i class="fa fa-building-o"></i> <b style="font-size:16px">Agency Rate By Test</b>
              </a>
				<a class="btn btn-app" href="set_agency_rate_by_material.php" >
               
                <i class="fa fa-building-o"></i> <b style="font-size:16px">Agency Rate By Material</b>
              </a>
              <a class="btn btn-app" href="tax.php" >                
                <i class="fa fa-money"></i> <b style="font-size:16px">Tax</b>
              </a>
              <a class="btn btn-app" href="material_category.php" >
                <i class="fa fa-list-alt"></i> <b style="font-size:16px">Category</b>
              </a>
              <a class="btn btn-app" href="material.php" >
                <i class="fa fa-industry"></i> <b style="font-size:16px">Material</b>
              </a>
			  
              <a class="btn btn-app" href="test_master.php" >
                <i class="fa fa-indent"></i> <b style="font-size:16px">Test</b>
              </a>
			  
			  <a class="btn btn-app" href="ulr.php" >
                <i class="fa fa-address-book-o"></i> <b style="font-size:16px">Ulr</b>
              </a>
			  
			  <a class="btn btn-app" href="view_desk_gallery.php" >
                <i class="fa fa-image"></i> <b style="font-size:16px">Dektop Images</b>
              </a>
			  
			  <a class="btn btn-app" href="year.php" >
                <i class="fa fa-calendar"></i> <b style="font-size:16px">Year</b>
              </a>
			  
			   <a class="btn btn-app" href="fine_agg_register.php" >
                <i class="fa fa-list"></i> <b style="font-size:16px">Material Register</b>
              </a>
			 
			  <a class="btn btn-app" href="sign_auth.php" >
                <i class="fa fa-sign-in"></i> <b style="font-size:16px">Sign Authority</b>
              </a>
			   <a class="btn btn-app" href="view_calibration_list.php" style="width:15%">
                <i class="fa fa-gear"></i> <b style="font-size:16px">Equipment Calibration</b>
              </a>
			  <a class="btn btn-app" href="more_for_admin.php" >
                <i class="fa fa-address-book-o"></i> <b style="font-size:16px">More</b>
              </a>
			  <a class="btn btn-app" href="whatsapp.php" >
                <i class="fa fa-address-book-o"></i> <b style="font-size:16px">Whatsapp</b>
              </a>
			   <a class="btn btn-app" href="tasks.php" >
                <i class="fa fa-address-book-o"></i> <b style="font-size:16px">Tasks</b>
              </a>
			  
			  <a class="btn btn-app" href="view_library_list.php" >
                <i class="fa fa-address-book-o"></i> <b style="font-size:16px">Library</b>
              </a>
			
            </div>
            <!-- /.box-body -->
          </div>
	</div>

	<br>

<?php
		
		$query1="select * from job WHERE `admin_status_rec_1`=1 ORDER BY job_id DESC";
		$result1=mysqli_query($conn,$query1);
		if(mysqli_num_rows($result1) > 0)
		{
										
	?>
	
<?php
		}
?>

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
	  format: 'dd-mm-yyyy'
	})
	$('#to_date').datepicker({
	  autoclose: true,
	  format: 'dd-mm-yyyy'
	})
		
	$(function () {
		$('.select2').select2()
	})
</script>
<script>


	$("#btn_search").click(function(){
					
					var from_date = $('#from_date').val(); 
					var to_date = $('#to_date').val(); 
					
					var postData = '&from_date='+from_date+'&to_date='+to_date+'&get_by_rece_second=get_by_rece_second';
			
					$.ajax({
						url : "<?php echo $base_url; ?>search_job_listing.php",
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
  
     if (type == 'delete'){
		
			billData = 'action_type='+type+'&id='+id;
				
    }
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>delete_ess_bill.php',
        data: billData,
        success:function(msg){
			alert("kkkkkk");
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


	$(document).on("click", ".send_to_second", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=send_job_to_second_reception&clicked_id='+clicked_id,
        success:function(html){
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

function get_jobs(){
		
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=get_jobing_for_first_reception',
        success:function(html){
            $('#display_data').html(html);
        }
    });
}

</script>
