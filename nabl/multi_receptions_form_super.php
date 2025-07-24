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
	<div class="row" style="margin: 0px 0px 0px 0px;">
		
					<h1 style="text-align:center;">
					RECEPTIONIST LIST
						
					</h1>
				</div>
	
	<div class="row">
				<?php
					 $query_rec1 = "select * from multi_login WHERE `staff_isdeleted`='0' AND `staff_isadmin`='2'";
					$select_data = mysqli_query($conn, $query_rec1);					
					if(mysqli_num_rows($select_data) > 0){
					while($row2=mysqli_fetch_array($select_data)){
					$user_id = $row2['id'];
					
					//$qry_Pending12="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `tested_by`='$user_id' AND `job_sent_to_qm`=0 AND `job_owner`=1 ORDER BY job_id DESC";
					 $qry_Pending12="select count(*) cnt from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 0 AND `jobcreatedby_id` ='$user_id'";
					$result12=mysqli_query($conn,$qry_Pending12);
					$cnteng=0;					
					$row4=mysqli_fetch_array($result12);
					$cnteng=$row4['cnt'];
					
					 $dt = date('Y-m-d');
					 $sel_estimate="select count(*) as cnt from report_dispatch where `is_deleted`=0 AND `courier_date`='$dt' AND `created_by` ='$user_id'";
					$query_estimate=mysqli_query($conn,$sel_estimate);
					$row4_sel=mysqli_fetch_array($query_estimate);
					$delivery_counts=$row4_sel['cnt'];
					$cnteng1=0;
					$cnteng1 = $delivery_counts;
					
					$sel_estimate_bill="select * from save_material_assign WHERE `is_deleted`=0 AND `isstatus`=2 AND `created_by` ='$user_id'";
					$result66=mysqli_query($conn,$sel_estimate_bill);
					$cnteng66=0;
					$cnteng66 = mysqli_num_rows($result66);	
					
					
				?>
				
				
				
				<div class="col-md-4">
				  <!-- Widget: user widget style 1 -->
				  <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('images/work_light/engineer.jpg')">
					  <h3 class="widget-user-username"><?php echo $row2['staff_fullname'];?></h3>
					  <h5 class="widget-user-desc">RECEPTIONIST</h5>
					</div>
					<div class="widget-user-image">
					  <img class="img-circle" style="width:75px;height:75px;" src="uplode/<?php echo $row2['id'].'.jpg';?>" alt="<?php echo $row2['staff_fullname'];?>">
					</div>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4 border-right">
						  <div class="description-block">
							<h5 class="description-header"><?php echo $cnteng;?></h5>
							<span class="description-text"><a href="pending_create_trf.php?userid=<?php echo $row2['id']; ?>">PENDING TRF</a></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header"><?php echo $cnteng66;?></h5>
							<span class="description-text"><a href="pending_proceed_compete_trf.php?userid=<?php echo $row2['id']; ?>">PENDING PROCEEDING TRF</a></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						
						<div class="col-sm-4 border-right">
						  <div class="description-block">
							<h5 class="description-header"><?php echo $cnteng1;?></h5>
							<span class="description-text"><a href="submited_report_by_rec.php?userid=<?php echo $row2['id']; ?>">DISPATCH REPORT LIST</a></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  <!-- /.row -->
					</div>
				  </div>
				  <!-- /.widget-user -->
				</div>
				
				<?php
					}
					}
				?>
			
	</div>
	<br>
	

</section>	
</div>  
	
<?php include("footer.php");?>		  
		  
<script>
   /* $(document).ready(function() {
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
	})*/
</script>
<script>


	/*$("#btn_search").click(function(){
					
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
	});*/
	
	
	/*function deleteData(type,id){ 
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
}*/

	/*$(document).on("click", ".submitted_jobs", function () {
				alert("NO SUBMITTED JOBS FOUND..");
					
	
	});
	
	$(document).on("click", ".pending_jobs", function () {
				alert("NO PENDING JOBS FOUND..");
					
	
	});*/


	/*$(document).on("click", ".send_to_second", function () {
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
});*/

/*function get_jobs(){
		
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=get_jobing_for_first_reception',
        success:function(html){
            $('#display_data').html(html);
        }
    });
}
*/
</script>
