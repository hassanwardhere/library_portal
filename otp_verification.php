<?php
require_once('config/db_conn.php');
$otp_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otp = $_POST['otp'];
    $email = $_POST['email'];

    if (empty($otp)) {
        $otp_error = 'Please enter OTP';
    } else {
        $sql = "SELECT * FROM registration WHERE otp_code = :otp AND school_email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['otp' => $otp, 'email' => $email]);

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $sql = "UPDATE registration SET is_active = 1 WHERE school_email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);

            // check if user came from login or register
            $previous_page = $_SERVER['HTTP_REFERER'];
            if (strpos($previous_page, 'login.php') !== false) {
                // redirect to Dashboard page
                header("Location: dashboard.php");
            } else {
                // redirect to Login page
                header("Location: login.php");
            }
            exit();
        } else {
            $otp_error = 'Invalid OTP';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
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
    <!-- OTP form -->
    <section class="otp-hero-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">

                <div class="container mt-5 bg-white py-4">
                    <h2 class="text-center mb-4">Google 2 Factor Authentication</h2>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="otp" class="form-label">OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" required>
                            <span class="text-danger"><?php echo $otp_error; ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Verify</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- End of OTP form -->
</body>
<?php include 'footer.php' ?>

</html>
