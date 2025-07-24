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
	
	$is_pending=$_POST["is_pending"];
	
	if($is_pending=="yes")
	{
		$stissss="`mail_status`='0' AND ";
	}
	else
	{
		$stissss="";	
	}
	
	$rrorr = array();
	$mailing_array = array();
	$attach_array = array();
	$trf_array = array();
	$sizing = array();
	foreach($explodes as $keyed => $one_chk){
		$sel_scaned="select * from scanned_trf_document where `is_deleted`=0 AND ".$stissss." `scan_id`=".$one_chk;
		$query_scanned=mysqli_query($conn,$sel_scaned);
		if(mysqli_num_rows($query_scanned) > 0)
		{
			$row_scanned=mysqli_fetch_array($query_scanned);
			$document=$row_scanned["document"];
			//$agency_email=$row_scanned["agency_email"];
			$trf_nos=$row_scanned["trf_no"];
			
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
						$file_sizes=filesize('D:\WFGS\htdocs\rajkotlab\nabl\scanned_document/'.$document);
						$in_mb=$file_sizes / 1000000;
						if($in_mb< 9.9)
						{
							array_push($mailing_array,$agency_email);
							array_push($attach_array,array($document));
							array_push($sizing,array($in_mb));
							
							if (!in_array($trf_nos, $trf_array))
							{
							array_push($trf_array,array($trf_nos));
							}
						}else{
							break;
						}
					}
					else
					{
						$key = array_search ($agency_email, $mailing_array);
						$file_sizing= $sizing[$key];
						$file_sizes=filesize('D:\WFGS\htdocs\rajkotlab\nabl\scanned_document/'.$document);
						$in_mb=$file_sizes / 1000000;
						if($in_mb < 9.9)
						{
							$set_size=floatval($file_sizing)+floatval($in_mb);
							if($set_size< 9.9)
							{
								array_push($attach_array[$key],$document);
								$sizing[$key]=$set_size;
								if (!in_array($trf_nos, $trf_array[$key]))
								{
								array_push($trf_array[$key],$trf_nos);
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
					$mail->Port       = $test_out_port_no;
					$mail->CharSet    = "UTF-8";
					$mail->IsHTML(true);
					$mail->Host       = $test_mail_host;
					$mail->Username   = $test_email;
					$mail->Password   = $test_password;
					$mail->SetFrom   =  $test_replay_mail_id;
					$mail->Subject   = "TEST REPORTS "."(".implode(",",$trf_array[$mail_key]).")";
					$concats ="";
					$array_report=array();
					foreach($attach_array[$mail_key] as $attch_keys => $one_attechss)
					{
						$report_nos="";
						
						$explode_trf=explode(".",$one_attechss);
						$one_trfs=$trf_array[$mail_key][$attch_keys];
						$explode_by_dot=$explode_trf[0].".".$explode_trf[1];
						
						$trf_report_divide = explode("_", $explode_by_dot);
						if($trf_report_divide[0] == "TRF"){
							$report_nos = $trf_report_divide[2];
						}else{
							$report_nos=$explode_by_dot;
						}
						
						array_push($array_report,$explode_by_dot);
						
						$sel_final="select * from final_material_assign_master where `report_no`='$report_nos'";
						$query_final=mysqli_query($conn,$sel_final);
						$result_final=mysqli_fetch_array($query_final);
						$lab_no=$result_final["lab_no"];
						$material_id=$result_final["material_id"];
						
						//$sel_scaner="select * from job where `trf_no`='$one_trfs'";
						$sel_scaner="select * from job where `trf_no`='$result_final[trf_no]'";
						$query_scan=mysqli_query($conn,$sel_scaner);
						$result_scanner=mysqli_fetch_array($query_scan);
						$agency_names=$result_scanner["agency_name"];
						$clientname=$result_scanner["clientname"];
						$refno=$result_scanner["refno"];
						
						$sel_mate="select * from material where `id`=".$material_id;
						$query_mate=mysqli_query($conn,$sel_mate);
						$result_mate=mysqli_fetch_array($query_mate);
						$mt_name=$result_mate["mt_name"];
					
						$concats .= '<tr style=""><td style="width: 300px;">'.$agency_names.'</td><td style="width: 300px;">'.$clientname.'</td><td style="width: 91.6406px;">'.$refno.'</td><td style="width: 91.6406px;">'.$lab_no.'</td><td style="width: 91.6406px;">'.$mt_name.'</td><td style="width: 91.7969px;">'.$report_nos.'</td></tr>';
					}
					
					$mail->Body = '<div><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><p><span style="color: #000000; ">Dear Sir/Madam,</span></p><p><span style="color: #000000; ">Please see here with the attached Test Reports.</span></p><table border="1"><tbody><tr style=""><td style="width: 300px;  background: #A19E99; color: black;"><strong>&nbsp;Agency Name</strong></td><td style="width: 300px; background: #A19E99; color: black;"><strong>&nbsp;Client Name</strong></td><td style="width: 91.6406px; background: #A19E99; color: black;"><strong>&nbsp;Customer Reference</strong></td><td style="width: 91.6406px; background: #A19E99; color: black;"><strong>&nbsp;Lab Id</strong></td><td style="width: 91.6406px; background: #A19E99; color: black;"><strong>Material&nbsp;</strong></td><td style="width: 91.7969px; background: #A19E99; color: black;"><strong>&nbsp;Report No</strong></td></tr>'.$concats.'</tbody></table><p><span style="color: #000000; "><br />For any further clarification please feel free to contact us (please mention report number).</span></p><p><span style="color: #000000; ">Thanks and regards,</span></p><p>Rajkot Lab Team</p></div><div dir="ltr"><div><span style="color: #ff0000;  font-size: large;"><strong><em>&nbsp;RAJKOT METLAB SERVICES</em></strong></span></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div><div><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div><span style="color: #3d85c6; ">ISO/IEC 17025 Accredited Testing Laboratory by&nbsp;<strong>NABL</strong>&nbsp;<span style="font-size: xx-small;">vide Certificate number</span>&nbsp;TC-5212</span></div><div><span style="color: #3d85c6;  font-size: xx-small;">+91 97252 13600 |&nbsp;<a href="mailto:testing@rajkotlab.com" target="_blank">testing@rajkotlab.com</a>&nbsp;|&nbsp;<a href="http://www.rajkotlab.com/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.rajkotlab.com&amp;source=gmail&amp;ust=1642575497897000&amp;usg=AOvVaw1nPARN92gz4vt9sxgUo3DX">www.<wbr />rajkotlab.com</a>&nbsp;| Off:&nbsp; Wednesday</span></div><div><span style="color: #3d85c6;  font-size: xx-small;">NH-27, Opp. Tulip Party Plot, Nr. JCB Showroom, Rajkot-360022</span></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>';
					
					$mail->SMTPOptions=Array('ssl'=>array(
									'verify_peer' =>false,
									'verify_peer_name' =>false,
									'allow_self_signed' =>false
									));
					$mail->WordWrap = 1000;
					foreach($attach_array[$mail_key] as $attch_key => $one_attech)
					{
						$mail->addAttachment('D:\WFGS\htdocs\rajkotlab\nabl\scanned_document/'.$one_attech, $one_attech);
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
								$up_scan="update scanned_trf_document set `mail_status`='1' WHERE `report_no`='$one_reports'";
								mysqli_query($conn,$up_scan);
							}
						}
					}
		}
	}
	echo "<pre>";
	print_r($rrorr);
