<?php 
session_start();
include("connection.php");
?>
<?php 
//if($_SESSION['name']=="")
//{
	?>
	<script >
		//window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
//}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<style>
@page {  
margin: 10mm 10mm 10mm 10mm; 
}


@media print{@page }

.tdclass{
    border: 1px solid black;
    font-size:11px;
	 font-family: Book Antiqua;
}
.test {
    border-collapse: collapse;
}
	.tdclass1{
    
    font-size:11px;
	 font-family: Book Antiqua;
}
.pagebreak { page-break-before: always; }

	#table_1 {
        page-break-inside: auto;
		
      }
     #table_1 tr {
        page-break-inside: avoid;
        page-break-after: auto;
		
      }
     #table_1 thead {
        display: table-header-group;
		
      }
     #table_1 tfoot {
        display: table-footer-group;
      }
	  
#content {
    display: table;
}

#pageFooter {
    display: table-footer-group;
}

#pageFooter:after {
    counter-increment: page;
    content:"Page " counter(page);
    left: 0; 
    top: 100%;
    white-space: nowrap; 
    z-index: 20;
    -moz-border-radius: 5px; 
    -moz-box-shadow: 0px 0px 4px #222;  
    background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);  
  }

</style>
<html>
	<body>
<?php
		// get estimate by report no and job no
		$get_report_no=$_GET["trf_no"];
		$get_job_no=$_GET["job_no"];
		$temporary_trf_no=$_GET["temporary_trf_no"];
		$sel_estiamte="select * from job where `trf_no`='$get_report_no' AND `temporary_trf_no`='$temporary_trf_no'";
		$result_estiamte =mysqli_query($conn,$sel_estiamte);
		$row_estiamte =mysqli_fetch_array($result_estiamte);
		$branch_id=$row_estiamte["branch_id"];
		
		$sel_branch = "select * from branches where `branch_id`=".$branch_id;
		$query_branch = mysqli_query($conn, $sel_branch);
		$row_branch = mysqli_fetch_array($query_branch);
		$company_name=$row_branch["company_name"];
		$company_logo=$row_branch["company_logo"];
		$company_address=$row_branch["company_address"];
		$contact_mobile=$row_branch["contact_mobile"];
		
		
		$setting_date=date_create($row_estiamte["sw_date"]);
		$sw_date= date_format($setting_date,"d-m-Y");
		$person_name=$row_estiamte["person_name"];
		$person_auth_mobile=$row_estiamte["person_auth_mobile"];
		
		// get name of agency by report no and job no from agency table
		$sel_agency_id=$row_estiamte["agency"];
		
		$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$sel_agency_id;
		$result_agency =mysqli_query($conn,$sel_agency);
		$row_agency =mysqli_fetch_array($result_agency);
		$agency_name=$row_agency["agency_name"];
		$agency_address=$row_agency["agency_address"];
		$agency_gst=$row_agency["agency_gstno"];
		$agency_email=$row_agency["agency_email"];
		
		$trf_nos=$_GET["trf_no"];
			
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
		
		<?php
		
		$matreials_ulr_array=array();
		
		// final material assign table data
		$get_final_material="select * from final_material_assign_master where `trf_no`='$get_report_no' AND `job_no`='$get_job_no' AND `temporary_trf_no`='$temporary_trf_no' AND `is_deleted`='0' ORDER BY `final_material_id` ASC";
		$result_final_materials =mysqli_query($conn,$get_final_material);
		$counts=1;
		if(mysqli_num_rows($result_final_materials)>0)
		{
			while($one_final_materials=mysqli_fetch_array($result_final_materials))
			{
				
				array_push($matreials_ulr_array,$one_final_materials["ulr_no"]);
				  
			}
		}
			$first = ltrim(reset($matreials_ulr_array),"0")."-";
		    $last = ltrim(end($matreials_ulr_array),"0");
			$joining_job_no="(".$first.$last.")";
			?>
			<page size="A4">
			
			<table align="center" class="test"  style="font-family: Book Antiqua;border:4px solid black;width:98%;">
				<tr>
				<td  style="text-align:center;font-size:17px;border: 4px solid black;" colspan="6">
				&#8594;&nbsp;<?php echo $company_name;?>&nbsp;&#8592;
				</td>
				</tr>
				<tr>
				<td colspan="6" style="padding:5px;" >
					<table  class="test"  style="font-family: Book Antiqua;width:100%">
						<tr>
						<td style="border-bottom:0px solid black;width:15%">Customer Name</td>
						<td style="width:5%;text-align:center"><b>:-</b></td>
						<td style="border-bottom:1px solid black;width:40%;"><?php echo $person_name;?></td>
						
						<td style="border-bottom:0px solid black;width:13%;float:right;">Date</td>
						<td style="border-bottom:0px solid black;width:5%;text-align:center"><b>:-</b></td>
						<td style="border-bottom:0px solid black;width:10%"><?php echo $sw_date; ?></td>
						</tr>
						<tr>
						<td style="border-bottom:0px solid black;width:15%">Customer No.</td>
						<td style="width:5%;text-align:center"><b>:-</b></td>
						<td style="border-bottom:1px solid black;width:40%;"><?php echo $person_auth_mobile;?></td>
						
						<td colspan="3" rowspan="4" style="border-bottom:0px solid black;">
						<img src="images/branch_logo/<?php echo $company_logo;?>" style="width:180;height:90px;float:right;margin-top:20px;">
						</td>
						
						</tr>
						
						<tr>
						<td style="border-bottom:0px solid black;width:15%">Agency Name</td>
						<td style="width:5%;text-align:center"><b>:-</b></td>
						<td style="border-bottom:1px solid black;width:40%;"><?php echo $agency_name;?></td>
						
						
						</tr>
						<tr>
						<td style="border-bottom:0px solid black;width:15%">Inward No.</td>
						<td style="width:5%;text-align:center"><b>:-</b></td>
						<td style="border-bottom:1px solid black;width:40%;"><?php echo $trf_nos; ?>&nbsp;</td>
						
						
						</tr>
						
						<tr>
						<td style="border-bottom:0px solid black;width:15%"></td>
						<td style="border-bottom:0px solid black;width:15%"></td>
						<td style="border-bottom:0px solid black;width:15%"></td>
						</tr>
						
						</table>
						<br>
						<table align="center" width="100%" class="test" style="font-family: Book Antiqua;border-top:4px solid black;">
							<tr>
							<td width="33%" colspan="2" style="">
							<b>Mobile No :- <?php echo $contact_mobile;?></b>
							</td>
							<td width="33%" colspan="2" style="text-align:center;">
							<b>**END**</b>
							</td>
							<td width="33%" colspan="2" style="text-align:right;">
							<b>&nbsp;</b>
							</td>
							</tr>
						</table>
				</td>
				</tr>
				
		    </table>
			
			</page>
		
	
	</body>
</html>

<script type="text/javascript">
window.onload = function(){ 
	setTimeout(function()
		{
			
			//window.print();
		}, 
		1000);

}



</script>