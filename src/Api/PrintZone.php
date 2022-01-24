<?php

namespace Onfuro\Linnworks\Api;

class PrintZone extends ApiClient
{
    public function GetAllPrintZones()
    {
        return $this->post('PrintZone/GetAllPrintZones', []);
    }

    public function GetTemplateOverridesForZone(string $PrintZoneCode = 'No override')
    {
        return $this->post('PrintZone/GetTemplateOverridesForZone', [
            "PrintZoneCode" => $PrintZoneCode
        ]);
    }

    public function UpdateTemplateOverrides(array $ToUpdate = [])
    {
        return $this->post('PrintZone/UpdateTemplateOverrides', [
            "request" => json_encode($ToUpdate)
        ]);
    }
}
