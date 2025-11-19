<?php
$connexion = new PDO('mysql:host=localhost;dbname=jo_sql;charset=utf8', 'root', '13062007');
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$colonnes = ['nom','pays','course','temps'];


$colonneTri = in_array($_GET['sort'] ?? '', $colonnes) ? $_GET['sort'] : 'nom';
$ordreTri   = (strtolower($_GET['order'] ?? '') === 'desc') ? 'DESC' : 'ASC';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nom']) && !empty($_POST['pays']) && !empty($_POST['course']) && $_POST['temps'] !== '') {
        $stmt = $connexion->prepare("
            INSERT INTO `100` (nom, pays, course, temps)
            VALUES (:nom, :pays, :course, :temps)
        ");
        $stmt->execute([
            ':nom'    => $_POST['nom'],
            ':pays'   => $_POST['pays'],
            ':course' => $_POST['course'],
            ':temps'  => $_POST['temps'],
        ]);
    }
}

$resultats = $connexion
    ->query("SELECT * FROM `100` ORDER BY $colonneTri $ordreTri")
    ->fetchAll(PDO::FETCH_ASSOC);

function fleche($col,$colTri,$ordre) {
    return $col === $colTri ? ($ordre==='ASC' ? ' ↑' : ' ↓') : '';
}

function lienTri($col,$colTri,$ordre) {
    $nouvelOrdre = ($col === $colTri && $ordre==='ASC') ? 'desc' : 'asc';
    return "<a href='?sort=$col&order=$nouvelOrdre'>$col" . fleche($col,$colTri,$ordre) . "</a>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>Ajouter un résultat :</h1>

<form method="post">
    <label>Nom : </label>
    <input type="text" name="nom"><br>

    <label>Pays : </label>
    <input type="text" name="pays"><br>

    <label>Course : </label>
    <input type="text" name="course"><br>

    <label>Temps : </label>
    <input type="number" step="0.01" name="temps"><br>

    <button type="submit">Submit</button>
</form>

<table border="10">
    <tr>
        <th><?= lienTri('nom',$colonneTri,$ordreTri) ?></th>
        <th><?= lienTri('pays',$colonneTri,$ordreTri) ?></th>
        <th><?= lienTri('course',$colonneTri,$ordreTri) ?></th>
        <th><?= lienTri('temps',$colonneTri,$ordreTri) ?></th>
    </tr>
    <?php foreach($resultats as $ligne): ?>
    <tr>
        <td><?= htmlspecialchars($ligne['nom']) ?></td>
        <td><?= htmlspecialchars($ligne['pays']) ?></td>
        <td><?= htmlspecialchars($ligne['course']) ?></td>
        <td><?= htmlspecialchars($ligne['temps']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
