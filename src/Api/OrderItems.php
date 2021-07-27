<?php


namespace Onfuro\Linnworks\Api;


class OrderItems
{

    protected $itemNumber = 0;
    protected $orderItems = [];

    public function addOrderItem(string $sku = "",
                                 string $title = "",
                                 int $qty = 0,
                                 float $pricePerUnit = 0,
                                 int $taxRate = 20,
                                 bool $taxCostInclusive = true,
                                 bool $useChannelTax = false,
                                 bool $isService = false,
                                 float $lineDiscount = 0
    ){
        if(! $sku){
            return;
        }

        $this->orderItems[] = array_filter([
            'TaxCostInclusive'=> $taxCostInclusive,
            'UseChannelTax'=> $useChannelTax,
            'PricePerUnit'=> $pricePerUnit < 0 ? 0 : $pricePerUnit,
            'Qty'=> $qty,
            'TaxRate'=> $taxRate,
            'LineDiscount'=> $lineDiscount,
            'ItemNumber'=> $this->itemNumber++,
            'ChannelSKU'=> $sku,
            'IsService'=> $isService,
            'ItemTitle'=> $title
        ], function($row){
            return ! is_null($row);
        });
    }

    public function getOrderItems()
    {
        return $this->orderItems;
    }
}