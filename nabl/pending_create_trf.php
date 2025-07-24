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
$user_id = $_GET['userid'];	

	
		
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
					PENDING TO CREATE TRF
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">PENDING TO CREATE TRF</h3>
				</div>
				<!-- /.box-header -->
					
						<div class="box-body">
							

							<div id="display_data">
							
								<table id="example1" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Assign To</th>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Sample Receive Date</th>
										<th style="text-align:center;">Token No.</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 0 AND `jobcreatedby_id`='$_GET[userid]' ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											
									?>
											<tr id="<?php echo $row['temporary_trf_no'];?>">
											
											<td style="white-space:nowrap;">
											
											<select name="sel_assign_to" class="form-control sel_assign_to" style="width:100%">
											<?php
											$sel_staff="select * from multi_login where `staff_isadmin`=2";
											$query_staff=mysqli_query($conn,$sel_staff);
											if(mysqli_num_rows($query_staff) > 0){
												
										while($one_staff=mysqli_fetch_array($query_staff)){
											?>
											
											<option value="<?php echo $one_staff["id"]."|".$row['temporary_trf_no']; ?>" <?php if($row["jobcreatedby_id"]==$one_staff["id"]){ echo "selected"; }?>><?php echo $one_staff["staff_fullname"]; ?></option>
											<?php
											} }
											?>
											</select>
											</td>
											
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php
											$date=date_create($row['sample_rec_date']);
											echo date_format($date,"d/m/Y");
											?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['temporary_trf_no'];?></td>
											<td style="text-align:center;">
											
											<a href="edit_client_form.php?temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-warning btn-lg btn3d" title="Edit Job"><span class="glyphicon glyphicon-question-list"></span> Edit</a>
											&nbsp;
											
											<a href="span_material_assigning_by_super_admin.php?temporary_trf_no=<?php echo $row['temporary_trf_no'];?>&&user_id=<?php echo $GET['userid'];?>" class="btn btn-primary btn-lg btn3d" title="Material Assign"><span class="glyphicon glyphicon-question-list"></span> Material Selection</a>
											&nbsp;
											<?php if($row['scan_document'] !=""){?>
											<a href="<?php echo $base_url."scan_document/".$row['scan_document'] ?>" class="btn btn-success btn-lg btn3d" title="Downlaod Document" download><span class="glyphicon glyphicon-question-downlaod"></span> Downlaod</a>
											
										<?php }?>
										</td>
										</tr>
									<?php
										}	
									?>
								</tbody>
								
							  </table>
								
							</div>
								
								
		
								
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

	
	$(function () {
		$('.select2').select2()
	})
</script>
<script>


	$("#btn_search").click(function(){
					
					var from_date = $('#from_date').val(); 
					var to_date = $('#to_date').val(); 
					var agency = $('#agency').val(); 
					var user_id = <?php echo $user_id;?>
					
					var postData = '&from_date='+from_date+'&to_date='+to_date+'&user_id='+user_id;
			
					$.ajax({
						url : "<?php echo $base_url; ?>search_pending_finaljob.php",
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

$(document).on('change','.sel_assign_to',function(){
  var val = $('option:selected',this).val();
  
  var idss= val.split('|');
  var delete_tr="#"+idss[1];
  
  billData = 'action_type=change_assign&val='+val;
  
  $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>change_resp_pending_trf.php',
        data: billData,
        success:function(msg){
            $(delete_tr).remove();
        }
    });
});

//Work FOr delete job by report no from all related tables
 $(document).on("click", ".delete_jobs", function () {
	var clicked_id = $(this).attr("data-id");  
		
		var idss= clicked_id.split('/');
		var delete_tr="#"+idss[2];
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=delete_the_jobs&clicked_id='+clicked_id,
        success:function(html){
			alert("Job Successfully Deleted..");
			$(delete_tr).remove();
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
