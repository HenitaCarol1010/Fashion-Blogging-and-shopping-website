<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
//$us=$_POST["us"];
//$psd=$_POST["psd"];
// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
//Code to check whether data with the name username has been submitted
if (isset($_POST['us']) && isset($_POST['psd'])) {

	//variables to hold our submitted data with post
	$us =  ( $_POST['us']);
        
        //Encrypting our login password
	$psd = ($_POST['psd']);

$sql = "SELECT us,psd FROM signup WHERE us='$us' AND psd='$psd'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
    // output data of each row
	
    while($row = $result->fetch_assoc()) 
       // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["salary"]. "<br>";
       {
       
        // $_SESSION['check_username'] = $row['us'];
        $_SESSION['check_username'] = $row['us'];
         //$check_password = $row['psd'];
         $_SESSION['check_password']=$row['psd'];
         }
    if ($us == $_SESSION['check_username'] && $psd  == $_SESSION['check_password'])
     {
        
        header("Location: index.html");
    }
     else 
     {
        $message = "Invalid username/password";

        echo "<script type='text/javascript'>alert('$message');</script>";
        //echo("Invalid username/password");
        require("login.html");
       //header("Location: login.html");
    }
    
} 
$conn->close();
?>