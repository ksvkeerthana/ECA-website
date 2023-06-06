<?php
if (isset($_POST['submit'])) {
    if (
        isset($_POST['name']) &&   isset($_POST['email'])  &&
        isset($_POST['password']) &&  isset($_POST['confirmpassword']))
        
         {
        
        
        $name= $_POST['name'];
        $email=$_POST['email'];
        $password= $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $host = "localhost";
        $dbusername = "root";
        $dbpassword="";
        $dbName= "covid";
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM registerform WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO registerform(name,email, password, confirmpassword) values(?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssss", $name, $email, $password, $confirmpassword);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else{
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>