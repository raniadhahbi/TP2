<?php require 'database.php';
 if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
{ 
    //on initialise nos messages d'erreurs;
       $telError ='';
       $tacheError='';
       $statusError='';
    // on recupère nos valeurs
       $tel=htmlentities(trim($_POST['tel']));
       $tache=htmlentities(trim($_POST['tache'])); 
       $status=htmlentities(trim($_POST['status']));
          
    // on vérifie nos champs
       $valid = true; 
       if (empty($tel)) { $telError = 'Please enter phone'; $valid = false; }
       //else if(!preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#",$tel)){ $telError = 'Please enter a valid phone'; $valid = false; }  
       if(empty($tache)){ $tacheError ='Please enter a description'; $valid= false; } 
       if(empty($status)){ $statusError ='Please select a status'; $valid= false; } 
      
     // si les données sont présentes et bonnes, on se connecte à la base 
       if ($valid)
        { 
            $pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tp2 (tel,tache, status) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($tel, $tache, $status));
            Database::disconnect();
            header("Location: index.php");
        }
}
    
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Todos</title>
<link href="style.css" rel="stylesheet">
</head>
<body>

<br /><div class="container"><br />
<div class="row">
<br /><h1>Ajouter un nouveau todo</h1>
<p></div><p>

<br />
<form method="post" action="add.php">
<br />
<div class="control-group <?php echo !empty($telError)?'error':'';?>">
<label class="control-label">Numéro</label>
<br />
<div class="controls">
<input name="tel" type="text" placeholder="Telephone" value="<?php echo !empty($tel) ? $tel:'';?>">
<?php if (!empty($telError)): ?>
<span class="help-inline"><?php echo $telError;?></span>
<?php endif;?>
</div>
<p></div><p>
<br />

<p>
<br />
<div class="control-group<?php echo !empty($statusError)?'error':'';?>">
<label class="control-label">Statut</label>
<br />
<div >
    Planifiee<input type="checkbox" name="status" value="Planifiee" <?php if (isset($status) && $status == "Planifiee") echo "checked"; ?>>
    En cours <input type="checkbox" name="status" value="En cours" <?php if (isset($status) && $status == "En cours") echo "checked"; ?>>
    Terminee <input type="checkbox" name="status" value="Terminee" <?php if (isset($status) && $status == "Terminee") echo "checked"; ?>>
</div>
<p>
<?php if (!empty($statusError)): ?>
<span class="help-inline"><?php echo $statusError;?></span>
<?php endif;?>
</div>
<p><br/><p>
</div>
<p>

<br/>
<div class="control-group <?php echo !empty($tacheError)?'error':'';?>">
<label class="control-label">Tache </label>
<br />
<div class="controls">
<textarea rows="4" cols="30" name="tache" ><?php if(isset($tache)) echo $tache;?></textarea>    
<?php if(!empty($tacheError)):?>
<span class="help-inline"><?php echo $tacheError ;?></span>
<?php endif;?>
</div>
<p></div><p>

<br />
<div class="form-actions">
<input type="submit" class="btn2" name="submit" value="submit">
<a class="btn3" href="index.php">Retour</a>
</div>
<p>

</form>
<p>
</div>
<p>

</body>
</html>