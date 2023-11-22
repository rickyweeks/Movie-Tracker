<?php
session_start();

if (isset($_POST['deletemovie'])) {
    include 'db.php';
    $movie_id = $_POST['movie_id'];

    $sql = "DELETE FROM movies WHERE movie_id = $movie_id";
    $result = $conn->query($sql);

    if ($result) {
        $_SESSION['message'] = 'moviedeleted';
    } else {
        $_SESSION['message'] = 'deleteerror';
    }

    $conn->close();

    header('Location: index.php');
    exit();
}
?>
