<?php

require 'vendor/autoload.php';

use League\Csv\Reader;
$csv = Reader::createFromPath($argv[1]);
$client = new \GuzzleHttp\Client();


// CREATE A HANDLE TO THE LOG
$log = new \Monolog\Logger('log_url_csv');

// CREATE A LOG CHANNEL
$stream = new \Monolog\Handler\StreamHandler('log_mono.log', \Monolog\Logger::DEBUG);

$log->pushHandler($stream);

foreach ($csv as $csvRow) {
    try {

        $httpResponse = $client->request('GET', $csvRow[0]);

        if ($httpResponse->getStatusCode() >= 400) {
            throw new \Exception();
        }
        
    } catch (\Exception $e) {
            
        $log->warning("This an error response: ".$csvRow[0].PHP_EOL);

    }
}
