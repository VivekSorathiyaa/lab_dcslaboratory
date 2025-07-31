<?php
$conn = mysqli_connect("localhost", "root", "") or die("error to connect database");
$db = mysqli_select_db($conn, "u218669247_dcslab");
//$base_url="https://stern.eihlims.com/";
$base_url = "http://localhost/lab_nextgen/";

$h_sr = "SSMTL";
$comp_name = "NextGenLIMS Technologies";
$city_name = "TARAGARH";

/*Need For Dynamic Backup*/
$lab_host = "localhost";
$lab_username = "root";
$lab_password = "";
$lab_db = "u218669247_dcslab";
$backup_file_name = "dcs_lab.sql";
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