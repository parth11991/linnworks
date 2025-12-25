<?php

namespace Onfuro\Linnworks\Api;

class OrdersV2 extends ApiClient
{

    public function GetOrders(
        array $orderIds = [],
        string $from = '-48 hours',
        int $entriesPerPage = 50,
        bool $includeProcessed = true,
        bool $onlyPaid = false,
        ?string $locationId = null,
        ?string $searchToken = null
    ) {
        // If IDs are provided, ALL other params must be ignored (per docs)
        if (!empty($orderIds)) {
            return $this->post(
                'Orders/GetOrders',
                [
                    'id' => $orderIds, // array of UUIDs
                ]
            );
        }

        $request = [
            'fromDate'         => date('Y-m-d\TH:i:sP', strtotime($from)),
            'entriesPerPage'   => $entriesPerPage,
            'includeProcessed' => $includeProcessed,
            'onlyPaid'         => $onlyPaid,
        ];

        if ($locationId) {
            $request['locationId'] = $locationId;
        }

        if ($searchToken) {
            $request['searchToken'] = $searchToken;
        }

        return $this->post(
            'Orders/GetOrders',
            $request
        );
    }
}
