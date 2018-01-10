<?php
session_start();
if(!$_SESSION["a"]){
  $a = rand(1,50);
  $b = rand(1,50);
  $_SESSION["a"] = $a;
  $_SESSION["b"] = $b;
}

$email ='';
$comment ='';
$name ='';
$result ='';
$error ='';

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $comment = $_POST['comment'];
  $check = intval($_POST['secCheck']);

  if(!$_POST['name']){$error .= 'Enter your name, please! <br>';}
  if(!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){$error .= 'Enter a valid email address, please!<br>';}
  if(!$_POST['comment']){$error .= 'Write your comment, please! <br>';}
  if($check!==($_SESSION["a"]+ $_SESSION["b"])){$error .= 'Wrong Answer!<br>';}

if($error ==''){
  $from = '';
  $to = 'dianamkado@gmail.com';//email address that receives the mail from contact form
  $subject = 'Message from contact form';
  $body = "From: $name($email) \n Comment \n $comment";
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: <'.$from.'>' . "\r\n";
  if(mail($to,$subject,$body,$headers)){
    $result = '<div class="success-alert">Message sent.</div>';
  } else {
    $result = '<div class="success-alert">Mail wasn\'t sent.</div>';
  }

} else {
    $result ='<div class="alert-danger">Error Found:<br>'.$error.'</div>';
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <title>FAA: Contact Us</title>
    <link rel="icon" type="image/png" href="FAA.png">
    <link rel="stylesheet" href="resources/css/reset.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
  </head>
  <body>
    <header>
      <a href="index.html"><img src="resources/images/FAA-FORGEAHEADARTS.png" alt="Forge Ahead Arts logo"></a>
      <nav>
        <a href="index.html#vision-section">vision</a>
        <a href="index.html#upcoming-section">upcoming</a>
        <a href="portfolio/index.html">portfolio</a>
        <a href="who.html">who we are</a>
        <a href="donate.html">donate</a>
        <a href="contact.php">contact us</a>
      </nav>
    </header>
    <div class="container">
        <form method="post" action="contact.php">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your name.." value="<?php echo $name;?>">
            <p class="text-danger">Please enter your name.</p>

            <label for="email">Email Address</label>
            <input type="text email" id="email" name="email" placeholder="Your email address.." value="<?php echo $email;?>">
            <p class="text-danger">Please enter your email address.</p>

            <!--<label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Your phone number..">

            <label for="city">Home Location</label>
            <select id="city" name="city">
              <option value="santaclarita">Santa Clarita Valley</option>
              <option value="losangeles">Greater Los Angeles Area</option>
              <option value="other">Other</option>
            </select>-->

            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" placeholder="Write something.." style="height:200px"><?php echo $comment;?></textarea>
            <p class="text-danger">Please enter a comment.</p>

            <label for="secCheck"><?php echo $_SESSION["a"] . "+" .$_SESSION["b"];?></label>
            <input type="text" id="secCheck" name="secCheck" placeholder="Enter the correct value.">
            <p class="text-danger">Please enter the correct answer.</p>

            <input type="submit" value="Send" id="submit" name="submit">

            <?php echo $result; ?>
        </form>
    </div>

    <footer>
      <p>© Copyright 2017 KADO GRAPHIC DESIGN</p>
    </footer>
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
      crossorigin="anonymous"></script>
  </body>
</html>
