<?php
    require_once("querybuilder.php");
    $db = new QueryBuilder("sligro_groothandel");

    if(isset($_GET['id'])) {
        $factuur_id = $_GET['id'];

        $factuur = $db->getTableById('factuur', $factuur_id);
        $bedrijf = $db->getTableById('bedrijf', $factuur['bedrijf_id']);
        $klant = $db->getTableById('klant', $factuur['klant_id']);
        $artikelen = $db->getBesteldeArtikelen($factuur_id);
        $prijs_details = $db->getTotaal($artikelen, $factuur['korting']);
    }
?>

<table>
    <tr>
        <td class="table-half">
            <?php
                foreach (array_reverse($bedrijf) as $key => $value) {
                    if($key !== "id") {
                        echo "<p>$value</p>";
                    }
                }
            ?>
        </td>
        <td class="table-half">
            <p><?= "Factuurcode: $factuur_id"?></p>
            <p><?= "Datum: " . $factuur["datum"]; ?></p>
        </td>
    </tr>
    <?php
        foreach ($klant as $key => $value) {
            if($key !== "id") {
                echo "<tr>";
                echo "<td class=\"table-quarter\">" . ucfirst($key) . "</td>";
                echo "<td> $value </td>";
                echo "</tr class=\"table-quarter\">";
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
    <?php
        foreach($artikelen as $artikel) {
            echo "<tr>";
            echo "<td>" . $artikel['id'] . "</td>";
            echo "<td>" . $artikel['omschrijving'] . "</td>";
            echo "<td>" . $artikel['aantal'] . "</td>";
            echo "<td>" . $artikel['prijs'] . "</td>";
            echo "<td>" . $artikel['prijs'] * $artikel['aantal']  . "</td>";
            echo "</tr>";
        }
    ?>
    <tr>
        <td>Subtotaal</td>
        <td><?= $prijs_details['subtotaal']?></td>
    <tr>
    <tr>
        <td>Korting</td>
        <td><?= $prijs_details['korting']?></td>
    <tr>
    <tr>
        <td>Totaal excl. btw</td>
        <td><?= $prijs_details['totaalexc']?></td>
    <tr>
    <tr>
        <td>21&#37; btw</td>
        <td><?= $prijs_details['btw']?></td>
    <tr>
    <tr>
        <td>Totaal</td>
        <td><?= $prijs_details['totaal']?></td>
    <tr>
</table>

<html>
  <head>
  </head>
  <body>
    <style>
        table {
          border-collapse: collapse;
          border: 1px solid black;
          width: 700px;
        }

        td {
          border: 1px solid black;
          width: 100px;
          overflow: hidden;
        }

        tr {
            width: 100%;
        }

        .table-half {
            width: 50%;
        }

        .table-quarter {
            width: 25%;
        }


    </style>
  </body>
</html>
