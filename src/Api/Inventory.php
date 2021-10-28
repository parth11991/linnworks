<?php

namespace Onfuro\Linnworks\Api;

class Inventory extends ApiClient
{

    public function GetInventoryItems(array $view = [], array $stockLocationIds = [], int $startIndex = 1, int $itemsCount = 10)
    {
        return $this->post('Inventory/GetInventoryItems', [
            "view" => json_encode($view),
            "stockLocationIds" => $stockLocationIds,
            "startIndex" => $startIndex,
            "itemsCount" => $itemsCount
        ]);
    }

    public function GetInventoryItemById(string $StockItemId = "")
    {
        return $this->post('Inventory/GetInventoryItemById', [
            "id" => $StockItemId
        ]);
    }

    public function GetStockItemIdsBySKU(string $SKUS = '{"SKUS":""}')
    {
        return $this->post('Inventory/GetStockItemIdsBySKU', [
            "request" => $SKUS
        ]);
    }

    

    public function GetInventoryItemImages(string $inventoryItemId = "")
    {
        return $this->post('Inventory/GetInventoryItemImages', [
            "inventoryItemId" => $inventoryItemId
        ]);
    }

    public function GetInventoryItemCompositions(string $inventoryItemId = "")
    {
        return $this->post('Inventory/GetInventoryItemCompositions', [
            "inventoryItemId" => $inventoryItemId
        ]);
    }

    public function GetStockLocations()
    {
        return $this->post('Inventory/GetStockLocations', []);
    }

    public function GetPreDefinedViews()
    {
        return $this->post('Inventory/GetPreDefinedViews', []);
    } 

    public function GetInventoryItemsCount(bool $includeDeleted = true, bool $includeArchived = true)
    {
        return $this->post_int('Inventory/GetInventoryItemsCount', [
            "includeDeleted" => $includeDeleted,
            "includeArchived" => $includeArchived
        ]);
    }

    public function GetInventoryItemExtendedProperties(string $inventoryItemId = "",array $propertyParams = [])
    {
        return $this->post('Inventory/GetInventoryItemExtendedProperties', [
            "inventoryItemId" => $inventoryItemId,
            "propertyParams" => json_encode($propertyParams)
        ]);
    }

    
}
