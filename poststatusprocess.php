<!-- 
	This web page checks the input data, writes the data to a database table and generates the
	corresponding HTML output in response to the user’s request. 
-->
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/w3.css"> <!-- External CSS framework with support for desktop, tablet, and mobile design by default -->
	<link rel="stylesheet" type="text/css" href="style/custompagestyslesheet.css"> <!-- External CSS file -->
	<title>Process Post Status</title>
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
	<!-- Form processing -->
	<div class="w3-container">
		<?php
			$host = " ";
			$user = " ";
			$password = " ";
			$dbName = " ";
			
			//Connect to a MySQL database server or display error message and end script if unable to connect.
			$dbConnection = @mysqli_connect($host,$user,$password)
					or die("	<p>Failed to connect to server!</p>
							</div>");
			
			//Use MySQL database or display error message and end script.
			@mysqli_select_db($dbConnection, $dbName)
					or die("	<p>Database not available!</p>
							</div>");
	
			/*Check if tables status, permission, and, status_permission exist in the database.
			  For each table, if the query is unable to be executed, display error message and end script.*/
			$table1Name = "status";		
			$sqlString1 = "SHOW TABLES LIKE '$table1Name';";		
			$queryResult1 = @mysqli_query($dbConnection, $sqlString1)
				or die("	<p>Unable to execute the query.</p>"
						. "  <p>Error code " . mysqli_errno($dbConnection)
						. ": " . mysqli_error($dbConnection). "</p>
						</div>");
			
			$table2Name = "permission";
			$sqlString2 = "SHOW TABLES LIKE '$table2Name';";		
			$queryResult2 = @mysqli_query($dbConnection, $sqlString2)
				or die("	<p>Unable to execute the query.</p>"
						. " <p>Error code " . mysqli_errno($dbConnection)
						. ": " . mysqli_error($dbConnection). "</p>
						</div>");
						
			$table3Name = "status_permission";
			$sqlString3 = "SHOW TABLES LIKE '$table3Name';";		
			$queryResult3 = @mysqli_query($dbConnection, $sqlString3)
				or die("	<p>Unable to execute the query.</p>"
						. " <p>Error code " . mysqli_errno($dbConnection)
						. ": " . mysqli_error($dbConnection). "</p>
						</div>");
			
			//Check if all 3 tables exist. If they do not exist, display error message.			  
			if(mysqli_num_rows($queryResult1) == 1 && mysqli_num_rows($queryResult2) == 1 && 
			   mysqli_num_rows($queryResult3) == 1)
			{ 
				//Check if form submission is correct. If incorrect, display error message.			 
				if($_SERVER['REQUEST_METHOD'] == 'POST')
				{		
					//Check if "status code" and "status" fields are not empty. If empty, display error message.
					if(!empty($_POST['code']) && !empty($_POST['status'])) 
					{		
					    $statusCodePattern = "/^[S]{1}[\d]{4}$/";				  	//Regex for status code validation.
						$statusPattern = "/^[a-zA-Z0-9\s,.!?]+$/"; 					//Regex for status validation.
						
						//Copy user input values for each field to a variable.
						$statusCode = $_POST['code'];								 
						$status = $_POST['status'];									 
						$share = $_POST['share'];									 
						$datePosted = $_POST['date'];								 
						$permissionType = $_POST['permission'];				 
						
						//Check if data for "status code" and "status" input string pattern are valid. If invalid, display error message.
						if(preg_match($statusCodePattern, $statusCode) && preg_match($statusPattern, $_POST['status']))
						{	
							$matches = array();											//Array to store number values in date input.
							$datePattern = "/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/";  //Regex for date validation.
							
							//Check if date field is not empty and that the format is valid and save the DD, MM, YYYY portions into $matches array.
							if (!empty($datePosted) && preg_match($datePattern, $datePosted, $matches))
							{
 								//Validate the date itself using checkdate function and display error message if invalid.
								if (checkdate($matches[2], $matches[3], $matches[1]))
								{														
									/*Check uniqueness of status code in the "status" table. If the query is unable to be executed, display 
									  error message and end script.*/
									$sqlQuery = "SELECT * FROM $table1Name WHERE status_code = '$statusCode'"; 									
									$retval = @mysqli_query($dbConnection, $sqlQuery)
											or die ("	<p>Unable to execute the query.</p>"
													. " <p>Error code " . mysqli_errno($dbConnection)
													. ": " . mysqli_error($dbConnection). "</p>
													</div>");
									
									//If input status code already exists in the database, display error message and end script.
									if(mysqli_num_rows($retval) != 0){
										die	("	<p>Unable to input data!</p>
												<p>The status code you have entered, already exists in the database.</p>
												<p>Please enter a different status code and try again.</p>
											</div>
											<br/><br/>
											<footer class=\"w3-container w3-center\">
												<p><a href=\"poststatusform.php\">Post a new status</a> | 
												   <a href=\"index.html\">Return to Home Page</a></p>
											</footer>");		
									}
									
									/*Insert data from first four fields in the "status" table. If unable to execute query, display 
									  error message and end script.*/ 
									$sqlQuery1 = "INSERT INTO $table1Name SET
														  status_Code = '".$statusCode."', 
														  status = '".$status."', 
														  share = '".$share."', 
														  date_posted = '".$datePosted."'";		
													  
									$retval1 = @mysqli_query($dbConnection, $sqlQuery1)
											or die ("	<p>Unable to insert data!</p>
														<p>Error code: " . mysqli_errno($dbConnection) 
														. ": " . mysqli_error($dbConnection). "</p>
													</div>");															
									
									/*Insert status code and permission_id of each of the selected permission type into the "status_permission". 
									  table using data from tables "status" and "permission". If unable to execute a query, display error message 
									  and end script.*/
									if(!empty($permissionType)){							//Check if permission type field is not empty
										foreach($permissionType as $selected)  				//Iterate through the array of selected options
										{   	
											//Insert data for each selection
											$sqlQuery2 = "INSERT INTO $table3Name (status_code, permission_id)		
														  SELECT status_code, permission_id
														  FROM $table1Name, $table2Name
														  WHERE status_code = '$statusCode' and 
																permission_id IN (SELECT permission_id FROM $table2Name WHERE permission_type = '$selected')";  
																
											$retval2 = @mysqli_query($dbConnection, $sqlQuery2)
													   or die("	<p>Could not enter \"permission type\"!</p>"
																. "<p>Error code " . mysqli_errno($dbConnection)
																. ": " . mysqli_error($dbConnection). "</p>
															</div>");				 
										}
									} else { 																
										//Set permission type as 'None selected' and insert data in the table.
										$sqlQuery2 = "INSERT INTO $table3Name (status_code, permission_id)	
													  SELECT status_code, permission_id
													  FROM $table1Name, $table2Name
													  WHERE status_code = '$statusCode' and 
															permission_id IN (SELECT permission_id FROM $table2Name WHERE permission_type = 'None selected')";          
										
										$retval2 = @mysqli_query($dbConnection, $sqlQuery2)
												   or die("	<p>Could not enter \"permission type\"!</p>"
															. "<p>Error code " . mysqli_errno($dbConnection)
															. ": " . mysqli_error($dbConnection). "</p>
														  </div>");		
									} 
									
									echo "	<p>A new status has been saved in the database successfully!</p>";	 //Display message if data is successfully entered.
								} else { 
									echo "	<p>The \"Date\" field has an invalid date. Please input a valid date and try again.</p>";
								}
							} else { 
								echo "	<p> \"Date\" is a mandatory field! Please input a valid date and try again.</p>"; 
							}
						} else { 
							echo "	<p>\"Status Code\" and \"Status\" information must be as per the requested format!<br/>
									   The \"Status Code\" must be 5 characters in length. It must start with an uppercase letter \"S\" 
									   followed by 4 numbers.<br/>
									   The \"Status\" can only contain letters and numbers and may include spaces, comma, full stop, 
									   exclamation mark and, question mark.</p>";
						}
					} else { 
						echo "	<p>The \"Status Code\", and \"Status\" fields are mandatory, and cannot be empty! 
								   Please input the information and try again.</p>";
					}
				} else {
					die ("	<p>The form submission method seems to be incorrect!</p>
						</div>");
				}					
			} else { 
				die ("	<p>One or more of the selected tables do not exist in the database!</p>
					</div>");
			}
												
			//Close connection to the MySQL database server
			mysqli_close($dbConnection); 
		?>
	</div>
	<br/><br/>
	<!-- Footer -->
	<footer class="w3-container w3-center">
		<p><a href="poststatusform.php">Post a new status</a> | 
		   <a href="index.html">Return to Home Page</a></p>
	</footer>
</body>
</html>