<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php
session_start();
include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
	</script>
	<?php
}

$get_agency_ids= $_POST["sel_agency_ids"];
$sel_clients_ids= $_POST["sel_clients_ids"];
$sel_auth_names= $_POST["sel_auth_names"];
$agree_nos= $_POST["agree_nos"];

// all fill
if($get_agency_ids != "" && $sel_clients_ids != "" && $sel_auth_names != "" && $agree_nos != "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}

	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}

	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}

	$wheres="`est_isdeleted`='0' AND ".$agency_connect." AND ".$clients_connect." AND ".$auth_connect." AND `agreement_no`='$agree_nos'";
}
// not agency
if($get_agency_ids == "" && $sel_clients_ids != "" && $sel_auth_names != "" && $agree_nos != "")
{
	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}

	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}

	$wheres="`est_isdeleted`='0' AND ".$clients_connect." AND ".$auth_connect." AND `agreement_no`='$agree_nos'";
}

// not client
if($get_agency_ids != "" && $sel_clients_ids == "" && $sel_auth_names != "" && $agree_nos != "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}


	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}


	$wheres="`est_isdeleted`='0' AND ".$agency_connect."  AND ".$auth_connect." AND `agreement_no`='$agree_nos'";
}

// not auth
if($get_agency_ids != "" && $sel_clients_ids != "" && $sel_auth_names == "" && $agree_nos != "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}

	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}

	$wheres="`est_isdeleted`='0' AND ".$agency_connect." AND ".$clients_connect." AND `agreement_no`='$agree_nos'";
}
// not agree
if($get_agency_ids != "" && $sel_clients_ids != "" && $sel_auth_names != "" && $agree_nos == "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}

	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}

	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}
	$wheres="`est_isdeleted`='0' AND ".$agency_connect." AND ".$clients_connect." AND ".$auth_connect;
}
// only agency
if($get_agency_ids != "" && $sel_clients_ids == "" && $sel_auth_names == "" && $agree_nos == "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}
	$wheres="`est_isdeleted`='0' AND $agency_connect";
}
// only client
if($get_agency_ids == "" && $sel_clients_ids != "" && $sel_auth_names == "" && $agree_nos == "")
{
	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}


	$wheres="`est_isdeleted`='0' AND ".$clients_connect;
}
// only auth
if($get_agency_ids == "" && $sel_clients_ids == "" && $sel_auth_names != "" && $agree_nos == "")
{
	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}
	$wheres="`est_isdeleted`='0' AND $auth_connect";
}
// only agree
if($get_agency_ids == "" && $sel_clients_ids == "" && $sel_auth_names == "" && $agree_nos != "")
{
	$wheres="`est_isdeleted`='0' AND `agreement_no`='$agree_nos'";
}
// only agency and client
if($get_agency_ids != "" && $sel_clients_ids != "" && $sel_auth_names == "" && $agree_nos == "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}

	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}


	$wheres="`est_isdeleted`='0' AND ".$agency_connect." AND ".$clients_connect;
}
// only agency and auth
if($get_agency_ids != "" && $sel_clients_ids == "" && $sel_auth_names != "" && $agree_nos == "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}

	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}
	$wheres="`est_isdeleted`='0' AND ".$agency_connect." AND ".$auth_connect;
}
// only agency and agree
if($get_agency_ids != "" && $sel_clients_ids == "" && $sel_auth_names == "" && $agree_nos != "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}


	$wheres="`est_isdeleted`='0' AND ".$agency_connect." AND `agreement_no`='$agree_nos'";
}

// only client and auth
if($get_agency_ids == "" && $sel_clients_ids != "" && $sel_auth_names != "" && $agree_nos == "")
{
	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}

	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}
	$wheres="`est_isdeleted`='0' AND ".$clients_connect." AND ".$auth_connect;
}

// only client and agree
if($get_agency_ids == "" && $sel_clients_ids != "" && $sel_auth_names == "" && $agree_nos != "")
{
	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}

	$wheres="`est_isdeleted`='0' AND ".$clients_connect." AND `agreement_no`='$agree_nos'";
}

