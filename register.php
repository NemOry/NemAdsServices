<?php 

/* 
  BY NEMORY OLIVER MARTINEZ - nemoryoliver@gmail.com
*/

require_once("includes/initialize.php");

if($session->is_logged_in())
{
  header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  
  <?php include_once("html/head.php"); ?>

    <div class="container">
      <div class="form-signin">
        <h3 class="form-signin-heading"><?php echo APP_TITLE; ?></h3>
        <h5 class="form-signin-heading">Create Account</h5>
        <input id="username" type="username" class="form-control" placeholder="username" required><br/>
        <input id="password" type="password" class="form-control" placeholder="password" required><br/>
        <button id="btnregister" class="btn btn-lg btn-primary btn-block">Register</button>

        <br/>Already have an account? <a href= "login.php" >Login Now!</a>

        <br/><br/><p class="muted credit">developed by <a href="http://nemoryoliver.com">Nemory Oliver Martinez</a> - <a href= "mailto: nemoryoliver@gmail.com" >nemoryoliver@gmail.com</a></p>
      </div>
    </div>

    <script>

    $("#btnregister").click(function()
    {
    	var theusername = $("#username").val();
	    var thepassword = $("#password").val();

	    if(theusername.length > 0 && thepassword.length > 0)
	    {
	    	$("#btnregister").prop("disabled", true);
	    	$("#btnregister").text("Registering...");

	    	$.post("includes/webservices/register.php", {username: theusername, password: thepassword}, function(response) 
	    	{
          console.log(response);

          var responseJSON = JSON.parse(response);

  				if(responseJSON.status == "okay")
  				{
  					window.location.href = "index.php";
  				}
  				else
  				{
  					alert(responseJSON.message);
  				}

  				$("#btnregister").prop("disabled", false);
  				$("#btnregister").text("Register");
  			});
	    }
	    else
    	{
    		alert("Please enter a username and a password.");
    	}
    });

    </script>

  </body>
</html>