<!DOCTYPE html>
<html>
    <head>
        <title>
            Tserver
        </title>
    </head>

    <body>
        <form method="POST" action="login_page.php">
                <pre>
                    Username
                    <input type="text" name="username" placeholder="Please enter your username" autocomplete="on"
                           required="required">
                    Password
                    <input type="password" name="password" placeholder="Please enter your password" required="required"
                           minlength="6">
                    <input type="submit" value="login">
                </pre>
        </form>
    </body>
</html>


<?php
require_once('../db_config.php');
$conn = new mysqli($hostname, $username, $password, $database);
if($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
$user_info = verifyAccount($conn);
if ($_POST["username"] != "" && $_POST["password"] != "") {
    if ($user_info != "") {
        header("Location: home_page.php");
    } else {
        print_r("Invalid username or password");
    }
}


function verifyAccount($conn) {
    $query = "call get_user();";
    $result = mysqli_query($conn, $query);
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];
    $row = mysqli_fetch_row($result);
    while($row != NULL){
        if ($input_username==$row[0] && $input_password==$row[1]) {
            $email = $row[2];
            $fullName = $row[3];
            return array($email, $fullName);
        }
        $row = mysqli_fetch_row($result);
    }
    return "";
}

?>
