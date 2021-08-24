<?php

namespace Onfuro\Linnworks\Api;

class Permissions extends ApiClient
{
    public function getUsers()
    {
        return $this->get('permissions/getUsers');
    }
}