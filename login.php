<?php

session_start();

	  $lg="";
	try{
		
		$con=new PDO("mysql:host=localhost;dbname=livestock","root","");
		
		if(isset($_POST['signup'])){
			$login=htmlspecialchars(trim($_POST['login']));
			$password=htmlspecialchars(trim($_POST['password']));
		$select=$con->prepare("SELECT login,password from 
			                        utilisateur WHERE login='$login' 
			                               and password='$password'");
		$select->setFetchMode(PDO::FETCH_ASSOC);
		$select->execute();
		$data=$select->fetch();
        
	 
	   if($data['login']==$login and
	                $data['password']==$password and 
	                           $login!="" and $password!="")
		{ 
		$_SESSION['login']=$data['login'];
	    $_SESSION['password']=$data['password'];
		
		  header("location:acceuil.php");	
		  
		}else {
			

            
      
			$lg=" Username or password incorrect";	
		}
		}
	}
	
	catch(PDOException $ex){
		echo"error".$ex->getMessage();
	}
	?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Login Page 2 | Creative - Bootstrap 3 Responsive Admin Template</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
</head>

<body  style="background-color:#8CB3C6" class="login-img3-body">

  <div class="container">

    <form class="login-form" method="post" action="">
	
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" class="form-control" name="login" placeholder="Username" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
			<p style="margin-top: 50px; margin-left: 0px; color: red;"><?php  echo $lg; ?></p>
        <button class="btn btn-primary btn-lg btn-block" name="signup" type="submit">Login</button>
      
      </div>
    </form>
	
	 <?php if(!empty($message)): ?>
					  <div class="alert alert success">
					  <?= $message; ?>
					  </div>
					  <?php endif;?>
    <div class="text-right">
      <div class="credits">
        </div>
    </div>
  </div>


</body>

</html>
