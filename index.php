<?php
/**
 * Project: bootstrap-contact-form
 * User: Gert Massheimer
 * Date: 25.Nov.2019
 * Time: 13:05
 * File: index.php
 * ------------------------------------------------- */

// ---------------------------------------------------------------------------------------------------------------------
// ---- User settings --------------------------------------------------------------------------------------------------

if (ini_get('date.timezone') !== 'America/New_York') date_default_timezone_set('America/New_York');
# if (ini_get('date.timezone') !== 'Europe/Berlin') date_default_timezone_set('Europe/Berlin');

$date = date("d.M.Y");   // Date eMail was sent
$time = date("H:i");     // Time eMail was sent

$toName  = 'Freddy Friday';     // Don't forget to change your name ...
$toEmail = 'freddy@friday.net'; // ... and email address!
$subject = 'Message from your website'; // And perhaps the subject.

$lang = 'en';
# $lang = 'de';

// ---- /User settings -------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------

global $lang, $part1, $part2, $result;
$emailStatus = "<div><br><br><br></div>\n";

if ($lang !== 'de') {
  $submit = 'Send Message&nbsp;&nbsp;&nbsp;<i class="fab fa-telegram-plane"></i>';
  $reset  = 'Delete Message&nbsp;&nbsp;&nbsp;<i class="far fa-times-circle"></i>';
  $msgEquation1   = 'Please check the equation. The result is NOT <strong>';
  $msgEquation2   = '</strong>.';
  $msgSuccess     = 'Your email was sent successfully.';
  $msgError       = 'Internal Error! Your email was not sent. Please tray again later.';
  $invalidName    = 'Please enter your name.';
  $invalidEmail   = 'Please enter or check your email address.';
  $invalidMessage = 'Please enter your message.';
  $invalidHuman   = 'Please enter the correct result.';
  $humanQuestion  = 'Are you Human or Bot?';
  $humanEquation  = 'What is';
  $nameLabel      = 'Your Name:';
  $emailLabel     = 'Your E-Mail:';
  $messageLabel   = 'Your Message:';
  $namePlaceholder    = 'Your Name';
  $emailPlaceholder   = 'Your e-mail address';
  $messagePlaceholder = 'Enter Your Message';
  $humanPlaceholder   = 'Answer?';
}
else {
  $submit = 'Sende Nachricht&nbsp;&nbsp;&nbsp;<i class="fab fa-telegram-plane"></i>';
  $reset  = 'Lösche Nachricht &nbsp;&nbsp;&nbsp;<i class="far fa-times-circle"></i>';
  $msgEquation1   = 'Die Gleichung ist falsch!. Das Ergebnis ist NICHT <strong>';
  $msgEquation2   = '</strong>.';
  $msgSuccess     = 'eMail wurde erfolgreich versendet.';
  $msgError       = 'Interner Fehler! Ihre eMail wurde nicht versendet. Bitte versuchen Sie es später noch einmal.';
  $invalidName    = 'Bitte Name eingeben.';
  $invalidEmail   = 'Bitte eMail-Adresse eingeben oder überprüfen.';
  $invalidMessage = 'Bitte Nachrichten-Text eingeben.';
  $invalidHuman   = 'Bitte das korrekte Ergebnis eingeben.';
  $humanQuestion  = 'Mensch oder Maschine?';
  $humanEquation  = 'Was ist';
  $nameLabel      = 'Ihr Name:';
  $emailLabel     = 'Ihre eMail-Adresse:';
  $messageLabel   = 'Ihre Nachricht:';
  $namePlaceholder    = 'Ihr Name';
  $emailPlaceholder   = 'Ihre eMmail-Adresse';
  $messagePlaceholder = 'Ihre Nachricht';
  $humanPlaceholder   = 'Antwort?';
}

placeNumber(); // --- create the numbers for the captcha

/**
 * Create the numbers for the captcha.
 */
function placeNumber() {
  global $part1, $part2, $result;
  $x = floor(rand(1, 10));
  $y = floor(rand(1, 10));
  $part1 = makeNumber($x);
  $part2 = makeNumber($y);
  $result = $x + $y;
}

/**
 * Create the number string for the captcha.
 * @param $numb
 * @return bool|string
 */
function makeNumber($numb) {
  global $lang;
  switch ($numb) {
    case  1: if ($lang === 'de') return 'eins';   else return 'one';
    case  2: if ($lang === 'de') return 'zwei';   else return 'two';
    case  3: if ($lang === 'de') return 'drei';   else return 'three';
    case  4: if ($lang === 'de') return 'vier';   else return 'four';
    case  5: if ($lang === 'de') return 'fünf';   else return 'five';
    case  6: if ($lang === 'de') return 'sechs';  else return 'six';
    case  7: if ($lang === 'de') return 'sieben'; else return 'seven';
    case  8: if ($lang === 'de') return 'acht';   else return 'eight';
    case  9: if ($lang === 'de') return 'neun';   else return 'nine';
    case 10: if ($lang === 'de') return 'zehn';   else return 'ten';
    default: return false;
  }
}

