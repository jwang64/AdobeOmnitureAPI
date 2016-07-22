<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$methodCaller = new MethodCaller();

$dataRequired='{
            "reportDescription":{
                "reportSuiteID":"sharecareprod",
                "dateFrom":"2016-06-01",
                "dateTo":"2016-07-01",
                "metrics":[{"id":"pageviews"}],
                "elements":[{"id":"page"}]
            }
           }';

$methodCaller->getReportData($methodCaller->setReportID($dataRequired));

?>