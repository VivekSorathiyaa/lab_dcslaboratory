

<?php

if(isset($_SESSION['clicking']))
{
	if($_SESSION['clicking']=="rec1")
	{
		$back="#";
		$next= $base_url."job_listing_for_second_reception.php?a=rec2";
		$b_styler="display:none;";
		$n_styler="";
	}
	
	if($_SESSION['clicking']=="rec2")
	{
		$back=$base_url."job_listing.php?a=rec1";
		$next= $base_url."job_listing_for_engineer.php?a=eng";
		$b_styler="";
		$n_styler="";
	}
	
	if($_SESSION['clicking']=="eng")
	{
		$back=$base_url."job_listing_for_second_reception.php?a=rec2";
		$next= $base_url."list_of_job_report_for_qm.php?a=qm";
		$b_styler="";
		$n_styler="";
	}
	
	if($_SESSION['clicking']=="qm")
	{
		$back=$base_url."job_listing_for_engineer.php?a=eng";
		$next= $base_url."list_of_job_report_for_biller.php?a=bill";
		$b_styler="";
		$n_styler="";
	}
	
	if($_SESSION['clicking']=="bill")
	{
		$back=$base_url."list_of_job_report_for_qm.php?a=qm";
		$next= "#";
		$b_styler="";
		$n_styler="display:none;";
	}
	
	
}

?>



<!--<br>
<div>
<a href="<?php //echo $back;?>"  class="btn btn-primary" style="margin-left: 20px; <?php //echo $b_styler;?>">Back</a>

<a href="<?php //echo $next;?>" class="btn btn-primary pull-right" style="margin-right: 20px; <?php //echo $n_styler;?>">Next</a>
</div>-->