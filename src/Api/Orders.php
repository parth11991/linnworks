<?php

namespace Onfuro\Linnworks\Api;

class Orders extends ApiClient
{

    public function getOpenOrders(string $fulfilmentCenter = '00000000-0000-0000-0000-000000000000', int $entriesPerPage = 25, int $pageNumber = 1, string $filters = "", array $sorting = [], string $additionalFilters = "")
    {
        return $this->get('Orders/GetOpenOrders', [
            "entriesPerPage" => $entriesPerPage,
            "pageNumber" => $pageNumber,
            "filters" => $filters,
            "sorting" => $sorting,
            "fulfilmentCenter" => $fulfilmentCenter,
            "additionalFilter" => $additionalFilters
        ]);
    }

    public function getAllOpenOrders($fulfilmentCenter, string $filters = "", array $sorting = [], string $additionalFilter = "")
    {
        return $this->get('Orders/GetAllOpenOrders', [
            "filters" => $filters,
            "sorting" => $sorting,
            "fulfilmentCenter" => $fulfilmentCenter,
            "additionalFilter" => $additionalFilter
        ]);
    }

    public function GetOrdersById(array $pkOrderIds = [])
    {
        return $this->get('Orders/GetOrdersById', [
            "pkOrderIds" => json_encode($pkOrderIds)
        ]);
    }

    public function GetOrdersByNumOrderId(int $numOrderId = 1)
    {
        return $this->get('Orders/GetOrderDetailsByNumOrderId', [
            "OrderId" => $numOrderId
        ]);
    }

    public function SearchProcessedOrdersPaged(int $pageNum = 1, int $numEntriesPerPage = 50, string $from = "-7200 days", string $to = "now", string $dateType = "PROCESSED", string $searchField = "", string $exactMatch = "false", string $searchTerm = "")
    {
        return $this->get('ProcessedOrders/SearchProcessedOrdersPaged', [
            "from" => date('Y-m-d\TH:i:sP', strtotime($from)),
            "to" => date('Y-m-d\TH:i:sP', strtotime($to)),
            "dateType" => $dateType,
            "searchField" => $searchField,
            "exactMatch" => $exactMatch,
            "searchTerm" => $searchTerm,
            "pageNum" => $pageNum,
            "numEntriesPerPage" => $numEntriesPerPage,
        ]);
    }

    public function MoveToLocation(array $orderIds = [], string $pkStockLocationId = "")
    {
        return $this->get('Orders/MoveToLocation', [
            "orderIds" => json_encode($orderIds),
            "pkStockLocationId" => $pkStockLocationId
        ]);
    }

    public function ChangeShippingMethod(array $orderIds = [], string $shippingMethod = "")
    {
        return $this->get('Orders/ChangeShippingMethod', [
            "orderIds" => json_encode($orderIds),
            "shippingMethod" => $shippingMethod
        ]);
    }

    public function changeStatus(array $orderIds = [], string $status = "")
    {
        return $this->get('Orders/ChangeStatus', [
            "orderIds" => json_encode($orderIds),
            "status" => $status
        ]);
    }

    public function SetLabelsPrinted(array $orderIds = [])
    {
        return $this->post('Orders/SetLabelsPrinted', [
            "orderIds" => json_encode($orderIds)
        ]);
    }

    public function setShippingInfo(string $orderId = "", array $info = [])
    {
        return $this->post('Orders/SetOrderShippingInfo',[
            'orderId' => $orderId,
            'info' => json_encode($info)
        ]);
    }

    public function processOrder(string $orderId = "", bool $scanPerformed = true, string $locationId = "", bool $allowZeroAndNegativeBatchQty = true)
    {
        return $this->post('Orders/ProcessOrder',[
            'orderId' => $orderId,
            'scanPerformed' => $scanPerformed,
            'locationId' => $locationId,
            'allowZeroAndNegativeBatchQty' => $allowZeroAndNegativeBatchQty,
        ]);
    }

    public function processFulfilmentCentreOrder(string $orderId = "")
    {
        return $this->post('Orders/ProcessFulfilmentCentreOrder',[
            'orderId' => $orderId
        ]);
    }

