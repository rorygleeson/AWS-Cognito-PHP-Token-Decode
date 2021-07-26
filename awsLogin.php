<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$token = $_REQUEST['code'];
$url = 'https://yourwebapp.auth.us-west-2.amazoncognito.com/oauth2/token';
$grant_type = 'authorization_code';
$client_id = '7k9cruc8ok5fj0sh849pe8thth';
$redirect_uri = 'https://airwatch.io/awsLogin.php';



$data = array(
    'grant_type' => 'authorization_code',
    'client_id' => '7k9cruc8ok5fj0sh849pe8thth',
    'code' => $token,
    'redirect_uri' => 'https://airwatch.io/awsLogin.php'
);



$query = http_build_query($data);



$options = array(
    'http' => array(
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method'  => "POST",
        'content' => $query,
    ),
);


$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$result = json_decode($result, true);

// validate format of token. 

echo "Result Initial API request"; echo "<br />"; 
print_r($result); echo "<br />"; echo "<br />"; 
echo "Size of array"; echo "<br />"; 
$sizeOfArray = sizeof($result);
echo "Size of Array is "; echo $sizeOfArray; echo "<br />";echo "<br />";echo "<br />"; 

$idToken = $result['id_token'] ;
$accessToken = $result['access_token'] ;

// At this stage we should have a valid idToken and accessToken
// Decode the id token, its in JWT base64 encoded so decode here. 
$idTokenDecodedArray =  json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $idToken)[1]))),true);
$at_hash = $idTokenDecodedArray['at_hash'];
$sub = $idTokenDecodedArray['sub'];
$email_verified = $idTokenDecodedArray['email_verified'];
$iss = $idTokenDecodedArray['iss'];
//$cognito_username = $idTokenDecodedArray['cognito:username'];
$origin_jti = $idTokenDecodedArray['origin_jti'];
$aud = $idTokenDecodedArray['aud'];
$token_use = $idTokenDecodedArray['token_use'];
$auth_time = $idTokenDecodedArray['auth_time'];
$exp = $idTokenDecodedArray['exp'];
$iat = $idTokenDecodedArray['iat'];
$jti = $idTokenDecodedArray['jti'];
$email  = $idTokenDecodedArray['email'];



echo "at_hash.."; echo $at_hash; echo "<br />"; 
echo "sub.."; echo $sub; echo "<br />"; 
echo "email_verified.."; echo $email_verified; echo "<br />"; 
echo "iss.."; echo $iss; echo "<br />"; 
echo "origin_jti.."; echo $origin_jti; echo "<br />"; 
echo "aud.."; echo $aud; echo "<br />"; 
echo "token_use.."; echo $token_use; echo "<br />"; 
echo "auth_time.."; echo $auth_time; echo "<br />"; 
echo "exp.."; echo $exp; echo "<br />"; 
echo "iat.."; echo $iat; echo "<br />"; 
echo "jti.."; echo $jti; echo "<br />"; echo "<br />"; echo "<br />"; 
echo "email.."; echo $email; echo "<br />"; echo "<br />"; echo "<br />"; 

echo "Now login for "; echo $email; echo "<br />"; echo "<br />"; 
















?>
