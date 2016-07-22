<?php

include_once("MethodCaller.php");

class ReportQueue
{
	/*
	 * This function takes in the required set of data and sends it to the server. If the request is valid, then it will return an ID that is used
	 * in conjunction with the ReportGet method getReportData in order to get the information from the report.
	 */
	public function setReportID($dataRequired)
	{
		$methodToUse = "Report.Queue";
		$caller = new MethodCaller();
		$reportID= $caller->getWebResponse($methodToUse,$dataRequired)->reportID;
		return $reportID;
	}
}

?>