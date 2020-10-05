<?php
    require_once('../db_config.php');
    $conn = new mysqli($hostname, $username, $password, $database); // New database connection
    $keywords = $_GET['keywords'];
    $hint = array();
    $query = "call show_events_past();";
    $events = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($events);
    while ($keywords != "" and $row != NULL and sizeof($hint) < 7) {
        if (strpos(strtolower(explode(" ", $row[0])[0]), strtolower($keywords)) !== false and !array_key_exists($row[8], $hint)) {
            $hint[$row[8]] = $row[0];
        }
        $row = mysqli_fetch_row($events);
    }
//$query = "call t_server.show_events_future();";
//$result2 = mysqli_query($conn, $query);
//$row = mysqli_fetch_row($result2);
//while($keywords != "" and $row != NULL and sizeof($hint) < 7){
//    if (strpos(strtolower(explode(" ", $row[0])[0]), strtolower($keywords)) !== false and !array_key_exists($row[8], $hint)){
//        $hint[$row[8]] = $row[0];
//    }
//    $row = mysqli_fetch_row($result2);
//}
if (sizeof($hint) == 7) {
    array_push($hint, ". . . . . . .");
}



if (!isset($_GET['startDate'])) {
    $_GET['startDate'] = '2020-05-11';
    $_GET['endDate'] = '2020-05-17';
}
$query = "call INFO263_cgo54_tserver.show_week_events('{$_GET['startDate']}', '{$_GET['endDate']}');";
$conn = new mysqli($hostname, $username, $password, $database); // New database connection
$week_events = array();
$events = mysqli_query($conn, $query);
$row = mysqli_fetch_row($events);
while ($row != NULL) {
    array_push($week_events, $row);
    $row = mysqli_fetch_row($events);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home - TServer</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
        <link rel="stylesheet" href="../css/home.css" />
    </head>

    <body>
        <!-- Header -->
        <div id="sticker">
        <nav id="nav_bar" class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #999999;">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="../images/UC_logo.png" height="50">
            </a>

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home</a>
                </li>

                <li class="nav-item">
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

                <!-- Search -->
                <li class="nav-item" id="search">
                    <a class="dropdown">
                        <div id="myDropdown" class="dropdown-content">
                            <input type="text" placeholder="Type an event name.." id="myInput" ,
                                   onkeyup="showSearchResult(this.value)">
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
                </li>
            </ul>
        </nav>


        <div id="calendar" class="row mt-3" >
                <div class="col">
                    <button onclick="calendarSwitch(1)" type="button" class="btn btn-secondary"><</button>
                    <span id="currentDate" class="h4"><?php
                        echo $_GET['startDate'] . " - " . $_GET['endDate'];
                    ?></span> <!-- insert current date -->
                    <button onclick="calendarSwitch(0)" type="button" class="btn btn-secondary">></button>
                </div>
            </div>


        <div id="weekdays" class="row mt-2">
                <div class="col pr-0">
                    <div class="mb-2 h4" style="text-align: center">
                        Monday
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4" style="text-align: center">
                        Tuesday
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4" style="text-align: center">
                        Wednesday
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4" style="text-align: center">
                        Thursday
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4" style="text-align: center">
                        Friday
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4" style="text-align: center">
                        Saturday
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4" style="text-align: center">
                        Sunday
                    </div>
                </div>

            </div>

        </div>

        <div id="mainFrame" class="container-fluid">
            <div class="row mt-2">

                <div class="col pr-0">
                    <?php
                    $count = 0;
                    foreach ($week_events as $row) {
                        if ($row[14] == 1) { // Monday
                            echo '<div class="card bg-light mb-3">';
                            echo "<div class=\"card-header\">{$row[0]}</div>";
                            echo "<div class=\"text-center\" >
                            <a id=\"mondayCard{$count}\"  class=\"btn btn-primary\" data-toggle=\"collapse\" href=\"#monday{$count}\" role=\"button\" aria-expanded=\"false\" aria-controls=\"multiCollapseExample1\">Show more</a>
                        </div>";
                            echo "<div class=\"collapse multi-collapse\" id=\"monday{$count}\">";
                            echo "<div class=\"card-body\">";
                            echo "<p class=\"card-text\">Start: {$row[6]}</p>
                                <p class=\"card-text\">Machine Group: {$row[3]}</p>";
                            echo '</div></div></div>';
                            $count += 1;
                        }
                    }


                    ?>

                </div>


                <div class="col pr-0">


                    <?php
                    $count = 0;
                    foreach ($week_events as $row) {
                        if ($row[14] == 2) { // Tuesday
                            echo '<div class="card bg-light mb-3">';
                            echo "<div class=\"card-header\">{$row[0]}</div>";
                            echo "<div class=\"text-center\" >
                            <a id=\"tuesdayCard{$count}\"  class=\"btn btn-primary\" data-toggle=\"collapse\" href=\"#tuesday{$count}\" role=\"button\" aria-expanded=\"false\" aria-controls=\"multiCollapseExample1\">Show more</a>
                        </div>";
                            echo "<div class=\"collapse multi-collapse\" id=\"tuesday{$count}\">";
                            echo "<div class=\"card-body\">";
                            echo "<p class=\"card-text\">Start: {$row[6]}</p>
                                <p class=\"card-text\">Machine Group: {$row[3]}</p>";
                            echo '</div></div></div>';
                            $count += 1;
                        }

                    }

                    ?>


                </div>


                <div class="col pr-0">
                    <?php
                    $count = 0;
                    foreach ($week_events as $row) {
                        if ($row[14] == 3) { // Wednesday
                            echo '<div class="card bg-light mb-3">';
                            echo "<div class=\"card-header\">{$row[0]}</div>";
                            echo "<div class=\"text-center\" >
                            <a id=\"wednesdayCard{$count}\"  class=\"btn btn-primary\" data-toggle=\"collapse\" href=\"#wednesday{$count}\" role=\"button\" aria-expanded=\"false\" aria-controls=\"multiCollapseExample1\">Show more</a>
                        </div>";
                            echo "<div class=\"collapse multi-collapse\" id=\"wednesday{$count}\">";
                            echo "<div class=\"card-body\">";
                            echo "<p class=\"card-text\">Start: {$row[6]}</p>
                                <p class=\"card-text\">Machine Group: {$row[3]}</p>";
                            echo '</div></div></div>';
                            $count += 1;
                        }

                    }

                    ?>
                </div>


                <div class="col pr-0">

                    <?php
                    $count = 0;
                    foreach ($week_events as $row) {
                        if ($row[14] == 4) { // Thursday
                            echo '<div class="card bg-light mb-3">';
                            echo "<div class=\"card-header\">{$row[0]}</div>";
                            echo "<div class=\"text-center\" >
                            <a id=\"thursdayCard{$count}\"  class=\"btn btn-primary\" data-toggle=\"collapse\" href=\"#thursday{$count}\" role=\"button\" aria-expanded=\"false\" aria-controls=\"multiCollapseExample1\">Show more</a>
                        </div>";
                            echo "<div class=\"collapse multi-collapse\" id=\"thursday{$count}\">";
                            echo "<div class=\"card-body\">";
                            echo "<p class=\"card-text\">Start: {$row[6]}</p>
                                <p class=\"card-text\">Machine Group: {$row[3]}</p>";
                            echo '</div></div></div>';
                            $count += 1;
                        }
                    }

                    ?>
                </div>


                <div class="col pr-0">
                    <?php
                    $count = 0;
                    foreach ($week_events as $row) {
                        if ($row[14] == 5) { // Friday
                            echo '<div class="card bg-light mb-3">';
                            echo "<div class=\"card-header\">{$row[0]}</div>";
                            echo "<div class=\"text-center\" >
                            <a id=\"fridayCard{$count}\"  class=\"btn btn-primary\" data-toggle=\"collapse\" href=\"#friday{$count}\" role=\"button\" aria-expanded=\"false\" aria-controls=\"multiCollapseExample1\">Show more</a>
                        </div>";
                            echo "<div class=\"collapse multi-collapse\" id=\"friday{$count}\">";
                            echo "<div class=\"card-body\">";
                            echo "<p class=\"card-text\">Start: {$row[6]}</p>
                                <p class=\"card-text\">Machine Group: {$row[3]}</p>";
                            echo '</div></div></div>';
                            $count += 1;
                        }
                    }

                    ?>
                </div>


                <div class="col pr-0">
                    <?php
                    $count = 0;
                    foreach ($week_events as $row) {
                        if ($row[14] == 6) { // Saturday
                            echo '<div class="card bg-light mb-3">';
                            echo "<div class=\"card-header\">{$row[0]}</div>";
                            echo "<div class=\"text-center\" >
                            <a id=\"saturdayCard{$count}\"  class=\"btn btn-primary\" data-toggle=\"collapse\" href=\"#saturday{$count}\" role=\"button\" aria-expanded=\"false\" aria-controls=\"multiCollapseExample1\">Show more</a>
                        </div>";
                            echo "<div class=\"collapse multi-collapse\" id=\"saturday{$count}\">";
                            echo "<div class=\"card-body\">";
                            echo "<p class=\"card-text\">Start: {$row[6]}</p>
                                <p class=\"card-text\">Machine Group: {$row[3]}</p>";
                            echo '</div></div></div>';
                            $count += 1;
                        }
                    }

                    ?>
                </div>


                <div class="col pr-0">
                    <?php
                    $count = 0;
                    foreach ($week_events as $row) {
                        if ($row[14] == 0) { // Sunday
                            echo '<div class="card bg-light mb-3">';
                            echo "<div class=\"card-header\">{$row[0]}</div>";
                            echo "<div class=\"text-center\" >
                            <a id=\"sundayCard{$count}\"  class=\"btn btn-primary\" data-toggle=\"collapse\" href=\"#sunday{$count}\" role=\"button\" aria-expanded=\"false\" aria-controls=\"multiCollapseExample1\">Show more</a>
                        </div>";
                            echo "<div class=\"collapse multi-collapse\" id=\"sunday{$count}\">";
                            echo "<div class=\"card-body\">";
                            echo "<p class=\"card-text\">Start: {$row[6]}</p>
                                <p class=\"card-text\">Machine Group: {$row[3]}</p>";
                            echo '</div></div></div>';
                            $count += 1;
                        }

                    }

                    ?>
                </div>


            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="home.js"></script>
    </body>
</html>
