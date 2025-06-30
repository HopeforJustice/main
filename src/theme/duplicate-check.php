<?php

require_once "donorfy.php";

$username = "James";
$currency = $_POST["Currency"];

if ($currency == "NOK") {
	$password = DONORFY_TOKEN_NORWAY;
	$tenant = "N2SOZ58ZN2";
} elseif ($currency == "AUD") {
	$password = DONORFY_TOKEN_AU;
	$tenant = "H63DOW9MT2";
} else {
	$password = DONORFY_TOKEN_UK;
	$tenant = "GO66X0NEL4";
}

$email = $_POST["Email"];
$URL =
	"https://data.donorfy.com/api/v1/" .
	$tenant .
	"/constituents/DuplicateCheckPerson";

$fields = [
	"EmailAddress" => $email,
];

$fields_string = http_build_query($fields);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
$result = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Decode the JSON result into an array
$data = json_decode($result, true);

// Prepare a new array to hold only the IDs
$ids = [];

// If $data is an array (of objects), loop through it directly
if (is_array($data)) {
	foreach ($data as $item) {
		if (isset($item["ConstituentId"])) {
			$ids[] = ["ConstituentId" => $item["ConstituentId"]];
		}
	}
}

// Return the sanitized array of objects
header("Content-Type: text/plain");
echo json_encode($ids);
