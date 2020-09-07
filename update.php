<?php require 'database.php';
 $id = null;
 if ( !empty($_GET['id'])) { $id = $_REQUEST['id']; } 
 //Un tableau associatif qui contient par défaut le contenu des variables $_GET, $_POST et $_COOKIE.
 if ( null==$id ) { header("Location: index.php"); }
 if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) 
{ // on initialise nos erreurs
 
      $telError = null; 
      $tacheError = null; 
      $statusError = null;
     
      // On assigne nos valeurs

         $tel = $_POST['tel'];
         $tache = $_POST['tache'];
         $status = $_POST['status'];
          
         // On verifie que les champs sont remplis
         $valid = true; 
         if (empty($tel)) { $telError = 'Please enter phone'; $valid = false; } 
         if (empty($tache)) { $tacheError = 'Please enter a description'; $valid = false; } 
         if (!isset($status)) { $statusError = 'Please select a status'; $valid = false; } 
    
         // mise à jour des donnés
          if ($valid) 
          { $pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
             $sql = "UPDATE tp2 SET tel = ?, tache = ?, status = ? WHERE id = ?";
             $q = $pdo->prepare($sql);
             $q->execute(array($tel,$tache, $status,$id));
             Database::disconnect();
             header("Location: index.php");
         } 
        }
        else {

             $pdo = Database::connect();
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "SELECT * FROM tp2 where id = ?";
             $q = $pdo->prepare($sql);
             $q->execute(array($id));
             $data = $q->fetch(PDO::FETCH_ASSOC);
             $tel = $data['tel'];
             $tache = $data['tache'];
             $status = $data['status'];
             Database::disconnect();
         }
     
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="styleupdate.css" rel="stylesheet">
<title>Crud-Update</title>
       
</head>
<body>
  
<br />
<div class="container">
<br />
<div class="row">
<br />
<h1>Modifier un todo</h1>
<p></div><p>

<br />
<form method="post" action="update.php?id=<?php echo $id ;?>">
<br />

<p></div><p>

<br />
<div class="controlgroup2 <?php echo!empty($telError) ? 'error' : ''; ?>">
<label class="controllabel2">Telephone</label>
<br />
<div class="controls2">
<input name="tel" type="text" placeholder="Telephone" value="<?php echo!empty($tel) ? $tel : ''; ?>">
<?php if (!empty($telError)): ?>
<span class="help-inline"><?php echo $telError; ?></span>
<?php endif; ?>
</div>

<p></div><p>


<br />
<div class="controlgroup2<?php echo!empty($statusError) ? 'error' : ''; ?>">
<label class="controllabel2">Status</label>
<br />
<div class="controls2">
Planifiee <input type="checkbox" name="status" value="Planifiee" <?php if (isset($status) && $status == "Planifiee") echo "checked"; ?>>
En cours <input type="checkbox" name="status" value="En cours" <?php if (isset($status) && $status == "En cours") echo "checked"; ?>>
Terminee <input type="checkbox" name="status" value="Terminee" <?php if (isset($status) && $status == "Terminee") echo "checked"; ?>>
</div>
<p>
<?php if (!empty($statusError)): ?>
<span ><?php echo $statusError; ?></span>
<?php endif; ?>
</div>
<p>

<p></div><p>

<br />
<div class="controlgroup2 <?php echo!empty($tacheError) ? 'error' : ''; ?>">
<label class="controllabel2">Tache </label>

<br />
<div class="controls2">
<textarea rows="4" cols="30" name="tache" ><?php if (isset($tache)) echo $tache; ?></textarea>    
<?php if (!empty($tacheError)): ?>
<span ><?php echo $tacheError; ?></span>
<?php endif; ?>
</div>

<p></div><p>


<br />
<div >
<input type="submit" class="btn btn-success" name="submit" value="submit">
<a class="btn2" href="index.php">Retour</a>
</div>
<p>
</form>

<p></div><p>
</body>
</html>