<?php
include("connection.php");
		$mail=$_REQUEST['email'];
		$select="select * from staff where staff_email='".$mail."'";
		$q=mysqli_query($conn,$select);
		$res=mysqli_fetch_array($q);
		$email = $res['staff_email'];
		//PRINT_R	($q); exit;
		 if($email !== "") 
		 {
		  $to=$email;
		  $subject='Remind password';
		  $message='Your password : '.$res['staff_pass']; 
		  $headers='From:vaibhav.wfgs@gmail.com';
		  $m=mail($to,$subject,$message,$headers);
		  if($m)
		  {
			echo'Check your inbox in mail';
		  }
		  else
		  {
		   echo'mail is not send';
		  }
		 }
		 else
		 {
		  echo'You entered mail id is not present';
		 }

?>