    public function createOrder(
        OrderItems $orderItems,
        string $locationName = "",
        string $matchPostalServiceTag = "",
        string $source = "",
        string $subSource = "",
        string $referenceNumber = "",
        string $externalReference = "",
        string $receivedDate = "",
        string $dispatchBy = "",
        string $currency = "",
        string $channelBuyerName = "",
        string $deliveryEmailAddress = "",
        string $deliveryAddress1 = "",
        string $deliveryAddress2 = "",
        string $deliveryAddress3 = "",
        string $deliveryTown = "",
        string $deliveryRegion = "",
        string $deliveryPostCode = "",
        string $deliveryCountryName = "",
        string $deliveryFullName = "",
        string $deliveryCompanyName = "",
        string $deliveryPhoneNumber = "",
        string $deliveryIso3CountryCode = "",
        string $billingAddress1 = "",
        string $billingAddress2 = "",
        string $billingAddress3 = "",
        string $billingTown = "",
        string $billingRegion = "",
        string $billingPostCode = "",
        string $billingCountryName = "",
        string $billingFullName = "",
        string $billingCompanyName = "",
        string $billingPhoneNumber = "",
        string $billingIso3CountryCode = "",
        float $shippingCost = 0,
        int $shippingTaxRate = 20,
        string $mappingSource = "",
        string $orderState = "None",
        string $paymentStatus = "Paid",
        string $paidDate = "Today",
        array $notes = []
    ){
        $order = [
            //minimum requirements
            "Source" => $source,
            "SubSource" => $subSource,
            "ReferenceNumber" => $referenceNumber,
            "ExternalReference" => $externalReference,
            "ReceivedDate" => date('c', strtotime($receivedDate)),
            "DispatchBy" => date('c', strtotime($dispatchBy)),
//            "DeliveryStartDate" => date('c', strtotime('15th January 2018')),
//            "DeliveryEndDate" => "2019-02-12T11:12:33.4177471+01:00",

            //Basic info
            "Currency" => $currency, //USD EUR
            'ChannelBuyerName' => $channelBuyerName,
            'MatchPostalServiceTag' => $matchPostalServiceTag,
            'DeliveryAddress' => [
                'EmailAddress' => $deliveryEmailAddress,
                'Address1' => $deliveryAddress1,
                'Address2' => $deliveryAddress2,
                'Address3' => $deliveryAddress3,
                'Town' =>  $deliveryTown,
                'Region' =>  $deliveryRegion,
                'PostCode' =>  $deliveryPostCode,
                'Country' =>  $deliveryCountryName,
                'FullName' =>  $deliveryFullName,
                'Company' =>  $deliveryCompanyName,
                'PhoneNumber' =>  $deliveryPhoneNumber,
                'MatchCountryCode' =>  $deliveryIso3CountryCode
            ],
            'BillingAddress' => [
                'Address1' => $billingAddress1,
                'Address2' => $billingAddress2,
                'Address3' => $billingAddress3,
                'Town' =>  $billingTown,
                'Region' =>  $billingRegion,
                'PostCode' =>  $billingPostCode,
                'Country' =>  $billingCountryName,
                'FullName' =>  $billingFullName,
                'Company' =>  $billingCompanyName,
                'PhoneNumber' =>  $billingPhoneNumber,
                'MatchCountryCode' =>  $billingIso3CountryCode
            ],

            // items
            'AutomaticallyLinkBySKU' => true, //if channel mapping does not work, link by sku
            'MappingSource' => $mappingSource, //use mapping from another channel for SKU's
            'OrderItems'=> $orderItems->getOrderItems(),
            'PostalServiceCost' => $shippingCost, //cost inclusive of cost and after discount
            'PostalServiceTaxRate' => $shippingTaxRate,

            //state
            'OrderState' => $orderState,
            'PaymentStatus' => $paymentStatus,
            'PaidOn' => $paidDate ? date('c', strtotime($paidDate)) : null,
            
            //Notes - Particularly useful for personalised items.
            'Notes' => $notes

        ];

        // remove null
        $order = array_filter($order, function($row){
            return ! is_null($row);
        });

        return $this->post('Orders/CreateOrders',[
            'Location' => $locationName,
            'Orders' => json_encode([$order])
        ]);
    }

    public function cancelOrder(string $orderId, string $fulfilmentCenter, float $refund = 0, string $note = "" )
    {
        return $this->post('Orders/CancelOrder',[
            'orderId' => $orderId,
            'fulfilmentCenter' => $fulfilmentCenter,
            'refund' => $refund,
            'note' => $note,
        ]);
    }

//    public function setGeneralInfo(
//        $guid
//    ){
//        $order = [
////              "Status" => 1,
////              "LabelPrinted" => true,
////              "LabelError" => "sample string 3",
////              "InvoicePrinted" => true,
////              "PickListPrinted" => true,
////              "IsRuleRun" => true,
////              "Notes" => 7,
////              "PartShipped" => true,
////              "Marker" => 64,
////              "IsParked" => true,
////              "Identifiers" => null,
////              "ReferenceNum" => "sample string 10",
////              "SecondaryReference" => "sample string 11",
////              "ExternalReferenceNum" => "sample string 12",
////              "ReceivedDate" => "2018-10-03T11:12:33.5138145+01:00",
////              "Source" => "sample string 14",
////              "SubSource" => "sample string 15",
////              "SiteCode" => "sample string 16",
////              "HoldOrCancel" => true,
////              "DespatchByDate" => "2018-10-03T11:12:33.5138145+01:00",
//              "ScheduledDelivery" => [
//                  "From" => "2019-02-12T11:12:33.5138145+01:00",
//                  "To" => "2019-12-12T11:12:33.5138145+01:00"
//              ],
//              "HasScheduledDelivery" => true,
////              "Location" => "201863fe-a0a0-4af3-8956-ac185631f82b",
////              "NumItems" => 20,
////              "StockAllocationType" => 0
//        ];
//
//        return $this->post('Orders/SetOrderGeneralInfo',[
//            'orderId' => $guid,
//            'info' => json_encode($order),
//            'wasDraft' => false,
//        ]);
//
//    }

}
