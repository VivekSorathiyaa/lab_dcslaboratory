<style>
.tdclass{
    border: 1px solid black;
    font-size:15px;
	 font-family: arial;
}

td{
	padding:10px;
	    
}
</style>

<?php include("connection.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
    $abc = $_GET['dispatch_id'];
    $sel_dispatches="select * from report_dispatch where `dispatch_id`=$abc AND `is_deleted`=0";
	$query_dispatches=mysqli_query($conn,$sel_dispatches);
	$result_dispatched=mysqli_fetch_array($query_dispatches);
?>
		
<table class="table no-margin " style="color: black;" border="1">
 <tbody>
   <tr>
     <td colspan="4" class="tdclass">
       <h2 style="font-size:15px;"><b><?php echo $result_dispatched["courier_contact_person"];?></b></h2>
       <h2 style="font-size:15px;"><b><?php echo $result_dispatched["courier_contact_address"];?></b></h2>
       <h2 style="font-size:15px;"><b><?php echo $result_dispatched["courier_contact_person_mobile"];?></b></h2>
     </td>
   </tr>
 </tbody>
</table>


	


<script type="text/javascript">
window.onload = function(){ 
	setTimeout(function()
		{
			
			window.print();
		}, 
		1000);

}





 
</script>

