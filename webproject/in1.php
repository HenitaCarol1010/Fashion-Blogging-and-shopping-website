<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$mail=$_POST["mail"];
$us=$_POST["us"];
$phone=$_POST["phone"];
$psd=$_POST["psd"];

// Create connection
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['mail']) && isset($_POST['us'])) {

	//variables to hold our submitted data with post
	$mail =  ( $_POST['mail']);
        
        //Encrypting our login password
	$us=($_POST['us']);

	//our sql statement that we will execute
//	$sql = "SELECT * FROM b WHERE c='$user' AND e='$Password'";

	//Executing the sql query with the connection
   // $re = mysqli_query($con, $sql);
    $sql = "SELECT mail,us FROM signup WHERE mail='$mail' AND us='$us'";
    $result = $conn->query($sql);
    

	//check to see if there is any record or row in the database if there is then the user exists
    if ( $result->num_rows> 0)
    while ($row = $result->fetch_assoc()) {
        $_SESSION['check_mail'] = $row['mail'];
        $_SESSION['check_username'] = $row['us'];
        //$check_password = $row['psd'];
        //$_SESSION['check_password']=$row['psd'];
    }
   // $Password == $check_password
    if ($mail == $_SESSION['check_mail'] ) {
        //echo ("Invalid username/password");
        $message = "Mail id already exists";

        echo "<script type='text/javascript'>alert('$message');</script>";
        //echo("Invalid username/password");
        require("login1.html");

        
        //$myfile =fopen("login.html","w");
    } 
     // $Password == $check_password
    else if ($us == $_SESSION['check_username'] ) {
        //echo ("Invalid username/password");
        $message = "Username already exists";

        echo "<script type='text/javascript'>alert('$message');</script>";
        //echo("Invalid username/password");
        require("login1.html");

        
        //$myfile =fopen("login.html","w");
    }
    
    else {
       // $message = "Welcome";
       $sql = "INSERT INTO signup (mail,us,phone,psd)
       VALUES ('$mail', '$us','$phone', '$psd')";
         if ($conn->query($sql) === TRUE) {
           echo "New record created successfully";
         } 
         else {
           echo "Error: " . $sql . "<br>" . $conn->error;
         }

         header("Location: index.html");
        
    }
    }

$conn->close();
?>