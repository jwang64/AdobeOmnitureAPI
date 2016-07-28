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
	 * This method will get a webrequest for methods that don't require data to access them then give the output.
	 */
	public function apiDataless($method)
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

		$methodToUse='?method='.$method;

		$rc->getWebRequest($server.$path.$methodToUse);

		if ($rc->getStatusCode()==200) {
			$response=$rc->getWebResponse();
			var_dump($response);
		} 
	}
	
	/*
	 * This function will take in the data and validate it
	 */
	public function validate($dataRequired)
	{
		
		$methodToUse = "Report.Validate";
		$validate = self::getWebResponse($methodToUse,$dataRequired);
		return $validate;
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
	$UpdatedReportID = '{"reportID":"'.$reportID.'"}';
	$methodToUse="Report.Get";
	sleep(6);
	return self::getWebResponse($methodToUse,$UpdatedReportID);
	}
	
	/*
	 * This method will allow a person to take in the report data and save it in a file of their specification. It will take the report data then encode it into a json format then save the data
	 */
	public function saveReportData($filename, $ReportData)
	{
		$formattedReportData = json_encode($ReportData);
		file_put_contents($filename,$formattedReportData);
		echo("The file has been saved to ".$filename);
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
		$methodToUse="Report.GetQueue";
		self::apiDataless($methodToUse);
	}
	
	/*
	 * This method will return all the segments that are owned by the company
	 * Note: you will have to have adminstrative powers to use this method
	 */
	public function getAllSegments()
	{
		$methodToUse="Segments.Get";
		self::apiDataless($methodToUse);
	}
	
	/*
	 * This method will allow users to obtain segments from a specific report suite. It doesn't require users to be adminstrators to use
	 * The report suite id must be obtained by someone who has administrative access.
	 */
	public function getReportsuiteSegments($reportsuite)
	{
		$methodToUse="ReportSuite.GetSegments";
		$formattedRSID ='{"rsid_list":["'.$reportsuite.'"]}';
		var_dump(self::getWebResponse($methodToUse,$formattedRSID));
	}
	
}

?>