<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$email=$_POST["email"];
$name=$_POST["name"];
$views=$_POST["views"];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO contact(email,name,views)
VALUES ('$email','$name','$views')";

if ($conn->query($sql) === FALSE) {

    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "SELECT email,name,views  FROM contact";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
       
      echo("your views have been reported");
  header("Location: contact.html");
     //echo '<a href="cart_page2.html"><h1>Click here to continue shopping</h1></a>';
    
    }
} else {
    echo "0 results";
}


  

$conn->close();
?>