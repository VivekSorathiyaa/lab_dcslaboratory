<?php 
error_reporting(1);
	if(isset($_POST["submit_job_card"]))
	{
		$merging="";
		$merging .= file_get_contents($_POST["chk_job_card"],0)."<div class='pagebreak'></div>";
		echo $merging;
	}
