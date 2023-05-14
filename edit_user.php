<?php
// Include your database connection file here
require_once('./config/db_conn.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $school_email = $_POST['school_email'];
    $user_type = $_POST['user_type'];
    $status = $_POST['status'];

    // Update user in the database
    $sql = "UPDATE registration SET full_name = :full_name, school_email = :school_email, user_type = :user_type, status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['full_name' => $full_name, 'school_email' => $school_email, 'user_type' => $user_type, 'status' => $status, 'id' => $id]);

    // Redirect to users page
    header("Location: user.php");
    exit();
}

// Get user from the database
$id = $_GET['id'];
$sql = "SELECT * FROM registration WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

// If user not found, redirect to users page
if (!$user) {
    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Include your header here -->
    <?php include './header.php'; ?>
</head>
<body>
    <!-- Include your navigation here -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Edit User</h3>
                        <form action="edit_user.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <div class="mb-3">
                                <label for="full-name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full-name" name="full_name" value="<?php echo $user['full_name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="school-email" class="form-label">School Email</label>
                                <input type="email" class="form-control" id="school-email" name="school_email" value="<?php echo $user['school_email']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="user-type" class="form-label">User Type</label>
                                <input type="text" class="form-control" id="user-type" name="user_type" value="<?php echo $user['user_type']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status" value="<?php echo $user['status']; ?>" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include your footer here -->
    <?php include './footer.php'; ?>
</body>
</html>