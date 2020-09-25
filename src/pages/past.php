<!DOCTYPE html>
<html>
    <head>
        <title>Past Events - TServer</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    </head>
    <!--probably should put in styles CSS doc-->
    <style>
        table:
        text-align: left;
        position: relative;
        th{
            text-align: left;
            vertical-align: text-top;
            position: sticky;
            top: 0;
        }
        table tbody{
            overflow: auto;
        }
    </style>
<body>
    <div>
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

                <li class="nav-item">
                    <a class="nav-link" href="login_page.php">Logout</a>
                </li>
            </ul>

            <!-- Search -->
            <form class="form-inline">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-dark" type="submit">Search</button>
            </form>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col">

                </div>
            </div>
            <!--</div>-->
            <!-- Constatines database code from the help session -->
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

            //debugging code
            //echo "<pre>" .print_r($result->fetch_fields(), true) . "</pre>"

            $fields = $result->fetch_fields();
            $field_names = [];
            while($field = $result->fetch_field()){
                $field_names[] = $field->name;
            }
            //debugging code
            //echo "<pre>" .print_r($field_names, true) . "</pre>"
            ?>
            <div class="table-responsive">
                <table class="table">

                    <thead class="sticky-top">
                        <tr>
                            <?
                            //output the headers

                            for($i = 0; $i < sizeof($field_names); ++$i){
                                echo "<th scope = 'col'><p>" . htmlspecialchars(ucwords(str_replace("_", " ", $field_names[$i]))). "</p></th>";
                            }
                            ?>
                        </tr>
                        <tbody>
                        <?
                        $num_rows = $result->num_rows;
                        for($j = 0; $j < $num_rows; ++$j){
                            $row = $result->fetch_array(MYSQLI_ASSOC);
                            echo "<trs scope='row'>";
                            for($k = 0; $k < sizeof($field_names); ++$k){
                                echo "<td>" . htmlspecialchars($row[$field_names[$k]]) . "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </thead>
                </table>
            </div>

            <?
            $result->close();
            $conn-> close();
            ?>
        </div>


        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </div>
</body>
</html>