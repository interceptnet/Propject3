TEAM 5 - Investment Recommendation App

Team Members:
	- Eyasu Asrat: Database
	- Kevin Barrett: API
	- Max Breyer: Javascript
	- Josh Carlson: HTML/CSS
	- Jeff McDonald: PHP/Database

How To Use:
	The app runs on localhost(User: root -- Password: root) using Apache and MySQL.

	The app starts on index.html. There you can create a username or log in with an existing account. No password is necessary since the app will be hosted locally.

	After logging in, you will see dataInput.php. If you have existing data, it will be displayed in a tabular form. To enter new data, use the form at the bottom of the page. To enter in multiple stocks or bonds, seperate the values with commas.

				Ticker			Shares
		EX: 	GOOG,AAPL		30,50

				Bond Name		Value
		EX:		Bond1,Bond2		1000,2000

	After selecting an investment strategy and clicking enter, the app will scrape the API (https://finance.yahoo.com/), pulling current stock prices, calculate totals for each category and fill in the CURRENT, TARGET and DIFFERENCE tables.

	The category with the largest skew is highlighted red to indicate the category you should invest in to approach your target.

	At the bottom, two pie charts will display your current and target distributions.

Features:
	- Portfolio data is stored and associated with a user
	- Login/Create Account
	- Add investment data
	- See data already stored for given user
	- API gathers current stock prices to calculate total value
	- App displays an investment recommendation based on current and target distributions

Future Features:
	- Make it easier to insert, update and delete data
	- Gather all pertinent data in order to calculate bond value internally
	- Develop portfolio dashboard to show current prices of owned stock
	- Log feature to show investment/transaction history
	- Password functionality if site is to be hosted on public server

Bug Log:
	- Fixed Income category doesn't always calculate total of bond values correctly
	- Pie charts move across the screen based on window size
	- Navigation used the "Update Data" buttom on portfolio.php doesn't carry the $_GET parameters to the dataInput.php page