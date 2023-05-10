 <?php
include_once "conecta_sqlite.php";
$pdo = conectar();
$transacaoOK = false;
$pdo->beginTransaction();
?>