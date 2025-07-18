<?php

namespace Onfuro\Linnworks\Api;

class Listings extends ApiClient
{

    public function GeteBayConfigurators()
    {
        return $this->post('Listings/GeteBayConfigurators');
    }

    public function GetAmazonConfigurators()
    {
        return $this->post('Listings/GetAmazonConfigurators');
    }

    public function GeteBayTemplates($inventoryItemIds = [], $subSource = '', int $pageNum = 1, int $numEntriesPerPage = 10000, $selectedRegions = [], $templatesType = 'Simple', $onlyWithErrors = true, $siteFilter = null)
    {
        return $this->post('Listings/GeteBayTemplates',['parameters'=>json_encode([
            'InventoryItemIds' => $inventoryItemIds,
            'PageNumber' => $pageNum,
            'EntriesPerPage' => $numEntriesPerPage,
            'SelectedRegions' => $selectedRegions,
            "SubSource" => $subSource,
            "TemplatesType" => $templatesType,
            // "OnlyWithErrors" => $onlyWithErrors,
            "siteFilter" => $siteFilter])
        ]);
    }

    public function GetAmazonTemplates($inventoryItemIds = [], $subSource = '' , int $pageNum = 1, int $numEntriesPerPage = 10000, $selectedRegions = [], $templatesType = 'Simple', $onlyWithErrors = true, $siteFilter = null)
    {
        return $this->post('Listings/GetAmazonTemplates',['parameters'=>json_encode([
            'InventoryItemIds' => $inventoryItemIds,
            'PageNumber' => $pageNum,
            'EntriesPerPage' => $numEntriesPerPage,
            'SelectedRegions' => $selectedRegions,
            "SubSource" => $subSource,
            "TemplatesType" => $templatesType,
            // "OnlyWithErrors" => $onlyWithErrors,
            "siteFilter" => $siteFilter])
        ]);
    }

    public function GetAmazonCategories(){
        return $this->post('Listings/GetAmazonCategories');   
    }

    public function GetAmazonBrowseNodes($category, $site = "co.uk"){
        return $this->post('Listings/GetAmazonBrowseNodes',['site' => $site, 'category' => $category]);
    }

    public function GeteBayConfiguratorsCategories($subSource, $site = "UK"){
        return $this->post('Listings/GeteBayConfiguratorsCategories',['site' => $site, 'subSource' => $subSource]);
    }
}