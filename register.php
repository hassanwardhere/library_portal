<?php
require_once('config/db_conn.php');
require_once('config/email_config.php');

// Function to generate OTP
function generateNumericOTP($n)
{
    $generator = "1357902468";
    return substr($generator, 0, $n);
}

// validate inputs and check if email is already registered
$email_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full-name'];
    $school_email = $_POST['school-email'];
    $password = $_POST['password'];
    $user_type = $_POST['user-type'];

    // Generate 6 digit OTP
    $otp = generateNumericOTP(6);

    if (empty($full_name) || empty($school_email) || empty($password)) {
        $email_error = 'Please fill all required fields';
    } elseif (!filter_var($school_email, FILTER_VALIDATE_EMAIL)) {
        $email_error = 'Invalid email format';
    } else {
        $sql = "SELECT * FROM registration WHERE school_email = :school_email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['school_email' => $school_email]);

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $email_error = 'Email is already registered';
        }
    }

    // insert user data into database
    if (empty($email_error)) {
        $sql = "INSERT INTO registration (full_name, school_email, password, user_type, otp_code, created_at, updated_at, is_active) VALUES (:full_name, :school_email, :password, :user_type, :otp_code, NOW(), NOW(), 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'full_name' => $full_name,
            'school_email' => $school_email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // hash password
            'user_type' => $user_type,
            'otp_code' => $otp
        ]);

        // Set the subject and body of the email
        $subject = 'OTP for Email Verification';
        $body = "Your One Time Password for email verification is " . $otp;

        // Send the email
        sendEmail($school_email, $subject, $body);

        // Redirect to OTP verification page
        header("Location: otp_verification.php");
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <?php include 'header.php' ?>
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
                            <span class="text-danger"><?php echo $email_error; ?></span>
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
</body>
<?php include 'footer.php' ?>

</html>