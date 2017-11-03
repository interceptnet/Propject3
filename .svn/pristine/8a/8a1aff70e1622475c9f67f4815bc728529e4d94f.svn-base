<?php
	session_start();

	// Load Data into MySql
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
	$strategy = $_POST["strategies"];

	$userIdQuery = "SELECT userID FROM Users WHERE userName=\"$username\"";
	$userIdResult = mysql_query($userIdQuery);
	$userID = mysql_result($userIdResult, 0);

	// Stocks
	if (isset($_POST["stockTicker"]) &&
		isset($_POST["stockCount"]))
	{
		$stockTicker = $_POST["stockTicker"];
		$stockCount = $_POST["stockCount"];

		$tickers = explode(',', $stockTicker);
		$tickerStr = "";
		foreach ($tickers as $symbol) {
			$tickerStr = $tickerStr . "\"" . $symbol . "\"" . ',';
		}
		$tickerStr = rtrim($tickerStr, ',');
		$counts = explode(',', $stockCount);

		// Remove old ticker info
		$updatequery = "DELETE FROM Stocks
						WHERE user = $userID
						AND ticker IN ($tickerStr)";
		if (mysql_query($updatequery)) {
			// echo "Updated Stocks Table!";
		}
		else {
			// echo "Error Updating Stocks Table!";
		}

		// Insert new ticker info
		$stockQuery = "INSERT INTO Stocks(user,ticker,shares)
						VALUES";
		for ($i = 0; $i < count($tickers); $i++) {
			$stockQuery = $stockQuery . "($userID, \"$tickers[$i]\", \"$counts[$i]\"),";
		}
		$stockQuery = rtrim($stockQuery, ',');

		if (mysql_query($stockQuery)) { }
		else {
			// echo "Error Adding Stock Data!";
		}
	}

	// Bonds
	if (isset($_POST["bondValue"]))
	{
		$bondName = $_POST["bondName"];
		$bondValue = $_POST["bondValue"];
		// $bondYield = $_POST["bondYield"];

		$names = explode(',', $bondName);
		$nameStr = "";
		foreach ($names as $name) {
			$nameStr = $nameStr . "\"" . $name . "\"" . ',';
		}
		$nameStr = rtrim($nameStr, ',');
		$values = explode(',', $bondValue);
		// $yields = explode(',', $bondYield);

		// Remove old bond info
		$updatequery = "DELETE FROM Bonds
						WHERE user = $userID
						AND bond IN ($bondStr)";
		if (mysql_query($updatequery)) {
			// echo "Updated Bonds Table!";
		}
		else {
			// echo "Error Updating Bonds Table!";
		}

		$bondQuery = "INSERT INTO Bonds(user,bond,value)
						VALUES";
		for ($i = 0; $i < count($values); $i++) {
			$bondQuery = $bondQuery . "($userID, \"$names[$i]\", $values[$i]),";
		}
		$bondQuery = rtrim($bondQuery, ',');

		if (mysql_query($bondQuery)) {
			// echo "Bond Data Added!";
		}
		else {
			// echo "Error Adding Bond Data!";
		}
	}

	// Cash Investments
	if (isset($_POST["otherMoney"])) {
		$otherMoney = $_POST["otherMoney"];

		$cashQuery = "INSERT INTO Cash(user,amount)
						VALUES($userID, $otherMoney)";

		if (mysql_query($cashQuery)) {
			// echo "Cash Investment Added!";
		}
		else {
			// echo "Error Adding Cash Investment Data!";
		}
	}

	header("Location: portfolio.php?userID=".urlencode($userID)."&strategy=".urlencode($strategy));
?>