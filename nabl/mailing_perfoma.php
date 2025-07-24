<?php
include("connection.php");
include("password_for_mail.php");
//error_reporting(1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'D:\WFGS\htdocs\rajkotlab\nabl\PHPMailer-master\src/Exception.php';
require 'D:\WFGS\htdocs\rajkotlab\nabl\PHPMailer-master\src/PHPMailer.php';
require 'D:\WFGS\htdocs\rajkotlab\nabl\PHPMailer-master\src/SMTP.php';

    
	
	$chk_array=$_POST["chk_array"];
	//$chk_array="2521,2522";
	
	//$chk_array = array('1803', '1804', '1805', '1806');
	$explodes=explode(",", $chk_array);
	
	
	
	$rrorr = array();
	$mailing_array = array();
	$attach_array = array();
	$trf_array = array();
	$sizing = array();
	foreach($explodes as $keyed => $one_chk){
	$onces=explode("|",$one_chk);
	$perfoma_no=$onces[0];
	$trf_nos=$onces[1];
		$sel_scaned="select * from upload_perfoma where `is_deleted`=0 AND `perfoma_no`='$perfoma_no'";
		$query_scanned=mysqli_query($conn,$sel_scaned);
		if(mysqli_num_rows($query_scanned) > 0)
		{
			$row_scanned=mysqli_fetch_array($query_scanned);
			$document=$row_scanned["documents"];
			
			
			$sel_scaner="select * from job where `trf_no`='$trf_nos'";
			$query_scan=mysqli_query($conn,$sel_scaner);
			$result_scanner=mysqli_fetch_array($query_scan);
			$agency=$result_scanner["billing_to_id"];
			
			$sel_agency="select * from agency_master where `agency_id`=".$agency;
			$query_agency=mysqli_query($conn,$sel_agency);
			$result_agency=mysqli_fetch_array($query_agency);
			$agency_name=$result_agency["agency_name"];
			$agency_email=$result_agency["agency_email"];
			
			if($agency_email!="")
			{
					
					
						
						if (!in_array($agency_email, $mailing_array))
					{
						$file_sizes=filesize('D:\WFGS\htdocs\rajkotlab\nabl\perfoma_pdf_upload/'.$document);
						$in_mb=$file_sizes / 1000000;
						if($in_mb< 9.9)
						{
							array_push($mailing_array,$agency_email);
							array_push($attach_array,array($document));
							array_push($sizing,array($in_mb));
							
							if (!in_array($perfoma_no, $trf_array))
							{
							array_push($trf_array,array($perfoma_no));
							}
						}else{
							break;
						}
					}
					else
					{
						$key = array_search ($agency_email, $mailing_array);
						$file_sizing= $sizing[$key];
						$file_sizes=filesize('D:\WFGS\htdocs\rajkotlab\nabl\perfoma_pdf_upload/'.$document);
						$in_mb=$file_sizes / 1000000;
						if($in_mb < 9.9)
						{
							$set_size=floatval($file_sizing)+floatval($in_mb);
							if($set_size< 9.9)
							{
								array_push($attach_array[$key],$document);
								$sizing[$key]=$set_size;
								if (!in_array($perfoma_no, $trf_array[$key]))
								{
								array_push($trf_array[$key],$perfoma_no);
								}
							}else{
								break;
							}
						}else{
							break;
						}
						
					}
					
					//$mail->addAttachment('C:/xampp/htdocs/rajkotlab/nabl/scanned_document/'.$document, $document);
					//$mail->AddAddress($agency_email);
					//if(!$mail->send()){
					//	array_push($rrorr,"fails");
					//}else{
					//	array_push($rrorr,"SENTS");
					//}
			}
			
			
		}
	}
	
	if(!empty($mailing_array))
	{
		foreach($mailing_array as $mail_key => $one_mail)
		{
			$mail=new PHPMailer();
					$mail->IsSMTP();
					$mail->SMTPAuth   = TRUE;
					$mail->SMTPSecure = "tls";
					$mail->Port       = $invoice_out_port_no;
					$mail->CharSet    = "UTF-8";
					$mail->IsHTML(true);
					$mail->Host       = $invoice_mail_host;
					$mail->Username   = $invoice_email;
					$mail->Password   = $invoice_password;
					$mail->SetFrom   = $invoice_replay_mail_id;
					$mail->Subject   = "PROFORMA "."(".implode(",",$trf_array[$mail_key]).")";
					$concats ="";
					$array_report=array();
					foreach($attach_array[$mail_key] as $attch_keys => $one_attechss)
					{
						$one_trfs=$trf_array[$mail_key][$attch_keys];
						array_push($array_report,$one_trfs);
						
						
					
						
					}
					
					$mail->Body = '<div><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><p><span style="color: #000000; ">Dear Sir/Madam,</span></p><p><span style="color: #000000; ">Please see here with the attached Proforma Invoice.</span></p><p><span style="color: #000000; ">For any further clarification please feel free to contact us.</span></p><p><span style="color: #000000; ">Thanks and regards,</span></p><p>Rajkot Lab Team</p></div><div dir="ltr"><div><span style="color: #ff0000;  font-size: large;"><strong><em>&nbsp;RAJKOT METLAB SERVICES</em></strong></span></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div><div><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div><span style="color: #3d85c6; ">ISO/IEC 17025 Accredited Testing Laboratory by&nbsp;<strong>NABL</strong>&nbsp;<span style="font-size: xx-small;">vide Certificate number</span>&nbsp;TC-5212</span></div><div><span style="color: #3d85c6;  font-size: xx-small;">+91 97252 13600 |&nbsp;<a href="mailto:testing@rajkotlab.com" target="_blank">testing@rajkotlab.com</a>&nbsp;|&nbsp;<a href="http://www.rajkotlab.com/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.rajkotlab.com&amp;source=gmail&amp;ust=1642575497897000&amp;usg=AOvVaw1nPARN92gz4vt9sxgUo3DX">www.<wbr />rajkotlab.com</a>&nbsp;| Off:&nbsp; Wednesday</span></div><div><span style="color: #3d85c6;  font-size: xx-small;">NH-27, Opp. Tulip Party Plot, Nr. JCB Showroom, Rajkot-360022</span></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';
					
					$mail->SMTPOptions=Array('ssl'=>array(
									'verify_peer' =>false,
									'verify_peer_name' =>false,
									'allow_self_signed' =>false
									));
					$mail->WordWrap = 1000;
					foreach($attach_array[$mail_key] as $attch_key => $one_attech)
					{
						$mail->addAttachment('D:\WFGS\htdocs\rajkotlab\nabl\perfoma_pdf_upload/'.$one_attech, $one_attech);
					}
					
					$explodes_mails=explode(";",$one_mail);
					foreach($explodes_mails as $once_keys => $only_mail)
					{
						$mail->AddAddress($only_mail);
					}
					
					if(!$mail->send()){
						array_push($rrorr,"fails");
					}else{
						array_push($rrorr,"SENTS");
						if(!empty($array_report))
						{
							foreach($array_report as $keyea => $one_reports)
							{
								$up_scan="update estimate_total_span set `is_perfoma_mail`='1' WHERE `perfoma_no`='$one_reports'";
								mysqli_query($conn,$up_scan);
							}
						}
					}
		}
	}
	echo "<pre>";
	print_r($rrorr);
