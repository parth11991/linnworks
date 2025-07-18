<?php

namespace Onfuro\Linnworks\Api;

class OpenOrders extends ApiClient
{
    public function GetIdentifiers()
    {
        return $this->get('OpenOrders/GetIdentifiers');
    }
}
