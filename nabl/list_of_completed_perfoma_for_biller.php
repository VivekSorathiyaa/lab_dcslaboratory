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
			
	<div class="row">
		
		<h1 style="text-align:center;">
		Pending Invoice List
	<!--<a href="span_add_new_perfoma.php" class="btn btn-info btn-lg btn3d pull-right" style="margin-right:20px;margin-bottom: 20px;" title="Add Direct Perfoma"><span class="glyphicon glyphicon-question-list"></span>ADD DIRECT PROFORMA</a>-->
		</h1>
	</div>		
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-body">
					<a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="margin-left:45%;width:3%;;" id="add_material_button"><i class="fa fa-search" aria-hidden="true"></i></a>
						<br>
						<br>
						<div id="collapse1" class="panel-collapse collapse">
							<div class="row">
									<div class="col-md-3">
									<label>Agency:</label>
									</div>
									<div class="col-md-3">
									<label>Perfoma No:</label>
									</div>
									
							</div>
							<div class="row">
							     <div class="col-md-3">
									<select name="search_sel_agency_ids" id="search_sel_agency_ids" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 230px;">
									<option value="">Select-Agency</option>
									<?php 
									$sel_agencys="select * from agency_master where `isdeleted`=0 and `isdeleted`=0";
									$query_agencys = mysqli_query($conn, $sel_agencys);
									if(mysqli_num_rows($query_agencys)> 0)
									{
									while($get_one_agency=mysqli_fetch_array($query_agencys))
									{ ?>
								    <option value="<?php echo $get_one_agency['agency_id'];?>"><?php echo $get_one_agency['agency_name'];?></option>
									<?php } }?>
									</select>
								 </div>
								 <div class="col-md-3">
									<input type="text" name="search_perfoma_no" id="search_perfoma_no" placeholder="Enter Perfoma No" class="form-control">
								 </div>
							</div>
							<div class="row">
								<div class="col-md-5">
								</div>
								<div class="col-md-3">
									<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_agency" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> Search</a>
									<a href="javascript:void(0);" class="btn btn-primary" onclick="location.reload()" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
								</div>
							</div>
						</div>
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">S</th>
										<th style="text-align:center;">Prints</th>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Type</th>
										<th style="text-align:center;">Job No</th>
										<!--<th style="text-align:center;">Name Of Customer</th>-->
										<th style="width:1%;">Bill To
										<select name="search_sel_agency_ids" id="search_bill_to" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 200px;">
									<option value="">Select-Agency</option>
									<?php 
									$sel_agencys="select `agency_id`,`agency_name` from agency_master where `isdeleted`=0";
									$query_agencys = mysqli_query($conn, $sel_agencys);
									if(mysqli_num_rows($query_agencys)> 0)
									{
									while($get_one_agency=mysqli_fetch_array($query_agencys))
									{ ?>
								    <option value="<?php echo $get_one_agency['agency_id'];?>"><?php echo $get_one_agency['agency_name'];?></option>
									<?php } }?>
									</select>
										</th>
										<th style="text-align:center;">Perfoma Name</th>
										<th style="text-align:center;">Perfoma Date</th>
										<th style="text-align:center;">Perfoma Type</th>
										<th style="text-align:center;">Rate Type</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
									 	$query="select * from estimate_total_span WHERE `est_isdeleted`=0  AND `perfoma_completed_by_biller`='0' AND `which_made`='0' ORDER BY est_id DESC LIMIT 0,200";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											
												$get_one_trf_no=explode(",",$row['trf_no']);
												$one_trf_no=$get_one_trf_no[0];
												$query_job="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' ORDER BY job_id DESC";
												$result_job =mysqli_query($conn,$query_job);
												
												$sel_agency_id=$row["agency_id"];
												$sel_agency="select * from agency_master where `isdeleted`=0 and `agency_id`=".$sel_agency_id;
												$result_agency =mysqli_query($conn,$sel_agency);
												$row_agency =mysqli_fetch_array($result_agency);
												$agency_name=$row_agency["agency_name"];
												
											
											
											$row_job =mysqli_fetch_array($result_job);
											$customer_name=$row_job['clientname'];
											if($row["perfoma_type"]=="direct_perfoma")
											{
												$customer_name=$row['customer_name'];
											}
											
											$name_of_work= strip_tags(html_entity_decode($row_job["nameofwork"]),"<strong><em>");
											
											if($row['make_test_bill']=="1"){ $make_test_bill='<img src="images/green_dot.png">';}else { $make_test_bill="";}
											if($row['make_material_bill']=="1"){ $make_material_bill='<img src="images/green_dot.png">';}else { $make_material_bill="";}
											if($row['make_estimate']=="1"){ $make_estiamte='<img src="images/green_dot.png">';}else { $make_estiamte="";}
											
									?>
											<tr>
											<td style="text-align:center;">
											<input type="checkbox" name="chk_est" class="chk_est" value="<?php echo $row["est_id"]; ?>">
											</td>
											<td >
											<input type="text" class="print_counts" style="width: 90px;"  value="<?php echo $row["print_counts"]; ?>" data-id="<?php echo $row["est_id"]; ?>"></td>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<?php
											//if perfoma type is excel then only excel button view
											if($row["perfoma_type"]=="excel")
											{
												echo "EXCEL";
											}
											if($row["perfoma_type"]=="direct_perfoma")
											{
												echo "DIRECT PERFOMA";
											}
											if($row["perfoma_type"] != "excel" && $row["perfoma_type"]!= "direct_perfoma" && $row["perfoma_type"] != "direct_perfoma_excel")
											{
												echo "REGULAR";
											}
											if($row["perfoma_type"] == "direct_perfoma_excel")
											{
												echo "DIRECT PERFOMA EXCEL";
											}
										    ?>
											</td>
											<td style="white-space:nowrap;text-align:center;">
											<?php 
											$explode_job= explode(",",$row['job_no']);
											$set_counts_job=1;
											foreach($explode_job as $keys => $one_jobs)
											{
												if($set_counts_job==4)
												{
													echo $one_jobs."</br>";
													$set_counts_job=0;
												}else
												{
													echo $one_jobs.",";
												}
												
												$set_counts_job++;
											}
											?>
											</td>
											<!--<td style="white-space:nowrap;text-align:center;"><?php //echo $customer_name;?></td>-->
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['bill_to_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["perfoma_no"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['estimate_date']);
											echo $date->format('d-m-Y');
											?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php 
												$per_type = "";
												if($row['make_by'] == 0)
												{
													$per_type = "Test";
												}else if($row['make_by'] == 1)
												{
													$per_type = "Material";
												}else{
													$per_type = "-";
												}
											
											echo $per_type;?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php 
												$rate_type = "";
												if($row['rate_type'] == 0)
												{
													$rate_type = "Goverment Rate";
												}else if($row['rate_type'] == 1)
												{
													$rate_type = "Private Rate";
												}else{
													$rate_type = "Other Rate";
												}
												echo $rate_type;
											?>
											</td>
											
											<td style="text-align:center;">
											<?php
											//if perfoma type is excel then only excel button view
											if($row["perfoma_type"]=="direct_perfoma_excel")
											{
										    ?>
											<a href="span_edit_direct_perfoma_excel_upload.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;Direct perfoma Excel&nbsp;&nbsp;</a>
											
											<a href="span_invoice_excel_upload_for_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(E) Invoice Excel&nbsp;&nbsp;</a>
											&nbsp;
											<?php											
											}
											else if($row["perfoma_type"]=="excel")
											{
											 ?>
											<a href="span_perfoma_excel_upload.php?chk_array=<?php echo $row['trf_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(E) perfoma Excel&nbsp;&nbsp;</a>
											
											<a href="span_invoice_excel_upload.php?chk_array=<?php echo $row['trf_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(E) Invoice Excel&nbsp;&nbsp;</a>
											&nbsp;
											<?php											
											
											    
											
											}else
											{
											?>
											<?php
                                            if($row["perfoma_type"]=="direct_perfoma")
											{
											?>
											<a href="span_edit_new_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D) perfoma&nbsp;&nbsp;</a>
											&nbsp;
											
											<a href="span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D)<?php echo $make_test_bill;?> Invoice By Test&nbsp;&nbsp;</a>
											
											<a href="span_set_rate_only_by_material_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D)<?php echo $make_material_bill;?> Invoice By Material&nbsp;&nbsp;</a>
											
											<a href="span_set_rate_only_for_estimate_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D)<?php echo $make_estiamte;?> Estimate&nbsp;&nbsp;</a>
											
											<?php 
											}
											else
											{
												if($row["make_by"]=="0"){
												?>
												<!--<a href="update_perfoma.php?perfoma_nos=<?php //echo $row['perfoma_no'];?>" class="btn btn-primary" title=""><span class="glyphicon glyphicon-question-list" ></span> &nbsp;proforma&nbsp;&nbsp;</a>-->
												&nbsp;
												<a href="perfoma_print.php?perfoma_nos=<?php echo $row['perfoma_no'];?>&&print_counts=<?php echo base64_encode($row["print_counts"]); ?>" class="btn btn-primary" title="" target="_blank">&nbsp;Proforma&nbsp;&nbsp;</a>
												&nbsp;
												<?php }else{?>
												<!--<a href="update_perfoma_by_material.php?perfoma_nos=<?php //echo $row['perfoma_no'];?>" class="btn btn-primary" title=""><span class="glyphicon glyphicon-question-list" ></span> &nbsp;proforma&nbsp;&nbsp;</a>-->
												
												<a href="perfoma_print_by_material.php?perfoma_nos=<?php echo $row['perfoma_no'];?>&&print_counts=<?php echo base64_encode($row["print_counts"]); ?>" class="btn btn-primary" title="" target="_blank">&nbsp;Proforma&nbsp;&nbsp;</a>
												&nbsp;
												<?php } ?>
												
												<a href="make_bill.php?perfoma_nos=<?php echo $row['perfoma_no'];?>" class="btn btn-primary" title="">&nbsp;Invoice&nbsp;&nbsp;</a>
												
												<a href="make_estimates.php?perfoma_nos=<?php echo $row['perfoma_no'];?>" class="btn btn-primary" title="">&nbsp;Estimate&nbsp;&nbsp;</a>
												
												
												<!--<a href="span_set_rate_only_for_estimate_merging.php?chk_array=<?php //echo $row['trf_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span><?php //echo $make_estiamte;?> &nbsp;Estimate&nbsp;&nbsp;</a>-->
												<?php
												
												
											}
											}
											
											if($row["perfoma_type"] !="direct_perfoma" && $row["perfoma_type"] !="direct_perfoma_excel")
											{
											?>
											<a href="list_of_multi_trf.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-success" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> &nbsp;Trf&nbsp;&nbsp;</a>
											&nbsp;
											<?php		
											}
											?>
											<!--<a href="javascript:void(0);" class=" btn-danger perfoma_deletes" data-id="<?php //echo $row['est_id'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span>&nbsp;Delete&nbsp;&nbsp;</a>-->
											
											<!--<a href="javascript:void(0);" class=" btn-warning perfoma_complete_by_est_id" data-id="<?php //echo $row['est_id'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span>&nbsp;Complete&nbsp;&nbsp;</a>-->
											
											
											<!--<a href="javascript:void(0);" class=" btn-danger perfoma_cancel_by_est_id" data-id="<?php //echo $row['est_id'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span>&nbsp;Cancel&nbsp;&nbsp;</a>-->
											
											
											
											</td>
										</tr> 
									<?php
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
		<div class="row">
			<div class="col-lg-12 text-center">
				<a href="javascript:void(0);" class="btn btn-danger btn-lg   merging_perfoma" title="Merge"><span class="glyphicon glyphicon-question-ok"></span> PERFOMA MERGE</a>
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
		"lengthMenu": [[100, 200, 250, -1], [100, 200, 250, "All"]]
    });
	$(function () {
		$('.select2').select2()
	})

});

