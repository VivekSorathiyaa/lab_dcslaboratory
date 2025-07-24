<?php
session_start();
include("connection.php");

$searchTerm = $_GET['term'];
$query="SELECT * FROM span_bill WHERE `division` LIKE '%$searchTerm%'";
$select =mysqli_query($conn,$query); 
while ($row=mysqli_fetch_array($select)) 
{
 $data[] = $row['division'];

}
//return json data
echo json_encode($data);

?>