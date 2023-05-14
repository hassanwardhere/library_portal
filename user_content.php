<?php
// Include your database connection file here
require_once('C:\xampp\htdocs\library_portal\config\db_conn.php');

// Fetch all users from the database
$sql = "SELECT * FROM registration";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();
?>
<?php include 'C:\xampp\htdocs\library_portal\header.php' ?>
<div class="container mt-5">
    <div class="mb-3">
        <a href="add_user.php" class="btn btn-success">Add User</a>
    </div>
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
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['full_name']; ?></td>
                    <td><?php echo $user['school_email']; ?></td>
                    <td><?php echo $user['user_type']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td>
                        <!-- Here you can add action buttons like edit, delete etc. -->
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'C:\xampp\htdocs\library_portal\footer.php' ?>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable();
    });
</script>
