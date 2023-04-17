<?php

$conn = mysqli_connect('localhost','root','','user_db') or die('connection failed');

?>

<?php
$error = array();
if(isset($_POST["submit"]))
{ 
  $Name= mysqli_real_escape_string($conn,$_POST["name"]);
  $Email= mysqli_real_escape_string($conn,$_POST["email"]);
  $Password= md5($_POST["psw"]);


  $select = "SELECT * FROM user_form WHERE email='$Email' && password='$Password'";
  $result = mysqli_query($conn,$select);

  if(mysqli_num_rows($result)>0){
     $error[]='User already exists!';   
  }

 
      else{
    $insert = "INSERT INTO user_form(name,email,password) VALUES ('$Name','$Email','$Password')"; 
    mysqli_query($conn,$insert);
    header('location:login.html');
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