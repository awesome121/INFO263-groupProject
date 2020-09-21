<!DOCTYPE html>
<html>

    <head>
        <title>Login - TServer</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    </head>

    <body>
        <!-- Logo -->
        <div>
            <a class="container-fluid row text-center mt-4 mb-3"  href="#">
                <img src="../images/UC_logo.png" class="rounded mx-auto d-block" height="150">
            </a>
        </div>

 <!--   Original Form Code
        <div>
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
        </div> -->

        <!--Reworked Form Code-->
        <div class="container-fluid row text-center">
                <div class="col text-center">
                    <div class="info-form">
                        <form method="POST" action="login_page.php">
                                <input type="text" name="username" placeholder="Username" autocomplete="on"
                                       required="required"><br>
                                <input type="password" class="password mt-2" name="password" placeholder="Password" required="required"
                                       minlength="6"><br>
                                <button type="button" class="btn btn-secondary mt-3" value="login" >Login</button>
                        </form>
                    </div>
                </div>
        </div>

    </body>

</html>


<?php
require_once('../db_config.php');
$conn = new mysqli($hostname, $username, $password, $database);
if($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
$user_info = verifyAccount($conn);
if ($_POST["username"] != "" && $_POST["password"] != "") {
    if ($user_info != "") {
        header("Location: home.php");
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
