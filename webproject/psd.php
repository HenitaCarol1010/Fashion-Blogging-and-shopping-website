<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";



$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

        session_start();
        //Code to check whether data with the name username has been submitted
        if (isset($_POST['us']) && isset($_POST['psd'])) {
            $us = $_POST['us'];
            $psd = $_POST['psd'];
            $newpsd = $_POST['newpsd'];
            $conpsd = $_POST['conpsd'];
        $sql = "SELECT us,psd FROM signup WHERE us='$us' AND psd='$psd'";
        $result = $conn->query($sql);        



       if ($result->num_rows > 0) 
	
    while($row = $result->fetch_assoc()) 
       // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["salary"]. "<br>";
       {
        $_SESSION['check_username'] = $row['us'];
         $_SESSION['check_password']=$row['psd'];
         }
        //$result = $conn->query("SELECT password FROM signup WHERE us='$us'");
        if($us != $_SESSION['check_username'] )
        {
        //echo "The username you entered does not exist";
        $message = "The username you entered does not exist";

        echo "<script type='text/javascript'>alert('$message');</script>";
        //echo("Invalid username/password");
        require("change.html");
        }
        else if($psd!= $_SESSION['check_password'])
        {
        //echo "You entered an incorrect password";
        $message = "You entered an incorrect password";

        echo "<script type='text/javascript'>alert('$message');</script>";
        //echo("Invalid username/password");
        require("change.html");
       
        }
        else if($newpsd!=$conpsd)
        {
           // echo("");
            $message = "Passwords do not match";

        echo "<script type='text/javascript'>alert('$message');</script>";
        //echo("Invalid username/password");
        require("change.html");
        }
        else {
        
        //$sql=("UPDATE signup SET newpsd='$newpsd' where us='$us'");
       //echo "welcome";
        $sql=$conn->query("UPDATE signup SET psd='$newpsd' WHERE us='$us'");
        header("Location:login.html");
        }
       /* if($sql)
        {
        echo "Congratulations You have successfully changed your password";
        header("Location:login.html");
        }*/
   }
       $conn->close();
      ?>