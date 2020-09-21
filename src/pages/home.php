<!DOCTYPE html>
<html>
    <head>
        <title>Home - TServer</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    </head>

    <body>
        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #999999;">
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
            <div class="row mt-3">
                <div class="col">
                    <button type="button" class="btn btn-secondary"><</button>
                    <span class="h4">14/09/2020 - 20/09/2020</span> <!-- insert current date -->
                    <button type="button" class="btn btn-secondary">></button>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col pr-0">
                    <div class="mb-2 h4">
                        Monday
                    </div>

                    <div class="card bg-light mb-3">
                        <div class="card-header">EMTH119-20S2 Monday</div>
                        <div class="card-body">
                            <p class="card-text">Start: 18:00:00</p>
                            <p class="card-text">End: 20:00:00</p>
                            <p class="card-text">Machine Group: Erskine-033, Erskine-035</p>
                        </div>
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4">
                        Tuesday
                    </div>

                    <div class="card bg-light mb-3">
                        <div class="card-header">EMTH118-20S2 Tuesday</div>
                        <div class="card-body">
                            <p class="card-text">Start: 16:00:00</p>
                            <p class="card-text">End: 18:00:00</p>
                            <p class="card-text">Machine Group: Erskine-033, Erskine-035</p>
                        </div>
                    </div>

                    <div class="card bg-light mb-3">
                        <div class="card-header">EMTH119-20S2 Tuesday</div>
                        <div class="card-body">
                            <p class="card-text">Start: 18:00:00</p>
                            <p class="card-text">End: 20:00:00</p>
                            <p class="card-text">Machine Group: Erskine-033, Erskine-035</p>
                        </div>
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4">
                        Wednesday
                    </div>

                    <div>
                        No events.
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4">
                        Thursday
                    </div>

                    <div>
                        No events.
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4">
                        Friday
                    </div>

                    <div class="card bg-light mb-3">
                        <div class="card-header">EMTH119-20S2 Friday</div>
                        <div class="card-body">
                            <p class="card-text">Start: 18:00:00</p>
                            <p class="card-text">End: 20:00:00</p>
                            <p class="card-text">Machine Group: Erskine-033, Erskine-035</p>
                        </div>
                    </div>
                </div>

                <div class="col pr-0">
                    <div class="mb-2 h4">
                        Saturday
                    </div>

                    <div>
                        No events.
                    </div>
                </div>

                <div class="col">
                    <div class="mb-2 h4">
                        Sunday
                    </div>

                    <div>
                        No events.
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>