<?php
namespace Bagusrin\Gsheet;

class Client{

    private $spreadSheetId;
    private $token;

    
    public function __construct(array $param = []){
        $this->spreadSheetId = $param['spreadSheetId'];
        $this->token = $param['token'];
    }

    public function insert(array $dt = []){

        $credentialPath = $dt['credentialPath'];
        $coloumn = $dt['coloumn'];
        $applicationName = $dt['applicationName'];
        $rawData = $dt['rawData'];

        $client = new \Google_Client();

        $client->setApplicationName($applicationName);
        $client->setScopes("https://www.googleapis.com/auth/spreadsheets");
        
        $client->setAuthConfig($credentialPath);
        $client->setAccessToken($this->token);

        $service = new \Google_Service_Sheets($client);
        $spreadsheetId = $this->spreadSheetId;

        $sheetInfo = $service->spreadsheets->get($spreadsheetId)->getProperties();

        $options = array('valueInputOption' => 'RAW');
        $values = $rawData;

        $body   = new \Google_Service_Sheets_ValueRange(['values' => $values]);
        $result = $service->spreadsheets_values->append($spreadsheetId, $coloumn, $body, $options);

    }
}
