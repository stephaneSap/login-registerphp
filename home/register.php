<?php include('db.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Register Form </title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>
<div class="register-form">
    <form action="register.php" method="post">
        <h2 class="text-center">Rgister</h2>
			<?php include('errors.php'); ?>
			<div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required="required"
             value="<?php echo $username; ?>">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required" value="<?php echo $email; ?>">
        </div>    
        <div class="form-group">
            <input type="password" class="form-control" name="password_1" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password_2" placeholder="Confirm password" required="required">
        </div>
		
		
		<div class="form-group">
  
  <input type="date"  name="code_of_birth" required="required" value="<?php echo $code_of_birth; ?>" >
  <label for="code_of_birth">Code_of_Birth:</label>
  </div>
  <p style="color:rgba(255,0,0,0.5);">	
			P.O. Box:<input type="text" name="code" value="<?php echo $code; ?>" size="5" maxlength="5">
			
			City:<input type="text" name="city"  value="<?php echo $city; ?>" size="15" maxlength="15"></p>
			 
		<div class="form-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<p  style="color:rgba(255,0,0,0.5);">
			Already a member? <a href="login.php">Login</a>
		</p>
    
	</form>
	</div>
  <style type="text/css">
    body {
        color: #fff;
        background: #383737;
    }
    .form-control {
        min-height: 41px;
        background: #fff;
        box-shadow: none !important;
        border-color: #e3e3e3;
    }
    .form-control:focus {
        border-color: #70c5c0;
    }
    .form-control, .btn {        
        border-radius: 2px;
    }
    .register-form {
        width: 350px;
        margin: 0 auto;
        padding: 200px 0 30px;      
    }
    .register-form form {
        color: #7a7a7a;
        border-radius: 2px;
        margin-bottom: 15px;
        font-size: 13px;
        background: #ececec;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;  
        position: relative; 
    }
    .register-form h2 {
        font-size: 22px;
        margin: 35px 0 25px;
    }
    .register-form .avatar {
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -50px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #70c5c0;
        padding: 15px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .register-form .avatar img {
        width: 100%;
    }   
    .register-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .register-form .btn {        
        font-size: 16px;
        font-weight: bold;
        background: #70c5c0;
        border: none;
        margin-bottom: 20px;
    }
    .register-form .btn:hover, .register-form .btn:focus {
        background: #50b8b3;
        outline: none !important;
    }    
    .register-form a {
        color: #fff;
        text-decoration: underline;
    }
    .register-form a:hover {
        text-decoration: none;
    }
    .register-form form a {
        color: #7a7a7a;
        text-decoration: none;
    }
    .register-form form a:hover {
        text-decoration: underline;
    }
</style>
</body>
</html>