// only auth and agree
if($get_agency_ids == "" && $sel_clients_ids == "" && $sel_auth_names != "" && $agree_nos != "")
{
	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}
	$wheres="`est_isdeleted`='0' AND ".$auth_connect." AND `agreement_no`='$agree_nos'";
}
// only agency and client and auth
if($get_agency_ids != "" && $sel_clients_ids != "" && $sel_auth_names != "" && $agree_nos == "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}

	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}

	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}

	$wheres="`est_isdeleted`='0' AND ".$agency_connect." AND ".$clients_connect." AND ".$auth_connect;
}
// only agency and auth and agree
if($get_agency_ids != "" && $sel_clients_ids == "" && $sel_auth_names != "" && $agree_nos != "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}

	//explode auth
	$explode_auth=explode(",",$sel_auth_names);
	$auth_connect="";
	$auth_counts=count($explode_auth);
	$count_down_auth=1;
	foreach($explode_auth as $one_auth)
	{
		$auth_connect .="`authority`='$one_auth'";
		if($auth_counts != $count_down_auth)
		{
		$auth_connect .=" OR ";
		}
		$count_down_auth++;
	}
	$wheres="`est_isdeleted`='0' AND ".$agency_connect." AND ".$auth_connect." AND `agreement_no`='$agree_nos'";
}
// only agency and client  and agree
if($get_agency_ids != "" && $sel_clients_ids != "" && $sel_auth_names == "" && $agree_nos != "")
{
	//explode agency
	$explode_agency=explode(",",$get_agency_ids);
	$agency_connect="";
	$agency_counts=count($explode_agency);
	$count_down=1;
	foreach($explode_agency as $one_agency)
	{
		$agency_connect .="`agency_id`='$one_agency'";
		if($agency_counts != $count_down)
		{
		$agency_connect .=" OR ";
		}
		$count_down++;
	}

	//explode clients
	$explode_clients=explode(",",$sel_clients_ids);
	$clients_connect="";
	$clients_counts=count($explode_clients);
	$count_down_clients=1;
	foreach($explode_clients as $one_clients)
	{
		$clients_connect .="`client_id`=$one_clients";
		if($clients_counts != $count_down_clients)
		{
		$clients_connect .=" OR ";
		}
		$count_down_clients++;
	}


	$wheres="`est_isdeleted`='0' AND ".$agency_connect." AND ".$clients_connect." AND `agreement_no`='$agree_nos'";
}


?>

