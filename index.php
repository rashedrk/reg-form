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
//variable declare
    $mail='';
    $confirm_password='';
    $errors = array(); 

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $mobile = $_POST['mobile'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

    } 
    
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR mail='$mail' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { // if user exists
        if ($user['username'] === $username) {
          array_push($errors, "Username already exists");
        }
    
        if ($user['mail'] === $mail) {
          array_push($errors, "Email already exists");
        }
      }
    if ($password!==$confirm_password) {
        array_push($errors,"Password doesn't match");
    }
    if (count($errors) == 0) {
        if(!empty($username) && !empty($mobile) && !empty($mail) && !empty($password)){
        
            $sql_query = "INSERT INTO users (username,mobile,mail,password) VALUES ('$username','$mobile','$mail','$password')";
                if($conn->query($sql_query) == TRUE){
                 $_SESSION['username'] = $username;
                header("Location:login.php");
                exit();
            
         } 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Here</title>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="inner">
        <?php  if (count($errors) > 0) : ?>
                 <div class="error">
  	                <?php foreach ($errors as $error) : ?>
  	                <p><?php echo $error ?></p>
  	                <?php endforeach ?>
                 </div>
            <?php  endif ?>
            <img src="" alt="">
            <form class="container" action="index.php" method="post">
                <h3>New Account?</h3>
                <div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text" class="form-control" placeholder="Username" name="username" required>
				</div>
                <div class="form-holder">
						<span class="lnr lnr-phone-handset"></span>
						<input type="text" class="form-control" placeholder="Phone Number" name="mobile" required>
				</div>
                <div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="email" class="form-control" placeholder="Mail" name="mail" required>
				</div>
                <div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" placeholder="Password" name="password" required>
				</div>
                <div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
				</div>
                <button type="submit" value="submit" name="submit" class="btn">
						<span>Register</span>
				</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
</body>
</html>