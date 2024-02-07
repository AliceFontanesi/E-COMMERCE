<?php

require_once '../dbmanager.php';

$dbManager = new DbManager("localhost", "3306", 'C:\Users\USER\Desktop\E-COMMERCE\file.txt');
$connessione = $dbManager->connect("ecommerce5E");

if ($connessione) {
    $parola_cercata = '%' . $_POST['nome'] . '%';
    $marca_cercata = '%' . $_POST['marca'] . '%';

    $sql = "SELECT nome, marca, prezzo FROM products WHERE nome LIKE :nome AND marca LIKE :marca";
    $stmt = $connessione->prepare($sql);
    $stmt->bindParam(':nome', $parola_cercata, PDO::PARAM_STR);
    $stmt->bindParam(':marca', $marca_cercata, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {?>
        <table class="styled-table">
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
                <tr>
                    <td><?php echo $row["nome"] ?></td>
                    <td><?php echo $row["marca"] ?></td>
                    <td><?php echo $row["prezzo"] ?></td>
                </tr>
        <?php }?>
        </table>
    <?php
    } else {
        echo "Nessun risultato trovato";
    }
} else {
    echo "Connessione al database fallita";
}
?>
