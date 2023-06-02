<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
        /* CSS styles for the table where the data from the database should be displayed*/
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 3px solid #ddd;
}
th {
  text-align: left;
  padding: 8px;
  color: blue;
  background-color: lightblue;
  border-bottom: 3px solid #0c0c0c;
    border-right: 3px solid #0b0a0a;
    border-left: 3px solid #0b0a0a;
    border-top: 3px solid #0b0a0a;
}

 td {
  text-align: left;
  padding: 8px;
  color: black;
  background-color: lightgoldenrodyellow;
  border-bottom: 3px solid #0c0c0c;
    border-right: 3px solid #0b0a0a;
    border-left: 3px solid #0b0a0a;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>



<?php
// Database connection parameters
$host = 'localhost';        // Hostname
$username = 'root';         // MySQL username
$password = '';             // MySQL password
$database = 'internet_programming';    // Database name  

// Establish a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted and deleteid patameter is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteId'])) {
    // Get the ID of the row to delete
    $id = $_POST['deleteId'];

    // save the query  to delete the row from the database into the query variable
    $query = "DELETE FROM coursedetails WHERE id = $id";
    $deleteResult = mysqli_query($connection, $query);  // mysqli_query is a function used to execute query which takes two parameters which are the database connection object and the query

    if ($deleteResult) {
        // Deletion successful
        echo "Row deleted successfully.";
    } else {
        // Deletion failed
        echo "Failed to delete the row.";
    }
}

// Retrieve data from the database and display in HTML table
$query = "SELECT * FROM coursedetails";
$result = mysqli_query($connection, $query);// execute the query

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Start creating the HTML table
    echo '<table>';
    echo '<tr>';
    echo '<th>Course Name</th>';  // Table header for Course Name column
    echo '<th>Overview</th>';       // Table header for overview
    echo '<th>Highlights</th>';  // Table header for highlights
    echo '<th>Course Details</th>';  // Table header for course details
    echo '<th>module1</th>';  // Table header for module1
    echo '<th>module1Credit</th>'; // Table header for module1 credit
    echo '<th>module2</th>';  // Table header for module 2
    echo '<th>module2Credit</th>'; // Table header for module2 credit
    echo '<th>module3</th>';   // Table header for module 3
    echo '<th>module3Credit</th>';   // Table header for module3 credit
    echo '<th>Level</th>';  // Table header for  level
    echo '<th>Entry Requirement</th>';  // Table header for entry requirements
    echo '<th>Fees(GBP)</th>';  // Table header for for fees in gbp
    echo '<th>International Fees(GBP)</th>'; // Table header for international fees in GBP
    echo '<th>Fees(EUR)</th>';   // Table header for fees in EUR
    echo '<th>International Fees(EUR)</th>';  // Table header for for international fees in EUR
    echo '<th>Fees(USD)</th>';   // Table header for fees in USD
    echo '<th>International Fees(USD)</th>';  // Table header for international fees in USD
    echo '<th>Action</th>';  // Table header for action which holds the delete button for deleting the row 
    echo '</tr>';

    // Loop through the rows and display data in table cells
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['courseName'] . '</td>';   //  add Table cell with Course Name value
        echo '<td>' . $row['overview'] . '</td>';  //  add Table cell with overview value
        echo '<td>' . $row['highlights'] . '</td>'; //  add Table cell with highlights value
        echo '<td>' . $row['courseDetails'] . '</td>';  //  add Table cell with coursedetails value
        echo '<td>' . $row['module1'] . '</td>';    //  add Table cell with module 1 value
        echo '<td>' . $row['module1Credit'] . '</td>';  //  add Table cell with module1 credit value
        echo '<td>' . $row['module2'] . '</td>';    //  add Table cell with module2 value
        echo '<td>' . $row['module2Credit'] . '</td>'; //  add Table cell with module 2 credit value
        echo '<td>' . $row['module3'] . '</td>';    //  add Table cell with module3 value
        echo '<td>' . $row['module3Credit'] . '</td>';  //  add Table cell with module3 credit value
        echo '<td>' . $row['level'] . '</td>';  //  add Table cell with level value
        echo '<td>' . $row['entryRequirement'] . '</td>'; //  add Table cell with entryrequirement value
        echo '<td>' . $row['feesGBP'] . '</td>'; //  add Table cell with with feesGBP value
        echo '<td>' . $row['intfeesGBP'] . '</td>'; //  add Table cell with intfeesGBP value
        echo '<td>' . $row['feesEUR'] . '</td>'; //  add Table cell with feesEUR value
        echo '<td>' . $row['intfeesEUR'] . '</td>';     //  add Table cell with intfeesEUR value
        echo '<td>' . $row['feesUSD'] . '</td>';    //  add Table cell with feesUSD value
        echo '<td>' . $row['intfeesUSD'] . '</td>'; //  add Table cell with intfeesUSD value
         // populate the last column of each row with the delete button for deleting the row and when the button is clicked value passed is the id of the course 
        echo '<td>                     
                <form method="post" action="">
                    <input type="hidden" name="deleteId" value="' . $row['id'] . '"> 
                    <button type="submit">Delete</button>
                </form>
            </td>';
        echo '</tr>';
    }

    // Close the table
    echo '</table>';
} else {
    echo 'No data found.';
}

// Close the database connection
mysqli_close($connection);
?>
</body></html>