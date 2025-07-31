<?php
$conn = mysqli_connect("localhost", "root", "") or die("error to connect database");
$db = mysqli_select_db($conn, "u218669247_dcslab");
//$base_url="https://stern.eihlims.com/";
$base_url = "http://localhost/lab_nextgen/";

$h_sr = "SSMTL";
$comp_name = "NEXTGEN ENGINEERS & CONSULTANT PVT. LTD.";
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
$tax_no = "AAIFT3946QSD002";
$pancard_no = "AAKCD6125G";
$gst_no = "02AAKCD6125G1ZZ";
$bank = "PUNJAB NATIONAL BANK";
$acc_no = "3371002100015065";
$ifsc_code = "PUNB0337100";