
<?php
include 'connection.php';
  
		$txt_qty = $_POST['txt_qty'];
		$txt_rate=$_POST['txt_rate'];
		$txt_cgst=$_POST['txt_cgst'];
		$txt_sgst=$_POST['txt_sgst'];
		$txt_net=$_POST['txt_net'];
		$rate=$_POST['txt_new_rate'];
		$gst_type=$_POST['gst_type'];
		
	if($gst_type=="include"){
		
		$txt_new_material = $_POST['txt_new_material'];
   
   $query = "SELECT * FROM material WHERE id = '$txt_new_material' AND `mt_status`='1' AND `mt_isdeleted`='1'";
	$result = mysqli_query($conn, $query);
	 
	$row = mysqli_fetch_assoc($result);
	
	$tax = "SELECT * FROM tax";
	$result1 = mysqli_query($conn,$tax);
	$row1 = mysqli_fetch_assoc($result1);
	
	$cgst=$row1['tax_cgst'];
	$sgst=$row1['tax_sgst'];
	$gst=$cgst+$sgst;
	
	$plus_gst=100+$gst;
	
	$ans=($rate*$gst)/$plus_gst;
	$final_rate=($rate-$ans)*$txt_qty;
	
	$final_gst=($ans/2)*$txt_qty;
	
	
   $final_txt_rate=$txt_rate*$txt_qty;
   $final_txt_cgst=$txt_cgst*$txt_qty;
   $final_txt_sgst=$txt_sgst*$txt_qty;
   $final_txt_net=$rate*$txt_qty;
   
   	
	/*  $fill = array(
        'txt_new_material' => $txt_new_material,
        'txt_qty' => $txt_qty,
        'txt_rate' =>  round($final_rate, 2),
        'txt_cgst' =>  round($final_gst, 2),
        'txt_sgst' =>  round($final_gst, 2),
        'txt_net' => $final_txt_net,
        
         ); */
		 
	// code for new change of edit rate Start
	
		$total_cgst= ($rate*$cgst)/100;
		$total_sgst= ($rate*$sgst)/100;
		$latest_cgst= $total_cgst*$txt_qty;
		$latest_sgst= $total_sgst*$txt_qty;
		$final_net_amt=($rate*$txt_qty) + $latest_cgst + $latest_sgst;
		 $fill = array(
        'txt_new_material' => $txt_new_material,
        'txt_qty' => $txt_qty,
        'txt_rate' =>  $rate,
        'txt_cgst' =>  $latest_cgst,
        'txt_sgst' =>  $latest_sgst,
        'txt_net' => $final_net_amt,
        
         );
	
	// code for new change of edit rate Stop
		
	}else{
		
		$txt_new_material = $_POST['txt_new_material'];
   
   $query = "SELECT * FROM material WHERE id = '$txt_new_material' AND `mt_status`='1' AND `mt_isdeleted`='1'";
	$result = mysqli_query($conn, $query);
	 
	$row = mysqli_fetch_assoc($result);
	
	$tax = "SELECT * FROM tax";
	$result1 = mysqli_query($conn,$tax);
	$row1 = mysqli_fetch_assoc($result1);
	
	$cgst=$row1['tax_cgst'];
	$sgst=$row1['tax_sgst'];
	$gst=$cgst+$sgst;
	
	$plus_gst=100+$gst;
	
	$ans=($rate*$gst)/$plus_gst;
	$final_rate=($rate-$ans)*$txt_qty;
	
	$final_gst=($ans/2)*$txt_qty;
	
	
   $final_txt_rate=$txt_rate*$txt_qty;
   $final_txt_cgst=$txt_cgst*$txt_qty;
   $final_txt_sgst=$txt_sgst*$txt_qty;
   $final_txt_net=$rate*$txt_qty;
   
   	
	/*  $fill = array(
        'txt_new_material' => $txt_new_material,
        'txt_qty' => $txt_qty,
        'txt_rate' =>  round($final_rate, 2),
        'txt_cgst' =>  round($final_gst, 2),
        'txt_sgst' =>  round($final_gst, 2),
        'txt_net' => $final_txt_net,
        
         ); */
		 
		 // code for new change of edit rate Start
	
		$total_cgst= ($rate*$cgst)/100;
		$total_sgst= ($rate*$sgst)/100;
		$latest_cgst= $total_cgst*$txt_qty;
		$latest_sgst= $total_sgst*$txt_qty;
		$final_net_amt=($rate*$txt_qty) + $latest_cgst + $latest_sgst;
		 $fill = array(
        'txt_new_material' => $txt_new_material,
        'txt_qty' => $txt_qty,
        'txt_rate' =>  $rate,
        'txt_cgst' =>  $latest_cgst,
        'txt_sgst' =>  $latest_sgst,
        'txt_net' => $final_net_amt,
        
         );
	
	// code for new change of edit rate Stop
	}
	
   
    echo json_encode($fill);
 
   ?>