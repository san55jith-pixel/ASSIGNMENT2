<?php
$hostname = "localhost";
$username = "root";
$password = "root123*";
$database = "assignment";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Book ID not provided.");
}

$query = "DELETE FROM books WHERE id = $id";

if (mysqli_query($connection, $query)) {
    echo "Book deleted successfully. <a href='index.php'>Back to list</a>";
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
