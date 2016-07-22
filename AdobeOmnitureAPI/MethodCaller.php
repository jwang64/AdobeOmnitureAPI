<?php
include_once("/SimpleRestClient/SimpleRestClient.php");
/*
 * MethodCaller class for the Adobe Marketing API. This class will use your username and secret in order to access information from the adobe marketing client
 * The GetAPIData method is used to send a request to the server. The getWebResponse function will return the response to the request.
 */
class MethodCaller
{
	/*
	 * The GetAPIData method will take in one of Adobe's methods as well as the data necessary for the method, then it will send a request to Adobe Marketing Server
	 * to access the API and receive the output of the method and data used. 
	 */
	public function GetAPIData($method, $data) {
        $username = 'Your_Username';
        $secret = 'Your_Secret';
        $nonce = md5(uniqid(php_uname('n'), true));
        $nonce_ts = date('c');
        $digest = base64_encode(sha1($nonce.$nonce_ts.$secret));

        $server = "https://api.omniture.com";
        $path = "/admin/1.4/rest/";

        $rc=new SimpleRestClient();
        $rc->setOption(CURLOPT_HTTPHEADER, array("X-WSSE: UsernameToken Username=\"$username\", PasswordDigest=\"$digest\", Nonce=\"$nonce\", Created=\"$nonce_ts\""));

        $rc->postWebRequest($server.$path.'?method='.$method, $data);

        return $rc;
    }
	
	/*
	 * The getWebResponse method will call the GetAPIData method in order to send a request to the server. Once this method obtains the results of the request,
	 * the getWebResponse method will then get the response from the server and will change it to an useable format for other methods.
	 */
	public function getWebResponse($method,$data)
	{
		$rc=self::GetAPIData($method, $data);
		if ($rc->getStatusCode()==200) {
        $response=$rc->getWebResponse();
		$json=json_decode($response);
		//$jsonResponse=$json->reportID;
		return($json);
		}
		else {
            echo "something went really wrong\n";
            var_dump($rc->getInfo());
            echo "\n".$rc->getWebResponse();
		}
	}
	
	/*
	 * This function will take in the data and validate it
	 */
	public function validate($dataRequired)
	{
		$methodToUse = "Report.Validate";
		return self::getWebResponse($methodToUse,$dataRequired);
	}

	/*
	 * This function takes in the required set of data and sends it to the server. If the request is valid, then it will return an ID that is used
	 * in conjunction with the ReportGet method getReportData in order to get the information from the report.
	 */
	public function setReportID($dataRequired)
	{
		if(self::validate($dataRequired))
		{
		$methodToUse = "Report.Queue";
		$reportID= self::getWebResponse($methodToUse,$dataRequired)->reportID;
		return $reportID;
		}
		else
		{
			echo("The data or format is incorrect, please try again");
		}
	}
	
	/*
	 * This method will take in a report ID and obtain the report data from the Adobe Marketing Servers. Can be used in conjunction with the
	 * ReportQueue method setReportID but does not have to be used in conjunction. If you have an ID already, then you can use this to get the
	 * report data as well.
	 */
	public function getReportData($reportID)
	{
	$reportID = (int) $reportID;
	$UpdatedReportID = '{"reportID":"'.$reportID.'"}';
	$methodToUse="Report.Get";
	sleep(3);
	var_dump(self::getWebResponse($methodToUse,$UpdatedReportID));
	}
	
	/*
	 * Get all of the elements for the report suite
	 */
	public function getElements($rsid)
	{
		$InputRSID = '{"reportSuiteID":"'.$rsid.'"}';
		$methodToUse="Report.GetElements";
		var_dump(self::getWebResponse($methodToUse,$InputRSID));
	}
	
	/*
	 * Get all of the metrics for the report suite
	 */
	public function getMetrics($rsid)
	{
		$InputRSID = '{"reportSuiteID":"'.$rsid.'"}';
		$methodToUse="Report.GetMetrics";
		var_dump(self::getWebResponse($methodToUse,$InputRSID));
	}
	
	/*
	 * The method will determine what kind of reports are queued on Adobe's servers
	 */
	public function getQueue()
	{	 
		$username = 'Your_Username';
		$secret = 'Your_Secret';
		$nonce = $nonce = md5(uniqid(php_uname('n'), true));
		$nonce_ts = date('c');

		$digest = base64_encode(sha1($nonce.$nonce_ts.$secret));

		$server = "https://api.omniture.com";
		$path = "/admin/1.4/rest/";

		$rc=new SimpleRestClient();
		$rc->setOption(CURLOPT_HTTPHEADER, array("X-WSSE: UsernameToken Username=\"$username\", PasswordDigest=\"$digest\", Nonce=\"$nonce\", Created=\"$nonce_ts\""));

		$methodToUse="?method=Report.GetQueue";

		$rc->getWebRequest($server.$path.$methodToUse);

		if ($rc->getStatusCode()==200) {
			$response=$rc->getWebResponse();
			var_dump($response);
		} 
	}
}

?>
