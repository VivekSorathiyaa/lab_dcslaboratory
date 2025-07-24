<?php 
include("connection.php");
$mailto = $master_mail_id;
$subject = 'Database OF'.$lab_db;
$url_destination = dirname(__FILE__)."/dailybackup/".$backup_file_name; 
$file = $url_destination;
$from_name = "Vaibhav Joshi";
$from_mail = "vaibhav.wfgs@gmail.com";
$replyto = "vaibhav.wfgs@gmail.com";
$message = "Please find attachment";
$filename = $backup_file_name;
$content = file_get_contents($file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$name = basename($file);

// header
$header = "From: ".$from_name." <".$from_mail.">\r\n";
$header .= "Reply-To: ".$replyto."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

// message & attachment
$nmessage = "--".$uid."\r\n";
$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$nmessage .= $message."\r\n\r\n";
$nmessage .= "--".$uid."\r\n";
$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
$nmessage .= "Content-Transfer-Encoding: base64\r\n";
$nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
$nmessage .= $content."\r\n\r\n";
$nmessage .= "--".$uid."--";

if (mail($mailto, $subject, $nmessage, $header)) {
	alert("success");
  //  return true; // Or do something here
} else {
  alert("fail");
  //return false;
}
?>