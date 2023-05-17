<?php
require_once('./config/db_conn.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author_year = $_POST['author_year'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO books (title, author_year, status) VALUES (?, ?, 'Available')");
    $stmt->execute([$title, $author_year]);

    // Redirect back to the books page after adding the book
    header("Location: books.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta2/css/bootstrap.min.css">

    <title>Add a Book</title>
</head>
<body>
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1 class="text-center mb-4">Add a Book</h1>
                <form action="add_book.php" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Book Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="author_year" class="form-label">Author and Year</label>
                        <input type="text" class="form-control" id="author_year" name="author_year" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Book</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
