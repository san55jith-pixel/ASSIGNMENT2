<?php
$hostname = "localhost";
$username = "root";
$password = "root123*";
$database = "assignment";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT books.id, books.title, books.isbn, authors.name AS author_name 
          FROM books 
          JOIN authors ON books.author_id = authors.id";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library - Book List</title>
</head>
<body>
    <h2>Book List</h2>
    <a href="create.php">Add New Book</a><br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>ISBN</th>
            <th>Author</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['isbn']) ?></td>
            <td><?= htmlspecialchars($row['author_name']) ?></td>
            <td>
                <a href="update.php?id=<?= $row['id'] ?>">Edit</a> | 
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php mysqli_close($connection); ?>
