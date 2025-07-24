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





.myElement{    

position: relative;    
z-index: 999;    
margin: 0em 0em;    
padding: 4px;           
transition: 10s cubic-bezier(0,1.5,.5,1);
}
.myElement:hover {    	
transform: 
scale(3.5);	
margin-right: 400px;
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
					ENGINEERS LIST
						
					</h1>
				</div>
	
	<div class="row">
				<?php
					 $query_rec1 = "select * from multi_login WHERE `staff_isdeleted`='0' AND `staff_isadmin`='4'";
					$select_data = mysqli_query($conn, $query_rec1);					
					if(mysqli_num_rows($select_data) > 0){
					while($row2=mysqli_fetch_array($select_data)){
					$user_id = $row2['id'];
					
					$qry_Pending12="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'r' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND  `job_sent_to_qm`=0 AND `job_owner` != 1 ORDER BY job_id DESC";
					$result12=mysqli_query($conn,$qry_Pending12);
					$cnteng=0;
					while($row=mysqli_fetch_array($result12))
					{
						if($row["job_owner"] !='2')
						{
							$tested_by_explode=explode(",",$row["tested_by"]);
							$tested_by_status_explode=explode(",",$row["tested_by_status"]);
							if (in_array($user_id, $tested_by_explode))
							{
								$value_position=array_search($user_id,$tested_by_explode,true);
							    if($tested_by_status_explode[$value_position]=="0")
							    {
									$cnteng++;
								}
							}
						}
					}
					
					
					$qry_Pending13="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'r' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND  `job_sent_to_qm`=0 AND `job_owner` != 1 ORDER BY job_id DESC";
					$result13=mysqli_query($conn,$qry_Pending13);
					$cnteng1=0;
					while($row=mysqli_fetch_array($result13))
					{
						if($row["job_owner"] !='2')
						{
							$tested_by_explode=explode(",",$row["tested_by"]);
							$tested_by_status_explode=explode(",",$row["tested_by_status"]);
							if (in_array($user_id, $tested_by_explode))
							{
								$value_position=array_search($user_id,$tested_by_explode,true);
							    if($tested_by_status_explode[$value_position]=="0")
							    {
									$cnteng1++;
								}
							}
						}
					}
					
						
					
					 $qry66="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `job_sent_to_qm`=0 AND `tested_by`='$user_id' AND `job_owner`=2 ORDER BY job_id DESC";
					$result66=mysqli_query($conn,$qry66);
					$cnteng66=0;
					$cnteng66 = mysqli_num_rows($result66);	
					
					
				?>
				
				
				
				<div class="col-md-4">
				  <!-- Widget: user widget style 1 -->
				  <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('images/work_light/engineer.jpg')">
					  <h3 class="widget-user-username"><?php echo $row2['staff_fullname'];?></h3>
					  <h5 class="widget-user-desc">ENGINEERS</h5>
					</div>
					<div class="widget-user-image">
					  <img class="img-circle myElement" style="width:100px;height:100px;" src="uplode/<?php echo $row2['id'].'.jpg';?>" alt="<?php echo $row2['staff_fullname'];?>">
					</div>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-6 border-right">
						  <div class="description-block">
							<h5 class="description-header"><?php echo $cnteng;?></h5>
							<span class="description-text"><a href="Job_inward_lab.php?userid=<?php echo $row2['id']; ?>">ARRIVAL JOBS</a></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<!--<div class="col-sm-4 border-right">
						  <div class="description-block">
							<h5 class="description-header"><?php //echo $cnteng1;?></h5>
							<span class="description-text"><a href="eng_job_inwerd_for_superadmin.php?userid=<?php //echo $row2['id']; ?>">WORKING JOBS</a></span>
						  </div>
						  <!-- /.description-block
						</div>-->
						<!-- /.col -->
						<div class="col-sm-6">
						  <div class="description-block">
							<h5 class="description-header"><?php echo $cnteng1;?></h5>
							<span class="description-text"><a href="eng_pending_job_for_super_admin.php?userid=<?php echo $row2['id']; ?>">PENDING JOBS</a></span>
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
