<!DOCTYPE html>
<html>
    <head>
        <title>Past Events - TServer</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
        <link href="../css/stylesheet.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="../css/home.css" />
    </head>

    <!--probably should put in styles CSS doc-->
    <!--<style>
        th.sticky-header {
            position: sticky;
            top: 0;
            z-index:10;
            background-color:white;
        }
        table{
            height: 640px;
        }
    </style>-->
    <body>
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

                <li class="nav-item">
                    <a class="nav-link" href="create.php">Create Event</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="future.php">Future Events</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="past.php">Past Events</a>
                </li>

                <li class="nav-item" id="logout">
                    <a class="nav-link" href="login.php">Logout</a>
                </li>


                <!-- Searchbar -->
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

        <div class="container-fluid">
            <!-- Table based off of Constantine's help session -->
            <?
            //Open database connection and run the query
            require_once('../db_config.php');
            $conn = new mysqli($hostname, $username, $password, $database);
            //Test the connection and run the query
            if($conn->connect_error){
                die("Fatal error: " . $conn->connect_error);
            }

            //shows events that have happened in the past ordered by date descending
            $query = "call show_events_past()";
            $result = $conn->query($query);
            //Test the query was completed without error
            if($conn->error){
                die("Fatal error: " . $conn->error);
            }

            $fields = $result->fetch_fields();
            $field_names = [];
            while($field = $result->fetch_field()){
                $field_names[] = $field->name;
            }
            ?>
            <div class="table">
                <table class="table table-responsive">

                    <thead>

                        <?
                        //output the headers

                        for($i = 0; $i < sizeof($field_names); ++$i){
                            echo "<th class='sticky-header' scope ='col'><p>" . htmlspecialchars(ucwords(str_replace("_", " ", $field_names[$i]))). "</p></th>";
                        }
                        ?>

                    </thead>
                    <tbody>
                        <?
                        $num_rows = $result->num_rows;
                        for($j = 0; $j < $num_rows; ++$j){
                            $row = $result->fetch_array(MYSQLI_ASSOC);
                            echo "<tr scope='row' class='active'>";
                            for($k = 0; $k < sizeof($field_names); ++$k){
                                echo "<td>" . htmlspecialchars($row[$field_names[$k]]) . "</td>";
                            }
                            echo "</tr>";}
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- closing open connections-->
            <?
            $result->close();
            $conn-> close();
            ?>
        </div>


        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="home.js"></script>
    </body>
</html>