<?php

declare(strict_types=1);
require('./config/db_conn.php');
require('./vendor/autoload.php');
include('./header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Authentication</title>
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
        <?php

        use Sonata\GoogleAuthenticator\GoogleAuthenticator;
        use Sonata\GoogleAuthenticator\GoogleQrUrl;

        $secret = "XVQ2UIGO75XRUKJO";
        // $code = 'code';

        $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
        echo $g->getCode($secret);
        // check if the request is coming from register.php or login.php
        if (isset($_SERVER['HTTP_REFERER'])) {
          $referrer = $_SERVER['HTTP_REFERER'];

          if (strpos($referrer, 'register.php') !== false) {
            // if coming from register.php, display the QR code image
            $secret = $g->generateSecret();
            $qrCodeUrl = GoogleQrUrl::generate('chregu', $secret, 'GoogleAuthenticatorExample');
            echo "<div class='container-fluid bg-white p-2 shadow'>";
            echo "<img id='qr-code-img'  src='{$qrCodeUrl}' class='img-fluid' alt='Google Authenticator QR code'>";
            echo "<form action='auth.php' method='post' class='mt-4'>";
            echo "<div class='mb-4'>";
            echo "<label for='code' class='form-label text-black'>Google Authenticator Code:</label>";
            echo "<input type='text' id='code' name='code' class='form-control form-control-lg'>";
            echo "</div>";
            echo "<button type='submit' class='btn btn-primary'>Submit</button>";
            echo "</form>";
            echo "</div>";
          } else if (strpos($referrer, 'login.php') !== false) {
            // if coming from login.php, display the login form
            echo "<p class='mt-4'>Let's verify it's you</p>";
            echo "<form id='verify-form' action='' method='post' class='mt-4 bg-white p-4 rounded shadow-sm'>";
            echo "<div class='mb-3'>";
            echo "<label for='code' class='form-label text-black'>Google Authenticator Code:</label>";
            echo "<input type='text' id='2fa-code' name='code' class='form-control' required>";
            echo "</div>";
            echo "<button type='submit' class='btn btn-primary'>Submit</button>";
            echo "</form>";
          }
        }

        if (isset($_POST['submit'])) {
          // if the form is submitted, check if the code is valid
          $code = $_POST['code'];
          $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
          if ($g->checkCode($secret, $code)) {
            if (strpos($referrer, 'register.php') !== false) {
              header('Location: ./login.php');
            } else if (strpos($referrer, 'login.php') !== false) {
              header('Location: dashboard.php');
            }
            exit;
          } else {
            echo "<div class='alert alert-danger mt-4'>Invalid Code. Please try again.</div>";
          }
        }
        ?>
      </div>
    </div>
  </section>
</body>
<script>
  // check if the request is coming from register.php or login.php
  var referrer = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
  if (referrer.includes('register.php')) {
    document.getElementById('verify-form').style.display = 'none';
  } else if (referrer.includes('login.php')) {
    document.getElementById('qr-code-img').style.display = 'none';
    document.getElementById('2fa-form').style.display = 'none';
  }
</script>
<?php include('./footer.php') ?>

</html>