 
<?php 

include("header.php");
include("sidebar.php");
include("connection.php");


?>
<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}
</style>
<?php
$select_query = "select * from job_invert WHERE `est_sr_no`='$_GET[id]'";
	$result_select = mysqli_query($conn, $select_query);


		if(isset($_GET['id'])){
			$aa=$_GET['id'];
			
		}
	if (mysqli_num_rows($result_select) > 0) {
		$row_select = mysqli_fetch_assoc($result_select);
		$serial_no1= $row_select['sr_no'];
		$est_sr_no= $row_select['est_sr_no'];
		
		//-------------------job no logic--------------
		
		$j_no=1;
		$final_j_no;
		//$querys_job = "SELECT * FROM ceramic_tiles WHERE `sr_no`= '$serial_no1' AND `is_deleted`='0'";
		$querys_job = "SELECT * FROM ceramic_tiles WHERE `is_deleted`='0'";
		$qrys_jobno = mysqli_query($conn,$querys_job);
		$rows=mysqli_num_rows($qrys_jobno);
		if($rows<1){
			$final_j_no=$j_no;
		}
		else{
			while($r1 = mysqli_fetch_array($qrys_jobno)){
				$jno=$r1['job_no'];
				$jno1 = substr($jno,4);
			}
				
			$final_j_no=$jno1+1;
		}
	
		//---------------------------------------------
		
		
		$job_no= "1";
		$agency_id= $row_select['agency_id'];
		$agency_name= $row_select['agency_name'];
		$auth_name= $row_select['auth_name'];
		$ref_date= $row_select['ref_date'];
		$ref_name= $row_select['ref_name'];

		$srno2=substr($est_sr_no,7);
		$srno1=substr($est_sr_no,0,7);
		
		/*$select_query1 = "select * from billmaster WHERE `sr_no`='$est_sr_no'";
		$result_select1 = mysqli_query($conn, $select_query1);

		if (mysqli_num_rows($result_select1) > 0) {
			$row_select1 = mysqli_fetch_assoc($result_select1);
			$name_of_work= $row_select1['name_of_work'];
			$city_id= $row_select1['city_id'];
			$ref_name= $row_select1['ref_name'];
			$ref_id= $row_select1['ref_id'];
			$material_id=$row_select1['material_id'];
			
				$select_city = "select * from city WHERE `id`='$city_id'";
				$result_city = mysqli_query($conn, $select_city);
	

				if (mysqli_num_rows($result_city) > 0) {
					$row_city = mysqli_fetch_assoc($result_city);
					$name_of_work= $row_select1['name_of_work'];
					$city_name= $row_city['city_name'];
				}		
		}*/
		
	
	}
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Ceramic Tiles Test
		</h1>
		
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Ceramic Tiles</h3>
					</div>
					<div class="box-body"  style="border:1px groove #ddd;">
					<form class="form" id="Glazed" method="post">

							<div class="row">

								<div class="col-lg-6">
									<div class="form-group">
									<input type="hidden" class="form-control" id="txt_id" value="<?php echo $serial_no1;?>" name="txt_id" >
									  <label for="inputEmail3" class="col-sm-2 control-label">SR.No.:</label>

									  <div class="col-sm-3">
										<input type="text" class="form-control" id="txt_srno1" value="<?php echo $srno1;?>" name="txt_srno1" >
									  </div>
									  <div class="col-sm-3">
											<input type="text" class="form-control" id="txt_srno2" value="<?php echo $srno2;?>" name="txt_srno2">

									  </div>

										<label for="inputEmail3" class="col-sm-1 control-label">Job No.:</label>
											<div class="col-sm-3">
											<div class="row">
												<div class="col-md-7">
													<input type="text" class="form-control" id="month_name" name="month_name" >
												</div>
												<div class="col-md-5">
													<input type="text" class="form-control" tabindex="1"  value="<?php echo $final_j_no;?>" id="txt_jobno" name="txt_jobno">
												</div>
											</div>
											</div>
									</div>
								</div>
									<div class="col-lg-6">
										<div class="form-group">
										
										  <label for="inputEmail3" class="col-sm-2 control-label">Days:</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="txt_day" name="txt_day">
											</div>
											
											<label for="inputEmail3" class="col-sm-2 control-label">Date:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="3" id="txt_date" name="txt_date" value="<?php echo date("d/m/Y");?>">
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Letter No:</label>
										 

										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="txt_ref" value="<?php echo $ref_name;?>" name="txt_ref">
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">

										  <label for="inputEmail3" class="col-sm-2 control-label">Ref Date:</label>
										  <div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="5" id="ref_date" name="ref_date" value="<?php echo date('d/m/Y', strtotime($ref_date));?>">
												</div>
											</div>
											 <label for="inputEmail3" class="col-sm-2 control-label">ID Brand:</label>
										  <div class="col-sm-4">
											<input type="text" class="form-control" id="txt_brand" name="txt_brand" value="N/A">
										  </div>
										</div>
									</div>
									
								</div>
								<br>
								<div class="row">

									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Detail Of Sample:</label>

										  <div class="col-sm-4">
											<input type="text" class="form-control" id="detail_sample" name="detail_sample" value="Ceramic Tiles">
										  </div>
									

											<label for="inputEmail3" class="col-sm-2 control-label">Identification Mark:</label>

											  <div class="col-sm-4">
												<input type="text" class="form-control" tabindex="1"  id="id_mark" name="id_mark" value="N/A">
											  </div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
										
										  <label for="inputEmail3" class="col-sm-2 control-label">Starting Date of Test:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="3" id="start_date" name="start_date" value="<?php echo date('d/m/Y', strtotime($ref_date));?>">
												</div>
											</div>
											
											<label for="inputEmail3" class="col-sm-2 control-label">Completion Date of Test:</label>
											<div class="col-sm-4">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" tabindex="3" id="end_date" name="end_date" value="<?php echo date("d/m/Y");?>">
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Condition Of Sample:</label>

										  <div class="col-sm-4">
											<select class="form-control" id="con_sample" name="con_sample">
													<option>Seal</option>
													<option>Unsealed</option>	
											</select>
										  </div>
										  <label for="inputEmail3" class="col-sm-2 control-label">Length x Width x Thickness (mm) :</label>
											<div class="col-sm-4">
												
												<input type="text" class="form-control" id="lwh" name="lwh" value="300 x 300 x 6">
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<div class="col-sm-4">
												<button type="button" class="btn btn-info pull-right" id="btn_auto" name="btn_auto" tabindex="14" >Auto</button>

											</div>
										  <div class="col-sm-4">
											
										  </div>
										</div>
									</div>
								</div>
								<hr style="border-top: 1px solid;">
								<div class="row">									
									<div class="col-lg-12">
										<div class="form-group">												
										<label for="inputEmail3" class="col-sm-8 control-label">A. DIMENSION & SURFACE QUALITY:</label>												
										<div class="col-sm-4"></div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-12">
										<div class="form-group">												
												<label for="inputEmail3" class="col-sm-2 control-label">1. </label>
												<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Deviation in Length :</label>												
												<div class="col-sm-4">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="dev_1" name="dev_1">
												</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-12">
										<div class="form-group">												
												<label for="inputEmail3" class="col-sm-2 control-label">2. </label>
												<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Deviation in Thicknes :</label>												
												<div class="col-sm-4">
												<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="dev_2" name="dev_2">
												</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">												
											<label for="inputEmail3" class="col-sm-2 control-label">3. </label>
											<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Straightness of Sides :</label>												
											<div class="col-sm-4">
											<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="dev_3" name="dev_3">
											</div>
									</div>
								</div>
								</div>
								<br>
								<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">												
											<label for="inputEmail3" class="col-sm-2 control-label">4. </label>
											<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Rectangularity :</label>												
											<div class="col-sm-4">
											<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="dev_4" name="dev_4">
											</div>
									</div>
								</div>
								</div>
								<br>
								<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">												
											<label for="inputEmail3" class="col-sm-2 control-label">5. </label>
											<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Surface Flatness (Warpage) :</label>												
											<div class="col-sm-4">
											<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="dev_5" name="dev_5">
											</div>
									</div>
								</div>
								</div>
								<br>								
								<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">												
											<label for="inputEmail3" class="col-sm-2 control-label">6. </label>
											<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Suface Quality :</label>												
											<div class="col-sm-4">
											<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="dev_6" name="dev_6" value="No Visible Defects">
											</div>
									</div>
								</div>
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-12">
										<div class="form-group">												
										<label for="inputEmail3" class="col-sm-8 control-label">B. PHYSICAL PROPERTIES:</label>												
										<div class="col-sm-4"></div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">												
											<label for="inputEmail3" class="col-sm-2 control-label">1. </label>
											<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Bending Strength / Modulus of Rapture :</label>												
											<div class="col-sm-4">
											<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="pp_1" name="pp_1">
											</div>
									</div>
								</div>
								</div>
								<br>
								<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">												
											<label for="inputEmail3" class="col-sm-2 control-label">2. </label>
											<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Resistance to Surface Abrasion :</label>												
											<div class="col-sm-4">
											<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="pp_2" name="pp_2">
											</div>
									</div>
								</div>
								</div>
								<br>
								<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">												
											<label for="inputEmail3" class="col-sm-2 control-label">3. </label>
											<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Water Absorption :</label>												
											<div class="col-sm-4">
											<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="pp_3" name="pp_3">
											</div>
									</div>
								</div>
								</div>
								<br>
								<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">												
											<label for="inputEmail3" class="col-sm-2 control-label">4. </label>
											<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Breaking Strength  :</label>												
											<div class="col-sm-4">
											<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="pp_4" name="pp_4">
											</div>
									</div>
								</div>
								</div>
								<br>
								<div class="row">									
								<div class="col-lg-12">
									<div class="form-group">												
											<label for="inputEmail3" class="col-sm-2 control-label">5. </label>
											<label for="inputEmail3" class="col-sm-2 control-label" style="text-align:right;">Scratch Hardness (Mohs) EN 101 :</label>												
											<div class="col-sm-4">
											<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="pp_5" name="pp_5">
											</div>
									</div>
								</div>
								</div>
								
							<hr style="border-top: 1px solid;">
							<div class="box-footer">
								<div class="row">	
									<div class="col-lg-12">
										<div class="form-group">
											<div class="col-sm-3">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
											</div>

											<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="saveGlazedTiles('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
												
											</div>
											
											<div class="col-sm-2">

													<a target = '_blank' href="<?php echo $base_url; ?>ceremic_tiles_print.php?id=<?php echo $_GET['id'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
													
													
											</div>
											<div class="col-sm-2">
													<button type="button" class="btn btn-info pull-right" onclick="saveGlazedTiles('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>
											</div>
										</div>
								
									</div>
								</div>
							</div>
							<hr>
							<div id="display_data">	
							<div class="row">
										<div class="col-lg-12">
											<table border="1px solid black" align="center" width="100%" id="aaaa">
												<tr>
													<th style="text-align:center;" width="10%"><label>Actions</label></th>
													<th style="text-align:center;"><label>Srno</label></th>	
													<th style="text-align:center;"><label>Jobno</label></th>	
													<th style="text-align:center;"><label>Days</label></th>	
													<th style="text-align:center;"><label>Date</label></th>	
													<th style="text-align:center;"><label>Latter No</label></th>	
													<th style="text-align:center;"><label>Ref Date</label></th>
													<th style="text-align:center;"><label>ID Brand</label></th>		
													<th style="text-align:center;"><label>Detail Of Sample</label></th>
													<th style="text-align:center;"><label>ID Mark</label></th>		
													<th style="text-align:center;"><label>Starting Date of Testing</label></th>	
													<th style="text-align:center;"><label>Complition Date of Testing</label></th>	
													<th style="text-align:center;"><label>Condition of Sample</label></th>
                                            													

												</tr>
													<?php
												 $query = "select * from ceramic_tiles WHERE bill_id='$aa'";
						
													$result = mysqli_query($conn, $query);
								
			
													if (mysqli_num_rows($result) > 0) {
												while($r = mysqli_fetch_array($result)){
										
															if($r['is_deleted'] == 0){
															?>
															<tr>
															<td style="text-align:center;" width="10%">	
															
															<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?saveGlazedTiles('delete','<?php echo $r['id']; ?>'):false;"></a>
															</td>
															<td style="text-align:center;"><?php echo $r['bill_id'];?></td>
															<td style="text-align:center;"><?php echo $r['job_no'];?></td>
															<td style="text-align:center;"><?php echo $r['days'];?></td>
															<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['date']));?></td>
															<td style="text-align:center;"><?php echo $r['ref_name'];?></td>
															<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['ref_date']));?></td>
															<td style="text-align:center;"><?php echo $r['id_brand'];?></td>
															<td style="text-align:center;"><?php echo $r['detail_sample'];?></td>
															<td style="text-align:center;"><?php echo $r['id_mark'];?></td>
															<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['start_date']));?></td>
															<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['end_date']));?></td>
															<td style="text-align:center;"><?php echo $r['con_sample'];?></td>
															</tr>
															<?php
															}
														}
													}
												?>
												
											</table>
										</div>
									</div>
								
								<hr>
							</div>
					</form>
						<!---------->
				<div>
			</div>
		</div>
	</div>
