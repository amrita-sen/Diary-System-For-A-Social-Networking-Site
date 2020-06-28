<!-- 
	This web page checks the status search string, reads the data from the status database table,
	searches for the occurrence of the status string in each status record and generates the
	corresponding HTML output in response to the user’s search request. 
-->
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/w3.css"> <!-- External CSS framework with support for desktop, tablet, and mobile design by default -->
	<link rel="stylesheet" type="text/css" href="style/custompagestyslesheet.css"> <!-- External CSS file -->
	<title>Search Status Result</title>
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
	<!-- Form processing -->
	<div class = "w3-container">
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
				if($_SERVER['REQUEST_METHOD'] == 'GET')
				{		
					//Check if "searchstatus" is not empty. If empty, display error message.
					if (!empty($_GET['searchstatus']))
					{
						$statusInput = $_GET['searchstatus'];	//Copy user input to variable.
						$pattern = "%$statusInput%";  			//Regex to search status that includes string input by user.
						$statusIndex = 0;						//Variable to store index number for each status displayed.
						
						/*Search all entries in table "status" where "status" is like regex $pattern.
						  If query is unable to be executed, display error message and end script.*/
						$query1 = "SELECT * FROM $table1Name WHERE status LIKE '$pattern';"; 				
						$resultSet1 = @mysqli_query($dbConnection, $query1)
							or die("	<p>Unable to execute the query.</p>"
								 . "	<p>Error code " . mysqli_errno($dbConnection)
								 . ": " . mysqli_error($dbConnection). "</p>
								</div>");
							
						//Check if entries with matching status exist in the table. If no matching entries found, display message.						  
						if(mysqli_num_rows($resultSet1) > 0){
							
							//Display page sub-heading
							echo "<h3><strong>Status Information:</strong></h3>";
							
							/*Retrieve all results from $resultSet1 and copy to variable $row1. If query is unable to be executed, display 
							  error message and end script.*/
							$row1 = @mysqli_fetch_row($resultSet1)
								or die("	<p>Unable to execute the query.</p>"
									 . "	<p>Error code " . mysqli_errno($dbConnection)
									 . ": " . mysqli_error($dbConnection). "</p>
									</div>");
						
							//Iterate through each row in $row1 and retrieve and copy value of each element to a variable.
							while ($row1){	
								$retrievedStatusCode = $row1[0];
								$retrievedStatus = $row1[1];
								$retrievedShare = $row1[2];
								$retrievedDatePosted = $row1[3];	
								$permissionArray = array();					
								$statusIndex++;						//Increment status index by 1 with each iteration.
								
								/*Search all entries in table "status_permission" where "status_code" matches the code retrieved from 
								  the "status" table. If query is unable to be executed, display error message and end script.*/
								$query2 = "SELECT * FROM $table3Name WHERE status_code LIKE '$retrievedStatusCode';"; 				
								$resultSet2 = @mysqli_query($dbConnection, $query2)
									or die("	<p>Unable to execute the query.</p>"
										 . "	<p>Error code " . mysqli_errno($dbConnection)
										 . ": " . mysqli_error($dbConnection). "</p>
										</div>");
								
								//Check if entries with matching status code exist in the "status_permission" table. 
								if(mysqli_num_rows($resultSet2) > 0)
								{
									/*Retrieve all results from $resultSet2 and copy to variable $row2.
									  If query is unable to be executed, display error message and end script.*/
									$row2 = @mysqli_fetch_row($resultSet2)
										or die("	<p>Unable to execute the query.</p>"
											. " <p>Error code " . mysqli_errno($dbConnection)
											. ": " . mysqli_error($dbConnection). "</p>
											</div>"); 
									
									//Iterate through each row in $row2 and retrieve and copy value of permission_id to a variable.
									while ($row2){
										$retrievedPermissionId = $row2[1];
										
										/*Search all entries in table "permission" where "permission_id" matches permission id retreived
										  from "status_permission" table. If query is unable to be executed, display error message and 
										  end script.*/
										$query3 = "SELECT * FROM $table2Name WHERE permission_id LIKE '$retrievedPermissionId';"; 						
										$resultSet3 = @mysqli_query($dbConnection, $query3)
											or die("	<p>Unable to execute the query.</p>"
													. " <p>Error code " . mysqli_errno($dbConnection)
													. ": " . mysqli_error($dbConnection). "</p>
													</div>"); 
										
										//Check if entries with matching permission_id exist in the table. If matching entries do not exist, display message.
										if(mysqli_num_rows($resultSet3) > 0)
										{
											/*Retrieve all results from $resultSet3 and copy to variable $row3. If query is unable to be executed, 
											  display error message and end script.*/
											$row3 = @mysqli_fetch_row($resultSet3)
												or die("	<p>Unable to execute the query.</p>"
													 . " <p>Error code " . mysqli_errno($dbConnection)
													 . ": " . mysqli_error($dbConnection). "</p>
													</div>"); 
											
											//Iterate through each row in $row3 and retrieve and copy value of permission types to an array variable.
											while ($row3){
												$permissionArray[] = $row3[1];	
												
												$row3 = @mysqli_fetch_row($resultSet3);							
											}
										} else {
											die ("	<p>No matching \"permission_id\" record found in the \"permission\" table!</p>
												</div>");
										}											
										
										$row2 = @mysqli_fetch_row($resultSet2);
									}
									
									//Format date and permission type information to display.
									$date = date_create($retrievedDatePosted);
									$newDateFormat = date_format($date, "F d, Y");
									
									/*Use implode function to join elements of $permissionArray with a string and save returning value 
									  to a variable.*/
									$permissionList = implode(', ', $permissionArray); 
									
									/*Dislay status information. If the number of records in $resultSet1 is more than 1, 
									  display a heading for each status.*/
									if(mysqli_num_rows($resultSet1) > 1){
										echo "<h5><strong>Record $statusIndex:</strong></h5>";
									}
									
									echo "	<p><strong>Status:</strong> $retrievedStatus<br/>
												<strong>Status Code:</strong> $retrievedStatusCode<br/><br/>
												<strong>Share:</strong> $retrievedShare<br/>
												<strong>Date Posted:</strong> $newDateFormat<br/>	
												<strong>Permission:</strong> $permissionList<br/><br/>
												<strong>*******************************************</strong><br/>
											</p>";						
								
									$row1 = @mysqli_fetch_row($resultSet1);		
								} else {
									die ("	<p>No matching \"status_code\" record found in the \"status_permission\" table!</p>
										 </div>");
								}
							}
							
							die ("</div>
								  <br/><br/>
								  <footer class=\"w3-container w3-center\">
									  <p><a href=\"searchstatusform.php\">Search for another status</a> | 
									     <a href=\"index.html\">Return to Home Page</a></p>
								  </footer>");
							
						} else {
							die ("	<p>No matching records found!</p>
							     </div>
								<br/><br/>
								<footer class=\"w3-container w3-center\">
									<p><a href=\"searchstatusform.php\">Search for another status</a> | 
									   <a href=\"index.html\">Return to Home Page</a></p>
								</footer>");
						}
					} else {
						echo "	<p>Please input a keyword to search for a status!</p>";
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
		<p><a href="searchstatusform.php">Search status</a> | 
		   <a href="index.html">Return to Home Page</a></p>
	</footer>
</body>
</html>