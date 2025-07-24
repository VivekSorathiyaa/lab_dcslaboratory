<?php
/*$serverName = "SHREEJI-PC\SQLSERVER(sa)"; //serverName\instanceName
$connectionInfo = array( "Database"=>"rjt_lab", "UID"=>"sa", "PWD"=>"sa12345");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
} */  

//$serverName_rm = "RMS_SERVER1-PC,1433"; 
//$connectionInfo_rm = array( "Database"=>"MECH_LAB_DB", "UID"=>"sa", "PWD"=>"admin@1234");
// $conn_ram = sqlsrv_connect( $serverName_rm, $connectionInfo_rm);

/*$serverName = "SHREEJI-PC\\SQLSERVER"; 
$connectionInfo = array( "Database"=>"rjt_lab", "UID"=>"sa", "PWD"=>"sa12345");
 $conn = sqlsrv_connect( $serverName, $connectionInfo);*/

 //if( $conn_ram ) {     
 //echo "Connection established.<br />";}
 //else{     echo "Connection could not be established.<br />";
 
 //die( print_r( sqlsrv_errors(), true));}
 //SQLDB-CLU
 
 //$tsql= "SELECT * FROM tbl_ulr_sequence_master WHERE ulr_from_type_id_fix='3'";
 //$tsql= "SELECT * FROM tbl_ulr_sequence_master WHERE ulr_from_type_id_fix='3' order by ulr_sequence_id asc";
 //$tsql= "SELECT isnull(max(ulr_sequence_id))+1 FROM tbl_ulr_sequence_master order by ulr_sequence_id desc";
 
 //$tsql= "insert into tbl_ulr_sequence_master (ulr_sequence_id,ulr_sequence,ulr_sequence_date,table_primary_key_id,ulr_from_type_id_fix,created_date,created_by,modified_date,modified_by,company_year_id,company_id) values( 11, 0, '2021-03-26', 0, 3, '2021-06-18', 3, '2021-06-18', 3, 1, 1)";
 //$tsql= "SELECT * FROM tbl_ulr_sequence_master where ulr_sequence=1 AND ulr_from_type_id_fix=3 ORDER BY ulr_sequence_id desc";

 
 //$tsql= "INSERT INTO tbl_ulr_sequence_master (ulr_sequence,ulr_sequence_date,table_primary_key_id,ulr_from_type_id_fix,created_date,created_by,modified_date,modified_by,company_year_id,company_id) values( 0, '2021-03-26', 0, 3, '2021-06-15', 3, '2021-06-15', 3, 1, 1)";
//$getResults= sqlsrv_query($conn, $tsql);


//$plusing=0;
//while ($row = sqlsrv_fetch_array($getResults)) {
 //   echo ($row['ulr_sequence'])."<br>";
//$plusing++;
//}

//echo "<br><br>".$plusing;

 ?>

