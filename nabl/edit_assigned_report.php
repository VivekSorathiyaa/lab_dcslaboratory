<?php include("header.php");?>
<?php include("sidebar.php");
include("connection.php");
	if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php $base_url; ?>index.php";
	</script>
	<?php
}

		$get_report_no= $_GET["report_no"];
		$sel_assign_total="select * from material_assign_total where `assign_status`=1 AND `isdeleted`=0 AND `report_number`='$get_report_no'";
		$get_result=mysqli_query($conn,$sel_assign_total);
	
		$get_assign_total=mysqli_fetch_array($get_result);
	
		$get_gst_type=$get_assign_total["gst_type"];
		$get_date=$get_assign_total["date"];
		$get_direct_path=$get_assign_total["direct_path"];
		
		if(isset($_POST['btn_estimate'])){
			
					$txt_report_no= $_POST["txt_report_no"];
							
					
					$update="update material_assign SET `assign_status`=1 WHERE `report_number`='$txt_report_no'";
				
					$result_of_update=mysqli_query($conn,$update);	
					
					$update_job="update job SET `assign_status`=1 WHERE `jobno`='$txt_report_no'";
				
					$result_of_update_job=mysqli_query($conn,$update_job);
					?>
						
					<script>
						//window.open("<?php $base_url; ?>bill_esstimate.php?ess_id=<?php echo $sr_no_ess;?>",'_blank');
						window.location.href="<?php $base_url; ?>assigned_material.php";
					</script>
					
					<?php
						
		}
		if(!isset($_POST['btn_saves']) || !isset($_POST['btn_estimate'])){

			$delet_query="DELETE FROM material_assign WHERE `assign_status`=0 AND `isdeleted`=0";
			$qrys_delete = mysqli_query($conn,$delet_query);
		}
		
		
?>


<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}

.mystyle{
	text-align: center;
    font-size: 2em;
}

