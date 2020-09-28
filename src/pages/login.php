<!DOCTYPE html>
<?php
setcookie('user_info', $user_info);
?>

<html>

    <head>
        <title>Login - TServer</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    </head>

    <body>
        <!-- UC Logo -->
        <div>
            <a class="container-fluid row text-center mt-4 mb-3"  href="#">
                <img src="../images/UC_logo.png" class="rounded mx-auto d-block" height="150">
            </a>
        </div>
        
        <div class="container-fluid row text-center">
            <div class="col text-center">
                <div class="info-form">
                    <form method="POST" action="login_page.php">
                            <input type="text" name="input_username" placeholder="Username" autocomplete="on"
                                   required="required"><br>
                            <input type="password" class="password mt-2" name="input_password" placeholder="Password" required="required"
                                   minlength="6"><br>
                            <button type="submit" class="btn btn-secondary mt-3" value="login" >Login</button>
                    </form>
                </div>
            </div>
        </div>

    </body>

</html>




<?php
require_once('../db_config.php');
$conn = new mysqli($hostname, $username, $password, $database); // New database connection
if($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
$user_info = verifyAccount($conn);
if ($_POST["input_username"] != "" && $_POST["input_password"] != "") {
    if ($user_info != NULL) {
        header("Location: home.php?");
    } else {
//        session_start();
//        $_SESSION["user_info"] = $user_info;
        print_r("Invalid username or password");
    }
}

// A function to verify user's input username and password
// Return username, email and fullname in an array for information display in the later pages
// Return NULL if it's invalid input username or password 
function verifyAccount($conn) {
    $query = "call get_user();";
    $result = mysqli_query($conn, $query);
    $input_username = $_POST["input_username"];
    $input_password = $_POST["input_password"];
    $row = mysqli_fetch_row($result);
    while($row != NULL){
        if ($input_username==$row[0] && $input_password==$row[1]) {
            $email = $row[2];
            $fullName = $row[3];
            return array($conn, $input_username, $email, $fullName);
        }
        $row = mysqli_fetch_row($result);
    }
    return NULL;
}

?>
