<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Message: <input type="text" name="msg"></br>
  New Name (optional): <input type="text" name="nom"></br>
  <input type="submit" value="Send">
</form>
<?php
if (isset($_POST['msg'])) {
	if ($_POST['nom'] != "") {
		echo "Now known as \"".$_POST['nom']."\"</br>";
	}
	echo date("H:i:s")." - | ".$_POST['msg']."</br><hr>";
}

echo "</br></br>Initializing...</br>";

echo "Checking for new POST message...</br>";

if ($_POST['msg']) {
	echo "POST message located. Confirming population.</br>";
	$msg = $_POST['msg'];
}

$hookurl = "https://discord.com/api/webhooks/889847080930115584/IuaD1ab3OxJprI7JQMcrhY94ziQ-g4cnFxHL7ULqYTelnd202tTKMFLGEedEkt_esFrt";
echo "Webhook variable declared and populated</br>";
$nom = "Mirau-bot";
if (isset($_POST['nom'])) {
	$nom = $_POST['nom'];
}
$hookObject = json_encode(["content" => $msg, "username" => $nom ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
echo "hookObject variable declared and populated</br>";

$ch = curl_init();
echo "Curl Initialized as \$ch</br>";

curl_setopt_array( $ch, [
	CURLOPT_URL => $hookurl,
	CURLOPT_POST => true,
	CURLOPT_POSTFIELDS => $hookObject,
	CURLOPT_HTTPHEADER => [
		"Length" => strlen( $hookObject ),
		"Content-Type: application/json"
	]
]);

if (isset($_POST['msg'])) {
	echo curl_exec($ch);
	echo "Curl Exececuted Properly at ".date("H:i:s")."!";
}else{
	echo "No POST found. No message was sent upon loading this page.</br>";
}
?>