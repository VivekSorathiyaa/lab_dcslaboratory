
<?php
include 'connection.php';
//on category changes
if(isset($_POST['select_material_category'])){
   $select_material_category = $_POST['select_material_category'];
   $query = "SELECT * FROM material WHERE `mt_status`=1 AND `mt_isdeleted`=0 AND mat_category_id =".$select_material_category;
	$result = mysqli_query($conn,$query);
	?>
	 <option value="">Select Material</option>
	<?php
	while($row = mysqli_fetch_assoc($result)) 
	{ ?>
  
    <option value="<?php echo $row['id']; ?>"><?php echo $row["mt_name"];?></option>;
  
    <?php }
	//echo json_encode(array('output' => $output));
}

if(isset($_POST['txt_new_material'])){
	
	$txt_new_material = $_POST['txt_new_material'];
	$gst_type = $_POST['gst_type'];
   
    $query = "SELECT * FROM material WHERE `mt_status`=1 AND `mt_isdeleted`=0 AND id =".$txt_new_material;
	$results = mysqli_query($conn,$query);
    $get_materials= mysqli_fetch_array($results);
   
    $mt_name=$get_materials['mt_name'];
    $mt_prefix=$get_materials['mt_prefix'];
   
    $mate_rate=$_POST['mate_rate'];
	
	if($mate_rate=="0"){
	   $get_material_rate= $get_materials["mt_rate"];
	   
   }else if($mate_rate=="1"){
	   $get_material_rate= $get_materials["rate_garry"];
	   
   }else{
	   $get_material_rate= $get_materials["rate_rnb"];
	   
   }
   
   
   if($gst_type=="with_gst")
	{

		$tax = "SELECT * FROM tax";
		$result1 = mysqli_query($conn,$tax);
		$row1 = mysqli_fetch_assoc($result1);
		
		$cgst=$row1['tax_cgst'];
		$sgst=$row1['tax_sgst'];
		
	
		
		
		$cgst_count=($get_material_rate*$cgst)/100;
		$sgst_count=($get_material_rate*$sgst)/100;
		
		$final_rate=$get_material_rate+$cgst_count+$cgst_count;
		
		$fill = array(
        'txt_new_material' => $mt_name,
        'txt_qty' => 1,
        'txt_rate' => $get_material_rate,
        'txt_cgst' => $cgst_count,
        'txt_sgst' => $sgst_count,
        'txt_net' => $final_rate,
        'mt_prefix' => $mt_prefix
        );
	
	}else{
		$fill = array(
        'txt_new_material' => $mt_name,
        'txt_qty' => 1,
        'txt_rate' => $get_material_rate,
        'txt_cgst' => 0,
        'txt_sgst' => 0,
        'txt_net' => $get_material_rate,
        'mt_prefix' => $mt_prefix
        );
		
	}
	echo json_encode($fill);
   
	
}

?>
   
							