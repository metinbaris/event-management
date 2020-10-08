<?php

namespace App\Services;

use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;

class GoogleSheetsService
{
    /**
     * @var Google_Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $body;

    /**
     * GoogleSheetsService constructor.
     * @param Google_Client $googleClient
     */
    public function __construct(Google_Client $googleClient)
    {
        $this->client = $googleClient;
    }

    public function insert(array $data)
    {
        $this->setClient();
        $this->setBody($data);
        $this->getService()->spreadsheets_values->append(
            $data[ 'googleSheetId' ],
            $data[ 'googleSheetName' ],
            $this->getBody(),
            ['valueInputOption' => 'RAW'],
            ['insertDataOption' => 'INSERT_ROWS']
        );
    }

    public function getService()
    {
        $service = new Google_Service_Sheets($this->client);

        return $service;
    }

    public function setClient()
    {
        $this->client->setApplicationName('Google Sheets API PHP Quickstart');
        $this->client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $this->client->setAuthConfig(config_path() . '/google-sheets.json');
        $this->client->setAccessType('offline');
    }

    public function setBody($data)
    {
        $this->body = new Google_Service_Sheets_ValueRange(['values' => [$data]]);
    }

    public function getBody(): array
    {
        return $this->body;
    }
}