input[type="radio"] {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
    transform: scale(1.5);
}
</style>
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Material Assigning 
			</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Material Assigning</h3>
						</div>
						<form class="form" id="billing" method="post">
							<div class="box-body"  style="border:1px groove #ddd;">
								<div class="row">
									
									<div class="col-lg-12">
									<label for="inputEmail3" class="col-sm-2 control-label">Report No:</label>
											
										  <div class="col-sm-2">
											<input type="text" class="form-control" value="<?php echo $_GET['report_no'];?>" id="txt_report_no" name="txt_report_no" >
										  </div>
										<div class="form-group">
										
										  <label for="inputEmail3" class="col-sm-2 control-label">Date:</label>
											<div class="col-sm-3">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="date" name="date" value="<?php echo date('d/m/Y', strtotime($get_date));?>" required   >
												</div>
											</div>
											
											
											
										</div>
										<div class="form-group">
										
											<div class="col-sm-3">
												<div class="input-group">
													
													<input type="checkbox" class="" id="directpath" name="directpath" value="1" <?php if($get_direct_path==1){ echo "checked"; } ?>><b>Direct Path</b>
												</div>
											</div>
										</div>
									</div>
								
								</div>
								<hr style="border-top: 1px solid;">
								<div class="row">
									<div class="col-lg-12">
									<div id="gst_status" class="mystyle">
										<h3>GST TYPE: <?php if($get_gst_type=="with_gst"){ echo "With Gst";}else{ echo "Without Gst";}?></h3>
									</div>
									</div>
								</div>
								<br>
								
								<div class="row">
									<div class="col-lg-2">
									<input type="hidden" name="gst_type" id="gst_type" value="<?php echo $get_gst_type; ?>">
									<input type="hidden" name="mate_rate" id="mate_rate" value="<?php echo $_GET['mate_rate'];?>">
									
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Category</label>
										</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
											<label for="inputEmail3" class="control-label">Material</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label" >QTY</label>
											
											<label for="inputEmail3" class="col-sm-2 control-label">Rate</label>
											
											<label for="inputEmail3" class="col-sm-2 control-label only_for_guj">CGST</label>
											
											<label for="inputEmail3" class="col-sm-2 control-label only_for_guj">SGST</label>
											
											<label for="inputEmail3" class="col-sm-2 control-label">Net</label>
											
										</div>
									</div>
									
								</div>
							
								<div class="row">
									<div class="col-lg-2">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control" name="select_material_category" id="select_material_category" >
													<option value="">Select Category</option>
													<?php 
													$sql = "select * from material_category where `material_cat_status`='1' AND `material_cat_isdelete`='0'";
												
													$result = mysqli_query($conn, $sql);

													if (mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
													
													?>
			
													<option value="<?php echo $row['material_cat_id'];?>"><?php echo $row['material_cat_name'];?></option>
													<?php }}?>
												</select>
											</div>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control " name="select_material" id="select_material" >
													<option>Select Material</option>
												</select>
												<input type="hidden" name="material_prefix" id="material_prefix">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
										
											<div class="col-sm-2">
												<input type="text" class="form-control" style="text-align:center;" tabindex="19" name="txt_qty" id="txt_qty">
											</div>
											
											<div class="col-sm-2">
												<input type="text" class="form-control" style="text-align:center;" name="txt_rate" id="txt_rate" tabindex="20">
											</div>
											
											<div class="col-sm-2">
												<input type="text" class="form-control" style="text-align:center;" name="txt_cgst" id="txt_cgst" tabindex="21">
											</div>
											
											<div class="col-sm-2">
												<input type="text" class="form-control " style="text-align:center;" name="txt_sgst" id="txt_sgst">
												
											</div>
										
											<div class="col-sm-2">
												<input type="text" class="form-control" style="text-align:center;"  tabindex="24" name="txt_net" id="txt_net">
											</div>
											
											<div class="col-sm-2">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
												<input type="hidden" class="form-control" name="add_status" id="add_status"/>
								
												
												<button type="button" class="btn btn-info pull-right" id="btn_add_data" onclick="addData('add')" name="btn_add_data" id="btn_add_data" tabindex="25" >Add</button>
												
												<button type="button" class="btn btn-info pull-right" onclick="addData('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>
											
										</div>
									</div>
									
									</div>		
								</div>
								<br>
								
								<input type="hidden" name="edit_rate" id="edit_rate">
								<div id="display_data">	
									<div class="row">
										<div class="col-lg-12">
											<table border="1px solid black" align="center" width="100%" id="aaaa">
												<tr>
													<th width="10%"><label>Actions</label></th>
													<th width="35%"><label>Material</label></th>	
													<th width="5%"><label>Lab Id</label></th>	
													<th width="5%"><label>Quantity</label></th>	
													<th width="10%"><label>Rate</label></th>	
													<th width="10%"><label>Taxable Amount</label></th>	
													<th width="10%"><label>CGST</label></th>	
													<th width="10%"><label>SGST</label></th>
													<th width="10%"><label>NET</label></th>	
													
												</tr>
												
													<?php
													$query = "select * from material_assign WHERE report_number='".$_GET["report_no"]."' AND `isdeleted`='0' AND `assign_status`='1'";
													$result = mysqli_query($conn, $query);
													
													$total_taxabled=0;
		
													if (mysqli_num_rows($result) > 0) {
														while($r = mysqli_fetch_array($result)){
										
															if($r['isdeleted'] == 0){
															?>
															<tr>
															<td style="text-align:center;" width="10%">	
															<!--<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php //echo $r['assign_id']; ?>')"></a>-->
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?addData('delete','<?php echo $r['assign_id']; ?>'):false;"></a>
														</td>

															<?php
															$mt_id= $r['material'];
															
															$query_mt = "select * from material WHERE id='$mt_id' AND `mt_status` = '1' AND `mt_isdeleted` = '0'";
															$result_mt = mysqli_query($conn, $query_mt);
															$rw = mysqli_fetch_array($result_mt);
															
															$query_sum = "select SUM(cgstamt) as sum_cgstamt, SUM(sgstamt) as sum_sgstamt,SUM(netamt) as sum_netamt from material_assign WHERE report_number='".$_GET["report_no"]."' AND isdeleted=0 AND assign_status=1 ";
															$result_sum = mysqli_query($conn, $query_sum);

															$r_sum = mysqli_fetch_array($result_sum);
															
															$cgst=round($r_sum['sum_cgstamt'],2);
															$sgst=round($r_sum['sum_sgstamt'],2);
															$gst=$cgst+$sgst;
																														
															$net=round($r_sum['sum_netamt']);
															
															?>
															<td style="text-align:center;" width="35%"><?php echo $rw['mt_name'];?></td>
															<td style="text-align:center;" width="5%"><?php echo $r['lab_id'];?></td>
															<td style="text-align:center;" width="5%"><?php echo $r['qty'];?></td>
															<td style="text-align:center;" width="10%"><?php echo $r['rate'];?></td>
															<td style="text-align:center;" width="10%"><?php echo $r['rate']*$r['qty'];
															$total_taxabled += $r['rate']*$r['qty'];
															
															?></td>
															
															<td style="text-align:center;" width="10%"><?php echo $r['cgstamt'];?></td>
															<td style="text-align:center;" width="10%"><?php echo $r['sgstamt'];?></td>
															
															<td style="text-align:center;" width="10%"><?php echo $r['netamt'];?></td>
															</tr>
															<?php
															}
														}
													}
												?>
							
												<tr>
													<th colspan="5"><label>Total</label></th>
													<th style="text-align:center;"><?php echo $total_taxabled;?></th>
													<th style="text-align:center;"><?php echo round($r_sum['sum_cgstamt'], 2);?></th>
													<th style="text-align:center;"><?php echo round($r_sum['sum_sgstamt'], 2);?></th>
													
													<th style="text-align:center;"><?php echo round($r_sum['sum_netamt'], 2);?></th>
												</tr>
											</table>
										</div>
									</div>
									<hr>
									<div class="row">	
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Taxable:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_taxable" name="txt_gst" value="<?php echo $total_taxabled;?>">											
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Total GST:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_gsti" name="txt_gst" value="<?php echo $gst;?>">											
											</div>
										</div>
									</div>
								
									<div class="col-lg-4">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Total Bill:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txt_billinword" name="txt_billinword" value="<?php echo $net;?>">											
											</div>
										</div>
									</div>
								</div>
									
									
								</div>
								
								
							</div>
							
							<div class="box-footer">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
									
											<div class="col-sm-6">
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<!--<div class="col-xs-2">
												
													
													<button type="submit" class="btn btn-info pull-right" id="btn_saves" name="btn_saves" tabindex="19" style="width:100px">Save</button>
												</div>-->	
											</div>
											<div class="col-sm-6">
												<div class="col-xs-2">
												<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" tabindex="33" style="width:100px">Estimate</button>
												</div>
											
												<div class="col-xs-2">
												<!--<button type="submit" class="btn btn-info pull-right" tabindex="21" id="btn_report" name="btn_report">Report</button>-->
												</div>
												
											</div>
										</div>
									</div>
								</div>	
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	</div>
	
	
		
		
		
		
		
		
		
