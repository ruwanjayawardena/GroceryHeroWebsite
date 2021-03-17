<?php
// Required if your environment does not handle autoloading
require 'vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC1fab5eadbb76fa78862625b6904ecbb2';
$token = '89c44f9c03768379189d44dd88302ae0';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$response = $client->messages->create(
    // the number you'd like to send the message to
    '+6590405836',
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+6582410007',
        // the body of the text message you'd like to send
        'body' => 'Here is Boreca.com - Tutor find serive Test Message'
    )
);
echo '<pre>';
print_r($response);
echo '</pre>';

//+17032159344