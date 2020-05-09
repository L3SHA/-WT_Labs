<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Task7 wt</title>
    </head>
    <body>
    <?php

        error_reporting(-1);
        ini_set('display_errors', 'On');
        set_error_handler("var_dump");

        $name = isset($_POST['submitted'])? $_POST['name']: "";
        $telephone = isset($_POST['submitted'])? $_POST['telephone']: "";
        $email= isset($_POST['submitted'])? $_POST['email']: "";
        $subject = isset($_POST['submitted'])? $_POST['subject']: "";
        $message = isset($_POST['submitted'])? $_POST['message']: "";

    ?>
    <form method="post">
        <label for="name">Name:<br></label>
        <input id="name" type="text" required="required"  name="name" value="<?php echo $name; ?>">
        <br><br>

        <label for="telephone">Telephone number:<br></label>
        <input id="telephone" type="tel" required="required" name="telephone" pattern="^\+375 (17|29|33|44) [0-9]{3}-[0-9]{2}-[0-9]{2}$" value="<?php echo $telephone; ?>">
        <br>
        <small>Format: +375 44 123-45-67</small>

        <br><br>
        <label for="email">E-mail:<br></label>
        <input id="email" type="email" required="required"  name="email"  pattern="([-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4})"  value="<?php echo $email; ?>">
        <br>
        <small>Format: address@example.com</small>

        <br><br>
        <label for="subject">Subject:<br></label>
        <input id="subject" type="text" required="required"  name="subject" value="<?php echo $subject; ?>">

        <br><br>
        <label for="message">Message:<br></label>
        <textarea id="message" name="message" required="required"  style="width:250px;height:150px;" ><?php echo $message; ?></textarea>

        <button type="submit" name="submitted">Send</button>
    </form>



    <?php
        const SERVER_EMAIL = "myapp@wt.com";
        const RESPONSE_SUBJECT = "Thanks for contacting us!";
        const RESPONSE_BODY = "Dear %s ! We're happy you have tried our new feature!
            Stay in touch, the real response is coming soon! We will call your phone number (%s) tommorow";

        if(isset($_POST['submitted']))
        {

            // USER's MESSAGE TO SERVER
            $headers = 'From: '.$email. "\r\n".
            'X-Mailer: PHP/' . phpversion();
            mail(SERVER_EMAIL, $subject, $message, $headers);

            // SERVER's AUTORESPONSE
            $headers = 'From: '.SERVER_EMAIL. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($email, RESPONSE_SUBJECT, sprintf(RESPONSE_BODY, $name, $telephone), $headers);
        }



    ?>

    </body>
</html>
