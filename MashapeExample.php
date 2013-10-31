<?php 

/*

Put this file on your server and call it as need to get data from YourMapper through one of Mashape's API.

A: Mashape Setup
1. Go to https://www.mashape.com/yourmapper browse our Mashape APIs
2. Sign up for a Mashape account.
3. Subscribe to one of the APIs (eg, YourMapper2: https://www.mashape.com/yourmapper/yourmapper2#!pricing )
4. Create a unique production key for the API you'd like to use: https://www.mashape.com/keys

Now you can use the code samples that Mashape provides at the top of each API endpoint (Curl Java Node PHP Python Objective-C Ruby .NET).

Or you can use this file we've created on your server.

B: Custom curl
1. Update places in this code marked with ***, including your production key
2. Put this file on your server and call it as need with parameters to get formatted data

*/

// *** Use your own Mashape prouction key from A4
$mashapekey = 'kKwDVqddEf2rroTE4hWzxkuKrLup4kGV'; // note this one is just made up and won't work

// A simple check to see if the file calling this is on your server
$ref = $_SERVER['HTTP_REFERER'];
if ($ref != '') {
    $refsplit = split('/',$ref);
    $domain = $refsplit[2];
} else {
    $domain='';
}

// *** Update with your dev and live domain names
if (($domain != 'dev.mydomain.com') and ($domain != 'www.mydomain.com') and ($domain != '')) {
    echo 'Please create your own server side feed using YourMapper's Mashape API. https://www.mashape.com/yourmapper';
    exit;
}

// *** get any query string parameters that the Mashape API requires, and pass them along
$id = $_GET['id']; 
$lat = $_GET['lat']; 
$lon = $_GET['lon']; 
$f = $_GET['f']; 

// *** create the call to the Mashape API and pass parameters along
$curlurl = 'https://crimescore.p.mashape.com/crimescore?f='.$f.'&id='.$id.'&lat='.$lat.'&lon='.$lon;

$ch = curl_init($curlurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Mashape-Authorization: '.$mashapekey
));
$response = curl_exec($ch);
curl_close($ch);

echo $response;
   
?>
