<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');
include_once(dirname(__FILE__) . '/../MethodCaller_ReportQueue.php');
include_once(dirname(__FILE__) . '/../MethodCaller_ReportGet.php');

/*
 * Test case for a single adobe report consisting of the reportsuite(sharecareprod), time period(dateFrom and dateTo), metrics("id":"pageviews"), and the elements("page")
 */

$methodCaller = new MethodCaller();
$reportQueue = new ReportQueue();
$reportGet = new ReportGet();

$dataRequired='{
            "reportDescription":{
                "reportSuiteID":"sharecareprod",
                "dateFrom":"2016-06-01",
                "dateTo":"2016-07-01",
                "metrics":[{"id":"pageviews"}],
                "elements":[{"id":"page"}]
            }
           }';

$reportGet->getReportData($reportQueue->setReportID($dataRequired));


?>