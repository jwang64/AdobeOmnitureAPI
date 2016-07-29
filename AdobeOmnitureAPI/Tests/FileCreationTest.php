<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$methodCaller = new MethodCaller();

$dataRequired='{
			"reportDescription":{
                "reportSuiteID":"sharecareprod",
                "dateFrom":"2016-06-01",
                "dateTo":"2016-07-01",
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

$methodCaller->saveRequest("testfile.json",$methodCaller->getReportData($methodCaller->setReportID($dataRequired)));

?>