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
    
    public function UpdatePickedItemDelta(string $Deltas = null)
    {
        return $this->post('Picking/UpdatePickedItemDelta', [
            "request" => $Deltas
        ]);
    }

    public function UpdatePickingWaveHeader(int $PickingWaveId = 0,int $UserId = 0)
    {
        return $this->post('Picking/UpdatePickingWaveHeader', [
            "PickingWaveId" => $PickingWaveId,
            "UserId" => $UserId,
            "State" => 1
        ]);
    }  
    

    public function DeleteOrdersFromPickingWaves(string $Orders = null)
    {
        return $this->post('Picking/DeleteOrdersFromPickingWaves', [
            "request" => $Orders
        ]);
    }
    
}
