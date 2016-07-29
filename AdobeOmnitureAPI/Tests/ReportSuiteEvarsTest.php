<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$methodCaller = new MethodCaller();

$rsid = "sharecareprod";

$methodCaller->saveRequest("sharecareEvars.json",$methodCaller->getReportsuiteEvars($rsid));

?>