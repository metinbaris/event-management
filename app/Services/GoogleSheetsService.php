<?php

namespace App\Services;

use Google_Client;
use Google_Service_Sheets;

class GoogleSheetsService
{
    /**
     * @var Google_Client
     */
    protected $client;

    /**
     * GoogleSheetsService constructor.
     * @param Google_Client $googleClient
     */
    public function __construct(Google_Client $googleClient)
    {
        $this->client = $googleClient;
    }

    public function getService()
    {
        $this->setClient();
        $service = new Google_Service_Sheets($this->client);

        return $service;
    }

    public function setClient()
    {
        try {
            $this->client->setApplicationName('Google Sheets API PHP Quickstart');
            $this->client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
            $this->client->setAuthConfig(config_path() . '/google-sheets.json');
            $this->client->setAccessType('offline');
        } catch (\Exception $exception) {
            //
        }
    }
}
