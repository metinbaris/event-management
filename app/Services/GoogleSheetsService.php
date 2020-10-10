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

    /** Row values of google sheets
     * @var array
     */
    protected $rowData;

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
        $this->setRowData($data);
        $this->getService()->spreadsheets_values->append(
            $data[ 'googleSheetsId' ],
            $data[ 'googleSheetsName' ],
            $this->getRowData(),
            ['valueInputOption' => 'RAW'],
            ['insertDataOption' => 'INSERT_ROWS']
        );
    }

    public function setClient()
    {
        $this->client->setApplicationName('Google Sheets');
        $this->client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $this->client->setAuthConfig(config_path() . '/google-sheets.json');
        $this->client->setAccessType('offline');
    }

    public function setRowData($data)
    {
        unset($data[ 'googleSheetId' ], $data[ 'googleSheetName' ]);
        $this->rowData = new Google_Service_Sheets_ValueRange(['values' => [$data]]);
    }

    public function getService()
    {
        $service = new Google_Service_Sheets($this->client);

        return $service;
    }

    public function getRowData(): array
    {
        return $this->rowData;
    }
}
