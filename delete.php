<?php require 'database.php';
$id=0; 
if(!empty($_GET['id'])){ $id=$_REQUEST['id']; } 
if(!empty($_POST))
{    $id= $_POST['id'];
     $pdo=Database::connect();
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "DELETE FROM tp2  WHERE id = ?";
     $q = $pdo->prepare($sql);
     $q->execute(array($id));
     Database::disconnect();
     header("Location: index.php");
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="styledelete.css" rel="stylesheet">

</head>
 
<body>

<br />
<div class="container">
     

<br />
<div class="span10 offset1">

<br />
<div class="row">

<br />
<h1>Supprimer un todo</h1>
<p>

</div>
<p>

                     
<br />
<form class="form-horizontal" action="delete.php" method="post">
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<div class="text">                     
Êtes-vous sûr de vouloir supprimer ?
</div>
<br />
<div class="form-actions">
<button type="submit" class="btn btn-danger">Yes</button>
<a class="btn" href="index.php">No</a>
</div>
<p>

</form>
<p></div><p>

</body>
</html>