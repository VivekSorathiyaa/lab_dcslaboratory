
<?php
include 'connection.php';
if(isset($_POST['txt_new_material'])){
   $txt_new_material = $_POST['txt_new_material'];
   $gst_type=$_POST["gst_type"];
   $txt_statecode=$_POST["txt_statecode"];
	
  if($gst_type=="include"){ 
  
 $query = "SELECT * FROM material WHERE id = '$txt_new_material' AND `mt_status`='1' AND `mt_isdeleted`='1'";
	$result = mysqli_query($conn, $query);
	 
	$row = mysqli_fetch_assoc($result);
	$mt_name=$row['mt_name'];
	
	$tax = "SELECT * FROM tax";
	$result1 = mysqli_query($conn,$tax);
	$row1 = mysqli_fetch_assoc($result1);
	
	$material_rate=$row['mt_rate']; 
	$cgst=$row1['tax_cgst'];
	$sgst=$row1['tax_sgst'];
	if($txt_statecode==24){
		$gst=$cgst+$sgst;
	}else{
		$gst=$row1['tax_igst'];
	}
	
	
	$plus_gst=100+$gst;
	
	$ans=($material_rate*$gst)/$plus_gst;
	$final_rate=$material_rate-$ans;
	
	$final_gst=$ans/2;
	
	 $fill = array(
        'txt_new_material' => $mt_name,
        'txt_qty' => 1,
        'txt_rate' => round($final_rate, 2),
        'txt_cgst' => round($final_gst, 2),
        'txt_sgst' => round($final_gst, 2),
		'txt_igst' => round($final_gst, 2)*2,
        'txt_net' => $material_rate
        );
		
  }else{
	  
	  $query = "SELECT * FROM material WHERE id = '$txt_new_material' AND `mt_status`='1' AND `mt_isdeleted`='1'";
	$result = mysqli_query($conn, $query);
	 
	$row = mysqli_fetch_assoc($result);
	$mt_name=$row['mt_name'];
	
	$tax = "SELECT * FROM tax";
	$result1 = mysqli_query($conn,$tax);
	$row1 = mysqli_fetch_assoc($result1);
	
	$material_rate=$row['mt_rate']; 
	$cgst=$row1['tax_cgst'];
	$sgst=$row1['tax_sgst'];
	$igst=$row1['tax_igst'];
	if($txt_statecode==24){
		$gst=$cgst+$sgst;
	}else{
		$gst=$row1['tax_igst'];
	}
	
	$plus_gst=100+$gst;
	
	$ans=($material_rate*$gst)/$plus_gst;
	$final_rate=$material_rate-$ans;
	
	$final_gst=$ans/2;
	
	$ex_rate= ($material_rate*$gst)/100;
	$cgst_count=($material_rate*$cgst)/100;
	$sgst_count=($material_rate*$sgst)/100;
	$igst_count=($material_rate*$igst)/100;
	$final_ex_amt= $material_rate + $ex_rate;
	 $fill = array(
        'txt_new_material' => $mt_name,
        'txt_qty' => 1,
        'txt_rate' => $material_rate,
        'txt_cgst' => $cgst_count,
        'txt_sgst' => $sgst_count,
        'txt_igst' => $igst_count,
        'txt_net' => $final_ex_amt
        );
	  
  }
    echo json_encode($fill);

}
	
   ?>
   
							