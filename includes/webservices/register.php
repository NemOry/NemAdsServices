<?php

require_once("../initialize.php");

$response = new Response();

$username = $_POST["username"];
$password = $_POST["password"];

if(!User::username_exists($username))
{
	$user = new User();
	$user->username = $username;
	$user->password = $password;
	$user->create();

	if($user)
	{
		$response->status = "okay";
		$response->message = $user;

		$session->login($user);

		$advertisement 			     = new Advertisement();
	    $advertisement->userid       = $session->userid;
		$advertisement->image        = "http://imgur.com/vGmLqT9.png";
	    $advertisement->text         = "This will launch the browser";
	    $advertisement->url          = "http://m.facebook.com/nemoryoliver";
	    $advertisement->timer        = 10;
	    $advertisement->launchin     = "browser";
	    $advertisement->appname      = "My App Name";
	    $advertisement->appversion   = "1.0";
	    $advertisement->clicked      = "0";
	    $advertisement->bgcolor      = "#000000";
	    $advertisement->textcolor    = "#FFFFFF";
	    $advertisement->create();

	    $advertisement2 			     = new Advertisement();
	    $advertisement2->userid       = $session->userid;
		$advertisement2->image        = "http://imgur.com/vGmLqT9.png";
	    $advertisement2->text         = "This will launch the BlackBerry World App";
	    $advertisement2->url          = "appworld://content/47649895";
	    $advertisement2->timer        = 10;
	    $advertisement2->launchin     = "bbworld";
	    $advertisement2->appname      = "My App Name 2";
	    $advertisement2->appversion   = "1.0";
	    $advertisement2->clicked      = "0";
	    $advertisement2->bgcolor      = "#000000";
	    $advertisement2->textcolor    = "#FFFFFF";
	    $advertisement2->create();
	}
	else
	{
		$response->status = "bad";
		$response->message = "Username or Password is invalid.";
	}
}
else
{
	$response->status = "bad";
	$response->message = "Username already exists";
}

echo json_encode($response);

class Response
{
	public $status 	= "okay";
	public $message = "";
}

?>