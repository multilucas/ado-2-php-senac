<?php
try {
    include "abrir_transacao.php";
include_once "operacoes.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Listagem de pessoaes</title>
    </head>
    <body>
        <?php $resultado = listar_todas_pessoas(); ?>
        <table>
            <tr>
                <th scope="column">Chave</th>
                <th scope="column">Login</th>
                <th scope="column">Data Nascimento</th>
                <th scope="column">Foto</th>
                <th scope="column">Homens</th>
                <th scope="column">Mulheres</th>
                <th scope="column">sexo</th>
            </tr>
            <?php foreach ($resultado as $linha) { ?>
                <tr>
                    <td><?= $linha["chave"] ?></td>
                    <td><?= $linha["login"] ?></td>
                    <td><?= $linha["dt_nascimento"] ?></td>
                    <td><?= $linha["url_foto"] ?></td>
                    <td><?= $linha["interesse_homens"] ?></td>
                    <td><?= $linha["interesse_mulheres"] ?></td>
                    <td><?= $linha["sexo"] ?></td>
                    <td>
                        <button type="button">
                            <a href="cadastro.php?chave=<?= $linha["chave"] ?>">Editar</a>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <button type="button"><a href="cadastro.php">Criar novo</a></button>
    </body>
</html>

<?php

$transacaoOk = true;

} finally {
    include "fechar_transacao.php";
}
?>