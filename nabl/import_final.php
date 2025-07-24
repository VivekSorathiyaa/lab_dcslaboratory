<?php

$restore_file  = dirname(__FILE__)."/dailybackup/db-backup.sql";
$server_name   = "localhost";
$username      = "tec_latest";
$password      = "tec_latest";
$database_name = "tec_latest";

$cmd = "mysql -h {$server_name} -u {$username} -p{$password} {$database_name} < $restore_file";
exec($cmd);

?>