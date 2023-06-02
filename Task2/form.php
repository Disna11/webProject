<?php

// Database connection configuration
$host = 'localhost'; // Database host
$dbname = 'internet_programming'; // Database name
$user = 'root'; // Database username
$password = ''; // Database password

$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); // Create a new PDO instance for database connection

// Retrieve form data using $_POST
$courseName = $_POST['courseName']; // Retrieve Course Name and store in a variable
$overview = $_POST['overview']; // Retrieve Overview and store in a variable
$highlights = $_POST['highlights']; // Retrieve  Highlights and store in a variable
$courseDetails = $_POST['courseDetails']; // Retrieve Course Details and store in a variable
$module1 = $_POST['module1']; //  Retrieve Module 1 and store in a variable
$module1Credit = $_POST['module1Credit']; // Retrieve Credit of Module 1 and store in a variable
$module2 = $_POST['module2']; //  Retrieve Module 2 and store in a variable
$module2Credit = $_POST['module2Credit']; // Retrieve Credit of Module 2 and store in a variable
$module3 = $_POST['module3']; //  Retrieve Module 3 and store in a variable
$module3Credit = $_POST['module3Credit']; //  Retrieve Credit of Module 3
$level = $_POST['level']; //  Retrieve Level and store in a variable
$entryRequirements = $_POST['entryRequirements']; // Retrieve Entry Requirements and store in a variable
$feesGBP = $_POST['feesGBP']; // Retrieve Fees in GBP and store in a variable
$intfeesGBP = $_POST['intfeesGBP']; // Retrieve International Fees in GBP and store in a variable
$feesEUR = $_POST['feesEUR']; // Retrieve Fees in EUR and store in a variable
$intfeesEUR = $_POST['intfeesEUR']; // Retrieve International Fees in EUR and store in a variable
$feesUSD = $_POST['feesUSD']; // Retrieve Fees in USD and store in a variable
$intfeesUSD = $_POST['intfeesUSD']; // Retrieve International Fees in USD and store in a variable

// Prepare the SQL query for inserting data into the database table
$sql = "INSERT INTO coursedetails (courseName, overview, highlights, courseDetails, module1, module1Credit, module2, module2Credit, module3, module3Credit, level, entryRequirement, feesGBP, intfeesGBP, feesEUR, intfeesEUR, feesUSD, intfeesUSD) VALUES (:courseName, :overview, :highlights, :courseDetails, :module1, :module1Credit, :module2, :module2Credit, :module3, :module3Credit, :level, :entryRequirements, :feesGBP, :intfeesGBP, :feesEUR, :intfeesEUR, :feesUSD, :intfeesUSD)";
$stmt = $db->prepare($sql); // Prepare the SQL statement

// Bind parameters to the SQL statement
$stmt->bindParam(':courseName', $courseName);
$stmt->bindParam(':overview', $overview);
$stmt->bindParam(':highlights', $highlights);
$stmt->bindParam(':courseDetails', $courseDetails);
$stmt->bindParam(':module1', $module1);
$stmt->bindParam(':module1Credit', $module1Credit);
$stmt->bindParam(':module2', $module2);
$stmt->bindParam(':module2Credit', $module2Credit);
$stmt->bindParam(':module3', $module3);
$stmt->bindParam(':module3Credit', $module3Credit);
$stmt->bindParam(':level', $level);
$stmt->bindParam(':entryRequirements', $entryRequirements);
$stmt->bindParam(':feesGBP', $feesGBP);
$stmt->bindParam(':intfeesGBP', $intfeesGBP);
$stmt->bindParam(':feesEUR', $feesEUR);
$stmt->bindParam(':intfeesEUR', $intfeesEUR);
$stmt->bindParam(':feesUSD', $feesUSD);
$stmt->bindParam(':intfeesUSD', $intfeesUSD);

if ($stmt->execute()) {
    // Data inserted successfully
    $message = "Data stored in the database.";
    echo "<script>alert('$message');</script>"; // Display a JavaScript alert with the message
    header('Location: main.html'); // Redirect the user to the main.html page
    exit();
} else {
    // An error occurred
    echo "Error: Unable to store data.";
}

$db = null; // Close the database connection

?>