<?php include("footer.php");?>

<script>
 //Date picker
    $('#date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
	     
  })

</script>

<script>


$(document).ready(function(){

		var edit_rate = $('#edit_rate').val(); 
	    $('#btn_edit_data').hide();
	  
		
		
	
	
    $("#select_material_category").change(function(){
      
			 var select_material_category = $('#select_material_category').val(); 
			 var postData = '&select_material_category='+select_material_category;
			 $.ajax({
				url : "<?php $base_url; ?>get_material_Rate.php",
				type: "POST",
				data : postData,
				success: function(data,status,  xhr)
				 {
					$("#select_material").html(data);
					$("#txt_rate").val("0");
					  $("#txt_qty").val("0");
					  $("#txt_cgst").val("0");
					  $("#txt_sgst").val("0");
					  $("#txt_net").val("0");
					  
				 }
			}); 
    });
	
	
	$("#select_material").change(function(){
      
			 var txt_new_material = $('#select_material').val(); 
			 var gst_type = $('#gst_type').val(); 
			 var mate_rate = $('#mate_rate').val(); 
			  var postData = '&txt_new_material='+txt_new_material+'&gst_type='+gst_type+'&mate_rate='+mate_rate;
			
			$.ajax({
				url : "<?php $base_url; ?>get_material_Rate.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				success: function(data,status,  xhr)
				 {
					
					$("#txt_rate").val(data.txt_rate);
					  $("#txt_qty").val(data.txt_qty);
					  $("#txt_cgst").val(data.txt_cgst);
					  $("#txt_sgst").val(data.txt_sgst);
					  $("#txt_net").val(data.txt_net);	
					  $("#material_prefix").val(data.mt_prefix);	
				 
				 }
			}); 
    });
	//on qty change
	$("#txt_qty").change(function(){
				
				var type = "change_qty";
				var select_material_category = $('#select_material_category').val();
				var txt_new_material = $('#select_material').val();
                
				var gst_type = $('#gst_type').val(); 
				var txt_qty = $('#txt_qty').val(); 
				var txt_rate = $('#txt_rate').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_net = $('#txt_net').val(); 
				var edit_rate = $('#edit_rate').val(); 
				var mate_rate = $('#mate_rate').val();
			
				var postData = '&select_material_category='+select_material_category+'&txt_new_material='+txt_new_material+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_net='+txt_net+'&edit_rate='+edit_rate+'&gst_type='+gst_type+'&mate_rate='+mate_rate+'&type='+type;
				
				
				
		$.ajax({
			url : "<?php $base_url; ?>getFinalRate.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  $("#txt_rate").val(data.txt_rate);
				  $("#txt_qty").val(data.txt_qty);
				  $("#txt_cgst").val(data.txt_cgst);
				  $("#txt_sgst").val(data.txt_sgst);
				  $("#txt_igst").val(data.txt_igst);
				  $("#txt_net").val(data.txt_net);
		
 			 }

		}); 
    });
	
	
	//on rate change
	$("#txt_rate").change(function(){
				
				var select_material_category = $('#select_material_category').val();
				var type = "rate_changes";
				var txt_new_material = $('#select_material').val();
                
				var gst_type = $('#gst_type').val(); 
				var txt_qty = $('#txt_qty').val(); 
				var txt_rate = $('#txt_rate').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_net = $('#txt_net').val(); 
				var edit_rate = $('#edit_rate').val(); 
				var mate_rate = $('#mate_rate').val();
			
				var postData = '&select_material_category='+select_material_category+'&txt_new_material='+txt_new_material+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_net='+txt_net+'&edit_rate='+edit_rate+'&gst_type='+gst_type+'&mate_rate='+mate_rate+'&type='+type;
				
				
				
		$.ajax({
			url : "<?php $base_url; ?>getFinalRate.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  $("#txt_rate").val(data.txt_rate);
				  $("#txt_qty").val(data.txt_qty);
				  $("#txt_cgst").val(data.txt_cgst);
				  $("#txt_sgst").val(data.txt_sgst);
				  $("#txt_igst").val(data.txt_igst);
				  $("#txt_net").val(data.txt_net);
		
 			 }

		}); 
    });
	
	$("#btn_saves").click(function(){
	
		var radios =$('input:radio[name="options"]').val();
		if(radios==null){
			 $("#options_val").val("blank");
			var radios = $('#options').val(); 
			//alert(radios);
			 alert("Saved Bill Successfully");
		}
		// alert("Saved Bill Successfully");
	
		
	});	
			
	$("#btn_edit_data").click(function(){
					$('#btn_add_data').show();
					$('#btn_edit_data').hide();

	});
});

