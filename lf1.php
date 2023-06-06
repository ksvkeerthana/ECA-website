<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['password']) &&
         isset($_POST['email'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "login";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM keerthu WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO keerthu(username, password, email) values(?, ?, ?)";
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
                $stmt->bind_param("sss",$username, $password,  $email);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
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

<html>
<head>
<style>
body  {
  background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgbdkpVXme_LghT7MiSCwgMn-RnvRO34X1nQ&usqp=CAU");
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover;
}

.btn-login{
        
        width: 20%;
        padding: 10px;
        border: 0;
        color: #fff;
        border-radius: 10px;
        cursor: pointer;
        
    }
    .btn-login:focus{
        outline: 0;
    }
    
    .btn-login:hover{
        opacity: 0.8;
        transition: .3s;
    }
    
    /* Gradient Background */
    .gr-bg{
        background: rgb(252,205,128);
        background: linear-gradient(90deg, rgba(252,205,128,1) 0%, rgba(209,122,142,1) 55%, rgba(220,159,174,1) 100%);   
    }
</style>

</head>
<body>

<p>
<center>

<h3>
<font color="black">

<i class="fas fa-atom fa-2x mx-3">KSV_ECA</i>
<br>
<font color="brown">
<a href="homepro1.html">Click here to visit home page</a>
</h3>
</center>
</p>
</body>
</html>