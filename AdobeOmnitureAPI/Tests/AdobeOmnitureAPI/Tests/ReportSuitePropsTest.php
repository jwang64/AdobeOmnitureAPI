<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$methodCaller = new MethodCaller();

$rsid = "sharecareprod";

$methodCaller->saveRequest("sharecareProps.json",$methodCaller->getReportsuiteProps($rsid));

?>