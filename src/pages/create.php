<!DOCTYPE html>
<html>
    <head>
        <title>Create Event - TServer</title>

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

        <div class="container">
            <div class="row">
                <div class="col">
                    Content
                </div>
            </div>
        </div>

        <main>
            <link
                href="style.css"
                rel="stylesheet">

            <form class="form-style-9">
                <ul>
                    <li>
                      <label for="field1"><span>Subject</span><input type="text" name="field1" class="field-style field-split align-left" placeholder="e.g: INFO263" /></label><br>
                     <label for="field2"<span>Date</span><input type="date" name="field2" class="field-style field-split align-right" placeholder="Date"/></label><br>

                    </li>
                    <li>
                        Start: <input type="time" name="field3" class="field-style field-split align-left" placeholder="Start Time" /><br>
                        End: <input type="time" name="field4" class="field-style field-split align-right" placeholder="End Time" />
                    </li>
                    <li>
                        <input type="text" name="field3" class="field-style field-full align-none" placeholder="Location" />
                    </li>
                    <li>
                        <textarea name="field5" class="field-style" placeholder="Note"></textarea>
                    </li>
                    <li>
                        <input type="submit" value="Save" />
                    </li>
                </ul>
            </form>
        </main>


        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>