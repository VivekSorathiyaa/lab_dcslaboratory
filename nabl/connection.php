<?php
$conn = mysqli_connect("localhost", "root", "") or die("error to connect database");
$db = mysqli_select_db($conn, "u218669247_dcslab");
//$base_url="localhost/rajkotlab/nabl/";
$base_url = "";

$h_sr = "SSMTL";
$comp_name = "NextGenLIMS Technologies";
$city_name = "TARAGARH";
ini_set('max_input_vars', '3000');

/*Need For Dynamic Backup*/
$lab_host = "localhost";
$lab_username = "root";
$lab_password = "";
$lab_db = "u218669247_dcslab";
$backup_file_name = "u218669247_dcslab.sql";
$master_mail_id = "vivek1.semicolon@gmail.com";
$cc_mail_id = "vivek1.semicolon@gmail.com";
$to_mail_id = "vivek1.semicolon@gmail.com";

/*Print Bill*/
$tax_no = "NGTLT1234X001";
$pancard_no = "NGTPT6789L";
$gst_no = "24NGTPT6789L1Z9";
$bank = "NEXTGEN BANK LTD";
$acc_no = "9876543210123456";
$ifsc_code = "NEXT0001234";


$nabl_report_first = "NGL/REPORT/";
$non_nabl_report_first = "NGLN/REPORT/";
$perfoma_first_parts = "NGL-P/";
$invoice_first_parts = "NGL-I/";
$vou_first_parts = "NGL-VCH/";
$reciept_first_parts = "NGL-RCPT/";
$cash_first_parts = "NGL-CASH_RCPT/";
$pur_in_first_parts = "NGL/PUR/";
$pur_in_img_first_parts = "NGL_PUR_";
$pur_out_first_parts = "NGL/PUROUT/";
$qt_first_parts = "NGL/EXT/QU/";

$set_mo_and_email = "Mobile: +91-9925755626, e-mail: contact@nextgenlims.in";
$set_reg_office = "Regd. Office: 302, ABC Business Park, Udhna Magdalla Road, Surat, Gujarat - 395007";


?>