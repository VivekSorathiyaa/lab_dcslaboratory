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
		Complete Email List
		</h1>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="scanned_list.php" class="btn btn-success btn-lg " title="Pending"><span class="glyphicon glyphicon-question-ok"></span> Pending Email</a>
		
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-danger btn-lg   merging_perfoma" title="Merge"><span class="glyphicon glyphicon-question-ok"></span> SEND</a>
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
										<th style="width:1%;">Select</th>
										<th style="text-align:center;width:1%;">View Pdf</th>
										<th style="text-align:center;width:1%;">Report No</th>
										<th style="text-align:center;width:1%;">Agency Name</th>
										<th style="text-align:center;width:1%;">Agency Email</th>
										<th style="text-align:center;width:1%;">Client Name</th>
										<th style="text-align:center;width:1%;">Material</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=1;
											$sel_scaned="select * from scanned_trf_document where `is_deleted`=0 AND `mail_status`='1'";
											$query_scanned=mysqli_query($conn,$sel_scaned);
											if(mysqli_num_rows($query_scanned) > 0)
											{
												while($row_scanned=mysqli_fetch_array($query_scanned))
												{
													
													$sel_scaner="select * from job where `trf_no`='$row_scanned[trf_no]'";
													$query_scan=mysqli_query($conn,$sel_scaner);
													$result_scanner=mysqli_fetch_array($query_scan);
													$agency_names=$result_scanner["agency_name"];
													$agency=$result_scanner["billing_to_id"];
													$clientname=$result_scanner["clientname"];
													
													$sel_final="select * from final_material_assign_master where `report_no`='$row_scanned[report_no]'";
													$query_final=mysqli_query($conn,$sel_final);
													$result_final=mysqli_fetch_array($query_final);
													$material_id=$result_final["material_id"];
													
													$sel_mate="select * from material where `id`=".$material_id;
													$query_mate=mysqli_query($conn,$sel_mate);
													$result_mate=mysqli_fetch_array($query_mate);
													$mt_name=$result_mate["mt_name"];
													
													$sel_agency="select * from agency_master where `agency_id`=".$agency;
													$query_agency=mysqli_query($conn,$sel_agency);
													$result_agency=mysqli_fetch_array($query_agency);
													$agency_name=$result_agency["agency_name"];
													$agency_email=$result_agency["agency_email"];
												
									
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="">
											<input type="checkbox" name="chk_tfr" class="chk_tfr" value="<?php echo $row_scanned["scan_id"]; ?>">
											</td>
											<td style="text-align:center;">
											<a href="scanned_document/<?php echo $row_scanned['document'];?>" class="btn btn-primary" target="_blank" title="VIEW DOCUMENT"><span class="fa fa-eye"></span></a>
											<a href="javascript:void(0);" class="btn btn-primary opennd" data-id="<?php echo $agency;?>" title="Open" ><span class="fa fa-edit"></span></a>
											<input type="text" style="width:400px;display:none;" class="hide_class" id="<?php echo $agency; ?>" value="<?php echo $agency_email;?>">
											
											</td>
											
											<td style="white-space:nowrap;text-align:center;"><?php echo $row_scanned['report_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_email;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $clientname;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $mt_name;?></td>
											
											
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
		pageLength: 100,
    } );

});

$(document).on("click", ".opennd", function () 
{
	var datas=$(this).attr("data-id");
	var set_ids="#"+datas;
	$(set_ids).toggle();
});

$(document).on("blur", ".hide_class", function () 
{
	var datas=$(this).attr("id");
	var set_ids="#"+datas;
	var txt_val=$(set_ids).val();
	
	$.ajax({
				type: 'POST',
				url: '<?php $base_url; ?>save_scanners.php',
				data: 'action_type=update_emails&txt_val='+txt_val+'&datas='+datas,
				beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
				success:function(html){
					document.getElementById("overlay_div").style.display="none";
					window.location.href="<?php echo $base_url; ?>sent_mail_list.php";
				}
				});
	
});



$(document).on("click", ".merging_perfoma", function () {
					
		var chk_array = [];
		var is_pending="no";
        var oTable = $("#example2").dataTable();      
	 $(".chk_tfr:checked", oTable.fnGetNodes()).each(function() {
		 chk_array.push($(this).val());      
		 });
					
		if (chk_array.length === 0) {
			alert("Please Select Atlist One Record");
			return false;
		}

		
		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To ReSend Mail ?",
			buttons: {
			confirm: function () 
			{
				$.ajax({
				type: 'POST',
				url: '<?php $base_url; ?>mailing.php',
				data: 'action_type=mails_sending&chk_array='+chk_array+'&is_pending='+is_pending,
				beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
				success:function(html){
					document.getElementById("overlay_div").style.display="none";
					window.location.href="<?php echo $base_url; ?>scanned_list.php";
				}
				});
			},
			cancel: function () {
					return;
				}
				}
			})
	});
	
	
	
	$(document).on("change", ".chk_all", function () {
		if($(".chk_all").is(':checked')){
        $(".chk_tfr").attr('checked',true);
    }else{
        $(".chk_tfr").attr('checked',false);
    } 
});
</script>