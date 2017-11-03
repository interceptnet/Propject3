<!-- Josh Carlson -->
<!-- Web Tech team 5 -->

<?php
	session_start();

	function displayStocks($num_rows, $result) {
		print "<tr>";
			print "<td colspan=3 style='font-weight:bold;font-size:1.2em'>Stocks</td>";
		print "</tr>";
		print "<tr>";
			print "<td style='font-weight:bold;'>Stock</td>";
			print "<td style='font-weight:bold;'>Shares</td>";
			print "<td style='font-weight:bold;'>Last Updated</td>";
		print "</tr>";
		for ($row_num = 0; $row_num < $num_rows; $row_num++) {
			$row = mysql_fetch_array($result);
			print "<tr>";
				print "<td>";
					print htmlspecialchars($row["ticker"]);
				print "</td>";
				print "<td>";
					print htmlspecialchars($row["shares"]);
				print "</td>";
				print "<td>";
					print htmlspecialchars($row["dateAdded"]);
				print "</td>";
			print "</tr>";
		}
	}
	function displayBonds($num_rows, $result) {
		print "<tr>";
			print "<td colspan=3 style='font-weight:bold;font-size:1.2em'>Bonds</td>";
		print "</tr>";
		print "<tr>";
			print "<td style='font-weight:bold;'>Bond</td>";
			print "<td style='font-weight:bold;'>Value</td>";
			print "<td style='font-weight:bold;'>Last Updated</td>";
		print "</tr>";
		for ($row_num = 0; $row_num < $num_rows; $row_num++) {
			$row = mysql_fetch_array($result);
			print "<tr>";
				print "<td>";
					print htmlspecialchars($row["bond"]);
				print "</td>";
				print "<td>";
					print htmlspecialchars($row["value"]);
				print "</td>";
				print "<td>";
					print htmlspecialchars($row["dateAdded"]);
				print "</td>";
			print "</tr>";
		}
	}
	function displayCash($num_rows, $result) {
		print "<tr>";
			print "<td colspan=3 style='font-weight:bold;font-size:1.2em'>Cash Investment Total</td>";
		print "</tr>";
		print "<tr>";
			// print "<td></td>";
			print "<td colspan=2 style='font-weight:bold;'>Total</td>";
			print "<td style='font-weight:bold;'>Last Updated</td>";
		print "</tr>";
		for ($row_num = 0; $row_num < $num_rows; $row_num++) {
			$row = mysql_fetch_array($result);
			print "<tr>";
				// print "<td></td>";
				print "<td colspan=2>";
					print htmlspecialchars($row["amount"]);
				print "</td>";
				print "<td>";
					print htmlspecialchars($row["dateAdded"]);
				print "</td>";
			print "</tr>";
		}
	}


	$db = mysql_connect('localhost','root','root');
	if (!$db) {
		print "Error - Could not connect MySQL";
		exit;
	}
	$er = mysql_select_db('FinancialControl');
	if (!$er) {
		print "Error - Could not select the FinancialControl database";
	}
	$username = $_GET["username"];

	// Query to show all user's stock info
	$queryStock = "SELECT ticker, shares, dateAdded
					FROM Stocks AS s
					JOIN Users AS u ON s.user = u.userID
					WHERE userName = \"$username\"";
	$resultStock = mysql_query($queryStock);
	$stock_num_rows = mysql_num_rows($resultStock);

	// Query to show all user's bond info
	$queryBond = "SELECT bond, value, dateAdded
					FROM Bonds AS b
					JOIN Users AS u ON b.user = u.userID
					WHERE userName = \"$username\"";
	$resultBond = mysql_query($queryBond);
	$bond_num_rows = mysql_num_rows($resultBond);

	// Query to show Cash Investment total
	$queryCash = "SELECT amount, dateAdded
					FROM Cash AS c
					JOIN Users AS u ON c.user = u.userID
					WHERE userName = \"$username\"";
	$resultCash = mysql_query($queryCash);
	$cash_num_rows = mysql_num_rows($resultCash);
?>

<html>
	<head>
		<title>Financial Control</title>
		
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/addTextbox.js"></script>
		<script type="text/javascript" src="dataload.js"></script>
		
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>



	<body id="top">
	
	<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h2>Enter Your Data</h2>
					<ul class="actions">
							<li><a href="index.html" class="button big special">Change Account</a></li>
					</ul>
				</div>
			</section>

		<br>
		
		<table class="box">
			<?php
				displayStocks($stock_num_rows, $resultStock);
				displayBonds($bond_num_rows, $resultBond);
				displayCash($cash_num_rows, $resultCash);
			?>
		</table>

		<br><hr><br>
		
		<a name="formAnchor"></a>
		<section id="main" class="wrapper style1">
			
			
		
		
			<header class="major">
				<h3>Manually Enter Your Data:</h3>
				<h4>To input multiple items for one category, separate Ticker and Count by commas respectively.</h4>
				<form method="post" action="dataload.php" name="DataForm">
					<table>
						<tr>
							<td></td>
							<td colspan="3"><input type="text" name="username" id="username" readonly>
								<script>document.getElementById("username").value = getURLParameter("username");</script>
							</td>
						<tr>
							<td class="override">Stocks:</td>
							<td colspan="3"><input type="text" name="stockTicker" id="stockTicker" placeholder="Ticker" ></td>			
							<td colspan="3"><input type="text" name="stockCount" id="stockCount" placeholder="Shares Owned" ></td>
						</tr>
						<tr>
							<td class="override">Bonds:</td>
							<td colspan="3"><input type="text" name="bondName" id="bondName" placeholder="Name of Bond" ></td>			
							<td colspan="3"><input type="text" name="bondValue" id="bondValue" placeholder="Bond Value" ></td>
							<!-- <td colspan="3"><input type="text" name="bondYield" id="bondYield" placeholder="Yield %"></td> -->
						</tr>
						<tr>
							<td class="override">Cash Investments / Other:</td>
							<td colspan="3"><input type="text" name="otherMoney" id="otherMoney" placeholder="$00.00" ></td>				
						</tr>
						
						<tr>
							<td class="override"> Investment Strategy:</td>
							<td>
							<select name="strategies">
							  <option value="Short Term">Short Term</option>
							  <option value="Conservative">Conservative</option>
							  <option value="Moderate Conservative">Moderate Conservative</option>
							  <option value="Moderate">Moderate</option>
							  <option value="Moderate Aggressive">Moderate Aggressive</option>
							  <option value="Aggressive">Aggressive</option>
							</select>
							</td>
						</tr>
						<tr> 
							<td> </td>
							<td> <input type="submit" class="button big special" value="Enter"></td> 
						</tr>
					</table>
				</form>	
					
					
					
					<br>
					
			</header>
		</section>