<?php
	session_start();

	// Login
	if (isset($_POST["username"])) {
		$db = mysql_connect('localhost','root','root');
		if (!$db) {
			print "Error - Could not connect MySQL";
			exit;
		}
		$er = mysql_select_db('FinancialControl');
		if (!$er) {
			print "Error - Could not select the FinancialControl database";
		}
		$username = $_POST["username"];
		// $password = $_POST["password"];

		$query = "SELECT * FROM Users WHERE userName=\"$username\"";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		if ($num_rows < 1) {
			echo "Invalid username? ".
				"<a href=\"index.html\">Try Again?</a>";
		}
		else {
			header("Location: dataInput.php?username=".urlencode($username));
		}
	}
?>