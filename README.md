# google-sheet
Google Sheet 3rd Party for PHP

=== Usage ===

<?php

$client = new Client([
                        'spreadSheetId' => 'SPREADSHEET ID',
                        'token' => 'TOKEN' 
                    ]);
                    
/** Insert to Google Sheet **/
$credential = '/Users/admin/Downloads/credentials.json';
        $applicationName = '01 Startup';
        $rawData = [['br12', 'status', 'startupField', 'businessScop', 'fundingStag', '$since', "", '$startupDescription', '$city', "", '$url']];
        $coloumn = 'A2:K2';

        $client->insert([
                    'credentialPath' => $credential,
                    'applicationName' => $applicationName,
                    'coloumn' => $coloumn,
                    'rawData' => $rawData
            ]);
            
            
 /** Get Raw Data from Google Sheet **/
 $credential = '/Users/admin/Downloads/credentials.json';
        $applicationName = '01 Startup';
        $coloumn = 'A2:K';
        
        $res = $client->get([
                    'credentialPath' => $credential,
                    'applicationName' => $applicationName,
                    'coloumn' => $coloumn
            ]);
