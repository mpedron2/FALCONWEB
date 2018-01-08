<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<?php
	$date = date('Y/m/d h:i a', time());
?>

<h2>Falcon Website Inquiry as of <?= $date ?></h2>

<div>
    <p>
      We have received an inquiry from Falcon Website, Please check the following details:
    </p>
  
    <p>
    	<label>Fullame:</label> <?= $email_data['fullname'] ?>
    </p>
      
    <p>
    	<label>Email:</label> <?= $email_data['email'] ?>
    </p>

    <p>
    	<label>Level:</label><br><?= $email_data['level'] ?>
    </p>

    <p>
    	<label>Mobile:</label> <?= $email_data['mobile'] ?>
    </p>

    <p>
    	<label>Message:</label><br><?= $email_data['message'] ?>
    </p>
    <br>

    <p>
    	<b>Thank you</b>
    </p>

</div>

</body>
</html>