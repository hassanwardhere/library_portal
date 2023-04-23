<?php
ob_start();
require_once('config/db_conn.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_email = $_POST['school-email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM registration WHERE school_email = :school_email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['school_email' => $school_email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $otp_code = rand(100000, 999999);

        $sql = "UPDATE registration SET otp_code = :otp_code WHERE school_email = :school_email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['otp_code' => $otp_code, 'school_email' => $school_email]);

        // send email with OTP code to user's email
        // ...
        $to = $user['school_email'];
        $subject = "OTP Code";
        $message = "Your OTP Code is: " . $otp_code;
        $headers = "From: Your Library <hassan@hassanwardhere.com>";

        mail($to, $subject, $message, $headers);

        ob_start(); // start output buffering
        header("Location: email-otp.php"); // redirect
        ob_end_flush(); // end output buffering and send headers
        exit();
    } else {
        $error_msg = "Invalid login credentials.";
    }
}
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container navbar-container">
            <a href="index.php" class="navbar-brand">Library Portal</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="#Home" class="nav-link">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->
    <!-- The registration form -->
    <section class="register-hero-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">


                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="text-center mb-4">Login</h3>
                                    <form action="login.php" method="POST">
                                        <div class="mb-3">
                                            <label for="school-email" class="form-label">School Email</label>
                                            <input type="email" class="form-control" id="school-email" name="school-email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                    <div class="mt-3 text-center">
                                        <p>Not a member? <a href="register.php">Register</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<?php include 'footer.php';
ob_end_flush(); // Add this line at the end of your code
?>

</html>