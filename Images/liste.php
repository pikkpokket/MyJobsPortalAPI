<html>
<head><title>Stock d'images</title></head>
<body>
<?php
      include ("connexion.php");
      $req = "SELECT img_nom, img_id ".
             "FROM images ORDER BY img_nom";
     $ret = mysql_query ($req) or die (mysql_error ());
     while ( $col = mysql_fetch_row ($ret) )
     {
     	echo $col[0];
     	echo $col[1];
           echo "<a href=\"apercu.php?img_nom=".$col[0]."\">".$col[0]."</a><br />";
} ?>
</body>
</html>
