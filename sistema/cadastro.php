<?php
    include "abrir_transacao.php";
    include_once "operacoes.php";

function validar($pessoa){
    
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $alterar = isset($_GET["chave"]);
    if ($alterar){
        $chave = $_GET["chave"];
        $pessoa = buscar_pessoa($chave);
        if($pessoa == null) die("Não existe!");
    }else {
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
    $validacaoOK = true;
    
} elseif ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $alterar = isset($_POST["chave"]);

    if($alterar){
        $pessoa = [
            "chave" => $_POST["chave"],
            "login" => $_POST["login"],
            "dt_nascimento" => $_POST["dt_nascimento"],
            "url_foto" => $_POST["url_foto"],
            "interesse_homens" => $_POST["interesse_homens"],
            "interesse_mulheres" => $_POST["interesse_mulheres"],
            "sexo" => $_POST["sexo"]
        ];
        $validacaoOK = validar($pessoa);
        if($validacaoOK) alterar_pessoa($flor);
    } else {
        $pessoa = [
            "login" => $_POST["login"],
            "dt_nascimento" => $_POST["dt_nascimento"],
            "url_foto" => $_POST["url_foto"],
            "interesse_homens" => $_POST["interesse_homens"],
            "interesse_mulheres" => $_POST["interesse_mulheres"],
            "sexo" => $_POST["sexo"]
        ];
        $validacaoOK = validar($pessoa);
        if ($validacaoOK) $id = inserir_pessoa($pessoa);
    }

    if ($validacaoOk) {
        header("Location: listagem.php");
        $transacaoOK = true;
    }
} else {
    die("Método não aceito"); 
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Pessoas</title>
        <script>
            function confirmar() {
                if(!confirm("Tem certeza que deseja salvar os dados?")) return;
                document.getElementById("excluir-flor").submit();
            }
        </script>
    </head>
    <body>
        <form method="POST" action="cadastro.php" id="formulario">
            <?php if (!$validacaoOK) {?>
                <div>
                    <p>Preencha os campos corretamente!</p>
                </div>
                <?php } ?>
                <?php if ($alterar) { ?>
                    <div>
                        <label for="chave">Chave:</label>
                        <input type="text" id="chave" name="chave" value="<?= $flor["chave"]?>" readonly>
                    </div>
                <?php } ?>
                <div>
                    <label for="login">login:</label>
                    <input type="text" id="login" name="login" value="<?= $pessoa["login"] ?>">
                </div>
                <div>
                    <label for="dataNasc">Data nascimento:</label>
                    <input type="text" id="login" name="login" value="<?= $pessoa["dt_nascimento"] ?>">
                </div>
                <div>
                    <label for="foto">Foto:</label>
                     <input type="text" id="foto" name="foto" value="<?= $pessoa["url_foto"]?>">
                    <input type="file">
                </div>
        </form>
    </body>
</html>
