<?php
try {
    include "abrir_transacao.php";
include_once "operacoes.php";

// $tipos = listar_todos_tipos();

function validar($pessoa) {
    // global $tipos;
    return strlen($pessoa["login"]) >= 4;
    //     && strlen($pessoa["cor"]) <= 30
    //     && strlen($pessoa["especie"]) >= 4
    //     && strlen($pessoa["especie"]) <= 50
    //     && strlen($pessoa["localizacao"]) >= 4
    //     && strlen($pessoa["localizacao"]) <= 200
    //     && $pessoa["folhas"] >= 0
    //     && $pessoa["folhas"] <= 5000000
    //     && in_array($pessoa["tipo"], $tipos, true);
        
};

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $alterar = isset($_GET["chave"]);
    if ($alterar) {
        $chave = $_GET["chave"];
        $pessoa = buscar_pessoa($chave);
        if ($pessoa == null) die("Não existe!");
    } else {
        $chave = "";
        $pessoa = [
            "chave" => "",
            "login" => "",
            "dt_nascimento" => "",
            "url_foto" => "",
            "interesse_homens" => "",
            "interesse_mulheres" => "",
            "sexo" => ""
        ];
    }
    $validacaoOk = true;

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $alterar = isset($_POST["chave"]);

    if ($alterar) {
        $pessoa = [
            "chave" => $_POST["chave"],
            "login" => $_POST["login"],
            "dt_nascimento" => $_POST["dt_nascimento"],
            "url_foto" => $_POST["url_foto"],
            "interesse_homens" => isset($_POST["interesse_homens"])? 1 : 0,
            "interesse_mulheres" => isset($_POST["interesse_mulheres"])? 1 :0,
            "sexo" => $_POST["sexo"]
        ];
        $validacaoOk = validar($pessoa);
        if ($validacaoOk) alterar_pessoa($pessoa);
    } else {
        $pessoa = [
            "login" => $_POST["login"],
            "dt_nascimento" => $_POST["dt_nascimento"],
            "url_foto" => $_POST["url_foto"],
            "interesse_homens" => isset($_POST["interesse_homens"])? 1 : 0,
            "interesse_mulheres" => isset($_POST["interesse_mulheres"])? 1 : 0,
            "sexo" => $_POST["sexo"]
        ];
        $validacaoOk = validar($pessoa);
        if ($validacaoOk) $id = inserir_pessoa($pessoa);
    }

    if ($validacaoOk) {
        header("Location: listagem.php");
        $transacaoOk = true;
    }
} else {
    die("Método não aceito");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Pessoas</title>
        <script>
            function confirmar() {
                if (!confirm("Tem certeza que deseja salvar os dados?")) return;
                document.getElementById("formulario").submit();
            }

            function excluir() {
                if (!confirm("Tem certeza que deseja excluir a pessoa?")) return;
                document.getElementById("excluir-pessoa").submit();
            }
        </script>
    </head>
    <body>
        <form method="POST" action="cadastro.php" id="formulario">
            <?php if (!$validacaoOk) {?>
                <div>
                    <p>Preencha os campos corretamente!</p>
                </div>
            <?php } ?>
            <?php if ($alterar) { ?>
                <div>
                    <label for="chave">Chave:</label>
                    <input type="text" id="chave" name="chave" value="<?= $pessoa["chave"] ?>" readonly>
                </div>
            <?php } ?>
            <div>
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" value="<?= $pessoa["login"] ?>">
            </div>
            <div>
                <label for="dt_nascimento">Data Nascimento:</label>
                <input type="date" id="dt_nascimento" name="dt_nascimento" value="<?= $pessoa["dt_nascimento"] ?>">
            </div>
            <div>
                <label for="url_foto">URL foto:</label>
                <input type="text" id="url_foto" name="url_foto" value="<?= $pessoa["url_foto"] ?>">
            </div>
            <div>
                <label for="interesse_homens">Homens:</label>
                <input type="checkbox" id="interesse_homens" name="interesse_homens" value="<?= $pessoa["interesse_homens"] ?>">
            </div>
            <div>
                <label for="interesse_mulheres">Mulheres:</label>
                <input type="checkbox" id="interesse_mulheres" name="interesse_mulheres" value="<?= $pessoa["interesse_mulheres"] ?>">
            </div>
            <div>
                <label for="sexo">Sexo:</label>
                <input type="radio" id="sexo" name="sexo" value="M" <?php if ($pessoa["sexo"] === "M") echo "checked"; ?>>M
                <input type="radio" id="sexo" name="sexo" value="F" <?php if ($pessoa["sexo"] === "F") echo "checked"; ?>>F
            </div>
            <div>
                <button type="button" onclick="confirmar()">Salvar</button>
            </div>
        </form>
        <?php if ($alterar) { ?>
            <form action="excluir.php"
                    method="POST"
                    style="display: none"
                    id="excluir-pessoa">
                <input type="hidden" name="chave" value="<?= $pessoa["chave"] ?>" >
            </form>
            <button type="button" onclick="excluir()">Excluir</button>
        <?php } ?>
    </body>
</html>

<?php
$transacaoOk = true;

} finally {
    include "fechar_transacao.php";
}
?>