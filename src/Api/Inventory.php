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

    public function GetImagesInBulk(array $stockItemIds = [], array $skus = [])
    {
        return $this->post('Inventory/GetImagesInBulk', [
            "request" => [
                "StockItemIds" => $stockItemIds,
                "SKUS" => $skus
            ]
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

    public function GetInventoryItemExtendedProperties(string $inventoryItemId = "", array $propertyParams = [])
    {
        return $this->post('Inventory/GetInventoryItemExtendedProperties', [
            "inventoryItemId" => $inventoryItemId,
            "propertyParams" => json_encode($propertyParams)
        ]);
    }

    public function GetPackageGroups()
    {
        return $this->post('Inventory/GetPackageGroups');
    }

    public function GetChannels()
    {
        return $this->post('Inventory/GetChannels');
    }

    public function GetInventoryItemPriceChannelSuffixes()
    {
        return $this->post('Inventory/GetInventoryItemPriceChannelSuffixes');
    }

    public function GetInventoryItemPriceTags()
    {
        return $this->post('Inventory/GetInventoryItemPriceTags');
    }

    public function GetCategories()
    {
        return $this->post('Inventory/GetCategories');
    }

    public function BatchGetInventoryItemChannelSKUs(array $inventoryItemIds = [])
    {
        return $this->post('Inventory/BatchGetInventoryItemChannelSKUs', [
            "inventoryItemIds" => json_encode($inventoryItemIds)
        ]);
    }

    public function UpdateInventoryItemPrices(array $arr)
    {
        // $arr = [json_encode([
        //     "Source" => $source,
        //     "SubSource" => $subSource,
        //     "Price" => (double) $price,
        //     "StockItemId" => $stockItemId
        // ])];

        // curl --location --request GET 'https://eu-ext.linnworks.net/api/Inventory/UpdateInventoryItemPrices' \
        //         --header 'Authorization: dcc59dc8-9dde-4ea5-a1fd-20266f124737' \
        //         --header 'Content-Type: application/x-www-form-urlencoded' \
        //         --data-urlencode 'inventoryItemPrices=[
        //         {
        //             "Source": "AMAZON",
        //             "SubSource": "Dapetz",
        //             "Price": 52,
        //             "StockItemId": "6ba16b1d-4263-4ca0-a157-ca44d37f875d"
        //         }
        //         ]'
        $acv = $this->apiClientVariables();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://eu-ext.linnworks.net/api/Inventory/UpdateInventoryItemPrices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => 'inventoryItemPrices=' . json_encode([$arr]),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $acv['bearer'],
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
        // print_r($response);exit;


        // print_r(json_encode([$arr]));
        // return $this->get('Inventory/UpdateInventoryItemPrices',[
        //     'inventoryItemPrices' => json_encode([$arr])
        // ]);
        // $this->get('Inventory/UpdateInventoryItemPrices',["inventoryItemPrices" => json_encode([$arr])]);
    }

    public function GetInventoryItemPrices($inventoryItemId)
    {
        return $this->post('Inventory/GetInventoryItemPrices', [
            "inventoryItemId" => $inventoryItemId
        ]);
    }
}
