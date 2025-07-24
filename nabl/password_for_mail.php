<?php
$sel_test_mail="SELECT  esc.email_id,esc.password,esc.mail_host,esc.out_port_no,esc.replay_mail_id FROM dbo.tbl_email_sms_configuration AS esc WHERE esc.configuration_type_id_fix = 1";
$query_test_mail=sqlsrv_query($conn_ram,$sel_test_mail);
$test_mails = sqlsrv_fetch_array($query_test_mail);

$test_email=$test_mails["email_id"];
$test_password=$test_mails["password"];
$test_mail_host=$test_mails["mail_host"];
$test_out_port_no=$test_mails["out_port_no"];
$test_replay_mail_id=$test_mails["replay_mail_id"];

$sel_invoice_mail="SELECT  esc.email_id,esc.password,esc.mail_host,esc.out_port_no,esc.replay_mail_id FROM dbo.tbl_email_sms_configuration AS esc WHERE   esc.configuration_type_id_fix = 2";
$query_invoice_mail=sqlsrv_query($conn_ram,$sel_invoice_mail);
$row_invoice_mail = sqlsrv_fetch_array($query_invoice_mail);

$invoice_email=$row_invoice_mail["email_id"];
$invoice_password=$row_invoice_mail["password"];
$invoice_mail_host=$row_invoice_mail["mail_host"];
$invoice_out_port_no=$row_invoice_mail["out_port_no"];
$invoice_replay_mail_id=$row_invoice_mail["replay_mail_id"];

?>