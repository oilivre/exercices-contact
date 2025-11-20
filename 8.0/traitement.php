<?php 


try {
    $mysqlClient = new PDO ('mysql:host=localhost;dbname=jo_sql;charset=utf8', 'root', '13062007');
} catch (PDOException $e){
    die($e->getMessage());
}


if (isset($_POST["register"]) && isset($_POST["registerpassword"])) {

    $inscription = $mysqlClient->prepare("INSERT INTO `user` (username, password)VALUES (:username, :password)");

    $inscription->execute([':username' => $_POST['register'],':password' => $_POST['registerpassword']]);
}


if(isset($_POST['connect'])) {
    if($user){
        if(password_verify($_POST['password'], $user['password'])){
            $_SESSION['username'] = $_POST['username'];
        }
    }
}

$query=$mysqlClient->prepare("SELECT * FROM user;");
$query->execute();

$data=$query->fetchAll();


var_dump($data);    




?>