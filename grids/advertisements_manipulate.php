<?php

require_once("../includes/initialize.php");

global $session;

if($_POST['oper']=='add')
{
	$advertisement 			     = new Advertisement();
    $advertisement->userid       = $session->userid;
	$advertisement->image        = $_POST['image'];
    $advertisement->text         = $_POST['text'];
    $advertisement->url          = $_POST['url'];
    $advertisement->timer        = $_POST['timer'];
    $advertisement->launchin     = $_POST['launchin'];
    $advertisement->appname      = $_POST['appname'];
    $advertisement->appversion   = $_POST['appversion'];
    $advertisement->clicked      = $_POST['clicked'];
    $advertisement->bgcolor      = $_POST['bgcolor'];
    $advertisement->textcolor    = $_POST['textcolor'];
    $advertisement->create();
}
else if($_POST['oper']=='edit')
{
	$advertisement 			     = Advertisement::get_by_id($_POST['id']);
    $advertisement->userid       = $session->userid;
    $advertisement->image        = $_POST['image'];
    $advertisement->text         = $_POST['text'];
    $advertisement->url          = $_POST['url'];
    $advertisement->timer        = $_POST['timer'];
    $advertisement->launchin     = $_POST['launchin'];
    $advertisement->appname      = $_POST['appname'];
    $advertisement->appversion   = $_POST['appversion'];
    // $advertisement->clicked      = $_POST['clicked'];
    $advertisement->bgcolor      = $_POST['bgcolor'];
    $advertisement->textcolor    = $_POST['textcolor'];
    $advertisement->update();
}
else if($_POST['oper']=='del')
{
    $advertisement               = Advertisement::get_by_id($_POST['id']);
    $advertisement->delete();
}

?>