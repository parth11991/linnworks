<?php

namespace Onfuro\Linnworks\Api;

class PrintService extends ApiClient
{
    public function CreatePDFfromJobForceTemplate(string $templateType = 'Shipping Labels', array $IDs = [], int $templateID = 17,string $parameters = '', string $printerName = "", string $printZoneCode = "", int $pageStartNumber = 0, string $operationId = "", string $context = "")
    {
        return $this->get('PrintService/CreatePDFfromJobForceTemplate', [
            "templateType" => $templateType,
            "IDs" => json_encode($IDs),
            "templateID" => $templateID,
            "parameters" => $parameters,
            "printerName" => $printerName,
            "printZoneCode" => $printZoneCode,
            "pageStartNumber" => $pageStartNumber,
            "operationId" => $operationId,
            "context" => $context,
        ]);
    }

    public function VP_GetPrinters()
    {
        return $this->post('PrintService/VP_GetPrinters', []);
    }
}
