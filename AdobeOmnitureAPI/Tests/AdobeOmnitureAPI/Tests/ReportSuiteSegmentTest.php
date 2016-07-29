<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$methodCaller = new MethodCaller();

$rsid = "sharecareprod";

$methodCaller->saveRequest("sharecareSegments.json",$methodCaller->getReportsuiteSegments($rsid));

?>