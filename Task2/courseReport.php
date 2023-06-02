<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table {
  border-collapse: collapse; /* Collapse the borders between table cells */
  border-spacing: 0; /* Remove spacing between table cells */
  width: 100%; /* Set the width of the table to 100% */
  border: 3px solid #ddd; /* Add a 3px solid border around the table */
}

th {
  text-align: left; /* Align the text inside table header cells to the left */
  padding: 8px; /* Add padding to the table header cells */
  color: blue; /* Set the text color to blue */
  background-color: lightblue; /* Set the background color of the table header cells to light blue */
  border-bottom: 3px solid #0c0c0c; /* Add a 3px solid border at the bottom of the table header cells */
  border-right: 3px solid #0b0a0a; /* Add a 3px solid border at the right of the table header cells */
  border-left: 3px solid #0b0a0a; /* Add a 3px solid border at the left of the table header cells */
  border-top: 3px solid #0b0a0a; /* Add a 3px solid border at the top of the table header cells */
}

td {
  text-align: left; /* Align the text inside table cells to the left */
  padding: 8px; /* Add padding to the table cells */
  color: black; /* Set the text color to black */
  background-color: lightgoldenrodyellow; /* Set the background color of the table cells to light goldenrod yellow */
  border-bottom: 3px solid #0c0c0c; /* Add a 3px solid border at the bottom of the table cells */
  border-right: 3px solid #0b0a0a; /* Add a 3px solid border at the right of the table cells */
  border-left: 3px solid #0b0a0a; /* Add a 3px solid border at the left of the table cells */
}

tr:nth-child(even) {
  background-color: #f2f2f2; /* Set the background color of even rows to light gray */
}

</style>
</head>
<body>

<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'internet_programming';

// Establish a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from the database and display in HTML table
$query = "SELECT * FROM coursedetails ORDER BY courseName ASC";
$result = mysqli_query($connection, $query);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Start creating the HTML table
    echo '<form method="post" action="generateReport.php">'; // Added the form  tag with action generatereport.php and method post

    echo '<table>';
    echo '<tr>';
    echo '<th><input type="checkbox" id="checkAll" onclick="toCheckAll()"></th>'; // first column contains checkbox
    echo '<th>Course Name</th>'; // course nmae as heading
    echo '<th>Overview</th>';// overview as heading
    echo '<th>Highlights</th>'; // highlights as heading
    echo '<th>Course Details</th>'; // course details as heading
    echo '<th>module1</th>';  // module1 as heading
    echo '<th>module1Credit</th>'; // module1 credit as heading
    echo '<th>module2</th>';  // module2 as heading
    echo '<th>module2Credit</th>'; // module2 credit as heading
    echo '<th>module3</th>';  // module3 as heading
    echo '<th>module3Credit</th>'; // module3 credit as heading
    echo '<th>Level</th>'; //level as heading
    echo '<th>Entry Requirement</th>'; // entry requirement as heading
    echo '<th>Fees(GBP)</th>'; // feesGBP as heading
    echo '<th>International Fees(GBP)</th>';// international feesGBP as heading
    echo '<th>Fees(EUR)</th>';// feesEUR as heading
    echo '<th>International Fees(EUR)</th>';// international feesEUR as heading
    echo '<th>Fees(USD)</th>';// feesUSD as heading
    echo '<th>International Fees(USD)</th>'; // international feesUSD as heading
    echo '</tr>';

    // Loop through the rows and display data in table cells
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td><input type="checkbox" name="checkedCourses[]" value="' . $row['id'] . '"></td>'; // add checkbox in the first column of every row
        echo '<td>' . $row['courseName'] . '</td>';  // get coursename value and display in coursename column
        echo '<td>' . $row['overview'] . '</td>';// get overview value and display in overview column
        echo '<td>' . $row['highlights'] . '</td>';  // get highlights value and display in highlights column
        echo '<td>' . $row['courseDetails'] . '</td>'; // get course details value and display in coursedetails column
        echo '<td>' . $row['module1'] . '</td>';// get module1 value and display in module1 column
        echo '<td>' . $row['module1Credit'] . '</td>'; // get module1 credit  value and display in module1 credit column
        echo '<td>' . $row['module2'] . '</td>';// get module2 value and display in module2 column
        echo '<td>' . $row['module2Credit'] . '</td>';  // get module2 credit  value and display in module1 credit column
        echo '<td>' . $row['module3'] . '</td>';// get module3 value and display in module2 column
        echo '<td>' . $row['module3Credit'] . '</td>';// get module3 credit  value and display in module1 credit column
        echo '<td>' . $row['level'] . '</td>';  // get level value and display in level column
        echo '<td>' . $row['entryRequirement'] . '</td>';  // get entry requirement value and display in entry requirement column
        echo '<td>' . $row['feesGBP'] . '</td>'; // get feesGBP value and display in feesGBP column
        echo '<td>' . $row['intfeesGBP'] . '</td>';  // get intfeesGBP value and display in international feesGBP column
        echo '<td>' . $row['feesEUR'] . '</td>';// get feesGEUR value and display in feesEUR column
        echo '<td>' . $row['intfeesEUR'] . '</td>';// get intfeesEUR value and display in international feesEUR column
        echo '<td>' . $row['feesUSD'] . '</td>';// get feesUSD value and display in feesUSD column
        echo '<td>' . $row['intfeesUSD'] . '</td>';// get intfeesUSD value and display in international feesGBP column
        echo '</tr>';
    }

    echo '</table>';

    //  JavaScript code for select-all checkbox functionality
   echo '<script>
   function toCheckAll() {
       
       var checkAllCheckbox = document.getElementById("checkAll");   // Get the "checkAll" checkbox element and store it in a variable

       
       var checkboxes = document.getElementsByName("checkedCourses[]");   // Get all checkboxes with the name "checkedCourses[]" and store it in a variable

       
       for (var i = 0; i < checkboxes.length; i++) {     
           // Set the checked state of each checkbox to match the "checkAll" checkbox
           checkboxes[i].checked = checkAllCheckbox.checked;
       }
   }
</script>'; 
    echo '<input type="submit" value="Generate Report">'; //  submit button inside the form
    echo '</form>'; // Added the form end tag
} else {
    echo 'No data found.';
}

// Close the database connection
mysqli_close($connection);
?>

</body></html>
