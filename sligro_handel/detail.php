<?php
    include_once("querybuilder.php");
    $db = new QueryBuilder("sligro_groothandel");
    $factuur_id = $_GET['id'];
    $factuur = $db->getTableById('factuur', $factuur_id);
    $bedrijf = $db->getTableById('bedrijf', $factuur['bedrijf_id']);
    $klant = $db->getTableById('klant', $factuur['klant_id']);
    $artikel = $db->getBesteldeArtikel($factuur_id);
?>

<table>
    <tr>
        <td>
            <?php
                foreach (array_reverse($bedrijf) as $key => $value) {
                    if($key !== "id") {
                        echo "<p>$value</p>";
                    }
                }
            ?>
        </td>
        <td>
            <p><?= "Factuurcode: $factuur_id"?></p>
            <p><?= "Datum: " . $factuur["datum"]; ?></p>
        </td>
    </tr>
    <?php
        foreach ($klant as $key => $value) {
            if($key !== "id") {
                echo "<tr>";
                echo "<td>" . ucfirst($key) . "</td>";
                echo "<td> $value </td>";
                echo "</tr>";
            }
        }
    ?>
    <tr>
        <th>art.nr</th>
        <th>omschrijving</th>
        <th>aantal</th>
        <th>prijs</th>
        <th>bedrag</th>
    </tr>
    <tr>
        <td>artikelid</td>
        <td>artikelomschrijving</td>
        <td>besteldeartikelaantal</td>
        <td>artikelprijs</td>
        <td>artikelprijs * besteldeartikelaantal</td>
    </tr>
</table>



<html>
  <head>
  </head>
  <body>
    <style>
        table {
          border-collapse: collapse;
          border: 1px solid black;
        }

        td {
          border: 1px solid black;
          width: 100px;
        }
    </style>
  </body>
</html>
