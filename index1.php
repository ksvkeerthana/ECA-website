<?php
if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['grade'  ]) &&
        !empty($_POST['email']) && !empty($_POST['Activity']) &&
        !empty($_POST['level']) && !empty($_POST['timing']) && !empty($_POST['phone'])) {
        
        $name = $_POST['name'];
        $grade = $_POST['grade'];
        $email = $_POST['email'];
        $email = $_POST['email'];
		$Activity = $_POST['Activity'];
		$level = $_POST['level'];
		$timing = $_POST['timing'];
        $phone = $_POST['phone'];
		
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "formpro";        
		$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO register(name, grade, email, Activity, level, timing, phone) values(?, ?, ?, ?, ?, ?, ?)";

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
                $stmt->bind_param("sissssi",$name, $grade, $email, $Activity, $level, $timing, $phone);
                if ($stmt->execute()) {
                    echo "You have registered successfully.";
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


</h3>
</center>
</p>
</body>
</html>