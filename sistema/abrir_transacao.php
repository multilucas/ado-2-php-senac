 <?php
include_once "conecta-sqlite.php";
$pdo = conectar();
$transacaoOK = false;
$pdo->beginTransaction();
?>