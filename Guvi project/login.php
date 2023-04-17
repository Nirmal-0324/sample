<?php

$conn = mysqli_connect('localhost','root','','user_db') or die('connection failed');

?>
<link rel='stylesheet' href="css/login.css" >
<?php
session_start();
$error = array();
if(isset($_POST["submit"]))
{ 
  $Email= mysqli_real_escape_string($conn,$_POST["email"]);
  $Password= md5($_POST["psw"]);

  $stmt = $conn->prepare("SELECT * FROM user_form WHERE email=? AND password=?");
  $stmt->bind_param("ss", $Email, $Password);
  $stmt->execute(); 
  $result = $stmt->get_result();

  if(mysqli_num_rows($result)>0){
     $row=mysqli_fetch_array($result);
     session_start();
    $_SESSION['user_id'] = $Email;
     header('location:profile.php');
  }
  else{
    $error[]='Incorrect email or password';  
  }
}
?>
<?php
          if(!empty($error)) {
            echo "<div class='error'>";
            foreach($error as $err) {
              echo "<p>".$err."</p>";
            }
            echo "</div>";
          }
          ?>