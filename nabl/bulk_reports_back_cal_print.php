<?php 
session_start();
error_reporting(1);
if(isset($_POST["submit_report"]))
{
	$arry=explode(",",$_POST["merged_reports"]);
	$merging="";
	$counting_of_array=count($arry);
	foreach($arry as  $keying => $oningg)
	{
		$plusing=$keying+1;
		if($plusing != $counting_of_array) { $setings="<div class='pagebreak'></div>"; }else{ $setings=""; }
		$merging .= file_get_contents($oningg,0).$setings;
	}
		echo $merging;
}

if(isset($_POST["submit_back_cal"]))
{
	$arry=explode(",",$_POST["merged_back_cal"]);
	$merging="";
	$counting_of_array=count($arry);
	foreach($arry as $keying => $oningg)
	{
		$plusing=$keying+1;
		if($plusing != $counting_of_array) { $setings="<div class='pagebreak'></div>"; }else{ $setings=""; }
		$merging .= file_get_contents($oningg,0).$setings;
	}
		echo $merging;
}


    
	// if trf also
	if(isset($_POST["submit_trf"]))
	{
		$merging="";
		$merging .= file_get_contents($_POST["chk_trf"],0)."<div class='pagebreak'></div>";
		echo $merging;
	}
	
	// if job card also
	if(isset($_POST["submit_job_card"]))
	{
		$merging="";
		$merging .= file_get_contents($_POST["chk_job_card"],0)."<div class='pagebreak'></div>";
		echo $merging;
	}
