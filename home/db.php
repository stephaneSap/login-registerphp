<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$password    = "";
	$code_of_birth   = "";
	$city    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connectlogin_registration
	$conn = mysqli_connect('localhost', 'root', 'root', 'login_registration');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    $code_of_birth = mysqli_real_escape_string($conn, $_POST['code_of_birth']);
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);



    // form validation: ensure that the form is correctly filled
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }

    if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
    }
    if (empty($code_of_birth)) { array_push($errors, "code_of_birth is required"); }
    if (empty($code)) { array_push($errors, "code is required"); }
    if (empty($city)) { array_push($errors, "city is required"); }
   // register user if there are no errors in the form
    if (count($errors) == 0) {
      $password = md5($password_1);//encrypt the password before saving in the database
      $query = "INSERT INTO tbregister (username, email, password, code_of_birth, code, city) 
            VALUES('$username', '$email', '$password','$code_of_birth','$code','$city')";
      mysqli_query($conn, $query);

      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }

  }
  if (isset($_POST["reg_user"]))
  {
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $conn = mysqli_connect("localhost", "root", "root", "login_registration");
    
    $sql = "INSERT INTO users (email, phone, password, is_tfa_enabled, pin) VALUES ('$email', '$phone', '$password', 0, '')";
    mysqli_query($conn, $sql);

    header("Location: login.php");
  }

	// LOGIN USER

  session_start();

  require_once "vendor/autoload.php";
  use Twilio\Rest\Client;

  $sid = "";
  $token = "";

  if (isset($_POST["login_user"]))
  {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conn = mysqli_connect("localhost", "root", "root", "login_registration");
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    {
      $row = mysqli_fetch_object($result);
      if (password_verify($password, $row->password))
      {
        if ($row->is_tfa_enabled)
        {
          $row->is_verified = false;
          $_SESSION["user"] = $row;

          $pin = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
          
          $sql = "UPDATE users SET pin = '$pin'  WHERE id = '" . $row->id . "'";
          mysqli_query($conn, $sql);

          $client = new Client($sid, $token);
          $client->messages->create(
            $row->phone, array(
              "from" => "",
              "body" => "Your adnan-tech.com 2-factor authentication code is: ". $pin
            )
          );

          header("Location: enter-pin.php");
        }
        else
        {
          $row->is_verified = true;
          $_SESSION["user"] = $row;

          header("Location: index.php");
        }
      }
      else
      {
        echo "Wrong password";
      }
    }
    else
    {
      echo "Not exists";
    }
  }

?>

