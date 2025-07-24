
<?php
include 'connection.php';
  
if(isset($_POST["type"]) && $_POST["type"]=="change_qty"){
	
	$txt_qty = $_POST['txt_qty'];
	$txt_rate=$_POST['txt_rate'];
	$txt_cgst=$_POST['txt_cgst'];
	$txt_sgst=$_POST['txt_sgst'];
	$txt_net=$_POST['txt_net'];
	
	$gst_type=$_POST['gst_type'];
	
	if($gst_type=="with_gst"){
		
		
	   $get_material_rate= $txt_rate;
	   
   

	$tax = "SELECT * FROM tax";
	$result1 = mysqli_query($conn,$tax);
	$row1 = mysqli_fetch_assoc($result1);
	
	$cgst=$row1['tax_cgst'];
	$sgst=$row1['tax_sgst'];
	$gst=$cgst+$sgst;
	
	
	$plus_gst=100+$gst;
	
	$ans=($get_material_rate*$gst)/$plus_gst;
	$final_rate=($get_material_rate-$ans);
	
	$final_gst=($ans/2)*$txt_qty;
	
	
   $final_txt_rate=$txt_rate*$txt_qty;
   $final_txt_cgst=$txt_cgst*$txt_qty;
   $final_txt_sgst=$txt_sgst*$txt_qty;
   $final_txt_net=$get_material_rate*$txt_qty;
   
   
	
		$total_cgst= ($txt_rate*$cgst)/100;
		$total_sgst= ($txt_rate*$sgst)/100;
		$latest_cgst= $total_cgst*$txt_qty;
		$latest_sgst= $total_sgst*$txt_qty;
		$final_net_amt=($txt_rate*$txt_qty) + $latest_cgst + $latest_sgst;
		 $fill = array(
        'txt_new_material' => $txt_new_material,
        'txt_qty' => $txt_qty,
        'txt_rate' =>  $txt_rate,
        'txt_cgst' =>  $latest_cgst,
        'txt_sgst' =>  $latest_sgst,
        'txt_net' => $final_net_amt,
        
         );
	
	echo json_encode($fill);
		
	}
	
	if($gst_type=="without_gst"){
		
		
	   $get_material_rate= $txt_rate;
	   
	$tax = "SELECT * FROM tax";
	$result1 = mysqli_query($conn,$tax);
	$row1 = mysqli_fetch_assoc($result1);
	
	$cgst=$row1['tax_cgst'];
	$sgst=$row1['tax_sgst'];
	$gst=$cgst+$sgst;
	
	
	$plus_gst=100+$gst;
	
	$ans=($get_material_rate*$gst)/$plus_gst;
	$final_rate=($get_material_rate-$ans);
	
	$final_gst=($ans/2)*$txt_qty;
	
    $final_txt_cgst= 0;
    $final_txt_sgst= 0;
   
	   $final_txt_net_sum= ($get_material_rate*$txt_qty) + $final_txt_cgst + $final_txt_sgst;
   
   

   	
	 $fill = array(
        'txt_new_material' => $txt_new_material,
        'txt_qty' => $txt_qty,
        'txt_rate' =>  $get_material_rate,
        'txt_cgst' =>  $final_txt_cgst,
        'txt_sgst' =>  $final_txt_sgst,
        'txt_net' => $final_txt_net_sum,
        
         );
		
    echo json_encode($fill);
	}
	
	
	
}

if(isset($_POST["type"]) && $_POST["type"]=="rate_changes"){
		
		$txt_qty = $_POST['txt_qty'];
		$txt_rate=$_POST['txt_rate'];
		$txt_cgst=$_POST['txt_cgst'];
		$txt_sgst=$_POST['txt_sgst'];
		$txt_net=$_POST['txt_net'];
		$gst_type=$_POST['gst_type'];
		
		if($gst_type=="with_gst"){
		
		$tax = "SELECT * FROM tax";
		$result1 = mysqli_query($conn,$tax);
		$row1 = mysqli_fetch_assoc($result1);
		
		$cgst=$row1['tax_cgst'];
		$sgst=$row1['tax_sgst'];
		$gst=$cgst+$sgst;
		
		$cgstamt= ($txt_rate*$cgst/100)*$txt_qty;
		$sgstamt= ($txt_rate*$sgst/100)*$txt_qty;
		
		$final_txt_net_sum= ($txt_rate*$txt_qty) + $cgstamt + $sgstamt;
		
		$fill = array(
        'txt_new_material' => $txt_new_material,
        'txt_qty' => $txt_qty,
        'txt_rate' =>  $txt_rate,
        'txt_cgst' =>  $cgstamt,
        'txt_sgst' =>  $sgstamt,
        'txt_net' => $final_txt_net_sum
         );
		
			echo json_encode($fill);
		}
		
		if($gst_type=="without_gst"){
			
			
			$fill = array(
        'txt_new_material' => $txt_new_material,
        'txt_qty' => $txt_qty,
        'txt_rate' =>  $txt_rate,
        'txt_cgst' =>  0,
        'txt_sgst' =>  0,
        'txt_net' => $txt_rate*$txt_qty
         );
		
			echo json_encode($fill);
			
			
		}
	
}
	
	
	
   
 
   ?>
