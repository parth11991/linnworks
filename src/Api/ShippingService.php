<?php

namespace Onfuro\Linnworks\Api;

class ShippingService extends ApiClient
{

    public function CancelOrderShippingLabel(string $pkOrderIds = '{"pkOrderId":""}')
    {
        return $this->get('ShippingService/CancelOrderShippingLabel', [
            "request" => $pkOrderIds
        ]);
    }

}
