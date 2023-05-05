<?php
if ($transacaoOK){
    $pdo->commit();
} else {
    $pdo->rollback();
}
$pdo = null;
?>