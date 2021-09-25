<?php

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\Thread\Member;
use Discord\WebSockets\Event;
use Discord\WebSockets\Intents;
use React\EventLoop\Factory;

require __DIR__ . '/vendor/autoload.php';


$loop = Factory::create();
#---------------------------------
$mysqli = new mysqli("localhost", "jim", "locke888", "testdb");
#---------------------------------
$discord = new Discord([
    'token' => 'ODg5OTM3MTcwNTUzNTM2NjIz.YUogkw.v1GewcyddV6TfFdT-MLgjWnf5GY',
    'loop' => $loop,
]);
#---------------------------------


$discord->on('ready', function ($discord) {
	echo "--- Mirau-bot is ready! ---", PHP_EOL;
});

$discord->on('message', function ($message, $discord) {
    $guild = $message->channel->guild;

    if (strtolower($message->content) == '!try') {
        $guild->members->fetch($message->author->id, true)->done(
            function ($member) use ($message) {
				$message->channel->sendMessage($member->__toString());
                echo var_dump($member->__toString());
				echo "Nickname:";
				echo var_dump($member->nick);
				echo "Actual username:";
				echo var_dump($message->author->username);
				echo "Snowflake ID:";
				echo var_dump($message->author->id);
            }
        );
    }
	
#--- Command to register Discord Account to the website Database ---
	if (strtolower($message->content) == '!register') {
		$guild->members->fetch($message->author->id, true)->done(
		function ($member) use ($message) {
			$nom = $message->author->username;
			$nic = $member->nick;
			$uid = $message->author->id; 
			echo "Name: ".$nom." | Nick: ".$nic." | ID: ".$uid, PHP_EOL;
			
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			global $mysqli;
			$sql = "SELECT uid, name FROM main ORDER BY id ASC";
			$result = $mysqli->query($sql);
			echo "Checking results for match...\n";
			$old = FALSE;
			foreach ($result as $row) {
				if ($row['uid'] == $uid){
					echo "User ID of (".$row['uid'].") already registered to: ".$row['name']."!", PHP_EOL;
					$message->channel->sendMessage("You're already registered ".$nom."!");
					$old = TRUE;
				}
			}
			if ($old === FALSE) {
				$sql = "INSERT INTO main (name, nick, uid) VALUES ('".$nom."', '".$nic."', '".$uid."')";
				$mysqli->query($sql);
				$message->channel->sendMessage("Account for ".$nom." has been successfully created!");
				echo "Account for ".$nom." added to database!", PHP_EOL;
			}
			
		});
	}
#--- Command to show your account statistics and other mumbo jumbo ---
	if (strtolower($message->content) == '!stats') {
		$guild->members->fetch($message->author->id, true)->done(
		function ($member) use ($message) {
			$uid = $message->author->id;
			echo "Fetching stats for user ID #".$uid, PHP_EOL;
			global $mysqli;
			$sql = "SELECT * FROM main WHERE uid=".$uid;
			$result = $mysqli->query($sql);
			echo "Checking results for match...\n";
			$old = FALSE;
			foreach ($result as $row) {
				if ($row['uid'] == $uid) {
					$message->channel->sendMessage("Name: ".$row['name'].", aka ".$row['nick']." with the UserID #".$row['uid']);
					echo "Match found for ".$row['name']." aka ".$row['nick']." who has the UID:".$row['uid'], PHP_EOL;
					$old = TRUE;
				}
			}
			if ($old === FALSE) {
				echo "No matches found. User not registered.", PHP_EOL;
			}
		
		});
	}

	
#--- Command to check if you included an e-mail ---
	if (strtolower($message->content) == '!mail') {
			$message->author->user->sendMessage('Test DM for ye');
			echo "DM sent to ", PHP_EOL;
	}
	
	
});
$discord->run();