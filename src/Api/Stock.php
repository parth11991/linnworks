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

    public function getStockItemsByIds(array $ids = [])
    {
        return $this->post('Stock/GetStockItemsByIds', [
            "request" => json_encode([
                "StockItemIds" => $ids
            ]),
        ]);
    }


    public function GetStockItemsFull(string $keyWord = "",bool $loadCompositeParents = true, bool $loadVariationParents = true,int $entriesPerPage = 100, int $pageNumber = 1, string $dataRequirements = '[0,1,2,3,4,5,6,7,8,9]', string $searchTypes = '[]')
    {
        return $this->get('Stock/GetStockItemsFull', [
            "keyWord" => $keyWord,
            "loadCompositeParents" => $loadCompositeParents,
            "loadVariationParents" => $loadVariationParents,
            "entriesPerPage" => $entriesPerPage,
            "pageNumber" => $pageNumber,
            "dataRequirements" => $dataRequirements,
            "searchTypes" => $searchTypes,
        ]);
    }

    public function getStockItemsFullByIds(array $ids = [])
    {
        return $this->post('Stock/GetStockItemsFullByIds', [
            "request" => json_encode([
                "StockItemIds" => $ids
            ]),
        ]);
    }

}