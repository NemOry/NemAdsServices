<?php

require_once("../initialize.php");

$message = "";

if(isset($_GET['object']) && isset($_GET['userid']))
{
	if($_GET['object'] == "advertisement")
	{
		$advertisements = Advertisement::get_all_by_userid($_GET['userid']);

		if(count($advertisements) > 0)
		{
			shuffle($advertisements);
			
			$message = json_encode($advertisements);
		}
		else
		{
			$message = "[]";
		}
	}
	else if($_GET['object'] == "user")
	{
		$users = User::get_all();

		if(count($users) > 0)
		{
			$string = "TOTAL: ".count($users)."<br/><br/>";

			foreach ($users as $user) 
			{
				$advertisements = Advertisement::get_all_by_userid($user->id);

				$string .= $user->username.": ".count($advertisements)."<br/>";
			}

			$message = $string;
		}
		else
		{
			$message = "[]";
		}
	}
	else
	{
		$message = "Object Specified Does Not Exists";
	}
}
else
{
	$message = "No Object / UserID Specified";
}

echo $message;

?>