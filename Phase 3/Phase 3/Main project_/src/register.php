<?php
	session_start();

	// Registration
	if (isset($_POST["newusername"]))
	{
		$db = mysql_connect('localhost','root','root');
		if (!$db) {
			print "Error - Could not connect MySQL";
			exit;
		}
		$er = mysql_select_db('FinancialControl');
		if (!$er) {
			print "Error - Could not select the FinancialControl database";
			exit;
		}
		
		$username = $_POST["newusername"];
		// $password = $_POST["newpwd"];

		$query = "SELECT * FROM Users WHERE userName=\"$username\"";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		if ($num_rows < 1) {
			$query1 = "INSERT INTO Users(userName)
						VALUES(\"$username\")";
			if (mysql_query($query1)) {
				echo "Account creation successful! " .
					"<a href=\"index.html\">Go to Login</a>";
			}
			else {
				echo "Error creating account!";
			}
		}
		else {
			echo "Username already exists! " .
				"<a href=\"index.html\">Try Again?</a>";
		}
	}
?>