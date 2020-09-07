<?php require('database.php');
 //on appelle notre fichier de config 
$id = null; 
if (!empty($_GET['id'])) { $id = $_REQUEST['id']; } 
if (null == $id) { header("location:index.php"); } 
else { //on lance la connection et la requete 
    $pdo = Database ::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) .
    $sql = "SELECT * FROM tp2 where id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="styleedit.css" rel="stylesheet">
</head>
<body>

<br />
<div class="container">
<br />
<div >
<br />
<div class="row">
<br />
<h1>Edition</h1>
<p></div><p>

<p></div><p>
<br />
<div class="controlgroup1">
<label class="controllabel1">Numéro</label>
<br />
<div class="controls1">
<label><?php echo $data['tel']; ?>
</label>
</div>

<p></div><p>
<br />
<p></div><p>


<br />
<div class="controlgroup1">
<label class="controllabel1">Status</label>
<br />
<div class="controls1">
<label ><?php echo $data['status']; ?>
</label>
</div>

<p></div><p>
<br />
<p></div><p>

<br />
<div class="controlgroup1">
<label class="controllabel1">Tache</label>
<br />
<div class="controls1">
<label><?php echo $data['tache']; ?>
</label>
</div>

<p></div><p>
<br />
<div >
<a class="btn" href="index.php">Retour</a>
</div>

<p></div><p>
</div><p>
</div><p>

</body>
</html>