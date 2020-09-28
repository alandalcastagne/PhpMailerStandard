<?php
include('config.php');
?>
<!DOCTYPE html>

<html>
<head>
<style>

    form{
        display: flex;
        flex-direction: column;
        max-width: 500px;
        margin: 50px auto;
    }

    form input:nth-of-type(2){
        margin: 20px 0;
    }
</style>

</head>
<body>

<?php

if(isset($_POST['action'])){
    
    //Sender
    $mail = new Email('your host', 
    'your email',
    'your password',
    'Your name');

    //Receiver
    $mail->setAddress('Receiver', 
    'Receiver Name');

    //Title and fields to send
    $info = array('subject'=>'New subscriber','body'=>$_POST['email']);
    $mail->formatEmail($info);

    $mail->sendEmail();

}

?>

<form method="post">
    <input type="text" name="name" placeholder="Name..."/>
    <input type="email" name="email" placeholder="Email..."/>
    <textarea type="subject" name="subject" placeholder="message"></textarea>
    <input type="submit" name="action" value="send"/>
</form>

</body>
</html>