</section>
</div>
					
	
		
<?php include("footer.php");?>
<script>

 //Date picker
   $('#txt_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	$('#ref_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
		//alert("dss");
		var ref = $('#ref_date').val();
		//alert(ref);
		document.getElementById('start_date').value = ref;
		/*job number*/
		if ( $('#month_name').val() != '' ) {
			$('#month_name').val('');
			if ( $('#month_name').val() == '' ) {
				//var jobnos = <?php echo $final_j_no;?>;
				//alert(jobnos);
				var months = ["Jan-", "Feb-", "Mar-", "Apr-", "May-", "Jun-",
           "Jul-", "Aug-", "Sep-", "Oct-", "Nov-", "Dec-"];
		   var monthsa = "CTL/";//months[(ref.split('/')[1]-1)];
		  
		   document.getElementById('month_name').value = monthsa;
		
				
			}
		}
  });
	

	

  $(function () {
    $('.select2').select2();
  });
$(document).ready(function(){ 
var ref = $('#ref_date').val();
	var months = ["Jan-", "Feb-", "Mar-", "Apr-", "May-", "Jun-",
           "Jul-", "Aug-", "Sep-", "Oct-", "Nov-", "Dec-"];
		   var monthsa = "CTL/";//months[(ref.split('/')[1]-1)];
		   //alert(monthsa);
			//var job_no_final = $('#txt_jobno').val();
			//alert(job_no_final);
			//var final_jobs = monthsa+job_no_final;
			//alert(final_jobs);
		   document.getElementById('month_name').value = monthsa;
    $('#btn_edit_data').hide();
	$("#start_date").datepicker({
        todayBtn:  1,
        autoclose: true,
		format: 'dd/mm/yyyy'
    });

    $("#end_date").datepicker({autoclose: true,format: 'dd/mm/yyyy'});
	$('#txt_day').change(function(e){	
        var days = $('#txt_day').val();
	//alert(days);
	days = parseInt(days);
		
	var date_input = document.getElementById("start_date").value.split('/');
	//alert(date_input);
	var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);
	//alert(date);
	var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + days);
	var dd = newdate.getDate();
	var mm = newdate.getMonth() + 1;
	var y = newdate.getFullYear();
	if(mm <= 9)
    mm = '0'+mm;
	if(dd <= 9)
    dd = '0'+dd;
	var someFormattedDate = dd + '/' + mm + '/' + y;
	//alert(someFormattedDate);exit;
  document.getElementById('end_date').value = someFormattedDate;
  document.getElementById('txt_date').value = someFormattedDate;
	});
		// $('#aaaa').DataTable();
});


