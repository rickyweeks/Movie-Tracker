<?php
session_start();

if (isset($_POST['updatemovie'])) {
    include 'db.php';

    $id = $_POST['id'];
    $movie_title = $_POST['movie_title'];
    $movie_genre = $_POST['movie_genre'];

    $sql = "UPDATE movies SET movie_title='$movie_title', movie_genre='$movie_genre' WHERE movie_id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'movieupdated';
        header("Location: index.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    
    $conn->close();
}
?>