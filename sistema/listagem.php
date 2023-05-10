<?php
try{
    include "abrir_transacao.php";
    include_once "operacoes.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Listagem de Pessoas</title>
    </head>
    <body>
        <?php $resultado = listar_todas_pessoas();?>
        <table>
            <tr>
                <th scope="column">Chave</th>
                <th scope="column">Login</th>
                <th scope="column">Data Nasc.</th>
                <th scope="column">Sexo</th>
            </tr>
            <?p<?php foreach ($resultado as $linha) { ?>
        <tr>
            <td><?= $linha["chave"] ?></td>
            <td><?= $linha["login"] ?></td>
            <td><?= $linha["Data Nasc"] ?></td>
            <td>
                <button type="button">
                    <a href="cadastro.php?chave=<?= $linha["chave"] ?>">Editar</a>
                </button>
            </td>
        </tr>
    <?php } ?>  
        </table>
        <button type="button">
            <a href="cadastro.php">Criar novo</a>
        </button>
    </body>
</html>
<?php

$transacaoOK = true;
}finally {
    include "fechar_transacao.php";
}
?>