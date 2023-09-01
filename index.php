<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();
const API_TOKEN = '9ba4c1525fcf76cf4004e5c5c55110ee8c0af7d506d447c378abd490388523549b33eb96';


/*====== Next code we create note in the deal ======*/
/*
$dealID = '472';
$response = $client->request('POST', 'https://growthgeyser.api-us1.com/api/3/deals/'.$dealID.'/notes', [
    'headers' => [
        'Api-Token' => API_TOKEN,
        'accept' => 'application/json',
        'content-type' => 'application/json',
    ],
    'json' => [
        'note' => [
            'note' => "Some note",
        ],
    ],
]);

echo $response->getBody();
*/


/*====== Next code we create a deal and return dealID ======*/
$dealData = [
    "deal" => [
        "contact" => "51",
        "account" => "45",
        "description" => "This deal is an important deal",
        "currency" => "usd",
        "group" => "1",
        "owner" => "1",
        "percent" => null,
        "stage" => "1",
        "status" => 0,
        "title" => "Igor TEST Deal",
        "value" => 45600
    ],
];

$response = $client->request('POST', 'https://growthgeyser.api-us1.com/api/3/deals', [
    'headers' => [
        'Api-Token' => API_TOKEN,
        'accept' => 'application/json',
        'content-type' => 'application/json',
    ],
    'json' => $dealData,
]);

$dealArray = json_decode($response->getBody(), true);

$dealID = $dealArray['deal']['id'];

/*====== Next code/ After created deal we create notes in the deal ======*/

$notesData = [
    [
        'note' => 'Note 1 for the deal',
    ],
    [
        'note' => 'Note 2 for the deal',
    ],
    [
        'note' => 'Note 3 for the deal',
    ],
];

foreach ($notesData as $note) {
    $response = $client->request('POST', 'https://growthgeyser.api-us1.com/api/3/deals/' . $dealID . '/notes', [
        'headers' => [
            'Api-Token' => API_TOKEN,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ],
        'json' => [
            'note' => [
                'note' => $note['note'],
            ],
        ],
    ]);
    $noteArray = json_decode($response->getBody(), true);

    echo "Created Deal ID - ".$dealID ." - " . $noteArray['note']['note'];
}

