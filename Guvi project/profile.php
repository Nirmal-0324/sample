

<!DOCTYPE html>
<html>
  <head>
    <title>User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='css/profile.css'>
  </head>
  <style>
    body {
background-image: url("css/3.jpg");
background-size: cover;
background-position: center;
background-attachment: fixed;
background-repeat: no-repeat;


}
</style>
  <body>
    <?php
  
  

$conn = mysqli_connect('localhost','root','','user_db') or die('connection failed');

?>
<?php
    
  session_start();
  if(!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
  }
  $email = $_SESSION['user_id'];

  $query = "SELECT * FROM user_form WHERE Email = '$email'";
  $result = mysqli_query($conn, $query);
  $user_data = mysqli_fetch_assoc($result);
?>
<div class="container">
  <h1>User Profile</h1>
  <form id="profile-form">
    <label for="Name">Name:</label>
    <input type="text" id="username" name="username" value="<?php echo $user_data['Name']; ?>" readonly>

    <label for="Email">Email:</label>
    <input type="email" id="Email" name="email" value="<?php echo $user_data['Email']; ?>" readonly>

    <div class="gender-box">
      <label for="gender">Gender:</label>
      <select id="gender" name="gender">
        <option value="">Select gender</option>
        <option value="male"<?php if($user_data['gender'] === 'male') { echo ' selected'; } ?>>Male</option>
        <option value="female"<?php if($user_data['gender'] === 'female') { echo ' selected'; } ?>>Female</option>
        <option value="other"<?php if($user_data['gender'] === 'other') { echo ' selected'; } ?>>Other</option>
      </select>
    </div>

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" value="<?php echo $user_data['phone']; ?>" >

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo $user_data['addr']; ?>" >

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" value="<?php echo $user_data['dob']; ?>" >
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  

  $('#gender').change(function() {
    updateUserField('gender', $(this).val());
  });
  $('#phone').keyup(function() {
    updateUserField('phone', $(this).val());
  });
  $('#address').keyup(function() {
    updateUserField('addr', $(this).val());
  });
  $('#dob').change(function() {
    updateUserField('dob', $(this).val());
  });

  function updateUserField(fieldName, value) {
    var data = {
      field: fieldName,
      value: value
    };
    $.ajax({
      type: 'POST',
      url: 'update_form.php', 
      data: data,
      success: function(response) {

      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
});
</script>

