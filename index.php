
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Crud en php</title>

<link href="style.css" rel="stylesheet">

</head>
<body>

<br />
<div class="container">
<br />
<div class="row">
<br />

<h2>Formulaire de TODOS</h2>

<p>
</div>
<p>
<br />
<div class="row">
<a href="add.php" class="btn1">Ajouter un  nouveau todo</a>
<br />
<div>
<br />
<table style="width:50%">
<br />
<thead>

<th>Numero</th>
<p>
<th>Tache</th>
<p>
<th>Status</th>
<p>
<th>Edition</th>
<p>
</thead>
<p>
<br />
<tbody>
<?php include 'database.php'; //on inclut notre fichier de connection 
$pdo = Database::connect(); //on se connecte à la base 
$sql = 'SELECT * FROM tp2 ORDER BY id DESC'; //on formule notre requete 
foreach ($pdo->query($sql) as $row) { 
//on cree les lignes du tableau avec chaque valeur retournée
echo '<br /><tr>';
echo'<td>' . $row['tel'] . '</td><p>';
echo'<td>' . $row['tache'] . '</td><p>';
echo'<td>' . $row['status'] . '</td><p>';
echo '<td>';
echo '<a class="btn" href="edit.php?id=' . $row['id'] . '">Read</a>';// un autre td pour le bouton d'edition
echo '</td><p>';
echo '<td>';
echo '<a class="btn-success" href="update.php?id=' . $row['id'] . '">Update</a>';// un autre td pour le bouton d'update
echo '</td><p>';
echo'<td>';
echo '<a class="btn-danger" href="delete.php?id=' . $row['id'] . ' ">Delete</a>';// un autre td pour le bouton de suppression
echo '</td><p>';
echo '</tr><p>';
}
Database::disconnect(); //on se deconnecte de la base
;
?>    
</tbody>
<p>
</table>
<p>
</div>
<p>
</div>
<p>
</div>
<p>

</body>
</html>