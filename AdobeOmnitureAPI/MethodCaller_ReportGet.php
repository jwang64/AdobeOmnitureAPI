<?php

include_once("MethodCaller.php");
include_once("MethodCaller_ReportQueue.php");



class ReportGet
{
	/*
	 * This method will take in a report ID and obtain the report data from the Adobe Marketing Servers. Can be used in conjunction with the
	 * ReportQueue method setReportID but does not have to be used in conjunction. If you have an ID already, then you can use this to get the
	 * report data as well.
	 */
	public function getReportData($reportID)
	{
	$reportID = (int) $reportID;
	$UpdatedReportID = '{"reportID":"'.$reportID.'"}';
	$methodToUse="Report.Get";
	$caller = new MethodCaller();
	var_dump($caller->getWebResponse($methodToUse,$UpdatedReportID));
	}
}


?>