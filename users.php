<?php
// Include your database connection file here
require_once('config/db_conn.php');

// Fetch all users from the database
$sql = "SELECT * FROM registration";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!-- Include your header here -->
    <?php include 'header.php'; ?>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
</head>
<body>
    <!-- Include your navigation here -->

    <div class="container mt-5">
        <table id="users-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>School Email</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['full_name']; ?></td>
                    <td><?php echo $user['school_email']; ?></td>
                    <td><?php echo $user['user_type']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td>
                        <!-- Here you can add action buttons like edit, delete etc. -->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Include your footer here -->
    <?php include 'footer.php'; ?>
    <script>
    $(document).ready(function() {
        $('#users-table').DataTable();
    });
    </script>
</body>
</html>