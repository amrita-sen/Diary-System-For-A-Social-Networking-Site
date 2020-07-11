# Diary-system-for-a-social-networking-site.
This web-based system allows users to post their status, save it to a database table, retrieve and view status details. Appropriate HTML, PHP, CSS files and Database
tables are created for this system. It has a responsive design and the web pages automatically resize, or enlarge, to look good on all devices (desktops, tablets, and phones).

Note: There are 3 tables created manually in the database. The program checks the existence of the tables and does not create them.</br></br>

<b>List of files in the system:</b>
******************************

<b>1.	index.html (Home Page)</b>

This is the home page of the system. It displays information of the author (student) and a disclaimer. It also has links to the other pages of the system.

<b>Screenshot:</b>

![image](https://user-images.githubusercontent.com/52112568/86736656-cebf8f80-c087-11ea-8783-39701df19343.png)
 
<br><b>2.	poststatusform.php (Post Status Page)</b>

This web page contains the form that enables a status to be submitted and saved. POST method for form submission is used and a link to return to the Home page is provided. The status data contains:

<b>•	Status Code:</b> (Text input type. NOT NULL, is unique). The code is 5 characters in length and starts with an uppercase letter “S” followed by 4 numbers.<br>
<b>•	Status:</b> (Text input type. NOT NULL). The status can only contain alphanumeric characters including spaces, comma, period (full stop), exclamation point and question mark. Other characters or symbols are not allowed.<br>
<b>•	Share:</b> (Radio button type, include 3 options: Public, Friends and Only Me (default))<br>
<b>•	Date:</b> (text/date input type. NOT NULL). It initially contains the current date in dd/mm/yyyy format. This can be edited by the user. PHP function date() is used to fetch server time.<br> 
<b>•	Permission Type:</b> (3 checkboxes, Allow Like, Allow Comments, Allow Share)

The user is informed using relevant messages when the status has been successfully been submitted or when input is invalid. Links to form and the Home page are provided with the message.

<b>Screenshots:</b>

![image](https://user-images.githubusercontent.com/52112568/86736772-e6971380-c087-11ea-93ac-2f0fcefdf324.png)
<br>
![image](https://user-images.githubusercontent.com/52112568/86736856-f4e52f80-c087-11ea-87f2-4334e608027f.png)

<br><b>3.	poststatusprocess.php (Process Post Status Page)</b>

This web page checks the input data, writes the data to a database table and generates the corresponding HTML output in response to the user’s request. 

Status Code and Status are mandatory fields. The program does not allow saving of status to the database table if any of these fields are not supplied or not valid, and if needed an error message is displayed to the user that includes links
to return to the Home page and Post Status page. The date is also validated to conform to the dd/mm/yyyy format. Furthermore, the Status Code is checked for its uniqueness within the database table.

A confirmation message is generated for a valid entry followed by a link to return to the Home page, once the status is stored successfully in the database.

<b>Screenshots:</b>

<b>On successful submission of a new status:</b>

![image](https://user-images.githubusercontent.com/52112568/86736941-04fd0f00-c088-11ea-9861-9a8ddb2eee31.png)

<b>Error messages for invalid input:</b>

![image](https://user-images.githubusercontent.com/52112568/86737109-2100b080-c088-11ea-9850-40843671082f.png)
<br>
![image](https://user-images.githubusercontent.com/52112568/86737158-2c53dc00-c088-11ea-8d8c-376f800d5bb2.png)
<br>
![image](https://user-images.githubusercontent.com/52112568/86737238-3d045200-c088-11ea-9fd1-b966fada6745.png)

<br><b>4.	searchstatusform.html (Search Status Page)</b>

This web page contains an input text field that accepts a status search string (the text description of the status) for searching the status information which already saved in the database table.

The GET method for form submission is used and a link to return to the Home page is provided.

<b>Screenshots:</b>

![image](https://user-images.githubusercontent.com/52112568/86737291-4988aa80-c088-11ea-8875-bcf70a0646c5.png)
<br>
![image](https://user-images.githubusercontent.com/52112568/86737358-56a59980-c088-11ea-8ddd-8c85dd632c4e.png)

<br><b>5.	searchstatusprocess.php (Search Status Result Page)</b>

This web page checks the status search string, reads the data from the status database table, searches for the occurrence of the status string in each status record and generates the
corresponding HTML output in response to the user’s search request.

The existence of the status database table is validated, and that the status search string is not empty. If either validation failed, a proper error message is displayed to the user that includes a link to return to the Home page
and Search Status page. All the status information records are searched based on keyword match. The details of requested status information are generated including links to return to the Home page and Search Status page if found. In cases where there are more than one status information located, all matches are listed.

If there is an error, an error message is generated that include links to return to the Home page and Search Status page.

<b>Screenshots:</b>

<b>When matching records are found:</b>

![image](https://user-images.githubusercontent.com/52112568/86737409-60c79800-c088-11ea-9300-5fed9d78deef.png)

<b>When matching records are not found:</b>

![image](https://user-images.githubusercontent.com/52112568/86741349-6a063400-c08b-11ea-8cba-7b4e6cc283de.png)

<b>When text field is empty at the time of submission:</b>

![image](https://user-images.githubusercontent.com/52112568/86741290-5eb30880-c08b-11ea-84bc-e2166e2a52ea.png)

<br><b>6.	about.html (About Page)</b>

This is a report webpage that presents what has been done for this system in a question-answer format and in an accordian display style. It also provides a link to return to the Home page.

<b>Screenshots:</b>

![image](https://user-images.githubusercontent.com/52112568/86737472-6cb35a00-c088-11ea-9f89-7058b12f69d6.png)
<br>
![image](https://user-images.githubusercontent.com/52112568/86737509-73da6800-c088-11ea-9095-660daf90cda5.png)

<br><b>7.	Two additional CSS files, including w3.css, to style the web pages. W3.CSS is a modern CSS framework with support for desktop, tablet, and mobile design by default.</b>

