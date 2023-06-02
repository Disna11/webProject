<?php

$host = 'localhost';   // store the host name into a variable called host
$dbname = 'internet_programming';  // store the database name into a variable called dbname
$user = 'root';     // store the username into a variable callaed user
$password = '';   // store the password into a variable called password

$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); // establish a cnnection to MYSQL data base using PHP object called PDO

$username = $_POST['username'];  // retrieve the username sended from the form using post method and store it into a variable called username
$password = $_POST['password']; //  retrieve the password sended from the form using post method and store it into a variable called password

$query = "SELECT * FROM user WHERE username = :username AND password= :password";  // query for selecting the row from the table user where the username and password given are equal
$stmt = $db->prepare($query); // prepares the database query saved in the variable query.
$stmt->bindParam(':username', $username); // bind the parameter to the prepared statement. it associates the value of variable username with the placeholder :username in the query.
$stmt->bindParam(':password', $password); // bind the parameter to the prepared statement. it associates the value of variable password with the placeholder :password in the query.

$stmt->execute();  // execute the prepared statement

$result = $stmt->fetch(PDO::FETCH_ASSOC); //store the resultant row after executing the query in to a variable result



// Verify the password
if ($result) {
    header('Location: main.html'); // if the password and username are equal go to main.html page
    exit();
} else {
    // Authentication failed, redirect back to the login page with an error message
   echo "invalid username or password";
    exit();
}

?>