<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// include_once __DIR__.'/../src/FixedBitNotation.php';
include_once __DIR__.'/vendor/sonata-project/src/FixedBitNotation.php';
// include_once __DIR__.'/../src/GoogleAuthenticator.php';
include_once __DIR__.'/vendor/sonata-project/src/GoogleAuthenticator.php';
// include_once __DIR__.'/../src/GoogleQrUrl.php';
include_once __DIR__.'/vendor/sonata-project/src/GoogleQrUrl.php';

$secret = 'XVQ2UIGO75XRUKJO';
$code = '846474';

$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();

// check if the request is coming from register.php or login.php
if(isset($_SERVER['HTTP_REFERER'])) {
  $referrer = $_SERVER['HTTP_REFERER'];

  if(strpos($referrer, 'register.php') !== false) {
    // if coming from register.php, display the QR code image
    $secret = $g->generateSecret();
    $qrCodeUrl = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('chregu', $secret, 'GoogleAuthenticatorExample');
    echo "<img src='{$qrCodeUrl}' alt='Google Authenticator QR code'>";
  } else if(strpos($referrer, 'login.php') !== false) {
    // if coming from login.php, display the login form
    echo "<form action='auth.php' method='post'>";
    echo "<label for='code'>Google Authenticator Code:</label>";
    echo "<input type='text' id='code' name='code'><br><br>";
    echo "<input type='submit' value='Submit'>";
    echo "</form>";

    if(isset($_POST['code'])) {
      // if the form is submitted, check if the code is valid
      $code = $_POST['code'];

      if($g->checkCode($secret, $code)) {
        echo "Authentication Successful!";
      } else {
        echo "Invalid Code. Please try again.";
      }
    }
  }
}
