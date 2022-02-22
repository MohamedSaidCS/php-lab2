<?php
$message = array();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    if ($name === '') {
        array_push($message, "** Name is required.");
    } else if (strlen($name) > 100) {
        array_push($message, "** Name can't be longer than 100 characters.");
    }

    $email = $_POST['email'];
    if ($email === '') {
        array_push($message, "** Email is required.");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($message, "** Email must be a valid email.");
    }

    $textarea = $_POST['message'];
    if ($textarea === '') {
        array_push($message, "** Message is required.");
    } else if (strlen($name) > 255) {
        array_push($message, "** Message can't be longer than 255 characters.");
    }
}

function getPastValue($field) {
    if(isset($_POST[$field])) {
        echo $_POST[$field];
    }
}

function logToFile() {
    $log_line =  date("F j Y g:i a") . "," . $_SERVER['REMOTE_ADDR'] . "," . $_POST['email'] . "," . $_POST['name'] . PHP_EOL;
    file_put_contents('log.txt', $log_line, FILE_APPEND);
}

?>

<html>

<head>
    <title> contact form </title>


</head>

<body>
    <h3> Contact Form </h3>
    <div id="after_submit">
        <h3><?php if (isset($_POST['submit'])) {
                if (sizeof($message) === 0) {
                    echo "Thank you for contactig us! <br>";
                    echo "Name: " . $_POST['name'] . "<br>";
                    echo "Email: " . $_POST['email'] . "<br>";
                    echo "Message: " . $_POST['message'] . "<br>";
                    logToFile();
                } else {
                    foreach ($message as $m) {
                        echo $m . "<br>";
                    }
                }
            }
            ?></h3>
    </div>
    <form id="contact_form" action="index.php" method="POST" enctype="multipart/form-data">

        <div class="row">
            <label class="required" for="name">Your name:</label><br />
            <input id="name" class="input" name="name" type="text" value="<?php getPastValue('name')?>" size="30" /><br />

        </div>
        <div class="row">
            <label class="required" for="email">Your email:</label><br />
            <input id="email" class="input" name="email" type="text" value="<?php getPastValue('email')?>" size="30" /><br />

        </div>
        <div class="row">
            <label class="required" for="message">Your message:</label><br />
            <textarea id="message" class="input" name="message" rows="7" cols="30"><?php getPastValue('message')?></textarea><br />

        </div>

        <input id="submit" name="submit" type="submit" value="Send email" />
        <input id="clear" name="clear" type="reset" value="clear form" />

    </form>
</body>

</html>