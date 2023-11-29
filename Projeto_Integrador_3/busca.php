<?php

include 'config.php';

$sql = "SELECT * FROM livros";
$res = $conn->query($sql);
    echo "<table class=\"table table-bordered\" border=\"1\">";
    echo "<tr><th>Titulo</th>";
    echo "<th>Autor</th></tr>";

while ($aux = mysqli_fetch_assoc($res)) {
   echo "<tr><td><input type='checkbox' id='".$aux["id"]."' value='".$aux["id"]."'>  ".$aux["titulo"]."</td>";
   echo "<td>".$aux["autor"]."</td></tr>";
}

    echo "</table>";

    mysqli_close($conn);
?>