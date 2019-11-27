<?php
require "../_include/inc_config.php";
//tableau des points pour chaque équipe cle=>valeur où clé est l'id d'une équipe et valeur son nombre de point total
$point=[];
for($i=1; $i<=20; $i++)
    $point[$i]=0;

//requete pour sélectionner les noms des équipes
$result = $link->query("select * from equipe");
$tab = $result->fetchAll();
//stocke le nom de l'équipe
$equipe=[];
foreach($tab as $row) {
    extract($row);
    $equipe[$eq_id]=$eq_nom;
}

$result = $link->query("select * from rencontre");
$data = $result->fetchAll();
foreach($data as $row) {
    extract($row);
    if ($re_but1>$re_but2)
        $point[$re_equipe1] += 3;
    else if ($re_but1<$re_but2)
        $point[$re_equipe2] += 3;
    else {
        $point[$re_equipe1] += 1;
        $point[$re_equipe2] += 1;
    }
}
//tri du tableau
asort($point);
$point=array_reverse($point,true);
?>
<!DOCTYPE html>
<html>

<head>
    <?php require "../_include/inc_head.php" ?>
</head>

<body>
    <header>
        <?php require "../_include/inc_entete.php" ?>
    </header>
    <nav>
        <?php require "../_include/inc_menu.php"; ?>
    </nav>
    <div id="contenu">
       <table>
           <tr>
               <th>équipe</th>
               <th>points</th>
           </tr>
           <?php
            foreach($point as $cle=>$valeur) {
                echo "<tr>";
                echo "<td>" . $equipe[$cle] . "</td>";
                echo "<td>$valeur</td>";
                echo "</tr>";
            }
           ?>
       </table>
    </div>
    <hr>
    <footer>
        <?php require "../_include/inc_pied.php"; ?>
    </footer>
</body>

</html>