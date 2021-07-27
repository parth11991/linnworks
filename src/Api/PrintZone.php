<?php

namespace Onfuro\Linnworks\Api;

class PrintZone extends ApiClient
{
    public function GetAllPrintZones()
    {
        return $this->post('PrintZone/GetAllPrintZones', []);
    }
}
