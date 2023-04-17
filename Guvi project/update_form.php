
<?php

$conn = mysqli_connect('localhost','root','','user_db') or die('connection failed');

?>
<?php



session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$email = $_SESSION['user_id'];


$field = $_POST['field'];
$value = $_POST['value'];


$query = "UPDATE user_form SET $field = '$value' WHERE Email = '$email'";
$result = mysqli_query($conn, $query);


if (!$result) {
    echo mysqli_error($conn);
}
?>
