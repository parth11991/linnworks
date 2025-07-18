<?php

namespace Onfuro\Linnworks\Api;

use Illuminate\Support\Arr;

class Dashboards extends ApiClient
{
    public function ExecuteCustomScriptQuery(string $script = null)
    {
        return $this->post('Dashboards/ExecuteCustomScriptQuery', [
            "request" => json_encode([
                "Script" => $script
            ]),
            "cancellationToken" => '{
                "IsCancellationRequested": false,
                "CanBeCanceled": false,
                "WaitHandle": {
                  "Handle": {
                    "value": 1376
                  },
                  "SafeWaitHandle": {
                    "IsInvalid": false,
                    "IsClosed": false
                  }
                }
              }'
        ]);
    }

    public function ExecuteCustomPagedScript(int $scriptId = null, Array $parameters = [], int $entriesPerPage = 1, int $pageNumber = 1)
    {
        return $this->post('Dashboards/ExecuteCustomPagedScript', [
          "scriptId" => $scriptId,
          "parameters" => json_encode($parameters),
          "entriesPerPage" => $entriesPerPage,
          "pageNumber" => $pageNumber,
        ]);
    }

    public function ExecuteCustomScript(int $scriptId = null, Array $parameters = [], int $entriesPerPage = 1, int $pageNumber = 1)
    {
        $params = [
            "scriptId" => $scriptId,
            "parameters" => json_encode($parameters),
        ];
        if($entriesPerPage) {
            $params["entriesPerPage"] = $entriesPerPage;
        }
        if($entriesPerPage) {
            $params["pageNumber"] = $pageNumber;
        }
        // dd($params);
        return $this->post('Dashboards/ExecuteCustomScript', $params);
    }

    public function GetLowStockLevel ( Array $parameters = [])
    {
        return $this->post('Dashboards/GetLowStockLevel', $parameters);
    }
}
