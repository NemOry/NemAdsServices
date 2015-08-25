<?php

require_once("../initialize.php");

$message = "";

if(isset($_POST['object']))
{
  $id = $_POST["id"];

  if($_POST['object'] == "user")
  {
    User::delete($id);
    $message = "success"; 
  }
  else if($_POST['object'] == "advertisement")
  {
    Advertisement::delete($id);
    $message = "success"; 
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