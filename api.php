<?php
require_once __DIR__. '/database.php';
class API {
    function select()
    {
        $db=Database::connect();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $tp2=array();
        $data=$db ->prepare('SELECT * FROM tp2 ORDER BY id');
        $data ->execute();
        while($outputdata=$data ->fetch(PDO:: FETCH_ASSOC))
        {
            $tp2[$outputdata['id']]=array(
                'id' => $outputdata['id'],
                'tel' => $outputdata['tel'],
                'tache' => $outputdata['tache'],
                'status' => $outputdata['status']
            );
        }
        return json_encode($tp2);
    }
   
}
$API = new API;
header('Content-Type: application/json');
echo $API->select();
?>