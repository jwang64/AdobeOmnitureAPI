<?php

include_once(dirname(__FILE__) . '/../MethodCaller.php');

$methodCaller = new MethodCaller();
$methodCaller->saveRequest("allSegments.json",$methodCaller->getAllSegments());

?>