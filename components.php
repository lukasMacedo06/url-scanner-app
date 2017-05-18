<?php

require 'vendor/autoload.php';


//Using GuzzleHttp
$client = new \GuzzleHttp\Client();
$res = $client->request('GET', 'http://www.google.com.br');
echo $res->getStatusCode();
// 200
echo $res->getHeaderLine('content-type');
// 'application/json; charset=utf8'
echo $res->getBody();
'{"id": 1420053, "name": "guzzle", ...}'

// Send an asynchronous request.
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://google.com');
$promise = $client->sendAsync($request)->then(function ($response) {
    echo 'I completed! ' . $response->getStatusCode();
});
$promise->wait();




//Using LeagueCsv
use League\Csv\Reader;
$csv = Reader::createFromPath('urls.csv');

foreach ($csv as $csvRow) {
    try {

        echo $csvRow[0];
        
    } catch (\Exception $e) {
        
        echo "This an error response: ".$csvRow[0] . PHP_EOL;

    }
}

?>
