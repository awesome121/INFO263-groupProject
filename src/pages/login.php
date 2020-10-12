<?php
    require_once('../db_config.php');

    $conn = new mysqli($hostname, $username, $password, $database); // New database connection

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    };

    $user_info = verifyAccount($conn);

    if ($_POST["input_username"] != "" && $_POST["input_password"] != "") {
        if ($user_info != NULL) {
            $conn->close();

            header("Location: home.php");
        } else {
            $login_error = "Invalid username or password";
        };
    };

    /**
     * A function to verify user's input username and password
     *
     * @param $conn The database connection.
     * @return array|null Return username, email and fullname in an array for information display in the later pages, or return NULL if it's invalid input username or password
     */
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
                return array($input_username, $email, $fullName);
            };

            $row = mysqli_fetch_row($result);
        };

        return NULL;
    };
?>

<html class="h-100">
    <head>
        <title>Login - TServer</title>

        <!-- Bootstrap CSS -->
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    
    <body class="h-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col col-sm-6 col-md-4 col-lg-3 text-center m-auto">
                    <!-- Logo -->
                    <img src="../images/UC_logo.png" class="rounded mb-5 img-fluid" style="max-height: 200px;">

                    <form method="POST" action="#">
                        <div class="form-group">
                            <input class="form-control<?php $login_error ? print_r(' is-invalid') : print_r('') ?>" type="text" name="input_username" placeholder="Username" required>
                        </div>

                        <div class="form-group">
                            <input class="form-control<?php $login_error ? print_r(' is-invalid') : print_r('') ?>" type="password" name="input_password" placeholder="Password" required>

                            <div class="invalid-feedback">
                                <?php print_r($login_error) ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger mt-2 mb-5">Login</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>
