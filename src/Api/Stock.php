<?php

namespace Onfuro\Linnworks\Api;

class Stock extends ApiClient
{
    public function getStockConsumption(string $stockItemId = "", string $locationId = "", string $startDate = "", string $endDate = "")
    {
        return $this->get('Stock/GetStockConsumption', [
            "stockItemId" => $stockItemId,
            "locationId" => $locationId,
            "startDate" => $startDate,
            "endDate" => $endDate,
        ]);
    }

    public function getStockItems(string $keyWord = "",string $locationId = "",int $entriesPerPage = 100, int $pageNumber = 1, bool $excludeComposites = true, bool $excludeVariations = true, bool $excludeBatches = true)
    {
        return $this->get('Stock/GetStockItems', [
            "keyWord" => $keyWord,
            "locationId" => $locationId,
            "entriesPerPage" => $entriesPerPage,
            "pageNumber" => $pageNumber,
            "excludeComposites" => $excludeComposites,
            "excludeVariations" => $excludeVariations,
            "excludeBatches" => $excludeBatches,
        ]);
    }

    public function getStockHistory(string $stockItemId, string $locationId, int $entriesPerPage = 100, int $pageNumber = 1)
    {
        return $this->get('Stock/GetItemChangesHistory', [
            "stockItemId" => $stockItemId,
            "locationId" => $locationId,
            "entriesPerPage" => $entriesPerPage,
            "pageNumber" => $pageNumber
        ]);
    }

    public function getStockItemByKey(string $locationId = "", string $key = "") : array
    {
        return $this->get('Stock/GetStockItemsByKey', [
            "stockIdentifier" => json_encode([
                "Key" => $key,
                "LocationId" => $locationId,
            ]),
        ]);
    }

    public function getStockItemsFullByIds(array $stockItemIds = []) {
        return $this->post('Stock/GetStockItemsFullByIds', [
            "request" => json_encode([
                'StockItemIds' => $stockItemIds,
                'DataRequirements' => [
                    'StockLevels',
                    'Supplier',
                    'ChannelTitle',
                    'ChannelDescription',
                    'ChannelPrice',
                    'ExtendedProperties',
                    'Images'
                ]
            ]),
        ]);
    }

    public function GetStockLevel(string $stockItemId)
    {
        return $this->get('Stock/GetStockLevel', [
            "stockItemId" => $stockItemId
        ]);
    }

}