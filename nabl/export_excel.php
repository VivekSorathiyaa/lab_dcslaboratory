<?php


if(isset($_POST["submit_report"]))
{
	$file_names= $_POST["file_names"];
	$file_named=str_replace(".php","",$file_names);
	$arry=explode(",",$_POST["merged_reports"]);
	$merging="";
	$counting_of_array=count($arry);
	foreach($arry as  $keying => $oningg)
	{
		$plusing=$keying+1;
		if($plusing != $counting_of_array) { $setings="<div class='pagebreak'></div>"; }else{ $setings=""; }
		$merging .= file_get_contents($oningg,0).$setings;
	}
		str_replace("Â»",">>",$merging);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-disposition: attachment; filename='.$file_named.'.xls');
		echo $merging;
}

?>