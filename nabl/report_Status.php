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

	/*$query="SELECT * FROM fyearmaster WHERE `fy_status`='1'";
  
     $qrys = mysqli_query($conn,$query);
    $no_of_rows=mysqli_num_rows($qrys);
    if($no_of_rows>0){
                
      $r = mysqli_fetch_array($qrys);
      $year=$r['fy_name'];      
    }
   $get_query = "select COUNT(*) as cnt from estimate_total_span WHERE `est_isdeleted`='0'"; 
    $select_result = mysqli_query($conn, $get_query);
    
    $result=mysqli_fetch_array($select_result);
    $esticnt=$result['cnt'];


    $get_query1 = "select COUNT(*) as cnt from estimate_total_span WHERE `est_isdeleted`='0' AND `is_billing`='1'"; 
    $select_result1 = mysqli_query($conn, $get_query1);
    
    $result1=mysqli_fetch_array($select_result1);
    $billcnt=$result1['cnt'];

    $get_query2 = "select COUNT(*) as cnt from job WHERE `jobisdeleted`='0'"; 
    $select_result2 = mysqli_query($conn, $get_query2);
    
    $result2=mysqli_fetch_array($select_result2);
    $usercnt=$result2['cnt'];


    $get_query3 = "select COUNT(*) as cnt from agency_master"; 
    $select_result3 = mysqli_query($conn, $get_query3);
    
    $result3=mysqli_fetch_array($select_result3);
    $agencycnt=$result3['cnt'];
	
	
	$cur = date('Y-m-d');
	$get_query_cur = "select COUNT(*) as cnt from job WHERE `jobisdeleted`='0' and `jobcreateddate` = '$cur'"; 
    $select_result_cur = mysqli_query($conn, $get_query_cur);
    
    $result_cur=mysqli_fetch_array($select_result_cur);
    $usercnt_cur=$result_cur['cnt'];

	 $get_query_es = "select sum(total_amt) as sm from estimate_total_span WHERE `est_isdeleted`='0' AND `estimate_date` = '$cur' and `is_billing`='0'"; 
    $select_result1_es = mysqli_query($conn, $get_query_es);
    
    $result1_es=mysqli_fetch_array($select_result1_es);
    $total_amt=$result1_es['sm'];
	
	
	 $get_query_es = "select * from estimate_total_span WHERE `est_isdeleted`='0' AND `est_modifydate` = '$cur' and `is_billing`='1'";
    $select_result1_es = mysqli_query($conn, $get_query_es);
    $tt=0;    
	while($row1=mysqli_fetch_array($select_result1_es))
	{
		 $patytp=$row1['paytype'];
		
		if($patytp != 3)
		{
			$tt += $row1['total_amt'];
		}
	}*/


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
					REPORT STATUS						
		</h1>		
	</div>
	<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">REPORT STATUS</h3>
				</div>
				<!-- /.box-header -->
					
						<div class="box-body">
							<form class="form" id="billing" method="post">
								<div class="box-body">
									<div class="row">	
										<div class="col-lg-4">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">ENTER REPORT NO TO SEARCH:</label>

											  <div class="col-sm-9">
													
														
														<input type="text" class="form-control pull-right" id="rpt_no" name="rpt_no"  tabindex="1">
												
											  </div>
											</div>
										</div>
										
										
										<div class="col-lg-4">
											
											<div class="form-group">
											 
											  <div class="col-sm-12">
												<input type="button" class="btn btn-info pull-right" name="btn_search" id="btn_search" value="Search" tabindex="2">

											  </div>
											</div>
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
	
      <!-- /.row -->
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


		$("#btn_search").click(function(){
					
					var rpt_no = $('#rpt_no').val(); 
					//var to_date = $('#to_date').val(); 
					
					var postData = '&rpt_no='+rpt_no;
			
					$.ajax({
						url : "<?php echo $base_url; ?>rpt_srs.php",
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

	$(document).on("click", ".submitted_jobs", function () {
				alert("NO SUBMITTED JOBS FOUND..");
					
	
	});
	
	$(document).on("click", ".pending_jobs", function () {
				alert("NO PENDING JOBS FOUND..");
					
	
	});


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
