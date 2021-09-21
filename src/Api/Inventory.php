<?php

namespace Onfuro\Linnworks\Api;

class Inventory extends ApiClient
{

    public function GetInventoryItems(string $view = "", string $stockLocationIds = ["00000000-0000-0000-0000-000000000000"], int $startIndex = 1, int $itemsCount = 100,  string $preloadChilds = false, string $isDownload = false)
    {
        return $this->get('Inventory/GetInventoryItems', [
            "view" => $view,
            "stockLocationIds" => $stockLocationIds,
            "startIndex" => $startIndex,
            "itemsCount" => $itemsCount,
            "preloadChilds" => $preloadChilds,
            "isDownload" => $isDownload
        ]);
    }

}
