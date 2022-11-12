<?php

session_start();
$conn = mysqli_connect("localhost", "root", "root", "login_registration");

if (isset($_SESSION["user"]) && $_SESSION["user"]->is_verified)
{

	$user_id = $_SESSION["user"]->id;

	if (isset($_POST["toggle_tfa"]))
	{
		$is_tfa_enabled = $_POST["is_tfa_enabled"];

		$sql = "UPDATE users SET is_tfa_enabled = '$is_tfa_enabled' WHERE id = '$user_id'";
		mysqli_query($conn, $sql);

		echo "<p>Settings changed</p>";
	}

	$sql = "SELECT * FROM users WHERE id = '$user_id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_object($result);

	?>

	<form method="POST" action="index.php">
		<h1>Enable TFA</h1>

		<p>
			<input type="radio" name="is_tfa_enabled" value="1" <?php echo $row->is_tfa_enabled ? "checked" : ""; ?>> Yes
		</p>

		<p>
			<input type="radio" name="is_tfa_enabled" value="0" <?php echo !$row->is_tfa_enabled ? "checked" : ""; ?>> No
		</p>

		<input type="submit" name="toggle_tfa">
	</form>

	<a href="logout.php">
		Logout
	</a>

	<?php
}
else
{
	header("Location: login.php");
}
