<!-- Josh Carlson, Max Breyer -->
<!-- Web Tech team 5 -->

<!DOCTYPE HTML>

<html>
	<head>
		<title>Portfolio</title>
		
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>

	<?php
		// Gets total value of a certain stock owned by the user given the number of shares owned
		function getTotal($stockname, $numofshare) {
			// Retrieves the current stock price (f=l1)
			$s = file_get_contents("http://finance.yahoo.com/d/quotes.csv?s=$stockname&f=l1&e=.csv");

			// Converts data to array
            $data = explode(',', $s);

            // Price per share * number of shares
            $total = $data[0] * $numofshare;
            return $total;
		}

		// Returns a string of the category that the given stock symbol belongs to
		function getCategory($stockname) 
        {
        	// Gets the stock exchange associated with the given stockname (f=x)
            $se = file_get_contents("http://finance.yahoo.com/d/quotes.csv?s=$stockname&f=x&e=.csv");

            // Trim the string to manipulate the data
            $stockexchange = trim($se);
            
            // Gets the market cap value associated with the given stockname (f=j1)
            $mc = file_get_contents("http://finance.yahoo.com/d/quotes.csv?s=$stockname&f=j1&e=.csv");
            
            // Trim the string to manipulate the data
            $marketcap = trim($mc);

            $data1 = substr($marketcap,-1);

            // To determine small cap or large cap
            $numofbillions = substr($marketcap, 0, -1);

            // If market cap greater than 10 billion dollars, category is large cap
            if($data1 == "B" and $numofbillions > 10) {
            	$category = "Large Cap";
            }
            // Else small cap
            else {
            	$category = "Small Cap";
            }

            // Checks to see if the stock symbol is included in one of the two major US-based stock exchanges NYQ-New York Stock Exchange or NMS-Nasdaq stock exchange
	        if (strcmp($stockexchange, '"NYQ"') !== 0 and strcmp($stockexchange, '"NMS"') !== 0) {
	        	$category = "International";
	        }

	        return $category;
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

		$userID = $_GET["userID"];

		$strategy = $_GET["strategy"];
		$largeCap = 0.0;
		$smallCap = 0.0;
		$interCap = 0.0;
		$fixedIncome = 0.0;
		$cashInvest = 0.0;
		$other = 0.0;

		$stockQuery = "SELECT ticker,shares FROM Stocks WHERE user=$userID";
		$stockResult = mysql_query($stockQuery);
		$num_rows = mysql_num_rows($stockResult);
		for ($row_num = 0; $row_num < $num_rows; $row_num++) {
			$row = mysql_fetch_array($stockResult);
			$ticker = $row["ticker"];
			$shares = $row["shares"];

			// Scrape API to fill category values
			$cat = getCategory($ticker);

			if ($cat == "Large Cap") {
				$largeCap = $largeCap + getTotal($ticker, $shares);
			}
			if ($cat == "Small Cap") {
				$smallCap = $smallCap + getTotal($ticker, $shares);
			}
			if ($cat == "International") {
				$interCap = $interCap + getTotal($ticker, $shares);
			}
		}

		$bondQuery = "SELECT value FROM Bonds WHERE user=$userID";
		$bondResult = mysql_query($bondQuery);
		$num_rows = mysql_num_rows($bondResult);
		for ($row_num = 0; $row_num < $num_rows; $row_num++) {
			$row = mysql_fetch_array($bondResult);
			// Calculate Bond Value
			// Store Value in $fixedIncome
			$value = $row["value"];
			$fixedIncome = $fixedIncome + $value;
		}

		$cashQuery = "SELECT amount FROM Cash WHERE dateAdded=
						(SELECT MAX(dateAdded) FROM Cash)";
		$cashResult = mysql_query($cashQuery);
		$cashInvest = mysql_result($cashResult, 0);

		$total = $largeCap + $smallCap + $interCap
					+ $fixedIncome + $cashInvest + $other;
	?>



	<body id="top">


		<!-- Main -->

				<section id="banner">
					<div class="inner">
						<h2>Your Target Asset Allocation</h2>
						<p>Scroll down to view your personally-tailored financial suggestions.</p>

						<ul class="actions">
							<li><a href="index.html" class="button big special">Change Account</a></li>
							<li><br></li>
							<li><a href="dataInput.php#formAnchor" class="button big special">Update Data</a></li>
						</ul>
					</div>
				</section>

				<section>
					<div>
						<table>
							<tr>
								<td>Current stock prices pulled from <a href="http://finance.yahoo.com">Yahoo Finance</a>.</td>
							</tr>
							<tr>
								<td>Charles Schwab Investment Strategies found <a href="http://www.schwab.com/public/schwab/investing/retirement_and_planning/how_to_invest/investing_basics/plan_your_mix">here</a>.</td>
							</tr>
						</table>
					</div>
				</section>

				<!-- One -->
				<section id="one" class="wrapper style1">

					<div class="container">

                        <div class="row">

							<div class="3u">
								<section class="special box">

									<h3>Portfolio Composition</h3>
									<hr>
									<table>
										<tr><td>Large Cap Equity</td></tr>
										<tr><td>Small Cap Equity</td></tr>
										<tr><td>Intl. Equity</td></tr>
										<tr><td>Fixed Income</td></tr>
										<tr><td>Cash Invest</td></tr>
										<tr><td>Other</td></tr>
										<tr><td><hr></td></tr>
										<tr><td>TOTAL</td></tr>
									</table>
								</section>
							</div>
							<div class="3u">
								<section class="special box">

									<h3>	&#8291; &#8291; &#8291;  &#8291;  Current &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291;  </h3>
									<hr>
									<table>
										<tr>
											<td>$</td>
											<td id="largeCapA"></td>
											<td id="largeCapP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="smallCapA"></td>
											<td id="smallCapP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="interCapA"></td>
											<td id="interCapP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="fixedIncomeA"></td>
											<td id="fixedIncomeP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="cashInvestA"></td>
											<td id="cashInvestP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="otherA"></td>
											<td id="otherP"></td>
										</tr>
										<tr><td colspan=3><hr></td></tr>
										<tr>
											<td>$</td>
											<td id="totalA"></td>
											<td id="totalP"></td>
										</tr>
									</table>
								</section>
							</div>
							<div class="3u">
								<section class="special box">

									<h3>	&#8291; &#8291; &#8291;  &#8291; &#8291; Target  &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291;  </h3>
									<hr>
									<table>
										<tr>
											<td>$</td>
											<td id="targetLargeA"></td>
											<td id="targetLargeP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="targetSmallA"></td>
											<td id="targetSmallP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="targetInterA"></td>
											<td id="targetInterP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="targetFixedA"></td>
											<td id="targetFixedP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="targetCashA"></td>
											<td id="targetCashP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="targetOtherA"></td>
											<td id="targetOtherP"></td>
										</tr>
										<tr><td colspan=3><hr></td></tr>
										<tr>
											<td>$</td>
											<td id="targetTotalA"></td>
											<td id="targetTotalP"></td>
										</tr>
									</table>
								</section>
							</div>
							<div class="3u">
								<section class="special box">

									<h3>	&#8291; &#8291;  Difference  &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291; &#8291;  </h3>
									<hr>
                                    <table>
										<tr>
											<td>$</td>
											<td id="differenceLargeA"></td>
											<td id="differenceLargeP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="differenceSmallA"></td>
											<td id="differenceSmallP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="differenceInterA"></td>
											<td id="differenceInterP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="differenceFixedA"></td>
											<td id="differenceFixedP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="differenceCashA"></td>
											<td id="differenceCashP"></td>
										</tr>
										<tr>
											<td>$</td>
											<td id="differenceOtherA"></td>
											<td id="differenceOtherP"></td>
										</tr>
										<tr><td colspan=3><hr></td></tr>
										<tr>
											<td>$</td>
											<td id="differenceTotalA"></td>
											<td id="differenceTotalP"></td>
										</tr>
									</table>
								</section>
							</div>
						</div>
						<div>
							<section>
								<table>
									<tr><td colspan=6 style='font-weight:bold;'>Legend</td></tr>
									<tr><td style="color:#4286f4;font-weight:bold;">Large Cap</td>
										<td style="color:#41b2f4;font-weight:bold;">Small Cap</td>
										<td style="color:#cd42f7;font-weight:bold;">International</td>
										<td style="color:#5dc13c;font-weight:bold;">Fixed Income</td>
										<td style="color:#d62c2c;font-weight:bold;">Cash Investments</td>
										<td style="color:#adadad;font-weight:bold;">Other</td></tr>
								</table>
							</section>
						</div>
						<div>
							<section>
								<div class="center">
								<table>
									<tr><td>Current</td><td>Target</td></tr>
									<tr>
										<td><canvas id="piechart1" width="350px" height="350px">Your browser does not support the HTML5 canvas tag!</canvas></td>
	                            		<td><canvas id="piechart2" width="350px" height="350px">Your browser does not support the HTML5 canvas tag!</canvas></td>
	                            	</tr>
	                            </table>
	             			</div>
                        </div>
					</div>
				</section>
            	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

        	<script>
        		var strat = "<?php echo $strategy; ?>";

        		switch (strat) {
        			case "Short Term":
        				var stratLarge = 0;
        				var stratSmall = 0;
        				var stratInter = 0;
        				var stratFixed = 40;
        				var stratCash = 60;
        				var stratOther = 0;
        				var stratTotal = 100;
        				break;
        			case "Conservative":
        				var stratLarge = 15;
        				var stratSmall = 0;
        				var stratInter = 5;
        				var stratFixed = 50;
        				var stratCash = 30;
        				var stratOther = 0;
        				var stratTotal = 100;
        				break;
        			case "Moderate Conservative":
        				var stratLarge = 25;
        				var stratSmall = 5;
        				var stratInter = 10;
        				var stratFixed = 50;
        				var stratCash = 10;
        				var stratOther = 0;
        				var stratTotal = 100;
        				break;
        			case "Moderate":
        				var stratLarge = 35;
        				var stratSmall = 15;
        				var stratInter = 20;
        				var stratFixed = 35;
        				var stratCash = 5;
        				var stratOther = 0;
        				var stratTotal = 100;
        				break;
        			case "Moderate Aggressive":
        				var stratLarge = 45;
        				var stratSmall = 15;
        				var stratInter = 20;
        				var stratFixed = 15;
        				var stratCash = 5;
        				var stratOther = 0;
        				var stratTotal = 100;
        				break;
        			case "Aggressive":
        				var stratLarge = 50;
        				var stratSmall = 20;
        				var stratInter = 25;
        				var stratFixed = 0;
        				var stratCash = 5;
        				var stratOther = 0;
        				var stratTotal = 100;
        				break;
        		}

        		var large = <?php echo $largeCap; ?>;
        		var small = <?php echo $smallCap; ?>;
                var inter = <?php echo $interCap; ?>;
                var fixed = <?php echo $fixedIncome; ?>;
                var cash = <?php echo $cashInvest; ?>;
                var other = <?php echo $other; ?>;
                var total = <?php echo $total; ?>;

                // Current
                document.getElementById("largeCapA").innerHTML = large.toFixed(2);
                document.getElementById("largeCapP").innerHTML = ((large/total)*100).toPrecision(2) + "%";
                document.getElementById("smallCapA").innerHTML = small.toFixed(2);
                document.getElementById("smallCapP").innerHTML = ((small/total)*100).toPrecision(2) + "%";
                document.getElementById("interCapA").innerHTML = inter.toFixed(2);
                document.getElementById("interCapP").innerHTML = ((inter/total)*100).toPrecision(2) + "%";
                document.getElementById("fixedIncomeA").innerHTML = fixed.toFixed(2);
                document.getElementById("fixedIncomeP").innerHTML = ((fixed/total)*100).toPrecision(2) + "%";
                document.getElementById("cashInvestA").innerHTML = cash.toFixed(2);
                document.getElementById("cashInvestP").innerHTML = ((cash/total)*100).toPrecision(2) + "%";
                document.getElementById("otherA").innerHTML = other.toFixed(2);
                document.getElementById("otherP").innerHTML = ((other/total)*100).toPrecision(2) + "%";
                document.getElementById("totalA").innerHTML = total.toFixed(2);
                document.getElementById("totalP").innerHTML = ((total/total)*100)+ "%";

                // Target
                document.getElementById("targetLargeA").innerHTML = (total*(stratLarge / 100)).toFixed(2);
                document.getElementById("targetLargeP").innerHTML = stratLarge + "%";
                document.getElementById("targetSmallA").innerHTML = (total*(stratSmall / 100)).toFixed(2);
                document.getElementById("targetSmallP").innerHTML = stratSmall + "%";
                document.getElementById("targetInterA").innerHTML = (total*(stratInter / 100)).toFixed(2);
                document.getElementById("targetInterP").innerHTML = stratInter + "%";
                document.getElementById("targetFixedA").innerHTML = (total*(stratFixed / 100)).toFixed(2);
                document.getElementById("targetFixedP").innerHTML = stratFixed + "%";
                document.getElementById("targetCashA").innerHTML = (total*(stratCash / 100)).toFixed(2);
                document.getElementById("targetCashP").innerHTML = stratCash + "%";
                document.getElementById("targetOtherA").innerHTML = (total*(stratOther / 100)).toFixed(2);
                document.getElementById("targetOtherP").innerHTML = stratOther + "%";
                document.getElementById("targetTotalA").innerHTML = (total*(stratTotal / 100)).toFixed(2);
                document.getElementById("targetTotalP").innerHTML = stratTotal + "%";

                // Difference
                document.getElementById("differenceLargeA").innerHTML = ((total *  (stratLarge / 100)) - large).toFixed(2);
                document.getElementById("differenceLargeP").innerHTML = (stratLarge - (large/total)*100).toPrecision(2) + "%";
                document.getElementById("differenceSmallA").innerHTML = ((total *  (stratSmall / 100)) - small).toFixed(2);
                document.getElementById("differenceSmallP").innerHTML = (stratSmall - (small/total)*100).toPrecision(2) + "%";
                document.getElementById("differenceInterA").innerHTML = ((total *  (stratInter / 100)) - inter).toFixed(2);
                document.getElementById("differenceInterP").innerHTML = (stratInter - (inter/total)*100).toPrecision(2) + "%";
                document.getElementById("differenceFixedA").innerHTML = ((total *  (stratFixed / 100)) - fixed).toFixed(2);
                document.getElementById("differenceFixedP").innerHTML = (stratFixed - (fixed/total)*100).toPrecision(2) + "%";
                document.getElementById("differenceCashA").innerHTML = ((total *  (stratCash  / 100)) - cash).toFixed(2);
                document.getElementById("differenceCashP").innerHTML = (stratCash - (cash/total)*100).toPrecision(2) + "%";
                document.getElementById("differenceOtherA").innerHTML = ((total *  (stratOther / 100)) - other).toFixed(2);
                document.getElementById("differenceOtherP").innerHTML = (stratOther - (other/total)*100).toPrecision(2) + "%";
                document.getElementById("differenceTotalA").innerHTML = total.toFixed(2);
                document.getElementById("differenceTotalP").innerHTML = stratTotal + "%";

                // Find make value to make recommendation
                var diffLarge = ((total *  (stratLarge / 100)) - large).toFixed(2);
                var diffSmall = ((total *  (stratSmall / 100)) - small).toFixed(2);
                var diffInter = ((total *  (stratInter / 100)) - inter).toFixed(2);
                var diffFixed = ((total *  (stratFixed / 100)) - fixed).toFixed(2);
                var diffCash = ((total *  (stratCash  / 100)) - cash).toFixed(2);
                var diffOther = ((total *  (stratOther / 100)) - other).toFixed(2);
                var differences = [diffLarge, diffSmall, diffInter, diffFixed, diffCash, diffOther];

                var max = differences[0];
			    var maxIndex = 0;

			    for (var i = 1; i < differences.length; i++) {
			        if (parseInt(differences[i]) > parseInt(max)) {
			            maxIndex = i;
			            max = differences[i];
			        }
			    }
			    switch(maxIndex) {
			    	case 0:
			    		document.getElementById("differenceLargeA").style.color = "red";
			    		document.getElementById("differenceLargeP").style.color = "red";
			    		break;
			    	case 1:
			    		document.getElementById("differenceSmallA").style.color = "red";
			    		document.getElementById("differenceSmallP").style.color = "red";
			    		break;
			    	case 2:
			    		document.getElementById("differenceInterA").style.color = "red";
			    		document.getElementById("differenceInterP").style.color = "red";
			    		break;
			    	case 3:
			    		document.getElementById("differenceFixedA").style.color = "red";
			    		document.getElementById("differenceFixedP").style.color = "red";
			    		break;
			    	case 4:
			    		document.getElementById("differenceCashA").style.color = "red";
			    		document.getElementById("differenceCashP").style.color = "red";
			    		break;
			    	case 5:
			    		document.getElementById("differenceOtherA").style.color = "red";
			    		document.getElementById("differenceOtherP").style.color = "red";
			    		break;
			    }

                /*PIE CHARTS
                /*adjust the values in data to set the pie wedge sizes
                  adjust the labels to rename the wedges*/
            	var pieLarge = (large/total)*360;
            	var pieSmall = (small/total)*360;
            	var pieInter = (inter/total)*360;
            	var pieFixed = (fixed/total)*360;
            	var pieCash = (cash/total)*360;
            	var pieOther = (other/total)*360;

                var data = [pieLarge, pieSmall, pieInter, pieFixed, pieCash, pieOther];
                
                var labels = ['Large Cap', 'Small Cap', 'International', 'Fixed Income', 'Cash Investments', 'Other'];
                var colors = ["#4286f4", "#41b2f4", "#cd42f7", "#5dc13c", "#d62c2c", "#adadad" ];

                function drawSegment(canvas, context, i)
                {
                    context.save();
                    var centerX = Math.floor(canvas.width / 2);
                    var centerY = Math.floor(canvas.height / 2);
                    radius = Math.floor(canvas.width / 2);

                    var startingAngle = degreesToRadians(sumTo(data, i));
                    var arcSize = degreesToRadians(data[i]);
                    var endingAngle = startingAngle + arcSize;

                    context.beginPath();
                    context.moveTo(centerX, centerY);
                    context.arc(centerX, centerY, radius,
                                startingAngle, endingAngle, false);
                    context.closePath();

                    context.fillStyle = colors[i];
                    context.fill();

                    context.restore();

                    // drawSegmentLabel(canvas, context, i);
                }
                function degreesToRadians(degrees)
                {
                    return (degrees * Math.PI) / 180;
                }
                function sumTo(a, i)
                {
                    var sum = 0;
                    for (var j = 0; j < i; j++) {
                        sum += a[j];
                    }
                    return sum;
                }
                function drawSegmentLabel(canvas, context, i)
                {
                    context.save();
                    var x = Math.floor(canvas.width / 2);
                    var y = Math.floor(canvas.height / 2);
                    var angle = degreesToRadians(sumTo(data, i));

                    context.translate(x, y);
                    context.rotate(angle);
                    var dx = Math.floor(canvas.width * 0.5) - 10;
                    var dy = Math.floor(canvas.height * 0.05);

                    context.textAlign = "right";
                    var fontSize = Math.floor(canvas.height / 25);
                    context.font = fontSize + "pt Helvetica";

                    context.fillText(labels[i], dx, dy);

                    context.restore();
                }

                canvas = document.getElementById("piechart1");
                var context = canvas.getContext("2d");
                for (var i = 0; i < data.length; i++)
                {
                    drawSegment(canvas, context, i);
                }

                data = [(stratLarge/100)*360, (stratSmall/100)*360, (stratInter/100)*360, (stratFixed/100)*360, (stratCash/100)*360, (stratOther/100)*360];

                canvas = document.getElementById("piechart2");
                var context = canvas.getContext("2d");
                for (var i = 0; i < data.length; i++) {
                    drawSegment(canvas, context, i);
                }
        	</script>


	</body>
</html>