</script>

<script>

$("#btn_auto").click(function(){
		//alert("Estimate Your Bill Successfully");
	var minNumber = -100;
	var maxNumber = 40;
	var dev_1 = randomNumberFromRange(0.00,1.20);
	var dev_2 = randomNumberFromRange(0.0, 10.0);
	var dev_3 = randomNumberFromRange(0.00,1.00);
	var dev_4 = randomNumberFromRange(0.00,1.20);
	var dev_5 = randomNumberFromRange(0.00, 1.00);	
	var pp_1 = randomNumberFromRange(22.00, 50.00);
	var pp_2 = randomNumberFromRange(60,150);
	var pp_3 = randomNumberFromRange(3.0, 6.0);
	var pp_4 = randomNumberFromRange(600.00, 900.00);
	var pp_5 = randomNumberFromRange(4.0,6.0);	
	
	

	function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}
    $('#dev_1').val(dev_1.toFixed(2));
    $('#dev_2').val(dev_2.toFixed(1));
    $('#dev_3').val(dev_3.toFixed(2));
    $('#dev_4').val(dev_4.toFixed(2));
    $('#dev_5').val(dev_5.toFixed(2));    
    $('#pp_1').val(pp_1.toFixed(2));
    $('#pp_2').val(pp_2.toFixed(0));
    $('#pp_3').val(pp_3.toFixed(1));
    $('#pp_4').val(pp_4.toFixed(2));
    $('#pp_5').val(pp_5.toFixed(1));
   
	//console.log(randomNumber);
	});
	
