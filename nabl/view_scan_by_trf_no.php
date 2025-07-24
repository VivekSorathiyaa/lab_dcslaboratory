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

$finaling="select * from final_material_assign_master where `trf_no`='$_GET[trf_no]' AND `is_scan`='0'";
$query_finaling=mysqli_query($conn,$finaling);
if(mysqli_num_rows($query_finaling) == 0){
	$up_job="update job set `is_scan`='1' where `trf_no`='$_GET[trf_no]'";
	mysqli_query($conn,$up_job);
}else{
	$up_job="update job set `is_scan`='0' where `trf_no`='$_GET[trf_no]'";
	mysqli_query($conn,$up_job);
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
   
<section class="content"  style="padding: 0px;margin-right: auto;margin-left: auto; padding-left: 0px; padding-right: 0px; ">
			<?php include("menu.php") ?>
			<!--<div class="row">
		
		<h1 style="text-align:center;">
		View Reports
		</h1>
	</div>-->
<div class="row">
				
		<div class="row">
		
		<h1 style="text-align:center;">
		Scan For Job No : <?php echo $_GET["trf_no"];?>
		</h1>
	</div>		
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				
				<!-- /.box-header -->
					
					
						<div class="box-body">
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;width:1%;">Serial No</th>
										<th style="text-align:center;width:1%;">Action</th>
										<th style="text-align:center;width:1%;">Report No</th>
										<th style="text-align:center;width:1%;">Agency Name</th>
										<th style="text-align:center;width:1%;">Client</th>
										<th style="text-align:center;width:1%;">Tpi</th>
										<th style="text-align:center;width:1%;">pmc</th>
										<th style="text-align:center;width:1%;">Material</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=1;
											$query="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$_GET[trf_no]'";
											$results=mysqli_query($conn,$query);
											$rowing=mysqli_fetch_array($results);
											$billing_to_id=$rowing["billing_to_id"];
											$sel_agency_for_bill_to="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$rowing["billing_to_id"];
											$result_agency_for_bill_to =mysqli_query($conn,$sel_agency_for_bill_to);
											$row_agency_for_bill_to =mysqli_fetch_array($result_agency_for_bill_to);
											$agency_email=$row_agency_for_bill_to["agency_email"];
											$agency_name_email=$row_agency_for_bill_to["agency_name"];
											
											
											if($rowing["agency"]!= ""){
											$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$rowing["agency"];
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];
											}else{
												$agency_name="";
											}
											
											if($rowing["client_code"] !=""){
											 $sel_client1="select * from client where `clientisdeleted`=0 and `client_code`=".$rowing["client_code"];
											$result_client1 =mysqli_query($conn,$sel_client1);
											$row_client1 =mysqli_fetch_array($result_client1);
											 $client_name=$row_client1["clientname"];
											}
											else{
												$client_name="";
											}
											
											$sel_final="select * from final_material_assign_master where `trf_no`='$_GET[trf_no]'";
											$query_final=mysqli_query($conn,$sel_final);
											if(mysqli_num_rows($query_final) > 0)
											{
												while($row_final=mysqli_fetch_array($query_final))
												{
													$sel_mates="select * from material where `id`=".$row_final["material_id"];
													$query_mates=mysqli_query($conn,$sel_mates);
													$row_mates=mysqli_fetch_array($query_mates);
													$set_materilas = $row_mates["mt_name"].", ";
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<?php
											if($row_final["is_scan"]=="0"){ ?>
											<input type="file" class="uplodings" id="uploads_<?php echo $count;?>" style="width: 125px;font-size: 20px;" multiple >
											<?php }else{ 
											 $sel_docs="select * from scanned_trf_document where `trf_no`='$row_final[trf_no]' AND `report_no`='$row_final[report_no]'";
											$rep_docs=mysqli_query($conn,$sel_docs);
											$results=mysqli_fetch_array($rep_docs);
											$filesed=$results["document"];
											?>
											<a href="scanned_document/<?php echo $filesed;?>" class="btn btn-primary" target="_blank" title="VIEW DOCUMENT"><span class="fa fa-eye"></span></a>
											
											<a href="javascript:void(0);" class="btn btn-danger delete_scaned" data-id="<?php echo $row_final['report_no']."|".$row_final['trf_no'];?>" title="DELETE UPLOADED FILE" ><span class="fa fa-trash"></span></a>
											<?php } ?>
											</td>
											
											<td style="white-space:nowrap;text-align:center;"><?php echo $row_final['report_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $client_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $rowing['tpi_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $rowing['pmc_name'];?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php echo $set_materilas;?>
											<input type="hidden" id="txt_<?php echo $count;?>" value="<?php echo $row_final['report_no'].'|'.$row_final['trf_no'].'|'.$agency_email.'|'.$billing_to_id.'|'.$agency_name_email;?>">
											</td>
											
										</tr>
									<?php
												$count++;
												}
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
<script>
$(document).ready(function(){
	
	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    } );

});



$(document).on("change", ".uplodings", function () {
                var fd = new FormData();
                var files = $(this)[0].files[0];
				var idss=$(this).attr("id");
				var spliteds= idss.split("_");
				var set_ids= "#txt_"+spliteds[1];
				var txt_boxes= $(set_ids).val();
				
				var spliting= txt_boxes.split("|");
				var	trf_nos= spliting[1];
				var acb = $(this).val();
				
	
		if(acb ==""){
			alert("Please Select File First");
			return false;
		}
               var totalfiles = $(this)[0].files.length;
			   
			   for (var index = 0; index < totalfiles; index++) {
				 
				   var sizes = $(this)[0].files[index].size ;
				   if(sizes < 10380902)
					{
						
						 fd.append("file[]", $(this)[0].files[index]);
					}
			   }

			   
			   fd.append('action_type', "add");
                fd.append('txt_boxes', txt_boxes);
       
                $.ajax({
                    url: 'save_scanners.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        //if(response != 0){
                          // alert('file uploaded');
						   window.location.href="<?php echo $base_url; ?>view_scan_by_trf_no.php?trf_no="+trf_nos+"&&job_no="+trf_nos;
                       // }
                       // else{
                       //     alert('file not uploaded');
                       //}
                    },
                });
            });
			
$(document).on("click", ".delete_scaned", function () {
	var clicked_id = $(this).attr("data-id");  
	var spliting= clicked_id.split("|");
    var	trf_nos= spliting[1];
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Uploded Document?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_scanners.php',
        data: 'action_type=delete_scaned&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>view_scan_by_trf_no.php?trf_no="+trf_nos+"&&job_no="+trf_nos;
			
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