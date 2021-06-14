<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
    <title>KWH DDIR DSA Management System</title>
    
    <!--initialize login session-->
    <?php 
     session_start();
    include('inc/header.php');
    $loginError = '';
      if (!empty($_POST['username']) && !empty($_POST['pwd'])) {
	      include 'function.php';
	      $inventory = new Inventory();
	      $login = $inventory->login($_POST['userid'], $_POST['pwd']); 
	    if(!empty($login)) {
		    $_SESSION['username'] = $login[0]['username'];
		    $_SESSION['name'] = $login[0]['name'];			
		    header("Location:index.php");
	    } else {
		      $loginError = "Invalid username or password!";
	    }
    }
    ?>
    
  </head>
  
  <body>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
    <?php include('inc/container.php');?>
    <div class="container">		
	    <h2>KWH DDIR DSA Management System</h2>	
	    <div class="login-form pull-left">		
		    <h4>User Login:</h4>		
		    <form method="post" action="">
			    <div class="form-group">
			    <?php if ($loginError ) { ?>
				      <div class="alert alert-warning"><?php echo $loginError; ?></div>
			      <?php } ?>
			      </div>
			    <div class="form-group">
				    <input type="text" id="userid" name="userid" class="form-control" placeholder="UserID" autofocus="" required>
			    </div>
			    <div class="form-group">
				    <input type="password" class="form-control" name="pwd" placeholder="Password" required>
			    </div>  
			    <div class="form-group">
				    <button type="submit" name="login" class="btn btn-info">Login</button>
			    </div>
			    <p><b>User</b> : admin<br><b>Password</b> : 123</p>	
		    </form>
		    <br>
	      </div>		
      </div>	
    
    <?php include('inc/footer.php');?>
  </body>

</html>