</script>
<script>

function getbills(){
				txt_report_no = $('#txt_report_no').val();
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=view_for_edit&txt_report_no='+txt_report_no,
        success:function(html){
            $('#display_data').html(html);
        }
    });
}



function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
				var txt_report_no = $('#txt_report_no').val(); 
				var date = $('#date').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				var material_prefix = $('#material_prefix').val(); 
				var txt_qty = $('#txt_qty').val(); 
				var txt_rate = $('#txt_rate').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_net = $('#txt_net').val(); 
				var gst_type = $('#gst_type').val();
				
				if($('#directpath').is(":checked")){
					var directing_path=1;
				}else {
					var directing_path=0;
				}
				
				if(txt_report_no !="" && select_material_category !="" && select_material !="" && material_prefix !="" && txt_qty !="" && txt_rate !="" && txt_cgst !="" && txt_sgst !="" && txt_net !=""){	
				billData = '&action_type='+type+'&id='+id+'&txt_report_no='+txt_report_no+'&date='+date+'&select_material_category='+select_material_category+'&select_material='+select_material+'&material_prefix='+material_prefix+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_net='+txt_net+'&gst_type='+gst_type+'&directing_path='+directing_path;
				}else{
					alert(" All Filled Required");
				}
				
				//exit();
				
    }else if (type == 'edit'){
		
				 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				var material_prefix = $('#material_prefix').val(); 
				var txt_qty = $('#txt_qty').val(); 
				var txt_rate = $('#txt_rate').val(); 
				var txt_cgst = $('#txt_cgst').val(); 
				var txt_sgst = $('#txt_sgst').val(); 
				var txt_net = $('#txt_net').val(); 
				
				if($('#directpath').is(":checked")){
					var directing_path=1;
				}else {
					var directing_path=0;
				}
				
				var txt_id = $('#idEdit').val();  
		
		        if(txt_report_no !="" && select_material_category !="" && select_material !="" && material_prefix !="" && txt_qty !="" && txt_rate !="" && txt_cgst !="" && txt_sgst !="" && txt_net !=""){
					
				billData = '&action_type='+type+'&id='+id+'&select_material_category='+select_material_category+'&select_material='+select_material+'&material_prefix='+material_prefix+'&txt_qty='+txt_qty+'&txt_rate='+txt_rate+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_net='+txt_net+'&directing_path='+directing_path+'&txt_id='+txt_id;
				}else{
					alert(" All Filled Required");
				}
				
    }else{
				
	
				billData = 'action_type='+type+'&id='+id;
    }
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: billData,
        success:function(msg){
         
                $('#txt_qty').val("");
            $('#txt_rate').val("");
            $('#txt_cgst').val("");
            $('#txt_sgst').val("");
            $('#txt_net').val("");
				getbills();
				$('#btn_edit_data').hide();
				$('#btn_add_data').show();
          
        }
    });
}
function editData(id){
				
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.assign_id);
			$("#select_material_category").html(data.all_material_category);
			$("#select_material").html(data.all_material);
			$('#select_material_category').val(data.material_category).prop('selected', true);
			$('#select_material').val(data.material).prop('selected', true);
			
			$('#txt_qty').val(data.qty);
            $('#txt_rate').val(data.rate);
            $('#txt_cgst').val(data.cgstamt);
            $('#txt_sgst').val(data.sgstamt);
            $('#txt_net').val(data.netamt);
			$('#btn_edit_data').show();
			$('#btn_add_data').hide();
        }
    });
}
if (localStorage.getItem("default_option")) {
   $('#select_material').val(localStorage.getItem("default_option")); 
}
</script>
