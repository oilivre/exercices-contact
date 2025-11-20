<?php
session_start();

$_SESSION["username"] = $_POST["username"];

echo "<h1> Bonjour " .  $_SESSION["username"] . "<h1>" ;

function endsession(){
    session_start();
    session_unset();
    session_destroy();
}
?>

<a href="index.php">
    <button onclick="endsession()">Stop Session</button>
</a>
