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
					Calibration Data						
		</h1>		
	</div>
<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
	<div class="col-md-12">
				<!-- general form elements -->
		<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">ADD CALIBRAION DATA</h3>
				</div>
				<!-- /.box-header -->
					
			<div class="box-body">
				<form class="form" id="billing" method="post">
								<div class="box-body">
								<div class="row">	
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Unique Id of Equipment:</label>

											  <div class="col-sm-9">														
														<input type="text" class="form-control pull-right" id="unique_id" name="unique_id" PLACEHOLDER="Unique ID." tabindex="1">
											 </div>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Certificate No. :</label>
											  <div class="col-sm-9">														
												<input type="text" class="form-control pull-right" id="rep_no" name="rep_no" PLACEHOLDER="CERTIFICATE NO."  tabindex="2">
											 </div>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Name of Instrument:</label>

											  <div class="col-sm-9">														
														<input type="text" class="form-control pull-right" id="name_of_instu" name="name_of_instu" PLACEHOLDER="Instrument Name"  tabindex="2">
											 </div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Equipment Serial No. :</label>

											  <div class="col-sm-9">														
														<input type="text" class="form-control pull-right" id="acceptance_cri" name="acceptance_cri" PLACEHOLDER="Equipment Serial No." tabindex="1">
											 </div>
											</div>
										</div>
										
									</div> 
									<br>
									<div class="row">	
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Make/ Model :</label>

											  <div class="col-sm-9">														
														<input type="text" class="form-control pull-right" id="make_model" name="make_model" PLACEHOLDER="Make / Model"  tabindex="2">
											 </div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Range :</label>

											  <div class="col-sm-9">														
														<input type="text" class="form-control pull-right" id="ranges" name="ranges" PLACEHOLDER="Range"  tabindex="2">
											 </div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Accuracy :</label>

											  <div class="col-sm-9">														
														<input type="text" class="form-control pull-right" id="accuracy" name="accuracy" PLACEHOLDER="Accuracy"  tabindex="2">
											 </div>
											</div>
										</div>
										
									</div> 
									<br>
									<div class="row">		
										
										
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label"> Calibration Date :</label>
											 <div class="col-sm-9">
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="calibration_date" name="calibration_date" value="<?php echo date("d/m/Y");?>" tabindex="1">
													</div>
											  </div>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Due Date of Calibration :</label>
											  <div class="col-sm-9">
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="due_date" name="due_date" value="<?php echo date("d/m/Y");?>" tabindex="1">
													</div>
											  </div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Calibration Validity :</label>

											  <div class="col-sm-9">														
														<input type="text" class="form-control pull-right" id="location" name="location" PLACEHOLDER="Calibration Validity"  tabindex="2">
											 </div>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Mode of Calibration :</label>
											  <div class="col-sm-9">														
												<input type="text" class="form-control pull-right" id="method" name="method" PLACEHOLDER="Mode of Calibration"  tabindex="2">
											 </div>
											</div>
										</div>
										
									</div>
									<br>
									<div class="row">
									<div class="col-lg-6">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">Calibrated By :</label>
											  <div class="col-sm-9">														
												<input type="text" class="form-control pull-right" id="status" name="status" PLACEHOLDER="Calibrated By" value="Excellent Calibration Services"  tabindex="2">
											 </div>
											</div>
										</div>
										<input type="hidden" class="form-control" name="idEdit" id="idEdit"/>
									</div>
									<br>
									<div class="row">										
										<div class="col-lg-4">
											
											<div class="form-group">
											 
											  <div class="col-sm-12">
												<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
												
											  </div>
											</div>
										</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>

											</div>
									</div>
									
			   					</div>
								
			
		</form> 
		<hr style="border-top: 1px solid;">
			<br>
			
			<div id="display_data">
			
				<table id="example1" class="table table-bordered table-striped">
					<thead>
							<tr>
								<th style="text-align:center;" width="10%"><label>Actions</label></th>
								<th style="text-align:center;"><label>UNIQUE ID.</label></th>	
								<th style="text-align:center;"><label>INSTUMENT  NAME</label></th>	
								<th style="text-align:center;"><label>RANGE </label></th>	
								<th style="text-align:center;"><label>ACCURACY  </label></th>	
								<th style="text-align:center;"><label>ACCEPTANCE CRITERIA </label></th>	
								<th style="text-align:center;"><label>LOCATION  </label></th>	
								<th style="text-align:center;"><label>MAKE/ MODEL  </label></th>	
								<th style="text-align:center;"><label>METHOD OF CALIBRATION  </label></th>	
								<th style="text-align:center;"><label>DATE</label></th>	
								<th style="text-align:center;"><label>METHOD OF CALIBRATION  </label></th>	
								<th style="text-align:center;"><label>DUE DATE</label></th>	
								<th style="text-align:center;"><label>STATUS </label></th>	
								
							</tr>
							  </thead>
							  	<tbody>
								<?php
							  $query = "select * from calibration_data WHERE `isdeleted`='0'";
						
								$result = mysqli_query($conn, $query);
			
								if (mysqli_num_rows($result) > 0) {
								while($r = mysqli_fetch_array($result)){
										?>
									
										<tr>
										<td style="text-align:center;" width="10%">	
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
										<?php

											//$val =  $_SESSION['isadmin'];
											//if($val == 0 || $val == 5){
											?>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
										<?php
											//}
										?>
										</td>
										<td style="text-align:center;"><?php echo $r['unique_id'];?></td>
										<td style="text-align:center;"><?php echo $r['name_of_instu'];?></td>
										<td style="text-align:center;"><?php echo $r['ranges'];?></td>					
										<td style="text-align:center;"><?php echo $r['accuracy'];?></td>					
										<td style="text-align:center;"><?php echo $r['acceptance_cri'];?></td>
										<td style="text-align:center;"><?php echo $r['location'];?></td>					
										<td style="text-align:center;"><?php echo $r['make_model'];?></td>					
										<td style="text-align:center;"><?php echo $r['method'];?></td>		
										<td style="text-align:center;"><?php echo date('Y-m-d', strtotime($r['calibration_date']));?></td>			
										<td style="text-align:center;"><?php echo $r['rep_no'];?></td>
										<td style="text-align:center;"><?php echo date('Y-m-d', strtotime($r['due_date']));?></td>					
										<td style="text-align:center;"><?php echo $r['status'];?></td>	 				
										</tr>
										
										<?php
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>	
					
					
			</div>			
		</div>
	</div>
</div>
	
      <!-- /.row -->
</section>	
</div>  
	
<?php include("footer.php");?>		  
		  
<script>
 
     $(document).ready(function() {
		$('#btn_edit_data').hide();
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

	$('#calibration_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	})
	$('#due_date').datepicker({
	  autoclose: true,
	  format: 'dd-mm-yyyy'
	})
		
	$(function () {
		$('.select2').select2()
	})
	
	
$("#btn_edit_data").click(function(){
			$('#btn_edit_data').hide();
		
	});
function getGlazedTiles(){
				
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_calibratoin.php',
        data: 'action_type=view&'+$("#Glazed").serialize(),
        success:function(html){
            $('#display_data').html(html);

        }
    });
}

function saveMetal(type,id){

    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
		
			var id = $('#id').val();
			var unique_id = $('#unique_id').val();
			var name_of_instu = $('#name_of_instu').val();
			var ranges = $('#ranges').val();
			var accuracy = $('#accuracy').val();
			var acceptance_cri = $('#acceptance_cri').val();
			var location = $('#location').val();
			var make_model = $('#make_model').val();
			var method = $('#method').val();
			var calibration_date = $('#calibration_date').val();
			var rep_no = $('#rep_no').val();
			var due_date = $('#due_date').val();
			var status = $('#status').val();	
				
				
						billData = '&action_type='+type+'&id='+id+'&unique_id='+unique_id+'&name_of_instu='+name_of_instu+'&ranges='+ranges+'&accuracy='+accuracy+'&acceptance_cri='+acceptance_cri+'&location='+location+'&make_model='+make_model+'&method='+method+'&calibration_date='+calibration_date+'&rep_no='+rep_no+'&due_date='+due_date+'&status='+status;
						
						
					
					
	}
	

else if (type == 'edit'){
			
			var unique_id = $('#unique_id').val();
			var name_of_instu = $('#name_of_instu').val();
			var ranges = $('#ranges').val();
			var accuracy = $('#accuracy').val();
			var acceptance_cri = $('#acceptance_cri').val();
			var location = $('#location').val();
			var make_model = $('#make_model').val();
			var method = $('#method').val();
			var calibration_date = $('#calibration_date').val();
			var rep_no = $('#rep_no').val();
			var due_date = $('#due_date').val();
			var status = $('#status').val();
			
			var txt_id1 = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&unique_id='+unique_id+'&name_of_instu='+name_of_instu+'&ranges='+ranges+'&accuracy='+accuracy+'&acceptance_cri='+acceptance_cri+'&location='+location+'&make_model='+make_model+'&method='+method+'&calibration_date='+calibration_date+'&rep_no='+rep_no+'&due_date='+due_date+'&status='+status+'&txt_id1='+txt_id1;
			
			
						
	}
else{
				
	
				billData = 'action_type='+type+'&id='+id;
    }
 $.ajax({
		type: 'POST',
		url: '<?php echo $base_url; ?>save_calibratoin.php',
		data: billData,
		dataType: 'JSON',
		success:function(msg){
		getGlazedTiles();
		}
	});
}	
	function editData(id){
				
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: '<?php echo $base_url; ?>save_calibratoin.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();
			
			$('#unique_id').val(data.unique_id);
			$('#name_of_instu').val(data.name_of_instu);
			$('#ranges').val(data.ranges);
			$('#accuracy').val(data.accuracy);
			$('#acceptance_cri').val(data.acceptance_cri);
			$('#location').val(data.location);
			$('#make_model').val(data.make_model);
			$('#rep_no').val(data.rep_no);
			$('#method').val(data.method);
			$('#calibration_date').val(data.calibration_date);
			$('#due_date').val(data.due_date);
			$('#status').val(data.status);
			 
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}

 
</script>
