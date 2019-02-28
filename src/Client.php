<?php
namespace Bagusrin\Gsheet;

/**
 * 3rd party google sheer using google api.
 *
 * @author Bagus Rinaldhi <bagusrinn@gmail.com>
 */

class Client{

    private $spreadSheetId;
    private $token;

    
    public function __construct(array $param = []){
        $this->spreadSheetId = $param['spreadSheetId'];
        $this->token = $param['token'];
    }

    /**
     * Insert Data to Google Sheet
     *
     * @param array $dt
     *
     * @return boolean
     */
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

        return true;
    }


    /**
     * Get Raw Data from Google Sheet
     *
     * @param array $dt
     *
     * @return array
     */
    public function get(array $dt = []){

        $credentialPath = $dt['credentialPath'];
        $coloumn = $dt['coloumn'];
        $applicationName = $dt['applicationName'];

        $res = self::getCLient($credentialPath, $applicationName);

        $client = $res;
        $service = new \Google_Service_Sheets($client);

        $spreadsheetId = $this->spreadSheetId;
        $range = $coloumn;
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        if (empty($values)) {
            return array();
        } else {
            return $values;
        }
    }

    /**
     * Get Client Google Sheet
     *
     * @param string $credentialPath
     * @param string $applicationName
     *
     * @return array
     */
    private function getClient($credentialPath, $applicationName){

        $client = new \Google_Client();
        $client->setApplicationName($applicationName);
        $client->setScopes(\Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig($credentialPath);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $client->setAccessToken($this->token);

        return $client;
    }


}
