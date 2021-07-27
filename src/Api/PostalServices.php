<?php

namespace Onfuro\Linnworks\Api;

class PostalServices extends ApiClient
{
    public function getPostalServices()
    {
        return $this->get('PostalServices/GetPostalServices');
    }
}