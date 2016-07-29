<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$methodCaller = new MethodCaller();

$rsid = "sharecareprod";

$methodCaller->saveRequest("sharecareEvents.json",$methodCaller->getReportsuiteEvents($rsid));

?>