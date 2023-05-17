<?php
require_once('C:\xampp\htdocs\library_portal\config\db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $school_email = $_POST['school_email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type'];
    $status = $_POST['status'];

    $sql = "INSERT INTO registration (full_name, school_email, password, user_type, status) VALUES (:full_name, :school_email, :password, :user_type, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['full_name' => $full_name, 'school_email' => $school_email, 'password' => $password, 'user_type' => $user_type, 'status' => $status]);

    $success_msg = "User added successfully.";
    header('Location: dashboard.php?page=users');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <?php include 'C:\xampp\htdocs\library_portal\header.php' ?>
</head>
<body>
    <!-- The registration form -->
    <!-- The registration form -->
<section class="">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="container mt-5 bg-white py-4">
                <h2 class="text-center mb-4">Register</h2>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="full-name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full-name" name="full-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="school-email" class="form-label">School Email</label>
                        <input type="email" class="form-control" id="email" name="school-email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                    </div>
                    <div class="mb-3">
                        <label for="user-type" class="form-label">I am a:</label>
                        <select class="form-select" aria-label="I am a" id="user-type" name="user-type">
                            <option value="student" selected>Student</option>
                            <option value="lecturer">Lecturer</option>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms-conditions" name="terms-conditions" required>
                        <label class="form-check-label" for="terms-conditions">I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End of registration form -->
    <!-- End of registration form -->
    <?php include 'C:\xampp\htdocs\library_portal\footer.php' ?>
</body>
</html>