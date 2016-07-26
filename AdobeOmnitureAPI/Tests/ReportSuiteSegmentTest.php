<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$methodCaller = new MethodCaller();

$rsid = "sharequalityhealthprod";

$methodCaller->getReportsuiteSegments($rsid);

?>