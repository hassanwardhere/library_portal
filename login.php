<?php
require_once('config/db_conn.php');
// require_once('config/email_config.php');
session_start();

// Function to generate OTP
function generateNumericOTP($n) {
    $generator = "0123456789";
    $result = "";

    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }

    return $result;
}


function sendEmail($to, $subject, $body) {
    $headers = 'From: jupiter.abdullahi@gmail.com' . "\r\n" .
    'Reply-To: jupiter.abdullahi@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $body, $headers);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_email = $_POST['school-email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM registration WHERE school_email = :school_email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['school_email' => $school_email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        if ($user['status'] === 'suspended') {
            $error_msg = "Your account has been suspended.";
        } elseif ($user['status'] === 'deactivated') {
            $error_msg = "Your account has been deactivated.";
        } else {
            $otp_code = generateNumericOTP(6);

            $sql = "UPDATE registration SET otp_code = :otp_code WHERE school_email = :school_email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['otp_code' => $otp_code, 'school_email' => $school_email]);

            // send email with OTP code to user's email
            $subject = "OTP for Login";
            $body = "Your One Time Password for login is " . $otp_code;
            sendEmail($school_email, $subject, $body);

            // store the email in session variable
            $_SESSION['school_email'] = $school_email;

            // redirect to OTP verification page
            header("Location: otp_verification.php");
            exit();
        }
    } else {
        $error_msg = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'header.php';?>
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