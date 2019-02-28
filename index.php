<?php

require 'vendor/autoload.php';


function insertToGsheet(){

	$path_key_google = 'credentials/credentials.json';

	$client = new Google_Client();

	$client->setApplicationName("01 Startup");
	$client->setScopes("https://www.googleapis.com/auth/spreadsheets");
	
	$client->setAuthConfig($path_key_google);
	//$client->setAccessToken("08b44d5c196b827f35c5e963b46c99d0b1a65479");
	$client->setAccessToken("a413ba1930fa0a7606c5ac75cb2ad6e998a92f61");

	$service = new \Google_Service_Sheets($client);
	//$spreadsheetId = '1SeSlAnI4S2A3KGRVTx94WUymI230q1HWU-2QpgpMNw0';
	$spreadsheetId = '13shtxTgjfq-6JBbpOfIWqzj-L8AhEjm6jriaU1Cy80c';

	$sheetInfo = $service->spreadsheets->get($spreadsheetId)->getProperties();

	//print($sheetInfo['title']. PHP_EOL);

	$options = array('valueInputOption' => 'RAW');
	$values = [['br', 'status', 'startupField', 'businessScop', 'fundingStag', '$since', "", '$startupDescription', '$city', "", '$url']];

	$body   = new \Google_Service_Sheets_ValueRange(['values' => $values]);
	$result = $service->spreadsheets_values->append($spreadsheetId, 'A2:K2', $body, $options);

	print_r($result);
}


insertToGsheet();

?>