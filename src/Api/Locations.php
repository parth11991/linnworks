<?php


namespace Onfuro\Linnworks\Api;


class Locations extends ApiClient
{

    public function GetCountries()
    {
        return $this->get('Inventory/GetCountries');
    }

    public function GetWarehouseTOTEs(string $LocationId = '{"LocationId":""}')
    {
        return $this->get('Inventory/GetWarehouseTOTEs', [
            "request" => $LocationId
        ]);
    }

}