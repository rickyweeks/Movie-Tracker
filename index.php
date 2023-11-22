<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Tracker</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="https://portfolio.rickyweeksjr.opalstacked.com/">Portfolio</a>

    <!-- Toggler/collapsible Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/projects/myguests">My Guests</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/projects/movies">Movie Tracker</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/projects/100">100 Pages</a>
            <li class="nav-item">
                <a class="nav-link" href="/projects/states">50 States</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6">
        <h1 style="margin: 20px 0;">Movie Tracker</h1>
            <?php
            if (isset($_SESSION['message'])) {
                if ($_SESSION['message'] == 'movieadded') {
                    echo '<div class="alert alert-success">
                    <strong>Success!</strong> Movie added.
                    </div>';
                }

                if (isset($_SESSION['message']) && $_SESSION['message'] == 'moviedeleted') {
                    echo '<div class="alert alert-danger">
                    <strong>Success!</strong> Movie removed.
                    </div>';
                }

                if (isset($_SESSION['message']) && $_SESSION['message'] == 'movieupdated') {
                    echo '<div class="alert alert-info">
                    <strong>Success!</strong> Movie updated.
                    </div>';
                }
                unset($_SESSION['message']);
            }
            ?>
            <form action="addmovie.php" method="POST">
                <div class="form-group">
                    <label>Movie Title: </label>
                    <input class="form-control" type="text" name="movie_title" required>
                </div>
                <div class="form-group">
                    <label>Genre: </label>
                    <select class="form-control" name="movie_genre" required> 
                        <?php
                        $genres = array("Action", "Comedy", "Kids and Family", "Drama", "Fantasy", "Horror", "Mystery", "Romance", "Thriller", "Western");
                        foreach ($genres as $genre) {
                            echo '<option value="' . $genre . '">' . $genre . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="addmovie" class="btn btn-success">Add Movie</button>
            </form>
            <br><br>
            <table class="table table-hover table-striped table-bordered">
                <tr style="background-color: #333; color: #fff;">
                    <!-- <th>ID</th> -->
                    <th>Movie</th>
                    <th>Genre</th>
                    <!-- <th>Edit</th> -->
                    <th>Delete</th>
                </tr>
                <?php
                include 'db.php';
                $sql = "SELECT * FROM movies";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <!-- <td><?= $row["movie_id"] ?></td> -->
                            <td><?= $row["movie_title"] ?></td>
                            <td><?= $row["movie_genre"] ?></td>
                            <!-- <td>
                                <form action="updatemovie.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $row['movie_id'] ?>">
                                    <input type="hidden" name="movie_title" value="<?= $row['movie_title'] ?>">
                                    <input type="hidden" name="movie_genre" value="<?= $row['movie_genre'] ?>">
                                    <button type="submit" name="updatemovie" class="btn btn-xs btn-success">Edit</button>
                                </form>
                            </td> -->
                            <td>
                                <form action="deletemovie.php" method="POST">
                                    <input type="hidden" name="movie_id" value="<?= $row['movie_id'] ?>">
                                    <button type="submit" name="deletemovie" class="btn btn-xs btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
