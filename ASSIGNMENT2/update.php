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


$result = mysqli_query($connection, "SELECT * FROM books WHERE id = $id");
$book = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $isbn = $_POST['isbn'];
    $author_id = $_POST['author_id'];

    $stmt = mysqli_prepare($connection, "UPDATE books SET title = ?, isbn = ?, author_id = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssii", $title, $isbn, $author_id, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Book updated successfully. <a href='index.php'>Back to list</a>";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

$authors = mysqli_query($connection, "SELECT id, name FROM authors");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>
    <h2>Edit Book</h2>
    <form method="post" action="">
        Title: <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required><br><br>
        ISBN: <input type="text" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>" required><br><br>
        Author: <input type="text" name="author_id" value="<?= htmlspecialchars($book['author_id']) ?>" required><br><br>
        <input type="submit" value="Update Book">
    </form>
    <br><a href="index.php">Back to List</a>
</body>
</html>

<?php mysqli_close($connection); ?>
