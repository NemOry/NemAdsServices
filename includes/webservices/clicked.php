<?php

require_once("../initialize.php");

$message = "";

if(isset($_GET['id']))
{
  $advertisement = Advertisement::get_by_id($_GET['id']);
  $advertisement->clicked = $advertisement->clicked + 1;
  $advertisement->update();
}
else
{
  $message = "No Ad ID Specified";
}

echo $message;

?>