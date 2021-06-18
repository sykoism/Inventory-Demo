    <!--initialize login session-->
    <?php 
     session_start();
    include('inc/header.php');
    $loginError = '';
      if (!empty($_POST['userid']) && !empty($_POST['pwd'])) {
	      include 'function.php';
	      $inventory = new Inventory();
	      $login = $inventory->login($_POST['userid'], $_POST['pwd']); 
	    if(!empty($login)) {
		    $_SESSION['username'] = $login[0]['username'];
		    $_SESSION['userid'] = $login[0]['userid'];			
		    header("Location:index.php");
	    } else {
		      $loginError = "Invalid username or password!";
	    }
    }
    ?>

<!--include custom stylesheet-->
<link href="css/style.css" rel="stylesheet">

<?php include('inc/container_login.php');?>
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
