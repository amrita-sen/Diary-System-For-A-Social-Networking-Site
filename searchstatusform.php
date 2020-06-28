<!-- This web page contains a form that accepts a status search string.-->
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/w3.css"> <!-- External CSS framework with support for desktop, tablet, and mobile design by default -->
	<link rel="stylesheet" type="text/css" href="style/custompagestyslesheet.css"> <!-- External CSS file -->
	<title>Search Status Form</title>
</head>
<body>
	<!-- Page heading -->
	<div class="w3-container w3-teal">
		<h1>Status Posting System</h1>
	</div>
	<!-- Navigation bar -->
	<div class="w3-bar w3-black">
		<a href="index.html" class="w3-bar-item w3-button w3-mobile">Home</a>
		<a href="poststatusform.php" class="w3-bar-item w3-button w3-mobile">Post a new status</a>
		<a href="searchstatusform.php" class="w3-bar-item w3-button w3-mobile w3-light-gray">Search status</a>
		<a href="about.html" class="w3-bar-item w3-button w3-mobile">About this assignment</a>
	</div>
	<!-- Form -->
	<div class="w3-container">
		<form action="searchstatusprocess.php" method="get">
			<label for="searchstatus"><br/>Status:</label> 
			<input type="search" name="searchstatus" title="Status description or keyword.">
			<br/><br/>
			<input type="submit" value="View Status"> 
		</form>
	</div>
	<br/><br/>
	<!-- Footer -->
	<footer class="w3-container w3-center">
		<p><a href="index.html">Return to Home Page</a></p>
	</footer>
</body>
</html>