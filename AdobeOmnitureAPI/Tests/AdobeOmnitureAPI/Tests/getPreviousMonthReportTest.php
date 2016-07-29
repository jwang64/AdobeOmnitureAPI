<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$methodCaller = new MethodCaller();

$dateFrom = date("Y-m-d", strtotime("first day of previous month"));
$dateTo = date("Y-m-d", strtotime("last day of previous month"));

$dataRequired='{
			"reportDescription":{
                "reportSuiteID":"sharecareprod",
                "dateFrom":"'.$dateFrom.'",
                "dateTo":"'.$dateTo.'",
                "metrics":[
							{
								"id":"visits"
							}
						  ],
				"elements":[
							{
							 "id":"evar49",
							 "classification":"Trinity Region",
							 "selected":[
								"Sisters of Providence","Saint Agnes", "Mercy Health", "Holy Cross", "Saint Joseph Mercy", "Saint Mary\'s (PA)"]
							}
						   ],

				"segments":[{"id":"s4238_56c205d6e4b0eed5611884d1"}]
            }
           }';

$methodCaller->saveRequest("dateTestFile.json",$methodCaller->getReportData($methodCaller->setReportID($dataRequired)));

?>