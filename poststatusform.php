<!-- This web page contains the form that enables a status to be submitted and saved.-->
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/w3.css"> <!-- External CSS framework with support for desktop, tablet, and mobile design by default -->
	<link rel="stylesheet" type="text/css" href="style/custompagestyslesheet.css"> <!-- External CSS file -->
	<title>Post Status Form</title>
</head>
<body>
	<!-- Page heading -->
	<div class="w3-container w3-teal">
		<h1>Status Posting System</h1>
	</div>
	<!-- Navigation bar -->
	<div class="w3-bar w3-black">
		<a href="index.html" class="w3-bar-item w3-button w3-mobile">Home</a>
		<a href="poststatusform.php" class="w3-bar-item w3-button w3-mobile w3-light-gray">Post a new status</a>
		<a href="searchstatusform.php" class="w3-bar-item w3-button w3-mobile">Search status</a>
		<a href="about.html" class="w3-bar-item w3-button w3-mobile">About this assignment</a>
	</div> 
	<!-- Form -->
	<div class="w3-container">
		<form action="poststatusprocess.php" method="post">
			<br/>
			<!-- Status Code -->
			<label for="code">Status Code (required):</label>
			<input type="text" name="code" size="5"  
				   title="Status code must be 5 characters long and begin with a capital S followed by 4 numbers">
			<br/><br/>
			<!-- Status -->
			<label for="status">Status (required):</label>
			<input type="text" name="status"  
				   title="Status can only contain letters and numbers and may include, spaces, comma, full stop, 
						  exclamation mark, question mark.">	
			<br/><br/>
			<!-- Share -->
			<label for="share">Share:</label>
			<input type="radio" id="public" name="share" value="public">
			<label for="public">Public</label>
			<input type="radio" id="friends" name="share" value="friends">
			<label for="friends">Friends</label>
			<input type="radio" id="me" name="share" value="me" checked="checked">
			<label for="me">Only Me</label>  
			<br/><br/>			
			<!-- Date. Initially contains server date. -->
			<label for="date">Date:</label>
			<input type="date" id="date" name="date" value="<?php echo date('Y-m-d');?>">
			<br/><br/>			
			<!-- Permission Type -->
			<label for="permission[]">Permission Type:</label>
			<input type="checkbox" id="like" name="permission[]" value="allow like">
			<label for="like">Allow Like</label> 
			<input type="checkbox" id="comment" name="permission[]" value="allow comment">
			<label for="comment">Allow Comment</label> 
			<input type="checkbox" id="share" name="permission[]" value="allow share">
			<label for="share">Allow Share</label> 
			<br/><br/>
			<!-- Buttons -->
			<input type="submit" value="Post"> 
			<input type="reset" value="Reset"> 			
		</form>
	</div>
	<br/><br/>
	<!-- Footer -->
	<footer class="w3-container w3-center">
		<p><a href="index.html">Return to Home Page</a></p>
	</footer>
</body>
</html>