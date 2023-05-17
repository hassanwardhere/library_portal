<?php
require_once('./config/db_conn.php');
$user_type = 'admin'; // fetch the user type from session or database
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'header.php' ?>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">

    <!-- jQuery, Bootstrap and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

    <title>Books</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if ($user_type == 'librarian' || $user_type == 'admin') { ?>
                    <a style="margin-bottom: 15px;" href="./add_a_book.php" class="btn btn-primary" id="addBookBtn">Add a Book</a>
                <?php } ?>
                <table id="booksTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author and Year</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM books");
                        $stmt->execute();
                        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($books as $book) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($book['id']) . '</td>';
                            echo '<td>' . htmlspecialchars($book['title']) . '</td>';
                            echo '<td>' . htmlspecialchars($book['author_year']) . '</td>';
                            echo '<td>' . htmlspecialchars($book['status']) . '</td>';
                            echo '<td>';
                            if ($user_type == 'librarian' || $user_type == 'admin') {
                                echo '<button class="btn btn-primary">Edit</button> ';
                                echo '<button class="btn btn-danger">Delete</button>';
                            } elseif (($user_type == 'student' || $user_type == 'lecturer') && $book['status'] == 'Available') {
                                echo '<button class="btn btn-success">Borrow</button>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#booksTable').DataTable();
        });
    </script>
    <?php include 'footer.php' ?>
</body>

</html>