$(document).on("click", ".perfoma_complete_by_est_id", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Complete This Perfoma ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=perfoma_complete_by_est_id&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

$(document).on("click", ".perfoma_cancel_by_est_id", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Cancel This Perfoma ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=perfoma_cancel_by_est_id&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

$(document).on("click", ".perfoma_deletes", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Perfoma ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=perfoma_deletes&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

$(".search_job_by_agency").click(function()
{
					
	var sel_agency_ids = $('#search_sel_agency_ids').val(); 
	var perfoma_no = $('#search_perfoma_no').val(); 
	var customer_name = $('#search_customer_name').val();  
	var search_agree_no = $('#search_agree_no').val();  
					
	if(sel_agency_ids =="" && perfoma_no =="" && customer_name =="" && search_agree_no =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&sel_agency_ids='+sel_agency_ids+'&perfoma_no='+perfoma_no+'&customer_name='+customer_name+'&search_agree_no='+search_agree_no;
			
		$.ajax({
			url : "<?php echo $base_url; ?>search_list_of_completed_perfoma_for_biller.php",
			type: "POST",
			data : postData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success: function(data,status,  xhr)
			{
				document.getElementById("overlay_div").style.display="none";
				$("#display_data_report").html(data);
			}
			}); 
});

$(document).on('change','.print_counts',function(){
	var get_values= parseInt($(this).val());
	var get_id= $(this).attr('data-id');
	
	var billData = '&action_type=update_print_counts'+'&get_values='+get_values+'&get_id='+get_id;
	
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: billData,
        success:function(msg){
          location.reload();
        }
    });
});
$(document).on("click", ".merging_perfoma", function () {
					
		var chk_array = [];
        var oTable = $("#example2").dataTable();      
	 $(".chk_est:checked", oTable.fnGetNodes()).each(function() {
		 chk_array.push($(this).val());      
		 });
					
		if (chk_array.length === 0 || chk_array.length === 1) {
			alert("Please Select Minimum Two Record");
			return false;
		}


		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Merge Selected Perfoma ?",
			buttons: {
			confirm: function () 
			{
				var billData = '&action_type=check_for_merge'+'&chk_array='+chk_array;
	
			$.ajax({
				type: 'POST',
				url: '<?php $base_url; ?>save_perfoma_merge.php',
				data: billData,
				dataType:'JSON',
				success:function(datas){
				 if(datas.status=="0"){
					window.location.href="<?php echo $base_url; ?>two_perfoma_merging.php?chk_array="+chk_array+"&make_type="+datas.make_type;
				}else{
					 alert(datas.msg);
				}
				}
			});
			},
			cancel: function () {
					return;
				}
				}
			})
	});
	

	$(document).on("change", "#search_bill_to", function () {
					
		var search_bill_to = $('#search_bill_to').val(); 
	  
					
	if(search_bill_to =="")
	{
		alert("Please Select Bill To");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&search_bill_to='+search_bill_to;
			
		$.ajax({
			url : "<?php echo $base_url; ?>search_made_perfoma.php",
			type: "POST",
			data : postData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success: function(data,status,  xhr)
			{
				document.getElementById("overlay_div").style.display="none";
				$("#display_data_report").html(data);
			}
			});
	});

</script>
