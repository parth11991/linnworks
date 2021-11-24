# linnworks

## About

Wrapper for the Linnworks API, as documented at [http://apps.linnworks.net/Api](http://apps.linnworks.net/Api)

## Install

    composer require onfuro/linnworks

## Usage
        
    $linnworks = Linnworks::make('applicationId', 'applicationSecret', 'token');
    $linnworks = Linnworks_API::make([
                                        'applicationId' => env('LINNWORKS_APP_ID'),
                                        'applicationSecret' => env('LINNWORKS_SECRET'),
                                        'token' => auth()->user()->linnworks_token()->token,
                                    ], $this->client);
    $filter = "";
    $sorting = "[]"
    $additionalFilter = "";
    $entriesPerPage = 25;
    $pageNumber = 1;
    $orders = $linnworks->Orders()->getOpenOrders(
                                                    'e41b4701-0885-430d-9623-d840d9d46dd6',
                                                    $entriesPerPage,
                                                    $pageNumber,
                                                    $filter,
                                                    $sorting,
                                                    $additionalFilter
                                                );
        
## Depriciated SDK

Only some of the API has been created. The depreciated SKD folder contains a wide range of the potential API calls.