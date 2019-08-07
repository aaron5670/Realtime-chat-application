
# REST API Server

This REST API server is created with the PHP framework CodeIgniter 3.
It is made for future projects that want to use a (Plug & play) REST API.

*********
### This REST API Server uses the following libraries
*********

-  [Ion Auth](http://github.com/benedmunds/CodeIgniter-Ion-Auth "Ion Auth")
-  [CodeIgniter Rest Controller](https://github.com/chriskacerguis/codeigniter-restserver "CodeIgniter Rest Controller")
-   Format class (author: @softwarespot)
-   API Auth (author: Aaron van den Berg)

*********
### Installation
*********

1. Insert SQL/rest_api_db-structure.sql
2. Insert SQL/rest_api_db-data.sql
3. Edit config settings: application/config/config.php
4. Edit config settings: application/config/database.php
5. Edit config settings: application/config/email.php (NOT NECESSARY)
6. Edit config settings: application/config/ion_auth.php
7. Edit config settings: application/config/rest.php

*********
### Code examples
*********

##### CURL GET METHOD
```php
<?php
// API key
$apiKey = 'GENERATED_API_KEY';

// API auth credentials
$apiUser = "user@email.com";     // user email
$apiPass = "password1";          // user password

// Specify the ID of the product
$productID = 1;

// API URL
$url = 'https://website-url.com/api/products/get/' . $productID;

// Create a new cURL resource
$ch = curl_init( $url );

curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "X-API-KEY: " . $apiKey ) );
curl_setopt( $ch, CURLOPT_USERPWD, "$apiUser:$apiPass" );

$result = curl_exec( $ch );

if ( curl_errno( $ch ) ) {
    print "Error: " . curl_error( $ch );
} else {
    // Show me the result
    $result = json_decode( $result, true );

    // Close cURL resource
    curl_close( $ch );

    echo '<pre>';
    print_r( $result );
    echo '</pre>';
}
```
------------
##### CURL POST METHOD
```php
<?php
// API key
$apiKey = 'GENERATED_API_KEY';

// API auth credentials
$apiUser = "user@email.com";     // user email
$apiPass = "password1";          // user password


// API URL
$url = 'https://website-url.com/api/products/post/';

// User account info
$userData = array(
    'title' => 'Wooden table',
    'desc'  => 'Nice wooden table.',
    'price' => '250',
    'tags'  => 'wood, tables',
    'image' => 'http://pngimg.com/uploads/table/table_PNG6977.png'
);

// Create a new cURL resource
$ch = curl_init( $url );

curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "X-API-KEY: " . $apiKey ) );
curl_setopt( $ch, CURLOPT_USERPWD, "$apiUser:$apiPass" );
curl_setopt( $ch, CURLOPT_POST, 1 );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $userData );

$result = curl_exec( $ch );

if ( curl_errno( $ch ) ) {
    print "Error: " . curl_error( $ch );
} else {
    // Show me the result
    $result = json_decode( $result, true );

    // Close cURL resource
    curl_close( $ch );

    echo '<pre>';
    print_r( $result );
    echo '</pre>';
}
```
