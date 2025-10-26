<?php
$hostname = "localhost";
$username = "root";
$password = "root123*";
$database = "assignment";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $isbn = $_POST['isbn'];

    // Check if new author is provided
    if (!empty($_POST['new_author_name'])) {
        $new_author_name = $_POST['new_author_name'];
        $new_author_bio = $_POST['new_author_bio'];

        // Insert new author
        $stmt_author = mysqli_prepare($connection, "INSERT INTO authors (name, bio) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt_author, "ss", $new_author_name, $new_author_bio);

        if (mysqli_stmt_execute($stmt_author)) {
            $author_id = mysqli_insert_id($connection);
        } else {
            echo "Error adding author: " . mysqli_error($connection);
            exit;
        }
    } else {
        $author_id = $_POST['author_id'];
    }

    if (!empty($title) && !empty($isbn) && !empty($author_id)) {
        $stmt = mysqli_prepare($connection, "INSERT INTO books (title, isbn, author_id) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssi", $title, $isbn, $author_id);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Book added successfully. <a href='index.php'>Back to list</a>";
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        echo "All fields are required.";
    }
}

// Fetch authors for the dropdown
$authors = mysqli_query($connection, "SELECT id, name FROM authors");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
</head>
<body>
    <h2>Add New Book</h2>
    <form method="post" action="create.php">
        Title: <input type="text" name="title" required><br><br>
        ISBN: <input type="text" name="isbn" required><br><br>

        Author:
        <select name="author_id">
            <option value="">-- Select Existing Author --</option>
            <?php while ($author = mysqli_fetch_assoc($authors)): ?>
                <option value="<?= $author['id'] ?>"><?= htmlspecialchars($author['name']) ?></option>
            <?php endwhile; ?>
        </select><br><br>

        OR Add New Author:<br>
        Name: <input type="text" name="new_author_name"><br><br>
        Bio: <textarea name="new_author_bio"></textarea><br><br>

        <input type="submit" value="Add Book">
    </form>
    <br><a href="index.php">Back to List</a>
</body>
</html>

<?php mysqli_close($connection); ?>
