<?php
$conn=mysqli_connect("localhost","u218669247_dcslab","Dcs@44975") or die ("error to connect database");
$db=mysqli_select_db($conn,"u218669247_dcslab");
//$base_url="localhost/rajkotlab/nabl/";
$base_url="";

$h_sr="SSMTL";
$comp_name="DCS ENGINEERS & CONSULTANT PVT. LTD.";
$city_name="TARAGARH";
ini_set('max_input_vars', '3000');

/*Need For Dynamic Backup*/
$lab_host="localhost";
$lab_username="root";
$lab_password="";
$lab_db="dcs_lab";
$backup_file_name = "dcs_lab.sql";
$master_mail_id = "vaibhav.wfgs@gmail.com";
$cc_mail_id = "vaibhav.wfgs@gmail.com";
$to_mail_id = "joshi.vibhs@gmail.com";

/*Print Bill*/
$tax_no="AAIFT3946QSD002";
$pancard_no="AAKCD6125G";
$gst_no="02AAKCD6125G1ZZ";
$bank="PUNJAB NATIONAL BANK";
$acc_no="3371002100015065";
$ifsc_code="PUNB0337100";


$nabl_report_first="DCS/REPORT/";
$non_nabl_report_first="DCSN/REPORT/";
$perfoma_first_parts="DCS-P/";
$invoice_first_parts="DCS-I/";
$vou_first_parts="DCS-VCH/";
$reciept_first_parts="DCS-RCPT/";
$cash_first_parts="DCS-CASH_RCPT/";
$pur_in_first_parts="DCS/PUR/";
$pur_in_img_first_parts="DCS_PUR_";
$pur_out_first_parts="DCS/PUROUT/";
$qt_first_parts="DCS/EXT/QU/";

$set_mo_and_email="Mobile: +91-7018819894, +91-9816755805, e-mail : officialdcspvtltd@gmail.com";
$set_reg_office="Regd. Office: VPO Taragarh(Rani Di K) Near Taragarh Palace Tehsil Bajinath District Kangra Himachal Pradesh(176081)";

?>