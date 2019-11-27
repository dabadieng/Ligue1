<?php
require "../_include/inc_config.php";

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
        <pre>
        <h1>Génération du jeu de données</h1>        
        <?php
        //création des équipes        
        echo "<h1>Création des équipes</h1>";
        $chaine="Amiens,SCO Angers,Girondins Bordeaux,Brest,DFCO Dijon,LOSC Lille,OL Lyon,OM Marseille,FCM Metz,ASM Monaco,MHSC Montpellier,FCNA Nantes,OGCN Nice,Nîmes Nîmes,PSG Paris,SDR Reims,Rennes Rennes,ASSE Saint-Etienne,Strasbourg,TFC Toulouse";
        $equipe=explode(",",$chaine);        
        $sql = "insert into equipe values ";
        $data=[];        
        foreach ($equipe as $nom) {
            $data[]="(null,'$nom',0)";
        }
        $link->query($sql . implode(",",$data));        

        echo "<h1>Création des rencontres</h1>";        
        $nbequipe = 20;
        $sql = "insert into rencontre values ";
        $data = [];
        $equipe_courante = 1;
        
        while ($equipe_courante < $nbequipe) {
            for ($i = $equipe_courante + 1; $i <= $nbequipe; $i++) {
                $equipe1 = $equipe_courante;
                $equipe2 = $i;                       
                $but1 = rand(0, 5);
                $but2 = rand(0, 5);           
                //détermination du numéro de journée
                $num=rand(1,38);
                $data[] = "(null, $equipe1, $equipe2, $num, $but1, $but2)";
                //match retour
                $num=rand(1,38);                
                $but1 = rand(0, 5);
                $but2 = rand(0, 5);                
                $data[] = "(null, $equipe2, $equipe1, $num, $but1, $but2)";
            }
            $equipe_courante++;
        }
        print_r($data);
        $link->query($sql . implode(",",$data));
        ?>
        </pre>
    </div>
    <hr>
    <footer>
        <?php require "../_include/inc_pied.php"; ?>
    </footer>
</body>

</html>