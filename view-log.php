<html>
<head>
    <title>contact form log</title>
</head>
<body>
    <?php
    session_start();

    if(!isset($_SESSION["is_visited"])) {
        echo "<h1>You visited this page 1 time.</h1>";
        $_SESSION["is_visited"]=true;
           
    } else {
        $_SESSION["counter"] = isset($_SESSION["counter"]) ? $_SESSION["counter"] + 1 : 2;
        echo "<h1>You visited this page ".$_SESSION["counter"]." times.</h1>"; 
        
    }
    // session_destroy();

    echo "<br><hr>";

    if(file_exists('log.txt')) {
        $lines = explode(PHP_EOL, file_get_contents('log.txt'));
        for ($i=0; $i < sizeof($lines) - 1; $i++) { 
            $data = explode(",", $lines[$i]);
            echo "Visit Date: " . $data[0] . "<br>";
            echo "IP Address: " . $data[1] . "<br>";
            echo "Email: " . $data[2] . "<br>";
            echo "Name: " . $data[3] . "<br>";
            echo "<hr>";
        }
    } else {
        echo "<h1>Log file not found.</h1>";
    }

    ?>
</body>
</html>