</script>
<script>
$("#btn_edit_data").click(function(){
			$('#btn_edit_data').hide();
			$('#btn_save').show();

	});
function getGlazedTiles(){
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>saveCeramicTiles.php',
        data: 'action_type=view&'+$("#Glazed").serialize()+'&get_of_srno='+get_of_srno,
        success:function(html){
            $('#display_data').html(html);

        }
    });
}

function saveGlazedTiles(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
				var txt_srno1 = $('#txt_srno1').val(); 
				var txt_id = $('#txt_id').val(); 
				var txt_srno2 = $('#txt_srno2').val(); 
				var get_srno=txt_srno1+txt_srno2;
				var txt_jobno = $('#txt_jobno').val(); 
				var txt_ref = $('#txt_ref').val(); 
				var ref_date = $('#ref_date').val(); 
				var txt_day = $('#txt_day').val();
				var txt_date = $('#txt_date').val();
				var txt_brand = $('#txt_brand').val();
				var detail_sample = $('#detail_sample').val();
				var id_mark = $('#id_mark').val();
				var start_date = $('#start_date').val();
				var end_date = $('#end_date').val();
				var con_sample = $('#con_sample').val();				
				var lwh = $('#lwh').val();
				var dev_1 = $('#dev_1').val();
				var dev_2 = $('#dev_2').val();
				var dev_3 = $('#dev_3').val();
				var dev_4 = $('#dev_4').val();
				var dev_5 = $('#dev_5').val();
				var dev_6 = $('#dev_6').val();				
				var pp_1 = $('#pp_1').val();
				var pp_2 = $('#pp_2').val();
				var pp_3 = $('#pp_3').val();
				var pp_4 = $('#pp_4').val();
				var pp_5 = $('#pp_5').val();
				var month_name = $('#month_name').val();				
				
				if(txt_brand !== "" && txt_day !== "")
				{
				
					billData = '&action_type='+type+'&id='+id+'&txt_id='+txt_id+'&get_srno='+get_srno+'&txt_jobno='+txt_jobno+'&txt_ref='+txt_ref+'&ref_date='+ref_date+'&txt_day='+txt_day+'&txt_date='+txt_date+'&txt_brand='+txt_brand+'&detail_sample='+detail_sample+'&id_mark='+id_mark+'&start_date='+start_date+'&end_date='+end_date+'&con_sample='+con_sample+'&lwh='+lwh+'&dev_1='+dev_1+'&dev_2='+dev_2+'&dev_3='+dev_3+'&dev_4='+dev_4+'&dev_5='+dev_5+'&dev_6='+dev_6+'&pp_1='+pp_1+'&pp_2='+pp_2+'&pp_3='+pp_3+'&pp_4='+pp_4+'&pp_5='+pp_5+'&month_name='+month_name;
				}
				else{
					// $('#alert').show();
					swal(
						  'Oops...',
						  'Please Fil all the field!',
						  'error'
						)
				}
	}
	else if (type == 'edit'){
		
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
				var txt_srno1 = $('#txt_srno1').val(); 
				var txt_id = $('#txt_id').val(); 
				var txt_srno2 = $('#txt_srno2').val(); 
				var get_srno=txt_srno1+txt_srno2;
				var txt_jobno = $('#txt_jobno').val(); 
				var txt_ref = $('#txt_ref').val(); 
				var ref_date = $('#ref_date').val(); 
				var txt_day = $('#txt_day').val();
				var txt_date = $('#txt_date').val();
				var txt_brand = $('#txt_brand').val();
				var detail_sample = $('#detail_sample').val();
				var id_mark = $('#id_mark').val();
				var start_date = $('#start_date').val();
				var end_date = $('#end_date').val();
				var con_sample = $('#con_sample').val();
				var lwh = $('#lwh').val();
				var dev_1 = $('#dev_1').val();
				var dev_2 = $('#dev_2').val();
				var dev_3 = $('#dev_3').val();
				var dev_4 = $('#dev_4').val();
				var dev_5 = $('#dev_5').val();
				var dev_6 = $('#dev_6').val();				
				var pp_1 = $('#pp_1').val();
				var pp_2 = $('#pp_2').val();
				var pp_3 = $('#pp_3').val();
				var pp_4 = $('#pp_4').val();
				var pp_5 = $('#pp_5').val();
				var month_name = $('#month_name').val();	
				var txt_id1 = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&txt_id='+txt_id1+'&get_of_srno='+get_of_srno+'&get_srno='+get_srno+'&txt_jobno='+txt_jobno+'&txt_ref='+txt_ref+'&ref_date='+ref_date+'&txt_day='+txt_day+'&txt_date='+txt_date+'&txt_brand='+txt_brand+'&detail_sample='+detail_sample+'&id_mark='+id_mark+'&start_date='+start_date+'&end_date='+end_date+'&con_sample='+con_sample+'&lwh='+lwh+'&dev_1='+dev_1+'&dev_2='+dev_2+'&dev_3='+dev_3+'&dev_4='+dev_4+'&dev_5='+dev_5+'&dev_6='+dev_6+'&pp_1='+pp_1+'&pp_2='+pp_2+'&pp_3='+pp_3+'&pp_4='+pp_4+'&pp_5='+pp_5+'&month_name='+month_name;
    }
	else{
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
	
				billData = 'action_type='+type+'&id='+id+'&get_of_srno='+get_of_srno;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>saveCeramicTiles.php',
        data: billData,
		dataType:'JSON',

        success:function(msg){
         
                getGlazedTiles();
				
					$('#txt_jobno').val(msg.txt_jobno);	 
	
        }
    });
}
function editData(id){
				var txt_srno_of1 = $('#txt_srno1').val(); 
				var txt_srno_of2 = $('#txt_srno2').val(); 
				var get_of_srno=txt_srno_of1+txt_srno_of2;
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: '<?php echo $base_url; ?>saveCeramicTiles.php',
        data: 'action_type=data&id='+id+'&get_of_srno='+get_of_srno,
        success:function(data){
            $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();
	
			var job_month1 = data.job_no;
			var job_nos = job_month1.substring(4);
			var job_month = job_month1.slice(0,-1);
			//alert(job_month);
            $('#txt_jobno').val(job_nos);
            $('#month_name').val(job_month);
            $('#txt_day').val(data.days);
            $('#txt_date').val(data.date);
            $('#txt_ref').val(data.ref_name);
            $('#ref_date').val(data.ref_date);
            $('#txt_brand').val(data.id_brand);
            $('#detail_sample').val(data.detail_sample);
            $('#id_mark').val(data.id_mark);
            $('#start_date').val(data.start_date);
            $('#end_date').val(data.end_date);
            $('#con_sample').val(data.con_sample);
            $('#lwh').val(data.lwh);
			$('#dev_1').val(data.dev_1);
            $('#dev_2').val(data.dev_2);
            $('#dev_3').val(data.dev_3);
            $('#dev_4').val(data.dev_4);
            $('#dev_5').val(data.dev_5);
            $('#dev_6').val(data.dev_6);            
            $('#pp_1').val(data.pp_1);
            $('#pp_2').val(data.pp_2);
            $('#pp_3').val(data.pp_3);
            $('#pp_4').val(data.pp_4);
            $('#pp_5').val(data.pp_5);            
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}

</script>

