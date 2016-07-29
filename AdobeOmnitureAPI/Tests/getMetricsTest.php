<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$reportSuite = "sharecareprod";
$methodCaller = new MethodCaller();

$methodCaller->saveRequest("allMetrics.json",$methodCaller->getElements($reportSuite));

?>