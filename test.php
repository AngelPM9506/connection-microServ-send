<?php
require __DIR__ . '/vendor/autoload.php';

use NDD_send_connect\NDD_send_connect;
use NDD_send_connect_php56\NDD_send_connect_php56;


$client = new NDD_send_connect('apikey', 'https://send.test81.app');


echo 'Testing 8.1';
echo "<br>";

echo $client->get_url();
echo "<br>";

echo 'End Testing 8.1';
echo "<br>";


$client = new NDD_send_connect_php56('apikey' , 'https://send.test56.app');

echo 'Testing 5.6';
echo "<br>";

echo $client->get_url();
echo "<br>";

echo 'End Testing 5.6';
echo "<br>";

