<?php 

/* 
  BY NEMORY OLIVER MARTINEZ - nemoryoliver@gmail.com
*/

require_once("includes/initialize.php");

if(!$session->is_logged_in())
{
  header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

  <?php include_once("html/head.php"); ?>

    <div class="container">

      <h1><?php echo APP_TITLE; ?></h1>

      <div class="panel panel-default">
        <div class="panel-body">
          UserID: <span class="badge"><?php echo $session->userid; ?></span>
          <a href="logout.php" class="btn btn-danger pull-right">Logout</a></br></br>
          <?php include_once("grids/advertisements.php"); ?>
        </div>
      </div>

      <div class="alert alert-info">
        <b>Notes: </b>
        <ul>
          <li>Nem Ads Services Tutorial: <a href="http://nemoryoliver.com/nemory-ads-services-for-blackberry-10-developers-free/">http://nemoryoliver.com/nemory-ads-services-for-blackberry-10-developers-free/ </a></li>
          <li>Use your UserID: <b><?php echo $session->userid; ?></b> in the NemAdvertisement QML Component Property: <b>userid</b>.</li>
          <li>Background and Text Colors must be in <b>#XXXXXX Color Format</b></li>
          <li>Image URLs must be a direct link to the image</li>
          <li>Launch In: <b>Browser</b> - will open URLs in the browser app = http://, <b>BBWorld</b> - will open URLs in the BB World App = appworld://, <b>Message</b> - Will show the Text Property in a Dialog.</li>
        </ul>
      </div>

    </div>

    <?php include_once("html/foot.php"); ?>
    
  </body>
</html>