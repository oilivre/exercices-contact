<?php
session_start();

try {
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=jo_sql;charset=utf8',
        'root',
        '13062007'
    );
} catch (PDOException $e){
    die($e->getMessage());
}

function showdata($mysqlClient){
    $query = $mysqlClient->prepare("SELECT * FROM user");
    $query->execute();
    $data = $query->fetchAll();
    var_dump($data);
}


if (isset($_POST['register'])) {

    if (empty($_POST["registeruser"]) || empty($_POST["registerpassword"])) {
        echo "Erreur : champs d'inscription vides";
        exit;
    }

    $username = $_POST["registeruser"];
    $password = password_hash($_POST["registerpassword"], PASSWORD_DEFAULT);

    $inscription = $mysqlClient->prepare(
        "INSERT INTO user (username, password) VALUES (:username, :password)"
    );

    $inscription->execute([':username' => $username,':password' => $password]);

    echo "Inscription réussie !<br>";
    showdata($mysqlClient);
}



if (isset($_POST['connect'])) {

    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "Champs de connexion vides.";
        exit;
    }

    $username = $_POST["username"];


    $query = $mysqlClient->prepare(
        "SELECT * FROM user WHERE username = :username LIMIT 1"
    );
    $query->execute([':username' => $username]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Utilisateur introuvable.";
        exit;
    }

 
    if (password_verify($_POST['password'], $user['password'])) {
        $_SESSION['username'] = $user['username'];
        echo "Connexion réussie ! Bonjour " . $user['username'];
    } else {
        echo "Mot de passe incorrect.";
    }
}
?>
