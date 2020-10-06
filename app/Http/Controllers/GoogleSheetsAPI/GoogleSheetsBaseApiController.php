<?php

namespace App\Http\Controllers\GoogleSheetsAPI;

use Google_Client;
use Google_Service_Sheets;

abstract class GoogleSheetsBaseApiController
{
    public function getGoogleSheetService()
    {
        $client = $this->getClient();
        $service = new Google_Service_Sheets($client);

        return $service;
    }

    public function getClient(): Google_Client
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig(config_path() . '/google-sheets.json');
        $client->setAccessType('offline');

        return $client;
    }
}
