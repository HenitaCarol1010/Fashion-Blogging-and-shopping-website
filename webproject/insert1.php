<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$productsincart=$_POST["productsincart"];
$totalcost=$_POST["totalcost"];
$totalproducts=$_POST["totalproducts"];
$name=$_POST["name"];
$address=$_POST["address"];
$city=$_POST["city"];
$pincode=$_POST["pincode"];
$cardholder=$_POST["cardholder"];
$cardno=$_POST["cardno"];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO adds(productsincart,totalcost,totalproducts,name,address,city,pincode,cardholder,cardno)
VALUES ('$productsincart','$totalcost',$totalproducts,'$name','$address','$city', $pincode,'$cardholder','$cardno')";

if ($conn->query($sql) === FALSE) {

    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "SELECT productsincart,totalcost,totalproducts,name,address,city,pincode,cardholder,cardno  FROM adds";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
       
      
  header("Location: check_out.html");
     //echo '<a href="cart_page2.html"><h1>Click here to continue shopping</h1></a>';
    
    }
} else {
    echo "0 results";
}


  

$conn->close();
?>