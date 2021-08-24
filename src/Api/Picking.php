<?php

namespace Onfuro\Linnworks\Api;

class Picking extends ApiClient
{
    public function GetAllPickingWaveHeaders(int $State = null,string $LocationId = '00000000-0000-0000-0000-000000000000', string $DetailLevel = "")
    {
        return $this->get('Picking/GetAllPickingWaveHeaders', [
            "State" => $State,
            "LocationId" => $LocationId,
            "DetailLevel" => $DetailLevel
        ]);
    }

    public function GetAllPickingWaves(int $State = null,string $LocationId = '00000000-0000-0000-0000-000000000000', string $DetailLevel = "")
    {
        return $this->get('Picking/GetAllPickingWaves', [
            "State" => $State,
            "LocationId" => $LocationId,
            "DetailLevel" => $DetailLevel
        ]);
    }

    public function GetMyPickingWaveHeaders(int $State = null,string $LocationId = '00000000-0000-0000-0000-000000000000', string $DetailLevel = "")
    {
        return $this->get('Picking/GetMyPickingWaves', [
            "State" => $State,
            "LocationId" => $LocationId,
            "DetailLevel" => $DetailLevel
        ]);
    } 

    public function GetMyPickingWaves(int $State = null,string $LocationId = '00000000-0000-0000-0000-000000000000', string $DetailLevel = "")
    {
        return $this->get('Picking/GetMyPickingWaves', [
            "State" => $State,
            "LocationId" => $LocationId,
            "DetailLevel" => $DetailLevel
        ]);
    } 

    public function GetPickwaveUsersWithSummary(int $State = null,string $LocationId = '00000000-0000-0000-0000-000000000000', string $DetailLevel = "")
    {
        return $this->get('Picking/GetPickwaveUsersWithSummary', [
            "State" => $State,
            "LocationId" => $LocationId,
            "DetailLevel" => $DetailLevel
        ]);
    } 

    public function GetPickingWave(int $PickingWaveId = 0)
    {
        return $this->get('Picking/GetPickingWave', [
            "PickingWaveId" => $PickingWaveId
        ]);
    }    
    
    
}
