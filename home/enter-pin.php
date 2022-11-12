<?php

	session_start();

	if (isset($_POST["enter_pin"]))
	{
		$pin = $_POST["pin"];
		$user_id = $_SESSION["user"]->id;

		$conn = mysqli_connect("localhost", "root", "root", "login_registration");
		
		$sql = "SELECT * FROM users WHERE id = '$user_id' AND pin = '$pin'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0)
		{
			$sql = "UPDATE users SET pin = '' WHERE id = '$user_id'";
			mysqli_query($conn, $sql);

			$_SESSION["user"]->is_verified = true;
			header("Location: index.php");
		}
		else
		{
			echo "Wrong pin";
		}
	}

?>

<form method="POST" action="enter-pin.php">
	<p>
		<input type="text" name="pin" placeholder="Enter Pin">
	</p>

	<input type="submit" name="enter_pin">
</form>