<?php

function naming($short_code,$conn)
{
	$sel_branch="select * from branches where `branch_short_code`='$short_code'";
	$result_branch = mysqli_query($conn, $sel_branch);
	$get_branch = mysqli_fetch_array($result_branch);
	$setings="";
	if($get_branch["first_name"]!="")
	{
		$setings .=$get_branch["first_name"];
	}
	if($get_branch["second_name"]!="")
	{
		$setings .="/".$get_branch["second_name"];
	}
	if($get_branch["third_name"]!="")
	{
		$setings .= "/".$get_branch["third_name"];
	}
echo $setings;
}

function degins($short_code,$conn)
{
	$sel_branch="select * from branches where `branch_short_code`='$short_code'";
	$result_branch = mysqli_query($conn, $sel_branch);
	$get_branch = mysqli_fetch_array($result_branch);
	$setings="";
	if($get_branch["first_designation"]!="")
	{
		$setings .=$get_branch["first_designation"];
	}
	if($get_branch["second_designation"]!="")
	{
		$setings .="/".$get_branch["second_designation"];
	}
	if($get_branch["third_designation"]!="")
	{
		$setings .= "/".$get_branch["third_designation"];
	}
return $setings;
}
?>