<table id="example1" class="table table-bordered table-striped" style="width:100%;">
										<thead>
										<tr>
										<th style="text-align:center;">sssIndication</th>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;"></th>
										<th style="text-align:center;">Client Name</th>
										<th style="text-align:center;">Client Address</th>
										<th style="text-align:center;">Client Phone</th>
										<th style="text-align:center;">Email</th>
										<th style="text-align:center;">Client Gst No</th>
										<th style="text-align:center;">Client city</th>
										<th style="text-align:center;">Agreement No</th>
										<th style="text-align:center;">Agency</th>
										<th style="text-align:center;">Payment Type</th>
										<th style="text-align:center;">Amount</th>
										<th style="text-align:center;">Job Creater</th>
										<th style="text-align:center;">Agency Address</th>
										<th style="text-align:center;" >Agency Mobile</th>
										<th style="text-align:center;">Agency City</th>
										<th style="text-align:center;">Agency Gstno</th>
										<th style="text-align:center;">Agency Email</th>
										<th style="text-align:center;">Name of Work</th>
										<th style="text-align:center;">Authorized Name</th>
										<th style="text-align:center;">Ref No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Job Number</th>
										<th style="text-align:center;">Sample Sent By</th>
										<th style="text-align:center;">Sample Rec Date</th>
										<th style="text-align:center;">Condition of Sample Receved</th>
									</tr>
									</thead>
									<tbody>
									<?php

										$count=0;

										$query_est_bill="select * from estimate_total_span_only_bill where ".$wheres;
										//$query_est_bill="select * from estimate_total_span_only_bill where  `est_isdeleted`='0' AND `agency_id`='$get_agency_ids'";
										$result_est_bill=mysqli_query($conn,$query_est_bill);
										if(mysqli_num_rows($result_est_bill) > 0)
										{
										while($row_est_bill=mysqli_fetch_array($result_est_bill))
										{
											$count++;
											$reports_no=$row_est_bill['report_no'];
											$jobs_no=$row_est_bill['job_no'];

											$query="select * from job where  `jobisdeleted`='0' AND `report_no`='$reports_no' AND `job_number`='$jobs_no'";
											$result=mysqli_query($conn,$query);
											$row=mysqli_fetch_array($result);
									?>
											<tr>
											<td>
											<?php
											$lights=$row['admin_special_light'];

											if($lights==0)
											{
											echo '<img src="images/admin_light/off.png">';
											$urls="job_listing.php?a=rec1";
											$classes="color: black";
											}
											if($lights==1)
											{
											echo '<img src="images/admin_light/yellow.png">';
											$urls="job_listing_for_second_reception.php?a=rec2";
											$classes="color: yellow";
											}
											if($lights==2)
											{
											echo '<img src="images/admin_light/orange.png">';
											$urls="span_set_rate.php?a=rec2&&report_no=".$reports_no."&&job_no=".$jobs_no;
											$classes="color: orange";
											}
											if($lights==3)
											{
											echo '<img src="images/admin_light/sky.png">';
											$urls="view_job_by_eng.php?report_no=".$row['report_no']."&&job_no=".$row['job_number'];
											$classes="color: #03aba8";
											}
											if($lights==4)
											{
											echo '<img src="images/admin_light/marron.png">';
											$urls="span_set_rate_final_bill.php?a=rec2&&report_no=".$row['report_no']."&&job_no=".$row['job_number'];
											$classes="color: brown";
											}
											if($lights==5)
											{
											echo '<img src="images/admin_light/green.png">';
											$urls="dilevery_detail.php?report_no=".$row['report_no']."&&job_no=".$row['job_number'];
											$classes="color: green";
											}
											?>
											</td>
											<td style="white-space:nowrap;">

											<a href="<?php echo $urls;?>" class="btn btn-default btn-lg btn3d" title="GO" style="<?php echo $classes;?>;background-color:darkgray;"><span class="glyphicon glyphicon-question-ok"></span>GO</a>

											</td>
											<td><?php echo $count;?></td>
											<td style="white-space:nowrap;"><?php echo $row['clientname'];?></td>
											<td><?php echo $row['clientaddress'];?></td>
											<td><?php echo $row['clientphone'];?></td>
											<td><?php echo $row['email'];?></td>
											<td><?php echo $row['client_gstno'];?></td>

											<?php
											$sel_city="select * from city where id=".$row['client_city'];
											$query_city = mysqli_query($conn, $sel_city);
											$get_city = mysqli_fetch_array($query_city);
											?>
											<td><?php echo $get_city['city_name'];?></td>
											<td><?php echo $row['agreement_no'];?></td>

											<?php $sel_agency="select * from agency_master where `agency_id`=".$row["agency"];
											$query_agency = mysqli_query($conn, $sel_agency);
											$get_agency = mysqli_fetch_array($query_agency);
											?>
											<td><?php echo $get_agency['agency_name'];?></td>
											<td>
											<?php
											if($row_est_bill['paytype']==0)
											{
												echo $pay_types="CASH";
											}
											else if($row_est_bill['paytype']==1)
											{
												echo $pay_types="CHEQUE";
											}
											else if($row_est_bill['paytype']==2)
											{
												echo $pay_types="RTGS/NEFT";
											}
											else if($row_est_bill['paytype']==3)
											{
												echo $pay_types="PENDING";
											}
											else
											{
												$pay_types="PENDING";
											}

											?></td>
											<td><?php echo $row_est_bill['total_amt'];?></td>
											<td><?php echo $row_est_bill['est_creatredby'];?></td>
											<td><?php echo $row['agency_address'];?></td>
											<td><?php echo $row['agency_mobile'];?></td>
											<?php $sel_agency_city="select * from city where `id`=".$row["agency_city"];
											$query_agency_city = mysqli_query($conn, $sel_agency_city);
											$get_agency_city = mysqli_fetch_array($query_agency_city);
											?>
											<td><?php echo $get_agency_city['city_name'];?></td>
											<td><?php echo $row['agency_gstno'];?></td>
											<td><?php echo $row['agency_email'];?></td>
											<td><?php echo $row['nameofwork'];?></td>
											<td><?php echo $row['person_name'];?></td>
											<td><?php echo $row['refno'];?></td>
											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['date']));?></td>
											<td><?php echo $row['report_no'];?></td>
											<td><?php echo $row['job_number'];?></td>
											<td>
											<?php if($row['sample_sent_by']=='0'){
												echo $row['clientname'];
											}else{
												echo $get_agency['agency_name'];
											}?>
											</td>

											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row[	'sample_rec_date']));?></td>
											<td>
											<?php if($row['condition_of_sample_receved']=='0'){
												echo $row['clientname'];
											}else{
												echo $get_agency['agency_name'];
											}?>
											</td>

										</tr>
									<?php
										}
										}
									?>
								</tbody>
								<tfoot>
								   <tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									 <tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
								   </tfoot>

								  </table>

<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>


<script>
    $(document).ready(function() {
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		drawCallback: function () {
      var api = this.api();

       // var pageTotal=api.column( 17, {page:'every'} ).data().sum();
        var pageTotal=123;

        var total_amount=api.column( 11, {page:'every'} ).data();
        var paytype =api.column( 10, {page:'every'} ).data();
		var paid_total=0;
		var remain_total=0
		for (i = 0; i < paytype.length; i++)
		{

		  if(paytype[i]=="CASH" || paytype[i]=="CHEQUE" || paytype[i]=="RTGS/NEFT")
		  {
			  paid_total=parseInt(paid_total)+parseInt(Math.round(total_amount[i]));
		  }else{
			  remain_total =parseInt(remain_total)+parseInt(Math.round(total_amount[i]));
		  }
		}


		$('tr:eq(0) td:eq(11)', api.table().footer()).html("TOTAL="+Math.round(paid_total+remain_total)+"   <br>PAID=  "+paid_total+"      <br>UNPAID="  +remain_total);

		//$(api.column(17).footer()).html("TOTAL="+Math.round(pageTotal)+"   <br>PAID=  "+paid_total+"      <br>UNPAID="  +remain_total);

    },
		buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],

    } );
 } );
</script>
