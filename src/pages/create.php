<?php
    setcookie('keywords', $_GET['keywords']);

    // Require the database credentials.
    require_once('../db_config.php');

    // Open a database connection.
    $conn = new mysqli($hostname, $username, $password, $database);

    // Get all the data that has been posted from the event creation form.
    $event_name = $_POST["event_name"];
    $cluster = $_POST["cluster"];
    $date = $_POST["date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $machine_groups = $_POST["machine_groups"];
    $notes = $_POST["notes"];

    // Only create an event if all the required fields have been filled in.
    if ($event_name && $cluster && $date && $start_time && $end_time && $machine_groups) {
        // TODO: Save event in database, maybe check that start time is before end time and date is in the future?

        /* Parameter for add_event procedure
        in_event_name VARCHAR(255),
        in_cluster_name VARCHAR(128),
        in_time_off_set_before_start TIME
        in_duration TIME
        in_event_year year(4)
        in_week_of_year int(11)
        */

        // $query = "call add_event('event_name', '{$_POST['subject']}');";
        // $events = mysqli_query($conn, $query);

        // Set the event created variable to true so that we can show the event created successfully message on the page below.
        $event_created = true;
    };
?>

<!DOCTYPE html>
<html class="h-100">
    <head>
        <title>Create Event - TServer</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.4.0/dist/select2-bootstrap4.min.css" integrity="sha256-3UPl0A8ykc7qW77XmHP0HDb1Nvs/09AACcTrNpIbdJ4=" crossorigin="anonymous">
        <!-- link to css -->
        <link rel="stylesheet" href="../css/home.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    </head>

    <body class="h-100">
        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #999999;">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="../images/UC_logo.png" height="50">
            </a>

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="create.php">Create Event</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="future.php">Future Events</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="past.php">Past Events</a>
                </li>

                <li class="nav-item" id="logout">
                    <a class="nav-link" href="login.php">Logout</a>
                </li>


                <!-- Search w button -->
                <form class="searchbar" class="nav-item" id="search">
                    <a class="dropdown">
                        <div id="myDropdown" class="dropdown-content">
                            <input id="input" type="text" placeholder="Type an event name..",
                                   onkeyup="showSearchResult(this.value)">

                            <button class="btn btn-dark" type="submit" onclick="openWin()"><i class="fa fa-search"></i></button>
                            <div id="hint">
                                <?php
                                if (isset($keywords)) {
                                    if ($keywords != "" and sizeof($hint) == 0) {
                                        echo "<a>No Suggestion</a>";
                                    } else {
                                        foreach ($hint as $key => $value)
                                            echo " <a>{$value}</a> ";

                                    }
                                }
                                ?> </div>

                        </div>
                    </a>
                </form>

            </ul>
        </nav>

        <div class="container-fluid" style="height: calc(100% - 76px);">
            <div class="row h-100">
                <div class="col col-sm-12 col-md-8 col-lg-5 col-xl-4 m-auto">
                    <?php
                        // Print out a success message if the event has been created.
                        if ($event_created) {
                            print_r('
                                <div class="alert alert-secondary alert-dismissible fade show my-2" role="alert">
                                    <div>
                                        <strong>Event created!</strong>
                                    </div>
                                    
                                    <div class="mt-2">
                                        Create another event, or <a href="future.php" class="alert-link">see all future events.</a>
                                    </div>
                                    
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ');
                        };
                    ?>

                    <div class="card my-2">
                        <div class="card-body">
                            <form action="#" method="POST">
                                <div class="form-group">
                                    <label for="event_name">Event Name <span class="text-danger">*</span></label>

                                    <input class="form-control" type="text" name="event_name" id="event_name" required autofocus />
                                </div>

                                <div class="form-group">
                                    <label for="cluster">Cluster <span class="text-danger">*</span></label>

                                    <select class="form-control" name="cluster" id="cluster" required>
                                        <option selected disabled></option>

                                        <?php
                                            $query = "call get_cluster_name();";

                                            $result = mysqli_query($conn, $query);
                                        
                                            // Print out each cluster from the database as a select option.
                                            while ($row = mysqli_fetch_row($result)) {
                                                $cluster = $row[0];

                                                print_r("<option value='$cluster'>$cluster</option>");
                                            };
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date <span class="text-danger">*</span></label>

                                    <input class="form-control" type="date" name="date" id="date" placeholder="dd/mm/yyyy" required>
                                </div>

                                <div class="form-group">
                                    <label for="start_time">Start Time <span class="text-danger">*</span></label>

                                    <input class="form-control" type="time" name="start_time" id="start_time" placeholder="--:-- --" required>

                                    <small class="form-text text-muted">Enter the test start time, computers will unlock 5 minutes earlier.</small>
                                </div>

                                <div class="form-group">
                                    <label for="end_time">End Time <span class="text-danger">*</span></label>

                                    <input class="form-control" type="time" name="end_time" id="end_time" placeholder="--:-- --" required>

                                    <small class="form-text text-muted">Enter the test end time, computers will lock 5 minutes later.</small>
                                </div>

                                <div class="form-group">
                                    <label for="machine_groups">Machine Groups <span class="text-danger">*</span></label>

                                    <select class="form-control" name="machine_groups[]" id="machine_groups" multiple required>
                                        <?php
                                            $query = "call get_machine_group();";

                                            $result = mysqli_query($conn, $query);
                                        
                                            // Print out each machine group from the database as a select option.
                                            while ($row = mysqli_fetch_row($result)) {
                                                $machine_group = $row[0];

                                                print_r("<option value='$machine_group'>$machine_group</option>");
                                            };
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="notes">Notes</label>

                                    <textarea class="form-control" name="notes" id="notes" rows="5"></textarea>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-danger" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" integrity="sha256-AFAYEOkzB6iIKnTYZOdUf9FFje6lOTYdwRJKwTN5mks=" crossorigin="anonymous"></script>

        <!-- Initialise select2 select boxes. -->
        <script>
            $('#cluster').select2({
                theme: 'bootstrap4',
            });

            $('#event').select2({
                theme: 'bootstrap4',
            });

            $('#machine_groups').select2({
                theme: 'bootstrap4',
            });
        </script>

        <!-- Home JS-->
        <script src="home.js"></script>
    </body>
</html>