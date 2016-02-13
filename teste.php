<?php

$pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");
$dados = array(
    'id' => null,
    'data_hora' => date('Y-m-d H:i:s')
);
$stmt = $pdo->prepare('INSERT INTO teste Values(
                                                      :id,
                                                      :data_hora
                                  )');
$stmt->execute($dados);
?>
