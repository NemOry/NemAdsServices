<?php

require_once("../initialize.php");

$message = "";

if(isset($_POST['object']))
{
	if($_POST['object'] == "user")
	{
		$username = $_POST["username"];
		$password = $_POST["password"];

		if(!User::username_exists($username))
		{
			$object         	= new User();
			$object->username 	= $_POST["username"];
			$object->password 	= $_POST["password"];
			$object->create();

			$message = "success";
		}
		else
		{
			$message = "The username ".$username." already exists. Please use a different one.";
		}
	}
	else
	{
		$message = "Object Specified Does Not Exists";
	}
}
else
{
	$message = "No Create Object Specified";
}

echo $message;

?>