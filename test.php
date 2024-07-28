<?php
require __DIR__ . '/vendor/autoload.php';

use NDD_send_connect\NDD_send_connect;


$client = new NDD_send_connect('apikey');

echo $client->get_url();
echo 'End Testing';
