<?php 

session_start();
//PHP for server side data entry
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "registration";
    $conn = mysqli_connect($servername,$username,$password,$database_name);
// Check connection
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

$name='';
$username='';
$mobile='';
$mail='';

if (isset($_SESSION['username'])){
    $name= $_SESSION['username'];
}

$query = "SELECT * FROM users WHERE username='$name'";
$data = mysqli_query($conn,$query);

$total = mysqli_num_rows($data);

if($total!=0)
{
	while($result= mysqli_fetch_assoc($data))
	{
                
        $username= $result['username'];
        $mobile=$result['mobile'];
        $mail=$result['mail'];
            
	}
}
else{
	echo "No Data";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
        <div class="inner">
            <div class="container welcome">
                <img  src="images/welcome.jpg" alt="">
                <h3><?php echo $username ;?></h3>
                <p> To Our Amazing World</p> 
                <h4>Username: <small><?php echo $username ;?></small></h4>
                <h4>Phone: <small><?php echo $mobile ;?></small></h4>
                <h4>Email: <small><?php echo $mail ;?></small></h4>
            </div>
        </div>
    </div>
</body>
</html>