if (isset($_POST['submit'])) { // --- prepare and send the email

  // ---- Email information from contact form
  $fromName  = $_POST['name'];
  $fromEmail = $_POST['email'];
  $fromMsg   = htmlentities(strip_tags($_POST['message']),ENT_QUOTES,'UTF-8');
  // ---- /Email information from contact form

  if ($lang !== 'de') $emailHeadline = 'On '.$date.' at '.$time.' <strong>'.$fromName.'</strong> wrote on your homepage:';
  else $emailHeadline = 'Am '.$date.' um '.$time.' <strong>'.$fromName.'</strong> schrieb auf Ihrer Webseite:';

  // ---- Preparing the html message
  $message = <<<MSG
  <!DOCTYPE html>
  <html lang="$lang">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>$subject</title>
      <style type="text/css">
        body {left:40px;top:10px;position:absolute;font:1rem Arial,Helvetica,Verdana,sans-serif;color:#000;background-color:#fff;}
        .message {white-space:pre;}
      </style>
    </head>
    <body>
      <p>$emailHeadline</p>
      <hr>
      <p class="message">$fromMsg</p>
    </body>
  </html>
  MSG;

  // ---- Preparing the message header
  $senderEmail = '=?UTF-8?B?'.base64_encode($fromEmail).'?=';
  $senderName  = '=?UTF-8?B?'.base64_encode($fromName).'?=';
  $recipient   = '=?UTF-8?B?'.base64_encode($toName).'?= <'.$toEmail.'>';
  $subject     = '=?UTF-8?B?'.base64_encode($subject).'?=';
  $message     = base64_encode($message);

  $headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset="UTF-8"',
    'Content-Transfer-Encoding: base64',
    'Return-Path: '.$senderName.' <'.$senderEmail.'>',
    'Date: '.date('r', $_SERVER['REQUEST_TIME']),
    'Message-ID: <'.$_SERVER['REQUEST_TIME'].md5($_SERVER['REQUEST_TIME']).'@'.$_SERVER['SERVER_NAME'].'>',
    'From: '.$senderName.' <'.$senderEmail.'>',
    'Sender: '.$senderName.' <'.$senderEmail.'>',
    'Reply-To: '.$senderName.' <'.$senderEmail.'>',
    'X-Mailer: PHP v'.phpversion(),
    'X-Originating-IP: '.$_SERVER['SERVER_ADDR']
  ];

  // ---- sending the email
  if (mail($recipient, $subject, $message, implode(chr(13), $headers)))
    $emailStatus = '<div class="text-center alert alert-success border-success" role="alert">'.$msgSuccess."</div>";
  else $emailStatus = '<div class="text-center alert alert-danger border-danger" role="alert">'.$msgError."</div>";
}

// --- create the web page ---------------------------------------------------------------------------------------------
echo <<<HTML
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>contact  template</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="assets/css/contact.css" type="text/css">

    <!-- Font Awesome (free) SVG-Version -->
    <script data-search-pseudo-elements defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js" data-auto-replace-svg="nest"></script>

    <!-- Custom JavaScript for this template -->
    <script src="assets/js/contact.js"></script>

  </head>
  <body>
    
    <div style="padding: 4rem">
  
      <div class="container">
        <div class="d-flex flex-row-reverse">
          <form class="theme-switch-wrapper ml-4 mr-2 ml-md-0">
            <label class="theme-switch" for="theme-switch">
              <input class="mr-2" type="checkbox" id="theme-switch">
              <span class="slider round"></span>
            </label>
          </form>
          <span class="pr-4 text-danger">switch me!</span>
        </div>
      </div>
  
      <!--contact us section-->
      <div class="container">
        <div class="row">
          <div class="col-sm-10">
            <h2>Contact Us</h2>
            <h5>Feel free to reach out for any questions!</h5>

            <form class="contact-form needs-validation" id="contactForm" name="contactForm" method="post" action="?" novalidate>
              <div class="row pt-3">
                <div class="col-sm-8">
                  <input type="text" id="name" name="name" class="form-control contact raised" aria-label="$nameLabel" placeholder="$namePlaceholder" required>
                  <div class="valid-feedback">&nbsp;</div>
                  <div class="invalid-feedback">$invalidName</div>
                </div>
              </div>
              <div class="row pt-3">
                <div class="col-sm-8">
                  <input type="email" id="email" name="email" class="form-control contact raised" aria-label="$emailLabel" placeholder="$emailPlaceholder" required>
                  <div class="valid-feedback">&nbsp;</div>
                  <div class="invalid-feedback">$invalidEmail</div>
                </div>
              </div>
              <div class="row pt-3">
                <div class="col-sm-12">
                  <textarea rows="7" id="message" name="message" class="form-control contact raised" aria-label="$messageLabel" placeholder="$messagePlaceholder" required></textarea>
                  <div class="valid-feedback">&nbsp;</div>
                  <div class="invalid-feedback">$invalidMessage</div>
                </div>
              </div>

              <!-- Captcha -->
              <div class="row pt-3">
                <label id="human-label" for="human" class="col-form-label form-text text-dark">
                  $humanQuestion<br />
                  $humanEquation $part1 plus $part2?
                </label>
                <div class="col-sm-3">
                  <input type="number" min="0" max="99" class="form-control human-form-control contact raised" id="human" name="human" placeholder="$humanPlaceholder" required>
                  <div class="valid-feedback">&nbsp;</div>
                  <div class="invalid-feedback">$invalidHuman</div>
                </div>
                <div class="col-sm-3">
                  <div id="human-feedback">&nbsp;</div>
                </div>
              </div>
              <!-- /Captcha -->

              <div class="form-row pt-3">
                <div class="col">
                  <button class="btn btn-success mr-3 raised" type="submit" id="submit" name="submit">$submit</button>
                  <button class="btn btn-danger ml-3 raised" type="reset" id="reset" name="reset">$reset</button>
                </div>
              </div>
              <div class="row pt-3">
                <div class="col-12">
                  $emailStatus
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <script>
      (function() {
        'use strict';
        window.addEventListener('load', () => {
          // check captcha answer
          const captchaAnswer = document.getElementById('human');
          captchaAnswer.onchange = () => {captcha('$msgEquation1', '$result', '$msgEquation2')};
        }, false);
      })();
    </script>

    <!-- Description :  The JS component of the Bootstrap Framework. -->
    <!-- !!! Make sure you keep the right order !!! -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

HTML;
