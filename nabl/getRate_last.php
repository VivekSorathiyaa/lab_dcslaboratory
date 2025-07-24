
<?php
include 'connection.php';
  
if(isset($_POST['txt_new_material'])){
   $txt_new_material = $_POST['txt_new_material'];

 $query = "SELECT * FROM material WHERE id = '$txt_new_material'";
	$result = mysqli_query($conn, $query);
	 
	$row = mysqli_fetch_assoc($result);
	$tax = "SELECT * FROM tax";
	$result1 = mysqli_query($conn,$tax);
	$row1 = mysqli_fetch_assoc($result1);
	
	$material_rate=$row['mt_rate']; 
	$cgst=$row1['tax_cgst'];
	$sgst=$row1['tax_sgst'];
	$gst=$cgst+$sgst;
	
	$plus_gst=100+$gst;
	
	$ans=($material_rate*$gst)/$plus_gst;
	$final_rate=$material_rate-$ans;
	
	$final_gst=$ans/2;
   ?>
   
								<form id="billing" method="post">
								<div id="result">
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control select2" name="select_material" id="select_material">
													<option>Select..</option>
													<?php 
													$sql = "select * from material order by id";
												
													$result = mysqli_query($conn, $sql);

													if (mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
													
													?>
													<option value="<?php echo $row['id'];?>"><?php echo $row['mt_name'];?></option>
													<?php } }?>
												</select>
											</div>
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group">
										
											<div class="col-sm-4">
												<input type="text" class="form-control" name="txt_qty" id="txt_qty" value="1">
											</div>
											
											<div class="col-sm-4">
												<input type="text" class="form-control" name="txt_rate" id="txt_rate" value="<?php echo $final_rate; ?>">
											</div>
											
											<div class="col-sm-4">
												<input type="text" class="form-control" name="txt_cgst" id="txt_cgst" value="<?php echo $final_gst; ?>">
											</div>
											
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
										
											<div class="col-sm-4">
												<input type="text" class="form-control" name="txt_sgst" id="txt_sgst" value="<?php echo $final_gst;?>">
											</div>
										
		
											
											<div class="col-sm-4">
												<input type="text" class="form-control" name="txt_net" id="txt_net" value="<?php echo $material_rate;?>">
											</div>
										</div>
									</div>
								</div>
								</form>
									<?php
	}
?>
  <script>
$(document).ready(function(){
   $("#txt_qty").change(function(){
        		var txt_new_material = $('#select_material').val(); 
				var txt_qty=$('#txt_qty').val(); 
				var txt_rate=$('#txt_rate').val(); 
				var txt_cgst=$('#txt_cgst').val();
				var txt_sgst=$('#txt_sgst').val();
				var txt_net=$('#txt_net').val();
				 var myData={"txt_new_material":txt_new_material,"txt_qty":txt_qty,"txt_rate":txt_rate,"txt_cgst":txt_cgst,"txt_sgst":txt_sgst,"txt_net":txt_net};
				

		$.ajax({
			url : "getFinalRate.php",
			type: "POST",
			data: myData,	
			success: function(data,status,  xhr)
			 {
				$("#result").html(data);
			 }
		}); 
    });
});
	
  </script>

